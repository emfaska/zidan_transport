@extends('layouts.driver')

@section('title', 'Dashboard Driver')

@section('content')
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
                <p class="text-[10px] font-black text-gray-400 uppercase tracking-widest mb-1">Total Trip</p>
                <p class="text-2xl font-black text-[#1a237e]">{{ $stats['total_trips'] }}</p>
            </div>
        </div>
    </div>

    <!-- Main Content Sections -->
    <div class="px-6 space-y-8 animate-up">
        
        <!-- Pesanan Aktif Section -->
        <div>
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-xs font-black text-[#1a237e] uppercase tracking-widest">Tugas Saat Ini</h3>
                @if($activeBooking)
                    <span class="px-3 py-1 bg-indigo-100 text-[#1a237e] text-[8px] font-black rounded-full uppercase tracking-widest animate-pulse">Sedang Berjalan</span>
                @endif
            </div>

            @if($activeBooking)
            <div class="bg-white rounded-[32px] p-6 shadow-xl border border-blue-50 relative overflow-hidden group">
                <div class="absolute top-0 right-0 p-4">
                    <div class="w-12 h-12 bg-blue-50 rounded-2xl flex items-center justify-center text-blue-600">
                        <i class="bi bi-geo-alt-fill text-xl"></i>
                    </div>
                </div>
                
                <div class="mb-6">
                    <p class="text-[9px] font-black text-blue-400 uppercase tracking-widest mb-1">Kode Booking</p>
                    <h4 class="text-xl font-black text-[#1a237e] uppercase tracking-tighter">#{{ $activeBooking->kode_booking }}</h4>
                </div>

                <div class="relative pl-6 border-l-2 border-dashed border-gray-100 space-y-6 mb-8">
                    <div class="relative">
                        <div class="absolute -left-[31px] top-0 w-3 h-3 rounded-full bg-blue-500 border-2 border-white"></div>
                        <p class="text-[8px] font-black text-gray-400 uppercase tracking-widest mb-0.5">Penjemputan</p>
                        <p class="text-xs font-bold text-gray-700 uppercase">{{ $activeBooking->titik_jemput }}</p>
                    </div>
                    <div class="relative">
                        <div class="absolute -left-[31px] top-0 w-3 h-3 rounded-full bg-[#fbc02d] border-2 border-white"></div>
                        <p class="text-[8px] font-black text-gray-400 uppercase tracking-widest mb-0.5">Tujuan</p>
                        <p class="text-xs font-bold text-gray-700 uppercase">{{ $activeBooking->titik_tujuan }}</p>
                    </div>
                </div>

                <div class="flex items-center justify-between pt-6 border-t border-gray-50">
                    <div class="flex items-center gap-3">
                        <i class="bi bi-clock text-blue-500"></i>
                        <span class="text-xs font-black text-[#1a237e]">{{ $activeBooking->waktu_jemput->format('H:i') }} WIB</span>
                    </div>
                    <a href="{{ route('driver.order.show', $activeBooking->id) }}" class="px-6 py-3 bg-[#1a237e] text-white text-[10px] font-black rounded-2xl uppercase tracking-widest hover:bg-blue-900 transition shadow-lg shadow-blue-900/10">
                        Detail Tugas
                    </a>
                </div>
            </div>
            @else
            <div class="bg-white rounded-[32px] p-10 border-2 border-dashed border-gray-200 text-center">
                <div class="w-16 h-16 bg-gray-50 rounded-3xl flex items-center justify-center mx-auto mb-4 text-gray-300">
                    <i class="bi bi-inbox text-3xl"></i>
                </div>
                <h4 class="text-sm font-black text-gray-400 uppercase tracking-widest">Tidak Ada Tugas Aktif</h4>
                <p class="text-[10px] text-gray-300 mt-1 uppercase font-bold">Aktifkan status untuk menerima order</p>
            </div>
            @endif
        </div>

        <!-- Wallet / Earning Snapshot -->
        <div class="bg-gradient-to-br from-[#1a237e] to-blue-900 rounded-[40px] p-8 text-white shadow-2xl relative overflow-hidden group">
            <div class="absolute top-0 right-0 p-8 opacity-10 group-hover:scale-110 transition duration-700">
                <i class="bi bi-wallet2 text-8xl"></i>
            </div>
            <div class="relative z-10">
                <p class="text-[10px] font-black text-blue-300 uppercase tracking-[0.3em] mb-4">Saldo Dompet Driver</p>
                <h3 class="text-4xl font-black tracking-tighter mb-8">Rp {{ number_format(Auth::user()->driverWallet->balance ?? 0, 0, ',', '.') }}</h3>
                <div class="flex gap-3">
                    <a href="{{ route('driver.wallet.index') }}" class="flex-1 py-4 bg-white/10 hover:bg-white/20 rounded-2xl text-[9px] font-black uppercase tracking-widest text-center backdrop-blur-md transition">Riwayat Transaksi</a>
                    <a href="{{ route('driver.wallet.withdrawal') }}" class="flex-1 py-4 bg-[#fbc02d] hover:bg-yellow-500 rounded-2xl text-[9px] font-black uppercase tracking-widest text-[#1a237e] text-center transition shadow-lg shadow-yellow-500/20">Tarik Saldo</a>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        document.addEventListener('turbo:load', function() {
            const statusToggle = document.getElementById('driver-status-toggle');
            const statusLabel = document.getElementById('status-label');

            if (statusToggle) {
                statusToggle.onchange = function() {
                    const status = this.checked ? 'available' : 'off';
                    
                    // Show Loading
                    Swal.fire({
                        title: 'Mengupdate Status...',
                        allowOutsideClick: false,
                        didOpen: () => { Swal.showLoading(); }
                    });

                    fetch('{{ route("driver.status.update") }}', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                        },
                        body: JSON.stringify({ status: status })
                    })
                    .then(response => response.json())
                    .then(data => {
                        Swal.close();
                        if (data.success) {
                            statusLabel.innerText = status === 'available' ? 'ONLINE' : 'OFFLINE';
                            statusLabel.className = `ms-3 text-[10px] font-black ${status === 'available' ? 'text-green-400' : 'text-gray-400'} uppercase tracking-widest leading-none`;
                            
                            if (status === 'available') {
                                startLocationTracking();
                                Swal.fire({ icon: 'success', text: 'Anda sekarang Online', timer: 1500, showConfirmButton: false });
                            } else {
                                Swal.fire({ icon: 'info', text: 'Anda sekarang Offline', timer: 1500, showConfirmButton: false });
                            }
                        }
                    })
                    .catch(error => {
                        Swal.fire({ icon: 'error', text: 'Gagal mengupdate status' });
                        this.checked = !this.checked;
                    });
                };

                // Tracking Logic
                let trackingInterval;
                function startLocationTracking() {
                    if ("geolocation" in navigator) {
                        trackingInterval = setInterval(() => {
                            if (!statusToggle.checked) {
                                clearInterval(trackingInterval);
                                return;
                            }
                            navigator.geolocation.getCurrentPosition(position => {
                                fetch('{{ route("driver.location.update") }}', {
                                    method: 'POST',
                                    headers: {
                                        'Content-Type': 'application/json',
                                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                                    },
                                    body: JSON.stringify({
                                        latitude: position.coords.latitude,
                                        longitude: position.coords.longitude
                                    })
                                });
                            });
                        }, 30000); // 30 seconds
                    }
                }

                if (statusToggle.checked) startLocationTracking();

                // Stop tracking on page leave / turbo cache
                document.addEventListener('turbo:before-cache', () => {
                    if (trackingInterval) clearInterval(trackingInterval);
                }, { once: true });
            }
        });
    </script>
    
    @if(session('success'))
        <script>
            document.addEventListener('turbo:load', () => {
                Swal.fire({ icon: 'success', text: '{{ session("success") }}', timer: 3000, background: '#fff' });
            }, { once: true });
        </script>
    @endif
@endpush