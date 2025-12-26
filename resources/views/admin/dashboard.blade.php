@extends('admin.layouts.app')

@section('title', 'Admin Dashboard - Smart IT Helpdesk')

@section('content')
    <div class="flex flex-col gap-6 p-4 md:p-8 max-w-[1200px] mx-auto">
        <!-- Breadcrumbs -->
        <div class="flex flex-wrap gap-2 text-sm">
            <span class="text-white font-medium">Dashboard</span>
        </div>
        
        <!-- Page Heading & Actions -->
        <div class="flex flex-col sm:flex-row sm:items-end justify-between gap-4">
            <div class="flex flex-col gap-2">
                <h1 class="text-white text-3xl md:text-4xl font-black leading-tight tracking-[-0.033em]">Admin Dashboard</h1>
                <p class="text-[#92a9c9] text-base font-normal">Overview of system performance and tickets.</p>
            </div>
        </div>

        <!-- Stats Overview -->
        <div class="grid grid-cols-1 sm:grid-cols-4 gap-4">
            <!-- Total Users -->
            <div class="flex flex-col gap-2 rounded-xl p-5 border border-[#233348] bg-[#1a232e]">
                <div class="flex justify-between items-start">
                    <p class="text-[#92a9c9] text-sm font-medium uppercase tracking-wider">Total Users</p>
                    <span class="material-symbols-outlined text-[#92a9c9]">group</span>
                </div>
                <div class="flex items-baseline gap-2">
                    <p class="text-white text-3xl font-bold">{{ $stats['total_users'] }}</p>
                </div>
            </div>
            
            <!-- Total Tickets -->
            <div class="flex flex-col gap-2 rounded-xl p-5 border border-[#233348] bg-[#1a232e]">
                <div class="flex justify-between items-start">
                    <p class="text-[#92a9c9] text-sm font-medium uppercase tracking-wider">Total Tickets</p>
                    <span class="material-symbols-outlined text-[#92a9c9]">confirmation_number</span>
                </div>
                <div class="flex items-baseline gap-2">
                    <p class="text-white text-3xl font-bold">{{ $stats['total_tickets'] }}</p>
                </div>
            </div>

            <!-- Pending Tickets -->
            <div class="flex flex-col gap-2 rounded-xl p-5 border border-[#233348] bg-[#1a232e]">
                <div class="flex justify-between items-start">
                    <p class="text-[#92a9c9] text-sm font-medium uppercase tracking-wider">Pending</p>
                    <span class="material-symbols-outlined text-yellow-500">pending_actions</span>
                </div>
                <div class="flex items-baseline gap-2">
                    <p class="text-white text-3xl font-bold">{{ $stats['pending_tickets'] }}</p>
                    <p class="text-yellow-500 text-sm font-medium">Action Needed</p>
                </div>
            </div>

            <!-- Inventory -->
            <div class="flex flex-col gap-2 rounded-xl p-5 border border-[#233348] bg-[#1a232e]">
                <div class="flex justify-between items-start">
                    <p class="text-[#92a9c9] text-sm font-medium uppercase tracking-wider">Inventory</p>
                    <span class="material-symbols-outlined text-[#92a9c9]">inventory_2</span>
                </div>
                <div class="flex items-baseline gap-2">
                    <p class="text-white text-3xl font-bold">{{ $stats['total_inventory'] }}</p>
                </div>
            </div>
        </div>

        <!-- Chart Section -->
        <div class="rounded-xl border border-[#233348] p-5 bg-[#1a232e]">
            <h3 class="text-white text-lg font-bold mb-4">Ticket Analytics</h3>
            <div class="w-full h-64">
                <canvas id="ticketChart"></canvas>
            </div>
        </div>

        <!-- Recent Tickets Table -->
        <div class="rounded-xl border border-[#233348] overflow-hidden bg-[#1a232e]">
            <div class="p-4 border-b border-[#233348]">
                <h3 class="text-white text-lg font-bold">Recent Tickets</h3>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full text-left text-sm text-[#92a9c9]">
                    <thead class="bg-[#233348] text-xs uppercase text-white font-semibold">
                        <tr>
                            <th class="px-6 py-4">Subject</th>
                            <th class="px-6 py-4">User</th>
                            <th class="px-6 py-4">Status</th>
                            <th class="px-6 py-4">Date</th>
                            <th class="px-6 py-4 text-right">Action</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-[#233348]">
                        @foreach($recentTickets as $ticket)
                        <tr class="hover:bg-[#233348]/50 transition-colors group">
                            <td class="px-6 py-4 text-white font-medium">{{ $ticket->subject }}</td>
                            <td class="px-6 py-4">{{ $ticket->user->name }}</td>
                            <td class="px-6 py-4">
                                <span class="inline-flex items-center gap-1 rounded-full px-2.5 py-0.5 text-xs font-medium border
                                    {{ $ticket->status == 'pending' ? 'bg-yellow-500/10 text-yellow-500 border-yellow-500/20' : 
                                       ($ticket->status == 'completed' ? 'bg-emerald-500/10 text-emerald-500 border-emerald-500/20' : 'bg-blue-500/10 text-blue-500 border-blue-500/20') }}">
                                    {{ ucfirst($ticket->status) }}
                                </span>
                            </td>
                            <td class="px-6 py-4">{{ $ticket->created_at->diffForHumans() }}</td>
                            <td class="px-6 py-4 text-right">
                                <button class="text-primary hover:text-white transition-colors font-medium text-sm">Manage</button>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    @push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const ctx = document.getElementById('ticketChart').getContext('2d');
        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ['Pending', 'Processing', 'Completed'],
                datasets: [{
                    label: '# of Tickets',
                    data: [{{ $stats['pending_tickets'] }}, {{ $stats['total_tickets'] - $stats['pending_tickets'] }}, 0],
                    backgroundColor: ['rgba(234, 179, 8, 0.5)', 'rgba(59, 130, 246, 0.5)', 'rgba(16, 185, 129, 0.5)'],
                    borderColor: ['rgba(234, 179, 8, 1)', 'rgba(59, 130, 246, 1)', 'rgba(16, 185, 129, 1)'],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    y: { beginAtZero: true, grid: { color: 'rgba(255, 255, 255, 0.05)' }, ticks: { color: '#92a9c9' } },
                    x: { grid: { display: false }, ticks: { color: '#92a9c9' } }
                },
                plugins: { legend: { labels: { color: '#ffffff' } } }
            }
        });
    </script>
    @endpush
@endsection
