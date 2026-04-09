@extends('layouts.admin')

@section('content')
<div class="container-fluid px-4 py-8 bg-[#f8faff]">
    <div class="mb-8">
        <a href="{{ route('admin.promo.index') }}" class="inline-flex items-center gap-2 text-[#1a237e] font-black uppercase text-xs tracking-widest hover:translate-x-[-10px] transition-all mb-4">
            <i class="bi bi-arrow-left"></i> Kembali ke Daftar
        </a>
        <h1 class="text-3xl font-black text-[#1a237e] tracking-tighter uppercase">Edit Promo</h1>
        <p class="text-[11px] font-bold text-gray-400 uppercase tracking-[0.3em] mt-1">Sesuaikan detail program diskon Anda</p>
    </div>

    @if($errors->any())
    <div class="mb-6 p-4 bg-red-50 border border-red-100 text-red-600 rounded-2xl">
        <ul class="list-disc list-inside text-xs font-bold uppercase tracking-widest">
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <form action="{{ route('admin.promo.update', $promo) }}" method="POST" enctype="multipart/form-data" class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        @csrf
        @method('PUT')
        <div class="lg:col-span-2 space-y-6">
            <div class="bg-white rounded-[40px] shadow-2xl border border-gray-100 p-8 md:p-10">
                <div class="space-y-6">
                    <div>
                        <label class="block text-[10px] font-black text-[#1a237e] uppercase tracking-widest mb-3">Judul Promo</label>
                        <input type="text" name="judul" value="{{ old('judul', $promo->judul) }}" placeholder="Contoh: Promo Ramadhan Berkah" class="w-full px-6 py-4 bg-gray-50 border-2 border-gray-100 rounded-2xl focus:border-[#1a237e] focus:outline-none transition font-bold" required>
                        @error('judul') <p class="text-red-500 text-[10px] mt-1 font-bold italic">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label class="block text-[10px] font-black text-[#1a237e] uppercase tracking-widest mb-3">Deskripsi Promo</label>
                        <textarea name="deskripsi" rows="4" placeholder="Jelaskan detail promo di sini..." class="w-full px-6 py-4 bg-gray-50 border-2 border-gray-100 rounded-2xl focus:border-[#1a237e] focus:outline-none transition font-bold">{{ old('deskripsi', $promo->deskripsi) }}</textarea>
                        @error('deskripsi') <p class="text-red-500 text-[10px] mt-1 font-bold italic">{{ $message }}</p> @enderror
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-[10px] font-black text-[#1a237e] uppercase tracking-widest mb-3">Potongan Persen (%)</label>
                            <div class="relative">
                                <input type="number" name="potongan_persen" value="{{ old('potongan_persen', $promo->potongan_persen) }}" placeholder="10" min="1" max="100" class="w-full px-6 py-4 bg-gray-50 border-2 border-gray-100 rounded-2xl focus:border-[#1a237e] focus:outline-none transition font-bold" required>
                                <span class="absolute right-6 top-1/2 -translate-y-1/2 font-black text-[#1a237e]">%</span>
                            </div>
                            @error('potongan_persen') <p class="text-red-500 text-[10px] mt-1 font-bold italic">{{ $message }}</p> @enderror
                        </div>
                        <div>
                            <label class="block text-[10px] font-black text-[#1a237e] uppercase tracking-widest mb-3">Kode Promo (Opsional)</label>
                            <input type="text" name="kode_promo" value="{{ old('kode_promo', $promo->kode_promo) }}" placeholder="Contoh: ZIDANBERKAH" class="w-full px-6 py-4 bg-gray-50 border-2 border-gray-100 rounded-2xl focus:border-[#1a237e] focus:outline-none transition font-bold uppercase">
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="space-y-6">
            <div class="bg-white rounded-[40px] shadow-2xl border border-gray-100 p-8">
                <label class="block text-[10px] font-black text-[#1a237e] uppercase tracking-widest mb-4">Banner Promo</label>
                <div class="relative group cursor-pointer">
                    <input type="file" name="gambar" class="absolute inset-0 opacity-0 cursor-pointer z-10" onchange="previewImage(event)">
                    <div id="image-preview-container" class="aspect-video bg-gray-50 border-2 border-dashed border-gray-200 rounded-[30px] flex flex-col items-center justify-center transition group-hover:bg-gray-100 overflow-hidden relative">
                        <div id="preview-placeholder" class="{{ $promo->gambar ? 'hidden' : '' }} text-center">
                            <i class="bi bi-cloud-arrow-up text-4xl text-gray-300"></i>
                            <p class="text-[10px] font-black text-gray-400 uppercase tracking-widest mt-2">Ganti Gambar</p>
                        </div>
                        <img id="image-preview" src="{{ $promo->gambar ? asset('storage/' . $promo->gambar) : '' }}" class="{{ $promo->gambar ? '' : 'hidden' }} absolute inset-0 w-full h-full object-cover">
                    </div>
                </div>
                @error('gambar') <p class="text-red-500 text-[10px] mt-1 font-bold italic">{{ $message }}</p> @enderror
                <p class="text-[9px] text-gray-400 font-bold uppercase tracking-tighter mt-4 leading-relaxed italic">Rekomendasi ukuran 1200x600px, format JPG/PNG/WEBP, Max 2MB.</p>

                <div class="mt-10 pt-8 border-t border-gray-50">
                    <label class="flex items-center gap-4 cursor-pointer group">
                        <div class="relative">
                            <input type="checkbox" name="is_active" value="1" {{ old('is_active', $promo->is_active) ? 'checked' : '' }} class="sr-only peer">
                            <div class="w-14 h-8 bg-gray-200 rounded-full peer peer-checked:bg-green-500 transition-all duration-300"></div>
                            <div class="absolute top-1 left-1 w-6 h-6 bg-white rounded-full transition-all duration-300 peer-checked:translate-x-6 shadow-md"></div>
                        </div>
                        <span class="text-[10px] font-black text-[#1a237e] uppercase tracking-widest">Aktifkan Sekarang</span>
                    </label>
                </div>
            </div>

            <button type="submit" class="w-full py-6 bg-[#1a237e] text-white rounded-[30px] font-black uppercase tracking-widest shadow-2xl shadow-blue-900/40 hover:bg-blue-800 transition-all hover:-translate-y-1">
                Perbarui Promo
            </button>
        </div>
    </form>
</div>

<script>
    function previewImage(event) {
        const reader = new FileReader();
        const preview = document.getElementById('image-preview');
        const placeholder = document.getElementById('preview-placeholder');
        
        reader.onload = function() {
            if (reader.readyState === 2) {
                preview.src = reader.result;
                preview.classList.remove('hidden');
                placeholder.classList.add('hidden');
            }
        }
        reader.readAsDataURL(event.target.files[0]);
    }
</script>
@endsection
