@extends('layouts.admin')

@section('title', 'Tambah Paket Rute')
@section('header_title', 'Tambah Paket Rute & Harga')

@section('content')
<div class="max-w-4xl mx-auto">
    <div class="mb-6">
        <a href="{{ route('admin.rute.index') }}" class="text-[#1a237e] font-bold text-sm flex items-center gap-2 hover:text-blue-700 transition">
            <i class="bi bi-arrow-left"></i>
            Kembali ke Daftar Paket Rute
        </a>
    </div>

    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
        <form action="{{ route('admin.rute.store') }}" method="POST">
            @csrf
            
            <div class="p-8 border-b border-gray-100 bg-gray-50/50">
                <h3 class="font-black text-[#1a237e] text-lg mb-1 italic">Setup Paket Rute & Harga</h3>
                <p class="text-xs text-gray-400 uppercase font-bold tracking-widest">Hubungkan layanan, rute, dan armada dengan harga paket</p>
            </div>

            <div class="p-8 grid grid-cols-1 md:grid-cols-2 gap-x-8 gap-y-6">
                <!-- Layanan -->
                <div class="col-span-1">
                    <label for="layanan_id" class="block text-[10px] font-black uppercase text-gray-400 tracking-widest mb-2">Pilih Jenis Layanan <span class="text-red-500">*</span></label>
                    <select name="layanan_id" id="layanan_id" required 
                        class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-[#fbc02d] focus:border-[#fbc02d] outline-none transition text-sm font-semibold appearance-none">
                        <option value="">-- Pilih Layanan --</option>
                        @foreach($layanans as $layanan)
                            <option value="{{ $layanan->id }}" {{ old('layanan_id', $rute->layanan_id ?? '') == $layanan->id ? 'selected' : '' }}>{{ $layanan->nama_layanan }}</option>
                        @endforeach
                    </select>
                    @error('layanan_id') <p class="text-red-500 text-[10px] mt-1 font-bold italic">{{ $message }}</p> @enderror
                </div>

                <!-- Armada -->
                <div class="col-span-1">
                    <label for="armada_id" class="block text-[10px] font-black uppercase text-gray-400 tracking-widest mb-2">Pilih Unit Armada <span class="text-red-500">*</span></label>
                    <select name="armada_id" id="armada_id" required 
                        class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-[#fbc02d] focus:border-[#fbc02d] outline-none transition text-sm font-semibold appearance-none">
                        <option value="">-- Pilih Armada --</option>
                        @foreach($armadas as $armada)
                            <option value="{{ $armada->id }}" {{ old('armada_id', $rute->armada_id ?? '') == $armada->id ? 'selected' : '' }}>{{ $armada->nama }} (Kapasitas: {{ $armada->kapasitas }})</option>
                        @endforeach
                    </select>
                    @error('armada_id') <p class="text-red-500 text-[10px] mt-1 font-bold italic">{{ $message }}</p> @enderror
                </div>

                <!-- Nama Rute -->
                <div class="col-span-2">
                    <label for="nama_rute" class="block text-[10px] font-black uppercase text-gray-400 tracking-widest mb-2">Nama Paket Rute <span class="text-red-500">*</span></label>
                    <input type="text" name="nama_rute" id="nama_rute" value="{{ old('nama_rute', $rute->nama_rute ?? '') }}" required placeholder="Contoh: Kediri - Surabaya (Juanda)" 
                        class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-[#fbc02d] focus:border-[#fbc02d] outline-none transition text-sm font-semibold">
                    <p class="text-[9px] text-gray-400 mt-1 italic">*Gunakan nama yang sama persis jika ingin mengelompokkan rute ini (misal beda mobil)</p>
                    @error('nama_rute') <p class="text-red-500 text-[10px] mt-1 font-bold italic">{{ $message }}</p> @enderror
                </div>

                <!-- Lokasi Awal -->
                <div class="col-span-1">
                    <label for="lokasi_awal" class="block text-[10px] font-black uppercase text-gray-400 tracking-widest mb-2">Titik Jemput / Lokasi Awal <span class="text-red-500">*</span></label>
                    <input type="text" name="lokasi_awal" id="lokasi_awal" value="{{ old('lokasi_awal', $rute->lokasi_awal ?? '') }}" required placeholder="Contoh: Kota Kediri" 
                        class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-[#fbc02d] focus:border-[#fbc02d] outline-none transition text-sm font-semibold">
                    @error('lokasi_awal') <p class="text-red-500 text-[10px] mt-1 font-bold italic">{{ $message }}</p> @enderror
                </div>

                <!-- Tujuan -->
                <div class="col-span-1">
                    <label for="tujuan" class="block text-[10px] font-black uppercase text-gray-400 tracking-widest mb-2">Titik Tujuan <span class="text-red-500">*</span></label>
                    <input type="text" name="tujuan" id="tujuan" value="{{ old('tujuan', $rute->tujuan ?? '') }}" required placeholder="Contoh: Bandara Juanda" 
                        class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-[#fbc02d] focus:border-[#fbc02d] outline-none transition text-sm font-semibold">
                    @error('tujuan') <p class="text-red-500 text-[10px] mt-1 font-bold italic">{{ $message }}</p> @enderror
                </div>

                <!-- Harga Paket -->
                <div class="col-span-1">
                    <label for="harga_paket" class="block text-[10px] font-black uppercase text-gray-400 tracking-widest mb-2">Harga Sekali Jalan <span class="text-red-500">*</span></label>
                    <div class="relative">
                        <span class="absolute left-4 top-1/2 -translate-y-1/2 text-[10px] font-black text-gray-400 uppercase">Rp</span>
                        <input type="text" name="harga_paket" id="harga_paket" value="{{ old('harga_paket') }}" required placeholder="0" 
                            class="w-full pl-12 pr-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-[#fbc02d] focus:border-[#fbc02d] outline-none transition text-sm font-black text-[#1a237e] mask-currency">
                    </div>
                    @error('harga_paket') <p class="text-red-500 text-[10px] mt-1 font-bold italic">{{ $message }}</p> @enderror
                </div>

                <!-- Harga Paket PP -->
                <div class="col-span-1">
                    <label for="harga_paket_pp" class="block text-[10px] font-black uppercase text-gray-400 tracking-widest mb-2">Harga Pulang Pergi (PP)</label>
                    <div class="relative">
                        <span class="absolute left-4 top-1/2 -translate-y-1/2 text-[10px] font-black text-gray-400 uppercase">Rp</span>
                        <input type="text" name="harga_paket_pp" id="harga_paket_pp" value="{{ old('harga_paket_pp') }}" placeholder="0" 
                            class="w-full pl-12 pr-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-[#fbc02d] focus:border-[#fbc02d] outline-none transition text-sm font-black text-orange-600 mask-currency">
                    </div>
                    @error('harga_paket_pp') <p class="text-red-500 text-[10px] mt-1 font-bold italic">{{ $message }}</p> @enderror
                </div>

                <!-- Harga Tol -->
                <div class="col-span-1">
                    <label for="harga_tol" class="block text-[10px] font-black uppercase text-gray-400 tracking-widest mb-2">Harga Tambahan Tol (Optional)</label>
                    <div class="relative">
                        <span class="absolute left-4 top-1/2 -translate-y-1/2 text-[10px] font-black text-gray-400 uppercase">Rp</span>
                        <input type="text" name="harga_tol" id="harga_tol" value="{{ old('harga_tol') }}" placeholder="0" 
                            class="w-full pl-12 pr-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-[#fbc02d] focus:border-[#fbc02d] outline-none transition text-sm font-bold text-blue-600 mask-currency">
                    </div>
                    @error('harga_tol') <p class="text-red-500 text-[10px] mt-1 font-bold italic">{{ $message }}</p> @enderror
                </div>

                <!-- Durasi & Jarak -->
                <div class="col-span-1">
                    <label for="durasi_estimasi" class="block text-[10px] font-black uppercase text-gray-400 tracking-widest mb-2">Estimasi Durasi</label>
                    <input type="text" name="durasi_estimasi" id="durasi_estimasi" value="{{ old('durasi_estimasi', $rute->durasi_estimasi ?? '') }}" placeholder="Contoh: 3 Jam" 
                        class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-[#fbc02d] focus:border-[#fbc02d] outline-none transition text-sm font-semibold">
                    @error('durasi_estimasi') <p class="text-red-500 text-[10px] mt-1 font-bold italic">{{ $message }}</p> @enderror
                </div>
                <div class="col-span-1">
                    <label for="jarak_km" class="block text-[10px] font-black uppercase text-gray-400 tracking-widest mb-2">Estimasi Jarak (KM)</label>
                    <input type="number" name="jarak_km" id="jarak_km" value="{{ old('jarak_km', $rute->jarak_km ?? '') }}" min="0" placeholder="0" 
                        class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-[#fbc02d] focus:border-[#fbc02d] outline-none transition text-sm font-semibold">
                    @error('jarak_km') <p class="text-red-500 text-[10px] mt-1 font-bold italic">{{ $message }}</p> @enderror
                </div>

                <!-- Catatan -->
                <div class="col-span-2">
                    <label for="catatan" class="block text-[10px] font-black uppercase text-gray-400 tracking-widest mb-2">Catatan Tambahan</label>
                    <textarea name="catatan" id="catatan" rows="3" placeholder="Informasi tambahan untuk rute ini..." 
                        class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-[#fbc02d] focus:border-[#fbc02d] outline-none transition text-sm font-semibold resize-none">{{ old('catatan', $rute->catatan ?? '') }}</textarea>
                    @error('catatan') <p class="text-red-500 text-[10px] mt-1 font-bold italic">{{ $message }}</p> @enderror
                </div>
            </div>

            <div class="p-8 bg-gray-50 border-t border-gray-100 flex justify-end gap-3">
                <button type="submit" class="w-full sm:w-auto px-8 py-3 bg-[#1a237e] text-white rounded-xl font-black text-sm hover:bg-blue-800 transition shadow-lg shadow-blue-900/20 uppercase tracking-widest">
                    Simpan Paket Rute & Harga
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
