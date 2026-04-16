@extends('admin.layouts.app')

@section('title', 'Halaman Kelola Prioritas SAW')

@section('content')
<div class="mx-auto max-w-6xl p-6 lg:p-10 flex flex-col gap-6">
    <!-- Breadcrumbs -->
    <div class="flex flex-wrap gap-2 text-sm">
        <a class="text-slate-500 dark:text-[#92a9c9] font-medium hover:text-primary transition-colors" href="{{ route('admin.dashboard') }}">Dashboard</a>
        <span class="text-slate-400 dark:text-[#64748b]">/</span>
        <span class="text-slate-900 dark:text-white font-medium">Prioritas SAW</span>
    </div>
    <!-- Page Heading -->
    <div class="flex flex-wrap justify-between items-end gap-4 border-b border-slate-200 dark:border-[#233348] pb-6">
        <div class="flex flex-col gap-2 max-w-2xl">
            <h1 class="text-slate-900 dark:text-white text-3xl md:text-4xl font-black leading-tight tracking-[-0.033em]">Kelola Prioritas SAW</h1>
            <p class="text-slate-600 dark:text-[#92a9c9] text-base font-normal leading-relaxed">Atur bobot dan kriteria prioritas untuk sistem pendukung keputusan (SAW). Pastikan total bobot mencapai 1.0.</p>
        </div>
        <button onclick="openCreateCriteriaModal()" class="flex items-center justify-center gap-2 rounded-lg bg-primary hover:bg-blue-600 text-white px-5 py-2.5 text-sm font-bold transition-all shadow-lg shadow-primary/30">
            <span class="material-symbols-outlined text-[20px]">add</span>
            <span>Tambah Kriteria</span>
        </button>
    </div>
    <!-- Feature Stats Section -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
        <div class="flex gap-4 rounded-xl border border-slate-200 dark:border-[#324867] bg-surface-light dark:bg-surface-dark p-5 shadow-sm">
            <div class="flex size-12 shrink-0 items-center justify-center rounded-full bg-blue-50 dark:bg-blue-900/30 text-primary">
                <span class="material-symbols-outlined">balance</span>
            </div>
            <div class="flex flex-col justify-center">
                <h2 class="text-slate-900 dark:text-white text-lg font-bold leading-tight">Total Bobot</h2>
                <div class="flex items-center gap-2">
                    <span class="text-green-600 dark:text-green-400 text-sm font-bold">{{ number_format($criterias->where('is_active', true)->sum('weight'), 2) }}</span>
                    @if(number_format($criterias->where('is_active', true)->sum('weight'), 2) == 1.00)
                    <span class="material-symbols-outlined text-green-600 dark:text-green-400 text-[16px]">check_circle</span>
                    @else
                    <span class="material-symbols-outlined text-yellow-600 dark:text-yellow-400 text-[16px]">warning</span>
                    @endif
                </div>
            </div>
        </div>
        <div class="flex gap-4 rounded-xl border border-slate-200 dark:border-[#324867] bg-surface-light dark:bg-surface-dark p-5 shadow-sm">
            <div class="flex size-12 shrink-0 items-center justify-center rounded-full bg-slate-50 dark:bg-slate-700/50 text-slate-600 dark:text-slate-300">
                <span class="material-symbols-outlined">rule</span>
            </div>
            <div class="flex flex-col justify-center">
                <h2 class="text-slate-900 dark:text-white text-lg font-bold leading-tight">Kriteria Aktif</h2>
                <p class="text-slate-500 dark:text-[#92a9c9] text-sm font-normal">{{ $criterias->where('is_active', true)->count() }} Aturan digunakan</p>
            </div>
        </div>
        <div class="flex gap-4 rounded-xl border border-slate-200 dark:border-[#324867] bg-surface-light dark:bg-surface-dark p-5 shadow-sm">
            <div class="flex size-12 shrink-0 items-center justify-center rounded-full bg-slate-50 dark:bg-slate-700/50 text-slate-600 dark:text-slate-300">
                <span class="material-symbols-outlined">disabled_by_default</span>
            </div>
            <div class="flex flex-col justify-center">
                <h2 class="text-slate-900 dark:text-white text-lg font-bold leading-tight">Non-Aktif</h2>
                <p class="text-slate-500 dark:text-[#92a9c9] text-sm font-normal">{{ $criterias->where('is_active', false)->count() }} Aturan tersimpan</p>
            </div>
        </div>
    </div>
    <!-- Filter Toolbar -->
    <div class="flex flex-col sm:flex-row gap-4 justify-between items-center bg-surface-light dark:bg-surface-dark p-4 rounded-xl border border-slate-200 dark:border-[#324867] shadow-sm">
        <div class="relative w-full sm:w-96">
            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                <span class="material-symbols-outlined text-slate-400">search</span>
            </div>
            <input class="block w-full rounded-lg border-slate-300 dark:border-slate-600 bg-slate-50 dark:bg-[#111822] text-slate-900 dark:text-white placeholder-slate-400 focus:border-primary focus:ring-primary sm:text-sm pl-10 py-2.5" placeholder="Cari nama kriteria..." type="text"/>
        </div>
        <div class="flex gap-3 w-full sm:w-auto">
            <select class="block w-full sm:w-48 rounded-lg border-slate-300 dark:border-slate-600 bg-slate-50 dark:bg-[#111822] text-slate-900 dark:text-white focus:border-primary focus:ring-primary sm:text-sm py-2.5">
                <option>Semua Status</option>
                <option>Aktif</option>
                <option>Non-Aktif</option>
            </select>
        </div>
    </div>
    <!-- Data Table -->
    <div class="rounded-xl border border-slate-200 dark:border-[#324867] bg-surface-light dark:bg-surface-dark shadow-sm overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left text-sm">
                <thead class="bg-slate-50 dark:bg-[#111822] border-b border-slate-200 dark:border-[#324867]">
                    <tr>
                        <th class="px-6 py-4 font-semibold text-slate-900 dark:text-white" scope="col">Nama Kriteria</th>
                        <th class="px-6 py-4 font-semibold text-slate-900 dark:text-white" scope="col">Bobot (Weight)</th>
                        <th class="px-6 py-4 font-semibold text-slate-900 dark:text-white w-1/3" scope="col">Deskripsi</th>
                        <th class="px-6 py-4 font-semibold text-slate-900 dark:text-white" scope="col">Status</th>
                        <th class="px-6 py-4 font-semibold text-slate-900 dark:text-white text-right" scope="col">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-200 dark:divide-[#324867]">
                    @forelse($criterias as $criteria)
                    <tr class="group hover:bg-slate-50 dark:hover:bg-[#253246] transition-colors">
                        <td class="px-6 py-4">
                            <div class="font-medium text-slate-900 dark:text-white">{{ $criteria->name }}</div>
                            <div class="text-xs text-slate-500 dark:text-slate-400">{{ $criteria->code }} - {{ ucfirst($criteria->attribute) }}</div>
                        </td>
                        <td class="px-6 py-4">
                            <span class="inline-flex items-center rounded-md bg-blue-50 dark:bg-blue-900/30 px-2 py-1 text-xs font-medium text-primary ring-1 ring-inset ring-blue-700/10 dark:ring-blue-700/30">{{ number_format($criteria->weight, 2) }}</span>
                        </td>
                        <td class="px-6 py-4 text-slate-500 dark:text-slate-400 w-1/3">
                            {{ $criteria->description ?? '-' }}
                            @if($criteria->code == 'C2')
                                <div class="mt-2">
                                    <a href="{{ route('admin.asset-categories.index') }}" class="inline-flex items-center gap-1 text-[10px] text-blue-600 dark:text-blue-400 font-bold hover:underline bg-blue-50 dark:bg-blue-900/30 px-2 py-1 rounded border border-blue-200 dark:border-blue-800">
                                        <span class="material-symbols-outlined text-[12px]">settings</span>
                                        Dikelola oleh Kategori Asset
                                    </a>
                                </div>
                            @elseif($criteria->code == 'C4')
                                <div class="mt-2">
                                    <a href="{{ route('admin.departments.index') }}" class="inline-flex items-center gap-1 text-[10px] text-blue-600 dark:text-blue-400 font-bold hover:underline bg-blue-50 dark:bg-blue-900/30 px-2 py-1 rounded border border-blue-200 dark:border-blue-800">
                                        <span class="material-symbols-outlined text-[12px]">settings</span>
                                        Dikelola oleh Departemen
                                    </a>
                                </div>
                            @endif
                        </td>
                        <td class="px-6 py-4">
                             <form action="{{ route('admin.criterias.toggle', $criteria->id) }}" method="POST" class="inline">
                                @csrf
                                @method('PATCH')
                                <button type="submit" class="relative inline-flex h-6 w-11 items-center rounded-full transition-colors focus:outline-none focus:ring-2 focus:ring-primary focus:ring-offset-2 {{ $criteria->is_active ? 'bg-primary' : 'bg-slate-200 dark:bg-slate-700' }}">
                                    <span class="sr-only">Toggle status</span>
                                    <span class="inline-block h-4 w-4 transform rounded-full bg-white transition {{ $criteria->is_active ? 'translate-x-6' : 'translate-x-1' }}"></span>
                                </button>
                             </form>
                        </td>
                        <td class="px-6 py-4 text-right">
                            <div class="flex justify-end gap-2">
                                <a href="{{ route('admin.criterias.edit', $criteria->id) }}" class="p-2 rounded-lg text-slate-400 hover:text-primary hover:bg-blue-50 dark:hover:bg-blue-900/20 transition-all" title="Edit & Kelola Sub-Kriteria">
                                    <span class="material-symbols-outlined text-[20px]">edit</span>
                                </a>
                                <form action="{{ route('admin.criterias.destroy', $criteria->id) }}" method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="button" onclick="confirmDelete(this, 'Apakah Anda yakin ingin menghapus kriteria ini?')" class="p-2 rounded-lg text-slate-400 hover:text-red-500 hover:bg-red-50 dark:hover:bg-red-900/20 transition-all" title="Delete">
                                        <span class="material-symbols-outlined text-[20px]">delete</span>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                         <td colspan="6" class="px-6 py-4 text-center text-slate-500 dark:text-slate-400">Belum ada kriteria.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    <!-- Create Criteria Modal -->
    <div id="createCriteriaModal" class="fixed inset-0 z-50 hidden overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
        <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
            <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" aria-hidden="true" onclick="closeCreateCriteriaModal()"></div>
            <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
            <div class="inline-block align-bottom bg-white dark:bg-[#1a232e] rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full border border-slate-200 dark:border-[#233348]">
                <form action="{{ route('admin.criterias.store') }}" method="POST">
                    @csrf
                    <div class="bg-white dark:bg-[#1a232e] px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                        <h3 class="text-lg leading-6 font-medium text-[#101822] dark:text-white mb-4">Tambah Kriteria Baru</h3>
                        <div class="space-y-4">
                             <div>
                                <label for="crit_code" class="block text-sm font-medium text-slate-700 dark:text-[#92a9c9]">Kode (C1, C2...)</label>
                                <input type="text" name="code" id="crit_code" required class="mt-1 block w-full rounded-md border-slate-300 dark:border-[#324867] bg-white dark:bg-[#111822] text-[#101822] dark:text-white shadow-sm focus:border-primary focus:ring-primary sm:text-sm">
                            </div>
                            <div>
                                <label for="crit_name" class="block text-sm font-medium text-slate-700 dark:text-[#92a9c9]">Nama Kriteria</label>
                                <input type="text" name="name" id="crit_name" required class="mt-1 block w-full rounded-md border-slate-300 dark:border-[#324867] bg-white dark:bg-[#111822] text-[#101822] dark:text-white shadow-sm focus:border-primary focus:ring-primary sm:text-sm">
                            </div>
                            <div>
                                <label for="crit_attr" class="block text-sm font-medium text-slate-700 dark:text-[#92a9c9]">Atribut</label>
                                <select name="attribute" id="crit_attr" class="mt-1 block w-full rounded-md border-slate-300 dark:border-[#324867] bg-white dark:bg-[#111822] text-[#101822] dark:text-white shadow-sm focus:border-primary focus:ring-primary sm:text-sm">
                                    <option value="benefit">Benefit</option>
                                    <option value="cost">Cost</option>
                                </select>
                            </div>
                            <div>
                                <label for="crit_weight" class="block text-sm font-medium text-slate-700 dark:text-[#92a9c9]">Bobot (0.00 - 1.00)</label>
                                <input type="number" step="0.01" min="0" max="1" name="weight" id="crit_weight" required class="mt-1 block w-full rounded-md border-slate-300 dark:border-[#324867] bg-white dark:bg-[#111822] text-[#101822] dark:text-white shadow-sm focus:border-primary focus:ring-primary sm:text-sm">
                            </div>
                        </div>
                    </div>
                    <div class="bg-slate-50 dark:bg-[#111822] px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse border-t border-slate-200 dark:border-[#233348]">
                        <button type="submit" class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-primary text-base font-medium text-white hover:bg-blue-700 focus:outline-none sm:ml-3 sm:w-auto sm:text-sm">Simpan</button>
                        <button type="button" onclick="closeCreateCriteriaModal()" class="mt-3 w-full inline-flex justify-center rounded-md border border-slate-300 dark:border-[#324867] shadow-sm px-4 py-2 bg-white dark:bg-[#1a232e] text-base font-medium text-slate-700 dark:text-[#92a9c9] hover:bg-slate-50 dark:hover:bg-[#111822] focus:outline-none sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">Batal</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
<script>
    function openCreateCriteriaModal() {
        document.getElementById('createCriteriaModal').classList.remove('hidden');
    }

    function closeCreateCriteriaModal() {
        document.getElementById('createCriteriaModal').classList.add('hidden');
    }
</script>
@endsection
