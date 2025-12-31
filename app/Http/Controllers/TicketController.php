<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Services\SawService;

class TicketController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $tickets = $user->tickets()->latest()->paginate(10);
        
        $stats = [
            'total' => $user->tickets()->count(),
            'open' => $user->tickets()->where('status', 'pending')->count(),
            'processing' => $user->tickets()->where('status', 'processing')->count(), // changed from in_progress to processing matching enum
            'completed' => $user->tickets()->where('status', 'completed')->count(),
        ];
        
        return view('user.tickets.index', compact('tickets', 'stats'));
    }

    public function create()
    {
        $inventories = Auth::user()->inventories;
        return view('user.tickets.create', compact('inventories'));
    }

    public function store(Request $request, SawService $sawService)
    {
        $validated = $request->validate([
            'subject' => 'required|string|max:255',
            'description' => 'required|string',
            'inventory_id' => 'nullable|exists:inventories,id',
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

        return redirect()->route('tickets.index')->with('success', 'Ticket created successfully!');
    }
}
