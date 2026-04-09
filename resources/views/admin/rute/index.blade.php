@extends('layouts.admin')

@section('title', 'Data Rute')
@section('header_title', 'Kelola Rute & Harga')

@section('content')
<div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
    <div class="p-6 border-b border-gray-100 flex flex-col sm:flex-row justify-between items-center gap-4">
        <div>
            <h3 class="font-black text-[#1a237e] text-lg">Daftar Rute Perjalanan</h3>
            <p class="text-xs text-gray-400">Total rute tersedia: {{ $rutes->count() }} rute</p>
        </div>
        <a href="{{ route('admin.rute.create') }}" class="w-full sm:w-auto px-6 py-3 bg-[#1a237e] text-white rounded-xl font-bold text-sm flex items-center justify-center gap-2 hover:bg-blue-800 transition shadow-lg shadow-blue-900/20">
            <i class="bi bi-plus-lg"></i>
            Tambah Rute Baru
        </a>
    </div>

    <div class="overflow-x-auto">
        <table class="w-full text-left">
            <thead>
                <tr class="bg-gray-50 text-[10px] font-black uppercase tracking-widest text-gray-400 border-b border-gray-100">
                    <th class="px-6 py-4">Layanan & Rute</th>
                    <th class="px-6 py-4">Armada</th>
                    <th class="px-6 py-4 text-center">Harga Paket</th>
                    <th class="px-6 py-4 text-center">Harga PP</th>
                    <th class="px-6 py-4 text-center">Harga Tol</th>
                    <th class="px-6 py-4 text-center">Status</th>
                    <th class="px-6 py-4 text-right">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-50">
                @forelse($rutes as $rute)
                <tr class="hover:bg-blue-50/30 transition group">
                    <td class="px-6 py-4">
                        <div class="flex items-center gap-4">
                            <div class="w-10 h-10 rounded-lg bg-blue-50 border border-blue-100 flex items-center justify-center text-[#1a237e]">
                                <i class="bi {{ $rute->layanan->icon }} text-lg"></i>
                            </div>
                            <div>
                                <h4 class="font-bold text-[#1a237e] text-sm group-hover:text-blue-600 transition">{{ $rute->nama_rute }}</h4>
                                <p class="text-[10px] font-bold text-gray-400 uppercase tracking-tighter">{{ $rute->lokasi_awal }} → {{ $rute->tujuan }}</p>
                            </div>
                        </div>
                    </td>
                    <td class="px-6 py-4">
                        <div class="flex flex-col">
                            <span class="text-sm font-semibold text-gray-700">{{ $rute->armada->nama }}</span>
                            <span class="text-[10px] font-bold text-gray-400 uppercase tracking-widest italic">{{ $rute->armada->jenis }}</span>
                        </div>
                    </td>
                    <td class="px-6 py-4 text-center">
                        <div class="flex flex-col">
                            <span class="text-sm font-black text-[#1a237e]">Rp {{ number_format($rute->harga_paket, 0, ',', '.') }}</span>
                            <span class="text-[9px] text-gray-400 font-bold uppercase tracking-tighter">Sekali Jalan</span>
                        </div>
                    </td>
                    <td class="px-6 py-4 text-center">
                        @if($rute->harga_paket_pp)
                            <div class="flex flex-col">
                                <span class="text-sm font-black text-orange-600">Rp {{ number_format($rute->harga_paket_pp, 0, ',', '.') }}</span>
                                <span class="text-[9px] text-orange-400 font-bold uppercase tracking-tighter">Pulang Pergi</span>
                            </div>
                        @else
                            <span class="text-xs text-gray-300 font-bold italic italic">Belum Set</span>
                        @endif
                    </td>
                    <td class="px-6 py-4 text-center">
                        @if($rute->harga_tol)
                            <span class="text-sm font-bold text-blue-600">Rp {{ number_format($rute->harga_tol, 0, ',', '.') }}</span>
                        @else
                            <span class="text-xs text-gray-300 font-bold italic italic">Tidak Ada</span>
                        @endif
                    </td>
                    <td class="px-6 py-4 text-center">
                        <form action="{{ route('admin.rute.toggle', $rute->id) }}" method="POST">
                            @csrf
                            @method('PATCH')
                            <button type="submit" class="group relative inline-flex items-center">
                                @if($rute->is_active)
                                    <span class="px-3 py-1 bg-green-100 text-green-700 text-[9px] font-black rounded-full border border-green-200 uppercase tracking-widest shadow-sm">Aktif</span>
                                @else
                                    <span class="px-3 py-1 bg-gray-100 text-gray-400 text-[9px] font-black rounded-full border border-gray-200 uppercase tracking-widest shadow-sm">Non-Aktif</span>
                                @endif
                            </button>
                        </form>
                    </td>
                    <td class="px-6 py-4 text-right">
                        <div class="flex justify-end gap-2">
                            <a href="{{ route('admin.rute.edit', $rute->id) }}" class="w-8 h-8 rounded-lg border border-gray-100 flex items-center justify-center text-gray-400 hover:text-[#1a237e] hover:border-[#1a237e] hover:bg-white transition shadow-sm" title="Edit Rute">
                                <i class="bi bi-pencil-square text-sm"></i>
                            </a>
                            <a href="{{ route('admin.rute.duplicate', $rute->id) }}" class="w-8 h-8 rounded-lg border border-gray-100 flex items-center justify-center text-gray-400 hover:text-green-600 hover:border-green-600 hover:bg-white transition shadow-sm" title="Duplikat Rute">
                                <i class="bi bi-files text-sm"></i>
                            </a>
                            <button type="button" onclick="confirmDelete('{{ $rute->id }}')" class="w-8 h-8 rounded-lg border border-gray-100 flex items-center justify-center text-gray-400 hover:text-red-600 hover:border-red-600 hover:bg-white transition shadow-sm">
                                <i class="bi bi-trash text-sm"></i>
                            </button>
                            <form id="delete-form-{{ $rute->id }}" action="{{ route('admin.rute.destroy', $rute->id) }}" method="POST" class="hidden">
                                @csrf
                                @method('DELETE')
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="px-6 py-12 text-center text-gray-400">
                        <i class="bi bi-inbox text-5xl mb-4 opacity-20 block"></i>
                        <p class="font-bold">Belum ada data rute</p>
                        <p class="text-xs">Silakan tambahkan rute baru</p>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
