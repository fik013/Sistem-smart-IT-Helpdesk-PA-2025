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
                <!-- Chat Response Area (Hidden by default until interaction) -->
                 <div x-show="messages.length > 0" class="mt-4 relative" style="display: none;">
                    <div class="bg-white/10 backdrop-blur rounded-xl p-4 max-h-60 overflow-y-auto custom-scrollbar pr-2" x-ref="chatContainer" @scroll="isScrolled = $el.scrollTop > 10">
                        <template x-for="msg in messages">
                            <div :class="msg.sender === 'user' ? 'text-right mb-2' : 'text-left mb-2'">
                                <span :class="msg.sender === 'user' ? 'bg-primary text-white' : 'bg-[#233348] text-white'" class="inline-block px-3 py-2 rounded-lg text-sm max-w-[90%] font-light leading-relaxed">
                                    <span x-html="msg.text"></span>
                                </span>
                            </div>
                        </template>
                        <!-- Spacer for scroll visibility -->
                        <div class="h-4"></div>
                    </div>
                    
                    <!-- Scroll Hint -->
                    <div x-show="messages.length >= 2 && !isScrolled" x-transition.opacity.duration.500ms class="absolute bottom-2 right-4 pointer-events-none">
                         <span class="inline-flex items-center gap-1 px-2 py-1 rounded-full bg-black/40 text-[10px] text-white/80 backdrop-blur-md border border-white/10 animate-bounce">
                            Scroll <span class="material-symbols-outlined text-[12px]">arrow_downward</span>
                         </span>
                    </div>
                 </div>
            </div>
        </div>
    </section>


    <!-- Announcements Section -->
    @if($announcements->count() > 0)
    <section class="flex flex-wrap items-start gap-3 animate-fade-in-up delay-100">
        @foreach($announcements as $announcement)
        <div x-data="{ expanded: true }" 
             :class="expanded ? 'w-full p-4 md:p-5' : 'w-[calc(50%-0.375rem)] md:w-[calc(33.33%-0.5rem)] lg:w-[calc(25%-0.5625rem)] p-3 h-24 hover:scale-[1.02] cursor-pointer'"
             class="relative overflow-hidden rounded-xl border shadow-sm transition-all duration-300
            {{ $announcement->type == 'critical' ? 'bg-red-50 dark:bg-red-900/10 border-red-200 dark:border-red-500/30' : 
               ($announcement->type == 'warning' ? 'bg-yellow-50 dark:bg-yellow-900/10 border-yellow-200 dark:border-yellow-500/30' : 
               'bg-blue-50 dark:bg-blue-900/10 border-blue-200 dark:border-blue-500/30') }}">
            
            <div class="flex gap-3 relative z-10 h-full" 
                 :class="expanded ? 'flex-col md:flex-row justify-between items-start' : 'flex-col justify-between'">
                
                <!-- Icon & Content -->
                <div class="flex gap-3 flex-1" :class="expanded ? 'items-start' : 'items-center flex-row'">
                    <!-- Icon -->
                    <div class="shrink-0 rounded-lg transition-all {{ $announcement->type == 'critical' ? 'bg-red-100 text-red-600 dark:bg-red-500/20 dark:text-red-400' : ($announcement->type == 'warning' ? 'bg-yellow-100 text-yellow-600 dark:bg-yellow-500/20 dark:text-yellow-400' : 'bg-blue-100 text-blue-600 dark:bg-blue-500/20 dark:text-blue-400') }}"
                         :class="expanded ? 'p-2' : 'p-1.5'">
                        <span class="material-symbols-outlined transition-all" :class="expanded ? 'text-2xl' : 'text-lg'">
                            {{ $announcement->type == 'critical' ? 'fmd_bad' : ($announcement->type == 'warning' ? 'warning' : 'campaign') }}
                        </span>
                    </div>

                    <!-- Text Content -->
                    <div class="flex flex-col gap-0.5 w-full overflow-hidden">
                        <div class="flex items-center gap-2" :class="expanded ? 'justify-between md:justify-start' : ''">
                            <h3 class="font-bold text-slate-900 dark:text-white transition-all leading-tight truncate" 
                                :class="expanded ? 'text-base md:text-lg' : 'text-xs'">
                                {{ $announcement->title }}
                            </h3>
                            <!-- Badge only shown when expanded or if space permits (hidden on mini to be cleaner) -->
                            @if($announcement->type == 'critical')
                                <span x-show="expanded" class="px-2 py-0.5 rounded text-[10px] font-bold uppercase bg-red-100 text-red-700 dark:bg-red-500/20 dark:text-red-400 border border-red-200 dark:border-red-500/30 shrink-0">Penting</span>
                            @endif
                        </div>
                        
                        <!-- Description (Collapsible) -->
                        <div x-show="expanded" x-collapse>
                            <p class="text-sm text-slate-600 dark:text-slate-300 leading-relaxed mt-1">{{ $announcement->content }}</p>
                        </div>
                    </div>
                </div>

                <!-- Toggle Button / Date -->
                <div class="flex items-center gap-3 shrink-0" :class="expanded ? 'pl-14 md:pl-0 absolute top-4 right-4 md:static' : 'absolute top-3 right-3'">
                    <div class="flex items-center gap-2 text-xs text-slate-400 dark:text-slate-500 font-mono" x-show="expanded">
                        <span class="material-symbols-outlined text-[16px] align-text-bottom">event</span>
                        {{ $announcement->created_at->format('d M Y') }}
                    </div>
                    <!-- Toggle Button -->
                    <button @click.stop="expanded = !expanded" class="p-1 rounded-full hover:bg-black/5 dark:hover:bg-white/10 transition-colors text-slate-400 dark:text-slate-500">
                        <span class="material-symbols-outlined transition-transform duration-200" :class="expanded ? 'rotate-180' : ''">
                            {{-- Change icon logic if needed, but rotate is fine --}}
                            expand_more
                        </span>
                    </button>
                </div>
            </div>

            <!-- Background Decoration (Hide when minimized) -->
            <div class="absolute -right-6 -bottom-6 opacity-5 dark:opacity-10 rotate-12 pointer-events-none" x-show="expanded" x-transition>
                <span class="material-symbols-outlined text-[120px] {{ $announcement->type == 'critical' ? 'text-red-500' : ($announcement->type == 'warning' ? 'text-yellow-500' : 'text-blue-500') }}">
                    {{ $announcement->type == 'critical' ? 'fmd_bad' : ($announcement->type == 'warning' ? 'warning' : 'campaign') }}
                </span>
            </div>
            
            <!-- Click anywhere to expand if minimized -->
            <div x-show="!expanded" @click="expanded = true" class="absolute inset-0 z-0 cursor-pointer" title="Perbesar"></div>
        </div>
        @endforeach
    </section>
    @endif

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
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 mt-4">
                <a href="{{ route('tickets.create') }}" class="flex items-center justify-between p-4 bg-primary text-white rounded-xl shadow-lg shadow-primary/20 hover:bg-blue-600 transition-all group">
                    <div class="flex flex-col items-start">
                        <span class="text-base font-bold">Ajukan Tiket Baru</span>
                        <span class="text-xs text-blue-100 mt-1 text-left">Laporan kerusakan</span>
                    </div>
                    <span class="material-symbols-outlined text-3xl group-hover:translate-x-1 transition-transform">add_circle</span>
                </a>
                
                <a href="{{ route('user.faq') }}" class="flex items-center justify-between p-4 bg-white dark:bg-[#233348] text-slate-900 dark:text-white border border-slate-200 dark:border-[#324867] rounded-xl hover:bg-slate-50 dark:hover:bg-[#324867] transition-all group">
                    <div class="flex flex-col items-start">
                        <span class="text-base font-bold">Panduan / FAQ</span>
                        <span class="text-xs text-slate-500 dark:text-slate-400 mt-1 text-left">Cari solusi mandiri</span>
                    </div>
                    <span class="material-symbols-outlined text-3xl text-slate-400 group-hover:text-primary transition-colors">menu_book</span>
                </a>

                @php
                    $adminContact = \App\Models\User::where('role', 'admin')->whereNotNull('phone_number')->first();
                    $waLink = $adminContact ? 'https://wa.me/' . $adminContact->phone_number : '#';
                @endphp
                <a href="{{ $waLink }}" target="_blank" class="flex items-center justify-between p-4 bg-emerald-500 text-white rounded-xl shadow-lg shadow-emerald-500/20 hover:bg-emerald-600 transition-all group">
                    <div class="flex flex-col items-start">
                        <span class="text-base font-bold">Hubungi Tim IT</span>
                        <span class="text-xs text-white/80 mt-1 text-left">Via WhatsApp</span>
                    </div>
                    <i class="fa-brands fa-whatsapp text-3xl group-hover:scale-110 transition-transform"></i>
                    <!-- Fallback icon if FontAwesome not loaded: -->
                    @if(!Str::contains(asset('app.css'), 'font-awesome')) 
                        <span class="material-symbols-outlined text-3xl">chat</span>
                    @endif
                </a>
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

            <!-- Removed Announcement Section from Here -->
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
                isScrolled: false,
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
                         console.error(e);
                         let errorMsg = 'Error interacting with AI.';
                         if (e.response && e.response.data && e.response.data.response) {
                             errorMsg = e.response.data.response;
                         }
                         this.messages.push({ sender: 'ai', text: errorMsg });
                    }
                    this.loading = false;
                }
             }));
        });
    </script>
@endpush
