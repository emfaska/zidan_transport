<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('images/favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('images/favicon-16x16.png') }}">
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('images/apple-touch-icon.png') }}">
    <title>@yield('title', 'Admin Dashboard') - Zidan Transport</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <!-- Hotwire Turbo -->
    <script src="https://cdn.jsdelivr.net/npm/@hotwired/turbo@8.0.4/dist/turbo.es2017-umd.min.js"></script>
</head>
<body class="bg-gray-50 font-sans text-gray-800 antialiased overflow-hidden">
    <style>
        .scrollbar-hide::-webkit-scrollbar { display: none; }
        .scrollbar-hide { -ms-overflow-style: none; scrollbar-width: none; }
        .scrollbar-thin::-webkit-scrollbar { width: 6px; height: 6px; }
        .scrollbar-thin::-webkit-scrollbar-track { background: transparent; }
        .scrollbar-thin::-webkit-scrollbar-thumb { background-color: #cbd5e1; border-radius: 20px; }
        .scrollbar-thin::-webkit-scrollbar-thumb:hover { background-color: #94a3b8; }
        
        .sidebar-scroll::-webkit-scrollbar { width: 4px; }
        .sidebar-scroll::-webkit-scrollbar-track { background: transparent; }
        .sidebar-scroll::-webkit-scrollbar-thumb { background-color: rgba(255, 255, 255, 0.1); border-radius: 10px; }
        .sidebar-scroll::-webkit-scrollbar-thumb:hover { background-color: rgba(255, 255, 255, 0.2); }
    </style>

    <div class="flex h-screen w-full">
        <!-- Sidebar -->
        <aside class="w-[260px] bg-gradient-to-b from-[#1a237e] via-[#1a237e] to-[#0d1440] flex flex-col flex-shrink-0 z-40 transition-all duration-300 shadow-[4px_0_24px_rgba(0,0,0,0.15)]">
            <!-- Logo area -->
            <div class="py-5 flex items-center justify-center border-b border-white/10 px-6 shrink-0 relative overflow-hidden">
                <div class="absolute inset-0 bg-white/5 opacity-50 blur-xl rounded-full scale-150 transform -translate-y-1/2"></div>
                <div class="flex flex-col items-center gap-2 relative z-10">
                    <div class="bg-white/90 backdrop-blur-sm p-2 rounded-full shadow-lg ring-2 ring-white/10">
                        <img src="{{ asset('images/logo.png') }}" class="h-7 w-auto">
                    </div>
                    <h1 class="text-[0.7rem] font-black text-white leading-none uppercase tracking-[0.15em] mt-1 text-center">Administrator</h1>
                </div>
            </div>
            
            <!-- Menu Items -->
            <nav class="flex-1 overflow-y-auto py-3 px-3 space-y-0.5 sidebar-scroll">
                <a href="{{ route('admin.dashboard') }}" class="group flex items-center space-x-3 py-[0.4rem] px-4 rounded-xl transition-all duration-300 {{ Request::is('admin/dashboard') ? 'bg-gradient-to-r from-[#fbc02d] to-[#f9a825] text-[#1a237e] shadow-lg scale-[1.02]' : 'text-blue-100/70 hover:bg-white/10 hover:text-white' }}">
                    <i class="bi bi-grid-fill text-[1rem] {{ Request::is('admin/dashboard') ? 'text-[#1a237e]' : 'text-blue-200/50 group-hover:text-blue-100' }}"></i>
                    <span class="text-[10px] font-bold uppercase tracking-wider">Dashboard</span>
                </a>
                
                @if(Auth::user()->role === 'admin')
                    <a href="{{ route('admin.armada.index') }}" class="group flex items-center space-x-3 py-[0.4rem] px-4 rounded-xl transition-all duration-300 {{ Request::is('admin/armada*') ? 'bg-gradient-to-r from-[#fbc02d] to-[#f9a825] text-[#1a237e] shadow-lg scale-[1.02]' : 'text-blue-100/70 hover:bg-white/10 hover:text-white' }}">
                        <i class="bi bi-car-front-fill text-[1rem] {{ Request::is('admin/armada*') ? 'text-[#1a237e]' : 'text-blue-200/50 group-hover:text-blue-100' }}"></i>
                        <span class="text-[10px] font-bold uppercase tracking-wider">Data Armada</span>
                    </a>
                    
                    <a href="{{ route('admin.layanan.index') }}" class="group flex items-center space-x-3 py-[0.4rem] px-4 rounded-xl transition-all duration-300 {{ Request::is('admin/layanan*') ? 'bg-gradient-to-r from-[#fbc02d] to-[#f9a825] text-[#1a237e] shadow-lg scale-[1.02]' : 'text-blue-100/70 hover:bg-white/10 hover:text-white' }}">
                        <i class="bi bi-layers-fill text-[1rem] {{ Request::is('admin/layanan*') ? 'text-[#1a237e]' : 'text-blue-200/50 group-hover:text-blue-100' }}"></i>
                        <span class="text-[10px] font-bold uppercase tracking-wider">Jenis Layanan</span>
                    </a>
                    
                    <a href="{{ route('admin.rute.index') }}" class="group flex items-center space-x-3 py-[0.4rem] px-4 rounded-xl transition-all duration-300 {{ Request::is('admin/rute*') ? 'bg-gradient-to-r from-[#fbc02d] to-[#f9a825] text-[#1a237e] shadow-lg scale-[1.02]' : 'text-blue-100/70 hover:bg-white/10 hover:text-white' }}">
                        <i class="bi bi-bezier2 text-[1rem] {{ Request::is('admin/rute*') ? 'text-[#1a237e]' : 'text-blue-200/50 group-hover:text-blue-100' }}"></i>
                        <span class="text-[10px] font-bold uppercase tracking-wider">Paket Rute</span>
                    </a>
                    
                    <a href="{{ route('admin.pelanggan.index') }}" class="group flex items-center space-x-3 py-[0.4rem] px-4 rounded-xl transition-all duration-300 {{ Request::is('admin/pelanggan*') ? 'bg-gradient-to-r from-[#fbc02d] to-[#f9a825] text-[#1a237e] shadow-lg scale-[1.02]' : 'text-blue-100/70 hover:bg-white/10 hover:text-white' }}">
                        <i class="bi bi-people-fill text-[1rem] {{ Request::is('admin/pelanggan*') ? 'text-[#1a237e]' : 'text-blue-200/50 group-hover:text-blue-100' }}"></i>
                        <span class="text-[10px] font-bold uppercase tracking-wider">Data Pelanggan</span>
                    </a>
                    
                    <a href="{{ route('admin.pengemudi.index') }}" class="group flex items-center space-x-3 py-[0.4rem] px-4 rounded-xl transition-all duration-300 {{ Request::is('admin/pengemudi*') ? 'bg-gradient-to-r from-[#fbc02d] to-[#f9a825] text-[#1a237e] shadow-lg scale-[1.02]' : 'text-blue-100/70 hover:bg-white/10 hover:text-white' }}">
                        <i class="bi bi-person-badge-fill text-[1rem] {{ Request::is('admin/pengemudi*') ? 'text-[#1a237e]' : 'text-blue-200/50 group-hover:text-blue-100' }}"></i>
                        <span class="text-[10px] font-bold uppercase tracking-wider">Data Pengemudi</span>
                    </a>
                    
                    <a href="{{ route('admin.booking.index') }}" class="group flex items-center space-x-3 py-[0.4rem] px-4 rounded-xl transition-all duration-300 {{ Request::is('admin/booking*') ? 'bg-gradient-to-r from-[#fbc02d] to-[#f9a825] text-[#1a237e] shadow-lg scale-[1.02]' : 'text-blue-100/70 hover:bg-white/10 hover:text-white' }}">
                        <i class="bi bi-journal-text text-[1rem] {{ Request::is('admin/booking*') ? 'text-[#1a237e]' : 'text-blue-200/50 group-hover:text-blue-100' }}"></i>
                        <span class="text-[10px] font-bold uppercase tracking-wider">Manajemen Pesanan</span>
                        @php $pendingExt = \App\Models\BookingExtension::where('status','pending')->count(); @endphp
                        @if($pendingExt > 0)
                            <span class="ml-auto text-[9px] font-black bg-[#1a237e] text-[#fbc02d] px-1.5 py-0.5 rounded-sm ring-1 ring-[#fbc02d]/50">{{ $pendingExt }}</span>
                        @endif
                    </a>
                    
                    <a href="{{ route('admin.refund.index') }}" class="group flex items-center space-x-3 py-[0.4rem] px-4 rounded-xl transition-all duration-300 {{ Request::is('admin/refunds*') ? 'bg-gradient-to-r from-[#fbc02d] to-[#f9a825] text-[#1a237e] shadow-lg scale-[1.02]' : 'text-blue-100/70 hover:bg-white/10 hover:text-white' }}">
                        <i class="bi bi-cash-stack text-[1rem] {{ Request::is('admin/refunds*') ? 'text-[#1a237e]' : 'text-blue-200/50 group-hover:text-blue-100' }}"></i>
                        <span class="text-[10px] font-bold uppercase tracking-wider">Manajemen Refund</span>
                        @php $pendingRefund = \App\Models\RefundRequest::where('status','pending')->count(); @endphp
                        @if($pendingRefund > 0)
                            <span class="ml-auto text-[9px] font-black bg-red-500 text-white px-1.5 py-0.5 rounded-sm">{{ $pendingRefund }}</span>
                        @endif
                    </a>
                    
                    <a href="{{ route('admin.promo.index') }}" class="group flex items-center space-x-3 py-[0.4rem] px-4 rounded-xl transition-all duration-300 {{ Request::is('admin/promo*') ? 'bg-gradient-to-r from-[#fbc02d] to-[#f9a825] text-[#1a237e] shadow-lg scale-[1.02]' : 'text-blue-100/70 hover:bg-white/10 hover:text-white' }}">
                        <i class="bi bi-tags-fill text-[1rem] {{ Request::is('admin/promo*') ? 'text-[#1a237e]' : 'text-blue-200/50 group-hover:text-blue-100' }}"></i>
                        <span class="text-[10px] font-bold uppercase tracking-wider">Kelola Promo</span>
                    </a>
                    
                    <a href="{{ route('admin.wallet.index') }}" class="group flex items-center space-x-3 py-[0.4rem] px-4 rounded-xl transition-all duration-300 {{ Request::is('admin/wallet*') ? 'bg-gradient-to-r from-[#fbc02d] to-[#f9a825] text-[#1a237e] shadow-lg scale-[1.02]' : 'text-blue-100/70 hover:bg-white/10 hover:text-white' }}">
                        <i class="bi bi-wallet-fill text-[1rem] {{ Request::is('admin/wallet*') ? 'text-[#1a237e]' : 'text-blue-200/50 group-hover:text-blue-100' }}"></i>
                        <span class="text-[10px] font-bold uppercase tracking-wider">Dompet Driver</span>
                        @php $pendingWd = \App\Models\WithdrawalRequest::where('status','pending')->count(); @endphp
                        @if($pendingWd > 0)
                            <span class="ml-auto text-[9px] font-black bg-red-500 text-white px-1.5 py-0.5 rounded-sm">{{ $pendingWd }}</span>
                        @endif
                    </a>
                    
                    <a href="{{ route('admin.report.index') }}" class="group flex items-center space-x-3 py-[0.4rem] px-4 rounded-xl transition-all duration-300 {{ Request::is('admin/reports*') ? 'bg-gradient-to-r from-[#fbc02d] to-[#f9a825] text-[#1a237e] shadow-lg scale-[1.02]' : 'text-blue-100/70 hover:bg-white/10 hover:text-white' }}">
                        <i class="bi bi-bar-chart-fill text-[1rem] {{ Request::is('admin/reports*') ? 'text-[#1a237e]' : 'text-blue-200/50 group-hover:text-blue-100' }}"></i>
                        <span class="text-[10px] font-bold uppercase tracking-wider">Laporan Bisnis</span>
                    </a>
                @elseif(Auth::user()->role === 'pelanggan')
                    <!-- Menu Pelanggan -->
                    <a href="{{ route('pelanggan.booking.create') }}" class="group flex items-center space-x-3 py-[0.4rem] px-4 rounded-xl transition-all duration-300 {{ Request::is('booking/create') ? 'bg-gradient-to-r from-[#fbc02d] to-[#f9a825] text-[#1a237e] shadow-lg scale-[1.02]' : 'text-blue-100/70 hover:bg-white/10 hover:text-white' }}">
                        <i class="bi bi-plus-circle-fill text-[1rem] {{ Request::is('booking/create') ? 'text-[#1a237e]' : 'text-blue-200/50 group-hover:text-blue-100' }}"></i>
                        <span class="text-[10px] font-bold uppercase tracking-wider">Pesan Sekarang</span>
                    </a>

                    <a href="{{ route('pelanggan.booking.index') }}" class="group flex items-center space-x-3 py-[0.4rem] px-4 rounded-xl transition-all duration-300 {{ Request::is('booking') ? 'bg-gradient-to-r from-[#fbc02d] to-[#f9a825] text-[#1a237e] shadow-lg scale-[1.02]' : 'text-blue-100/70 hover:bg-white/10 hover:text-white' }}">
                        <i class="bi bi-clock-history text-[1rem] {{ Request::is('booking') ? 'text-[#1a237e]' : 'text-blue-200/50 group-hover:text-blue-100' }}"></i>
                        <span class="text-[10px] font-bold uppercase tracking-wider">Riwayat Pesanan</span>
                    </a>

                    <a href="{{ route('pelanggan.armada') }}" class="group flex items-center space-x-3 py-[0.4rem] px-4 rounded-xl transition-all duration-300 {{ Request::is('armada*') ? 'bg-gradient-to-r from-[#fbc02d] to-[#f9a825] text-[#1a237e] shadow-lg scale-[1.02]' : 'text-blue-100/70 hover:bg-white/10 hover:text-white' }}">
                        <i class="bi bi-truck-front-fill text-[1rem] {{ Request::is('armada*') ? 'text-[#1a237e]' : 'text-blue-200/50 group-hover:text-blue-100' }}"></i>
                        <span class="text-[10px] font-bold uppercase tracking-wider">Daftar Armada</span>
                    </a>

                    <a href="{{ route('pelanggan.kontak') }}" class="group flex items-center space-x-3 py-[0.4rem] px-4 rounded-xl transition-all duration-300 {{ Request::is('kontak*') ? 'bg-gradient-to-r from-[#fbc02d] to-[#f9a825] text-[#1a237e] shadow-lg scale-[1.02]' : 'text-blue-100/70 hover:bg-white/10 hover:text-white' }}">
                        <i class="bi bi-headset text-[1rem] {{ Request::is('kontak*') ? 'text-[#1a237e]' : 'text-blue-200/50 group-hover:text-blue-100' }}"></i>
                        <span class="text-[10px] font-bold uppercase tracking-wider">Hubungi CS</span>
                    </a>
                @endif
            </nav>

            <!-- Bottom Section -->
            <div class="border-t border-white/10 p-3 space-y-1 bg-black/10 shrink-0 mt-auto">
                <a href="{{ route('profile.edit') }}" class="group flex items-center space-x-3 py-2 px-4 rounded-xl transition-colors {{ Request::is('profile*') ? 'bg-gradient-to-r from-[#fbc02d] to-[#f9a825] text-[#1a237e] shadow-lg' : 'text-blue-100/70 hover:bg-white/10 hover:text-white' }}">
                    <i class="bi bi-person-gear text-[1.1rem] {{ Request::is('profile*') ? 'text-[#1a237e]' : 'text-blue-200/50 group-hover:text-blue-100' }}"></i>
                    <span class="text-[10px] font-bold uppercase tracking-wider">Pengaturan Profil</span>
                </a>
                
                <form action="{{ route('logout') }}" method="POST" class="m-0 group">
                    @csrf
                    <button type="submit" class="flex items-center space-x-3 w-full py-2 px-4 rounded-xl transition-colors text-red-300 hover:bg-red-500/20 group-hover:text-red-200 border border-transparent hover:border-red-500/30">
                        <i class="bi bi-box-arrow-right text-[1.1rem]"></i>
                        <span class="text-[10px] font-bold uppercase tracking-wider">Keluar Sistem</span>
                    </button>
                </form>
            </div>
        </aside>

        <!-- Main Content Wrapper -->
        <div class="flex-1 flex flex-col min-w-0 bg-[#f4f6f9] overflow-hidden">
            <header class="bg-white shadow-[0_4px_24px_rgba(0,0,0,0.02)] h-20 px-8 flex justify-between items-center border-b border-gray-200/60 shrink-0 z-30">
                <div class="flex items-center gap-4">
                    <div class="w-1.5 h-6 bg-[#1a237e] rounded-[1px]"></div>
                    <div>
                        <h2 class="text-lg font-black text-[#1a237e] tracking-tight leading-none">@yield('header_title', 'Dashboard')</h2>
                        <p class="text-[10px] text-gray-500 font-bold uppercase tracking-widest mt-1">Panel Administrator</p>
                    </div>
                </div>
                <div class="flex items-center space-x-6">
                    <div class="text-right hidden sm:block">
                        <p class="text-[9px] font-bold text-gray-400 uppercase tracking-widest leading-none mb-1">Status Login</p>
                        <p class="text-[13px] font-black text-[#1a237e] tracking-tight">{{ Auth::user()->name }}</p>
                    </div>
                    
                    <!-- Avatar & Dropdown Container -->
                    <div class="relative group">
                        <!-- Avatar -->
                        <div class="relative cursor-pointer">
                            <div class="w-11 h-11 rounded-full bg-gray-200 overflow-hidden shadow-sm border-2 border-white ring-1 ring-gray-100 relative z-20 transition-transform duration-300 group-hover:scale-105">
                                <img src="{{ Auth::user()->foto_profil ? asset('storage/' . Auth::user()->foto_profil) : 'https://ui-avatars.com/api/?name='.urlencode(Auth::user()->name).'&background=1a237e&color=fff&bold=true' }}" 
                                     class="w-full h-full object-cover">
                            </div>
                            <div class="absolute bottom-0.5 right-0 w-3.5 h-3.5 bg-green-500 border-2 border-white rounded-full z-30"></div>
                        </div>

                        <!-- Invisible Bridge for pure css hover -->
                        <div class="absolute right-0 top-10 h-4 w-full z-10"></div>

                        <!-- Dropdown Menu -->
                        <div class="absolute right-0 top-[3.2rem] pt-2 w-56 opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-300 transform origin-top-right scale-95 group-hover:scale-100 z-50">
                            <div class="bg-white rounded-2xl shadow-[0_10px_40px_-10px_rgba(0,0,0,0.15)] border border-gray-100 overflow-hidden py-2 relative">
                                <div class="px-4 py-3 border-b border-gray-50/50 mb-1">
                                    <p class="text-[10px] font-bold text-gray-400 uppercase tracking-widest">Akun Aktif</p>
                                    <p class="text-xs font-black text-[#1a237e] truncate mt-0.5">{{ Auth::user()->name }}</p>
                                </div>
                                <a href="{{ route('admin.setting.index') }}" class="flex items-center space-x-3 px-5 py-2.5 text-xs font-bold text-gray-600 hover:bg-gray-50 hover:text-[#1a237e] transition-colors group/item">
                                    <div class="w-7 h-7 rounded-lg bg-gray-100 group-hover/item:bg-blue-50 flex items-center justify-center transition-colors">
                                        <i class="bi bi-diagram-3-fill text-gray-400 group-hover/item:text-[#1a237e]"></i>
                                    </div>
                                    <span>Pengaturan Pusat</span>
                                </a>
                                <a href="{{ route('admin.management.index') }}" class="flex items-center space-x-3 px-5 py-2.5 text-xs font-bold text-gray-600 hover:bg-gray-50 hover:text-[#1a237e] transition-colors group/item">
                                    <div class="w-7 h-7 rounded-lg bg-gray-100 group-hover/item:bg-blue-50 flex items-center justify-center transition-colors">
                                        <i class="bi bi-shield-lock-fill text-gray-400 group-hover/item:text-[#1a237e]"></i>
                                    </div>
                                    <span>Manajemen Admin</span>
                                </a>
                                
                                <div class="border-t border-gray-100 my-1.5 mx-4"></div>
                                
                                <form action="{{ route('logout') }}" method="POST" class="m-0">
                                    @csrf
                                    <button type="submit" class="flex w-full items-center space-x-3 px-5 py-2.5 text-xs font-bold text-red-500 hover:bg-red-50 hover:text-red-600 transition-colors group/item">
                                        <div class="w-7 h-7 rounded-lg bg-red-50/50 group-hover/item:bg-red-100 flex items-center justify-center transition-colors">
                                            <i class="bi bi-box-arrow-right"></i>
                                        </div>
                                        <span>Keluar Sistem</span>
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </header>

            <main class="flex-1 overflow-y-auto w-full p-6 lg:p-10 scrollbar-thin">
                @if(session('success'))
                    <div class="mb-8 p-4 bg-green-50 border-1 border-green-200 text-green-700 rounded-xl shadow-sm flex items-center gap-4 ring-1 ring-green-500/20">
                        <div class="w-10 h-10 rounded-full bg-green-100 flex items-center justify-center text-green-600 shrink-0">
                            <i class="bi bi-check2-circle text-xl"></i>
                        </div>
                        <div>
                            <p class="font-black text-[10px] uppercase tracking-widest leading-none mb-1 text-green-600">Berhasil</p>
                            <p class="font-bold text-sm">{{ session('success') }}</p>
                        </div>
                    </div>
                @endif

                @if(session('wa_success'))
                    <div class="mb-8 p-4 bg-blue-50 border-1 border-blue-200 text-blue-700 rounded-xl shadow-sm flex items-center gap-4 ring-1 ring-blue-500/20">
                        <div class="w-10 h-10 rounded-full bg-blue-100 flex items-center justify-center text-blue-600 shrink-0">
                            <i class="bi bi-whatsapp text-xl"></i>
                        </div>
                        <div>
                            <p class="font-black text-[10px] uppercase tracking-widest leading-none mb-1 text-blue-600">WhatsApp Terkirim</p>
                            <p class="font-bold text-sm">{{ session('wa_success') }}</p>
                        </div>
                    </div>
                @endif

                @if(session('error'))
                    <div class="mb-6 p-4 bg-red-50 border-1 border-red-200 text-red-700 rounded-xl shadow-sm flex items-center gap-4 ring-1 ring-red-500/20">
                        <div class="w-10 h-10 rounded-full bg-red-100 flex items-center justify-center text-red-600 shrink-0">
                            <i class="bi bi-exclamation-triangle-fill text-xl"></i>
                        </div>
                        <div>
                            <p class="font-black text-[10px] uppercase tracking-widest leading-none mb-1 text-red-600">Terjadi Kesalahan</p>
                            <p class="font-bold text-sm">{{ session('error') }}</p>
                        </div>
                    </div>
                @endif

                @yield('content')
            </main>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        // Global Currency Masking Logic
        function formatRupiah(number) {
            return new Intl.NumberFormat('id-ID').format(number);
        }

        function cleanNumber(value) {
            return value.replace(/\./g, '').replace(/,/g, '');
        }

        document.addEventListener('turbo:load', function() {
            // Re-bind listeners if necessary or initialize one-time components
        });

        document.addEventListener('input', function(e) {
            if (e.target.classList.contains('mask-currency')) {
                let cursorPosition = e.target.selectionStart;
                let originalLength = e.target.value.length;
                
                let value = e.target.value.replace(/\D/g, '');
                if (value === '') {
                    e.target.value = '';
                    return;
                }
                
                e.target.value = formatRupiah(value);
                
                // Maintain cursor position
                let newLength = e.target.value.length;
                e.target.setSelectionRange(cursorPosition + (newLength - originalLength), cursorPosition + (newLength - originalLength));
            }
        });

        // Ensure clean numbers are sent to the server
        document.addEventListener('submit', function(e) {
            const maskedInputs = e.target.querySelectorAll('.mask-currency');
            maskedInputs.forEach(input => {
                // We don't want to change the visual value right before submit if possible
                // but Laravel validation will fail if it's sent as "1.000.000"
                // So we'll append a hidden field with cleaned value or just clean the input
                // Cleaning the input is safest for simple forms
                input.value = cleanNumber(input.value);
            });
        });

        // Global Password Visibility Toggle
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

        // SweetAlert2 for Delete Confirmation
        function confirmDelete(id, title = 'Apakah Anda yakin?', text = "Data yang dihapus tidak dapat dikembalikan!") {
            Swal.fire({
                title: title,
                text: text,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Ya, Hapus!',
                cancelButtonText: 'Batal',
                background: '#fff',
                customClass: {
                    title: 'text-xl font-black text-[#1a237e]',
                    htmlContainer: 'text-sm font-medium text-gray-500',
                    popup: 'rounded-[32px] p-8',
                    confirmButton: 'rounded-xl font-bold px-8 py-3 text-xs uppercase tracking-widest',
                    cancelButton: 'rounded-xl font-bold px-8 py-3 text-xs uppercase tracking-widest'
                }
            }).then((result) => {
                if (result.isConfirmed) {
                    const form = document.getElementById('delete-form-' + id);
                    if (form) {
                        form.submit();
                    } else {
                        console.error('Delete form not found: delete-form-' + id);
                    }
                }
            })
        }

        // SweetAlert2 for General Confirmation (e.g., Approve)
        function confirmAction(id, actionUrl, title = 'Konfirmasi Tindakan', text = 'Apakah Anda yakin ingin melanjutkan?', icon = 'question', confirmText = 'Ya, Lanjutkan') {
             Swal.fire({
                title: title,
                text: text,
                icon: icon,
                showCancelButton: true,
                confirmButtonColor: '#1a237e',
                cancelButtonColor: '#64748b',
                confirmButtonText: confirmText,
                cancelButtonText: 'Batal',
                background: '#fff',
                customClass: {
                    title: 'text-xl font-black text-[#1a237e]',
                    htmlContainer: 'text-sm font-medium text-gray-500',
                    popup: 'rounded-[32px] p-8',
                    confirmButton: 'rounded-xl font-bold px-8 py-3 text-xs uppercase tracking-widest',
                    cancelButton: 'rounded-xl font-bold px-8 py-3 text-xs uppercase tracking-widest'
                }
            }).then((result) => {
                if (result.isConfirmed) {
                    let form = document.createElement('form');
                    form.method = 'POST';
                    form.action = actionUrl;
                    
                    let csrfToken = document.createElement('input');
                    csrfToken.type = 'hidden';
                    csrfToken.name = '_token';
                    csrfToken.value = '{{ csrf_token() }}';
                    form.appendChild(csrfToken);

                    let methodField = document.createElement('input');
                    methodField.type = 'hidden';
                    methodField.name = '_method';
                    methodField.value = 'PATCH'; 
                    form.appendChild(methodField);

                    document.body.appendChild(form);
                    form.submit();
                }
            })
        }

        // Global Confirmation Handler for Forms/Buttons
        document.addEventListener('submit', function(e) {
            const form = e.target;
            if (form.hasAttribute('data-confirm')) {
                e.preventDefault();
                const message = form.getAttribute('data-confirm');
                const title = form.getAttribute('data-title') || 'Konfirmasi';
                const type = form.getAttribute('data-type') || 'question';
                const confirmText = form.getAttribute('data-btn-text') || 'Ya, Lanjutkan';
                const confirmColor = form.getAttribute('data-btn-color') || '#1a237e';

                Swal.fire({
                    title: title,
                    text: message,
                    icon: type,
                    showCancelButton: true,
                    confirmButtonColor: confirmColor,
                    cancelButtonColor: '#64748b',
                    confirmButtonText: confirmText,
                    cancelButtonText: 'Batal',
                    background: '#fff',
                    customClass: {
                        title: 'text-xl font-black text-[#1a237e]',
                        htmlContainer: 'text-sm font-medium text-gray-500',
                        popup: 'rounded-[32px] p-8',
                        confirmButton: 'rounded-xl font-bold px-8 py-3 text-xs uppercase tracking-widest',
                        cancelButton: 'rounded-xl font-bold px-8 py-3 text-xs uppercase tracking-widest'
                    }
                }).then((result) => {
                    if (result.isConfirmed) {
                        // Temporarily disable the data-confirm to allow actual submission
                        form.removeAttribute('data-confirm');
                        form.submit();
                    }
                });
            }
        });

        // Clean up SweetAlert before Turbo caches the page to prevent "ghost" popups on back navigation
        document.addEventListener('turbo:before-cache', function() {
            if (typeof Swal !== 'undefined') {
                Swal.close();
            }
        });
    </script>
    @stack('scripts')
</body>
</html>
