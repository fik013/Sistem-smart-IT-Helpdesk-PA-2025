@extends('layouts.app')

@section('content')
    <!-- Page Heading & Action -->
    <div class="flex flex-col md:flex-row md:items-end justify-between gap-4 pb-2">
        <div class="flex flex-col gap-2">
            <h1 class="text-slate-900 dark:text-white text-3xl md:text-4xl font-black leading-tight tracking-[-0.033em]">
                Inventaris Divisi & Pribadi</h1>
            <p class="text-slate-500 dark:text-text-secondary text-base font-normal leading-normal max-w-xl">
                Kelola dan pantau semua aset IT yang ditugaskan kepada Anda, termasuk perangkat keras dan lisensi
                perangkat lunak.
            </p>
        </div>
        <a href="{{ route('tickets.create') }}"
            class="flex items-center justify-center gap-2 rounded-lg h-11 px-5 bg-primary hover:bg-blue-600 transition-colors text-white text-sm font-bold leading-normal tracking-[0.015em] shrink-0 shadow-lg shadow-blue-500/20">
            <span class="material-symbols-outlined text-[20px]">report_problem</span>
            <span>Laporkan Masalah</span>
        </a>
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
    <!-- Toolbar (Search & Filters) -->
    <form method="GET" action="{{ route('user.inventory') }}" class="flex flex-col lg:flex-row items-start lg:items-center justify-between gap-4 py-2">
        <input type="hidden" name="category" value="{{ request('category', 'all') }}" id="category-input">
        
        <!-- Chips -->
        <div class="flex gap-2 overflow-x-auto pb-2 lg:pb-0 w-full lg:w-auto scrollbar-hide">
            <button
                type="button"
                onclick="document.getElementById('category-input').value='all'; this.form.submit();"
                class="flex h-9 shrink-0 items-center justify-center gap-x-2 rounded-lg {{ request('category', 'all') == 'all' ? 'bg-slate-200 dark:bg-slate-700 text-slate-900 dark:text-white' : 'border border-slate-200 dark:border-border-dark bg-transparent text-slate-500 dark:text-text-secondary hover:bg-slate-100 dark:hover:bg-[#233348] hover:text-slate-900 dark:hover:text-white' }} px-4 transition-colors">
                <span class="text-sm {{ request('category', 'all') == 'all' ? 'font-bold' : 'font-medium' }}">Semua</span>
            </button>
            @foreach($categories as $category)
            <button
                type="button"
                onclick="document.getElementById('category-input').value='{{ $category->id }}'; this.form.submit();"
                class="flex h-9 shrink-0 items-center justify-center gap-x-2 rounded-lg {{ request('category') == $category->id ? 'bg-slate-200 dark:bg-slate-700 text-slate-900 dark:text-white' : 'border border-slate-200 dark:border-border-dark bg-transparent text-slate-500 dark:text-text-secondary hover:bg-slate-100 dark:hover:bg-[#233348] hover:text-slate-900 dark:hover:text-white' }} px-4 transition-colors">
                <span class="text-sm {{ request('category') == $category->id ? 'font-bold' : 'font-medium' }}">{{ $category->name }}</span>
            </button>
            @endforeach
        </div>
        <!-- Detailed Search -->
        <label class="flex flex-col min-w-40 h-10 w-full lg:w-80 relative">
            <div
                class="flex w-full flex-1 items-stretch rounded-lg h-full border border-slate-200 dark:border-border-dark bg-white dark:bg-[#1A2634] focus-within:ring-2 focus-within:ring-primary focus-within:border-transparent transition-all">
                <button type="submit" class="text-slate-400 dark:text-text-secondary flex items-center justify-center pl-3">
                    <span class="material-symbols-outlined text-[20px]">search</span>
                </button>
                <input
                    type="text"
                    name="search"
                    value="{{ request('search') }}"
                    class="flex w-full min-w-0 flex-1 resize-none bg-transparent text-slate-900 dark:text-white focus:outline-0 h-full placeholder:text-slate-400 dark:placeholder:text-text-secondary px-3 text-sm font-normal leading-normal"
                    placeholder="Cari item..." />
            </div>
        </label>
    </form>

    <!-- Inventory Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @forelse($inventories as $inventory)
            <div
                class="group flex flex-col rounded-xl border border-slate-200 dark:border-border-dark bg-white dark:bg-[#1A2634] overflow-hidden hover:border-primary/50 transition-all duration-300 shadow-sm hover:shadow-lg hover:shadow-primary/10">
                <div class="relative h-48 w-full overflow-hidden">
                    <div class="absolute top-3 left-3 z-10">
                        <span
                            class="inline-flex items-center gap-1 rounded-full bg-emerald-100/90 dark:bg-emerald-500/20 px-2.5 py-1 text-xs font-semibold text-emerald-700 dark:text-emerald-400 border border-emerald-200/50 dark:border-emerald-500/30 backdrop-blur-sm shadow-sm ring-1 ring-emerald-500/10">
                            <span class="h-1.5 w-1.5 rounded-full bg-emerald-500 shadow-[0_0_6px_rgba(16,_185,_129,_0.6)]"></span>
                            {{ $inventory->status ?? 'Digunakan' }}
                        </span>
                    </div>
                    <!-- Inventory Image -->
                    <div class="w-full h-full bg-white dark:bg-[#1a232e]">
                        @if($inventory->image_path)
                            <img class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110"
                                src="{{ asset('storage/' . $inventory->image_path) }}"
                                alt="{{ $inventory->item_name }}" />
                        @else
                            <div class="w-full h-full bg-gradient-to-br from-slate-100 to-slate-200 dark:from-[#1a232e] dark:to-[#233348] flex items-center justify-center">
                                <span class="material-symbols-outlined text-4xl text-slate-300 dark:text-slate-600">image</span>
                            </div>
                        @endif
                    </div>
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
                        <div class="flex items-center gap-2 mb-2">
                            <p class="text-slate-500 dark:text-text-secondary text-sm font-mono">
                                {{ $inventory->serial_number }}
                            </p>
                             @if($inventory->user_id === auth()->id())
                                <span class="inline-flex items-center rounded-md bg-blue-50 dark:bg-blue-900/20 px-2 py-1 text-xs font-medium text-blue-700 dark:text-blue-300 ring-1 ring-inset ring-blue-700/10 dark:ring-blue-400/20">Pribadi</span>
                            @else
                                <span class="inline-flex items-center rounded-md bg-purple-50 dark:bg-purple-900/20 px-2 py-1 text-xs font-medium text-purple-700 dark:text-purple-300 ring-1 ring-inset ring-purple-700/10 dark:ring-purple-400/20">Shared</span>
                            @endif
                        </div>
                    </div>
                    <div
                        class="grid grid-cols-2 gap-y-3 gap-x-2 text-sm border-t border-dashed border-slate-200 dark:border-border-dark pt-4">
                        <div class="flex flex-col">
                            <span class="text-slate-400 dark:text-text-secondary text-xs">Assigned Date</span>
                            <span
                                class="text-slate-900 dark:text-white font-medium">{{ $inventory->created_at->format('d M Y') }}</span>
                        </div>
                        <div class="flex flex-col">
                            <span class="text-slate-400 dark:text-text-secondary text-xs flex items-center gap-1">
                                Ownership
                                @if($inventory->user_id === auth()->id())
                                    <span class="material-symbols-outlined text-[14px] text-blue-500">person</span>
                                @else
                                    <span class="material-symbols-outlined text-[14px] text-purple-500">groups</span>
                                @endif
                            </span>
                            <span class="text-slate-900 dark:text-white font-medium">
                                {{ $inventory->user_id === auth()->id() ? 'Personal' : ($inventory->department->name ?? 'Department') }}
                            </span>
                        </div>
                        <div class="flex flex-col col-span-2">
                            <span class="text-slate-400 dark:text-text-secondary text-xs">Description</span>
                            <span
                                class="text-slate-900 dark:text-white font-medium truncate">{{ $inventory->description }}</span>
                        </div>
                    </div>
                    <div class="flex gap-2 mt-2">
                        <a href="{{ route('user.inventory.show', $inventory->id) }}"
                            class="flex-1 rounded-lg border border-slate-200 dark:border-border-dark bg-transparent py-2 text-xs font-bold text-slate-700 dark:text-white hover:bg-slate-50 dark:hover:bg-[#233348] transition-colors text-center">
                            Lihat Detail
                        </a>
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

