<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $appSetting->app_name ?? 'Hotel Admin' }} | Reset Password</title>

    <!-- Tailwind CSS -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/js/all.min.js"></script>

        <!-- Favicon -->
    <link rel="icon" type="image/png"
        href="{{ !empty($appSetting?->favicon) ? asset($appSetting->favicon) : asset('images/hdc.webp') }}">

    <style>
        body {
            background: linear-gradient(135deg, #FDF6ED 0%, #EADFC0 100%);
        }

        .card {
            box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.1),
                0 10px 10px -5px rgba(0, 0, 0, 0.04);
        }

        .input-focus:focus {
            box-shadow: 0 0 0 3px rgba(56, 36, 13, 0.3);
        }
    </style>
</head>

<body class="min-h-screen flex items-center justify-center p-4">

    <div class="w-full max-w-md">

        <!-- Logo Header -->
        <div class="text-center mb-8">
            <div class="mx-auto w-20 h-20 flex items-center justify-center mb-4 overflow-hidden rounded-full bg-white shadow">
                <img src="{{ !empty($appSetting?->app_logo) ? asset($appSetting->app_logo) : asset('images/hdc.webp') }}"
                    alt="Logo" class="w-full h-full object-contain">
            </div>
            <h1 class="text-2xl font-bold text-[#38240D]">{{ $appSetting->app_name ?? 'Hotel Admin' }}</h1>
            <p class="text-gray-600 mt-1">Reset Your Password</p>
        </div>

        <!-- Reset Card -->
        <div class="bg-white rounded-xl card overflow-hidden border border-gray-200">
            <div class="px-8 py-6">

                <!-- Session Status -->
                @if (session('status'))
                    <div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-2 rounded">
                        {{ session('status') }}
                    </div>
                @endif

                <!-- Instructions -->
                <p class="text-gray-500 text-sm mb-4">
                    Enter your email address and we will send you a password reset link.
                </p>

                <form method="POST" action="{{ route('password.email') }}" class="space-y-5">
                    @csrf

                    <!-- Email Input -->
                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email Address</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <i class="fas fa-envelope text-gray-400"></i>
                            </div>
                            <input id="email" name="email" type="email" value="{{ old('email') }}" required autofocus
                                class="pl-10 w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#38240D] focus:border-[#38240D] outline-none transition input-focus"
                                placeholder="your@email.com">
                        </div>
                        @error('email')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Submit Button -->
                    <div>
                        <button type="submit"
                            class="w-full py-3 px-4 bg-[#38240D] hover:bg-[#5C3A1A] text-white font-medium rounded-lg shadow transition">
                            Send Password Reset Link
                        </button>
                    </div>

                    <!-- Back to login -->
                    <div class="text-center text-sm text-gray-600">
                        <a href="{{ route('login') }}" class="text-[#38240D] hover:underline">Back to login</a>
                    </div>
                </form>

            </div>

            <!-- Footer -->
            <div class="bg-gray-50 px-6 py-4 text-center text-xs text-gray-500 border-t border-gray-200">
                &copy; {{ date('Y') }} {{ $appSetting->app_name ?? 'Hotel Admin' }}. All rights reserved.
            </div>
        </div>

    </div>

</body>

</html>
