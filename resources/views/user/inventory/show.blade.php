@extends('layouts.app')

@section('content')
<div class="py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-4xl mx-auto">
        <!-- Breadcrumb -->
        <nav class="flex mb-5" aria-label="Breadcrumb">
            <ol class="inline-flex items-center space-x-1 md:space-x-3">
                <li class="inline-flex items-center">
                    <a href="{{ route('user.dashboard') }}" class="inline-flex items-center text-sm font-medium text-slate-700 hover:text-blue-600 dark:text-slate-400 dark:hover:text-white">
                        <span class="material-symbols-outlined mr-2 text-lg">dashboard</span>
                        Dashboard
                    </a>
                </li>
                <li>
                    <div class="flex items-center">
                        <span class="material-symbols-outlined text-slate-400 text-lg">chevron_right</span>
                        <a href="{{ route('user.inventory') }}" class="ml-1 text-sm font-medium text-slate-700 hover:text-blue-600 dark:text-slate-400 dark:hover:text-white md:ml-2">Inventaris Saya</a>
                    </div>
                </li>
                <li aria-current="page">
                    <div class="flex items-center">
                        <span class="material-symbols-outlined text-slate-400 text-lg">chevron_right</span>
                        <span class="ml-1 text-sm font-medium text-slate-500 dark:text-slate-400 md:ml-2">Detail Aset</span>
                    </div>
                </li>
            </ol>
        </nav>

        <div class="bg-white dark:bg-[#1A2634] rounded-2xl border border-slate-200 dark:border-border-dark overflow-hidden shadow-sm">
            <!-- Header Image Section -->
            <div class="relative w-full h-64 md:h-80 bg-slate-100 dark:bg-[#111822] group overflow-hidden">
                @if($inventory->image_path)
                    <img src="{{ asset('storage/' . $inventory->image_path) }}" alt="{{ $inventory->item_name }}" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105">
                     <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent"></div>
                @else
                    <div class="w-full h-full flex items-center justify-center bg-gradient-to-br from-indigo-50 to-blue-50 dark:from-[#111822] dark:to-[#1A2634]">
                        <span class="material-symbols-outlined text-8xl text-indigo-200 dark:text-indigo-900/50">inventory_2</span>
                    </div>
                @endif
                
                <!-- Status Badge Overlay -->
                <div class="absolute top-4 right-4 z-10">
                     <div class="inline-flex items-center gap-1.5 rounded-full bg-white/90 dark:bg-[#1A2634]/90 px-3 py-1 text-sm font-semibold shadow-lg backdrop-blur-sm border border-slate-200/50 dark:border-slate-700/50
                        {{ $inventory->status === 'active' ? 'text-emerald-600 dark:text-emerald-400' : ($inventory->status === 'maintenance' ? 'text-yellow-600 dark:text-yellow-400' : 'text-red-600 dark:text-red-400') }}">
                        <span class="h-2 w-2 rounded-full {{ $inventory->status === 'active' ? 'bg-emerald-500 shadow-[0_0_8px_rgba(16,185,129,0.5)]' : ($inventory->status === 'maintenance' ? 'bg-yellow-500' : 'bg-red-500') }}"></span>
                        {{ ucfirst($inventory->status) }}
                    </div>
                </div>

                <!-- Title Overlay -->
                 <div class="absolute bottom-0 left-0 right-0 p-6 md:p-8 text-white z-10">
                    <div class="flex flex-col md:flex-row md:items-end justify-between gap-4">
                        <div>
                            <div class="flex items-center gap-2 mb-2">
                                <span class="bg-blue-600/90 text-white text-[10px] md:text-xs font-bold px-2 py-0.5 rounded uppercase tracking-wider backdrop-blur-sm">
                                    {{ $inventory->category->name ?? 'Uncategorized' }}
                                </span>
                                @if($inventory->department)
                                     <span class="bg-purple-600/90 text-white text-[10px] md:text-xs font-bold px-2 py-0.5 rounded uppercase tracking-wider backdrop-blur-sm flex items-center gap-1">
                                        <span class="material-symbols-outlined text-[12px]">domain</span>
                                        {{ $inventory->department->name }}
                                     </span>
                                @else
                                    <span class="bg-indigo-600/90 text-white text-[10px] md:text-xs font-bold px-2 py-0.5 rounded uppercase tracking-wider backdrop-blur-sm flex items-center gap-1">
                                        <span class="material-symbols-outlined text-[12px]">person</span>
                                        Personal
                                     </span>
                                @endif
                            </div>
                            <h1 class="text-3xl md:text-4xl font-black tracking-tight text-white mb-1 shadow-black/50 drop-shadow-md">{{ $inventory->item_name }}</h1>
                            <p class="text-slate-200 font-mono text-sm md:text-base opacity-90">S/N: {{ $inventory->serial_number ?? 'N/A' }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="p-6 md:p-8">
                <!-- Main Info Grid -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    <!-- Left Column: Details -->
                    <div class="md:col-span-2 space-y-8">
                        <div>
                            <h3 class="text-lg font-bold text-slate-900 dark:text-white mb-3 flex items-center gap-2">
                                <span class="material-symbols-outlined text-primary">description</span>
                                Deskripsi & Spesifikasi
                            </h3>
                            <div class="prose dark:prose-invert max-w-none text-slate-600 dark:text-slate-300 bg-slate-50 dark:bg-[#111822] p-6 rounded-xl border border-slate-100 dark:border-border-dark">
                                @if($inventory->description)
                                    <p class="whitespace-pre-line leading-relaxed">{{ $inventory->description }}</p>
                                @else
                                    <p class="italic text-slate-400">Tidak ada deskripsi tersedia.</p>
                                @endif
                            </div>
                        </div>

                         <div>
                            <h3 class="text-lg font-bold text-slate-900 dark:text-white mb-3 flex items-center gap-2">
                                <span class="material-symbols-outlined text-primary">history</span>
                                Riwayat Singkat
                            </h3>
                             <div class="relative pl-6 border-l-2 border-slate-200 dark:border-slate-700 space-y-6">
                                <div class="relative">
                                    <span class="absolute -left-[29px] top-1 h-3 w-3 rounded-full bg-blue-500 ring-4 ring-white dark:ring-[#1A2634]"></span>
                                    <p class="text-sm font-semibold text-slate-900 dark:text-white">Ditambahkan ke  inventaris Anda</p>
                                    <p class="text-xs text-slate-500">{{ $inventory->created_at->format('d M Y, H:i') }}</p>
                                </div>
                                 <div class="relative">
                                    <span class="absolute -left-[29px] top-1 h-3 w-3 rounded-full bg-slate-300 dark:bg-slate-600 ring-4 ring-white dark:ring-[#1A2634]"></span>
                                    <p class="text-sm font-semibold text-slate-500 dark:text-slate-400">Aset Terdaftar</p>
                                    <p class="text-xs text-slate-500">{{ $inventory->created_at->format('d M Y, H:i') }}</p>
                                </div>
                            </div>
                         </div>
                    </div>

                    <!-- Right Column: Meta Info & Actions -->
                    <div class="space-y-6">
                        <div class="bg-slate-50 dark:bg-[#111822] rounded-xl p-5 border border-slate-100 dark:border-border-dark">
                            <h4 class="text-sm font-bold text-slate-900 dark:text-white uppercase tracking-wider mb-4 border-b border-slate-200 dark:border-slate-700 pb-2">Informasi Aset</h4>
                            
                            <ul class="space-y-4 text-sm">
                                <li class="flex justify-between">
                                    <span class="text-slate-500 dark:text-slate-400">Kategori</span>
                                    <span class="font-medium text-slate-900 dark:text-white">{{ $inventory->category->name ?? '-' }}</span>
                                </li>
                                <li class="flex justify-between">
                                    <span class="text-slate-500 dark:text-slate-400">Tanggal Assign</span>
                                    <span class="font-medium text-slate-900 dark:text-white">{{ $inventory->created_at->format('d M Y') }}</span>
                                </li>
                                <li class="flex justify-between">
                                    <span class="text-slate-500 dark:text-slate-400">Pemilik</span>
                                    <span class="font-medium text-slate-900 dark:text-white">
                                        {{ $inventory->department ? $inventory->department->name : 'Personal' }}
                                    </span>
                                </li>
                                <li class="flex justify-between">
                                    <span class="text-slate-500 dark:text-slate-400">Kondisi</span>
                                    <span class="font-medium {{ $inventory->status === 'active' ? 'text-emerald-600' : 'text-slate-900 dark:text-white' }}">
                                        {{ ucfirst($inventory->status) }}
                                    </span>
                                </li>
                            </ul>
                        </div>

                        <div class="bg-blue-50 dark:bg-blue-900/10 rounded-xl p-5 border border-blue-100 dark:border-blue-900/20">
                            <div class="flex items-start gap-3">
                                <span class="material-symbols-outlined text-blue-600 dark:text-blue-400 text-2xl">support_agent</span>
                                <div>
                                    <h4 class="font-bold text-blue-900 dark:text-blue-100 text-sm mb-1">Butuh Bantuan?</h4>
                                    <p class="text-xs text-blue-700 dark:text-blue-300 mb-3 leading-relaxed">
                                        Jika aset ini mengalami kendala atau kerusakan, segera laporkan untuk mendapatkan penanganan.
                                    </p>
                                    <a href="{{ route('tickets.create', ['asset_id' => $inventory->id]) }}" class="inline-flex items-center justify-center w-full px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white text-sm font-bold rounded-lg transition-colors shadow-sm hover:shadow-md">
                                        Laporkan Masalah
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
