<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Services\SawService;

use App\Notifications\TicketCreatedNotification;

class TicketController extends Controller
{
    public function index(Request $request)
    {
        $user = Auth::user();
        $query = $user->tickets()->latest();

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('id', 'like', "%$search%")
                  ->orWhere('subject', 'like', "%$search%");
            });
        }

        if ($request->filled('status') && $request->status !== 'all') {
            $query->where('status', $request->status);
        }

        if ($request->filled('urgency') && $request->urgency !== 'all') {
            $query->where('urgency', $request->urgency);
        }

        $tickets = $query->paginate(10)->withQueryString();
        
        $stats = [
            'total' => $user->tickets()->count(),
            'open' => $user->tickets()->where('status', 'pending')->count(),
            'processing' => $user->tickets()->where('status', 'processing')->count(),
            'completed' => $user->tickets()->where('status', 'completed')->count(),
        ];
        
        return view('user.tickets.index', compact('tickets', 'stats'));
    }

    public function create()
    {
        $user = Auth::user();
        $query = \App\Models\Inventory::query();

        // Base Query: User's items OR Department's items
        $query->where(function($q) use ($user) {
            $q->where('user_id', $user->id);
            
            if ($user->department) {
                // Find department by name
                $dept = \App\Models\Department::where('name', $user->department)->first();
                if ($dept) {
                     $q->orWhere('department_id', $dept->id);
                }
            }
        });

        $inventories = $query->get();
        $announcements = \App\Models\Announcement::active()->latest()->limit(3)->get();
        
        return view('user.tickets.create', compact('inventories', 'announcements'));
    }

    public function store(Request $request, SawService $sawService)
    {
        $validated = $request->validate([
            'subject' => 'required|string|max:255',
            'description' => 'required|string',
            'inventory_id' => 'required|exists:inventories,id',
            'urgency' => 'required|in:low,medium,high',
            'evidence' => 'nullable|file|mimes:jpg,png,pdf|max:2048',
        ]);

        $path = null;
        if ($request->hasFile('evidence')) {
            $path = $request->file('evidence')->store('evidence', 'public');
        }

        $ticket = Auth::user()->tickets()->create([
            'subject' => $validated['subject'],
            'description' => $validated['description'],
            'inventory_id' => $validated['inventory_id'] ?? null,
            'urgency' => $validated['urgency'],
            'evidence_path' => $path,
            'status' => 'pending'
        ]);

        // Calculate SAW Score
        $score = $sawService->calculateScore($ticket);
        $ticket->update(['saw_score' => $score]);

        // Notify Admins
        $admins = \App\Models\User::where('role', 'admin')->get();
        \Illuminate\Support\Facades\Notification::send($admins, new TicketCreatedNotification($ticket));

        return redirect()->route('tickets.index')->with('success', 'Ticket created successfully!');
    }
}
