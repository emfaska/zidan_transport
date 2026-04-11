<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('images/favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('images/favicon-16x16.png') }}">
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('images/apple-touch-icon.png') }}">
    <title>Profil - Zidan Transport</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <style>
        body { font-family: 'Montserrat', sans-serif; -webkit-tap-highlight-color: transparent; }
    </style>
</head>
<body class="bg-gray-50 pb-24">

    <!-- Header -->
    <div class="bg-[#1a237e] pt-12 pb-8 px-6 rounded-b-[32px] shadow-lg sticky top-0 z-50">
        <div class="flex items-center justify-between mb-4">
            <a href="{{ route('driver.dashboard') }}" class="w-10 h-10 flex items-center justify-center bg-white/10 rounded-xl text-white">
                <i class="bi bi-chevron-left text-xl"></i>
            </a>
            <h1 class="text-lg font-black text-white uppercase tracking-widest">Profil Anda</h1>
            <div class="w-10"></div>
        </div>
    </div>

    <main class="px-6 -mt-6 relative z-10 space-y-6">
        @if(session('success'))
            <div class="bg-green-500 text-white p-4 rounded-2xl shadow-lg border border-green-400 flex items-center gap-3 animate-bounce">
                <i class="bi bi-check-circle-fill text-xl"></i>
                <p class="text-[11px] font-bold">{{ session('success') }}</p>
            </div>
        @endif

        <!-- Profile Info Card -->
        <div class="bg-white rounded-[32px] p-6 shadow-xl border border-gray-100">
            <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                @csrf
                @method('patch')

                <div class="flex flex-col items-center pb-6 border-b border-gray-50">
                    <div class="relative group">
                        <div class="w-24 h-24 rounded-3xl overflow-hidden border-4 border-blue-50 shadow-inner">
                            <img src="{{ $user->foto_profil ? asset('storage/' . $user->foto_profil) : 'https://ui-avatars.com/api/?name='.urlencode($user->name).'&background=1a237e&color=fff&size=128&bold=true' }}" 
                                 id="preview-img"
                                 class="w-full h-full object-cover">
                        </div>
                        <label for="foto_profil" class="absolute -bottom-1 -right-1 w-8 h-8 bg-[#fbc02d] text-[#1a237e] rounded-xl flex items-center justify-center cursor-pointer shadow-lg active:scale-95 transition">
                            <i class="bi bi-camera-fill"></i>
                        </label>
                        <input type="file" name="foto_profil" id="foto_profil" class="hidden" onchange="previewFile()">
                    </div>
                </div>

                <div class="space-y-4">
                    <div class="space-y-1">
                        <label class="text-[10px] font-black uppercase tracking-widest text-gray-400 ml-1">Nama Driver</label>
                        <div class="relative">
                            <i class="bi bi-person absolute left-4 top-1/2 -translate-y-1/2 text-gray-400"></i>
                            <input type="text" name="name" value="{{ old('name', $user->name) }}" class="w-full bg-gray-50 border-none rounded-2xl pl-11 pr-5 py-4 focus:ring-2 focus:ring-[#1a237e] transition font-bold text-[#1a237e]" required>
                        </div>
                        @error('name') <p class="text-red-500 text-[10px] font-bold mt-1 ml-1">{{ $message }}</p> @enderror
                    </div>
                    <div class="space-y-1">
                        <label class="text-[10px] font-black uppercase tracking-widest text-gray-400 ml-1">Email</label>
                        <div class="relative">
                            <i class="bi bi-envelope absolute left-4 top-1/2 -translate-y-1/2 text-gray-400"></i>
                            <input type="email" name="email" value="{{ old('email', $user->email) }}" class="w-full bg-gray-50 border-none rounded-2xl pl-11 pr-5 py-4 focus:ring-2 focus:ring-[#1a237e] transition font-bold text-[#1a237e]" required>
                        </div>
                        @error('email') <p class="text-red-500 text-[10px] font-bold mt-1 ml-1">{{ $message }}</p> @enderror
                    </div>
                    <div class="space-y-1">
                        <label class="text-[10px] font-black uppercase tracking-widest text-gray-400 ml-1">WhatsApp</label>
                        <div class="relative">
                            <i class="bi bi-whatsapp absolute left-4 top-1/2 -translate-y-1/2 text-gray-400"></i>
                            <input type="text" name="no_hp" value="{{ old('no_hp', $user->no_hp) }}" class="w-full bg-gray-50 border-none rounded-2xl pl-11 pr-5 py-4 focus:ring-2 focus:ring-[#1a237e] transition font-bold text-[#1a237e]">
                        </div>
                        @error('no_hp') <p class="text-red-500 text-[10px] font-bold mt-1 ml-1">{{ $message }}</p> @enderror
                    </div>
                </div>

                <button type="submit" class="w-full bg-[#1a237e] hover:bg-[#0d1440] text-white font-black py-4 rounded-2xl shadow-xl transition active:scale-95">
                    SIMPAN PERUBAHAN
                </button>
            </form>
        </div>

        <!-- Security Card -->
        <div class="bg-white rounded-[32px] p-6 shadow-xl border border-gray-100">
            <div class="flex items-center gap-3 mb-6">
                <div class="w-10 h-10 bg-red-50 text-red-600 rounded-xl flex items-center justify-center">
                    <i class="bi bi-shield-lock-fill text-xl"></i>
                </div>
                <h3 class="font-black text-[#1a237e] uppercase tracking-widest text-xs pr-4">Ganti Password</h3>
            </div>

            <form action="{{ route('profile.password.update') }}" method="POST" class="space-y-4">
                @csrf
                @method('put')

                <div class="space-y-1 text-left">
                    <div class="relative">
                        <input type="password" name="current_password" placeholder="Password Sekarang" class="w-full bg-gray-50 border-none rounded-2xl pl-5 pr-12 py-4 focus:ring-2 focus:ring-red-500 transition font-bold" required>
                        <button type="button" class="password-toggle absolute right-4 top-1/2 -translate-y-1/2 text-gray-400 hover:text-red-500 transition">
                            <i class="bi bi-eye"></i>
                        </button>
                    </div>
                    @error('current_password') <p class="text-red-500 text-[10px] font-bold mt-1 ml-1">{{ $message }}</p> @enderror
                </div>

                <div class="space-y-1 text-left">
                    <div class="relative">
                        <input type="password" name="password" placeholder="Password Baru" class="w-full bg-gray-50 border-none rounded-2xl pl-5 pr-12 py-4 focus:ring-2 focus:ring-red-500 transition font-bold" required>
                        <button type="button" class="password-toggle absolute right-4 top-1/2 -translate-y-1/2 text-gray-400 hover:text-red-500 transition">
                            <i class="bi bi-eye"></i>
                        </button>
                    </div>
                    @error('password') <p class="text-red-500 text-[10px] font-bold mt-1 ml-1">{{ $message }}</p> @enderror
                </div>

                <div class="space-y-1 text-left">
                    <div class="relative">
                        <input type="password" name="password_confirmation" placeholder="Ulangi Password Baru" class="w-full bg-gray-50 border-none rounded-2xl pl-5 pr-12 py-4 focus:ring-2 focus:ring-red-500 transition font-bold" required>
                        <button type="button" class="password-toggle absolute right-4 top-1/2 -translate-y-1/2 text-gray-400 hover:text-red-500 transition">
                            <i class="bi bi-eye"></i>
                        </button>
                    </div>
                </div>

                <button type="submit" class="w-full bg-red-50 text-red-600 hover:bg-red-600 hover:text-white py-4 rounded-2xl font-black transition active:scale-95">
                    UPDATE KEAMANAN
                </button>
            </form>
        </div>
    </main>

    <div class="fixed bottom-6 left-6 right-6 z-50">
        <div class="bg-[#1a237e]/90 backdrop-blur-xl rounded-[24px] p-3 shadow-2xl border border-white/10 flex justify-between items-center">
            <a href="{{ route('driver.dashboard') }}" class="flex-1 flex flex-col items-center justify-center py-2 transition {{ Request::is('driver/dashboard') ? 'bg-white/10 rounded-2xl text-[#fbc02d]' : 'text-gray-400' }}">
                <i class="bi bi-grid-fill text-xl"></i>
                <span class="text-[9px] font-black mt-1 uppercase tracking-tighter">Beranda</span>
            </a>
            <a href="{{ route('driver.history') }}" class="flex-1 flex flex-col items-center justify-center py-2 transition {{ Request::is('driver/history') ? 'bg-white/10 rounded-2xl text-[#fbc02d]' : 'text-gray-400' }}">
                <i class="bi bi-journal-check text-xl"></i>
                <span class="text-[9px] font-black mt-1 uppercase tracking-tighter">Riwayat</span>
            </a>
            <a href="{{ route('driver.wallet') }}" class="flex-1 flex flex-col items-center justify-center py-2 transition {{ Request::is('driver/wallet') ? 'bg-white/10 rounded-2xl text-[#fbc02d]' : 'text-gray-400' }}">
                <i class="bi bi-wallet2 text-xl"></i>
                <span class="text-[9px] font-black mt-1 uppercase tracking-tighter">Dompet</span>
            </a>
            <a href="{{ route('profile.edit') }}" class="flex-1 flex flex-col items-center justify-center py-2 transition {{ Request::is('profile*') ? 'bg-white/10 rounded-2xl text-[#fbc02d]' : 'text-gray-400' }}">
                <i class="bi bi-person-fill text-xl"></i>
                <span class="text-[9px] font-black mt-1 uppercase tracking-tighter">Akun</span>
            </a>
        </div>
    </div>

    <script>
        // Password Visibility Toggle
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

        function previewFile() {
            const preview = document.querySelector('#preview-img');
            const file = document.querySelector('#foto_profil').files[0];
            const reader = new FileReader();
            reader.addEventListener("load", function () { preview.src = reader.result; }, false);
            if (file) { reader.readAsDataURL(file); }
        }
    </script>
</body>
</html>
