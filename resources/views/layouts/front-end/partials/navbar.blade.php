<nav 
    x-data="{ scrolled: false }" 
    x-init="window.addEventListener('scroll', () => scrolled = window.scrollY > 10)" 
    :class="scrolled ? 'bg-white shadow-lg' : 'bg-transparent shadow-none'" 
    class="fixed w-full z-50 transition-all duration-300"
>
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center h-16">
            <!-- Logo -->
            <a href="{{ route('home') }}" :class="scrolled ? 'text-amber-900' : 'text-white'" class="flex items-center space-x-2 text-2xl md:text-3xl font-bold tracking-wide transition-colors duration-300">
                Himalaya Hotel
            </a>

            <!-- Desktop Navigation -->
            <div class="hidden lg:flex items-center space-x-1">
                <ul class="flex space-x-1">
                    <li>
                        <a href="#home" :class="scrolled ? 'text-gray-700 hover:text-amber-900 hover:bg-amber-50' : 'text-white hover:text-amber-200'" class="px-4 py-2 rounded-lg font-medium transition-colors duration-300">Home</a>
                    </li>
                    <li>
                        <a href="#about" :class="scrolled ? 'text-gray-700 hover:text-amber-900 hover:bg-amber-50' : 'text-white hover:text-amber-200'" class="px-4 py-2 rounded-lg font-medium transition-colors duration-300">About</a>
                    </li>
                    <li>
                        <a href="#rooms" :class="scrolled ? 'text-gray-700 hover:text-amber-900 hover:bg-amber-50' : 'text-white hover:text-amber-200'" class="px-4 py-2 rounded-lg font-medium transition-colors duration-300">Rooms</a>
                    </li>
                    <li>
                        <a href="#services" :class="scrolled ? 'text-gray-700 hover:text-amber-900 hover:bg-amber-50' : 'text-white hover:text-amber-200'" class="px-4 py-2 rounded-lg font-medium transition-colors duration-300">Services</a>
                    </li>
                    <li>
                        <a href="#gallery" :class="scrolled ? 'text-gray-700 hover:text-amber-900 hover:bg-amber-50' : 'text-white hover:text-amber-200'" class="px-4 py-2 rounded-lg font-medium transition-colors duration-300">Gallery</a>
                    </li>
                    <li>
                        <a href="#contact" :class="scrolled ? 'text-gray-700 hover:text-amber-900 hover:bg-amber-50' : 'text-white hover:text-amber-200'" class="px-4 py-2 rounded-lg font-medium transition-colors duration-300">Contact</a>
                    </li>
                </ul>
            </div>

            <!-- Mobile menu button -->
            <div class="lg:hidden">
                <button @click="open = !open" x-data="{open:false}" :class="scrolled ? 'text-gray-700 hover:text-amber-900 hover:bg-amber-50' : 'text-white hover:text-amber-200'" class="inline-flex items-center justify-center p-2 rounded-md focus:outline-none transition-colors duration-300">
                    <span class="sr-only">Open main menu</span>
                    <!-- Hamburger Icon -->
                    <svg x-show="!open" class="block h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                    </svg>
                    <!-- Close Icon -->
                    <svg x-show="open" class="block h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Mobile Menu Dropdown -->
    <div x-show="open" 
         x-transition:enter="transition ease-out duration-200"
         x-transition:enter-start="opacity-0 scale-95"
         x-transition:enter-end="opacity-100 scale-100"
         x-transition:leave="transition ease-in duration-150"
         x-transition:leave-start="opacity-100 scale-100"
         x-transition:leave-end="opacity-0 scale-95"
         @click.away="open=false"
         :class="scrolled ? 'bg-white shadow-xl border-t border-amber-100' : 'bg-transparent shadow-none border-t border-white/20'"
         class="lg:hidden"
    >
        <div class="px-4 pt-2 pb-3 space-y-1">
            <a href="#home" :class="scrolled ? 'text-gray-700 hover:text-amber-900 hover:bg-amber-50' : 'text-white hover:text-amber-200'" class="block px-4 py-3 rounded-lg font-medium transition-colors duration-300">Home</a>
            <a href="#about" :class="scrolled ? 'text-gray-700 hover:text-amber-900 hover:bg-amber-50' : 'text-white hover:text-amber-200'" class="block px-4 py-3 rounded-lg font-medium transition-colors duration-300">About</a>
            <a href="#rooms" :class="scrolled ? 'text-gray-700 hover:text-amber-900 hover:bg-amber-50' : 'text-white hover:text-amber-200'" class="block px-4 py-3 rounded-lg font-medium transition-colors duration-300">Rooms</a>
            <a href="#services" :class="scrolled ? 'text-gray-700 hover:text-amber-900 hover:bg-amber-50' : 'text-white hover:text-amber-200'" class="block px-4 py-3 rounded-lg font-medium transition-colors duration-300">Services</a>
            <a href="#gallery" :class="scrolled ? 'text-gray-700 hover:text-amber-900 hover:bg-amber-50' : 'text-white hover:text-amber-200'" class="block px-4 py-3 rounded-lg font-medium transition-colors duration-300">Gallery</a>
            <a href="#contact" :class="scrolled ? 'text-gray-700 hover:text-amber-900 hover:bg-amber-50' : 'text-white hover:text-amber-200'" class="block px-4 py-3 rounded-lg font-medium transition-colors duration-300">Contact</a>
        </div>
    </div>
</nav>
