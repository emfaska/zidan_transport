<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <link rel="icon" type="image/png" href="{{ asset('images/logo.png') }}">
    <title>Riwayat Pekerjaan - Zidan Transport</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <style>
        body { font-family: 'Montserrat', sans-serif; }
    </style>
</head>
<body class="bg-gray-50 pb-24">

    <!-- Header -->
    <div class="bg-[#1a237e] pt-12 pb-8 px-6 rounded-b-[32px] shadow-lg sticky top-0 z-50">
        <div class="flex items-center justify-between mb-4">
            <a href="{{ route('driver.dashboard') }}" class="w-10 h-10 flex items-center justify-center bg-white/10 rounded-xl text-white">
                <i class="bi bi-chevron-left text-xl"></i>
            </a>
            <h1 class="text-lg font-black text-white uppercase tracking-widest">Riwayat Tugas</h1>
            <div class="w-10"></div> <!-- Spacer -->
        </div>
    </div>

    <!-- History List -->
    <main class="px-6 mt-8 space-y-4">
        @forelse($bookings as $booking)
            <div class="bg-white rounded-3xl p-5 shadow-sm border border-gray-100 flex items-center gap-4 group active:scale-[0.98] transition">
                <div class="w-12 h-12 bg-blue-50 text-[#1a237e] rounded-2xl flex items-center justify-center flex-shrink-0 group-hover:bg-[#1a237e] group-hover:text-white transition">
                    <i class="bi bi-check-circle-fill text-xl"></i>
                </div>
                <div class="flex-1 min-w-0">
                    <div class="flex justify-between items-start mb-1">
                        <div>
                            <span class="text-[9px] font-black text-gray-400 uppercase tracking-widest block mb-0.5">{{ $booking->rute->layanan->nama_layanan ?? '' }}</span>
                            <h4 class="text-sm font-black text-[#1a237e] truncate pr-2 uppercase">{{ $booking->rute->nama_rute }}</h4>
                        </div>
                        <span class="text-[9px] font-black text-gray-300 flex-shrink-0">{{ $booking->tanggal_berangkat->format('d/m/Y') }}</span>
                    </div>
                    <div class="flex items-center gap-2 text-[10px] text-gray-500 font-bold">
                        <i class="bi bi-person-fill text-[#fbc02d]"></i>
                        <span>{{ $booking->user->name }}</span>
                        <span class="mx-1">•</span>
                        <span>{{ \Carbon\Carbon::parse($booking->waktu_jemput)->format('H:i') }} WIB</span>
                    </div>
                </div>
            </div>
        @empty
            <div class="text-center py-20">
                <div class="w-20 h-20 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
                    <i class="bi bi-invoices text-4xl text-gray-300"></i>
                </div>
                <h3 class="text-sm font-bold text-gray-700">Belum Ada Riwayat</h3>
                <p class="text-xs text-gray-400 mt-1">Tugas yang Anda selesaikan akan muncul di sini.</p>
            </div>
        @endforelse

        <!-- Pagination -->
        <div class="pt-4">
            {{ $bookings->links() }}
        </div>
    </main>

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

</body>
</html>
