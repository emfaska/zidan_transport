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
        <h1 class="text-4xl md:text-5xl font-black text-[#1a237e] mb-2 uppercase tracking-tighter">Armada Terpercaya</h1>
        <p class="text-gray-500 font-medium tracking-tight">Kapasitas besar, kenyamanan maksimal, performa handal.</p>
    </div>

    <!-- Search & Filter Bar (Minimalist) -->
    <div class="mb-12 flex flex-col md:flex-row gap-6 items-center justify-between">
        <form action="{{ route('pelanggan.armada') }}" method="GET" class="relative w-full md:w-[450px] group">
            <i class="bi bi-search absolute left-6 top-1/2 -translate-y-1/2 text-gray-400 group-focus-within:text-[#1a237e] transition-colors"></i>
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari unit atau merk kendaraan..." class="w-full pl-14 pr-6 py-5 bg-white border border-gray-100 rounded-[24px] shadow-sm group-hover:shadow-lg focus:ring-4 focus:ring-blue-900/5 transition-all outline-none font-bold text-sm text-[#1a237e] placeholder:text-gray-300">
        </form>
        <div class="px-6 py-3 bg-blue-50/50 rounded-2xl border border-blue-100/50 flex items-center gap-3">
            <span class="relative flex h-2 w-2">
                <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-blue-400 opacity-75"></span>
                <span class="relative inline-flex rounded-full h-2 w-2 bg-blue-600"></span>
            </span>
            <span class="text-[10px] font-black text-[#1a237e] uppercase tracking-widest text-center">Tersedia {{ $armadas->total() }} Unit Terbaik</span>
        </div>
    </div>

    <!-- Armada Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 mb-16">
        @forelse($armadas as $armada)
        <div class="bg-white rounded-[40px] shadow-sm border border-gray-100 hover:shadow-2xl transition-all duration-700 group flex flex-col h-full overflow-hidden">
            <!-- Armada Image Container (Clean, no overlay) -->
            <div class="relative h-56 bg-gray-50 overflow-hidden">
                <img src="{{ $armada->foto ? asset('storage/' . $armada->foto) : asset('images/default-car.png') }}" class="w-full h-full object-cover group-hover:scale-105 transition duration-1000">
                <!-- Status Badge -->
                <div class="absolute top-5 right-5">
                    <span class="px-4 py-1.5 bg-green-500 text-white text-[9px] font-black rounded-full uppercase tracking-widest shadow-lg shadow-green-500/30">Tersedia</span>
                </div>
            </div>

            <!-- Content Body -->
            <div class="p-8 flex flex-col flex-grow">
                <!-- Name & Brand (Updated Position) -->
                <div class="mb-6">
                    <p class="text-[10px] font-black text-[#fbc02d] uppercase tracking-[0.3em] mb-1.5">{{ explode(' ', $armada->nama)[0] }}</p>
                    <h3 class="text-2xl font-black text-[#1a237e] uppercase tracking-tighter leading-tight">{{ $armada->nama }}</h3>
                </div>

                <!-- One Row Specs (Requested) -->
                <div class="flex items-center flex-wrap gap-4 py-6 border-y border-gray-50 mb-8">
                    <div class="flex items-center gap-2">
                        <div class="w-8 h-8 rounded-xl bg-blue-50 flex items-center justify-center text-[#1a237e]">
                            <i class="bi bi-people-fill text-sm"></i>
                        </div>
                        <span class="text-[11px] font-black text-gray-500 uppercase tracking-tighter">{{ $armada->kapasitas }} S</span>
                    </div>
                    <div class="h-4 w-px bg-gray-100"></div>
                    <div class="flex items-center gap-2">
                        <div class="w-8 h-8 rounded-xl bg-green-50 flex items-center justify-center text-green-600">
                            <i class="bi bi-snow text-sm"></i>
                        </div>
                        <span class="text-[11px] font-black text-gray-400 uppercase tracking-tighter">AC</span>
                    </div>
                    @if($armada->jenis)
                    <div class="h-4 w-px bg-gray-100"></div>
                    <div class="flex items-center gap-2">
                        <div class="w-8 h-8 rounded-xl bg-yellow-50 flex items-center justify-center text-yellow-600">
                            <i class="bi bi-truck text-sm"></i>
                        </div>
                        <span class="text-[11px] font-black text-gray-400 uppercase tracking-tighter truncate max-w-[80px]">{{ $armada->jenis }}</span>
                    </div>
                    @endif
                </div>

                <!-- Action Button -->
                <a href="{{ route('pelanggan.booking.create', ['armada_id' => $armada->id]) }}" class="mt-auto group/btn flex items-center justify-between w-full bg-[#1a237e] text-white p-2 rounded-[22px] transition-all hover:bg-[#0d1440] hover:shadow-xl active:scale-95">
                    <span class="pl-6 text-[11px] font-black uppercase tracking-[0.2em]">Pilih Unit</span>
                    <div class="w-12 h-12 bg-[#fbc02d] text-[#1a237e] rounded-2xl flex items-center justify-center group-hover/btn:scale-110 transition-transform">
                        <i class="bi bi-arrow-right-short text-3xl"></i>
                    </div>
                </a>
            </div>
        </div>
        @empty
        <div class="col-span-full text-center py-20 bg-white rounded-[40px] border border-dashed border-gray-100 italic">
            <i class="bi bi-search text-6xl text-gray-200 mb-6 block"></i>
            <p class="text-gray-400 font-bold uppercase tracking-widest text-sm">Unit tidak ditemukan</p>
        </div>
        @endforelse
    </div>

    <!-- Pagination -->
    <div class="flex justify-center mb-20">
        {{ $armadas->links() }}
    </div>

    <!-- Contact Support Footer -->
    <div class="bg-white rounded-[48px] p-10 md:p-16 border border-gray-100 shadow-sm flex flex-col md:flex-row items-center justify-between gap-10">
        <div class="text-center md:text-left">
            <h4 class="text-2xl font-black text-[#1a237e] uppercase tracking-tighter mb-4">Butuh Kapasitas Lebih Besar?</h4>
            <p class="text-gray-400 text-sm font-bold uppercase tracking-widest leading-relaxed">Hubungi admin untuk ketersediaan bus pariwisata atau iring-iringan armada.</p>
        </div>
        <a href="{{ route('pelanggan.kontak') }}" class="bg-[#1a237e] text-white px-10 py-5 rounded-[24px] font-black text-xs uppercase tracking-[0.2em] shadow-2xl shadow-blue-900/20 hover:scale-105 transition-transform">
            Bicara Dengan Admin
        </a>
    </div>
@endsection
