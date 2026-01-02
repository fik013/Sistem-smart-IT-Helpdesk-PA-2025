@extends('layouts.app')

@section('content')
    <div class="flex flex-1 justify-center py-8 px-4 sm:px-6 lg:px-8">
        <div class="w-full max-w-[1200px] flex flex-col gap-8">
            <!-- Page Heading & Action -->
            <div class="flex flex-wrap items-end justify-between gap-4">
                <div class="flex flex-col gap-2">
                    <h1 class="text-white text-4xl font-black leading-tight tracking-[-0.033em]">Riwayat Tiket</h1>
                    <p class="text-text-secondary text-base font-normal leading-normal">Kelola dan pantau status tiket bantuan
                        IT Anda di sini.</p>
                </div>
                <a href="{{ route('tickets.create') }}"
                    class="flex items-center justify-center gap-2 rounded-lg h-10 px-6 bg-primary hover:bg-blue-600 text-white text-sm font-bold leading-normal tracking-[0.015em] transition-colors shadow-lg shadow-blue-900/20">
                    <span class="material-symbols-outlined !text-[20px]">add</span>
                    <span class="truncate">Buat Tiket Baru</span>
                </a>
            </div>
            <!-- Stats Overview -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
                <div
                    class="flex flex-col gap-2 rounded-xl p-6 border border-surface-border bg-surface-dark/30 hover:bg-surface-dark/50 transition-colors">
                    <div class="flex justify-between items-start">
                        <p class="text-text-secondary text-sm font-medium leading-normal">Total Tiket</p>
                        <span class="material-symbols-outlined text-text-secondary !text-[20px]">folder</span>
                    </div>
                    <p class="text-white tracking-tight text-3xl font-bold leading-tight">{{ $stats['total'] }}</p>
                </div>
                <div
                    class="flex flex-col gap-2 rounded-xl p-6 border border-surface-border bg-surface-dark/30 hover:bg-surface-dark/50 transition-colors relative overflow-hidden group">
                    <div
                        class="absolute right-0 top-0 h-full w-1 bg-yellow-500/50 group-hover:bg-yellow-500 transition-colors">
                    </div>
                    <div class="flex justify-between items-start">
                        <p class="text-text-secondary text-sm font-medium leading-normal">Open</p>
                        <span class="material-symbols-outlined text-yellow-500 !text-[20px]">warning</span>
                    </div>
                    <p class="text-white tracking-tight text-3xl font-bold leading-tight">{{ $stats['open'] }}</p>
                </div>
                <div
                    class="flex flex-col gap-2 rounded-xl p-6 border border-surface-border bg-surface-dark/30 hover:bg-surface-dark/50 transition-colors relative overflow-hidden group">
                    <div class="absolute right-0 top-0 h-full w-1 bg-primary/50 group-hover:bg-primary transition-colors">
                    </div>
                    <div class="flex justify-between items-start">
                        <p class="text-text-secondary text-sm font-medium leading-normal">Sedang Diproses</p>
                        <span class="material-symbols-outlined text-primary !text-[20px]">pending</span>
                    </div>
                    <p class="text-white tracking-tight text-3xl font-bold leading-tight">{{ $stats['processing'] }}</p>
                </div>
                <div
                    class="flex flex-col gap-2 rounded-xl p-6 border border-surface-border bg-surface-dark/30 hover:bg-surface-dark/50 transition-colors relative overflow-hidden group">
                    <div
                        class="absolute right-0 top-0 h-full w-1 bg-green-500/50 group-hover:bg-green-500 transition-colors">
                    </div>
                    <div class="flex justify-between items-start">
                        <p class="text-text-secondary text-sm font-medium leading-normal">Selesai</p>
                        <span class="material-symbols-outlined text-green-500 !text-[20px]">check_circle</span>
                    </div>
                    <p class="text-white tracking-tight text-3xl font-bold leading-tight">{{ $stats['completed'] }}</p>
                </div>
            </div>
            <!-- Toolbar: Search & Filters -->
            <!-- Toolbar: Search & Filters -->
            <form method="GET" action="{{ route('tickets.index') }}"
                class="flex flex-col lg:flex-row gap-4 items-center justify-between bg-surface-dark/30 p-2 rounded-xl border border-surface-border">
                <div class="w-full lg:w-96">
                    <label
                        class="flex items-center w-full h-10 rounded-lg bg-surface-dark border border-surface-border focus-within:border-primary transition-colors overflow-hidden">
                        <div class="flex items-center justify-center pl-3 pr-2 text-text-secondary">
                            <button type="submit">
                                <span class="material-symbols-outlined !text-[20px]">search</span>
                            </button>
                        </div>
                        <input
                            type="text"
                            name="search"
                            value="{{ request('search') }}"
                            class="w-full bg-transparent border-none text-white text-sm placeholder:text-text-secondary focus:ring-0 h-full"
                            placeholder="Cari ID Tiket, Subjek..." />
                    </label>
                </div>
                <div class="flex gap-2 overflow-x-auto w-full lg:w-auto pb-2 lg:pb-0 scrollbar-hide">
                    <div class="relative">
                        <select name="status" onchange="this.form.submit()"
                            class="appearance-none flex h-9 shrink-0 items-center gap-2 rounded-lg border border-surface-border bg-surface-dark hover:bg-surface-border pl-3 pr-8 transition-colors text-white text-sm font-medium focus:ring-0 focus:border-primary cursor-pointer w-full">
                            <option value="all">Semua Status</option>
                            <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                            <option value="processing" {{ request('status') == 'processing' ? 'selected' : '' }}>Processing</option>
                            <option value="completed" {{ request('status') == 'completed' ? 'selected' : '' }}>Completed</option>
                        </select>
                        <span class="material-symbols-outlined text-text-secondary !text-[18px] absolute right-2 top-1/2 -translate-y-1/2 pointer-events-none">expand_more</span>
                    </div>

                    <div class="relative">
                        <select name="urgency" onchange="this.form.submit()"
                            class="appearance-none flex h-9 shrink-0 items-center gap-2 rounded-lg border border-surface-border bg-surface-dark hover:bg-surface-border pl-3 pr-8 transition-colors text-white text-sm font-medium focus:ring-0 focus:border-primary cursor-pointer w-full">
                            <option value="all">Semua Prioritas</option>
                            <option value="low" {{ request('urgency') == 'low' ? 'selected' : '' }}>Low</option>
                            <option value="medium" {{ request('urgency') == 'medium' ? 'selected' : '' }}>Medium</option>
                            <option value="high" {{ request('urgency') == 'high' ? 'selected' : '' }}>High</option>
                        </select>
                         <span class="material-symbols-outlined text-text-secondary !text-[18px] absolute right-2 top-1/2 -translate-y-1/2 pointer-events-none">expand_more</span>
                    </div>

                    <div class="w-px h-6 bg-surface-border my-auto mx-1"></div>
                    <a href="{{ route('tickets.index') }}"
                        class="flex size-9 shrink-0 items-center justify-center rounded-lg border border-surface-border bg-surface-dark hover:bg-surface-border text-text-secondary transition-colors"
                        title="Reset Filter">
                        <span class="material-symbols-outlined !text-[20px]">restart_alt</span>
                    </a>
                </div>
            </form>
            <!-- Ticket Table -->
            <div class="overflow-hidden rounded-xl border border-surface-border bg-surface-dark/20">
                <div class="overflow-x-auto">
                    <table class="w-full text-left text-sm text-text-secondary">
                        <thead
                            class="bg-surface-dark border-b border-surface-border text-xs uppercase font-semibold text-white">
                            <tr>
                                <th class="px-6 py-4" scope="col">ID Tiket</th>
                                <th class="px-6 py-4" scope="col">Subjek &amp; Katgeori</th>
                                <th class="px-6 py-4" scope="col">Tanggal Dibuat</th>
                                <th class="px-6 py-4" scope="col">Status</th>
                                <th class="px-6 py-4 text-right" scope="col">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-surface-border">
                            @forelse($tickets as $ticket)
                                <tr class="hover:bg-surface-dark/40 transition-colors group">
                                    <td class="px-6 py-4 font-medium text-white font-mono whitespace-nowrap">
                                        <span class="text-primary">#{{ $ticket->id }}</span>
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="flex flex-col">
                                            <span class="text-white font-medium text-base">{{ $ticket->subject }}</span>
                                            <span
                                                class="text-xs text-text-secondary mt-0.5">{{ Str::limit($ticket->description, 30) }}</span>
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
                                            ? 'bg-yellow-500/10 text-yellow-400 border-yellow-500/20'
                                            : ($ticket->status == 'completed'
                                                ? 'bg-green-500/10 text-green-400 border-green-500/20'
                                                : 'bg-primary/10 text-blue-400 border-primary/20') }}">
                                            {{ ucfirst($ticket->status) }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 text-right">
                                        <button
                                            class="text-text-secondary hover:text-white transition-colors p-1 rounded hover:bg-surface-border">
                                            <span class="material-symbols-outlined">more_vert</span>
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
                <div class="px-6 py-4 border-t border-surface-border bg-surface-dark">
                    {{ $tickets->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection
