@extends('layouts.admin')

@section('title', 'Registrasi Pengemudi')
@section('header_title', 'Tambah Pengemudi Baru')

@section('content')
<div class="max-w-4xl mx-auto">
    <div class="mb-6">
        <a href="{{ route('admin.pengemudi.index') }}" class="text-[#1a237e] font-bold text-sm flex items-center gap-2 hover:text-blue-700 transition">
            <i class="bi bi-arrow-left"></i>
            Kembali ke Daftar Pengemudi
        </a>
    </div>

    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
        <form action="{{ route('admin.pengemudi.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            
            <div class="p-8 border-b border-gray-100 bg-gray-50/50">
                <h3 class="font-black text-[#1a237e] text-lg mb-1 italic">Data Personal & Lisensi</h3>
                <p class="text-xs text-gray-400 uppercase font-bold tracking-widest">Lengkapi data pengemudi resmi Zidan Transport</p>
            </div>

            <div class="p-8 grid grid-cols-1 md:grid-cols-2 gap-x-8 gap-y-6">
                <!-- Nama -->
                <div class="col-span-1">
                    <label for="name" class="block text-[10px] font-black uppercase text-gray-400 tracking-widest mb-2">Nama Lengkap <span class="text-red-500">*</span></label>
                    <input type="text" name="name" id="name" value="{{ old('name') }}" required placeholder="Nama pengemudi" 
                        class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-[#fbc02d] focus:border-[#fbc02d] outline-none transition text-sm font-semibold">
                    @error('name') <p class="text-red-500 text-[10px] mt-1 font-bold italic">{{ $message }}</p> @enderror
                </div>

                <!-- Status -->
                <div class="col-span-1">
                    <label for="status_driver" class="block text-[10px] font-black uppercase text-gray-400 tracking-widest mb-2">Status Tugas <span class="text-red-500">*</span></label>
                    <select name="status_driver" id="status_driver" required 
                        class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-[#fbc02d] focus:border-[#fbc02d] outline-none transition text-sm font-semibold appearance-none">
                        <option value="available" {{ old('status_driver') == 'available' ? 'selected' : '' }}>Available (Siap Tugas)</option>
                        <option value="on_duty" {{ old('status_driver') == 'on_duty' ? 'selected' : '' }}>On Duty (Sedang Jalan)</option>
                        <option value="off" {{ old('status_driver') == 'off' ? 'selected' : '' }}>Off / Izin</option>
                    </select>
                    @error('status_driver') <p class="text-red-500 text-[10px] mt-1 font-bold italic">{{ $message }}</p> @enderror
                </div>

                <!-- Email -->
                <div class="col-span-1">
                    <label for="email" class="block text-[10px] font-black uppercase text-gray-400 tracking-widest mb-2">Email Akun <span class="text-red-500">*</span></label>
                    <input type="email" name="email" id="email" value="{{ old('email') }}" required placeholder="driver@zidan.com" 
                        class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-[#fbc02d] focus:border-[#fbc02d] outline-none transition text-sm font-semibold">
                    @error('email') <p class="text-red-500 text-[10px] mt-1 font-bold italic">{{ $message }}</p> @enderror
                </div>

                <!-- SIM -->
                <div class="col-span-1">
                    <label for="nomor_sim" class="block text-[10px] font-black uppercase text-gray-400 tracking-widest mb-2">Nomor SIM <span class="text-red-500">*</span></label>
                    <input type="text" name="nomor_sim" id="nomor_sim" value="{{ old('nomor_sim') }}" required placeholder="Contoh: 1234-5678-XXXX" 
                        class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-[#fbc02d] focus:border-[#fbc02d] outline-none transition text-sm font-semibold uppercase tracking-widest">
                    @error('nomor_sim') <p class="text-red-500 text-[10px] mt-1 font-bold italic">{{ $message }}</p> @enderror
                </div>

                <!-- Password -->
                <div class="col-span-1">
                    <label for="password" class="block text-[10px] font-black uppercase text-gray-400 tracking-widest mb-2">Password Login <span class="text-red-500">*</span></label>
                    <div class="relative">
                        <input type="password" name="password" id="password" required 
                            class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-[#fbc02d] focus:border-[#fbc02d] outline-none transition text-sm font-semibold">
                        <button type="button" class="password-toggle absolute right-4 top-1/2 -translate-y-1/2 text-gray-400 hover:text-[#1a237e] transition">
                            <i class="bi bi-eye"></i>
                        </button>
                    </div>
                    @error('password') <p class="text-red-500 text-[10px] mt-1 font-bold italic">{{ $message }}</p> @enderror
                </div>
                <div class="col-span-1">
                    <label for="password_confirmation" class="block text-[10px] font-black uppercase text-gray-400 tracking-widest mb-2">Konfirmasi Password <span class="text-red-500">*</span></label>
                    <div class="relative">
                        <input type="password" name="password_confirmation" id="password_confirmation" required 
                            class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-[#fbc02d] focus:border-[#fbc02d] outline-none transition text-sm font-semibold">
                        <button type="button" class="password-toggle absolute right-4 top-1/2 -translate-y-1/2 text-gray-400 hover:text-[#1a237e] transition">
                            <i class="bi bi-eye"></i>
                        </button>
                    </div>
                </div>

                <!-- Kontak -->
                <div class="col-span-2">
                    <label for="no_hp" class="block text-[10px] font-black uppercase text-gray-400 tracking-widest mb-2">Nomor WhatsApp Pengemudi</label>
                    <input type="text" name="no_hp" id="no_hp" value="{{ old('no_hp') }}" placeholder="08XXXXXXXXXX" 
                        class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-[#fbc02d] focus:border-[#fbc02d] outline-none transition text-sm font-semibold">
                    @error('no_hp') <p class="text-red-500 text-[10px] mt-1 font-bold italic">{{ $message }}</p> @enderror
                </div>

                <!-- Foto Profil -->
                <div class="col-span-1">
                    <label for="foto_profil" class="block text-[10px] font-black uppercase text-gray-400 tracking-widest mb-2">Foto Profil Pengemudi</label>
                    <div class="relative group">
                        <input type="file" name="foto_profil" id="foto_profil" accept="image/*" 
                            class="absolute inset-0 w-full h-full opacity-0 cursor-pointer z-10">
                        <div class="p-8 border-2 border-dashed border-gray-200 rounded-2xl flex flex-col items-center justify-center bg-gray-50 group-hover:bg-blue-50 group-hover:border-blue-200 transition">
                            <i class="bi bi-person-bounding-box text-4xl text-gray-300 group-hover:text-blue-400 transition mb-2"></i>
                            <p class="text-[10px] font-bold text-gray-400 group-hover:text-blue-500">Upload foto profil</p>
                        </div>
                    </div>
                    @error('foto_profil') <p class="text-red-500 text-[10px] mt-1 font-bold italic">{{ $message }}</p> @enderror
                </div>

                <!-- Foto SIM -->
                <div class="col-span-1">
                    <label for="foto_sim" class="block text-[10px] font-black uppercase text-gray-400 tracking-widest mb-2">Foto SIM Pengemudi <span class="text-red-500">*</span></label>
                    <div class="relative group">
                        <input type="file" name="foto_sim" id="foto_sim" accept="image/*" required 
                            class="absolute inset-0 w-full h-full opacity-0 cursor-pointer z-10">
                        <div class="p-8 border-2 border-dashed border-gray-200 rounded-2xl flex flex-col items-center justify-center bg-gray-50 group-hover:bg-blue-50 group-hover:border-blue-200 transition">
                            <i class="bi bi-card-checklist text-4xl text-gray-300 group-hover:text-blue-400 transition mb-2"></i>
                            <p class="text-[10px] font-bold text-gray-400 group-hover:text-blue-500">Upload foto SIM</p>
                        </div>
                    </div>
                    @error('foto_sim') <p class="text-red-500 text-[10px] mt-1 font-bold italic">{{ $message }}</p> @enderror
                </div>
            </div>

            <div class="p-8 bg-gray-50 border-t border-gray-100 flex justify-end gap-3">
                <button type="submit" class="w-full sm:w-auto px-8 py-3 bg-[#1a237e] text-white rounded-xl font-black text-sm hover:bg-blue-800 transition shadow-lg shadow-blue-900/20 uppercase tracking-widest">
                    Daftarkan Pengemudi
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
