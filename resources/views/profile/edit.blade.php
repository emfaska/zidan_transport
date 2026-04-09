<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pengaturan Profil - Zidan Transport</title>
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
                            <a href="{{ route('profile.edit') }}" class="flex items-center gap-3 px-4 py-3 bg-blue-50 text-[#1a237e] font-bold border-r-4 border-[#1a237e]">
                                <i class="bi bi-person-circle"></i>
                                <span class="text-sm">Profil</span>
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

    <main class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 pt-28 pb-20">
        
        <!-- Page Header -->
        <div class="flex flex-col md:flex-row md:items-end justify-between gap-6 mb-12">
            <div>
                <div class="inline-flex items-center gap-2 px-3 py-1 bg-blue-100 border border-blue-200 rounded-full text-[#1a237e] text-[10px] font-black uppercase tracking-widest mb-4">
                    <i class="bi bi-person-gear"></i> Pengaturan Akun
                </div>
                <h1 class="text-4xl md:text-5xl font-black text-[#1a237e] tracking-tighter uppercase">Profil Pelanggan</h1>
                <p class="text-gray-500 mt-2 font-medium">Kelola informasi pribadi, foto profil, dan keamanan akun Anda.</p>
            </div>
            <div class="px-5 py-2.5 bg-white border border-gray-100 rounded-2xl shadow-sm">
                <p class="text-[10px] text-gray-400 font-bold uppercase tracking-widest mb-1">Status Keanggotaan</p>
                <div class="flex items-center gap-2">
                    <div class="w-2 h-2 rounded-full bg-green-500 animate-pulse"></div>
                    <span class="text-sm font-black text-[#1a237e] uppercase">Pelanggan Aktif</span>
                </div>
            </div>
        </div>

        @if(session('success'))
        <div class="mb-10 p-5 bg-green-500 text-white rounded-[30px] shadow-xl shadow-green-200 flex items-center gap-4 animate-bounce-short">
            <div class="w-12 h-12 rounded-full bg-white/20 flex items-center justify-center border border-white/30">
                <i class="bi bi-check2-circle text-2xl"></i>
            </div>
            <p class="font-black text-sm uppercase tracking-wider">{{ session('success') }}</p>
        </div>
        @endif

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-10">
            <!-- Left: Profile Form -->
            <div class="lg:col-span-2">
                <div class="bg-white rounded-[40px] shadow-2xl shadow-blue-900/5 border border-gray-100 overflow-hidden relative">
                    <div class="absolute top-0 left-0 w-full h-2 bg-[#fbc02d]"></div>
                    
                    <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data" class="p-10 space-y-10">
                        @csrf
                        @method('patch')

                        <!-- Avatar Upload -->
                        <div class="flex flex-col md:flex-row items-center gap-10 pb-10 border-b border-gray-50">
                            <div class="relative group">
                                <div class="w-40 h-40 rounded-[40px] overflow-hidden border-8 border-gray-50 shadow-inner group-hover:border-[#1a237e]/5 transition-all duration-500">
                                    <img src="{{ Auth::user()->foto_profil ? asset('storage/' . Auth::user()->foto_profil) : 'https://ui-avatars.com/api/?name='.urlencode(Auth::user()->name).'&background=1a237e&color=fff&size=200&bold=true' }}" 
                                         id="preview-img"
                                         class="w-full h-full object-cover transition duration-700 group-hover:scale-110">
                                </div>
                                <label for="foto_profil" class="absolute -bottom-3 -right-3 w-14 h-14 bg-[#fbc02d] text-[#1a237e] rounded-[22px] flex items-center justify-center cursor-pointer shadow-xl shadow-yellow-500/40 hover:scale-110 active:scale-95 transition-all duration-300">
                                    <i class="bi bi-camera-fill text-2xl"></i>
                                </label>
                                <input type="file" name="foto_profil" id="foto_profil" class="hidden" onchange="previewFile()">
                            </div>
                            <div class="flex-1 text-center md:text-left">
                                <h3 class="text-2xl font-black text-[#1a237e] tracking-tight uppercase">{{ Auth::user()->name }}</h3>
                                <p class="text-gray-400 font-bold mt-1">{{ Auth::user()->email }}</p>
                                <div class="mt-6 inline-flex items-center gap-3 px-4 py-2 bg-gray-50 rounded-xl border border-gray-100">
                                    <i class="bi bi-info-circle-fill text-blue-500"></i>
                                    <span class="text-[10px] text-gray-500 font-black uppercase tracking-widest">JPG, PNG (Max 2MB)</span>
                                </div>
                            </div>
                        </div>

                        <!-- Form Inputs -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                            <div class="space-y-3">
                                <label class="text-[11px] font-black uppercase tracking-[0.2em] text-[#1a237e]/50 ml-1">Nama Lengkap</label>
                                <div class="relative group">
                                    <i class="bi bi-person-fill absolute left-5 top-1/2 -translate-y-1/2 text-gray-300 group-focus-within:text-[#1a237e] transition-colors"></i>
                                    <input type="text" name="name" value="{{ old('name', Auth::user()->name) }}" class="w-full pl-14 pr-6 py-4 bg-gray-50 border-2 border-transparent rounded-[24px] focus:bg-white focus:border-[#1a237e] focus:ring-4 focus:ring-blue-900/5 transition-all outline-none font-bold text-[#1a237e]" required>
                                </div>
                                @error('name') <p class="text-red-500 text-[10px] font-bold mt-1 ml-1">{{ $message }}</p> @enderror
                            </div>
                            <div class="space-y-3">
                                <label class="text-[11px] font-black uppercase tracking-[0.2em] text-[#1a237e]/50 ml-1">Email Aktif</label>
                                <div class="relative group">
                                    <i class="bi bi-envelope-at-fill absolute left-5 top-1/2 -translate-y-1/2 text-gray-300 group-focus-within:text-[#1a237e] transition-colors"></i>
                                    <input type="email" name="email" value="{{ old('email', Auth::user()->email) }}" class="w-full pl-14 pr-6 py-4 bg-gray-50 border-2 border-transparent rounded-[24px] focus:bg-white focus:border-[#1a237e] focus:ring-4 focus:ring-blue-900/5 transition-all outline-none font-bold text-[#1a237e]" required>
                                </div>
                                @error('email') <p class="text-red-500 text-[10px] font-bold mt-1 ml-1">{{ $message }}</p> @enderror
                            </div>
                            <div class="space-y-3 md:col-span-2">
                                <label class="text-[11px] font-black uppercase tracking-[0.2em] text-[#1a237e]/50 ml-1">Nomor WhatsApp</label>
                                <div class="relative group">
                                    <i class="bi bi-whatsapp absolute left-5 top-1/2 -translate-y-1/2 text-gray-300 group-focus-within:text-[#1a237e] transition-colors"></i>
                                    <input type="text" name="no_hp" value="{{ old('no_hp', Auth::user()->no_hp) }}" class="w-full pl-14 pr-6 py-4 bg-gray-50 border-2 border-transparent rounded-[24px] focus:bg-white focus:border-[#1a237e] focus:ring-4 focus:ring-blue-900/5 transition-all outline-none font-bold text-[#1a237e]" placeholder="08xxxx">
                                </div>
                                @error('no_hp') <p class="text-red-500 text-[10px] font-bold mt-1 ml-1">{{ $message }}</p> @enderror
                            </div>
                        </div>

                        <div class="space-y-3">
                            <label class="text-[11px] font-black uppercase tracking-[0.2em] text-[#1a237e]/50 ml-1">Alamat Lengkap</label>
                            <textarea name="alamat" rows="4" class="w-full bg-gray-50 border-2 border-transparent rounded-[32px] p-8 focus:bg-white focus:border-[#1a237e] focus:ring-4 focus:ring-blue-900/5 transition-all outline-none font-bold text-[#1a237e]">{{ old('alamat', Auth::user()->alamat) }}</textarea>
                            @error('alamat') <p class="text-red-500 text-[10px] font-bold mt-1 ml-1">{{ $message }}</p> @enderror
                        </div>

                        <div class="flex justify-end pt-4">
                            <button type="submit" class="px-10 py-5 bg-[#1a237e] text-white rounded-[24px] font-black uppercase tracking-[0.2em] shadow-xl shadow-blue-900/20 hover:bg-[#0d1440] hover:-translate-y-1 transition-all active:scale-95 flex items-center gap-4">
                                SIMPAN PERUBAHAN <i class="bi bi-check2-all text-xl"></i>
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Right: Security & Info -->
            <div class="space-y-10">
                <!-- Change Password -->
                <div class="bg-white rounded-[40px] shadow-2xl shadow-blue-900/5 border border-gray-100 overflow-hidden relative">
                    <div class="absolute top-0 left-0 w-full h-2 bg-red-500"></div>
                    
                    <div class="p-8">
                        <div class="flex items-center gap-4 mb-8">
                            <div class="w-12 h-12 bg-red-50 text-red-500 rounded-2xl flex items-center justify-center border border-red-100/50">
                                <i class="bi bi-shield-lock-fill text-xl"></i>
                            </div>
                            <h3 class="font-black text-[#1a237e] uppercase tracking-widest text-sm">Keamanan Akun</h3>
                        </div>

                        <form action="{{ route('profile.password.update') }}" method="POST" class="space-y-6">
                            @csrf
                            @method('put')

                            <div class="space-y-2">
                                <label class="text-[10px] font-black uppercase tracking-[0.2em] text-gray-400 ml-1">Password Sekarang</label>
                                <div class="relative">
                                    <input type="password" name="current_password" class="w-full bg-gray-50 border-none rounded-2xl pl-5 pr-12 py-4 focus:ring-4 focus:ring-red-100 transition font-bold text-[#1a237e]" required>
                                    <button type="button" class="password-toggle absolute right-4 top-1/2 -translate-y-1/2 text-gray-300 hover:text-[#1a237e] transition">
                                        <i class="bi bi-eye"></i>
                                    </button>
                                </div>
                                @error('current_password') <p class="text-red-500 text-[10px] font-bold mt-1 ml-1">{{ $message }}</p> @enderror
                            </div>

                            <div class="space-y-2">
                                <label class="text-[10px] font-black uppercase tracking-[0.2em] text-gray-400 ml-1">Password Baru</label>
                                <div class="relative">
                                    <input type="password" name="password" class="w-full bg-gray-50 border-none rounded-2xl pl-5 pr-12 py-4 focus:ring-4 focus:ring-red-100 transition font-bold text-[#1a237e]" required>
                                    <button type="button" class="password-toggle absolute right-4 top-1/2 -translate-y-1/2 text-gray-300 hover:text-[#1a237e] transition">
                                        <i class="bi bi-eye"></i>
                                    </button>
                                </div>
                                @error('password') <p class="text-red-500 text-[10px] font-bold mt-1 ml-1">{{ $message }}</p> @enderror
                            </div>

                            <div class="space-y-2">
                                <label class="text-[10px] font-black uppercase tracking-[0.2em] text-gray-400 ml-1">Konfirmasi</label>
                                <div class="relative">
                                    <input type="password" name="password_confirmation" class="w-full bg-gray-50 border-none rounded-2xl pl-5 pr-12 py-4 focus:ring-4 focus:ring-red-100 transition font-bold text-[#1a237e]" required>
                                    <button type="button" class="password-toggle absolute right-4 top-1/2 -translate-y-1/2 text-gray-300 hover:text-[#1a237e] transition">
                                        <i class="bi bi-eye"></i>
                                    </button>
                                </div>
                            </div>

                            <button type="submit" class="w-full bg-red-50 text-red-600 hover:bg-red-600 hover:text-white py-5 rounded-[22px] font-black uppercase tracking-widest text-xs transition-all duration-300 flex items-center justify-center gap-3 active:scale-95 shadow-lg shadow-red-500/10">
                                UPDATE PASSWORD <i class="bi bi-key-fill text-lg"></i>
                            </button>
                        </form>
                    </div>
                </div>

                <!-- Info Card -->
                <div class="bg-gradient-to-br from-[#1a237e] to-blue-900 rounded-[40px] p-8 text-white shadow-2xl relative overflow-hidden group">
                    <i class="bi bi-shield-check absolute -right-6 -bottom-6 text-9xl opacity-10 group-hover:scale-110 transition duration-700"></i>
                    <h4 class="font-black text-sm mb-4 uppercase tracking-[0.3em] flex items-center gap-2">
                         Tips Keamanan
                    </h4>
                    <p class="text-xs text-blue-100 leading-relaxed font-medium">Lindungi akun Anda dengan mengganti password secara berkala. Pastikan tidak memberikan informasi login Anda kepada siapapun.</p>
                </div>
            </div>
        </div>
    </main>

    <footer class="bg-[#1a237e] py-10 text-center text-white/30 text-[10px] uppercase font-black tracking-[0.4em]">
        &copy; {{ date('Y') }} Zidan Transport &bull; Secure Profile Management
    </footer>

    <script>
        const mobileMenuBtn = document.getElementById('mobile-menu-btn');
        const mobileMenu = document.getElementById('mobile-menu');
        mobileMenuBtn.onclick = () => mobileMenu.classList.toggle('hidden');

        // Password Visibility Toggle
        document.addEventListener('click', function (e) {
            if (e.target.closest('.password-toggle')) {
                const button = e.target.closest('.password-toggle');
                const container = button.closest('.relative');
                const input = container.querySelector('input');
                const icon = button.querySelector('i');

                if (input.type === 'password') {
                    input.type = 'text';
                    icon.classList.remove('bi-eye');
                    icon.classList.add('bi-eye-slash');
                } else {
                    input.type = 'password';
                    icon.classList.remove('bi-eye-slash');
                    icon.classList.add('bi-eye');
                }
            }
        });

        function previewFile() {
            const preview = document.querySelector('#preview-img');
            const file = document.querySelector('#foto_profil').files[0];
            const reader = new FileReader();

            reader.addEventListener("load", function () {
                preview.src = reader.result;
            }, false);

            if (file) {
                reader.readAsDataURL(file);
            }
        }
    </script>
</body>
</html>
