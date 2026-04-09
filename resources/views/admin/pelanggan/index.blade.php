@extends('layouts.admin')

@section('title', 'Data Pelanggan')
@section('header_title', 'Kelola Data Pelanggan')

@section('content')
<div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
    <div class="p-6 border-b border-gray-100 flex flex-col sm:flex-row justify-between items-center gap-4">
        <div>
            <h3 class="font-black text-[#1a237e] text-lg">Daftar Pelanggan Terdaftar</h3>
            <p class="text-xs text-gray-400">Total pelanggan: {{ $pelanggans->count() }} orang</p>
        </div>
        <a href="{{ route('admin.pelanggan.create') }}" class="w-full sm:w-auto px-6 py-3 bg-[#1a237e] text-white rounded-xl font-bold text-sm flex items-center justify-center gap-2 hover:bg-blue-800 transition shadow-lg shadow-blue-900/20">
            <i class="bi bi-person-plus-fill"></i>
            Tambah Pelanggan Baru
        </a>
    </div>

    <div class="overflow-x-auto">
        <table class="w-full text-left">
            <thead>
                <tr class="bg-gray-50 text-[10px] font-black uppercase tracking-widest text-gray-400 border-b border-gray-100">
                    <th class="px-6 py-4">Nama & Email</th>
                    <th class="px-6 py-4">Kontak & Alamat</th>
                    <th class="px-6 py-4 text-center">Riwayat Order</th>
                    <th class="px-6 py-4 text-right">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-50">
                @forelse($pelanggans as $pelanggan)
                <tr class="hover:bg-blue-50/30 transition group">
                    <td class="px-6 py-4">
                        <div class="flex items-center gap-4">
                            <div class="w-10 h-10 rounded-full bg-blue-100 flex items-center justify-center text-[#1a237e] font-black text-xs uppercase">
                                {{ substr($pelanggan->name, 0, 2) }}
                            </div>
                            <div>
                                <h4 class="font-bold text-[#1a237e] text-sm group-hover:text-blue-600 transition">{{ $pelanggan->name }}</h4>
                                <p class="text-[10px] text-gray-400 lowercase font-semibold">{{ $pelanggan->email }}</p>
                            </div>
                        </div>
                    </td>
                    <td class="px-6 py-4">
                        <div class="flex flex-col">
                            <span class="text-xs font-bold text-gray-700"><i class="bi bi-telephone mr-2 opacity-50"></i>{{ $pelanggan->no_hp ?? '-' }}</span>
                            <span class="text-[10px] text-gray-400 font-medium line-clamp-1 max-w-xs"><i class="bi bi-geo-alt mr-2 opacity-50"></i>{{ $pelanggan->alamat ?? 'Alamat belum diset' }}</span>
                        </div>
                    </td>
                    <td class="px-6 py-4 text-center">
                        <span class="px-3 py-1 bg-blue-50 text-[#1a237e] text-[9px] font-black rounded-full border border-blue-100">
                            {{ $pelanggan->bookings ? $pelanggan->bookings->count() : 0 }} Order
                        </span>
                    </td>
                    <td class="px-6 py-4 text-right">
                        <div class="flex justify-end gap-2">
                            <a href="{{ route('admin.pelanggan.edit', $pelanggan->id) }}" class="w-8 h-8 rounded-lg border border-gray-100 flex items-center justify-center text-gray-400 hover:text-[#1a237e] hover:border-[#1a237e] hover:bg-white transition shadow-sm">
                                <i class="bi bi-pencil-square text-sm"></i>
                            </a>
                            <button type="button" onclick="confirmDelete('{{ $pelanggan->id }}')" class="w-8 h-8 rounded-lg border border-gray-100 flex items-center justify-center text-gray-400 hover:text-red-600 hover:border-red-600 hover:bg-white transition shadow-sm">
                                <i class="bi bi-trash text-sm"></i>
                            </button>
                            <form id="delete-form-{{ $pelanggan->id }}" action="{{ route('admin.pelanggan.destroy', $pelanggan->id) }}" method="POST" class="hidden">
                                @csrf
                                @method('DELETE')
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="px-6 py-12 text-center text-gray-400">
                        <i class="bi bi-people text-5xl mb-4 opacity-20 block"></i>
                        <p class="font-bold">Belum ada pelanggan terdaftar</p>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
