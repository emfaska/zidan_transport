@extends('layouts.admin')

@section('title', 'Manajemen Admin')
@section('header_title', 'Kelola Admin Sistem')

@section('content')
<div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
    <div class="p-6 border-b border-gray-100 flex flex-col sm:flex-row justify-between items-center gap-4">
        <div>
            <h3 class="font-black text-[#1a237e] text-lg">Daftar Admin</h3>
            <p class="text-xs text-gray-400">Total Admin: {{ $admins->count() }} orang</p>
        </div>
        <a href="{{ route('admin.management.create') }}" class="w-full sm:w-auto px-6 py-3 bg-[#1a237e] text-white rounded-xl font-bold text-sm flex items-center justify-center gap-2 hover:bg-blue-800 transition shadow-lg shadow-blue-900/20">
            <i class="bi bi-person-plus-fill"></i>
            Tambah Admin Baru
        </a>
    </div>

    @if (session('success'))
        <div class="m-6 bg-green-50 border-l-4 border-green-500 p-4 rounded-r-lg">
            <div class="flex items-center">
                <i class="bi bi-check-circle-fill text-green-500 text-xl mr-3"></i>
                <div>
                    <p class="text-sm text-green-700 font-bold">Berhasil</p>
                    <p class="text-xs text-green-600">{{ session('success') }}</p>
                </div>
            </div>
        </div>
    @endif

    <div class="overflow-x-auto">
        <table class="w-full text-left">
            <thead>
                <tr class="bg-gray-50 text-[10px] font-black uppercase tracking-widest text-gray-400 border-b border-gray-100">
                    <th class="px-6 py-4">Nama & Email</th>
                    <th class="px-6 py-4">No. HP</th>
                    <th class="px-6 py-4">Jabatan</th>
                    <th class="px-6 py-4 text-center">Status</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-50">
                @forelse($admins as $admin)
                <tr class="hover:bg-blue-50/30 transition group">
                    <td class="px-6 py-4">
                        <div class="flex items-center gap-4">
                            @if($admin->adminProfile && $admin->adminProfile->foto_profil)
                                <img src="{{ Storage::url($admin->adminProfile->foto_profil) }}" class="w-10 h-10 rounded-full object-cover">
                            @else
                                <div class="w-10 h-10 rounded-full bg-blue-100 flex items-center justify-center text-[#1a237e] font-black text-xs uppercase">
                                    {{ substr($admin->name, 0, 2) }}
                                </div>
                            @endif
                            <div>
                                <h4 class="font-bold text-[#1a237e] text-sm group-hover:text-blue-600 transition">{{ $admin->name }}</h4>
                                <p class="text-[10px] text-gray-400 lowercase font-semibold">{{ $admin->email }}</p>
                            </div>
                        </div>
                    </td>
                    <td class="px-6 py-4">
                        <span class="text-xs font-bold text-gray-700">{{ $admin->no_hp }}</span>
                    </td>
                    <td class="px-6 py-4">
                        <span class="text-xs font-medium text-gray-600">{{ $admin->adminProfile->jabatan ?? '-' }}</span>
                    </td>
                    <td class="px-6 py-4 text-center">
                        <span class="px-3 py-1 bg-green-50 text-green-600 text-[10px] font-black rounded-full border border-green-100">Aktif</span>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="px-6 py-12 text-center text-gray-400">
                        <i class="bi bi-shield-lock text-5xl mb-4 opacity-20 block"></i>
                        <p class="font-bold">Belum ada admin lain</p>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
