@extends('layouts.admin')

@section('title', 'Edit Pelanggan')
@section('header_title', 'Perbarui Data Pelanggan')

@section('content')
<div class="max-w-3xl mx-auto">
    <div class="mb-6">
        <a href="{{ route('admin.pelanggan.index') }}" class="text-[#1a237e] font-bold text-sm flex items-center gap-2 hover:text-blue-700 transition">
            <i class="bi bi-arrow-left"></i>
            Kembali ke Daftar Pelanggan
        </a>
    </div>

    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
        <form action="{{ route('admin.pelanggan.update', $pelanggan->id) }}" method="POST">
            @csrf
            @method('PUT')
            
            <div class="p-8 border-b border-gray-100 bg-gray-50/50">
                <h3 class="font-black text-[#1a237e] text-lg mb-1 italic">Perbarui Profil: {{ $pelanggan->name }}</h3>
                <p class="text-xs text-gray-400 uppercase font-bold tracking-widest">ID Pelanggan: #PLG-{{ str_pad($pelanggan->id, 4, '0', STR_PAD_LEFT) }}</p>
            </div>

            <div class="p-8 space-y-6">
                <!-- Nama -->
                <div>
                    <label for="name" class="block text-[10px] font-black uppercase text-gray-400 tracking-widest mb-2">Nama Lengkap <span class="text-red-500">*</span></label>
                    <input type="text" name="name" id="name" value="{{ old('name', $pelanggan->name) }}" required 
                        class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-[#fbc02d] focus:border-[#fbc02d] outline-none transition text-sm font-semibold">
                    @error('name') <p class="text-red-500 text-[10px] mt-1 font-bold italic">{{ $message }}</p> @enderror
                </div>

                <!-- Email -->
                <div>
                    <label for="email" class="block text-[10px] font-black uppercase text-gray-400 tracking-widest mb-2">Alamat Email <span class="text-red-500">*</span></label>
                    <input type="email" name="email" id="email" value="{{ old('email', $pelanggan->email) }}" required 
                        class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-[#fbc02d] focus:border-[#fbc02d] outline-none transition text-sm font-semibold">
                    @error('email') <p class="text-red-500 text-[10px] mt-1 font-bold italic">{{ $message }}</p> @enderror
                </div>

                <!-- No HP -->
                <div>
                    <label for="no_hp" class="block text-[10px] font-black uppercase text-gray-400 tracking-widest mb-2">Nomor Telepon/WhatsApp</label>
                    <input type="text" name="no_hp" id="no_hp" value="{{ old('no_hp', $pelanggan->no_hp) }}" 
                        class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-[#fbc02d] focus:border-[#fbc02d] outline-none transition text-sm font-semibold">
                    @error('no_hp') <p class="text-red-500 text-[10px] mt-1 font-bold italic">{{ $message }}</p> @enderror
                </div>

                <!-- Alamat -->
                <div>
                    <label for="alamat" class="block text-[10px] font-black uppercase text-gray-400 tracking-widest mb-2">Alamat Tinggal</label>
                    <textarea name="alamat" id="alamat" rows="3" 
                        class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-[#fbc02d] focus:border-[#fbc02d] outline-none transition text-sm font-semibold resize-none">{{ old('alamat', $pelanggan->alamat) }}</textarea>
                    @error('alamat') <p class="text-red-500 text-[10px] mt-1 font-bold italic">{{ $message }}</p> @enderror
                </div>
            </div>

            <div class="p-8 bg-gray-50 border-t border-gray-100 flex justify-end gap-3">
                <a href="{{ route('admin.pelanggan.index') }}" class="px-6 py-3 border border-gray-200 text-gray-400 rounded-xl font-bold text-sm hover:bg-white hover:text-gray-600 transition flex items-center">Batal</a>
                <button type="submit" class="px-8 py-3 bg-[#1a237e] text-white rounded-xl font-black text-sm hover:bg-blue-800 transition shadow-lg shadow-blue-900/20 uppercase tracking-widest">
                    Simpan Perubahan
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
