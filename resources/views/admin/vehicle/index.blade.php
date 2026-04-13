@extends('layouts.admin')

@section('title', 'Laporan & Penggantian Armada')
@section('header_title', 'Kendala Armada')

@section('content')
<div class="space-y-6">
    <!-- Summary Stats -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <div class="bg-white rounded-2xl p-6 shadow-sm border border-gray-100 flex items-center gap-4">
            <div class="w-12 h-12 bg-orange-50 text-orange-500 rounded-xl flex items-center justify-center">
                <i class="bi bi-exclamation-triangle-fill text-xl"></i>
            </div>
            <div>
                <h4 class="text-2xl font-black text-[#1a237e]">{{ $reports->total() }}</h4>
                <p class="text-[10px] font-black text-gray-400 uppercase tracking-widest">Total Laporan Kerusakan</p>
            </div>
        </div>
        <div class="bg-white rounded-2xl p-6 shadow-sm border border-gray-100 flex items-center gap-4">
            <div class="w-12 h-12 bg-blue-50 text-[#1a237e] rounded-xl flex items-center justify-center">
                <i class="bi bi-arrow-repeat text-xl"></i>
            </div>
            <div>
                <h4 class="text-2xl font-black text-[#1a237e]">{{ $replacements->total() }}</h4>
                <p class="text-[10px] font-black text-gray-400 uppercase tracking-widest">Permintaan Ganti Unit</p>
            </div>
        </div>
    </div>

    <!-- Replacement Requests Table -->
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
        <div class="p-6 border-b border-gray-100 bg-gray-50/50">
            <h3 class="font-black text-[#1a237e] text-sm uppercase tracking-widest flex items-center gap-2">
                <i class="bi bi-arrow-repeat"></i> Permintaan Ganti Armada Aktif
            </h3>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full text-left">
                <thead>
                    <tr class="bg-gray-50/30 text-[10px] font-black uppercase tracking-widest text-gray-400 border-b border-gray-100">
                        <th class="px-6 py-4">Booking & Driver</th>
                        <th class="px-6 py-4">Armada Saat Ini</th>
                        <th class="px-6 py-4">Alasan</th>
                        <th class="px-6 py-4">Status</th>
                        <th class="px-6 py-4 text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50">
                    @forelse($replacements as $req)
                    <tr class="hover:bg-blue-50/30 transition group">
                        <td class="px-6 py-4">
                            <div class="flex flex-col">
                                <span class="text-xs font-black text-[#1a237e] uppercase tracking-tighter">{{ $req->booking->kode_booking }}</span>
                                <span class="text-[10px] font-bold text-gray-400 uppercase mt-1">{{ $req->user->name }}</span>
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex flex-col">
                                <span class="text-xs font-bold text-gray-700">{{ $req->oldArmada->nama }}</span>
                                <span class="text-[9px] font-black text-gray-400 uppercase tracking-widest">{{ $req->oldArmada->plat_nomor }}</span>
                            </div>
                        </td>
                        <td class="px-6 py-4 max-w-xs">
                            <p class="text-[11px] text-gray-600 leading-relaxed italic">"{{ $req->reason }}"</p>
                        </td>
                        <td class="px-6 py-4">
                            @if($req->status === 'pending')
                                <span class="px-2 py-0.5 bg-yellow-50 text-yellow-600 text-[9px] font-black rounded-full border border-yellow-100 uppercase tracking-widest italic">Menunggu</span>
                            @elseif($req->status === 'approved')
                                <span class="px-2 py-0.5 bg-green-50 text-green-600 text-[9px] font-black rounded-full border border-green-100 uppercase tracking-widest">Disetujui</span>
                            @else
                                <span class="px-2 py-0.5 bg-red-50 text-red-600 text-[9px] font-black rounded-full border border-red-100 uppercase tracking-widest">Ditolak</span>
                            @endif
                        </td>
                        <td class="px-6 py-4 text-right">
                            @if($req->status === 'pending')
                            <button onclick="openReplaceModal('{{ $req->id }}', '{{ $req->booking->kode_booking }}', '{{ $req->oldArmada->nama }}')" class="px-3 py-1.5 bg-[#1a237e] text-white text-[9px] font-black rounded-lg uppercase tracking-widest shadow-xl shadow-blue-900/10 hover:bg-blue-800 transition">
                                Proses
                            </button>
                            @else
                            <span class="text-[9px] font-bold text-gray-300 uppercase italic">Selesai</span>
                            @endif
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="px-6 py-12 text-center text-gray-300">
                            <p class="text-[10px] font-black uppercase tracking-widest">Tidak ada permintaan ganti armada</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="p-6 border-t border-gray-50">
            {{ $replacements->links() }}
        </div>
    </div>

    <!-- Vehicle Reports Table -->
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
        <div class="p-6 border-b border-gray-100 bg-gray-50/50">
            <h3 class="font-black text-[#1a237e] text-sm uppercase tracking-widest flex items-center gap-2">
                <i class="bi bi-exclamation-triangle-fill"></i> Laporan Kerusakan Unit
            </h3>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full text-left">
                <thead>
                    <tr class="bg-gray-50/30 text-[10px] font-black uppercase tracking-widest text-gray-400 border-b border-gray-100">
                        <th class="px-6 py-4">Armada & Pelapor</th>
                        <th class="px-6 py-4">Kategori</th>
                        <th class="px-6 py-4">Deskripsi</th>
                        <th class="px-6 py-4 text-center">Foto</th>
                        <th class="px-6 py-4">Status</th>
                        <th class="px-6 py-4 text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50">
                    @forelse($reports as $report)
                    <tr class="hover:bg-orange-50/30 transition group">
                        <td class="px-6 py-4">
                            <div class="flex flex-col">
                                <span class="text-xs font-black text-[#1a237e] uppercase tracking-tighter">{{ $report->armada->nama }}</span>
                                <span class="text-[9px] font-black text-gray-400 uppercase mt-1">{{ $report->user->name }}</span>
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            <span class="px-2 py-0.5 bg-gray-100 text-gray-600 text-[9px] font-black rounded-md border border-gray-200 uppercase tracking-widest">{{ $report->category }}</span>
                        </td>
                        <td class="px-6 py-4 max-w-xs">
                            <p class="text-[11px] text-gray-600 leading-relaxed">{{ $report->description }}</p>
                        </td>
                        <td class="px-6 py-4 text-center">
                            @if($report->photo)
                                <a href="{{ asset('storage/'.$report->photo) }}" target="_blank" class="text-blue-500 hover:text-blue-700">
                                    <i class="bi bi-image text-lg"></i>
                                </a>
                            @else
                                <span class="text-gray-300"><i class="bi bi-dash"></i></span>
                            @endif
                        </td>
                        <td class="px-6 py-4">
                            @if($report->status === 'pending')
                                <span class="px-2 py-0.5 bg-orange-50 text-orange-600 text-[9px] font-black rounded-full border border-orange-100 uppercase tracking-widest italic">Belum Dicek</span>
                            @elseif($report->status === 'checked')
                                <span class="px-2 py-0.5 bg-blue-50 text-[#1a237e] text-[9px] font-black rounded-full border border-blue-100 uppercase tracking-widest italic">Dicek (Maint)</span>
                            @else
                                <span class="px-2 py-0.5 bg-green-50 text-green-600 text-[9px] font-black rounded-full border border-green-100 uppercase tracking-widest">Selesai</span>
                            @endif
                        </td>
                        <td class="px-6 py-4 text-right">
                            <form action="{{ route('admin.laporan.report.handle', $report->id) }}" method="POST" class="flex justify-end gap-1">
                                @csrf
                                @method('PATCH')
                                @if($report->status === 'pending')
                                    <button name="status" value="checked" class="w-8 h-8 rounded-lg bg-blue-50 text-[#1a237e] flex items-center justify-center hover:bg-blue-100 transition shadow-sm" title="Tandai Sedang Dicek">
                                        <i class="bi bi-clock-history"></i>
                                    </button>
                                @endif
                                @if($report->status !== 'repaired')
                                    <button name="status" value="repaired" class="w-8 h-8 rounded-lg bg-green-50 text-green-600 flex items-center justify-center hover:bg-green-100 transition shadow-sm" title="Tandai Selesai Diperbaiki">
                                        <i class="bi bi-check-lg"></i>
                                    </button>
                                @endif
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="px-6 py-12 text-center text-gray-300">
                            <p class="text-[10px] font-black uppercase tracking-widest">Tidak ada laporan kerusakan</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="p-6 border-t border-gray-50">
            {{ $reports->links() }}
        </div>
    </div>
</div>

<!-- Modal Ganti Armada -->
<div id="replaceModal" class="fixed inset-0 z-[100] hidden">
    <div class="absolute inset-0 bg-black/60 backdrop-blur-sm" onclick="closeReplaceModal()"></div>
    <div class="absolute left-1/2 top-1/2 -translate-x-1/2 -translate-y-1/2 w-full max-w-lg">
        <div class="bg-white rounded-[40px] shadow-2xl overflow-hidden animate-up">
            <div class="bg-[#1a237e] p-8 text-white relative">
                <button onclick="closeReplaceModal()" class="absolute top-8 right-8 text-white/50 hover:text-white transition">
                    <i class="bi bi-x-lg"></i>
                </button>
                <h3 class="text-xl font-black uppercase tracking-widest">Proses Ganti Armada</h3>
                <p class="text-[10px] font-black text-white/50 uppercase tracking-[0.2em] mt-2">ID Booking: <span id="modal_kode_booking" class="text-white"></span></p>
            </div>
            
            <form id="replaceForm" method="POST" class="p-8 space-y-6">
                @csrf
                @method('PATCH')
                <input type="hidden" name="action" value="approve">
                
                <div class="bg-orange-50 p-6 rounded-3xl border border-orange-100">
                    <p class="text-[9px] font-black text-orange-400 uppercase tracking-widest mb-2">Armada Saat Ini</p>
                    <h5 id="modal_old_armada" class="text-sm font-black text-[#1a237e]"></h5>
                </div>

                <div>
                    <label class="block text-[10px] font-black text-[#1a237e] uppercase tracking-widest mb-3 ml-2">Pilih Armada Pengganti</label>
                    <select name="new_armada_id" required class="w-full px-5 py-4 bg-gray-50 border border-gray-100 rounded-2xl text-xs font-bold text-[#1a237e] focus:outline-none focus:ring-4 focus:ring-blue-100 focus:border-[#1a237e] transition-all">
                        <option value="">Pilih Armada Tersedia...</option>
                        @foreach($av_armadas as $av)
                            <option value="{{ $av->id }}">{{ $av->nama }} - {{ $av->plat_nomor }} (Cap: {{ $av->kapasitas }})</option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label class="block text-[10px] font-black text-[#1a237e] uppercase tracking-widest mb-3 ml-2">Catatan Admin (Opsional)</label>
                    <textarea name="admin_notes" rows="3" class="w-full px-5 py-4 bg-gray-50 border border-gray-100 rounded-2xl text-xs font-bold text-[#1a237e] focus:outline-none focus:ring-4 focus:ring-blue-100 focus:border-[#1a237e] transition-all" placeholder="Tambahkan catatan tindak lanjut..."></textarea>
                </div>

                <div class="grid grid-cols-2 gap-4 pt-4">
                    <button type="button" onclick="rejectReplacement()" class="w-full py-4 text-red-600 font-black text-[10px] uppercase tracking-widest border border-red-100 rounded-2xl hover:bg-red-50 transition">
                        Tolak Request
                    </button>
                    <button type="submit" class="w-full py-4 bg-[#1a237e] text-white font-black text-[10px] uppercase tracking-widest rounded-2xl shadow-xl shadow-blue-900/20 hover:opacity-90 transition">
                        Konfirmasi Ganti
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    function openReplaceModal(id, kode, oldArmada) {
        document.getElementById('modal_kode_booking').innerText = kode;
        document.getElementById('modal_old_armada').innerText = oldArmada;
        document.getElementById('replaceForm').action = "/admin/laporan-armada/" + id + "/replacement";
        document.getElementById('replaceModal').classList.remove('hidden');
    }

    function closeReplaceModal() {
        document.getElementById('replaceModal').classList.add('hidden');
    }

    function rejectReplacement() {
        if(confirm('Yakin ingin menolak permintaan ganti armada ini?')) {
            const form = document.getElementById('replaceForm');
            form.querySelector('input[name="action"]').value = 'reject';
            form.submit();
        }
    }
</script>
@endsection
