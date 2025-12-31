@extends('layouts.app')

@section('content')
    <!-- Hero / AI Assistant Section -->
    <section class="rounded-xl overflow-hidden relative min-h-[380px] flex flex-col justify-end p-6 md:p-10" data-alt="Abstract blue digital network background representing technology" style='background-image: linear-gradient(to top, rgba(16, 24, 34, 1) 0%, rgba(16, 24, 34, 0.6) 50%, rgba(16, 24, 34, 0.2) 100%), url("https://lh3.googleusercontent.com/aida-public/AB6AXuDjijYdVs8ir_JimWi2F1S7oimRkknblNeOkEXLQCVMokfIrDGgrFgKCH0qCR6euy3GmgTAKfu0HunFapwXS5xjZpOPjHT5kN5grXtGKLmEgxt39zZpWjSDsSeYR8bpbkeLSkvHSVs7cTxaVJD0OgU3vajELroMNhtnOVGTiD75g8HwIT2-0ptgCT9tuRlqabgCGFjKINq93NsWq9sTKasAH2EtjPK3WW0VHnk8ZUlYIE12XPjY2bp93ZlQXxqoinEmkS_v2LPmeUI"); background-size: cover; background-position: center;'>
        <div class="relative z-10 max-w-2xl w-full">
            <div class="mb-6 animate-fade-in-up">
                <span class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-primary/20 border border-primary/30 text-primary dark:text-blue-300 text-xs font-bold uppercase tracking-wider mb-4 backdrop-blur-sm">
                    <span class="material-symbols-outlined text-sm">auto_awesome</span>AI Powered
                </span>
                <h1 class="text-white text-3xl md:text-5xl font-black leading-tight tracking-tight mb-2">
                    Selamat Pagi, {{ explode(' ', $user->name)[0] }}.
                </h1>
                <p class="text-slate-200 text-lg font-light">
                    Ada yang bisa kami bantu hari ini? Gunakan asisten AI untuk solusi instan.
                </p>
            </div>
            
            <!-- AI Input Form -->
             <div class="flex flex-col w-full shadow-2xl shadow-primary/10" x-data="chatbot()">
                <div class="flex w-full items-stretch rounded-lg h-14 md:h-16 bg-white dark:bg-[#192433] border border-slate-200 dark:border-[#324867] overflow-hidden focus-within:border-primary focus-within:ring-2 focus-within:ring-primary/20 transition-all">
                    <div class="text-primary flex items-center justify-center pl-5">
                        <span class="material-symbols-outlined text-[24px]">smart_toy</span>
                    </div>
                    <input x-model="userInput" @keydown.enter="sendMessage()" class="flex-1 bg-transparent border-none text-slate-900 dark:text-white placeholder:text-slate-400 dark:placeholder:text-[#92a9c9] px-4 text-base focus:ring-0" placeholder="Ketik masalah IT Anda di sini (contoh: WiFi lambat, Lupa password)..." />
                    <div class="flex items-center justify-center pr-2">
                        <button @click="sendMessage()" class="flex items-center justify-center rounded-lg h-10 px-6 bg-primary hover:bg-blue-600 text-white text-sm font-bold transition-colors">
                            <span x-show="!loading">Tanya AI</span>
                            <span x-show="loading" class="animate-pulse">...</span>
                        </button>
                    </div>
                </div>
                <!-- Chat Response Area (Hidden by default until interaction) -->
                 <div x-show="messages.length > 0" class="mt-4 bg-white/10 backdrop-blur rounded-xl p-4 max-h-60 overflow-y-auto" style="display: none;">
                    <template x-for="msg in messages">
                        <div :class="msg.sender === 'user' ? 'text-right mb-2' : 'text-left mb-2'">
                            <span :class="msg.sender === 'user' ? 'bg-primary text-white' : 'bg-[#233348] text-white'" class="inline-block px-3 py-2 rounded-lg text-sm max-w-[90%]">
                                <span x-text="msg.text"></span>
                            </span>
                        </div>
                    </template>
                 </div>
            </div>
        </div>
    </section>

    <!-- Stats Overview -->
    <section class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
        <!-- Stat Card 1 -->
        <div class="flex flex-col p-5 bg-white dark:bg-[#1e293b] rounded-xl border border-slate-200 dark:border-[#324867] shadow-sm hover:shadow-md transition-shadow">
            <div class="flex items-center justify-between mb-2">
                <span class="text-slate-500 dark:text-[#92a9c9] text-sm font-medium">Tiket Terbuka</span>
                <span class="material-symbols-outlined text-orange-400 bg-orange-400/10 p-1.5 rounded-lg text-xl">pending_actions</span>
            </div>
            <div class="flex items-baseline gap-2">
                <span class="text-3xl font-bold text-slate-900 dark:text-white">{{ $activeTickets->count() }}</span>
                <span class="text-xs text-orange-400 font-medium">Perlu perhatian</span>
            </div>
        </div>
        <!-- Stat Card 2 -->
        <div class="flex flex-col p-5 bg-white dark:bg-[#1e293b] rounded-xl border border-slate-200 dark:border-[#324867] shadow-sm hover:shadow-md transition-shadow">
            <div class="flex items-center justify-between mb-2">
                <span class="text-slate-500 dark:text-[#92a9c9] text-sm font-medium">Sedang Diproses</span>
                <span class="material-symbols-outlined text-primary bg-primary/10 p-1.5 rounded-lg text-xl">build</span>
            </div>
            <div class="flex items-baseline gap-2">
                <span class="text-3xl font-bold text-slate-900 dark:text-white">{{ $activeTickets->where('status', 'in_progress')->count() }}</span>
                <span class="text-xs text-primary font-medium">Estimasi 2 jam</span>
            </div>
        </div>
        <!-- Stat Card 3 -->
        <div class="flex flex-col p-5 bg-white dark:bg-[#1e293b] rounded-xl border border-slate-200 dark:border-[#324867] shadow-sm hover:shadow-md transition-shadow">
            <div class="flex items-center justify-between mb-2">
                <span class="text-slate-500 dark:text-[#92a9c9] text-sm font-medium">Selesai (Total)</span>
                <span class="material-symbols-outlined text-emerald-400 bg-emerald-400/10 p-1.5 rounded-lg text-xl">check_circle</span>
            </div>
            <div class="flex items-baseline gap-2">
                <span class="text-3xl font-bold text-slate-900 dark:text-white">{{ $user->tickets()->where('status', 'completed')->count() }}</span>
                <span class="text-xs text-emerald-400 font-medium">Tiket terselesaikan</span>
            </div>
        </div>
        <!-- Stat Card 4 -->
        <div class="flex flex-col p-5 bg-white dark:bg-[#1e293b] rounded-xl border border-slate-200 dark:border-[#324867] shadow-sm hover:shadow-md transition-shadow cursor-pointer group">
            <div class="flex items-center justify-between mb-2">
                <span class="text-slate-500 dark:text-[#92a9c9] text-sm font-medium">Aset Saya</span>
                <span class="material-symbols-outlined text-purple-400 bg-purple-400/10 p-1.5 rounded-lg text-xl">devices</span>
            </div>
            <div class="flex items-baseline gap-2">
                <span class="text-3xl font-bold text-slate-900 dark:text-white">{{ $inventories->count() }}</span>
                <span class="text-xs text-slate-500 dark:text-slate-400 font-medium group-hover:text-primary transition-colors">Lihat Detail →</span>
            </div>
        </div>
    </section>

    <!-- Main Content Grid -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Left Column: Recent Tickets (Span 2) -->
        <div class="lg:col-span-2 flex flex-col gap-4">
            <div class="flex items-center justify-between px-1">
                <h3 class="text-slate-900 dark:text-white text-lg font-bold leading-tight">Aktivitas Terkini</h3>
                <a class="text-primary text-sm font-bold hover:underline" href="{{ route('tickets.create') }}">Lihat Semua</a>
            </div>
            <div class="bg-white dark:bg-[#1e293b] rounded-xl border border-slate-200 dark:border-[#324867] overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="border-b border-slate-100 dark:border-[#324867] bg-slate-50 dark:bg-[#233348]/50">
                                <th class="p-4 text-xs font-bold text-slate-500 dark:text-[#92a9c9] uppercase tracking-wide">ID Tiket</th>
                                <th class="p-4 text-xs font-bold text-slate-500 dark:text-[#92a9c9] uppercase tracking-wide">Subjek</th>
                                <th class="p-4 text-xs font-bold text-slate-500 dark:text-[#92a9c9] uppercase tracking-wide">Tanggal</th>
                                <th class="p-4 text-xs font-bold text-slate-500 dark:text-[#92a9c9] uppercase tracking-wide text-right">Status</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100 dark:divide-[#324867]">
                            @forelse($activeTickets as $ticket)
                            <tr class="hover:bg-slate-50 dark:hover:bg-[#233348]/30 transition-colors cursor-pointer group">
                                <td class="p-4 text-sm font-mono text-slate-500 dark:text-[#92a9c9] group-hover:text-primary">#{{ $ticket->id }}</td>
                                <td class="p-4 text-sm font-medium text-slate-900 dark:text-white">
                                    <div class="flex items-center gap-2">
                                        <span>{{ $ticket->subject }}</span>
                                    </div>
                                </td>
                                <td class="p-4 text-sm text-slate-500 dark:text-[#92a9c9]">{{ $ticket->created_at->diffForHumans() }}</td>
                                <td class="p-4 text-right">
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium 
                                        {{ $ticket->status == 'pending' ? 'bg-yellow-100 text-yellow-800 dark:bg-yellow-900/30 dark:text-yellow-300' : 'bg-blue-100 text-blue-800 dark:bg-blue-900/30 dark:text-blue-300' }}">
                                        {{ ucfirst($ticket->status) }}
                                    </span>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="4" class="p-4 text-center text-gray-500">Belum ada tiket aktif.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <!-- Pagination or View All -->
            </div>

            <!-- Quick Actions CTA -->
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mt-4">
                <a href="{{ route('tickets.create') }}" class="flex items-center justify-between p-4 bg-primary text-white rounded-xl shadow-lg shadow-primary/20 hover:bg-blue-600 transition-all group">
                    <div class="flex flex-col items-start">
                        <span class="text-base font-bold">Ajukan Tiket Baru</span>
                        <span class="text-xs text-blue-100 mt-1 text-left">Laporan kerusakan atau permintaan</span>
                    </div>
                    <span class="material-symbols-outlined text-3xl group-hover:translate-x-1 transition-transform">add_circle</span>
                </a>
                <button class="flex items-center justify-between p-4 bg-white dark:bg-[#233348] text-slate-900 dark:text-white border border-slate-200 dark:border-[#324867] rounded-xl hover:bg-slate-50 dark:hover:bg-[#324867] transition-all group">
                    <div class="flex flex-col items-start">
                        <span class="text-base font-bold">Panduan / FAQ</span>
                        <span class="text-xs text-slate-500 dark:text-slate-400 mt-1 text-left">Cari solusi mandiri</span>
                    </div>
                    <span class="material-symbols-outlined text-3xl text-slate-400 group-hover:text-white transition-colors">menu_book</span>
                </button>
            </div>
        </div>

        <!-- Right Column: Inventory & Status (Span 1) -->
        <div class="flex flex-col gap-6">
            <!-- My Inventory -->
            <div class="flex flex-col gap-3">
                <div class="flex items-center justify-between px-1">
                    <h3 class="text-slate-900 dark:text-white text-lg font-bold leading-tight">Inventaris Saya</h3>
                    <button class="text-slate-400 hover:text-primary transition-colors">
                        <span class="material-symbols-outlined text-xl">more_horiz</span>
                    </button>
                </div>
                <div class="bg-white dark:bg-[#1e293b] rounded-xl border border-slate-200 dark:border-[#324867] p-4 flex flex-col gap-4">
                    @forelse($inventories->take(3) as $item)
                    <!-- Item -->
                    <div class="flex items-start gap-3 {{ !$loop->first ? 'pt-3 border-t border-slate-100 dark:border-[#324867]' : '' }}">
                        <div class="size-12 rounded-lg bg-slate-100 dark:bg-[#101822] flex items-center justify-center shrink-0">
                            <span class="material-symbols-outlined text-slate-500 text-2xl">
                                {{ Str::contains(strtolower($item->item_name), 'laptop') ? 'laptop_mac' : 
                                   (Str::contains(strtolower($item->item_name), 'monitor') ? 'desktop_windows' : 'devices') }}
                            </span>
                        </div>
                        <div class="flex flex-col flex-1 min-w-0">
                            <span class="text-sm font-bold text-slate-900 dark:text-white truncate">{{ $item->item_name }}</span>
                            <span class="text-xs text-slate-500 dark:text-[#92a9c9] truncate">SN: {{ $item->serial_number ?? 'N/A' }}</span>
                        </div>
                        <span class="inline-flex items-center px-2 py-0.5 rounded text-[10px] font-bold bg-emerald-100 text-emerald-800 dark:bg-emerald-900/30 dark:text-emerald-400 uppercase">
                            Active
                        </span>
                    </div>
                    @empty
                        <p class="text-gray-500 text-sm text-center">Tidak ada inventaris.</p>
                    @endforelse
                </div>
            </div>

            <!-- Announcements -->
            @if($announcements->count() > 0)
            <div class="flex flex-col gap-3">
                 <div class="flex items-center justify-between px-1">
                    <h3 class="text-slate-900 dark:text-white text-lg font-bold leading-tight">Pengumuman</h3>
                </div>
                @foreach($announcements as $announcement)
                <div class="rounded-xl border p-4 shadow-sm relative overflow-hidden
                    {{ $announcement->type == 'critical' ? 'bg-red-50 dark:bg-red-900/10 border-red-200 dark:border-red-500/30' : 
                       ($announcement->type == 'warning' ? 'bg-yellow-50 dark:bg-yellow-900/10 border-yellow-200 dark:border-yellow-500/30' : 
                       'bg-white dark:bg-[#1e293b] border-slate-200 dark:border-[#324867]') }}">
                    
                    @if($announcement->type == 'critical')
                        <div class="absolute top-0 right-0 p-2 opacity-10">
                            <span class="material-symbols-outlined text-6xl text-red-500">warning</span>
                        </div>
                    @endif

                    <div class="flex items-start justify-between mb-2 relative z-10">
                        <div class="flex items-center gap-2">
                            @if($announcement->type == 'critical')
                                <span class="material-symbols-outlined text-red-500 text-base">error</span>
                                <span class="text-xs font-bold text-red-600 dark:text-red-400 uppercase tracking-wider">Penting</span>
                            @elseif($announcement->type == 'warning')
                                <span class="material-symbols-outlined text-yellow-500 text-base">warning</span>
                                <span class="text-xs font-bold text-yellow-600 dark:text-yellow-400 uppercase tracking-wider">Perhatian</span>
                            @else
                                <span class="material-symbols-outlined text-blue-500 text-base">info</span>
                                <span class="text-xs font-bold text-blue-600 dark:text-blue-400 uppercase tracking-wider">Info</span>
                            @endif
                        </div>
                        <span class="text-[10px] text-slate-400 font-mono">{{ $announcement->created_at->format('d M') }}</span>
                    </div>
                    
                    <h4 class="text-sm font-bold text-slate-900 dark:text-white mb-1 relative z-10">{{ $announcement->title }}</h4>
                    <p class="text-xs text-slate-600 dark:text-slate-300 leading-relaxed relative z-10">
                        {{ $announcement->content }}
                    </p>
                </div>
                @endforeach
            </div>
            @endif
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        document.addEventListener('alpine:init', () => {
             // Reuse previous chatbot logic if needed, or simple JS
             // Re-implementing simple chatbot logic for the new UI
             Alpine.data('chatbot', () => ({
                messages: [],
                userInput: '',
                loading: false,
                async sendMessage() {
                    if (this.userInput.trim() === '') return;
                    const text = this.userInput;
                    this.messages.push({ sender: 'user', text: text });
                    this.userInput = '';
                    this.loading = true;
                    try {
                        const response = await axios.post('{{ route('chatbot.ask') }}', { message: text });
                        this.messages.push({ sender: 'ai', text: response.data.response });
                    } catch (e) {
                         this.messages.push({ sender: 'ai', text: 'Error interacting with AI.' });
                    }
                    this.loading = false;
                }
             }));
        });
    </script>
@endpush
