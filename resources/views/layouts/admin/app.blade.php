<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>@yield('title', 'Admin Panel')</title>

    <!-- CSRF Token -->
    <!-- <meta name="csrf-token" content="{{ csrf_token() }}"> -->

    <!-- Vite Assets -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- Favicon -->
    <link rel="icon" type="image/png"
        href="{{ !empty($appSetting?->favicon) ? asset($appSetting->favicon) : asset('images/hdc.webp') }}">

    <!-- Alpine.js -->
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <!-- SweetAlert -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    @stack('styles')
    <style>
        [x-cloak] {
            display: none !important;
        }

        /* SweetAlert Custom Buttons */
        .swal-confirm-btn {
            background-color: #2665cb !important;
            color: #fff !important;
            padding: 0.5rem 1.25rem;
            border-radius: 0.375rem;
        }

        .swal-cancel-btn {
            background-color: #dc2626 !important;
            color: #fff !important;
            padding: 0.5rem 1.25rem;
            border-radius: 0.375rem;
            margin-left: 0.5rem;
        }
    </style>
</head>

<body class="bg-gray-50 font-sans">
    <div class="flex h-screen overflow-hidden">

        {{-- Sidebar --}}
        @include('layouts.admin.partials.sidebar')

        <div class="flex flex-col flex-1">

            {{-- Topbar --}}
            @include('layouts.admin.partials.topbar')

            {{-- Page Content --}}
            <main class="flex-1 overflow-y-auto px-6 py-6">
                @yield('contents')
            </main>

        </div>
    </div>

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

    {{-- ✅ GLOBAL ERROR TOAST --}}
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
