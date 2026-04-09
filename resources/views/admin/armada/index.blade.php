@extends('layouts.admin')

@section('title', 'Data Armada')
@section('header_title', 'Kelola Armada')

@section('content')
<div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
    <div class="p-6 border-b border-gray-100 flex flex-col sm:flex-row justify-between items-center gap-4">
        <div>
            <h3 class="font-black text-[#1a237e] text-lg">Daftar Armada</h3>
            <p class="text-xs text-gray-400">Total armada terdaftar: {{ $armadas->count() }} unit</p>
        </div>
        <a href="{{ route('admin.armada.create') }}" class="w-full sm:w-auto px-6 py-3 bg-[#1a237e] text-white rounded-xl font-bold text-sm flex items-center justify-center gap-2 hover:bg-blue-800 transition shadow-lg shadow-blue-900/20">
            <i class="bi bi-plus-lg"></i>
            Tambah Armada Baru
        </a>
    </div>

    <div class="overflow-x-auto">
        <table class="w-full text-left">
            <thead>
                <tr class="bg-gray-50 text-[10px] font-black uppercase tracking-widest text-gray-400 border-b border-gray-100">
                    <th class="px-6 py-4">Armada</th>
                    <th class="px-6 py-4 text-center">Info Dasar</th>
                    <th class="px-6 py-4 text-center">Status</th>
                    <th class="px-6 py-4 text-right">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-50">
                @forelse($armadas as $armada)
                <tr class="hover:bg-blue-50/30 transition group">
                    <td class="px-6 py-4">
                        <div class="flex items-center gap-4">
                            <div class="w-16 h-12 rounded-lg bg-gray-100 overflow-hidden flex-shrink-0 border border-gray-100">
                                @if($armada->foto)
                                    <img src="{{ asset('storage/'.$armada->foto) }}" alt="{{ $armada->nama }}" class="w-full h-full object-cover">
                                @else
                                    <div class="w-full h-full flex items-center justify-center text-gray-300">
                                        <i class="bi bi-truck text-xl"></i>
                                    </div>
                                @endif
                            </div>
                            <div>
                                <h4 class="font-bold text-[#1a237e] text-sm group-hover:text-blue-600 transition">{{ $armada->nama }}</h4>
                                <p class="text-[10px] font-bold text-gray-400 uppercase tracking-tighter">{{ $armada->plat_nomor }}</p>
                            </div>
                        </div>
                    </td>
                    <td class="px-6 py-4">
                        <div class="flex flex-col items-center">
                            <div class="flex gap-2 mb-1">
                                <span class="px-2 py-0.5 bg-blue-50 text-[#1a237e] text-[9px] font-black rounded-md border border-blue-100 italic">{{ $armada->jenis }}</span>
                                <span class="px-2 py-0.5 bg-gray-50 text-gray-500 text-[9px] font-black rounded-md border border-gray-100">{{ $armada->tahun }}</span>
                            </div>
                            <span class="text-[10px] text-gray-400 font-bold"><i class="bi bi-people-fill mr-1"></i>{{ $armada->kapasitas }} Penumpang</span>
                        </div>
                    </td>
                    <td class="px-6 py-4">
                        <div class="flex justify-center">
                            @if($armada->status == 'tersedia')
                                <span class="px-3 py-1 bg-green-100 text-green-700 text-[9px] font-black rounded-full border border-green-200 uppercase tracking-widest shadow-sm">Tersedia</span>
                            @elseif($armada->status == 'maintenance')
                                <span class="px-3 py-1 bg-yellow-100 text-yellow-700 text-[9px] font-black rounded-full border border-yellow-200 uppercase tracking-widest shadow-sm">Maintenance</span>
                            @else
                                <span class="px-3 py-1 bg-red-100 text-red-700 text-[9px] font-black rounded-full border border-red-200 uppercase tracking-widest shadow-sm">Terpakai</span>
                            @endif
                        </div>
                    </td>
                    <td class="px-6 py-4 text-right">
                        <div class="flex justify-end gap-2">
                            <a href="{{ route('admin.armada.edit', $armada->id) }}" class="w-8 h-8 rounded-lg border border-gray-100 flex items-center justify-center text-gray-400 hover:text-[#1a237e] hover:border-[#1a237e] hover:bg-white transition shadow-sm">
                                <i class="bi bi-pencil-square text-sm"></i>
                            </a>
                            <button type="button" onclick="confirmDelete('{{ $armada->id }}')" class="w-8 h-8 rounded-lg border border-gray-100 flex items-center justify-center text-gray-400 hover:text-red-600 hover:border-red-600 hover:bg-white transition shadow-sm">
                                <i class="bi bi-trash text-sm"></i>
                            </button>
                            <form id="delete-form-{{ $armada->id }}" action="{{ route('admin.armada.destroy', $armada->id) }}" method="POST" class="hidden">
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
                        <p class="font-bold">Belum ada data armada</p>
                        <p class="text-xs">Silakan tambahkan armada baru untuk memulai</p>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
