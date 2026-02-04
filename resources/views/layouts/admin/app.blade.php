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
            :root {
                /* ================= PRIMARY COLORS ================= */
                --primary-color:
                    {{ $appSetting->primary_color ?? '#6B4C2B' }}
                ;
                --primary-hover:
                    {{ $appSetting->primary_hover ?? '#5a3f20' }}
                ;

                /* ================= ACCENT COLORS ================= */
                --accent-color:
                    {{ $appSetting->accent_color ?? '#2665cb' }}
                ;
                --accent-hover:
                    {{ $appSetting->accent_hover ?? '#1f54a8' }}
                ;

                /* ================= SIDEBAR COLORS ================= */
                --sidebar-bg:
                    {{ $appSetting->sidebar_bg ?? '#ffffff' }}
                ;
                --sidebar-text:
                    {{ $appSetting->sidebar_text ?? '#4b5563' }}
                ;
                --sidebar-hover-bg:
                    {{ $appSetting->sidebar_hover_bg ?? '#F5EFEA' }}
                ;
                --sidebar-active-bg:
                    {{ $appSetting->sidebar_active_bg ?? '#EFE7DF' }}
                ;
                --sidebar-active-text:
                    {{ $appSetting->sidebar_active_text ?? '#6B4C2B' }}
                ;

                /* ================= TABLE COLORS ================= */
                --table-header-bg:
                    {{ $appSetting->table_header_bg ?? '#f9f6f2' }}
                ;
                --table-border:
                    {{ $appSetting->table_border ?? '#e5e7eb' }}
                ;
            }

            /* ================= BUTTON STYLES ================= */
            .btn-primary {
                background: var(--primary-color) !important;
                color: white !important;
            }

            .btn-primary:hover {
                background: var(--primary-hover) !important;
            }

            .btn-accent {
                background: var(--accent-color) !important;
                color: white !important;
            }

            .btn-accent:hover {
                background: var(--accent-hover) !important;
            }

            /* ================= SIDEBAR STYLES ================= */
            .sidebar {
                background: var(--sidebar-bg);
                color: var(--sidebar-text);
            }

            .sidebar-link:hover {
                background: var(--sidebar-hover-bg);
            }

            .sidebar-link-active {
                background: var(--sidebar-active-bg);
                color: var(--sidebar-active-text) !important;
                font-weight: 600;
            }

            /* ================= TABLE STYLES ================= */
            .table-header {
                background: var(--table-header-bg) !important;
            }

            .table-border {
                border-color: var(--table-border) !important;
            }


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