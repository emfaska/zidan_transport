@extends('layouts.driver')

@section('title', 'Tugas Aktif - Zidan Driver')

@section('content')
    <!-- Sticky Header -->
    <div class="bg-gradient-to-r from-[#1a237e] to-[#0d1440] pt-12 pb-8 px-6 rounded-b-[40px] shadow-lg sticky top-0 z-50 overflow-hidden">
        <div class="absolute -top-10 -right-10 w-32 h-32 bg-white/5 rounded-full blur-2xl"></div>
        <div class="relative z-10 flex items-center justify-between">
            <a href="{{ route('driver.dashboard') }}" class="w-10 h-10 flex items-center justify-center bg-white/10 rounded-2xl text-white backdrop-blur-md hover:bg-white/20 transition">
                <i class="bi bi-arrow-left text-xl"></i>
            </a>
            <h1 class="text-xs font-[900] text-white uppercase tracking-[0.3em] absolute left-1/2 -translate-x-1/2">Tugas Aktif</h1>
            <div class="w-10"></div> <!-- Placeholder for alignment -->
        </div>
    </div>

    <!-- Stats Snapshot -->
    <div class="px-6 -mt-6 relative z-20 mb-8">
        <div class="bg-white rounded-[32px] p-6 shadow-xl border border-gray-100 flex items-center justify-between">
            <div class="flex items-center gap-4">
                <div class="w-12 h-12 bg-yellow-50 text-[#fbc02d] rounded-2xl flex items-center justify-center shadow-inner">
                    <i class="bi bi-list-task text-2xl"></i>
                </div>
                <div>
                    <h4 class="text-2xl font-black text-[#1a237e] leading-none">{{ $bookings->total() }}</h4>
                    <p class="text-[9px] font-black text-gray-400 uppercase tracking-widest mt-1">Total Tugas Mendatang</p>
                </div>
            </div>
            <i class="bi bi-chevron-right text-gray-200"></i>
        </div>
    </div>

    <!-- Tasks List -->
    <main class="px-6 space-y-3 pb-32 animate-up">
        @forelse($bookings as $booking)
            <a href="{{ route('driver.order.show', $booking->id) }}" class="block bg-white rounded-[24px] p-5 shadow-sm border border-blue-50 hover:bg-blue-50/10 active:scale-[0.98] transition-all relative overflow-hidden group">
                <div class="absolute top-0 right-0 p-4 opacity-5 group-hover:opacity-10 transition">
                    <i class="bi bi-calendar-event text-5xl text-[#1a237e]"></i>
                </div>
                
                <div class="flex justify-between items-start mb-3">
                    <div class="space-y-1">
                        @if($booking->status == 'on_trip')
                        <span class="px-3 py-1 bg-green-100 text-green-600 text-[8px] font-black rounded-full uppercase tracking-widest inline-block border border-green-200">On Trip</span>
                        @else
                        <span class="px-3 py-1 bg-yellow-100 text-yellow-700 text-[8px] font-black rounded-full uppercase tracking-widest inline-block border border-yellow-200">Confirmed</span>
                        @endif
                        <h4 class="text-base font-black text-[#1a237e] uppercase tracking-tighter block">#{{ $booking->kode_booking }}</h4>
                    </div>
                    <div class="text-right flex flex-col items-end">
                        <p class="text-[10px] font-black text-gray-400 uppercase tracking-widest">{{ \Carbon\Carbon::parse($booking->tanggal_berangkat)->translatedFormat('d M Y') }}</p>
                        <p class="text-[12px] font-bold text-[#1a237e] uppercase tracking-widest mt-0.5"><i class="bi bi-clock-fill text-[#fbc02d]"></i> {{ \Carbon\Carbon::parse($booking->waktu_jemput)->format('H:i') }}</p>
                    </div>
                </div>

                <div class="space-y-3 mb-4 mt-4 relative z-10">
                    <div class="flex gap-3">
                        <div class="flex flex-col items-center mt-0.5">
                            <div class="w-2.5 h-2.5 rounded-full bg-blue-500 border-2 border-white shadow-sm shadow-blue-500/50"></div>
                            <div class="w-0.5 h-full bg-gray-200 border-l border-dashed border-gray-300"></div>
                        </div>
                        <div>
                            <p class="text-[8px] font-black text-gray-400 uppercase tracking-widest">Penjemputan</p>
                            <p class="text-xs font-bold text-gray-700 uppercase pr-4 mt-0.5">{{ $booking->titik_jemput }}</p>
                        </div>
                    </div>
                    <div class="flex gap-3">
                        <div class="flex flex-col items-center mt-0.5">
                            <div class="w-2.5 h-2.5 rounded-full bg-[#fbc02d] border-2 border-white shadow-sm shadow-yellow-500/50"></div>
                        </div>
                        <div>
                            <p class="text-[8px] font-black text-gray-400 uppercase tracking-widest">Tujuan</p>
                            <p class="text-xs font-bold text-gray-700 uppercase pr-4 mt-0.5">{{ $booking->titik_tujuan }}</p>
                        </div>
                    </div>
                </div>

                <div class="flex items-center justify-between pt-4 border-t border-gray-50">
                    <div class="flex items-center gap-2">
                        <div class="w-6 h-6 rounded-full bg-blue-50 flex items-center justify-center">
                            <i class="bi bi-person-fill text-[#1a237e] text-[10px]"></i>
                        </div>
                        <span class="text-[10px] font-black text-gray-500 uppercase tracking-widest">{{ $booking->user->name ?? 'User' }}</span>
                    </div>
                    <button class="px-5 py-2.5 bg-[#1a237e] text-white text-[9px] font-black rounded-xl uppercase tracking-widest shadow-md shadow-blue-900/20 group-hover:bg-[#0d1440] transition">
                        Buka Detail
                    </button>
                </div>
            </a>
        @empty
            <div class="text-center py-20">
                <div class="w-20 h-20 bg-gray-50 rounded-[28px] flex items-center justify-center mx-auto mb-6 border border-dashed border-gray-200 text-gray-200">
                    <i class="bi bi-calendar-x text-4xl"></i>
                </div>
                <h3 class="text-sm font-black text-gray-400 uppercase tracking-widest">Tidak Ada Tugas Mendatang</h3>
                <p class="text-[10px] text-gray-200 mt-2 font-bold uppercase">Anda belum memiliki jadwal tugas baru</p>
            </div>
        @endforelse

        <!-- Pagination -->
        <div class="pt-6 pb-12">
            {{ $bookings->links() }}
        </div>
    </main>
@endsection
