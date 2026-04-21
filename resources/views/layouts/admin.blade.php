<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('images/favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('images/favicon-16x16.png') }}">
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('images/apple-touch-icon.png') }}">
    <title>@yield('title', 'Admin Dashboard') - Zidan Transport</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <!-- Hotwire Turbo -->
    <script src="https://cdn.jsdelivr.net/npm/@hotwired/turbo@8.0.4/dist/turbo.es2017-umd.min.js"></script>
</head>
<body class="bg-gray-50 font-sans text-gray-800 antialiased overflow-hidden">
    <style>
        .scrollbar-hide::-webkit-scrollbar { display: none; }
        .scrollbar-hide { -ms-overflow-style: none; scrollbar-width: none; }
        .scrollbar-thin::-webkit-scrollbar { width: 6px; height: 6px; }
        .scrollbar-thin::-webkit-scrollbar-track { background: transparent; }
        .scrollbar-thin::-webkit-scrollbar-thumb { background-color: #e5e7eb; border-radius: 20px; }
        .scrollbar-thin::-webkit-scrollbar-thumb:hover { background-color: #d1d5db; }
    </style>

    <div class="flex h-screen w-full">
        <!-- Sidebar -->
        <aside class="w-[260px] bg-[#f8f9fa] border-r border-gray-200 flex flex-col flex-shrink-0 z-40 transition-all duration-300">
            <!-- Logo area -->
            <div class="h-20 flex items-center justify-center border-b border-gray-200/60 px-6 shrink-0">
                <div class="flex items-center gap-3">
                    <img src="{{ asset('images/logo.png') }}" class="h-9 w-auto filter grayscale opacity-90 drop-shadow-sm">
                    <div class="flex flex-col">
                        <h1 class="text-[1.1rem] font-black text-gray-900 leading-none uppercase tracking-tight">Zidan</h1>
                        <span class="text-[0.6rem] font-bold text-gray-500 uppercase tracking-widest mt-0.5">Transport</span>
                    </div>
                </div>
            </div>
            
            <!-- Menu Items -->
            <nav class="flex-1 overflow-y-auto py-6 space-y-0.5 scrollbar-hide">
                <a href="{{ route('admin.dashboard') }}" class="group flex items-center space-x-4 py-3.5 px-6 transition-colors {{ Request::is('admin/dashboard') ? 'bg-[#0a0a0a] text-white shadow-md' : 'text-[#6c757d] hover:bg-gray-200/60 hover:text-gray-900' }}">
                    <i class="bi bi-grid-fill text-[1.1rem] {{ Request::is('admin/dashboard') ? 'text-white' : 'text-[#a1a1aa] group-hover:text-gray-600' }}"></i>
                    <span class="text-[11px] font-bold uppercase tracking-wider">Dashboard</span>
                </a>
                @if(Auth::user()->role === 'admin')
                    <a href="{{ route('admin.armada.index') }}" class="group flex items-center space-x-4 py-3.5 px-6 transition-colors {{ Request::is('admin/armada*') ? 'bg-[#0a0a0a] text-white shadow-md' : 'text-[#6c757d] hover:bg-gray-200/60 hover:text-gray-900' }}">
                        <i class="bi bi-car-front-fill text-[1.1rem] {{ Request::is('admin/armada*') ? 'text-white' : 'text-[#a1a1aa] group-hover:text-gray-600' }}"></i>
                        <span class="text-[11px] font-bold uppercase tracking-wider">Data Armada</span>
                    </a>
                    
                    <a href="{{ route('admin.layanan.index') }}" class="group flex items-center space-x-4 py-3.5 px-6 transition-colors {{ Request::is('admin/layanan*') ? 'bg-[#0a0a0a] text-white shadow-md' : 'text-[#6c757d] hover:bg-gray-200/60 hover:text-gray-900' }}">
                        <i class="bi bi-layers-fill text-[1.1rem] {{ Request::is('admin/layanan*') ? 'text-white' : 'text-[#a1a1aa] group-hover:text-gray-600' }}"></i>
                        <span class="text-[11px] font-bold uppercase tracking-wider">Jenis Layanan</span>
                    </a>
                    
                    <a href="{{ route('admin.rute.index') }}" class="group flex items-center space-x-4 py-3.5 px-6 transition-colors {{ Request::is('admin/rute*') ? 'bg-[#0a0a0a] text-white shadow-md' : 'text-[#6c757d] hover:bg-gray-200/60 hover:text-gray-900' }}">
                        <i class="bi bi-bezier2 text-[1.1rem] {{ Request::is('admin/rute*') ? 'text-white' : 'text-[#a1a1aa] group-hover:text-gray-600' }}"></i>
                        <span class="text-[11px] font-bold uppercase tracking-wider">Paket Rute</span>
                    </a>
                    
                    <a href="{{ route('admin.pelanggan.index') }}" class="group flex items-center space-x-4 py-3.5 px-6 transition-colors {{ Request::is('admin/pelanggan*') ? 'bg-[#0a0a0a] text-white shadow-md' : 'text-[#6c757d] hover:bg-gray-200/60 hover:text-gray-900' }}">
                        <i class="bi bi-people-fill text-[1.1rem] {{ Request::is('admin/pelanggan*') ? 'text-white' : 'text-[#a1a1aa] group-hover:text-gray-600' }}"></i>
                        <span class="text-[11px] font-bold uppercase tracking-wider">Data Pelanggan</span>
                    </a>
                    
                    <a href="{{ route('admin.pengemudi.index') }}" class="group flex items-center space-x-4 py-3.5 px-6 transition-colors {{ Request::is('admin/pengemudi*') ? 'bg-[#0a0a0a] text-white shadow-md' : 'text-[#6c757d] hover:bg-gray-200/60 hover:text-gray-900' }}">
                        <i class="bi bi-person-badge-fill text-[1.1rem] {{ Request::is('admin/pengemudi*') ? 'text-white' : 'text-[#a1a1aa] group-hover:text-gray-600' }}"></i>
                        <span class="text-[11px] font-bold uppercase tracking-wider">Data Pengemudi</span>
                    </a>
                    
                    <a href="{{ route('admin.booking.index') }}" class="group flex items-center space-x-4 py-3.5 px-6 transition-colors {{ Request::is('admin/booking*') ? 'bg-[#0a0a0a] text-white shadow-md' : 'text-[#6c757d] hover:bg-gray-200/60 hover:text-gray-900' }}">
                        <i class="bi bi-journal-text text-[1.1rem] {{ Request::is('admin/booking*') ? 'text-white' : 'text-[#a1a1aa] group-hover:text-gray-600' }}"></i>
                        <span class="text-[11px] font-bold uppercase tracking-wider">Manajemen Booking</span>
                        @php $pendingExt = \App\Models\BookingExtension::where('status','pending')->count(); @endphp
                        @if($pendingExt > 0)
                            <span class="ml-auto text-[9px] font-black bg-gray-200 text-gray-800 px-1.5 py-0.5 rounded-sm">{{ $pendingExt }}</span>
                        @endif
                    </a>
                    
                    <a href="{{ route('admin.refund.index') }}" class="group flex items-center space-x-4 py-3.5 px-6 transition-colors {{ Request::is('admin/refunds*') ? 'bg-[#0a0a0a] text-white shadow-md' : 'text-[#6c757d] hover:bg-gray-200/60 hover:text-gray-900' }}">
                        <i class="bi bi-cash-stack text-[1.1rem] {{ Request::is('admin/refunds*') ? 'text-white' : 'text-[#a1a1aa] group-hover:text-gray-600' }}"></i>
                        <span class="text-[11px] font-bold uppercase tracking-wider">Manajemen Refund</span>
                        @php $pendingRefund = \App\Models\RefundRequest::where('status','pending')->count(); @endphp
                        @if($pendingRefund > 0)
                            <span class="ml-auto text-[9px] font-black bg-red-500 text-white px-1.5 py-0.5 rounded-sm">{{ $pendingRefund }}</span>
                        @endif
                    </a>
                    
                    <a href="{{ route('admin.promo.index') }}" class="group flex items-center space-x-4 py-3.5 px-6 transition-colors {{ Request::is('admin/promo*') ? 'bg-[#0a0a0a] text-white shadow-md' : 'text-[#6c757d] hover:bg-gray-200/60 hover:text-gray-900' }}">
                        <i class="bi bi-tags-fill text-[1.1rem] {{ Request::is('admin/promo*') ? 'text-white' : 'text-[#a1a1aa] group-hover:text-gray-600' }}"></i>
                        <span class="text-[11px] font-bold uppercase tracking-wider">Kelola Promo</span>
                    </a>
                    
                    <a href="{{ route('admin.wallet.index') }}" class="group flex items-center space-x-4 py-3.5 px-6 transition-colors {{ Request::is('admin/wallet*') ? 'bg-[#0a0a0a] text-white shadow-md' : 'text-[#6c757d] hover:bg-gray-200/60 hover:text-gray-900' }}">
                        <i class="bi bi-wallet-fill text-[1.1rem] {{ Request::is('admin/wallet*') ? 'text-white' : 'text-[#a1a1aa] group-hover:text-gray-600' }}"></i>
                        <span class="text-[11px] font-bold uppercase tracking-wider">Dompet Driver</span>
                        @php $pendingWd = \App\Models\WithdrawalRequest::where('status','pending')->count(); @endphp
                        @if($pendingWd > 0)
                            <span class="ml-auto text-[9px] font-black bg-red-500 text-white px-1.5 py-0.5 rounded-sm">{{ $pendingWd }}</span>
                        @endif
                    </a>
                    
                    <a href="{{ route('admin.setting.index') }}" class="group flex items-center space-x-4 py-3.5 px-6 transition-colors {{ Request::is('admin/settings*') ? 'bg-[#0a0a0a] text-white shadow-md' : 'text-[#6c757d] hover:bg-gray-200/60 hover:text-gray-900' }}">
                        <i class="bi bi-diagram-3-fill text-[1.1rem] {{ Request::is('admin/settings*') ? 'text-white' : 'text-[#a1a1aa] group-hover:text-gray-600' }}"></i>
                        <span class="text-[11px] font-bold uppercase tracking-wider">Pengaturan Pusat</span>
                    </a>

                    <a href="{{ route('admin.report.index') }}" class="group flex items-center space-x-4 py-3.5 px-6 transition-colors {{ Request::is('admin/reports*') ? 'bg-[#0a0a0a] text-white shadow-md' : 'text-[#6c757d] hover:bg-gray-200/60 hover:text-gray-900' }}">
                        <i class="bi bi-bar-chart-fill text-[1.1rem] {{ Request::is('admin/reports*') ? 'text-white' : 'text-[#a1a1aa] group-hover:text-gray-600' }}"></i>
                        <span class="text-[11px] font-bold uppercase tracking-wider">Laporan Bisnis</span>
                    </a>

                    <a href="{{ route('admin.management.index') }}" class="group flex items-center space-x-4 py-3.5 px-6 transition-colors {{ Request::is('admin/management*') ? 'bg-[#0a0a0a] text-white shadow-md' : 'text-[#6c757d] hover:bg-gray-200/60 hover:text-gray-900' }}">
                        <i class="bi bi-shield-lock-fill text-[1.1rem] {{ Request::is('admin/management*') ? 'text-white' : 'text-[#a1a1aa] group-hover:text-gray-600' }}"></i>
                        <span class="text-[11px] font-bold uppercase tracking-wider">Manajemen Admin</span>
                    </a>
                @elseif(Auth::user()->role === 'pelanggan')
                    <!-- Menu Pelanggan -->
                    <a href="{{ route('pelanggan.booking.create') }}" class="group flex items-center space-x-4 py-3.5 px-6 transition-colors {{ Request::is('booking/create') ? 'bg-[#0a0a0a] text-white shadow-md' : 'text-[#6c757d] hover:bg-gray-200/60 hover:text-gray-900' }}">
                        <i class="bi bi-plus-circle-fill text-[1.1rem] {{ Request::is('booking/create') ? 'text-white' : 'text-[#a1a1aa] group-hover:text-gray-600' }}"></i>
                        <span class="text-[11px] font-bold uppercase tracking-wider">Pesan Sekarang</span>
                    </a>

                    <a href="{{ route('pelanggan.booking.index') }}" class="group flex items-center space-x-4 py-3.5 px-6 transition-colors {{ Request::is('booking') ? 'bg-[#0a0a0a] text-white shadow-md' : 'text-[#6c757d] hover:bg-gray-200/60 hover:text-gray-900' }}">
                        <i class="bi bi-clock-history text-[1.1rem] {{ Request::is('booking') ? 'text-white' : 'text-[#a1a1aa] group-hover:text-gray-600' }}"></i>
                        <span class="text-[11px] font-bold uppercase tracking-wider">Riwayat Pesanan</span>
                    </a>

                    <a href="{{ route('pelanggan.armada') }}" class="group flex items-center space-x-4 py-3.5 px-6 transition-colors {{ Request::is('armada*') ? 'bg-[#0a0a0a] text-white shadow-md' : 'text-[#6c757d] hover:bg-gray-200/60 hover:text-gray-900' }}">
                        <i class="bi bi-truck-front-fill text-[1.1rem] {{ Request::is('armada*') ? 'text-white' : 'text-[#a1a1aa] group-hover:text-gray-600' }}"></i>
                        <span class="text-[11px] font-bold uppercase tracking-wider">Daftar Armada</span>
                    </a>

                    <a href="{{ route('pelanggan.kontak') }}" class="group flex items-center space-x-4 py-3.5 px-6 transition-colors {{ Request::is('kontak*') ? 'bg-[#0a0a0a] text-white shadow-md' : 'text-[#6c757d] hover:bg-gray-200/60 hover:text-gray-900' }}">
                        <i class="bi bi-headset text-[1.1rem] {{ Request::is('kontak*') ? 'text-white' : 'text-[#a1a1aa] group-hover:text-gray-600' }}"></i>
                        <span class="text-[11px] font-bold uppercase tracking-wider">Hubungi CS</span>
                    </a>
                @endif
            </nav>

            <!-- Bottom Section -->
            <div class="border-t border-gray-200/60 p-4 space-y-1 bg-[#f8f9fa] shrink-0 mt-auto">
                <a href="{{ route('profile.edit') }}" class="group flex items-center space-x-4 py-3 px-2 transition-colors {{ Request::is('profile*') ? 'bg-[#0a0a0a] text-white shadow-md rounded-lg' : 'text-[#6c757d] hover:bg-gray-200/60 hover:text-gray-900 rounded-lg' }}">
                    <i class="bi bi-person-gear text-[1.2rem] pl-2 {{ Request::is('profile*') ? 'text-white' : 'text-[#a1a1aa] group-hover:text-gray-600' }}"></i>
                    <span class="text-[11px] font-bold uppercase tracking-wider">Pengaturan Profil</span>
                </a>
                
                <form action="{{ route('logout') }}" method="POST" class="m-0 group">
                    @csrf
                    <button type="submit" class="flex items-center space-x-4 w-full py-3 px-2 rounded-lg transition-colors text-[#d32f2f] hover:bg-red-50/80 group-hover:text-red-700">
                        <i class="bi bi-box-arrow-right text-[1.2rem] pl-2"></i>
                        <span class="text-[11px] font-bold uppercase tracking-wider">Keluar Sistem</span>
                    </button>
                </form>
            </div>
        </aside>

        <!-- Main Content Wrapper -->
        <div class="flex-1 flex flex-col min-w-0 bg-[#f4f6f9] overflow-hidden">
            <header class="bg-white shadow-[0_4px_24px_rgba(0,0,0,0.02)] h-20 px-8 flex justify-between items-center border-b border-gray-200/60 shrink-0 z-30">
                <div class="flex items-center gap-4">
                    <div class="w-1.5 h-6 bg-[#0a0a0a] rounded-[1px]"></div>
                    <div>
                        <h2 class="text-lg font-black text-gray-900 tracking-tight leading-none">@yield('header_title', 'Dashboard')</h2>
                        <p class="text-[10px] text-gray-500 font-bold uppercase tracking-widest mt-1">Panel Administrator</p>
                    </div>
                </div>
                <div class="flex items-center space-x-6">
                    <div class="text-right hidden sm:block">
                        <p class="text-[9px] font-bold text-gray-400 uppercase tracking-widest leading-none mb-1">Status Login</p>
                        <p class="text-[13px] font-black text-gray-900 tracking-tight">{{ Auth::user()->name }}</p>
                    </div>
                    <div class="relative">
                        <div class="w-10 h-10 rounded-full bg-gray-200 overflow-hidden shadow-sm border border-gray-200">
                            <img src="{{ Auth::user()->foto_profil ? asset('storage/' . Auth::user()->foto_profil) : 'https://ui-avatars.com/api/?name='.urlencode(Auth::user()->name).'&background=000&color=fff&bold=true' }}" 
                                 class="w-full h-full object-cover">
                        </div>
                        <div class="absolute bottom-0 right-0 w-3 h-3 bg-green-500 border-2 border-white rounded-full"></div>
                    </div>
                </div>
            </header>

            <main class="flex-1 overflow-y-auto w-full p-6 lg:p-10 scrollbar-thin">
                @if(session('success'))
                    <div class="mb-8 p-4 bg-green-50 border-1 border-green-200 text-green-700 rounded-xl shadow-sm flex items-center gap-4 ring-1 ring-green-500/20">
                        <div class="w-10 h-10 rounded-full bg-green-100 flex items-center justify-center text-green-600 shrink-0">
                            <i class="bi bi-check2-circle text-xl"></i>
                        </div>
                        <div>
                            <p class="font-black text-[10px] uppercase tracking-widest leading-none mb-1 text-green-600">Berhasil</p>
                            <p class="font-bold text-sm">{{ session('success') }}</p>
                        </div>
                    </div>
                @endif

                @if(session('wa_success'))
                    <div class="mb-8 p-4 bg-blue-50 border-1 border-blue-200 text-blue-700 rounded-xl shadow-sm flex items-center gap-4 ring-1 ring-blue-500/20">
                        <div class="w-10 h-10 rounded-full bg-blue-100 flex items-center justify-center text-blue-600 shrink-0">
                            <i class="bi bi-whatsapp text-xl"></i>
                        </div>
                        <div>
                            <p class="font-black text-[10px] uppercase tracking-widest leading-none mb-1 text-blue-600">WhatsApp Terkirim</p>
                            <p class="font-bold text-sm">{{ session('wa_success') }}</p>
                        </div>
                    </div>
                @endif

                @if(session('error'))
                    <div class="mb-6 p-4 bg-red-50 border-1 border-red-200 text-red-700 rounded-xl shadow-sm flex items-center gap-4 ring-1 ring-red-500/20">
                        <div class="w-10 h-10 rounded-full bg-red-100 flex items-center justify-center text-red-600 shrink-0">
                            <i class="bi bi-exclamation-triangle-fill text-xl"></i>
                        </div>
                        <div>
                            <p class="font-black text-[10px] uppercase tracking-widest leading-none mb-1 text-red-600">Terjadi Kesalahan</p>
                            <p class="font-bold text-sm">{{ session('error') }}</p>
                        </div>
                    </div>
                @endif

                @yield('content')
            </main>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        // Global Currency Masking Logic
        function formatRupiah(number) {
            return new Intl.NumberFormat('id-ID').format(number);
        }

        function cleanNumber(value) {
            return value.replace(/\./g, '').replace(/,/g, '');
        }

        document.addEventListener('turbo:load', function() {
            // Re-bind listeners if necessary or initialize one-time components
        });

        document.addEventListener('input', function(e) {
            if (e.target.classList.contains('mask-currency')) {
                let cursorPosition = e.target.selectionStart;
                let originalLength = e.target.value.length;
                
                let value = e.target.value.replace(/\D/g, '');
                if (value === '') {
                    e.target.value = '';
                    return;
                }
                
                e.target.value = formatRupiah(value);
                
                // Maintain cursor position
                let newLength = e.target.value.length;
                e.target.setSelectionRange(cursorPosition + (newLength - originalLength), cursorPosition + (newLength - originalLength));
            }
        });

        // Ensure clean numbers are sent to the server
        document.addEventListener('submit', function(e) {
            const maskedInputs = e.target.querySelectorAll('.mask-currency');
            maskedInputs.forEach(input => {
                // We don't want to change the visual value right before submit if possible
                // but Laravel validation will fail if it's sent as "1.000.000"
                // So we'll append a hidden field with cleaned value or just clean the input
                // Cleaning the input is safest for simple forms
                input.value = cleanNumber(input.value);
            });
        });

        // Global Password Visibility Toggle
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

        // SweetAlert2 for Delete Confirmation
        function confirmDelete(id, title = 'Apakah Anda yakin?', text = "Data yang dihapus tidak dapat dikembalikan!") {
            Swal.fire({
                title: title,
                text: text,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Ya, Hapus!',
                cancelButtonText: 'Batal',
                background: '#fff',
                customClass: {
                    title: 'text-xl font-black text-[#1a237e]',
                    htmlContainer: 'text-sm font-medium text-gray-500',
                    popup: 'rounded-[32px] p-8',
                    confirmButton: 'rounded-xl font-bold px-8 py-3 text-xs uppercase tracking-widest',
                    cancelButton: 'rounded-xl font-bold px-8 py-3 text-xs uppercase tracking-widest'
                }
            }).then((result) => {
                if (result.isConfirmed) {
                    const form = document.getElementById('delete-form-' + id);
                    if (form) {
                        form.submit();
                    } else {
                        console.error('Delete form not found: delete-form-' + id);
                    }
                }
            })
        }

        // SweetAlert2 for General Confirmation (e.g., Approve)
        function confirmAction(id, actionUrl, title = 'Konfirmasi Tindakan', text = 'Apakah Anda yakin ingin melanjutkan?', icon = 'question', confirmText = 'Ya, Lanjutkan') {
             Swal.fire({
                title: title,
                text: text,
                icon: icon,
                showCancelButton: true,
                confirmButtonColor: '#1a237e',
                cancelButtonColor: '#64748b',
                confirmButtonText: confirmText,
                cancelButtonText: 'Batal',
                background: '#fff',
                customClass: {
                    title: 'text-xl font-black text-[#1a237e]',
                    htmlContainer: 'text-sm font-medium text-gray-500',
                    popup: 'rounded-[32px] p-8',
                    confirmButton: 'rounded-xl font-bold px-8 py-3 text-xs uppercase tracking-widest',
                    cancelButton: 'rounded-xl font-bold px-8 py-3 text-xs uppercase tracking-widest'
                }
            }).then((result) => {
                if (result.isConfirmed) {
                    let form = document.createElement('form');
                    form.method = 'POST';
                    form.action = actionUrl;
                    
                    let csrfToken = document.createElement('input');
                    csrfToken.type = 'hidden';
                    csrfToken.name = '_token';
                    csrfToken.value = '{{ csrf_token() }}';
                    form.appendChild(csrfToken);

                    let methodField = document.createElement('input');
                    methodField.type = 'hidden';
                    methodField.name = '_method';
                    methodField.value = 'PATCH'; 
                    form.appendChild(methodField);

                    document.body.appendChild(form);
                    form.submit();
                }
            })
        }

        // Global Confirmation Handler for Forms/Buttons
        document.addEventListener('submit', function(e) {
            const form = e.target;
            if (form.hasAttribute('data-confirm')) {
                e.preventDefault();
                const message = form.getAttribute('data-confirm');
                const title = form.getAttribute('data-title') || 'Konfirmasi';
                const type = form.getAttribute('data-type') || 'question';
                const confirmText = form.getAttribute('data-btn-text') || 'Ya, Lanjutkan';
                const confirmColor = form.getAttribute('data-btn-color') || '#1a237e';

                Swal.fire({
                    title: title,
                    text: message,
                    icon: type,
                    showCancelButton: true,
                    confirmButtonColor: confirmColor,
                    cancelButtonColor: '#64748b',
                    confirmButtonText: confirmText,
                    cancelButtonText: 'Batal',
                    background: '#fff',
                    customClass: {
                        title: 'text-xl font-black text-[#1a237e]',
                        htmlContainer: 'text-sm font-medium text-gray-500',
                        popup: 'rounded-[32px] p-8',
                        confirmButton: 'rounded-xl font-bold px-8 py-3 text-xs uppercase tracking-widest',
                        cancelButton: 'rounded-xl font-bold px-8 py-3 text-xs uppercase tracking-widest'
                    }
                }).then((result) => {
                    if (result.isConfirmed) {
                        // Temporarily disable the data-confirm to allow actual submission
                        form.removeAttribute('data-confirm');
                        form.submit();
                    }
                });
            }
        });

        // Clean up SweetAlert before Turbo caches the page to prevent "ghost" popups on back navigation
        document.addEventListener('turbo:before-cache', function() {
            if (typeof Swal !== 'undefined') {
                Swal.close();
            }
        });
    </script>
    @stack('scripts')
</body>
</html>
