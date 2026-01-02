@extends('admin.layouts.app')

@section('title', 'Edit Profile - Smart IT Helpdesk')

@section('content')
<div class="flex flex-col gap-6 p-4 md:p-8 max-w-[800px] mx-auto w-full">
    <!-- Breadcrumbs -->
    <div class="flex flex-wrap gap-2 text-sm">
        <a class="text-slate-500 hover:text-slate-700 dark:text-[#92a9c9] dark:hover:text-white transition-colors font-medium" href="{{ route('admin.dashboard') }}">Dashboard</a>
        <span class="text-slate-400 dark:text-[#92a9c9] font-medium">/</span>
        <span class="text-slate-800 dark:text-white font-medium">Edit Profile</span>
    </div>

    <!-- Page Heading -->
    <div class="flex flex-col gap-2">
        <h1 class="text-slate-900 dark:text-white text-3xl font-black leading-tight tracking-[-0.033em]">Edit Profile</h1>
        <p class="text-slate-500 dark:text-[#92a9c9] text-base font-normal">Update your personal information and password.</p>
    </div>

    <!-- Success Message -->
    @if(session('success'))
        <div class="p-4 mb-4 text-sm text-green-700 dark:text-green-400 rounded-lg bg-green-100 dark:bg-green-500/10 border border-green-200 dark:border-green-500/20" role="alert">
            <span class="font-medium">Success!</span> {{ session('success') }}
        </div>
    @endif

    <!-- Form -->
    <div class="rounded-xl border border-slate-200 dark:border-[#233348] bg-white dark:bg-[#1a232e] p-6">
        <form action="{{ route('admin.profile.update') }}" method="POST" enctype="multipart/form-data" class="flex flex-col gap-6">
            @csrf
            @method('PATCH')
            
            <!-- Current Avatar Preview -->
            <div class="flex flex-col gap-2">
                <span class="text-slate-700 dark:text-white text-sm font-medium">Profile Photo</span>
                <div class="flex items-center gap-4">
                    <div class="h-20 w-20 rounded-full bg-cover bg-center border border-slate-200 dark:border-[#233348]" 
                         style="background-image: url('{{ $user->avatar ? asset('storage/' . $user->avatar) : 'https://ui-avatars.com/api/?name=' . urlencode($user->name) }}');">
                    </div>
                    <div class="flex flex-col gap-1">
                        <input type="file" name="avatar" id="avatar" class="block w-full text-sm text-slate-500 dark:text-[#92a9c9]
                            file:mr-4 file:py-2 file:px-4
                            file:rounded-full file:border-0
                            file:text-sm file:font-semibold
                            file:bg-primary/10 file:text-primary
                            hover:file:bg-primary/20
                        "/>
                        <p class="text-xs text-slate-500 dark:text-[#92a9c9]">JPG, PNG or GIF (Max. 1MB)</p>
                    </div>
                </div>
                @error('avatar')
                    <p class="text-red-400 text-xs">{{ $message }}</p>
                @enderror
            </div>

            <!-- Name -->
            <div class="flex flex-col gap-2">
                <label for="name" class="text-slate-700 dark:text-white text-sm font-medium">Full Name</label>
                <input type="text" name="name" id="name" 
                       class="w-full rounded-lg border border-slate-300 dark:border-[#324867] bg-white dark:bg-[#111822] p-2.5 text-slate-900 dark:text-white placeholder-slate-400 dark:placeholder-[#92a9c9] focus:border-primary focus:ring-primary focus:outline-none transition-all @error('name') border-red-500 @enderror"
                       value="{{ old('name', $user->name) }}" required>
                @error('name')
                    <p class="text-red-400 text-xs">{{ $message }}</p>
                @enderror
            </div>

            <!-- Email (Read Only) -->
            <div class="flex flex-col gap-2">
                <label for="email" class="text-slate-700 dark:text-white text-sm font-medium">Email Address</label>
                <input type="email" value="{{ $user->email }}" disabled
                       class="w-full rounded-lg border border-slate-300 dark:border-[#324867] bg-slate-100 dark:bg-[#111822]/50 p-2.5 text-slate-500 dark:text-slate-400 cursor-not-allowed">
            </div>

            <div class="border-t border-slate-200 dark:border-[#233348] my-2"></div>

            <div class="flex flex-col gap-1">
                <h3 class="text-slate-900 dark:text-white text-lg font-bold">Change Password</h3>
                <p class="text-slate-500 dark:text-[#92a9c9] text-sm">Leave blank if you don't want to change password.</p>
            </div>

            <!-- Password -->
            <div class="flex flex-col gap-2">
                <label for="password" class="text-slate-700 dark:text-white text-sm font-medium">New Password</label>
                <input type="password" name="password" id="password" 
                       class="w-full rounded-lg border border-slate-300 dark:border-[#324867] bg-white dark:bg-[#111822] p-2.5 text-slate-900 dark:text-white placeholder-slate-400 dark:placeholder-[#92a9c9] focus:border-primary focus:ring-primary focus:outline-none transition-all @error('password') border-red-500 @enderror">
                @error('password')
                    <p class="text-red-400 text-xs">{{ $message }}</p>
                @enderror
            </div>

            <!-- Confirm Password -->
            <div class="flex flex-col gap-2">
                <label for="password_confirmation" class="text-slate-700 dark:text-white text-sm font-medium">Confirm New Password</label>
                <input type="password" name="password_confirmation" id="password_confirmation" 
                       class="w-full rounded-lg border border-slate-300 dark:border-[#324867] bg-white dark:bg-[#111822] p-2.5 text-slate-900 dark:text-white placeholder-slate-400 dark:placeholder-[#92a9c9] focus:border-primary focus:ring-primary focus:outline-none transition-all">
            </div>

            <!-- Actions -->
            <div class="flex items-center justify-end gap-3 pt-4 border-t border-slate-200 dark:border-[#233348]">
                <button type="submit" class="px-5 py-2.5 rounded-lg bg-primary text-white font-bold hover:bg-blue-600 shadow-lg shadow-blue-500/20 transition-all">
                    Save Changes
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
