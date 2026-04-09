@extends('layouts.admin')

@section('title', 'Tambah Pelanggan')
@section('header_title', 'Registrasi Pelanggan Baru')

@section('content')
<div class="max-w-3xl mx-auto">
    <div class="mb-6">
        <a href="{{ route('admin.pelanggan.index') }}" class="text-[#1a237e] font-bold text-sm flex items-center gap-2 hover:text-blue-700 transition">
            <i class="bi bi-arrow-left"></i>
            Kembali ke Daftar Pelanggan
        </a>
    </div>

    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
        <form action="{{ route('admin.pelanggan.store') }}" method="POST">
            @csrf
            
            <div class="p-8 border-b border-gray-100 bg-gray-50/50">
                <h3 class="font-black text-[#1a237e] text-lg mb-1 italic">Data Akun Pelanggan</h3>
                <p class="text-xs text-gray-400 uppercase font-bold tracking-widest">Informasi dasar untuk akses sistem</p>
            </div>

            <div class="p-8 space-y-6">
                <!-- Nama -->
                <div>
                    <label for="name" class="block text-[10px] font-black uppercase text-gray-400 tracking-widest mb-2">Nama Lengkap <span class="text-red-500">*</span></label>
                    <input type="text" name="name" id="name" value="{{ old('name') }}" required placeholder="Nama lengkap pelanggan" 
                        class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-[#fbc02d] focus:border-[#fbc02d] outline-none transition text-sm font-semibold">
                    @error('name') <p class="text-red-500 text-[10px] mt-1 font-bold italic">{{ $message }}</p> @enderror
                </div>

                <!-- Email -->
                <div>
                    <label for="email" class="block text-[10px] font-black uppercase text-gray-400 tracking-widest mb-2">Alamat Email <span class="text-red-500">*</span></label>
                    <input type="email" name="email" id="email" value="{{ old('email') }}" required placeholder="email@example.com" 
                        class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-[#fbc02d] focus:border-[#fbc02d] outline-none transition text-sm font-semibold">
                    @error('email') <p class="text-red-500 text-[10px] mt-1 font-bold italic">{{ $message }}</p> @enderror
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Password -->
                    <div>
                        <label for="password" class="block text-[10px] font-black uppercase text-gray-400 tracking-widest mb-2">Password <span class="text-red-500">*</span></label>
                        <div class="relative">
                            <input type="password" name="password" id="password" required placeholder="Minimal 8 karakter" 
                                class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-[#fbc02d] focus:border-[#fbc02d] outline-none transition text-sm font-semibold">
                            <button type="button" class="password-toggle absolute right-4 top-1/2 -translate-y-1/2 text-gray-400 hover:text-[#1a237e] transition">
                                <i class="bi bi-eye"></i>
                            </button>
                        </div>
                    </div>
                    <!-- Confirm Password -->
                    <div>
                        <label for="password_confirmation" class="block text-[10px] font-black uppercase text-gray-400 tracking-widest mb-2">Konfirmasi Password <span class="text-red-500">*</span></label>
                        <div class="relative">
                            <input type="password" name="password_confirmation" id="password_confirmation" required placeholder="Ulangi password" 
                                class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-[#fbc02d] focus:border-[#fbc02d] outline-none transition text-sm font-semibold">
                            <button type="button" class="password-toggle absolute right-4 top-1/2 -translate-y-1/2 text-gray-400 hover:text-[#1a237e] transition">
                                <i class="bi bi-eye"></i>
                            </button>
                        </div>
                    </div>
                    @error('password') <div class="col-span-2"><p class="text-red-500 text-[10px] mt-1 font-bold italic">{{ $message }}</p></div> @enderror
                </div>

                <!-- No HP -->
                <div>
                    <label for="no_hp" class="block text-[10px] font-black uppercase text-gray-400 tracking-widest mb-2">Nomor Telepon/WhatsApp</label>
                    <input type="text" name="no_hp" id="no_hp" value="{{ old('no_hp') }}" placeholder="Contoh: 081234567890" 
                        class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-[#fbc02d] focus:border-[#fbc02d] outline-none transition text-sm font-semibold">
                    @error('no_hp') <p class="text-red-500 text-[10px] mt-1 font-bold italic">{{ $message }}</p> @enderror
                </div>

                <!-- Alamat -->
                <div>
                    <label for="alamat" class="block text-[10px] font-black uppercase text-gray-400 tracking-widest mb-2">Alamat Tinggal</label>
                    <textarea name="alamat" id="alamat" rows="3" placeholder="Alamat lengkap pelanggan..." 
                        class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-[#fbc02d] focus:border-[#fbc02d] outline-none transition text-sm font-semibold resize-none">{{ old('alamat') }}</textarea>
                    @error('alamat') <p class="text-red-500 text-[10px] mt-1 font-bold italic">{{ $message }}</p> @enderror
                </div>
            </div>

            <div class="p-8 bg-gray-50 border-t border-gray-100 flex justify-end gap-3">
                <button type="submit" class="w-full sm:w-auto px-8 py-3 bg-[#1a237e] text-white rounded-xl font-black text-sm hover:bg-blue-800 transition shadow-lg shadow-blue-900/20 uppercase tracking-widest">
                    Buat Akun Pelanggan
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
