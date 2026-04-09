@extends('layouts.admin')

@section('title', 'Tambah Armada')
@section('header_title', 'Tambah Armada Baru')

@section('content')
<div class="max-w-4xl mx-auto">
    <div class="mb-6">
        <a href="{{ route('admin.armada.index') }}" class="text-[#1a237e] font-bold text-sm flex items-center gap-2 hover:text-blue-700 transition">
            <i class="bi bi-arrow-left"></i>
            Kembali ke Daftar Armada
        </a>
    </div>

    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
        <form action="{{ route('admin.armada.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            
            <div class="p-8 border-b border-gray-100 bg-gray-50/50">
                <h3 class="font-black text-[#1a237e] text-lg mb-1 italic">Informasi Utama Armada</h3>
                <p class="text-xs text-gray-400 uppercase font-bold tracking-widest">Silakan lengkapi data teknis kendaraan</p>
            </div>

            <div class="p-8 grid grid-cols-1 md:grid-cols-2 gap-x-8 gap-y-6">
                <!-- Nama Armada -->
                <div class="col-span-1">
                    <label for="nama" class="block text-[10px] font-black uppercase text-gray-400 tracking-widest mb-2">Nama Armada <span class="text-red-500">*</span></label>
                    <input type="text" name="nama" id="nama" value="{{ old('nama') }}" required placeholder="Contoh: Toyota HiAce Premium" 
                        class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-[#fbc02d] focus:border-[#fbc02d] outline-none transition text-sm font-semibold">
                    @error('nama') <p class="text-red-500 text-[10px] mt-1 font-bold italic">{{ $message }}</p> @enderror
                </div>

                <!-- Jenis Armada & BBM -->
                <div class="col-span-1">
                    <label for="jenis" class="block text-[10px] font-black uppercase text-gray-400 tracking-widest mb-2">Jenis Kendaraan <span class="text-red-500">*</span></label>
                    <select name="jenis" id="jenis" required 
                        class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-[#fbc02d] focus:border-[#fbc02d] outline-none transition text-sm font-semibold appearance-none">
                        <option value="">-- Pilih Jenis --</option>
                        <option value="Minibus" {{ old('jenis') == 'Minibus' ? 'selected' : '' }}>Minibus (HiAce, ELF, etc)</option>
                        <option value="MPV" {{ old('jenis') == 'MPV' ? 'selected' : '' }}>MPV (Avanza, Xenia, etc)</option>
                        <option value="MPV Premium" {{ old('jenis') == 'MPV Premium' ? 'selected' : '' }}>MPV Premium (Innova, etc)</option>
                        <option value="SUV" {{ old('jenis') == 'SUV' ? 'selected' : '' }}>SUV</option>
                        <option value="Luxury" {{ old('jenis') == 'Luxury' ? 'selected' : '' }}>Luxury (Alphard, etc)</option>
                    </select>
                    @error('jenis') <p class="text-red-500 text-[10px] mt-1 font-bold italic">{{ $message }}</p> @enderror
                </div>

                <div class="col-span-1">
                    <label for="bbm" class="block text-[10px] font-black uppercase text-gray-400 tracking-widest mb-2">Bahan Bakar (BBM) <span class="text-red-500">*</span></label>
                    <select name="bbm" id="bbm" required 
                        class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-[#fbc02d] focus:border-[#fbc02d] outline-none transition text-sm font-semibold appearance-none">
                        <option value="">-- Pilih BBM --</option>
                        <option value="Pertalite" {{ old('bbm') == 'Pertalite' ? 'selected' : '' }}>Pertalite</option>
                        <option value="Pertamax" {{ old('bbm') == 'Pertamax' ? 'selected' : '' }}>Pertamax</option>
                        <option value="Solar" {{ old('bbm') == 'Solar' ? 'selected' : '' }}>Solar (Bio Solar/Dexlite)</option>
                        <option value="Dexlite" {{ old('bbm') == 'Dexlite' ? 'selected' : '' }}>Dexlite</option>
                        <option value="Listrik" {{ old('bbm') == 'Listrik' ? 'selected' : '' }}>Listrik (EV)</option>
                    </select>
                    @error('bbm') <p class="text-red-500 text-[10px] mt-1 font-bold italic">{{ $message }}</p> @enderror
                </div>

                <!-- Plat Nomor -->
                <div class="col-span-1">
                    <label for="plat_nomor" class="block text-[10px] font-black uppercase text-gray-400 tracking-widest mb-2">Nomor Plat <span class="text-red-500">*</span></label>
                    <input type="text" name="plat_nomor" id="plat_nomor" value="{{ old('plat_nomor') }}" required placeholder="Contoh: AG 1234 XY" 
                        class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-[#fbc02d] focus:border-[#fbc02d] outline-none transition text-sm font-semibold uppercase">
                    @error('plat_nomor') <p class="text-red-500 text-[10px] mt-1 font-bold italic">{{ $message }}</p> @enderror
                </div>

                <!-- Kapasitas -->
                <div class="col-span-1">
                    <label for="kapasitas" class="block text-[10px] font-black uppercase text-gray-400 tracking-widest mb-2">Kapasitas Penumpang <span class="text-red-500">*</span></label>
                    <div class="relative">
                        <input type="number" name="kapasitas" id="kapasitas" value="{{ old('kapasitas') }}" required min="1" placeholder="16" 
                            class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-[#fbc02d] focus:border-[#fbc02d] outline-none transition text-sm font-semibold">
                        <span class="absolute right-4 top-1/2 -translate-y-1/2 text-[10px] font-black text-gray-300 uppercase">Orang</span>
                    </div>
                    @error('kapasitas') <p class="text-red-500 text-[10px] mt-1 font-bold italic">{{ $message }}</p> @enderror
                </div>

                <!-- Tahun -->
                <div class="col-span-1">
                    <label for="tahun" class="block text-[10px] font-black uppercase text-gray-400 tracking-widest mb-2">Tahun Kendaraan</label>
                    <input type="number" name="tahun" id="tahun" value="{{ old('tahun', date('Y')) }}" min="1900" max="{{ date('Y')+1 }}" 
                        class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-[#fbc02d] focus:border-[#fbc02d] outline-none transition text-sm font-semibold">
                    @error('tahun') <p class="text-red-500 text-[10px] mt-1 font-bold italic">{{ $message }}</p> @enderror
                </div>

                <!-- Status -->
                <div class="col-span-1">
                    <label for="status" class="block text-[10px] font-black uppercase text-gray-400 tracking-widest mb-2">Status Operasional <span class="text-red-500">*</span></label>
                    <select name="status" id="status" required 
                        class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-[#fbc02d] focus:border-[#fbc02d] outline-none transition text-sm font-semibold appearance-none">
                        <option value="tersedia" {{ old('status') == 'tersedia' ? 'selected' : '' }}>Tersedia (Siap Jalan)</option>
                        <option value="maintenance" {{ old('status') == 'maintenance' ? 'selected' : '' }}>Maintenance (Bengkel)</option>
                        <option value="terpakai" {{ old('status') == 'terpakai' ? 'selected' : '' }}>Terpakai (Dalam Tugas)</option>
                    </select>
                    @error('status') <p class="text-red-500 text-[10px] mt-1 font-bold italic">{{ $message }}</p> @enderror
                </div>

                <!-- Spesifikasi -->
                <div class="col-span-2">
                    <label for="spesifikasi" class="block text-[10px] font-black uppercase text-gray-400 tracking-widest mb-2">Spesifikasi Kendaraan</label>
                    <textarea name="spesifikasi" id="spesifikasi" rows="3" placeholder="Contoh: AC Central, Audio System, USB Charger, Captain Seat, dll" 
                        class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-[#fbc02d] focus:border-[#fbc02d] outline-none transition text-sm font-semibold resize-none">{{ old('spesifikasi') }}</textarea>
                    @error('spesifikasi') <p class="text-red-500 text-[10px] mt-1 font-bold italic">{{ $message }}</p> @enderror
                </div>

                <!-- Foto Armada -->
                <div class="col-span-2">
                    <label for="foto" class="block text-[10px] font-black uppercase text-gray-400 tracking-widest mb-2">Foto Unit Kendaraan</label>
                    <div class="relative group w-full h-64 border-2 border-dashed border-gray-200 rounded-2xl overflow-hidden bg-gray-50 hover:bg-blue-50 transition hover:border-blue-200" id="drop-area">
                        <input type="file" name="foto" id="foto" accept="image/*" 
                            class="absolute inset-0 w-full h-full opacity-0 cursor-pointer z-20">
                        
                        <!-- Default Content -->
                        <div id="default-content" class="absolute inset-0 flex flex-col items-center justify-center pointer-events-none z-10 transition-opacity duration-300">
                            <i class="bi bi-cloud-arrow-up text-4xl text-gray-300 group-hover:text-blue-400 transition mb-2"></i>
                            <p class="text-xs font-bold text-gray-400 group-hover:text-blue-500">Klik atau seret gambar ke sini</p>
                            <p class="text-[9px] text-gray-300 mt-1 uppercase tracking-tighter">PNG, JPG, WEBP (Max 2MB)</p>
                        </div>

                        <!-- Preview Content -->
                        <div id="preview-container" class="absolute inset-0 hidden z-10 bg-white transition-opacity duration-300">
                            <img id="preview-image" src="" alt="Preview" class="w-full h-full object-cover">
                            <div class="absolute inset-0 bg-black/40 opacity-0 group-hover:opacity-100 flex items-center justify-center transition duration-300 pointer-events-none">
                                <span class="px-4 py-2 bg-white/20 backdrop-blur-sm rounded-lg text-white text-xs font-bold uppercase tracking-widest border border-white/30 truncate max-w-[90%]">
                                    <i class="bi bi-arrow-repeat mr-2"></i>Ganti Gambar
                                </span>
                            </div>
                        </div>
                    </div>
                    @error('foto') <p class="text-red-500 text-[10px] mt-1 font-bold italic">{{ $message }}</p> @enderror
                </div>
            </div>

            <div class="p-8 bg-gray-50 border-t border-gray-100 flex justify-end gap-3">
                <button type="reset" class="px-6 py-3 border border-gray-200 text-gray-400 rounded-xl font-bold text-sm hover:bg-white hover:text-gray-600 transition">Reset Form</button>
                <button type="submit" class="px-8 py-3 bg-[#1a237e] text-white rounded-xl font-black text-sm hover:bg-blue-800 transition shadow-lg shadow-blue-900/20 uppercase tracking-widest">
                    Simpan Data Armada
                </button>
            </div>
        </form>
    </div>
</div>

<script>
    document.getElementById('foto').addEventListener('change', function(e) {
        const file = e.target.files[0];
        const previewContainer = document.getElementById('preview-container');
        const defaultContent = document.getElementById('default-content');
        const previewImage = document.getElementById('preview-image');
        
        if (file) {
            const reader = new FileReader();
            
            reader.onload = function(e) {
                previewImage.src = e.target.result;
                previewContainer.classList.remove('hidden');
                defaultContent.classList.add('opacity-0');
            }
            
            reader.readAsDataURL(file);
        } else {
            previewImage.src = '';
            previewContainer.classList.add('hidden');
            defaultContent.classList.remove('opacity-0');
        }
    });
</script>
@endsection
