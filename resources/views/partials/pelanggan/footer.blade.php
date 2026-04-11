@php
    $siteName = \App\Models\Setting::get('site_name', 'Zidan Transport');
    $address = \App\Models\Setting::get('contact_address', 'Jl. Bokbrobos Ds. Ngadiluwih, Kediri');
    $whatsapp = \App\Models\Setting::get('contact_whatsapp', '6282142951682');
    $whatsappDisplay = \App\Models\Setting::get('contact_whatsapp_display', '+62 821-4295-1682');
    $email = \App\Models\Setting::get('contact_email', 'zidantransport@gmail.com');
@endphp

<!-- Professional Dynamic Footer -->
<footer class="bg-white text-[#1a237e] py-16 border-t border-gray-100 relative overflow-hidden">
    <!-- Decorative Accents -->
    <div class="absolute top-0 right-0 w-64 h-64 bg-blue-50/50 rounded-full -mr-32 -mt-32 blur-3xl"></div>
    <div class="absolute bottom-0 left-0 w-48 h-48 bg-yellow-50/50 rounded-full -ml-24 -mb-24 blur-3xl"></div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-12">
            
            <!-- Column 1: Brand -->
            <div class="space-y-6">
                <a href="{{ route('landing') }}" class="flex items-center gap-3">
                    <img class="h-12 w-auto" src="{{ asset('images/logo.png') }}" alt="{{ $siteName }}">
                    <div class="flex flex-col">
                        <span class="text-xl font-black text-[#1a237e] uppercase tracking-tighter leading-none">{{ explode(' ', $siteName)[0] }}</span>
                        <span class="text-[10px] font-bold text-[#fbc02d] uppercase tracking-[0.2em] leading-none mt-1">{{ explode(' ', $siteName)[1] ?? 'Transport' }}</span>
                    </div>
                </a>
                <p class="text-gray-500 text-sm font-medium leading-relaxed">
                    Solusi transportasi premium di Kediri dengan mengutamakan keselamatan, kenyamanan, dan kepuasan perjalanan Anda.
                </p>
                <div class="flex items-center gap-4">
                    <a href="#" class="w-10 h-10 rounded-xl bg-gray-50 flex items-center justify-center text-[#1a237e] hover:bg-[#1a237e] hover:text-white transition shadow-sm">
                        <i class="bi bi-facebook"></i>
                    </a>
                    <a href="#" class="w-10 h-10 rounded-xl bg-gray-50 flex items-center justify-center text-[#1a237e] hover:bg-gradient-to-tr from-[#f09433] via-[#e6683c] to-[#bc1888] hover:text-white transition shadow-sm">
                        <i class="bi bi-instagram"></i>
                    </a>
                    <a href="#" class="w-10 h-10 rounded-xl bg-gray-50 flex items-center justify-center text-[#1a237e] hover:bg-black hover:text-white transition shadow-sm">
                        <i class="bi bi-tiktok"></i>
                    </a>
                </div>
            </div>

            <!-- Column 2: Quick Links -->
            <div>
                <h4 class="text-sm font-black text-[#1a237e] uppercase tracking-[0.2em] mb-6">Menu Utama</h4>
                <ul class="space-y-4">
                    <li>
                        <a href="{{ route('landing') }}" class="text-gray-500 text-sm font-bold hover:text-[#1a237e] transition flex items-center gap-2">
                            <i class="bi bi-chevron-right text-[10px] text-[#fbc02d]"></i> Beranda
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('pelanggan.armada') }}" class="text-gray-500 text-sm font-bold hover:text-[#1a237e] transition flex items-center gap-2">
                            <i class="bi bi-chevron-right text-[10px] text-[#fbc02d]"></i> Katalog Armada
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('pelanggan.layanan') }}" class="text-gray-500 text-sm font-bold hover:text-[#1a237e] transition flex items-center gap-2">
                            <i class="bi bi-chevron-right text-[10px] text-[#fbc02d]"></i> Layanan
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('pelanggan.rute') }}" class="text-gray-500 text-sm font-bold hover:text-[#1a237e] transition flex items-center gap-2">
                            <i class="bi bi-chevron-right text-[10px] text-[#fbc02d]"></i> Rute Perjalanan
                        </a>
                    </li>
                </ul>
            </div>

            <!-- Column 3: Navigation -->
            <div>
                <h4 class="text-sm font-black text-[#1a237e] uppercase tracking-[0.2em] mb-6">Bantuan</h4>
                <ul class="space-y-4">
                    <li>
                        <a href="{{ route('pelanggan.kontak') }}" class="text-gray-500 text-sm font-bold hover:text-[#1a237e] transition flex items-center gap-2">
                            <i class="bi bi-chevron-right text-[10px] text-[#fbc02d]"></i> Kontak & Lokasi
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('login') }}" class="text-gray-500 text-sm font-bold hover:text-[#1a237e] transition flex items-center gap-2">
                            <i class="bi bi-chevron-right text-[10px] text-[#fbc02d]"></i> Masuk Akun
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('register') }}" class="text-gray-500 text-sm font-bold hover:text-[#1a237e] transition flex items-center gap-2">
                            <i class="bi bi-chevron-right text-[10px] text-[#fbc02d]"></i> Daftar Sekarang
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('driver.register') }}" class="text-gray-500 text-sm font-bold hover:text-[#1a237e] transition flex items-center gap-2">
                            <i class="bi bi-chevron-right text-[10px] text-[#fbc02d]"></i> Gabung Driver
                        </a>
                    </li>
                </ul>
            </div>

            <!-- Column 4: Contact Info -->
            <div>
                <h4 class="text-sm font-black text-[#1a237e] uppercase tracking-[0.2em] mb-6">Hubungi Kami</h4>
                <ul class="space-y-6">
                    <li class="flex items-start gap-4">
                        <div class="w-10 h-10 rounded-xl bg-blue-50 flex items-center justify-center text-[#1a237e] shrink-0 border border-blue-100">
                            <i class="bi bi-geo-alt-fill"></i>
                        </div>
                        <div>
                            <p class="text-[10px] font-black text-gray-400 uppercase tracking-widest leading-none mb-1">Alamat</p>
                            <p class="text-xs font-bold text-gray-600 leading-relaxed">{{ $address }}</p>
                        </div>
                    </li>
                    <li class="flex items-start gap-4">
                        <div class="w-10 h-10 rounded-xl bg-green-50 flex items-center justify-center text-green-600 shrink-0 border border-green-100">
                            <i class="bi bi-whatsapp"></i>
                        </div>
                        <div>
                            <p class="text-[10px] font-black text-gray-400 uppercase tracking-widest leading-none mb-1">WhatsApp</p>
                            <a href="https://wa.me/{{ $whatsapp }}" target="_blank" class="text-xs font-[800] text-[#1a237e] hover:text-[#fbc02d] transition">{{ $whatsappDisplay }}</a>
                        </div>
                    </li>
                    <li class="flex items-start gap-4">
                        <div class="w-10 h-10 rounded-xl bg-yellow-50 flex items-center justify-center text-[#fbc02d] shrink-0 border border-yellow-100">
                            <i class="bi bi-envelope-fill"></i>
                        </div>
                        <div>
                            <p class="text-[10px] font-black text-gray-400 uppercase tracking-widest leading-none mb-1">Email</p>
                            <a href="mailto:{{ $email }}" class="text-xs font-[800] text-[#1a237e] hover:text-[#fbc02d] transition">{{ $email }}</a>
                        </div>
                    </li>
                </ul>
            </div>

        </div>

        <!-- Copyright -->
        <div class="border-t border-gray-100 mt-16 pt-8 flex flex-col md:flex-row justify-between items-center gap-4">
            <p class="text-[10px] font-black text-gray-400 uppercase tracking-[0.3em]">
                &copy; {{ date('Y') }} {{ strtoupper($siteName) }} &bull; ALL RIGHTS RESERVED
            </p>
            <div class="flex items-center gap-6">
                <a href="#" class="text-[10px] font-black text-gray-400 uppercase tracking-tighter hover:text-[#1a237e] transition">Syarat & Ketentuan</a>
                <a href="#" class="text-[10px] font-black text-gray-400 uppercase tracking-tighter hover:text-[#1a237e] transition">Kebijakan Privasi</a>
            </div>
        </div>
    </div>
</footer>
