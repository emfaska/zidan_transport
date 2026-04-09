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

    <!-- Navbar -->
    <nav class="bg-white/95 backdrop-blur-md fixed w-full z-50 shadow-sm border-b border-gray-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-20 items-center">
                <div class="flex-shrink-0 flex items-center">
                    <a href="{{ Auth::check() ? route('home') : route('landing') }}" class="flex items-center gap-3">
                        <img class="h-12 w-auto" src="{{ asset('images/logo.png') }}" alt="Zidan Transport">
                        <div class="flex flex-col">
                            <span class="text-lg font-black text-[#1a237e] leading-none uppercase tracking-tighter">Zidan</span>
                            <span class="text-[10px] font-bold text-[#fbc02d] uppercase tracking-[0.2em] leading-none mt-1">Transport</span>
                        </div>
                    </a>
                </div>
                <div class="hidden md:flex space-x-8 items-center">
                    <a href="{{ Auth::check() ? route('home') : route('landing') }}" class="text-gray-700 hover:text-[#1a237e] font-semibold transition">Beranda</a>
                    <a href="{{ route('pelanggan.armada') }}" class="text-gray-700 hover:text-[#1a237e] font-semibold transition">Armada</a>
                    <a href="{{ route('pelanggan.layanan') }}" class="text-gray-700 hover:text-[#1a237e] font-semibold transition">Layanan</a>
                    <a href="{{ route('pelanggan.rute') }}" class="text-[#1a237e] hover:text-[#fbc02d] font-bold transition border-b-2 border-[#1a237e] pb-1">Rute</a>
                    <a href="{{ route('pelanggan.kontak') }}" class="text-gray-700 hover:text-[#1a237e] font-semibold transition">Lokasi & Kontak</a>
                </div>
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
                        <div class="dropdown-menu hidden absolute right-0 mt-2 w-56 bg-white rounded-2xl shadow-xl border border-gray-100 py-2">
                            <div class="px-4 py-3 border-b border-gray-100">
                                <p class="text-xs text-gray-500 font-semibold">Signed in as</p>
                                <p class="text-sm font-bold text-[#1a237e] truncate">{{ Auth::user()->email }}</p>
                            </div>
                            <a href="{{ route('profile.edit') }}" class="flex items-center gap-3 px-4 py-3 hover:bg-gray-50 transition text-gray-700 hover:text-[#1a237e]">
                                <i class="bi bi-person"></i>
                                <span class="text-sm font-semibold">Profil Saya</span>
                            </a>
                            <a href="{{ route('pelanggan.booking.index') }}" class="flex items-center gap-3 px-4 py-3 hover:bg-gray-50 transition text-gray-700 hover:text-[#1a237e]">
                                <i class="bi bi-clock-history"></i>
                                <span class="text-sm font-semibold">Riwayat Pesanan</span>
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
                <div class="md:hidden flex items-center gap-3">
                    <button id="mobile-menu-btn" class="text-[#1a237e] hover:text-[#fbc02d] transition">
                        <i class="bi bi-list text-3xl"></i>
                    </button>
                </div>
            </div>
        </div>
        <div id="mobile-menu" class="hidden md:hidden bg-white border-t border-gray-100">
            <div class="px-4 py-4 space-y-3">
                <a href="{{ Auth::check() ? route('home') : route('landing') }}" class="block px-4 py-3 rounded-xl text-gray-700 hover:bg-gray-50 font-semibold">
                    <i class="bi bi-house-door mr-2"></i> Beranda
                </a>
                <a href="{{ route('pelanggan.armada') }}" class="block px-4 py-3 rounded-xl text-gray-700 hover:bg-gray-50 font-semibold">
                    <i class="bi bi-car-front mr-2"></i> Armada
                </a>
                <a href="{{ route('pelanggan.layanan') }}" class="block px-4 py-3 rounded-xl text-gray-700 hover:bg-gray-50 font-semibold">
                    <i class="bi bi-signpost-2 mr-2"></i> Layanan
                </a>
                <a href="{{ route('pelanggan.rute') }}" class="block px-4 py-3 rounded-xl bg-[#1a237e] text-white font-bold">
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

    <script>
        const mobileMenuBtn = document.getElementById('mobile-menu-btn');
        const mobileMenu = document.getElementById('mobile-menu');
        mobileMenuBtn.addEventListener('click', () => {
            mobileMenu.classList.toggle('hidden');
        });
    </script>

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

    <footer class="bg-[#1a237e] py-10 text-center text-white/30 text-[10px] uppercase font-black tracking-[0.4em]">
        &copy; {{ date('Y') }} Zidan Transport &bull; Professional Route Management
    </footer>

</body>
</html>
