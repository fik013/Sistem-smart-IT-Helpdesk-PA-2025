<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Ticket;
use Illuminate\Http\Request;

use App\Services\SawService;

use App\Notifications\TicketStatusUpdatedNotification;

class TicketController extends Controller
{
    /**
     * Display a listing of tickets sorted by SAW priority.
     */
    public function index(SawService $sawService)
    {
        // Fetch all pending/processing tickets
        $tickets = Ticket::with(['user', 'inventory'])
            ->whereIn('status', ['pending', 'processing'])
            ->get();

        // Calculate SAW Score dynamically using Matrix Normalization (Max/Min)
        $tickets = $sawService->calculateScores($tickets);

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

        // Notify user
        if ($ticket->user) {
            $ticket->user->notify(new TicketStatusUpdatedNotification($ticket));
        }

        return redirect()->route('admin.tickets.index')->with('success', 'Status tiket berhasil diperbarui.');
    }
}
