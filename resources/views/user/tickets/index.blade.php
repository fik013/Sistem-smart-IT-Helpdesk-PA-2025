@extends('layouts.app')

@section('content')
    <div class="flex flex-1 justify-center py-8 px-4 sm:px-6 lg:px-8" x-data="{ 
        showModal: false, 
        activeTicket: null,
        openModal(ticket) {
            this.activeTicket = ticket;
            // Prevent body scroll
            document.body.style.overflow = 'hidden';
            this.showModal = true;
        },
        closeModal() {
            this.showModal = false;
            document.body.style.overflow = 'auto';
            setTimeout(() => { this.activeTicket = null }, 300);
        }
    }">
        <div class="w-full max-w-[1200px] flex flex-col gap-8">
            <!-- Page Heading & Action -->
            <div class="flex flex-wrap items-end justify-between gap-4">
                <div class="flex flex-col gap-2">
                    <h1 class="text-slate-900 dark:text-white text-4xl font-black leading-tight tracking-[-0.033em]">Riwayat Tiket</h1>
                    <p class="text-slate-500 dark:text-text-secondary text-base font-normal leading-normal">Kelola dan pantau status tiket bantuan
                        IT Anda di sini.</p>
                </div>
                <a href="{{ route('tickets.create') }}"
                    class="flex items-center justify-center gap-2 rounded-lg h-10 px-6 bg-primary hover:bg-blue-600 text-white text-sm font-bold leading-normal tracking-[0.015em] transition-colors shadow-lg shadow-blue-900/20">
                    <span class="material-symbols-outlined !text-[20px]">add</span>
                    <span class="truncate">Buat Tiket Baru</span>
                </a>
            </div>
            
             <!-- Stats Overview -->
             <!-- ... (Stats content remains same) ... -->
             <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
                <div
                    class="flex flex-col gap-2 rounded-xl p-6 border border-slate-200 dark:border-surface-border bg-white dark:bg-surface-dark/30 hover:bg-slate-50 dark:hover:bg-surface-dark/50 transition-colors shadow-sm">
                    <div class="flex justify-between items-start">
                        <p class="text-slate-500 dark:text-text-secondary text-sm font-medium leading-normal">Total Tiket</p>
                        <span class="material-symbols-outlined text-slate-400 dark:text-text-secondary !text-[20px]">folder</span>
                    </div>
                    <p class="text-slate-900 dark:text-white tracking-tight text-3xl font-bold leading-tight">{{ $stats['total'] }}</p>
                </div>
                <div
                    class="flex flex-col gap-2 rounded-xl p-6 border border-slate-200 dark:border-surface-border bg-white dark:bg-surface-dark/30 hover:bg-slate-50 dark:hover:bg-surface-dark/50 transition-colors relative overflow-hidden group shadow-sm">
                    <div
                        class="absolute right-0 top-0 h-full w-1 bg-yellow-500/50 group-hover:bg-yellow-500 transition-colors">
                    </div>
                    <div class="flex justify-between items-start">
                        <p class="text-slate-500 dark:text-text-secondary text-sm font-medium leading-normal">Open</p>
                        <span class="material-symbols-outlined text-yellow-500 !text-[20px]">warning</span>
                    </div>
                    <p class="text-slate-900 dark:text-white tracking-tight text-3xl font-bold leading-tight">{{ $stats['open'] }}</p>
                </div>
                <div
                    class="flex flex-col gap-2 rounded-xl p-6 border border-slate-200 dark:border-surface-border bg-white dark:bg-surface-dark/30 hover:bg-slate-50 dark:hover:bg-surface-dark/50 transition-colors relative overflow-hidden group shadow-sm">
                    <div class="absolute right-0 top-0 h-full w-1 bg-primary/50 group-hover:bg-primary transition-colors">
                    </div>
                    <div class="flex justify-between items-start">
                        <p class="text-slate-500 dark:text-text-secondary text-sm font-medium leading-normal">Sedang Diproses</p>
                        <span class="material-symbols-outlined text-primary !text-[20px]">pending</span>
                    </div>
                    <p class="text-slate-900 dark:text-white tracking-tight text-3xl font-bold leading-tight">{{ $stats['processing'] }}</p>
                </div>
                <div
                    class="flex flex-col gap-2 rounded-xl p-6 border border-slate-200 dark:border-surface-border bg-white dark:bg-surface-dark/30 hover:bg-slate-50 dark:hover:bg-surface-dark/50 transition-colors relative overflow-hidden group shadow-sm">
                    <div
                        class="absolute right-0 top-0 h-full w-1 bg-green-500/50 group-hover:bg-green-500 transition-colors">
                    </div>
                    <div class="flex justify-between items-start">
                        <p class="text-slate-500 dark:text-text-secondary text-sm font-medium leading-normal">Selesai</p>
                        <span class="material-symbols-outlined text-green-500 !text-[20px]">check_circle</span>
                    </div>
                    <p class="text-slate-900 dark:text-white tracking-tight text-3xl font-bold leading-tight">{{ $stats['completed'] }}</p>
                </div>
            </div>

            <!-- Toolbar: Search & Filters -->
            <form method="GET" action="{{ route('tickets.index') }}"
                class="flex flex-col lg:flex-row gap-4 items-center justify-between bg-white dark:bg-surface-dark/30 p-2 rounded-xl border border-slate-200 dark:border-surface-border shadow-sm">
                <!-- ... (Filter Search inputs remain same) ... -->
                <div class="w-full lg:w-96">
                    <label
                        class="flex items-center w-full h-10 rounded-lg bg-slate-50 dark:bg-surface-dark border border-slate-200 dark:border-surface-border focus-within:border-primary transition-colors overflow-hidden">
                        <div class="flex items-center justify-center pl-3 pr-2 text-slate-400 dark:text-text-secondary">
                            <button type="submit">
                                <span class="material-symbols-outlined !text-[20px]">search</span>
                            </button>
                        </div>
                        <input
                            type="text"
                            name="search"
                            value="{{ request('search') }}"
                            class="w-full bg-transparent border-none text-slate-900 dark:text-white text-sm placeholder:text-slate-400 dark:placeholder:text-text-secondary focus:ring-0 h-full"
                            placeholder="Cari ID Tiket, Subjek..." />
                    </label>
                </div>
                <div class="flex gap-2 overflow-x-auto w-full lg:w-auto pb-2 lg:pb-0 scrollbar-hide">
                    <div class="relative">
                        <select name="status" onchange="this.form.submit()"
                            class="appearance-none flex h-9 shrink-0 items-center gap-2 rounded-lg border border-slate-200 dark:border-surface-border bg-slate-50 dark:bg-surface-dark hover:bg-slate-100 dark:hover:bg-surface-border pl-3 pr-8 transition-colors text-slate-700 dark:text-white text-sm font-medium focus:ring-0 focus:border-primary cursor-pointer w-full">
                            <option value="all">Semua Status</option>
                            <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                            <option value="processing" {{ request('status') == 'processing' ? 'selected' : '' }}>Processing</option>
                            <option value="completed" {{ request('status') == 'completed' ? 'selected' : '' }}>Completed</option>
                        </select>
                        <span class="material-symbols-outlined text-slate-500 dark:text-text-secondary !text-[18px] absolute right-2 top-1/2 -translate-y-1/2 pointer-events-none">expand_more</span>
                    </div>

                    <div class="relative">
                        <select name="urgency" onchange="this.form.submit()"
                            class="appearance-none flex h-9 shrink-0 items-center gap-2 rounded-lg border border-slate-200 dark:border-surface-border bg-slate-50 dark:bg-surface-dark hover:bg-slate-100 dark:hover:bg-surface-border pl-3 pr-8 transition-colors text-slate-700 dark:text-white text-sm font-medium focus:ring-0 focus:border-primary cursor-pointer w-full">
                            <option value="all">Semua Prioritas</option>
                            <option value="low" {{ request('urgency') == 'low' ? 'selected' : '' }}>Low</option>
                            <option value="medium" {{ request('urgency') == 'medium' ? 'selected' : '' }}>Medium</option>
                            <option value="high" {{ request('urgency') == 'high' ? 'selected' : '' }}>High</option>
                        </select>
                         <span class="material-symbols-outlined text-slate-500 dark:text-text-secondary !text-[18px] absolute right-2 top-1/2 -translate-y-1/2 pointer-events-none">expand_more</span>
                    </div>

                    <div class="w-px h-6 bg-slate-200 dark:bg-surface-border my-auto mx-1"></div>
                    <a href="{{ route('tickets.index') }}"
                        class="flex size-9 shrink-0 items-center justify-center rounded-lg border border-slate-200 dark:border-surface-border bg-slate-50 dark:bg-surface-dark hover:bg-slate-100 dark:hover:bg-surface-border text-slate-500 dark:text-text-secondary transition-colors"
                        title="Reset Filter">
                        <span class="material-symbols-outlined !text-[20px]">restart_alt</span>
                    </a>
                </div>
            </form>

            <div class="overflow-hidden rounded-xl border border-slate-200 dark:border-surface-border bg-white dark:bg-surface-dark/20 shadow-sm">
                <div class="overflow-x-auto">
                    <table class="w-full text-left text-sm text-slate-500 dark:text-text-secondary">
                        <thead
                            class="bg-slate-50 dark:bg-surface-dark border-b border-slate-200 dark:border-surface-border text-xs uppercase font-semibold text-slate-700 dark:text-white">
                            <tr>
                                <th class="px-6 py-4" scope="col">ID Tiket</th>
                                <th class="px-6 py-4" scope="col">Subjek &amp; Katgeori</th>
                                <th class="px-6 py-4" scope="col">Tanggal Dibuat</th>
                                <th class="px-6 py-4" scope="col">Status</th>
                                <th class="px-6 py-4 text-right" scope="col">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-200 dark:divide-surface-border">
                            @forelse($tickets as $ticket)
                                <tr class="hover:bg-slate-50 dark:hover:bg-surface-dark/40 transition-colors group">
                                    <td class="px-6 py-4 font-medium text-slate-900 dark:text-white font-mono whitespace-nowrap">
                                        <span class="text-primary">#{{ $ticket->id }}</span>
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="flex flex-col">
                                            <span class="text-slate-900 dark:text-white font-medium text-base">{{ $ticket->subject }}</span>
                                            <span
                                                class="text-xs text-slate-500 dark:text-text-secondary mt-0.5">{{ Str::limit($ticket->description, 30) }}</span>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center gap-2">
                                            <span class="material-symbols-outlined !text-[16px]">schedule</span>
                                            {{ $ticket->created_at->format('d M Y') }}
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span
                                            class="inline-flex items-center rounded-full px-2.5 py-1 text-xs font-medium border
                                        {{ $ticket->status == 'pending'
                                            ? 'bg-yellow-500/10 text-yellow-600 dark:text-yellow-400 border-yellow-500/20'
                                            : ($ticket->status == 'completed'
                                                ? 'bg-green-500/10 text-green-600 dark:text-green-400 border-green-500/20'
                                                : 'bg-primary/10 text-blue-600 dark:text-blue-400 border-primary/20') }}">
                                            {{ ucfirst($ticket->status) }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 text-right">
                                        <button @click="openModal({{ $ticket->load('inventory') }})"
                                            class="inline-flex items-center justify-center gap-1.5 px-3 py-1.5 rounded-lg bg-white dark:bg-surface-dark border border-slate-200 dark:border-surface-border hover:bg-slate-50 dark:hover:bg-surface-border hover:text-primary transition-all text-sm font-medium shadow-sm">
                                            <span class="material-symbols-outlined !text-[18px]">visibility</span>
                                            Detail
                                        </button>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="px-6 py-4 text-center">Belum ada tiket.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <!-- Pagination -->
                <div class="px-6 py-4 border-t border-slate-200 dark:border-surface-border bg-slate-50 dark:bg-surface-dark">
                    {{ $tickets->links() }}
                </div>
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
                     class="relative inline-block align-bottom bg-white dark:bg-[#192433] rounded-2xl text-left overflow-hidden shadow-2xl transform transition-all sm:my-8 sm:align-middle sm:max-w-2xl w-full border border-slate-100 dark:border-[#324867]">
                    
                    <template x-if="activeTicket">
                        <div>
                            <!-- Header -->
                            <div class="px-6 py-4 border-b border-slate-100 dark:border-[#324867] flex items-center justify-between bg-slate-50/50 dark:bg-[#1f2937]/50">
                                <h3 class="text-lg font-bold text-slate-900 dark:text-white flex items-center gap-2">
                                    <span class="material-symbols-outlined text-primary">confirmation_number</span>
                                    <span>Detail Tiket #<span x-text="activeTicket.id"></span></span>
                                </h3>
                                <button @click="closeModal()" class="text-slate-400 hover:text-slate-500 dark:hover:text-slate-300 transition-colors rounded-lg p-1 hover:bg-slate-100 dark:hover:bg-[#324867]">
                                    <span class="material-symbols-outlined">close</span>
                                </button>
                            </div>

                            <!-- Content -->
                            <div class="px-6 py-6 max-h-[70vh] overflow-y-auto custom-scrollbar">
                                <div class="flex flex-col gap-6">
                                    
                                    <!-- Status Badge -->
                                    <div class="flex items-center justify-between">
                                        <span class="text-sm text-slate-500 dark:text-slate-400">Status Saat Ini</span>
                                        <span class="inline-flex items-center rounded-full px-3 py-1 text-xs font-bold uppercase tracking-wide border shadow-sm"
                                          :class="{
                                            'bg-yellow-500/10 text-yellow-600 dark:text-yellow-400 border-yellow-500/20': activeTicket.status === 'pending',
                                            'bg-green-500/10 text-green-600 dark:text-green-400 border-green-500/20': activeTicket.status === 'completed',
                                            'bg-blue-500/10 text-blue-600 dark:text-blue-400 border-blue-500/20': activeTicket.status !== 'pending' && activeTicket.status !== 'completed'
                                          }"
                                          x-text="activeTicket.status">
                                        </span>
                                    </div>

                                    <!-- Main Info -->
                                    <div class="space-y-4">
                                        <div>
                                            <h4 class="text-sm font-semibold text-slate-900 dark:text-white mb-1">Subjek Masalah</h4>
                                            <p class="text-slate-600 dark:text-slate-300 text-base leading-relaxed" x-text="activeTicket.subject"></p>
                                        </div>
                                        
                                        <div>
                                            <h4 class="text-sm font-semibold text-slate-900 dark:text-white mb-1">Deskripsi Lengkap</h4>
                                            <div class="bg-slate-50 dark:bg-[#233348]/50 p-4 rounded-xl border border-slate-100 dark:border-[#324867]">
                                                <p class="text-slate-600 dark:text-slate-300 text-sm whitespace-pre-wrap leading-relaxed" x-text="activeTicket.description"></p>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Meta Grid -->
                                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 bg-slate-50 dark:bg-[#233348]/50 p-4 rounded-xl border border-slate-100 dark:border-[#324867]">
                                        <div>
                                            <p class="text-xs text-slate-500 mb-1">Prioritas</p>
                                            <p class="text-sm font-medium text-slate-900 dark:text-white flex items-center gap-1">
                                                <span class="w-2 h-2 rounded-full" 
                                                      :class="{
                                                        'bg-red-500': activeTicket.urgency === 'high',
                                                        'bg-yellow-500': activeTicket.urgency === 'medium',
                                                        'bg-green-500': activeTicket.urgency === 'low'
                                                      }"></span>
                                                <span class="capitalize" x-text="activeTicket.urgency"></span>
                                            </p>
                                        </div>
                                        <div>
                                            <p class="text-xs text-slate-500 mb-1">Inventaris Terkait</p>
                                            <p class="text-sm font-medium text-slate-900 dark:text-white" x-text="activeTicket.inventory ? activeTicket.inventory.item_name : 'N/A'"></p>
                                        </div>
                                        <div>
                                            <p class="text-xs text-slate-500 mb-1">Tanggal Dibuat</p>
                                            <p class="text-sm font-medium text-slate-900 dark:text-white" x-text="new Date(activeTicket.created_at).toLocaleDateString('id-ID', { day: 'numeric', month: 'long', year: 'numeric', hour: '2-digit', minute: '2-digit' })"></p>
                                        </div>
                                         <div x-show="activeTicket.admin_response">
                                            <p class="text-xs text-slate-500 mb-1">Tanggapan Admin</p>
                                            <p class="text-sm font-medium text-slate-900 dark:text-white" x-text="activeTicket.admin_response || '-'"></p>
                                        </div>
                                    </div>

                                    <!-- Evidence Image -->
                                    <div x-show="activeTicket.evidence_path">
                                        <h4 class="text-sm font-semibold text-slate-900 dark:text-white mb-2">Bukti Pendukung</h4>
                                        <div class="relative group rounded-xl overflow-hidden border border-slate-200 dark:border-[#324867] bg-slate-100 dark:bg-[#233348]">
                                            <img :src="'/storage/' + activeTicket.evidence_path" alt="Bukti" class="w-full h-auto max-h-[300px] object-contain">
                                            <a :href="'/storage/' + activeTicket.evidence_path" target="_blank" class="absolute top-2 right-2 bg-black/50 text-white p-2 rounded-lg hover:bg-black/70 transition-colors opacity-0 group-hover:opacity-100 backdrop-blur-sm">
                                                <span class="material-symbols-outlined text-lg">open_in_new</span>
                                            </a>
                                        </div>
                                    </div>

                                </div>
                            </div>
                            
                            <!-- Footer -->
                            <div class="bg-slate-50 dark:bg-[#1f2937]/50 px-6 py-4 flex justify-end border-t border-slate-100 dark:border-[#324867]">
                                <button type="button" 
                                        class="px-5 py-2.5 bg-slate-900 dark:bg-white text-white dark:text-slate-900 font-medium rounded-lg hover:opacity-90 transition-opacity shadow-lg shadow-slate-900/10" 
                                        @click="closeModal()">
                                    Tutup Detail
                                </button>
                            </div>
                        </div>
                    </template>
                </div>
            </div>
        </div>

    </div>
@endsection
