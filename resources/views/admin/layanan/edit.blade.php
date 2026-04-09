@extends('layouts.admin')

@section('title', 'Edit Layanan')
@section('header_title', 'Edit Jenis Layanan')

@section('content')
<div class="max-w-3xl mx-auto">
    <div class="mb-6 flex justify-between items-center">
        <a href="{{ route('admin.layanan.index') }}" class="text-[#1a237e] font-bold text-sm flex items-center gap-2 hover:text-blue-700 transition">
            <i class="bi bi-arrow-left"></i>
            Kembali ke Daftar Layanan
        </a>
        <div>
            @if($layanan->is_active)
                <span class="px-3 py-1 bg-green-100 text-green-700 text-[9px] font-black rounded-full border border-green-200 uppercase tracking-widest shadow-sm">Aktif</span>
            @else
                <span class="px-3 py-1 bg-gray-100 text-gray-400 text-[9px] font-black rounded-full border border-gray-200 uppercase tracking-widest shadow-sm">Non-Aktif</span>
            @endif
        </div>
    </div>

    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
        <form action="{{ route('admin.layanan.update', $layanan->id) }}" method="POST">
            @csrf
            @method('PUT')
            
            <div class="p-8 border-b border-gray-100 bg-gray-50/50">
                <h3 class="font-black text-[#1a237e] text-lg mb-1 italic">Perbarui Layanan</h3>
                <p class="text-xs text-gray-400 uppercase font-bold tracking-widest">Edit detail untuk {{ $layanan->nama_layanan }}</p>
            </div>

            <div class="p-8 space-y-6">
                <!-- Nama Layanan -->
                <div>
                    <label for="nama_layanan" class="block text-[10px] font-black uppercase text-gray-400 tracking-widest mb-2">Nama Layanan <span class="text-red-500">*</span></label>
                    <input type="text" name="nama_layanan" id="nama_layanan" value="{{ old('nama_layanan', $layanan->nama_layanan) }}" required placeholder="Contoh: Dalam Kota, Luar Kota, Pernikahan" 
                        class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-[#fbc02d] focus:border-[#fbc02d] outline-none transition text-sm font-semibold">
                    @error('nama_layanan') <p class="text-red-500 text-[10px] mt-1 font-bold italic">{{ $message }}</p> @enderror
                </div>

                <!-- Icon -->
                <div>
                    <label for="icon" class="block text-[10px] font-black uppercase text-gray-400 tracking-widest mb-2">Pilih Icon (Bootstrap Icon Class)</label>
                    <div class="flex gap-4">
                        <input type="text" name="icon" id="icon" value="{{ old('icon', $layanan->icon) }}" placeholder="bi-layers" 
                            class="flex-1 px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-[#fbc02d] focus:border-[#fbc02d] outline-none transition text-sm font-semibold">
                        <div class="w-12 h-12 rounded-xl bg-blue-50 border border-blue-100 flex items-center justify-center text-[#1a237e]">
                            <i class="bi {{ $layanan->icon }}" id="icon-preview"></i>
                        </div>
                    </div>
                </div>

                <!-- Deskripsi -->
                <div>
                    <label for="deskripsi" class="block text-[10px] font-black uppercase text-gray-400 tracking-widest mb-2">Deskripsi Layanan</label>
                    <textarea name="deskripsi" id="deskripsi" rows="4" placeholder="Jelaskan secara singkat layanan ini..." 
                        class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-[#fbc02d] focus:border-[#fbc02d] outline-none transition text-sm font-semibold resize-none">{{ old('deskripsi', $layanan->deskripsi) }}</textarea>
                    @error('deskripsi') <p class="text-red-500 text-[10px] mt-1 font-bold italic">{{ $message }}</p> @enderror
                </div>
            </div>

            <div class="p-8 bg-gray-50 border-t border-gray-100 flex justify-end gap-3">
                <a href="{{ route('admin.layanan.index') }}" class="px-6 py-3 border border-gray-200 text-gray-400 rounded-xl font-bold text-sm hover:bg-white hover:text-gray-600 transition flex items-center">Batal</a>
                <button type="submit" class="px-8 py-3 bg-[#1a237e] text-white rounded-xl font-black text-sm hover:bg-blue-800 transition shadow-lg shadow-blue-900/20 uppercase tracking-widest">
                    Simpan Perubahan
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
