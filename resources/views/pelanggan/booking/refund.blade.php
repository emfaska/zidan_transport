<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" href="{{ asset('images/logo.png') }}">
    <title>Ajukan Pengembalian Dana (Refund) - Zidan Transport</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <style>body { font-family: 'Montserrat', sans-serif; }</style>
</head>
<body class="bg-[#f8faff] min-h-screen flex flex-col">

    <nav class="bg-white/95 backdrop-blur-md w-full shadow-sm border-b border-gray-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-20 items-center">
                <div class="flex-shrink-0 flex items-center">
                    <a href="{{ route('pelanggan.booking.index') }}" class="flex items-center gap-3">
                        <img class="h-12 w-auto" src="{{ asset('images/logo.png') }}" alt="Zidan Transport">
                        <div class="flex flex-col">
                            <span class="text-lg font-black text-[#1a237e] leading-none uppercase tracking-tighter">Zidan</span>
                            <span class="text-[10px] font-bold text-[#fbc02d] uppercase tracking-[0.2em] leading-none mt-1">Transport</span>
                        </div>
                    </a>
                </div>
                <a href="{{ route('pelanggan.booking.index') }}" class="text-gray-500 hover:text-[#1a237e] font-bold flex items-center gap-2 transition text-sm uppercase tracking-widest">
                    <i class="bi bi-arrow-left"></i> Kembali
                </a>
            </div>
        </div>
    </nav>

    <main class="flex-grow flex items-center justify-center p-4 py-12">
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
    </main>

</body>
</html>
