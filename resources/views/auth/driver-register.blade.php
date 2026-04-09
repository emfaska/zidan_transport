<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Mitra Pengemudi - Zidan Transport</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <style>
        body { font-family: 'Montserrat', sans-serif; }
        .step-inactive { opacity: 0.5; filter: grayscale(1); pointer-events: none; }
        .glass-card { background: rgba(255, 255, 255, 0.9); backdrop-blur: 10px; border: 1px solid rgba(255, 255, 255, 0.2); }
    </style>
</head>
<body class="bg-[#1a237e] min-h-screen flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8 relative overflow-y-auto">
    
    <!-- Decorative Elements -->
    <div class="absolute top-0 left-0 w-full h-full opacity-10 pointer-events-none">
        <i class="bi bi-truck absolute -left-20 -top-20 text-[400px] text-white rotate-12"></i>
        <i class="bi bi-geo-alt-fill absolute -right-20 -bottom-20 text-[300px] text-white -rotate-12"></i>
    </div>

    <div class="max-w-4xl w-full space-y-8 relative z-10">
        <div class="text-center">
            <a href="{{ route('home') }}" class="inline-block mb-6">
                <div class="bg-white/90 backdrop-blur-sm p-4 rounded-3xl shadow-2xl">
                    <img class="h-16 w-auto" src="{{ asset('images/logo.png') }}" alt="Zidan Transport">
                </div>
            </a>
            <h2 class="text-4xl font-black text-white tracking-tight uppercase">Pendaftaran Mitra <span class="text-[#fbc02d]">Driver</span></h2>
            <p class="mt-2 text-blue-200 font-medium">Bergabunglah bersama keluarga besar Zidan Transport.</p>
        </div>

        @if ($errors->any())
        <div class="bg-red-500/10 border-2 border-red-500/20 backdrop-blur-md rounded-[30px] p-6 text-white mb-8">
            <div class="flex items-center gap-4">
                <div class="w-10 h-10 bg-red-500 rounded-2xl flex items-center justify-center text-xl">
                    <i class="bi bi-exclamation-triangle-fill"></i>
                </div>
                <div>
                    <h4 class="font-black uppercase tracking-tight text-red-500">Ada Kesalahan Input!</h4>
                    <p class="text-xs text-red-300 font-medium">Silakan periksa kembali data yang Anda masukkan di bawah ini.</p>
                </div>
            </div>
            <ul class="mt-4 space-y-1 text-[11px] text-red-200 list-disc list-inside opacity-80">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <form action="{{ route('driver.register.submit') }}" method="POST" enctype="multipart/form-data" class="mt-8">
            @csrf
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                
                <!-- Section 1: Data Pribadi -->
                <div class="glass-card rounded-[40px] p-8 shadow-2xl">
                    <div class="flex items-center gap-4 mb-8">
                        <div class="w-12 h-12 bg-[#1a237e] text-white rounded-2xl flex items-center justify-center text-xl font-black shadow-lg">1</div>
                        <div>
                            <h3 class="text-xl font-black text-[#1a237e] leading-none mb-1 uppercase tracking-tight">Data Pribadi</h3>
                            <p class="text-[10px] text-gray-500 font-bold uppercase tracking-widest">Identitas Utama & Domisili</p>
                        </div>
                    </div>

                    <div class="space-y-5">
                        <div class="space-y-1">
                            <label class="text-[10px] font-black uppercase tracking-widest text-[#1a237e] ml-1">Nama Lengkap (Sesuai KTP)</label>
                            <div class="relative">
                                <i class="bi bi-person absolute left-4 top-1/2 -translate-y-1/2 text-gray-400"></i>
                                <input type="text" name="name" value="{{ old('name') }}" class="w-full bg-white border-2 {{ $errors->has('name') ? 'border-red-400' : 'border-gray-100' }} rounded-2xl pl-12 pr-5 py-4 focus:ring-4 focus:ring-blue-100 focus:border-[#1a237e] transition font-bold" placeholder="Contoh: Budi Santoso" required>
                                @error('name') <p class="text-[10px] text-red-500 mt-1 font-bold italic ml-1">{{ $message }}</p> @enderror
                            </div>
                        </div>

                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <div class="space-y-1">
                                <label class="text-[10px] font-black uppercase tracking-widest text-[#1a237e] ml-1">Email</label>
                                <input type="email" name="email" value="{{ old('email') }}" class="w-full bg-white border-2 {{ $errors->has('email') ? 'border-red-400' : 'border-gray-100' }} rounded-2xl px-5 py-4 focus:ring-4 focus:ring-blue-100 focus:border-[#1a237e] transition font-bold" placeholder="nama@email.com" required>
                                @error('email') <p class="text-[10px] text-red-500 mt-1 font-bold italic ml-1">{{ $message }}</p> @enderror
                            </div>
                            <div class="space-y-1">
                                <label class="text-[10px] font-black uppercase tracking-widest text-[#1a237e] ml-1">Nomor WhatsApp</label>
                                <input type="text" name="no_hp" value="{{ old('no_hp') }}" class="w-full bg-white border-2 {{ $errors->has('no_hp') ? 'border-red-400' : 'border-gray-100' }} rounded-2xl px-5 py-4 focus:ring-4 focus:ring-blue-100 focus:border-[#1a237e] transition font-bold" placeholder="08xxxxxxxx" required>
                                @error('no_hp') <p class="text-[10px] text-red-500 mt-1 font-bold italic ml-1">{{ $message }}</p> @enderror
                            </div>
                        </div>

                        <div class="space-y-1">
                            <label class="text-[10px] font-black uppercase tracking-widest text-[#1a237e] ml-1">Alamat Domisili</label>
                            <textarea name="alamat_domisili" rows="2" class="w-full bg-white border-2 {{ $errors->has('alamat_domisili') ? 'border-red-400' : 'border-gray-100' }} rounded-2xl px-5 py-4 focus:ring-4 focus:ring-blue-100 focus:border-[#1a237e] transition font-bold" placeholder="Alamat tinggal saat ini..." required>{{ old('alamat_domisili') }}</textarea>
                            @error('alamat_domisili') <p class="text-[10px] text-red-500 mt-1 font-bold italic ml-1">{{ $message }}</p> @enderror
                        </div>

                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <div class="space-y-1">
                                <label class="text-[10px] font-black uppercase tracking-widest text-[#1a237e] ml-1">Password</label>
                                <div class="relative">
                                    <input type="password" name="password" id="password" class="w-full bg-white border-2 {{ $errors->has('password') ? 'border-red-400' : 'border-gray-100' }} rounded-2xl px-5 py-4 focus:ring-4 focus:ring-blue-100 focus:border-[#1a237e] transition font-bold" required>
                                    <button type="button" class="password-toggle absolute right-4 top-1/2 -translate-y-1/2 text-gray-400 hover:text-[#1a237e] transition">
                                        <i class="bi bi-eye"></i>
                                    </button>
                                </div>
                                @error('password') <p class="text-[10px] text-red-500 mt-1 font-bold italic ml-1">{{ $message }}</p> @enderror
                            </div>
                            <div class="space-y-1">
                                <label class="text-[10px] font-black uppercase tracking-widest text-[#1a237e] ml-1">Konfirmasi</label>
                                <div class="relative">
                                    <input type="password" name="password_confirmation" id="password_confirmation" class="w-full bg-white border-2 border-gray-100 rounded-2xl px-5 py-4 focus:ring-4 focus:ring-blue-100 focus:border-[#1a237e] transition font-bold" required>
                                    <button type="button" class="password-toggle absolute right-4 top-1/2 -translate-y-1/2 text-gray-400 hover:text-[#1a237e] transition">
                                        <i class="bi bi-eye"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Section 2: Dokumen Legalitas -->
                <div class="glass-card rounded-[40px] p-8 shadow-2xl">
                    <div class="flex items-center gap-4 mb-8">
                        <div class="w-12 h-12 bg-[#fbc02d] text-[#1a237e] rounded-2xl flex items-center justify-center text-xl font-black shadow-lg">2</div>
                        <div>
                            <h3 class="text-xl font-black text-[#1a237e] leading-none mb-1 uppercase tracking-tight">Dokumen Legalitas</h3>
                            <p class="text-[10px] text-gray-500 font-bold uppercase tracking-widest">Verifikasi Keaslian Dokumen</p>
                        </div>
                    </div>

                    <div class="space-y-6">
                        <div class="space-y-1">
                            <label class="text-[10px] font-black uppercase tracking-widest text-[#1a237e] ml-1">Nomor SIM</label>
                            <input type="text" name="nomor_sim" value="{{ old('nomor_sim') }}" class="w-full bg-white border-2 {{ $errors->has('nomor_sim') ? 'border-red-400' : 'border-gray-100' }} rounded-2xl px-5 py-4 focus:ring-4 focus:ring-blue-100 focus:border-[#1a237e] transition font-bold" placeholder="Contoh: 1234-5678-91011" required>
                            @error('nomor_sim') <p class="text-[10px] text-red-500 mt-1 font-bold italic ml-1">{{ $message }}</p> @enderror
                        </div>

                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                            <div class="space-y-2">
                                <label class="text-[10px] font-black uppercase tracking-widest text-[#1a237e] ml-1">Foto KTP (Asli)</label>
                                <div class="relative group h-40">
                                    <div class="absolute inset-0 border-2 border-dashed border-gray-200 rounded-2xl flex flex-col items-center justify-center bg-gray-50 group-hover:bg-blue-50 transition overflow-hidden">
                                        <i class="bi bi-person-vcard text-3xl text-gray-300 mb-2"></i>
                                        <p class="text-[10px] font-bold text-gray-400">Klik untuk upload</p>
                                        <img id="ktp-preview" class="absolute inset-0 w-full h-full object-cover hidden">
                                    </div>
                                    <input type="file" name="foto_ktp" class="absolute inset-0 opacity-0 cursor-pointer" onchange="preview(this, 'ktp-preview')" required>
                                    @error('foto_ktp') <p class="text-[10px] text-red-500 mt-1 font-bold italic ml-1">{{ $message }}</p> @enderror
                                </div>
                            </div>

                            <div class="space-y-2">
                                <label class="text-[10px] font-black uppercase tracking-widest text-[#1a237e] ml-1">Foto SIM (Asli)</label>
                                <div class="relative group h-40">
                                    <div class="absolute inset-0 border-2 border-dashed border-gray-200 rounded-2xl flex flex-col items-center justify-center bg-gray-50 group-hover:bg-blue-50 transition overflow-hidden">
                                        <i class="bi bi-card-checklist text-3xl text-gray-300 mb-2"></i>
                                        <p class="text-[10px] font-bold text-gray-400">Klik untuk upload</p>
                                        <img id="sim-preview" class="absolute inset-0 w-full h-full object-cover hidden">
                                    </div>
                                    <input type="file" name="foto_sim" class="absolute inset-0 opacity-0 cursor-pointer" onchange="preview(this, 'sim-preview')" required>
                                    @error('foto_sim') <p class="text-[10px] text-red-500 mt-1 font-bold italic ml-1">{{ $message }}</p> @enderror
                                </div>
                            </div>
                        </div>

                        <div class="bg-blue-50 p-4 rounded-2xl border border-blue-100">
                            <div class="flex gap-3">
                                <i class="bi bi-info-circle-fill text-[#1a237e]"></i>
                                <p class="text-[11px] text-[#1a237e] font-medium leading-relaxed">
                                    Pastikan foto dokumen terlihat jelas, tidak buram, dan tidak terpotong. Dokumen ini diperlukan untuk proses verifikasi keamanan perusahaan.
                                </p>
                            </div>
                        </div>

                        <button type="submit" class="w-full bg-[#1a237e] hover:bg-[#0d1440] text-white font-black py-5 rounded-2xl shadow-2xl transition transform hover:-translate-y-1 active:scale-95 uppercase tracking-widest">
                            Kirim Pendaftaran Mitra
                        </button>
                    </div>
                </div>
            </div>
        </form>

        <div class="text-center">
            <p class="text-blue-100 text-sm font-medium">Sudah punya akun driver? <a href="{{ route('login') }}" class="text-[#fbc02d] font-black hover:underline">Masuk di sini</a></p>
        </div>
    </div>

    <script>
        function preview(input, id) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    document.getElementById(id).src = e.target.result;
                    document.getElementById(id).classList.remove('hidden');
                }
                reader.readAsDataURL(input.files[0]);
            }
        }

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
    </script>
</body>
</html>
