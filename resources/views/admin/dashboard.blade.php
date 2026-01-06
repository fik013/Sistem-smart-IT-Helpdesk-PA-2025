@extends('admin.layouts.app')

@section('title', 'Admin Dashboard - Smart IT Helpdesk')

@section('content')
    <div class="flex flex-col gap-6 p-4 md:p-8 max-w-[1200px] mx-auto">
        <!-- Breadcrumbs -->
        <div class="flex flex-wrap gap-2 text-sm">
            <span class="text-[#101822] dark:text-white font-medium">Dashboard</span>
        </div>
        
        <!-- Page Heading & Actions -->
        <div class="flex flex-col sm:flex-row sm:items-end justify-between gap-4">
            <div class="flex flex-col gap-2">
                <h1 class="text-[#101822] dark:text-white text-3xl md:text-4xl font-black leading-tight tracking-[-0.033em]">Admin Dashboard</h1>
                <p class="text-slate-500 dark:text-[#92a9c9] text-base font-normal">Grafik performa dan tiket</p>
            </div>
        </div>

        <!-- Stats Overview -->
        <div class="grid grid-cols-1 sm:grid-cols-4 gap-4">
            <!-- Total Users -->
            <div class="flex flex-col gap-2 rounded-xl p-5 border border-slate-200 dark:border-[#233348] bg-white dark:bg-[#1a232e]">
                <div class="flex justify-between items-start">
                    <p class="text-slate-500 dark:text-[#92a9c9] text-sm font-medium uppercase tracking-wider">Total User</p>
                    <span class="material-symbols-outlined text-slate-400 dark:text-[#92a9c9]">group</span>
                </div>
                <div class="flex items-baseline gap-2">
                    <p class="text-[#101822] dark:text-white text-3xl font-bold">{{ $stats['total_users'] }}</p>
                </div>
            </div>
            
            <!-- Total Tickets -->
            <div class="flex flex-col gap-2 rounded-xl p-5 border border-slate-200 dark:border-[#233348] bg-white dark:bg-[#1a232e]">
                <div class="flex justify-between items-start">
                    <p class="text-slate-500 dark:text-[#92a9c9] text-sm font-medium uppercase tracking-wider">Total Tiket</p>
                    <span class="material-symbols-outlined text-slate-400 dark:text-[#92a9c9]">confirmation_number</span>
                </div>
                <div class="flex items-baseline gap-2">
                    <p class="text-[#101822] dark:text-white text-3xl font-bold">{{ $stats['total_tickets'] }}</p>
                </div>
            </div>

            <!-- Pending Tickets -->
            <div class="flex flex-col gap-2 rounded-xl p-5 border border-slate-200 dark:border-[#233348] bg-white dark:bg-[#1a232e]">
                <div class="flex justify-between items-start">
                    <p class="text-slate-500 dark:text-[#92a9c9] text-sm font-medium uppercase tracking-wider">Pending</p>
                    <span class="material-symbols-outlined text-yellow-500">pending_actions</span>
                </div>
                <div class="flex items-baseline gap-2">
                    <p class="text-[#101822] dark:text-white text-3xl font-bold">{{ $stats['pending_tickets'] }}</p>
                    <p class="text-yellow-500 text-sm font-medium">Perlu Tindakan</p>
                </div>
            </div>

            <!-- Inventory -->
            <div class="flex flex-col gap-2 rounded-xl p-5 border border-slate-200 dark:border-[#233348] bg-white dark:bg-[#1a232e]">
                <div class="flex justify-between items-start">
                    <p class="text-slate-500 dark:text-[#92a9c9] text-sm font-medium uppercase tracking-wider">Inventaris</p>
                    <span class="material-symbols-outlined text-slate-400 dark:text-[#92a9c9]">inventory_2</span>
                </div>
                <div class="flex items-baseline gap-2">
                    <p class="text-[#101822] dark:text-white text-3xl font-bold">{{ $stats['total_inventory'] }}</p>
                </div>
            </div>
        </div>

        <!-- Active Announcements -->
        @if($announcements->count() > 0)
        <div class="rounded-xl border border-slate-200 dark:border-[#233348] p-5 bg-white dark:bg-[#1a232e]">
            <h3 class="text-[#101822] dark:text-white text-lg font-bold mb-4 flex items-center gap-2">
                <span class="material-symbols-outlined text-primary">campaign</span>
                Pengumuman Aktif
            </h3>
            <div class="space-y-3">
                @foreach($announcements as $announce)
                <div class="flex flex-col sm:flex-row gap-3 sm:items-center justify-between p-4 rounded-lg bg-slate-50 dark:bg-[#111822] border-l-4 {{ $announce->type == 'critical' ? 'border-red-500 bg-red-50/50 dark:bg-red-900/10' : ($announce->type == 'warning' ? 'border-yellow-500' : 'border-blue-500') }}">
                    <div class="flex flex-col gap-1">
                        <div class="flex items-center gap-2">
                             @if($announce->type == 'critical')
                                <span class="px-2 py-0.5 rounded text-[10px] font-bold uppercase bg-red-100 text-red-700 dark:bg-red-500/20 dark:text-red-400">Penting</span>
                             @elseif($announce->type == 'warning')
                                <span class="px-2 py-0.5 rounded text-[10px] font-bold uppercase bg-yellow-100 text-yellow-700 dark:bg-yellow-500/20 dark:text-yellow-400">Sedang</span>
                             @else
                                <span class="px-2 py-0.5 rounded text-[10px] font-bold uppercase bg-blue-100 text-blue-700 dark:bg-blue-500/20 dark:text-blue-400">Info</span>
                             @endif
                             <h4 class="font-bold text-[#101822] dark:text-white text-sm">{{ $announce->title }}</h4>
                        </div>
                        <p class="text-xs text-slate-500 dark:text-[#92a9c9] line-clamp-2 md:line-clamp-1">{{ Str::limit($announce->content, 100) }}</p>
                    </div>
                    <div class="flex items-center gap-4 text-xs text-slate-400 dark:text-[#64748b] shrink-0">
                         @if($announce->end_date)
                            <span title="Berakhir pada"><span class="material-symbols-outlined md-14 align-text-bottom text-[14px]">event_busy</span> {{ $announce->end_date->format('d M H:i') }}</span>
                         @endif
                         <span><span class="material-symbols-outlined md-14 align-text-bottom text-[14px]">schedule</span> {{ $announce->created_at->diffForHumans() }}</span>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        @endif

        <!-- Chart Section -->
        <div class="rounded-xl border border-slate-200 dark:border-[#233348] p-5 bg-white dark:bg-[#1a232e]">
            <h3 class="text-[#101822] dark:text-white text-lg font-bold mb-4">Analisis Tiket</h3>
            <div class="w-full h-64">
                <canvas id="ticketChart"></canvas>
            </div>
        </div>

        <!-- Recent Tickets Table -->
        <div class="rounded-xl border border-slate-200 dark:border-[#233348] overflow-hidden bg-white dark:bg-[#1a232e]">
            <div class="p-4 border-b border-slate-200 dark:border-[#233348]">
                <h3 class="text-[#101822] dark:text-white text-lg font-bold">Tiket Terbaru</h3>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full text-left text-sm text-slate-500 dark:text-[#92a9c9]">
                    <thead class="bg-slate-100 dark:bg-[#233348] text-xs uppercase text-[#101822] dark:text-white font-semibold">
                        <tr>
                            <th class="px-6 py-4">Subjek</th>
                            <th class="px-6 py-4">User</th>
                            <th class="px-6 py-4">Status</th>
                            <th class="px-6 py-4">Tanggal</th>
                            <th class="px-6 py-4 text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-200 dark:divide-[#233348]">
                        @foreach($recentTickets as $ticket)
                        <tr class="hover:bg-slate-50 dark:hover:bg-[#233348]/50 transition-colors group">
                            <td class="px-6 py-4 text-[#101822] dark:text-white font-medium">{{ $ticket->subject }}</td>
                            <td class="px-6 py-4">{{ $ticket->user->name }}</td>
                            <td class="px-6 py-4">
                                <span class="inline-flex items-center gap-1 rounded-full px-2.5 py-0.5 text-xs font-medium border
                                    {{ $ticket->status == 'pending' ? 'bg-yellow-50 dark:bg-yellow-500/10 text-yellow-600 dark:text-yellow-500 border-yellow-200 dark:border-yellow-500/20' : 
                                       ($ticket->status == 'completed' ? 'bg-emerald-50 dark:bg-emerald-500/10 text-emerald-600 dark:text-emerald-500 border-emerald-200 dark:border-emerald-500/20' : 'bg-blue-50 dark:bg-blue-500/10 text-blue-600 dark:text-blue-500 border-blue-200 dark:border-blue-500/20') }}">
                                    {{ ucfirst($ticket->status) }}
                                </span>
                            </td>
                            <td class="px-6 py-4">{{ $ticket->created_at->diffForHumans() }}</td>
                            <td class="px-6 py-4 text-right">
                                <a href="{{ route('admin.tickets.show', $ticket) }}" class="text-primary hover:text-blue-700 dark:hover:text-white transition-colors font-medium text-sm">Kelola</a>
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
        
        // Function to get colors based on theme
        function getChartColors() {
            const isDark = document.documentElement.classList.contains('dark');
            return {
                grid: isDark ? 'rgba(255, 255, 255, 0.05)' : 'rgba(0, 0, 0, 0.05)',
                ticks: isDark ? '#92a9c9' : '#64748b',
                text: isDark ? '#ffffff' : '#101822'
            };
        }

        let chartColors = getChartColors();

        const ticketChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ['Pending', 'Processing', 'Completed'],
                datasets: [{
                    label: 'Jumlah Tiket',
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
                    y: { 
                        beginAtZero: true, 
                        grid: { color: chartColors.grid }, 
                        ticks: { color: chartColors.ticks } 
                    },
                    x: { 
                        grid: { display: false }, 
                        ticks: { color: chartColors.ticks } 
                    }
                },
                plugins: { 
                    legend: { 
                        labels: { color: chartColors.text } 
                    } 
                }
            }
        });

        // Listen for theme changes to update chart
        const observer = new MutationObserver(function(mutations) {
            mutations.forEach(function(mutation) {
                if (mutation.attributeName === 'class') {
                    const newColors = getChartColors();
                    ticketChart.options.scales.y.grid.color = newColors.grid;
                    ticketChart.options.scales.y.ticks.color = newColors.ticks;
                    ticketChart.options.scales.x.ticks.color = newColors.ticks;
                    ticketChart.options.plugins.legend.labels.color = newColors.text;
                    ticketChart.update();
                }
            });
        });

        observer.observe(document.documentElement, { attributes: true });
    </script>
    @endpush
@endsection
