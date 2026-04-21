@extends('layouts.admin')

@section('title', 'Admin Dashboard')
@section('header_title', 'Ringkasan Bisnis')

@section('content')
<div class="grid grid-cols-1 md:grid-cols-4 gap-6">
    <!-- Total Armada -->
    <div class="relative group bg-white p-6 rounded-[2rem] shadow-sm border border-gray-100 overflow-hidden transition-all duration-500 hover:shadow-2xl hover:shadow-blue-900/10 hover:-translate-y-2 flex flex-col justify-between">
        <div class="absolute top-0 right-0 w-32 h-32 bg-blue-50/50 rounded-full -mr-16 -mt-16 transition-all group-hover:scale-110"></div>
        <div class="relative flex justify-between items-start">
            <div>
                <p class="text-gray-400 text-[10px] font-black uppercase tracking-[0.2em] mb-2">Unit Armada</p>
                <h3 class="text-3xl font-black text-[#1a237e] tracking-tighter">{{ \App\Models\Armada::count() }} <span class="text-sm font-bold text-gray-300 ml-1">Unit</span></h3>
            </div>
            <div class="w-12 h-12 rounded-xl bg-gradient-to-br from-[#1a237e] to-blue-600 flex items-center justify-center text-white shadow-lg shadow-blue-500/30">
                <i class="bi bi-truck text-xl"></i>
            </div>
        </div>
        <div class="mt-4 flex items-center gap-2">
            <span class="px-2 py-1 bg-green-100 text-green-700 text-[9px] font-black rounded-lg border border-green-200 uppercase tracking-widest">Active Fleet</span>
        </div>
    </div>

    <!-- Order Aktif -->
    <div class="relative group bg-white p-6 rounded-[2rem] shadow-sm border border-gray-100 overflow-hidden transition-all duration-500 hover:shadow-2xl hover:shadow-yellow-500/10 hover:-translate-y-2 flex flex-col justify-between">
        <div class="absolute top-0 right-0 w-32 h-32 bg-yellow-50/50 rounded-full -mr-16 -mt-16 transition-all group-hover:scale-110"></div>
        <div class="relative flex justify-between items-start">
            <div>
                <p class="text-gray-400 text-[10px] font-black uppercase tracking-[0.2em] mb-2">Live Tracking</p>
                <h3 class="text-3xl font-black text-[#1a237e] tracking-tighter">{{ \App\Models\Booking::where('status', 'on_trip')->count() }} <span class="text-sm font-bold text-gray-300 ml-1">Order</span></h3>
            </div>
            <div class="w-12 h-12 rounded-xl bg-gradient-to-br from-[#fbc02d] to-[#f9a825] flex items-center justify-center text-[#1a237e] shadow-lg shadow-yellow-500/30">
                <i class="bi bi-geo-alt text-xl"></i>
            </div>
        </div>
        <div class="mt-4 flex items-center gap-2">
            <span class="px-2 py-1 bg-yellow-100 text-[#1a237e] text-[9px] font-black rounded-lg border border-yellow-200 uppercase tracking-widest">In Progress</span>
        </div>
    </div>

    <!-- Total Layanan -->
    <div class="relative group bg-white p-6 rounded-[2rem] shadow-sm border border-gray-100 overflow-hidden transition-all duration-500 hover:shadow-2xl hover:shadow-green-900/10 hover:-translate-y-2 flex flex-col justify-between">
        <div class="absolute top-0 right-0 w-32 h-32 bg-green-50/50 rounded-full -mr-16 -mt-16 transition-all group-hover:scale-110"></div>
        <div class="relative flex justify-between items-start">
            <div>
                <p class="text-gray-400 text-[10px] font-black uppercase tracking-[0.2em] mb-2">Service Types</p>
                <h3 class="text-3xl font-black text-[#1a237e] tracking-tighter">{{ \App\Models\Layanan::count() }} <span class="text-sm font-bold text-gray-300 ml-1">Jenis</span></h3>
            </div>
            <div class="w-12 h-12 rounded-xl bg-gradient-to-br from-green-500 to-emerald-600 flex items-center justify-center text-white shadow-lg shadow-green-500/30">
                <i class="bi bi-layers text-xl"></i>
            </div>
        </div>
        <div class="mt-4 flex items-center gap-2">
            <span class="px-2 py-1 bg-green-100 text-green-700 text-[9px] font-black rounded-lg border border-green-200 uppercase tracking-widest">Active Services</span>
        </div>
    </div>

    <!-- Perpanjangan Aktif -->
    <div class="relative group bg-white p-6 rounded-[2rem] shadow-sm border border-gray-100 overflow-hidden transition-all duration-500 hover:shadow-2xl hover:shadow-orange-500/10 hover:-translate-y-2 flex flex-col justify-between">
        <div class="absolute top-0 right-0 w-32 h-32 bg-orange-50/50 rounded-full -mr-16 -mt-16 transition-all group-hover:scale-110"></div>
        <div class="relative flex justify-between items-start">
            <div>
                <p class="text-gray-400 text-[10px] font-black uppercase tracking-[0.2em] mb-2">Extensions</p>
                <h3 class="text-3xl font-black text-[#1a237e] tracking-tighter">{{ \App\Models\BookingExtension::where('status', 'pending')->count() }} <span class="text-sm font-bold text-gray-300 ml-1">Request</span></h3>
            </div>
            <div class="w-12 h-12 rounded-xl bg-gradient-to-br from-orange-400 to-orange-600 flex items-center justify-center text-white shadow-lg shadow-orange-500/30">
                <i class="bi bi-calendar-plus text-xl"></i>
            </div>
        </div>
        <div class="mt-4 flex items-center gap-2">
            <a href="{{ route('admin.booking.index') }}" class="px-2 py-1 bg-orange-100 text-orange-700 text-[9px] font-black rounded-lg border border-orange-200 uppercase tracking-widest hover:bg-orange-600 hover:text-white transition-all">Tinjau</a>
        </div>
    </div>

    <!-- Aktivitas Section -->
    <div class="md:col-span-4 bg-white rounded-[2.5rem] shadow-sm p-8 border border-gray-100 min-h-[350px] relative overflow-hidden flex flex-col">
        <div class="absolute top-0 left-0 w-full h-2 bg-gradient-to-r from-[#1a237e] via-[#fbc02d] to-[#1a237e]"></div>
        <div class="flex justify-between items-center mb-8 shrink-0">
            <div>
                <h3 class="font-black text-[#1a237e] text-2xl tracking-tighter flex items-center gap-3">
                    <i class="bi bi-activity text-[#fbc02d]"></i>
                    Aktivitas Operasional
                </h3>
                <p class="text-xs text-gray-400 font-bold mt-1">Pantau pergerakan armada secara real-time</p>
            </div>
            <button class="px-6 py-2 rounded-xl bg-blue-50 text-[#1a237e] text-xs font-black uppercase tracking-widest hover:bg-[#1a237e] hover:text-white transition-all duration-300">
                Lihat Semua <i class="bi bi-arrow-right ml-2"></i>
            </button>
        </div>
        
        <div class="flex-1 border-2 border-dashed border-gray-100 rounded-[2rem] flex flex-col items-center justify-center text-gray-400 bg-gray-50/50">
            <div class="w-16 h-16 rounded-full bg-white flex items-center justify-center shadow-sm mb-4">
                <i class="bi bi-clock-history text-2xl opacity-30 text-[#1a237e]"></i>
            </div>
            <p class="font-black text-gray-500 uppercase tracking-widest text-sm">Belum Ada Pergerakan</p>
            <p class="text-xs mt-2 font-bold opacity-60">Sistem siap memproses orderan baru hari ini.</p>
        </div>
    </div>
</div>
@endsection
