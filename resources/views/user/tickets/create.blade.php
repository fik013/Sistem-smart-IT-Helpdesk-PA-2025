@extends('layouts.app')

@section('content')
    <div class="flex flex-1 justify-center py-8">
        <div class="layout-content-container flex flex-col w-full max-w-[1200px] flex-1">
            <!-- Page Heading -->
            <div class="flex flex-wrap justify-between gap-3 px-4 pb-6 border-b border-white/10 mb-6">
                <div class="flex min-w-72 flex-col gap-2">
                    <h1 class="text-white text-3xl md:text-4xl font-black leading-tight tracking-[-0.033em]">Ajukan Tiket Bantuan</h1>
                    <p class="text-slate-400 text-base font-normal leading-normal max-w-2xl">
                        Isi formulir di bawah ini untuk melaporkan masalah teknis Anda. Sistem kami akan menyarankan artikel yang relevan saat Anda mengetik.
                    </p>
                </div>
            </div>

            <form method="POST" action="{{ route('tickets.store') }}" enctype="multipart/form-data" class="grid grid-cols-1 lg:grid-cols-3 gap-8 px-4">
                @csrf
                <!-- Left Column: Main Form -->
                <div class="lg:col-span-2 space-y-6">
                    <!-- Subject Field -->
                    <div class="flex flex-col gap-2">
                        <label class="text-white text-sm font-semibold leading-normal">Judul Masalah</label>
                        <input type="text" name="subject" class="form-input flex w-full rounded-lg text-white focus:outline-none focus:ring-2 focus:ring-primary/50 border border-slate-700 bg-[#192433] h-14 placeholder:text-slate-500 px-4 text-base font-normal transition-all" placeholder="Contoh: Tidak bisa koneksi ke VPN" required value="{{ old('subject') }}"/>
                        @error('subject') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>
                    
                    <!-- Asset Selection -->
                    <div class="flex flex-col gap-2">
                        <label class="text-white text-sm font-semibold leading-normal">Pilih Aset (Opsional)</label>
                        <div class="relative">
                            <select name="inventory_id" class="form-select flex w-full appearance-none rounded-lg text-white focus:outline-none focus:ring-2 focus:ring-primary/50 border border-slate-700 bg-[#192433] h-14 placeholder:text-slate-500 px-4 pr-10 text-base font-normal transition-all cursor-pointer">
                                <option value="" selected>Tidak ada aset spesifik / Umum</option>
                                @foreach($inventories as $inventory)
                                    <option value="{{ $inventory->id }}">{{ $inventory->name }} ({{ $inventory->type }})</option>
                                @endforeach
                            </select>
                            <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-4 text-slate-500">
                                <span class="material-symbols-outlined">expand_more</span>
                            </div>
                        </div>
                    </div>

                    <!-- Urgency/Priority Section -->
                    <div class="flex flex-col gap-3 pt-2">
                        <h2 class="text-white text-sm font-semibold leading-normal">Tingkat Urgensi</h2>
                        <div class="grid grid-cols-3 gap-4">
                            @foreach(['low' => ['Rendah', 'low_priority', 'green'], 'medium' => ['Sedang', 'equalizer', 'blue'], 'high' => ['Tinggi', 'priority_high', 'red']] as $key => $data)
                            <label class="cursor-pointer group">
                                <input type="radio" name="urgency" value="{{ $key }}" class="peer sr-only radio-card" {{ $key == 'low' ? 'checked' : '' }}/>
                                <div class="h-full rounded-lg border border-slate-700 bg-[#192433] p-4 flex flex-col items-center justify-center gap-3 hover:border-slate-500 transition-all 
                                     peer-checked:bg-{{ $data[2] }}-900/20 peer-checked:border-{{ $data[2] }}-500 peer-checked:text-{{ $data[2] }}-500">
                                    <span class="material-symbols-outlined text-3xl text-{{ $data[2] }}-500 group-hover:scale-110 transition-transform">{{ $data[1] }}</span>
                                    <span class="text-sm font-bold">{{ $data[0] }}</span>
                                </div>
                            </label>
                            @endforeach
                        </div>
                    </div>

                    <!-- Description Editor -->
                    <div class="flex flex-col gap-2">
                        <label class="text-white text-sm font-semibold leading-normal">Deskripsi Detail</label>
                        <div class="w-full rounded-lg border border-slate-700 bg-[#192433] overflow-hidden focus-within:ring-2 focus-within:ring-primary/50 focus-within:border-primary/50 transition-all">
                            <!-- Fake Toolbar -->
                            <div class="flex items-center gap-1 p-2 border-b border-slate-700 bg-[#233348] text-slate-400">
                                <button type="button" class="p-1.5 hover:bg-[#192433] hover:text-white rounded transition-colors"><span class="material-symbols-outlined text-[20px]">format_bold</span></button>
                                <button type="button" class="p-1.5 hover:bg-[#192433] hover:text-white rounded transition-colors"><span class="material-symbols-outlined text-[20px]">format_italic</span></button>
                                <div class="w-px h-5 bg-slate-700 mx-1"></div>
                                <button type="button" class="p-1.5 hover:bg-[#192433] hover:text-white rounded transition-colors"><span class="material-symbols-outlined text-[20px]">format_list_bulleted</span></button>
                            </div>
                            <textarea name="description" class="w-full bg-[#192433] border-none text-white placeholder:text-slate-500 p-4 h-48 focus:ring-0 resize-y" placeholder="Jelaskan langkah-langkah yang menyebabkan masalah..." required>{{ old('description') }}</textarea>
                        </div>
                        @error('description') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>

                    <!-- File Attachment -->
                    <div class="flex flex-col gap-2">
                        <label class="text-white text-sm font-semibold leading-normal">Lampiran (Screenshot / Logs)</label>
                        <div class="relative border-2 border-dashed border-slate-700 rounded-lg p-8 flex flex-col items-center justify-center text-slate-500 hover:bg-[#192433] hover:border-primary/50 hover:text-primary transition-all cursor-pointer group">
                            <input type="file" name="evidence" class="absolute inset-0 w-full h-full opacity-0 cursor-pointer" />
                            <div class="p-3 bg-[#233348] rounded-full mb-3 group-hover:bg-[#233348]/80">
                                <span class="material-symbols-outlined text-3xl">cloud_upload</span>
                            </div>
                            <p class="text-sm font-medium">Klik untuk unggah atau seret file ke sini</p>
                            <p class="text-xs text-slate-500/70 mt-1">PNG, JPG, PDF up to 2MB</p>
                        </div>
                    </div>

                    <!-- Action Buttons -->
                    <div class="flex items-center gap-4 pt-4">
                        <button type="submit" class="flex items-center justify-center gap-2 bg-primary hover:bg-blue-600 text-white font-medium py-3 px-8 rounded-lg transition-colors w-full md:w-auto shadow-lg shadow-blue-900/20">
                            <span class="material-symbols-outlined text-[20px]">send</span>
                            Kirim Tiket
                        </button>
                        <a href="{{ route('user.dashboard') }}" class="flex items-center justify-center gap-2 bg-transparent border border-slate-700 hover:bg-[#192433] text-slate-400 hover:text-white font-medium py-3 px-6 rounded-lg transition-colors w-full md:w-auto">
                            Batal
                        </a>
                    </div>
                </div>

                <!-- Right Column: Sidebar / Smart Suggestions -->
                <div class="lg:col-span-1 space-y-6">
                    <!-- AI Suggestion Card -->
                    <div class="bg-[#192433] border border-slate-700 rounded-xl p-5 shadow-sm">
                        <div class="flex items-center gap-2 mb-4 text-primary">
                            <span class="material-symbols-outlined">auto_awesome</span>
                            <h3 class="text-white text-base font-bold">Artikel yang Mungkin Membantu</h3>
                        </div>
                        <div class="flex flex-col gap-3">
                            <a class="group block p-3 rounded-lg hover:bg-[#233348] transition-colors border border-transparent hover:border-slate-700" href="#">
                                <h4 class="text-white text-sm font-medium mb-1 group-hover:text-primary transition-colors">Cara reset password VPN</h4>
                                <p class="text-xs text-slate-500 line-clamp-2">Ikuti panduan ini untuk mengatur ulang kata sandi VPN Anda secara mandiri...</p>
                            </a>
                            <div class="h-px bg-slate-700 w-full"></div>
                            <a class="group block p-3 rounded-lg hover:bg-[#233348] transition-colors border border-transparent hover:border-slate-700" href="#">
                                <h4 class="text-white text-sm font-medium mb-1 group-hover:text-primary transition-colors">Troubleshooting Koneksi Internet</h4>
                                <p class="text-xs text-slate-500 line-clamp-2">Langkah awal untuk memeriksa masalah jaringan sebelum membuat tiket...</p>
                            </a>
                        </div>
                    </div>

                    <!-- System Status -->
                    <div class="bg-[#192433] border border-slate-700 rounded-xl p-5 shadow-sm">
                        <h3 class="text-white text-base font-bold mb-4">Status Sistem</h3>
                        <div class="space-y-4">
                            <div class="flex items-center justify-between">
                                <div class="flex items-center gap-3">
                                    <div class="size-2.5 rounded-full bg-green-500 shadow-[0_0_8px_rgba(34,197,94,0.5)]"></div>
                                    <span class="text-sm text-slate-500">Network Core</span>
                                </div>
                                <span class="text-xs font-medium text-green-500 bg-green-500/10 px-2 py-0.5 rounded">Operational</span>
                            </div>
                            <!-- More status items... -->
                        </div>
                    </div>
                </div>
            </form>
            <!-- Footer Spacer -->
            <div class="h-20"></div>
        </div>
    </div>
    
    <style>
        .radio-card:checked + div {
            border-color: #136dec;
            background-color: rgba(19, 109, 236, 0.1);
        }
    </style>
@endsection
