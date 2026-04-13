<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('images/favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('images/favicon-16x16.png') }}">
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('images/apple-touch-icon.png') }}">
    <title>@yield('title', 'Zidan Transport')</title>
    
    <!-- Fonts & Icons -->
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    
    <!-- Frameworks -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/@hotwired/turbo@8.0.4/dist/turbo.es2017-umd.js"></script>
    
    <style>
        body { font-family: 'Montserrat', sans-serif; }
        
        @keyframes fadeInUp {
            from { opacity: 0; transform: translateY(30px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .animate-fade-in-up {
            animation: fadeInUp 0.8s ease-out forwards;
        }
        
        /* Turbo Progress Bar Color */
        .turbo-progress-bar {
            background-color: #fbc02d;
            height: 3px;
        }
    </style>
    @stack('styles')
</head>
<body class="bg-gray-50">

    @include('partials.pelanggan.navbar')

    <main class="max-w-7xl mx-auto p-4 md:p-8 pt-24 md:pt-28">
        @yield('content')
    </main>

    @include('partials.pelanggan.footer')

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        document.addEventListener('turbo:load', () => {
            @if(session('success'))
                Swal.fire({ icon: 'success', text: '{{ session("success") }}', background: '#fff', color: '#111', showConfirmButton: false, timer: 3000 });
            @endif
            @if(session('error'))
                Swal.fire({ icon: 'error', title: 'Oops...', text: '{{ session("error") }}', background: '#fff', color: '#111' });
            @endif
            @if($errors->any())
                Swal.fire({ icon: 'warning', title: 'Perhatian', html: '{!! implode("<br>", $errors->all()) !!}', background: '#fff', color: '#111' });
            @endif
        });
    </script>
    @stack('scripts')
</body>
</html>
