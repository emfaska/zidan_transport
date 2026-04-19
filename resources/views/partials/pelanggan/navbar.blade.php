<!-- Professional Unified Navbar -->
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
                <a href="{{ Auth::check() ? route('home') : route('landing') }}" 
                   class="{{ Request::routeIs('home') || Request::routeIs('landing') ? 'text-[#1a237e] border-b-2 border-[#1a237e] pb-1 font-bold' : 'text-gray-700 hover:text-[#1a237e] font-semibold' }} transition">
                    Beranda
                </a>
                <a href="{{ route('pelanggan.armada') }}" 
                   class="{{ Request::routeIs('pelanggan.armada') ? 'text-[#1a237e] border-b-2 border-[#1a237e] pb-1 font-bold' : 'text-gray-700 hover:text-[#1a237e] font-semibold' }} transition">
                    Armada
                </a>
                <a href="{{ route('pelanggan.layanan') }}" 
                   class="{{ Request::routeIs('pelanggan.layanan') ? 'text-[#1a237e] border-b-2 border-[#1a237e] pb-1 font-bold' : 'text-gray-700 hover:text-[#1a237e] font-semibold' }} transition">
                    Layanan
                </a>
                <a href="{{ route('pelanggan.rute') }}" 
                   class="{{ Request::routeIs('pelanggan.rute') ? 'text-[#1a237e] border-b-2 border-[#1a237e] pb-1 font-bold' : 'text-gray-700 hover:text-[#1a237e] font-semibold' }} transition">
                    Paket Rute
                </a>
                <a href="{{ route('pelanggan.kontak') }}" 
                   class="{{ Request::routeIs('pelanggan.kontak') ? 'text-[#1a237e] border-b-2 border-[#1a237e] pb-1 font-bold' : 'text-gray-700 hover:text-[#1a237e] font-semibold' }} transition">
                    Lokasi & Kontak
                </a>
            </div>

            <!-- User Profile Dropdown (Desktop) -->
            <div class="hidden md:flex items-center gap-4">
                @auth
                <div class="nav-dropdown-wrapper relative">
                    <button class="nav-dropdown-trigger flex items-center gap-3 px-4 py-2 rounded-full hover:bg-gray-50 transition">
                        <div class="text-right">
                            <p class="text-xs font-semibold text-gray-500 uppercase tracking-wide">Welcome</p>
                            <p class="text-sm font-black text-[#1a237e]">{{ Auth::user()->name }}</p>
                        </div>
                        <div class="w-10 h-10 rounded-full bg-gradient-to-br from-[#1a237e] to-blue-600 overflow-hidden shadow-lg border-2 border-white">
                            <img src="{{ Auth::user()->foto_profil ? asset('storage/' . Auth::user()->foto_profil) : 'https://ui-avatars.com/api/?name='.urlencode(Auth::user()->name).'&background=1a237e&color=fff&bold=true' }}" 
                                 class="w-full h-full object-cover">
                        </div>
                        <i class="bi bi-chevron-down text-gray-400 text-xs nav-chevron transition-transform duration-200"></i>
                    </button>
                    
                    <!-- Invisible Bridge (hover gap filler) -->
                    <div class="nav-dropdown-bridge absolute w-full top-full left-0" style="height: 20px;"></div>

                    <!-- Dropdown Menu -->
                    <div class="nav-dropdown-menu absolute right-0 top-[calc(100%+12px)] w-64 bg-white rounded-2xl shadow-2xl border border-gray-100 py-2 z-[60] pointer-events-none opacity-0 translate-y-2 transition-all duration-200">
                        <div class="px-4 py-3 border-b border-gray-100">
                            <p class="text-xs text-gray-500 font-semibold">Masuk sebagai</p>
                            <p class="text-sm font-bold text-[#1a237e] truncate">{{ Auth::user()->email }}</p>
                        </div>
                        <a href="{{ route('profile.edit') }}" class="flex items-center gap-3 px-4 py-3.5 hover:bg-blue-50 hover:text-[#1a237e] transition text-gray-700 font-semibold">
                            <i class="bi bi-person text-[#1a237e]"></i>
                            <span class="text-sm">Profil Saya</span>
                        </a>
                        <a href="{{ route('pelanggan.booking.index', ['tab' => 'active']) }}" class="flex items-center gap-3 px-4 py-3.5 hover:bg-blue-50 hover:text-[#1a237e] transition text-gray-700 font-semibold">
                            <i class="bi bi-car-front text-[#1a237e]"></i>
                            <span class="text-sm">Pesanan Berjalan</span>
                        </a>
                        <a href="{{ route('pelanggan.booking.index', ['tab' => 'history']) }}" class="flex items-center gap-3 px-4 py-3.5 hover:bg-blue-50 hover:text-[#1a237e] transition text-gray-700 font-semibold">
                            <i class="bi bi-clock-history text-[#1a237e]"></i>
                            <span class="text-sm">Riwayat Selesai</span>
                        </a>

                        <div class="border-t border-gray-100 mt-1 pt-1">
                            <form action="{{ route('logout') }}" method="POST">
                                @csrf
                                <button type="submit" class="w-full flex items-center gap-3 px-4 py-3.5 hover:bg-red-50 transition text-left">
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
            <a href="{{ Auth::check() ? route('home') : route('landing') }}" 
               class="block px-4 py-3 rounded-xl {{ Request::routeIs('home') || Request::routeIs('landing') ? 'bg-[#1a237e] text-white font-bold' : 'text-gray-700 hover:bg-gray-50 font-semibold' }}">
                <i class="bi bi-house-door mr-2"></i> Beranda
            </a>
            <a href="{{ route('pelanggan.armada') }}" 
               class="block px-4 py-3 rounded-xl {{ Request::routeIs('pelanggan.armada') ? 'bg-[#1a237e] text-white font-bold' : 'text-gray-700 hover:bg-gray-50 font-semibold' }}">
                <i class="bi bi-car-front mr-2"></i> Armada
            </a>
            <a href="{{ route('pelanggan.layanan') }}" 
               class="block px-4 py-3 rounded-xl {{ Request::routeIs('pelanggan.layanan') ? 'bg-[#1a237e] text-white font-bold' : 'text-gray-700 hover:bg-gray-50 font-semibold' }}">
                <i class="bi bi-layers mr-2"></i> Layanan
            </a>
            <a href="{{ route('pelanggan.rute') }}" 
               class="block px-4 py-3 rounded-xl {{ Request::routeIs('pelanggan.rute') ? 'bg-[#1a237e] text-white font-bold' : 'text-gray-700 hover:bg-gray-50 font-semibold' }}">
                <i class="bi bi-box2-heart mr-2"></i> Paket Rute
            </a>
            <a href="{{ route('pelanggan.kontak') }}" 
               class="block px-4 py-3 rounded-xl {{ Request::routeIs('pelanggan.kontak') ? 'bg-[#1a237e] text-white font-bold' : 'text-gray-700 hover:bg-gray-50 font-semibold' }}">
                <i class="bi bi-geo-alt mr-2"></i> Lokasi & Kontak
            </a>
            
            <!-- Mobile User Section -->
            <div class="border-t border-gray-100 pt-3 mt-3">
                @auth
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
                <a href="{{ route('pelanggan.booking.index', ['tab' => 'active']) }}" class="block px-4 py-3 rounded-xl text-gray-700 hover:bg-gray-50 font-semibold">
                    <i class="bi bi-car-front mr-2"></i> Pesanan Berjalan
                </a>
                <a href="{{ route('pelanggan.booking.index', ['tab' => 'history']) }}" class="block px-4 py-3 rounded-xl text-gray-700 hover:bg-gray-50 font-semibold">
                    <i class="bi bi-clock-history mr-2"></i> Riwayat Selesai
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
    if (!window.navbarScriptInitialized) {
        document.addEventListener('turbo:load', () => {
            // Mobile menu toggle
            const mobileMenuBtn = document.getElementById('mobile-menu-btn');
            const mobileMenu = document.getElementById('mobile-menu');
            
            if (mobileMenuBtn && mobileMenu) {
                mobileMenuBtn.addEventListener('click', () => {
                    mobileMenu.classList.toggle('hidden');
                });
            }

            // Hover Bridge Dropdown Logic
            document.querySelectorAll('.nav-dropdown-wrapper').forEach(wrapper => {
                const trigger = wrapper.querySelector('.nav-dropdown-trigger');
                const menu = wrapper.querySelector('.nav-dropdown-menu');
                const bridge = wrapper.querySelector('.nav-dropdown-bridge');
                const chevron = wrapper.querySelector('.nav-chevron');
                let hideTimer = null;
                let isMenuOpen = false;

                const showMenu = () => {
                    clearTimeout(hideTimer);
                    isMenuOpen = true;
                    menu.classList.remove('opacity-0', 'translate-y-2', 'pointer-events-none');
                    menu.classList.add('opacity-100', 'translate-y-0', 'pointer-events-auto');
                    if (chevron) chevron.style.transform = 'rotate(180deg)';
                };

                const hideMenu = () => {
                    hideTimer = setTimeout(() => {
                        isMenuOpen = false;
                        menu.classList.add('opacity-0', 'translate-y-2', 'pointer-events-none');
                        menu.classList.remove('opacity-100', 'translate-y-0', 'pointer-events-auto');
                        if (chevron) chevron.style.transform = 'rotate(0deg)';
                    }, 300);
                };

                // Trigger on wrapper (includes button and bridge)
                wrapper.addEventListener('mouseenter', showMenu);
                wrapper.addEventListener('mouseleave', hideMenu);

                // Keep open when hovering over the menu itself
                menu.addEventListener('mouseenter', () => {
                    clearTimeout(hideTimer);
                });
                menu.addEventListener('mouseleave', hideMenu);

                // Also support click toggle for better accessibility
                if (trigger) {
                    trigger.addEventListener('click', (e) => {
                        e.stopPropagation();
                        if (isMenuOpen) {
                            clearTimeout(hideTimer);
                            isMenuOpen = false;
                            menu.classList.add('opacity-0', 'translate-y-2', 'pointer-events-none');
                            menu.classList.remove('opacity-100', 'translate-y-0', 'pointer-events-auto');
                            if (chevron) chevron.style.transform = 'rotate(0deg)';
                        } else {
                            showMenu();
                        }
                    });
                }
            });

            // Close dropdown when clicking outside
            document.addEventListener('click', () => {
                document.querySelectorAll('.nav-dropdown-menu').forEach(menu => {
                    menu.classList.add('opacity-0', 'translate-y-2', 'pointer-events-none');
                    menu.classList.remove('opacity-100', 'translate-y-0', 'pointer-events-auto');
                });
                document.querySelectorAll('.nav-chevron').forEach(c => {
                    c.style.transform = 'rotate(0deg)';
                });
            });
        });
        window.navbarScriptInitialized = true;
    }
</script>
