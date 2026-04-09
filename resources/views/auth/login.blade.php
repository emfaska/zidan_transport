<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Zidan Transport</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <style> body { font-family: 'Montserrat', sans-serif; } </style>
</head>
<body class="bg-white min-h-screen flex items-center justify-center p-4">

    <div class="w-full max-w-5xl bg-white rounded-3xl shadow-2xl overflow-hidden flex min-h-[600px] border border-gray-100">
        
        <!-- Left Side - Branding (BLUE) -->
        <div class="hidden md:flex md:w-1/2 bg-[#1a237e] text-white flex-col justify-center items-center p-12 relative overflow-hidden">
            <!-- Background Pattern -->
            <div class="absolute inset-0 opacity-10">
                <svg class="h-full w-full" viewBox="0 0 100 100" preserveAspectRatio="none">
                    <path d="M0 100 C 20 0 50 0 100 100 Z" fill="white" />
                    <path d="M0 0 C 50 100 80 100 100 0 Z" fill="white" opacity="0.1" />
                </svg>
            </div>
            
            <div class="relative z-10 text-center">
                <div class="inline-block bg-white rounded-full p-6 mb-6 shadow-xl">
                    <img src="{{ asset('images/logo.png') }}" alt="Zidan Transport" class="w-28 h-auto">
                </div>
                <div class="flex flex-col items-center mb-10">
                    <h1 class="text-4xl font-black text-white leading-none uppercase tracking-tighter">Zidan</h1>
                    <h1 class="text-lg font-bold text-[#fbc02d] uppercase tracking-[0.35em] leading-none mt-1">Transport</h1>
                </div>
                <h2 class="text-3xl font-black mb-4 leading-tight">Menuju Destinasi,<br>Bersama Armada Terbaik</h2>
                <p class="text-blue-200 text-lg mb-2 leading-relaxed max-w-md mx-auto">Layanan carter dan antar-jemput berkualitas premium dengan armada modern dan nyaman</p>
                <div class="flex gap-2 justify-center mt-8">
                    <div class="w-3 h-3 rounded-full bg-[#fbc02d]"></div>
                    <div class="w-3 h-3 rounded-full bg-blue-400"></div>
                    <div class="w-3 h-3 rounded-full bg-blue-400"></div>
                </div>
            </div>
        </div>

        <!-- Right Side - Login Form (WHITE) -->
        <div class="w-full md:w-1/2 p-8 md:p-12 flex flex-col justify-center relative">
            
            <div class="mb-10">
                <div class="md:hidden mb-6 flex justify-center">
                    <img src="{{ asset('images/logo.png') }}" alt="Zidan Transport" class="h-12 w-auto">
                </div>
                <h3 class="text-3xl font-black text-[#1a237e] mb-2">Login Akun</h3>
                <p class="text-gray-500 font-medium">Selamat datang! Silakan masukkan email dan password.</p>
            </div>

            @if (session('success'))
                <div class="mb-6 bg-green-50 border-l-4 border-green-500 p-4 rounded-r-lg">
                    <div class="flex items-center">
                        <i class="bi bi-check-circle-fill text-green-500 text-xl mr-3"></i>
                        <div>
                            <p class="text-sm text-green-700 font-bold">Berhasil</p>
                            <p class="text-xs text-green-600">{{ session('success') }}</p>
                        </div>
                    </div>
                </div>
            @endif

            @if ($errors->any())
                <div class="mb-6 bg-red-50 border-l-4 border-red-500 p-4 rounded-r-lg">
                    <div class="flex items-center">
                        <i class="bi bi-exclamation-circle-fill text-red-500 text-xl mr-3"></i>
                        <div>
                            <p class="text-sm text-red-700 font-bold">Kesalahan</p>
                            <p class="text-xs text-red-600">{{ $errors->first() }}</p>
                        </div>
                    </div>
                </div>
            @endif

            <form action="{{ route('login') }}" method="POST" class="space-y-6">
                @csrf
                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-2 ml-1">Email</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                            <i class="bi bi-envelope text-gray-400"></i>
                        </div>
                        <input type="email" name="email" required
                            class="w-full pl-11 pr-4 py-4 rounded-xl border border-gray-200 focus:border-[#1a237e] focus:ring-2 focus:ring-blue-100 bg-gray-50 focus:bg-white outline-none transition-all font-medium text-gray-700 placeholder-gray-300"
                            placeholder="nama@email.com">
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-2 ml-1">Password</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                            <i class="bi bi-lock text-gray-400"></i>
                        </div>
                        <input type="password" name="password" id="password" required
                            class="w-full pl-11 pr-12 py-4 rounded-xl border border-gray-200 focus:border-[#1a237e] focus:ring-2 focus:ring-blue-100 bg-gray-50 focus:bg-white outline-none transition-all font-medium text-gray-700 placeholder-gray-300"
                            placeholder="••••••••">
                        <button type="button" class="password-toggle absolute right-4 top-1/2 -translate-y-1/2 text-gray-400 hover:text-[#1a237e] transition">
                            <i class="bi bi-eye"></i>
                        </button>
                    </div>
                </div>

                <button type="submit" 
                    class="w-full bg-[#1a237e] hover:bg-[#0d1440] text-white font-black py-4 rounded-xl shadow-lg hover:shadow-xl transform transition hover:-translate-y-0.5 active:translate-y-0 text-lg tracking-wide flex items-center justify-center gap-3">
                    <span>MASUK SEKARANG</span>
                    <i class="bi bi-arrow-right"></i>
                </button>
            </form>

            <div class="mt-10 pt-6 border-t border-gray-100 text-center">
                <p class="text-gray-500 font-medium">Belum memiliki akun?</p>
                <a href="{{ route('register') }}" class="inline-block mt-2 text-[#1a237e] font-black hover:text-[#fbc02d] transition-colors">
                    Daftar Akun Baru
                </a>
            </div>

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