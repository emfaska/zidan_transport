@extends('layouts.driver')

@section('title', 'Detail Tugas #' . $booking->kode_booking)

@section('content')
    <!-- Sticky Header -->
    <div class="bg-[#1a237e] pt-12 pb-6 px-6 rounded-b-[32px] shadow-lg sticky top-0 z-50">
        <div class="flex items-center justify-between">
            <a href="{{ route('driver.dashboard') }}" class="w-10 h-10 flex items-center justify-center bg-white/10 rounded-xl text-white">
                <i class="bi bi-chevron-left text-xl"></i>
            </a>
            <h1 class="text-sm font-black text-white uppercase tracking-widest">Detail Tugas</h1>
            <div class="w-10 h-10 flex items-center justify-center bg-white/10 rounded-xl text-white">
                <i class="bi bi-info-circle"></i>
            </div>
        </div>
    </div>

    <main class="px-6 py-8 space-y-6 pb-32 animate-up">
        <!-- Status Card -->
        <div class="bg-white rounded-[32px] p-6 shadow-xl border border-gray-50 flex items-center justify-between">
            <div>
                <p class="text-[9px] font-black text-gray-400 uppercase tracking-widest mb-1">Status Saat Ini</p>
                <div class="flex items-center gap-2">
                    <span class="w-2 h-2 rounded-full {{ $booking->status === 'on_trip' ? 'bg-blue-500 animate-pulse' : ($booking->status === 'completed' ? 'bg-green-500' : 'bg-yellow-500') }}"></span>
                    <h4 class="text-lg font-black text-[#1a237e] uppercase">
                        {{ $booking->status === 'confirmed' ? 'Siap Jemput' : ($booking->status === 'on_trip' ? 'Dalam Perjalanan' : 'Selesai') }}
                    </h4>
                </div>
            </div>
            <div class="text-right">
                <p class="text-[9px] font-black text-gray-400 uppercase tracking-widest mb-1">ID Booking</p>
                <span class="text-xs font-black text-gray-400">#{{ $booking->kode_booking }}</span>
            </div>
        </div>

        <!-- Passenger Info -->
        <div class="bg-white rounded-[32px] p-8 shadow-xl border border-gray-50 relative overflow-hidden">
            <div class="absolute top-0 right-0 p-8 opacity-5">
                <i class="bi bi-person-fill text-8xl text-[#1a237e]"></i>
            </div>
            <p class="text-[9px] font-black text-gray-400 uppercase tracking-widest mb-6 border-b border-gray-50 pb-4">Informasi Pelanggan</p>
            
            <div class="flex items-center gap-4 mb-6">
                <img src="https://ui-avatars.com/api/?name={{ urlencode($booking->user->name) }}&background=fbc02d&color=1a237e&bold=true" class="w-16 h-16 rounded-[24px] shadow-sm">
                <div>
                    <h4 class="text-base font-black text-[#1a237e]">{{ $booking->user->name }}</h4>
                    <p class="text-xs font-bold text-gray-400">{{ $booking->user->no_hp }}</p>
                </div>
            </div>

            <div class="grid grid-cols-2 gap-4">
                <a href="tel:{{ $booking->user->no_hp }}" class="flex items-center justify-center gap-2 py-4 bg-blue-50 text-[#1a237e] rounded-2xl text-[10px] font-black uppercase tracking-widest hover:bg-blue-100 transition">
                    <i class="bi bi-telephone-fill"></i> Telepon
                </a>
                <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $booking->user->no_hp) }}" class="flex items-center justify-center gap-2 py-4 bg-green-50 text-green-600 rounded-2xl text-[10px] font-black uppercase tracking-widest hover:bg-green-100 transition">
                    <i class="bi bi-whatsapp"></i> Chat WA
                </a>
            </div>
        </div>

        <!-- Route & Location -->
        <div class="bg-white rounded-[32px] p-8 shadow-xl border border-gray-50">
            <p class="text-[9px] font-black text-gray-400 uppercase tracking-widest mb-8 border-b border-gray-50 pb-4">Info Perjalanan</p>
            
            <div class="space-y-8 relative">
                <!-- Timeline Line -->
                <div class="absolute left-[11px] top-2 bottom-2 w-0.5 bg-gray-100 border-l border-dashed border-gray-200"></div>

                <!-- Pickup -->
                <div class="relative pl-10">
                    <div class="absolute left-0 top-1 w-6 h-6 rounded-full bg-blue-500 border-4 border-white shadow-lg"></div>
                    <p class="text-[8px] font-black text-gray-300 uppercase tracking-[0.2em] mb-1">Titik Penjemputan</p>
                    <h5 class="text-sm font-black text-[#1a237e] uppercase leading-tight">{{ $booking->titik_jemput }}</h5>
                    <p class="text-[10px] text-gray-400 font-bold mt-1 italic">{{ $booking->waktu_jemput->format('d M — H:i') }} WIB</p>
                </div>

                <!-- Destination -->
                <div class="relative pl-10">
                    <div class="absolute left-0 top-1 w-6 h-6 rounded-full bg-[#fbc02d] border-4 border-white shadow-lg"></div>
                    <p class="text-[8px] font-black text-gray-300 uppercase tracking-[0.2em] mb-1">Lokasi Tujuan</p>
                    <h5 class="text-sm font-black text-[#1a237e] uppercase leading-tight">{{ $booking->titik_tujuan }}</h5>
                    <p class="text-[10px] text-gray-400 font-bold mt-1">Estimasi Perjalanan Aman</p>
                </div>
            </div>


        </div>

        <!-- Action Buttons -->
        <div class="pt-4">
            @if($booking->status === 'confirmed')
                <form action="{{ route('driver.order.update-status', $booking->id) }}" method="POST">
                    @csrf
                    <input type="hidden" name="status" value="on_trip">
                    <button type="submit" class="w-full py-6 bg-gradient-to-r from-blue-600 to-indigo-700 text-white rounded-[24px] font-[900] uppercase tracking-[0.3em] text-xs shadow-2xl shadow-blue-600/30 active:scale-95 transition border-b-4 border-blue-800">
                        MULAI PERJALANAN
                    </button>
                </form>
            @elseif($booking->status === 'on_trip')
                <form action="{{ route('driver.order.update-status', $booking->id) }}" method="POST">
                    @csrf
                    <input type="hidden" name="status" value="completed">
                    <button type="submit" class="w-full py-6 bg-gradient-to-r from-green-500 to-emerald-600 text-white rounded-[24px] font-[900] uppercase tracking-[0.3em] text-xs shadow-2xl shadow-green-500/30 active:scale-95 transition border-b-4 border-green-700">
                         KONFIRMASI SELESAI
                    </button>
                </form>
            @else
                <div class="bg-gray-50 border border-gray-100 rounded-2xl p-6 text-center">
                    <i class="bi bi-check2-all text-4xl text-green-500 mb-2 block"></i>
                    <p class="text-[10px] font-black text-gray-400 uppercase tracking-widest">Tugas Ini Telah Diselesaikan</p>
                </div>
            @endif
        </div>

        <!-- Emergency SOS Button (Driver) -->
        @if($booking->status === 'on_trip' || $booking->status === 'confirmed')
        <div class="fixed bottom-24 right-6 z-[100]">
            @php
                $adminWa = \App\Models\Setting::get('contact_whatsapp', '6282142951682');
                $sosMessage = "DARURAT! Saya Driver " . Auth::user()->name . ", butuh bantuan segera untuk Order #" . $booking->kode_booking . ". Mohon respon cepat!";
                $waUrl = "https://wa.me/" . $adminWa . "?text=" . urlencode($sosMessage);
            @endphp
            <a href="{{ $waUrl }}" target="_blank" 
               class="w-16 h-16 bg-red-600 text-white rounded-full shadow-2xl shadow-red-600/50 flex items-center justify-center animate-pulse group active:scale-90 transition-all border-4 border-white">
                <i class="bi bi-exclamation-octagon-fill text-2xl group-hover:scale-110 transition-transform"></i>
                <span class="absolute right-full mr-4 px-4 py-2 bg-red-600 text-white text-[10px] font-black uppercase tracking-widest rounded-xl opacity-0 group-hover:opacity-100 transition-opacity whitespace-nowrap pointer-events-none">SOS DARURAT</span>
            </a>
        </div>
        @endif
    </main>
@endsection
