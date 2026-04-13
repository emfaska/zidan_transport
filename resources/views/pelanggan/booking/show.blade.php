@extends('layouts.pelanggan')

@section('title', 'Detail Pesanan #' . $booking->kode_booking . ' - Zidan Transport')

@push('styles')
<style>
    body { font-family: 'Plus Jakarta Sans', sans-serif; }
    .font-mont { font-family: 'Montserrat', sans-serif; }
    .modal { transition: opacity 0.25s ease; }
    body.modal-active { overflow-x: hidden; overflow-y: hidden !important; }
</style>
<!-- Leaflet.js for Real-time Tracking -->
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin=""/>
@endpush

@section('content')
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
                                    'dp_dibayar' => ['label' => 'DP LUNAS', 'color' => 'text-yellow-400'],
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
                            <p class="text-[9px] font-black text-gray-400 uppercase tracking-widest mb-1">Hingga Tanggal Baru</p>
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
                                <div class="px-4 py-2 bg-blue-50 border border-blue-100 rounded-xl flex items-center gap-2">
                                    <p class="text-[9px] font-bold text-blue-700 leading-tight">
                                        Bayar ke DRIVER/ADMIN.
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
                        </div>
                    @else
                        <!-- Form Review if not yet reviewed -->
                        <div class="bg-gradient-to-br from-[#1a237e] to-blue-900 rounded-[40px] p-10 text-white shadow-2xl relative overflow-hidden group">
                            <h3 class="text-2xl font-black uppercase tracking-tighter mb-2">Bagaimana Perjalanan Anda?</h3>
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
                                <textarea name="comment" rows="3" class="w-full bg-white/10 border border-white/20 rounded-2xl py-4 px-6 text-white text-sm outline-none" placeholder="Ceritakan pengalaman Anda..."></textarea>
                                <button type="submit" class="w-full bg-[#fbc02d] text-[#1a237e] font-black py-4 rounded-2xl uppercase tracking-widest text-xs">Kirim Review</button>
                            </form>
                        </div>
                    @endif
                </div>
            @endif

            <!-- Final Actions Bar -->
            <div class="mt-12 pt-12 border-t border-gray-100">
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
                    @if($booking->status === 'confirmed' && $booking->status_pembayaran !== 'lunas')
                        <a href="{{ route('pelanggan.booking.payment', $booking->id) }}" class="flex flex-col items-center justify-center p-5 bg-[#1a237e] text-white rounded-[30px] shadow-xl hover:-translate-y-1 transition-all">
                            <i class="bi bi-wallet2 text-2xl mb-2"></i>
                            <span class="text-[10px] font-black uppercase tracking-[0.2em]">Bayar</span>
                        </a>
                    @else
                        <a href="https://wa.me/{{ \App\Models\Setting::get('contact_whatsapp', '6282142951682') }}" target="_blank" class="flex flex-col items-center justify-center p-5 bg-green-500 text-white rounded-[30px] shadow-xl hover:-translate-y-1 transition-all">
                            <i class="bi bi-whatsapp text-2xl mb-2"></i>
                            <span class="text-[10px] font-black uppercase tracking-[0.2em]">Contact Admin</span>
                        </a>
                    @endif

                    @if(in_array($booking->status, ['confirmed', 'on_trip', 'completed']))
                        <a href="{{ route('pelanggan.booking.invoice', $booking->id) }}" class="flex flex-col items-center justify-center p-5 bg-blue-50 text-[#1a237e] border border-blue-100 rounded-[30px] hover:bg-[#1a237e] hover:text-white transition-all hover:-translate-y-1">
                            <i class="bi bi-file-earmark-pdf-fill text-2xl mb-2"></i>
                            <span class="text-[10px] font-black uppercase tracking-[0.2em]">Invoice PDF</span>
                        </a>
                    @endif

                    @if(in_array($booking->status, ['confirmed', 'on_trip']))
                        <button type="button" onclick="document.getElementById('extensionModal').classList.remove('hidden')" class="flex flex-col items-center justify-center p-5 bg-[#fbc02d] text-[#1a237e] rounded-[30px] shadow-xl hover:-translate-y-1 transition-all">
                            <i class="bi bi-calendar-plus-fill text-2xl mb-2"></i>
                            <span class="text-[10px] font-black uppercase tracking-[0.2em]">Extend</span>
                        </button>
                    @endif
                </div>
            </div>
        </div>
        
        @if($booking->refundRequest)
            <div id="refund-action" class="p-8 md:p-12 bg-gray-50 border-t border-gray-100 relative">
                <h3 class="text-2xl font-black text-[#1a237e] tracking-tighter uppercase mb-6 flex items-center gap-3">
                    <i class="bi bi-arrow-counterclockwise text-red-500"></i> Refund Details
                </h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <div>
                        <p class="text-[10px] text-gray-400 font-bold uppercase tracking-widest mb-1">Status</p>
                        <p class="font-black text-[#1a237e]">{{ strtoupper($booking->refundRequest->status) }}</p>
                    </div>
                    <div>
                        <p class="text-[10px] text-gray-400 font-bold uppercase tracking-widest mb-1">Amount</p>
                        <p class="text-xl font-black text-[#1a237e]">Rp {{ number_format($booking->refundRequest->amount, 0, ',', '.') }}</p>
                    </div>
                </div>
            </div>
        @endif
    </div>

    <!-- Extension Modal -->
    <div id="extensionModal" class="hidden fixed inset-0 z-[100] flex items-center justify-center p-4">
        <div class="absolute inset-0 bg-slate-900/60 backdrop-blur-sm" onclick="document.getElementById('extensionModal').classList.add('hidden')"></div>
        <div class="bg-white rounded-[40px] w-full max-w-lg relative z-10 shadow-2xl p-8">
            <h3 class="text-2xl font-black text-[#1a237e] uppercase mb-6">Perpanjang Waktu</h3>
            <form action="{{ route('pelanggan.booking.extension', $booking->id) }}" method="POST" class="space-y-6">
                @csrf
                <div>
                    <label class="block text-[10px] font-black text-gray-400 uppercase mb-2">Tanggal Baru</label>
                    <input type="date" name="new_return_date" required min="{{ $booking->tanggal_berangkat->addDay()->format('Y-m-d') }}" class="w-full bg-gray-50 border border-gray-200 rounded-xl p-4">
                </div>
                <div>
                    <label class="block text-[10px] font-black text-gray-400 uppercase mb-2">Alasan</label>
                    <textarea name="reason" rows="3" required class="w-full bg-gray-50 border border-gray-200 rounded-xl p-4"></textarea>
                </div>
                <button type="submit" class="w-full bg-[#1a237e] text-white font-black py-4 rounded-xl uppercase">Kirim Pengajuan</button>
            </form>
        </div>
    </div>
@endsection

@push('scripts')
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>
<script>
    document.addEventListener('turbo:load', () => {
        // Star rating logic (if present)
        const stars = document.querySelectorAll('.star-btn');
        const ratingInput = document.getElementById('rating-input');
        if (stars.length > 0 && ratingInput) {
            stars.forEach(btn => {
                btn.onclick = function() {
                    const val = this.dataset.value;
                    ratingInput.value = val;
                    stars.forEach(s => {
                        if (s.dataset.value <= val) {
                            s.classList.remove('text-gray-400/50');
                            s.classList.add('text-yellow-400');
                        } else {
                            s.classList.add('text-gray-400/50');
                            s.classList.remove('text-yellow-400');
                        }
                    });
                };
            });
        }

        // Map Tracking Logic
        const mapContainer = document.getElementById('trackingMap');
        if (mapContainer) {
            const bookingId = "{{ $booking->id }}";
            const kediriCenter = [-7.8228, 112.0119];
            
            const map = L.map('trackingMap').setView(kediriCenter, 13);
            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '&copy; OpenStreetMap'
            }).addTo(map);

            const driverIcon = L.icon({
                iconUrl: 'https://cdn-icons-png.flaticon.com/512/3202/3202926.png',
                iconSize: [40, 40],
                iconAnchor: [20, 20]
            });

            const driverMarker = L.marker(kediriCenter, {icon: driverIcon}).addTo(map)
                .bindPopup("<b>Driver Zidan Transport</b>")
                .openPopup();

            function updateMapPosition() {
                fetch(`/booking/${bookingId}/location`)
                    .then(r => r.json())
                    .then(data => {
                        if (data.latitude && data.longitude) {
                            const newPos = [data.latitude, data.longitude];
                            driverMarker.setLatLng(newPos);
                            map.panTo(newPos);
                        }
                    }).catch(e => console.error(e));
            }
            
            updateMapPosition();
            const polling = setInterval(updateMapPosition, 30000);

            // Cleanup on Turbo Cache/Visit
            document.addEventListener('turbo:before-cache', () => clearInterval(polling), { once: true });
        }
    });
</script>
@endpush
