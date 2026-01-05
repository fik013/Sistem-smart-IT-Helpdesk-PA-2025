@extends('layouts.app')

@section('content')
    <div class="flex flex-col gap-6">
        <div class="flex flex-col gap-2">
            <h1 class="text-3xl font-bold text-slate-900 dark:text-white">Kelola Profile</h1>
            <p class="text-slate-500 dark:text-slate-400">Perbarui informasi profil, foto, dan keamanan akun Anda.</p>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
            <!-- Left Column: Profile Info & Avatar -->
            <div class="flex flex-col gap-6">
                <!-- Profile Information -->
                <div class="p-6 bg-white dark:bg-[#1e293b] rounded-xl border border-slate-200 dark:border-[#324867] shadow-sm">
                    <h2 class="text-lg font-bold text-slate-900 dark:text-white mb-4">Informasi Pribadi</h2>
                    @include('user.profile.partials.update-profile-information-form')
                </div>
            </div>

            <!-- Right Column: Password & Security -->
            <div class="flex flex-col gap-6">
                <!-- Update Password -->
                <div class="p-6 bg-white dark:bg-[#1e293b] rounded-xl border border-slate-200 dark:border-[#324867] shadow-sm">
                     <h2 class="text-lg font-bold text-slate-900 dark:text-white mb-4">Ubah Password</h2>
                    @include('user.profile.partials.update-password-form')
                </div>
            </div>
        </div>
    </div>
@endsection
