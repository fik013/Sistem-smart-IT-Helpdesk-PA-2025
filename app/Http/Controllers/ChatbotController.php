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
        
        // 1. Collect Context: User Inventory
        $inventoryList = $user->inventories->map(function($item) {
            $category = $item->category->name ?? 'Unknown Device';
            return "- {$item->item_name} (Type: {$category}, Serial: {$item->serial_number}, Status: {$item->status})";
        })->implode("\n");

        if (empty($inventoryList)) {
            $inventoryList = "No registered assets found for this user.";
        }

        // 2. Construct System Prompt
        $systemInstruction = "You are an intelligent IT Helpdesk Assistant for 'Sistem Smart IT Helpdesk'. 
        Your goal is to assist employees with technical issues, troubleshooting, and IT-related inquiries.
        
        [User Context]
        Name: {$user->name}
        Department: {$user->department}
        assigned Assets/Inventory:
        {$inventoryList}
        
        [Strict Guidelines]
        1. Context Awareness: You know who the user is and what devices they have. If they ask about 'my laptop' or 'printer', refer to their specific assets listed above (e.g., 'For your Asus ROG...').
        2. Scope Limitation: ONLY answer questions related to IT, computers, software, hardware, networking, and technical troubleshooting. If the user asks about non-IT topics (like cooking, weather, general knowledge unrelated to work), politely decline and state you are an IT assistant.
        3. Tone: Professional, helpful, concise, and friendly.
        4. Escalation: If a problem seems physical/hardware related or you cannot solve it, suggest they 'Create a Ticket' for a human technician.
        5. Language: Reply in the same language as the user (mainly Indonesian).
        
        User Query: {$message}";

        // 3. Call Gemini API
        $apiKey = env('GEMINI_API_KEY');

        if (!$apiKey) {
            return response()->json([
                'response' => "System Error: AI configuration missing (API Key). Please contact administrator.",
                'suggest_ticket' => true
            ]);
        }

        try {
            $response = Http::withHeaders([
                'Content-Type' => 'application/json',
            ])->post("https://generativelanguage.googleapis.com/v1beta/models/gemini-1.5-flash:generateContent?key={$apiKey}", [
                'contents' => [
                    [
                        'parts' => [
                            ['text' => $systemInstruction]
                        ]
                    ]
                ],
                'generationConfig' => [
                    'temperature' => 0.7,
                    'maxOutputTokens' => 500,
                ]
            ]);

            if ($response->successful()) {
                $data = $response->json();
                $aiReply = $data['candidates'][0]['content']['parts'][0]['text'] ?? 'Maaf, saya tidak dapat menghasilkan jawaban saat ini.';
                
                // Remove formatting like ** if desired, or keep markdown if frontend supports it. 
                // The frontend seems to just display text, markdown support is unknown but usually safe to keep basic text.
                // We'll keep it raw for now.

                Log::info('Gemini API Success');
                return response()->json([
                    'response' => $aiReply,
                    'suggest_ticket' => true // logic could be refined based on AI response keywords
                ]);
            } else {
                Log::error('Gemini API Error Status: ' . $response->status());
                Log::error('Gemini API Error Body: ' . $response->body());
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
