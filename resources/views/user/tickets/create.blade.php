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
                        <input type="text" id="subject_input" name="subject" class="form-input flex w-full rounded-lg text-white focus:outline-none focus:ring-2 focus:ring-primary/50 border border-slate-700 bg-[#192433] h-14 placeholder:text-slate-500 px-4 text-base font-normal transition-all" placeholder="Contoh: Tidak bisa koneksi ke VPN" required value="{{ old('subject') }}"/>
                        @error('subject') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>
                    
                    <!-- Asset Selection -->
                    <div class="flex flex-col gap-2">
                        <label class="text-white text-sm font-semibold leading-normal">Pilih Aset <span class="text-red-500">*</span></label>
                        <div class="relative">
                            <select name="inventory_id" id="inventory_select" required class="form-select flex w-full appearance-none rounded-lg text-white focus:outline-none focus:ring-2 focus:ring-primary/50 border border-slate-700 bg-[#192433] h-14 placeholder:text-slate-500 px-4 pr-10 text-base font-normal transition-all cursor-pointer">
                                <option value="" selected disabled>-- Pilih Aset yang Mengalami Kendala --</option>
                                @foreach($inventories as $inventory)
                                    <option value="{{ $inventory->id }}" {{ request('asset_id') == $inventory->id ? 'selected' : '' }}>
                                        @if($inventory->user_id === auth()->id())
                                            👤 Personal - {{ $inventory->item_name }} ({{ $inventory->category->name ?? 'Uncategorized' }})
                                        @else
                                            🏢 Dept - {{ $inventory->item_name }} ({{ $inventory->category->name ?? 'Uncategorized' }})
                                        @endif
                                    </option>
                                @endforeach
                            </select>
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
                            <textarea name="description" id="description_input" class="w-full bg-[#192433] border-none text-white placeholder:text-slate-500 p-4 h-48 focus:ring-0 resize-y" placeholder="Jelaskan langkah-langkah yang menyebabkan masalah..." required>{{ old('description') }}</textarea>
                        </div>
                        @error('description') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>

                    <!-- File Attachment -->
                    <div class="flex flex-col gap-2">
                        <label class="text-white text-sm font-semibold leading-normal">Lampiran (Screenshot / Logs)</label>
                        
                        <!-- Upload Area -->
                        <div class="relative border-2 border-dashed border-slate-700 rounded-lg p-8 flex flex-col items-center justify-center text-slate-500 hover:bg-[#192433] hover:border-primary/50 hover:text-primary transition-all cursor-pointer group" id="upload_container">
                            <input type="file" name="evidence" id="evidence_input" accept="image/png, image/jpeg, application/pdf" class="absolute inset-0 w-full h-full opacity-0 cursor-pointer z-10" />
                            
                            <!-- Initial Prompt state -->
                            <div id="upload_prompt" class="flex flex-col items-center justify-center transition-opacity duration-300">
                                <div class="p-3 bg-[#233348] rounded-full mb-3 group-hover:bg-[#233348]/80">
                                    <span class="material-symbols-outlined text-3xl">cloud_upload</span>
                                </div>
                                <p class="text-sm font-medium">Klik untuk unggah atau seret file ke sini</p>
                                <p class="text-xs text-slate-500/70 mt-1">PNG, JPG, PDF up to 2MB</p>
                            </div>

                            <!-- Preview State -->
                            <div id="upload_preview" class="hidden flex-col items-center justify-center w-full z-20">
                                <img id="preview_image" src="" alt="Preview" class="max-h-48 rounded-lg shadow-md mb-3 object-contain hidden">
                                <div id="preview_file_info" class="hidden flex items-center gap-2 mb-3 bg-[#233348] px-3 py-2 rounded-lg border border-slate-600">
                                    <span class="material-symbols-outlined text-red-400">picture_as_pdf</span>
                                    <span id="preview_filename" class="text-sm text-white truncate max-w-[200px]">filename.pdf</span>
                                </div>
                                <button type="button" id="remove_file_btn" class="px-3 py-1 bg-red-500/10 hover:bg-red-500/20 text-red-500 text-xs font-bold rounded border border-red-500/20 transition-colors flex items-center gap-1">
                                    <span class="material-symbols-outlined text-[14px]">delete</span>
                                    Hapus File
                                </button>
                            </div>
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
                        <div class="flex flex-col gap-3" id="faq-suggestions">
                            <p class="text-xs text-slate-500 text-center italic py-2">Mulai mengetik judul atau pilih aset untuk melihat saran artikel...</p>
                        </div>
                    </div>

                    <!-- Announcements / Info -->
                    <div class="bg-[#192433] border border-slate-700 rounded-xl p-5 shadow-sm">
                        <h3 class="text-white text-base font-bold mb-4 flex items-center gap-2">
                            <span class="material-symbols-outlined text-yellow-500">campaign</span>
                            Info & Pengumuman
                        </h3>
                        <div class="space-y-4">
                            @forelse($announcements as $announcement)
                                <div class="flex flex-col gap-1 pb-3 border-b border-slate-700 last:border-0 last:pb-0">
                                    <div class="flex items-center justify-between">
                                        <span class="text-sm font-semibold text-white">{{ $announcement->title }}</span>
                                        @if($announcement->type === 'maintenance')
                                            <span class="px-1.5 py-0.5 rounded text-[10px] font-bold bg-orange-500/10 text-orange-400 border border-orange-500/20">MAINTENANCE</span>
                                        @elseif($announcement->type === 'urgent')
                                            <span class="px-1.5 py-0.5 rounded text-[10px] font-bold bg-red-500/10 text-red-400 border border-red-500/20">PENTING</span>
                                        @else
                                            <span class="px-1.5 py-0.5 rounded text-[10px] font-bold bg-blue-500/10 text-blue-400 border border-blue-500/20">INFO</span>
                                        @endif
                                    </div>
                                    <p class="text-xs text-slate-400 line-clamp-2 leading-relaxed">
                                        {{ Str::limit($announcement->content, 80) }}
                                    </p>
                                    <span class="text-[10px] text-slate-600 mt-1">{{ $announcement->created_at->diffForHumans() }}</span>
                                </div>
                            @empty
                                <div class="text-center py-4">
                                     <span class="material-symbols-outlined text-slate-600 text-3xl mb-1">check_circle</span>
                                     <p class="text-xs text-slate-500">Sistem berjalan normal. Tidak ada pengumuman.</p>
                                </div>
                            @endforelse
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

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const subjectInput = document.getElementById('subject_input');
            const descriptionInput = document.getElementById('description_input');
            const inventorySelect = document.getElementById('inventory_select');
            const suggestionsContainer = document.getElementById('faq-suggestions');
            let timeoutId;

            function fetchSuggestions() {
                const subject = subjectInput.value;
                const description = descriptionInput.value;
                const inventoryId = inventorySelect.value;

                if (subject.length < 3 && !inventoryId) {
                    suggestionsContainer.innerHTML = '<p class="text-xs text-slate-500 text-center italic py-2">Mulai mengetik judul atau pilih aset untuk melihat saran artikel...</p>';
                    return;
                }

                // Debounce
                clearTimeout(timeoutId);
                timeoutId = setTimeout(() => {
                    suggestionsContainer.innerHTML = '<div class="flex justify-center py-4"><span class="material-symbols-outlined animate-spin text-primary">progress_activity</span></div>';
                    
                    const params = new URLSearchParams({
                        subject: subject,
                        // description: description, // Maybe skip description for now to reduce noise or keep it simple
                        inventory_id: inventoryId
                    });

                    fetch(`{{ route('user.faq.search') }}?${params.toString()}`)
                        .then(response => response.json())
                        .then(data => {
                            suggestionsContainer.innerHTML = '';
                            if (data.length === 0) {
                                suggestionsContainer.innerHTML = '<p class="text-xs text-slate-500 text-center italic py-2">Tidak ada artikel yang cocok ditemukan.</p>';
                                return;
                            }

                            data.forEach(faq => {
                                const article = document.createElement('div'); // Changed from <a> to <div> as we handle click manually for expanding, or keep it wrapper
                                // Using div wrapper to allow internal buttons without navigation issues
                                article.className = 'group relative p-3 rounded-lg hover:bg-[#233348] transition-colors border border-transparent hover:border-slate-700';
                                
                                // Store data
                                article.dataset.full = faq.answer.replace(/<[^>]*>?/gm, ''); // Strip tags for text content, or handle HTML if safe
                                article.dataset.preview = faq.answer_preview;

                                article.innerHTML = `
                                    <div class="pr-6">
                                        <h4 class="text-white text-sm font-medium mb-1 group-hover:text-primary transition-colors">${faq.question}</h4>
                                        <p class="text-xs text-slate-500 line-clamp-2 transition-all duration-300">${faq.answer_preview}</p>
                                    </div>
                                    <button type="button" class="expand-btn absolute top-3 right-3 text-slate-500 hover:text-white transition-colors">
                                        <span class="material-symbols-outlined text-[20px]">expand_more</span>
                                    </button>
                                `;
                                suggestionsContainer.appendChild(article);
                                
                                // Separator
                                if (data.indexOf(faq) < data.length - 1) {
                                    const sep = document.createElement('div');
                                    sep.className = 'h-px bg-slate-700 w-full';
                                    suggestionsContainer.appendChild(sep);
                                }
                            });
                        })
                        .catch(err => {
                            console.error(err);
                            suggestionsContainer.innerHTML = '<p class="text-xs text-red-500 text-center italic py-2">Gagal memuat saran.</p>';
                        });
                }, 500); // 500ms delay
            }

            subjectInput.addEventListener('input', fetchSuggestions);
            inventorySelect.addEventListener('change', fetchSuggestions);
            // descriptionInput.addEventListener('input', fetchSuggestions); // Optional

            // Add event delegation for expand functionality
            suggestionsContainer.addEventListener('click', function(e) {
                const btn = e.target.closest('.expand-btn');
                if (btn) {
                    e.preventDefault();
                    // Find the article container (which is 2 levels up from the button: div > w-full or similar structure)
                    // The button is inside <button><span/></button>, inside absolute div, inside relative div, inside article <a>
                    // Actually, let's look at the structure I'm building below:
                    const article = btn.closest('.group');
                    const textP = article.querySelector('p');
                    const icon = btn.querySelector('.material-symbols-outlined');
                    
                    if (article.classList.contains('expanded')) {
                        // Collapse
                        article.classList.remove('expanded');
                        textP.classList.add('line-clamp-2');
                        textP.classList.remove('whitespace-pre-wrap'); 
                        icon.textContent = 'expand_more';
                        // Revert text to preview if needed, but we used CSS line-clamp so removing class is enough?
                        // Wait, data.foreach renders answer_preview. We need full answer.
                        // We store full answer in data attribute.
                        textP.textContent = article.dataset.preview;
                        
                    } else {
                        // Expand
                        article.classList.add('expanded');
                        textP.classList.remove('line-clamp-2');
                        textP.classList.add('whitespace-pre-wrap');
                        icon.textContent = 'expand_less';
                        // Set full answer
                        textP.textContent = article.dataset.full;
                    }
                }
            });

            // File Upload Preview Logic
            const evidenceInput = document.getElementById('evidence_input');
            const uploadPrompt = document.getElementById('upload_prompt');
            const uploadPreview = document.getElementById('upload_preview');
            const previewImage = document.getElementById('preview_image');
            const previewFileInfo = document.getElementById('preview_file_info');
            const previewFilename = document.getElementById('preview_filename');
            const removeFileBtn = document.getElementById('remove_file_btn');

            evidenceInput.addEventListener('change', function(e) {
                const file = e.target.files[0];
                if (!file) return;

                // Hide prompt, show preview container
                uploadPrompt.classList.add('hidden');
                uploadPreview.classList.remove('hidden');
                uploadPreview.classList.add('flex');

                if (file.type.startsWith('image/')) {
                    // Show Image Preview
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        previewImage.src = e.target.result;
                        previewImage.classList.remove('hidden');
                        previewFileInfo.classList.add('hidden');
                    }
                    reader.readAsDataURL(file);
                } else {
                    // Show File Info (e.g. PDF)
                    previewImage.classList.add('hidden');
                    previewFileInfo.classList.remove('hidden');
                    previewFileInfo.classList.add('flex');
                    previewFilename.textContent = file.name;
                }
            });

            removeFileBtn.addEventListener('click', function(e) {
                e.preventDefault(); // Prevent bubbling causing file input dialog to open again
                e.stopPropagation(); // Stop propagation to container
                
                // Clear input
                evidenceInput.value = '';
                
                // Reset UI
                uploadPreview.classList.add('hidden');
                uploadPreview.classList.remove('flex');
                uploadPrompt.classList.remove('hidden');
            });
        });
    </script>
