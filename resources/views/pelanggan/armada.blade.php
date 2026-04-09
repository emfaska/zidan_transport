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

    <!-- Professional Navbar (Same as dashboard) -->
    <nav class="bg-white/95 backdrop-blur-md fixed w-full z-50 shadow-sm border-b border-gray-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-20 items-center">
                
                <!-- Logo -->
                <div class="flex-shrink-0 flex items-center">
                    <a href="{{ Auth::check() ? route('home') : route('landing') }}" class="flex items-center gap-3">
                        <img class="h-12 w-auto" src="{{ asset('images/logo.png') }}" alt="Zidan Transport">
                        <div class="flex flex-col">
                            <span class="text-lg font-black text-[#1a237e] leading-none uppercase tracking-tighter">Zidan</span>
                            <span class="text-[10px] font-bold text-[#fbc02d] uppercase tracking-[0.2em] leading-none mt-1">Transport</span>
                        </div>
                    </a>
                </div>

                <!-- Desktop Navigation -->
                <div class="hidden md:flex space-x-8 items-center">
                    <a href="{{ Auth::check() ? route('home') : route('landing') }}" class="text-gray-700 hover:text-[#1a237e] font-semibold transition">
                        Beranda
                    </a>
                    <a href="{{ route('pelanggan.armada') }}" class="text-[#1a237e] hover:text-[#fbc02d] font-bold transition border-b-2 border-[#1a237e] pb-1">
                        Armada
                    </a>
                    <a href="{{ route('pelanggan.layanan') }}" class="text-gray-700 hover:text-[#1a237e] font-semibold transition">
                        Layanan
                    </a>
                    <a href="{{ route('pelanggan.rute') }}" class="text-gray-700 hover:text-[#1a237e] font-semibold transition">
                        Rute
                    </a>
                    <a href="{{ route('pelanggan.kontak') }}" class="text-gray-700 hover:text-[#1a237e] font-semibold transition">
                        Lokasi & Kontak
                    </a>
                </div>

                <!-- User Profile Dropdown (Desktop) -->
                <div class="hidden md:flex items-center gap-4">
                    @auth
                    <div class="relative dropdown group">
                        <button class="flex items-center gap-3 px-4 py-2 rounded-full hover:bg-gray-50 transition">
                            <div class="text-right">
                                <p class="text-xs font-semibold text-gray-500 uppercase tracking-wide">Welcome</p>
                                <p class="text-sm font-black text-[#1a237e]">{{ Auth::user()->name }}</p>
                            </div>
                            <div class="w-10 h-10 rounded-full bg-gradient-to-br from-[#1a237e] to-blue-600 flex items-center justify-center text-white font-black shadow-lg">
                                {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                            </div>
                            <i class="bi bi-chevron-down text-gray-400 text-xs"></i>
                        </button>
                        
                        <!-- Dropdown Menu -->
                        <div class="dropdown-menu hidden absolute right-0 mt-2 w-56 bg-white rounded-2xl shadow-xl border border-gray-100 py-2">
                            <div class="px-4 py-3 border-b border-gray-100">
                                <p class="text-xs text-gray-500 font-semibold">Signed in as</p>
                                <p class="text-sm font-bold text-[#1a237e] truncate">{{ Auth::user()->email }}</p>
                            </div>
                            <a href="#" class="flex items-center gap-3 px-4 py-3 hover:bg-gray-50 transition">
                                <i class="bi bi-person text-[#1a237e]"></i>
                                <span class="text-sm font-semibold text-gray-700">Profil Saya</span>
                            </a>
                            <a href="{{ route('pelanggan.booking.index') }}" class="flex items-center gap-3 px-4 py-3 hover:bg-gray-50 transition">
                                <i class="bi bi-clock-history text-[#1a237e]"></i>
                                <span class="text-sm font-semibold text-gray-700">Riwayat Pesanan</span>
                            </a>
                            <div class="border-t border-gray-100 mt-2 pt-2">
                                <form action="{{ route('logout') }}" method="POST">
                                    @csrf
                                    <button type="submit" class="w-full flex items-center gap-3 px-4 py-3 hover:bg-red-50 transition text-left">
                                        <i class="bi bi-box-arrow-right text-red-500"></i>
                                        <span class="text-sm font-bold text-red-500">Logout</span>
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                    @else
                    <div class="flex items-center gap-3">
                        <a href="{{ route('login') }}" class="px-6 py-2.5 rounded-full bg-[#fbc02d] text-[#1a237e] font-black shadow-lg hover:bg-yellow-500 transition">
                            Masuk
                        </a>
                        <a href="{{ route('register') }}" class="px-6 py-2.5 rounded-full bg-[#1a237e] text-white font-black shadow-lg hover:bg-[#0d1440] transition">
                            Daftar
                        </a>
                    </div>
                    @endauth
                </div>

                <!-- Mobile Menu Button -->
                <div class="md:hidden flex items-center gap-3">
                    <button id="mobile-menu-btn" class="text-[#1a237e] hover:text-[#fbc02d] transition">
                        <i class="bi bi-list text-3xl"></i>
                    </button>
                </div>
            </div>
        </div>

        <!-- Mobile Menu -->
        <div id="mobile-menu" class="hidden md:hidden bg-white border-t border-gray-100">
            <div class="px-4 py-4 space-y-3">
                <a href="{{ Auth::check() ? route('home') : route('landing') }}" class="block px-4 py-3 rounded-xl text-gray-700 hover:bg-gray-50 font-semibold">
                    <i class="bi bi-house-door mr-2"></i> Beranda
                </a>
                <a href="{{ route('pelanggan.armada') }}" class="block px-4 py-3 rounded-xl bg-[#1a237e] text-white font-bold">
                    <i class="bi bi-car-front mr-2"></i> Armada
                </a>
                <a href="{{ route('pelanggan.layanan') }}" class="block px-4 py-3 rounded-xl text-gray-700 hover:bg-gray-50 font-semibold">
                    <i class="bi bi-layers mr-2"></i> Layanan
                </a>
                <a href="{{ route('pelanggan.rute') }}" class="block px-4 py-3 rounded-xl text-gray-700 hover:bg-gray-50 font-semibold">
                    <i class="bi bi-map mr-2"></i> Rute Perjalanan
                </a>
                <a href="{{ route('pelanggan.kontak') }}" class="block px-4 py-3 rounded-xl text-gray-700 hover:bg-gray-50 font-semibold">
                    <i class="bi bi-geo-alt mr-2"></i> Lokasi & Kontak
                </a>
                
                <!-- Mobile User Section -->
                <div class="border-t border-gray-100 pt-3 mt-3">
                    @auth
                    <div class="flex items-center gap-3 px-4 py-3 bg-gray-50 rounded-xl mb-2">
                        <div class="w-10 h-10 rounded-full bg-gradient-to-br from-[#1a237e] to-blue-600 flex items-center justify-center text-white font-black">
                            {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                        </div>
                        <div>
                            <p class="text-sm font-black text-[#1a237e]">{{ Auth::user()->name }}</p>
                            <p class="text-xs text-gray-500">{{ Auth::user()->email }}</p>
                        </div>
                    </div>
                    <a href="#" class="block px-4 py-3 rounded-xl text-gray-700 hover:bg-gray-50 font-semibold">
                        <i class="bi bi-person mr-2"></i> Profil Saya
                    </a>
                    <a href="{{ route('pelanggan.booking.index') }}" class="block px-4 py-3 rounded-xl text-gray-700 hover:bg-gray-50 font-semibold">
                        <i class="bi bi-clock-history mr-2"></i> Riwayat Pesanan
                    </a>
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="w-full text-left px-4 py-3 rounded-xl text-red-500 hover:bg-red-50 font-bold">
                            <i class="bi bi-box-arrow-right mr-2"></i> Logout
                        </button>
                    </form>
                    @else
                    <div class="grid grid-cols-2 gap-3 p-2">
                        <a href="{{ route('login') }}" class="flex items-center justify-center px-4 py-3 rounded-xl bg-[#fbc02d] text-[#1a237e] font-black shadow-md">
                            Masuk
                        </a>
                        <a href="{{ route('register') }}" class="flex items-center justify-center px-4 py-3 rounded-xl bg-gray-50 text-[#1a237e] font-black border border-gray-100">
                            Daftar
                        </a>
                    </div>
                    @endauth
                </div>
            </div>
        </div>
    </nav>

    <!-- Mobile Menu Toggle Script -->
    <script>
        const mobileMenuBtn = document.getElementById('mobile-menu-btn');
        const mobileMenu = document.getElementById('mobile-menu');
        
        mobileMenuBtn.addEventListener('click', () => {
            mobileMenu.classList.toggle('hidden');
        });
    </script>

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

</body>
</html>
