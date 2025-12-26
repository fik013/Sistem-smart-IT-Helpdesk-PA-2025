<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-200 leading-tight">
            {{ __('Admin Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-8">
            
            <!-- Specific Admin Actions -->
            <div class="flex gap-4">
                 <!-- Add User/Inventory buttons could go here -->
            </div>

            <!-- Stats Grid -->
            <div class="grid grid-cols-1 md:grid-cols-4 gap-6 animate-fade-in-up">
                <div class="glass-card text-center">
                    <div class="text-4xl font-bold text-blue-400">{{ $stats['total_users'] }}</div>
                    <div class="text-gray-400">Total Users</div>
                </div>
                <div class="glass-card text-center">
                    <div class="text-4xl font-bold text-green-400">{{ $stats['total_tickets'] }}</div>
                    <div class="text-gray-400">Total Tickets</div>
                </div>
                <div class="glass-card text-center">
                    <div class="text-4xl font-bold text-yellow-400">{{ $stats['pending_tickets'] }}</div>
                    <div class="text-gray-400">Pending Tickets</div>
                </div>
                <div class="glass-card text-center">
                    <div class="text-4xl font-bold text-purple-400">{{ $stats['total_inventory'] }}</div>
                    <div class="text-gray-400">Inventory Items</div>
                </div>
            </div>

            <!-- Chart Section -->
            <div class="glass-card animate-fade-in-up" style="animation-delay: 0.1s;">
                <h3 class="text-xl font-bold text-white mb-4">Ticket Analytics</h3>
                <canvas id="ticketChart" class="w-full h-64"></canvas>
            </div>

            <!-- Recent Tickets -->
            <div class="glass-card animate-fade-in-up" style="animation-delay: 0.2s;">
                <h3 class="text-xl font-bold text-white mb-4">Recent Tickets</h3>
                <div class="overflow-x-auto">
                    <table class="w-full text-left text-gray-300">
                        <thead class="bg-white/5 uppercase text-xs">
                            <tr>
                                <th class="px-4 py-3">Subject</th>
                                <th class="px-4 py-3">User</th>
                                <th class="px-4 py-3">Status</th>
                                <th class="px-4 py-3">Date</th>
                                <th class="px-4 py-3">Action</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-700">
                            @foreach($recentTickets as $ticket)
                            <tr class="hover:bg-white/5 transition">
                                <td class="px-4 py-3">{{ $ticket->subject }}</td>
                                <td class="px-4 py-3">{{ $ticket->user->name }}</td>
                                <td class="px-4 py-3">
                                    <span class="px-2 py-1 rounded text-xs
                                        {{ $ticket->status == 'pending' ? 'bg-yellow-500/20 text-yellow-300' : 
                                           ($ticket->status == 'completed' ? 'bg-green-500/20 text-green-300' : 'bg-blue-500/20 text-blue-300') }}">
                                        {{ ucfirst($ticket->status) }}
                                    </span>
                                </td>
                                <td class="px-4 py-3 text-sm">{{ $ticket->created_at->diffForHumans() }}</td>
                                <td class="px-4 py-3">
                                    <button class="text-blue-400 hover:text-white text-sm">Manage</button>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>

    @push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const ctx = document.getElementById('ticketChart').getContext('2d');
        const ticketChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ['Pending', 'Processing', 'Completed'],
                datasets: [{
                    label: '# of Tickets',
                    data: [{{ $stats['pending_tickets'] }}, {{ $stats['total_tickets'] - $stats['pending_tickets'] }}, 0], // Placeholder data logic
                    backgroundColor: [
                        'rgba(251, 191, 36, 0.5)',
                        'rgba(59, 130, 246, 0.5)',
                        'rgba(16, 185, 129, 0.5)'
                    ],
                    borderColor: [
                        'rgba(251, 191, 36, 1)',
                        'rgba(59, 130, 246, 1)',
                        'rgba(16, 185, 129, 1)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true,
                        grid: { color: 'rgba(255, 255, 255, 0.1)' }
                    },
                    x: {
                        grid: { color: 'rgba(255, 255, 255, 0.1)' }
                    }
                },
                plugins: {
                    legend: { labels: { color: 'white' } }
                }
            }
        });
    </script>
    @endpush
</x-app-layout>
