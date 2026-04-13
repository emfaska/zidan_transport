@extends('layouts.pelanggan')

@section('title', 'Beranda - Zidan Transport')

@section('content')
    <!-- Dashboard Hero (Restored & Enhanced) -->
    <div class="relative bg-gradient-to-br from-[#1a237e] to-blue-900 rounded-[40px] p-8 md:p-16 text-white mb-12 overflow-hidden shadow-2xl">
        <div class="absolute top-0 right-0 w-1/2 h-full bg-white/5 skew-x-12 transform translate-x-20"></div>
        <div class="relative z-10 flex flex-col lg:flex-row items-center gap-12">
            <div class="w-full lg:w-3/5 space-y-6">
                <div class="inline-flex items-center gap-2 px-4 py-2 bg-white/10 backdrop-blur-md rounded-full text-[#fbc02d] text-[10px] font-black uppercase tracking-widest animate-fade-in-up">
                    <span class="relative flex h-2 w-2">
                        <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-yellow-400 opacity-75"></span>
                        <span class="relative inline-flex rounded-full h-2 w-2 bg-[#fbc02d]"></span>
                    </span>
                    Halo, {{ Auth::user()->name }} 👋
                </div>
                <h1 class="text-4xl md:text-6xl font-[900] leading-[1.1] uppercase tracking-tighter">
                    Siap Untuk <br/>
                    <span class="text-[#fbc02d]">Perjalanan Baru?</span>
                </h1>
                <p class="text-blue-100 text-sm md:text-lg leading-relaxed font-medium max-w-xl">
                    Kami menyediakan layanan transportasi premium dengan standar keamanan tinggi di Kediri. Nikmati perjalanan aman dan nyaman bersama kami.
                </p>
                <div class="flex flex-col sm:flex-row gap-4 pt-4">
                    <a href="{{ route('pelanggan.booking.create') }}" class="group bg-[#fbc02d] text-[#1a237e] px-10 py-5 rounded-2xl font-black text-xs shadow-xl hover:bg-white transition-all transform hover:-translate-y-1 flex items-center justify-center gap-3 uppercase tracking-widest">
                        PESAN SEKARANG <i class="bi bi-arrow-right-short text-2xl group-hover:translate-x-1 transition-transform"></i>
                    </a>
                </div>
            </div>
            <div class="hidden lg:block w-2/5">
                <img src="{{ asset('images/fleet_premium.png') }}" class="w-full h-auto drop-shadow-2xl" alt="Armada Premium">
            </div>
        </div>
    </div>

    <!-- Quick Stats Strip (Restored) -->
    <div class="grid grid-cols-2 md:grid-cols-4 gap-6 mb-12">
        <div class="bg-white p-6 rounded-[32px] border border-gray-100 shadow-sm text-center">
            <p class="text-3xl font-black text-[#1a237e]">5,000+</p>
            <p class="text-[9px] font-black text-gray-400 uppercase tracking-widest">Trip Selesai</p>
        </div>
        <div class="bg-white p-6 rounded-[32px] border border-gray-100 shadow-sm text-center">
            <p class="text-3xl font-black text-[#1a237e]">50+</p>
            <p class="text-[9px] font-black text-gray-400 uppercase tracking-widest">Unit Armada</p>
        </div>
        <div class="bg-white p-6 rounded-[32px] border border-gray-100 shadow-sm text-center">
            <p class="text-3xl font-black text-[#1a237e]">4.9/5</p>
            <p class="text-[9px] font-black text-gray-400 uppercase tracking-widest">Rating User</p>
        </div>
        <div class="bg-white p-6 rounded-[32px] border border-gray-100 shadow-sm text-center">
            <p class="text-3xl font-black text-[#1a237e]">24/7</p>
            <p class="text-[9px] font-black text-gray-400 uppercase tracking-widest">Siap Melayani</p>
        </div>
    </div>

    <!-- Search Tool (Always Useful) -->
    <div class="bg-white rounded-[40px] p-8 md:p-12 shadow-sm border border-gray-100 mb-12">
        <h2 class="text-2xl font-black text-[#1a237e] uppercase tracking-tighter mb-8">Cek Tarif Estimasi</h2>
        <form id="express-search-form" class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <div class="space-y-2">
                <label class="text-[10px] font-black uppercase tracking-widest text-gray-400 ml-1">Lokasi Awal</label>
                <input type="text" name="lokasi_awal" required placeholder="Contoh: Ngadiluwih..." class="w-full px-6 py-4 bg-gray-50 border border-gray-100 rounded-2xl focus:bg-white focus:border-[#1a237e] transition-all outline-none font-bold text-sm">
            </div>
            <div class="space-y-2">
                <label class="text-[10px] font-black uppercase tracking-widest text-gray-400 ml-1">Lokasi Tujuan</label>
                <input type="text" name="tujuan" required placeholder="Contoh: Juanda..." class="w-full px-6 py-4 bg-gray-50 border border-gray-100 rounded-2xl focus:bg-white focus:border-[#fbc02d] transition-all outline-none font-bold text-sm">
            </div>
            <div class="flex items-end">
                <button type="submit" id="search-btn" class="w-full bg-[#1a237e] text-white py-4 rounded-2xl font-black uppercase tracking-widest text-xs shadow-lg hover:bg-blue-900 transition-all flex items-center justify-center gap-3 h-[58px]">
                    <span id="btn-text">Cari Tarif</span> <i class="bi bi-search"></i>
                </button>
            </div>
        </form>
        <div id="search-results" class="mt-10 hidden"></div>
    </div>

    <!-- Services Section (Restored) -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-16">
        <div class="bg-white p-8 rounded-[40px] border border-gray-100 hover:shadow-xl transition-all group">
            <div class="w-14 h-14 bg-blue-50 rounded-2xl flex items-center justify-center mb-6 group-hover:bg-[#1a237e] transition duration-500">
                <i class="bi bi-shield-check text-[#1a237e] group-hover:text-white text-2xl"></i>
            </div>
            <h3 class="text-base font-black text-[#1a237e] mb-3 uppercase tracking-tight">Aman & Terpercaya</h3>
            <p class="text-xs text-gray-400 font-bold leading-relaxed">Prioritas kami adalah keselamatan dan kenyamanan setiap penumpang.</p>
        </div>
        <div class="bg-white p-8 rounded-[40px] border border-gray-100 hover:shadow-xl transition-all group">
            <div class="w-14 h-14 bg-yellow-50 rounded-2xl flex items-center justify-center mb-6 group-hover:bg-[#fbc02d] transition duration-500">
                <i class="bi bi-clock-history text-[#fbc02d] group-hover:text-[#1a237e] text-2xl"></i>
            </div>
            <h3 class="text-base font-black text-[#1a237e] mb-3 uppercase tracking-tight">On Time Service</h3>
            <p class="text-xs text-gray-400 font-bold leading-relaxed">Penjemputan tepat waktu oleh driver profesional kami.</p>
        </div>
        <div class="bg-white p-8 rounded-[40px] border border-gray-100 hover:shadow-xl transition-all group">
            <div class="w-14 h-14 bg-green-50 rounded-2xl flex items-center justify-center mb-6 group-hover:bg-green-500 transition duration-500">
                <i class="bi bi-car-front-fill text-green-500 group-hover:text-white text-2xl"></i>
            </div>
            <h3 class="text-base font-black text-[#1a237e] mb-3 uppercase tracking-tight">Armada Modern</h3>
            <p class="text-xs text-gray-400 font-bold leading-relaxed">Unit kendaraan yang selalu bersih, terawat, dan prima.</p>
        </div>
    </div>

    <!-- Floating Promo Area -->
    @if($promo)
    <div id="floating-promo" class="fixed bottom-8 right-8 z-[100] w-full max-w-[320px] transition-all duration-500 animate-fade-in-up">
        <div class="bg-white rounded-[32px] p-6 shadow-2xl border border-blue-50 relative overflow-hidden group">
            <div class="absolute -top-10 -right-10 w-24 h-24 bg-[#fbc02d]/10 rounded-full blur-2xl"></div>
            
            <!-- Close Button -->
            <button onclick="dismissPromo()" class="absolute top-4 right-4 w-8 h-8 flex items-center justify-center bg-gray-50 text-gray-400 rounded-full hover:bg-red-50 hover:text-red-500 transition-colors z-20">
                <i class="bi bi-x-lg text-xs"></i>
            </button>

            <div class="relative z-10">
                <div class="flex items-center gap-3 mb-4">
                    <div class="w-10 h-10 bg-[#fbc02d] rounded-xl flex items-center justify-center text-[#1a237e] shadow-lg">
                        <i class="bi bi-megaphone-fill"></i>
                    </div>
                    <div>
                        <p class="text-[9px] font-black text-gray-400 uppercase tracking-widest leading-none mb-1">Promo Khusus</p>
                        <h4 class="text-sm font-black text-[#1a237e] uppercase tracking-tighter">{{ $promo->nama_promo }}</h4>
                    </div>
                </div>
                
                <p class="text-xs text-gray-500 font-bold mb-4 leading-relaxed">Dapatkan potongan menarik untuk perjalanan Anda berikutnya!</p>

                <div class="bg-gray-50 p-4 rounded-2xl border border-gray-100 mb-6 text-center">
                    <p class="text-[9px] font-black text-gray-400 uppercase tracking-widest mb-1">Gunakan Kode</p>
                    <p class="text-lg font-black text-[#1a237e] tracking-widest uppercase">{{ $promo->kode_promo }}</p>
                </div>

                <a href="{{ route('pelanggan.booking.create') }}" class="block w-full text-center py-4 bg-[#1a237e] text-white font-black rounded-2xl text-[10px] uppercase tracking-widest shadow-xl hover:bg-[#0d1440] transition active:scale-95">
                    Klaim Sekarang
                </a>
            </div>
        </div>
    </div>

    <script>
        function dismissPromo() {
            const promo = document.getElementById('floating-promo');
            promo.classList.add('opacity-0', 'translate-y-10');
            setTimeout(() => promo.remove(), 500);
            sessionStorage.setItem('promo-dismissed', 'true');
        }

        document.addEventListener('turbo:load', () => {
            if (sessionStorage.getItem('promo-dismissed')) {
                const promo = document.getElementById('floating-promo');
                if (promo) promo.remove();
            }
        });
    </script>
    @endif
@endsection

@push('scripts')
<script>
    document.addEventListener('turbo:load', () => {
        const form = document.getElementById('express-search-form');
        if (!form) return;

        form.addEventListener('submit', async (e) => {
            e.preventDefault();
            const btn = document.getElementById('search-btn');
            const btnText = document.getElementById('btn-text');
            const resultsDiv = document.getElementById('search-results');
            
            btn.disabled = true;
            btnText.innerText = 'Mencari...';
            
            const formData = new FormData(form);
            
            try {
                const response = await fetch("{{ route('pelanggan.rute.search') }}", {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Accept': 'application/json'
                    }
                });
                
                const result = await response.json();
                
                if (result.success) {
                    let html = `<div class="space-y-4">`;
                    result.data.forEach(rute => {
                        html += `
                            <div class="bg-gray-50 border border-gray-100 rounded-[30px] p-6 flex flex-col md:flex-row justify-between items-center gap-6">
                                <div>
                                    <p class="text-[10px] font-black text-blue-400 uppercase tracking-widest leading-none mb-2">${rute.nama_rute} - ${rute.armada}</p>
                                    <h4 class="text-xl font-black text-[#1a237e] uppercase tracking-tighter">Rp ${rute.harga}</h4>
                                </div>
                                <a href="${rute.booking_url}" class="bg-[#fbc02d] text-[#1a237e] px-8 py-4 rounded-xl font-black text-[10px] uppercase tracking-widest hover:bg-[#1a237e] hover:text-white transition shadow-lg">Pesan Sekarang</a>
                            </div>
                        `;
                    });
                    html += `</div>`;
                    resultsDiv.innerHTML = html;
                    resultsDiv.classList.remove('hidden');
                } else {
                    resultsDiv.innerHTML = `<p class="text-center text-red-500 font-bold">${result.message}</p>`;
                    resultsDiv.classList.remove('hidden');
                }
            } catch (error) {
                console.error(error);
            } finally {
                btn.disabled = false;
                btnText.innerText = 'Cari Tarif';
            }
        });
    });
</script>
@endpush