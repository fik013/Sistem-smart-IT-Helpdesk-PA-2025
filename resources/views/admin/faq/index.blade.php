@extends('admin.layouts.app')

@section('title', 'Kelola FAQ - Smart IT Helpdesk')

@section('content')
<div class="flex flex-col gap-6 p-4 md:p-8 max-w-[1200px] mx-auto">
    <!-- Breadcrumbs -->
    <div class="flex flex-wrap gap-2 text-sm">
        <a class="text-[#92a9c9] hover:text-white transition-colors font-medium" href="{{ route('admin.dashboard') }}">Dashboard</a>
        <span class="text-[#92a9c9] font-medium">/</span>
        <span class="text-white font-medium">Kelola FAQ</span>
    </div>

    <!-- Page Heading & Actions -->
    <div class="flex flex-col sm:flex-row sm:items-end justify-between gap-4">
        <div class="flex flex-col gap-2">
            <h1 class="text-white text-3xl md:text-4xl font-black leading-tight tracking-[-0.033em]">Frequently Asked Questions</h1>
            <p class="text-[#92a9c9] text-base font-normal">Manage questions and answers displayed to users.</p>
        </div>
        <a href="{{ route('admin.faq.create') }}" class="flex items-center justify-center gap-2 rounded-lg h-10 px-5 bg-primary hover:bg-blue-600 text-white text-sm font-bold shadow-lg shadow-blue-500/20 transition-all">
            <span class="material-symbols-outlined" style="font-size: 20px;">add</span>
            <span class="truncate">Tambah FAQ Baru</span>
        </a>
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
                        <th class="px-6 py-4" scope="col">Question</th>
                        <th class="px-6 py-4" scope="col">Answer</th>
                        <th class="px-6 py-4" scope="col" style="width: 150px;">Last Updated</th>
                        <th class="px-6 py-4 text-right" scope="col" style="width: 120px;">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-[#233348]">
                    @forelse($faqs as $faq)
                    <tr class="hover:bg-[#233348]/50 transition-colors group">
                        <td class="px-6 py-4">
                            <div class="font-medium text-white">{{ $faq->question }}</div>
                        </td>
                        <td class="px-6 py-4">
                            <div class="line-clamp-2">{{ Str::limit($faq->answer, 100) }}</div>
                        </td>
                        <td class="px-6 py-4">
                            <div>{{ $faq->updated_at->format('M d, Y') }}</div>
                        </td>
                        <td class="px-6 py-4 text-right">
                            <div class="flex justify-end gap-2">
                                <a href="{{ route('admin.faq.edit', $faq) }}" class="rounded-lg p-2 text-[#92a9c9] hover:bg-primary/20 hover:text-white transition-colors" title="Edit FAQ">
                                    <span class="material-symbols-outlined text-[20px]">edit</span>
                                </a>
                                <form action="{{ route('admin.faq.destroy', $faq) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this FAQ?');" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="rounded-lg p-2 text-[#92a9c9] hover:bg-red-500/20 hover:text-red-400 transition-colors" title="Delete FAQ">
                                        <span class="material-symbols-outlined text-[20px]">delete</span>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="px-6 py-4 text-center">No FAQ data available.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <!-- Pagination -->
        <div class="bg-[#1a232e] px-6 py-4 border-t border-[#233348]">
            {{ $faqs->links() }}
        </div>
    </div>
</div>
@endsection
