@extends('layouts.admin')

@section('title', 'Manajemen Pengembalian Dana (Refund)')
@section('header_title', 'Kelola Permintaan Refund')

@section('content')
<div class="bg-white rounded-[2rem] shadow-sm border border-gray-100 overflow-hidden relative">
    <div class="absolute top-0 left-0 w-full h-2 bg-gradient-to-r from-[#1a237e] via-[#fbc02d] to-[#1a237e]"></div>
    
    <div class="p-8">
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-6 mb-8">
            <h2 class="text-xl font-black text-[#1a237e] uppercase tracking-tighter">Daftar Permintaan Refund</h2>
            
            <div class="flex gap-2">
                <a href="{{ route('admin.refund.index') }}" class="px-4 py-2 rounded-xl text-xs font-bold uppercase tracking-widest transition-all {{ $status === 'all' ? 'bg-[#1a237e] text-white shadow-md' : 'bg-gray-100 text-gray-600 hover:bg-gray-200' }}">Semua</a>
                <a href="{{ route('admin.refund.index', ['status' => 'pending']) }}" class="px-4 py-2 rounded-xl text-xs font-bold uppercase tracking-widest transition-all {{ $status === 'pending' ? 'bg-orange-500 text-white shadow-md' : 'bg-gray-100 text-gray-600 hover:bg-gray-200' }}">Pending</a>
                <a href="{{ route('admin.refund.index', ['status' => 'processed']) }}" class="px-4 py-2 rounded-xl text-xs font-bold uppercase tracking-widest transition-all {{ $status === 'processed' ? 'bg-blue-500 text-white shadow-md' : 'bg-gray-100 text-gray-600 hover:bg-gray-200' }}">Diproses</a>
                <a href="{{ route('admin.refund.index', ['status' => 'completed']) }}" class="px-4 py-2 rounded-xl text-xs font-bold uppercase tracking-widest transition-all {{ $status === 'completed' ? 'bg-green-500 text-white shadow-md' : 'bg-gray-100 text-gray-600 hover:bg-gray-200' }}">Selesai</a>
            </div>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left text-sm whitespace-nowrap">
                <thead class="bg-gray-50/50 text-gray-500 font-bold uppercase tracking-widest text-[10px]">
                    <tr>
                        <th class="px-6 py-4 rounded-tl-2xl">Kode Booking</th>
                        <th class="px-6 py-4">Pelanggan</th>
                        <th class="px-6 py-4">Nominal</th>
                        <th class="px-6 py-4">Info Bank</th>
                        <th class="px-6 py-4 text-center">Status</th>
                        <th class="px-6 py-4 rounded-tr-2xl text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50">
                    @forelse($refunds as $refund)
                    <tr class="hover:bg-blue-50/30 transition-colors group">
                        <td class="px-6 py-5">
                            <span class="font-black text-[#1a237e]">{{ $refund->booking->kode_booking ?? '-' }}</span><br>
                            <span class="text-[10px] text-gray-400 font-medium">{{ $refund->created_at->format('d M Y H:i') }}</span>
                        </td>
                        <td class="px-6 py-5">
                            <span class="font-bold text-gray-800">{{ $refund->booking->user->name ?? 'User Terhapus' }}</span><br>
                            <span class="text-[10px] text-gray-500">{{ $refund->booking->user->no_hp ?? '-' }}</span>
                        </td>
                        <td class="px-6 py-5">
                            <span class="font-black text-red-500">Rp {{ number_format($refund->amount, 0, ',', '.') }}</span>
                        </td>
                        <td class="px-6 py-5">
                            <span class="font-bold text-[#1a237e]">{{ $refund->bank_name }}</span><br>
                            <span class="text-xs text-gray-600">{{ $refund->account_number }} (a.n {{ $refund->account_name }})</span>
                        </td>
                        <td class="px-6 py-5 text-center">
                            @if($refund->status === 'pending')
                                <span class="bg-orange-100 text-orange-600 px-3 py-1 rounded-full text-[10px] font-black uppercase tracking-widest border border-orange-200">Pending</span>
                            @elseif($refund->status === 'processed')
                                <span class="bg-blue-100 text-blue-600 px-3 py-1 rounded-full text-[10px] font-black uppercase tracking-widest border border-blue-200">Diproses Transfer</span>
                            @elseif($refund->status === 'completed')
                                <span class="bg-green-100 text-green-600 px-3 py-1 rounded-full text-[10px] font-black uppercase tracking-widest border border-green-200">Selesai</span>
                            @else
                                <span class="bg-red-100 text-red-600 px-3 py-1 rounded-full text-[10px] font-black uppercase tracking-widest border border-red-200">Ditolak</span>
                            @endif
                        </td>
                        <td class="px-6 py-5 text-right relative">
                            <button onclick="document.getElementById('modal-detail-{{ $refund->id }}').classList.remove('hidden')" class="w-10 h-10 rounded-xl bg-blue-50 text-blue-600 hover:bg-blue-600 hover:text-white transition-all flex items-center justify-center shadow-sm ml-auto">
                                <i class="bi bi-eye-fill"></i>
                            </button>

                            <!-- Modal Detail & Action -->
                            <div id="modal-detail-{{ $refund->id }}" class="fixed inset-0 z-[100] hidden">
                                <div class="absolute inset-0 bg-gray-900/60 backdrop-blur-sm" onclick="document.getElementById('modal-detail-{{ $refund->id }}').classList.add('hidden')"></div>
                                <div class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 bg-white w-full max-w-2xl rounded-[30px] shadow-2xl overflow-hidden text-left">
                                    <div class="h-2 bg-gradient-to-r from-[#1a237e] via-[#fbc02d] to-[#1a237e]"></div>
                                    <div class="p-8">
                                        <div class="flex justify-between items-start mb-6">
                                            <h3 class="text-xl font-black text-[#1a237e] uppercase tracking-tighter">Detail Permintaan Refund</h3>
                                            <button onclick="document.getElementById('modal-detail-{{ $refund->id }}').classList.add('hidden')" class="text-gray-400 hover:text-red-500 transition-colors">
                                                <i class="bi bi-x-lg text-xl"></i>
                                            </button>
                                        </div>

                                        <div class="bg-gray-50 border border-gray-100 rounded-2xl p-6 mb-6">
                                            <div class="grid grid-cols-2 gap-4 text-sm">
                                                <div>
                                                    <p class="text-[10px] font-bold text-gray-400 uppercase tracking-widest">Alasan Batal</p>
                                                    <p class="font-medium text-gray-700 italic mt-1">"{{ $refund->reason }}"</p>
                                                </div>
                                                <div>
                                                    <p class="text-[10px] font-bold text-gray-400 uppercase tracking-widest">Waktu Request</p>
                                                    <p class="font-bold text-[#1a237e] mt-1">{{ $refund->created_at->format('d M Y, H:i') }}</p>
                                                </div>
                                            </div>
                                        </div>

                                                @if($refund->status === 'pending')
                                                    <!-- Approve & Reject Actions -->
                                                    <div class="border-t border-gray-100 pt-6 mt-6 space-y-6">
                                                        <!-- Approve Form -->
                                                        <div>
                                                            <h4 class="text-xs font-black uppercase tracking-widest text-green-600 mb-4 flex items-center gap-2">
                                                                <i class="bi bi-check-circle-fill"></i> Proses Dana Dikirim
                                                            </h4>
                                                            <form action="{{ route('admin.refund.approve', $refund->id) }}" method="POST" class="flex flex-col gap-3"
                                                                data-confirm="Tandai bahwa dana sebesar Rp {{ number_format($refund->amount, 0, ',', '.') }} telah berhasil ditransfer ke pelanggan?"
                                                                data-title="Konfirmasi Transfer"
                                                                data-type="question"
                                                                data-btn-text="Ya, Sudah Transfer"
                                                                data-btn-color="#22c55e">
                                                                @csrf
                                                                @method('PATCH')
                                                                <input type="text" name="admin_note" placeholder="Catatan Admin (Opsional)" class="w-full bg-white border border-gray-200 rounded-xl p-3 text-sm focus:outline-none focus:border-green-500 shadow-sm transition-all">
                                                                <button type="submit" class="w-full bg-green-500 hover:bg-green-600 text-white font-black py-3 rounded-xl uppercase tracking-widest shadow-md flex items-center justify-center gap-2 transition-all hover:-translate-y-0.5 active:scale-95">
                                                                    <i class="bi bi-cash-stack"></i> Tandai Sudah Ditransfer
                                                                </button>
                                                            </form>
                                                        </div>

                                                        <!-- Reject Form -->
                                                        <div class="pt-6 border-t border-gray-50">
                                                            <h4 class="text-xs font-black uppercase tracking-widest text-red-500 mb-4 flex items-center gap-2">
                                                                <i class="bi bi-x-circle-fill"></i> Batalkan / Tolak Refund
                                                            </h4>
                                                            <form action="{{ route('admin.refund.reject', $refund->id) }}" method="POST" class="flex flex-col gap-3"
                                                                data-confirm="Yakin ingin menolak permintaan refund ini?"
                                                                data-title="Tolak Refund"
                                                                data-type="warning"
                                                                data-btn-text="Ya, Tolak"
                                                                data-btn-color="#d33">
                                                                @csrf
                                                                @method('PATCH')
                                                                <input type="text" name="admin_note" required placeholder="Alasan Penolakan (Wajib)" class="w-full bg-red-50 text-red-700 border border-red-200 rounded-xl p-3 text-sm focus:outline-none focus:border-red-500 shadow-sm transition-all">
                                                                <button type="submit" class="w-full bg-red-100 hover:bg-red-200 text-red-600 font-bold py-3 rounded-xl uppercase tracking-widest text-[10px] shadow-sm transition-all flex items-center justify-center gap-2 active:scale-95">
                                                                    <i class="bi bi-x-circle"></i> Tolak Permintaan Refund
                                                                </button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                @elseif($refund->status === 'processed')
                                            <div class="bg-blue-50 border border-blue-100 text-blue-700 p-4 rounded-xl text-center">
                                                <i class="bi bi-hourglass-split text-2xl mb-2 block"></i>
                                                <p class="font-bold text-sm">Menunggu Konfirmasi Pelanggan</p>
                                                <p class="text-[10px] mt-1">Anda sudah menandai dana telah dikirim. Menunggu pelanggan mengunggah bukti penerimaan.</p>
                                                @if($refund->admin_note)
                                                    <p class="text-xs italic mt-2 opacity-80">Catatan Anda: "{{ $refund->admin_note }}"</p>
                                                @endif
                                            </div>
                                        @elseif($refund->status === 'completed')
                                            <div class="bg-green-50 border border-green-100 text-green-700 p-4 rounded-xl text-center">
                                                <i class="bi bi-check-circle-fill text-2xl mb-2 block"></i>
                                                <p class="font-bold text-sm">Selesai Berhasil</p>
                                                <p class="text-[10px] mt-1">Pelanggan telah menerima dana dan mengunggah bukti penerimaan.</p>
                                                @if($refund->bukti_penerimaan)
                                                    <a href="{{ asset('storage/' . $refund->bukti_penerimaan) }}" target="_blank" class="mt-4 inline-block px-4 py-2 bg-green-500 text-white rounded-lg text-xs font-bold shadow hover:bg-green-600">
                                                        Lihat Bukti Pelanggan
                                                    </a>
                                                @endif
                                            </div>
                                        @endif

                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="px-6 py-12 text-center text-gray-400 font-medium">
                            <div class="flex flex-col items-center justify-center space-y-3">
                                <i class="bi bi-inbox text-4xl opacity-50"></i>
                                <span class="uppercase tracking-widest text-xs font-bold">Tidak ada data refund</span>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-6 px-6">
            {{ $refunds->links() }}
        </div>
    </div>
</div>
@endsection
