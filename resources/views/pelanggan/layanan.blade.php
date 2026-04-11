<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Layanan & Rute - Zidan Transport</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <style>
        body { font-family: 'Montserrat', sans-serif; }
        .dropdown:hover .dropdown-menu { display: block; }
    </style>
</head>
<body class="bg-gray-50">

    @include('partials.pelanggan.navbar')

    <main class="max-w-7xl mx-auto p-4 md:p-8 pt-24 md:pt-28">
        
        <!-- Breadcrumb -->
        <div class="mb-12">
            <div class="flex items-center gap-2 text-sm text-gray-500 mb-4">
                <a href="{{ Auth::check() ? route('home') : route('landing') }}" class="hover:text-[#1a237e]">Beranda</a>
                <i class="bi bi-chevron-right text-xs"></i>
                <span class="text-[#1a237e] font-semibold">Layanan Kami</span>
            </div>
            <h1 class="text-4xl md:text-5xl font-black text-[#1a237e] mb-4 uppercase">Layanan Profesional</h1>
            <p class="text-lg text-gray-600 max-w-3xl">Kami menyediakan berbagai layanan transportasi profesional untuk memenuhi kebutuhan perjalanan Anda</p>
        </div>

        <!-- Services Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-12">
            @forelse($layanans as $layanan)
            <div class="bg-white rounded-[40px] p-10 shadow-sm border border-gray-100 hover:border-[#fbc02d] hover:shadow-2xl transition-all duration-300 flex flex-col group h-full">
                <div class="w-20 h-20 bg-[#1a237e] rounded-[24px] flex items-center justify-center mb-8 shadow-lg rotate-3 group-hover:rotate-0 transition duration-500">
                    <i class="bi {{ $layanan->icon ?? 'bi-star-fill' }} text-[#fbc02d] text-4xl"></i>
                </div>
                <h2 class="text-2xl font-[900] text-[#1a237e] mb-4 uppercase tracking-tight">{{ $layanan->nama_layanan }}</h2>
                <p class="text-gray-500 font-medium leading-relaxed mb-8 flex-grow">{{ $layanan->deskripsi }}</p>
                <a href="{{ route('pelanggan.booking.create') }}" class="inline-flex items-center justify-center w-full bg-gray-50 hover:bg-[#1a237e] hover:text-white text-[#1a237e] font-black py-5 rounded-[20px] transition-all duration-300 uppercase tracking-widest text-xs gap-3">
                    Pesan Layanan <i class="bi bi-arrow-right"></i>
                </a>
            </div>
            @empty
            <div class="col-span-full text-center py-10">
                <p class="text-gray-500">Belum ada layanan yang tersedia.</p>
            </div>
            @endforelse
        </div>

        <!-- CTA Section -->
        <div class="bg-gradient-to-r from-[#1a237e] to-blue-800 rounded-3xl p-8 md:p-12 text-white text-center">
            <h2 class="text-3xl md:text-4xl font-black mb-4">Siap Memulai Perjalanan?</h2>
            <p class="text-blue-200 text-lg mb-6 max-w-2xl mx-auto">Pilih layanan yang sesuai dengan kebutuhan Anda dan nikmati perjalanan yang aman dan nyaman</p>
            <div class="flex flex-wrap gap-4 justify-center">
                <a href="{{ route('pelanggan.armada') }}" class="bg-[#fbc02d] text-[#1a237e] px-8 py-4 rounded-xl font-black text-base inline-flex items-center gap-2 shadow-xl hover:bg-yellow-400 transition">
                    <i class="bi bi-car-front"></i>
                    Lihat Armada
                </a>
                <a href="{{ route('pelanggan.booking.create') }}" class="bg-white/10 backdrop-blur-sm border-2 border-white/30 text-white px-8 py-4 rounded-xl font-bold text-base inline-flex items-center gap-2 hover:bg-white/20 transition">
                    <i class="bi bi-calendar-check"></i>
                    Pesan Sekarang
                </a>
            </div>
        </div>

    </main>

    @include('partials.pelanggan.footer')
</body>
</html>
