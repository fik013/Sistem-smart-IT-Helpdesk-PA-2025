@extends('admin.layouts.app')

@section('title', 'Halaman Kelola Prioritas SAW')

@section('content')
<div class="mx-auto max-w-6xl p-6 lg:p-10 flex flex-col gap-6">
    <!-- Breadcrumbs -->
    <div class="flex flex-wrap gap-2 text-sm">
        <a class="text-slate-500 dark:text-[#92a9c9] font-medium hover:text-primary transition-colors" href="{{ route('admin.dashboard') }}">Dashboard</a>
        <span class="text-slate-400 dark:text-[#64748b]">/</span>
        <a class="text-slate-500 dark:text-[#92a9c9] font-medium hover:text-primary transition-colors" href="#">Pengaturan</a>
        <span class="text-slate-400 dark:text-[#64748b]">/</span>
        <span class="text-slate-900 dark:text-white font-medium">Prioritas SAW</span>
    </div>
    <!-- Page Heading -->
    <div class="flex flex-wrap justify-between items-end gap-4 border-b border-slate-200 dark:border-[#233348] pb-6">
        <div class="flex flex-col gap-2 max-w-2xl">
            <h1 class="text-slate-900 dark:text-white text-3xl md:text-4xl font-black leading-tight tracking-[-0.033em]">Kelola Prioritas SAW</h1>
            <p class="text-slate-600 dark:text-[#92a9c9] text-base font-normal leading-relaxed">Atur bobot dan kriteria prioritas untuk sistem pendukung keputusan (SAW). Pastikan total bobot mencapai 1.0.</p>
        </div>
        <button class="flex items-center justify-center gap-2 rounded-lg bg-primary hover:bg-blue-600 text-white px-5 py-2.5 text-sm font-bold transition-all shadow-lg shadow-primary/30">
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
                    <span class="text-green-600 dark:text-green-400 text-sm font-bold">1.0 (Valid)</span>
                    <span class="material-symbols-outlined text-green-600 dark:text-green-400 text-[16px]">check_circle</span>
                </div>
            </div>
        </div>
        <div class="flex gap-4 rounded-xl border border-slate-200 dark:border-[#324867] bg-surface-light dark:bg-surface-dark p-5 shadow-sm">
            <div class="flex size-12 shrink-0 items-center justify-center rounded-full bg-slate-50 dark:bg-slate-700/50 text-slate-600 dark:text-slate-300">
                <span class="material-symbols-outlined">rule</span>
            </div>
            <div class="flex flex-col justify-center">
                <h2 class="text-slate-900 dark:text-white text-lg font-bold leading-tight">Kriteria Aktif</h2>
                <p class="text-slate-500 dark:text-[#92a9c9] text-sm font-normal">4 Aturan digunakan</p>
            </div>
        </div>
        <div class="flex gap-4 rounded-xl border border-slate-200 dark:border-[#324867] bg-surface-light dark:bg-surface-dark p-5 shadow-sm">
            <div class="flex size-12 shrink-0 items-center justify-center rounded-full bg-slate-50 dark:bg-slate-700/50 text-slate-600 dark:text-slate-300">
                <span class="material-symbols-outlined">disabled_by_default</span>
            </div>
            <div class="flex flex-col justify-center">
                <h2 class="text-slate-900 dark:text-white text-lg font-bold leading-tight">Non-Aktif</h2>
                <p class="text-slate-500 dark:text-[#92a9c9] text-sm font-normal">1 Aturan tersimpan</p>
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
                        <th class="px-6 py-4 font-semibold text-slate-900 dark:text-white" scope="col">Target SLA</th>
                        <th class="px-6 py-4 font-semibold text-slate-900 dark:text-white w-1/3" scope="col">Deskripsi</th>
                        <th class="px-6 py-4 font-semibold text-slate-900 dark:text-white" scope="col">Status</th>
                        <th class="px-6 py-4 font-semibold text-slate-900 dark:text-white text-right" scope="col">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-200 dark:divide-[#324867]">
                    <!-- Row 1 -->
                    <tr class="group hover:bg-slate-50 dark:hover:bg-[#253246] transition-colors">
                        <td class="px-6 py-4">
                            <div class="font-medium text-slate-900 dark:text-white">Tingkat Urgensi</div>
                            <div class="text-xs text-slate-500 dark:text-slate-400">Urgency Level</div>
                        </td>
                        <td class="px-6 py-4">
                            <span class="inline-flex items-center rounded-md bg-blue-50 dark:bg-blue-900/30 px-2 py-1 text-xs font-medium text-primary ring-1 ring-inset ring-blue-700/10 dark:ring-blue-700/30">0.40</span>
                        </td>
                        <td class="px-6 py-4 text-slate-600 dark:text-slate-300">
                            2 Jam
                        </td>
                        <td class="px-6 py-4 text-slate-500 dark:text-slate-400">
                            Menentukan prioritas berdasarkan dampak kerusakan aset terhadap operasional bisnis.
                        </td>
                        <td class="px-6 py-4">
                            <label class="relative inline-flex items-center cursor-pointer">
                                <input checked="" class="sr-only peer" type="checkbox" value=""/>
                                <div class="w-11 h-6 bg-slate-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 dark:peer-focus:ring-blue-800 rounded-full peer dark:bg-slate-700 peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-primary"></div>
                            </label>
                        </td>
                        <td class="px-6 py-4 text-right">
                            <div class="flex justify-end gap-2">
                                <button class="p-2 rounded-lg text-slate-400 hover:text-primary hover:bg-blue-50 dark:hover:bg-blue-900/20 transition-all" title="Edit">
                                    <span class="material-symbols-outlined text-[20px]">edit</span>
                                </button>
                                <button class="p-2 rounded-lg text-slate-400 hover:text-red-500 hover:bg-red-50 dark:hover:bg-red-900/20 transition-all" title="Delete">
                                    <span class="material-symbols-outlined text-[20px]">delete</span>
                                </button>
                            </div>
                        </td>
                    </tr>
                    <!-- Row 2 -->
                    <tr class="group hover:bg-slate-50 dark:hover:bg-[#253246] transition-colors">
                        <td class="px-6 py-4">
                            <div class="font-medium text-slate-900 dark:text-white">Jenis Aset</div>
                            <div class="text-xs text-slate-500 dark:text-slate-400">Asset Criticality</div>
                        </td>
                        <td class="px-6 py-4">
                            <span class="inline-flex items-center rounded-md bg-blue-50 dark:bg-blue-900/30 px-2 py-1 text-xs font-medium text-primary ring-1 ring-inset ring-blue-700/10 dark:ring-blue-700/30">0.30</span>
                        </td>
                        <td class="px-6 py-4 text-slate-600 dark:text-slate-300">
                            4 Jam
                        </td>
                        <td class="px-6 py-4 text-slate-500 dark:text-slate-400">
                            Kriteria berdasarkan seberapa vital aset tersebut (Server vs Laptop User).
                        </td>
                        <td class="px-6 py-4">
                            <label class="relative inline-flex items-center cursor-pointer">
                                <input checked="" class="sr-only peer" type="checkbox" value=""/>
                                <div class="w-11 h-6 bg-slate-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 dark:peer-focus:ring-blue-800 rounded-full peer dark:bg-slate-700 peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-primary"></div>
                            </label>
                        </td>
                        <td class="px-6 py-4 text-right">
                            <div class="flex justify-end gap-2">
                                <button class="p-2 rounded-lg text-slate-400 hover:text-primary hover:bg-blue-50 dark:hover:bg-blue-900/20 transition-all" title="Edit">
                                    <span class="material-symbols-outlined text-[20px]">edit</span>
                                </button>
                                <button class="p-2 rounded-lg text-slate-400 hover:text-red-500 hover:bg-red-50 dark:hover:bg-red-900/20 transition-all" title="Delete">
                                    <span class="material-symbols-outlined text-[20px]">delete</span>
                                </button>
                            </div>
                        </td>
                    </tr>
                    <!-- Row 3 -->
                    <tr class="group hover:bg-slate-50 dark:hover:bg-[#253246] transition-colors">
                        <td class="px-6 py-4">
                            <div class="font-medium text-slate-900 dark:text-white">Status Garansi</div>
                            <div class="text-xs text-slate-500 dark:text-slate-400">Warranty Status</div>
                        </td>
                        <td class="px-6 py-4">
                            <span class="inline-flex items-center rounded-md bg-blue-50 dark:bg-blue-900/30 px-2 py-1 text-xs font-medium text-primary ring-1 ring-inset ring-blue-700/10 dark:ring-blue-700/30">0.20</span>
                        </td>
                        <td class="px-6 py-4 text-slate-600 dark:text-slate-300">
                            24 Jam
                        </td>
                        <td class="px-6 py-4 text-slate-500 dark:text-slate-400">
                            Prioritas untuk perangkat yang masih dalam masa garansi aktif vendor.
                        </td>
                        <td class="px-6 py-4">
                            <label class="relative inline-flex items-center cursor-pointer">
                                <input checked="" class="sr-only peer" type="checkbox" value=""/>
                                <div class="w-11 h-6 bg-slate-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 dark:peer-focus:ring-blue-800 rounded-full peer dark:bg-slate-700 peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-primary"></div>
                            </label>
                        </td>
                        <td class="px-6 py-4 text-right">
                            <div class="flex justify-end gap-2">
                                <button class="p-2 rounded-lg text-slate-400 hover:text-primary hover:bg-blue-50 dark:hover:bg-blue-900/20 transition-all" title="Edit">
                                    <span class="material-symbols-outlined text-[20px]">edit</span>
                                </button>
                                <button class="p-2 rounded-lg text-slate-400 hover:text-red-500 hover:bg-red-50 dark:hover:bg-red-900/20 transition-all" title="Delete">
                                    <span class="material-symbols-outlined text-[20px]">delete</span>
                                </button>
                            </div>
                        </td>
                    </tr>
                    <!-- Row 4 -->
                    <tr class="group hover:bg-slate-50 dark:hover:bg-[#253246] transition-colors">
                        <td class="px-6 py-4">
                            <div class="font-medium text-slate-900 dark:text-white">Jabatan Pengguna</div>
                            <div class="text-xs text-slate-500 dark:text-slate-400">User Role</div>
                        </td>
                        <td class="px-6 py-4">
                            <span class="inline-flex items-center rounded-md bg-blue-50 dark:bg-blue-900/30 px-2 py-1 text-xs font-medium text-primary ring-1 ring-inset ring-blue-700/10 dark:ring-blue-700/30">0.10</span>
                        </td>
                        <td class="px-6 py-4 text-slate-600 dark:text-slate-300">
                            48 Jam
                        </td>
                        <td class="px-6 py-4 text-slate-500 dark:text-slate-400">
                            Bobot tambahan untuk pengguna level Direktur atau C-Level.
                        </td>
                        <td class="px-6 py-4">
                            <label class="relative inline-flex items-center cursor-pointer">
                                <input checked="" class="sr-only peer" type="checkbox" value=""/>
                                <div class="w-11 h-6 bg-slate-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 dark:peer-focus:ring-blue-800 rounded-full peer dark:bg-slate-700 peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-primary"></div>
                            </label>
                        </td>
                        <td class="px-6 py-4 text-right">
                            <div class="flex justify-end gap-2">
                                <button class="p-2 rounded-lg text-slate-400 hover:text-primary hover:bg-blue-50 dark:hover:bg-blue-900/20 transition-all" title="Edit">
                                    <span class="material-symbols-outlined text-[20px]">edit</span>
                                </button>
                                <button class="p-2 rounded-lg text-slate-400 hover:text-red-500 hover:bg-red-50 dark:hover:bg-red-900/20 transition-all" title="Delete">
                                    <span class="material-symbols-outlined text-[20px]">delete</span>
                                </button>
                            </div>
                        </td>
                    </tr>
                    <!-- Row 5 (Inactive) -->
                    <tr class="group bg-slate-50 dark:bg-[#15202e] hover:bg-slate-100 dark:hover:bg-[#1c2a3d] transition-colors opacity-75">
                        <td class="px-6 py-4">
                            <div class="font-medium text-slate-600 dark:text-slate-300">Riwayat Tiket</div>
                            <div class="text-xs text-slate-400 dark:text-slate-500">Ticket History</div>
                        </td>
                        <td class="px-6 py-4">
                            <span class="inline-flex items-center rounded-md bg-slate-100 dark:bg-slate-800 px-2 py-1 text-xs font-medium text-slate-600 dark:text-slate-400 ring-1 ring-inset ring-slate-500/10">0.00</span>
                        </td>
                        <td class="px-6 py-4 text-slate-500 dark:text-slate-500">
                            -
                        </td>
                        <td class="px-6 py-4 text-slate-500 dark:text-slate-500">
                            Kriteria berdasarkan jumlah tiket yang pernah dibuat pengguna (Deprecated).
                        </td>
                        <td class="px-6 py-4">
                            <label class="relative inline-flex items-center cursor-pointer">
                                <input class="sr-only peer" type="checkbox" value=""/>
                                <div class="w-11 h-6 bg-slate-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 dark:peer-focus:ring-blue-800 rounded-full peer dark:bg-slate-700 peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-primary"></div>
                            </label>
                        </td>
                        <td class="px-6 py-4 text-right">
                            <div class="flex justify-end gap-2">
                                <button class="p-2 rounded-lg text-slate-400 hover:text-primary hover:bg-blue-50 dark:hover:bg-blue-900/20 transition-all" title="Edit">
                                    <span class="material-symbols-outlined text-[20px]">edit</span>
                                </button>
                                <button class="p-2 rounded-lg text-slate-400 hover:text-red-500 hover:bg-red-50 dark:hover:bg-red-900/20 transition-all" title="Delete">
                                    <span class="material-symbols-outlined text-[20px]">delete</span>
                                </button>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
