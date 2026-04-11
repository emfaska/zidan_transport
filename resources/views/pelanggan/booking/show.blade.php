<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('images/favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('images/favicon-16x16.png') }}">
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('images/apple-touch-icon.png') }}">
    <title>Detail Pesanan #{{ $booking->kode_booking }} - Zidan Transport</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <style>
        body { font-family: 'Montserrat', sans-serif; }
        
        .modal { transition: opacity 0.25s ease; }
        body.modal-active { overflow-x: hidden; overflow-y: hidden !important; }
    </style>
    <!-- Leaflet.js for Real-time Tracking -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin=""/>
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>
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
                    <a href="{{ route('home') }}" class="text-gray-700 hover:text-[#1a237e] font-semibold transition">Beranda</a>
                    <a href="{{ route('pelanggan.armada') }}" class="text-gray-700 hover:text-[#1a237e] font-semibold transition">Armada</a>
                    <a href="{{ route('pelanggan.layanan') }}" class="text-gray-700 hover:text-[#1a237e] font-semibold transition">Layanan & Rute</a>
                    <a href="{{ route('pelanggan.kontak') }}" class="text-gray-700 hover:text-[#1a237e] font-semibold transition">Lokasi & Kontak</a>
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
                                <img src="{{ Auth::user()->foto_profil ? asset('storage/' . Auth::user()->foto_profil) : 'https://ui-avatars.com/api/?name='.urlencode(Auth::user()->name).'&background=1a237e&color=fff&bold=true' }}" class="w-full h-full object-cover">
                            </div>
                            <i class="bi bi-chevron-down text-gray-400 text-xs"></i>
                        </button>
                        <div class="dropdown-menu hidden absolute right-0 mt-2 w-56 bg-white rounded-2xl shadow-xl border border-gray-100 py-2 overflow-hidden">
                            <a href="{{ route('profile.edit') }}" class="flex items-center gap-3 px-4 py-3 hover:bg-blue-50 transition text-gray-700 font-bold"><i class="bi bi-person-circle"></i> Detail Profil</a>
                            <a href="{{ route('pelanggan.booking.index') }}" class="flex items-center gap-3 px-4 py-3 hover:bg-blue-50 transition text-[#1a237e] font-bold"><i class="bi bi-clock-history"></i> Riwayat Pesanan</a>
                            <form action="{{ route('logout') }}" method="POST" class="border-t border-gray-50">@csrf<button type="submit" class="w-full flex items-center gap-3 px-4 py-3 hover:bg-red-50 text-red-500 font-bold"><i class="bi bi-box-arrow-right"></i> Keluar</button></form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </nav>

    <main class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 pt-28 pb-20">
        <!-- Back Button -->
        <div class="mb-8">
            <a href="{{ route('pelanggan.booking.index') }}" class="inline-flex items-center gap-2 text-[#1a237e] font-black uppercase text-xs tracking-widest hover:translate-x-[-10px] transition-all">
                <i class="bi bi-arrow-left"></i> Kembali ke Riwayat
            </a>
        </div>

        <div class="bg-white rounded-[40px] shadow-2xl border border-gray-100 overflow-hidden relative">
            <div class="absolute top-0 left-0 w-full h-2 bg-gradient-to-r from-[#1a237e] via-[#fbc02d] to-[#1a237e]"></div>
            
            <div class="p-8 md:p-12">
                <!-- Header Detail -->
                <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-6 mb-12 border-b border-gray-50 pb-8">
                    <div>
                        <p class="text-[10px] text-gray-400 font-black uppercase tracking-[0.3em] mb-2">Detail Perjalanan #{{ $booking->kode_booking }}</p>
                        <h1 class="text-3xl font-black text-[#1a237e] tracking-tighter uppercase">{{ $booking->rute->nama_rute }}</h1>
                    </div>
                    
                    @php
                        $statusMeta = [
                            'pending' => ['label' => 'Menunggu Konfirmasi', 'color' => 'bg-yellow-100 text-yellow-700 border-yellow-200', 'icon' => 'bi-hourglass-split'],
                            'confirmed' => ['label' => 'Pesanan Dikonfirmasi', 'color' => 'bg-blue-100 text-blue-700 border-blue-200', 'icon' => 'bi-check2-all'],
                            'on_trip' => ['label' => 'Dalam Perjalanan', 'color' => 'bg-indigo-100 text-indigo-700 border-indigo-200', 'icon' => 'bi-truck-flatbed'],
                            'completed' => ['label' => 'Selesai', 'color' => 'bg-green-100 text-green-700 border-green-200', 'icon' => 'bi-stars'],
                            'cancelled' => ['label' => 'Dibatalkan', 'color' => 'bg-red-100 text-red-700 border-red-200', 'icon' => 'bi-x-circle'],
                        ];
                        $status = $statusMeta[$booking->status] ?? ['label' => $booking->status, 'color' => 'bg-gray-100 text-gray-700 border-gray-200', 'icon' => 'bi-info-circle'];
                    @endphp

                    <div class="flex flex-col items-end gap-3">
                        <div class="px-6 py-3 rounded-2xl {{ $status['color'] }} border flex items-center gap-3 shadow-md">
                            <i class="bi {{ $status['icon'] }} text-xl"></i>
                            <span class="text-xs font-black uppercase tracking-widest">{{ $status['label'] }}</span>
                        </div>

                        @if(in_array($booking->status, ['confirmed', 'on_trip', 'completed']))
                        <a href="{{ route('pelanggan.booking.invoice', $booking->id) }}" class="flex items-center gap-2 px-4 py-2 bg-red-50 text-red-600 rounded-xl text-[10px] font-black uppercase tracking-widest hover:bg-red-500 hover:text-white transition-all border border-red-100 shadow-sm">
                            <i class="bi bi-file-earmark-pdf-fill"></i> Cetak Bukti PDF
                        </a>
                        @endif
                    </div>
                </div>

                @if($booking->status === 'on_trip')
                <!-- Real-time Driver Tracking Map -->
                <div class="mb-12">
                    <div class="flex items-center justify-between mb-4 px-2">
                        <h4 class="text-[11px] font-black text-[#1a237e] uppercase tracking-[0.2em] flex items-center gap-2">
                            <i class="bi bi-geo-alt-fill text-blue-500 animate-bounce"></i> Pelacakan Driver (Real-time)
                        </h4>
                        <span class="text-[9px] font-bold text-green-600 bg-green-50 px-3 py-1 rounded-full border border-green-100 uppercase tracking-widest animate-pulse">
                            Live Update
                        </span>
                    </div>
                    <div id="trackingMap" class="w-full h-[400px] rounded-[35px] shadow-inner border border-gray-100 overflow-hidden z-10">
                        <!-- Map will be initialized here -->
                        <div class="w-full h-full flex items-center justify-center bg-gray-50 text-gray-400 italic text-sm">
                            <i class="bi bi-arrow-repeat animate-spin mr-2"></i> Menginisialisasi Peta...
                        </div>
                    </div>
                    <p class="mt-4 px-2 text-[10px] text-gray-500 font-medium italic">
                        *Posisi driver diperbarui secara otomatis setiap 30 detik. Akurasi bergantung pada GPS Driver.
                    </p>
                </div>
                @endif

                <div class="grid grid-cols-1 md:grid-cols-2 gap-12 mb-12">
                    <!-- Itinerary Secton -->
                    <div class="space-y-8">
                        <div>
                            <h4 class="text-[11px] font-black text-[#1a237e]/40 uppercase tracking-[0.2em] mb-4 flex items-center gap-2">
                                <i class="bi bi-geo-alt-fill"></i> Rute Perjalanan
                            </h4>
                            <div class="relative pl-8 border-l-2 border-dashed border-blue-100 space-y-8">
                                <div class="relative">
                                    <div class="absolute -left-[41px] top-0 w-4 h-4 rounded-full bg-blue-500 border-4 border-white shadow-md"></div>
                                    <p class="text-[9px] font-black text-gray-400 uppercase tracking-widest mb-1">Lokasi Penjemputan</p>
                                    <p class="text-sm font-bold text-[#1a237e] uppercase tracking-tight">{{ $booking->rute->lokasi_awal }}</p>
                                </div>
                                <div class="relative">
                                    <div class="absolute -left-[41px] top-0 w-4 h-4 rounded-full bg-[#fbc02d] border-4 border-white shadow-md"></div>
                                    <p class="text-[9px] font-black text-gray-400 uppercase tracking-widest mb-1">Destinasi Akhir</p>
                                    <p class="text-sm font-bold text-[#1a237e] uppercase tracking-tight">{{ $booking->rute->tujuan }}</p>
                                </div>
                            </div>
                        </div>

                        <div class="grid grid-cols-2 gap-6 pt-4">
                            <div>
                                <p class="text-[9px] font-black text-gray-400 uppercase tracking-widest mb-1">Tanggal</p>
                                <p class="text-sm font-black text-[#1a237e] italic">{{ $booking->tanggal_berangkat->format('d M Y') }}</p>
                            </div>
                            <div>
                                <p class="text-[9px] font-black text-gray-400 uppercase tracking-widest mb-1">Jam Penjemputan</p>
                                <p class="text-sm font-black text-[#1a237e] italic">{{ $booking->waktu_jemput->format('H:i') }} WIB</p>
                            </div>
                        </div>

                        <div>
                            <p class="text-[9px] font-black text-gray-400 uppercase tracking-widest mb-1">Tipe Perjalanan</p>
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-[10px] font-black uppercase tracking-tight {{ $booking->tipe_perjalanan === 'round_trip' ? 'bg-orange-50 text-orange-600 border border-orange-100' : 'bg-blue-50 text-blue-600 border border-blue-100' }}">
                                {{ $booking->tipe_perjalanan === 'round_trip' ? 'Pulang Pergi (PP)' : 'Sekali Jalan' }}
                            </span>
                        </div>
                    </div>

                    <!-- Fleet Section -->
                    <div class="bg-gray-50/50 rounded-[35px] p-8 border border-gray-100 group hover:bg-white hover:shadow-2xl transition-all duration-500">
                        <h4 class="text-[11px] font-black text-[#1a237e]/40 uppercase tracking-[0.2em] mb-6 flex items-center gap-2">
                            <i class="bi bi-car-front-fill"></i> Armada Perjalanan
                        </h4>
                        
                        <div class="w-full h-40 rounded-3xl overflow-hidden mb-6 border border-gray-100 shadow-inner">
                            @if($booking->armada && $booking->armada->foto)
                                <img src="{{ asset('storage/' . $booking->armada->foto) }}" class="w-full h-full object-cover">
                            @else
                                <div class="w-full h-full flex items-center justify-center bg-gray-100 text-gray-300 italic text-xs">Foto tidak tersedia</div>
                            @endif
                        </div>

                        <h3 class="text-xl font-black text-[#1a237e] tracking-tight uppercase">{{ $booking->armada->nama ?? 'Standar Zidan Trans' }}</h3>
                        <div class="flex items-center gap-4 mt-2">
                            <span class="text-[10px] font-bold text-gray-500 uppercase tracking-widest">{{ $booking->armada->jenis ?? 'Travel' }}</span>
                            <span class="w-1 h-1 rounded-full bg-gray-300"></span>
                            <span class="text-[10px] font-bold text-gray-500 uppercase tracking-widest">{{ $booking->armada->kapasitas ?? '14' }} Seat</span>
                        </div>

                        <div class="mt-6 pt-6 border-t border-gray-100 space-y-3">
                            <div class="flex items-center gap-3 text-xs font-bold text-green-600"><i class="bi bi-check-circle-fill"></i> Termasuk Bahan Bakar (BBM)</div>
                            <div class="flex items-center gap-3 text-xs font-bold text-green-600"><i class="bi bi-check-circle-fill"></i> Jasa Pengemudi Standar</div>
                        </div>
                    </div>
                </div>

                <!-- Price Breakdown -->
                <div class="bg-[#1a237e] rounded-[40px] p-8 md:p-12 text-white shadow-2xl relative overflow-hidden group">
                    <div class="absolute top-0 right-0 w-64 h-64 bg-white/5 rounded-full -translate-y-1/2 translate-x-1/2 blur-3xl"></div>
                    
                    <h4 class="text-[11px] font-black text-blue-200 uppercase tracking-[0.3em] mb-8 relative z-10">Rincian Pembayaran</h4>
                    
                    <div class="space-y-6 relative z-10">
                        <div class="flex justify-between items-center text-sm font-bold opacity-80">
                            <span>Harga Paket ({{ $booking->tipe_perjalanan === 'round_trip' ? 'PP' : 'Sekali Jalan' }})</span>
                            <span>Rp {{ number_format($booking->harga_paket, 0, ',', '.') }}</span>
                        </div>
                        
                        @if($booking->harga_tol > 0)
                        <div class="flex justify-between items-center text-sm font-bold opacity-80">
                            <span>Biaya Jalan Tol ({{ $booking->tipe_perjalanan === 'round_trip' ? 'Berangkat & Pulang' : 'Berangkat' }})</span>
                            <span>Rp {{ number_format($booking->harga_tol, 0, ',', '.') }}</span>
                        </div>
                        @endif

                        @if($booking->potongan_promo > 0)
                        <div class="flex justify-between items-center text-sm font-bold text-[#fbc02d]">
                            <span>Potongan Promo ({{ $booking->promo->judul ?? 'Diskon' }})</span>
                            <span>- Rp {{ number_format($booking->potongan_promo, 0, ',', '.') }}</span>
                        </div>
                        @endif

                        <div class="pt-6 border-t border-white/10 flex justify-between items-end">
                            <div>
                                <p class="text-[10px] font-black text-blue-300 uppercase tracking-[0.2em] mb-1">Total Biaya Perjalanan</p>
                                <h2 class="text-4xl font-black tracking-tighter text-[#fbc02d]">Rp {{ number_format($booking->total_akhir ?? $booking->total_harga, 0, ',', '.') }}</h2>
                            </div>
                            
                            <div class="text-right">
                                <p class="text-[10px] font-black text-blue-300 uppercase tracking-[0.2em] mb-1">Status Pembayaran</p>
                                @php
                                    $payoutMeta = [
                                        'belum_bayar' => ['label' => 'BELUM DIBAYAR', 'color' => 'text-red-400'],
                                        'dp_dibayar' => ['label' => 'DOWN PAYMENT (DP) PAID', 'color' => 'text-yellow-400'],
                                        'lunas' => ['label' => 'LUNAS', 'color' => 'text-green-400'],
                                    ];
                                    $pay = $payoutMeta[$booking->status_pembayaran] ?? ['label' => strtoupper($booking->status_pembayaran), 'color' => 'text-white'];
                                @endphp
                                <span class="text-xs font-black tracking-widest {{ $pay['color'] }}">{{ $pay['label'] }}</span>
                            </div>
                        </div>
                    </div>
                </div>

                @if($booking->catatan_customer)
                <div class="mt-12 p-8 bg-blue-50/50 rounded-[30px] border border-blue-100">
                    <h5 class="text-[10px] font-black text-[#1a237e] uppercase tracking-widest mb-4 flex items-center gap-2">
                        <i class="bi bi-sticky-fill"></i> Catatan Anda:
                    </h5>
                    <p class="text-xs font-medium text-gray-600 leading-relaxed italic">"{{ $booking->catatan_customer }}"</p>
                </div>
                @endif

                <!-- Extension Requests Section -->
                @if($booking->extensions->count() > 0)
                <div class="mt-12 space-y-6">
                    <h5 class="text-[10px] font-black text-[#1a237e] uppercase tracking-widest flex items-center gap-2">
                        <i class="bi bi-calendar-plus-fill"></i> Riwayat Perpanjangan:
                    </h5>
                    <div class="grid grid-cols-1 gap-4">
                        @foreach($booking->extensions as $ext)
                        <div class="p-6 bg-white border border-gray-100 rounded-3xl shadow-sm flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
                            <div>
                                <p class="text-[9px] font-black text-gray-400 uppercase tracking-widest mb-1">Pengajuan ke Tanggal Baru</p>
                                <p class="text-sm font-black text-[#1a237e]">{{ $ext->new_return_date->format('d M Y') }}</p>
                                <p class="text-[10px] text-gray-500 mt-1 italic">"{{ $ext->reason }}"</p>
                            </div>
                            
                            <div class="flex items-center gap-6">
                                <div class="text-right">
                                    <p class="text-[9px] font-black text-gray-400 uppercase tracking-widest mb-1">Status</p>
                                    @php
                                        $extStatus = [
                                            'pending' => ['label' => 'PENDING', 'color' => 'text-yellow-600 bg-yellow-50'],
                                            'approved' => ['label' => 'DISETUJUI', 'color' => 'text-green-600 bg-green-50'],
                                            'rejected' => ['label' => 'DITOLAK', 'color' => 'text-red-600 bg-red-50'],
                                            'paid' => ['label' => 'DIBAYAR', 'color' => 'text-blue-600 bg-blue-50'],
                                        ];
                                        $s = $extStatus[$ext->status] ?? ['label' => $ext->status, 'color' => 'text-gray-600 bg-gray-50'];
                                    @endphp
                                    <span class="px-3 py-1 rounded-full text-[9px] font-black {{ $s['color'] }}">{{ $s['label'] }}</span>
                                </div>
                                
                                @if($ext->status === 'approved')
                                <div class="flex flex-col md:flex-row items-end md:items-center gap-4">
                                    <div class="text-right">
                                        <p class="text-[9px] font-black text-gray-400 uppercase tracking-widest mb-1">Biaya Tambahan</p>
                                        <p class="text-xs font-black text-[#fbc02d]">Rp {{ number_format($ext->additional_price, 0, ',', '.') }}</p>
                                    </div>
                                    <div class="px-4 py-2 bg-blue-50 border border-blue-100 rounded-xl flex items-center gap-2 shadow-sm animate-pulse-short">
                                        <i class="bi bi-info-circle-fill text-blue-500 text-xs shadow-inner"></i>
                                        <p class="text-[9px] font-bold text-blue-700 leading-tight">
                                            Silakan bayar tunai ke <span class="uppercase">Driver</span> atau <span class="uppercase">Admin</span> secara langsung.
                                        </p>
                                    </div>
                                </div>
                                @endif
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
                @endif

                <!-- Review Section -->
                @if($booking->status === 'completed')
                    <div class="mt-12 pt-12 border-t border-gray-100">
                        @if($booking->review)
                            <div class="bg-gray-50 rounded-[40px] p-8 border border-gray-100 shadow-inner">
                                <h5 class="text-[10px] font-black text-[#1a237e] uppercase tracking-widest mb-6 flex items-center gap-2">
                                    <i class="bi bi-star-fill text-yellow-400"></i> Review Anda
                                </h5>
                                <div class="flex items-center gap-1 mb-4">
                                    @for($i = 1; $i <= 5; $i++)
                                        <i class="bi bi-star-fill {{ $i <= $booking->review->rating ? 'text-yellow-400' : 'text-gray-200' }} text-xl"></i>
                                    @endfor
                                </div>
                                <p class="text-sm font-medium text-gray-600 leading-relaxed italic">"{{ $booking->review->comment }}"</p>
                                <p class="text-[9px] text-gray-400 mt-4 uppercase font-bold tracking-widest">Terima kasih atas feedback Anda!</p>
                            </div>
                        @else
                            <div class="bg-gradient-to-br from-[#1a237e] to-blue-900 rounded-[40px] p-10 text-white shadow-2xl relative overflow-hidden group">
                                <div class="absolute -right-10 -bottom-10 w-40 h-40 bg-white/5 rounded-full blur-2xl"></div>
                                <div class="relative z-10">
                                    <h3 class="text-2xl font-black uppercase tracking-tighter mb-2">Bagaimana Perjalanan Anda?</h3>
                                    <p class="text-blue-200 text-xs font-medium mb-8">Bintang Anda sangat berarti untuk meningkatkan kualitas layanan driver kami.</p>

                                    <form action="{{ route('pelanggan.booking.review', $booking->id) }}" method="POST" class="space-y-6">
                                        @csrf
                                        <div class="flex items-center gap-2" id="star-rating">
                                            @for($i = 1; $i <= 5; $i++)
                                                <button type="button" data-value="{{ $i }}" class="star-btn text-3xl text-gray-400/50 hover:text-yellow-400 transition-colors">
                                                    <i class="bi bi-star-fill"></i>
                                                </button>
                                            @endfor
                                            <input type="hidden" name="rating" id="rating-input" required>
                                        </div>

                                        <div>
                                            <textarea name="comment" rows="3" class="w-full bg-white/10 border border-white/20 rounded-2xl py-4 px-6 text-white text-sm focus:ring-2 focus:ring-[#fbc02d] focus:border-[#fbc02d] outline-none transition placeholder-white/30" placeholder="Ceritakan pengalaman Anda berserta driver kami..."></textarea>
                                        </div>

                                        <button type="submit" class="w-full bg-[#fbc02d] text-[#1a237e] font-black py-4 rounded-2xl shadow-xl hover:bg-white transition-all uppercase tracking-widest text-xs">
                                            Kirim Review Sekarang
                                        </button>
                                    </form>
                                </div>
                            </div>

                            <script>
                                document.querySelectorAll('.star-btn').forEach(btn => {
                                    btn.addEventListener('click', function() {
                                        const val = this.dataset.value;
                                        document.getElementById('rating-input').value = val;
                                        
                                        document.querySelectorAll('.star-btn').forEach(s => {
                                            if (s.dataset.value <= val) {
                                                s.classList.remove('text-gray-400/50');
                                                s.classList.add('text-yellow-400');
                                            } else {
                                                s.classList.add('text-gray-400/50');
                                                s.classList.remove('text-yellow-400');
                                            }
                                        });
                                    });
                                });
                            </script>
                        @endif
                    </div>
                @endif

                <!-- Final Actions Bar -->
                <div class="mt-12 pt-12 border-t border-gray-100">
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
                        <!-- Primary Action (Payment/WA) -->
                        @if($booking->status === 'confirmed' && $booking->status_pembayaran !== 'lunas')
                            <a href="{{ route('pelanggan.booking.payment', $booking->id) }}" class="group flex flex-col items-center justify-center p-5 bg-[#1a237e] text-white rounded-[30px] shadow-xl hover:bg-blue-900 transition-all hover:-translate-y-1">
                                <i class="bi bi-wallet2 text-2xl mb-2 group-hover:scale-110 transition-transform"></i>
                                <span class="text-[10px] font-black uppercase tracking-[0.2em]">Bayar Sekarang</span>
                            </a>
                        @else
                            <a href="https://wa.me/6282142951682?text={{ urlencode('Halo Admin Zidan Transport, saya ingin bertanya tentang pesanan ' . $booking->kode_booking) }}" target="_blank" class="group flex flex-col items-center justify-center p-5 bg-green-500 text-white rounded-[30px] shadow-xl hover:bg-green-600 transition-all hover:-translate-y-1">
                                <i class="bi bi-whatsapp text-2xl mb-2 group-hover:scale-110 transition-transform"></i>
                                <span class="text-[10px] font-black uppercase tracking-[0.2em]">Hubungi Admin</span>
                            </a>
                        @endif

                        <!-- PDF Invoice -->
                        @if(in_array($booking->status, ['confirmed', 'on_trip', 'completed']))
                            <a href="{{ route('pelanggan.booking.invoice', $booking->id) }}" class="group flex flex-col items-center justify-center p-5 bg-blue-50 text-[#1a237e] border border-blue-100 rounded-[30px] shadow-sm hover:bg-[#1a237e] hover:text-white transition-all hover:-translate-y-1">
                                <i class="bi bi-file-earmark-pdf-fill text-2xl mb-2 group-hover:scale-110 transition-transform"></i>
                                <span class="text-[10px] font-black uppercase tracking-[0.2em] text-center">Cetak Bukti PDF</span>
                            </a>
                        @endif

                        <!-- Extension -->
                        @if(in_array($booking->status, ['confirmed', 'on_trip']))
                            <button type="button" onclick="document.getElementById('extensionModal').classList.remove('hidden')" class="group flex flex-col items-center justify-center p-5 bg-[#fbc02d] text-[#1a237e] rounded-[30px] shadow-xl hover:bg-yellow-500 transition-all hover:-translate-y-1">
                                <i class="bi bi-calendar-plus-fill text-2xl mb-2 group-hover:scale-110 transition-transform"></i>
                                <span class="text-[10px] font-black uppercase tracking-[0.2em]">Perpanjang</span>
                            </button>
                        @endif

                        <!-- Refund/Delete -->
                        @if(in_array($booking->status, ['pending', 'confirmed']))
                            @if($booking->jumlah_bayar > 0)
                                @if(!$booking->refundRequest)
                                    <a href="{{ route('pelanggan.booking.refund', $booking->id) }}" class="group flex flex-col items-center justify-center p-5 bg-red-50 text-red-500 border border-red-100 rounded-[30px] hover:bg-red-500 hover:text-white transition-all hover:-translate-y-1">
                                        <i class="bi bi-arrow-counterclockwise text-2xl mb-2 group-hover:rotate-[-45deg] transition-transform"></i>
                                        <span class="text-[10px] font-black uppercase tracking-[0.2em]">Batalkan</span>
                                    </a>
                                @endif
                            @else
                                @if($booking->status === 'pending')
                                <form action="{{ route('pelanggan.booking.destroy', $booking->id) }}" method="POST" class="contents" onsubmit="return confirm('Apakah Anda yakin ingin menghapus pesanan ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="group flex flex-col items-center justify-center p-5 bg-gray-50 text-gray-400 border border-gray-200 rounded-[30px] hover:bg-red-500 hover:text-white transition-all hover:-translate-y-1">
                                        <i class="bi bi-trash3-fill text-2xl mb-2 group-hover:scale-110 transition-transform"></i>
                                        <span class="text-[10px] font-black uppercase tracking-[0.2em]">Hapus</span>
                                    </button>
                                </form>
                                @endif
                            @endif
                        @endif
                    </div>
                </div>
            </div>
            
            @if($booking->refundRequest)
                <div id="refund-action" class="p-8 md:p-12 bg-gray-50 border-t border-gray-100 relative">
                    <h3 class="text-2xl font-black text-[#1a237e] tracking-tighter uppercase mb-6 flex items-center gap-3">
                        <i class="bi bi-arrow-counterclockwise text-red-500"></i> Detail Pengembalian Dana
                    </h3>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-8">
                        <div>
                            <p class="text-[10px] text-gray-400 font-bold uppercase tracking-widest mb-1">Status Refund</p>
                            @if($booking->refundRequest->status === 'pending')
                                <span class="inline-flex px-4 py-2 bg-orange-100 text-orange-600 font-black text-xs uppercase tracking-widest rounded-xl">Proses Admin</span>
                            @elseif($booking->refundRequest->status === 'processed')
                                <span class="inline-flex px-4 py-2 bg-blue-100 text-blue-600 font-black text-xs uppercase tracking-widest rounded-xl animate-pulse">Menunggu Konfirmasi Anda</span>
                            @elseif($booking->refundRequest->status === 'completed')
                                <span class="inline-flex px-4 py-2 bg-green-100 text-green-600 font-black text-xs uppercase tracking-widest rounded-xl">Selesai Berhasil</span>
                            @else
                                <span class="inline-flex px-4 py-2 bg-red-100 text-red-600 font-black text-xs uppercase tracking-widest rounded-xl">Ditolak</span>
                            @endif
                        </div>
                        <div>
                            <p class="text-[10px] text-gray-400 font-bold uppercase tracking-widest mb-1">Nominal Refund</p>
                            <p class="text-2xl font-black text-[#1a237e]">Rp {{ number_format($booking->refundRequest->amount, 0, ',', '.') }}</p>
                        </div>
                        <div class="md:col-span-2">
                            <p class="text-[10px] text-gray-400 font-bold uppercase tracking-widest mb-1">Rekening Tujuan</p>
                            <p class="text-sm font-bold text-gray-700">{{ $booking->refundRequest->bank_name }} - {{ $booking->refundRequest->account_number }} (a.n {{ $booking->refundRequest->account_name }})</p>
                        </div>
                    </div>

                    @if($booking->refundRequest->status === 'processed')
                        <div class="bg-blue-50 border border-blue-100 rounded-3xl p-8 text-center mt-8 shadow-inner">
                            <div class="w-16 h-16 bg-blue-100 text-blue-500 rounded-full flex items-center justify-center mx-auto mb-4 border border-blue-200">
                                <i class="bi bi-info-circle text-3xl"></i>
                            </div>
                            <h4 class="text-lg font-black text-[#1a237e] uppercase mb-2">Dana Telah Dikirim</h4>
                            <p class="text-xs text-blue-800 font-medium mb-8 max-w-lg mx-auto leading-relaxed">Admin Zidan Transport telah mengirimkan dana refund Anda. Silakan cek mutasi rekening Anda, dan konfirmasi dengan mengupload tangkapan layar / bukti transfer masuk.</p>
                            
                            <form action="{{ route('pelanggan.booking.refund.confirm', $booking->id) }}" method="POST" enctype="multipart/form-data" class="max-w-md mx-auto text-left bg-white p-6 rounded-2xl shadow-sm border border-blue-50">
                                @csrf
                                <div class="mb-6">
                                    <label class="block text-[10px] font-black text-[#1a237e] uppercase tracking-widest mb-3">Upload Bukti Penerimaan (Mutasi/SS)</label>
                                    <input type="file" name="bukti_penerimaan" required accept="image/*" class="w-full bg-gray-50 border border-gray-200 rounded-xl p-3 text-xs focus:outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-100 transition-all">
                                </div>
                                <button type="submit" class="w-full bg-[#1a237e] hover:bg-blue-800 text-white font-black py-4 rounded-xl uppercase tracking-widest text-[10px] shadow-lg hover:-translate-y-1 transition duration-300">
                                    Kirim & Konfirmasi Selesai
                                </button>
                            </form>
                        </div>
                    @elseif($booking->refundRequest->status === 'completed')
                        <div class="mt-8 p-6 bg-green-50 border border-green-100 rounded-2xl flex flex-col md:flex-row items-center justify-between gap-4">
                            <div class="flex items-center gap-3">
                                <div class="w-10 h-10 bg-green-500 text-white rounded-full flex items-center justify-center shadow-md">
                                    <i class="bi bi-check-lg text-xl"></i>
                                </div>
                                <p class="text-xs font-bold text-green-700">Proses pengembalian dana telah selesai.</p>
                            </div>
                            @if($booking->refundRequest->bukti_penerimaan)
                            <a href="{{ asset('storage/' . $booking->refundRequest->bukti_penerimaan) }}" target="_blank" class="px-6 py-3 bg-white border border-gray-200 text-gray-700 rounded-xl text-[10px] font-black uppercase tracking-widest hover:bg-gray-50 transition shadow-sm flex items-center gap-2">
                                <i class="bi bi-image"></i> Lihat Bukti Anda
                            </a>
                            @endif
                        </div>
                    @elseif($booking->refundRequest->status === 'rejected')
                        <div class="mt-8 p-6 bg-red-50 border border-red-100 rounded-2xl flex items-start gap-4">
                            <i class="bi bi-exclamation-triangle-fill text-red-500 text-xl"></i>
                            <div>
                                <h4 class="text-xs font-black text-red-700 uppercase tracking-widest mb-1">Ditolak Admin</h4>
                                <p class="text-xs text-red-600 font-medium">Alasan: {{ $booking->refundRequest->admin_note }}</p>
                            </div>
                        </div>
                    @endif
                </div>
            @endif
        </div>
    </main>

    <footer class="bg-[#1a237e] py-10 text-center text-white/30 text-[10px] uppercase font-black tracking-[0.4em]">
        &copy; {{ date('Y') }} Zidan Transport &bull; Solusi Perjalanan Premium Kediri
    </footer>

    <!-- Extension Modal -->
    <div id="extensionModal" class="hidden fixed inset-0 z-[60] overflow-y-auto">
        <div class="flex items-center justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:block sm:p-0">
            <div class="fixed inset-0 transition-opacity" aria-hidden="true" onclick="document.getElementById('extensionModal').classList.add('hidden')">
                <div class="absolute inset-0 bg-gray-900 opacity-75 backdrop-blur-sm"></div>
            </div>
            <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
            <div class="inline-block align-bottom bg-white rounded-[40px] text-left overflow-hidden shadow-2xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full border border-gray-100">
                <div class="p-8 md:p-12">
                    <div class="flex justify-between items-center mb-8">
                        <div>
                            <p class="text-[10px] text-[#fbc02d] font-black uppercase tracking-widest mb-1">Charter Extension</p>
                            <h3 class="text-2xl font-black text-[#1a237e] tracking-tighter uppercase">Perpanjang Waktu</h3>
                        </div>
                        <button onclick="document.getElementById('extensionModal').classList.add('hidden')" class="w-10 h-10 rounded-full bg-gray-50 flex items-center justify-center text-gray-400 hover:bg-red-50 hover:text-red-500 transition-all">
                            <i class="bi bi-x-lg"></i>
                        </button>
                    </div>

                    <form action="{{ route('pelanggan.booking.extension', $booking->id) }}" method="POST" class="space-y-6">
                        @csrf
                        <div>
                            <label class="block text-[10px] font-black text-gray-400 uppercase tracking-widest mb-2">Hingga Tanggal Berapa?</label>
                            <input type="date" name="new_return_date" required min="{{ $booking->tanggal_berangkat->addDay()->format('Y-m-d') }}" class="w-full bg-gray-50 border border-gray-100 rounded-2xl py-4 px-6 text-sm font-bold text-[#1a237e] focus:ring-2 focus:ring-[#fbc02d] focus:border-[#fbc02d] transition-all outline-none">
                            <p class="text-[9px] text-gray-400 mt-2 font-medium italic">*Tanggal harus setelah jadwal keberangkatan saat ini.</p>
                        </div>

                        <div>
                            <label class="block text-[10px] font-black text-gray-400 uppercase tracking-widest mb-2">Alasan Perpanjangan</label>
                            <textarea name="reason" rows="3" required class="w-full bg-gray-50 border border-gray-100 rounded-2xl py-4 px-6 text-sm font-medium text-gray-700 focus:ring-2 focus:ring-[#fbc02d] focus:border-[#fbc02d] transition-all outline-none resize-none" placeholder="Contoh: Menambah jadwal kunjungan di lokasi..."></textarea>
                        </div>

                        <div class="bg-blue-50/50 p-6 rounded-3xl border border-blue-100 flex gap-4">
                            <i class="bi bi-info-circle-fill text-blue-500 text-lg"></i>
                            <p class="text-[10px] text-blue-800 font-bold leading-relaxed uppercase tracking-widest">Admin akan meninjau ketersediaan armada dan menentukan biaya tambahan untuk perpanjangan ini.</p>
                        </div>

                        <button type="submit" class="w-full py-5 bg-[#1a237e] text-white rounded-2xl font-black uppercase tracking-widest shadow-xl hover:bg-blue-900 transition-all hover:-translate-y-1">
                            KIRIM PENGAJUAN SEKARANG
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @if($booking->status === 'on_trip')
    <script>
        let map;
        let driverMarker;
        const bookingId = "{{ $booking->id }}";
        
        function initMap() {
            // Default center if no coordinates yet (Indonesia/Kediri center approx)
            const kediriCenter = [-7.8228, 112.0119];
            
            map = L.map('trackingMap').setView(kediriCenter, 13);
            
            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
            }).addTo(map);

            // Custom Icon for Driver
            const driverIcon = L.icon({
                iconUrl: 'https://cdn-icons-png.flaticon.com/512/3202/3202926.png', // Taxi/Car icon
                iconSize: [40, 40],
                iconAnchor: [20, 20],
                popupAnchor: [0, -20]
            });

            driverMarker = L.marker(kediriCenter, {icon: driverIcon}).addTo(map)
                .bindPopup("<b>Driver Zidan Transport</b><br>Sedang dalam perjalanan.")
                .openPopup();
            
            // Start polling
            updateMapPosition();
            setInterval(updateMapPosition, 30000); // Every 30 seconds
        }

        function updateMapPosition() {
            fetch(`/booking/${bookingId}/location`)
                .then(response => response.json())
                .then(data => {
                    if (data.latitude && data.longitude) {
                        const newPos = [data.latitude, data.longitude];
                        driverMarker.setLatLng(newPos);
                        map.panTo(newPos);
                        
                        if (data.driver_name) {
                            driverMarker.getPopup().setContent(`<b>Driver: ${data.driver_name}</b><br>Lokasi Terkini.`);
                        }
                    }
                })
                .catch(error => console.error('Error fetching location:', error));
        }

        // Initialize map when DOM is loaded
        document.addEventListener('DOMContentLoaded', initMap);
    </script>
    @endif

</body>
</html>
