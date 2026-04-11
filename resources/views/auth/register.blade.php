<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" href="{{ asset('images/logo.png') }}">
    <title>Daftar - Zidan Transport</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <style> body { font-family: 'Montserrat', sans-serif; } </style>
</head>
<body class="bg-white min-h-screen flex items-center justify-center p-4">

    <div class="w-full max-w-6xl bg-white rounded-3xl shadow-2xl overflow-hidden flex min-h-[700px] border border-gray-100">
        
        <!-- Left Side - Branding (BLUE) -->
        <div class="hidden md:flex md:w-2/5 bg-[#1a237e] text-white flex-col justify-between p-12 relative overflow-hidden">
            <!-- Background Pattern -->
            <div class="absolute inset-0 z-0">
                 <!-- Gradient Overlay -->
                 <div class="absolute inset-0 bg-gradient-to-t from-[#1a237e] via-[#1a237e]/90 to-transparent"></div>
                 <!-- Pattern -->
                 <div class="absolute inset-0 opacity-20" style="background-image: radial-gradient(#ffffff 2px, transparent 2px); background-size: 30px 30px;"></div>
            </div>

            <div class="relative z-10">
                <div class="inline-block bg-white rounded-full p-6 mb-6 shadow-xl">
                    <img src="{{ asset('images/logo.png') }}" alt="Zidan Transport" class="w-24 h-auto">
                </div>
                <div class="flex flex-col mb-10">
                    <h1 class="text-3xl font-black text-white leading-none uppercase tracking-tighter">Zidan</h1>
                    <h1 class="text-base font-bold text-[#fbc02d] uppercase tracking-[0.3em] leading-none mt-1">Transport</h1>
                </div>
                <h2 class="text-4xl font-black leading-tight">
                    Gabung dengan <span class="text-[#fbc02d]">Komunitas</span> Perjalanan Kami.
                </h2>
                <div class="w-20 h-2 bg-[#fbc02d] mt-6 mb-6"></div>
                <p class="text-blue-100 text-lg font-medium leading-relaxed">
                    Nikmati layanan carter dan antar-jemput berkualitas premium dengan armada modern. Akses eksklusif ke promo menarik khusus member.
                </p>
            </div>

            <div class="relative z-10 mt-auto">
                <div class="flex items-center gap-4 bg-[#0d1440] p-4 rounded-2xl border border-blue-900 shadow-xl">
                    <div class="w-12 h-12 bg-[#fbc02d] rounded-full flex items-center justify-center text-[#1a237e] text-xl">
                        <i class="bi bi-shield-check"></i>
                    </div>
                    <div>
                        <p class="font-bold text-white text-sm">Data Anda Aman</p>
                        <p class="text-xs text-blue-300">Enkripsi standar industri</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Right Side - Form (WHITE) -->
        <div class="w-full md:w-3/5 p-8 md:p-12 flex flex-col justify-center relative">
            
            <div class="mb-8">
                <div class="md:hidden mb-6 flex justify-center">
                    <img src="{{ asset('images/logo.png') }}" alt="Zidan Transport" class="h-12 w-auto">
                </div>
                <h3 class="text-3xl font-black text-[#1a237e] mb-2">Buat Akun Baru</h3>
                <p class="text-gray-500 font-medium">Lengkapi data diri Anda untuk memulai perjalanan.</p>
            </div>

            @if ($errors->any())
                <div class="mb-6 bg-red-50 border-l-4 border-red-500 p-4 rounded-r-lg">
                    <p class="text-xs text-red-600 font-bold">Harap periksa kembali inputan Anda.</p>
                </div>
            @endif

            <form action="{{ route('register') }}" method="POST" class="grid grid-cols-1 md:grid-cols-2 gap-6">
                @csrf
                <!-- Nama -->
                <div class="col-span-1">
                    <label class="block text-xs font-bold uppercase text-gray-500 mb-2 tracking-wide">Nama Lengkap</label>
                    <input type="text" name="name" value="{{ old('name') }}" required
                        class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-[#1a237e] focus:ring-2 focus:ring-blue-100 bg-gray-50 focus:bg-white outline-none transition-all font-medium text-gray-700 placeholder-gray-300"
                        placeholder="Contoh: Budi Santoso">
                    @error('name') <p class="text-red-500 text-[10px] mt-1 font-bold italic">{{ $message }}</p> @enderror
                </div>

                <!-- Email -->
                <div class="col-span-1">
                    <label class="block text-xs font-bold uppercase text-gray-500 mb-2 tracking-wide">Alamat Email</label>
                    <input type="email" name="email" value="{{ old('email') }}" required
                        class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-[#1a237e] focus:ring-2 focus:ring-blue-100 bg-gray-50 focus:bg-white outline-none transition-all font-medium text-gray-700 placeholder-gray-300"
                        placeholder="nama@email.com">
                    @error('email') <p class="text-red-500 text-[10px] mt-1 font-bold italic">{{ $message }}</p> @enderror
                </div>

                <!-- No HP -->
                <div class="col-span-1">
                    <label class="block text-xs font-bold uppercase text-gray-500 mb-2 tracking-wide">Nomor WhatsApp</label>
                    <input type="text" name="no_hp" value="{{ old('no_hp') }}" required
                        class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-[#1a237e] focus:ring-2 focus:ring-blue-100 bg-gray-50 focus:bg-white outline-none transition-all font-medium text-gray-700 placeholder-gray-300"
                        placeholder="0812...">
                    @error('no_hp') <p class="text-red-500 text-[10px] mt-1 font-bold italic">{{ $message }}</p> @enderror
                </div>

                <!-- Alamat -->
                <div class="col-span-1 md:col-span-2">
                    <label class="block text-xs font-bold uppercase text-gray-500 mb-2 tracking-wide">Alamat Lengkap</label>
                    <textarea name="alamat" rows="2" required
                        class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-[#1a237e] focus:ring-2 focus:ring-blue-100 bg-gray-50 focus:bg-white outline-none transition-all font-medium text-gray-700 placeholder-gray-300 resize-none"
                        placeholder="Jalan, Nomor Rumah, Kota...">{{ old('alamat') }}</textarea>
                    @error('alamat') <p class="text-red-500 text-[10px] mt-1 font-bold italic">{{ $message }}</p> @enderror
                </div>

                <!-- Password -->
                <div class="col-span-1">
                    <label class="block text-xs font-bold uppercase text-gray-500 mb-2 tracking-wide">Password</label>
                    <div class="relative">
                        <input type="password" name="password" id="password" required
                            class="w-full pr-12 px-4 py-3 rounded-xl border border-gray-200 focus:border-[#1a237e] focus:ring-2 focus:ring-blue-100 bg-gray-50 focus:bg-white outline-none transition-all font-medium text-gray-700"
                            placeholder="••••••••">
                        <button type="button" class="password-toggle absolute right-4 top-1/2 -translate-y-1/2 text-gray-400 hover:text-[#1a237e] transition">
                            <i class="bi bi-eye"></i>
                        </button>
                    </div>
                    @error('password') <p class="text-red-500 text-[10px] mt-1 font-bold italic">{{ $message }}</p> @enderror
                </div>

                <!-- Konfirmasi -->
                <div class="col-span-1">
                    <label class="block text-xs font-bold uppercase text-gray-500 mb-2 tracking-wide">Konfirmasi Password</label>
                    <div class="relative">
                        <input type="password" name="password_confirmation" id="password_confirmation" required
                            class="w-full pr-12 px-4 py-3 rounded-xl border border-gray-200 focus:border-[#1a237e] focus:ring-2 focus:ring-blue-100 bg-gray-50 focus:bg-white outline-none transition-all font-medium text-gray-700"
                            placeholder="••••••••">
                        <button type="button" class="password-toggle absolute right-4 top-1/2 -translate-y-1/2 text-gray-400 hover:text-[#1a237e] transition">
                            <i class="bi bi-eye"></i>
                        </button>
                    </div>
                </div>

                <div class="col-span-1 md:col-span-2 mt-4">
                    <button type="submit" 
                        class="w-full bg-[#1a237e] hover:bg-[#0d1440] text-white font-black py-4 rounded-xl shadow-lg hover:shadow-xl transform transition hover:-translate-y-0.5 active:translate-y-0 text-lg tracking-wide uppercase flex items-center justify-center gap-3">
                        <span>Daftar Sekarang</span>
                        <i class="bi bi-arrow-right-circle-fill"></i>
                    </button>
                    <p class="text-center text-sm mt-6 text-gray-500">
                        Sudah punya akun? <a href="{{ route('login') }}" class="text-[#1a237e] font-bold hover:underline">Masuk disini</a>
                    </p>
                </div>
            </form>

            <!-- Home Button -->
            <a href="{{ url('/') }}" class="absolute top-6 right-6 text-gray-300 hover:text-[#1a237e] transition">
                <i class="bi bi-arrow-left text-2xl"></i>
            </a>
        </div>

    </div>

    <script>
        document.addEventListener('click', function (e) {
            if (e.target.closest('.password-toggle')) {
                const button = e.target.closest('.password-toggle');
                const container = button.closest('.relative');
                const input = container.querySelector('input');
                const icon = button.querySelector('i');

                if (input.type === 'password') {
                    input.type = 'text';
                    icon.classList.remove('bi-eye');
                    icon.classList.add('bi-eye-slash');
                } else {
                    input.type = 'password';
                    icon.classList.remove('bi-eye-slash');
                    icon.classList.add('bi-eye');
                }
            }
        });
    </script>
</body>
</html>