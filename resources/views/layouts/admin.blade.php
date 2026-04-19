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
<body class="bg-gray-100">

    <div class="flex min-h-screen">
        <!-- Sidebar -->
        <div class="w-64 bg-gradient-to-b from-[#1a237e] via-[#1a237e] to-[#0d1440] text-white shadow-2xl flex-shrink-0 z-40">
            <div class="px-6 py-10 border-b border-white/10 text-center">
                <div class="flex flex-col items-center space-y-4">
                    <div class="bg-white/80 backdrop-blur-sm px-4 py-2 rounded-full shadow-xl ring-4 ring-white/5 transition-transform hover:rotate-3">
                        <img src="{{ asset('images/logo.png') }}" alt="Zidan Transport Logo" class="h-12 w-auto">
                    </div>
                    <div class="flex flex-col items-center">
                        <h1 class="text-2xl font-black text-white leading-none uppercase tracking-tighter">Zidan</h1>
                        <h1 class="text-sm font-bold text-[#fbc02d] uppercase tracking-[0.3em] leading-none mt-1">Transport</h1>
                        <p class="text-[8px] uppercase tracking-[0.2em] text-blue-300/60 font-black mt-3">
                            Carteran & Antar Jemput
                        </p>
                    </div>
                </div>
            </div>
            
            <nav class="mt-8 px-4 space-y-2 pb-20">
                <a href="{{ route('admin.dashboard') }}" class="group flex items-center space-x-3 py-3 px-4 rounded-xl transition-all duration-300 {{ Request::is('admin/dashboard') ? 'bg-gradient-to-r from-[#fbc02d] to-[#f9a825] text-[#1a237e] font-bold shadow-xl scale-[1.02]' : 'hover:bg-white/10 text-gray-400 hover:text-white' }}">
                    <i class="bi bi-speedometer2 text-lg"></i>
                    <span class="text-sm">Dashboard</span>
                </a>
                @if(Auth::user()->role === 'admin')
                    <a href="{{ route('admin.armada.index') }}" class="group flex items-center space-x-3 py-3 px-4 rounded-xl transition-all duration-300 {{ Request::is('admin/armada*') ? 'bg-gradient-to-r from-[#fbc02d] to-[#f9a825] text-[#1a237e] font-bold shadow-xl scale-[1.02]' : 'hover:bg-white/10 text-gray-400 hover:text-white' }}">
                        <i class="bi bi-truck text-lg"></i>
                        <span class="text-sm">Data Armada</span>
                    </a>
                    <a href="{{ route('admin.layanan.index') }}" class="group flex items-center space-x-3 py-3 px-4 rounded-xl transition-all duration-300 {{ Request::is('admin/layanan*') ? 'bg-gradient-to-r from-[#fbc02d] to-[#f9a825] text-[#1a237e] font-bold shadow-xl scale-[1.02]' : 'hover:bg-white/10 text-gray-400 hover:text-white' }}">
                        <i class="bi bi-layers text-lg"></i>
                        <span class="text-sm">Jenis Layanan</span>
                    </a>
                    <a href="{{ route('admin.rute.index') }}" class="group flex items-center space-x-3 py-3 px-4 rounded-xl transition-all duration-300 {{ Request::is('admin/rute*') ? 'bg-gradient-to-r from-[#fbc02d] to-[#f9a825] text-[#1a237e] font-bold shadow-xl scale-[1.02]' : 'hover:bg-white/10 text-gray-400 hover:text-white' }}">
                        <i class="bi bi-map text-lg"></i>
                        <span class="text-sm">Paket Rute</span>
                    </a>
                    <a href="{{ route('admin.pelanggan.index') }}" class="group flex items-center space-x-3 py-3 px-4 rounded-xl transition-all duration-300 {{ Request::is('admin/pelanggan*') ? 'bg-gradient-to-r from-[#fbc02d] to-[#f9a825] text-[#1a237e] font-bold shadow-xl scale-[1.02]' : 'hover:bg-white/10 text-gray-400 hover:text-white' }}">
                        <i class="bi bi-people text-lg"></i>
                        <span class="text-sm">Data Pelanggan</span>
                    </a>
                    <a href="{{ route('admin.pengemudi.index') }}" class="group flex items-center space-x-3 py-3 px-4 rounded-xl transition-all duration-300 {{ Request::is('admin/pengemudi*') ? 'bg-gradient-to-r from-[#fbc02d] to-[#f9a825] text-[#1a237e] font-bold shadow-xl scale-[1.02]' : 'hover:bg-white/10 text-gray-400 hover:text-white' }}">
                        <i class="bi bi-person-badge text-lg"></i>
                        <span class="text-sm">Data Pengemudi</span>
                    </a>
                    <a href="{{ route('admin.booking.index') }}" class="group flex items-center space-x-3 py-3 px-4 rounded-xl transition-all duration-300 {{ Request::is('admin/booking*') ? 'bg-gradient-to-r from-[#fbc02d] to-[#f9a825] text-[#1a237e] font-bold shadow-xl scale-[1.02]' : 'hover:bg-white/10 text-gray-400 hover:text-white' }}">
                        <i class="bi bi-card-checklist text-lg"></i>
                        <span class="text-sm">Manajemen Booking</span>
                        @php $pendingExt = \App\Models\BookingExtension::where('status','pending')->count(); @endphp
                        @if($pendingExt > 0)
                            <span class="ml-auto text-[10px] font-black bg-yellow-500 text-[#1a237e] px-1.5 py-0.5 rounded-full ring-2 ring-white/20">{{ $pendingExt }}</span>
                        @endif
                    </a>
                    <a href="{{ route('admin.refund.index') }}" class="group flex items-center space-x-3 py-3 px-4 rounded-xl transition-all duration-300 {{ Request::is('admin/refunds*') ? 'bg-gradient-to-r from-[#fbc02d] to-[#f9a825] text-[#1a237e] font-bold shadow-xl scale-[1.02]' : 'hover:bg-white/10 text-gray-400 hover:text-white' }}">
                        <i class="bi bi-arrow-counterclockwise text-lg"></i>
                        <span class="text-sm">Manajemen Refund</span>
                        @php $pendingRefund = \App\Models\RefundRequest::where('status','pending')->count(); @endphp
                        @if($pendingRefund > 0)
                            <span class="ml-auto text-[10px] font-black bg-red-500 text-white px-1.5 py-0.5 rounded-full">{{ $pendingRefund }}</span>
                        @endif
                    </a>
                    <a href="{{ route('admin.promo.index') }}" class="group flex items-center space-x-3 py-3 px-4 rounded-xl transition-all duration-300 {{ Request::is('admin/promo*') ? 'bg-gradient-to-r from-[#fbc02d] to-[#f9a825] text-[#1a237e] font-bold shadow-xl scale-[1.02]' : 'hover:bg-white/10 text-gray-400 hover:text-white' }}">
                        <i class="bi bi-tag text-lg"></i>
                        <span class="text-sm">Kelola Promo</span>
                    </a>
                    <a href="{{ route('admin.wallet.index') }}" class="group flex items-center space-x-3 py-3 px-4 rounded-xl transition-all duration-300 {{ Request::is('admin/wallet*') ? 'bg-gradient-to-r from-[#fbc02d] to-[#f9a825] text-[#1a237e] font-bold shadow-xl scale-[1.02]' : 'hover:bg-white/10 text-gray-400 hover:text-white' }}">
                        <i class="bi bi-wallet2 text-lg"></i>
                        <span class="text-sm">Dompet Driver</span>
                        @php $pendingWd = \App\Models\WithdrawalRequest::where('status','pending')->count(); @endphp
                        @if($pendingWd > 0)
                            <span class="ml-auto text-[10px] font-black bg-red-500 text-white px-1.5 py-0.5 rounded-full">{{ $pendingWd }}</span>
                        @endif
                    </a>
                    <a href="{{ route('admin.setting.index') }}" class="group flex items-center space-x-3 py-3 px-4 rounded-xl transition-all duration-300 {{ Request::is('admin/settings*') ? 'bg-gradient-to-r from-[#fbc02d] to-[#f9a825] text-[#1a237e] font-bold shadow-xl scale-[1.02]' : 'hover:bg-white/10 text-gray-400 hover:text-white' }}">
                        <i class="bi bi-gear text-lg"></i>
                        <span class="text-sm">Pengaturan Pusat</span>
                    </a>

                    <a href="{{ route('admin.report.index') }}" class="group flex items-center space-x-3 py-3 px-4 rounded-xl transition-all duration-300 {{ Request::is('admin/reports*') ? 'bg-gradient-to-r from-[#fbc02d] to-[#f9a825] text-[#1a237e] font-bold shadow-xl scale-[1.02]' : 'hover:bg-white/10 text-gray-400 hover:text-white' }}">
                        <i class="bi bi-bar-chart-line text-lg"></i>
                        <span class="text-sm">Laporan Bisnis</span>
                    </a>


                    <a href="{{ route('admin.management.index') }}" class="group flex items-center space-x-3 py-3 px-4 rounded-xl transition-all duration-300 {{ Request::is('admin/management*') ? 'bg-gradient-to-r from-[#fbc02d] to-[#f9a825] text-[#1a237e] font-bold shadow-xl scale-[1.02]' : 'hover:bg-white/10 text-gray-400 hover:text-white' }}">
                        <i class="bi bi-shield-lock text-lg"></i>
                        <span class="text-sm">Manajemen Admin</span>
                    </a>
                @elseif(Auth::user()->role === 'pelanggan')
                    <!-- Menu Pelanggan -->
                    <a href="{{ route('pelanggan.booking.create') }}" class="group flex items-center space-x-3 py-3 px-4 rounded-xl transition-all duration-300 {{ Request::is('booking/create') ? 'bg-gradient-to-r from-[#fbc02d] to-[#f9a825] text-[#1a237e] font-bold shadow-xl scale-[1.02]' : 'hover:bg-white/10 text-gray-400 hover:text-white' }}">
                        <i class="bi bi-plus-circle text-lg"></i>
                        <span class="text-sm">Pesan Sekarang</span>
                    </a>

                    <a href="{{ route('pelanggan.booking.index') }}" class="group flex items-center space-x-3 py-3 px-4 rounded-xl transition-all duration-300 {{ Request::is('booking') ? 'bg-gradient-to-r from-[#fbc02d] to-[#f9a825] text-[#1a237e] font-bold shadow-xl scale-[1.02]' : 'hover:bg-white/10 text-gray-400 hover:text-white' }}">
                        <i class="bi bi-clock-history text-lg"></i>
                        <span class="text-sm">Riwayat Pesanan</span>
                    </a>

                    <a href="{{ route('pelanggan.armada') }}" class="group flex items-center space-x-3 py-3 px-4 rounded-xl transition-all duration-300 {{ Request::is('armada*') ? 'bg-gradient-to-r from-[#fbc02d] to-[#f9a825] text-[#1a237e] font-bold shadow-xl scale-[1.02]' : 'hover:bg-white/10 text-gray-400 hover:text-white' }}">
                        <i class="bi bi-truck text-lg"></i>
                        <span class="text-sm">Daftar Armada</span>
                    </a>

                    <a href="{{ route('pelanggan.kontak') }}" class="group flex items-center space-x-3 py-3 px-4 rounded-xl transition-all duration-300 {{ Request::is('kontak*') ? 'bg-gradient-to-r from-[#fbc02d] to-[#f9a825] text-[#1a237e] font-bold shadow-xl scale-[1.02]' : 'hover:bg-white/10 text-gray-400 hover:text-white' }}">
                        <i class="bi bi-headset text-lg"></i>
                        <span class="text-sm">Hubungi CS</span>
                    </a>
                @endif
                <a href="{{ route('profile.edit') }}" class="group flex items-center space-x-3 py-3 px-4 rounded-xl transition-all duration-300 {{ Request::is('profile*') ? 'bg-gradient-to-r from-[#fbc02d] to-[#f9a825] text-[#1a237e] font-bold shadow-xl scale-[1.02]' : 'hover:bg-white/10 text-gray-400 hover:text-white' }}">
                    <i class="bi bi-person-gear text-lg"></i>
                    <span class="text-sm">Pengaturan Profil</span>
                </a>
                <div class="pt-10">
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="flex items-center space-x-3 w-full py-3 px-4 rounded-xl text-red-100 bg-red-500/10 hover:bg-red-500/20 transition-all duration-300 font-bold text-xs uppercase tracking-widest border border-red-500/20">
                            <i class="bi bi-box-arrow-right text-lg"></i>
                            <span>Keluar Sistem</span>
                        </button>
                    </form>
                </div>
            </nav>
        </div>

        <!-- Main Content -->
        <div class="flex-1 flex flex-col min-w-0 bg-[#f8faff]">
            <header class="bg-white/80 backdrop-blur-md shadow-sm py-4 px-8 flex justify-between items-center border-b border-gray-100 sticky top-0 z-30">
                <div class="flex items-center gap-4">
                    <div class="w-1 h-8 bg-[#1a237e] rounded-full"></div>
                    <div>
                        <h2 class="text-lg font-black text-[#1a237e] tracking-tight">@yield('header_title', 'Dashboard')</h2>
                        <p class="text-[10px] text-gray-400 font-bold uppercase tracking-widest">Panel Administrator</p>
                    </div>
                </div>
                <div class="flex items-center space-x-6">
                    <div class="text-right hidden sm:block">
                        <p class="text-[9px] font-black text-gray-400 uppercase tracking-widest leading-none mb-1">Status Login</p>
                        <p class="text-sm font-black text-[#1a237e] tracking-tighter">{{ Auth::user()->name }}</p>
                    </div>
                    <div class="relative">
                        <div class="w-11 h-11 rounded-2xl bg-gradient-to-br from-[#1a237e] to-blue-600 overflow-hidden shadow-lg border-2 border-white ring-4 ring-blue-50">
                            <img src="{{ Auth::user()->foto_profil ? asset('storage/' . Auth::user()->foto_profil) : 'https://ui-avatars.com/api/?name='.urlencode(Auth::user()->name).'&background=1a237e&color=fff&bold=true' }}" 
                                 class="w-full h-full object-cover">
                        </div>
                        <div class="absolute -bottom-1 -right-1 w-4 h-4 bg-green-500 border-2 border-white rounded-full"></div>
                    </div>
                </div>
            </header>

            <main class="p-6 md:p-10">
                @if(session('success'))
                    <div class="mb-8 p-4 bg-green-500/10 border border-green-500/20 text-green-700 rounded-2xl shadow-sm flex items-center gap-4 animate-bounce-short">
                        <div class="w-10 h-10 rounded-xl bg-green-500 flex items-center justify-center text-white">
                            <i class="bi bi-check2-circle text-xl"></i>
                        </div>
                        <div>
                            <p class="font-black text-xs uppercase tracking-widest leading-none mb-1">Berhasil</p>
                            <p class="font-bold text-sm">{{ session('success') }}</p>
                        </div>
                    </div>
                @endif

                @if(session('wa_success'))
                    <div class="mb-8 p-4 bg-blue-500/10 border border-blue-500/20 text-blue-700 rounded-2xl shadow-sm flex items-center gap-4 animate-pulse-short">
                        <div class="w-10 h-10 rounded-xl bg-blue-500 flex items-center justify-center text-white">
                            <i class="bi bi-whatsapp text-xl"></i>
                        </div>
                        <div>
                            <p class="font-black text-xs uppercase tracking-widest leading-none mb-1">WhatsApp Terkirim</p>
                            <p class="font-bold text-sm">{{ session('wa_success') }}</p>
                        </div>
                    </div>
                @endif

                @if(session('error'))
                    <div class="mb-6 p-4 bg-red-100 border-l-4 border-red-500 text-red-700 rounded-r-xl shadow-sm flex items-center gap-3">
                        <i class="bi bi-exclamation-triangle-fill text-xl"></i>
                        <p class="font-bold text-sm">{{ session('error') }}</p>
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
