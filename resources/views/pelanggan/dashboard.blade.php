@extends('layouts.pelanggan')

@section('title', 'Dashboard Pelanggan - Zidan Transport')

@push('styles')
<style>
    .search-result-enter {
        animation: slideDown 0.5s ease-out forwards;
    }
    @keyframes slideDown {
        from { opacity: 0; transform: translateY(-20px); }
        to { opacity: 1; transform: translateY(0); }
    }
    .delay-100 { animation-delay: 0.1s; }
    .delay-200 { animation-delay: 0.2s; }
    .delay-300 { animation-delay: 0.3s; }
</style>
@endpush

@section('content')
    <!-- Professional Hero Section -->
    <div class="relative bg-gradient-to-br from-[#1a237e] to-blue-900 rounded-[40px] p-8 md:p-16 text-white mb-12 overflow-hidden shadow-2xl border-b-4 border-[#fbc02d]/30">
        <!-- Background Decorative Elements -->
        <div class="absolute top-0 right-0 w-1/2 h-full bg-white/5 skew-x-12 transform translate-x-20"></div>
        <div class="absolute -top-24 -left-24 w-96 h-96 bg-blue-400/20 rounded-full blur-[100px]"></div>
        
        <div class="relative z-10 flex flex-col lg:flex-row items-center gap-12">
            <!-- Left: Content -->
            <div class="w-full lg:w-3/5 space-y-6">
                <div class="inline-flex items-center gap-2 px-4 py-2 bg-white/10 backdrop-blur-md border border-white/20 rounded-full text-[#fbc02d] text-[10px] font-black uppercase tracking-widest animate-fade-in-up">
                    <span class="relative flex h-2 w-2">
                        <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-yellow-400 opacity-75"></span>
                        <span class="relative inline-flex rounded-full h-2 w-2 bg-[#fbc02d]"></span>
                    </span>
                    Halo, {{ Auth::user()->name }} 👋
                </div>

                <h1 class="text-4xl md:text-6xl font-[900] leading-[1.1] animate-fade-in-up delay-100 uppercase tracking-tighter">
                    Siap Untuk <br/>
                    <span class="text-[#fbc02d]">Perjalanan Baru?</span>
                </h1>

                <p class="text-blue-100 text-sm md:text-lg leading-relaxed font-medium animate-fade-in-up delay-200 max-w-xl">
                    Kami menyediakan layanan transportasi premium dengan standar keamanan tinggi. Nikmati pengalaman perjalanan terbaik di Kediri bersama Zidan Transport.
                </p>

                <div class="flex flex-col sm:flex-row gap-4 pt-4 animate-fade-in-up delay-300">
                    <a href="{{ route('pelanggan.booking.create') }}" class="group bg-[#fbc02d] text-[#1a237e] px-10 py-5 rounded-2xl font-black text-xs shadow-xl hover:bg-white transition-all transform hover:-translate-y-1 flex items-center justify-center gap-3 uppercase tracking-widest">
                        PESAN SEKARANG
                        <i class="bi bi-arrow-right-short text-2xl group-hover:translate-x-1 transition-transform"></i>
                    </a>
                    <a href="{{ route('pelanggan.armada') }}" class="bg-white/10 backdrop-blur-md border-2 border-white/20 text-white px-10 py-5 rounded-2xl font-black text-xs flex items-center justify-center gap-3 hover:bg-white/20 transition uppercase tracking-widest">
                        LIHAT ARMADA
                    </a>
                </div>
            </div>

            <!-- Right: Visual -->
            <div class="hidden lg:block w-2/5 relative animate-fade-in-up delay-300">
                <div class="relative">
                    <img src="{{ asset('images/fleet_premium.png') }}" class="w-full h-auto drop-shadow-[0_45px_35px_rgba(0,0,0,0.4)] transform -rotate-2 hover:rotate-0 hover:scale-105 transition duration-700" alt="Koleksi Armada Premium">
                    <!-- Floating Badge -->
                    <div class="absolute -bottom-6 -right-6 bg-white p-6 rounded-3xl shadow-2xl border border-gray-100 animate-bounce">
                        <div class="flex items-center gap-4">
                            <div class="w-12 h-12 bg-[#fbc02d] rounded-2xl flex items-center justify-center text-[#1a237e] shadow-lg">
                                <i class="bi bi-shield-check text-2xl"></i>
                            </div>
                            <div>
                                <p class="text-[10px] font-black text-gray-400 uppercase leading-none mb-1">Terverifikasi</p>
                                <p class="text-sm font-black text-[#1a237e] uppercase">Sangat Aman</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Promo Banner (Conditional) -->
    @if($promo)
    <div class="bg-[#fbc02d] rounded-3xl p-6 mb-12 flex flex-col md:flex-row items-center justify-between gap-6 shadow-xl shadow-yellow-500/20 animate-fade-in-up">
        <div class="flex items-center gap-6">
            <div class="w-16 h-16 bg-white rounded-2xl flex items-center justify-center shadow-lg transform -rotate-3 group-hover:rotate-0 transition duration-300">
                <i class="bi bi-megaphone-fill text-[#1a237e] text-3xl"></i>
            </div>
            <div>
                <h3 class="text-2xl font-black text-[#1a237e] uppercase tracking-tighter">{{ $promo->nama_promo }}</h3>
                <p class="text-[#1a237e]/70 font-bold uppercase tracking-widest text-[10px]">Gunakan Kode: <span class="bg-white px-2 py-0.5 rounded ml-1">{{ $promo->kode_promo }}</span></p>
            </div>
        </div>
        <div class="flex items-center gap-4">
            <div class="text-right">
                <p class="text-[10px] font-black text-[#1a237e]/50 uppercase tracking-widest">Diskon Hingga</p>
                <p class="text-3xl font-black text-[#1a237e]">
                    {{ $promo->tipe_diskon === 'persen' ? $promo->nilai_diskon . '%' : 'Rp ' . number_format($promo->nilai_diskon, 0, ',', '.') }}
                </p>
            </div>
            <a href="{{ route('pelanggan.booking.create') }}" class="bg-[#1a237e] text-white px-8 py-4 rounded-xl font-black text-[10px] uppercase tracking-widest hover:bg-[#0d1440] transition shadow-lg">
                Klaim Sekarang
            </a>
        </div>
    </div>
    @endif

    <!-- Search Tool Card -->
    <div class="bg-white rounded-[40px] p-8 md:p-12 shadow-2xl shadow-blue-900/5 mb-12 border border-blue-50 relative overflow-hidden group">
        <div class="absolute top-0 right-0 w-32 h-32 bg-blue-50 rounded-full -mr-16 -mt-16 group-hover:scale-110 transition duration-700"></div>
        
        <div class="relative z-10">
            <div class="flex flex-col md:flex-row md:items-end justify-between gap-8 mb-10">
                <div class="space-y-2">
                    <h2 class="text-3xl font-black text-[#1a237e] uppercase tracking-tighter">Cek Tarif Perjalanan</h2>
                    <p class="text-gray-400 font-bold uppercase tracking-widest text-[10px]">Dapatkan estimasi harga instan untuk rencana perjalanan Anda</p>
                </div>
                <div class="flex items-center gap-3">
                    <span class="flex h-3 w-3">
                        <span class="animate-ping absolute inline-flex h-3 w-3 rounded-full bg-green-400 opacity-75"></span>
                        <span class="relative inline-flex rounded-full h-3 w-3 bg-green-500"></span>
                    </span>
                    <span class="text-[10px] font-black text-gray-400 uppercase tracking-widest">Update Otomatis</span>
                </div>
            </div>

            <form id="express-search-form" class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <!-- Lokasi Awal -->
                <div class="space-y-3">
                    <label class="text-[10px] font-black uppercase tracking-[0.2em] text-[#1a237e]/50 ml-1">Masukan Lokasi Awal</label>
                    <div class="relative group">
                        <i class="bi bi-geo-alt-fill absolute left-5 top-1/2 -translate-y-1/2 text-gray-300 group-focus-within:text-[#1a237e] transition-colors"></i>
                        <input type="text" name="lokasi_awal" required placeholder="Contoh: Ngadiluwih, Kediri" class="w-full pl-14 pr-6 py-5 bg-gray-50 border-2 border-transparent rounded-[24px] focus:bg-white focus:border-[#1a237e] focus:ring-4 focus:ring-blue-900/5 transition-all outline-none font-bold text-[#1a237e] placeholder:text-gray-300">
                    </div>
                </div>

                <!-- Lokasi Tujuan -->
                <div class="space-y-3">
                    <label class="text-[10px] font-black uppercase tracking-[0.2em] text-[#1a237e]/50 ml-1">Ketik Lokasi Tujuan</label>
                    <div class="relative group">
                        <i class="bi bi-send-fill absolute left-5 top-1/2 -translate-y-1/2 text-gray-300 group-focus-within:text-[#fbc02d] transition-colors"></i>
                        <input type="text" name="tujuan" required placeholder="Contoh: Juanda, Surabaya" class="w-full pl-14 pr-6 py-5 bg-gray-50 border-2 border-transparent rounded-[24px] focus:bg-white focus:border-[#fbc02d] focus:ring-4 focus:ring-yellow-500/5 transition-all outline-none font-bold text-[#1a237e] placeholder:text-gray-300">
                    </div>
                </div>

                <!-- Submit Button -->
                <div class="flex items-end">
                    <button type="submit" id="search-btn" class="w-full bg-[#1a237e] text-white py-5 rounded-[24px] font-black uppercase tracking-[0.2em] text-xs shadow-xl shadow-blue-900/20 hover:bg-[#0d1440] hover:-translate-y-1 transition-all active:scale-95 flex items-center justify-center gap-4 min-h-[68px]">
                        <span id="btn-text">Cek Tarif & Armada</span>
                        <i class="bi bi-search text-lg"></i>
                    </button>
                </div>
            </form>

            <!-- Results Placeholder -->
            <div id="search-results" class="mt-10 hidden border-t border-gray-50 pt-10">
                <!-- Dynamic results will be injected here -->
            </div>
        </div>
    </div>

    <!-- Quick Services Grid -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-12">
        <!-- Service 1 -->
        <div class="bg-white p-8 rounded-[40px] shadow-sm border border-gray-100 hover:shadow-2xl hover:border-[#1a237e]/20 transition-all duration-500 group">
            <div class="w-14 h-14 bg-blue-50 rounded-2xl flex items-center justify-center mb-6 group-hover:scale-110 group-hover:bg-[#1a237e] transition duration-500">
                <i class="bi bi-clock-fill text-[#1a237e] group-hover:text-white text-2xl transition"></i>
            </div>
            <h3 class="text-sm font-black text-[#1a237e] mb-2 uppercase tracking-tight">Siap 24 Jam</h3>
            <p class="text-xs text-gray-400 font-bold leading-relaxed">Layanan penjemputan kapanpun Anda butuhkan.</p>
        </div>

        <!-- Service 2 -->
        <div class="bg-white p-8 rounded-[40px] shadow-sm border border-gray-100 hover:shadow-2xl hover:border-[#1a237e]/20 transition-all duration-500 group">
            <div class="w-14 h-14 bg-yellow-50 rounded-2xl flex items-center justify-center mb-6 group-hover:scale-110 group-hover:bg-[#fbc02d] transition duration-500">
                <i class="bi bi-person-fill-check text-[#fbc02d] group-hover:text-[#1a237e] text-2xl transition"></i>
            </div>
            <h3 class="text-sm font-black text-[#1a237e] mb-2 uppercase tracking-tight">Driver Handal</h3>
            <p class="text-xs text-gray-400 font-bold leading-relaxed">Pilot perjalanan yang ramah & berpengalaman.</p>
        </div>

        <!-- Service 3 -->
        <div class="bg-white p-8 rounded-[40px] shadow-sm border border-gray-100 hover:shadow-2xl hover:border-[#1a237e]/20 transition-all duration-500 group">
            <div class="w-14 h-14 bg-green-50 rounded-2xl flex items-center justify-center mb-6 group-hover:scale-110 group-hover:bg-green-500 transition duration-500">
                <i class="bi bi-shield-lock-fill text-green-500 group-hover:text-white text-2xl transition"></i>
            </div>
            <h3 class="text-sm font-black text-[#1a237e] mb-2 uppercase tracking-tight">Aman & Terpercaya</h3>
            <p class="text-xs text-gray-400 font-bold leading-relaxed">Proteksi maksimal untuk setiap rute perjalanan.</p>
        </div>

        <!-- Service 4 -->
        <div class="bg-[#1a237e] p-8 rounded-[40px] shadow-2xl shadow-blue-900/40 hover:-translate-y-2 transition-all duration-500 text-center flex flex-col items-center justify-center">
            <h3 class="text-sm font-black text-[#fbc02d] mb-4 uppercase tracking-[0.2em]">Butuh Bantuan?</h3>
            <a href="{{ route('pelanggan.kontak') }}" class="w-full bg-white/10 border border-white/20 text-white py-3 rounded-2xl text-[10px] font-black uppercase tracking-widest hover:bg-white hover:text-[#1a237e] transition">HUBUNGI CS</a>
        </div>
    </div>
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
            btnText.innerText = 'Mencari Penawaran...';
            
            const formData = new FormData(form);
            
            try {
                const response = await fetch("{{ route('pelanggan.express.search') }}", {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Accept': 'application/json'
                    }
                });
                
                const result = await response.json();
                
                if (result.success) {
                    let html = `
                        <div class="search-result-enter space-y-4">
                            <div class="flex items-center gap-2 mb-4">
                                <span class="h-px flex-grow bg-gray-100"></span>
                                <span class="text-[9px] font-black text-gray-400 uppercase tracking-widest">Hasil Estimasi</span>
                                <span class="h-px flex-grow bg-gray-100"></span>
                            </div>
                    `;
                    
                    result.data.forEach(rute => {
                        html += `
                            <div class="bg-gray-50 border border-gray-100 rounded-[30px] p-6 hover:border-[#fbc02d] transition-colors group">
                                <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-6">
                                    <div class="flex-grow">
                                        <div class="flex items-center gap-3 mb-2">
                                            <span class="px-3 py-1 bg-[#1a237e] text-white text-[9px] font-black rounded-full uppercase tracking-widest leading-none">${rute.nama_rute}</span>
                                            <span class="text-[10px] font-bold text-gray-400 italic">${rute.armada}</span>
                                        </div>
                                        <h4 class="text-xl font-black text-[#1a237e] uppercase tracking-tighter mb-1">
                                            Rp ${rute.harga}
                                        </h4>
                                        <div class="flex gap-4 text-[10px] font-bold text-gray-500 uppercase">
                                            <span><i class="bi bi-geo-alt mr-1"></i> ${rute.jarak}</span>
                                            <span><i class="bi bi-clock mr-1"></i> ${rute.durasi}</span>
                                        </div>
                                    </div>
                                    <a href="${rute.booking_url}" class="w-full md:w-auto bg-[#fbc02d] text-[#1a237e] px-8 py-4 rounded-2xl font-black text-[10px] uppercase tracking-widest hover:bg-[#1a237e] hover:text-white transition-all shadow-lg flex items-center justify-center gap-2">
                                        Pesan Sekarang <i class="bi bi-arrow-right"></i>
                                    </a>
                                </div>
                            </div>
                        `;
                    });
                    
                    html += `</div>`;
                    resultsDiv.innerHTML = html;
                    resultsDiv.classList.remove('hidden');
                } else {
                    resultsDiv.innerHTML = `
                        <div class="search-result-enter p-8 text-center bg-red-50 rounded-[30px] border border-red-100">
                            <i class="bi bi-exclamation-triangle text-3xl text-red-500 mb-3 block"></i>
                            <h4 class="text-sm font-black text-red-700 uppercase mb-2">${result.message}</h4>
                            <p class="text-[11px] text-red-600 font-medium mb-6">Jangan khawatir! Hubungi tim bantuan kami untuk mendapatkan penawaran khusus rute Anda.</p>
                            <a href="https://wa.me/{{ \App\Models\Setting::get('contact_whatsapp', '6282142951682') }}" target="_blank" class="inline-flex items-center gap-2 bg-[#25D366] text-white px-6 py-3 rounded-xl font-black text-[10px] uppercase tracking-widest hover:scale-105 transition-transform shadow-md">
                                <i class="bi bi-whatsapp"></i> Chat Admin Sekarang
                            </a>
                        </div>
                    `;
                    resultsDiv.classList.remove('hidden');
                }
            } catch (error) {
                console.error(error);
                alert('Terjadi kesalahan saat mencari rute.');
            } finally {
                btn.disabled = false;
                btnText.innerText = 'Cek Tarif & Armada';
            }
        });
    });
</script>
@endpush