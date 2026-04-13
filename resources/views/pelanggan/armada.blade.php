@extends('layouts.pelanggan')

@section('title', 'Armada Kami - Zidan Transport')

@section('content')
    <!-- Breadcrumb -->
    <div class="mb-8">
        <div class="flex items-center gap-2 text-sm text-gray-500 mb-4">
            <a href="{{ Auth::check() ? route('home') : route('landing') }}" class="hover:text-[#1a237e]">Beranda</a>
            <i class="bi bi-chevron-right text-xs"></i>
            <span class="text-[#1a237e] font-semibold">Armada</span>
        </div>
        <h1 class="text-4xl md:text-5xl font-black text-[#1a237e] mb-2 uppercase tracking-tighter">Armada Kami</h1>
        <p class="text-gray-500 font-medium tracking-tight">Temukan kendaraan terbaik untuk perjalanan Anda.</p>
    </div>

    <!-- Search & Filter Bar (Server-Side) -->
    <div class="mb-10 flex flex-col md:flex-row gap-4 items-center justify-between">
        <form action="{{ route('pelanggan.armada') }}" method="GET" class="relative w-full md:w-96">
            <i class="bi bi-search absolute left-5 top-1/2 -translate-y-1/2 text-gray-400"></i>
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari nama atau merk armada..." class="w-full pl-12 pr-6 py-4 bg-white border border-gray-100 rounded-2xl shadow-sm focus:ring-2 focus:ring-[#1a237e] transition-all outline-none font-bold text-sm">
        </form>
        <div class="flex items-center gap-2 text-[10px] font-black text-gray-400 uppercase tracking-widest">
            <i class="bi bi-info-circle"></i>
            Menampilkan {{ $armadas->count() }} dari {{ $armadas->total() }} Armada
        </div>
    </div>

    <!-- Armada Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-12">
        @forelse($armadas as $armada)
        <div class="bg-white rounded-[32px] overflow-hidden shadow-sm border border-gray-100 hover:shadow-2xl hover:border-[#1a237e]/20 transition-all duration-500 group flex flex-col h-full">
            <!-- Armada Image -->
            <div class="relative h-48 overflow-hidden">
                <img src="{{ $armada->foto ? asset('storage/' . $armada->foto) : asset('images/default-car.png') }}" class="w-full h-full object-cover group-hover:scale-110 transition duration-700">
                <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent"></div>
                <div class="absolute bottom-4 left-6 right-6 flex justify-between items-end">
                    <div>
                        <p class="text-[9px] font-black text-[#fbc02d] uppercase tracking-widest leading-none mb-1">{{ $armada->merk }}</p>
                        <h3 class="text-lg font-black text-white uppercase tracking-tighter">{{ $armada->nama }}</h3>
                    </div>
                </div>
            </div>

            <!-- Content -->
            <div class="p-6 space-y-4 flex flex-col flex-grow">
                <!-- Specs Compact -->
                <div class="grid grid-cols-2 gap-3">
                    <div class="bg-gray-50/50 p-3 rounded-xl border border-gray-100 flex items-center gap-3">
                        <div class="w-7 h-7 rounded-lg bg-blue-100 flex items-center justify-center text-[#1a237e]">
                            <i class="bi bi-people-fill text-xs"></i>
                        </div>
                        <span class="text-[10px] font-bold text-gray-700 uppercase tracking-tighter">{{ $armada->kapasitas }} Kursi</span>
                    </div>
                    <div class="bg-gray-50/50 p-3 rounded-xl border border-gray-100 flex items-center gap-3">
                        <div class="w-7 h-7 rounded-lg bg-green-100 flex items-center justify-center text-green-600">
                            <i class="bi bi-snow text-xs"></i>
                        </div>
                        <span class="text-[10px] font-bold text-gray-700 uppercase tracking-tighter">Full AC</span>
                    </div>
                    @if($armada->jenis)
                    <div class="bg-gray-50/50 p-3 rounded-xl border border-gray-100 flex items-center gap-3">
                        <div class="w-7 h-7 rounded-lg bg-yellow-100 flex items-center justify-center text-yellow-600">
                            <i class="bi bi-truck text-xs"></i>
                        </div>
                        <span class="text-[10px] font-bold text-gray-700 uppercase tracking-tighter">{{ strtoupper($armada->jenis) }}</span>
                    </div>
                    @endif
                </div>

                <a href="{{ route('pelanggan.booking.create', ['armada_id' => $armada->id]) }}" class="inline-flex items-center justify-center w-full bg-[#1a237e] hover:bg-[#0d1440] text-white font-black py-3.5 rounded-xl transition shadow-lg hover:shadow-xl uppercase tracking-[0.2em] text-[10px] gap-3 mt-auto transform active:scale-95">
                    Pilih Armada <i class="bi bi-arrow-right"></i>
                </a>
            </div>
        </div>
        @empty
        <div class="col-span-full text-center py-20 bg-white rounded-[40px] border border-dashed border-gray-200">
            <i class="bi bi-inbox text-7xl text-gray-200 mb-6 block"></i>
            <h3 class="text-xl font-black text-[#1a237e] uppercase tracking-widest">Armada Tidak Ditemukan</h3>
            <p class="text-gray-400 mt-2 font-medium">Coba gunakan kata kunci pencarian lain.</p>
        </div>
        @endforelse
    </div>

    <!-- Pagination Support -->
    <div class="pagination-container mb-16">
        {{ $armadas->links() }}
    </div>

    <!-- CTA Section -->
    <div class="bg-gradient-to-r from-[#1a237e] to-blue-800 rounded-[40px] p-10 text-white text-center shadow-2xl shadow-blue-900/20">
        <h2 class="text-3xl font-black mb-4 uppercase tracking-tighter">Butuh Rekomendasi?</h2>
        <p class="text-blue-200 text-sm mb-8 max-w-xl mx-auto font-medium">Tim kami siap membantu Anda memilih kendaraan yang paling pas buat perjalanan Anda.</p>
        <div class="flex justify-center">
            <a href="{{ route('pelanggan.kontak') }}" class="bg-[#fbc02d] text-[#1a237e] px-8 py-4 rounded-xl font-black text-xs inline-flex items-center gap-3 shadow-xl hover:bg-yellow-400 transition transform hover:-translate-y-1 uppercase tracking-widest">
                <i class="bi bi-whatsapp text-lg"></i>
                Chat Admin
            </a>
        </div>
    </div>
@endsection
