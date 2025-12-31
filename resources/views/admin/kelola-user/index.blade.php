@extends('admin.layouts.app')

@section('title', 'Halaman Kelola Akun Admin - Smart IT Helpdesk')

@section('content')
<div class="flex flex-col gap-6 p-4 md:p-8 max-w-[1200px] mx-auto">
    <!-- Breadcrumbs -->
    <div class="flex flex-wrap gap-2 text-sm">
        <a class="text-slate-500 dark:text-[#92a9c9] hover:text-[#101822] dark:hover:text-white transition-colors font-medium" href="{{ route('admin.dashboard') }}">Dashboard</a>
        <span class="text-slate-500 dark:text-[#92a9c9] font-medium">/</span>
        <span class="text-[#101822] dark:text-white font-medium">Kelola Akun</span>
    </div>
    <!-- Page Heading & Actions -->
    <div class="flex flex-col sm:flex-row sm:items-end justify-between gap-4">
        <div class="flex flex-col gap-2">
            <h1 class="text-[#101822] dark:text-white text-3xl md:text-4xl font-black leading-tight tracking-[-0.033em]">Kelola Akun Pengguna</h1>
            <p class="text-slate-500 dark:text-[#92a9c9] text-base font-normal">Manage access for administrators and users.</p>
        </div>
        <button onclick="openModal()" class="flex items-center justify-center gap-2 rounded-lg h-10 px-5 bg-primary hover:bg-blue-600 text-white text-sm font-bold shadow-lg shadow-blue-500/20 transition-all">
            <span class="material-symbols-outlined" style="font-size: 20px;">add</span>
            <span class="truncate">Tambah Akun Baru</span>
        </button>
    </div>
    <!-- Success Message -->
    @if(session('success'))
        <div class="p-4 mb-4 text-sm text-green-700 dark:text-green-400 rounded-lg bg-green-100 dark:bg-green-500/10 border border-green-200 dark:border-green-500/20" role="alert">
            <span class="font-medium">Success!</span> {{ session('success') }}
        </div>
    @endif

    <!-- Validation Errors -->
    @if($errors->any())
        <div class="p-4 mb-4 text-sm text-red-700 dark:text-red-400 rounded-lg bg-red-100 dark:bg-red-500/10 border border-red-200 dark:border-red-500/20" role="alert">
            <ul class="list-disc list-inside">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- Stats Overview -->
    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
        <div class="flex flex-col gap-2 rounded-xl p-5 border border-slate-200 dark:border-[#233348] bg-white dark:bg-[#1a232e]">
            <div class="flex justify-between items-start">
                <p class="text-slate-500 dark:text-[#92a9c9] text-sm font-medium uppercase tracking-wider">Total Users</p>
                <span class="material-symbols-outlined text-slate-400 dark:text-[#92a9c9]">group</span>
            </div>
            <div class="flex items-baseline gap-2">
                <p class="text-[#101822] dark:text-white text-3xl font-bold">{{ $users->total() }}</p>
            </div>
        </div>
        <div class="flex flex-col gap-2 rounded-xl p-5 border border-slate-200 dark:border-[#233348] bg-white dark:bg-[#1a232e]">
            <div class="flex justify-between items-start">
                <p class="text-slate-500 dark:text-[#92a9c9] text-sm font-medium uppercase tracking-wider">Admins</p>
                <span class="material-symbols-outlined text-slate-400 dark:text-[#92a9c9]">admin_panel_settings</span>
            </div>
            <div class="flex items-baseline gap-2">
                <p class="text-[#101822] dark:text-white text-3xl font-bold">{{ \App\Models\User::where('role', 'admin')->count() }}</p>
            </div>
        </div>
        <div class="flex flex-col gap-2 rounded-xl p-5 border border-slate-200 dark:border-[#233348] bg-white dark:bg-[#1a232e]">
            <div class="flex justify-between items-start">
                <p class="text-slate-500 dark:text-[#92a9c9] text-sm font-medium uppercase tracking-wider">Users</p>
                <span class="material-symbols-outlined text-slate-400 dark:text-[#92a9c9]">person</span>
            </div>
            <div class="flex items-baseline gap-2">
                <p class="text-[#101822] dark:text-white text-3xl font-bold">{{ \App\Models\User::where('role', '!=', 'admin')->count() }}</p>
            </div>
        </div>
    </div>
    <!-- Filters & Toolbar -->
    <form method="GET" action="{{ route('admin.users.index') }}" class="flex flex-col md:flex-row justify-between items-center gap-4 bg-white dark:bg-[#1a232e] p-4 rounded-xl border border-slate-200 dark:border-[#233348]">
        <div class="relative w-full md:w-96">
            <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none text-slate-400 dark:text-[#92a9c9]">
                <span class="material-symbols-outlined">search</span>
            </div>
            <input name="search" value="{{ request('search') }}" class="block w-full rounded-lg border border-slate-200 dark:border-[#324867] bg-slate-50 dark:bg-[#111822] p-2.5 pl-10 text-sm text-[#101822] dark:text-white placeholder-slate-400 dark:placeholder-[#92a9c9] focus:border-primary focus:ring-primary focus:outline-none transition-all" placeholder="Search by name or email..." type="text"/>
        </div>
        <div class="flex w-full md:w-auto gap-3">
             <select name="department" onchange="this.form.submit()" class="rounded-lg border border-slate-200 dark:border-[#324867] bg-slate-50 dark:bg-[#111822] py-2 px-4 text-sm text-[#101822] dark:text-white focus:border-primary focus:ring-primary focus:outline-none">
                <option value="">Semua Jabatan</option>
                @foreach($departments as $dept)
                    <option value="{{ $dept->name }}" {{ request('department') == $dept->name ? 'selected' : '' }}>{{ $dept->name }}</option>
                @endforeach
            </select>
            <select name="role" onchange="this.form.submit()" class="rounded-lg border border-slate-200 dark:border-[#324867] bg-slate-50 dark:bg-[#111822] py-2 px-4 text-sm text-[#101822] dark:text-white focus:border-primary focus:ring-primary focus:outline-none">
                <option value="">Semua Role</option>
                <option value="admin" {{ request('role') == 'admin' ? 'selected' : '' }}>Administrator</option>
                <option value="employee" {{ request('role') == 'employee' ? 'selected' : '' }}>Employee</option>
            </select>
            <button type="submit" class="hidden">Search</button>
        </div>
    </form>
    <!-- Data Table -->
    <div class="rounded-xl border border-slate-200 dark:border-[#233348] overflow-hidden bg-white dark:bg-[#1a232e]">
        <div class="overflow-x-auto">
            <table class="w-full text-left text-sm text-slate-500 dark:text-[#92a9c9]">
                <thead class="bg-slate-100 dark:bg-[#233348] text-xs uppercase text-[#101822] dark:text-white font-semibold">
                    <tr>
                        <th class="px-6 py-4" scope="col">User</th>
                        <th class="px-6 py-4" scope="col">Jabatan</th>
                        <th class="px-6 py-4" scope="col">Role</th>
                        <th class="px-6 py-4" scope="col">Email Verified</th>
                        <th class="px-6 py-4" scope="col">Joined Date</th>
                        <th class="px-6 py-4 text-right" scope="col">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-200 dark:divide-[#233348]">
                    @forelse($users as $user)
                    <tr class="hover:bg-slate-50 dark:hover:bg-[#233348]/50 transition-colors group">
                        <td class="px-6 py-4">
                            <div class="flex items-center gap-3">
                                <div class="h-10 w-10 flex-none rounded-full bg-cover bg-center border border-slate-200 dark:border-transparent" style='background-image: url("https://ui-avatars.com/api/?name={{ urlencode($user->name) }}");'></div>
                                <div>
                                    <div class="font-medium text-[#101822] dark:text-white">{{ $user->name }}</div>
                                    <div class="text-xs">{{ $user->email }}</div>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            @if($user->department)
                                <span class="inline-flex items-center rounded-md bg-purple-50 dark:bg-purple-900/30 px-2 py-1 text-xs font-medium text-purple-700 dark:text-purple-400 ring-1 ring-inset ring-purple-700/10 dark:ring-purple-700/30">
                                    {{ $user->department }}
                                </span>
                            @else
                                <span class="text-slate-400">-</span>
                            @endif
                        </td>
                        <td class="px-6 py-4">
                            <span class="inline-flex items-center gap-1 rounded-full px-2.5 py-0.5 text-xs font-medium border
                            {{ $user->role === 'admin' ? 'bg-blue-50 dark:bg-primary/10 text-primary border-blue-200 dark:border-primary/20' : 'bg-slate-100 dark:bg-gray-700/30 text-slate-600 dark:text-gray-300 border-slate-200 dark:border-gray-600' }}">
                                <span class="material-symbols-outlined text-[14px]">{{ $user->role === 'admin' ? 'shield_person' : 'person' }}</span>
                                {{ ucfirst($user->role) }}
                            </span>
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex items-center gap-2">
                                @if($user->email_verified_at)
                                    <div class="h-2.5 w-2.5 rounded-full bg-emerald-500 shadow-[0_0_8px_rgba(16,185,129,0.5)]"></div>
                                    <span class="text-[#101822] dark:text-white">Verified</span>
                                @else
                                    <div class="h-2.5 w-2.5 rounded-full bg-yellow-500"></div>
                                    <span class="text-[#101822] dark:text-white">Unverified</span>
                                @endif
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            <div>{{ $user->created_at->format('M d, Y') }}</div>
                            <div class="text-xs">{{ $user->created_at->format('h:i A') }}</div>
                        </td>
                        <td class="px-6 py-4 text-right">
                            <div class="flex justify-end gap-2">
                                <button onclick='openEditModal(@json($user))' class="rounded-lg p-2 text-blue-600 hover:bg-blue-50 hover:text-blue-700 dark:text-blue-400 dark:hover:bg-blue-900/30 dark:hover:text-blue-300 transition-colors" title="Edit User">
                                    <span class="material-symbols-outlined text-[20px]">edit</span>
                                </button>
                                <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" class="inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus user ini?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="rounded-lg p-2 text-red-600 hover:bg-red-50 hover:text-red-700 dark:text-red-400 dark:hover:bg-red-900/30 dark:hover:text-red-300 transition-colors" title="Delete User">
                                        <span class="material-symbols-outlined text-[20px]">delete</span>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="px-6 py-4 text-center">No users found.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <!-- Pagination -->
        <div class="flex flex-col items-center justify-between gap-4 border-t border-slate-200 dark:border-[#233348] bg-white dark:bg-[#1a232e] px-6 py-4 sm:flex-row">
            {{ $users->links() }}
        </div>
    </div>
</div>

<!-- Create/Edit User Modal -->
<div id="createUserModal" class="fixed inset-0 z-50 hidden overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
    <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
        <!-- Background overlay -->
        <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" aria-hidden="true" onclick="closeModal()"></div>

        <!-- Modal panel -->
        <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
        <div class="inline-block align-bottom bg-white dark:bg-[#1a232e] rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full border border-slate-200 dark:border-[#233348]">
            <form id="userForm" action="{{ route('admin.users.store') }}" method="POST">
                @csrf
                <div id="methodField"></div>
                <div class="bg-white dark:bg-[#1a232e] px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                    <h3 class="text-lg leading-6 font-medium text-[#101822] dark:text-white mb-4" id="modal-title">Tambah Akun Baru</h3>
                    <div class="space-y-4">
                        <!-- Name -->
                        <div>
                            <label for="name" class="block text-sm font-medium text-slate-700 dark:text-[#92a9c9]">Nama Lengkap</label>
                            <input type="text" name="name" id="name" required class="mt-1 block w-full rounded-md border-slate-300 dark:border-[#324867] bg-white dark:bg-[#111822] text-[#101822] dark:text-white shadow-sm focus:border-primary focus:ring-primary sm:text-sm">
                        </div>
                        
                        <!-- Email -->
                        <div>
                            <label for="email" class="block text-sm font-medium text-slate-700 dark:text-[#92a9c9]">Email Address</label>
                            <input type="email" name="email" id="email" required class="mt-1 block w-full rounded-md border-slate-300 dark:border-[#324867] bg-white dark:bg-[#111822] text-[#101822] dark:text-white shadow-sm focus:border-primary focus:ring-primary sm:text-sm">
                        </div>
                        <!-- Password Info -->
                        <div id="password-info" class="hidden rounded-md bg-blue-50 dark:bg-blue-900/20 p-4">
                            <div class="flex">
                                <div class="flex-shrink-0">
                                    <span class="material-symbols-outlined text-blue-400">info</span>
                                </div>
                                <div class="ml-3">
                                    <h3 class="text-sm font-medium text-blue-800 dark:text-blue-200">Password Otomatis</h3>
                                    <div class="mt-2 text-sm text-blue-700 dark:text-blue-300">
                                        <p>Password akan dibuat secara otomatis dan dikirimkan ke alamat email pengguna di atas.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Password -->
                        <div id="password-container" class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <div>
                                <label for="password" class="block text-sm font-medium text-slate-700 dark:text-[#92a9c9]">Password</label>
                                <input type="password" name="password" id="password" class="mt-1 block w-full rounded-md border-slate-300 dark:border-[#324867] bg-white dark:bg-[#111822] text-[#101822] dark:text-white shadow-sm focus:border-primary focus:ring-primary sm:text-sm">
                            </div>
                            <div>
                                <label for="password_confirmation" class="block text-sm font-medium text-slate-700 dark:text-[#92a9c9]">Confirm Password</label>
                                <input type="password" name="password_confirmation" id="password_confirmation" class="mt-1 block w-full rounded-md border-slate-300 dark:border-[#324867] bg-white dark:bg-[#111822] text-[#101822] dark:text-white shadow-sm focus:border-primary focus:ring-primary sm:text-sm">
                            </div>
                        </div>

                        <!-- Role & Jabatan -->
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <div>
                                <label for="role" class="block text-sm font-medium text-slate-700 dark:text-[#92a9c9]">Role</label>
                                <select name="role" id="role" required class="mt-1 block w-full rounded-md border-slate-300 dark:border-[#324867] bg-white dark:bg-[#111822] text-[#101822] dark:text-white shadow-sm focus:border-primary focus:ring-primary sm:text-sm">
                                    <option value="employee">Employee</option>
                                    <option value="admin">Administrator</option>
                                </select>
                            </div>
                            <div>
                                <label for="department" class="block text-sm font-medium text-slate-700 dark:text-[#92a9c9]">Jabatan</label>
                                <select name="department" id="department" class="mt-1 block w-full rounded-md border-slate-300 dark:border-[#324867] bg-white dark:bg-[#111822] text-[#101822] dark:text-white shadow-sm focus:border-primary focus:ring-primary sm:text-sm">
                                    <option value="">Select Department</option>
                                    @foreach($departments as $department)
                                        <option value="{{ $department->name }}">{{ $department->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="bg-slate-50 dark:bg-[#111822] px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse border-t border-slate-200 dark:border-[#233348]">
                    <button type="submit" id="submitButton" class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-primary text-base font-medium text-white hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary sm:ml-3 sm:w-auto sm:text-sm">
                        Simpan Akun
                    </button>
                    <button type="button" onclick="closeModal()" class="mt-3 w-full inline-flex justify-center rounded-md border border-slate-300 dark:border-[#324867] shadow-sm px-4 py-2 bg-white dark:bg-[#1a232e] text-base font-medium text-slate-700 dark:text-[#92a9c9] hover:bg-slate-50 dark:hover:bg-[#111822] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
                        Batal
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
<script>
    // Store original options to reset when switching between modes
    let originalDepartmentOptions = "";

    document.addEventListener('DOMContentLoaded', function() {
        const deptSelect = document.getElementById('department');
        if(deptSelect) {
            originalDepartmentOptions = deptSelect.innerHTML;
        }
    });

    function openModal() {
        document.getElementById('modal-title').innerText = 'Tambah Akun Baru';
        document.getElementById('userForm').action = "{{ route('admin.users.store') }}";
        document.getElementById('methodField').innerHTML = '';
        document.getElementById('submitButton').innerText = 'Simpan & Kirim Email';
        
        // Reset fields
        document.getElementById('name').value = '';
        document.getElementById('email').value = '';
        document.getElementById('password').value = '';
        document.getElementById('password_confirmation').value = '';
        document.getElementById('role').value = 'employee';
        
        // Reset department options and selection
        const deptSelect = document.getElementById('department');
        if(originalDepartmentOptions) deptSelect.innerHTML = originalDepartmentOptions;
        deptSelect.value = '';

        // Hide Password fields for Create (Auto-generated)
        document.getElementById('password-container').classList.add('hidden');
        document.getElementById('password-info').classList.remove('hidden');
        document.getElementById('password').required = false;
        document.getElementById('password_confirmation').required = false;

        document.getElementById('createUserModal').classList.remove('hidden');
    }

    function openEditModal(user) {
        document.getElementById('modal-title').innerText = 'Edit Akun Pengguna';
        document.getElementById('userForm').action = "{{ url('admin/kelola-akun') }}/" + user.id;
        document.getElementById('methodField').innerHTML = '@method("PUT")';
        document.getElementById('submitButton').innerText = 'Update Akun';

        // Fill fields
        document.getElementById('name').value = user.name;
        document.getElementById('email').value = user.email;
        document.getElementById('role').value = user.role;
        
        // Handle department selection with fuzzy matching
        const deptSelect = document.getElementById('department');
        const userDept = user.department;
        
        // Reset options first
        if(originalDepartmentOptions) deptSelect.innerHTML = originalDepartmentOptions;
        
        deptSelect.value = ""; // Reset value
        
        if (userDept) {
            // Try direct assignment
            deptSelect.value = userDept;
            
            // If literal match failed, try case-insensitive/trimmed match
            if (deptSelect.value === "") {
                for (let i = 0; i < deptSelect.options.length; i++) {
                    const optValue = deptSelect.options[i].value;
                    if (optValue && optValue.trim().toLowerCase() === userDept.trim().toLowerCase()) {
                        deptSelect.selectedIndex = i;
                        break;
                    }
                }
            }
             // If still no match (custom text), append it
             if (deptSelect.value === "" && userDept) {
                 const newOption = document.createElement('option');
                 newOption.value = userDept;
                 newOption.text = userDept + " (Current)";
                 newOption.selected = true;
                 deptSelect.add(newOption);
             }
        }
        
        // Show Password fields for Edit (Optional reset)
        document.getElementById('password-container').classList.remove('hidden');
        document.getElementById('password-info').classList.add('hidden');
        document.getElementById('password').required = false;
        document.getElementById('password_confirmation').required = false;
        document.getElementById('password').value = '';
        document.getElementById('password_confirmation').value = '';

        document.getElementById('createUserModal').classList.remove('hidden');
    }

    function closeModal() {
        document.getElementById('createUserModal').classList.add('hidden');
    }
</script>
@endsection
