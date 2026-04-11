<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rute Perjalanan - Zidan Transport</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <style>
        body { font-family: 'Montserrat', sans-serif; }
        .dropdown:hover .dropdown-menu { display: block; }
    </style>
</head>
<body class="bg-gray-50">

    @include('partials.pelanggan.navbar')

    <main class="max-w-7xl mx-auto p-4 md:p-8 pt-24 md:pt-28">
        
        <!-- Breadcrumb -->
        <div class="mb-12">
            <div class="flex items-center gap-2 text-sm text-gray-500 mb-4">
                <a href="{{ Auth::check() ? route('home') : route('landing') }}" class="hover:text-[#1a237e]">Beranda</a>
                <i class="bi bi-chevron-right text-xs"></i>
                <span class="text-[#1a237e] font-semibold">Rute Perjalanan</span>
            </div>
            <h1 class="text-4xl md:text-5xl font-black text-[#1a237e] mb-4 uppercase">Rute Favorit</h1>
            <p class="text-lg text-gray-600 max-w-3xl">Pilih rute perjalanan Anda dengan estimasi tarif yang transparan dan kompetitif.</p>
        </div>

        <!-- Popular Routes Section -->
        <section class="mb-12">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                @forelse($rutes as $rute)
                <div class="bg-white rounded-[40px] p-8 shadow-sm border border-gray-100 hover:shadow-2xl hover:-translate-y-2 transition-all duration-500 group">
                    <div class="flex items-center gap-4 mb-6">
                        <div class="w-14 h-14 bg-blue-50 rounded-2xl flex items-center justify-center group-hover:bg-[#1a237e] transition duration-500">
                            <i class="bi bi-geo-alt-fill text-[#1a237e] group-hover:text-[#fbc02d] text-2xl"></i>
                        </div>
                        <div>
                            <p class="text-[10px] font-black text-gray-400 uppercase tracking-[0.2em] mb-1">{{ $rute->nama_rute }}</p>
                            <p class="font-black text-[#1a237e] text-lg leading-none uppercase tracking-tighter">{{ $rute->lokasi_awal }} <span class="text-[#fbc02d] mx-1">/</span> {{ $rute->tujuan }}</p>
                        </div>
                    </div>
                    
                    <div class="space-y-4 mb-8">
                        <div class="bg-gray-50 px-6 py-4 rounded-3xl border border-gray-100">
                            <p class="text-[10px] font-black text-gray-400 uppercase tracking-widest mb-1">Estimasi Tarif</p>
                            <p class="text-2xl font-[900] text-[#16a34a]">Rp {{ number_format($rute->harga_paket, 0, ',', '.') }}</p>
                        </div>
                        <div class="px-2">
                            <div class="flex items-center gap-2 text-xs text-gray-500 font-bold">
                                <i class="bi bi-check2-circle text-green-500"></i>
                                <span>Sudah Termasuk Driver</span>
                            </div>
                            <div class="flex items-center gap-2 text-xs text-gray-500 font-bold mt-1">
                                <i class="bi bi-check2-circle text-green-500"></i>
                                <span>Layanan 24 Jam</span>
                            </div>
                        </div>
                    </div>

                    <a href="{{ route('pelanggan.booking.create', ['rute_id' => $rute->id]) }}" class="flex items-center justify-center w-full bg-[#1a237e] text-white font-black py-4 rounded-2xl shadow-lg hover:bg-[#0d1440] transition-all uppercase tracking-widest text-xs gap-3 transform group-hover:scale-[1.02]">
                        Pesan Rute Ini <i class="bi bi-arrow-right"></i>
                    </a>
                </div>
                @empty
                 <div class="col-span-full text-center py-20 bg-white rounded-[40px] border border-dashed border-gray-200">
                    <i class="bi bi-map text-6xl text-gray-200 mb-6 block"></i>
                    <h3 class="text-xl font-black text-[#1a237e] uppercase tracking-widest">Belum Ada Rute</h3>
                    <p class="text-gray-400 mt-2 font-medium">Kami akan segera memperbarui rute perjalanan kami.</p>
                </div>
                @endforelse
            </div>
        </section>

        <!-- FAQ Section for Routes -->
        <div class="bg-white rounded-[40px] p-8 md:p-12 shadow-sm border border-gray-100 mb-12">
            <h2 class="text-2xl font-black text-[#1a237e] mb-8 flex items-center gap-3">
                <i class="bi bi-info-circle-fill text-[#fbc02d]"></i>
                Informasi Tarif Rute
            </h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <div class="space-y-4">
                    <div class="flex gap-4">
                        <div class="w-10 h-10 rounded-full bg-blue-50 flex items-center justify-center shrink-0">
                            <i class="bi bi-check text-[#1a237e] text-xl font-bold"></i>
                        </div>
                        <div>
                            <h4 class="font-black text-[#1a237e] text-sm uppercase">Harga All-In</h4>
                            <p class="text-gray-500 text-xs font-medium leading-relaxed">Tarif yang tertera sudah termasuk biaya armada, pengemudi, dan BBM untuk rute standar.</p>
                        </div>
                    </div>
                </div>
                <div class="space-y-4">
                    <div class="flex gap-4">
                        <div class="w-10 h-10 rounded-full bg-blue-50 flex items-center justify-center shrink-0">
                            <i class="bi bi-exclamation text-[#1a237e] text-xl font-bold"></i>
                        </div>
                        <div>
                            <h4 class="font-black text-[#1a237e] text-sm uppercase">Biaya Tambahan</h4>
                            <p class="text-gray-500 text-xs font-medium leading-relaxed">Biaya tol, parkir, dan makan driver belum termasuk dalam harga paket rute ini.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- CTA Section -->
        <div class="bg-gradient-to-r from-[#1a237e] to-blue-800 rounded-3xl p-8 md:p-12 text-white text-center">
            <h2 class="text-3xl md:text-4xl font-black mb-4">Butuh Rute Khusus?</h2>
            <p class="text-blue-200 text-lg mb-6 max-w-2xl mx-auto">Kami melayani perjalanan ke luar kota atau rute khusus sesuai keinginan Anda. Hubungi kami untuk konsultasi harga.</p>
            <div class="flex flex-wrap gap-4 justify-center">
                <a href="{{ route('pelanggan.kontak') }}" class="bg-[#fbc02d] text-[#1a237e] px-8 py-4 rounded-xl font-black text-base inline-flex items-center gap-2 shadow-xl hover:bg-yellow-400 transition">
                    <i class="bi bi-telephone"></i> Hubungi CS
                </a>
                <a href="{{ route('pelanggan.booking.create') }}" class="bg-white/10 backdrop-blur-sm border-2 border-white/30 text-white px-8 py-4 rounded-xl font-bold text-base inline-flex items-center gap-2 hover:bg-white/20 transition">
                    <i class="bi bi-calendar-check"></i> Pesanan Khusus
                </a>
            </div>
        </div>

    </main>

    @include('partials.pelanggan.footer')

</body>
</html>
