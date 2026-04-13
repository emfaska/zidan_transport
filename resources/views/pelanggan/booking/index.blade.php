@extends('layouts.pelanggan')

@section('title', 'Riwayat Pesanan - Zidan Transport')

@push('styles')
<style>
    body { font-family: 'Plus Jakarta Sans', sans-serif; }
    .font-mont { font-family: 'Montserrat', sans-serif; }
    
    @keyframes fadeInUp {
        from { opacity: 0; transform: translateY(10px); }
        to { opacity: 1; transform: translateY(0); }
    }
    .animate-up { animation: fadeInUp 0.4s ease forwards; }
</style>
@endpush

@section('content')
    <!-- Header -->
    <div class="flex flex-col md:flex-row md:items-end justify-between gap-6 mb-10 animate-up">
        <div>
            <div class="inline-flex items-center gap-2 px-3 py-1 bg-blue-50 border border-blue-100 rounded-full text-[#1a237e] text-[10px] font-black uppercase tracking-widest mb-4">
                <i class="bi bi-collection-play-fill text-blue-500"></i> Aktivitas Perjalanan
            </div>
            <h1 class="text-3xl md:text-5xl font-mont font-[900] text-[#1a237e] uppercase tracking-tighter leading-none mb-2">Riwayat <span class="text-[#fbc02d]">Pesanan</span></h1>
            <p class="text-slate-500 text-sm font-medium">Lacak status dan kelola detail semua perjalanan Anda.</p>
        </div>
        <a href="{{ route('pelanggan.booking.create') }}" class="inline-flex items-center px-8 py-4 bg-[#1a237e] text-white rounded-2xl font-black uppercase tracking-widest text-[10px] shadow-lg shadow-blue-900/10 hover:-translate-y-1 transition-all gap-3">
            <i class="bi bi-plus-lg"></i> Pesanan Baru
        </a>
    </div>

    <!-- List Pesanan -->
    <div class="space-y-4">
        @forelse($bookings as $booking)
        <div class="bg-white rounded-[32px] border border-slate-100 shadow-sm hover:shadow-xl hover:shadow-slate-200/50 transition-all duration-300 group overflow-hidden animate-up">
            <div class="flex flex-col lg:flex-row">
                <!-- Progress Bar (Left Accent) -->
                <div class="hidden lg:block w-1.5 bg-[#fbc02d]"></div>
                
                <div class="flex-grow p-6 md:p-8">
                    <div class="flex flex-col md:flex-row md:items-center justify-between gap-6 mb-8">
                        <div class="flex items-center gap-4">
                            <div class="w-12 h-12 rounded-2xl bg-slate-50 flex items-center justify-center text-[#1a237e] border border-slate-100 shrink-0">
                                <i class="bi bi-receipt-cutoff text-lg"></i>
                            </div>
                            <div>
                                <p class="text-[8px] text-slate-400 font-black uppercase tracking-[0.2em] mb-0.5">Kode Booking</p>
                                <h3 class="text-lg font-mont font-black text-[#1a237e] uppercase tracking-tight">#{{ $booking->kode_booking }}</h3>
                            </div>
                        </div>

                        @php
                            $statusMeta = [
                                'pending' => ['label' => 'Menunggu', 'color' => 'bg-amber-50 text-amber-600 border-amber-100', 'icon' => 'bi-hourglass-split'],
                                'confirmed' => ['label' => 'Dikonfirmasi', 'color' => 'bg-blue-50 text-blue-600 border-blue-100', 'icon' => 'bi-check2-circle'],
                                'on_trip' => ['label' => 'Dalam Perjalanan', 'color' => 'bg-indigo-50 text-indigo-600 border-indigo-100', 'icon' => 'bi-truck'],
                                'completed' => ['label' => 'Selesai', 'color' => 'bg-green-50 text-green-600 border-green-100', 'icon' => 'bi-stars'],
                                'cancelled' => ['label' => 'Dibatalkan', 'color' => 'bg-red-50 text-red-600 border-red-100', 'icon' => 'bi-x-circle'],
                            ];
                            $curStatus = $statusMeta[$booking->status] ?? ['label' => $booking->status, 'color' => 'bg-slate-50 text-slate-600 border-slate-100', 'icon' => 'bi-info-circle'];
                        @endphp
                        
                        <div class="px-4 py-2 rounded-xl {{ $curStatus['color'] }} border flex items-center gap-3">
                            <i class="bi {{ $curStatus['icon'] }} text-sm"></i>
                            <span class="text-[9px] font-black uppercase tracking-widest">{{ $curStatus['label'] }}</span>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-x-8 gap-y-6">
                        <!-- Detail Perjalanan -->
                        <div>
                            <p class="text-[8px] text-slate-400 font-black uppercase tracking-widest mb-2">Rute & Tipe</p>
                            <div class="space-y-1">
                                <p class="text-xs font-bold text-slate-800 uppercase leading-tight">{{ $booking->rute->nama_rute }}</p>
                                <div class="flex items-center gap-2">
                                    <span class="text-[8px] font-black px-2 py-0.5 rounded-md border {{ $booking->tipe_perjalanan === 'round_trip' ? 'bg-orange-50 text-orange-600 border-orange-100' : 'bg-blue-50 text-blue-600 border-blue-100' }} uppercase">
                                        {{ $booking->tipe_perjalanan === 'round_trip' ? 'Pulang Pergi' : 'Sekali Jalan' }}
                                    </span>
                                    <span class="text-[9px] font-bold text-slate-400">{{ $booking->jumlah_penumpang }} Orang</span>
                                </div>
                            </div>
                        </div>

                        <!-- Jadwal -->
                        <div>
                            <p class="text-[8px] text-slate-400 font-black uppercase tracking-widest mb-2">Jadwal Jemput</p>
                            <div class="flex flex-col">
                                <span class="text-xs font-bold text-slate-800">{{ $booking->tanggal_berangkat->format('d M Y') }}</span>
                                <span class="text-[10px] font-black text-blue-600 uppercase italic">@ {{ $booking->waktu_jemput->format('H:i') }} WIB</span>
                            </div>
                        </div>

                        <!-- Biaya -->
                        <div>
                            <p class="text-[8px] text-slate-400 font-black uppercase tracking-widest mb-2">Total Biaya</p>
                            <div class="flex flex-col">
                                <span class="text-lg font-mont font-black text-[#1a237e]">Rp {{ number_format($booking->total_harga, 0, ',', '.') }}</span>
                                <span class="text-[8px] font-bold text-green-600 uppercase flex items-center gap-1.5">
                                    <i class="bi bi-check-circle-fill"></i> Harga All-In
                                </span>
                            </div>
                        </div>

                         <!-- Akses & Tombol -->
                         <div class="flex flex-wrap items-center lg:justify-end gap-2">
                             @if($booking->status === 'pending')
                             <a href="https://wa.me/{{ \App\Models\Setting::get('contact_whatsapp', '6282142951682') }}?text={{ urlencode('Halo Admin Zidan Transport, saya ingin konfirmasi harga untuk pesanan ' . $booking->kode_booking . ' atas nama ' . Auth::user()->name) }}" target="_blank" class="px-4 py-2.5 bg-green-500 text-white rounded-xl text-[9px] font-black uppercase tracking-widest hover:bg-green-600 transition-all flex items-center gap-2 shadow-md">
                                 <i class="bi bi-whatsapp"></i> Nego
                             </a>
                             @endif
                             
                             @if($booking->status === 'confirmed' && $booking->status_pembayaran !== 'lunas')
                             <a href="{{ route('pelanggan.booking.payment', $booking->id) }}" class="px-4 py-2.5 bg-[#1a237e] text-white rounded-xl text-[9px] font-black uppercase tracking-widest hover:bg-blue-900 transition-all flex items-center gap-2 shadow-md">
                                 <i class="bi bi-wallet2"></i> Bayar
                             </a>
                             @endif

                             <a href="{{ route('pelanggan.booking.show', $booking->id) }}" class="px-4 py-2.5 bg-slate-50 border border-slate-100 text-[#1a237e] rounded-xl text-[9px] font-black uppercase tracking-widest hover:bg-slate-100 transition-all">
                                 Detail
                             </a>

                             @if(in_array($booking->status, ['confirmed', 'on_trip', 'completed']))
                             <a href="{{ route('pelanggan.booking.invoice', $booking->id) }}" target="_blank" class="px-4 py-2.5 border border-red-100 text-red-500 rounded-xl text-[9px] font-black uppercase tracking-widest bg-red-50 hover:bg-red-500 hover:text-white transition-all">
                                 <i class="bi bi-file-earmark-pdf"></i> PDF
                             </a>
                             @endif

                             @if($booking->status === 'completed' && !$booking->review)
                             <button type="button" onclick="openReviewModal('{{ $booking->id }}', '{{ addslashes($booking->rute->nama_rute) }}', '{{ addslashes($booking->driver->name ?? 'Pengemudi Kami') }}')" class="px-4 py-2.5 bg-[#fbc02d] text-[#1a237e] rounded-xl text-[9px] font-black uppercase tracking-widest hover:bg-yellow-500 transition-all font-mont">
                                 Review Trip
                             </button>
                             @endif

                             @if(in_array($booking->status, ['pending', 'confirmed']))
                                 @if($booking->jumlah_bayar > 0)
                                     @if(!$booking->refundRequest)
                                         <a href="{{ route('pelanggan.booking.refund', $booking->id) }}" class="px-4 py-2.5 bg-red-50 text-red-500 rounded-xl text-[9px] font-black uppercase tracking-widest border border-red-100 hover:bg-red-500 hover:text-white transition-all">
                                             Batal & Refund
                                         </a>
                                     @endif
                                 @else
                                     @if($booking->status === 'pending')
                                     <form action="{{ route('pelanggan.booking.destroy', $booking->id) }}" method="POST"
                                         data-confirm="Apakah Anda yakin ingin membatalkan pesanan ini? Pesanan yang dibatalkan tidak dapat dikembalikan."
                                         data-title="Batalkan Pesanan?"
                                         data-type="warning"
                                         data-btn-text="Ya, Batalkan"
                                         data-btn-color="#d33">
                                         @csrf @method('DELETE')
                                         <button type="submit" class="px-4 py-2.5 bg-slate-50 text-red-500 rounded-xl text-[9px] font-black uppercase tracking-widest border border-slate-100 hover:bg-red-50 transition-all">
                                             Batal
                                         </button>
                                     </form>
                                     @endif
                                 @endif
                             @endif

                             @if($booking->status === 'cancelled' && $booking->refundRequest)
                                 <span class="px-4 py-2.5 bg-slate-100 text-slate-500 rounded-xl text-[8px] font-black uppercase tracking-widest border border-slate-200">
                                     Refund {{ ucfirst($booking->refundRequest->status) }}
                                 </span>
                             @endif
                         </div>
                    </div>
                </div>
            </div>
        </div>
        @empty
        <div class="py-20 bg-white rounded-[40px] border border-dashed border-slate-200 text-center flex flex-col items-center justify-center">
            <div class="w-20 h-20 bg-slate-50 rounded-3xl flex items-center justify-center text-slate-200 mb-4">
                <i class="bi bi-inbox text-4xl"></i>
            </div>
            <h3 class="text-xl font-mont font-black text-[#1a237e] uppercase tracking-widest">Belum Ada Pesanan</h3>
            <p class="text-slate-400 mt-2 text-xs font-medium">Mari rencanakan perjalanan pertama Anda sekarang.</p>
            <a href="{{ route('pelanggan.booking.create') }}" class="mt-8 px-8 py-4 bg-[#fbc02d] text-[#1a237e] font-black rounded-2xl shadow-xl shadow-yellow-500/10 uppercase tracking-widest text-[9px] hover:bg-yellow-500 transition-all">
                Pesan Sekarang
            </a>
        </div>
        @endforelse
    </div>

    @if($bookings->hasPages())
    <div class="mt-10 px-6 py-4 bg-white rounded-3xl shadow-sm border border-slate-100">
        {{ $bookings->links() }}
    </div>
    @endif

    <!-- Review Modal -->
    <div id="reviewModal" class="hidden fixed inset-0 z-[100] flex items-center justify-center p-4">
        <div class="absolute inset-0 bg-slate-900/60 backdrop-blur-sm" onclick="closeReviewModal()"></div>
        <div class="bg-white rounded-[32px] w-full max-w-lg relative z-10 shadow-2xl animate-up overflow-hidden">
            <div class="p-6 md:p-8">
                <div class="flex justify-between items-center mb-6">
                    <div class="flex items-center gap-3">
                        <div class="w-12 h-12 bg-yellow-50 text-yellow-500 rounded-2xl flex items-center justify-center shadow-sm">
                            <i class="bi bi-star-fill text-xl"></i>
                        </div>
                        <div>
                            <h3 class="text-2xl font-mont font-[900] text-[#1a237e]">Beri Ulasan</h3>
                            <p class="text-xs text-slate-500 font-medium">Nilai pengalaman perjalanan Anda</p>
                        </div>
                    </div>
                    <button type="button" onclick="closeReviewModal()" class="w-10 h-10 flex items-center justify-center rounded-xl bg-slate-100 text-slate-500 hover:bg-red-50 hover:text-red-500 transition">
                        <i class="bi bi-x-lg"></i>
                    </button>
                </div>
                
                <form id="reviewForm" action="" method="POST" class="space-y-6 flex flex-col">
                    @csrf
                    
                    <div class="bg-slate-50 rounded-2xl p-4 border border-slate-100 flex items-center gap-4">
                        <div class="w-10 h-10 bg-indigo-100 text-indigo-600 rounded-xl flex items-center justify-center shrink-0">
                            <i class="bi bi-geo-alt-fill text-lg"></i>
                        </div>
                        <div>
                            <p id="modalRute" class="text-sm font-bold text-slate-800 uppercase leading-tight"></p>
                            <p id="modalDriver" class="text-[10px] uppercase font-black tracking-widest text-[#1a237e]"></p>
                        </div>
                    </div>

                    <div>
                        <label class="block text-xs font-black text-slate-400 uppercase tracking-widest mb-3 text-center">Rating Anda</label>
                        <div class="flex items-center justify-center gap-2" id="starContainer">
                            @for($i=1; $i<=5; $i++)
                            <label class="cursor-pointer group flex-1 max-w-[60px]">
                                <input type="radio" name="rating" value="{{ $i }}" class="hidden peer rating-radio" required onchange="updateStars(this.value)">
                                <div class="py-3 flex justify-center border-2 border-slate-100 rounded-xl text-slate-300 transition-all star-box hover:scale-105 active:scale-95">
                                    <i class="bi bi-star-fill text-2xl"></i>
                                </div>
                            </label>
                            @endfor
                        </div>
                    </div>

                    <div>
                        <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-2">Ulasan (Opsional)</label>
                        <textarea id="modalComment" name="comment" rows="3" class="w-full bg-slate-50 border border-slate-200 rounded-2xl p-4 focus:ring-2 focus:ring-[#fbc02d] focus:border-[#fbc02d] transition-all text-sm font-medium text-slate-700 outline-none placeholder:text-slate-400" placeholder="Ceritakan pengalaman Anda..."></textarea>
                    </div>

                    <button type="submit" class="w-full bg-[#1a237e] text-white rounded-2xl py-4 font-black uppercase tracking-widest text-xs hover:bg-[#0d1440] shadow-xl shadow-blue-900/20 transition-all active:scale-[0.98]">
                        Kirim Ulasan Anda
                    </button>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
<script>
    document.addEventListener('turbo:load', () => {
        // Initializing modal functionality for Turbo
        window.openReviewModal = function(bookingId, rute, driver) {
            const modal = document.getElementById('reviewModal');
            if(!modal) return;
            modal.classList.remove('hidden');
            document.getElementById('modalRute').innerText = rute;
            document.getElementById('modalDriver').innerText = 'DENGAN ' + driver;
            document.getElementById('reviewForm').action = "/booking/" + bookingId + "/review";
            updateStars(0);
            const checked = document.querySelector('.rating-radio:checked');
            if (checked) checked.checked = false;
            document.getElementById('modalComment').value = "";
        };
        
        window.closeReviewModal = function() {
            const modal = document.getElementById('reviewModal');
            if(modal) modal.classList.add('hidden');
        };

        window.updateStars = function(val) {
            const radios = document.querySelectorAll('.rating-radio');
            radios.forEach((radio, index) => {
                const box = radio.nextElementSibling;
                if(index < val) {
                    box.classList.add('border-[#fbc02d]', 'bg-yellow-50', 'text-[#fbc02d]', 'scale-110');
                    box.classList.remove('border-slate-100', 'text-slate-300');
                } else {
                    box.classList.remove('border-[#fbc02d]', 'bg-yellow-50', 'text-[#fbc02d]', 'scale-110');
                    box.classList.add('border-slate-100', 'text-slate-300');
                }
            });
        };
    });
</script>
@endpush
