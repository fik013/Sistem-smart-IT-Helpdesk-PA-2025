@extends('admin.layouts.app')

@section('title', 'Edit Kriteria SAW')

@section('content')
<div class="mx-auto max-w-6xl p-6 lg:p-10 flex flex-col gap-6">
    <!-- Breadcrumbs -->
    <div class="flex flex-wrap gap-2 text-sm">
        <a class="text-slate-500 dark:text-[#92a9c9] font-medium hover:text-primary transition-colors" href="{{ route('admin.dashboard') }}">Dashboard</a>
        <span class="text-slate-400 dark:text-[#64748b]">/</span>
        <a class="text-slate-500 dark:text-[#92a9c9] font-medium hover:text-primary transition-colors" href="{{ route('admin.prioritas.index') }}">Prioritas SAW</a>
        <span class="text-slate-400 dark:text-[#64748b]">/</span>
        <span class="text-slate-900 dark:text-white font-medium">Edit Kriteria</span>
    </div>

    <!-- Page Heading -->
    <div class="flex flex-col gap-2 pb-6 border-b border-slate-200 dark:border-[#233348]">
        <h1 class="text-slate-900 dark:text-white text-3xl md:text-4xl font-black leading-tight tracking-[-0.033em]">Edit Kriteria & Sub-Kriteria</h1>
        <p class="text-slate-600 dark:text-[#92a9c9] text-base font-normal leading-relaxed">Ubah detail kriteria utama dan kelola sub-kriteria untuk pembobotan yang lebih spesifik.</p>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Main Criteria Edit Form -->
        <div class="lg:col-span-1">
            <div class="bg-surface-light dark:bg-surface-dark rounded-xl border border-slate-200 dark:border-[#324867] p-6 shadow-sm sticky top-6">
                <h2 class="text-lg font-bold text-slate-900 dark:text-white mb-4">Detail Kriteria</h2>
                <form action="{{ route('admin.criterias.update', $criteria->id) }}" method="POST" class="space-y-4">
                    @csrf
                    @method('PUT')
                    <div>
                        <label for="code" class="block text-sm font-medium text-slate-700 dark:text-[#92a9c9]">Kode</label>
                        <input type="text" name="code" id="code" value="{{ old('code', $criteria->code) }}" required class="mt-1 block w-full rounded-md border-slate-300 dark:border-[#324867] bg-white dark:bg-[#111822] text-[#101822] dark:text-white shadow-sm focus:border-primary focus:ring-primary sm:text-sm">
                    </div>
                    <div>
                        <label for="name" class="block text-sm font-medium text-slate-700 dark:text-[#92a9c9]">Nama Kriteria</label>
                        <input type="text" name="name" id="name" value="{{ old('name', $criteria->name) }}" required class="mt-1 block w-full rounded-md border-slate-300 dark:border-[#324867] bg-white dark:bg-[#111822] text-[#101822] dark:text-white shadow-sm focus:border-primary focus:ring-primary sm:text-sm">
                    </div>
                    <div>
                        <label for="attribute" class="block text-sm font-medium text-slate-700 dark:text-[#92a9c9]">Atribut</label>
                        <select name="attribute" id="attribute" class="mt-1 block w-full rounded-md border-slate-300 dark:border-[#324867] bg-white dark:bg-[#111822] text-[#101822] dark:text-white shadow-sm focus:border-primary focus:ring-primary sm:text-sm">
                            <option value="benefit" {{ $criteria->attribute == 'benefit' ? 'selected' : '' }}>Benefit</option>
                            <option value="cost" {{ $criteria->attribute == 'cost' ? 'selected' : '' }}>Cost</option>
                        </select>
                    </div>
                    <div>
                        <label for="description" class="block text-sm font-medium text-slate-700 dark:text-[#92a9c9]">Deskripsi</label>
                        <textarea name="description" id="description" rows="3" class="mt-1 block w-full rounded-md border-slate-300 dark:border-[#324867] bg-white dark:bg-[#111822] text-[#101822] dark:text-white shadow-sm focus:border-primary focus:ring-primary sm:text-sm">{{ old('description', $criteria->description) }}</textarea>
                    </div>
                    <div>
                        <label for="weight" class="block text-sm font-medium text-slate-700 dark:text-[#92a9c9]">Bobot (0.1 - 1.0)</label>
                        <input type="number" step="0.01" min="0" max="1" name="weight" id="weight" value="{{ old('weight', $criteria->weight) }}" required class="mt-1 block w-full rounded-md border-slate-300 dark:border-[#324867] bg-white dark:bg-[#111822] text-[#101822] dark:text-white shadow-sm focus:border-primary focus:ring-primary sm:text-sm">
                    </div>
                    <div class="pt-4 flex gap-3">
                        <button type="submit" class="w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-primary hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary">Simpan Perubahan</button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Sub-Criteria Management -->
        <div class="lg:col-span-2 space-y-6">
            <div class="bg-surface-light dark:bg-surface-dark rounded-xl border border-slate-200 dark:border-[#324867] p-6 shadow-sm">
                <div class="flex justify-between items-center mb-6">
                    <div>
                        <h2 class="text-lg font-bold text-slate-900 dark:text-white">Sub-Kriteria</h2>
                        <p class="text-sm text-slate-500 dark:text-[#92a9c9]">Daftar nilai variabel untuk kriteria ini.</p>
                    </div>
                    @if(str_contains(strtolower($criteria->name), 'jabatan'))
                        <div class="px-4 py-2 bg-yellow-50 dark:bg-yellow-900/20 text-yellow-700 dark:text-yellow-400 text-sm rounded-lg border border-yellow-200 dark:border-yellow-900/30">
                            Managed automatically via <a href="{{ route('admin.departments.index') }}" class="font-bold underline">Kelola Jabatan</a>
                        </div>
                    @elseif(str_contains(strtolower($criteria->name), 'jenis aset'))
                        <div class="px-4 py-2 bg-blue-50 dark:bg-blue-900/20 text-blue-700 dark:text-blue-400 text-sm rounded-lg border border-blue-200 dark:border-blue-900/30">
                            Managed automatically via <a href="{{ route('admin.asset-categories.index') }}" class="font-bold underline">Kelola Kategori Aset</a>
                        </div>
                    @elseif(str_contains(strtolower($criteria->name), 'tingkat urgensi') || $criteria->code == 'C1' || str_contains(strtolower($criteria->name), 'pengguna aset') || $criteria->code == 'C3')
                        {{-- Hide Add button for Urgency & Pengguna Aset --}}
                    @else
                        <button onclick="openCreateSubCriteriaModal()" class="flex items-center gap-2 text-sm font-bold text-primary bg-blue-50 dark:bg-blue-900/30 px-4 py-2 rounded-lg hover:bg-blue-100 dark:hover:bg-blue-900/50 transition-colors">
                            <span class="material-symbols-outlined text-[18px]">add</span>
                            Tambah Sub
                        </button>
                    @endif
                </div>

                <div class="overflow-hidden rounded-lg border border-slate-200 dark:border-[#324867]">
                    <table class="min-w-full divide-y divide-slate-200 dark:divide-[#324867]">
                        <thead class="bg-slate-50 dark:bg-[#111822]">
                            <tr>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-slate-500 dark:text-[#92a9c9] uppercase tracking-wider">Nama / Deskripsi</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-slate-500 dark:text-[#92a9c9] uppercase tracking-wider">Nilai Bobot</th>
                                <th scope="col" class="px-6 py-3 text-right text-xs font-medium text-slate-500 dark:text-[#92a9c9] uppercase tracking-wider">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white dark:bg-[#1a232e] divide-y divide-slate-200 dark:divide-[#324867]">
                            @if(str_contains(strtolower($criteria->name), 'jabatan'))
                                @forelse($departments as $dept)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-slate-900 dark:text-white">
                                        {{ $dept->name }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-slate-500 dark:text-[#92a9c9]">
                                        {{ number_format($dept->weight, 2) }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                        <button onclick="openEditDepartmentModal('{{ $dept->id }}', '{{ $dept->name }}', '{{ $dept->weight }}')" class="text-primary hover:text-blue-900 dark:hover:text-blue-400">Edit Bobot</button>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="3" class="px-6 py-4 text-center text-sm text-slate-500 dark:text-[#92a9c9]">Belum ada jabatan. Kelola di menu <a href="{{ route('admin.departments.index') }}" class="underline text-primary">Master Jabatan</a>.</td>
                                </tr>
                                @endforelse
                            @elseif(str_contains(strtolower($criteria->name), 'jenis aset'))
                                @forelse($assetCategories as $cat)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-slate-900 dark:text-white">
                                        {{ $cat->name }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-slate-500 dark:text-[#92a9c9]">
                                        {{ number_format($cat->weight, 2) }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                        <button onclick="openEditAssetCategoryModal('{{ $cat->id }}', '{{ $cat->name }}', '{{ $cat->weight }}', '{{ $cat->description }}')" class="text-primary hover:text-blue-900 dark:hover:text-blue-400">Edit Bobot</button>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="3" class="px-6 py-4 text-center text-sm text-slate-500 dark:text-[#92a9c9]">Belum ada kategori aset. Kelola di menu <a href="{{ route('admin.asset-categories.index') }}" class="underline text-primary">Master Kategori Aset</a>.</td>
                                </tr>
                                @endforelse
                            @else
                                @forelse($criteria->subCriterias as $sub)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-slate-900 dark:text-white">
                                        {{ $sub->name }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-slate-500 dark:text-[#92a9c9]">
                                        {{ number_format($sub->weight, 2) }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                        @if($criteria->code == 'C1' || $criteria->code == 'C3')
                                            {{-- Urgency & Asset User: Only Edit, No Delete --}}
                                            <button onclick="openEditSubCriteriaModal('{{ $sub->id }}', '{{ $sub->name }}', '{{ $sub->weight }}')" class="text-primary hover:text-blue-900 dark:hover:text-blue-400">Edit Bobot</button>
                                        @else
                                            <form action="{{ route('admin.sub-criterias.destroy', $sub->id) }}" method="POST" class="inline-block">
                                                @csrf
                                                @method('DELETE')
                                                <button type="button" onclick="confirmDelete(this, 'Hapus sub-kriteria ini?')" class="text-red-600 hover:text-red-900 dark:hover:text-red-400">Hapus</button>
                                            </form>
                                        @endif
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="3" class="px-6 py-4 text-center text-sm text-slate-500 dark:text-[#92a9c9]">Belum ada sub-kriteria.</td>
                                </tr>
                                @endforelse
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Add Sub Criteria Modal -->
<div id="createSubCriteriaModal" class="fixed inset-0 z-50 hidden overflow-y-auto">
    <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
        <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" onclick="closeCreateSubCriteriaModal()"></div>
        <div class="inline-block align-bottom bg-white dark:bg-[#1a232e] rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full border border-slate-200 dark:border-[#233348]">
            <form action="{{ route('admin.sub-criterias.store') }}" method="POST">
                @csrf
                <input type="hidden" name="saw_criteria_id" value="{{ $criteria->id }}">
                <div class="bg-white dark:bg-[#1a232e] px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                    <h3 class="text-lg font-medium text-slate-900 dark:text-white mb-4">Tambah Sub-Kriteria</h3>
                    <div class="space-y-4">
                        <div>
                            <label class="block text-sm font-medium text-slate-700 dark:text-[#92a9c9]">Nama / Label</label>
                            <input type="text" name="name" required class="mt-1 block w-full rounded-md border-slate-300 dark:border-[#324867] bg-white dark:bg-[#111822] text-[#101822] dark:text-white shadow-sm focus:border-primary focus:ring-primary sm:text-sm" placeholder="Contoh: Sangat Tinggi / Direktur">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-slate-700 dark:text-[#92a9c9]">Nilai Bobot (0.00 - 1.00)</label>
                            <input type="number" step="0.01" min="0" max="1" name="weight" required class="mt-1 block w-full rounded-md border-slate-300 dark:border-[#324867] bg-white dark:bg-[#111822] text-[#101822] dark:text-white shadow-sm focus:border-primary focus:ring-primary sm:text-sm" placeholder="0.5">
                        </div>
                    </div>
                </div>
                <div class="bg-slate-50 dark:bg-[#111822] px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse border-t border-slate-200 dark:border-[#233348]">
                    <button type="submit" class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-primary text-base font-medium text-white hover:bg-blue-700 sm:ml-3 sm:w-auto sm:text-sm">Simpan</button>
                    <button type="button" onclick="closeCreateSubCriteriaModal()" class="mt-3 w-full inline-flex justify-center rounded-md border border-slate-300 dark:border-[#324867] shadow-sm px-4 py-2 bg-white dark:bg-[#1a232e] text-base font-medium text-slate-700 dark:text-[#92a9c9] hover:bg-slate-50 dark:hover:bg-[#111822] sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">Batal</button>
                </div>
            </form>
        </div>
    </div>
</div>


<!-- Edit Department Weight Modal -->
<div id="editDepartmentModal" class="fixed inset-0 z-50 hidden overflow-y-auto">
    <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
        <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" onclick="closeEditDepartmentModal()"></div>
        <div class="inline-block align-bottom bg-white dark:bg-[#1a232e] rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full border border-slate-200 dark:border-[#233348]">
            <form id="editDepartmentForm" method="POST">
                @csrf
                @method('PUT')
                <div class="bg-white dark:bg-[#1a232e] px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                    <h3 class="text-lg font-medium text-slate-900 dark:text-white mb-4">Edit Bobot Jabatan</h3>
                    <div class="space-y-4">
                        <div>
                            <label class="block text-sm font-medium text-slate-700 dark:text-[#92a9c9]">Nama Jabatan</label>
                            <input type="text" name="name" id="dept_name" readonly class="mt-1 block w-full rounded-md border-slate-300 dark:border-[#324867] bg-slate-100 dark:bg-[#111822] text-slate-500 dark:text-slate-400 shadow-sm sm:text-sm">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-slate-700 dark:text-[#92a9c9]">Nilai Bobot (0.00 - 1.00)</label>
                            <input type="number" step="0.01" min="0" max="1" name="weight" id="dept_weight" required class="mt-1 block w-full rounded-md border-slate-300 dark:border-[#324867] bg-white dark:bg-[#111822] text-[#101822] dark:text-white shadow-sm focus:border-primary focus:ring-primary sm:text-sm">
                        </div>
                    </div>
                </div>
                <div class="bg-slate-50 dark:bg-[#111822] px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse border-t border-slate-200 dark:border-[#233348]">
                    <button type="submit" class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-primary text-base font-medium text-white hover:bg-blue-700 sm:ml-3 sm:w-auto sm:text-sm">Simpan</button>
                    <button type="button" onclick="closeEditDepartmentModal()" class="mt-3 w-full inline-flex justify-center rounded-md border border-slate-300 dark:border-[#324867] shadow-sm px-4 py-2 bg-white dark:bg-[#1a232e] text-base font-medium text-slate-700 dark:text-[#92a9c9] hover:bg-slate-50 dark:hover:bg-[#111822] sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">Batal</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Edit Asset Category Weight Modal -->
<div id="editAssetCategoryModal" class="fixed inset-0 z-50 hidden overflow-y-auto">
    <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
        <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" onclick="closeEditAssetCategoryModal()"></div>
        <div class="inline-block align-bottom bg-white dark:bg-[#1a232e] rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full border border-slate-200 dark:border-[#233348]">
            <form id="editAssetCategoryForm" method="POST">
                @csrf
                @method('PUT')
                <div class="bg-white dark:bg-[#1a232e] px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                    <h3 class="text-lg font-medium text-slate-900 dark:text-white mb-4">Edit Bobot Kategori Aset</h3>
                    <div class="space-y-4">
                        <div>
                            <label class="block text-sm font-medium text-slate-700 dark:text-[#92a9c9]">Nama Kategori</label>
                            <input type="text" name="name" id="cat_name" readonly class="mt-1 block w-full rounded-md border-slate-300 dark:border-[#324867] bg-slate-100 dark:bg-[#111822] text-slate-500 dark:text-slate-400 shadow-sm sm:text-sm">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-slate-700 dark:text-[#92a9c9]">Nilai Bobot (0.00 - 1.00)</label>
                            <input type="number" step="0.01" min="0" max="1" name="weight" id="cat_weight" required class="mt-1 block w-full rounded-md border-slate-300 dark:border-[#324867] bg-white dark:bg-[#111822] text-[#101822] dark:text-white shadow-sm focus:border-primary focus:ring-primary sm:text-sm">
                        </div>
                        <input type="hidden" name="description" id="cat_description">
                    </div>
                </div>
                <div class="bg-slate-50 dark:bg-[#111822] px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse border-t border-slate-200 dark:border-[#233348]">
                    <button type="submit" class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-primary text-base font-medium text-white hover:bg-blue-700 sm:ml-3 sm:w-auto sm:text-sm">Simpan</button>
                    <button type="button" onclick="closeEditAssetCategoryModal()" class="mt-3 w-full inline-flex justify-center rounded-md border border-slate-300 dark:border-[#324867] shadow-sm px-4 py-2 bg-white dark:bg-[#1a232e] text-base font-medium text-slate-700 dark:text-[#92a9c9] hover:bg-slate-50 dark:hover:bg-[#111822] sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">Batal</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Edit Sub Criteria Modal (Generic) -->
<div id="editSubCriteriaModal" class="fixed inset-0 z-50 hidden overflow-y-auto">
    <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
        <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" onclick="closeEditSubCriteriaModal()"></div>
        <div class="inline-block align-bottom bg-white dark:bg-[#1a232e] rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full border border-slate-200 dark:border-[#233348]">
            <form id="editSubCriteriaForm" method="POST">
                @csrf
                @method('PUT')
                <div class="bg-white dark:bg-[#1a232e] px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                    <h3 class="text-lg font-medium text-slate-900 dark:text-white mb-4">Edit Sub-Kriteria</h3>
                    <div class="space-y-4">
                        <div>
                            <label class="block text-sm font-medium text-slate-700 dark:text-[#92a9c9]">Nama / Label</label>
                            <input type="text" name="name" id="sub_name" readonly class="mt-1 block w-full rounded-md border-slate-300 dark:border-[#324867] bg-slate-100 dark:bg-[#111822] text-slate-500 dark:text-slate-400 shadow-sm sm:text-sm">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-slate-700 dark:text-[#92a9c9]">Nilai Bobot (0.00 - 1.00)</label>
                            <input type="number" step="0.01" min="0" max="1" name="weight" id="sub_weight" required class="mt-1 block w-full rounded-md border-slate-300 dark:border-[#324867] bg-white dark:bg-[#111822] text-[#101822] dark:text-white shadow-sm focus:border-primary focus:ring-primary sm:text-sm">
                        </div>
                    </div>
                </div>
                <div class="bg-slate-50 dark:bg-[#111822] px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse border-t border-slate-200 dark:border-[#233348]">
                    <button type="submit" class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-primary text-base font-medium text-white hover:bg-blue-700 sm:ml-3 sm:w-auto sm:text-sm">Simpan</button>
                    <button type="button" onclick="closeEditSubCriteriaModal()" class="mt-3 w-full inline-flex justify-center rounded-md border border-slate-300 dark:border-[#324867] shadow-sm px-4 py-2 bg-white dark:bg-[#1a232e] text-base font-medium text-slate-700 dark:text-[#92a9c9] hover:bg-slate-50 dark:hover:bg-[#111822] sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">Batal</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    function openCreateSubCriteriaModal() {
        document.getElementById('createSubCriteriaModal').classList.remove('hidden');
    }
    function closeCreateSubCriteriaModal() {
        document.getElementById('createSubCriteriaModal').classList.add('hidden');
    }

    function openEditSubCriteriaModal(id, name, weight) {
        document.getElementById('sub_name').value = name;
        document.getElementById('sub_weight').value = weight;
        
        let form = document.getElementById('editSubCriteriaForm');
        form.action = "{{ url('admin/sub-criterias') }}/" + id;
        
        document.getElementById('editSubCriteriaModal').classList.remove('hidden');
    }

    function closeEditSubCriteriaModal() {
        document.getElementById('editSubCriteriaModal').classList.add('hidden');
    }

    function openEditDepartmentModal(id, name, weight) {
        document.getElementById('dept_name').value = name;
        document.getElementById('dept_weight').value = weight;
        
        let form = document.getElementById('editDepartmentForm');
        form.action = "{{ url('admin/departments') }}/" + id;
        
        document.getElementById('editDepartmentModal').classList.remove('hidden');
    }
    
    function closeEditDepartmentModal() {
        document.getElementById('editDepartmentModal').classList.add('hidden');
    }

    function openEditAssetCategoryModal(id, name, weight, description) {
        document.getElementById('cat_name').value = name;
        document.getElementById('cat_weight').value = weight;
        document.getElementById('cat_description').value = description;

        let form = document.getElementById('editAssetCategoryForm');
        form.action = "{{ url('admin/asset-categories') }}/" + id;

        document.getElementById('editAssetCategoryModal').classList.remove('hidden');
    }

    function closeEditAssetCategoryModal() {
        document.getElementById('editAssetCategoryModal').classList.add('hidden');
    }
</script>
@endsection
