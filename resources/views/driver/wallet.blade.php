@extends('layouts.driver')

@section('title', 'Dompet Saya - Zidan Driver')

@section('content')
    <!-- Header Section (Premium Gradient) -->
    <div class="bg-gradient-to-br from-[#1a237e] via-[#283593] to-[#0a0f30] pt-12 pb-28 px-6 rounded-b-[50px] shadow-2xl relative overflow-hidden">
        <div class="absolute -top-16 -right-16 w-64 h-64 bg-white/5 rounded-full blur-3xl pointer-events-none"></div>
        <div class="absolute top-20 -left-10 w-32 h-32 bg-[#fbc02d]/10 rounded-full blur-2xl pointer-events-none"></div>

        <div class="relative z-10 flex justify-between items-center mb-10">
            <a href="{{ route('driver.dashboard') }}" class="w-10 h-10 flex items-center justify-center bg-white/10 rounded-xl hover:bg-white/20 transition backdrop-blur-md">
                <i class="bi bi-chevron-left text-white text-xl"></i>
            </a>
            <h1 class="text-xs font-[900] text-white uppercase tracking-[0.3em]">Dompet Pendapatan</h1>
            <div class="w-10 h-10 flex items-center justify-center bg-white/10 rounded-2xl text-white">
                <i class="bi bi-wallet-fill text-lg"></i>
            </div>
        </div>

        <div class="relative z-10 text-center animate-fade-in-up">
            <p class="text-[10px] font-black text-blue-300/80 uppercase tracking-[0.4em] mb-3">Total Saldo Tersedia</p>
            <div class="flex items-center justify-center gap-2">
                <span class="text-2xl font-black text-blue-300 italic">Rp</span>
                <h2 class="text-5xl font-[950] text-white tracking-tighter">
                    {{ number_format($wallet->balance, 0, ',', '.') }}
                </h2>
            </div>
            <div class="mt-4 inline-flex items-center gap-2 px-4 py-1.5 bg-white/10 rounded-full border border-white/10 backdrop-blur-md">
                <span class="w-1.5 h-1.5 rounded-full bg-green-400"></span>
                <p class="text-[9px] text-white font-black uppercase tracking-widest">Akun Terverifikasi</p>
            </div>
        </div>
    </div>

    <!-- Quick Actions & Stats -->
    <div class="px-6 -mt-12 mb-8 relative z-20">
        <div class="grid grid-cols-2 gap-4">
            <div class="bg-white/95 backdrop-blur-lg p-5 rounded-[32px] shadow-xl border border-white/50 flex flex-col items-center text-center">
                <div class="w-10 h-10 bg-green-50 text-green-600 rounded-2xl flex items-center justify-center mb-3">
                    <i class="bi bi-graph-up-arrow text-xl"></i>
                </div>
                <p class="text-[9px] font-black text-gray-400 uppercase tracking-widest mb-1">Total Komisi</p>
                <p class="text-sm font-black text-[#1a237e]">Rp {{ number_format($wallet->total_earned, 0, ',', '.') }}</p>
            </div>
            <div class="bg-white/95 backdrop-blur-lg p-5 rounded-[32px] shadow-xl border border-white/50 flex flex-col items-center text-center">
                <div class="w-10 h-10 bg-blue-50 text-[#1a237e] rounded-2xl flex items-center justify-center mb-3">
                    <i class="bi bi-bank text-xl"></i>
                </div>
                <p class="text-[9px] font-black text-gray-400 uppercase tracking-widest mb-1">Sudah Cair</p>
                <p class="text-sm font-black text-[#1a237e]">Rp {{ number_format($wallet->total_withdrawn, 0, ',', '.') }}</p>
            </div>
        </div>
    </div>

    <main class="px-6 space-y-6 pb-32">
        <!-- Error & Success Messages -->
        @if(session('success'))
            <div class="bg-green-100 text-green-800 p-4 rounded-2xl border border-green-200 flex items-center gap-3 animate-up">
                <i class="bi bi-check-circle-fill"></i>
                <p class="text-[11px] font-bold uppercase tracking-tight">{{ session('success') }}</p>
            </div>
        @endif

        @if($errors->any())
            <div class="bg-red-50 text-red-700 p-4 rounded-2xl border border-red-100 flex items-center gap-3 animate-up">
                <i class="bi bi-exclamation-triangle-fill"></i>
                <p class="text-[11px] font-bold uppercase tracking-tight">{{ $errors->first() }}</p>
            </div>
        @endif

        <!-- Withdraw Button Logic -->
        <div class="animate-up" style="animation-delay: 0.1s">
            @if($wallet->balance >= 10000 && !$hasPendingWithdrawal)
                <button id="withdraw-btn" class="w-full bg-[#fbc02d] hover:bg-yellow-500 text-[#1a237e] font-[950] py-5 rounded-[24px] shadow-2xl shadow-yellow-500/20 flex items-center justify-center gap-3 uppercase tracking-[0.2em] text-[11px] transition-all transform active:scale-95">
                    <i class="bi bi-arrow-up-right-circle-fill text-xl"></i>
                    Tarik Dana Sekarang
                </button>
            @elseif($hasPendingWithdrawal)
                <div class="w-full bg-amber-50 border border-amber-200 text-amber-700 p-5 rounded-[24px] flex flex-col items-center gap-2">
                    <i class="bi bi-hourglass-split text-2xl animate-spin-slow"></i>
                    <p class="text-[10px] font-black uppercase tracking-widest">Penarikan Sedang Diproses Admin</p>
                </div>
            @else
                <div class="w-full bg-gray-50 border border-gray-200 text-gray-400 p-5 rounded-[24px] text-center">
                    <i class="bi bi-info-circle text-xl mb-1 block"></i>
                    <p class="text-[10px] font-black uppercase tracking-widest">Saldo Minimum Penarikan: Rp 10.000</p>
                </div>
            @endif
        </div>

        <!-- Transaction History -->
        <div class="space-y-4 animate-up" style="animation-delay: 0.2s">
            <div class="flex items-center justify-between mb-2">
                <h3 class="text-[10px] font-black text-[#1a237e] uppercase tracking-[0.2em] ml-2">Arus Kas Dompet</h3>
                <span class="text-[9px] font-black text-gray-300 uppercase tracking-widest">Terbaru</span>
            </div>

            @forelse($transactions as $trx)
                <div class="bg-white rounded-[28px] p-5 shadow-sm border border-gray-50 flex items-center justify-between group">
                    <div class="flex items-center gap-4">
                        <div class="w-11 h-11 rounded-2xl flex items-center justify-center text-lg {{ $trx->type === 'credit' ? 'bg-green-50 text-green-600' : 'bg-red-50 text-red-500' }}">
                            <i class="bi {{ $trx->type === 'credit' ? 'bi-plus-circle-fill' : 'bi-dash-circle-fill' }}"></i>
                        </div>
                        <div>
                            <p class="text-xs font-black text-[#1a237e] leading-tight mb-1">{{ $trx->description }}</p>
                            <p class="text-[10px] text-gray-400 font-bold uppercase">{{ $trx->created_at->translatedFormat('d M, H:i') }} WIB</p>
                        </div>
                    </div>
                    <p class="text-sm font-[900] {{ $trx->type === 'credit' ? 'text-green-600' : 'text-red-500' }} tracking-tighter italic">
                        {{ $trx->type === 'credit' ? '+' : '-' }}Rp{{ number_format($trx->amount, 0, ',', '.') }}
                    </p>
                </div>
            @empty
                <div class="text-center py-20 bg-gray-50 rounded-[40px] border-2 border-dashed border-gray-200">
                    <p class="text-[10px] font-black text-gray-300 uppercase tracking-widest">Belum Ada Transaksi</p>
                </div>
            @endforelse

            @if($transactions->hasPages())
                <div class="pt-4">{{ $transactions->links() }}</div>
            @endif
        </div>
    </main>

    <!-- Modal Withdrawal (Professional Bottom Sheet style) -->
    <div id="modal-withdraw" class="hidden fixed inset-0 z-[100] flex items-end md:items-center justify-center bg-black/70 backdrop-blur-md transition-all duration-300">
        <div class="bg-white w-full max-w-lg rounded-t-[40px] md:rounded-[40px] p-8 shadow-2xl animate-up">
            <div class="flex justify-between items-center mb-8 pb-4 border-b border-gray-50">
                <h3 class="text-lg font-black text-[#1a237e] uppercase tracking-tighter">Formulir Pencairan</h3>
                <button type="button" id="close-modal" class="w-10 h-10 flex items-center justify-center bg-gray-50 rounded-xl hover:bg-red-50 hover:text-red-500 transition-colors">
                    <i class="bi bi-x-lg"></i>
                </button>
            </div>

            <form action="{{ route('driver.wallet.withdraw') }}" method="POST" class="space-y-5">
                @csrf
                <div class="space-y-2">
                    <label class="text-[10px] font-black text-gray-400 uppercase tracking-widest ml-1">Nominal (Rp)</label>
                    <input type="number" name="amount" min="10000" max="{{ $wallet->balance }}" placeholder="Minimal 10,000" class="w-full px-6 py-4 bg-gray-50 border border-gray-100 rounded-2xl text-base font-black text-[#1a237e] focus:bg-white focus:border-[#1a237e] transition outline-none shadow-inner" required>
                </div>
                <div class="space-y-2">
                    <label class="text-[10px] font-black text-gray-400 uppercase tracking-widest ml-1">Nama Bank / e-Wallet</label>
                    <select name="nama_bank" class="w-full px-6 py-4 bg-gray-50 border border-gray-100 rounded-2xl text-sm font-black text-[#1a237e] appearance-none cursor-pointer" required>
                        <option value="" disabled selected>Pilih Bank Pelunasan...</option>
                        <option>BCA</option><option>BRI</option><option>BNI</option><option>Mandiri</option>
                        <option>DANA</option><option>GoPay</option><option>OVO</option>
                    </select>
                </div>
                <div class="space-y-2">
                    <label class="text-[10px] font-black text-gray-400 uppercase tracking-widest ml-1">No. Rekening / No. HP</label>
                    <input type="text" name="no_rekening" placeholder="Contoh: 0821..." class="w-full px-6 py-4 bg-gray-50 border border-gray-100 rounded-2xl text-sm font-black text-[#1a237e] placeholder:text-gray-300" required>
                </div>
                <div class="space-y-2 pb-4">
                    <label class="text-[10px] font-black text-gray-400 uppercase tracking-widest ml-1">Atas Nama Pemilik</label>
                    <input type="text" name="nama_rekening" value="{{ Auth::user()->name }}" class="w-full px-6 py-4 bg-gray-50 border border-gray-100 rounded-2xl text-sm font-black text-[#1a237e]" required>
                </div>

                <button type="submit" class="w-full py-5 bg-[#1a237e] text-white font-[950] rounded-2xl uppercase tracking-[0.2em] text-[11px] shadow-2xl shadow-blue-900/40 active:scale-95 transition">
                    Konfirmasi Penarikan <i class="bi bi-send-fill ml-2"></i>
                </button>
            </form>
        </div>
    </div>
@endsection

@push('scripts')
<script>
    document.addEventListener('turbo:load', () => {
        const btn = document.getElementById('withdraw-btn');
        const modal = document.getElementById('modal-withdraw');
        const close = document.getElementById('close-modal');

        if(btn && modal) {
            btn.onclick = () => {
                modal.classList.remove('hidden');
                modal.classList.add('flex');
            };
        }
        if(close && modal) {
            close.onclick = () => {
                modal.classList.add('hidden');
                modal.classList.remove('flex');
            };
        }
    });
</script>
@endpush
