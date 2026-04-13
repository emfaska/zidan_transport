@extends('layouts.pelanggan')

@section('title', 'Ajukan Pengembalian Dana (Refund) - Zidan Transport')

@push('styles')
<style>
    body { font-family: 'Plus Jakarta Sans', sans-serif; }
    .font-mont { font-family: 'Montserrat', sans-serif; }
</style>
@endpush

@section('content')
    <div class="flex items-center justify-center pt-8">
        <div class="w-full max-w-2xl bg-white rounded-[40px] shadow-2xl border border-gray-100 overflow-hidden">
            <div class="p-8 md:p-12">
                <div class="text-center mb-10">
                    <div class="w-20 h-20 bg-red-50 text-red-500 rounded-full flex items-center justify-center mx-auto mb-6 shadow-inner border border-red-100">
                        <i class="bi bi-arrow-counterclockwise text-4xl"></i>
                    </div>
                    <h2 class="text-3xl font-black text-[#1a237e] uppercase tracking-tighter">Pembatalan & Refund</h2>
                    <p class="text-xs font-bold text-gray-400 mt-2 uppercase tracking-widest">Kode Booking: {{ $booking->kode_booking }}</p>
                </div>

                <!-- Info Box -->
                <div class="bg-blue-50 border border-blue-100 p-6 rounded-3xl mb-8">
                    <div class="flex justify-between items-center mb-2">
                        <span class="text-[10px] font-black text-blue-400 uppercase tracking-widest">Dana yang bisa dikembalikan (Max)</span>
                        <span class="text-lg font-black text-[#1a237e]">Rp {{ number_format($booking->jumlah_bayar, 0, ',', '.') }}</span>
                    </div>
                    <p class="text-[10px] text-blue-600 font-medium">Dana akan dikembalikan ke rekening Anda maksimal 3x24 jam kerja setelah disetujui admin, bergantung pada kebijakan layanan.</p>
                </div>

                <form action="{{ route('pelanggan.booking.refund.store', $booking->id) }}" method="POST" class="space-y-6">
                    @csrf
                    
                    <div>
                        <label class="block text-[10px] font-black text-[#1a237e] uppercase tracking-widest mb-2">Alasan Pembatalan</label>
                        <textarea name="reason" rows="3" required class="w-full bg-gray-50 border-2 border-gray-100 rounded-2xl p-4 text-sm font-medium text-gray-700 focus:border-[#1a237e] focus:ring-0 transition-colors" placeholder="Tuliskan alasan Anda membatalkan pesanan ini..."></textarea>
                    </div>

                    <div class="relative">
                        <div class="absolute inset-0 flex items-center" aria-hidden="true">
                            <div class="w-full border-t border-gray-200 border-dashed"></div>
                        </div>
                        <div class="relative flex justify-center">
                            <span class="px-3 bg-white text-[10px] font-black text-gray-400 uppercase tracking-widest">Informasi Rekening Pengembalian</span>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-[10px] font-black text-[#1a237e] uppercase tracking-widest mb-2">Nama Bank / E-Wallet</label>
                            <input type="text" name="bank_name" required placeholder="Contoh: BCA / GoPay" class="w-full bg-gray-50 border-2 border-gray-100 rounded-2xl p-4 text-sm font-bold text-[#1a237e] focus:border-[#1a237e] focus:ring-0 transition-colors">
                        </div>
                        <div>
                            <label class="block text-[10px] font-black text-[#1a237e] uppercase tracking-widest mb-2">Atas Nama (Pemilik Rekening)</label>
                            <input type="text" name="account_name" required placeholder="Nama lengkap sesuai rekening" class="w-full bg-gray-50 border-2 border-gray-100 rounded-2xl p-4 text-sm font-bold text-[#1a237e] focus:border-[#1a237e] focus:ring-0 transition-colors">
                        </div>
                        <div class="md:col-span-2">
                            <label class="block text-[10px] font-black text-[#1a237e] uppercase tracking-widest mb-2">Nomor Rekening / No. HP</label>
                            <input type="text" name="account_number" required placeholder="Contoh: 1234567890" class="w-full bg-gray-50 border-2 border-gray-100 rounded-2xl p-4 text-sm font-bold text-[#1a237e] focus:border-[#1a237e] focus:ring-0 transition-colors">
                        </div>
                    </div>

                    <div class="pt-6">
                        <button type="submit" class="w-full bg-red-500 hover:bg-red-600 text-white font-black uppercase tracking-[0.2em] py-5 rounded-[20px] shadow-lg shadow-red-500/30 transition duration-300 transform hover:-translate-y-1">
                            Kirim Permintaan Refund
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
