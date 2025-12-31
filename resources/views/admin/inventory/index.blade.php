@extends('admin.layouts.app')

@section('title', 'Kelola Inventaris - Smart IT Helpdesk')

@section('content')
<div class="flex flex-col gap-6 p-4 md:p-8 max-w-[1200px] mx-auto">
    <!-- Breadcrumbs -->
    <div class="flex flex-wrap gap-2 text-sm">
        <a class="text-slate-500 dark:text-[#92a9c9] hover:text-[#101822] dark:hover:text-white transition-colors font-medium" href="{{ route('admin.dashboard') }}">Dashboard</a>
        <span class="text-slate-500 dark:text-[#92a9c9] font-medium">/</span>
        <span class="text-[#101822] dark:text-white font-medium">Kelola Inventaris</span>
    </div>

    <!-- Page Heading & Actions -->
    <div class="flex flex-col sm:flex-row sm:items-end justify-between gap-4">
        <div class="flex flex-col gap-2">
            <h1 class="text-[#101822] dark:text-white text-3xl md:text-4xl font-black leading-tight tracking-[-0.033em]">Asset Management</h1>
            <p class="text-slate-500 dark:text-[#92a9c9] text-base font-normal">Manage hardware and software assets assigned to users.</p>
        </div>
        <a href="{{ route('admin.inventory.create') }}" class="flex items-center justify-center gap-2 rounded-lg h-10 px-5 bg-primary hover:bg-blue-600 text-white text-sm font-bold shadow-lg shadow-blue-500/20 transition-all">
            <span class="material-symbols-outlined" style="font-size: 20px;">add</span>
            <span class="truncate">Tambah Aset Baru</span>
        </a>
    </div>

    <!-- Success Message -->
    @if(session('success'))
        <div class="p-4 mb-4 text-sm text-green-700 dark:text-green-400 rounded-lg bg-green-100 dark:bg-green-500/10 border border-green-200 dark:border-green-500/20" role="alert">
            <span class="font-medium">Success!</span> {{ session('success') }}
        </div>
    @endif

    <!-- Data Table -->
    <div class="rounded-xl border border-slate-200 dark:border-[#233348] overflow-hidden bg-white dark:bg-[#1a232e]">
        <div class="overflow-x-auto">
            <table class="w-full text-left text-sm text-slate-500 dark:text-[#92a9c9]">
                <thead class="bg-slate-100 dark:bg-[#233348] text-xs uppercase text-[#101822] dark:text-white font-semibold">
                    <tr>
                        <th class="px-6 py-4" scope="col">Item Details</th>
                        <th class="px-6 py-4" scope="col">Assigned To</th>
                        <th class="px-6 py-4" scope="col">Status</th>
                        <th class="px-6 py-4" scope="col">Description</th>
                        <th class="px-6 py-4 text-right" scope="col">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-200 dark:divide-[#233348]">
                    @forelse($inventories as $item)
                    <tr class="hover:bg-slate-50 dark:hover:bg-[#233348]/50 transition-colors group">
                        <td class="px-6 py-4">
                            <div class="flex flex-col">
                                <span class="font-medium text-[#101822] dark:text-white">{{ $item->item_name }}</span>
                                <span class="text-xs">S/N: {{ $item->serial_number ?? 'N/A' }}</span>
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            @if($item->department)
                                <div class="flex items-center gap-2">
                                    <div class="h-6 w-6 flex items-center justify-center rounded-full bg-indigo-100 dark:bg-indigo-900/50 text-indigo-600 dark:text-indigo-400">
                                        <span class="material-symbols-outlined text-[16px]">domain</span>
                                    </div>
                                    <span class="text-[#101822] dark:text-white">{{ $item->department->name }}</span>
                                    <span class="text-xs text-slate-400 dark:text-[#92a9c9]">(Dept)</span>
                                </div>
                            @elseif($item->user)
                                <div class="flex items-center gap-2">
                                    <div class="h-6 w-6 rounded-full bg-cover bg-center border border-slate-200 dark:border-transparent" style='background-image: url("https://ui-avatars.com/api/?name={{ urlencode($item->user->name) }}&size=24");'></div>
                                    <span class="text-[#101822] dark:text-white">{{ $item->user->name }}</span>
                                </div>
                            @else
                                <span class="text-slate-400 dark:text-[#92a9c9] italic">Unassigned</span>
                            @endif
                        </td>
                        <td class="px-6 py-4">
                            <span class="inline-flex items-center gap-1 rounded-full px-2.5 py-0.5 text-xs font-medium border
                                {{ $item->status === 'active' ? 'bg-emerald-50 dark:bg-emerald-500/10 text-emerald-600 dark:text-emerald-500 border-emerald-200 dark:border-emerald-500/20' : 
                                   ($item->status === 'maintenance' ? 'bg-yellow-50 dark:bg-yellow-500/10 text-yellow-600 dark:text-yellow-500 border-yellow-200 dark:border-yellow-500/20' : 'bg-red-50 dark:bg-red-500/10 text-red-600 dark:text-red-500 border-red-200 dark:border-red-500/20') }}">
                                {{ ucfirst($item->status) }}
                            </span>
                        </td>
                        <td class="px-6 py-4">
                            <span class="line-clamp-1" title="{{ $item->description }}">{{ $item->description ?? '-' }}</span>
                        </td>
                        <td class="px-6 py-4 text-right">
                            <div class="flex justify-end gap-2">
                                <a href="{{ route('admin.inventory.edit', $item) }}" class="rounded-lg p-2 text-slate-400 dark:text-[#92a9c9] hover:bg-primary/20 hover:text-primary dark:hover:text-white transition-colors" title="Edit Item">
                                    <span class="material-symbols-outlined text-[20px]">edit</span>
                                </a>
                                <form action="{{ route('admin.inventory.destroy', $item) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this item?');" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="rounded-lg p-2 text-slate-400 dark:text-[#92a9c9] hover:bg-red-500/20 hover:text-red-500 dark:hover:text-red-400 transition-colors" title="Delete Item">
                                        <span class="material-symbols-outlined text-[20px]">delete</span>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="px-6 py-4 text-center">No inventory items found.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <!-- Pagination -->
        <div class="bg-white dark:bg-[#1a232e] px-6 py-4 border-t border-slate-200 dark:border-[#233348]">
            {{ $inventories->links() }}
        </div>
    </div>
</div>
@endsection
