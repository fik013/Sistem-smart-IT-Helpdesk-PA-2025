@extends('layouts.app')

@section('content')
    <!-- Page Heading & Action -->
    <div class="flex flex-col md:flex-row md:items-end justify-between gap-4 pb-2">
        <div class="flex flex-col gap-2">
            <h1 class="text-slate-900 dark:text-white text-3xl md:text-4xl font-black leading-tight tracking-[-0.033em]">
                Inventaris Pribadi</h1>
            <p class="text-slate-500 dark:text-text-secondary text-base font-normal leading-normal max-w-xl">
                Kelola dan pantau semua aset IT yang ditugaskan kepada Anda, termasuk perangkat keras dan lisensi
                perangkat lunak.
            </p>
        </div>
        <button
            class="flex items-center justify-center gap-2 rounded-lg h-11 px-5 bg-primary hover:bg-blue-600 transition-colors text-white text-sm font-bold leading-normal tracking-[0.015em] shrink-0 shadow-lg shadow-blue-500/20">
            <span class="material-symbols-outlined text-[20px]">report_problem</span>
            <span>Laporkan Masalah</span>
        </button>
    </div>

    <!-- Stats Overview -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
        <div
            class="flex flex-col gap-1 rounded-xl p-5 border border-slate-200 dark:border-border-dark bg-white dark:bg-[#1A2634] shadow-sm">
            <div class="flex items-center justify-between">
                <p class="text-slate-500 dark:text-text-secondary text-sm font-medium uppercase tracking-wider">Total
                    Aset</p>
                <span class="material-symbols-outlined text-primary">inventory_2</span>
            </div>
            <p class="text-slate-900 dark:text-white text-3xl font-bold leading-tight mt-1">{{ $inventories->count() }}
            </p>
        </div>
        <div
            class="flex flex-col gap-1 rounded-xl p-5 border border-slate-200 dark:border-border-dark bg-white dark:bg-[#1A2634] shadow-sm">
            <div class="flex items-center justify-between">
                <p class="text-slate-500 dark:text-text-secondary text-sm font-medium uppercase tracking-wider">Perlu
                    Perbaikan</p>
                <span class="material-symbols-outlined text-orange-500">build</span>
            </div>
            <p class="text-slate-900 dark:text-white text-3xl font-bold leading-tight mt-1">
                {{ $inventories->where('status', 'maintenance')->count() }}</p>
        </div>
        <div
            class="flex flex-col gap-1 rounded-xl p-5 border border-slate-200 dark:border-border-dark bg-white dark:bg-[#1A2634] shadow-sm">
            <div class="flex items-center justify-between">
                <p class="text-slate-500 dark:text-text-secondary text-sm font-medium uppercase tracking-wider">Jadwal
                    Refresh</p>
                <span class="material-symbols-outlined text-yellow-500">update</span>
            </div>
            <p class="text-slate-900 dark:text-white text-3xl font-bold leading-tight mt-1">0</p>
        </div>
    </div>

    <!-- Toolbar (Search & Filters) -->
    <div class="flex flex-col lg:flex-row items-start lg:items-center justify-between gap-4 py-2">
        <!-- Chips -->
        <div class="flex gap-2 overflow-x-auto pb-2 lg:pb-0 w-full lg:w-auto scrollbar-hide">
            <button
                class="flex h-9 shrink-0 items-center justify-center gap-x-2 rounded-lg bg-slate-200 dark:bg-slate-700 text-slate-900 dark:text-white px-4 hover:bg-slate-300 dark:hover:bg-slate-600 transition-colors">
                <span class="text-sm font-bold">Semua</span>
            </button>
            <button
                class="flex h-9 shrink-0 items-center justify-center gap-x-2 rounded-lg border border-slate-200 dark:border-border-dark bg-transparent text-slate-500 dark:text-text-secondary px-4 hover:bg-slate-100 dark:hover:bg-[#233348] hover:text-slate-900 dark:hover:text-white transition-colors">
                <span class="text-sm font-medium">Laptop</span>
            </button>
            <button
                class="flex h-9 shrink-0 items-center justify-center gap-x-2 rounded-lg border border-slate-200 dark:border-border-dark bg-transparent text-slate-500 dark:text-text-secondary px-4 hover:bg-slate-100 dark:hover:bg-[#233348] hover:text-slate-900 dark:hover:text-white transition-colors">
                <span class="text-sm font-medium">Monitor</span>
            </button>
            <button
                class="flex h-9 shrink-0 items-center justify-center gap-x-2 rounded-lg border border-slate-200 dark:border-border-dark bg-transparent text-slate-500 dark:text-text-secondary px-4 hover:bg-slate-100 dark:hover:bg-[#233348] hover:text-slate-900 dark:hover:text-white transition-colors">
                <span class="text-sm font-medium">Aksesoris</span>
            </button>
        </div>
        <!-- Detailed Search -->
        <label class="flex flex-col min-w-40 h-10 w-full lg:w-80 relative">
            <div
                class="flex w-full flex-1 items-stretch rounded-lg h-full border border-slate-200 dark:border-border-dark bg-white dark:bg-[#1A2634] focus-within:ring-2 focus-within:ring-primary focus-within:border-transparent transition-all">
                <div class="text-slate-400 dark:text-text-secondary flex items-center justify-center pl-3">
                    <span class="material-symbols-outlined text-[20px]">filter_list</span>
                </div>
                <input
                    class="flex w-full min-w-0 flex-1 resize-none bg-transparent text-slate-900 dark:text-white focus:outline-0 h-full placeholder:text-slate-400 dark:placeholder:text-text-secondary px-3 text-sm font-normal leading-normal"
                    placeholder="Filter berdasarkan ID atau Tag..." value="" />
            </div>
        </label>
    </div>

    <!-- Inventory Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @forelse($inventories as $inventory)
            <div
                class="group flex flex-col rounded-xl border border-slate-200 dark:border-border-dark bg-white dark:bg-[#1A2634] overflow-hidden hover:border-primary/50 transition-all duration-300 shadow-sm hover:shadow-lg hover:shadow-primary/10">
                <div class="relative h-48 w-full bg-slate-100 dark:bg-[#233348] flex items-center justify-center p-6">
                    <div class="absolute top-3 right-3">
                        <span
                            class="inline-flex items-center gap-1 rounded-full bg-emerald-100 dark:bg-emerald-500/10 px-2 py-1 text-xs font-semibold text-emerald-700 dark:text-emerald-400 border border-emerald-200 dark:border-emerald-500/20">
                            <span class="h-1.5 w-1.5 rounded-full bg-emerald-500"></span>
                            {{ $inventory->status ?? 'Digunakan' }}
                        </span>
                    </div>
                    <!-- Placeholder Image - Logic to be refined based on item type if available -->
                    <img class="h-full w-auto object-contain mix-blend-multiply dark:mix-blend-normal drop-shadow-xl transition-transform duration-500 group-hover:scale-105"
                        src="https://via.placeholder.com/300?text={{ urlencode($inventory->item_name) }}"
                        alt="{{ $inventory->item_name }}" />
                </div>
                <div class="flex flex-col p-5 gap-4">
                    <div>
                        <div class="flex justify-between items-start mb-1">
                            <h3
                                class="text-slate-900 dark:text-white text-lg font-bold leading-tight group-hover:text-primary transition-colors">
                                {{ $inventory->item_name }}</h3>
                            <button
                                class="text-slate-400 dark:text-text-secondary hover:text-primary dark:hover:text-white">
                                <span class="material-symbols-outlined">more_vert</span>
                            </button>
                        </div>
                        <p class="text-slate-500 dark:text-text-secondary text-sm font-mono">
                            {{ $inventory->serial_number }}</p>
                    </div>
                    <div
                        class="grid grid-cols-2 gap-y-3 gap-x-2 text-sm border-t border-dashed border-slate-200 dark:border-border-dark pt-4">
                        <div class="flex flex-col">
                            <span class="text-slate-400 dark:text-text-secondary text-xs">Assigned</span>
                            <span
                                class="text-slate-900 dark:text-white font-medium">{{ $inventory->created_at->format('d M Y') }}</span>
                        </div>
                        <div class="flex flex-col">
                            <span class="text-slate-400 dark:text-text-secondary text-xs">Warranty</span>
                            <span class="text-slate-900 dark:text-white font-medium">-</span>
                        </div>
                        <div class="flex flex-col col-span-2">
                            <span class="text-slate-400 dark:text-text-secondary text-xs">Description</span>
                            <span
                                class="text-slate-900 dark:text-white font-medium truncate">{{ $inventory->description }}</span>
                        </div>
                    </div>
                    <div class="flex gap-2 mt-2">
                        <button
                            class="flex-1 rounded-lg border border-slate-200 dark:border-border-dark bg-transparent py-2 text-xs font-bold text-slate-700 dark:text-white hover:bg-slate-50 dark:hover:bg-[#233348] transition-colors">
                            Lihat Detail
                        </button>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-span-full text-center py-10">
                <div class="bg-slate-100 dark:bg-[#233348] rounded-full p-4 mb-4 inline-block">
                    <span class="material-symbols-outlined text-4xl text-slate-400 dark:text-text-secondary">inventory_2</span>
                </div>
                <h3 class="text-slate-900 dark:text-white text-lg font-bold">Belum ada inventaris</h3>
                <p class="text-slate-500 dark:text-text-secondary text-sm mt-1">Anda belum memiliki aset yang ditugaskan atau data belum tersedia.</p>
            </div>
        @endforelse
    </div>
@endsection
