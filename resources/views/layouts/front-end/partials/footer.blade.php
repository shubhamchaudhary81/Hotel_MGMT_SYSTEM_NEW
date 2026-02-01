<footer class="bg-gradient-to-b from-amber-900/90 to-amber-800/90 text-white py-10 sm:py-12 lg:py-14 relative">
    <div class="container mx-auto px-3 sm:px-4 lg:px-6">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 lg:gap-8">

            <!-- Hotel Information -->
            <div class="space-y-4">
                <div class="flex items-center space-x-2">
                    <span class="text-xl sm:text-2xl font-bold text-white">Himalaya Hotel</span>
                </div>
                <p class="text-sm text-amber-100/80 leading-relaxed">
                    Experience Himalayan luxury, comfort, and authentic hospitality 
                    nestled in the heart of the majestic mountains.
                </p>
                <!-- Social Media -->
                <div class="flex space-x-3 pt-2">
                    @foreach(['#' => 'M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z'] as $link => $path)
                        <a href="{{ $link }}" class="w-8 h-8 rounded-full bg-amber-700/70 hover:bg-amber-600/70 
                                        flex items-center justify-center transition-colors duration-300 text-white/90">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                                <path d="{{ $path }}"/>
                            </svg>
                        </a>
                    @endforeach
                </div>
            </div>

            <!-- Quick Links -->
            <div class="space-y-4">
                <h3 class="text-base font-bold text-white border-l-3 border-amber-400/70 pl-3">
                    Quick Links
                </h3>
                <ul class="space-y-2">
                    @foreach(['Home'=>'#home','About Us'=>'#about','Rooms'=>'#rooms','Services'=>'#services','Gallery'=>'#gallery','Contact'=>'#contact'] as $name => $link)
                        <li>
                            <a href="{{ $link }}" class="text-sm text-amber-100/80 hover:text-white hover:pl-2 
                                                    transition-all duration-300 flex items-center">
                                <svg class="w-3 h-3 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                          d="M13 5l7 7-7 7M5 5l7 7-7 7"/>
                                </svg>
                                {{ $name }}
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>

            <!-- Contact Information -->
            <div class="space-y-4">
                <h3 class="text-base font-bold text-white border-l-3 border-amber-400/70 pl-3">
                    Contact Info
                </h3>
                <div class="space-y-3">
                    <div class="flex items-start space-x-3">
                        <div class="flex-shrink-0 w-8 h-8 rounded bg-amber-700/70 flex items-center justify-center">
                            <svg class="w-4 h-4 text-white/90" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                      d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                      d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                            </svg>
                        </div>
                        <div>
                            <p class="text-sm font-medium text-white">Address</p>
                            <p class="text-xs text-amber-100/80">College Road, Biratnagar, Nepal</p>
                        </div>
                    </div>
                    <div class="flex items-start space-x-3">
                        <div class="flex-shrink-0 w-8 h-8 rounded bg-amber-700/70 flex items-center justify-center">
                            <svg class="w-4 h-4 text-white/90" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                      d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                            </svg>
                        </div>
                        <div>
                            <p class="text-sm font-medium text-white">Phone</p>
                            <a href="tel:+9779819096819" class="text-xs text-amber-100/80 hover:text-white">
                                +977 9819096819
                            </a>
                        </div>
                    </div>
                    <div class="flex items-start space-x-3">
                        <div class="flex-shrink-0 w-8 h-8 rounded bg-amber-700/70 flex items-center justify-center">
                            <svg class="w-4 h-4 text-white/90" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                      d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                            </svg>
                        </div>
                        <div>
                            <p class="text-sm font-medium text-white">Email</p>
                            <a href="mailto:info@himalayahotel.com" class="text-xs text-amber-100/80 hover:text-white">
                                info@himalayahotel.com
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Newsletter -->
            <div class="space-y-4">
                <h3 class="text-base font-bold text-white border-l-3 border-amber-400/70 pl-3">
                    Newsletter
                </h3>
                <p class="text-sm text-amber-100/80">
                    Subscribe to our newsletter for updates, offers, and Himalayan travel tips.
                </p>
                <form class="space-y-3">
                    <div class="flex">
                        <input type="email" placeholder="Your email" 
                               class="flex-grow px-3 py-2 text-sm rounded-l focus:outline-none text-gray-800">
                        <button type="submit" 
                                class="bg-amber-600/80 hover:bg-amber-700/90 text-white px-4 py-2 text-sm rounded-r 
                                       transition-colors duration-300 font-medium">
                            Subscribe
                        </button>
                    </div>
                    <p class="text-xs text-amber-200/60">
                        We respect your privacy. Unsubscribe at any time.
                    </p>
                </form>
            </div>

        </div>

        <!-- Divider -->
        <div class="mt-8 pt-6 border-t border-amber-700/50">
            <div class="flex flex-col md:flex-row justify-between items-center space-y-4 md:space-y-0">
                <div class="text-xs text-amber-200/60">
                    &copy; 2026 Himalaya Hotel. All rights reserved.
                </div>
                <div class="flex space-x-4 text-xs text-amber-200/60">
                    <a href="#" class="hover:text-white transition-colors duration-300">Privacy Policy</a>
                    <span class="text-amber-600">•</span>
                    <a href="#" class="hover:text-white transition-colors duration-300">Terms of Service</a>
                    <span class="text-amber-600">•</span>
                    <a href="#" class="hover:text-white transition-colors duration-300">Cookie Policy</a>
                </div>
            </div>
        </div>
    </div>
</footer>
