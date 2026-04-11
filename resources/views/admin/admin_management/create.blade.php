@extends('layouts.admin')

@section('title', 'Tambah Admin')
@section('header_title', 'Tambah Admin Baru')

@section('content')
<div class="max-w-3xl mx-auto">
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
        <div class="p-6 border-b border-gray-100 flex items-center gap-4">
            <a href="{{ route('admin.management.index') }}" class="w-10 h-10 rounded-full bg-gray-50 flex items-center justify-center text-gray-500 hover:bg-gray-100 hover:text-gray-700 transition">
                <i class="bi bi-arrow-left"></i>
            </a>
            <div>
                <h3 class="font-black text-[#1a237e] text-lg">Form Tambah Admin</h3>
                <p class="text-xs text-gray-400">Silakan lengkapi data admin baru di bawah ini</p>
            </div>
        </div>

        <form action="{{ route('admin.management.store') }}" method="POST" enctype="multipart/form-data" class="p-6 space-y-6">
            @csrf

            <!-- Informasi Dasar -->
            <div>
                <h4 class="text-sm font-bold text-gray-700 mb-4 flex items-center gap-2">
                    <i class="bi bi-person-badge text-[#1a237e]"></i> Informasi Dasar
                </h4>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-bold text-gray-700 mb-2">Nama Lengkap</label>
                        <input type="text" name="name" value="{{ old('name') }}" required
                            class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-[#1a237e] focus:ring-2 focus:ring-blue-100 outline-none transition text-sm">
                        @error('name') <span class="text-xs text-red-500">{{ $message }}</span> @enderror
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-gray-700 mb-2">No. WhatsApp</label>
                        <input type="text" name="no_hp" value="{{ old('no_hp') }}" required placeholder="Contoh: 08123456789"
                            class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-[#1a237e] focus:ring-2 focus:ring-blue-100 outline-none transition text-sm">
                        @error('no_hp') <span class="text-xs text-red-500">{{ $message }}</span> @enderror
                    </div>
                </div>
            </div>

            <!-- Detail Admin -->
            <div class="pt-4 border-t border-gray-100">
                <h4 class="text-sm font-bold text-gray-700 mb-4 flex items-center gap-2">
                    <i class="bi bi-shield-check text-[#1a237e]"></i> Detail Admin
                </h4>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-bold text-gray-700 mb-2">Email Login</label>
                        <input type="email" name="email" value="{{ old('email') }}" required
                            class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-[#1a237e] focus:ring-2 focus:ring-blue-100 outline-none transition text-sm">
                        @error('email') <span class="text-xs text-red-500">{{ $message }}</span> @enderror
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-gray-700 mb-2">Jabatan / Divisi (Opsional)</label>
                        <input type="text" name="jabatan" value="{{ old('jabatan') }}" placeholder="Contoh: Customer Service"
                            class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-[#1a237e] focus:ring-2 focus:ring-blue-100 outline-none transition text-sm">
                        @error('jabatan') <span class="text-xs text-red-500">{{ $message }}</span> @enderror
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-gray-700 mb-2">Password</label>
                        <input type="password" name="password" required
                            class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-[#1a237e] focus:ring-2 focus:ring-blue-100 outline-none transition text-sm">
                        @error('password') <span class="text-xs text-red-500">{{ $message }}</span> @enderror
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-gray-700 mb-2">Konfirmasi Password</label>
                        <input type="password" name="password_confirmation" required
                            class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-[#1a237e] focus:ring-2 focus:ring-blue-100 outline-none transition text-sm">
                    </div>
                    <div class="md:col-span-2">
                        <label class="block text-xs font-bold text-gray-700 mb-2">Foto Profil (Opsional)</label>
                        <input type="file" name="foto_profil" accept="image/*"
                            class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-[#1a237e] focus:ring-2 focus:ring-blue-100 outline-none transition text-sm file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-xs file:font-bold file:bg-blue-50 file:text-[#1a237e]">
                        <p class="text-[10px] text-gray-400 mt-1">Format: JPG, PNG. Maks 2MB.</p>
                        @error('foto_profil') <span class="text-xs text-red-500">{{ $message }}</span> @enderror
                    </div>
                </div>
            </div>

            <!-- Submit -->
            <div class="pt-6 border-t border-gray-100 flex justify-end gap-3">
                <button type="reset" class="px-6 py-3 rounded-xl font-bold text-sm text-gray-500 bg-gray-50 hover:bg-gray-100 transition">Reset</button>
                <button type="submit" class="px-8 py-3 bg-[#1a237e] text-white rounded-xl font-bold text-sm hover:bg-blue-800 transition shadow-lg shadow-blue-900/20">Simpan Admin Baru</button>
            </div>
        </form>
    </div>
</div>
@endsection
