<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" href="{{ asset('images/logo.png') }}">
    <title>Hubungi Kami - Zidan Transport</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <style>
        body { font-family: 'Montserrat', sans-serif; }
        
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
                            <p class="text-xl font-black text-[#1a237e] mb-2">{{ \App\Models\Setting::get('contact_email', 'zidantransport@gmail.com') }}</p>
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
                            <p class="text-lg font-black text-[#1a237e] mb-2">{{ \App\Models\Setting::get('contact_address', 'Kediri, Jawa Timur') }}</p>
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

    @include('partials.pelanggan.footer')
</body>
</html>
