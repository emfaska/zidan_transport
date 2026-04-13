@extends('layouts.driver')

@section('title', $type === 'issue' ? 'Lapor Kendala' : 'Ganti Armada')

@section('content')
    <!-- Sticky Header -->
    <div class="bg-[#1a237e] pt-12 pb-6 px-6 rounded-b-[32px] shadow-lg sticky top-0 z-50">
        <div class="flex items-center justify-between">
            <a href="{{ route('driver.order.show', $booking->id) }}" class="w-10 h-10 flex items-center justify-center bg-white/10 rounded-xl text-white">
                <i class="bi bi-chevron-left text-xl"></i>
            </a>
            <h1 class="text-xs font-black text-white uppercase tracking-[0.3em]">
                {{ $type === 'issue' ? 'Lapor Kendala' : 'Ganti Armada' }}
            </h1>
            <div class="w-10"></div>
        </div>
    </div>

    <main class="px-6 py-8 pb-32 animate-up">
        <!-- Vehicle Context Card -->
        <div class="bg-white rounded-[32px] p-6 shadow-xl border border-gray-50 mb-8 relative overflow-hidden">
            <div class="absolute -top-10 -right-10 w-32 h-32 bg-blue-50/50 rounded-full blur-2xl"></div>
            <p class="text-[9px] font-black text-gray-400 uppercase tracking-widest mb-4">Kendaraan Terkait</p>
            <div class="flex items-center gap-4">
                <div class="w-14 h-10 rounded-xl bg-gray-50 flex items-center justify-center border border-gray-100 overflow-hidden">
                    @if($booking->armada->foto)
                        <img src="{{ asset('storage/'.$booking->armada->foto) }}" class="w-full h-full object-cover">
                    @else
                        <i class="bi bi-truck text-[#1a237e]"></i>
                    @endif
                </div>
                <div>
                    <h4 class="text-sm font-black text-[#1a237e]">{{ $booking->armada->nama }}</h4>
                    <p class="text-[10px] font-bold text-gray-400 uppercase tracking-tighter">{{ $booking->armada->plat_nomor }}</p>
                </div>
            </div>
        </div>

        <form action="{{ route('driver.order.report.submit', $booking->id) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf
            <input type="hidden" name="type" value="{{ $type }}">

            @if($type === 'issue')
                <div class="space-y-6">
                    <div>
                        <label class="block text-[10px] font-black text-[#1a237e] uppercase tracking-widest mb-3 ml-2">Kategori Kendala</label>
                        <select name="category" required class="w-full px-5 py-4 bg-gray-50 border border-gray-100 rounded-2xl text-xs font-bold text-[#1a237e] focus:outline-none focus:ring-4 focus:ring-blue-100 focus:border-[#1a237e] transition-all appearance-none">
                            <option value="">Pilih Kategori...</option>
                            <option value="Mesin">Mesin & Performa</option>
                            <option value="AC">AC Tidak Dingin</option>
                            <option value="Ban">Masalah Ban/Kaki-kaki</option>
                            <option value="Listrik">Kelistrikan/Lampu</option>
                            <option value="Kebersihan">Kebersihan Unit</option>
                            <option value="Lainnya">Lainnya...</option>
                        </select>
                    </div>

                    <div>
                        <label class="block text-[10px] font-black text-[#1a237e] uppercase tracking-widest mb-3 ml-2">Detail Masalah</label>
                        <textarea name="description" required rows="4" 
                            placeholder="Jelaskan secara detail kendala yang dialami agar Admin dapat segera menindaklanjuti..."
                            class="w-full px-6 py-5 bg-gray-50 border border-gray-100 rounded-[24px] text-xs font-bold text-[#1a237e] focus:outline-none focus:ring-4 focus:ring-blue-100 focus:border-[#1a237e] transition-all placeholder:text-gray-300"></textarea>
                    </div>

                    <div>
                        <label class="block text-[10px] font-black text-[#1a237e] uppercase tracking-widest mb-3 ml-2">Foto Bukti (Opsional)</label>
                        <div class="relative">
                            <input type="file" name="photo" accept="image/*" class="absolute inset-0 w-full h-full opacity-0 z-10 cursor-pointer">
                            <div class="w-full py-8 bg-gray-50 border-2 border-dashed border-gray-200 rounded-[24px] flex flex-col items-center justify-center text-gray-400 group-hover:border-[#1a237e] transition-all">
                                <i class="bi bi-camera text-3xl mb-2"></i>
                                <span class="text-[10px] font-black uppercase tracking-widest">Ambil Foto / Upload</span>
                            </div>
                        </div>
                    </div>
                </div>
            @else
                <div class="space-y-6">
                    <div class="bg-red-50 p-6 rounded-2xl border border-red-100 mb-4">
                        <div class="flex gap-4">
                            <i class="bi bi-info-circle-fill text-red-500 text-xl"></i>
                            <p class="text-[10px] font-bold text-red-600 leading-relaxed uppercase tracking-tight">
                                Permintaan ganti armada akan segera diteruskan ke Admin. Sambil menunggu, pastikan lokasi penjemputan/tujuan tetap aman bagi penumpang.
                            </p>
                        </div>
                    </div>

                    <div>
                        <label class="block text-[10px] font-black text-[#1a237e] uppercase tracking-widest mb-3 ml-2">Alasan Penggantian</label>
                        <textarea name="reason" required rows="5" 
                            placeholder="Berikan alasan mendesak mengapa perlu dilakukan pergantian unit untuk perjalanan ini..."
                            class="w-full px-6 py-5 bg-gray-50 border border-gray-100 rounded-[24px] text-xs font-bold text-[#1a237e] focus:outline-none focus:ring-4 focus:ring-blue-100 focus:border-[#1a237e] transition-all placeholder:text-gray-300"></textarea>
                    </div>
                </div>
            @endif

            <button type="submit" class="w-full py-6 mt-4 bg-gradient-to-r {{ $type === 'issue' ? 'from-orange-500 to-orange-600' : 'from-blue-600 to-indigo-700' }} text-white rounded-[24px] font-[900] uppercase tracking-[0.3em] text-xs shadow-2xl transition hover:opacity-90 active:scale-95 border-b-4 {{ $type === 'issue' ? 'border-orange-800' : 'border-blue-900' }}">
                {{ $type === 'issue' ? 'KIRIM LAPORAN' : 'AJUKAN PERGANTIAN' }}
            </button>
        </form>
    </main>
@endsection
