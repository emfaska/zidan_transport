@extends('layouts.driver')

@section('title', 'Profil Driver - Zidan Transport')

@section('content')
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

    <main class="px-6 -mt-6 relative z-10 space-y-6 animate-up">
        @if(session('success'))
            <div class="bg-green-500 text-white p-4 rounded-2xl shadow-lg border border-green-400 flex items-center gap-3">
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
                            <img src="{{ Auth::user()->foto_profil ? asset('storage/' . Auth::user()->foto_profil) : 'https://ui-avatars.com/api/?name='.urlencode(Auth::user()->name).'&background=1a237e&color=fff&size=128&bold=true' }}" 
                                 id="preview-img"
                                 class="w-full h-full object-cover">
                        </div>
                        <label for="foto_profil" class="absolute -bottom-1 -right-1 w-8 h-8 bg-[#fbc02d] text-[#1a237e] rounded-xl flex items-center justify-center cursor-pointer shadow-lg active:scale-95 transition">
                            <i class="bi bi-camera-fill"></i>
                        </label>
                        <input type="file" name="foto_profil" id="foto_profil" class="hidden">
                    </div>
                </div>

                <div class="space-y-4">
                    <div class="space-y-1">
                        <label class="text-[10px] font-black uppercase tracking-widest text-gray-400 ml-1">Nama Driver</label>
                        <div class="relative">
                            <i class="bi bi-person absolute left-4 top-1/2 -translate-y-1/2 text-gray-400"></i>
                            <input type="text" name="name" value="{{ old('name', Auth::user()->name) }}" class="w-full bg-gray-50 border-none rounded-2xl pl-11 pr-5 py-4 focus:ring-2 focus:ring-[#1a237e] transition font-bold text-[#1a237e]" required>
                        </div>
                    </div>
                    <div class="space-y-1">
                        <label class="text-[10px] font-black uppercase tracking-widest text-gray-400 ml-1">Email</label>
                        <div class="relative">
                            <i class="bi bi-envelope absolute left-4 top-1/2 -translate-y-1/2 text-gray-400"></i>
                            <input type="email" name="email" value="{{ old('email', Auth::user()->email) }}" class="w-full bg-gray-50 border-none rounded-2xl pl-11 pr-5 py-4 focus:ring-2 focus:ring-[#1a237e] transition font-bold text-[#1a237e]" required>
                        </div>
                    </div>
                    <div class="space-y-1">
                        <label class="text-[10px] font-black uppercase tracking-widest text-gray-400 ml-1">WhatsApp</label>
                        <div class="relative">
                            <i class="bi bi-whatsapp absolute left-4 top-1/2 -translate-y-1/2 text-gray-400"></i>
                            <input type="text" name="no_hp" value="{{ old('no_hp', Auth::user()->no_hp) }}" class="w-full bg-gray-50 border-none rounded-2xl pl-11 pr-5 py-4 focus:ring-2 focus:ring-[#1a237e] transition font-bold text-[#1a237e]">
                        </div>
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
                </div>

                <div class="space-y-1 text-left">
                    <div class="relative">
                        <input type="password" name="password" placeholder="Password Baru" class="w-full bg-gray-50 border-none rounded-2xl pl-5 pr-12 py-4 focus:ring-2 focus:ring-red-500 transition font-bold" required>
                        <button type="button" class="password-toggle absolute right-4 top-1/2 -translate-y-1/2 text-gray-400 hover:text-red-500 transition">
                            <i class="bi bi-eye"></i>
                        </button>
                    </div>
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

        // Photo Preview
        const photoInput = document.getElementById('foto_profil');
        if (photoInput) {
            photoInput.onchange = function() {
                const preview = document.querySelector('#preview-img');
                const file = this.files[0];
                const reader = new FileReader();
                reader.onload = (e) => preview.src = e.target.result;
                if (file) reader.readAsDataURL(file);
            };
        }
    });
</script>
@endpush
