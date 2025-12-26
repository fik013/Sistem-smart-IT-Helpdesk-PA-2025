<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Ticket;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function index()
    {
        // Fetch completed tickets for the report
        $tickets = Ticket::with('user')
            ->where('status', 'completed')
            ->latest()
            ->paginate(20);

        // Stats for the report header
        $totalCompleted = Ticket::where('status', 'completed')->count();
        $avgResolutionTime = 0; // Placeholder for now

        return view('admin.reports.index', compact('tickets', 'totalCompleted'));
    }
}
