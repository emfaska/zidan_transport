<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pesan Armada - Zidan Transport</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <style>
        body { font-family: 'Montserrat', sans-serif; }
        .dropdown:hover .dropdown-menu { display: block; }
    </style>
</head>
<body class="bg-[#f8faff]">

    <!-- Professional Navbar -->
    <nav class="bg-white/95 backdrop-blur-md fixed w-full z-50 shadow-sm border-b border-gray-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-20 items-center">
                
                <!-- Logo & Brand -->
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
                    <a href="{{ route('home') }}" class="text-gray-700 hover:text-[#1a237e] font-semibold transition">
                        Beranda
                    </a>
                    <a href="{{ route('pelanggan.armada') }}" class="text-gray-700 hover:text-[#1a237e] font-semibold transition">
                        Armada
                    </a>
                    <a href="{{ route('pelanggan.layanan') }}" class="text-gray-700 hover:text-[#1a237e] font-semibold transition">
                        Layanan & Rute
                    </a>
                    <a href="{{ route('pelanggan.kontak') }}" class="text-gray-700 hover:text-[#1a237e] font-semibold transition">
                        Lokasi & Kontak
                    </a>
                </div>

                <!-- User Profile Dropdown -->
                <div class="hidden md:flex items-center gap-4">
                    <div class="relative dropdown group">
                        <button class="flex items-center gap-3 px-4 py-2 rounded-full hover:bg-gray-50 transition">
                            <div class="text-right">
                                <p class="text-xs font-semibold text-gray-400 uppercase tracking-wide">Pelanggan</p>
                                <p class="text-sm font-black text-[#1a237e]">{{ Auth::user()->name }}</p>
                            </div>
                            <div class="w-10 h-10 rounded-full bg-gradient-to-br from-[#1a237e] to-blue-600 overflow-hidden shadow-lg border-2 border-white">
                                <img src="{{ Auth::user()->foto_profil ? asset('storage/' . Auth::user()->foto_profil) : 'https://ui-avatars.com/api/?name='.urlencode(Auth::user()->name).'&background=1a237e&color=fff&bold=true' }}" 
                                     class="w-full h-full object-cover">
                            </div>
                            <i class="bi bi-chevron-down text-gray-400 text-xs"></i>
                        </button>
                        
                        <div class="dropdown-menu hidden absolute right-0 mt-2 w-56 bg-white rounded-2xl shadow-xl border border-gray-100 py-2 overflow-hidden animate-fade-in-up">
                            <div class="px-4 py-3 border-b border-gray-50 bg-gray-50/50">
                                <p class="text-[10px] text-gray-400 font-bold uppercase tracking-widest">Akun Saya</p>
                                <p class="text-sm font-bold text-[#1a237e] truncate mt-0.5">{{ Auth::user()->email }}</p>
                            </div>
                            <a href="{{ route('profile.edit') }}" class="flex items-center gap-3 px-4 py-3 hover:bg-blue-50 transition text-gray-700 hover:text-[#1a237e]">
                                <i class="bi bi-person-circle"></i>
                                <span class="text-sm font-bold">Profil</span>
                            </a>
                            <a href="{{ route('pelanggan.booking.index') }}" class="flex items-center gap-3 px-4 py-3 hover:bg-blue-50 transition text-gray-700 hover:text-[#1a237e]">
                                <i class="bi bi-clock-history"></i>
                                <span class="text-sm font-bold">Riwayat Pesanan</span>
                            </a>
                            <div class="border-t border-gray-50 mt-2">
                                <form action="{{ route('logout') }}" method="POST">
                                    @csrf
                                    <button type="submit" class="w-full flex items-center gap-3 px-4 py-3 hover:bg-red-50 transition text-red-500 text-left font-bold">
                                        <i class="bi bi-box-arrow-right"></i>
                                        <span class="text-sm">Keluar</span>
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Mobile Menu Button -->
                <div class="md:hidden">
                    <button id="mobile-menu-btn" class="text-[#1a237e] p-2 hover:bg-gray-100 rounded-xl transition">
                        <i class="bi bi-list text-3xl"></i>
                    </button>
                </div>
            </div>
        </div>

        <!-- Mobile Menu -->
        <div id="mobile-menu" class="hidden md:hidden bg-white border-t border-gray-100 p-4">
            <div class="space-y-2">
                <a href="{{ route('home') }}" class="flex items-center gap-3 p-4 rounded-2xl hover:bg-gray-50 text-[#1a237e] font-bold transition">
                    <i class="bi bi-house-door"></i> Beranda
                </a>
                <a href="{{ route('pelanggan.armada') }}" class="flex items-center gap-3 p-4 rounded-2xl hover:bg-gray-50 text-gray-600 font-bold transition">
                    <i class="bi bi-car-front"></i> Armada
                </a>
                <a href="{{ route('pelanggan.booking.index') }}" class="flex items-center gap-3 p-4 rounded-2xl hover:bg-gray-50 text-gray-600 font-bold transition">
                    <i class="bi bi-clock-history"></i> Riwayat Pesanan
                </a>
                <div class="pt-4 border-t border-gray-100 mt-4">
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="w-full flex items-center gap-3 p-4 rounded-2xl text-red-500 font-bold hover:bg-red-50 transition">
                            <i class="bi bi-box-arrow-right"></i> Keluar
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </nav>

    <main class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 pt-28 pb-20">
        
        <div class="bg-white rounded-[40px] shadow-2xl border border-gray-100 overflow-hidden relative">
            <div class="absolute top-0 left-0 w-full h-2 bg-gradient-to-r from-[#1a237e] via-[#fbc02d] to-[#1a237e]"></div>
            
            <div class="p-8 md:p-12">
                <div class="flex items-center gap-6 mb-12">
                    <div class="w-16 h-16 rounded-[24px] bg-blue-50 flex items-center justify-center text-[#1a237e] shadow-inner border border-blue-100">
                        <i class="bi bi-plus-circle-fill text-3xl"></i>
                    </div>
                    <div>
                        <h2 class="text-3xl font-black text-[#1a237e] tracking-tighter uppercase leading-tight">Formulir Pemesanan</h2>
                        <p class="text-xs text-gray-400 font-bold uppercase tracking-[0.2em] mt-2">Lengkapi data perjalanan Anda</p>
                    </div>
                </div>

                <form action="{{ route('pelanggan.booking.store') }}" method="POST" class="space-y-10">
                    @csrf

                    @if(session('error'))
                    <div class="bg-red-50 border-2 border-red-100 rounded-[24px] p-6 flex items-center gap-6 animate-fade-in-down mb-8">
                        <div class="w-12 h-12 rounded-2xl bg-red-100 flex items-center justify-center text-red-600 shadow-inner">
                            <i class="bi bi-exclamation-triangle-fill text-2xl"></i>
                        </div>
                        <div>
                            <p class="text-[10px] font-black uppercase tracking-widest text-red-400 mb-1">Gagal Memesan</p>
                            <h3 class="text-sm font-bold text-red-700">{{ session('error') }}</h3>
                        </div>
                    </div>
                    @endif
                    
                    <input type="hidden" name="armada_id" value="{{ request('armada_id') }}">

                    @if(isset($selectedArmada))
                    <div class="bg-blue-50/50 border border-blue-100 rounded-[32px] p-6 flex items-center gap-6 animate-fade-in-down">
                        <div class="w-20 h-20 rounded-2xl overflow-hidden flex-shrink-0 bg-white border border-blue-50 shadow-md">
                            @if($selectedArmada->foto)
                                <img src="{{ asset('storage/' . $selectedArmada->foto) }}" class="w-full h-full object-cover">
                            @else
                                <div class="w-full h-full flex items-center justify-center bg-gray-100 text-gray-400">
                                    <i class="bi bi-car-front-fill text-3xl"></i>
                                </div>
                            @endif
                        </div>
                        <div>
                            <p class="text-[10px] font-black uppercase tracking-widest text-[#1a237e]/60 mb-1">Armada Yang Dipilih</p>
                            <h3 class="text-xl font-black text-[#1a237e] tracking-tight">{{ $selectedArmada->nama }}</h3>
                            <p class="text-xs text-gray-500 font-bold mt-1 uppercase tracking-wider">{{ $selectedArmada->jenis }} • {{ $selectedArmada->kapasitas }} Seat</p>
                        </div>
                        <div class="ml-auto">
                            <a href="{{ route('pelanggan.armada') }}" class="px-4 py-2 bg-white text-red-500 border border-red-100 rounded-xl text-xs font-black uppercase tracking-widest hover:bg-red-50 transition shadow-sm">Ganti</a>
                        </div>
                    </div>
                    @endif
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                        <!-- Tipe Perjalanan -->
                        <div class="col-span-1 md:col-span-2 space-y-3">
                            <label class="text-[11px] font-black uppercase tracking-[0.2em] text-[#1a237e]/50 ml-1">Tipe Perjalanan</label>
                            <div class="grid grid-cols-2 gap-4">
                                <label class="relative flex items-center justify-center p-4 rounded-[24px] border-2 border-gray-100 bg-gray-50 cursor-pointer hover:bg-white hover:border-[#1a237e] transition-all group overflow-hidden">
                                    <input type="radio" name="tipe_perjalanan" value="one_way" checked class="peer absolute opacity-0 cursor-pointer">
                                    <div class="absolute inset-0 bg-[#1a237e] opacity-0 peer-checked:opacity-100 transition-opacity"></div>
                                    <span class="relative z-10 text-xs font-black uppercase tracking-widest text-[#1a237e] peer-checked:text-white transition-colors">Sekali Jalan</span>
                                </label>
                                <label class="relative flex items-center justify-center p-4 rounded-[24px] border-2 border-gray-100 bg-gray-50 cursor-pointer hover:bg-white hover:border-[#fbc02d] transition-all group overflow-hidden">
                                    <input type="radio" name="tipe_perjalanan" value="round_trip" class="peer absolute opacity-0 cursor-pointer">
                                    <div class="absolute inset-0 bg-[#fbc02d] opacity-0 peer-checked:opacity-100 transition-opacity"></div>
                                    <span class="relative z-10 text-xs font-black uppercase tracking-widest text-[#1a237e] transition-colors">Pulang Pergi (PP)</span>
                                </label>
                            </div>
                        </div>

                        <!-- Pilih Layanan -->
                        <div class="space-y-3">
                            <label class="text-[11px] font-black uppercase tracking-[0.2em] text-[#1a237e]/50 ml-1">Jenis Layanan</label>
                            <div class="relative group">
                                <i class="bi bi-grid-fill absolute left-5 top-1/2 -translate-y-1/2 text-gray-300 group-focus-within:text-[#1a237e] transition-colors"></i>
                                <select name="layanan_id" id="layanan_id" required class="w-full pl-14 pr-6 py-4 bg-gray-50 border-2 border-transparent rounded-[24px] focus:bg-white focus:border-[#1a237e] focus:ring-4 focus:ring-blue-900/5 transition-all outline-none font-bold text-[#1a237e] appearance-none cursor-pointer">
                                    <option value="" disabled selected>Pilih Layanan...</option>
                                    @foreach($layanans as $layanan)
                                        <option value="{{ $layanan->id }}">{{ $layanan->nama_layanan }}</option>
                                    @endforeach
                                </select>
                                <i class="bi bi-chevron-down absolute right-6 top-1/2 -translate-y-1/2 text-gray-300 pointer-events-none"></i>
                            </div>
                        </div>

                        <!-- Pilih Tujuan -->
                        <div class="space-y-3">
                            <label class="text-[11px] font-black uppercase tracking-[0.2em] text-[#1a237e]/50 ml-1">Tujuan Perjalanan</label>
                            <div class="relative group">
                                <i class="bi bi-geo-alt-fill absolute left-5 top-1/2 -translate-y-1/2 text-gray-300 group-focus-within:text-[#1a237e] transition-colors"></i>
                                <select id="tujuan_select" required disabled class="w-full pl-14 pr-6 py-4 bg-gray-50 border-2 border-transparent rounded-[24px] focus:bg-white focus:border-[#1a237e] focus:ring-4 focus:ring-blue-900/5 transition-all outline-none font-bold text-[#1a237e] appearance-none cursor-pointer disabled:bg-gray-100 disabled:text-gray-400 disabled:cursor-not-allowed">
                                    <option value="" disabled selected>Pilih Layanan Terlebih Dahulu...</option>
                                </select>
                                <i class="bi bi-chevron-down absolute right-6 top-1/2 -translate-y-1/2 text-gray-300 pointer-events-none"></i>
                            </div>
                        </div>

                        <!-- Hidden Input for Actual Rute ID -->
                        <input type="hidden" name="rute_id" id="rute_id" required>

                        <!-- Jumlah Penumpang -->
                        <div class="space-y-3">
                            <label class="text-[11px] font-black uppercase tracking-[0.2em] text-[#1a237e]/50 ml-1">Jumlah Penumpang</label>
                            <div class="relative group">
                                <i class="bi bi-people-fill absolute left-5 top-1/2 -translate-y-1/2 text-gray-300 group-focus-within:text-[#1a237e] transition-colors"></i>
                                <input type="number" name="jumlah_penumpang" value="{{ old('jumlah_penumpang', 1) }}" min="1" required class="w-full pl-14 pr-6 py-4 bg-gray-50 border-2 border-transparent rounded-[24px] focus:bg-white focus:border-[#1a237e] focus:ring-4 focus:ring-blue-900/5 transition-all outline-none font-bold text-[#1a237e]" placeholder="1">
                            </div>
                            @error('jumlah_penumpang') <p class="text-red-500 text-[10px] font-bold mt-1 ml-1">{{ $message }}</p> @enderror
                        </div>

                        <!-- Tanggal Berangkat -->
                        <div class="space-y-3">
                            <label class="text-[11px] font-black uppercase tracking-[0.2em] text-[#1a237e]/50 ml-1">Tanggal Berangkat</label>
                            <div class="relative group">
                                <i class="bi bi-calendar-event-fill absolute left-5 top-1/2 -translate-y-1/2 text-gray-300 group-focus-within:text-[#1a237e] transition-colors"></i>
                                <input type="date" name="tanggal_berangkat" required min="{{ date('Y-m-d') }}" class="w-full pl-14 pr-6 py-4 bg-gray-50 border-2 border-transparent rounded-[24px] focus:bg-white focus:border-[#1a237e] focus:ring-4 focus:ring-blue-900/5 transition-all outline-none font-bold text-[#1a237e]">
                            </div>
                            @error('tanggal_berangkat') <p class="text-red-500 text-[10px] font-bold mt-1 ml-1">{{ $message }}</p> @enderror
                        </div>

                        <!-- Waktu Jemput -->
                        <div class="space-y-3">
                            <label class="text-[11px] font-black uppercase tracking-[0.2em] text-[#1a237e]/50 ml-1">Jam Penjemputan</label>
                            <div class="relative group">
                                <i class="bi bi-clock-fill absolute left-5 top-1/2 -translate-y-1/2 text-gray-300 group-focus-within:text-[#1a237e] transition-colors"></i>
                                <input type="time" name="waktu_jemput" required class="w-full pl-14 pr-6 py-4 bg-gray-50 border-2 border-transparent rounded-[24px] focus:bg-white focus:border-[#1a237e] focus:ring-4 focus:ring-blue-900/5 transition-all outline-none font-bold text-[#1a237e]">
                            </div>
                            @error('waktu_jemput') <p class="text-red-500 text-[10px] font-bold mt-1 ml-1">{{ $message }}</p> @enderror
                        </div>
                    </div>

                    <!-- Pilih Armada Grid (Visible when Tujuan selected) -->
                    <div id="armada_section" class="space-y-4 hidden animate-fade-in-up">
                         <label class="text-[11px] font-black uppercase tracking-[0.2em] text-[#1a237e]/50 ml-1">Pilih Armada & Harga Paket</label>
                         <div id="armada_grid" class="grid grid-cols-1 md:grid-cols-2 gap-6">
                             <!-- Cards injected by JS -->
                         </div>
                    </div>

                    <!-- Checkbox Tol -->
                    <div id="tol-section" class="space-y-4 hidden animate-fade-in-up">
                        <label class="text-[11px] font-black uppercase tracking-[0.2em] text-[#1a237e]/50 ml-1">Layanan Ekstra</label>
                        <label class="flex items-center gap-6 p-6 border-2 border-dashed border-gray-200 rounded-[30px] bg-gray-50 cursor-pointer hover:bg-white hover:border-blue-200 hover:shadow-xl transition-all group">
                            <div class="relative flex items-center">
                                <input type="checkbox" name="include_tol" id="include_tol" value="1" class="peer h-8 w-8 cursor-pointer appearance-none rounded-xl border-2 border-gray-300 bg-white transition-all checked:border-[#1a237e] checked:bg-[#1a237e]">
                                <i class="bi bi-check-lg absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 text-white opacity-0 peer-checked:opacity-100 transition-opacity pointer-events-none text-xl"></i>
                            </div>
                            <div class="flex-1">
                                <p class="font-black text-[#1a237e] text-base">Termasuk Biaya Tol</p>
                                <p class="text-xs text-gray-400 font-bold uppercase tracking-wider mt-1">Perjalanan lebih cepat via tol</p>
                            </div>
                            <div class="text-right">
                                <span class="text-sm font-black text-blue-600 block" id="tol-price-display">+Rp 0</span>
                            </div>
                        </label>
                    </div>

                    <!-- Catatan Tambahan -->
                    <div class="space-y-3">
                        <label class="text-[11px] font-black uppercase tracking-[0.2em] text-[#1a237e]/50 ml-1">Catatan Tambahan (Opsional)</label>
                        <textarea name="catatan_customer" rows="4" class="w-full bg-gray-50 border-2 border-transparent rounded-[32px] p-8 focus:bg-white focus:border-[#1a237e] focus:ring-4 focus:ring-blue-900/5 transition-all outline-none font-medium text-[#1a237e]" placeholder="Contoh: Titik jemput di depan Lobi Hotel A..."></textarea>
                    </div>

                    <!-- Price Confirmation Box -->
                    <div id="price-box" class="hidden animate-fade-in-up space-y-6">
                        <div class="bg-gradient-to-r from-[#1a237e] to-blue-800 rounded-[35px] p-8 text-white shadow-2xl flex flex-col md:flex-row justify-between items-center gap-6">
                            <div>
                                <p class="text-[10px] font-black uppercase tracking-[0.3em] text-blue-200 mb-2">Total Estimasi Awal</p>
                                <div class="flex flex-col">
                                    <h3 class="text-4xl font-black tracking-tighter" id="estimated-price">Rp 0</h3>
                                    <div id="promo-badge" class="hidden mt-2 flex flex-col">
                                        <span class="text-[10px] font-black text-[#fbc02d] uppercase tracking-widest bg-white/10 self-start px-3 py-1 rounded-full border border-yellow-500/30">
                                            <i class="bi bi-tag-fill mr-1"></i> Diskon Promo <span id="promo-percent">0</span>%
                                        </span>
                                        <span class="text-xs font-bold text-blue-200 line-through mt-1 opacity-60" id="original-price">Rp 0</span>
                                    </div>
                                </div>
                                <p class="text-[9px] font-bold text-[#fbc02d] mt-4 uppercase tracking-widest italic leading-relaxed">
                                    <i class="bi bi-info-circle-fill mr-1 text-xs"></i> Harga final akan fiks setelah nego via WhatsApp.<br>Sudah termasuk diskon promo (jika ada).
                                </p>
                            </div>
                            <div class="bg-white/10 backdrop-blur-md px-6 py-4 rounded-3xl border border-white/20">
                                <p class="text-[10px] font-black uppercase tracking-widest text-[#fbc02d]">Metode Pembayaran</p>
                                <p class="text-sm font-bold uppercase tracking-widest mt-1">Cash / Transfer</p>
                            </div>
                        </div>

                        <!-- Fasilitas Info -->
                        <div class="bg-white rounded-[35px] border-2 border-gray-50 p-8 shadow-inner">
                            <h4 class="font-black text-[#1a237e] text-sm mb-6 flex items-center gap-3">
                                <i class="bi bi-patch-check-fill text-[#fbc02d] text-xl"></i>
                                RINCIAN FASILITAS PERJALANAN
                            </h4>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                                <div>
                                    <p class="text-[10px] font-black uppercase tracking-[0.2em] text-green-600 mb-4 border-b border-gray-100 pb-2 flex items-center gap-2">
                                        <i class="bi bi-plus-lg"></i> Termasuk (Included)
                                    </p>
                                    <ul class="space-y-3">
                                        <li class="flex items-start gap-3 text-xs font-bold text-gray-600 uppercase tracking-tight">
                                            <i class="bi bi-check-circle-fill text-green-500"></i> Unit Kendaraan Premium
                                        </li>
                                        <li class="flex items-start gap-3 text-xs font-bold text-gray-600 uppercase tracking-tight">
                                            <i class="bi bi-check-circle-fill text-green-500"></i> Jasa Pengemudi Standar Zidan Trans
                                        </li>
                                        <li class="flex items-start gap-3 text-xs font-bold text-gray-600 uppercase tracking-tight">
                                            <i class="bi bi-check-circle-fill text-green-500"></i> BBM Sepanjang Rute
                                        </li>
                                        <li id="li-tol-included" class="hidden flex items-start gap-3 text-xs font-black text-[#1a237e] uppercase tracking-tight animate-fade-in">
                                            <i class="bi bi-check-circle-fill text-blue-500"></i> Biaya Jalan Tol
                                        </li>
                                    </ul>
                                </div>
                                <div>
                                    <p class="text-[10px] font-black uppercase tracking-[0.2em] text-red-500 mb-4 border-b border-gray-100 pb-2 flex items-center gap-2">
                                        <i class="bi bi-dash-lg"></i> Tidak Termasuk (Excluded)
                                    </p>
                                    <ul class="space-y-3">
                                        <li class="flex items-start gap-3 text-xs font-bold text-gray-400 uppercase tracking-tight">
                                            <i class="bi bi-x-circle-fill text-red-300"></i> Parkir & Tiket Masuk Objek
                                        </li>
                                        <li class="flex items-start gap-3 text-xs font-bold text-gray-400 uppercase tracking-tight">
                                            <i class="bi bi-x-circle-fill text-red-300"></i> Konsumsi Pribadi & Crew
                                        </li>
                                        <li class="flex items-start gap-3 text-xs font-bold text-gray-400 uppercase tracking-tight">
                                            <i class="bi bi-x-circle-fill text-red-300"></i> Penginapan Crew (Jika Menginap)
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Submission Buttons -->
                    <div class="flex flex-col md:flex-row gap-4 pt-6">
                        <button type="submit" class="flex-1 py-5 bg-[#1a237e] text-white rounded-[24px] font-black uppercase tracking-[0.2em] shadow-xl shadow-blue-900/20 hover:bg-[#0d1440] hover:-translate-y-1 transition-all active:scale-95 flex items-center justify-center gap-4">
                            KONFIRMASI PESANAN <i class="bi bi-chevron-right"></i>
                        </button>
                        <a href="{{ route('home') }}" class="px-10 py-5 bg-gray-100 text-gray-400 rounded-[24px] font-black uppercase tracking-[0.2em] hover:bg-gray-200 hover:text-gray-600 transition-all text-center">
                            BATALKAN
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </main>

    <footer class="bg-[#1a237e] py-10 text-center text-white/30 text-[10px] uppercase font-black tracking-[0.4em]">
        &copy; {{ date('Y') }} Zidan Transport Kediri &bull; VIP Travel Solutions
    </footer>

    <!-- Logic JS -->
    <script>
        const allRutes = @json($rutes);
        const activePromo = @json($promo);
        const mobileMenuBtn = document.getElementById('mobile-menu-btn');
        const mobileMenu = document.getElementById('mobile-menu');
        
        mobileMenuBtn.onclick = () => mobileMenu.classList.toggle('hidden');

        document.addEventListener('DOMContentLoaded', function() {
            const layananSelect = document.getElementById('layanan_id');
            const tujuanSelect = document.getElementById('tujuan_select');
            const armadaSection = document.getElementById('armada_section');
            const armadaGrid = document.getElementById('armada_grid');
            const ruteIdInput = document.getElementById('rute_id');
            const priceBox = document.getElementById('price-box');
            const estimatedPrice = document.getElementById('estimated-price');
            const tolSection = document.getElementById('tol-section');
            const tolCheckbox = document.getElementById('include_tol');
            const tolPriceDisplay = document.getElementById('tol-price-display');
            const liTol = document.getElementById('li-tol-included');

            const tipePerjalananRadios = document.querySelectorAll('input[name="tipe_perjalanan"]');

            let currentBasePriceOneWay = 0;
            let currentBasePricePP = 0;
            let currentTollPrice = 0;

            layananSelect.addEventListener('change', function() {
                const layananId = this.value;
                tujuanSelect.innerHTML = '<option value="" disabled selected>Pilih Tujuan...</option>';
                tujuanSelect.disabled = false;
                armadaSection.classList.add('hidden');
                tolSection.classList.add('hidden');
                ruteIdInput.value = "";
                priceBox.classList.add('hidden');
                tolCheckbox.checked = false;

                const filteredRutes = allRutes.filter(r => r.layanan_id == layananId);
                const uniqueTujuans = [...new Set(filteredRutes.map(r => r.nama_rute))];

                if(uniqueTujuans.length === 0) {
                    tujuanSelect.innerHTML = '<option value="" disabled selected>Tidak ada rute tersedia</option>';
                    tujuanSelect.disabled = true;
                } else {
                    uniqueTujuans.forEach(tujuan => {
                        const option = document.createElement('option');
                        option.value = tujuan;
                        option.textContent = tujuan;
                        tujuanSelect.appendChild(option);
                    });
                }
            });

            tujuanSelect.addEventListener('change', function() {
                const selectedTujuan = this.value;
                const layananId = layananSelect.value;
                const availableRutes = allRutes.filter(r => r.layanan_id == layananId && r.nama_rute == selectedTujuan);

                armadaSection.classList.remove('hidden');
                armadaGrid.innerHTML = ''; 
                ruteIdInput.value = ""; 
                priceBox.classList.add('hidden');
                tolSection.classList.add('hidden');
                tolCheckbox.checked = false;

                availableRutes.forEach(rute => {
                    const armadaName = rute.armada ? rute.armada.nama : 'Standard Fleet';
                    const armadaFoto = rute.armada && rute.armada.foto ? '/storage/' + rute.armada.foto : null;
                    const kapasitas = rute.armada ? rute.armada.kapasitas + ' Seat' : 'Standar';
                    
                    const priceOneWay = parseFloat(rute.harga_paket);
                    const pricePP = rute.harga_paket_pp ? parseFloat(rute.harga_paket_pp) : (priceOneWay * 1.8); // Default fallback 1.8x
                    
                    const formattedPrice = new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR', minimumFractionDigits: 0 }).format(priceOneWay);
                    const tollPrice = rute.harga_tol ? parseFloat(rute.harga_tol) : 0;

                    const card = document.createElement('div');
                    card.className = "bg-white border-2 border-gray-100 rounded-[28px] p-6 cursor-pointer hover:border-[#1a237e] hover:shadow-2xl transition-all duration-300 group relative overflow-hidden";
                    card.onclick = () => selectArmada(rute.id, priceOneWay, pricePP, tollPrice, card);

                    card.innerHTML = `
                        <div class="flex items-center gap-5">
                            <div class="w-20 h-20 rounded-2xl bg-gray-50 flex-shrink-0 overflow-hidden shadow-inner border border-gray-100">
                                ${armadaFoto ? `<img src="${armadaFoto}" class="w-full h-full object-cover">` : `<div class="w-full h-full flex items-center justify-center text-gray-300"><i class="bi bi-car-front-fill text-4xl"></i></div>`}
                            </div>
                            <div class="flex-1">
                                <h4 class="font-black text-[#1a237e] text-base tracking-tight">${armadaName}</h4>
                                <p class="text-[10px] text-gray-400 font-black uppercase tracking-widest mt-0.5">${kapasitas}</p>
                                <p class="text-sm font-black text-[#fbc02d] mt-2">${formattedPrice}</p>
                            </div>
                            <div class="w-8 h-8 rounded-full border-2 border-gray-200 flex items-center justify-center selection-ring group-hover:border-[#1a237e] flex-shrink-0 transition-colors">
                                <div class="w-4 h-4 rounded-full bg-[#1a237e] hidden animate-scale-in"></div>
                            </div>
                        </div>
                    `;
                    armadaGrid.appendChild(card);
                });
            });

            function selectArmada(id, basePriceOneWay, basePricePP, tollPrice, cardElement) {
                ruteIdInput.value = id;
                currentBasePriceOneWay = basePriceOneWay;
                currentBasePricePP = basePricePP;
                currentTollPrice = tollPrice;

                const allCards = armadaGrid.querySelectorAll('div[onclick]');
                allCards.forEach(c => {
                    c.classList.remove('border-[#1a237e]', 'bg-blue-50/50', 'ring-4', 'ring-blue-100/50');
                    c.classList.add('border-gray-100', 'bg-white');
                    c.querySelector('.selection-ring').classList.remove('border-[#1a237e]');
                    c.querySelector('.selection-ring div').classList.add('hidden');
                });

                cardElement.classList.remove('border-gray-100', 'bg-white');
                cardElement.classList.add('border-[#1a237e]', 'bg-blue-50/50', 'ring-4', 'ring-blue-100/50');
                cardElement.querySelector('.selection-ring').classList.add('border-[#1a237e]');
                cardElement.querySelector('.selection-ring div').classList.remove('hidden');

                if (currentTollPrice > 0) {
                    tolSection.classList.remove('hidden');
                    updateTolDisplay();
                } else {
                    tolSection.classList.add('hidden');
                    tolCheckbox.checked = false;
                }

                updateTotalPrice();
            }

            tipePerjalananRadios.forEach(radio => {
                radio.addEventListener('change', () => {
                    updateTolDisplay();
                    updateTotalPrice();
                });
            });

            function updateTolDisplay() {
                const isPP = document.querySelector('input[name="tipe_perjalanan"]:checked').value === 'round_trip';
                const tollToDisplay = isPP ? (currentTollPrice * 2) : currentTollPrice;
                tolPriceDisplay.innerText = '+' + new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR', minimumFractionDigits: 0 }).format(tollToDisplay);
            }

            tolCheckbox.addEventListener('change', updateTotalPrice);

            function updateTotalPrice() {
                const tipePerjalanan = document.querySelector('input[name="tipe_perjalanan"]:checked').value;
                const isPP = tipePerjalanan === 'round_trip';
                
                let total = isPP ? currentBasePricePP : currentBasePriceOneWay;
                
                if (tolCheckbox.checked && currentTollPrice > 0) {
                    const biayaTol = isPP ? (currentTollPrice * 2) : currentTollPrice;
                    total += biayaTol;
                    liTol.classList.remove('hidden');
                } else {
                    liTol.classList.add('hidden');
                }
                
                if (ruteIdInput.value) {
                    priceBox.classList.remove('hidden');
                    
                    const originalPriceEl = document.getElementById('original-price');
                    const promoBadge = document.getElementById('promo-badge');
                    const promoPercentEl = document.getElementById('promo-percent');

                    if (activePromo && activePromo.is_active) {
                        const discount = (total * activePromo.potongan_persen) / 100;
                        const finalTotal = total - discount;
                        
                        promoBadge.classList.remove('hidden');
                        promoPercentEl.innerText = activePromo.potongan_persen;
                        originalPriceEl.innerText = new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR', minimumFractionDigits: 0 }).format(total);
                        estimatedPrice.innerText = new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR', minimumFractionDigits: 0 }).format(finalTotal);
                    } else {
                        promoBadge.classList.add('hidden');
                        estimatedPrice.innerText = new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR', minimumFractionDigits: 0 }).format(total);
                    }
                }
            }
        });
    </script>

    <style>
        @keyframes scale-in {
            from { transform: scale(0); opacity: 0; }
            to { transform: scale(1); opacity: 1; }
        }
        .animate-scale-in { animation: scale-in 0.2s cubic-bezier(0.175, 0.885, 0.32, 1.275) forwards; }
        .animate-fade-in-up { animation: fadeInUp 0.5s ease-out forwards; }
        @keyframes fadeInUp {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
    </style>
</body>
</html>
