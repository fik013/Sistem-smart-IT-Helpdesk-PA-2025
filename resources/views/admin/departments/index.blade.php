@extends('admin.layouts.app')

@section('title', 'Halaman Kelola Jabatan')

@section('content')
<div class="mx-auto max-w-6xl p-6 lg:p-10 flex flex-col gap-6">
    <!-- Breadcrumbs -->
    <div class="flex flex-wrap gap-2 text-sm">
        <a class="text-slate-500 dark:text-[#92a9c9] font-medium hover:text-primary transition-colors" href="{{ route('admin.dashboard') }}">Dashboard</a>
        <span class="text-slate-400 dark:text-[#64748b]">/</span>
        <span class="text-slate-900 dark:text-white font-medium">Kelola Jabatan</span>
    </div>

    <!-- Page Heading -->
    <div class="flex flex-wrap justify-between items-end gap-4 border-b border-slate-200 dark:border-[#233348] pb-6">
        <div class="flex flex-col gap-2 max-w-2xl">
            <h1 class="text-slate-900 dark:text-white text-3xl md:text-4xl font-black leading-tight tracking-[-0.033em]">Kelola Jabatan</h1>
            <p class="text-slate-600 dark:text-[#92a9c9] text-base font-normal leading-relaxed">Kelola daftar jabatan dan bobot untuk perhitungan sistem.</p>
        </div>
        <button onclick="openCreateModal()" class="flex items-center justify-center gap-2 rounded-lg bg-primary hover:bg-blue-600 text-white px-5 py-2.5 text-sm font-bold transition-all shadow-lg shadow-primary/30">
            <span class="material-symbols-outlined text-[20px]">add</span>
            <span>Tambah Jabatan</span>
        </button>
    </div>

    <!-- Success Message -->
    @if(session('success'))
        <div class="p-4 mb-4 text-sm text-green-700 dark:text-green-400 rounded-lg bg-green-100 dark:bg-green-500/10 border border-green-200 dark:border-green-500/20" role="alert">
            <span class="font-medium">Success!</span> {{ session('success') }}
        </div>
    @endif

    <!-- Data Table -->
    <div class="rounded-xl border border-slate-200 dark:border-[#324867] bg-surface-light dark:bg-surface-dark shadow-sm overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left text-sm">
                <thead class="bg-slate-50 dark:bg-[#111822] border-b border-slate-200 dark:border-[#324867]">
                    <tr>
                        <th class="px-6 py-4 font-semibold text-slate-900 dark:text-white" scope="col">Nama Jabatan</th>
                        <th class="px-6 py-4 font-semibold text-slate-900 dark:text-white" scope="col">Bobot (Weight)</th>
                        <th class="px-6 py-4 font-semibold text-slate-900 dark:text-white" scope="col">Deskripsi</th>
                        <th class="px-6 py-4 font-semibold text-slate-900 dark:text-white text-right" scope="col">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-200 dark:divide-[#324867]">
                    @forelse($departments as $department)
                    <tr class="group hover:bg-slate-50 dark:hover:bg-[#253246] transition-colors">
                        <td class="px-6 py-4">
                            <div class="font-medium text-slate-900 dark:text-white">{{ $department->name }}</div>
                        </td>
                        <td class="px-6 py-4">
                            <span class="inline-flex items-center rounded-md bg-blue-50 dark:bg-blue-900/30 px-2 py-1 text-xs font-medium text-primary ring-1 ring-inset ring-blue-700/10 dark:ring-blue-700/30">{{ number_format($department->weight, 2) }}</span>
                        </td>
                        <td class="px-6 py-4 text-slate-500 dark:text-slate-400">
                            {{ $department->description ?? '-' }}
                        </td>
                        <td class="px-6 py-4 text-right">
                            <div class="flex justify-end gap-2">
                                <button onclick="openEditModal({{ $department }})" class="p-2 rounded-lg text-slate-400 hover:text-primary hover:bg-blue-50 dark:hover:bg-blue-900/20 transition-all" title="Edit">
                                    <span class="material-symbols-outlined text-[20px]">edit</span>
                                </button>
                                <form action="{{ route('admin.departments.destroy', $department->id) }}" method="POST" class="inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus jabatan ini?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="p-2 rounded-lg text-slate-400 hover:text-red-500 hover:bg-red-50 dark:hover:bg-red-900/20 transition-all" title="Delete">
                                        <span class="material-symbols-outlined text-[20px]">delete</span>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                         <td colspan="4" class="px-6 py-4 text-center text-slate-500 dark:text-slate-400">Belum ada jabatan.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Create Modal -->
<div id="createDepartmentModal" class="fixed inset-0 z-50 hidden overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
    <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
        <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" aria-hidden="true" onclick="closeCreateModal()"></div>
        <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
        <div class="inline-block align-bottom bg-white dark:bg-[#1a232e] rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full border border-slate-200 dark:border-[#233348]">
            <form action="{{ route('admin.departments.store') }}" method="POST">
                @csrf
                <div class="bg-white dark:bg-[#1a232e] px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                    <h3 class="text-lg leading-6 font-medium text-[#101822] dark:text-white mb-4">Tambah Jabatan Baru</h3>
                    <div class="space-y-4">
                        <div>
                            <label for="name" class="block text-sm font-medium text-slate-700 dark:text-[#92a9c9]">Nama Jabatan</label>
                            <input type="text" name="name" id="name" required class="mt-1 block w-full rounded-md border-slate-300 dark:border-[#324867] bg-white dark:bg-[#111822] text-[#101822] dark:text-white shadow-sm focus:border-primary focus:ring-primary sm:text-sm">
                        </div>
                        <div>
                            <label for="weight" class="block text-sm font-medium text-slate-700 dark:text-[#92a9c9]">Bobot (0.00 - 1.00)</label>
                            <input type="number" step="0.01" min="0" max="1" name="weight" id="weight" required class="mt-1 block w-full rounded-md border-slate-300 dark:border-[#324867] bg-white dark:bg-[#111822] text-[#101822] dark:text-white shadow-sm focus:border-primary focus:ring-primary sm:text-sm">
                        </div>
                        <div>
                            <label for="description" class="block text-sm font-medium text-slate-700 dark:text-[#92a9c9]">Deskripsi</label>
                            <textarea name="description" id="description" rows="3" class="mt-1 block w-full rounded-md border-slate-300 dark:border-[#324867] bg-white dark:bg-[#111822] text-[#101822] dark:text-white shadow-sm focus:border-primary focus:ring-primary sm:text-sm"></textarea>
                        </div>
                    </div>
                </div>
                <div class="bg-slate-50 dark:bg-[#111822] px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse border-t border-slate-200 dark:border-[#233348]">
                    <button type="submit" class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-primary text-base font-medium text-white hover:bg-blue-700 focus:outline-none sm:ml-3 sm:w-auto sm:text-sm">Simpan</button>
                    <button type="button" onclick="closeCreateModal()" class="mt-3 w-full inline-flex justify-center rounded-md border border-slate-300 dark:border-[#324867] shadow-sm px-4 py-2 bg-white dark:bg-[#1a232e] text-base font-medium text-slate-700 dark:text-[#92a9c9] hover:bg-slate-50 dark:hover:bg-[#111822] focus:outline-none sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">Batal</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Edit Modal -->
<div id="editDepartmentModal" class="fixed inset-0 z-50 hidden overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
    <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
        <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" aria-hidden="true" onclick="closeEditModal()"></div>
        <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
        <div class="inline-block align-bottom bg-white dark:bg-[#1a232e] rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full border border-slate-200 dark:border-[#233348]">
            <form id="editDepartmentForm" action="" method="POST">
                @csrf
                @method('PUT')
                <div class="bg-white dark:bg-[#1a232e] px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                    <h3 class="text-lg leading-6 font-medium text-[#101822] dark:text-white mb-4">Edit Jabatan</h3>
                    <div class="space-y-4">
                        <div>
                            <label for="edit_name" class="block text-sm font-medium text-slate-700 dark:text-[#92a9c9]">Nama Jabatan</label>
                            <input type="text" name="name" id="edit_name" required class="mt-1 block w-full rounded-md border-slate-300 dark:border-[#324867] bg-white dark:bg-[#111822] text-[#101822] dark:text-white shadow-sm focus:border-primary focus:ring-primary sm:text-sm">
                        </div>
                        <div>
                            <label for="edit_weight" class="block text-sm font-medium text-slate-700 dark:text-[#92a9c9]">Bobot (0.00 - 1.00)</label>
                            <input type="number" step="0.01" min="0" max="1" name="weight" id="edit_weight" required class="mt-1 block w-full rounded-md border-slate-300 dark:border-[#324867] bg-white dark:bg-[#111822] text-[#101822] dark:text-white shadow-sm focus:border-primary focus:ring-primary sm:text-sm">
                        </div>
                        <div>
                            <label for="edit_description" class="block text-sm font-medium text-slate-700 dark:text-[#92a9c9]">Deskripsi</label>
                            <textarea name="description" id="edit_description" rows="3" class="mt-1 block w-full rounded-md border-slate-300 dark:border-[#324867] bg-white dark:bg-[#111822] text-[#101822] dark:text-white shadow-sm focus:border-primary focus:ring-primary sm:text-sm"></textarea>
                        </div>
                    </div>
                </div>
                <div class="bg-slate-50 dark:bg-[#111822] px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse border-t border-slate-200 dark:border-[#233348]">
                    <button type="submit" class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-primary text-base font-medium text-white hover:bg-blue-700 focus:outline-none sm:ml-3 sm:w-auto sm:text-sm">Update</button>
                    <button type="button" onclick="closeEditModal()" class="mt-3 w-full inline-flex justify-center rounded-md border border-slate-300 dark:border-[#324867] shadow-sm px-4 py-2 bg-white dark:bg-[#1a232e] text-base font-medium text-slate-700 dark:text-[#92a9c9] hover:bg-slate-50 dark:hover:bg-[#111822] focus:outline-none sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">Batal</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    function openCreateModal() {
        document.getElementById('createDepartmentModal').classList.remove('hidden');
    }

    function closeCreateModal() {
        document.getElementById('createDepartmentModal').classList.add('hidden');
    }

    function openEditModal(department) {
        document.getElementById('edit_name').value = department.name;
        document.getElementById('edit_weight').value = department.weight;
        document.getElementById('edit_description').value = department.description;
        
        // Update form action
        const form = document.getElementById('editDepartmentForm');
        form.action = "{{ route('admin.departments.index') }}/" + department.id;
        
        document.getElementById('editDepartmentModal').classList.remove('hidden');
    }

    function closeEditModal() {
        document.getElementById('editDepartmentModal').classList.add('hidden');
    }
</script>
@endsection
