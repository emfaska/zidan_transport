@extends('layouts.pelanggan')

@section('title', 'Armada Kami - Zidan Transport')

@section('content')
    <!-- Breadcrumb -->
    <div class="mb-12">
        <div class="flex items-center gap-2 text-sm text-gray-500 mb-4">
            <a href="{{ Auth::check() ? route('home') : route('landing') }}" class="hover:text-[#1a237e]">Beranda</a>
            <i class="bi bi-chevron-right text-xs"></i>
            <span class="text-[#1a237e] font-semibold">Armada</span>
        </div>
        <h1 class="text-4xl md:text-5xl font-black text-[#1a237e] mb-4">Pilih Armada Terbaik Anda</h1>
        <p class="text-lg text-gray-600 max-w-3xl">Semua kendaraan kami terawat dengan baik, dilengkapi AC, dan dikemudikan oleh driver profesional berpengalaman.</p>
    </div>

    <!-- Promo Info (Conditional) -->
    @if($promo)
    <div class="mb-10">
        <div class="bg-gradient-to-r from-yellow-400 to-[#fbc02d] rounded-[30px] p-6 md:p-8 shadow-xl shadow-yellow-500/10 flex flex-col md:flex-row items-center justify-between gap-6 border-b-4 border-yellow-600/20">
            <div class="flex items-center gap-6 text-center md:text-left">
                <div class="w-16 h-16 bg-[#1a237e] rounded-2xl flex items-center justify-center shadow-lg transform -rotate-6">
                    <i class="bi bi-tag-fill text-[#fbc02d] text-3xl"></i>
                </div>
                <div>
                    <h3 class="text-xl font-black text-[#1a237e] uppercase tracking-tighter leading-none mb-2">{{ $promo->judul }}</h3>
                    <p class="text-[#1a237e]/70 text-sm font-bold">{{ $promo->deskripsi }}</p>
                </div>
            </div>
            <div class="flex items-center gap-6">
                <div class="text-center md:text-right">
                    <p class="text-[10px] font-black text-[#1a237e]/60 uppercase tracking-widest leading-none mb-1">Potongan Harga</p>
                    <p class="text-4xl font-black text-[#1a237e] tracking-tighter">{{ $promo->potongan_persen }}% OFF</p>
                </div>
                <div class="px-5 py-2 bg-[#1a237e] rounded-xl text-white font-black text-xs uppercase tracking-[0.2em] shadow-lg">
                    HOT PROMO
                </div>
            </div>
        </div>
    </div>
    @endif

    <!-- Armada Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 mb-16">
        @forelse($armadas as $armada)
        <div class="bg-white rounded-[40px] overflow-hidden shadow-sm border border-gray-100 hover:shadow-2xl hover:border-[#1a237e]/20 transition-all duration-500 group flex flex-col h-full">
            <!-- Armada Image -->
            <div class="relative h-64 overflow-hidden">
                <img src="{{ $armada->foto ? asset('storage/' . $armada->foto) : asset('images/default-car.png') }}" class="w-full h-full object-cover group-hover:scale-110 transition duration-700">
                <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent"></div>
                <div class="absolute bottom-6 left-6 right-6 flex justify-between items-end">
                    <div>
                        <p class="text-[10px] font-black text-[#fbc02d] uppercase tracking-widest leading-none mb-2">Tipe Kendaraan</p>
                        <h3 class="text-2xl font-black text-white uppercase tracking-tighter">{{ $armada->nama_armada }}</h3>
                    </div>
                </div>
            </div>

            <!-- Content -->
            <div class="p-8 space-y-8 flex flex-col flex-grow">
                <!-- Specs Grid -->
                <div class="grid grid-cols-2 gap-4">
                    <div class="bg-gray-50/50 p-3.5 rounded-2xl border border-gray-100 group-hover:bg-[#1a237e]/5 transition group-hover:border-[#1a237e]/10">
                        <div class="flex items-center gap-3">
                            <div class="w-8 h-8 rounded-lg bg-blue-100 flex items-center justify-center text-[#1a237e]">
                                <i class="bi bi-people-fill text-sm"></i>
                            </div>
                            <span class="text-[11px] font-bold text-gray-700 uppercase tracking-tighter">{{ $armada->kapasitas }} Kursi</span>
                        </div>
                    </div>
                    <div class="bg-gray-50/50 p-3.5 rounded-2xl border border-gray-100 group-hover:bg-[#1a237e]/5 transition group-hover:border-[#1a237e]/10">
                        <div class="flex items-center gap-3">
                            <div class="w-8 h-8 rounded-lg bg-green-100 flex items-center justify-center text-green-600">
                                <i class="bi bi-snow text-sm"></i>
                            </div>
                            <span class="text-[11px] font-bold text-gray-700 uppercase tracking-tighter">Full AC</span>
                        </div>
                    </div>
                    @if(isset($armada->bbm))
                    <div class="bg-gray-50/50 p-3.5 rounded-2xl border border-gray-100 group-hover:bg-[#1a237e]/5 transition group-hover:border-[#1a237e]/10">
                        <div class="flex items-center gap-3">
                            <div class="w-8 h-8 rounded-lg bg-yellow-100 flex items-center justify-center text-yellow-600">
                                <i class="bi bi-fuel-pump-fill text-sm"></i>
                            </div>
                            <span class="text-[11px] font-bold text-gray-700 uppercase tracking-tighter">{{ strtoupper($armada->bbm) }}</span>
                        </div>
                    </div>
                    @endif
                </div>

                <a href="{{ route('pelanggan.booking.create', ['armada_id' => $armada->id]) }}" class="inline-flex items-center justify-center w-full bg-[#1a237e] hover:bg-[#0d1440] text-white font-black py-4 rounded-2xl transition shadow-lg hover:shadow-xl uppercase tracking-[0.2em] text-[10px] gap-3 mt-auto transform active:scale-95">
                    Pilih Armada <i class="bi bi-arrow-right"></i>
                </a>
            </div>
        </div>
        @empty
        <div class="col-span-full text-center py-20 bg-white rounded-[40px] border border-dashed border-gray-200">
            <i class="bi bi-inbox text-7xl text-gray-200 mb-6 block"></i>
            <h3 class="text-xl font-black text-[#1a237e] uppercase tracking-widest">Belum Ada Armada</h3>
            <p class="text-gray-400 mt-2 font-medium">Kami akan segera memperbarui katalog armada kami.</p>
        </div>
        @endforelse
    </div>

    <!-- CTA Section -->
    <div class="bg-gradient-to-r from-[#1a237e] to-blue-800 rounded-3xl p-8 md:p-12 text-white text-center">
        <h2 class="text-3xl md:text-4xl font-black mb-4">Tidak Menemukan Yang Cocok?</h2>
        <p class="text-blue-200 text-lg mb-6 max-w-2xl mx-auto">Hubungi customer service kami untuk konsultasi pemilihan armada yang sesuai dengan kebutuhan Anda</p>
        <div class="flex flex-wrap gap-4 justify-center">
            <a href="{{ route('pelanggan.kontak') }}" class="bg-[#fbc02d] text-[#1a237e] px-8 py-4 rounded-xl font-black text-base inline-flex items-center gap-2 shadow-xl hover:bg-yellow-400 transition">
                <i class="bi bi-telephone-fill"></i>
                Hubungi Kami
            </a>
            <a href="{{ route('pelanggan.booking.create') }}" class="bg-white/10 backdrop-blur-sm border-2 border-white/30 text-white px-8 py-4 rounded-xl font-bold text-base inline-flex items-center gap-2 hover:bg-white/20 transition">
                <i class="bi bi-calendar-check"></i>
                Langsung Pesan
            </a>
        </div>
    </div>
@endsection
