@extends('layouts.app')

@section('content')
    <!-- Page Heading -->
    <div class="flex flex-col gap-2 pb-6 border-b border-slate-200 dark:border-border-dark">
        <h1 class="text-slate-900 dark:text-white text-3xl md:text-4xl font-black leading-tight tracking-[-0.033em]">
            Frequently Asked Questions
        </h1>
        <p class="text-slate-500 dark:text-text-secondary text-base font-normal leading-normal max-w-2xl">
            Cari jawaban cepat untuk pertanyaan umum seputar layanan IT, perangkat keras, dan perangkat lunak kantor.
        </p>
    </div>

    <!-- Search Tool (Optional but good for UX) -->
    <div class="relative w-full max-w-xl">
        <div
            class="flex items-center rounded-lg border border-slate-200 dark:border-border-dark bg-white dark:bg-[#1A2634] overflow-hidden focus-within:ring-2 focus-within:ring-primary focus-within:border-transparent transition-all h-12">
            <div class="text-slate-400 dark:text-text-secondary flex items-center justify-center pl-4">
                <span class="material-symbols-outlined text-[24px]">search</span>
            </div>
            <input
                class="flex w-full min-w-0 flex-1 resize-none bg-transparent text-slate-900 dark:text-white focus:outline-0 h-full placeholder:text-slate-400 dark:placeholder:text-text-secondary px-4 text-base font-normal leading-normal"
                placeholder="Cari pertanyaan..." />
        </div>
    </div>

    <!-- FAQ Accordion List -->
    <div class="flex flex-col gap-4 mt-4" x-data="{ active: null }">
        @forelse($faqs as $faq)
            <div
                class="rounded-xl border border-slate-200 dark:border-border-dark bg-white dark:bg-[#1A2634] overflow-hidden transition-all duration-300">
                <button @click="active = active === {{ $loop->index }} ? null : {{ $loop->index }}"
                    class="w-full flex items-center justify-between p-6 text-left focus:outline-none">
                    <span class="text-lg font-bold text-slate-900 dark:text-white">{{ $faq->question }}</span>
                    <span class="material-symbols-outlined text-slate-400 transition-transform duration-300"
                        :class="active === {{ $loop->index }} ? 'rotate-180' : ''">expand_more</span>
                </button>
                <div x-show="active === {{ $loop->index }}" x-collapse
                    class="px-6 pb-6 text-slate-600 dark:text-slate-300 text-base leading-relaxed border-t border-slate-100 dark:border-border-dark/50 pt-4 mt-[-10px]">
                    {{ $faq->answer }}
                </div>
            </div>
        @empty
            <div class="col-span-full text-center py-10">
                <div class="bg-slate-100 dark:bg-[#233348] rounded-full p-4 mb-4 inline-block">
                    <span class="material-symbols-outlined text-4xl text-slate-400 dark:text-text-secondary">help_outline</span>
                </div>
                <h3 class="text-slate-900 dark:text-white text-lg font-bold">Belum ada pertanyaan</h3>
                <p class="text-slate-500 dark:text-text-secondary text-sm mt-1">FAQ akan segera ditambahkan oleh admin.</p>
            </div>
        @endforelse
    </div>

    <!-- Contact Support CTA -->
    <div class="mt-8 rounded-xl bg-primary/10 border border-primary/20 p-6 flex flex-col md:flex-row items-center justify-between gap-6">
        <div class="flex flex-col gap-2">
            <h3 class="text-lg font-bold text-slate-900 dark:text-white">Masih butuh bantuan?</h3>
            <p class="text-slate-500 dark:text-text-secondary text-base">Jika Anda tidak menemukan jawaban yang Anda cari, silakan hubungi tim support kami.</p>
        </div>
        <div class="flex gap-4">
            <a href="{{ route('tickets.create') }}" class="flex items-center justify-center gap-2 rounded-lg h-11 px-6 bg-primary hover:bg-blue-600 transition-colors text-white text-sm font-bold leading-normal shadow-lg shadow-blue-500/20">
                <span class="material-symbols-outlined">add_task</span>
                Buat Tiket
            </a>
            <a href="#" class="flex items-center justify-center gap-2 rounded-lg h-11 px-6 bg-white dark:bg-[#233348] border border-slate-200 dark:border-border-dark hover:bg-slate-50 dark:hover:bg-[#324867] transition-colors text-slate-900 dark:text-white text-sm font-bold leading-normal">
                <span class="material-symbols-outlined">chat</span>
                Chat AI
            </a>
        </div>
    </div>
@endsection
