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

    <div class="overflow-x-auto">
        <table class="w-full text-left">
            <thead>
                <tr class="bg-gray-50 text-[10px] font-black uppercase tracking-widest text-gray-400 border-b border-gray-100">
                    <th class="px-6 py-4">Kode & Customer</th>
                    <th class="px-6 py-4">Rute & Jadwal</th>
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
                            <span class="text-[10px] font-black text-[#1a237e] uppercase tracking-widest">#{{ $booking->kode_booking }}</span>
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
                                <i class="bi bi-clock mr-1 text-blue-400"></i>{{ substr($booking->waktu_jemput, 0, 5) }}
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
@endsection
