<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Riwayat Pesanan - Zidan Transport</title>
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
                            <i class="bi bi-chevron-down text-gray-400 text-xs shadow-sm"></i>
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
                            <a href="{{ route('pelanggan.booking.index') }}" class="flex items-center gap-3 px-4 py-3 bg-blue-50 text-[#1a237e] font-bold border-r-4 border-[#1a237e]">
                                <i class="bi bi-clock-history"></i>
                                <span class="text-sm">Riwayat Pesanan</span>
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
        <div id="mobile-menu" class="hidden md:hidden bg-white border-t border-gray-100 p-4 animate-fade-in-down">
            <div class="space-y-2">
                <a href="{{ route('home') }}" class="flex items-center gap-3 p-4 rounded-2xl hover:bg-gray-50 text-[#1a237e] font-bold transition">
                    <i class="bi bi-house-door"></i> Beranda
                </a>
                <a href="{{ route('pelanggan.armada') }}" class="flex items-center gap-3 p-4 rounded-2xl hover:bg-gray-50 text-gray-600 font-bold transition">
                    <i class="bi bi-car-front"></i> Armada
                </a>
                <a href="{{ route('pelanggan.booking.index') }}" class="flex items-center gap-3 p-4 rounded-2xl bg-[#1a237e] text-white font-bold shadow-lg">
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

    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-28 pb-20">
        
        <!-- Page Header -->
        <div class="flex flex-col md:flex-row md:items-end justify-between gap-6 mb-12">
            <div>
                <div class="inline-flex items-center gap-2 px-3 py-1 bg-blue-100 border border-blue-200 rounded-full text-[#1a237e] text-[10px] font-black uppercase tracking-widest mb-4">
                    <i class="bi bi-calendar2-check-fill"></i> Aktivitas Perjalanan
                </div>
                <h1 class="text-4xl md:text-5xl font-black text-[#1a237e] tracking-tighter uppercase">Riwayat Pesanan</h1>
                <p class="text-gray-500 mt-2 font-medium">Pantau status dan detail seluruh perjalanan Anda bersama Zidan Transport.</p>
            </div>
            <a href="{{ route('pelanggan.booking.create') }}" class="inline-flex items-center px-10 py-4 bg-[#1a237e] text-white rounded-[25px] font-black uppercase tracking-widest text-xs shadow-xl shadow-blue-900/20 hover:bg-[#0d1440] hover:-translate-y-1 transition-all group">
                <i class="bi bi-plus-circle-fill mr-3 group-hover:rotate-90 transition duration-300"></i> Buat Pesanan Baru
            </a>
        </div>

        @if(session('success'))
        <div class="mb-8 p-4 bg-green-50 border border-green-100 text-green-700 rounded-3xl flex items-center gap-4 animate-bounce-short">
            <div class="w-10 h-10 rounded-full bg-green-500 flex items-center justify-center text-white shadow-lg">
                <i class="bi bi-check2"></i>
            </div>
            <p class="font-bold text-sm">{{ session('success') }}</p>
        </div>
        @endif

        <!-- Bookings List -->
        <div class="grid grid-cols-1 gap-6">
            @forelse($bookings as $booking)
            <div class="bg-white rounded-[40px] border border-gray-100 shadow-sm hover:shadow-2xl transition-all duration-500 group overflow-hidden">
                <div class="flex flex-col lg:flex-row">
                    <!-- Status Bar (Vertical on Desktop) -->
                    <div class="w-full lg:w-3 bg-gradient-to-down from-[#1a237e] to-[#fbc02d] opacity-0 group-hover:opacity-100 transition duration-500"></div>
                    
                    <div class="flex-grow p-8 md:p-10">
                        <div class="flex flex-wrap items-center justify-between gap-4 mb-8">
                            <div class="flex items-center gap-4">
                                <div class="w-14 h-14 rounded-2xl bg-blue-50 flex items-center justify-center text-[#1a237e] text-xl shadow-inner border border-blue-100/50">
                                    <i class="bi bi-ticket-perforated-fill"></i>
                                </div>
                                <div>
                                    <p class="text-[10px] text-gray-400 font-bold uppercase tracking-[0.2em] mb-1">Kode Booking</p>
                                    <h3 class="text-xl font-black text-[#1a237e] tracking-tight uppercase">{{ $booking->kode_booking }}</h3>
                                </div>
                            </div>

                            @php
                                $statusMeta = [
                                    'pending' => ['label' => 'Menunggu Konfirmasi', 'color' => 'bg-yellow-100 text-yellow-700 border-yellow-200', 'icon' => 'bi-hourglass-split'],
                                    'confirmed' => ['label' => 'Pesanan Dikonfirmasi', 'color' => 'bg-blue-100 text-blue-700 border-blue-200', 'icon' => 'bi-check2-all'],
                                    'on_trip' => ['label' => 'Dalam Perjalanan', 'color' => 'bg-indigo-100 text-indigo-700 border-indigo-200', 'icon' => 'bi-truck-flatbed'],
                                    'completed' => ['label' => 'Selesai', 'color' => 'bg-green-100 text-green-700 border-green-200', 'icon' => 'bi-stars'],
                                    'cancelled' => ['label' => 'Dibatalkan', 'color' => 'bg-red-100 text-red-700 border-red-200', 'icon' => 'bi-x-circle'],
                                ];
                                $current = $statusMeta[$booking->status] ?? ['label' => $booking->status, 'color' => 'bg-gray-100 text-gray-700 border-gray-200', 'icon' => 'bi-info-circle'];
                            @endphp
                            
                            <div class="px-5 py-2.5 rounded-full {{ $current['color'] }} border flex items-center gap-2 shadow-sm">
                                <i class="bi {{ $current['icon'] }} animate-pulse"></i>
                                <span class="text-[10px] font-black uppercase tracking-widest">{{ $current['label'] }}</span>
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                            <!-- Route Info -->
                            <div class="space-y-1">
                                <p class="text-[10px] text-gray-400 font-bold uppercase tracking-widest">Rute & Layanan</p>
                                <div class="flex flex-col">
                                    <span class="text-sm font-black text-[#1a237e] leading-tight break-words">{{ $booking->rute->nama_rute }}</span>
                                    <div class="flex items-center gap-2 mt-1">
                                        <span class="text-[10px] font-bold text-gray-500 uppercase">{{ $booking->jumlah_penumpang }} Orang</span>
                                        <span class="w-1 h-1 rounded-full bg-gray-300"></span>
                                        @if($booking->tipe_perjalanan === 'round_trip')
                                            <span class="text-[9px] font-black text-orange-600 uppercase tracking-tighter bg-orange-50 px-2 py-0.5 rounded-full border border-orange-100">Pulang Pergi</span>
                                        @else
                                            <span class="text-[9px] font-black text-blue-600 uppercase tracking-tighter bg-blue-50 px-2 py-0.5 rounded-full border border-blue-100">Sekali Jalan</span>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <!-- Schedule Info -->
                            <div class="space-y-1">
                                <p class="text-[10px] text-gray-400 font-bold uppercase tracking-widest">Keberangkatan</p>
                                <div class="flex items-center gap-3">
                                    <div class="flex flex-col">
                                        <span class="text-sm font-black text-gray-700">{{ $booking->tanggal_berangkat->format('d M Y') }}</span>
                                        <span class="text-[11px] font-bold text-[#1a237e] uppercase italic">Pukul {{ $booking->waktu_jemput->format('H:i') }} WIB</span>
                                    </div>
                                </div>
                            </div>

                            <!-- Payment Info -->
                            <div class="space-y-1">
                                <p class="text-[10px] text-gray-400 font-bold uppercase tracking-widest">Biaya Total</p>
                                <div class="flex flex-col">
                                    <span class="text-xl font-black text-[#1a237e] tracking-tighter">Rp {{ number_format($booking->total_harga, 0, ',', '.') }}</span>
                                    <span class="text-[10px] font-bold text-green-600 uppercase">Sudah Termasuk Driver & BBM</span>
                                </div>
                            </div>

                             <!-- Actions -->
                             <div class="flex flex-wrap items-center lg:justify-end gap-3">
                                 @if($booking->status === 'pending')
                                 <a href="https://wa.me/{{ \App\Models\Setting::get('contact_whatsapp', '6282142951682') }}?text={{ urlencode('Halo Admin Zidan Transport, saya ingin konfirmasi harga untuk pesanan ' . $booking->kode_booking . ' atas nama ' . Auth::user()->name) }}" target="_blank" class="px-6 py-3 bg-green-500 text-white rounded-2xl text-[10px] font-black uppercase tracking-widest hover:bg-green-600 transition-all shadow-lg flex items-center gap-2">
                                     <i class="bi bi-whatsapp"></i> Nego Harga
                                 </a>
                                 @endif
                                 @if($booking->status === 'confirmed' && $booking->status_pembayaran !== 'lunas')
                                 <a href="{{ route('pelanggan.booking.payment', $booking->id) }}" class="px-6 py-3 bg-[#1a237e] text-white rounded-2xl text-[10px] font-black uppercase tracking-widest hover:bg-blue-800 transition-all shadow-lg flex items-center gap-2">
                                     <i class="bi bi-wallet2"></i> Bayar Sekarang
                                 </a>
                                 @endif
                                 <a href="{{ route('pelanggan.booking.show', $booking->id) }}" class="px-6 py-3 bg-gray-50 border border-gray-100 rounded-2xl text-[10px] font-black text-[#1a237e] uppercase tracking-widest hover:bg-[#1a237e] hover:text-white transition-all shadow-sm">
                                     Detail
                                 </a>
                                 @if($booking->status === 'completed' && !$booking->review)
                                 <a href="{{ route('pelanggan.booking.show', $booking->id) }}#review" class="px-6 py-3 bg-yellow-400 text-[#1a237e] rounded-2xl text-[10px] font-black uppercase tracking-widest hover:bg-[#1a237e] hover:text-white transition-all shadow-lg animate-pulse-soft">
                                     Beri Review
                                 </a>
                                 @endif
                                 @if(in_array($booking->status, ['pending', 'confirmed']))
                                     @if($booking->jumlah_bayar > 0)
                                         @if(!$booking->refundRequest)
                                             <a href="{{ route('pelanggan.booking.refund', $booking->id) }}" class="px-6 py-3 bg-red-50 border border-red-100 rounded-2xl text-[10px] font-black text-red-500 uppercase tracking-widest hover:bg-red-500 hover:text-white transition-all shadow-sm">
                                                 Batalkan & Refund
                                             </a>
                                         @endif
                                     @else
                                         @if($booking->status === 'pending')
                                         <form action="{{ route('pelanggan.booking.destroy', $booking->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus pesanan ini?')">
                                             @csrf
                                             @method('DELETE')
                                             <button type="submit" class="px-6 py-3 bg-red-50 border border-red-100 rounded-2xl text-[10px] font-black text-red-500 uppercase tracking-widest hover:bg-red-500 hover:text-white transition-all shadow-sm">
                                                 Batal
                                             </button>
                                         </form>
                                         @endif
                                     @endif
                                 @endif

                                 @if($booking->status === 'cancelled' && $booking->refundRequest)
                                     @if($booking->refundRequest->status === 'pending')
                                         <span class="px-6 py-3 bg-orange-50 border border-orange-100 rounded-2xl text-[10px] font-black text-orange-500 uppercase tracking-widest shadow-sm">
                                             Refund Proses
                                         </span>
                                     @elseif($booking->refundRequest->status === 'processed')
                                         <a href="{{ route('pelanggan.booking.show', $booking->id) }}#refund-action" class="px-6 py-3 bg-blue-500 text-white rounded-2xl text-[10px] font-black uppercase tracking-widest hover:bg-blue-600 transition-all shadow-lg animate-pulse">
                                             Konfirmasi Dana
                                         </a>
                                     @elseif($booking->refundRequest->status === 'completed')
                                         <span class="px-6 py-3 bg-green-50 border border-green-100 rounded-2xl text-[10px] font-black text-green-600 uppercase tracking-widest shadow-sm">
                                             Refund Selesai
                                         </span>
                                     @elseif($booking->refundRequest->status === 'rejected')
                                         <span class="px-6 py-3 bg-red-50 border border-red-100 rounded-2xl text-[10px] font-black text-red-500 uppercase tracking-widest shadow-sm" title="{{ $booking->refundRequest->admin_note }}">
                                             Refund Ditolak
                                         </span>
                                     @endif
                                 @endif
                             </div>
                        </div>
                    </div>
                </div>
            </div>
            @empty
            <div class="py-24 bg-white rounded-[50px] border border-dashed border-gray-200 text-center shadow-inner">
                <div class="w-32 h-32 bg-blue-50 rounded-full flex items-center justify-center mx-auto mb-8 border border-blue-100">
                    <i class="bi bi-inbox text-5xl text-[#1a237e] opacity-30"></i>
                </div>
                <h3 class="text-2xl font-black text-[#1a237e] uppercase tracking-widest">Belum Ada Pesanan</h3>
                <p class="text-gray-400 mt-3 font-medium max-w-sm mx-auto">Anda belum memiliki riwayat perjalanan. Mari rencanakan perjalanan pertama Anda sekarang!</p>
                <div class="mt-10">
                    <a href="{{ route('pelanggan.booking.create') }}" class="px-10 py-4 bg-[#fbc02d] text-[#1a237e] font-black rounded-2xl shadow-xl shadow-yellow-500/20 uppercase tracking-widest text-xs hover:bg-yellow-500 transition-all">
                        Pesan Armada Sekarang
                    </a>
                </div>
            </div>
            @endforelse
        </div>

        @if($bookings->hasPages())
        <div class="mt-12 px-8 py-6 bg-white rounded-3xl shadow-sm border border-gray-100 overflow-hidden">
            {{ $bookings->links() }}
        </div>
        @endif
    </main>

    <!-- Footer Simple -->
    <footer class="bg-[#1a237e] py-8 text-center text-white/40 text-[10px] uppercase font-bold tracking-[0.3em]">
        &copy; {{ date('Y') }} Zidan Transport &bull; Solusi Perjalanan Premium Kediri
    </footer>

    <script>
        const mobileMenuBtn = document.getElementById('mobile-menu-btn');
        const mobileMenu = document.getElementById('mobile-menu');
        mobileMenuBtn.onclick = () => mobileMenu.classList.toggle('hidden');
    </script>
</body>
</html>
