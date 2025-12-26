@extends('admin.layouts.app')

@section('title', 'Detail Tiket - Smart IT Helpdesk')

@section('content')
<div class="flex flex-col gap-6 p-4 md:p-8 max-w-[800px] mx-auto w-full">
    <!-- Breadcrumbs -->
    <div class="flex flex-wrap gap-2 text-sm">
        <a class="text-[#92a9c9] hover:text-white transition-colors font-medium" href="{{ route('admin.dashboard') }}">Dashboard</a>
        <span class="text-[#92a9c9] font-medium">/</span>
        <a class="text-[#92a9c9] hover:text-white transition-colors font-medium" href="{{ route('admin.tickets.index') }}">Kelola Tiket</a>
        <span class="text-[#92a9c9] font-medium">/</span>
        <span class="text-white font-medium">Detail Tiket #{{ $ticket->id }}</span>
    </div>

    <div class="rounded-xl border border-[#233348] bg-[#1a232e] p-6 flex flex-col gap-6">
        <!-- Ticket Info -->
        <div class="flex flex-col gap-4 border-b border-[#233348] pb-6">
            <div class="flex justify-between items-start">
                <h1 class="text-white text-2xl font-bold">{{ $ticket->subject }}</h1>
                <span class="inline-flex items-center gap-1 rounded-full px-2.5 py-0.5 text-xs font-medium border
                    {{ $ticket->status === 'pending' ? 'bg-yellow-500/10 text-yellow-500 border-yellow-500/20' : 
                       ($ticket->status === 'processing' ? 'bg-blue-500/10 text-blue-500 border-blue-500/20' : 'bg-green-500/10 text-green-500 border-green-500/20') }}">
                    {{ ucfirst($ticket->status) }}
                </span>
            </div>
            
            <div class="flex items-center gap-3">
                <div class="bg-center bg-no-repeat bg-cover rounded-full size-10 border border-[#233348]" 
                     style='background-image: url("https://ui-avatars.com/api/?name={{ urlencode($ticket->user->name) }}");'>
                </div>
                <div>
                    <p class="text-white font-medium">{{ $ticket->user->name }}</p>
                    <p class="text-[#92a9c9] text-xs">{{ $ticket->created_at->format('d M Y, H:i') }}</p>
                </div>
            </div>

            <div class="bg-[#111822] p-4 rounded-lg border border-[#324867]">
                <p class="text-slate-300">{{ $ticket->description }}</p>
            </div>

            @if($ticket->evidence_path)
            <div>
                <p class="text-[#92a9c9] text-sm font-medium mb-2">Lampiran Bukti:</p>
                <a href="{{ Storage::url($ticket->evidence_path) }}" target="_blank" class="inline-flex items-center gap-2 text-primary hover:underline">
                    <span class="material-symbols-outlined">attach_file</span>
                    Lihat Lampiran
                </a>
            </div>
            @endif
        </div>

        <!-- Admin Action Form -->
        <form action="{{ route('admin.tickets.update', $ticket) }}" method="POST" class="flex flex-col gap-4">
            @csrf
            @method('PUT')
            
            <h3 class="text-white text-lg font-bold">Respon Admin</h3>

            <div class="flex flex-col gap-2">
                <label for="status" class="text-white text-sm font-medium">Update Status</label>
                <select name="status" id="status" class="w-full rounded-lg border border-[#324867] bg-[#111822] p-2.5 text-white placeholder-[#92a9c9] focus:border-primary focus:ring-primary focus:outline-none transition-all">
                    <option value="pending" {{ $ticket->status == 'pending' ? 'selected' : '' }}>Pending</option>
                    <option value="processing" {{ $ticket->status == 'processing' ? 'selected' : '' }}>Processing</option>
                    <option value="completed" {{ $ticket->status == 'completed' ? 'selected' : '' }}>Completed</option>
                    <option value="rejected" {{ $ticket->status == 'rejected' ? 'selected' : '' }}>Rejected</option>
                </select>
            </div>

            <div class="flex flex-col gap-2">
                <label for="admin_response" class="text-white text-sm font-medium">Pesan / Balasan</label>
                <textarea name="admin_response" id="admin_response" rows="4" 
                          class="w-full rounded-lg border border-[#324867] bg-[#111822] p-2.5 text-white placeholder-[#92a9c9] focus:border-primary focus:ring-primary focus:outline-none transition-all"
                          placeholder="Tulis balasan untuk user...">{{ old('admin_response', $ticket->admin_response) }}</textarea>
            </div>

            <button type="submit" class="self-end px-5 py-2.5 rounded-lg bg-primary text-white font-bold hover:bg-blue-600 shadow-lg shadow-blue-500/20 transition-all">
                Update Tiket
            </button>
        </form>
    </div>
</div>
@endsection
