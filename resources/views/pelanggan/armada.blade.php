<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Armada Kami - Zidan Transport</title>
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
        
        <!-- Page Header -->
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
                    <a href="{{ route('pelanggan.booking.create') }}" class="bg-[#1a237e] text-white px-8 py-4 rounded-2xl font-black text-xs uppercase tracking-[0.2em] shadow-xl hover:bg-[#0d1440] transition transform hover:scale-105 active:scale-95">
                        Pesan Sekarang
                    </a>
                </div>
            </div>
        </div>
        @endif

        <!-- Filter/Category (Simple, can be enhanced later) -->
        <div class="flex flex-wrap gap-3 mb-8">
            <button class="px-6 py-3 bg-[#1a237e] text-white font-bold rounded-xl shadow-lg">
                <i class="bi bi-grid-fill mr-2"></i> Semua Armada
            </button>
            <button class="px-6 py-3 bg-white text-gray-700 font-semibold rounded-xl border-2 border-gray-200 hover:border-[#1a237e] hover:text-[#1a237e] transition">
                Keluarga (5-7 seat)
            </button>
            <button class="px-6 py-3 bg-white text-gray-700 font-semibold rounded-xl border-2 border-gray-200 hover:border-[#1a237e] hover:text-[#1a237e] transition">
                Rombongan (8+ seat)
            </button>
            <button class="px-6 py-3 bg-white text-gray-700 font-semibold rounded-xl border-2 border-gray-200 hover:border-[#1a237e] hover:text-[#1a237e] transition">
                Premium
            </button>
        </div>

        <!-- Fleet Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 mb-16">
            @forelse($armadas as $armada)
            <!-- Fleet Card: {{ $armada->nama }} -->
            <div class="bg-white rounded-[40px] overflow-hidden shadow-sm hover:shadow-2xl transition transform hover:-translate-y-2 border border-gray-100 flex flex-col h-full group">
                <div class="bg-gray-100 flex items-center justify-center h-56 relative overflow-hidden p-6">
                    @if($armada->foto)
                        <img src="{{ asset('storage/'.$armada->foto) }}" alt="{{ $armada->nama }}" class="w-full h-full object-contain group-hover:scale-105 transition duration-500">
                    @else
                        <div class="w-full h-full flex flex-col items-center justify-center text-gray-300">
                             <i class="bi bi-car-front-fill text-6xl"></i>
                             <span class="text-[10px] uppercase font-black tracking-widest mt-3">Katalog Armada</span>
                        </div>
                    @endif
                    <div class="absolute top-4 right-4 bg-white/95 backdrop-blur-md px-4 py-1.5 rounded-full shadow-md border border-gray-50">
                         <span class="text-[10px] font-[800] text-[#1a237e] uppercase tracking-wider italic">{{ $armada->tahun }}</span>
                    </div>
                </div>
                <div class="p-8 flex-grow flex flex-col">
                    <div class="mb-6">
                        <div class="flex justify-between items-start gap-2">
                            <h3 class="text-xl font-[900] text-[#1a237e] uppercase leading-tight tracking-tight">{{ $armada->nama }}</h3>
                            <span class="flex-shrink-0 text-[#fbc02d] text-[9px] font-black uppercase tracking-widest bg-yellow-50 px-2 py-0.5 rounded-md border border-yellow-100">{{ $armada->plat_nomor }}</span>
                        </div>
                        <div class="flex items-center gap-2 mt-2">
                            <span class="text-[10px] font-bold text-gray-400 uppercase tracking-widest">Kategori :</span>
                            <span class="text-[10px] font-black text-[#1a237e] uppercase transition-all">{{ $armada->tahun > 2022 ? 'Muda' : 'Standar' }}</span>
                        </div>
                    </div>
                    
                    <div class="grid grid-cols-2 gap-3 mb-8">
                        <div class="bg-gray-50/50 p-3.5 rounded-2xl border border-gray-100 group-hover:bg-[#1a237e]/5 transition group-hover:border-[#1a237e]/10">
                            <div class="flex items-center gap-3">
                                <div class="w-8 h-8 rounded-lg bg-green-100 flex items-center justify-center text-green-600">
                                    <i class="bi bi-people-fill text-sm"></i>
                                </div>
                                <span class="text-[11px] font-bold text-gray-700 uppercase tracking-tighter">{{ $armada->kapasitas }} Kursi</span>
                            </div>
                        </div>
                        <div class="bg-gray-50/50 p-3.5 rounded-2xl border border-gray-100 group-hover:bg-[#1a237e]/5 transition group-hover:border-[#1a237e]/10">
                            <div class="flex items-center gap-3">
                                <div class="w-8 h-8 rounded-lg bg-blue-100 flex items-center justify-center text-[#1a237e]">
                                    <i class="bi bi-shield-check text-sm"></i>
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

    </main>

    @include('partials.pelanggan.footer')
</body>
</html>
