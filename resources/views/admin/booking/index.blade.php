@extends('layouts.admin')

@section('title', 'Manajemen Booking')
@section('header_title', 'Daftar Pesanan & Jadwal')

@section('content')
<div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
    <div class="p-6 border-b border-gray-100 flex flex-col sm:flex-row justify-between items-center gap-4">
        <div>
            <h3 class="font-black text-[#1a237e] text-lg">Semua Pesanan</h3>
            <p class="text-xs text-gray-400">Total riwayat booking: {{ $bookings->count() }} transaksi</p>
        </div>
        <div class="flex gap-2">
            <div class="px-4 py-2 bg-blue-50 text-[#1a237e] rounded-xl text-[10px] font-black uppercase tracking-widest border border-blue-100">
                {{ $bookings->where('status', 'pending')->count() }} Menunggu
            </div>
            <div class="px-4 py-2 bg-green-50 text-green-700 rounded-xl text-[10px] font-black uppercase tracking-widest border border-green-100">
                {{ $bookings->where('status', 'confirmed')->count() }} Terkonfirmasi
            </div>
        </div>
    </div>

    <!-- Filter Section -->
    <div class="px-6 py-4 border-b border-gray-100 bg-gray-50/50">
        <form action="{{ route('admin.booking.index') }}" method="GET" class="flex flex-wrap items-center gap-3">
            <input type="date" name="tanggal" value="{{ request('tanggal') }}" class="px-4 py-2 rounded-xl border border-gray-200 text-xs font-bold text-gray-700 outline-none focus:border-[#fbc02d] transition-colors bg-white">
            
            <select name="armada_id" class="px-4 py-2 rounded-xl border border-gray-200 text-xs font-bold text-gray-700 outline-none focus:border-[#fbc02d] transition-colors bg-white w-full sm:w-auto">
                <option value="">Semua Armada</option>
                @foreach($armadas as $armada)
                    <option value="{{ $armada->id }}" {{ request('armada_id') == $armada->id ? 'selected' : '' }}>{{ $armada->nama }} ({{ $armada->plat_nomor }})</option>
                @endforeach
            </select>

            <select name="driver_id" class="px-4 py-2 rounded-xl border border-gray-200 text-xs font-bold text-gray-700 outline-none focus:border-[#fbc02d] transition-colors bg-white w-full sm:w-auto">
                <option value="">Semua Driver</option>
                @foreach($drivers as $driver)
                    <option value="{{ $driver->id }}" {{ request('driver_id') == $driver->id ? 'selected' : '' }}>{{ $driver->name }}</option>
                @endforeach
            </select>

            <button type="submit" class="px-4 py-2 bg-[#1a237e] text-white rounded-xl text-[10px] font-black uppercase tracking-widest hover:bg-[#0d1440] transition-all shadow-md">
                <i class="bi bi-filter"></i> Filter
            </button>
            
            @if(request()->hasAny(['tanggal', 'armada_id', 'driver_id']))
                <a href="{{ route('admin.booking.index') }}" title="Reset Filter" class="px-3 py-2 bg-red-50 text-red-500 border border-red-100 rounded-xl text-[10px] font-black uppercase tracking-widest hover:bg-red-500 hover:text-white transition-all shadow-sm">
                    <i class="bi bi-arrow-counterclockwise text-sm"></i>
                </a>
            @endif
        </form>
    </div>

    <div class="overflow-x-auto">
        <table class="w-full text-left">
            <thead>
                <tr class="bg-gray-50 text-[10px] font-black uppercase tracking-widest text-gray-400 border-b border-gray-100">
                    <th class="px-6 py-4">Kode & Customer</th>
                    <th class="px-6 py-4">Paket Rute & Jadwal</th>
                    <th class="px-6 py-4">Total Harga</th>
                    <th class="px-6 py-4">Status</th>
                    <th class="px-6 py-4">Driver</th>
                    <th class="px-6 py-4 text-right">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-50">
                @forelse($bookings as $booking)
                <tr class="hover:bg-blue-50/30 transition group">
                    <td class="px-6 py-4">
                        <div class="flex flex-col">
                            <div class="flex items-center gap-2">
                                <span class="text-[10px] font-black text-[#1a237e] uppercase tracking-widest">#{{ $booking->kode_booking }}</span>
                                @php $pendingExtension = $booking->extensions->where('status', 'pending')->first(); @endphp
                                @if($pendingExtension)
                                    <button type="button" 
                                        onclick="openExtensionModal('{{ $booking->kode_booking }}', '{{ $booking->user->name }}', '{{ $pendingExtension->new_return_date->format('d M Y') }}', '{{ addslashes($pendingExtension->reason) }}', '{{ route('admin.booking.extension.handle', $pendingExtension->id) }}')" 
                                        class="group/ext flex items-center gap-2 px-2 py-0.5 bg-orange-50 border border-orange-200 rounded-md hover:bg-orange-500 transition-all duration-300">
                                        <span class="animate-pulse flex h-1.5 w-1.5 rounded-full bg-orange-500 group-hover/ext:bg-white"></span>
                                        <span class="text-[8px] font-black text-orange-600 uppercase italic tracking-tighter group-hover/ext:text-white">Review Perpanjangan</span>
                                    </button>
                                @endif
                            </div>
                            <span class="text-sm font-bold text-gray-700">{{ $booking->user->name }}</span>
                            <span class="text-[9px] text-gray-400 font-medium">{{ $booking->user->no_hp }}</span>
                        </div>
                    </td>
                    <td class="px-6 py-4">
                        <div class="flex flex-col">
                            <span class="text-[9px] font-black text-gray-400 uppercase tracking-widest mb-0.5">{{ $booking->rute->layanan->nama_layanan ?? 'Layanan' }}</span>
                            <span class="text-xs font-bold text-[#1a237e]">{{ $booking->rute->nama_rute }}</span>
                            <span class="text-[10px] text-gray-400 font-black uppercase tracking-tighter">
                                <i class="bi bi-calendar-event mr-1 text-blue-400"></i>{{ \Carbon\Carbon::parse($booking->tanggal_berangkat)->format('d M Y') }} 
                                <span class="mx-1">•</span> 
                                <i class="bi bi-clock mr-1 text-blue-400"></i>{{ \Carbon\Carbon::parse($booking->waktu_jemput)->format('H:i') }} WIB
                            </span>
                        </div>
                    </td>
                    <td class="px-6 py-4">
                        <div class="flex flex-col">
                            <div class="flex items-center gap-2 mb-1">
                                <span class="text-sm font-black text-[#1a237e]">Rp {{ number_format($booking->total_akhir ?? $booking->total_harga, 0, ',', '.') }}</span>
                                @if($booking->potongan_promo > 0)
                                    <span class="px-2 py-0.5 bg-orange-50 text-orange-600 text-[8px] font-black rounded-md border border-orange-100 uppercase tracking-tighter">
                                        Promo {{ $booking->promo->potongan_persen ?? '' }}%
                                    </span>
                                @endif
                                @if($booking->status_pembayaran === 'paid')
                                    <span class="px-2 py-0.5 bg-green-50 text-green-700 text-[8px] font-black rounded-md border border-green-100 uppercase tracking-tighter">
                                        Lunas
                                    </span>
                                @elseif($booking->status_pembayaran === 'dp_paid')
                                    <span class="px-2 py-0.5 bg-blue-50 text-[#1a237e] text-[8px] font-black rounded-md border border-blue-100 uppercase tracking-tighter">
                                        DP 30%
                                    </span>
                                @endif
                            </div>
                            <div class="flex flex-col gap-0.5">
                                @if($booking->jumlah_bayar > 0)
                                    <span class="text-[10px] font-bold text-green-600 uppercase tracking-tight">Dibayar: Rp {{ number_format($booking->jumlah_bayar, 0, ',', '.') }}</span>
                                @endif
                                <span class="text-[9px] font-bold {{ $booking->include_tol ? 'text-blue-500' : 'text-gray-300' }} uppercase tracking-widest">
                                    {{ $booking->include_tol ? 'Termasuk Tol' : 'Tanpa Tol' }}
                                </span>
                            </div>
                        </div>
                    </td>
                    <td class="px-6 py-4">
                        @php
                            $statusClasses = [
                                'pending' => 'bg-yellow-100 text-yellow-700 border-yellow-200',
                                'confirmed' => 'bg-blue-100 text-blue-700 border-blue-200',
                                'on_trip' => 'bg-purple-100 text-purple-700 border-purple-200',
                                'completed' => 'bg-green-100 text-green-700 border-green-200',
                                'cancelled' => 'bg-red-100 text-red-700 border-red-200',
                            ];
                            $statusLabels = [
                                'pending' => 'Menunggu',
                                'confirmed' => 'Dikonfirmasi',
                                'on_trip' => 'Perjalanan',
                                'completed' => 'Selesai',
                                'cancelled' => 'Dibatalkan',
                            ];
                        @endphp
                        <span class="px-3 py-1 {{ $statusClasses[$booking->status] }} text-[9px] font-black rounded-full border uppercase tracking-widest shadow-sm">
                            {{ $statusLabels[$booking->status] }}
                        </span>
                    </td>
                    <td class="px-6 py-4">
                        @if($booking->driver)
                            <div class="flex items-center justify-between gap-2">
                                <div class="flex items-center gap-2">
                                    <div class="w-6 h-6 rounded-full bg-blue-100 flex items-center justify-center text-[#1a237e] text-[8px] font-black">
                                        {{ strtoupper(substr($booking->driver->name, 0, 2)) }}
                                    </div>
                                    <span class="text-xs font-bold text-gray-700">{{ $booking->driver->name }}</span>
                                </div>
                                @if($booking->driver->no_hp)
                                    <form action="{{ route('admin.booking.notify-driver', $booking->id) }}" method="POST">
                                        @csrf
                                        <button type="submit" 
                                           class="w-7 h-7 bg-green-50 text-green-600 rounded-lg flex items-center justify-center hover:bg-green-500 hover:text-white transition shadow-sm" 
                                           title="Kirim Notifikasi WA (Automatis)">
                                            <i class="bi bi-whatsapp text-xs"></i>
                                        </button>
                                    </form>
                                @endif
                            </div>
                        @else
                            <span class="text-[10px] text-gray-300 font-bold italic">Belum Ditentukan</span>
                        @endif
                    </td>
                    <td class="px-6 py-4 text-right">
                        <div class="flex justify-end gap-2">
                            <a href="{{ route('admin.booking.invoice', $booking->id) }}" target="_blank" class="w-8 h-8 rounded-lg border border-gray-100 flex items-center justify-center text-gray-400 hover:text-red-500 hover:border-red-500 hover:bg-white transition shadow-sm" title="Download Invoice PDF">
                                <i class="bi bi-file-earmark-pdf text-sm"></i>
                            </a>
                            <a href="{{ route('admin.booking.edit', $booking->id) }}" class="w-8 h-8 rounded-lg border border-gray-100 flex items-center justify-center text-gray-400 hover:text-[#1a237e] hover:border-[#1a237e] hover:bg-white transition shadow-sm">
                                <i class="bi bi-gear-fill text-sm"></i>
                            </a>
                            <button type="button" onclick="confirmDelete('{{ $booking->id }}', 'Hapus Booking ini?', 'Pesanan #{{ $booking->kode_booking }} akan dihapus permanen.')" class="w-8 h-8 rounded-lg border border-gray-100 flex items-center justify-center text-gray-400 hover:text-red-600 hover:border-red-600 hover:bg-white transition shadow-sm">
                                <i class="bi bi-trash text-sm"></i>
                            </button>
                            <form id="delete-form-{{ $booking->id }}" action="{{ route('admin.booking.destroy', $booking->id) }}" method="POST" class="hidden">
                                @csrf
                                @method('DELETE')
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="px-6 py-12 text-center text-gray-400">
                        <i class="bi bi-calendar-x text-5xl mb-4 opacity-20 block"></i>
                        <p class="font-bold">Belum ada pesanan masuk</p>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<!-- Premium Extension Modal -->
<div id="extensionModal" class="fixed inset-0 z-[100] hidden items-center justify-center p-4">
    <!-- Backdrop with Blur -->
    <div class="absolute inset-0 bg-[#0d1440]/80 backdrop-blur-sm transition-opacity duration-300" onclick="closeExtensionModal()"></div>
    
    <!-- Modal Card -->
    <div class="relative w-full max-w-lg bg-white rounded-[2.5rem] shadow-2xl border border-white/20 transform transition-all duration-500 scale-95 opacity-0 overflow-hidden" id="modalCard">
        <!-- Accent Line -->
        <div class="absolute top-0 left-0 w-full h-2 bg-gradient-to-r from-orange-400 via-yellow-400 to-orange-400"></div>
        
        <div class="p-8">
            <div class="flex justify-between items-start mb-6">
                <div>
                    <h3 class="text-xl font-black text-[#1a237e] tracking-tight italic">Tinjau Perpanjangan <span id="modalBookingCode" class="text-orange-500 px-2"></span></h3>
                    <p class="text-[10px] text-gray-400 font-bold uppercase tracking-widest mt-1">Permintaan sewa tambahan dari pelanggan</p>
                </div>
                <button onclick="closeExtensionModal()" class="w-10 h-10 rounded-full bg-gray-50 flex items-center justify-center text-gray-400 hover:bg-red-50 hover:text-red-500 transition-all">
                    <i class="bi bi-x-lg"></i>
                </button>
            </div>

            <div class="space-y-6">
                <!-- Data Info -->
                <div class="grid grid-cols-2 gap-4">
                    <div class="p-4 bg-blue-50/50 rounded-2xl border border-blue-100">
                        <p class="text-[9px] font-black text-gray-400 uppercase tracking-widest mb-1">Nama Pelanggan</p>
                        <p id="modalCustomerName" class="text-xs font-black text-[#1a237e]"></p>
                    </div>
                    <div class="p-4 bg-orange-50/50 rounded-2xl border border-orange-100">
                        <p class="text-[9px] font-black text-gray-400 uppercase tracking-widest mb-1">Target Tanggal Baru</p>
                        <p id="modalNewDate" class="text-xs font-black text-orange-600"></p>
                    </div>
                </div>

                <!-- Reason Container -->
                <div class="p-5 bg-gray-50 rounded-3xl border border-gray-100 italic">
                    <p class="text-[9px] font-black text-gray-300 uppercase tracking-widest mb-2">Alasan/Catatan Pelanggan</p>
                    <p id="modalReason" class="text-xs font-medium text-gray-600 leading-relaxed"></p>
                </div>

                <!-- Action Form -->
                <form id="extensionForm" action="" method="POST" class="space-y-5">
                    @csrf
                    <div>
                        <label class="block text-[10px] font-black text-gray-400 uppercase tracking-widest mb-2">Biaya Tambahan (Rp) <span class="text-red-500">*</span></label>
                        <div class="relative">
                            <span class="absolute left-4 top-1/2 -translate-y-1/2 text-gray-400 font-bold text-xs uppercase italic">IDR</span>
                            <input type="number" name="additional_price" required min="1" class="w-full pl-14 pr-4 py-3 bg-gray-50 border border-gray-100 rounded-2xl focus:ring-2 focus:ring-[#fbc02d] outline-none text-sm font-black" placeholder="Masukkan harga tambahan...">
                        </div>
                        <p class="text-[9px] text-blue-400 mt-2 font-bold italic">* Biaya komitmen perpanjangan yang harus dibayar pelanggan.</p>
                    </div>

                    <div>
                        <label class="block text-[10px] font-black text-gray-400 uppercase tracking-widest mb-2">Catatan Admin (Opsional)</label>
                        <input type="text" name="admin_notes" class="w-full px-4 py-3 bg-gray-50 border border-gray-100 rounded-2xl focus:ring-2 focus:ring-[#fbc02d] outline-none text-xs font-medium" placeholder="Tulis alasan jika ditolak atau instruksi Khusus...">
                    </div>

                    <div class="flex gap-3 pt-2">
                        <button type="submit" name="action" value="approve" class="flex-[2] py-4 bg-[#1a237e] text-white rounded-2xl text-xs font-black uppercase tracking-widest hover:bg-blue-800 transition transform hover:-translate-y-1 shadow-lg shadow-blue-900/20 shadow-inner">
                            Setujui Perpanjangan
                        </button>
                        <button type="submit" name="action" value="reject" onclick="return confirm('Tolak pengajuan ini?')" class="flex-1 py-4 bg-red-50 text-red-500 rounded-2xl text-xs font-black uppercase tracking-widest hover:bg-red-500 hover:text-white transition transform hover:-translate-y-1">
                            Tolak
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    const modal = document.getElementById('extensionModal');
    const card = document.getElementById('modalCard');
    const form = document.getElementById('extensionForm');
    
    function openExtensionModal(bookingCode, customerName, newDate, reason, actionUrl) {
        document.getElementById('modalBookingCode').innerText = '#' + bookingCode;
        document.getElementById('modalCustomerName').innerText = customerName;
        document.getElementById('modalNewDate').innerText = newDate;
        document.getElementById('modalReason').innerText = '"' + reason + '"';
        form.action = actionUrl;

        modal.classList.remove('hidden');
        modal.classList.add('flex');
        
        setTimeout(() => {
            card.classList.remove('scale-95', 'opacity-0');
            card.classList.add('scale-100', 'opacity-100');
        }, 10);
    }

    function closeExtensionModal() {
        card.classList.remove('scale-100', 'opacity-100');
        card.classList.add('scale-95', 'opacity-0');
        
        setTimeout(() => {
            modal.classList.add('hidden');
            modal.classList.remove('flex');
        }, 300);
    }

    // Close on Escape key
    document.addEventListener('keydown', function(event) {
        if (event.key === "Escape") {
            closeExtensionModal();
        }
    });
</script>
@endpush
@endsection
