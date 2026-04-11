<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('images/favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('images/favicon-16x16.png') }}">
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('images/apple-touch-icon.png') }}">
    <title>Pembayaran - Zidan Transport</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <style>
        body { font-family: 'Montserrat', sans-serif; }
    </style>
</head>
<body class="bg-[#f8faff]">

    <!-- Navbar -->
    <nav class="bg-white/95 backdrop-blur-md fixed w-full z-50 shadow-sm border-b border-gray-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-20 items-center">
                <div class="flex-shrink-0 flex items-center">
                    <a href="{{ route('home') }}" class="flex items-center gap-3">
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

    <main class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 pt-32 pb-20">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            
            <!-- Left: Payment Info -->
            <div class="lg:col-span-2 space-y-6">
                <div class="bg-white rounded-[40px] shadow-2xl border border-gray-100 overflow-hidden">
                    <div class="p-8 md:p-10 text-center">
                        <div class="flex flex-col items-center gap-6 mb-10">
                            <div class="w-20 h-20 rounded-3xl bg-blue-50 flex items-center justify-center text-[#1a237e] border border-blue-100 shadow-inner">
                                <i class="bi bi-shield-check text-4xl"></i>
                            </div>
                            <div>
                                <h2 class="text-3xl font-black text-[#1a237e] uppercase tracking-tighter leading-none">
                                    {{ $sudahBayar > 0 ? 'Pelunasan Pesanan' : 'Pilih Tipe Bayar' }}
                                </h2>
                                <p class="text-[10px] text-gray-400 font-bold uppercase tracking-[0.2em] mt-3">
                                    {{ $sudahBayar > 0 ? 'Selesaikan sisa pembayaran Anda' : 'Tersedia opsi DP untuk kenyamanan Anda' }}
                                </p>
                            </div>
                        </div>

                        <!-- Tipe Pembayaran Selection -->
                        @if($sudahBayar == 0)
                        <div class="grid grid-cols-2 gap-4 mb-10">
                            <label class="cursor-pointer group">
                                <input type="radio" name="tipe_pembayaran" value="dp" class="peer hidden" {{ $paymentType === 'dp' ? 'checked' : '' }}>
                                <div class="p-5 border-2 border-gray-100 rounded-[28px] bg-gray-50 text-center peer-checked:border-[#1a237e] peer-checked:bg-blue-50 transition-all group-hover:bg-white group-hover:shadow-lg">
                                    <p class="text-xs font-black text-[#1a237e] uppercase tracking-widest">Down Payment (30%)</p>
                                    <p class="text-[9px] text-[#fbc02d] font-bold mt-1 uppercase tracking-tight">Rp {{ number_format($booking->total_harga * 0.3, 0, ',', '.') }}</p>
                                </div>
                            </label>
                            <label class="cursor-pointer group">
                                <input type="radio" name="tipe_pembayaran" value="lunas" class="peer hidden" {{ $paymentType === 'lunas' ? 'checked' : '' }}>
                                <div class="p-5 border-2 border-gray-100 rounded-[28px] bg-gray-50 text-center peer-checked:border-[#1a237e] peer-checked:bg-blue-50 transition-all group-hover:bg-white group-hover:shadow-lg">
                                    <p class="text-xs font-black text-[#1a237e] uppercase tracking-widest">Bayar Lunas (Full)</p>
                                    <p class="text-[9px] text-green-600 font-bold mt-1 uppercase tracking-tight">Rp {{ number_format($booking->total_harga, 0, ',', '.') }}</p>
                                </div>
                            </label>
                        </div>
                        @else
                        <div class="mb-10 space-y-3">
                            <div class="flex justify-between items-center p-4 bg-gray-50 rounded-2xl border border-gray-100">
                                <span class="text-[10px] font-black text-gray-400 uppercase tracking-widest">Total Harga</span>
                                <span class="text-xs font-bold text-[#1a237e]">Rp {{ number_format($totalHarga, 0, ',', '.') }}</span>
                            </div>
                            <div class="flex justify-between items-center p-4 bg-blue-50 rounded-2xl border border-blue-100">
                                <span class="text-[10px] font-black text-blue-400 uppercase tracking-widest">Telah Dibayar (DP)</span>
                                <span class="text-xs font-bold text-blue-700">Rp {{ number_format($sudahBayar, 0, ',', '.') }}</span>
                            </div>
                        </div>
                        @endif

                        <div class="p-8 bg-gray-50 rounded-[35px] border-2 border-gray-100 mb-10">
                            <p class="text-[11px] font-black text-[#1a237e]/50 uppercase tracking-[0.2em] mb-2">
                                {{ $sudahBayar > 0 ? 'Sisa Tagihan Pelunasan' : 'Total Yang Akan Dibayar' }}
                            </p>
                            <h3 class="text-4xl font-black text-{{ $sudahBayar > 0 ? 'green' : '[#1a237e]' }}">Rp {{ number_format($amountToPay, 0, ',', '.') }}</h3>
                        </div>

                        <div class="space-y-4">
                            <button type="button" id="pay-button" class="w-full py-6 bg-[#1a237e] text-white rounded-[28px] font-black uppercase tracking-[0.2em] shadow-2xl shadow-blue-900/40 hover:bg-[#0d1440] hover:-translate-y-1 transition-all active:scale-95 flex items-center justify-center gap-4 text-lg">
                                BAYAR SEKARANG <i class="bi bi-credit-card text-2xl"></i>
                            </button>
                            <p class="text-[10px] text-gray-400 font-bold uppercase tracking-widest leading-relaxed">
                                <i class="bi bi-lock-fill text-[#fbc02d]"></i> Terenkripsi & Aman • Mendukung VA, E-Wallet, & Kartu Kredit
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Safe Payment Info -->
                <div class="bg-[#1a237e] rounded-[40px] shadow-xl p-8 text-white flex items-center gap-6">
                    <div class="w-16 h-16 rounded-2xl bg-white/10 flex items-center justify-center text-[#fbc02d] text-2xl shrink-0">
                        <i class="bi bi-info-circle"></i>
                    </div>
                    <div>
                        <p class="text-sm font-black text-[#fbc02d] uppercase tracking-widest mb-1">Informasi</p>
                        <p class="text-xs text-blue-100 leading-relaxed font-medium">Anda akan diarahkan ke jendela pembayaran aman Midtrans. Setelah pembayaran berhasil, status pesanan Anda akan diperbarui secara otomatis.</p>
                    </div>
                </div>
            </div>

            <!-- Right: Order Summary -->
            <div class="space-y-6">
                <div class="bg-white rounded-[40px] shadow-xl border border-gray-100 p-8">
                    <h3 class="text-sm font-black text-[#1a237e] uppercase tracking-[0.2em] mb-6 border-b border-gray-50 pb-4">Ringkasan Pesanan</h3>
                    <div class="space-y-5">
                        <div class="flex justify-between items-center">
                            <span class="text-[9px] font-black text-gray-400 uppercase">Kode Booking</span>
                            <span class="text-xs font-black text-[#1a237e]">{{ $booking->kode_booking }}</span>
                        </div>
                        <div class="flex justify-between items-center">
                            <span class="text-[9px] font-black text-gray-400 uppercase">Pelanggan</span>
                            <span class="text-xs font-black text-[#1a237e]">{{ $booking->user->name }}</span>
                        </div>
                        <div class="flex justify-between items-center">
                            <span class="text-[9px] font-black text-gray-400 uppercase">Armada</span>
                            <span class="text-xs font-black text-[#1a237e] truncate ml-4">{{ $booking->armada->nama ?? ($booking->rute->armada->nama ?? 'Armada') }}</span>
                        </div>
                        <div class="flex justify-between items-center">
                            <span class="text-[9px] font-black text-gray-400 uppercase">Tanggal</span>
                            <span class="text-xs font-black text-[#1a237e]">{{ $booking->tanggal_berangkat->format('d M Y') }}</span>
                        </div>
                        <div class="flex justify-between items-center pt-4 border-t border-dashed border-gray-100">
                            <span class="text-[10px] font-black text-[#1a237e] uppercase tracking-widest">Total</span>
                            <span class="text-lg font-black text-[#fbc02d]">Rp {{ number_format($booking->total_harga, 0, ',', '.') }}</span>
                        </div>
                    </div>
                </div>

                <!-- Midtrans Trust Badge -->
                <div class="bg-white rounded-[40px] shadow-lg border border-gray-50 p-6 flex flex-col items-center justify-center gap-4">
                    <img src="https://midtrans.com/assets/img/og-midtrans.png" class="h-8 grayscale opacity-50 inverse" alt="Midtrans Security">
                    <p class="text-[8px] font-bold text-gray-300 uppercase tracking-[0.3em]">Official Payment Partner</p>
                </div>
            </div>
        </div>
    </main>

    <!-- Midtrans Snap JS -->
    <script src="{{ config('midtrans.is_production') ? 'https://app.midtrans.com/snap/snap.js' : 'https://app.sandbox.midtrans.com/snap/snap.js' }}" data-client-key="{{ config('midtrans.client_key') }}"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const payButton = document.getElementById('pay-button');
            const typeRadios = document.querySelectorAll('input[name="tipe_pembayaran"]');

            // Handle type change
            typeRadios.forEach(radio => {
                radio.addEventListener('change', function() {
                    const type = this.value;
                    window.location.href = `{{ route('pelanggan.booking.payment', $booking->id) }}?type=${type}`;
                });
            });

            if (payButton) {
                payButton.addEventListener('click', function(e) {
                    e.preventDefault();
                    
                    // Show Snap popup
                    snap.pay('{{ $booking->snap_token }}', {
                        onSuccess: function(result) {
                            window.location.href = "{{ route('pelanggan.booking.index') }}";
                        },
                        onPending: function(result) {
                            window.location.href = "{{ route('pelanggan.booking.index') }}";
                        },
                        onError: function(result) {
                            console.error(result);
                            alert("Kesalahan saat memproses pembayaran. Silakan coba lagi.");
                        },
                        onClose: function() {
                            // User closed the popup
                        }
                    });
                });
            }
        });
    </script>
</body>
</html>
