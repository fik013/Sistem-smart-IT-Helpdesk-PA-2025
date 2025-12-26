<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TicketController extends Controller
{
    public function create()
    {
        return view('tickets.create');
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
