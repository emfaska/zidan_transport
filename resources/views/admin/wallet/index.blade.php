@extends('layouts.admin')

@section('title', 'Dompet Driver')
@section('header_title', 'Dompet Driver')

@section('content')
<div class="space-y-6">

    {{-- Page Header --}}
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-2xl font-bold text-gray-800">Dompet Driver</h1>
            <p class="text-sm text-gray-500 mt-1">Kelola permintaan pencairan komisi dari pengemudi</p>
        </div>
    </div>

    {{-- Alerts --}}
    @if(session('success'))
        <div class="bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-xl flex items-center gap-3">
            <i class="bi bi-check-circle-fill text-lg"></i>
            {{ session('success') }}
        </div>
    @endif

    {{-- Stats Cards --}}
    <div class="grid grid-cols-2 lg:grid-cols-4 gap-4">
        <div class="bg-white rounded-2xl p-5 shadow-sm border border-gray-100">
            <div class="flex items-center gap-3 mb-3">
                <div class="w-10 h-10 bg-amber-50 text-amber-500 rounded-xl flex items-center justify-center">
                    <i class="bi bi-hourglass-split text-lg"></i>
                </div>
                <p class="text-xs font-bold text-gray-500 uppercase tracking-wider">Menunggu</p>
            </div>
            <p class="text-2xl font-black text-gray-800">{{ $stats['total_pending'] }}</p>
            <p class="text-xs text-gray-400 mt-1">Permintaan aktif</p>
        </div>
        <div class="bg-white rounded-2xl p-5 shadow-sm border border-gray-100">
            <div class="flex items-center gap-3 mb-3">
                <div class="w-10 h-10 bg-green-50 text-green-600 rounded-xl flex items-center justify-center">
                    <i class="bi bi-check-circle text-lg"></i>
                </div>
                <p class="text-xs font-bold text-gray-500 uppercase tracking-wider">Dicairkan</p>
            </div>
            <p class="text-2xl font-black text-gray-800">Rp {{ number_format($stats['total_approved'], 0, ',', '.') }}</p>
            <p class="text-xs text-gray-400 mt-1">Total telah diproses</p>
        </div>
        <div class="bg-white rounded-2xl p-5 shadow-sm border border-gray-100">
            <div class="flex items-center gap-3 mb-3">
                <div class="w-10 h-10 bg-blue-50 text-blue-600 rounded-xl flex items-center justify-center">
                    <i class="bi bi-people text-lg"></i>
                </div>
                <p class="text-xs font-bold text-gray-500 uppercase tracking-wider">Driver Aktif</p>
            </div>
            <p class="text-2xl font-black text-gray-800">{{ $stats['total_drivers'] }}</p>
            <p class="text-xs text-gray-400 mt-1">Punya dompet</p>
        </div>
        <div class="bg-white rounded-2xl p-5 shadow-sm border border-gray-100">
            <div class="flex items-center gap-3 mb-3">
                <div class="w-10 h-10 bg-indigo-50 text-indigo-600 rounded-xl flex items-center justify-center">
                    <i class="bi bi-wallet2 text-lg"></i>
                </div>
                <p class="text-xs font-bold text-gray-500 uppercase tracking-wider">Total Saldo</p>
            </div>
            <p class="text-2xl font-black text-gray-800">Rp {{ number_format($stats['total_balance'], 0, ',', '.') }}</p>
            <p class="text-xs text-gray-400 mt-1">Semua dompet driver</p>
        </div>
    </div>

    {{-- Tabel Permintaan Pencairan --}}
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
        <div class="px-6 py-4 border-b border-gray-100 flex items-center justify-between">
            <h2 class="text-base font-bold text-gray-800">Permintaan Pencairan</h2>
            <span class="text-xs text-gray-400 bg-gray-50 px-3 py-1 rounded-full font-semibold">{{ $withdrawals->total() }} total</span>
        </div>

        @if($withdrawals->isEmpty())
            <div class="p-16 text-center">
                <i class="bi bi-inbox text-5xl text-gray-200 block mb-4"></i>
                <p class="text-sm font-bold text-gray-400">Belum ada permintaan pencairan</p>
            </div>
        @else
            <div class="overflow-x-auto">
                <table class="w-full text-sm">
                    <thead>
                        <tr class="bg-gray-50 text-xs font-bold text-gray-500 uppercase tracking-wider">
                            <th class="px-6 py-3 text-left">Pengemudi</th>
                            <th class="px-6 py-3 text-left">Bank / Rekening</th>
                            <th class="px-6 py-3 text-right">Nominal</th>
                            <th class="px-6 py-3 text-center">Status</th>
                            <th class="px-6 py-3 text-left">Tanggal</th>
                            <th class="px-6 py-3 text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-50">
                        @foreach($withdrawals as $wd)
                            <tr class="hover:bg-gray-50/50 transition-colors">
                                <td class="px-6 py-4">
                                    <div class="flex items-center gap-3">
                                        <img src="https://ui-avatars.com/api/?name={{ urlencode($wd->driver->name) }}&background=1a237e&color=fff&bold=true&size=32"
                                            class="w-8 h-8 rounded-full" alt="">
                                        <div>
                                            <p class="font-bold text-gray-800">{{ $wd->driver->name }}</p>
                                            <p class="text-xs text-gray-400">{{ $wd->driver->no_hp }}</p>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4">
                                    <p class="font-bold text-gray-800">{{ $wd->nama_bank }}</p>
                                    <p class="text-xs text-gray-500">{{ $wd->no_rekening }} · {{ $wd->nama_rekening }}</p>
                                </td>
                                <td class="px-6 py-4 text-right">
                                    <span class="font-black text-gray-800">Rp {{ number_format($wd->amount, 0, ',', '.') }}</span>
                                </td>
                                <td class="px-6 py-4 text-center">
                                    @if($wd->status === 'pending')
                                        <span class="inline-flex items-center gap-1 px-3 py-1 bg-amber-100 text-amber-700 text-xs font-bold rounded-full">
                                            <span class="w-1.5 h-1.5 bg-amber-500 rounded-full animate-pulse"></span> Menunggu
                                        </span>
                                    @elseif($wd->status === 'approved')
                                        <span class="inline-flex items-center gap-1 px-3 py-1 bg-green-100 text-green-700 text-xs font-bold rounded-full">
                                            <i class="bi bi-check"></i> Disetujui
                                        </span>
                                    @else
                                        <span class="inline-flex items-center gap-1 px-3 py-1 bg-red-100 text-red-700 text-xs font-bold rounded-full">
                                            <i class="bi bi-x"></i> Ditolak
                                        </span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 text-gray-500 text-xs">
                                    {{ $wd->created_at->format('d M Y H:i') }}
                                    @if($wd->processed_at)
                                        <br><span class="text-gray-400">Diproses: {{ $wd->processed_at->format('d M H:i') }}</span>
                                    @endif
                                </td>
                                <td class="px-6 py-4">
                                    @if($wd->status === 'pending')
                                        <div class="flex items-center justify-center gap-2">
                                            {{-- Approve --}}
                                            <form action="{{ route('admin.wallet.approve', $wd->id) }}" method="POST"
                                                data-confirm="Setujui pencairan Rp {{ number_format($wd->amount, 0, ',', '.') }} untuk {{ $wd->driver->name }}?"
                                                data-title="Persetujuan Pencairan"
                                                data-type="question"
                                                data-btn-text="Ya, Setujui"
                                                data-btn-color="#1a237e">
                                                @csrf
                                                <button type="submit"
                                                    class="px-3 py-1.5 bg-green-500 hover:bg-green-600 text-white text-xs font-bold rounded-xl transition">
                                                    <i class="bi bi-check-lg"></i> Setujui
                                                </button>
                                            </form>

                                            {{-- Reject (trigger modal) --}}
                                            <button onclick="openReject({{ $wd->id }}, '{{ $wd->driver->name }}')"
                                                class="px-3 py-1.5 bg-red-100 hover:bg-red-200 text-red-600 text-xs font-bold rounded-xl transition">
                                                <i class="bi bi-x-lg"></i> Tolak
                                            </button>
                                        </div>
                                    @else
                                        <span class="text-xs text-gray-300 italic">Sudah diproses</span>
                                    @endif

                                    {{-- Catatan jika ditolak --}}
                                    @if($wd->status === 'rejected' && $wd->catatan_admin)
                                        <p class="text-[10px] text-red-500 mt-1 text-center">{{ $wd->catatan_admin }}</p>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="px-6 py-4 border-t border-gray-100">
                {{ $withdrawals->links() }}
            </div>
        @endif
    </div>
</div>

{{-- Modal Reject --}}
<div id="modal-reject" class="hidden fixed inset-0 z-50 flex items-center justify-center bg-black/40 backdrop-blur-sm px-4">
    <div class="bg-white w-full max-w-sm rounded-2xl p-6 shadow-2xl">
        <h3 class="text-base font-bold text-gray-800 mb-1">Tolak Pencairan</h3>
        <p id="reject-driver-name" class="text-sm text-gray-500 mb-4"></p>
        <form id="form-reject" method="POST">
            @csrf
            <div class="mb-4">
                <label class="block text-xs font-bold text-gray-500 uppercase tracking-wider mb-1.5">Alasan Penolakan (Opsional)</label>
                <textarea name="catatan_admin" rows="3" placeholder="Contoh: Nomor rekening tidak valid..."
                    class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl text-sm focus:outline-none focus:border-red-400"></textarea>
            </div>
            <div class="flex gap-3">
                <button type="button" onclick="document.getElementById('modal-reject').classList.add('hidden')"
                    class="flex-1 py-3 bg-gray-100 text-gray-600 font-bold rounded-xl hover:bg-gray-200 transition text-sm">
                    Batal
                </button>
                <button type="submit"
                    class="flex-1 py-3 bg-red-500 text-white font-bold rounded-xl hover:bg-red-600 transition text-sm">
                    Tolak & Kembalikan Dana
                </button>
            </div>
        </form>
    </div>
</div>

<script>
function openReject(id, name) {
    document.getElementById('modal-reject').classList.remove('hidden');
    document.getElementById('reject-driver-name').textContent = 'Driver: ' + name;
    document.getElementById('form-reject').action = '/admin/wallet/' + id + '/reject';
}
</script>
@endsection
