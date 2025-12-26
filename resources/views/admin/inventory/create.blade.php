@extends('admin.layouts.app')

@section('title', 'Tambah Inventaris - Smart IT Helpdesk')

@section('content')
<div class="flex flex-col gap-6 p-4 md:p-8 max-w-[800px] mx-auto w-full">
    <!-- Breadcrumbs -->
    <div class="flex flex-wrap gap-2 text-sm">
        <a class="text-[#92a9c9] hover:text-white transition-colors font-medium" href="{{ route('admin.dashboard') }}">Dashboard</a>
        <span class="text-[#92a9c9] font-medium">/</span>
        <a class="text-[#92a9c9] hover:text-white transition-colors font-medium" href="{{ route('admin.inventory.index') }}">Kelola Inventaris</a>
        <span class="text-[#92a9c9] font-medium">/</span>
        <span class="text-white font-medium">Tambah Aset</span>
    </div>

    <!-- Page Heading -->
    <div class="flex flex-col gap-2">
        <h1 class="text-white text-3xl font-black leading-tight tracking-[-0.033em]">Tambah Aset Baru</h1>
        <p class="text-[#92a9c9] text-base font-normal">Assign new equipment to a user.</p>
    </div>

    <!-- Form -->
    <div class="rounded-xl border border-[#233348] bg-[#1a232e] p-6">
        <form action="{{ route('admin.inventory.store') }}" method="POST" class="flex flex-col gap-6">
            @csrf
            
            <!-- User Selection -->
            <div class="flex flex-col gap-2">
                <label for="user_id" class="text-white text-sm font-medium">Pilih Pengguna</label>
                <select name="user_id" id="user_id" class="w-full rounded-lg border border-[#324867] bg-[#111822] p-2.5 text-white placeholder-[#92a9c9] focus:border-primary focus:ring-primary focus:outline-none transition-all @error('user_id') border-red-500 @enderror">
                    <option value="">-- Pilih Pengguna --</option>
                    @foreach($users as $user)
                        <option value="{{ $user->id }}" {{ old('user_id') == $user->id ? 'selected' : '' }}>{{ $user->name }} ({{ $user->email }})</option>
                    @endforeach
                </select>
                @error('user_id')
                    <p class="text-red-400 text-xs">{{ $message }}</p>
                @enderror
            </div>

            <!-- Item Name -->
            <div class="flex flex-col gap-2">
                <label for="item_name" class="text-white text-sm font-medium">Nama Barang</label>
                <input type="text" name="item_name" id="item_name" 
                       class="w-full rounded-lg border border-[#324867] bg-[#111822] p-2.5 text-white placeholder-[#92a9c9] focus:border-primary focus:ring-primary focus:outline-none transition-all @error('item_name') border-red-500 @enderror"
                       placeholder="Contoh: MacBook Pro M1 2020" value="{{ old('item_name') }}">
                @error('item_name')
                    <p class="text-red-400 text-xs">{{ $message }}</p>
                @enderror
            </div>

            <!-- Serial Number -->
            <div class="flex flex-col gap-2">
                <label for="serial_number" class="text-white text-sm font-medium">Serial Number / Asset Tag</label>
                <input type="text" name="serial_number" id="serial_number" 
                       class="w-full rounded-lg border border-[#324867] bg-[#111822] p-2.5 text-white placeholder-[#92a9c9] focus:border-primary focus:ring-primary focus:outline-none transition-all @error('serial_number') border-red-500 @enderror"
                       placeholder="Contoh: C02XYZ123ABC" value="{{ old('serial_number') }}">
                @error('serial_number')
                    <p class="text-red-400 text-xs">{{ $message }}</p>
                @enderror
            </div>

            <!-- Status -->
            <div class="flex flex-col gap-2">
                <label for="status" class="text-white text-sm font-medium">Status Barang</label>
                <select name="status" id="status" class="w-full rounded-lg border border-[#324867] bg-[#111822] p-2.5 text-white placeholder-[#92a9c9] focus:border-primary focus:ring-primary focus:outline-none transition-all @error('status') border-red-500 @enderror">
                    <option value="active" {{ old('status') == 'active' ? 'selected' : '' }}>Active (Digunakan)</option>
                    <option value="maintenance" {{ old('status') == 'maintenance' ? 'selected' : '' }}>Maintenance (Perbaikan)</option>
                    <option value="inactive" {{ old('status') == 'inactive' ? 'selected' : '' }}>Inactive (Rusak/Tidak Digunakan)</option>
                </select>
                @error('status')
                    <p class="text-red-400 text-xs">{{ $message }}</p>
                @enderror
            </div>

            <!-- Description -->
            <div class="flex flex-col gap-2">
                <label for="description" class="text-white text-sm font-medium">Deskripsi / Spesifikasi</label>
                <textarea name="description" id="description" rows="4" 
                          class="w-full rounded-lg border border-[#324867] bg-[#111822] p-2.5 text-white placeholder-[#92a9c9] focus:border-primary focus:ring-primary focus:outline-none transition-all @error('description') border-red-500 @enderror"
                          placeholder="Tulis detail spesifikasi atau kondisi barang...">{{ old('description') }}</textarea>
                @error('description')
                    <p class="text-red-400 text-xs">{{ $message }}</p>
                @enderror
            </div>

            <!-- Actions -->
            <div class="flex items-center justify-end gap-3 pt-4 border-t border-[#233348]">
                <a href="{{ route('admin.inventory.index') }}" class="px-5 py-2.5 rounded-lg text-[#92a9c9] font-medium hover:bg-[#233348] hover:text-white transition-colors">
                    Batal
                </a>
                <button type="submit" class="px-5 py-2.5 rounded-lg bg-primary text-white font-bold hover:bg-blue-600 shadow-lg shadow-blue-500/20 transition-all">
                    Simpan Aset
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
