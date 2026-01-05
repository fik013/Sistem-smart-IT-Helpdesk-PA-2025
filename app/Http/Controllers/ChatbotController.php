<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class ChatbotController extends Controller
{
    public function ask(Request $request)
    {
        $request->validate(['message' => 'required|string']);
        $user = Auth::user();
        $message = $request->input('message');
        
        // 1. Collect Context: User & Department Inventory
        // Fetch personal assets
        $personalAssets = \App\Models\Inventory::where('user_id', $user->id)
            ->with('category')
            ->get();
            
        // Fetch department assets (shared assets usually have null user_id but a valid department_id)
        // Since User has 'department' string, we need to find the Department ID first or join.
        $departmentAssets = collect();
        if ($user->department) {
            $departmentAssets = \App\Models\Inventory::whereHas('department', function($q) use ($user) {
                $q->where('name', $user->department);
            })->where('user_id', null) // Only fetch shared departmental assets (not assigned to specific other users)
              ->with('category')
              ->get();
        }

        $allAssets = $personalAssets->merge($departmentAssets);

        $inventoryList = $allAssets->map(function($item) {
            $category = $item->category->name ?? 'Unknown Device';
            $desc = $item->description ? ", Deskripsi: {$item->description}" : "";
            $ownerType = $item->user_id ? "(Milik Pribadi)" : "(Aset Departemen)";
            return "- {$item->item_name} {$ownerType} (Tipe: {$category}, Serial: {$item->serial_number}, Status: {$item->status}{$desc})";
        })->implode("\n");

        if (empty($inventoryList)) {
            $inventoryList = "Tidak ada aset terdaftar untuk pengguna atau departemen ini.";
        }

        // 1b. Collect Context: Knowledge Base (FAQ)
        // Fetch all published FAQs (Assumes reasonable number of FAQs, otherwise vector search is needed)
        $faqs = \App\Models\Faq::where('is_published', true)->get();
        $faqContext = $faqs->map(function($faq) {
            return "Q: {$faq->question}\nA: {$faq->answer}";
        })->implode("\n\n");
        
        if (empty($faqContext)) {
            $faqContext = "Tidak ada data FAQ tersedia.";
        }

        // 2. Construct System Prompt
        $systemContext = "Anda adalah Asisten IT Helpdesk Cerdas untuk 'Sistem Smart IT Helpdesk'.
        Tujuan Anda adalah membantu karyawan dengan masalah teknis, troubleshooting, dan pertanyaan seputar IT.
        
        [Konteks Pengguna]
        Nama: {$user->name}
        Departemen: {$user->department}
        Aset/Inventaris yang Dimiliki:
        {$inventoryList}
        
        [Basis Pengetahuan (FAQ & Kebijakan)]
        Gunakan informasi berikut untuk menjawab pertanyaan umum (akun, kebijakan, prosedur):
        {$faqContext}
        
        [Pedoman Ketat]
        1. Kesadaran Konteks: Anda mengetahui siapa pengguna ini dan perangkat apa yang mereka miliki.
        2. Prioritas Data: Jika pertanyaan ada di FAQ, utamakan jawaban dari FAQ tersebut. Jika terkait hardware, cek inventaris user.
        3. Batasan Lingkup: HANYA jawab pertanyaan seputar IT, komputer, software, hardware, jaringan, dan masalah teknis.
        4. Nada Bicara: Profesional, membantu, ringkas, dan ramah.
        5. Eskalasi: Jika masalahnya rumit atau memerlukan perbaikan fisik, sarankan untuk 'Buat Tiket'.
        6. Format: Gunakan poin-poin (bullet points) untuk langkah-langkah. Jawaban harus pendek dan to the point (hindari paragraf panjang).
        7. Bahasa: Jawablah dalam Bahasa Indonesia.";

        // 3. Call Groq API
        $apiKey = env('GROQ_API_KEY');

        if (!$apiKey) {
            return response()->json([
                'response' => "System Error: AI configuration missing (GROQ_API_KEY). Please contact administrator.",
                'suggest_ticket' => true
            ]);
        }

        try {
            $url = "https://api.groq.com/openai/v1/chat/completions";
            
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $apiKey,
                'Content-Type' => 'application/json',
            ])->post($url, [
                'model' => 'llama-3.3-70b-versatile',
                'messages' => [
                    ['role' => 'system', 'content' => $systemContext],
                    ['role' => 'user', 'content' => $message]
                ],
                'temperature' => 0.7,
                'max_tokens' => 1000,
            ]);

            if ($response->successful()) {
                $data = $response->json();
                $aiReply = $data['choices'][0]['message']['content'] ?? 'Maaf, saya tidak dapat menghasilkan jawaban saat ini.';
                
                // Convert Markdown to specific HTML for the frontend
                $aiReply = preg_replace('/\*\*(.*?)\*\*/', '<strong>$1</strong>', $aiReply); // Bold
                $aiReply = nl2br($aiReply); // Newlines

                return response()->json([
                    'response' => $aiReply,
                    'suggest_ticket' => true 
                ]);
            } else {
                Log::error('Groq API Error Status: ' . $response->status());
                Log::error('Groq API Error Body: ' . $response->body());

                if ($response->status() === 429) {
                     return response()->json([
                        'response' => "Layanan AI sedang sibuk (Limit Kuota Tercapai). Mohon tunggu sebentar sebelum mencoba lagi.",
                        'suggest_ticket' => false
                    ]);
                }

                return response()->json([
                    'response' => "Maaf, terjadi gangguan pada layanan AI (Status: " . $response->status() . "). Silakan coba lagi atau buat tiket.",
                    'suggest_ticket' => true
                ]);
            }
        } catch (\Exception $e) {
            Log::error('Chatbot Exception: ' . $e->getMessage());
            return response()->json([
                'response' => "Terjadi kesalahan koneksi. Periksa koneksi internet Anda.",
                'suggest_ticket' => true
            ]);
        }


    }
}
