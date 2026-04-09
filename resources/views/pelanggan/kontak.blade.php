<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hubungi Kami - Zidan Transport</title>
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
                    <a href="{{ route('pelanggan.rute') }}" class="text-gray-700 hover:text-[#1a237e] font-semibold transition">Rute</a>
                    <a href="{{ route('pelanggan.kontak') }}" class="text-[#1a237e] hover:text-[#fbc02d] font-bold transition border-b-2 border-[#1a237e] pb-1">Lokasi & Kontak</a>
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
                    <i class="bi bi-layers mr-2"></i> Layanan
                </a>
                <a href="{{ route('pelanggan.rute') }}" class="block px-4 py-3 rounded-xl text-gray-700 hover:bg-gray-50 font-semibold">
                    <i class="bi bi-map mr-2"></i> Rute Perjalanan
                </a>
                <a href="{{ route('pelanggan.kontak') }}" class="block px-4 py-3 rounded-xl bg-[#1a237e] text-white font-bold">
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
                <span class="text-[#1a237e] font-semibold">Kontak</span>
            </div>
            <h1 class="text-4xl md:text-5xl font-black text-[#1a237e] mb-4">Hubungi Kami</h1>
            <p class="text-lg text-gray-600 max-w-3xl">Kami siap membantu Anda 24/7. Jangan ragu untuk menghubungi kami untuk konsultasi atau informasi lebih lanjut.</p>
        </div>

        <!-- Contact Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-12">
            
            <!-- Contact Form -->
            <div class="bg-white rounded-[40px] p-8 shadow-lg border border-gray-100">
                <h2 class="text-2xl font-black text-[#1a237e] mb-6">Kirim Pesan</h2>
                <form class="space-y-5">
                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-2">Nama Lengkap</label>
                        <input type="text" class="w-full bg-gray-50 border-2 border-gray-200 rounded-xl py-3 px-4 focus:ring-2 focus:ring-[#fbc02d] focus:border-[#fbc02d] outline-none transition" placeholder="Masukkan nama Anda" value="{{ Auth::check() ? Auth::user()->name : '' }}">
                    </div>
                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-2">Email</label>
                        <input type="email" class="w-full bg-gray-50 border-2 border-gray-200 rounded-xl py-3 px-4 focus:ring-2 focus:ring-[#fbc02d] focus:border-[#fbc02d] outline-none transition" placeholder="email@example.com" value="{{ Auth::check() ? Auth::user()->email : '' }}">
                    </div>
                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-2">Nomor Telepon</label>
                        <input type="tel" class="w-full bg-gray-50 border-2 border-gray-200 rounded-xl py-3 px-4 focus:ring-2 focus:ring-[#fbc02d] focus:border-[#fbc02d] outline-none transition" placeholder="+62 812 3456 7890">
                    </div>
                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-2">Subjek</label>
                        <select class="w-full bg-gray-50 border-2 border-gray-200 rounded-xl py-3 px-4 focus:ring-2 focus:ring-[#fbc02d] focus:border-[#fbc02d] outline-none transition">
                            <option>Pertanyaan Umum</option>
                            <option>Informasi Harga</option>
                            <option>Pemesanan</option>
                            <option>Keluhan/Saran</option>
                            <option>Lainnya</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-2">Pesan</label>
                        <textarea rows="4" class="w-full bg-gray-50 border-2 border-gray-200 rounded-xl py-3 px-4 focus:ring-2 focus:ring-[#fbc02d] focus:border-[#fbc02d] outline-none transition resize-none" placeholder="Tulis pesan Anda di sini..."></textarea>
                    </div>
                    <button type="submit" class="w-full bg-[#1a237e] hover:bg-[#0d1440] text-white font-black py-4 rounded-xl transition shadow-lg hover:shadow-xl uppercase tracking-widest text-sm">
                        <i class="bi bi-send mr-2"></i> Kirim Pesan
                    </button>
                </form>
            </div>

            <!-- Contact Info -->
            <div class="space-y-6">
                
                <!-- Contact Card 1 -->
                <div class="bg-gradient-to-br from-[#1a237e] to-blue-800 rounded-[40px] p-8 text-white shadow-xl">
                    <div class="flex items-start gap-4">
                        <div class="w-14 h-14 bg-[#fbc02d] rounded-2xl flex items-center justify-center flex-shrink-0 shadow-lg">
                            <i class="bi bi-telephone-fill text-[#1a237e] text-2xl"></i>
                        </div>
                        <div>
                            <p class="text-xs font-bold text-blue-200 mb-1 uppercase tracking-widest">Telepon & WhatsApp</p>
                            <p class="text-2xl font-black mb-2">{{ \App\Models\Setting::get('contact_whatsapp_display', '+62 821 4295 1682') }}</p>
                            <p class="text-[10px] text-blue-200 uppercase font-bold tracking-tight">Senin - Minggu, 24 Jam</p>
                            <a href="https://wa.me/{{ \App\Models\Setting::get('contact_whatsapp', '6282142951682') }}" target="_blank" class="inline-flex items-center gap-2 mt-4 bg-green-500 hover:bg-green-600 text-white px-5 py-2 rounded-xl font-bold text-xs transition shadow-md">
                                <i class="bi bi-whatsapp"></i>
                                Chat WhatsApp
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Contact Card 2 -->
                <div class="bg-white rounded-[40px] p-8 border border-gray-100 shadow-sm hover:shadow-md transition">
                    <div class="flex items-start gap-4">
                        <div class="w-14 h-14 bg-[#fbc02d] rounded-2xl flex items-center justify-center flex-shrink-0 shadow-lg">
                            <i class="bi bi-envelope-fill text-[#1a237e] text-2xl"></i>
                        </div>
                        <div>
                            <p class="text-xs font-bold text-gray-400 mb-1 uppercase tracking-widest">Email Resmi</p>
                            <p class="text-xl font-black text-[#1a237e] mb-2">zidantransport@gmail.com</p>
                            <p class="text-[10px] text-gray-400 font-bold uppercase tracking-tight">Respon dalam 24 Jam</p>
                        </div>
                    </div>
                </div>

                <!-- Contact Card 3 -->
                <div class="bg-white rounded-[40px] p-8 border border-gray-100 shadow-sm hover:shadow-md transition">
                    <div class="flex items-start gap-4">
                        <div class="w-14 h-14 bg-[#1a237e] rounded-2xl flex items-center justify-center flex-shrink-0 shadow-lg">
                            <i class="bi bi-geo-alt-fill text-[#fbc02d] text-2xl"></i>
                        </div>
                        <div>
                            <p class="text-xs font-bold text-gray-400 mb-1 uppercase tracking-widest">Alamat Kantor</p>
                            <p class="text-lg font-black text-[#1a237e] mb-2">Jl. Bokbrobos Rt.04/Rw.04 Ds. Ngadiluwih</p>
                            <p class="text-[10px] text-gray-400 font-bold uppercase tracking-tight">Kediri, Jawa Timur 64171</p>
                        </div>
                    </div>
                </div>

                <!-- Social Media -->
                <div class="bg-gradient-to-br from-gray-50 to-gray-100 rounded-[40px] p-8 border border-gray-100">
                    <p class="text-xs font-bold text-gray-400 mb-6 uppercase tracking-[0.2em] text-center">Ikuti Media Sosial Kami</p>
                    <div class="flex justify-center gap-4">
                        <a href="#" class="w-14 h-14 bg-white hover:bg-[#1a237e] hover:text-white rounded-2xl flex items-center justify-center shadow-sm hover:shadow-xl transition group">
                            <i class="bi bi-facebook text-xl text-blue-600 group-hover:text-white"></i>
                        </a>
                        <a href="#" class="w-14 h-14 bg-white hover:bg-gradient-to-tr hover:from-[#f09433] hover:via-[#e6683c] hover:to-[#bc1888] hover:text-white rounded-2xl flex items-center justify-center shadow-sm hover:shadow-xl transition group">
                            <i class="bi bi-instagram text-xl text-pink-600 group-hover:text-white"></i>
                        </a>
                        <a href="#" class="w-14 h-14 bg-white hover:bg-[#000000] hover:text-white rounded-2xl flex items-center justify-center shadow-sm hover:shadow-xl transition group">
                            <i class="bi bi-tiktok text-xl text-black group-hover:text-white"></i>
                        </a>
                    </div>
                </div>

            </div>

        </div>

        <!-- Map Section -->
        <div class="bg-white rounded-[40px] overflow-hidden shadow-xl border-4 border-white mb-12 relative group h-[500px]">
            <iframe 
                src="https://maps.google.com/maps?q=Zidan%20Transport%20Ngadiluwih%20Kediri&t=&z=15&ie=UTF8&iwloc=&output=embed" 
                class="absolute inset-0 w-full h-full border-0 transition-all duration-700 shadow-inner"
                allowfullscreen="" 
                loading="lazy" 
                referrerpolicy="no-referrer-when-downgrade">
            </iframe>
            
            <!-- Floating Navigation Button -->
            <a href="https://maps.app.goo.gl/dT1PzTHFyBHRMjPh8" target="_blank" class="absolute bottom-8 right-8 bg-[#1a237e] text-white px-8 py-4 rounded-2xl font-black shadow-2xl hover:bg-[#fbc02d] hover:text-[#1a237e] transition transform hover:-translate-y-1 flex items-center gap-3 uppercase tracking-widest text-sm z-10">
                <i class="bi bi-geo-alt-fill"></i>
                Buka Petunjuk Arah
            </a>
        </div>

        <!-- FAQ Section -->
        <div class="mb-12">
            <h2 class="text-3xl md:text-4xl font-black text-[#1a237e] mb-8 text-center">Pertanyaan Umum</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                
                <div class="bg-white rounded-2xl p-6 border border-gray-200">
                    <h3 class="font-black text-[#1a237e] mb-2 flex items-center gap-2">
                        <i class="bi bi-question-circle text-[#fbc02d]"></i>
                        Bagaimana cara memesan?
                    </h3>
                    <p class="text-gray-600 text-sm">Anda dapat memesan melalui website, WhatsApp, atau telepon langsung ke customer service kami.</p>
                </div>

                <div class="bg-white rounded-2xl p-6 border border-gray-200">
                    <h3 class="font-black text-[#1a237e] mb-2 flex items-center gap-2">
                        <i class="bi bi-question-circle text-[#fbc02d]"></i>
                        Apakah ada biaya pembatalan?
                    </h3>
                    <p class="text-gray-600 text-sm">Pembatalan H-2 tidak dikenakan biaya. Pembatalan H-1 dikenakan biaya 50% dari total.</p>
                </div>

                <div class="bg-white rounded-2xl p-6 border border-gray-200">
                    <h3 class="font-black text-[#1a237e] mb-2 flex items-center gap-2">
                        <i class="bi bi-question-circle text-[#fbc02d]"></i>
                        Metode pembayaran apa saja yang tersedia?
                    </h3>
                    <p class="text-gray-600 text-sm">Kami menerima transfer bank, e-wallet (OVO, GoPay, DANA), dan pembayaran tunai.</p>
                </div>

                <div class="bg-white rounded-2xl p-6 border border-gray-200">
                    <h3 class="font-black text-[#1a237e] mb-2 flex items-center gap-2">
                        <i class="bi bi-question-circle text-[#fbc02d]"></i>
                        Apakah driver sudah termasuk?
                    </h3>
                    <p class="text-gray-600 text-sm">Ya, semua paket kami sudah termasuk driver profesional dan berpengalaman.</p>
                </div>

            </div>
        </div>

    </main>

</body>
</html>
