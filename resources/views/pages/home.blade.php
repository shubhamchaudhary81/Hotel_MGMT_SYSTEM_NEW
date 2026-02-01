@extends ('layouts.front-end.app')
@section('title', 'Home - Himalaya Hotel')

@section('content')

<section id="home" class="relative overflow-hidden">
    <div x-data="{show:false}" x-init="setTimeout(()=>show=true,200)"
        class="relative w-full min-h-[80vh] sm:min-h-screen bg-cover bg-center flex items-center justify-center"
        style="background-image: linear-gradient(rgba(0, 0, 0, 0.8), rgba(0, 0, 0, 0.7)), url('{{ asset('images/image1.jpg') }}');">

        <div class="absolute inset-0 bg-gradient-to-b from-amber-900/10 via-transparent to-amber-900/5"></div>

        <!-- Main Content -->
        <div class="relative z-10 container mx-auto px-3 sm:px-4 py-10 sm:py-12 lg:py-16">
            <div class="max-w-4xl mx-auto">
                <!-- Welcome Text -->
                <div x-show="show" x-transition
                    class="text-center mb-6 sm:mb-8">
                    <span class="inline-block px-3 py-1 bg-amber-50 text-amber-800 rounded-full 
                                 text-xs font-semibold mb-4 shadow">
                        ★ Luxury Himalayan Retreat ★
                    </span>
                </div>

                <!-- Main Heading -->
                <h1 x-show="show" x-transition.delay.100ms
                    class="text-2xl sm:text-3xl md:text-4xl lg:text-5xl 
                           font-bold mb-4 sm:mb-6 text-center leading-snug">
                    <span class="block text-white mb-1 sm:mb-2">Discover The</span>
                    <span class="block bg-gradient-to-r from-amber-100 via-amber-300 to-amber-500 
                                 bg-clip-text text-transparent drop-shadow">
                        Ultimate Escape
                    </span>
                </h1>

                <!-- Subtitle & Description -->
                <div x-show="show" x-transition.delay.300ms 
                     class="space-y-3 mb-6 sm:mb-8 max-w-2xl mx-auto">
                    <p class="text-base sm:text-lg md:text-xl text-amber-50 font-light text-center">
                        Where Himalayan Majesty Meets Modern Luxury
                    </p>
                    <p class="text-sm sm:text-base text-amber-100/80 text-center 
                              leading-relaxed px-3">
                        Nestled in the heart of the mountains, our hotel offers an unparalleled 
                        blend of traditional warmth and contemporary comfort.
                    </p>
                </div>

                <!-- Call to Action Buttons -->
                <div x-show="show" x-transition.delay.500ms 
                     class="flex flex-col sm:flex-row gap-3 sm:gap-4 justify-center items-center">
                    <a href="#rooms"
                       class="group relative px-5 sm:px-6 py-3 rounded-lg 
                              font-semibold text-sm sm:text-base
                              bg-gradient-to-r from-amber-800 to-amber-900 
                              text-white hover:from-amber-900 hover:to-amber-950
                              transition-all duration-300 shadow hover:shadow-md
                              hover:-translate-y-0.5 min-w-[140px] text-center">
                        Explore Rooms
                    </a>

                    <a href="#contact"
                       class="group relative px-5 sm:px-6 py-3 rounded-lg 
                              font-semibold text-sm sm:text-base
                              border border-amber-200 text-amber-50 
                              hover:bg-amber-50 hover:text-amber-900
                              transition-all duration-300 shadow hover:shadow-md
                              hover:-translate-y-0.5 min-w-[140px] text-center">
                        Book Your Stay
                    </a>
                </div>

                <!-- Stats/Features -->
                <!-- <div x-show="show" x-transition.delay.700ms
                    class="mt-10 sm:mt-12 grid grid-cols-2 sm:grid-cols-4 gap-3 sm:gap-4 max-w-3xl mx-auto">
                    <div class="text-center p-3 bg-white/5 backdrop-blur-sm rounded-lg 
                                border border-amber-200/10">
                        <div class="text-lg sm:text-xl font-bold text-amber-300 mb-1">50+</div>
                        <div class="text-xs sm:text-sm text-amber-100">Luxury Rooms</div>
                    </div>
                    <div class="text-center p-3 bg-white/5 backdrop-blur-sm rounded-lg 
                                border border-amber-200/10">
                        <div class="text-lg sm:text-xl font-bold text-amber-300 mb-1">24/7</div>
                        <div class="text-xs sm:text-sm text-amber-100">Service</div>
                    </div>
                    <div class="text-center p-3 bg-white/5 backdrop-blur-sm rounded-lg 
                                border border-amber-200/10">
                        <div class="text-lg sm:text-xl font-bold text-amber-300 mb-1">5★</div>
                        <div class="text-xs sm:text-sm text-amber-100">Rating</div>
                    </div>
                    <div class="text-center p-3 bg-white/5 backdrop-blur-sm rounded-lg 
                                border border-amber-200/10">
                        <div class="text-lg sm:text-xl font-bold text-amber-300 mb-1">10+</div>
                        <div class="text-xs sm:text-sm text-amber-100">Years</div>
                    </div>
                </div> -->
            </div>
        </div>

        <!-- Scroll Indicator -->
        <div class="absolute bottom-4 sm:bottom-6 left-1/2 -translate-x-1/2">
            <a href="#about" 
               class="group flex flex-col items-center text-amber-200/60 hover:text-amber-300 
                      transition-colors duration-300 animate-bounce">
                <span class="text-xs mb-1 opacity-0 group-hover:opacity-100 transition-opacity">
                    Explore
                </span>
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M19 14l-7 7m0 0l-7-7m7 7V3"/>
                </svg>
            </a>
        </div>
    </div>
</section>

@include('pages.about')
@include('pages.rooms')
@include('pages.services')
@include('pages.contact')

@endsection