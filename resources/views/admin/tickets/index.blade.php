@extends('admin.layouts.app')

@section('title', 'Kelola Tiket - Smart IT Helpdesk')

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
    <div class="flex flex-wrap gap-2 text-sm">
        <a class="text-slate-500 dark:text-[#92a9c9] hover:text-[#101822] dark:hover:text-white transition-colors font-medium" href="{{ route('admin.dashboard') }}">Dashboard</a>
        <span class="text-slate-500 dark:text-[#92a9c9] font-medium">/</span>
        <span class="text-[#101822] dark:text-white font-medium">Kelola Tiket</span>
    </div>

    <!-- Page Heading -->
    <div class="flex flex-col sm:flex-row sm:items-end justify-between gap-4">
        <div class="flex flex-col gap-2">
            <h1 class="text-[#101822] dark:text-white text-3xl md:text-4xl font-black leading-tight tracking-[-0.033em]">Kelola Tiket Masuk</h1>
            <p class="text-slate-500 dark:text-[#92a9c9] text-base font-normal">Daftar tiket yang diurutkan berdasarkan Prioritas SAW.</p>
        </div>
    </div>

    <!-- Success Message -->
    @if(session('success'))
        <div class="p-4 mb-4 text-sm text-green-700 dark:text-green-400 rounded-lg bg-green-100 dark:bg-green-500/10 border border-green-200 dark:border-green-500/20" role="alert">
            <span class="font-medium">Berhasil!</span> {{ session('success') }}
        </div>
    @endif

    <!-- Stats Overview -->
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-4">
        <div class="flex flex-col gap-2 rounded-xl p-5 border border-slate-200 dark:border-[#233348] bg-white dark:bg-[#1a232e]">
            <div class="flex justify-between items-start">
                <p class="text-slate-500 dark:text-[#92a9c9] text-sm font-medium uppercase tracking-wider">Total Tiket</p>
                <span class="material-symbols-outlined text-slate-400 dark:text-[#92a9c9]">confirmation_number</span>
            </div>
            <div class="flex items-baseline gap-2">
                <p class="text-[#101822] dark:text-white text-3xl font-bold">{{ \App\Models\Ticket::count() }}</p>
            </div>
        </div>
        <div class="flex flex-col gap-2 rounded-xl p-5 border border-slate-200 dark:border-[#233348] bg-white dark:bg-[#1a232e]">
            <div class="flex justify-between items-start">
                <p class="text-yellow-600 dark:text-yellow-500 text-sm font-medium uppercase tracking-wider">Pending</p>
                <span class="material-symbols-outlined text-yellow-600 dark:text-yellow-500">pending</span>
            </div>
            <div class="flex items-baseline gap-2">
                <p class="text-[#101822] dark:text-white text-3xl font-bold">{{ \App\Models\Ticket::where('status', 'pending')->count() }}</p>
            </div>
        </div>
        <div class="flex flex-col gap-2 rounded-xl p-5 border border-slate-200 dark:border-[#233348] bg-white dark:bg-[#1a232e]">
            <div class="flex justify-between items-start">
                <p class="text-blue-600 dark:text-blue-500 text-sm font-medium uppercase tracking-wider">Diproses</p>
                <span class="material-symbols-outlined text-blue-600 dark:text-blue-500">autorenew</span>
            </div>
            <div class="flex items-baseline gap-2">
                <p class="text-[#101822] dark:text-white text-3xl font-bold">{{ \App\Models\Ticket::where('status', 'processing')->count() }}</p>
            </div>
        </div>
        <div class="flex flex-col gap-2 rounded-xl p-5 border border-slate-200 dark:border-[#233348] bg-white dark:bg-[#1a232e]">
            <div class="flex justify-between items-start">
                <p class="text-green-600 dark:text-green-500 text-sm font-medium uppercase tracking-wider">Selesai</p>
                <span class="material-symbols-outlined text-green-600 dark:text-green-500">check_circle</span>
            </div>
            <div class="flex items-baseline gap-2">
                <p class="text-[#101822] dark:text-white text-3xl font-bold">{{ \App\Models\Ticket::where('status', 'completed')->count() }}</p>
            </div>
        </div>
    </div>

    <!-- Data Table -->
    <div class="rounded-xl border border-slate-200 dark:border-[#233348] overflow-hidden bg-white dark:bg-[#1a232e]">
        <div class="overflow-x-auto">
            <table class="w-full text-left text-sm text-slate-500 dark:text-[#92a9c9]">
                <thead class="bg-slate-100 dark:bg-[#233348] text-xs uppercase text-[#101822] dark:text-white font-semibold">
                    <tr>
                        <th class="px-6 py-4" scope="col">No</th>
                        <th class="px-6 py-4" scope="col">Skor SAW</th>
                        <th class="px-6 py-4" scope="col">Subjek</th>
                        <th class="px-6 py-4" scope="col">Pengguna</th>
                        <th class="px-6 py-4" scope="col">Urgensi</th>
                        <th class="px-6 py-4" scope="col">Status</th>
                        <th class="px-6 py-4" scope="col">Tanggal</th>
                        <th class="px-6 py-4 text-right" scope="col">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-200 dark:divide-[#233348]">
                    @forelse($tickets as $ticket)
                    @php
                        $currentNumber = ($tickets->currentPage() - 1) * $tickets->perPage() + $loop->iteration;
                    @endphp
                    <tr class="hover:bg-slate-50 dark:hover:bg-[#233348]/50 transition-colors group">
                        <td class="px-6 py-4">
                            <div class="flex h-8 w-8 items-center justify-center rounded-full text-sm font-bold border shadow-sm
                                {{ $currentNumber == 1 ? 'bg-red-600 text-white border-red-700' : 
                                   ($currentNumber == 2 ? 'bg-orange-500 text-white border-orange-600' : 
                                   ($currentNumber == 3 ? 'bg-amber-400 text-white border-amber-500' : 
                                   'bg-slate-100 dark:bg-[#233348] text-slate-700 dark:text-white border-slate-200 dark:border-slate-700')) }}">
                                {{ $currentNumber }}
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            <span class="inline-flex items-center rounded-md bg-blue-50 dark:bg-blue-500/10 px-2 py-1 text-xs font-bold text-blue-600 dark:text-blue-400 ring-1 ring-inset ring-blue-500/10 dark:ring-blue-500/20">
                                {{ number_format($ticket->saw_score, 3) }}
                            </span>
                        </td>
                        <td class="px-6 py-4">
                            <div class="font-medium text-[#101822] dark:text-white">{{ $ticket->subject }}</div>
                            <div class="text-xs truncate w-48">{{ Str::limit($ticket->description, 50) }}</div>
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex items-center gap-2">
                                <div class="h-6 w-6 rounded-full bg-cover bg-center border border-slate-200 dark:border-transparent" style='background-image: url("https://ui-avatars.com/api/?name={{ urlencode($ticket->user->name) }}&size=24");'></div>
                                <span class="text-[#101822] dark:text-white">{{ $ticket->user->name }}</span>
                            </div>
                        </td>
                        <td class="px-6 py-4">
                             <!-- Urgency Selection Display -->
                            <span class="inline-flex items-center gap-1 rounded px-2 py-1 text-xs font-bold uppercase tracking-wider
                                {{ $ticket->urgency == 'high' ? 'text-red-600 bg-red-100 dark:bg-red-500/10 dark:text-red-500' : 
                                  ($ticket->urgency == 'medium' ? 'text-blue-600 bg-blue-100 dark:bg-blue-500/10 dark:text-blue-500' : 
                                  'text-green-600 bg-green-100 dark:bg-green-500/10 dark:text-green-500') }}">
                                {{ $ticket->urgency == 'high' ? 'TINGGI' : ($ticket->urgency == 'medium' ? 'SEDANG' : 'RENDAH') }}
                            </span>
                        </td>
                        <td class="px-6 py-4">
                            <span class="inline-flex items-center gap-1 rounded-full px-2.5 py-0.5 text-xs font-medium border
                                {{ $ticket->status === 'pending' ? 'bg-yellow-50 dark:bg-yellow-500/10 text-yellow-600 dark:text-yellow-500 border-yellow-200 dark:border-yellow-500/20' : 
                                   ($ticket->status === 'processing' ? 'bg-blue-50 dark:bg-blue-500/10 text-blue-600 dark:text-blue-500 border-blue-200 dark:border-blue-500/20' : 'bg-green-50 dark:bg-green-500/10 text-green-600 dark:text-green-500 border-green-200 dark:border-green-500/20') }}">
                                {{ ucfirst($ticket->status) }}
                            </span>
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex flex-col">
                                <span class="text-sm font-medium text-[#101822] dark:text-white">
                                    {{ $ticket->created_at->translatedFormat('d M Y, H:i') }}
                                </span>
                                <span class="text-xs text-slate-500 dark:text-[#92a9c9]">
                                    {{ $ticket->created_at->diffForHumans() }}
                                </span>
                            </div>
                        </td>
                        <td class="px-6 py-4 text-right">
                            <div class="flex justify-end gap-2">
                                <button 
                                    data-ticket="{{ $ticket->load(['user', 'inventory']) }}"
                                    @click="openModal(JSON.parse($el.dataset.ticket))" 
                                    class="rounded-lg px-3 py-1.5 bg-slate-100 dark:bg-[#233348] hover:bg-slate-200 dark:hover:bg-[#324867] text-slate-700 dark:text-white text-xs font-bold transition-colors shadow-sm flex items-center gap-1">
                                    <span class="material-symbols-outlined text-[16px]">visibility</span>
                                    Detail
                                </button>
                                <a href="{{ route('admin.tickets.show', $ticket) }}" class="rounded-lg px-3 py-1.5 bg-primary hover:bg-blue-600 text-white text-xs font-bold transition-colors shadow-sm flex items-center gap-1">
                                    <span class="material-symbols-outlined text-[16px]">edit</span>
                                    Proses
                                </a>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="8" class="px-6 py-4 text-center">Tidak ada tiket pending saat ini.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <!-- Pagination -->
        <div class="bg-white dark:bg-[#1a232e] px-6 py-4 border-t border-slate-200 dark:border-[#233348]">
            {{ $tickets->links() }}
        </div>
    </div>
    
     <!-- Detail Modal -->
    <div x-show="showModal" 
            style="display: none;"
            class="fixed inset-0 z-[100] overflow-y-auto" 
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
                    class="relative inline-block align-bottom bg-white dark:bg-[#192433] rounded-2xl text-left overflow-hidden shadow-2xl transform transition-all sm:my-8 sm:align-middle sm:max-w-3xl w-full border border-slate-200 dark:border-[#324867]">
                
                <template x-if="activeTicket">
                    <div>
                        <!-- Header -->
                        <div class="px-6 py-4 border-b border-slate-200 dark:border-[#324867] flex items-center justify-between bg-white dark:bg-[#1f2937]/50">
                            <h3 class="text-lg font-bold text-slate-800 dark:text-white flex items-center gap-2">
                                <span class="material-symbols-outlined text-primary">admin_panel_settings</span>
                                <span>Detail Tiket #<span x-text="activeTicket.id"></span></span>
                            </h3>
                            <button @click="closeModal()" class="text-slate-400 hover:text-slate-600 dark:hover:text-slate-300 transition-colors rounded-lg p-1 hover:bg-slate-100 dark:hover:bg-[#324867]">
                                <span class="material-symbols-outlined">close</span>
                            </button>
                        </div>

                        <!-- Content -->
                        <div class="px-6 py-6 max-h-[70vh] overflow-y-auto custom-scrollbar">
                            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                                <!-- Col 1: Main Info -->
                                <div class="md:col-span-2 space-y-6">
                                    <!-- User Info Card -->
                                    <div class="bg-slate-50 dark:bg-[#233348]/50 p-4 rounded-xl border border-slate-200 dark:border-[#324867] flex items-center gap-4">
                                        <div class="h-12 w-12 rounded-full bg-cover bg-center border border-slate-200 dark:border-transparent flex-shrink-0" 
                                             :style="'background-image: url(https://ui-avatars.com/api/?name=' + (activeTicket.user ? encodeURIComponent(activeTicket.user.name) : 'Pengguna') + '&size=64)'"></div>
                                        <div>
                                            <p class="text-sm font-bold text-slate-800 dark:text-white" x-text="activeTicket.user ? activeTicket.user.name : 'Pengguna Tidak Diketahui'"></p>
                                            <p class="text-xs text-slate-600 dark:text-slate-400" x-text="activeTicket.user ? activeTicket.user.email : '-'"></p>
                                        </div>
                                    </div>

                                    <div>
                                        <h4 class="text-sm font-semibold text-slate-800 dark:text-white mb-2">Subjek Tiket</h4>
                                        <p class="text-slate-700 dark:text-slate-300 text-base" x-text="activeTicket.subject"></p>
                                    </div>
                                    
                                    <div>
                                        <h4 class="text-sm font-semibold text-slate-800 dark:text-white mb-2">Deskripsi Masalah</h4>
                                        <div class="bg-slate-50 dark:bg-[#233348]/50 p-4 rounded-xl border border-slate-200 dark:border-[#324867]">
                                            <p class="text-slate-700 dark:text-slate-300 text-sm whitespace-pre-wrap leading-relaxed" x-text="activeTicket.description"></p>
                                        </div>
                                    </div>

                                    <div x-show="activeTicket.evidence_path">
                                        <h4 class="text-sm font-semibold text-slate-800 dark:text-white mb-2">Bukti Foto / Lampiran</h4>
                                        <div class="relative group rounded-xl overflow-hidden border border-slate-200 dark:border-[#324867] bg-slate-50 dark:bg-[#233348]">
                                            <img :src="'/storage/' + activeTicket.evidence_path" alt="Bukti Foto" class="w-full h-auto max-h-[400px] object-contain">
                                            <a :href="'/storage/' + activeTicket.evidence_path" target="_blank" class="absolute top-2 right-2 bg-black/50 text-white p-2 rounded-lg hover:bg-black/70 transition-colors opacity-0 group-hover:opacity-100 backdrop-blur-sm flex items-center gap-2">
                                                <span class="text-xs font-bold">Buka Gambar</span>
                                                <span class="material-symbols-outlined text-lg">open_in_new</span>
                                            </a>
                                        </div>
                                    </div>
                                    <div x-show="!activeTicket.evidence_path" class="p-4 bg-slate-50 dark:bg-[#233348]/50 rounded-xl border border-dashed border-slate-300 dark:border-slate-600 text-center">
                                        <p class="text-sm text-slate-500 italic">Tidak ada bukti foto yang dilampirkan.</p>
                                    </div>
                                </div>

                                <!-- Col 2: Meta Info -->
                                <div class="space-y-6">
                                    <div class="bg-white dark:bg-[#1a232e] border border-slate-200 dark:border-[#233348] rounded-xl p-4 shadow-sm">
                                        <h4 class="text-xs font-bold text-slate-400 uppercase tracking-wider mb-4">Rincian Tiket</h4>
                                        
                                        <div class="space-y-4">
                                            <div>
                                                <p class="text-xs text-slate-500 mb-1">Status</p>
                                                <span class="inline-flex items-center rounded-full px-2.5 py-1 text-xs font-bold uppercase tracking-wide border"
                                                    :class="{
                                                    'bg-yellow-500/10 text-yellow-600 dark:text-yellow-400 border-yellow-500/20': activeTicket.status === 'pending',
                                                    'bg-green-500/10 text-green-600 dark:text-green-400 border-green-500/20': activeTicket.status === 'completed',
                                                    'bg-blue-500/10 text-blue-600 dark:text-blue-400 border-blue-500/20': activeTicket.status === 'processing'
                                                    }"
                                                    x-text="activeTicket.status === 'pending' ? 'Pending' : (activeTicket.status === 'processing' ? 'Diproses' : (activeTicket.status === 'completed' ? 'Selesai' : activeTicket.status))">
                                                </span>
                                            </div>

                                            <div>
                                                <p class="text-xs text-slate-500 mb-1">Prioritas / Urgensi</p>
                                                <span class="inline-flex items-center gap-1 rounded px-2 py-1 text-xs font-bold uppercase tracking-wider"
                                                    :class="{
                                                    'text-red-600 bg-red-100 dark:bg-red-500/10 dark:text-red-500': activeTicket.urgency === 'high',
                                                    'text-blue-600 bg-blue-100 dark:bg-blue-500/10 dark:text-blue-500': activeTicket.urgency === 'medium',
                                                    'text-green-600 bg-green-100 dark:bg-green-500/10 dark:text-green-500': activeTicket.urgency === 'low'
                                                    }"
                                                    x-text="activeTicket.urgency === 'high' ? 'TINGGI' : (activeTicket.urgency === 'medium' ? 'SEDANG' : 'RENDAH')">
                                                </span>
                                            </div>

                                            <div>
                                                <p class="text-xs text-slate-500 mb-1">Skor SAW</p>
                                                <p class="text-lg font-mono font-bold text-primary" x-text="Number(activeTicket.saw_score).toFixed(3)"></p>
                                            </div>

                                            <div>
                                                <p class="text-xs text-slate-500 mb-1">Barang / Inventaris</p>
                                                <p class="text-sm font-medium text-slate-800 dark:text-white" x-text="activeTicket.inventory ? activeTicket.inventory.item_name : 'Tidak ada'"></p>
                                            </div>

                                            <div>
                                                <p class="text-xs text-slate-500 mb-1">Dibuat Pada</p>
                                                <p class="text-sm font-medium text-slate-800 dark:text-white" x-text="new Date(activeTicket.created_at).toLocaleDateString('id-ID', { day: 'numeric', month: 'long', year: 'numeric', hour: '2-digit', minute:'2-digit' }) + ' WIB'"></p>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="bg-blue-50 dark:bg-blue-900/10 border border-blue-100 dark:border-blue-500/20 rounded-xl p-4">
                                        <p class="text-xs text-blue-600 dark:text-blue-400 mb-2 font-medium">Aksi Cepat</p>
                                        <a :href="'/admin/tickets/' + activeTicket.id" class="flex items-center justify-center w-full gap-2 rounded-lg py-2 bg-blue-600 hover:bg-blue-700 text-white text-sm font-bold transition-colors">
                                            Proses Tiket
                                            <span class="material-symbols-outlined text-[18px]">arrow_forward</span>
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
@endsection
