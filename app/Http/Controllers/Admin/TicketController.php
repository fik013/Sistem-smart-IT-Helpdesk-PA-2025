<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Ticket;
use Illuminate\Http\Request;

class TicketController extends Controller
{
    /**
     * Display a listing of tickets sorted by SAW priority.
     */
    public function index()
    {
        // Fetch all pending/processing tickets
        $tickets = Ticket::with('user')
            ->whereIn('status', ['pending', 'processing'])
            ->get();

        // Calculate SAW Score for each ticket
        // For now, since we don't have dynamic criteria data stored yet,
        // we will implement a hardcoded version of the SAW calculation 
        // as a placeholder to demonstrate the sorting functionality.
        
        $tickets->transform(function ($ticket) {
            // Criteria 1: User Role (Admin/Director = High Priority)
            // Weight: 0.10 (From design)
            $userRoleScore = 0;
            if ($ticket->user && $ticket->user->role === 'admin') {
                $userRoleScore = 1.0; 
            } else {
                $userRoleScore = 0.5; // Standard user
            }

            // Criteria 2: Ticket Age/Urgency ( Older tickets = Higher urgency?) or just static
            // Let's assume ticket duration adds to urgency.
            // Weight: 0.40 (Urgency)
            $hoursSinceCreation = $ticket->created_at->diffInHours(now());
            // Normalize: Max 48 hours for full score
            $urgencyScore = min($hoursSinceCreation / 48, 1.0); 

            // Criteria 3: Asset Criticality (If we had asset info)
            // Weight: 0.30
            // Placeholder
            $assetScore = 0.5;

            // Criteria 4: Warranty Status
            // Weight: 0.20
            // Placeholder 
            $warrantyScore = 0.5;

            // Total SAW Score
            // Weights: 0.4, 0.3, 0.2, 0.1
            $sawScore = ($urgencyScore * 0.4) + ($assetScore * 0.3) + ($warrantyScore * 0.2) + ($userRoleScore * 0.1);

            $ticket->saw_score = $sawScore;
            return $ticket;
        });

        // Sort by SAW Score Descending
        $tickets = $tickets->sortByDesc('saw_score');

        // Manual Pagination for the collection
        $page = request()->get('page', 1);
        $perPage = 10;
        $tickets = new \Illuminate\Pagination\LengthAwarePaginator(
            $tickets->forPage($page, $perPage),
            $tickets->count(),
            $perPage,
            $page,
            ['path' => request()->url(), 'query' => request()->query()]
        );

        return view('admin.tickets.index', compact('tickets'));
    }

    public function show(Ticket $ticket)
    {
        return view('admin.tickets.show', compact('ticket'));
    }

    public function update(Request $request, Ticket $ticket)
    {
        $validated = $request->validate([
            'status' => 'required|in:pending,processing,completed,rejected',
            'admin_response' => 'nullable|string',
        ]);

        $ticket->update($validated);

        return redirect()->route('admin.tickets.index')->with('success', 'Status tiket berhasil diperbarui.');
    }
}
