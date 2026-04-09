@extends('layouts.admin')

@section('title', 'Detail Pengemudi')
@section('header_title', 'Verifikasi Dokumen Driver')

@section('content')
<div class="mb-6 flex items-center gap-4">
    <a href="{{ route('admin.pengemudi.index') }}" class="w-10 h-10 bg-white rounded-xl border border-gray-100 flex items-center justify-center text-[#1a237e] hover:bg-[#1a237e] hover:text-white transition shadow-sm">
        <i class="bi bi-arrow-left"></i>
    </a>
    <div>
        <h3 class="font-black text-[#1a237e] text-lg">Detail : {{ $pengemudi->name }}</h3>
        <p class="text-[10px] text-gray-400 font-bold uppercase tracking-widest">ID Pengemudi: #D-{{ str_pad($pengemudi->id, 5, '0', STR_PAD_LEFT) }}</p>
    </div>
</div>

<div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
    <!-- Profil & Info Dasar -->
    <div class="lg:col-span-1 space-y-6">
        <div class="bg-white rounded-3xl shadow-sm border border-gray-50 overflow-hidden">
            <div class="h-32 bg-gradient-to-r from-[#1a237e] to-blue-600 relative">
                <div class="absolute -bottom-10 left-1/2 -translate-x-1/2">
                    <div class="w-24 h-24 rounded-2xl bg-white p-1 shadow-xl">
                        <div class="w-full h-full rounded-xl bg-gray-100 overflow-hidden">
                            @if($pengemudi->foto_profil)
                                <img src="{{ asset('storage/'.$pengemudi->foto_profil) }}" class="w-full h-full object-cover">
                            @else
                                <div class="w-full h-full flex items-center justify-center text-gray-300">
                                    <i class="bi bi-person-fill text-4xl"></i>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            <div class="pt-14 pb-8 px-6 text-center">
                <h4 class="font-black text-[#1a237e] text-xl">{{ $pengemudi->name }}</h4>
                <p class="text-sm text-gray-400 font-medium mb-4">{{ $pengemudi->email }}</p>
                
                <div class="flex justify-center gap-2">
                    @if($pengemudi->is_active)
                        <span class="px-4 py-1.5 bg-green-500 text-white text-[10px] font-black rounded-full uppercase tracking-wider shadow-lg shadow-green-500/20">Aktif / Disetujui</span>
                    @else
                        @if($pengemudi->rejection_note)
                            <span class="px-4 py-1.5 bg-red-500 text-white text-[10px] font-black rounded-full uppercase tracking-wider shadow-lg shadow-red-500/20">Ditolak</span>
                        @else
                            <span class="px-4 py-1.5 bg-yellow-400 text-[#1a237e] text-[10px] font-black rounded-full uppercase tracking-wider shadow-lg shadow-yellow-400/20">Menunggu Review</span>
                        @endif
                    @endif
                </div>
            </div>
        </div>

        <div class="bg-white rounded-3xl shadow-sm border border-gray-50 p-6 space-y-6">
            <div>
                <label class="text-[9px] font-black uppercase tracking-[0.2em] text-gray-400 block mb-2">Kontak Utama</label>
                <div class="flex items-center gap-4 p-4 bg-green-50 rounded-2xl border border-green-100">
                    <div class="w-10 h-10 rounded-xl bg-green-500 flex items-center justify-center text-white shadow-lg">
                        <i class="bi bi-whatsapp"></i>
                    </div>
                    <div>
                        <p class="text-[10px] text-green-600 font-bold uppercase">WhatsApp</p>
                        <p class="text-sm font-black text-[#1a237e]">{{ $pengemudi->no_hp ?? '-' }}</p>
                    </div>
                </div>
            </div>

            <div>
                <label class="text-[9px] font-black uppercase tracking-[0.2em] text-gray-400 block mb-2">Alamat Domisili</label>
                <div class="p-4 bg-blue-50/50 rounded-2xl border border-blue-100">
                    <p class="text-xs font-bold text-blue-900 leading-relaxed">{{ $pengemudi->alamat_domisili ?? '-' }}</p>
                </div>
            </div>

            @if($pengemudi->rejection_note)
            <div>
                <label class="text-[9px] font-black uppercase tracking-[0.2em] text-red-400 block mb-2">Catatan Penolakan Sebelumnya</label>
                <div class="p-4 bg-red-50 rounded-2xl border border-red-100">
                    <p class="text-xs font-bold text-red-700 leading-relaxed italic">"{{ $pengemudi->rejection_note }}"</p>
                </div>
            </div>
            @endif
        </div>
    </div>

    <!-- Verifikasi Dokumen -->
    <div class="lg:col-span-2 space-y-8">
        <div class="bg-white rounded-3xl shadow-sm border border-gray-50 p-8">
            <div class="flex items-center justify-between mb-8">
                <div class="flex items-center gap-3">
                    <div class="w-1.5 h-6 bg-[#fbc02d] rounded-full"></div>
                    <h4 class="font-black text-[#1a237e] uppercase tracking-tight">Dokumen Identitas</h4>
                </div>
                <span class="text-[10px] font-bold text-gray-400 uppercase tracking-widest">Klik gambar untuk memperbesar</span>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <!-- KTP -->
                <div class="space-y-4">
                    <div class="flex items-center justify-between">
                        <p class="text-[10px] font-black text-[#1a237e] uppercase tracking-widest pl-1">Foto KTP</p>
                        <span class="text-[9px] bg-blue-50 text-blue-600 px-2 py-0.5 rounded-full font-bold uppercase">Kartu Tanda Penduduk</span>
                    </div>
                    <div class="group relative rounded-3xl overflow-hidden border-4 border-gray-50 shadow-inner bg-gray-100 cursor-zoom-in aspect-[1.6/1]" onclick="openModal('{{ asset('storage/'.$pengemudi->foto_ktp) }}', 'Foto KTP : {{ $pengemudi->name }}')">
                        @if($pengemudi->foto_ktp)
                            <img src="{{ asset('storage/'.$pengemudi->foto_ktp) }}" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110">
                            <div class="absolute inset-0 bg-[#1a237e]/40 opacity-0 group-hover:opacity-100 transition flex items-center justify-center">
                                <i class="bi bi-zoom-in text-white text-3xl"></i>
                            </div>
                        @else
                            <div class="w-full h-full flex flex-col items-center justify-center text-gray-300 gap-2">
                                <i class="bi bi-image text-3xl opacity-20"></i>
                                <span class="text-[10px] font-bold italic">Belum diunggah</span>
                            </div>
                        @endif
                    </div>
                </div>

                <!-- SIM -->
                <div class="space-y-4">
                    <div class="flex items-center justify-between">
                        <p class="text-[10px] font-black text-[#1a237e] uppercase tracking-widest pl-1">Foto SIM</p>
                        <span class="text-[9px] bg-blue-50 text-blue-600 px-2 py-0.5 rounded-full font-bold uppercase">No: {{ $pengemudi->nomor_sim ?? 'N/A' }}</span>
                    </div>
                    <div class="group relative rounded-3xl overflow-hidden border-4 border-gray-50 shadow-inner bg-gray-100 cursor-zoom-in aspect-[1.6/1]" onclick="openModal('{{ asset('storage/'.$pengemudi->foto_sim) }}', 'Foto SIM : {{ $pengemudi->name }}')">
                        @if($pengemudi->foto_sim)
                            <img src="{{ asset('storage/'.$pengemudi->foto_sim) }}" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110">
                            <div class="absolute inset-0 bg-[#1a237e]/40 opacity-0 group-hover:opacity-100 transition flex items-center justify-center">
                                <i class="bi bi-zoom-in text-white text-3xl"></i>
                            </div>
                        @else
                            <div class="w-full h-full flex flex-col items-center justify-center text-gray-300 gap-2">
                                <i class="bi bi-image text-3xl opacity-20"></i>
                                <span class="text-[10px] font-bold italic">Belum diunggah</span>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Action Buttons -->
            @if(!$pengemudi->is_active)
            <div class="mt-12 pt-8 border-t border-gray-100 flex flex-col sm:flex-row gap-4">
                <button type="button" onclick="confirmAction('{{ $pengemudi->id }}', '{{ route('admin.pengemudi.approve', $pengemudi->id) }}', 'Setujui Pendaftaran?', 'Setelah disetujui, driver akan langsung bisa login ke sistem.', 'success', 'Ya, Setujui Sekarang')" 
                    class="flex-1 py-4 bg-green-500 text-white rounded-2xl font-black text-sm uppercase tracking-widest hover:bg-green-600 transition shadow-xl shadow-green-500/20 flex items-center justify-center gap-3">
                    <i class="bi bi-check-circle-fill text-lg"></i>
                    Setujui Driver
                </button>
                <button type="button" onclick="rejectDriver('{{ $pengemudi->id }}', '{{ route('admin.pengemudi.reject', $pengemudi->id) }}')" 
                    class="flex-1 py-4 bg-red-500 text-white rounded-2xl font-black text-sm uppercase tracking-widest hover:bg-red-600 transition shadow-xl shadow-red-500/20 flex items-center justify-center gap-3">
                    <i class="bi bi-x-circle-fill text-lg"></i>
                    Tolak Pendaftaran
                </button>
            </div>
            @else
                <div class="mt-12 p-6 bg-blue-50 rounded-[30px] border-2 border-dashed border-blue-200 text-center">
                    <i class="bi bi-info-circle-fill text-2xl text-blue-400 mb-2 block"></i>
                    <p class="text-xs font-bold text-blue-800">Akun ini sudah berstatus aktif dan telah diverifikasi oleh admin.</p>
                </div>
            @endif
        </div>
    </div>
</div>

<!-- Modal Zoom Gambar -->
<div id="imageModal" class="fixed inset-0 z-[60] hidden flex items-center justify-center bg-[#1a237e]/90 backdrop-blur-md p-4">
    <button onclick="closeModal()" class="absolute top-8 right-8 text-white text-4xl hover:rotate-90 transition transform duration-300">
        <i class="bi bi-x-lg"></i>
    </button>
    <div class="max-w-4xl w-full">
        <h3 id="modalTitle" class="text-white font-black text-xl mb-6 text-center tracking-widest uppercase"></h3>
        <div class="bg-white p-2 rounded-[40px] shadow-2xl overflow-hidden max-h-[70vh]">
            <img id="modalImg" class="w-full h-full object-contain rounded-[32px]">
        </div>
    </div>
</div>

<script>
    function openModal(src, title) {
        document.getElementById('modalImg').src = src;
        document.getElementById('modalTitle').innerText = title;
        document.getElementById('imageModal').classList.remove('hidden');
        document.body.style.overflow = 'hidden';
    }

    function closeModal() {
        document.getElementById('imageModal').classList.add('hidden');
        document.body.style.overflow = 'auto';
    }

    // Modal close on ESC key
    document.addEventListener('keydown', function(event) {
        if (event.key === "Escape") {
            closeModal();
        }
    });

    // Reuse rejectDriver script from index or place it in a common script if needed
    function rejectDriver(id, actionUrl) {
        Swal.fire({
            title: 'Tolak Pendaftaran?',
            text: 'Masukkan alasan penolakan agar driver bisa memperbaikinya:',
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
                popup: 'rounded-[30px]',
                confirmButton: 'rounded-2xl font-bold px-8 py-3',
                cancelButton: 'rounded-2xl font-bold px-8 py-3'
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
