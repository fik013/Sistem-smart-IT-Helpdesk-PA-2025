<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Faq;
use Illuminate\Http\Request;

class FaqController extends Controller
{
    public function index(Request $request)
    {
        $query = Faq::where('is_published', true);

        if ($request->has('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('question', 'like', "%{$search}%")
                  ->orWhere('answer', 'like', "%{$search}%");
            });
        }

        $faqs = $query->latest()->get();
        return view('user.faq.index', compact('faqs'));
    }

    public function search(Request $request)
    {
        $subject = $request->get('subject');
        $description = $request->get('description');
        $inventoryId = $request->get('inventory_id');

        $query = Faq::where('is_published', true);

        $keywords = [];
        
        if ($subject) {
            // Extract meaningful words? For now simple space check or just use whole string
            // Let's split by space and take words > 3 chars
            $words = explode(' ', $subject);
            foreach ($words as $word) {
                if (strlen($word) > 3) $keywords[] = $word;
            }
        }

        if ($inventoryId) {
            $inventory = \App\Models\Inventory::with('category')->find($inventoryId);
            if ($inventory && $inventory->category) {
                $keywords[] = $inventory->category->name;
            }
        }

        if (empty($keywords) && empty($subject) && empty($description)) {
             // Random or popular? Or empty.
             return response()->json([]);
        }
        
        // If we have specific keywords, search for them
        if (!empty($keywords)) {
             $query->where(function($q) use ($keywords) {
                foreach ($keywords as $word) {
                    $q->orWhere('question', 'like', "%{$word}%")
                      ->orWhere('answer', 'like', "%{$word}%");
                }
             });
        } elseif ($subject) {
             // Fallback to direct like if keywords logic failed (e.g. short words)
             $query->where('question', 'like', "%{$subject}%");
        }

        $faqs = $query->limit(5)->get(['id', 'question', 'answer']);
        
        // Clean answer for preview (strip tags)
        $faqs->transform(function ($faq) {
            $faq->answer_preview = \Illuminate\Support\Str::limit(strip_tags($faq->answer), 100);
            return $faq;
        });

        return response()->json($faqs);
    }
}
