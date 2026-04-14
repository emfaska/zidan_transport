@extends('layouts.pelanggan')

@section('title', 'Paket Rute - Zidan Transport')

@section('content')
    <!-- Breadcrumb -->
    <div class="mb-8">
        <div class="flex items-center gap-2 text-sm text-gray-500 mb-4">
            <a href="{{ Auth::check() ? route('home') : route('landing') }}" class="hover:text-[#1a237e]">Beranda</a>
            <i class="bi bi-chevron-right text-xs"></i>
            <span class="text-[#1a237e] font-semibold">Paket Rute</span>
        </div>
        <h1 class="text-4xl md:text-5xl font-black text-[#1a237e] mb-2 uppercase tracking-tighter">Paket Rute</h1>
        <p class="text-gray-500 font-medium tracking-tight">Pilih paket rute terbaik — sudah termasuk armada, driver, dan harga transparan.</p>
    </div>

    <!-- Search Tool (Server-Side) -->
    <div class="mb-10 flex flex-col md:flex-row gap-4 items-center justify-between">
        <form action="{{ route('pelanggan.rute') }}" method="GET" class="relative w-full md:w-96">
            <i class="bi bi-geo-alt-fill absolute left-5 top-1/2 -translate-y-1/2 text-[#fbc02d]"></i>
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari kota asal atau tujuan..." class="w-full pl-12 pr-6 py-4 bg-white border border-gray-100 rounded-2xl shadow-sm focus:ring-2 focus:ring-[#1a237e] transition-all outline-none font-bold text-sm">
        </form>
        <div class="flex items-center gap-2 text-[10px] font-black text-gray-400 uppercase tracking-widest">
            <i class="bi bi-info-circle"></i>
            Menampilkan {{ $rutes->count() }} dari {{ $rutes->total() }} Paket Rute
        </div>
    </div>

    <!-- Routes Grid -->
    <section class="mb-12">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @forelse($rutes as $rute)
            <div class="bg-white rounded-[40px] p-6 shadow-sm border border-gray-100 hover:shadow-2xl hover:-translate-y-1 transition-all duration-500 group flex flex-col">
                <div class="flex items-center gap-4 mb-6">
                    <div class="w-12 h-12 bg-blue-50 rounded-2xl flex items-center justify-center group-hover:bg-[#1a237e] transition duration-500 shrink-0">
                        <i class="bi bi-map-fill text-[#1a237e] group-hover:text-[#fbc02d] text-xl"></i>
                    </div>
                    <div class="min-w-0">
                        <p class="text-[9px] font-black text-gray-400 uppercase tracking-widest mb-1 truncate">{{ $rute->nama_rute }}</p>
                        <p class="font-black text-[#1a237e] text-base leading-none uppercase tracking-tighter truncate">
                            {{ $rute->lokasi_awal }} <span class="text-[#fbc02d] mx-1">/</span> {{ $rute->tujuan }}
                        </p>
                    </div>
                </div>
                
                <div class="space-y-4 mb-8">
                    <div class="bg-gray-50 px-6 py-4 rounded-3xl border border-gray-100">
                        <p class="text-[9px] font-black text-gray-400 uppercase tracking-widest mb-1">Estimasi Tarif</p>
                        <p class="text-xl font-black text-green-600 tracking-tighter">Rp {{ number_format($rute->harga_paket, 0, ',', '.') }}</p>
                    </div>
                    <div class="px-2">
                        <div class="flex items-center gap-2 text-[10px] text-gray-400 font-black uppercase tracking-tighter">
                            <i class="bi bi-check2-circle text-green-500"></i>
                            <span>All-In Driver & BBM</span>
                        </div>
                    </div>
                </div>

                <a href="{{ route('pelanggan.booking.create', ['rute_id' => $rute->id]) }}" class="mt-auto flex items-center justify-center w-full bg-[#1a237e] text-white font-black py-4 rounded-2xl shadow-lg hover:bg-[#0d1440] transition-all uppercase tracking-widest text-[10px] gap-3 transform group-hover:scale-[1.02]">
                    Pesan Sekarang <i class="bi bi-arrow-right"></i>
                </a>
            </div>
            @empty
             <div class="col-span-full text-center py-20 bg-white rounded-[40px] border border-dashed border-gray-200">
                <i class="bi bi-send-x text-6xl text-gray-200 mb-6 block"></i>
                <h3 class="text-xl font-black text-[#1a237e] uppercase tracking-widest">Paket Rute Tidak Ditemukan</h3>
                <p class="text-gray-400 mt-2 font-medium">Silakan hubungi admin untuk paket rute kustom Anda.</p>
            </div>
            @endforelse
        </div>
    </section>

    <!-- Pagination Support -->
    <div class="pagination-container mb-16">
        {{ $rutes->links() }}
    </div>

    <!-- Info Guide -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-12">
        <div class="p-8 bg-white rounded-[32px] border border-gray-100 shadow-sm flex gap-6 items-start">
            <div class="w-12 h-12 bg-green-50 rounded-2xl flex items-center justify-center text-green-600 shrink-0">
                <i class="bi bi-cash-stack text-2xl"></i>
            </div>
            <div>
                <h4 class="font-black text-[#1a237e] uppercase text-sm tracking-tight mb-1">Transparan</h4>
                <p class="text-xs text-gray-400 font-bold leading-relaxed">Harga yang tertera adalah estimasi paket standar. Tidak ada biaya tersembunyi.</p>
            </div>
        </div>
        <div class="p-8 bg-white rounded-[32px] border border-gray-100 shadow-sm flex gap-6 items-start">
            <div class="w-12 h-12 bg-blue-50 rounded-2xl flex items-center justify-center text-[#1a237e] shrink-0">
                <i class="bi bi-headset text-2xl"></i>
            </div>
            <div>
                <h4 class="font-black text-[#1a237e] uppercase text-sm tracking-tight mb-1">Bantuan 24/7</h4>
                <p class="text-xs text-gray-400 font-bold leading-relaxed">Butuh rute ke kota lain? Hubungi WhatsApp kami kapan saja untuk penawaran kilat.</p>
            </div>
        </div>
    </div>
@endsection
