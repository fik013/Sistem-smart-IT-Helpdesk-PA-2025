@extends('admin.layouts.app')

@section('title', 'Kelola Tiket - Smart IT Helpdesk')

@section('content')
<div class="flex flex-col gap-6 p-4 md:p-8 max-w-[1200px] mx-auto">
    <!-- Breadcrumbs -->
    <div class="flex flex-wrap gap-2 text-sm">
        <a class="text-[#92a9c9] hover:text-white transition-colors font-medium" href="{{ route('admin.dashboard') }}">Dashboard</a>
        <span class="text-[#92a9c9] font-medium">/</span>
        <span class="text-white font-medium">Kelola Tiket</span>
    </div>

    <!-- Page Heading -->
    <div class="flex flex-col sm:flex-row sm:items-end justify-between gap-4">
        <div class="flex flex-col gap-2">
            <h1 class="text-white text-3xl md:text-4xl font-black leading-tight tracking-[-0.033em]">Kelola Tiket Masuk</h1>
            <p class="text-[#92a9c9] text-base font-normal">Daftar tiket yang diurutkan berdasarkan Prioritas SAW.</p>
        </div>
    </div>

    <!-- Success Message -->
    @if(session('success'))
        <div class="p-4 mb-4 text-sm text-green-400 rounded-lg bg-green-500/10 border border-green-500/20" role="alert">
            <span class="font-medium">Success!</span> {{ session('success') }}
        </div>
    @endif

    <!-- Data Table -->
    <div class="rounded-xl border border-[#233348] overflow-hidden bg-[#1a232e]">
        <div class="overflow-x-auto">
            <table class="w-full text-left text-sm text-[#92a9c9]">
                <thead class="bg-[#233348] text-xs uppercase text-white font-semibold">
                    <tr>
                        <th class="px-6 py-4" scope="col">SAW Score</th>
                        <th class="px-6 py-4" scope="col">Subject</th>
                        <th class="px-6 py-4" scope="col">User</th>
                        <th class="px-6 py-4" scope="col">Status</th>
                        <th class="px-6 py-4" scope="col">Date</th>
                        <th class="px-6 py-4 text-right" scope="col">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-[#233348]">
                    @forelse($tickets as $ticket)
                    <tr class="hover:bg-[#233348]/50 transition-colors group">
                        <td class="px-6 py-4">
                            <span class="inline-flex items-center rounded-md bg-blue-500/10 px-2 py-1 text-xs font-bold text-blue-400 ring-1 ring-inset ring-blue-500/20">
                                {{ number_format($ticket->saw_score, 3) }}
                            </span>
                        </td>
                        <td class="px-6 py-4">
                            <div class="font-medium text-white">{{ $ticket->subject }}</div>
                            <div class="text-xs truncate w-48">{{ Str::limit($ticket->description, 50) }}</div>
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex items-center gap-2">
                                <div class="h-6 w-6 rounded-full bg-cover bg-center" style='background-image: url("https://ui-avatars.com/api/?name={{ urlencode($ticket->user->name) }}&size=24");'></div>
                                <span class="text-white">{{ $ticket->user->name }}</span>
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            <span class="inline-flex items-center gap-1 rounded-full px-2.5 py-0.5 text-xs font-medium border
                                {{ $ticket->status === 'pending' ? 'bg-yellow-500/10 text-yellow-500 border-yellow-500/20' : 
                                   ($ticket->status === 'processing' ? 'bg-blue-500/10 text-blue-500 border-blue-500/20' : 'bg-green-500/10 text-green-500 border-green-500/20') }}">
                                {{ ucfirst($ticket->status) }}
                            </span>
                        </td>
                        <td class="px-6 py-4">
                            <div>{{ $ticket->created_at->diffForHumans() }}</div>
                        </td>
                        <td class="px-6 py-4 text-right">
                            <div class="flex justify-end gap-2">
                                <a href="{{ route('admin.tickets.show', $ticket) }}" class="rounded-lg px-3 py-1.5 bg-primary hover:bg-blue-600 text-white text-xs font-bold transition-colors">
                                    Process
                                </a>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="px-6 py-4 text-center">Tidak ada tiket pending saat ini.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <!-- Pagination -->
        <div class="bg-[#1a232e] px-6 py-4 border-t border-[#233348]">
            {{ $tickets->links() }}
        </div>
    </div>
</div>
@endsection
