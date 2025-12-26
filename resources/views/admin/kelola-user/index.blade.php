@extends('admin.layouts.app')

@section('title', 'Halaman Kelola Akun Admin - Smart IT Helpdesk')

@section('content')
<div class="flex flex-col gap-6 p-4 md:p-8 max-w-[1200px] mx-auto">
    <!-- Breadcrumbs -->
    <div class="flex flex-wrap gap-2 text-sm">
        <a class="text-[#92a9c9] hover:text-white transition-colors font-medium" href="{{ route('admin.dashboard') }}">Dashboard</a>
        <span class="text-[#92a9c9] font-medium">/</span>
        <span class="text-white font-medium">Kelola Akun</span>
    </div>
    <!-- Page Heading & Actions -->
    <div class="flex flex-col sm:flex-row sm:items-end justify-between gap-4">
        <div class="flex flex-col gap-2">
            <h1 class="text-white text-3xl md:text-4xl font-black leading-tight tracking-[-0.033em]">Kelola Akun Pengguna</h1>
            <p class="text-[#92a9c9] text-base font-normal">Manage access for administrators and users.</p>
        </div>
        <button class="flex items-center justify-center gap-2 rounded-lg h-10 px-5 bg-primary hover:bg-blue-600 text-white text-sm font-bold shadow-lg shadow-blue-500/20 transition-all">
            <span class="material-symbols-outlined" style="font-size: 20px;">add</span>
            <span class="truncate">Tambah Akun Baru</span>
        </button>
    </div>
    <!-- Stats Overview -->
    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
        <div class="flex flex-col gap-2 rounded-xl p-5 border border-[#233348] bg-[#1a232e]">
            <div class="flex justify-between items-start">
                <p class="text-[#92a9c9] text-sm font-medium uppercase tracking-wider">Total Users</p>
                <span class="material-symbols-outlined text-[#92a9c9]">group</span>
            </div>
            <div class="flex items-baseline gap-2">
                <p class="text-white text-3xl font-bold">{{ $users->total() }}</p>
            </div>
        </div>
        <div class="flex flex-col gap-2 rounded-xl p-5 border border-[#233348] bg-[#1a232e]">
            <div class="flex justify-between items-start">
                <p class="text-[#92a9c9] text-sm font-medium uppercase tracking-wider">Admins</p>
                <span class="material-symbols-outlined text-[#92a9c9]">admin_panel_settings</span>
            </div>
            <div class="flex items-baseline gap-2">
                <p class="text-white text-3xl font-bold">{{ \App\Models\User::where('role', 'admin')->count() }}</p>
            </div>
        </div>
        <div class="flex flex-col gap-2 rounded-xl p-5 border border-[#233348] bg-[#1a232e]">
            <div class="flex justify-between items-start">
                <p class="text-[#92a9c9] text-sm font-medium uppercase tracking-wider">Users</p>
                <span class="material-symbols-outlined text-[#92a9c9]">person</span>
            </div>
            <div class="flex items-baseline gap-2">
                <p class="text-white text-3xl font-bold">{{ \App\Models\User::where('role', '!=', 'admin')->count() }}</p>
            </div>
        </div>
    </div>
    <!-- Filters & Toolbar -->
    <div class="flex flex-col md:flex-row justify-between items-center gap-4 bg-[#1a232e] p-4 rounded-xl border border-[#233348]">
        <div class="relative w-full md:w-96">
            <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none text-[#92a9c9]">
                <span class="material-symbols-outlined">search</span>
            </div>
            <input class="block w-full rounded-lg border border-[#324867] bg-[#111822] p-2.5 pl-10 text-sm text-white placeholder-[#92a9c9] focus:border-primary focus:ring-primary focus:outline-none transition-all" placeholder="Search by name, email, or role..." type="text"/>
        </div>
        <div class="flex w-full md:w-auto gap-3">
            <select class="rounded-lg border border-[#324867] bg-[#111822] py-2 px-4 text-sm text-white focus:border-primary focus:ring-primary focus:outline-none">
                <option value="">All Roles</option>
                <option value="admin">Administrator</option>
                <option value="employee">Employee</option>
            </select>
        </div>
    </div>
    <!-- Data Table -->
    <div class="rounded-xl border border-[#233348] overflow-hidden bg-[#1a232e]">
        <div class="overflow-x-auto">
            <table class="w-full text-left text-sm text-[#92a9c9]">
                <thead class="bg-[#233348] text-xs uppercase text-white font-semibold">
                    <tr>
                        <th class="px-6 py-4" scope="col">User</th>
                        <th class="px-6 py-4" scope="col">Role</th>
                        <th class="px-6 py-4" scope="col">Email Verified</th>
                        <th class="px-6 py-4" scope="col">Joined Date</th>
                        <th class="px-6 py-4 text-right" scope="col">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-[#233348]">
                    @forelse($users as $user)
                    <tr class="hover:bg-[#233348]/50 transition-colors group">
                        <td class="px-6 py-4">
                            <div class="flex items-center gap-3">
                                <div class="h-10 w-10 flex-none rounded-full bg-cover bg-center" style='background-image: url("https://ui-avatars.com/api/?name={{ urlencode($user->name) }}");'></div>
                                <div>
                                    <div class="font-medium text-white">{{ $user->name }}</div>
                                    <div class="text-xs">{{ $user->email }}</div>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            <span class="inline-flex items-center gap-1 rounded-full px-2.5 py-0.5 text-xs font-medium border
                            {{ $user->role === 'admin' ? 'bg-primary/10 text-primary border-primary/20' : 'bg-gray-700/30 text-gray-300 border-gray-600' }}">
                                <span class="material-symbols-outlined text-[14px]">{{ $user->role === 'admin' ? 'shield_person' : 'person' }}</span>
                                {{ ucfirst($user->role) }}
                            </span>
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex items-center gap-2">
                                @if($user->email_verified_at)
                                    <div class="h-2.5 w-2.5 rounded-full bg-emerald-500 shadow-[0_0_8px_rgba(16,185,129,0.5)]"></div>
                                    <span class="text-white">Verified</span>
                                @else
                                    <div class="h-2.5 w-2.5 rounded-full bg-yellow-500"></div>
                                    <span class="text-white">Unverified</span>
                                @endif
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            <div>{{ $user->created_at->format('M d, Y') }}</div>
                            <div class="text-xs">{{ $user->created_at->format('h:i A') }}</div>
                        </td>
                        <td class="px-6 py-4 text-right">
                            <div class="flex justify-end gap-2 opacity-100 sm:opacity-0 sm:group-hover:opacity-100 transition-opacity">
                                <button class="rounded-lg p-2 text-[#92a9c9] hover:bg-primary/20 hover:text-white transition-colors" title="Edit User">
                                    <span class="material-symbols-outlined text-[20px]">edit</span>
                                </button>
                                <button class="rounded-lg p-2 text-[#92a9c9] hover:bg-red-500/20 hover:text-red-400 transition-colors" title="Delete User">
                                    <span class="material-symbols-outlined text-[20px]">delete</span>
                                </button>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="px-6 py-4 text-center">No users found.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <!-- Pagination -->
        <div class="flex flex-col items-center justify-between gap-4 border-t border-[#233348] bg-[#1a232e] px-6 py-4 sm:flex-row">
            {{ $users->links() }}
        </div>
    </div>
</div>
@endsection
