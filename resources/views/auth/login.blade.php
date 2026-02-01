<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ $appSetting->app_name ?? 'Hotel Admin' }} | Login</title>

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

        .login-card {
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
            <!-- <p class="text-gray-600 mt-1">Enterprise Workforce Management Platform</p> -->
        </div>

        <!-- Login Card -->
        <div class="bg-white rounded-xl login-card overflow-hidden border border-gray-200">
            <div class="px-8 py-6">

                <h2 class="text-2xl font-semibold text-gray-800 text-center">Sign In</h2>
                <p class="text-gray-500 text-sm text-center mt-1 mb-4">Enter your credentials to access your account</p>

                <!-- Error Alert -->
                @if ($errors->any())
                    <div class="mb-4 bg-red-100 border border-red-400 text-red-700 px-4 py-2 rounded">
                        {{ $errors->first() }}
                    </div>
                @endif

                <form method="POST" action="{{ route('login') }}" class="space-y-5">
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

                    <!-- Password Input -->
                    <div>
                        <label for="password" class="block text-sm font-medium text-gray-700 mb-1">Password</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <i class="fas fa-lock text-gray-400"></i>
                            </div>
                            <input id="password" name="password" type="password" required
                                class="pl-10 pr-10 w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#38240D] focus:border-[#38240D] outline-none transition input-focus"
                                placeholder="••••••••">
                            <!-- Eye toggle button -->
                            <button type="button" id="togglePassword"
                                class="absolute inset-y-0 right-0 pr-3 flex items-center text-gray-400 hover:text-gray-600 focus:outline-none">
                                <i class="fas fa-eye"></i>
                            </button>
                        </div>
                        @error('password')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Remember Me & Forgot Password -->
                    <div class="flex items-center justify-between text-sm">
                        <label class="inline-flex items-center">
                            <input type="checkbox" name="remember"
                                class="h-4 w-4 text-[#38240D] border-gray-300 rounded" {{ old('remember') ? 'checked' : '' }}>
                            <span class="ml-2 text-gray-700">Remember me</span>
                        </label>
                        @if (Route::has('password.request'))
                            <a href="{{ route('password.request') }}" class="text-[#38240D] hover:underline">
                                Forgot password?
                            </a>
                        @endif
                    </div>

                    <!-- Submit Button -->
                    <div>
                        <button type="submit"
                            class="w-full py-3 px-4 bg-[#38240D] hover:bg-[#5C3A1A] text-white font-medium rounded-lg shadow transition">
                            Sign In
                        </button>
                    </div>

                </form>
            </div>

            <!-- Footer -->
            <div class="bg-gray-50 px-6 py-4 text-center text-xs text-gray-500 border-t border-gray-200">
                &copy; {{ date('Y') }} {{ $appSetting->app_name ?? 'Hotel Admin' }}. All rights reserved.
            </div>
        </div>

    </div>

    <script>
        // Toggle password visibility
        const togglePassword = document.getElementById("togglePassword");
        const passwordInput = document.getElementById("password");

        togglePassword.addEventListener("click", function () {
            const type = passwordInput.getAttribute("type") === "password" ? "text" : "password";
            passwordInput.setAttribute("type", type);
            this.querySelector("i").classList.toggle("fa-eye");
            this.querySelector("i").classList.toggle("fa-eye-slash");
        });
    </script>

</body>

</html>
