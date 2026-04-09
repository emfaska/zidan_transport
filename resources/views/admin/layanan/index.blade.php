@extends('layouts.admin')

@section('title', 'Data Layanan')
@section('header_title', 'Kelola Jenis Layanan')

@section('content')
<div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
    <div class="p-6 border-b border-gray-100 flex flex-col sm:flex-row justify-between items-center gap-4">
        <div>
            <h3 class="font-black text-[#1a237e] text-lg">Daftar Layanan</h3>
            <p class="text-xs text-gray-400">Total kategori layanan: {{ $layanans->count() }} jenis</p>
        </div>
        <a href="{{ route('admin.layanan.create') }}" class="w-full sm:w-auto px-6 py-3 bg-[#1a237e] text-white rounded-xl font-bold text-sm flex items-center justify-center gap-2 hover:bg-blue-800 transition shadow-lg shadow-blue-900/20">
            <i class="bi bi-plus-lg"></i>
            Tambah Layanan Baru
        </a>
    </div>

    <div class="overflow-x-auto">
        <table class="w-full text-left">
            <thead>
                <tr class="bg-gray-50 text-[10px] font-black uppercase tracking-widest text-gray-400 border-b border-gray-100">
                    <th class="px-6 py-4">Nama Layanan</th>
                    <th class="px-6 py-4">Deskripsi</th>
                    <th class="px-6 py-4 text-center">Status</th>
                    <th class="px-6 py-4 text-right">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-50">
                @forelse($layanans as $layanan)
                <tr class="hover:bg-blue-50/30 transition group">
                    <td class="px-6 py-4">
                        <div class="flex items-center gap-4">
                            <div class="w-10 h-10 rounded-lg bg-blue-50 border border-blue-100 flex items-center justify-center text-[#1a237e]">
                                <i class="bi {{ $layanan->icon }} text-lg"></i>
                            </div>
                            <h4 class="font-bold text-[#1a237e] text-sm group-hover:text-blue-600 transition">{{ $layanan->nama_layanan }}</h4>
                        </div>
                    </td>
                    <td class="px-6 py-4">
                        <p class="text-[10px] text-gray-400 font-semibold line-clamp-1 max-w-xs">{{ $layanan->deskripsi }}</p>
                    </td>
                    <td class="px-6 py-4 text-center">
                        <form action="{{ route('admin.layanan.toggle', $layanan->id) }}" method="POST">
                            @csrf
                            @method('PATCH')
                            <button type="submit" class="group relative inline-flex items-center">
                                @if($layanan->is_active)
                                    <span class="px-3 py-1 bg-green-100 text-green-700 text-[9px] font-black rounded-full border border-green-200 uppercase tracking-widest shadow-sm">Aktif</span>
                                @else
                                    <span class="px-3 py-1 bg-gray-100 text-gray-400 text-[9px] font-black rounded-full border border-gray-200 uppercase tracking-widest shadow-sm">Non-Aktif</span>
                                @endif
                                <span class="absolute -bottom-6 left-1/2 -translate-x-1/2 px-2 py-1 bg-gray-800 text-white text-[8px] font-bold rounded opacity-0 group-hover:opacity-100 transition whitespace-nowrap z-10">Klik untuk ubah status</span>
                            </button>
                        </form>
                    </td>
                    <td class="px-6 py-4 text-right">
                        <div class="flex justify-end gap-2">
                            <a href="{{ route('admin.layanan.edit', $layanan->id) }}" class="w-8 h-8 rounded-lg border border-gray-100 flex items-center justify-center text-gray-400 hover:text-[#1a237e] hover:border-[#1a237e] hover:bg-white transition shadow-sm">
                                <i class="bi bi-pencil-square text-sm"></i>
                            </a>
                            <button type="button" onclick="confirmDelete('{{ $layanan->id }}')" class="w-8 h-8 rounded-lg border border-gray-100 flex items-center justify-center text-gray-400 hover:text-red-600 hover:border-red-600 hover:bg-white transition shadow-sm">
                                <i class="bi bi-trash text-sm"></i>
                            </button>
                            <form id="delete-form-{{ $layanan->id }}" action="{{ route('admin.layanan.destroy', $layanan->id) }}" method="POST" class="hidden">
                                @csrf
                                @method('DELETE')
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="px-6 py-12 text-center text-gray-400">
                        <i class="bi bi-inbox text-5xl mb-4 opacity-20 block"></i>
                        <p class="font-bold">Belum ada data layanan</p>
                        <p class="text-xs">Silakan tambahkan jenis layanan baru</p>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
