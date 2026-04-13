@extends('layouts.driver')

@section('title', 'Dompet Saya - Zidan Driver')

@push('styles')
<style>
    .fade-up { animation: fadeUp 0.5s ease forwards; }
    .fade-up-2 { animation: fadeUp 0.5s 0.1s ease forwards; opacity:0; }
    .fade-up-3 { animation: fadeUp 0.5s 0.2s ease forwards; opacity:0; }
</style>
@endpush

@section('content')
    {{-- ==================== HEADER ==================== --}}
    <div class="bg-gradient-to-br from-[#1a237e] via-[#283593] to-[#0d1440] pt-10 pb-28 px-6 rounded-b-[48px] shadow-2xl relative overflow-hidden">
        {{-- Decorative circles --}}
        <div class="absolute -top-16 -right-16 w-56 h-56 rounded-full bg-white/5 pointer-events-none"></div>
        <div class="absolute top-12 -right-8 w-32 h-32 rounded-full bg-[#fbc02d]/10 pointer-events-none"></div>

        <div class="relative z-10 flex justify-between items-center mb-8">
            <a href="{{ route('driver.dashboard') }}" class="w-10 h-10 flex items-center justify-center bg-white/10 rounded-xl hover:bg-white/20 transition">
                <i class="bi bi-arrow-left text-white text-xl"></i>
            </a>
            <h1 class="text-sm font-black text-white uppercase tracking-[0.2em]">Dompet Saya</h1>
            <div class="w-10"></div>{{-- spacer --}}
        </div>

        {{-- Saldo Utama --}}
        <div class="relative z-10 text-center fade-up">
            <p class="text-[10px] font-black text-blue-300 uppercase tracking-[0.3em] mb-2">Saldo Tersedia</p>
            <h2 class="text-4xl font-black text-white leading-none mb-1">
                Rp {{ number_format($wallet->balance, 0, ',', '.') }}
            </h2>
            <p class="text-[11px] text-blue-200 font-semibold">{{ Auth::user()->name }}</p>
        </div>
    </div>

    {{-- ==================== STATS CARDS (Overlap Header) ==================== --}}
    <div class="px-5 -mt-16 mb-6 relative z-20 fade-up-2">
        <div class="grid grid-cols-2 gap-4">
            <div class="glass-card p-4 rounded-3xl shadow-xl text-center">
                <div class="w-9 h-9 bg-green-50 text-green-600 rounded-xl flex items-center justify-center mx-auto mb-2">
                    <i class="bi bi-graph-up-arrow"></i>
                </div>
                <p class="text-[9px] font-black text-gray-400 uppercase tracking-widest mb-1">Total Komisi</p>
                <p class="text-base font-black text-[#1a237e]">Rp {{ number_format($wallet->total_earned, 0, ',', '.') }}</p>
            </div>
            <div class="glass-card p-4 rounded-3xl shadow-xl text-center">
                <div class="w-9 h-9 bg-yellow-50 text-[#fbc02d] rounded-xl flex items-center justify-center mx-auto mb-2">
                    <i class="bi bi-bank"></i>
                </div>
                <p class="text-[9px] font-black text-gray-400 uppercase tracking-widest mb-1">Dicairkan</p>
                <p class="text-base font-black text-[#1a237e]">Rp {{ number_format($wallet->total_withdrawn, 0, ',', '.') }}</p>
            </div>
        </div>
    </div>

    <main class="px-5 space-y-6 fade-up-3 pb-32">
        {{-- ==================== NOTIFIKASI ==================== --}}
        @if(session('success'))
            <div class="bg-green-500 text-white p-4 rounded-2xl shadow-lg flex items-center gap-3">
                <i class="bi bi-check-circle-fill text-xl"></i>
                <p class="text-[11px] font-bold">{{ session('success') }}</p>
            </div>
        @endif

        @if($errors->any())
            <div class="bg-red-50 border border-red-200 text-red-700 p-4 rounded-2xl flex items-start gap-3">
                <i class="bi bi-exclamation-triangle-fill mt-0.5"></i>
                <p class="text-[11px] font-bold">{{ $errors->first() }}</p>
            </div>
        @endif

        {{-- ==================== STATUS WITHDRAW TERAKHIR ==================== --}}
        @if($lastWithdrawal)
            <div class="@if($lastWithdrawal->status === 'pending') bg-amber-50 border border-amber-200
                        @elseif($lastWithdrawal->status === 'approved') bg-green-50 border border-green-200
                        @else bg-red-50 border border-red-200 @endif
                        p-4 rounded-2xl">
                <div class="flex items-center justify-between mb-1">
                    <p class="text-[10px] font-black text-gray-500 uppercase tracking-widest">Pencairan Terakhir</p>
                    @if($lastWithdrawal->status === 'pending')
                        <span class="text-[9px] font-black bg-amber-200 text-amber-800 px-2 py-0.5 rounded-full uppercase">Menunggu</span>
                    @elseif($lastWithdrawal->status === 'approved')
                        <span class="text-[9px] font-black bg-green-200 text-green-800 px-2 py-0.5 rounded-full uppercase">Disetujui</span>
                    @else
                        <span class="text-[9px] font-black bg-red-200 text-red-800 px-2 py-0.5 rounded-full uppercase">Ditolak</span>
                    @endif
                </div>
                <p class="text-sm font-black text-[#1a237e]">Rp {{ number_format($lastWithdrawal->amount, 0, ',', '.') }}</p>
                <p class="text-[10px] text-gray-500 font-semibold">{{ $lastWithdrawal->nama_bank }} — {{ $lastWithdrawal->no_rekening }}</p>
            </div>
        @endif

        {{-- ==================== TOMBOL PENCAIRAN ==================== --}}
        @if($wallet->balance >= 10000 && !$hasPendingWithdrawal)
            <button id="withdraw-btn"
                class="w-full bg-gradient-to-r from-[#fbc02d] to-[#f9a825] text-[#1a237e] font-black py-4 rounded-2xl shadow-lg shadow-yellow-200 flex items-center justify-center gap-2 uppercase tracking-widest text-[11px] hover:shadow-xl hover:scale-[1.01] transition-all active:scale-95">
                <i class="bi bi-bank2 text-lg"></i>
                Ajukan Pencairan Dana
            </button>
        @elseif($hasPendingWithdrawal)
            <div class="w-full bg-amber-50 border border-amber-200 text-amber-700 font-bold py-4 rounded-2xl flex items-center justify-center gap-2 text-[11px]">
                <i class="bi bi-hourglass-split"></i>
                Pencairan sedang diproses admin
            </div>
        @else
            <div class="w-full bg-gray-100 text-gray-400 font-bold py-4 rounded-2xl flex items-center justify-center gap-2 text-[11px]">
                <i class="bi bi-wallet2"></i>
                Saldo minimum pencairan Rp 10.000
            </div>
        @endif

        {{-- ==================== RIWAYAT TRANSAKSI ==================== --}}
        <div>
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-sm font-black text-[#1a237e] uppercase tracking-[0.15em]">Riwayat Transaksi</h3>
                <span class="text-[10px] font-bold text-gray-400 bg-gray-100 px-3 py-1 rounded-full">{{ $transactions->total() }} transaksi</span>
            </div>

            @forelse($transactions as $trx)
                <div class="bg-white rounded-2xl p-4 shadow-sm border border-gray-50 mb-3 flex items-center gap-4">
                    <div class="w-11 h-11 rounded-2xl flex items-center justify-center flex-shrink-0
                        {{ $trx->type === 'credit' ? 'bg-green-50 text-green-600' : 'bg-red-50 text-red-500' }}">
                        <i class="bi {{ $trx->type === 'credit' ? 'bi-arrow-down-circle-fill' : 'bi-arrow-up-circle-fill' }} text-xl"></i>
                    </div>
                    <div class="flex-1 min-w-0">
                        <p class="text-[11px] font-bold text-[#1a237e] leading-tight truncate">{{ $trx->description }}</p>
                        <p class="text-[10px] text-gray-400 font-semibold mt-0.5">{{ $trx->created_at->format('d M Y, H:i') }}</p>
                    </div>
                    <div class="text-right flex-shrink-0">
                        <p class="text-sm font-black {{ $trx->type === 'credit' ? 'text-green-600' : 'text-red-500' }}">
                            {{ $trx->type === 'credit' ? '+' : '-' }}Rp {{ number_format($trx->amount, 0, ',', '.') }}
                        </p>
                    </div>
                </div>
            @empty
                <div class="bg-white rounded-2xl p-10 text-center shadow-sm border-2 border-dashed border-gray-100">
                    <p class="text-sm font-bold text-gray-400">Belum ada riwayat transaksi</p>
                </div>
            @endforelse

            {{-- Pagination --}}
            @if($transactions->hasPages())
                <div class="mt-4">{{ $transactions->links() }}</div>
            @endif
        </div>
    </main>

    {{-- ==================== MODAL PENCAIRAN ==================== --}}
    <div id="modal-withdraw" class="hidden fixed inset-0 z-[100] flex items-end justify-center bg-black/60 backdrop-blur-sm px-4 pb-6">
        <div class="bg-white w-full max-w-md rounded-[32px] p-6 shadow-2xl">
            <div class="flex items-center justify-between mb-5">
                <div>
                    <h3 class="text-base font-black text-[#1a237e]">Ajukan Pencairan</h3>
                    <p class="text-[10px] text-gray-400 font-semibold">Saldo: Rp {{ number_format($wallet->balance, 0, ',', '.') }}</p>
                </div>
                <button type="button" id="close-modal"
                    class="w-9 h-9 flex items-center justify-center bg-gray-100 rounded-xl hover:bg-gray-200 transition">
                    <i class="bi bi-x-lg text-gray-600"></i>
                </button>
            </div>

            <form action="{{ route('driver.wallet.withdraw') }}" method="POST" class="space-y-4">
                @csrf
                <div>
                    <label class="block text-[10px] font-black text-gray-500 uppercase tracking-widest mb-1.5">Nominal Pencairan</label>
                    <div class="relative">
                        <span class="absolute left-4 top-1/2 -translate-y-1/2 text-sm font-black text-gray-400">Rp</span>
                        <input type="number" name="amount" min="10000" max="{{ $wallet->balance }}"
                            placeholder="Contoh: 50000"
                            class="w-full pl-10 pr-4 py-3.5 bg-gray-50 border border-gray-200 rounded-2xl text-sm font-bold text-[#1a237e] focus:outline-none focus:border-[#1a237e] focus:ring-2 focus:ring-[#1a237e]/10"
                            required>
                    </div>
                </div>

                <div>
                    <label class="block text-[10px] font-black text-gray-500 uppercase tracking-widest mb-1.5">Nama Bank</label>
                    <select name="nama_bank" required
                        class="w-full px-4 py-3.5 bg-gray-50 border border-gray-200 rounded-2xl text-sm font-bold text-[#1a237e] focus:outline-none focus:border-[#1a237e] appearance-none">
                        <option value="" disabled selected>Pilih bank...</option>
                        <option>BCA</option><option>BRI</option><option>BNI</option><option>Mandiri</option>
                        <option>DANA</option><option>GoPay</option><option>OVO</option>
                    </select>
                </div>

                <div>
                    <label class="block text-[10px] font-black text-gray-500 uppercase tracking-widest mb-1.5">Nomor Rekening / Dompet</label>
                    <input type="text" name="no_rekening" placeholder="Contoh: 0895..."
                        class="w-full px-4 py-3.5 bg-gray-50 border border-gray-200 rounded-2xl text-sm font-bold text-[#1a237e]"
                        required>
                </div>

                <div>
                    <label class="block text-[10px] font-black text-gray-500 uppercase tracking-widest mb-1.5">Nama Pemilik Rekening</label>
                    <input type="text" name="nama_rekening" value="{{ Auth::user()->name }}"
                        class="w-full px-4 py-3.5 bg-gray-50 border border-gray-200 rounded-2xl text-sm font-bold text-[#1a237e]"
                        required>
                </div>

                <button type="submit"
                    class="w-full bg-[#1a237e] text-white font-black py-4 rounded-2xl shadow-lg uppercase tracking-widest text-[11px]">
                    <i class="bi bi-send-fill mr-2"></i>Kirim Permintaan
                </button>
            </form>
        </div>
    </div>
@endsection

@push('scripts')
<script>
    document.addEventListener('turbo:load', () => {
        const withdrawBtn = document.getElementById('withdraw-btn');
        const closeModal = document.getElementById('close-modal');
        const modal = document.getElementById('modal-withdraw');

        if (withdrawBtn && modal) {
            withdrawBtn.onclick = () => modal.classList.remove('hidden');
        }
        if (closeModal && modal) {
            closeModal.onclick = () => modal.classList.add('hidden');
        }
    });
</script>
@endpush
