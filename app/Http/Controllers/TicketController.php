<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TicketController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $tickets = $user->tickets()->latest()->paginate(10);
        
        $stats = [
            'total' => $user->tickets()->count(),
            'open' => $user->tickets()->where('status', 'pending')->count(), // 'open' usually mapped to pending or open
            'processing' => $user->tickets()->where('status', 'in_progress')->count(),
            'completed' => $user->tickets()->where('status', 'completed')->count(),
        ];
        
        return view('user.tickets.index', compact('tickets', 'stats'));
    }

    public function create()
    {
        return view('user.tickets.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'subject' => 'required|string|max:255',
            'description' => 'required|string',
            'evidence' => 'nullable|file|mimes:jpg,png,pdf|max:2048',
        ]);

        $path = null;
        if ($request->hasFile('evidence')) {
            $path = $request->file('evidence')->store('evidence', 'public');
        }

        Auth::user()->tickets()->create([
            'subject' => $validated['subject'],
            'description' => $validated['description'],
            'evidence_path' => $path,
            'status' => 'pending'
        ]);

        return redirect()->route('user.dashboard')->with('success', 'Ticket created successfully!');
    }
}
