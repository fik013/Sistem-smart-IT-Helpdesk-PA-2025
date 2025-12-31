<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Announcement;

class UserDashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $inventories = $user->inventories;
        $activeTickets = $user->tickets()->where('status', '!=', 'completed')->get();
        $announcements = Announcement::active()->latest()->get();
        
        return view('user.dashboard.index', compact('user', 'inventories', 'activeTickets', 'announcements'));
    }
}
