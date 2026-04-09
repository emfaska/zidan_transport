@extends('layouts.admin')

@section('title', 'Tambah Layanan')
@section('header_title', 'Tambah Layanan Baru')

@section('content')
<div class="max-w-3xl mx-auto">
    <div class="mb-6">
        <a href="{{ route('admin.layanan.index') }}" class="text-[#1a237e] font-bold text-sm flex items-center gap-2 hover:text-blue-700 transition">
            <i class="bi bi-arrow-left"></i>
            Kembali ke Daftar Layanan
        </a>
    </div>

    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
        <form action="{{ route('admin.layanan.store') }}" method="POST">
            @csrf
            
            <div class="p-8 border-b border-gray-100 bg-gray-50/50">
                <h3 class="font-black text-[#1a237e] text-lg mb-1 italic">Informasi Layanan</h3>
                <p class="text-xs text-gray-400 uppercase font-bold tracking-widest">Definisikan kategori layanan transportasi baru</p>
            </div>

            <div class="p-8 space-y-6">
                <!-- Nama Layanan -->
                <div>
                    <label for="nama_layanan" class="block text-[10px] font-black uppercase text-gray-400 tracking-widest mb-2">Nama Layanan <span class="text-red-500">*</span></label>
                    <input type="text" name="nama_layanan" id="nama_layanan" value="{{ old('nama_layanan') }}" required placeholder="Contoh: Dalam Kota, Luar Kota, Pernikahan" 
                        class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-[#fbc02d] focus:border-[#fbc02d] outline-none transition text-sm font-semibold">
                    @error('nama_layanan') <p class="text-red-500 text-[10px] mt-1 font-bold italic">{{ $message }}</p> @enderror
                </div>

                <!-- Icon -->
                <div>
                    <label for="icon" class="block text-[10px] font-black uppercase text-gray-400 tracking-widest mb-2">Pilih Icon (Bootstrap Icon Class)</label>
                    <div class="flex gap-4">
                        <input type="text" name="icon" id="icon" value="{{ old('icon', 'bi-layers') }}" placeholder="bi-layers" 
                            class="flex-1 px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-[#fbc02d] focus:border-[#fbc02d] outline-none transition text-sm font-semibold">
                        <div class="w-12 h-12 rounded-xl bg-blue-50 border border-blue-100 flex items-center justify-center text-[#1a237e]">
                            <i class="bi bi-layers text-xl" id="icon-preview"></i>
                        </div>
                    </div>
                    <p class="text-[9px] text-gray-400 mt-2 italic">Gunakan class dari <a href="https://icons.getbootstrap.com/" target="_blank" class="text-blue-500 underline">Bootstrap Icons</a>. Contoh: bi-car-front, bi-briefcase, bi-heart.</p>
                </div>

                <!-- Deskripsi -->
                <div>
                    <label for="deskripsi" class="block text-[10px] font-black uppercase text-gray-400 tracking-widest mb-2">Deskripsi Layanan</label>
                    <textarea name="deskripsi" id="deskripsi" rows="4" placeholder="Jelaskan secara singkat layanan ini..." 
                        class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-[#fbc02d] focus:border-[#fbc02d] outline-none transition text-sm font-semibold resize-none">{{ old('deskripsi') }}</textarea>
                    @error('deskripsi') <p class="text-red-500 text-[10px] mt-1 font-bold italic">{{ $message }}</p> @enderror
                </div>
            </div>

            <div class="p-8 bg-gray-50 border-t border-gray-100 flex justify-end gap-3">
                <button type="submit" class="w-full sm:w-auto px-8 py-3 bg-[#1a237e] text-white rounded-xl font-black text-sm hover:bg-blue-800 transition shadow-lg shadow-blue-900/20 uppercase tracking-widest">
                    Simpan Layanan Baru
                </button>
            </div>
        </form>
    </div>
</div>

<script>
    document.getElementById('icon').addEventListener('input', function() {
        const preview = document.getElementById('icon-preview');
        preview.className = 'bi ' + this.value;
    });
</script>
@endsection
