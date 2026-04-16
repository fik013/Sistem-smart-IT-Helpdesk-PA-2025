@extends('admin.layouts.app')

@section('title', 'Kelola Pengumuman')

@push('styles')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/themes/dark.css">
@endpush

@section('content')
<div class="mx-auto max-w-6xl p-6 lg:p-10 flex flex-col gap-6">
    <!-- Breadcrumbs -->
    <div class="flex flex-wrap gap-2 text-sm">
        <a class="text-slate-500 dark:text-[#92a9c9] font-medium hover:text-primary transition-colors" href="{{ route('admin.dashboard') }}">Dashboard</a>
        <span class="text-slate-400 dark:text-[#64748b]">/</span>
        <span class="text-slate-900 dark:text-white font-medium">Pengumuman</span>
    </div>

    <!-- Page Heading -->
    <div class="flex flex-wrap justify-between items-end gap-4 border-b border-slate-200 dark:border-[#233348] pb-6">
        <div class="flex flex-col gap-2 max-w-2xl">
            <h1 class="text-slate-900 dark:text-white text-3xl md:text-4xl font-black leading-tight tracking-[-0.033em]">Kelola Pengumuman</h1>
            <p class="text-slate-600 dark:text-[#92a9c9] text-base font-normal leading-relaxed">Buat dan kelola informasi yang akan ditampilkan kepada seluruh pengguna.</p>
        </div>
        <button onclick="openCreateModal()" class="flex items-center justify-center gap-2 rounded-lg bg-primary hover:bg-blue-600 text-white px-5 py-2.5 text-sm font-bold transition-all shadow-lg shadow-primary/30">
            <span class="material-symbols-outlined text-[20px]">add</span>
            <span>Buat Pengumuman</span>
        </button>
    </div>

    <!-- Stats Overview -->
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-4">
        <div class="flex flex-col gap-2 rounded-xl p-5 border border-slate-200 dark:border-[#233348] bg-surface-light dark:bg-surface-dark">
            <div class="flex justify-between items-start">
                <p class="text-slate-500 dark:text-[#92a9c9] text-sm font-medium uppercase tracking-wider">Total Info</p>
                <span class="material-symbols-outlined text-slate-400 dark:text-[#92a9c9]">campaign</span>
            </div>
            <div class="flex items-baseline gap-2">
                <p class="text-[#101822] dark:text-white text-3xl font-bold">{{ \App\Models\Announcement::count() }}</p>
            </div>
        </div>
        <div class="flex flex-col gap-2 rounded-xl p-5 border border-slate-200 dark:border-[#233348] bg-surface-light dark:bg-surface-dark">
            <div class="flex justify-between items-start">
                <p class="text-green-600 dark:text-green-500 text-sm font-medium uppercase tracking-wider">Aktif</p>
                <span class="material-symbols-outlined text-green-600 dark:text-green-500">check_circle</span>
            </div>
            <div class="flex items-baseline gap-2">
                <p class="text-[#101822] dark:text-white text-3xl font-bold">{{ \App\Models\Announcement::where('is_active', true)->where('end_date', '>', now())->count() }}</p>
            </div>
        </div>
        <div class="flex flex-col gap-2 rounded-xl p-5 border border-slate-200 dark:border-[#233348] bg-surface-light dark:bg-surface-dark">
            <div class="flex justify-between items-start">
                <p class="text-yellow-600 dark:text-yellow-500 text-sm font-medium uppercase tracking-wider">Berakhir segera</p>
                <span class="material-symbols-outlined text-yellow-600 dark:text-yellow-500">timer</span>
            </div>
            <div class="flex items-baseline gap-2">
                <p class="text-[#101822] dark:text-white text-3xl font-bold">{{ \App\Models\Announcement::where('end_date', '>', now())->where('end_date', '<', now()->addDays(3))->count() }}</p>
            </div>
        </div>
        <div class="flex flex-col gap-2 rounded-xl p-5 border border-slate-200 dark:border-[#233348] bg-surface-light dark:bg-surface-dark">
            <div class="flex justify-between items-start">
                <p class="text-red-600 dark:text-red-500 text-sm font-medium uppercase tracking-wider">Penting</p>
                <span class="material-symbols-outlined text-red-600 dark:text-red-500">warning</span>
            </div>
            <div class="flex items-baseline gap-2">
                <p class="text-[#101822] dark:text-white text-3xl font-bold">{{ \App\Models\Announcement::where('type', 'critical')->where('is_active', true)->count() }}</p>
            </div>
        </div>
    </div>

    <!-- Data Table -->
    <div class="rounded-xl border border-slate-200 dark:border-[#324867] bg-surface-light dark:bg-surface-dark shadow-sm overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left text-sm">
                <thead class="bg-slate-50 dark:bg-[#111822] border-b border-slate-200 dark:border-[#324867]">
                    <tr>
                        <th class="px-6 py-4 font-semibold text-slate-900 dark:text-white" scope="col">Judul & Isi</th>
                        <th class="px-6 py-4 font-semibold text-slate-900 dark:text-white" scope="col">Tingkat Urgensi</th>
                        <th class="px-6 py-4 font-semibold text-slate-900 dark:text-white" scope="col">Durasi Tayang</th>
                        <th class="px-6 py-4 font-semibold text-slate-900 dark:text-white" scope="col">Status</th>
                        <th class="px-6 py-4 font-semibold text-slate-900 dark:text-white text-right" scope="col">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-200 dark:divide-[#324867]">
                    @forelse($announcements as $announcement)
                    <tr class="group hover:bg-slate-50 dark:hover:bg-[#253246] transition-colors">
                        <td class="px-6 py-4 max-w-sm">
                            <div class="font-bold text-slate-900 dark:text-white mb-1">{{ $announcement->title }}</div>
                            <div class="text-xs text-slate-500 dark:text-slate-400 line-clamp-2">{{ $announcement->content }}</div>
                        </td>
                        <td class="px-6 py-4">
                            @php
                                $badgeColor = match($announcement->type) {
                                    'critical' => 'bg-red-50 text-red-700 ring-red-600/20 dark:bg-red-900/30 dark:text-red-400 dark:ring-red-500/30',
                                    'warning' => 'bg-yellow-50 text-yellow-700 ring-yellow-600/20 dark:bg-yellow-900/30 dark:text-yellow-400 dark:ring-yellow-500/30',
                                    default => 'bg-blue-50 text-blue-700 ring-blue-700/10 dark:bg-blue-900/30 dark:text-blue-400 dark:ring-blue-500/30',
                                };
                                $label = match($announcement->type) {
                                    'critical' => 'Penting',
                                    'warning' => 'Sedang',
                                    default => 'Informasi',
                                };
                            @endphp
                            <span class="inline-flex items-center rounded-md px-2 py-1 text-xs font-medium ring-1 ring-inset {{ $badgeColor }}">
                                {{ $label }}
                            </span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-slate-500 dark:text-slate-400 text-xs">
                            <div class="flex flex-col gap-1">
                                <span>Mulai: {{ $announcement->start_date ? $announcement->start_date->format('d M Y H:i') : '-' }}</span>
                                <span>Selesai: {{ $announcement->end_date ? $announcement->end_date->format('d M Y H:i') : '-' }}</span>
                                @if($announcement->end_date && $announcement->end_date < now())
                                    <span class="text-red-500 font-bold">(Expired)</span>
                                @endif
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            <form action="{{ route('admin.announcements.toggle', $announcement->id) }}" method="POST" class="inline">
                                @csrf
                                @method('PATCH')
                                <button type="submit" class="relative inline-flex h-6 w-11 items-center rounded-full transition-colors focus:outline-none focus:ring-2 focus:ring-primary focus:ring-offset-2 {{ $announcement->is_active ? 'bg-green-500' : 'bg-slate-200 dark:bg-slate-700' }}">
                                    <span class="sr-only">Toggle status</span>
                                    <span class="inline-block h-4 w-4 transform rounded-full bg-white transition {{ $announcement->is_active ? 'translate-x-6' : 'translate-x-1' }}"></span>
                                </button>
                            </form>
                        </td>
                        <td class="px-6 py-4 text-right">
                            <div class="flex justify-end gap-2">
                                <button onclick='openEditModal(@json($announcement))' class="p-2 rounded-lg text-slate-400 hover:text-primary hover:bg-blue-50 dark:hover:bg-blue-900/20 transition-all" title="Edit">
                                    <span class="material-symbols-outlined text-[20px]">edit</span>
                                </button>
                                <form action="{{ route('admin.announcements.destroy', $announcement->id) }}" method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="button" onclick="confirmDelete(this, 'Hapus pengumuman ini?')" class="p-2 rounded-lg text-slate-400 hover:text-red-500 hover:bg-red-50 dark:hover:bg-red-900/20 transition-all" title="Delete">
                                        <span class="material-symbols-outlined text-[20px]">delete</span>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="px-6 py-8 text-center text-slate-500 dark:text-slate-400">
                            Belum ada pengumuman yang dibuat.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="p-4 border-t border-slate-200 dark:border-[#324867]">
            {{ $announcements->links() }}
        </div>
    </div>
</div>

<!-- Create/Edit Modal -->
<div id="announcementModal" class="fixed inset-0 z-50 hidden overflow-y-auto">
    <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
        <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" onclick="closeModal()"></div>
        <div class="inline-block align-bottom bg-white dark:bg-[#1a232e] rounded-lg text-left overflow-visible shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-xl sm:w-full border border-slate-200 dark:border-[#233348]">
            <form id="announcementForm" method="POST">
                @csrf
                <div id="methodField"></div>
                <div class="bg-white dark:bg-[#1a232e] px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                    <h3 class="text-lg font-bold text-slate-900 dark:text-white mb-4" id="modalTitle">Buat Pengumuman Baru</h3>
                    <div class="space-y-4">
                        <div>
                            <label class="block text-sm font-medium text-slate-700 dark:text-[#92a9c9]">Judul Pengumuman</label>
                            <input type="text" name="title" id="title" required class="mt-1 block w-full rounded-md border-slate-300 dark:border-[#324867] bg-white dark:bg-[#111822] text-[#101822] dark:text-white shadow-sm focus:border-primary focus:ring-primary sm:text-sm" placeholder="Contoh: Maintenance Server">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-slate-700 dark:text-[#92a9c9]">Tingkat Urgensi</label>
                            <select name="type" id="type" class="mt-1 block w-full rounded-md border-slate-300 dark:border-[#324867] bg-white dark:bg-[#111822] text-[#101822] dark:text-white shadow-sm focus:border-primary focus:ring-primary sm:text-sm">
                                <option value="info">Informasi (Biasa)</option>
                                <option value="warning">Sedang (Perhatian)</option>
                                <option value="critical">Penting (Darurat)</option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-slate-700 dark:text-[#92a9c9]">Isi Pengumuman</label>
                            <textarea name="content" id="content" rows="4" required class="mt-1 block w-full rounded-md border-slate-300 dark:border-[#324867] bg-white dark:bg-[#111822] text-[#101822] dark:text-white shadow-sm focus:border-primary focus:ring-primary sm:text-sm"></textarea>
                        </div>
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-medium text-slate-700 dark:text-[#92a9c9]">Tanggal Mulai</label>
                                <input type="text" name="start_date" id="start_date" required class="datetimepicker mt-1 block w-full rounded-md border-slate-300 dark:border-[#324867] bg-white dark:bg-[#111822] text-[#101822] dark:text-white shadow-sm focus:border-primary focus:ring-primary sm:text-sm" placeholder="Pilih waktu...">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-slate-700 dark:text-[#92a9c9]">Tanggal Selesai</label>
                                <input type="text" name="end_date" id="end_date" required class="datetimepicker mt-1 block w-full rounded-md border-slate-300 dark:border-[#324867] bg-white dark:bg-[#111822] text-[#101822] dark:text-white shadow-sm focus:border-primary focus:ring-primary sm:text-sm" placeholder="Pilih waktu...">
                            </div>
                        </div>
                        <div class="flex items-center gap-2">
                             <input type="checkbox" name="is_active" id="is_active" class="rounded border-slate-300 text-primary focus:ring-primary">
                             <!-- Hidden input to signal that checkbox was present in form, handled in controller -->
                             <input type="hidden" name="is_active_explicit" value="1">
                             <label for="is_active" class="text-sm font-medium text-slate-700 dark:text-[#92a9c9]">Langsung Aktifkan?</label>
                        </div>
                    </div>
                </div>
                <div class="bg-slate-50 dark:bg-[#111822] px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse border-t border-slate-200 dark:border-[#233348] items-center gap-4">
                    <button type="submit" id="saveButton" disabled class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-primary text-base font-medium text-white hover:bg-blue-700 disabled:bg-slate-400 disabled:cursor-not-allowed sm:ml-3 sm:w-auto sm:text-sm transition-all">Simpan</button>
                    <button type="button" onclick="closeModal()" class="mt-3 w-full inline-flex justify-center rounded-md border border-slate-300 dark:border-[#324867] shadow-sm px-4 py-2 bg-white dark:bg-[#1a232e] text-base font-medium text-slate-700 dark:text-[#92a9c9] hover:bg-slate-50 dark:hover:bg-[#111822] sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">Batal</button>
                    <p id="validationWarning" class="text-xs text-red-500 font-medium hidden sm:block">Harap isi Tanggal Muai & Selesai</p>
                </div>
            </form>
        </div>
    </div>
</div>

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script>
    // Initialize global flatpickr instances
    let fpStartDate, fpEndDate;

    document.addEventListener('DOMContentLoaded', function() {
        const config = {
            enableTime: true,
            dateFormat: "Y-m-d H:i",
            time_24hr: true,
            minuteIncrement: 1,
            static: true, // Important for modals
            onChange: function() {
                validateForm();
            }
        };
        
        fpStartDate = flatpickr("#start_date", config);
        fpEndDate = flatpickr("#end_date", config);
    });

    function validateForm() {
        const startDate = document.getElementById('start_date').value;
        const endDate = document.getElementById('end_date').value;
        const btn = document.getElementById('saveButton');
        const warning = document.getElementById('validationWarning');

        if (startDate && endDate) {
            btn.disabled = false;
            warning.classList.add('hidden');
        } else {
            btn.disabled = true;
            warning.classList.remove('hidden');
        }
    }

    function openCreateModal() {
        document.getElementById('modalTitle').innerText = 'Buat Pengumuman Baru';
        document.getElementById('announcementForm').action = "{{ route('admin.announcements.store') }}";
        document.getElementById('methodField').innerHTML = '';
        
        document.getElementById('title').value = '';
        document.getElementById('type').value = 'info';
        document.getElementById('content').value = '';
        
        if(fpStartDate) fpStartDate.clear();
        if(fpEndDate) fpEndDate.clear();

        document.getElementById('is_active').checked = true;
        
        validateForm(); // Check initial state

        document.getElementById('announcementModal').classList.remove('hidden');
    }

    function openEditModal(data) {
        document.getElementById('modalTitle').innerText = 'Edit Pengumuman';
        document.getElementById('announcementForm').action = "{{ url('admin/announcements') }}/" + data.id;
        document.getElementById('methodField').innerHTML = '@method("PUT")';

        document.getElementById('title').value = data.title;
        document.getElementById('type').value = data.type;
        document.getElementById('content').value = data.content;
        
        if(data.start_date) {
            fpStartDate.setDate(data.start_date);
        } else {
            fpStartDate.clear();
        }
        
        if(data.end_date) {
            fpEndDate.setDate(data.end_date);
        } else {
            fpEndDate.clear();
        }

        document.getElementById('is_active').checked = data.is_active;

        validateForm(); // Check initial state

        document.getElementById('announcementModal').classList.remove('hidden');
    }

    function closeModal() {
        document.getElementById('announcementModal').classList.add('hidden');
    }
</script>
@endpush
@endsection
