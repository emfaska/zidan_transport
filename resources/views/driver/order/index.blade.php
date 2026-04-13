@extends('layouts.driver')

@section('title', 'Riwayat Tugas - Zidan Driver')

@section('content')
    <!-- Sticky Header -->
    <div class="bg-[#1a237e] pt-12 pb-8 px-6 rounded-b-[40px] shadow-lg sticky top-0 z-50 overflow-hidden">
        <div class="absolute -top-10 -right-10 w-32 h-32 bg-white/5 rounded-full blur-2xl"></div>
        <div class="relative z-10 flex items-center justify-between">
            <a href="{{ route('driver.dashboard') }}" class="w-10 h-10 flex items-center justify-center bg-white/10 rounded-2xl text-white backdrop-blur-md hover:bg-white/20 transition">
                <i class="bi bi-arrow-left text-xl"></i>
            </a>
            <h1 class="text-xs font-[900] text-white uppercase tracking-[0.3em] absolute left-1/2 -translate-x-1/2">Riwayat Tugas</h1>
            
            <form action="{{ route('driver.history') }}" method="GET" id="filter-form">
                <div class="relative">
                    <input type="month" name="month" value="{{ request('month', date('Y-m')) }}" 
                           onchange="this.form.submit()"
                           class="opacity-0 absolute inset-0 w-full h-full cursor-pointer z-20">
                    <div class="w-10 h-10 flex items-center justify-center bg-white/10 rounded-2xl text-white backdrop-blur-md hover:bg-white/20 transition">
                        <i class="bi bi-funnel{{ request('month') ? '-fill text-yellow-400' : '' }}"></i>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Stats Snapshot -->
    <div class="px-6 -mt-6 relative z-20 mb-8">
        <div class="bg-white rounded-[32px] p-6 shadow-xl border border-gray-100 flex items-center justify-between">
            <div class="flex items-center gap-4">
                <div class="w-12 h-12 bg-blue-50 text-[#1a237e] rounded-2xl flex items-center justify-center shadow-inner">
                    <i class="bi bi-check-all text-2xl"></i>
                </div>
                <div>
                    <h4 class="text-2xl font-black text-[#1a237e] leading-none">{{ $bookings->total() }}</h4>
                    <p class="text-[9px] font-black text-gray-400 uppercase tracking-widest mt-1">Total Trip Selesai</p>
                </div>
            </div>
            <i class="bi bi-chevron-right text-gray-200"></i>
        </div>
    </div>

    <!-- History List -->
    <main class="px-6 space-y-3 pb-32 animate-up">
        @forelse($bookings as $booking)
            <a href="{{ route('driver.order.show', $booking->id) }}" class="block bg-white rounded-[24px] p-4 shadow-sm border border-gray-100 group active:scale-[0.98] transition-all relative overflow-hidden">
                <div class="absolute top-0 right-0 p-4 opacity-5 group-hover:opacity-10 transition">
                    <i class="bi bi-check-circle-fill text-4xl text-[#1a237e]"></i>
                </div>
                
                <div class="flex justify-between items-start mb-2">
                    <div class="space-y-0.5">
                        <span class="px-2 py-0.5 bg-green-50 text-green-600 text-[7px] font-black rounded-full uppercase tracking-widest italic border border-green-100">SELESAI</span>
                        <h4 class="text-sm font-black text-[#1a237e] uppercase tracking-tighter mt-1">#{{ $booking->kode_booking }}</h4>
                    </div>
                    <p class="text-[9px] font-black text-gray-300 uppercase italic">{{ \Carbon\Carbon::parse($booking->tanggal_berangkat)->translatedFormat('d M Y') }}</p>
                </div>

                <div class="flex items-center gap-2 mb-3">
                    <div class="w-7 h-7 rounded-lg bg-gray-50 flex items-center justify-center text-gray-400 border border-gray-100">
                        <i class="bi bi-geo-alt text-[10px]"></i>
                    </div>
                    <p class="text-[10px] font-bold text-gray-500 uppercase truncate pr-8">{{ $booking->titik_jemput }} — {{ $booking->titik_tujuan }}</p>
                </div>

                <div class="flex items-center justify-between pt-3 border-t border-gray-50">
                    <div class="flex items-center gap-2">
                        <div class="w-5 h-5 rounded-full bg-blue-50 flex items-center justify-center">
                            <i class="bi bi-person-fill text-[#1a237e] text-[8px]"></i>
                        </div>
                        <span class="text-[9px] font-black text-gray-400 uppercase tracking-widest">{{ $booking->user->name ?? 'User' }}</span>
                    </div>
                    <div class="flex items-center gap-1.5 text-[#1a237e]">
                        <span class="text-[9px] font-[900] uppercase tracking-widest">Detail</span>
                        <i class="bi bi-arrow-right text-xs group-hover:translate-x-1 transition-transform"></i>
                    </div>
                </div>
            </a>
        @empty
            <div class="text-center py-20">
                <div class="w-20 h-20 bg-gray-50 rounded-[28px] flex items-center justify-center mx-auto mb-6 border border-dashed border-gray-200 text-gray-200">
                    <i class="bi bi-inbox text-4xl"></i>
                </div>
                <h3 class="text-sm font-black text-gray-400 uppercase tracking-widest">Belum Ada Riwayat</h3>
                <p class="text-[10px] text-gray-200 mt-2 font-bold uppercase">Selesaikan tugas untuk melihat riwayat di sini</p>
            </div>
        @endforelse

        <!-- Pagination -->
        <div class="pt-6">
            {{ $bookings->links() }}
        </div>
    </main>
@endsection
