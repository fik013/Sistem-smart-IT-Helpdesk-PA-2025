<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Ticket;
use App\Models\Inventory;
use Illuminate\Http\Request;

class AdminDashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'total_users' => User::count(),
            'total_tickets' => Ticket::count(),
            'pending_tickets' => Ticket::where('status', 'pending')->count(),
            'total_inventory' => Inventory::count(),
        ];
        
        $recentTickets = Ticket::with('user')->latest()->take(5)->get();

        return view('admin.dashboard', compact('stats', 'recentTickets'));
    }
}
