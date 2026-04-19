<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('images/favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('images/favicon-16x16.png') }}">
    
    <title>@yield('title', 'Driver Panel') - Zidan Transport</title>
    
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    
    <!-- Hotwire Turbo -->
    <script src="https://cdn.jsdelivr.net/npm/@hotwired/turbo@8.0.4/dist/turbo.es2017-umd.min.js"></script>

    <style>
        body { 
            font-family: 'Montserrat', sans-serif; 
            -webkit-tap-highlight-color: transparent;
        }
        .glass-card {
            background: rgba(255, 255, 255, 0.9);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }
        @keyframes pulse-soft {
            0%, 100% { transform: scale(1); opacity: 1; }
            50% { transform: scale(1.05); opacity: 0.8; }
        }
        .animate-pulse-soft {
            animation: pulse-soft 2s infinite;
        }
        @keyframes fadeInUp {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .animate-up { animation: fadeInUp 0.4s ease forwards; }
    </style>
    @stack('styles')
</head>
<body class="bg-gray-50 pb-24 min-h-screen">

    @yield('content')

    @include('partials.driver.bottom-nav')

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        document.addEventListener('turbo:load', function() {
            // Global driver scripts initialization
        });

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
                        form.removeAttribute('data-confirm');
                        form.submit();
                    }
                });
            }
        });

        document.addEventListener('turbo:before-cache', function() {
            if (typeof Swal !== 'undefined') {
                Swal.close();
            }
        });
    </script>
    @stack('scripts')
</body>
</html>
