@extends('layouts.admin')

@section('title', 'Kelola Booking')
@section('header_title', 'Update Pesanan')

@section('content')
<div class="max-w-4xl mx-auto">
    <div class="mb-6">
        <a href="{{ route('admin.booking.index') }}" class="text-[#1a237e] font-bold text-sm flex items-center gap-2 hover:text-blue-700 transition">
            <i class="bi bi-arrow-left"></i>
            Kembali ke Daftar Booking
        </a>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Sidebar Info -->
        <div class="lg:col-span-1 space-y-6">
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
                <h4 class="text-[10px] font-black uppercase text-gray-400 tracking-widest mb-4 italic">Detail Ringkas Pesanan</h4>
                <div class="space-y-4">
                    <div>
                        <p class="text-[9px] font-black text-gray-300 uppercase">Kode Booking</p>
                        <p class="text-sm font-black text-[#1a237e] tracking-widest">#{{ $booking->kode_booking }}</p>
                    </div>
                    <div>
                        <p class="text-[9px] font-black text-gray-300 uppercase">Pelanggan</p>
                        <p class="text-sm font-bold text-gray-700">{{ $booking->user->name }}</p>
                    </div>
                    <div>
                        <p class="text-[9px] font-black text-gray-300 uppercase">Rute & Armada</p>
                        <p class="text-[9px] font-black text-blue-300 uppercase tracking-widest mb-1">{{ $booking->rute->layanan->nama_layanan ?? '-' }}</p>
                        <p class="text-xs font-bold text-gray-700">{{ $booking->rute->nama_rute }}</p>
                        <p class="text-[10px] text-blue-400 font-bold italic">{{ $booking->rute->armada->nama }}</p>
                    </div>
                    <div class="pt-4 border-t border-gray-50">
                        <p class="text-[9px] font-black text-gray-300 uppercase">Total Bayar</p>
                        <p class="text-xl font-black text-[#1a237e]">Rp {{ number_format($booking->total_harga, 0, ',', '.') }}</p>
                    </div>
                </div>
            </div>

            <div class="bg-blue-900 rounded-2xl p-6 text-white shadow-lg shadow-blue-900/20">
                <h4 class="text-[10px] font-black uppercase text-blue-300 tracking-widest mb-2">Tips Admin</h4>
                <p class="text-xs font-medium leading-relaxed opacity-80">Pastikan untuk menghubungi pengemudi sebelum mengonfirmasi pesanan untuk memastikan ketersediaan unit dan personel.</p>
            </div>
        </div>

        <!-- Main Form -->
        <div class="lg:col-span-2">
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
                <form action="{{ route('admin.booking.update', $booking->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    
                    <div class="p-8 border-b border-gray-100 bg-gray-50/50">
                        <h3 class="font-black text-[#1a237e] text-lg mb-1 italic">Proses Pesanan</h3>
                        <p class="text-xs text-gray-400 uppercase font-bold tracking-widest">Update status dan alokasi sumber daya</p>
                    </div>

                    <div class="p-8 space-y-6">
                        <!-- Status Booking -->
                        <div>
                            <label for="status" class="block text-[10px] font-black uppercase text-gray-400 tracking-widest mb-2">Status Pesanan <span class="text-red-500">*</span></label>
                            <div class="grid grid-cols-2 sm:grid-cols-3 gap-3">
                                @php
                                    $statuses = [
                                        'pending' => ['label' => 'Menunggu', 'color' => 'yellow'],
                                        'confirmed' => ['label' => 'Konfirmasi', 'color' => 'blue'],
                                        'on_trip' => ['label' => 'Perjalanan', 'color' => 'purple'],
                                        'completed' => ['label' => 'Selesai', 'color' => 'green'],
                                        'cancelled' => ['label' => 'Batalkan', 'color' => 'red'],
                                    ];
                                @endphp
                                @foreach($statuses as $value => $info)
                                    <label class="cursor-pointer">
                                        <input type="radio" name="status" value="{{ $value }}" {{ $booking->status == $value ? 'checked' : '' }} class="peer hidden">
                                        <div class="py-3 px-2 text-center rounded-xl border border-gray-100 bg-gray-50 text-[10px] font-black uppercase transition peer-checked:bg-{{ $info['color'] }}-100 peer-checked:text-{{ $info['color'] }}-700 peer-checked:border-{{ $info['color'] }}-200 shadow-sm">
                                            {{ $info['label'] }}
                                        </div>
                                    </label>
                                @endforeach
                            </div>
                            @error('status') <p class="text-red-500 text-[10px] mt-1 font-bold italic">{{ $message }}</p> @enderror
                        </div>

                        <!-- Total Harga (Negotiated) -->
                        <div>
                            <label for="total_harga" class="block text-[10px] font-black uppercase text-gray-400 tracking-widest mb-2">Total Harga Final (Fiks) <span class="text-red-500">*</span></label>
                            <div class="relative">
                                <span class="absolute left-4 top-1/2 -translate-y-1/2 text-gray-400 font-bold text-sm">Rp</span>
                                <input type="text" name="total_harga" id="total_harga" value="{{ old('total_harga', number_format($booking->total_harga, 0, ',', '.')) }}" 
                                    class="w-full pl-12 pr-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-[#fbc02d] focus:border-[#fbc02d] outline-none transition text-sm font-black mask-currency" 
                                    placeholder="Masukkan harga fiks hasil nego">
                            </div>
                            @error('total_harga') <p class="text-red-500 text-[10px] mt-1 font-bold italic">{{ $message }}</p> @enderror
                            <p class="text-[9px] text-blue-400 mt-2 italic font-bold">Inputkan harga yang sudah disepakati via WhatsApp.</p>
                        </div>

                        <!-- Assign Driver & Armada -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label for="driver_id" class="block text-[10px] font-black uppercase text-gray-400 tracking-widest mb-2">Tugaskan Pengemudi</label>
                                <div class="relative">
                                    <i class="bi bi-steering-wheel absolute left-4 top-1/2 -translate-y-1/2 text-gray-400"></i>
                                    <select name="driver_id" id="driver_id" class="w-full pl-10 pr-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-[#fbc02d] focus:border-[#fbc02d] outline-none transition text-sm font-bold appearance-none cursor-pointer">
                                        <option value="">-- Pilih Driver --</option>
                                        @foreach($drivers as $driver)
                                            <option value="{{ $driver->id }}" {{ $booking->driver_id == $driver->id ? 'selected' : '' }}>
                                                {{ $driver->name }} ({{ $driver->status_driver ?? 'off' }})
                                            </option>
                                        @endforeach
                                    </select>
                                    <i class="bi bi-chevron-down absolute right-4 top-1/2 -translate-y-1/2 text-gray-400 pointer-events-none"></i>
                                </div>
                                @error('driver_id') <p class="text-red-500 text-[10px] mt-1 font-bold italic">{{ $message }}</p> @enderror
                            </div>

                            <div>
                                <label for="armada_id" class="block text-[10px] font-black uppercase text-gray-400 tracking-widest mb-2">Pilih Armada (Unit)</label>
                                <div class="relative">
                                    <i class="bi bi-car-front-fill absolute left-4 top-1/2 -translate-y-1/2 text-gray-400"></i>
                                    <select name="armada_id" id="armada_id" class="w-full pl-10 pr-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-[#fbc02d] focus:border-[#fbc02d] outline-none transition text-sm font-bold appearance-none cursor-pointer">
                                        <option value="">-- Pilih Armada --</option>
                                        @foreach($armadas as $armada)
                                            <option value="{{ $armada->id }}" {{ $booking->armada_id == $armada->id ? 'selected' : '' }}>
                                                {{ $armada->nama }} ({{ $armada->jenis }})
                                            </option>
                                        @endforeach
                                    </select>
                                    <i class="bi bi-chevron-down absolute right-4 top-1/2 -translate-y-1/2 text-gray-400 pointer-events-none"></i>
                                </div>
                                @error('armada_id') <p class="text-red-500 text-[10px] mt-1 font-bold italic">{{ $message }}</p> @enderror
                            </div>
                        </div>

                        <hr class="border-gray-100 my-2">

                        <!-- Payment Management -->
                        <div class="p-6 bg-blue-50/50 rounded-[32px] border border-blue-100 space-y-6">
                            <h4 class="text-xs font-black text-[#1a237e] uppercase tracking-[0.2em] flex items-center gap-2">
                                <i class="bi bi-shield-check text-lg"></i> Verifikasi Pembayaran
                            </h4>

                            <div class="grid grid-cols-1 gap-6">
                                <div>
                                    <label class="block text-[10px] font-black uppercase text-gray-400 tracking-widest mb-3">Status Pembayaran</label>
                                    <div class="grid grid-cols-1 gap-2">
                                        @php
                                            $payStatuses = [
                                                'belum_bayar' => ['label' => 'Belum Bayar', 'color' => 'gray'],
                                                'dp_dibayar' => ['label' => 'DP Dibayar', 'color' => 'yellow'],
                                                'lunas' => ['label' => 'Lunas', 'color' => 'green'],
                                            ];
                                        @endphp
                                        @foreach($payStatuses as $val => $info)
                                            <label class="cursor-pointer">
                                                <input type="radio" name="status_pembayaran" value="{{ $val }}" {{ $booking->status_pembayaran == $val ? 'checked' : '' }} class="peer hidden">
                                                <div class="py-2.5 px-4 text-center rounded-xl border border-gray-100 bg-white text-[9px] font-black uppercase transition peer-checked:bg-{{ $info['color'] }}-100 peer-checked:text-{{ $info['color'] }}-700 peer-checked:border-{{ $info['color'] }}-200 shadow-sm">
                                                    {{ $info['label'] }}
                                                </div>
                                            </label>
                                        @endforeach
                                    </div>
                                    @error('status_pembayaran') <p class="text-red-500 text-[10px] mt-1 font-bold italic">{{ $message }}</p> @enderror
                                    @if($booking->metode_pembayaran)
                                        <div class="mt-4 p-3 bg-white border border-blue-50 rounded-xl">
                                            <p class="text-[9px] font-black text-gray-400 uppercase tracking-widest mb-1">Info Transaksi</p>
                                            <p class="text-xs font-bold text-[#1a237e]">
                                                {{ strtoupper($booking->metode_pembayaran) }} - {{ strtoupper($booking->tipe_pembayaran) }}
                                                @if($booking->jumlah_bayar > 0)
                                                    <span class="text-green-600 ml-2">(Rp {{ number_format($booking->jumlah_bayar, 0, ',', '.') }})</span>
                                                @endif
                                            </p>
                                        </div>
                                    @endif
                                </div>
                                
                            </div>
                        </div>
                        <!-- Extension Management -->
                        @if($booking->extensions->count() > 0)
                        <div class="p-6 bg-yellow-50/50 rounded-[32px] border border-yellow-100 space-y-6">
                            <h4 class="text-xs font-black text-[#1a237e] uppercase tracking-[0.2em] flex items-center gap-2">
                                <i class="bi bi-calendar-plus text-lg"></i> Permintaan Perpanjangan
                            </h4>

                            <div class="space-y-4">
                                @foreach($booking->extensions as $ext)
                                <div class="p-5 bg-white border border-gray-100 rounded-2xl shadow-sm">
                                    <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4 mb-4">
                                        <div>
                                            <p class="text-[9px] font-black text-gray-400 uppercase tracking-widest">Target Tanggal Baru</p>
                                            <p class="text-sm font-black text-[#1a237e]">{{ $ext->new_return_date->format('d M Y') }}</p>
                                        </div>
                                        <div class="text-right">
                                            <p class="text-[9px] font-black text-gray-400 uppercase tracking-widest leading-none mb-2">Status</p>
                                            @php
                                                $sMeta = [
                                                    'pending' => ['label' => 'PENDING', 'color' => 'yellow'],
                                                    'approved' => ['label' => 'DISETUJUI', 'color' => 'green'],
                                                    'rejected' => ['label' => 'DITOLAK', 'color' => 'red'],
                                                    'paid' => ['label' => 'DIBAYAR', 'color' => 'blue'],
                                                ];
                                                $sm = $sMeta[$ext->status] ?? ['label' => $ext->status, 'color' => 'gray'];
                                            @endphp
                                            <span class="px-3 py-1 bg-{{ $sm['color'] }}-100 text-{{ $sm['color'] }}-700 text-[9px] font-black rounded-full">{{ $sm['label'] }}</span>
                                        </div>
                                    </div>
                                    
                                    <div class="mb-4">
                                        <p class="text-[9px] font-black text-gray-300 uppercase tracking-widest mb-1">Alasan Pelanggan</p>
                                        <p class="text-xs font-medium text-gray-600 italic">"{{ $ext->reason }}"</p>
                                    </div>

                                    @if($ext->status === 'pending')
                                    <form action="{{ route('admin.booking.extension.handle', $ext->id) }}" method="POST" class="mt-6 pt-4 border-t border-gray-100 space-y-4">
                                        @csrf
                                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                            <div>
                                                <label class="block text-[9px] font-black uppercase text-gray-400 mb-2">Biaya Tambahan (Rp) <span class="text-red-500">*</span></label>
                                                <input type="text" name="additional_price" value="{{ old('additional_price', 0) }}" required class="w-full px-4 py-2 bg-gray-50 border @error('additional_price') border-red-500 @else border-gray-200 @enderror rounded-xl text-xs font-bold focus:ring-[#fbc02d] outline-none mask-currency" placeholder="0">
                                                @error('additional_price') <p class="text-red-500 text-[8px] mt-1 font-bold italic">{{ $message }}</p> @enderror
                                            </div>
                                            <div>
                                                <label class="block text-[9px] font-black uppercase text-gray-400 mb-2">Catatan/Alasan (Opsional)</label>
                                                <input type="text" name="admin_notes" value="{{ old('admin_notes') }}" class="w-full px-4 py-2 bg-gray-50 border border-gray-200 rounded-xl text-xs font-medium focus:ring-[#fbc02d] outline-none" placeholder="Tulis catatan penolakan jika ditolak...">
                                            </div>
                                        </div>
                                        <div class="flex gap-2">
                                            <button type="submit" name="action" value="approve" class="flex-1 bg-green-500 hover:bg-green-600 text-white text-[9px] font-black py-3 rounded-xl uppercase tracking-widest transition shadow-md shadow-green-500/20">Setujui</button>
                                            <button type="submit" name="action" value="reject" onclick="return confirm('Tolak pengajuan perpanjangan ini?')" class="flex-1 bg-red-50 hover:bg-red-500 hover:text-white text-red-500 text-[9px] font-black py-3 rounded-xl uppercase tracking-widest transition">Tolak</button>
                                        </div>
                                    </form>
                                    @else
                                    <div class="mt-4 pt-4 border-t border-gray-50 flex justify-between items-center">
                                        <div>
                                            <p class="text-[9px] font-black text-gray-300 uppercase">Biaya Tambahan</p>
                                            <p class="text-xs font-black text-[#fbc02d]">Rp {{ number_format($ext->additional_price, 0, ',', '.') }}</p>
                                        </div>
                                        <div class="text-right">
                                            @if($ext->admin_notes)
                                                <p class="text-[9px] font-black text-gray-300 uppercase">Catatan Admin</p>
                                                <p class="text-[10px] font-medium text-gray-500 italic">{{ $ext->admin_notes }}</p>
                                            @endif
                                        </div>
                                    </div>
                                    @endif
                                </div>
                                @endforeach
                            </div>
                        </div>
                        @endif

                        <!-- Catatan Admin -->
                        <div>
                            <label for="catatan_admin" class="block text-[10px] font-black uppercase text-gray-400 tracking-widest mb-2">Catatan Internal Admin</label>
                            <textarea name="catatan_admin" id="catatan_admin" rows="4" placeholder="Masukkan instruksi khusus atau catatan internal di sini..." 
                                class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-[#fbc02d] focus:border-[#fbc02d] outline-none transition text-sm font-semibold resize-none">{{ old('catatan_admin', $booking->catatan_admin) }}</textarea>
                            <p class="text-[9px] text-gray-300 mt-1 uppercase font-bold text-right italic font-bold">Catatan ini TIDAK terlihat oleh pelanggan</p>
                        </div>
                    </div>

                    <div class="p-8 bg-gray-50 border-t border-gray-100 flex justify-end gap-3">
                        <button type="submit" class="w-full sm:w-auto px-10 py-4 bg-[#1a237e] text-white rounded-xl font-black text-sm hover:bg-blue-800 transition shadow-lg shadow-blue-900/20 uppercase tracking-widest">
                            Simpan Perubahan & Update
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
