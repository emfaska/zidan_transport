<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('images/favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('images/favicon-16x16.png') }}">
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('images/apple-touch-icon.png') }}">
    <title>Zidan Transport - Solusi Perjalanan Terpercaya di Kediri</title>
    <meta name="description" content="Zidan Transport - Layanan Sewa Mobil dan Travel Terpercaya di Kediri dengan Armada Modern dan Driver Profesional.">
    <meta name="keywords" content="travel kediri, sewa mobil kediri, zidan transport, rental mobil kediri, travel surabaya kediri, travel malang kediri">
    <meta name="author" content="Zidan Transport">
    <meta name="robots" content="index, follow">
    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ url('/') }}">
    <meta property="og:title" content="Zidan Transport - Layanan Sewa Mobil & Travel Terpercaya di Kediri">
    <meta property="og:description" content="Zidan Transport - Layanan Sewa Mobil dan Travel Terpercaya di Kediri dengan Armada Modern dan Driver Profesional.">
    <meta property="og:image" content="{{ asset('images/logo.png') }}">

    <!-- Twitter -->
    <meta property="twitter:card" content="summary_large_image">
    <meta property="twitter:url" content="{{ url('/') }}">
    <meta property="twitter:title" content="Zidan Transport - Layanan Sewa Mobil & Travel Terpercaya di Kediri">
    <meta property="twitter:description" content="Zidan Transport - Layanan Sewa Mobil dan Travel Terpercaya di Kediri dengan Armada Modern dan Driver Profesional.">
    <meta property="twitter:image" content="{{ asset('images/logo.png') }}">

    <!-- Canonical Link -->
    <link rel="canonical" href="{{ url('/') }}">


    <!-- Structured Data (JSON-LD) -->
    <script type="application/ld+json">
    {
      "@@context": "https://schema.org",
      "@@type": "TravelAgency",
      "@@id": "{{ url('/') }}",
      "name": "Zidan Transport",
      "url": "{{ url('/') }}",
      "telephone": "{{ \App\Models\Setting::get('contact_whatsapp', '6282142951682') }}",
      "image": "{{ asset('images/logo.png') }}",
      "address": {
        "@@type": "PostalAddress",
        "streetAddress": "{{ \App\Models\Setting::get('contact_address', 'Ngadiluwih, Kediri, Jawa Timur') }}",
        "addressLocality": "Kediri",
        "addressRegion": "Jawa Timur",
        "postalCode": "64171",
        "addressCountry": "ID"
      },
      "geo": {
        "@@type": "GeoCoordinates",
        "latitude": -7.8480,
        "longitude": 112.0178
      },
      "openingHoursSpecification": {
        "@@type": "OpeningHoursSpecification",
        "dayOfWeek": ["Monday","Tuesday","Wednesday","Thursday","Friday","Saturday","Sunday"],
        "opens": "00:00",
        "closes": "23:59"
      },
      "sameAs": [
        "https://www.facebook.com/zidantransport",
        "https://www.instagram.com/zidantransport"
      ]
    }
    </script>


    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <!-- Swiper CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    <!-- Swiper JS -->
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <style>
        html { scroll-behavior: smooth; }
        body { font-family: 'Montserrat', sans-serif; }
        @verbatim
        @keyframes fadeInUp {
            from { opacity: 0; transform: translateY(30px); }
            to { opacity: 1; transform: translateY(0); }
        }
        @endverbatim
        .animate-fade-in-up {
            animation: fadeInUp 0.8s ease-out forwards;
        }
        .delay-100 { animation-delay: 0.1s; }
        .delay-200 { animation-delay: 0.2s; }
        .delay-300 { animation-delay: 0.3s; }
    </style>
</head>
<body class="antialiased bg-gray-50">

    <!-- Navbar -->
    <nav class="bg-white/95 backdrop-blur-md fixed w-full z-50 shadow-sm border-b border-gray-100 transition-all duration-300">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-20 items-center">
                <!-- Logo -->
                <div class="flex-shrink-0 flex items-center gap-3">
                    <a href="{{ route('landing') }}" class="flex items-center gap-3">
                        <img class="h-12 w-auto" src="{{ asset('images/logo.png') }}" alt="Zidan Transport">
                        <div class="flex flex-col">
                            <span class="text-lg font-black text-[#1a237e] leading-none uppercase tracking-tighter">Zidan</span>
                            <span class="text-[10px] font-bold text-[#fbc02d] uppercase tracking-[0.2em] leading-none mt-1">Transport</span>
                        </div>
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden md:flex space-x-8 items-center">
                    <a href="{{ route('landing') }}" class="text-gray-700 hover:text-[#1a237e] font-semibold transition">Beranda</a>
                    <a href="{{ route('pelanggan.armada') }}" class="text-gray-700 hover:text-[#1a237e] font-semibold transition">Armada</a>
                    <a href="{{ route('pelanggan.layanan') }}" class="text-gray-700 hover:text-[#1a237e] font-semibold transition">Layanan</a>
                    <a href="{{ route('pelanggan.rute') }}" class="text-gray-700 hover:text-[#1a237e] font-semibold transition">Paket Rute</a>
                    <a href="{{ route('pelanggan.kontak') }}" class="text-gray-700 hover:text-[#1a237e] font-semibold transition">Lokasi & Kontak</a>
                </div>

                <!-- Auth Buttons & Mobile Toggle -->
                <div class="flex items-center gap-3">
                    <div class="hidden md:flex items-center gap-3">
                        @auth
                            <a href="{{ Auth::user()->role === 'admin' ? route('admin.dashboard') : (Auth::user()->role === 'pengemudi' ? route('driver.dashboard') : route('home')) }}" class="px-6 py-2.5 rounded-full bg-[#1a237e] text-white font-black shadow-lg hover:bg-[#0d1440] transition">
                                Dashboard
                            </a>
                        @else
                            <a href="{{ route('login') }}" class="px-6 py-2.5 rounded-full bg-[#fbc02d] text-[#1a237e] font-black shadow-lg hover:bg-yellow-500 transition">
                                Masuk
                            </a>
                            <a href="{{ route('register') }}" class="px-6 py-2.5 rounded-full bg-[#1a237e] text-white font-black shadow-lg hover:bg-[#0d1440] transition">
                                Daftar
                            </a>
                        @endauth
                    </div>
                    <div class="md:hidden flex items-center gap-3">
                        <button id="mobile-menu-btn" class="text-[#1a237e] hover:text-[#fbc02d] transition">
                            <i class="bi bi-list text-3xl"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <!-- Mobile Menu -->
        <div id="mobile-menu" class="hidden md:hidden bg-white border-t border-gray-100 shadow-lg">
            <div class="px-4 py-6 space-y-4">
                <a href="{{ route('landing') }}" class="block px-4 py-3 rounded-xl bg-[#1a237e] text-white font-bold">
                    <i class="bi bi-house-door mr-2"></i> Beranda
                </a>
                <a href="{{ route('pelanggan.armada') }}" class="block px-4 py-3 rounded-xl text-gray-700 hover:bg-gray-50 font-semibold transition">
                    <i class="bi bi-car-front mr-2"></i> Armada
                </a>
                <a href="{{ route('pelanggan.layanan') }}" class="block px-4 py-3 rounded-xl text-gray-700 hover:bg-gray-50 font-semibold transition">
                    <i class="bi bi-layers mr-2"></i> Layanan
                </a>
                <a href="{{ route('pelanggan.rute') }}" class="block px-4 py-3 rounded-xl text-gray-700 hover:bg-gray-50 font-semibold transition">
                    <i class="bi bi-box2-heart mr-2"></i> Paket Rute
                </a>
                <a href="{{ route('pelanggan.kontak') }}" class="block px-4 py-3 rounded-xl text-gray-700 hover:bg-gray-50 font-semibold transition">
                    <i class="bi bi-geo-alt mr-2"></i> Lokasi & Kontak
                </a>
                
                <div class="pt-4 border-t border-gray-100 flex flex-col gap-3">
                    @auth
                        <a href="{{ Auth::user()->role === 'admin' ? route('admin.dashboard') : (Auth::user()->role === 'pengemudi' ? route('driver.dashboard') : route('home')) }}" class="w-full text-center py-4 rounded-xl bg-[#1a237e] text-white font-black shadow-lg">
                            Dashboard
                        </a>
                    @else
                        <a href="{{ route('login') }}" class="w-full text-center py-4 rounded-xl bg-[#fbc02d] text-[#1a237e] font-black shadow-lg">
                            Masuk
                        </a>
                        <a href="{{ route('register') }}" class="w-full text-center py-4 rounded-xl bg-gray-50 text-[#1a237e] font-black border border-gray-100">
                            Daftar
                        </a>
                    @endauth
                </div>
            </div>
        </div>
    </nav>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const mobileMenuBtn = document.getElementById('mobile-menu-btn');
            const mobileMenu = document.getElementById('mobile-menu');
            if (mobileMenuBtn && mobileMenu) {
                mobileMenuBtn.addEventListener('click', () => {
                    mobileMenu.classList.toggle('hidden');
                });
            }
        });
    </script>

    <!-- Hero Section -->
    <div class="relative bg-white pt-16 overflow-hidden">
        <!-- Background Elements -->
        <div class="absolute top-0 right-0 w-1/2 h-full bg-[#1a237e] hidden lg:block rounded-l-[100px] z-0"></div>
        <div class="absolute -top-24 -left-24 w-96 h-96 bg-blue-50 rounded-full blur-[100px] opacity-70 -z-10"></div>
        
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="flex flex-col lg:flex-row items-center gap-12 lg:gap-8 min-h-[550px]">
                
                <!-- Left Content: Text & CTA -->
                <div class="w-full lg:w-1/2 space-y-6 py-10 lg:py-16">
                    <div class="inline-flex items-center gap-2 px-4 py-2 bg-blue-50 border border-blue-100 rounded-full text-[#1a237e] text-[10px] font-extrabold uppercase tracking-widest animate-fade-in-up">
                        <span class="relative flex h-2 w-2">
                            <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-blue-400 opacity-75"></span>
                            <span class="relative inline-flex rounded-full h-2 w-2 bg-blue-600"></span>
                        </span>
                        Layanan Terpercaya di Kediri
                    </div>
                    
                    <h1 class="text-4xl md:text-6xl lg:text-7xl font-[900] text-[#1a237e] leading-[1.1] animate-fade-in-up delay-100 uppercase tracking-tighter">
                        Solusi <span class="text-[#fbc02d] block">Transportasi</span> Premium.
                    </h1>
                    
                    <!-- Trust Card (Relocated & Redesigned) -->
                    <div class="flex items-center gap-5 p-5 bg-white rounded-[30px] border border-gray-100 shadow-xl shadow-blue-900/5 animate-fade-in-up delay-200 max-w-md">
                        <div class="w-16 h-16 bg-[#fbc02d] rounded-2xl flex items-center justify-center text-[#1a237e] shadow-lg shrink-0">
                            <i class="bi bi-shield-fill-check text-3xl"></i>
                        </div>
                        <div>
                            <h4 class="font-black text-[#1a237e] text-sm uppercase tracking-widest">Keamanan Terjamin</h4>
                            <p class="text-[10px] text-gray-500 font-bold leading-relaxed uppercase tracking-tighter italic mt-1">Layanan asuransi & perbaikan unit rutin setiap bulan.</p>
                        </div>
                    </div>
                    
                    <p class="text-base text-gray-500 font-medium max-w-xl leading-relaxed animate-fade-in-up delay-300">
                        Nikmati perjalanan aman dan nyaman dengan armada modern serta pengemudi profesional. Kami hadir untuk memastikan setiap destinasi Anda tercapai dengan sempurna.
                    </p>
                    
                    <div class="flex flex-col sm:flex-row gap-4 animate-fade-in-up delay-300">
                        <a href="{{ route('register') }}" class="group px-10 py-5 bg-[#1a237e] text-white font-black rounded-3xl shadow-2xl shadow-blue-900/40 hover:bg-[#0d1440] transition-all transform hover:-translate-y-1 flex items-center justify-center gap-3">
                            <span>MULAI PESAN SEKARANG</span>
                            <i class="bi bi-arrow-right-short text-2xl group-hover:translate-x-1 transition-transform"></i>
                        </a>
                        <a href="{{ route('driver.register') }}" class="px-10 py-5 bg-[#fbc02d] text-[#1a237e] font-black rounded-3xl hover:bg-yellow-500 transition-all transform hover:-translate-y-1 flex items-center justify-center shadow-xl">
                            MENJADI MITRA
                        </a>
                    </div>
                </div>
                
                <!-- Right Visual: Swiper Slider -->
                <div class="w-full lg:w-1/2 relative lg:h-[550px] flex items-center justify-center animate-fade-in-up delay-300">
                    <div class="relative w-full max-w-[500px] lg:max-w-none">
                        <!-- Swiper Container -->
                        <div class="swiper heroSwiper rounded-[60px] overflow-hidden shadow-[0_50px_100px_-20px_rgba(0,0,0,0.3)] border-[12px] border-white/10 backdrop-blur-sm aspect-square lg:aspect-video lg:h-[400px]">
                            <div class="swiper-wrapper">
                                <!-- Slide 1 -->
                                <div class="swiper-slide bg-white flex items-center justify-center p-0">
                                    <img src="{{ asset('images/slider1.jpeg') }}" alt="Toyota Innova" class="w-full h-full object-cover">
                                </div>
                                <!-- Slide 2 -->
                                <div class="swiper-slide bg-white flex items-center justify-center p-0">
                                    <img src="{{ asset('images/slider2.jpg') }}" alt="Isuzu Elf Microbus" class="w-full h-full object-cover">
                                </div>
                                <!-- Slide 3  -->
                                <div class="swiper-slide bg-white flex items-center justify-center p-0">
                                    <img src="{{ asset('images/slider3.jpg') }}" alt="Daihatsu Xenia" class="w-full h-full object-cover">
                                </div>
                            </div>
                            <!-- Swiper Pagination -->
                            <div class="swiper-pagination"></div>
                        </div>

                        <!-- Side Accent -->
                        <div class="absolute -top-10 -right-10 w-40 h-40 bg-[#fbc02d] rounded-full opacity-20 blur-3xl"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Initialize Swiper -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const swiper = new Swiper('.heroSwiper', {
                effect: 'fade',
                fadeEffect: {
                    crossFade: true
                },
                autoplay: {
                    delay: 4000,
                    disableOnInteraction: false,
                },
                loop: true,
                pagination: {
                    el: '.swiper-pagination',
                    clickable: true,
                },
            });
        });
    </script>

                        <!-- Side Accent -->
                        <div class="absolute -top-10 -right-10 w-40 h-40 bg-[#fbc02d] rounded-full opacity-20 blur-3xl"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Social Proof / Stats Strip -->
    <div class="bg-[#1a237e] py-10 relative overflow-hidden">
        <div class="absolute inset-0 opacity-5">
            <svg class="h-full w-full" viewBox="0 0 100 100" preserveAspectRatio="none">
                <path d="M0 0 L100 100 M100 0 L0 100" stroke="white" stroke-width="0.5" />
            </svg>
        </div>
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="grid grid-cols-2 md:grid-cols-4 gap-8 md:gap-4 items-center justify-items-center text-center">
                <div class="space-y-1">
                    <p class="text-2xl lg:text-3xl font-black text-[#fbc02d]">5,000+</p>
                    <p class="text-[10px] font-black text-blue-200 uppercase tracking-[0.2em]">Perjalanan Selesai</p>
                </div>
                <div class="space-y-1">
                    <p class="text-2xl lg:text-3xl font-black text-[#fbc02d]">50+</p>
                    <p class="text-[10px] font-black text-blue-200 uppercase tracking-[0.2em]">Armada Modern</p>
                </div>
                <div class="space-y-1">
                    <p class="text-2xl lg:text-3xl font-black text-[#fbc02d]">4.9/5</p>
                    <p class="text-[10px] font-black text-blue-200 uppercase tracking-[0.2em]">Rating Pelanggan</p>
                </div>
                <div class="space-y-1">
                    <p class="text-2xl lg:text-3xl font-black text-[#fbc02d]">24/7</p>
                    <p class="text-[10px] font-black text-blue-200 uppercase tracking-[0.2em]">Layanan Standby</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Promo Banner (Conditional) -->
    @if($promo)
    <div class="py-12 bg-white relative overflow-hidden">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-gradient-to-r from-[#1a237e] to-blue-800 rounded-[50px] overflow-hidden shadow-2xl relative group">
                <!-- Background Accents -->
                <div class="absolute top-0 right-0 w-96 h-96 bg-white/5 rounded-full -mr-32 -mt-32 blur-3xl group-hover:bg-white/10 transition-all duration-700"></div>
                <div class="absolute bottom-0 left-0 w-64 h-64 bg-[#fbc02d] rounded-full -ml-20 -mb-20 opacity-10 blur-2xl"></div>

                <div class="relative z-10 flex flex-col lg:flex-row items-center">
                    <!-- Image Area -->
                    <div class="w-full lg:w-2/5 h-64 lg:h-auto overflow-hidden">
                        @if($promo->gambar)
                            <img src="{{ asset('storage/' . $promo->gambar) }}" class="w-full h-full object-cover transform group-hover:scale-110 transition duration-700" alt="Special Promo">
                        @else
                            <div class="w-full h-full bg-blue-900/50 flex items-center justify-center text-white/20 italic p-12 text-center text-4xl font-black uppercase tracking-tighter">
                                Special <br> Offer
                            </div>
                        @endif
                    </div>

                    <!-- Content Area -->
                    <div class="w-full lg:w-3/5 p-8 lg:p-16 text-white text-center lg:text-left">
                        <div class="inline-flex items-center gap-3 px-5 py-2 bg-[#fbc02d] text-[#1a237e] rounded-full text-[10px] font-black uppercase tracking-[0.2em] mb-6 shadow-lg shadow-yellow-500/20">
                            <i class="bi bi-megaphone-fill"></i>
                            Promo Terbatas
                        </div>
                        
                        <h2 class="text-3xl md:text-5xl font-[900] leading-tight tracking-tighter uppercase mb-4">
                            {{ $promo->judul }}
                        </h2>
                        <p class="text-blue-200 text-sm md:text-lg font-medium mb-8 leading-relaxed opacity-90">
                            {{ $promo->deskripsi }}
                        </p>

                        <div class="flex flex-col sm:flex-row items-center gap-8 lg:gap-12">
                            <div class="flex flex-col">
                                <span class="text-5xl md:text-6xl font-black text-[#fbc02d] tracking-tighter leading-none">
                                    {{ $promo->potongan_persen }}%
                                </span>
                                <span class="text-[10px] font-black text-blue-300 uppercase tracking-[0.3em] mt-2 italic">Diskon Perjalanan</span>
                            </div>

                            @if($promo->kode_promo)
                            <div class="flex flex-col items-center lg:items-start">
                                <span class="text-[10px] font-black text-blue-300 uppercase tracking-[0.3em] mb-2 px-1">Gunakan Kode:</span>
                                <div class="px-8 py-3 bg-white/10 backdrop-blur-md rounded-2xl border border-white/20 font-black text-2xl tracking-widest text-[#fbc02d] select-all cursor-pointer hover:bg-white/20 transition uppercase">
                                    {{ $promo->kode_promo }}
                                </div>
                            </div>
                            @endif

                            <div class="flex-grow flex justify-center lg:justify-end">
                                <a href="{{ route('pelanggan.booking.create') }}" class="px-10 py-5 bg-white text-[#1a237e] font-black rounded-3xl shadow-xl hover:bg-[#fbc02d] transition-all transform hover:-translate-y-1 uppercase tracking-widest text-xs flex items-center gap-3">
                                    Klaim Sekarang
                                    <i class="bi bi-arrow-right-short text-xl"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif

    <!-- Dynamic Services Section -->
    <div id="layanan" class="py-24 bg-white relative">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-base text-[#1a237e] font-black tracking-widest uppercase">Layanan Unggulan</h2>
                <p class="mt-2 text-3xl font-black text-gray-900 sm:text-4xl">Solusi Transportasi Untuk Anda</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-10">
                @foreach($layanans as $layanan)
                <div class="p-8 bg-gray-50 rounded-[40px] border border-gray-100 hover:shadow-2xl transition group flex flex-col h-full">
                    <div class="w-16 h-16 bg-[#1a237e] rounded-2xl flex items-center justify-center text-white text-3xl mb-6 shadow-lg rotate-3 group-hover:rotate-0 transition">
                        <i class="bi {{ $layanan->icon ?? 'bi-star-fill' }}"></i>
                    </div>
                    <h3 class="text-xl font-black text-[#1a237e] mb-3 uppercase">{{ $layanan->nama_layanan }}</h3>
                    <p class="text-gray-500 font-medium leading-relaxed mb-6 flex-grow">{{ $layanan->deskripsi }}</p>
                    <a href="{{ Auth::check() ? route('pelanggan.booking.create') : route('login') }}" class="inline-flex items-center text-[#1a237e] font-black uppercase tracking-widest text-sm hover:gap-3 transition-all gap-2">
                        Pesan Sekarang
                        <i class="bi bi-arrow-right"></i>
                    </a>
                </div>
                @endforeach
            </div>
        </div>
    </div>

    <!-- Why Choose Us Section -->
    <div class="py-24 bg-white relative overflow-hidden">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col lg:flex-row items-center gap-16">
                <!-- Left: Content -->
                <div class="lg:w-1/2">
                    <h2 class="text-base text-[#1a237e] font-black tracking-widest uppercase mb-4">Keunggulan Kami</h2>
                    <h3 class="text-4xl md:text-5xl font-black text-gray-900 leading-tight mb-8">
                        Mengapa Harus Memilih <br><span class="text-[#fbc02d]">Zidan Transport?</span>
                    </h3>
                    <p class="text-gray-500 font-medium text-lg leading-relaxed mb-10">
                        Kami berkomitmen memberikan pengalaman perjalanan yang tak terlupakan dengan standar pelayanan bintang lima.
                    </p>
                    
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-8">
                        <div class="flex items-start gap-4">
                            <div class="w-12 h-12 rounded-2xl bg-blue-50 flex items-center justify-center text-[#1a237e] shrink-0 shadow-sm shadow-blue-100">
                                <i class="bi bi-person-badge-fill text-xl"></i>
                            </div>
                            <div>
                                <h4 class="font-black text-[#1a237e] uppercase text-xs tracking-wider mb-1">Driver Profesional</h4>
                                <p class="text-[11px] text-gray-400 font-bold leading-relaxed">Berpengalaman & Ramah</p>
                            </div>
                        </div>
                        <div class="flex items-start gap-4">
                            <div class="w-12 h-12 rounded-2xl bg-blue-50 flex items-center justify-center text-[#1a237e] shrink-0 shadow-sm shadow-blue-100">
                                <i class="bi bi-shield-check text-xl"></i>
                            </div>
                            <div>
                                <h4 class="font-black text-[#1a237e] uppercase text-xs tracking-wider mb-1">Armada Terawat</h4>
                                <p class="text-[11px] text-gray-400 font-bold leading-relaxed">Bersih, Wangi & Prima</p>
                            </div>
                        </div>
                        <div class="flex items-start gap-4">
                            <div class="w-12 h-12 rounded-2xl bg-blue-50 flex items-center justify-center text-[#1a237e] shrink-0 shadow-sm shadow-blue-100">
                                <i class="bi bi-tags-fill text-xl"></i>
                            </div>
                            <div>
                                <h4 class="font-black text-[#1a237e] uppercase text-xs tracking-wider mb-1">Harga Transparan</h4>
                                <p class="text-[11px] text-gray-400 font-bold leading-relaxed">Tanpa Biaya Tersembunyi</p>
                            </div>
                        </div>
                        <div class="flex items-start gap-4">
                            <div class="w-12 h-12 rounded-2xl bg-blue-50 flex items-center justify-center text-[#1a237e] shrink-0 shadow-sm shadow-blue-100">
                                <i class="bi bi-clock-fill text-xl"></i>
                            </div>
                            <div>
                                <h4 class="font-black text-[#1a237e] uppercase text-xs tracking-wider mb-1">Layanan 24/7</h4>
                                <p class="text-[11px] text-gray-400 font-bold leading-relaxed">Siap Kapan Saja</p>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Right: Stats / Image -->
                <div class="lg:w-1/2 relative">
                    <div class="relative z-10 grid grid-cols-2 gap-6">
                        <div class="space-y-6">
                            <div class="bg-gray-50 p-8 rounded-[40px] border border-gray-100 hover:scale-105 transition duration-500">
                                <h5 class="text-4xl font-black text-[#1a237e] mb-1">100+</h5>
                                <p class="text-[10px] font-black text-gray-400 uppercase tracking-widest leading-tight">Pelanggan Puas Setiap Bulan</p>
                            </div>
                            <div class="bg-[#1a237e] p-8 rounded-[40px] shadow-2xl shadow-blue-900/40 hover:scale-105 transition duration-500 text-white">
                                <h5 class="text-4xl font-black text-[#fbc02d] mb-1">24jt</h5>
                                <p class="text-[10px] font-black text-blue-200 uppercase tracking-widest leading-tight">Km Jarak Tempuh Aman</p>
                            </div>
                        </div>
                        <div class="pt-12 space-y-6">
                            <div class="bg-[#fbc02d] p-8 rounded-[40px] shadow-2xl shadow-yellow-500/30 hover:scale-105 transition duration-500">
                                <h5 class="text-4xl font-black text-[#1a237e] mb-1">5.0</h5>
                                <div class="flex gap-1 text-[#1a237e] text-xs mb-1">
                                    <i class="bi bi-star-fill"></i>
                                    <i class="bi bi-star-fill"></i>
                                    <i class="bi bi-star-fill"></i>
                                    <i class="bi bi-star-fill"></i>
                                    <i class="bi bi-star-fill"></i>
                                </div>
                                <p class="text-[10px] font-black text-[#1a237e]/60 uppercase tracking-widest leading-tight">Rating Rata-rata Pelanggan</p>
                            </div>
                            <div class="bg-gray-50 p-8 rounded-[40px] border border-gray-100 hover:scale-105 transition duration-500">
                                <h5 class="text-4xl font-black text-[#1a237e] mb-1">15+</h5>
                                <p class="text-[10px] font-black text-gray-400 uppercase tracking-widest leading-tight">Pilihan Armada Modern</p>
                            </div>
                        </div>
                    </div>
                    <!-- Decorative background element -->
                    <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[120%] h-[120%] bg-blue-50/50 rounded-full blur-[100px] -z-10"></div>
                </div>
            </div>
        </div>
    </div>
    <div id="armada" class="py-24 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-base text-[#1a237e] font-black tracking-widest uppercase">Katalog Armada</h2>
                <p class="mt-2 text-3xl font-black text-gray-900 sm:text-4xl">Kendaraan Bersih & Terawat</p>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach($armadas as $armada)
                <div class="bg-white rounded-[40px] overflow-hidden border border-gray-100 hover:shadow-2xl transition group shadow-sm">
                    <div class="h-56 overflow-hidden relative">
                        @if($armada->foto)
                            <img src="{{ asset('storage/' . $armada->foto) }}" class="w-full h-full object-cover group-hover:scale-110 transition duration-500" alt="{{ $armada->nama }}">
                        @else
                            <div class="w-full h-full bg-gray-100 flex items-center justify-center text-gray-300">
                                <i class="bi bi-car-front text-6xl"></i>
                            </div>
                        @endif
                        <div class="absolute top-4 right-4 bg-white/90 backdrop-blur-md px-4 py-1.5 rounded-full shadow-sm">
                            <span class="text-[10px] font-black text-[#1a237e] uppercase tracking-widest">{{ $armada->tahun }}</span>
                        </div>
                    </div>
                    <div class="p-8">
                        <div class="flex justify-between items-start mb-4">
                            <div>
                                <h3 class="text-xl font-black text-[#1a237e] uppercase leading-none">{{ $armada->nama }}</h3>
                                <p class="text-gray-400 text-xs font-bold uppercase tracking-widest mt-1">{{ $armada->plat_nomor }}</p>
                            </div>
                            <div class="text-right">
                                <p class="text-[10px] font-black text-gray-400 uppercase tracking-tighter leading-none">Status</p>
                                <p class="text-[#fbc02d] text-xl font-black italic">{{ ucfirst($armada->status) }}</p>
                            </div>
                        </div>

                        <div class="grid grid-cols-2 gap-4 mb-8">
                            <div class="flex items-center gap-2 text-gray-500">
                                <i class="bi bi-people text-[#16a34a]"></i>
                                <span class="text-xs font-bold">{{ $armada->kapasitas }} Orang</span>
                            </div>
                            <div class="flex items-center gap-2 text-gray-500">
                                <i class="bi bi-fuel-pump text-[#dc2626]"></i>
                                <span class="text-xs font-bold">{{ $armada->bbm ?? 'Pertalite' }}</span>
                            </div>
                        </div>

                        <a href="{{ Auth::check() ? route('pelanggan.booking.create', ['armada_id' => $armada->id]) : route('login') }}" class="block w-full text-center py-4 bg-[#1a237e] text-white font-black rounded-2xl hover:bg-[#0d1440] transition shadow-lg uppercase tracking-widest text-sm">
                            Lihat Detail & Pesan
                        </a>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>

        </div>
    </div>

    <!-- Contact & Map Section -->
    <div id="kontak" class="py-24 bg-gray-50 overflow-hidden">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-base text-[#1a237e] font-black tracking-widest uppercase">Lokasi & Kontak</h2>
                <p class="mt-2 text-3xl font-black text-gray-900 sm:text-4xl">Kunjungi Kantor Kami</p>
                <p class="mt-4 text-gray-500 font-medium max-w-2xl mx-auto text-sm sm:text-base">
                    Kami berlokasi di pusat Ngadiluwih, Kediri. Silakan mampir atau hubungi kami melalui saluran berikut.
                </p>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
                <!-- Contact Info Cards -->
                <div class="space-y-6 order-2 lg:order-1">
                    <div class="bg-white p-8 rounded-[40px] shadow-sm border border-gray-100 flex items-start gap-6 hover:shadow-xl transition group">
                        <div class="w-14 h-14 bg-[#1a237e] rounded-2xl flex items-center justify-center text-white text-2xl shadow-lg rotate-3 group-hover:rotate-0 transition shrink-0">
                            <i class="bi bi-geo-alt-fill text-[#fbc02d]"></i>
                        </div>
                        <div>
                            <h4 class="font-black text-[#1a237e] uppercase tracking-tight mb-2">Alamat Kantor</h4>
                            <p class="text-gray-500 text-sm font-bold leading-relaxed">{{ \App\Models\Setting::get('contact_address', 'Kediri, Jawa Timur') }}</p>
                        </div>
                    </div>

                    <div class="bg-white p-8 rounded-[40px] shadow-sm border border-gray-100 flex items-start gap-6 hover:shadow-xl transition group">
                        <div class="w-14 h-14 bg-green-500 rounded-2xl flex items-center justify-center text-white text-2xl shadow-lg -rotate-3 group-hover:rotate-0 transition shrink-0">
                            <i class="bi bi-whatsapp"></i>
                        </div>
                        <div>
                            <h4 class="font-black text-[#1a237e] uppercase tracking-tight mb-2">Layanan WhatsApp</h4>
                            <p class="text-gray-500 text-sm font-bold mb-3">{{ \App\Models\Setting::get('contact_whatsapp_display', '+62 821 4295 1682') }}</p>
                            <a href="https://wa.me/{{ \App\Models\Setting::get('contact_whatsapp', '6282142951682') }}" target="_blank" class="inline-flex items-center gap-2 text-green-600 font-black text-xs uppercase tracking-widest hover:gap-3 transition-all">
                                Chat Sekarang
                                <i class="bi bi-arrow-right"></i>
                            </a>
                        </div>
                    </div>

                    <div class="bg-white p-8 rounded-[40px] shadow-sm border border-gray-100 flex items-start gap-6 hover:shadow-xl transition group">
                        <div class="w-14 h-14 bg-[#fbc02d] rounded-2xl flex items-center justify-center text-[#1a237e] text-2xl shadow-lg rotate-3 group-hover:rotate-0 transition shrink-0">
                            <i class="bi bi-envelope-fill"></i>
                        </div>
                        <div>
                            <h4 class="font-black text-[#1a237e] uppercase tracking-tight mb-2">Email Resmi</h4>
                            <p class="text-gray-500 text-sm font-bold">{{ \App\Models\Setting::get('contact_email', 'zidantransport@gmail.com') }}</p>
                            <p class="text-[10px] text-gray-400 font-bold uppercase mt-1">Balasan dalam 24 Jam</p>
                        </div>
                    </div>
                </div>

                <!-- Google Maps Embed -->
                <div class="order-1 lg:order-2">
                    <div class="bg-white p-4 rounded-[45px] shadow-2xl border border-gray-100 rotate-1">
                        <div class="rounded-[35px] overflow-hidden h-[400px] border-4 border-white shadow-inner relative">
                            <iframe 
                                src="https://maps.google.com/maps?q=Zidan%20Transport%20Ngadiluwih%20Kediri&t=&z=15&ie=UTF8&iwloc=&output=embed" 
                                class="absolute inset-0 w-full h-full border-0 transition-all duration-700"
                                allowfullscreen="" 
                                loading="lazy" 
                                referrerpolicy="no-referrer-when-downgrade">
                            </iframe>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- CTA Section (Recruitment) -->
    <div id="gabung" class="py-20 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-[#1a237e] rounded-[50px] p-12 md:p-20 relative overflow-hidden shadow-2xl">
                <div class="absolute top-0 right-0 w-64 h-64 bg-[#fbc02d] rounded-full opacity-10 -mr-20 -mt-20"></div>
                <div class="relative z-10 grid md:grid-cols-2 gap-12 items-center">
                    <div>
                        <h2 class="text-3xl md:text-5xl font-black text-white leading-tight uppercase">
                            Ingin Bergabung <br>Sebagai <span class="text-[#fbc02d]">Mitra Driver?</span>
                        </h2>
                        <p class="mt-6 text-blue-200 text-lg font-medium">
                            Dapatkan penghasilan tambahan dan jadilah bagian dari layanan transportasi terbaik di Kediri.
                        </p>
                        <div class="mt-10">
                            <a href="{{ route('driver.register') }}" class="inline-flex items-center gap-3 px-10 py-5 bg-[#fbc02d] text-[#1a237e] font-black rounded-2xl hover:bg-white transition shadow-xl uppercase tracking-widest">
                                Daftar Sebagai Driver
                                <i class="bi bi-chevron-right"></i>
                            </a>
                        </div>
                    </div>
                    <div class="hidden md:block">
                        <div class="grid grid-cols-2 gap-4">
                            <div class="bg-white/10 p-6 rounded-3xl backdrop-blur-sm">
                                <h4 class="text-2xl font-black text-[#fbc02d]">Jam Kerja</h4>
                                <p class="text-white text-sm opacity-80 mt-1 uppercase font-bold tracking-tighter">Fleksibel</p>
                            </div>
                            <div class="bg-white/10 p-6 rounded-3xl backdrop-blur-sm mt-8">
                                <h4 class="text-2xl font-black text-[#fbc02d]">Penghasilan</h4>
                                <p class="text-white text-sm opacity-80 mt-1 uppercase font-bold tracking-tighter">Menarik</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- Floating Promo Area -->
    @if($promo)
    <div id="floating-promo" class="fixed bottom-8 right-8 z-[100] w-full max-w-[320px] transition-all duration-500">
        <div class="bg-white rounded-[32px] p-6 shadow-2xl border border-blue-50 relative overflow-hidden group animate-fade-in-up">
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
                        <h4 class="text-sm font-black text-[#1a237e] uppercase tracking-tighter">{{ $promo->judul }}</h4>
                    </div>
                </div>
                
                <p class="text-xs text-gray-500 font-bold mb-4 leading-relaxed line-clamp-2">{{ $promo->deskripsi }}</p>

                <div class="bg-gray-50 p-4 rounded-2xl border border-gray-100 mb-6 text-center">
                    <p class="text-[9px] font-black text-gray-400 uppercase tracking-widest mb-1">Gunakan Kode</p>
                    <p class="text-lg font-black text-[#1a237e] tracking-widest uppercase">{{ $promo->kode_promo }}</p>
                </div>

                <a href="{{ route('register') }}" class="block w-full text-center py-4 bg-[#1a237e] text-white font-black rounded-2xl text-[10px] uppercase tracking-widest shadow-xl hover:bg-[#0d1440] transition active:scale-95">
                    Daftar & Klaim Promo
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

        document.addEventListener('DOMContentLoaded', () => {
            if (sessionStorage.getItem('promo-dismissed')) {
                const promo = document.getElementById('floating-promo');
                if (promo) promo.remove();
            }
        });
    </script>
    @endif

    @include('partials.pelanggan.footer')

</body>
</html>
