@extends('layouts.admin')

@section('title', 'Data Pengemudi')
@section('header_title', 'Kelola Tim Pengemudi')

@section('content')
<div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
    <div class="p-6 border-b border-gray-100 flex flex-col sm:flex-row justify-between items-center gap-4">
        <div>
            <h3 class="font-black text-[#1a237e] text-lg">Daftar Pengemudi (Driver)</h3>
            <p class="text-xs text-gray-400">Total personel: {{ $pengemudis->count() }} orang</p>
        </div>
        <a href="{{ route('admin.pengemudi.create') }}" class="w-full sm:w-auto px-6 py-3 bg-[#1a237e] text-white rounded-xl font-bold text-sm flex items-center justify-center gap-2 hover:bg-blue-800 transition shadow-lg shadow-blue-900/20">
            <i class="bi bi-person-badge-fill"></i>
            Daftarkan Pengemudi
        </a>
    </div>

    <div class="overflow-x-auto">
        <table class="w-full text-left">
            <thead>
                <tr class="bg-gray-50 text-[10px] font-black uppercase tracking-widest text-gray-400 border-b border-gray-100">
                    <th class="px-6 py-4">Pengemudi</th>
                    <th class="px-6 py-4">Status & SIM</th>
                    <th class="px-6 py-4">Kontak</th>
                    <th class="px-6 py-4 text-center">Tugas Aktif</th>
                    <th class="px-6 py-4 text-right">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-50">
                @forelse($pengemudis as $pengemudi)
                <tr class="hover:bg-blue-50/30 transition group">
                    <td class="px-6 py-4">
                        <div class="flex items-center gap-4">
                            <div class="w-12 h-12 rounded-xl bg-gray-100 overflow-hidden border border-gray-100 flex-shrink-0">
                                @if($pengemudi->foto_profil)
                                    <img src="{{ asset('storage/'.$pengemudi->foto_profil) }}" alt="{{ $pengemudi->name }}" class="w-full h-full object-cover">
                                @else
                                    <div class="w-full h-full flex items-center justify-center text-gray-300">
                                        <i class="bi bi-person-fill text-xl"></i>
                                    </div>
                                @endif
                            </div>
                            <div>
                                <h4 class="font-bold text-[#1a237e] text-sm group-hover:text-blue-600 transition">{{ $pengemudi->name }}</h4>
                                <p class="text-[10px] text-gray-400 lowercase font-medium">{{ $pengemudi->email }}</p>
                            </div>
                        </div>
                    </td>
                    <td class="px-6 py-4">
                        <div class="flex flex-col gap-1">
                            @if($pengemudi->is_active)
                                @if($pengemudi->status_driver == 'available')
                                    <span class="w-fit px-3 py-1 bg-green-100 text-green-700 text-[9px] font-black rounded-full border border-green-200 uppercase tracking-widest shadow-sm">Ready</span>
                                @elseif($pengemudi->status_driver == 'on_duty')
                                    <span class="w-fit px-3 py-1 bg-blue-100 text-blue-700 text-[9px] font-black rounded-full border border-blue-200 uppercase tracking-widest shadow-sm">On Duty</span>
                                @else
                                    <span class="w-fit px-3 py-1 bg-gray-100 text-gray-400 text-[9px] font-black rounded-full border border-gray-200 uppercase tracking-widest shadow-sm">Off</span>
                                @endif
                            @else
                                @if($pengemudi->rejection_note)
                                    <span class="w-fit px-3 py-1 bg-red-100 text-red-700 text-[9px] font-black rounded-full border border-red-200 uppercase tracking-widest shadow-sm">Ditolak</span>
                                @else
                                    <span class="w-fit px-3 py-1 bg-yellow-100 text-yellow-700 text-[9px] font-black rounded-full border border-yellow-200 uppercase tracking-widest shadow-sm">Pending</span>
                                @endif
                            @endif
                            <span class="text-[10px] font-bold text-gray-400 uppercase tracking-tighter">SIM: {{ $pengemudi->nomor_sim ?? '-' }}</span>
                        </div>
                    </td>
                    <td class="px-6 py-4">
                        <span class="text-xs font-bold text-gray-700"><i class="bi bi-whatsapp mr-2 text-green-500"></i>{{ $pengemudi->no_hp ?? '-' }}</span>
                    </td>
                    <td class="px-6 py-4 text-center">
                        <span class="text-xs font-black text-[#1a237e]">
                            {{ $pengemudi->assignedBookings()->whereIn('status', ['confirmed', 'on_trip'])->count() }}
                        </span>
                    </td>
                    <td class="px-6 py-4 text-right">
                        <div class="flex justify-end gap-2">
                            @if(!$pengemudi->is_active)
                                <button type="button" onclick="confirmAction('{{ $pengemudi->id }}', '{{ route('admin.pengemudi.approve', $pengemudi->id) }}', 'Setujui Pengemudi?', 'Apakah Anda yakin ingin menyetujui pendaftaran pengemudi ini?', 'info', 'Ya, Setujui')" 
                                    class="h-8 px-3 rounded-lg bg-green-500 text-white font-bold text-[10px] uppercase tracking-wider hover:bg-green-600 transition shadow-sm flex items-center gap-2">
                                    <i class="bi bi-check-lg"></i> Setujui
                                </button>
                                <button type="button" onclick="rejectDriver('{{ $pengemudi->id }}', '{{ route('admin.pengemudi.reject', $pengemudi->id) }}')" 
                                    class="h-8 px-3 rounded-lg bg-red-500 text-white font-bold text-[10px] uppercase tracking-wider hover:bg-red-600 transition shadow-sm flex items-center gap-2">
                                    <i class="bi bi-x-lg"></i> Tolak
                                </button>
                            @endif
                            <a href="{{ route('admin.pengemudi.show', $pengemudi->id) }}" class="w-8 h-8 rounded-lg border border-gray-100 flex items-center justify-center text-gray-400 hover:text-blue-600 hover:border-blue-600 hover:bg-white transition shadow-sm" title="Lihat Detail & Dokumen">
                                <i class="bi bi-eye-fill text-sm"></i>
                            </a>
                            <a href="{{ route('admin.pengemudi.edit', $pengemudi->id) }}" class="w-8 h-8 rounded-lg border border-gray-100 flex items-center justify-center text-gray-400 hover:text-[#1a237e] hover:border-[#1a237e] hover:bg-white transition shadow-sm" title="Edit Data">
                                <i class="bi bi-pencil-square text-sm"></i>
                            </a>
                            <button type="button" onclick="confirmDelete('{{ $pengemudi->id }}')" class="w-8 h-8 rounded-lg border border-gray-100 flex items-center justify-center text-gray-400 hover:text-red-600 hover:border-red-600 hover:bg-white transition shadow-sm" title="Hapus Data">
                                <i class="bi bi-trash text-sm"></i>
                            </button>
                            <form id="delete-form-{{ $pengemudi->id }}" action="{{ route('admin.pengemudi.destroy', $pengemudi->id) }}" method="POST" class="hidden">
                                @csrf
                                @method('DELETE')
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="px-6 py-12 text-center text-gray-400">
                        <i class="bi bi-person-badge text-5xl mb-4 opacity-20 block"></i>
                        <p class="font-bold">Belum ada pengemudi terdaftar</p>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<script>
    function rejectDriver(id, actionUrl) {
        Swal.fire({
            title: 'Tolak Pendaftaran?',
            text: 'Masukkan alasan penolakan untuk pengemudi ini:',
            input: 'textarea',
            inputPlaceholder: 'Contoh: Foto SIM tidak terbaca atau buram...',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Tolak Sekarang',
            cancelButtonText: 'Batal',
            inputValidator: (value) => {
                if (!value) {
                    return 'Alasan penolakan wajib diisi!'
                }
            },
            customClass: {
                title: 'text-xl font-black text-[#1a237e]',
                popup: 'rounded-2xl',
                confirmButton: 'rounded-xl font-bold px-6 py-2',
                cancelButton: 'rounded-xl font-bold px-6 py-2'
            }
        }).then((result) => {
            if (result.isConfirmed) {
                let form = document.createElement('form');
                form.method = 'POST';
                form.action = actionUrl;
                
                let csrfToken = document.createElement('input');
                csrfToken.type = 'hidden';
                csrfToken.name = '_token';
                csrfToken.value = '{{ csrf_token() }}';
                form.appendChild(csrfToken);

                let reasonField = document.createElement('input');
                reasonField.type = 'hidden';
                reasonField.name = 'reason';
                reasonField.value = result.value;
                form.appendChild(reasonField);

                document.body.appendChild(form);
                form.submit();
            }
        })
    }
</script>
@endsection
