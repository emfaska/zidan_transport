@extends('layouts.admin')

@section('title', 'Edit Pengemudi')
@section('header_title', 'Perbarui Data Pengemudi')

@section('content')
<div class="max-w-4xl mx-auto">
    <div class="mb-6 flex justify-between items-center">
        <a href="{{ route('admin.pengemudi.index') }}" class="text-[#1a237e] font-bold text-sm flex items-center gap-2 hover:text-blue-700 transition">
            <i class="bi bi-arrow-left"></i>
            Kembali ke Daftar Pengemudi
        </a>
        <div>
            @if($pengemudi->status_driver == 'available')
                <span class="px-3 py-1 bg-green-100 text-green-700 text-[9px] font-black rounded-full border border-green-200 uppercase tracking-widest shadow-sm">Ready</span>
            @elseif($pengemudi->status_driver == 'on_duty')
                <span class="px-3 py-1 bg-blue-100 text-blue-700 text-[9px] font-black rounded-full border border-blue-200 uppercase tracking-widest shadow-sm">On Duty</span>
            @else
                <span class="px-3 py-1 bg-gray-100 text-gray-400 text-[9px] font-black rounded-full border border-gray-200 uppercase tracking-widest shadow-sm">Off</span>
            @endif
        </div>
    </div>

    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
        <form action="{{ route('admin.pengemudi.update', $pengemudi->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            
            <div class="p-8 border-b border-gray-100 bg-gray-50/50 flex items-center justify-between">
                <div>
                    <h3 class="font-black text-[#1a237e] text-lg mb-1 italic">Update Profil: {{ $pengemudi->name }}</h3>
                    <p class="text-xs text-gray-400 uppercase font-bold tracking-widest">ID Driver: #DRV-{{ str_pad($pengemudi->id, 4, '0', STR_PAD_LEFT) }}</p>
                </div>
                @if($pengemudi->foto_profil)
                    <div class="w-16 h-16 rounded-full border-4 border-white shadow-md overflow-hidden">
                        <img src="{{ asset('storage/'.$pengemudi->foto_profil) }}" class="w-full h-full object-cover">
                    </div>
                @endif
            </div>

            <div class="p-8 grid grid-cols-1 md:grid-cols-2 gap-x-8 gap-y-6">
                <!-- Nama -->
                <div class="col-span-1">
                    <label for="name" class="block text-[10px] font-black uppercase text-gray-400 tracking-widest mb-2">Nama Lengkap <span class="text-red-500">*</span></label>
                    <input type="text" name="name" id="name" value="{{ old('name', $pengemudi->name) }}" required 
                        class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-[#fbc02d] focus:border-[#fbc02d] outline-none transition text-sm font-semibold">
                </div>

                <!-- Status -->
                <div class="col-span-1">
                    <label for="status_driver" class="block text-[10px] font-black uppercase text-gray-400 tracking-widest mb-2">Status Tugas <span class="text-red-500">*</span></label>
                    <select name="status_driver" id="status_driver" required 
                        class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-[#fbc02d] focus:border-[#fbc02d] outline-none transition text-sm font-semibold appearance-none">
                        <option value="available" {{ old('status_driver', $pengemudi->status_driver) == 'available' ? 'selected' : '' }}>Available (Siap Tugas)</option>
                        <option value="on_duty" {{ old('status_driver', $pengemudi->status_driver) == 'on_duty' ? 'selected' : '' }}>On Duty (Sedang Jalan)</option>
                        <option value="off" {{ old('status_driver', $pengemudi->status_driver) == 'off' ? 'selected' : '' }}>Off / Izin</option>
                    </select>
                </div>

                <!-- Email -->
                <div class="col-span-1">
                    <label for="email" class="block text-[10px] font-black uppercase text-gray-400 tracking-widest mb-2">Email Akun <span class="text-red-500">*</span></label>
                    <input type="email" name="email" id="email" value="{{ old('email', $pengemudi->email) }}" required 
                        class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-[#fbc02d] focus:border-[#fbc02d] outline-none transition text-sm font-semibold">
                </div>

                <!-- SIM -->
                <div class="col-span-1">
                    <label for="nomor_sim" class="block text-[10px] font-black uppercase text-gray-400 tracking-widest mb-2">Nomor SIM <span class="text-red-500">*</span></label>
                    <input type="text" name="nomor_sim" id="nomor_sim" value="{{ old('nomor_sim', $pengemudi->nomor_sim) }}" required 
                        class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-[#fbc02d] focus:border-[#fbc02d] outline-none transition text-sm font-semibold uppercase tracking-widest">
                </div>

                <!-- Kontak -->
                <div class="col-span-2">
                    <label for="no_hp" class="block text-[10px] font-black uppercase text-gray-400 tracking-widest mb-2">Nomor WhatsApp Pengemudi</label>
                    <input type="text" name="no_hp" id="no_hp" value="{{ old('no_hp', $pengemudi->no_hp) }}" 
                        class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-[#fbc02d] focus:border-[#fbc02d] outline-none transition text-sm font-semibold">
                </div>

                <!-- Foto Profil -->
                <div class="col-span-1">
                    <label for="foto_profil" class="block text-[10px] font-black uppercase text-gray-400 tracking-widest mb-2">Perbarui Foto Profil</label>
                    <div class="relative group">
                        <input type="file" name="foto_profil" id="foto_profil" accept="image/*" 
                            class="absolute inset-0 w-full h-full opacity-0 cursor-pointer z-10">
                        <div class="p-8 border-2 border-dashed border-gray-200 rounded-2xl flex flex-col items-center justify-center bg-gray-50 group-hover:bg-blue-50 group-hover:border-blue-200 transition">
                            <i class="bi bi-person-bounding-box text-4xl text-gray-300 group-hover:text-blue-400 transition mb-2"></i>
                            <p class="text-[10px] font-bold text-gray-400 group-hover:text-blue-500">Klik untuk upload foto baru</p>
                        </div>
                    </div>
                </div>

                <!-- Foto SIM -->
                <div class="col-span-1">
                    <label for="foto_sim" class="block text-[10px] font-black uppercase text-gray-400 tracking-widest mb-2">Perbarui Foto SIM</label>
                    <div class="relative group">
                        <input type="file" name="foto_sim" id="foto_sim" accept="image/*" 
                            class="absolute inset-0 w-full h-full opacity-0 cursor-pointer z-10">
                        <div class="p-8 border-2 border-dashed border-gray-200 rounded-2xl flex flex-col items-center justify-center bg-gray-50 group-hover:bg-blue-50 group-hover:border-blue-200 transition">
                            <i class="bi bi-card-checklist text-4xl text-gray-300 group-hover:text-blue-400 transition mb-2"></i>
                            <p class="text-[10px] font-bold text-gray-400 group-hover:text-blue-500">Klik untuk upload SIM baru</p>
                        </div>
                    </div>
                    @error('foto_sim') <p class="text-red-500 text-[10px] mt-1 font-bold italic">{{ $message }}</p> @enderror
                </div>
            </div>

            <div class="p-8 bg-gray-50 border-t border-gray-100 flex justify-end gap-3">
                <a href="{{ route('admin.pengemudi.index') }}" class="px-6 py-3 border border-gray-200 text-gray-400 rounded-xl font-bold text-sm hover:bg-white hover:text-gray-600 transition flex items-center">Batal</a>
                <button type="submit" class="px-8 py-3 bg-[#1a237e] text-white rounded-xl font-black text-sm hover:bg-blue-800 transition shadow-lg shadow-blue-900/20 uppercase tracking-widest">
                    Update Data Pengemudi
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
