@extends('layouts.admin')

@section('content')
<div class="container-fluid px-4 py-8 bg-[#f8faff]">
    <div class="flex justify-between items-center mb-8">
        <div>
            <h1 class="text-3xl font-black text-[#1a237e] tracking-tighter uppercase">Daftar Promo</h1>
            <p class="text-[11px] font-bold text-gray-400 uppercase tracking-[0.3em] mt-1">Kelola Program Promo & Diskon</p>
        </div>
        <a href="{{ route('admin.promo.create') }}" class="px-8 py-4 bg-[#1a237e] text-white rounded-2xl text-[10px] font-black uppercase tracking-widest hover:bg-blue-800 transition-all shadow-xl flex items-center gap-2">
            <i class="bi bi-plus-lg"></i> Tambah Promo
        </a>
    </div>

    @if(session('success'))
    <div class="mb-6 p-4 bg-green-50 border border-green-100 text-green-600 rounded-2xl flex items-center gap-3">
        <i class="bi bi-check-circle-fill"></i>
        <span class="text-xs font-bold uppercase tracking-widest">{{ session('success') }}</span>
    </div>
    @endif

    <div class="bg-white rounded-[40px] shadow-2xl border border-gray-100 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-gray-50/50 border-b border-gray-100">
                        <th class="px-6 py-4 text-[10px] font-black text-[#1a237e] uppercase tracking-widest">Banner</th>
                        <th class="px-6 py-4 text-[10px] font-black text-[#1a237e] uppercase tracking-widest">Judul & Kode</th>
                        <th class="px-6 py-4 text-[10px] font-black text-[#1a237e] uppercase tracking-widest text-center">Potongan</th>
                        <th class="px-6 py-4 text-[10px] font-black text-[#1a237e] uppercase tracking-widest text-center">Status</th>
                        <th class="px-6 py-4 text-[10px] font-black text-[#1a237e] uppercase tracking-widest text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50">
                    @forelse($promos as $promo)
                    <tr class="hover:bg-gray-50/50 transition">
                        <td class="px-6 py-4">
                            <div class="w-24 h-12 rounded-xl overflow-hidden border border-gray-100 shadow-sm">
                                @if($promo->gambar)
                                    <img src="{{ asset('storage/' . $promo->gambar) }}" class="w-full h-full object-cover">
                                @else
                                    <div class="w-full h-full bg-gray-100 flex items-center justify-center text-gray-300">
                                        <i class="bi bi-image text-xl"></i>
                                    </div>
                                @endif
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex flex-col">
                                <span class="text-sm font-black text-[#1a237e] uppercase tracking-tight">{{ $promo->judul }}</span>
                                <span class="text-[10px] font-bold text-gray-400 tracking-widest mt-0.5 capitalize italic">{{ $promo->kode_promo ?? 'Tidak ada kode' }}</span>
                            </div>
                        </td>
                        <td class="px-6 py-4 text-center">
                            <span class="px-4 py-2 bg-orange-50 text-orange-600 rounded-full text-[10px] font-black border border-orange-100 uppercase tracking-widest">
                                {{ $promo->potongan_persen }}% OFF
                            </span>
                        </td>
                        <td class="px-6 py-4 text-center">
                            <form action="{{ route('admin.promo.toggle', $promo) }}" method="POST">
                                @csrf
                                @method('PATCH')
                                <button type="submit" class="inline-flex items-center gap-2 group">
                                    <div class="relative w-12 h-6 rounded-full transition-all duration-300 {{ $promo->is_active ? 'bg-green-500' : 'bg-gray-200' }}">
                                        <div class="absolute top-1 left-1 w-4 h-4 rounded-full bg-white transition-all duration-300 transform {{ $promo->is_active ? 'translate-x-6' : 'translate-x-0' }}"></div>
                                    </div>
                                    <span class="text-[9px] font-black uppercase tracking-widest {{ $promo->is_active ? 'text-green-600' : 'text-gray-400' }}">
                                        {{ $promo->is_active ? 'Aktif' : 'Non-Aktif' }}
                                    </span>
                                </button>
                            </form>
                        </td>
                        <td class="px-6 py-4 text-right">
                            <div class="flex justify-end gap-2">
                                <a href="{{ route('admin.promo.edit', $promo) }}" class="p-2 bg-blue-50 text-blue-600 rounded-xl hover:bg-blue-600 hover:text-white transition shadow-sm">
                                    <i class="bi bi-pencil-square"></i>
                                </a>
                                <button type="button" onclick="confirmDelete('{{ $promo->id }}', 'Yakin hapus promo ini?', 'Seluruh data promo ini akan dihapus permanen.')" class="p-2 bg-red-50 text-red-500 rounded-xl hover:bg-red-500 hover:text-white transition shadow-sm">
                                    <i class="bi bi-trash"></i>
                                </button>
                                <form id="delete-form-{{ $promo->id }}" action="{{ route('admin.promo.destroy', $promo) }}" method="POST" class="hidden">
                                    @csrf
                                    @method('DELETE')
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="px-6 py-12 text-center text-gray-400">
                            <div class="flex flex-col items-center">
                                <i class="bi bi-tag text-6xl opacity-20 mb-4"></i>
                                <p class="text-xs font-bold uppercase tracking-widest">Belum ada data promo</p>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if($promos->hasPages())
        <div class="px-6 py-4 bg-gray-50/50 border-t border-gray-100">
            {{ $promos->links() }}
        </div>
        @endif
    </div>
</div>
@endsection
