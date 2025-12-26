@extends('admin.layouts.app')

@section('title', 'Tambah FAQ - Smart IT Helpdesk')

@section('content')
<div class="flex flex-col gap-6 p-4 md:p-8 max-w-[800px] mx-auto w-full">
    <!-- Breadcrumbs -->
    <div class="flex flex-wrap gap-2 text-sm">
        <a class="text-[#92a9c9] hover:text-white transition-colors font-medium" href="{{ route('admin.dashboard') }}">Dashboard</a>
        <span class="text-[#92a9c9] font-medium">/</span>
        <a class="text-[#92a9c9] hover:text-white transition-colors font-medium" href="{{ route('admin.faq.index') }}">Kelola FAQ</a>
        <span class="text-[#92a9c9] font-medium">/</span>
        <span class="text-white font-medium">Tambah FAQ</span>
    </div>

    <!-- Page Heading -->
    <div class="flex flex-col gap-2">
        <h1 class="text-white text-3xl font-black leading-tight tracking-[-0.033em]">Tambah FAQ Baru</h1>
        <p class="text-[#92a9c9] text-base font-normal">Create a new commonly asked question for users.</p>
    </div>

    <!-- Form -->
    <div class="rounded-xl border border-[#233348] bg-[#1a232e] p-6">
        <form action="{{ route('admin.faq.store') }}" method="POST" class="flex flex-col gap-6">
            @csrf
            
            <!-- Question -->
            <div class="flex flex-col gap-2">
                <label for="question" class="text-white text-sm font-medium">Pertanyaan</label>
                <input type="text" name="question" id="question" 
                       class="w-full rounded-lg border border-[#324867] bg-[#111822] p-2.5 text-white placeholder-[#92a9c9] focus:border-primary focus:ring-primary focus:outline-none transition-all @error('question') border-red-500 @enderror"
                       placeholder="Contoh: Bagaimana cara reset password?" value="{{ old('question') }}">
                @error('question')
                    <p class="text-red-400 text-xs">{{ $message }}</p>
                @enderror
            </div>

            <!-- Answer -->
            <div class="flex flex-col gap-2">
                <label for="answer" class="text-white text-sm font-medium">Jawaban</label>
                <textarea name="answer" id="answer" rows="6" 
                          class="w-full rounded-lg border border-[#324867] bg-[#111822] p-2.5 text-white placeholder-[#92a9c9] focus:border-primary focus:ring-primary focus:outline-none transition-all @error('answer') border-red-500 @enderror"
                          placeholder="Tulis jawaban lengkap di sini...">{{ old('answer') }}</textarea>
                @error('answer')
                    <p class="text-red-400 text-xs">{{ $message }}</p>
                @enderror
            </div>

            <!-- Actions -->
            <div class="flex items-center justify-end gap-3 pt-4 border-t border-[#233348]">
                <a href="{{ route('admin.faq.index') }}" class="px-5 py-2.5 rounded-lg text-[#92a9c9] font-medium hover:bg-[#233348] hover:text-white transition-colors">
                    Batal
                </a>
                <button type="submit" class="px-5 py-2.5 rounded-lg bg-primary text-white font-bold hover:bg-blue-600 shadow-lg shadow-blue-500/20 transition-all">
                    Simpan FAQ
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
