@extends('layouts.admin')

@section('content')
<div class="space-y-6">
    <div class="flex justify-between items-center">
        <div>
            <h1 class="text-2xl font-black text-[#1a237e] uppercase tracking-tight">Kedaruratan & Laporan</h1>
            <p class="text-sm text-gray-500 font-medium">Manajemen laporan kerusakan dan masalah armada dari pengemudi.</p>
        </div>
    </div>

    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-2xl relative mb-4">
            <span class="block sm:inline">{{ session('success') }}</span>
        </div>
    @endif
    @if($errors->any())
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-2xl relative mb-4">
            <ul class="list-disc pl-5">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="bg-white rounded-[30px] border border-gray-100 shadow-sm overflow-hidden">
        <div class="overflow-x-auto p-4">
            <table class="w-full text-left border-separate border-spacing-y-2">
                <thead>
                    <tr class="text-[10px] font-black text-gray-400 uppercase tracking-widest bg-gray-50/50">
                        <th class="p-4 rounded-l-2xl">Tanggal</th>
                        <th class="p-4">Pengemudi & Armada</th>
                        <th class="p-4">Jenis Laporan</th>
                        <th class="p-4">Permintaan</th>
                        <th class="p-4">Status</th>
                        <th class="p-4 rounded-r-2xl text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="text-sm">
                    @forelse($laporans as $laporan)
                        <tr class="hover:bg-gray-50 transition-colors group">
                            <td class="p-4">
                                <p class="font-bold text-[#1a237e]">{{ $laporan->created_at->format('d M Y') }}</p>
                                <p class="text-xs text-gray-400">{{ $laporan->created_at->format('H:i') }} WIB</p>
                            </td>
                            <td class="p-4">
                                <p class="font-bold text-[#1a237e]">{{ $laporan->driver->name ?? '-' }}</p>
                                <p class="text-xs font-semibold text-blue-500">{{ $laporan->armada->nama ?? 'Armada Dihapus' }} ({{ $laporan->armada->plat_nomor ?? '-' }})</p>
                            </td>
                            <td class="p-4">
                                <span class="px-3 py-1 rounded-full text-[10px] font-black uppercase tracking-widest bg-red-100 text-red-700">
                                    {{ $laporan->tipe_laporan }}
                                </span>
                                <p class="text-xs text-gray-500 mt-2 max-w-xs truncate" title="{{ $laporan->deskripsi }}">{{ $laporan->deskripsi }}</p>
                            </td>
                            <td class="p-4">
                                @if($laporan->request_penggantian)
                                    <span class="px-2 py-1 bg-yellow-100 text-yellow-800 rounded text-xs font-bold"><i class="bi bi-exclamation-triangle"></i> Ganti Kendaraan</span>
                                @else
                                    <span class="text-xs text-gray-400 font-bold">-</span>
                                @endif
                                
                                @if($laporan->foto_bukti)
                                    <div class="mt-2">
                                        <a href="{{ asset('storage/' . $laporan->foto_bukti) }}" target="_blank" class="text-xs text-blue-600 hover:underline font-bold"><i class="bi bi-image"></i> Lihat Bukti</a>
                                    </div>
                                @endif
                            </td>
                            <td class="p-4">
                                @php
                                    $statusClass = [
                                        'pending' => 'bg-yellow-100 text-yellow-700',
                                        'diproses' => 'bg-blue-100 text-blue-700',
                                        'selesai' => 'bg-green-100 text-green-700',
                                        'ditolak' => 'bg-gray-100 text-gray-700',
                                    ];
                                @endphp
                                <span class="px-3 py-1 rounded-lg text-[10px] font-black uppercase tracking-widest {{ $statusClass[$laporan->status] ?? 'bg-gray-100 text-gray-700' }}">
                                    {{ $laporan->status }}
                                </span>
                            </td>
                            <td class="p-4 text-right">
                                <form action="{{ route('admin.laporan.update', $laporan->id) }}" method="POST" class="inline-flex gap-2">
                                    @csrf
                                    @method('PATCH')
                                    <select name="status" class="text-xs rounded-xl border-gray-200 font-bold text-[#1a237e] focus:ring-[#fbc02d]">
                                        <option value="pending" {{ $laporan->status == 'pending' ? 'selected' : '' }}>Pending</option>
                                        <option value="diproses" {{ $laporan->status == 'diproses' ? 'selected' : '' }}>Diproses (Maintenance)</option>
                                        <option value="selesai" {{ $laporan->status == 'selesai' ? 'selected' : '' }}>Selesai / Pulih</option>
                                        <option value="ditolak" {{ $laporan->status == 'ditolak' ? 'selected' : '' }}>Ditolak</option>
                                    </select>
                                    <button type="submit" class="bg-[#1a237e] hover:bg-[#0d1440] text-white px-3 py-1.5 rounded-xl text-xs font-bold transition">Update</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="p-8 text-center text-gray-400 font-bold">
                                Belum ada laporan kerusakan dari pengemudi.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if($laporans->hasPages())
            <div class="px-6 py-4 border-t border-gray-100">
                {{ $laporans->links() }}
            </div>
        @endif
    </div>
</div>
@endsection
