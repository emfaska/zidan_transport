<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Pelanggan - Zidan Transport</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <style>
        body { font-family: 'Montserrat', sans-serif; }
        .dropdown:hover .dropdown-menu { display: block; }
        .search-result-enter {
            animation: slideDown 0.5s ease-out forwards;
        }
        @keyframes slideDown {
            from { opacity: 0; transform: translateY(-20px); }
            to { opacity: 1; transform: translateY(0); }
        }
        @keyframes fadeInUp {
            from { opacity: 0; transform: translateY(30px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .animate-fade-in-up {
            animation: fadeInUp 0.8s ease-out forwards;
        }
        .delay-100 { animation-delay: 0.1s; }
        .delay-200 { animation-delay: 0.2s; }
        .delay-300 { animation-delay: 0.3s; }
    </style>
</head>
<body class="bg-gray-50">

    <!-- Professional Navbar -->
    <nav class="bg-white/95 backdrop-blur-md fixed w-full z-50 shadow-sm border-b border-gray-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-20 items-center">
                
                <!-- Logo -->
                <div class="flex-shrink-0 flex items-center">
                    <a href="{{ route('home') }}" class="flex items-center gap-3">
                        <img class="h-12 w-auto" src="{{ asset('images/logo.png') }}" alt="Zidan Transport">
                        <div class="flex flex-col">
                            <span class="text-lg font-black text-[#1a237e] leading-none uppercase tracking-tighter">Zidan</span>
                            <span class="text-[10px] font-bold text-[#fbc02d] uppercase tracking-[0.2em] leading-none mt-1">Transport</span>
                        </div>
                    </a>
                </div>

                <!-- Desktop Navigation -->
                <div class="hidden md:flex space-x-8 items-center">
                    <a href="{{ route('home') }}" class="text-[#1a237e] hover:text-[#fbc02d] font-bold transition border-b-2 border-[#1a237e] pb-1">
                        Beranda
                    </a>
                    <a href="{{ route('pelanggan.armada') }}" class="text-gray-700 hover:text-[#1a237e] font-semibold transition">
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
                    <div class="relative dropdown group">
                        <button class="flex items-center gap-3 px-4 py-2 rounded-full hover:bg-gray-50 transition">
                            <div class="text-right">
                                <p class="text-xs font-semibold text-gray-500 uppercase tracking-wide">Welcome</p>
                                <p class="text-sm font-black text-[#1a237e]">{{ Auth::user()->name }}</p>
                            </div>
                            <div class="w-10 h-10 rounded-full bg-gradient-to-br from-[#1a237e] to-blue-600 overflow-hidden shadow-lg">
                                <img src="{{ Auth::user()->foto_profil ? asset('storage/' . Auth::user()->foto_profil) : 'https://ui-avatars.com/api/?name='.urlencode(Auth::user()->name).'&background=1a237e&color=fff&bold=true' }}" 
                                     class="w-full h-full object-cover">
                            </div>
                            <i class="bi bi-chevron-down text-gray-400 text-xs"></i>
                        </button>
                        
                        <!-- Dropdown Menu -->
                        <div class="dropdown-menu hidden absolute right-0 mt-2 w-56 bg-white rounded-2xl shadow-xl border border-gray-100 py-2">
                            <div class="px-4 py-3 border-b border-gray-100">
                                <p class="text-xs text-gray-500 font-semibold">Signed in as</p>
                                <p class="text-sm font-bold text-[#1a237e] truncate">{{ Auth::user()->email }}</p>
                            </div>
                            <a href="{{ route('profile.edit') }}" class="flex items-center gap-3 px-4 py-3 hover:bg-gray-50 transition">
                                <i class="bi bi-person text-[#1a237e]"></i>
                                <span class="text-sm font-semibold text-gray-700">Profil Saya</span>
                            </a>
                            <a href="{{ route('pelanggan.booking.index') }}" class="flex items-center gap-3 px-4 py-3 hover:bg-gray-50 transition">
                                <i class="bi bi-clock-history text-[#1a237e]"></i>
                                <span class="text-sm font-semibold text-gray-700">Riwayat Pesanan</span>
                            </a>
                            <a href="#" class="flex items-center gap-3 px-4 py-3 hover:bg-gray-50 transition">
                                <i class="bi bi-gear text-[#1a237e]"></i>
                                <span class="text-sm font-semibold text-gray-700">Pengaturan</span>
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
                <a href="{{ route('home') }}" class="block px-4 py-3 rounded-xl bg-[#1a237e] text-white font-bold">
                    <i class="bi bi-house-door mr-2"></i> Beranda
                </a>
                <a href="{{ route('pelanggan.armada') }}" class="block px-4 py-3 rounded-xl text-gray-700 hover:bg-gray-50 font-semibold">
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
                    <div class="flex items-center gap-3 px-4 py-3 bg-gray-50 rounded-xl mb-2">
                        <div class="w-10 h-10 rounded-full bg-gradient-to-br from-[#1a237e] to-blue-600 overflow-hidden shadow-lg border-2 border-white">
                            <img src="{{ Auth::user()->foto_profil ? asset('storage/' . Auth::user()->foto_profil) : 'https://ui-avatars.com/api/?name='.urlencode(Auth::user()->name).'&background=1a237e&color=fff&bold=true' }}" 
                                 class="w-full h-full object-cover">
                        </div>
                        <div>
                            <p class="text-sm font-black text-[#1a237e]">{{ Auth::user()->name }}</p>
                            <p class="text-xs text-gray-500">{{ Auth::user()->email }}</p>
                        </div>
                    </div>
                    <a href="{{ route('profile.edit') }}" class="block px-4 py-3 rounded-xl text-gray-700 hover:bg-gray-50 font-semibold">
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
                        <img src="{{ asset('images/innova.png') }}" class="w-full h-auto drop-shadow-[0_35px_35px_rgba(0,0,0,0.5)] transform -rotate-3 hover:rotate-0 transition duration-700" alt="Innova Premium">
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
        <div class="mb-12">
            <div class="bg-gradient-to-r from-[#1a237e] to-blue-800 rounded-[40px] overflow-hidden shadow-2xl relative group">
                <!-- Background Accents -->
                <div class="absolute top-0 right-0 w-64 h-64 bg-white/5 rounded-full -mr-32 -mt-32 blur-3xl group-hover:bg-white/10 transition-all duration-700"></div>
                <div class="absolute bottom-0 left-0 w-48 h-48 bg-[#fbc02d] rounded-full -ml-20 -mb-20 opacity-10 blur-2xl"></div>

                <div class="relative z-10 flex flex-col lg:flex-row items-center">
                    <!-- Image Area -->
                    <div class="w-full lg:w-1/3 h-48 lg:h-64 overflow-hidden">
                        @if($promo->gambar)
                            <img src="{{ asset('storage/' . $promo->gambar) }}" class="w-full h-full object-cover transform group-hover:scale-110 transition duration-700" alt="Special Promo">
                        @else
                            <div class="w-full h-full bg-blue-900/50 flex items-center justify-center text-white/20 italic p-8 text-center text-2xl font-black uppercase tracking-tighter">
                                PROMO <br> KHUSUS
                            </div>
                        @endif
                    </div>

                    <!-- Content Area -->
                    <div class="w-full lg:w-2/3 p-8 lg:p-10 text-white text-center lg:text-left flex flex-col lg:flex-row justify-between items-center gap-6">
                        <div class="flex-grow">
                            <div class="inline-flex items-center gap-3 px-4 py-1.5 bg-[#fbc02d] text-[#1a237e] rounded-full text-[9px] font-black uppercase tracking-[0.2em] mb-4 shadow-lg shadow-yellow-500/20">
                                <i class="bi bi-megaphone-fill"></i>
                                Promo Terbatas
                            </div>
                            <h2 class="text-2xl md:text-3xl font-[900] leading-tight tracking-tighter uppercase mb-2">
                                {{ $promo->judul }}
                            </h2>
                            <p class="text-blue-200 text-xs md:text-sm font-medium leading-relaxed opacity-90 max-w-xl">
                                {{ $promo->deskripsi }}
                            </p>
                        </div>

                        <div class="flex items-center gap-6 flex-shrink-0">
                            <div class="flex flex-col items-center lg:items-end">
                                <span class="text-4xl md:text-5xl font-black text-[#fbc02d] tracking-tighter leading-none">
                                    {{ $promo->potongan_persen }}%
                                </span>
                                <span class="text-[8px] font-black text-blue-300 uppercase tracking-[0.3em] mt-1 italic">Diskon</span>
                            </div>
                            <a href="{{ route('pelanggan.booking.create') }}" class="px-8 py-4 bg-white text-[#1a237e] rounded-2xl font-black text-[10px] uppercase tracking-widest hover:bg-[#fbc02d] transition shadow-xl transform hover:-translate-y-1">
                                Ambil Promo <i class="bi bi-arrow-right ml-1"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endif

        <!-- Fleet Showcase Section -->
        <section id="armada" class="mb-12">
            <div class="text-center mb-8">
                <h2 class="text-3xl md:text-4xl font-black text-[#1a237e] mb-3">Armada Kami</h2>
                <p class="text-gray-600 text-lg max-w-2xl mx-auto">Pilih kendaraan sesuai kebutuhan perjalanan Anda dengan armada modern dan terawat</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
                @forelse($armadas as $armada)
                <!-- Fleet Card: {{ $armada->nama }} -->
                <div class="bg-white rounded-[40px] overflow-hidden shadow-sm hover:shadow-2xl transition transform hover:-translate-y-2 border border-gray-100 flex flex-col h-full group">
                    <div class="bg-gray-50 flex items-center justify-center h-52 relative overflow-hidden">
                        @if($armada->foto)
                            <img src="{{ asset('storage/' . $armada->foto) }}" alt="{{ $armada->nama }}" class="w-full h-full object-cover group-hover:scale-110 transition duration-500">
                        @else
                            <div class="w-full h-full flex flex-col items-center justify-center text-gray-200">
                                <i class="bi bi-car-front-fill text-6xl"></i>
                                <span class="text-[10px] uppercase font-black tracking-widest mt-2">No Photo</span>
                            </div>
                        @endif
                        <div class="absolute top-4 right-4 bg-white/90 backdrop-blur-md px-4 py-1.5 rounded-full shadow-sm">
                             <span class="text-[10px] font-black text-[#1a237e] uppercase tracking-widest">{{ $armada->tahun }}</span>
                        </div>
                    </div>
                    <div class="p-8 flex flex-col flex-grow">
                        <div class="flex justify-between items-start mb-4">
                            <div>
                                <h3 class="text-xl font-black text-[#1a237e] uppercase leading-none">{{ $armada->nama }}</h3>
                                <p class="text-gray-400 text-[10px] font-bold uppercase tracking-widest mt-2 px-2 py-0.5 bg-gray-50 rounded-full inline-block">{{ $armada->plat_nomor }}</p>
                            </div>
                            <div class="text-right">
                                <span class="text-[#fbc02d] text-sm font-black italic uppercase tracking-tighter">{{ $armada->status }}</span>
                            </div>
                        </div>
                        
                        <div class="grid grid-cols-2 gap-4 mb-8">
                            <div class="flex items-center gap-2 text-gray-500">
                                <i class="bi bi-people-fill text-[#16a34a]"></i>
                                <span class="text-xs font-bold">{{ $armada->kapasitas }} Orang</span>
                            </div>
                            <div class="flex items-center gap-2 text-gray-500">
                                <i class="bi bi-calendar-check text-[#dc2626]"></i>
                                <span class="text-xs font-bold">{{ $armada->tahun }}</span>
                            </div>
                        </div>
                        
                        <a href="{{ route('pelanggan.booking.create', ['armada_id' => $armada->id]) }}" class="inline-flex items-center justify-center w-full bg-[#1a237e] hover:bg-[#0d1440] text-white font-black py-4 rounded-2xl transition shadow-lg uppercase tracking-[0.2em] text-[10px] gap-3 transform active:scale-95">
                            Pilih Armada <i class="bi bi-arrow-right"></i>
                        </a>
                    </div>
                </div>
            @empty
                <div class="col-span-full text-center py-10 bg-gray-50 rounded-2xl border-2 border-dashed border-gray-200">
                    <i class="bi bi-exclamation-circle text-4xl text-gray-400 mb-2"></i>
                    <p class="text-gray-500 font-semibold">Belum ada armada yang tersedia saat ini.</p>
                </div>
            @endforelse
            </div>

            <div class="text-center">
                <a href="{{ route('pelanggan.armada') }}" class="inline-flex items-center gap-2 text-[#1a237e] font-bold hover:text-[#fbc02d] transition">
                    Lihat Semua Armada
                    <i class="bi bi-arrow-right"></i>
                </a>
            </div>
        </section>

        <!-- Dynamic Services Section -->
        <section id="layanan" class="mb-12">
            <div class="text-center mb-10">
                <h2 class="text-3xl md:text-4xl font-black text-[#1a237e] mb-3">Layanan Unggulan</h2>
                <p class="text-gray-600 text-lg max-w-2xl mx-auto">Solusi transportasi terbaik untuk kebutuhan perjalanan Anda</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-6">
                @foreach($layanans as $layanan)
                <div class="p-8 bg-white rounded-[40px] border border-gray-100 hover:shadow-2xl transition group flex flex-col h-full shadow-sm">
                    <div class="w-16 h-16 bg-[#1a237e] rounded-2xl flex items-center justify-center text-white text-3xl mb-6 shadow-lg rotate-3 group-hover:rotate-0 transition">
                        <i class="bi {{ $layanan->icon ?? 'bi-star-fill' }}"></i>
                    </div>
                    <h3 class="text-xl font-black text-[#1a237e] mb-3 uppercase tracking-tight">{{ $layanan->nama_layanan }}</h3>
                    <p class="text-gray-500 font-medium leading-relaxed mb-8 flex-grow text-sm">{{ $layanan->deskripsi }}</p>
                    <a href="{{ route('pelanggan.booking.create') }}" class="inline-flex items-center text-[#1a237e] font-black uppercase tracking-widest text-[10px] hover:gap-3 transition-all gap-2">
                        Pesan Layanan Ini
                        <i class="bi bi-arrow-right"></i>
                    </a>
                </div>
                @endforeach
            </div>

            <div class="text-center">
                <a href="{{ route('pelanggan.layanan') }}" class="inline-flex items-center gap-2 text-[#1a237e] font-bold hover:text-[#fbc02d] transition">
                    Lihat Semua Layanan
                    <i class="bi bi-arrow-right"></i>
                </a>
            </div>
        </section>

        <!-- Why Choose Us Section -->
        <section id="layanan" class="mb-12 bg-gradient-to-br from-gray-50 to-gray-100 rounded-3xl p-8 md:p-12">
            <div class="text-center mb-10">
                <h2 class="text-3xl md:text-4xl font-black text-[#1a237e] mb-3">Kenapa Pilih Kami?</h2>
                <p class="text-gray-600 text-lg max-w-2xl mx-auto">Komitmen kami memberikan layanan transportasi terbaik untuk Anda</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <!-- Benefit 1 -->
                <div class="text-center">
                    <div class="w-20 h-20 bg-[#1a237e] rounded-2xl flex items-center justify-center mx-auto mb-4 shadow-lg transform transition hover:scale-110">
                        <i class="bi bi-shield-check text-[#fbc02d] text-4xl"></i>
                    </div>
                    <h3 class="text-xl font-black text-[#1a237e] mb-3">Armada Terawat</h3>
                    <p class="text-gray-600">Semua kendaraan rutin diservis dan dalam kondisi prima untuk kenyamanan perjalanan Anda</p>
                </div>

                <!-- Benefit 2 -->
                <div class="text-center">
                    <div class="w-20 h-20 bg-[#fbc02d] rounded-2xl flex items-center justify-center mx-auto mb-4 shadow-lg transform transition hover:scale-110">
                        <i class="bi bi-person-badge text-[#1a237e] text-4xl"></i>
                    </div>
                    <h3 class="text-xl font-black text-[#1a237e] mb-3">Driver Profesional</h3>
                    <p class="text-gray-600">Pengemudi berpengalaman, ramah, dan terlatih dengan pengetahuan rute terbaik</p>
                </div>

                <!-- Benefit 3 -->
                <div class="text-center">
                    <div class="w-20 h-20 bg-[#1a237e] rounded-2xl flex items-center justify-center mx-auto mb-4 shadow-lg transform transition hover:scale-110">
                        <i class="bi bi-currency-dollar text-[#fbc02d] text-4xl"></i>
                    </div>
                    <h3 class="text-xl font-black text-[#1a237e] mb-3">Harga Transparan</h3>
                    <p class="text-gray-600">Tidak ada biaya tersembunyi, harga yang Anda lihat adalah harga yang Anda bayar</p>
                </div>
            </div>
        </section>

        <!-- Location Preview & Recent Bookings -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-12">
            <div class="md:col-span-2 bg-white rounded-[40px] p-10 shadow-sm border border-gray-100 group">
                <h3 class="text-2xl font-black text-[#1a237e] mb-8 flex items-center gap-4">
                    <div class="w-14 h-14 bg-[#1a237e] rounded-2xl flex items-center justify-center shadow-lg rotate-3 group-hover:rotate-0 transition">
                        <i class="bi bi-pin-map-fill text-[#fbc02d] text-2xl"></i>
                    </div>
                    Cek Estimasi Perjalanan
                </h3>
                <form id="estimation-form" class="space-y-6">
                    @csrf
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-[10px] font-black text-gray-400 uppercase tracking-[0.2em] mb-3">📍 Lokasi Penjemputan</label>
                            <input type="text" name="lokasi_awal" id="lokasi_awal" class="w-full bg-gray-50 border border-gray-100 rounded-[20px] py-5 px-6 focus:ring-2 focus:ring-[#fbc02d] focus:border-[#fbc02d] outline-none transition font-semibold text-gray-700 shadow-inner" placeholder="Contoh: Stasiun Kediri" required>
                        </div>
                        <div>
                            <label class="block text-[10px] font-black text-gray-400 uppercase tracking-[0.2em] mb-3">🎯 Tujuan</label>
                            <input type="text" name="tujuan" id="tujuan" class="w-full bg-gray-50 border border-gray-100 rounded-[20px] py-5 px-6 focus:ring-2 focus:ring-[#fbc02d] focus:border-[#fbc02d] outline-none transition font-semibold text-gray-700 shadow-inner" placeholder="Contoh: Bandara Juanda Surabaya" required>
                        </div>
                    </div>
                    <div class="pt-4">
                        <button type="submit" id="btn-cek-tarif" class="group w-full bg-[#1a237e] hover:bg-[#0d1440] text-white py-5 rounded-[20px] font-black text-xs shadow-xl transition-all transform hover:-translate-y-1 flex items-center justify-center gap-4 uppercase tracking-[0.2em]">
                            <i class="bi bi-search group-hover:scale-125 transition"></i>
                            <span id="btn-text">Cek Tarif & Armada</span>
                        </button>
                    </div>
                </form>

                <!-- Search Results Area -->
                <div id="search-results" class="mt-8 hidden">
                    <!-- Results will be injected here -->
                </div>
            </div>

            <div class="bg-white rounded-[40px] p-8 shadow-sm border border-gray-100 flex flex-col">
                <h3 class="text-xl font-black text-[#1a237e] mb-8 flex items-center gap-3">
                    <i class="bi bi-clock-history text-[#fbc02d]"></i>
                    Pesanan Terkhir
                </h3>
                <div class="space-y-4 flex-grow">
                    <div class="flex items-start gap-4 p-6 rounded-[30px] bg-gray-50 border border-gray-100 border-dashed">
                        <div class="bg-white px-4 py-3 rounded-2xl text-[#fbc02d] shadow-sm">
                            <i class="bi bi-inbox text-2xl"></i>
                        </div>
                        <div>
                            <p class="text-[10px] font-black text-[#1a237e] mb-1 uppercase tracking-widest">Kosong</p>
                            <p class="text-[11px] text-gray-400 font-bold leading-relaxed">Belum ada aktivitas perjalanan.</p>
                        </div>
                    </div>
                </div>
                <a href="{{ route('pelanggan.booking.create') }}" class="mt-8 group w-full bg-gray-50 hover:bg-[#1a237e] hover:text-white px-4 py-4 rounded-2xl text-center transition-all duration-300">
                    <span class="text-[10px] font-black uppercase tracking-widest">Buat Pesanan Pertama</span>
                </a>
            </div>
        </div>

        <!-- Contact Section -->
        <section id="kontak" class="bg-[#1a237e] rounded-[50px] p-10 md:p-16 text-white relative overflow-hidden shadow-2xl">
            <div class="absolute top-0 right-0 w-64 h-64 bg-[#fbc02d] rounded-full opacity-5 -mr-20 -mt-20"></div>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-12 items-center relative z-10">
                <div>
                    <h2 class="text-3xl md:text-5xl font-[900] mb-6 uppercase tracking-tighter">Bantuan <br><span class="text-[#fbc02d]">24/7 Center</span></h2>
                    <p class="text-blue-200 text-base md:text-lg mb-10 font-medium">Tim kami selalu siap mendampingi perjalanan Anda kapanpun dan dimanapun.</p>
                    <div class="space-y-6">
                        <div class="flex items-center gap-5 group">
                            <div class="w-14 h-14 bg-white/10 backdrop-blur-md rounded-2xl flex items-center justify-center flex-shrink-0 group-hover:bg-[#fbc02d] transition-all duration-300 shadow-lg">
                                <i class="bi bi-whatsapp text-[#fbc02d] group-hover:text-[#1a237e] text-2xl"></i>
                            </div>
                            <div>
                                <p class="text-[10px] font-black text-blue-300 uppercase tracking-widest leading-none mb-1">WhatsApp Fast Response</p>
                                <p class="font-black text-xl">{{ \App\Models\Setting::get('contact_whatsapp_display', '+62 821 4295 1682') }}</p>
                            </div>
                        </div>
                        <div class="flex items-center gap-5 group">
                            <div class="w-14 h-14 bg-white/10 backdrop-blur-md rounded-2xl flex items-center justify-center flex-shrink-0 group-hover:bg-[#fbc02d] transition-all duration-300 shadow-lg">
                                <i class="bi bi-envelope-fill text-[#fbc02d] group-hover:text-[#1a237e] text-2xl"></i>
                            </div>
                            <div>
                                <p class="text-[10px] font-black text-blue-300 uppercase tracking-widest leading-none mb-1">Email Resmi</p>
                                <p class="font-black text-xl">zidantransport@gmail.com</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="flex justify-center md:justify-end">
                    <div class="relative p-3 bg-white/10 backdrop-blur-md rounded-[45px] border border-white/20 shadow-2xl group">
                        <div class="w-64 h-80 rounded-[35px] overflow-hidden relative shadow-inner border shadow-blue-900/40">
                            <img src="{{ asset('images/cs.png') }}" alt="CS Zidan Transport" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110">
                            <div class="absolute inset-0 bg-gradient-to-t from-[#1a237e] via-transparent to-transparent opacity-90"></div>
                            <div class="absolute bottom-6 left-0 right-0 text-center px-4">
                                <div class="flex items-center justify-center gap-2 mb-2">
                                    <span class="w-2.5 h-2.5 bg-green-500 rounded-full animate-pulse shadow-[0_0_15px_rgba(34,197,94,1)]"></span>
                                    <p class="text-[10px] font-black uppercase tracking-[0.3em] text-white">Online</p>
                                </div>
                                <h3 class="text-2xl font-[900] text-white tracking-widest leading-none uppercase">Support</h3>
                                <p class="text-[9px] font-bold text-[#fbc02d] uppercase tracking-[0.2em] mt-2 italic flex justify-center items-center gap-2">
                                   <span class="h-px w-4 bg-[#fbc02d]/30"></span> 24 JAM STANDBY <span class="h-px w-4 bg-[#fbc02d]/30"></span>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

    </main>

    <script>
        document.getElementById('estimation-form').addEventListener('submit', async function(e) {
            e.preventDefault();
            
            const btn = document.getElementById('btn-cek-tarif');
            const btnText = document.getElementById('btn-text');
            const resultsDiv = document.getElementById('search-results');
            const formData = new FormData(this);
            
            // Loading State
            btn.disabled = true;
            btnText.innerText = 'Mencari...';
            resultsDiv.classList.add('hidden');
            
            try {
                const response = await fetch('{{ route("pelanggan.rute.search") }}', {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Accept': 'application/json'
                    },
                    body: formData
                });
                
                if (!response.ok) {
                    const text = await response.text();
                    throw new Error(`HTTP error! status: ${response.status}, body: ${text.substring(0, 100)}`);
                }

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
    </script>
</body>
</html>