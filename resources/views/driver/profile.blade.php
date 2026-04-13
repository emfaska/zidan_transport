@extends('layouts.driver')

@section('title', 'Profil Pengemudi - Zidan Driver')

@section('content')
    <!-- Header Area -->
    <div class="bg-[#1a237e] pt-12 pb-16 px-6 rounded-b-[48px] shadow-lg sticky top-0 z-50 overflow-hidden">
        <div class="absolute -top-10 -left-10 w-40 h-40 bg-white/5 rounded-full blur-2xl"></div>
        <div class="relative z-10 flex items-center justify-between">
            <a href="{{ route('driver.dashboard') }}" class="w-10 h-10 flex items-center justify-center bg-white/10 rounded-2xl text-white">
                <i class="bi bi-chevron-left text-xl"></i>
            </a>
            <h1 class="text-xs font-[900] text-white uppercase tracking-[0.3em]">Profil Driver</h1>
            <div class="w-10 h-10 flex items-center justify-center bg-white/10 rounded-2xl text-white">
                <i class="bi bi-gear"></i>
            </div>
        </div>
    </div>

    <main class="px-6 -mt-8 relative z-10 pb-32 space-y-8 animate-up">
        <!-- Success Notification -->
        @if(session('success'))
            <div class="bg-green-100 border border-green-200 text-green-800 p-5 rounded-[24px] shadow-lg flex items-center gap-3">
                <i class="bi bi-check-circle-fill text-xl"></i>
                <p class="text-[11px] font-[900] uppercase tracking-tight">{{ session('success') }}</p>
            </div>
        @endif

        <!-- Identity & Photo Card -->
        <div class="bg-white rounded-[40px] p-8 shadow-xl border border-gray-50">
            <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data" class="space-y-8">
                @csrf
                @method('patch')

                <!-- Photo Upload Professional UI -->
                <div class="flex flex-col items-center">
                    <div class="relative group">
                        <div class="w-32 h-32 rounded-[40px] overflow-hidden border-8 border-gray-50 shadow-inner group-hover:border-[#1a237e]/10 transition-colors">
                            <img src="{{ Auth::user()->foto_profil ? asset('storage/' . Auth::user()->foto_profil) : 'https://ui-avatars.com/api/?name='.urlencode(Auth::user()->name).'&background=1a237e&color=fff&size=200&bold=true' }}" 
                                 id="preview-img"
                                 class="w-full h-full object-cover transition duration-500 group-hover:scale-110">
                        </div>
                        <label for="foto_profil" class="absolute -bottom-2 -right-2 w-12 h-12 bg-[#fbc02d] text-[#1a237e] rounded-[18px] flex items-center justify-center cursor-pointer shadow-xl hover:bg-white transition active:scale-90 border-4 border-white">
                            <i class="bi bi-camera-fill text-xl"></i>
                        </label>
                        <input type="file" name="foto_profil" id="foto_profil" class="hidden">
                    </div>
                    <p class="text-[10px] font-black text-gray-400 uppercase tracking-widest mt-6">Ketuk Kamera Untuk Ubah Foto</p>
                </div>

                <!-- Personal Info Inputs -->
                <div class="space-y-5">
                    <div class="space-y-2">
                        <label class="text-[9px] font-black uppercase tracking-widest text-[#1a237e]/40 ml-1">Nama Lengkap</label>
                        <div class="relative">
                            <i class="bi bi-person absolute left-5 top-1/2 -translate-y-1/2 text-gray-400"></i>
                            <input type="text" name="name" value="{{ old('name', Auth::user()->name) }}" class="w-full bg-gray-50 border border-gray-100 rounded-[22px] pl-12 pr-6 py-4.5 focus:bg-white focus:border-[#1a237e] transition outline-none font-black text-sm text-[#1a237e]" required>
                        </div>
                    </div>
                    <div class="space-y-2">
                        <label class="text-[9px] font-black uppercase tracking-widest text-[#1a237e]/40 ml-1">Alamat Email</label>
                        <div class="relative">
                            <i class="bi bi-envelope absolute left-5 top-1/2 -translate-y-1/2 text-gray-400"></i>
                            <input type="email" name="email" value="{{ old('email', Auth::user()->email) }}" class="w-full bg-gray-50 border border-gray-100 rounded-[22px] pl-12 pr-6 py-4.5 focus:bg-white focus:border-[#1a237e] transition outline-none font-black text-sm text-[#1a237e]" required>
                        </div>
                    </div>
                    <div class="space-y-2">
                        <label class="text-[9px] font-black uppercase tracking-widest text-[#1a237e]/40 ml-1">No. WhatsApp Driver</label>
                        <div class="relative">
                            <i class="bi bi-whatsapp absolute left-5 top-1/2 -translate-y-1/2 text-gray-400"></i>
                            <input type="text" name="no_hp" value="{{ old('no_hp', Auth::user()->no_hp) }}" class="w-full bg-gray-50 border border-gray-100 rounded-[22px] pl-12 pr-6 py-4.5 focus:bg-white focus:border-[#1a237e] transition outline-none font-black text-sm text-[#1a237e]">
                        </div>
                    </div>
                </div>

                <button type="submit" class="w-full bg-[#1a237e] text-white font-[950] py-5 rounded-[22px] shadow-2xl shadow-blue-900/40 hover:bg-[#0a0f30] transition transform active:scale-95 uppercase tracking-[0.2em] text-[11px]">
                    Update Identitas Profil
                </button>
            </form>
        </div>

        <!-- Security & Password Card -->
        <div class="bg-gray-50 rounded-[40px] p-8 border-2 border-dashed border-gray-200">
            <div class="flex items-center gap-4 mb-8">
                <div class="w-12 h-12 bg-red-50 text-red-600 rounded-[18px] flex items-center justify-center shadow-sm">
                    <i class="bi bi-shield-lock text-xl"></i>
                </div>
                <div>
                    <h3 class="font-black text-[#1a237e] uppercase tracking-widest text-xs">Keamanan Akun</h3>
                    <p class="text-[9px] font-bold text-gray-400 uppercase mt-0.5 tracking-tighter">Ubah Password Secara Berkala</p>
                </div>
            </div>

            <form action="{{ route('profile.password.update') }}" method="POST" class="space-y-4">
                @csrf
                @method('put')

                <div class="relative">
                    <input type="password" name="current_password" placeholder="Password Saat Ini" class="w-full bg-white border border-gray-100 rounded-[20px] px-6 py-4.5 focus:border-red-500 transition outline-none font-black text-sm" required>
                    <button type="button" class="password-toggle absolute right-5 top-1/2 -translate-y-1/2 text-gray-300">
                        <i class="bi bi-eye"></i>
                    </button>
                </div>

                <div class="relative">
                    <input type="password" name="password" placeholder="Password Baru" class="w-full bg-white border border-gray-100 rounded-[20px] px-6 py-4.5 focus:border-red-500 transition outline-none font-black text-sm" required>
                    <button type="button" class="password-toggle absolute right-5 top-1/2 -translate-y-1/2 text-gray-300">
                        <i class="bi bi-eye"></i>
                    </button>
                </div>

                <div class="relative">
                    <input type="password" name="password_confirmation" placeholder="Ulangi Password Baru" class="w-full bg-white border border-gray-100 rounded-[20px] px-6 py-4.5 focus:border-red-500 transition outline-none font-black text-sm" required>
                    <button type="button" class="password-toggle absolute right-5 top-1/2 -translate-y-1/2 text-gray-300">
                        <i class="bi bi-eye"></i>
                    </button>
                </div>

                <button type="submit" class="w-full bg-red-50 text-red-600 hover:bg-red-600 hover:text-white py-5 rounded-[20px] font-black transition active:scale-95 uppercase tracking-widest text-[10px]">
                    Update Kata Sandi <i class="bi bi-key ml-2"></i>
                </button>
            </form>
        </div>
    </main>
@endsection

@push('scripts')
<script>
    document.addEventListener('turbo:load', () => {
        // Password Visibility Toggle
        document.querySelectorAll('.password-toggle').forEach(btn => {
            btn.onclick = function() {
                const container = this.closest('.relative');
                const input = container.querySelector('input');
                const icon = this.querySelector('i');

                if (input.type === 'password') {
                    input.type = 'text';
                    icon.classList.remove('bi-eye');
                    icon.classList.add('bi-eye-slash');
                } else {
                    input.type = 'password';
                    icon.classList.remove('bi-eye-slash');
                    icon.classList.add('bi-eye');
                }
            };
        });

        // Photo Preview Logic
        const photoInput = document.getElementById('foto_profil');
        if (photoInput) {
            photoInput.onchange = function() {
                const preview = document.querySelector('#preview-img');
                const file = this.files[0];
                const reader = new FileReader();
                reader.onload = (e) => {
                    preview.src = e.target.result;
                    preview.classList.add('scale-110');
                    setTimeout(() => preview.classList.remove('scale-110'), 500);
                };
                if (file) reader.readAsDataURL(file);
            };
        }
    });
</script>
@endpush
