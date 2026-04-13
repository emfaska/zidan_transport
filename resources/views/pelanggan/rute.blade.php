@extends('layouts.pelanggan')

@section('title', 'Rute Perjalanan - Zidan Transport')

@section('content')
    <!-- Breadcrumb -->
    <div class="mb-8">
        <div class="flex items-center gap-2 text-sm text-gray-500 mb-4">
            <a href="{{ Auth::check() ? route('home') : route('landing') }}" class="hover:text-[#1a237e]">Beranda</a>
            <i class="bi bi-chevron-right text-xs"></i>
            <span class="text-[#1a237e] font-semibold">Rute Perjalanan</span>
        </div>
        <h1 class="text-4xl md:text-5xl font-black text-[#1a237e] mb-2 uppercase tracking-tighter">Rute Populer</h1>
        <p class="text-gray-500 font-medium tracking-tight">Cek tarif transparan ke berbagai tujuan favorit Anda.</p>
    </div>

    <!-- Search Tool -->
    <div class="mb-10">
        <div class="relative max-w-2xl">
            <i class="bi bi-geo-alt-fill absolute left-5 top-1/2 -translate-y-1/2 text-[#fbc02d]"></i>
            <input type="text" id="rute-search" placeholder="Cari kota asal atau tujuan (Contoh: Surabaya, Juanda, Kediri...)" class="w-full pl-12 pr-6 py-5 bg-white border border-gray-100 rounded-[28px] shadow-sm focus:ring-2 focus:ring-[#1a237e] transition-all outline-none font-bold text-sm">
        </div>
    </div>

    <!-- Routes Grid -->
    <section class="mb-16">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6" id="rute-grid">
            @forelse($rutes as $rute)
            <div class="rute-card bg-white rounded-[40px] p-6 shadow-sm border border-gray-100 hover:shadow-2xl hover:-translate-y-1 transition-all duration-500 group flex flex-col">
                <div class="flex items-center gap-4 mb-6">
                    <div class="w-12 h-12 bg-blue-50 rounded-2xl flex items-center justify-center group-hover:bg-[#1a237e] transition duration-500 shrink-0">
                        <i class="bi bi-map-fill text-[#1a237e] group-hover:text-[#fbc02d] text-xl"></i>
                    </div>
                    <div class="min-w-0">
                        <p class="text-[9px] font-black text-gray-400 uppercase tracking-widest mb-1 truncate">{{ $rute->nama_rute }}</p>
                        <p class="font-black text-[#1a237e] text-base leading-none uppercase tracking-tighter rute-location truncate">
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
                <h3 class="text-xl font-black text-[#1a237e] uppercase tracking-widest">Belum Ada Rute</h3>
                <p class="text-gray-400 mt-2 font-medium">Silakan hubungi admin untuk rute kustom Anda.</p>
            </div>
            @endforelse
        </div>

        <!-- No Results Message -->
        <div id="no-results" class="hidden text-center py-20 bg-gray-50 rounded-[40px] border-2 border-dashed border-gray-200 mt-6">
            <i class="bi bi-search text-5xl text-gray-300 mb-4 block"></i>
            <h4 class="text-lg font-black text-[#1a237e] uppercase">Rute Tidak Ditemukan</h4>
            <p class="text-gray-400 text-sm font-medium">Coba gunakan kata kunci kota lain atau hubungi admin.</p>
        </div>
    </section>

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

@push('scripts')
<script>
    document.addEventListener('turbo:load', () => {
        const searchInput = document.getElementById('rute-search');
        if (!searchInput) return;

        searchInput.addEventListener('input', function() {
            const query = this.value.toLowerCase();
            const cards = document.querySelectorAll('.rute-card');
            const noResults = document.getElementById('no-results');
            let found = 0;
            
            cards.forEach(card => {
                const locationText = card.querySelector('.rute-location').innerText.toLowerCase();
                const routeName = card.querySelector('p.text-gray-400').innerText.toLowerCase();
                
                if (locationText.includes(query) || routeName.includes(query)) {
                    card.classList.remove('hidden');
                    card.classList.add('flex');
                    found++;
                } else {
                    card.classList.add('hidden');
                    card.classList.remove('flex');
                }
            });

            if (found === 0 && query !== "") {
                noResults.classList.remove('hidden');
            } else {
                noResults.classList.add('hidden');
            }
        });
    });
</script>
@endpush
