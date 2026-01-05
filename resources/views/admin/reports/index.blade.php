@extends('admin.layouts.app')

@section('title', 'Laporan Tiket - Smart IT Helpdesk')

@section('content')
<div class="flex flex-col gap-6 p-4 md:p-8 max-w-[1200px] mx-auto" x-data="{ 
    showModal: false, 
    activeTicket: null,
    openModal(ticket) {
        this.activeTicket = ticket;
        document.body.style.overflow = 'hidden';
        this.showModal = true;
    },
    closeModal() {
        this.showModal = false;
        document.body.style.overflow = 'auto';
        setTimeout(() => { this.activeTicket = null }, 300);
    }
}">
    <!-- Breadcrumbs -->
    <div class="flex flex-wrap gap-2 text-sm print:hidden">
        <a class="text-slate-500 dark:text-[#92a9c9] hover:text-[#101822] dark:hover:text-white transition-colors font-medium" href="{{ route('admin.dashboard') }}">Dashboard</a>
        <span class="text-slate-500 dark:text-[#92a9c9] font-medium">/</span>
        <span class="text-[#101822] dark:text-white font-medium">Laporan</span>
    </div>

    <!-- Page Heading & Actions -->
    <div class="flex flex-col sm:flex-row sm:items-end justify-between gap-4">
        <div class="flex flex-col gap-2">
            <h1 class="text-[#101822] dark:text-white text-3xl md:text-4xl font-black leading-tight tracking-[-0.033em] print:text-black">Laporan Penyelesaian Tiket</h1>
            <p class="text-slate-500 dark:text-[#92a9c9] text-base font-normal print:text-gray-600">History of resolved issues and performance metrics.</p>
        </div>
        <button onclick="window.print()" class="flex items-center justify-center gap-2 rounded-lg h-10 px-5 bg-[#233348] hover:bg-[#324867] text-white text-sm font-bold transition-all print:hidden">
            <span class="material-symbols-outlined" style="font-size: 20px;">print</span>
            <span class="truncate">Cetak Laporan</span>
        </button>
    </div>

    <!-- Stats Summary -->
    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 print:grid-cols-2 print:gap-4 print:mb-6">
        <div class="flex flex-col gap-2 rounded-xl p-5 border border-slate-200 dark:border-[#233348] bg-white dark:bg-[#1a232e] print:border-gray-300 print:bg-white">
            <div class="flex justify-between items-start">
                <p class="text-slate-500 dark:text-[#92a9c9] text-sm font-medium uppercase tracking-wider print:text-gray-600">Total Completed</p>
                <span class="material-symbols-outlined text-slate-400 dark:text-[#92a9c9] print:text-gray-400">check_circle</span>
            </div>
            <div class="flex items-baseline gap-2">
                <p class="text-[#101822] dark:text-white text-3xl font-bold print:text-black">{{ $totalCompleted }}</p>
                <p class="text-emerald-600 dark:text-emerald-400 text-sm font-medium print:text-emerald-600">Tickets resolved</p>
            </div>
        </div>
        <!-- Add more stats here if needed -->
    </div>

    <!-- Data Table -->
    <div class="rounded-xl border border-slate-200 dark:border-[#233348] overflow-hidden bg-white dark:bg-[#1a232e] print:border-gray-300 print:bg-white">
        <div class="overflow-x-auto">
            <table class="w-full text-left text-sm text-slate-500 dark:text-[#92a9c9] print:text-gray-800">
                <thead class="bg-slate-100 dark:bg-[#233348] text-xs uppercase text-[#101822] dark:text-white font-semibold print:bg-gray-100 print:text-black">
                    <tr>
                        <th class="px-6 py-4 print:px-4 print:py-2">Date Resolved</th>
                        <th class="px-6 py-4 print:px-4 print:py-2">Subject</th>
                        <th class="px-6 py-4 print:px-4 print:py-2">User</th>
                        <th class="px-6 py-4 print:px-4 print:py-2">Resolution Note</th>
                        <th class="px-6 py-4 print:hidden text-right">Action</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-200 dark:divide-[#233348] print:divide-gray-200">
                    @forelse($tickets as $ticket)
                    <tr class="hover:bg-slate-50 dark:hover:bg-[#233348]/50 transition-colors print:hover:bg-transparent">
                        <td class="px-6 py-4 print:px-4 print:py-2">
                            {{ $ticket->updated_at->format('d M Y') }}
                        </td>
                        <td class="px-6 py-4 print:px-4 print:py-2">
                            <span class="font-medium text-[#101822] dark:text-white print:text-black">{{ $ticket->subject }}</span>
                        </td>
                        <td class="px-6 py-4 print:px-4 print:py-2">
                            {{ $ticket->user->name }}
                        </td>
                        <td class="px-6 py-4 print:px-4 print:py-2">
                            {{ Str::limit($ticket->admin_response ?? 'No notes.', 50) }}
                        </td>
                        <td class="px-6 py-4 print:hidden text-right">
                             <button 
                                data-ticket="{{ $ticket->load(['user', 'inventory']) }}"
                                @click="openModal(JSON.parse($el.dataset.ticket))" 
                                class="inline-flex items-center justify-center gap-1 px-3 py-1.5 rounded-lg bg-slate-100 dark:bg-[#233348] hover:bg-slate-200 dark:hover:bg-[#324867] text-slate-700 dark:text-white text-xs font-bold transition-colors">
                                <span class="material-symbols-outlined text-[16px]">visibility</span>
                                Detail
                            </button>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="px-6 py-4 text-center print:px-4 print:py-2">No completed tickets found.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <!-- Pagination -->
        <div class="bg-white dark:bg-[#1a232e] px-6 py-4 border-t border-slate-200 dark:border-[#233348] print:hidden">
            {{ $tickets->links() }}
        </div>
    </div>
    
    <!-- Detail Modal (Printing Safe) -->
    <div x-show="showModal" 
            style="display: none;"
            class="fixed inset-0 z-[100] overflow-y-auto print:hidden" 
            aria-labelledby="modal-title" 
            role="dialog" 
            aria-modal="true">
        <div class="flex items-center justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:block sm:p-0">
            <!-- Overlay -->
            <div x-show="showModal"
                    x-transition:enter="ease-out duration-300"
                    x-transition:enter-start="opacity-0"
                    x-transition:enter-end="opacity-100"
                    x-transition:leave="ease-in duration-200"
                    x-transition:leave-start="opacity-100"
                    x-transition:leave-end="opacity-0"
                    class="fixed inset-0 transition-opacity bg-slate-900/60 backdrop-blur-sm" 
                    @click="closeModal()" 
                    aria-hidden="true"></div>

            <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>

            <!-- Modal Panel -->
            <div x-show="showModal"
                    x-transition:enter="ease-out duration-300"
                    x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                    x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
                    x-transition:leave="ease-in duration-200"
                    x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
                    x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                    class="relative inline-block align-bottom bg-white dark:bg-[#192433] rounded-2xl text-left overflow-hidden shadow-2xl transform transition-all sm:my-8 sm:align-middle sm:max-w-2xl w-full border border-slate-200 dark:border-[#324867]">
                
                <template x-if="activeTicket">
                    <div>
                        <!-- Header -->
                        <div class="px-6 py-4 border-b border-slate-200 dark:border-[#324867] flex items-center justify-between bg-white dark:bg-[#1f2937]/50">
                            <h3 class="text-lg font-bold text-slate-800 dark:text-white flex items-center gap-2">
                                <span class="material-symbols-outlined text-green-500">check_circle</span>
                                <span>Tiket Selesai #<span x-text="activeTicket.id"></span></span>
                            </h3>
                            <button @click="closeModal()" class="text-slate-400 hover:text-slate-600 dark:hover:text-slate-300 transition-colors rounded-lg p-1 hover:bg-slate-100 dark:hover:bg-[#324867]">
                                <span class="material-symbols-outlined">close</span>
                            </button>
                        </div>

                        <!-- Content -->
                        <div class="px-6 py-6 max-h-[70vh] overflow-y-auto custom-scrollbar">
                            <div class="space-y-6">
                                <!-- User Info -->
                                <div class="flex items-center gap-3 pb-4 border-b border-slate-200 dark:border-[#324867]">
                                    <div class="h-10 w-10 rounded-full bg-slate-200 dark:bg-slate-700 flex items-center justify-center text-slate-500">
                                        <span class="material-symbols-outlined">person</span>
                                    </div>
                                    <div>
                                        <p class="text-sm font-bold text-slate-800 dark:text-white" x-text="activeTicket.user ? activeTicket.user.name : 'Unknown'"></p>
                                        <p class="text-xs text-slate-600 dark:text-slate-400" x-text="activeTicket.user ? activeTicket.user.email : '-'"></p>
                                    </div>
                                    <div class="ml-auto text-right">
                                        <p class="text-xs text-slate-500">Selesai Pada</p>
                                        <p class="text-sm font-medium text-slate-800 dark:text-white" x-text="new Date(activeTicket.updated_at).toLocaleDateString('id-ID', { day: 'numeric', month: 'long', year: 'numeric' })"></p>
                                    </div>
                                </div>

                                <div>
                                    <h4 class="text-sm font-semibold text-slate-800 dark:text-white mb-1">Subjek</h4>
                                    <p class="text-slate-700 dark:text-slate-300" x-text="activeTicket.subject"></p>
                                </div>

                                <div>
                                    <h4 class="text-sm font-semibold text-slate-800 dark:text-white mb-2">Deskripsi Masalah</h4>
                                    <div class="bg-slate-50 dark:bg-[#233348]/50 p-4 rounded-xl border border-slate-200 dark:border-[#324867]">
                                        <p class="text-slate-700 dark:text-slate-300 text-sm whitespace-pre-wrap" x-text="activeTicket.description"></p>
                                    </div>
                                </div>

                                <div>
                                    <h4 class="text-sm font-semibold text-slate-800 dark:text-white mb-2 flex items-center gap-2">
                                        <span class="material-symbols-outlined text-primary text-base">engineering</span>
                                        Penyelesaian / Tanggapan Admin
                                    </h4>
                                    <div class="bg-blue-50 dark:bg-blue-900/10 p-4 rounded-xl border border-blue-100 dark:border-blue-500/20">
                                        <p class="text-slate-700 dark:text-blue-100 text-sm whitespace-pre-wrap font-medium" x-text="activeTicket.admin_response || 'Tidak ada tanggapan tercatat.'"></p>
                                    </div>
                                </div>
                                
                                <div x-show="activeTicket.evidence_path">
                                    <h4 class="text-sm font-semibold text-slate-800 dark:text-white mb-2">Bukti Awal</h4>
                                    <div class="relative group rounded-xl overflow-hidden border border-slate-200 dark:border-[#324867] bg-slate-50 dark:bg-[#233348]">
                                        <img :src="'/storage/' + activeTicket.evidence_path" alt="Bukti Foto" class="w-full h-auto max-h-[300px] object-contain">
                                        <a :href="'/storage/' + activeTicket.evidence_path" target="_blank" class="absolute top-2 right-2 bg-black/50 text-white p-2 rounded-lg hover:bg-black/70 transition-colors opacity-0 group-hover:opacity-100 backdrop-blur-sm flex items-center gap-2">
                                            <span class="text-xs font-bold">Buka Gambar</span>
                                            <span class="material-symbols-outlined text-lg">open_in_new</span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </template>
            </div>
        </div>
    </div>
</div>

<style>
    @media print {
        body {
            background-color: white !important;
            color: black !important;
        }
        .bg-\[\#111822\], .bg-\[\#1a232e\], .dark\:bg-background-dark {
            background-color: white !important;
        }
        .text-white, .dark\:text-white {
            color: black !important;
        }
        .border-\[\#233348\] {
            border-color: #e5e7eb !important; /* gray-200 */
        }
        /* Hide sidebar and other non-print elements */
        aside, header, footer {
            display: none !important;
        }
        /* Expand main content */
        main {
            margin: 0 !important;
            padding: 0 !important;
            width: 100% !important;
            height: auto !important;
            overflow: visible !important;
        }
        /* Ensure table prints nicely */
        table {
            width: 100% !important;
            border-collapse: collapse !important;
        }
        th, td {
            border: 1px solid #ddd !important;
            padding: 8px !important;
            color: black !important;
        }
    }
</style>
@endsection
