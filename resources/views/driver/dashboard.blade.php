@extends('layouts.driver')

@section('title', 'Dashboard Driver')

@section('content')
    <!-- Header / Navbar Overlay (Mobile Optimized) -->
    <div class="bg-gradient-to-r from-[#1a237e] to-[#0d1440] pt-6 pb-24 px-5 rounded-b-[48px] shadow-2xl relative overflow-hidden">
        <div class="absolute top-0 left-0 w-full h-full opacity-10 pointer-events-none">
            <i class="bi bi-geo-alt-fill absolute -right-10 -top-10 text-[180px] text-white"></i>
        </div>
        
        <div class="relative z-10 flex justify-between items-center mb-8">
            <div class="flex items-center gap-3">
                <div class="p-2 bg-white/90 rounded-2xl backdrop-blur-md shadow-sm">
                    <img src="{{ asset('images/logo.png') }}" class="h-7 w-auto" alt="Logo">
                </div>
                <!-- Status Toggle (Professional Look) -->
                <label class="relative inline-flex items-center cursor-pointer group">
                    <input type="checkbox" id="driver-status-toggle" class="sr-only peer" {{ (Auth::user()->driverProfile->status_driver ?? 'off') !== 'off' ? 'checked' : '' }} {{ $activeBooking ? 'disabled' : '' }}>
                    <div class="w-12 h-6 bg-white/20 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:bg-white after:border-white after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-green-500 shadow-inner group-active:scale-95 transition-transform"></div>
                    <span id="status-label" class="ms-3 text-[9px] font-black {{ (Auth::user()->driverProfile->status_driver ?? 'off') !== 'off' ? 'text-green-400' : 'text-gray-400' }} uppercase tracking-[0.2em]">
                        @php $driverStatus = Auth::user()->driverProfile->status_driver ?? 'off'; @endphp
                        {{ $driverStatus === 'on_duty' ? 'ON DUTY' : ($driverStatus === 'available' ? 'ONLINE' : 'OFFLINE') }}
                    </span>
                </label>
            </div>
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="w-10 h-10 flex items-center justify-center bg-white/10 rounded-2xl hover:bg-red-500/30 transition group">
                    <i class="bi bi-power text-xl text-white group-hover:text-red-400"></i>
                </button>
            </form>
        </div>

        <!-- Profile Section -->
        <div class="relative z-10 flex items-center gap-4">
            <div class="relative">
                <img src="{{ Auth::user()->foto_profil ? asset('storage/' . Auth::user()->foto_profil) : 'https://ui-avatars.com/api/?name='.urlencode(Auth::user()->name).'&background=fbc02d&color=1a237e&bold=true' }}" class="w-14 h-14 rounded-[20px] border-2 border-white/20 shadow-xl object-cover">
                <div class="absolute -bottom-1 -right-1 w-5 h-5 bg-green-500 border-4 border-[#1a237e] rounded-full"></div>
            </div>
            <div>
                <h2 class="text-lg font-black text-white leading-tight uppercase tracking-tight">{{ Auth::user()->name }}</h2>
                <div class="flex items-center gap-2 mt-1">
                    <p class="text-[10px] font-black text-blue-200/70 uppercase tracking-widest">Driver #{{ str_pad(Auth::user()->id, 4, '0', STR_PAD_LEFT) }}</p>
                    <span class="w-1 h-1 rounded-full bg-blue-300/30"></span>
                    <div class="flex items-center gap-1">
                        <i class="bi bi-star-fill text-[#fbc02d] text-[10px]"></i>
                        <span class="text-[10px] font-black text-white">{{ number_format(Auth::user()->averageRating(), 1) }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Quick Stats Cards (Overlap Header) -->
    <div class="px-5 -mt-10 mb-8 relative z-20">
        <div class="grid grid-cols-2 gap-4">
            <div class="bg-white/90 backdrop-blur-md p-5 rounded-[28px] shadow-xl border border-white/50 flex flex-col items-center text-center">
                <div class="w-10 h-10 bg-blue-50 text-[#1a237e] rounded-xl flex items-center justify-center mb-2">
                    <i class="bi bi-check-lg text-lg"></i>
                </div>
                <p class="text-[9px] font-black text-gray-400 uppercase tracking-widest">Selesai</p>
                <p class="text-xl font-black text-[#1a237e]">{{ $stats['total_completed'] }}</p>
            </div>
            <div class="bg-white/90 backdrop-blur-md p-5 rounded-[28px] shadow-xl border border-white/50 flex flex-col items-center text-center">
                <div class="w-10 h-10 bg-yellow-50 text-[#fbc02d] rounded-xl flex items-center justify-center mb-2">
                    <i class="bi bi-map text-lg"></i>
                </div>
                <p class="text-[9px] font-black text-gray-400 uppercase tracking-widest">Total Trip</p>
                <p class="text-xl font-black text-[#1a237e]">{{ $stats['total_trips'] }}</p>
            </div>
        </div>
    </div>

    <!-- Main Content Sections -->
    <div class="px-5 pb-10 space-y-8">
        
        <!-- Pesanan Aktif Section -->
        <div>
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-[10px] font-black text-[#1a237e] uppercase tracking-[0.2em] ml-2">Tugas Berjalan</h3>
                @if($activeBooking)
                    <span class="px-3 py-1 bg-green-100 text-green-600 text-[8px] font-black rounded-full uppercase tracking-widest">On Trip</span>
                @endif
            </div>

            @if($activeBooking)
            <div class="bg-white rounded-[32px] p-6 shadow-xl border border-blue-50/50 relative overflow-hidden">
                <div class="absolute top-0 right-0 p-6 opacity-10">
                    <i class="bi bi-geo-alt-fill text-6xl text-[#1a237e]"></i>
                </div>
                
                <div class="mb-6">
                    <p class="text-[8px] font-black text-gray-400 uppercase tracking-widest mb-1">ID Booking</p>
                    <h4 class="text-xl font-black text-[#1a237e] tracking-tight">#{{ $activeBooking->kode_booking }}</h4>
                </div>

                <div class="space-y-4 mb-8">
                    <div class="flex gap-4">
                        <div class="flex flex-col items-center gap-1 mt-1">
                            <div class="w-2.5 h-2.5 rounded-full bg-blue-500 border-2 border-white shadow-sm shadow-blue-500/50"></div>
                            <div class="w-0.5 h-full bg-gray-100 border-l border-dashed border-gray-200"></div>
                        </div>
                        <div>
                            <p class="text-[8px] font-black text-gray-300 uppercase tracking-widest">Titik Jemput</p>
                            <p class="text-xs font-bold text-gray-700 uppercase leading-tight mt-0.5">{{ $activeBooking->titik_jemput }}</p>
                        </div>
                    </div>
                    <div class="flex gap-4">
                        <div class="flex flex-col items-center">
                            <div class="w-2.5 h-2.5 rounded-full bg-[#fbc02d] border-2 border-white shadow-sm shadow-yellow-500/50"></div>
                        </div>
                        <div>
                            <p class="text-[8px] font-black text-gray-300 uppercase tracking-widest">Lokasi Tujuan</p>
                            <p class="text-xs font-bold text-gray-700 uppercase leading-tight mt-0.5">{{ $activeBooking->titik_tujuan }}</p>
                        </div>
                    </div>
                </div>

                <div class="flex items-center justify-between pt-6 border-t border-gray-50">
                    <div class="flex items-center gap-2">
                        <i class="bi bi-clock-fill text-[#1a237e]"></i>
                        <span class="text-[10px] font-black text-[#1a237e]">{{ $activeBooking->waktu_jemput->format('H:i') }} WIB</span>
                    </div>
                    <a href="{{ route('driver.order.show', $activeBooking->id) }}" class="px-6 py-3 bg-[#1a237e] text-white text-[10px] font-black rounded-2xl uppercase tracking-widest shadow-lg shadow-blue-900/20 active:scale-95 transition">
                        Buka Detail
                    </a>
                </div>
            </div>
            @else
            <div class="bg-white rounded-[32px] p-8 border-2 border-dashed border-gray-100 text-center">
                <i class="bi bi-plus-circle text-3xl text-gray-200 mb-2 block"></i>
                <h4 class="text-[10px] font-black text-gray-300 uppercase tracking-widest">Belum Ada Tugas</h4>
                <p class="text-[8px] text-gray-200 mt-1 uppercase font-bold tracking-tighter italic">Nantikan orderan baru di sini</p>
            </div>
            @endif
        </div>

        <!-- Wallet / Earning Section (Fix Reference) -->
        <div class="bg-[#1a237e] rounded-[40px] p-8 text-white shadow-2xl relative overflow-hidden group">
            <div class="absolute -top-10 -right-10 w-40 h-40 bg-white/5 rounded-full blur-3xl"></div>
            <div class="relative z-10">
                <div class="flex items-center gap-3 mb-6">
                    <div class="w-10 h-10 bg-white/10 rounded-xl flex items-center justify-center">
                        <i class="bi bi-wallet2 text-lg"></i>
                    </div>
                    <p class="text-[9px] font-black text-blue-200 uppercase tracking-[0.2em]">Saldo Pendapatan</p>
                </div>
                <h3 class="text-4xl font-black tracking-tighter mb-8 italic">Rp {{ number_format(Auth::user()->wallet->balance ?? 0, 0, ',', '.') }}</h3>
                <div class="flex gap-3">
                    <a href="{{ route('driver.wallet.index') }}" class="flex-1 py-4 bg-white/10 hover:bg-white/20 rounded-2xl text-[9px] font-black uppercase tracking-widest text-center transition">Riwayat</a>
                    <a href="{{ route('driver.wallet.index') }}" class="flex-1 py-4 bg-[#fbc02d] text-[#1a237e] rounded-2xl text-[9px] font-black uppercase tracking-widest text-center shadow-lg transition active:scale-95">Tarik Dana</a>
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
                    
                    Swal.fire({
                        title: 'Mohon Tunggu...',
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
                            statusLabel.className = `ms-3 text-[9px] font-black ${status === 'available' ? 'text-green-400' : 'text-gray-400'} uppercase tracking-[0.2em]`;
                            
                            Swal.fire({ icon: 'success', text: 'Status diperbarui', timer: 1000, showConfirmButton: false });
                        }
                    })
                    .catch(error => {
                        Swal.fire({ icon: 'error', text: 'Koneksi gagal' });
                        this.checked = !this.checked;
                    });
                };
            }
        });
    </script>
@endpush