<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>@yield('title', 'Himalaya Hotel')</title>
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <link rel="icon" type="image/png"
            href="{{ !empty($appSetting?->favicon) ? asset($appSetting->favicon) : asset('images/hdc.webp') }}">
    </head>

    <body class="bg-white text-gray-900 font-sans">

        <!-- NAVBAR -->
        @include('layouts.front-end.partials.navbar')

        <!-- MAIN CONTENT -->
        <main>
            @yield('content')
        </main>

        <!-- FOOTER -->
        @include('layouts.front-end.partials.footer')

        @stack('scripts')

        {{-- ✅ GLOBAL SUCCESS TOAST --}}
        @if (session('success'))
            <script>
                document.addEventListener('DOMContentLoaded', function () {
                    Swal.fire({
                        toast: true,
                        position: 'top-end',
                        icon: 'success',
                        title: @json(session('success')),
                        showConfirmButton: false,
                        timer: 3000,
                        timerProgressBar: true
                    });
                });
            </script>
        @endif
        {{-- GLOBAL ERROR TOAST --}}
        @if (session('error'))
            <script>
                document.addEventListener('DOMContentLoaded', function () {
                    Swal.fire({
                        toast: true,
                        position: 'top-end',
                        icon: 'error',
                        title: @json(session('error')),
                        showConfirmButton: false,
                        timer: 3000,
                        timerProgressBar: true
                    });
                });
            </script>
        @endif
    </body>

</html>