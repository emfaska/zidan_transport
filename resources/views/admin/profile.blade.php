@extends('layouts.admin')

@section('title', 'Pengaturan Profil')

@section('header_title', 'Pengaturan Profil')

@section('content')
<div class="max-w-4xl mx-auto">
    <!-- Page Header -->
    <div class="mb-8">
        <h1 class="text-2xl font-black text-[#1a237e] uppercase tracking-tight">Profil Administrator</h1>
        <p class="text-gray-500 text-sm">Kelola informasi akun dan keamanan panel admin Anda.</p>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Left: Profile Form -->
        <div class="lg:col-span-2 space-y-6">
            <div class="bg-white rounded-3xl shadow-sm border border-gray-100 overflow-hidden relative">
                <div class="absolute top-0 left-0 w-full h-1 bg-[#fbc02d]"></div>
                
                <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data" class="p-8 space-y-8">
                    @csrf
                    @method('patch')

                    <!-- Avatar Section -->
                    <div class="flex items-center gap-6 pb-6 border-b border-gray-50">
                        <div class="relative group">
                            <div class="w-24 h-24 rounded-2xl overflow-hidden border-4 border-gray-50 shadow-sm group-hover:border-blue-100 transition-all">
                                <img src="{{ $user->foto_profil ? asset('storage/' . $user->foto_profil) : 'https://ui-avatars.com/api/?name='.urlencode($user->name).'&background=1a237e&color=fff&bold=true' }}" 
                                     id="preview-img"
                                     class="w-full h-full object-cover">
                            </div>
                            <label for="foto_profil" class="absolute -bottom-2 -right-2 w-8 h-8 bg-[#fbc02d] text-[#1a237e] rounded-lg flex items-center justify-center cursor-pointer shadow-lg hover:scale-110 transition-transform">
                                <i class="bi bi-camera-fill text-sm"></i>
                            </label>
                            <input type="file" name="foto_profil" id="foto_profil" class="hidden" onchange="previewFile()">
                        </div>
                        <div>
                            <h3 class="font-black text-[#1a237e] uppercase text-sm tracking-wide">{{ $user->name }}</h3>
                            <p class="text-xs text-gray-400 font-bold mb-2">{{ $user->email }}</p>
                            <span class="px-2 py-1 bg-blue-50 text-blue-600 text-[10px] font-black uppercase rounded-md border border-blue-100">Administrator</span>
                        </div>
                    </div>

                    <!-- Inputs -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="space-y-2">
                            <label class="text-[10px] font-black uppercase tracking-widest text-gray-400 ml-1">Nama Lengkap</label>
                            <input type="text" name="name" value="{{ old('name', $user->name) }}" class="w-full px-5 py-3 bg-gray-50 border border-gray-100 rounded-xl focus:bg-white focus:border-[#1a237e] focus:ring-4 focus:ring-blue-50 transition-all outline-none font-bold text-[#1a237e]" required>
                        </div>
                        <div class="space-y-2">
                            <label class="text-[10px] font-black uppercase tracking-widest text-gray-400 ml-1">Email Panel</label>
                            <input type="email" name="email" value="{{ old('email', $user->email) }}" class="w-full px-5 py-3 bg-gray-50 border border-gray-100 rounded-xl focus:bg-white focus:border-[#1a237e] focus:ring-4 focus:ring-blue-50 transition-all outline-none font-bold text-[#1a237e]" required>
                        </div>
                        <div class="space-y-2 md:col-span-2">
                            <label class="text-[10px] font-black uppercase tracking-widest text-gray-400 ml-1">Nomor Kontak</label>
                            <input type="text" name="no_hp" value="{{ old('no_hp', $user->no_hp) }}" class="w-full px-5 py-3 bg-gray-50 border border-gray-100 rounded-xl focus:bg-white focus:border-[#1a237e] focus:ring-4 focus:ring-blue-50 transition-all outline-none font-bold text-[#1a237e]" placeholder="08xxxx">
                        </div>
                    </div>

                    <div class="space-y-2">
                        <label class="text-[10px] font-black uppercase tracking-widest text-gray-400 ml-1">Alamat</label>
                        <textarea name="alamat" rows="3" class="w-full px-5 py-3 bg-gray-50 border border-gray-100 rounded-xl focus:bg-white focus:border-[#1a237e] focus:ring-4 focus:ring-blue-50 transition-all outline-none font-bold text-[#1a237e]">{{ old('alamat', $user->alamat) }}</textarea>
                    </div>

                    <div class="flex justify-end pt-4">
                        <button type="submit" class="px-8 py-3 bg-[#1a237e] text-white rounded-xl font-black text-xs uppercase tracking-widest shadow-lg shadow-blue-900/20 hover:bg-[#0d1440] transition-all flex items-center gap-3">
                            SIMPAN PROFIL <i class="bi bi-check2-circle text-lg"></i>
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Right: Password Section -->
        <div class="space-y-6">
            <div class="bg-white rounded-3xl shadow-sm border border-gray-100 overflow-hidden relative">
                <div class="absolute top-0 left-0 w-full h-1 bg-red-500"></div>
                <div class="p-6">
                    <div class="flex items-center gap-3 mb-6">
                        <div class="w-10 h-10 bg-red-50 text-red-500 rounded-xl flex items-center justify-center border border-red-100">
                            <i class="bi bi-shield-lock-fill text-lg"></i>
                        </div>
                        <h3 class="font-black text-[#1a237e] uppercase tracking-wide text-xs">Ubah Password</h3>
                    </div>

                    <form action="{{ route('profile.password.update') }}" method="POST" class="space-y-4">
                        @csrf
                        @method('put')

                        <div class="space-y-1">
                            <label class="text-[9px] font-black uppercase tracking-widest text-gray-400 ml-1">Password Lama</label>
                            <div class="relative">
                                <input type="password" name="current_password" class="w-full pl-4 pr-12 py-2.5 bg-gray-50 border border-gray-100 rounded-lg focus:ring-2 focus:ring-red-100 transition font-bold text-sm text-[#1a237e]" required>
                                <button type="button" class="password-toggle absolute right-3 top-1/2 -translate-y-1/2 text-gray-400 hover:text-red-500 transition">
                                    <i class="bi bi-eye"></i>
                                </button>
                            </div>
                        </div>

                        <div class="space-y-1">
                            <label class="text-[9px] font-black uppercase tracking-widest text-gray-400 ml-1">Password Baru</label>
                            <div class="relative">
                                <input type="password" name="password" class="w-full pl-4 pr-12 py-2.5 bg-gray-50 border border-gray-100 rounded-lg focus:ring-2 focus:ring-red-100 transition font-bold text-sm text-[#1a237e]" required>
                                <button type="button" class="password-toggle absolute right-3 top-1/2 -translate-y-1/2 text-gray-400 hover:text-red-500 transition">
                                    <i class="bi bi-eye"></i>
                                </button>
                            </div>
                        </div>

                        <div class="space-y-1">
                            <label class="text-[9px] font-black uppercase tracking-widest text-gray-400 ml-1">Konfirmasi</label>
                            <div class="relative">
                                <input type="password" name="password_confirmation" class="w-full pl-4 pr-12 py-2.5 bg-gray-50 border border-gray-100 rounded-lg focus:ring-2 focus:ring-red-100 transition font-bold text-sm text-[#1a237e]" required>
                                <button type="button" class="password-toggle absolute right-3 top-1/2 -translate-y-1/2 text-gray-400 hover:text-red-500 transition">
                                    <i class="bi bi-eye"></i>
                                </button>
                            </div>
                        </div>

                        <button type="submit" class="w-full mt-4 bg-red-50 text-red-600 hover:bg-red-600 hover:text-white py-3 rounded-xl font-black uppercase tracking-widest text-[10px] transition-all flex items-center justify-center gap-2">
                             Update Password <i class="bi bi-key-fill"></i>
                        </button>
                    </form>
                </div>
            </div>

            <div class="bg-[#1a237e] rounded-3xl p-6 text-white shadow-lg relative overflow-hidden">
                <i class="bi bi-info-circle absolute -right-4 -bottom-4 text-6xl opacity-10"></i>
                <h4 class="font-black text-[10px] mb-2 uppercase tracking-[0.2em]">Penting</h4>
                <p class="text-[11px] text-blue-100 leading-relaxed font-medium">Gunakan kombinasi password yang kuat untuk menjaga keamanan akses panel administrator Anda.</p>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    function previewFile() {
        const preview = document.querySelector('#preview-img');
        const file = document.querySelector('#foto_profil').files[0];
        const reader = new FileReader();

        reader.addEventListener("load", function () {
            preview.src = reader.result;
        }, false);

        if (file) {
            reader.readAsDataURL(file);
        }
    }
</script>
@endpush
@endsection
