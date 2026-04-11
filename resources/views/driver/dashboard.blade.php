<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>Driver Dashboard - Zidan Transport</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <style>
        body { 
            font-family: 'Montserrat', sans-serif; 
            -webkit-tap-highlight-color: transparent;
        }
        .glass-card {
            background: rgba(255, 255, 255, 0.9);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }
        @keyframes pulse-soft {
            0%, 100% { transform: scale(1); opacity: 1; }
            50% { transform: scale(1.05); opacity: 0.8; }
        }
        .animate-pulse-soft {
            animation: pulse-soft 2s infinite;
        }
    </style>
</head>
<body class="bg-gray-50 pb-24">

    <!-- Header / Navbar Overlay -->
    <div class="bg-gradient-to-r from-[#1a237e] to-[#0d1440] pt-8 pb-20 px-6 rounded-b-[40px] shadow-2xl relative overflow-hidden">
        <div class="absolute top-0 left-0 w-full h-full opacity-10 pointer-events-none">
            <i class="bi bi-geo-alt-fill absolute -right-10 -top-10 text-[200px] text-white"></i>
        </div>
        
        <div class="relative z-10 flex justify-between items-center mb-6">
            <div class="flex items-center gap-3">
                <div class="p-2 bg-white/80 rounded-xl backdrop-blur-sm shadow-sm">
                    <img src="{{ asset('images/logo.png') }}" class="h-8 w-auto" alt="Logo">
                </div>
                <div>
                <div>
                    <label class="relative inline-flex items-center cursor-pointer group">
                        <input type="checkbox" id="driver-status-toggle" class="sr-only peer" {{ (Auth::user()->driverProfile->status_driver ?? 'off') !== 'off' ? 'checked' : '' }} {{ $activeBooking ? 'disabled' : '' }}>
                        <div class="w-14 h-7 bg-gray-200 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-6 after:w-6 after:transition-all peer-checked:bg-green-500 shadow-inner group-active:scale-95 transition-transform"></div>
                        <span id="status-label" class="ms-3 text-[10px] font-black {{ (Auth::user()->driverProfile->status_driver ?? 'off') !== 'off' ? 'text-green-400' : 'text-gray-400' }} uppercase tracking-widest leading-none">
                            @php $driverStatus = Auth::user()->driverProfile->status_driver ?? 'off'; @endphp
                            {{ $driverStatus === 'on_duty' ? 'ON DUTY' : ($driverStatus === 'available' ? 'ONLINE' : 'OFFLINE') }}
                        </span>
                    </label>
                </div>
                </div>
            </div>
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="w-10 h-10 flex items-center justify-center bg-white/10 rounded-xl hover:bg-red-500/20 transition group">
                    <i class="bi bi-power text-xl text-white group-hover:text-red-400"></i>
                </button>
            </form>
        </div>

        <div class="relative z-10 flex items-center justify-between">
            <div class="flex items-center gap-4">
                <div class="relative">
                    <img src="{{ Auth::user()->foto_profil ? asset('storage/' . Auth::user()->foto_profil) : 'https://ui-avatars.com/api/?name='.urlencode(Auth::user()->name).'&background=fbc02d&color=1a237e&bold=true' }}" class="w-14 h-14 rounded-2xl border-2 border-white/20 shadow-lg object-cover">
                    <div class="absolute -bottom-1 -right-1 w-6 h-6 bg-green-500 border-4 border-[#1a237e] rounded-full"></div>
                </div>
                <div>
                    <h2 class="text-lg font-black text-white leading-tight">{{ Auth::user()->name }}</h2>
                    <div class="flex items-center gap-2 mt-0.5">
                        <p class="text-xs font-bold text-blue-200">#ZDN-DRV-{{ str_pad(Auth::user()->id, 4, '0', STR_PAD_LEFT) }}</p>
                        <span class="w-1 h-1 rounded-full bg-blue-300"></span>
                        <div class="flex items-center gap-1">
                            <i class="bi bi-star-fill text-[#fbc02d] text-[10px]"></i>
                            <span class="text-[10px] font-black text-white">{{ number_format(Auth::user()->averageRating(), 1) }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Quick Stats Cards (Overlap Header) -->
    <div class="px-6 -mt-12 mb-8 relative z-20">
        <div class="grid grid-cols-2 gap-4">
            <div class="glass-card p-5 rounded-3xl shadow-xl flex flex-col items-center text-center">
                <div class="w-10 h-10 bg-blue-50 text-[#1a237e] rounded-xl flex items-center justify-center mb-3">
                    <i class="bi bi-check2-circle text-xl"></i>
                </div>
                <p class="text-[10px] font-black text-gray-400 uppercase tracking-widest mb-1">Selesai</p>
                <p class="text-2xl font-black text-[#1a237e]">{{ $stats['total_completed'] }}</p>
            </div>
            <div class="glass-card p-5 rounded-3xl shadow-xl flex flex-col items-center text-center">
                <div class="w-10 h-10 bg-yellow-50 text-[#fbc02d] rounded-xl flex items-center justify-center mb-3">
                    <i class="bi bi-calendar-event text-xl"></i>
                </div>
                <p class="text-[10px] font-black text-gray-400 uppercase tracking-widest mb-1">Hari Ini</p>
                <p class="text-2xl font-black text-[#1a237e]">{{ $stats['today_jobs'] }}</p>
            </div>
        </div>
    </div>

    <!-- Active Task Section -->
    <main class="px-6 space-y-6">
        <div>
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-sm font-black text-[#1a237e] uppercase tracking-[0.2em]">Tugas Utama</h3>
                <span class="text-[10px] font-bold text-gray-400 px-3 py-1 bg-gray-100 rounded-full italic">Real-time update</span>
            </div>

            @if($activeBooking)
                <div class="bg-white rounded-[32px] p-6 shadow-xl border border-blue-50 relative overflow-hidden group">
                    <!-- Status Badge Floating -->
                    <div class="absolute top-4 right-4">
                        @if($activeBooking->status === 'on_trip')
                            <span class="px-3 py-1 bg-blue-100 text-blue-700 rounded-lg text-[10px] font-black uppercase tracking-widest animate-pulse-soft">DI JALAN</span>
                        @else
                            <span class="px-3 py-1 bg-yellow-100 text-[#f9a825] rounded-lg text-[10px] font-black uppercase tracking-widest">DIKONFIRMASI</span>
                        @endif
                    </div>

                    <div class="space-y-6">
                        <!-- Route Detail -->
                        <div class="flex items-start gap-4">
                            <div class="flex flex-col items-center pt-1">
                                <div class="w-4 h-4 rounded-full border-4 border-[#1a237e] bg-white"></div>
                                <div class="w-0.5 h-12 border-l-2 border-dashed border-gray-200 my-1"></div>
                                <div class="w-4 h-4 rounded-full bg-[#fbc02d] shadow-lg shadow-yellow-200"></div>
                            </div>
                            <div class="flex-1 space-y-6">
                                <div>
                                    <p class="text-[10px] font-black text-gray-400 uppercase tracking-widest mb-1">Titik Awal (Admin Base)</p>
                                    <h4 class="text-sm font-bold text-[#1a237e]">Zidan Transport Kediri</h4>
                                </div>
                                <div class="pt-2">
                                    <p class="text-[10px] font-black text-gray-400 uppercase tracking-widest mb-1">Tujuan Perjalanan</p>
                                    <p class="text-[9px] font-black text-blue-300 uppercase tracking-widest mb-0.5">{{ $activeBooking->rute->layanan->nama_layanan ?? '-' }}</p>
                                    <h4 class="text-sm font-black text-[#1a237e] uppercase tracking-tight">{{ $activeBooking->rute->nama_rute }}</h4>
                                </div>
                            </div>
                        </div>

                        <!-- Info Grid -->
                        <div class="grid grid-cols-2 gap-4 py-6 border-y border-gray-50">
                            <div>
                                <p class="text-[10px] font-black text-gray-400 uppercase tracking-widest mb-1">Pelanggan</p>
                                <p class="text-sm font-bold text-[#1a237e] truncate">{{ $activeBooking->user->name }}</p>
                                <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $activeBooking->user->no_hp) }}" class="inline-flex items-center gap-1 text-[10px] font-bold text-green-600 mt-1 hover:underline">
                                    <i class="bi bi-whatsapp"></i> Hubungi WA
                                </a>
                            </div>
                            <div class="text-right">
                                <p class="text-[10px] font-black text-gray-400 uppercase tracking-widest mb-1">Waktu Jemput</p>
                                <p class="text-sm font-black text-[#1a237e] leading-none">{{ $activeBooking->tanggal_berangkat->format('d M') }}</p>
                                <p class="text-[10px] font-bold text-[#fbc02d] mt-1">{{ \Carbon\Carbon::parse($activeBooking->waktu_jemput)->format('H:i') }} WIB</p>
                            </div>
                        </div>

                        <!-- Action Buttons -->
                        <div class="space-y-3">
                            @if($activeBooking->status === 'confirmed')
                                <form action="{{ route('driver.order.update-status', $activeBooking->id) }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="status" value="on_trip">
                                    <button type="submit" class="w-full bg-[#1a237e] text-white font-black py-4 rounded-2xl shadow-lg hover:bg-[#0d1440] transition uppercase tracking-widest text-[10px]">
                                        MULAI PERJALANAN SEKARANG
                                    </button>
                                </form>
                            @elseif($activeBooking->status === 'on_trip')
                                <form action="{{ route('driver.order.update-status', $activeBooking->id) }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="status" value="completed">
                                    <button type="submit" class="w-full bg-green-500 hover:bg-green-600 text-white font-black py-4 rounded-2xl shadow-xl shadow-green-900/20 transition flex items-center justify-center gap-2">
                                        <span>SELESAIKAN TUGAS</span>
                                        <i class="bi bi-check-all text-xl"></i>
                                    </button>
                                </form>
                            @endif
                        </div>
                    </div>
                </div>
            @else
                <div class="bg-white rounded-[32px] p-10 text-center shadow-lg border-2 border-dashed border-gray-100">
                    <div class="w-16 h-16 bg-gray-50 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="bi bi-clock-history text-3xl text-gray-300"></i>
                    </div>
                    <h4 class="text-sm font-bold text-gray-700 mb-1">Belum Ada Tugas Aktif</h4>
                    <p class="text-xs text-gray-400">Hubungi admin jika Anda merasa ada penugasan baru yang belum muncul.</p>
                </div>
            @endif
        </div>

        <!-- Notification Banner -->
        @if(session('success'))
            <div class="bg-green-500 text-white p-4 rounded-2xl shadow-lg border border-green-400 flex items-center gap-3 animate-bounce shadow-green-200">
                <i class="bi bi-check-circle-fill text-xl"></i>
                <p class="text-[11px] font-bold">{{ session('success') }}</p>
            </div>
        @endif
    </main>

    <!-- Bottom Navigation (Android Pixel Style) -->
    <div class="fixed bottom-6 left-6 right-6 z-50">
        <div class="bg-[#1a237e]/90 backdrop-blur-xl rounded-[24px] p-3 shadow-2xl border border-white/10 flex justify-between items-center">
            <a href="{{ route('driver.dashboard') }}" class="flex-1 flex flex-col items-center justify-center py-2 transition {{ Request::is('driver/dashboard') ? 'bg-white/10 rounded-2xl text-[#fbc02d]' : 'text-gray-400' }}">
                <i class="bi bi-grid-fill text-xl"></i>
                <span class="text-[9px] font-black mt-1 uppercase tracking-tighter">Beranda</span>
            </a>
            <a href="{{ route('driver.history') }}" class="flex-1 flex flex-col items-center justify-center py-2 transition {{ Request::is('driver/history') ? 'bg-white/10 rounded-2xl text-[#fbc02d]' : 'text-gray-400' }}">
                <i class="bi bi-journal-check text-xl"></i>
                <span class="text-[9px] font-black mt-1 uppercase tracking-tighter">Riwayat</span>
            </a>
            <a href="{{ route('driver.wallet') }}" class="flex-1 flex flex-col items-center justify-center py-2 transition {{ Request::is('driver/wallet') ? 'bg-white/10 rounded-2xl text-[#fbc02d]' : 'text-gray-400' }}">
                <i class="bi bi-wallet2 text-xl"></i>
                <span class="text-[9px] font-black mt-1 uppercase tracking-tighter">Dompet</span>
            </a>
            <a href="{{ route('profile.edit') }}" class="flex-1 flex flex-col items-center justify-center py-2 transition {{ Request::is('profile*') ? 'bg-white/10 rounded-2xl text-[#fbc02d]' : 'text-gray-400' }}">
                <i class="bi bi-person-fill text-xl"></i>
                <span class="text-[9px] font-black mt-1 uppercase tracking-tighter">Akun</span>
            </a>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        const statusToggle = document.getElementById('driver-status-toggle');
        const statusLabel = document.getElementById('status-label');

        statusToggle.addEventListener('change', async function() {
            const isOnline = this.checked;
            const newStatus = isOnline ? 'available' : 'off';
            
            try {
                const response = await fetch("{{ route('driver.status.update') }}", {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({ status: newStatus })
                });

                const result = await response.json();

                if (result.success) {
                    statusLabel.textContent = isOnline ? 'ONLINE' : 'OFFLINE';
                    statusLabel.className = `ms-3 text-[10px] font-black ${isOnline ? 'text-green-400' : 'text-gray-400'} uppercase tracking-widest leading-none`;
                    
                    const Toast = Swal.mixin({
                        toast: true,
                        position: 'top-end',
                        showConfirmButton: false,
                        timer: 3000,
                        timerProgressBar: true
                    });

                    Toast.fire({
                        icon: 'success',
                        title: result.message
                    });
                } else {
                    this.checked = !isOnline;
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: result.message,
                        customClass: {
                            popup: 'rounded-3xl',
                            confirmButton: 'rounded-xl bg-[#1a237e] px-8'
                        }
                    });
                }
            } catch (error) {
                this.checked = !isOnline;
                console.error('Error updating status:', error);
                Swal.fire({
                    icon: 'error',
                    title: 'Kesalahan Jaringan',
                    text: 'Gagal menghubungi server. Pastikan koneksi internet Anda stabil.',
                    customClass: {
                        popup: 'rounded-3xl',
                        confirmButton: 'rounded-xl bg-[#1a237e] px-8'
                    }
                });
            }
        });

        // Real-time Location Tracking Implementation
        if (navigator.geolocation) {
            function updateDriverLocation() {
                const driverStatus = "{{ Auth::user()->driverProfile->status_driver ?? 'off' }}";
                
                // Only track if Online or On Duty
                if (driverStatus === 'off') return;

                navigator.geolocation.getCurrentPosition(
                    function(position) {
                        const lat = position.coords.latitude;
                        const lng = position.coords.longitude;

                        fetch("{{ route('driver.location.update') }}", {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'Accept': 'application/json',
                                'X-CSRF-TOKEN': '{{ csrf_token() }}'
                            },
                            body: JSON.stringify({
                                latitude: lat,
                                longitude: lng
                            })
                        })
                        .then(response => response.json())
                        .then(data => console.log('Location updated:', data))
                        .catch(error => console.error('Location update failed:', error));
                    },
                    function(error) {
                        console.error('Geolocation error:', error.message);
                    },
                    {
                        enableHighAccuracy: true,
                        timeout: 5000,
                        maximumAge: 0
                    }
                );
            }

            // Update immediately on load
            updateDriverLocation();

            // Then every 60 seconds
            setInterval(updateDriverLocation, 60000);
        } else {
            console.error('Geolocation is not supported by this browser.');
        }
    </script>
</body>
</html>