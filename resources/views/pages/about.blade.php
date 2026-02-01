<section id="about" class="py-10 sm:py-12 lg:py-16 relative overflow-hidden bg-white">
    <div class="container mx-auto px-3 sm:px-4 lg:px-6">
        <!-- Section Header -->
        <div class="text-center max-w-3xl mx-auto mb-8 sm:mb-10">
            <span class="inline-block px-3 py-1 bg-amber-100 text-amber-800 rounded-full 
                         text-xs font-semibold uppercase mb-4 shadow"
                  data-aos="fade-up">
                Our Story
            </span>
            
            <h2 class="text-xl sm:text-2xl md:text-3xl lg:text-4xl font-bold mb-4"
                data-aos="fade-up" data-aos-delay="100">
                <span class="block text-gray-800">Experience Himalayan</span>
                <span class="text-transparent bg-gradient-to-r from-amber-700 to-amber-800 bg-clip-text">
                    Hospitality
                </span>
            </h2>
            
            <p class="text-sm sm:text-base text-gray-600 leading-relaxed max-w-2xl mx-auto px-3"
               data-aos="fade-up" data-aos-delay="200">
                Nestled in the majestic Himalayan foothills, our hotel blends 
                tradition with contemporary luxury.
            </p>
        </div>

        <!-- Main Content Grid -->
        <div class="grid lg:grid-cols-2 gap-6 lg:gap-8 items-center mb-10 lg:mb-12">
            <!-- Left Column - Image/Visual -->
            <div class="relative" data-aos="fade-right">
                <div class="relative rounded-lg overflow-hidden shadow-lg">
                    <img src="{{ asset('images/about.jpg') }}" 
                         alt="Himalaya Hotel Exterior"
                         class="w-full h-64 sm:h-72 md:h-80 object-cover transform hover:scale-105 transition-transform duration-700">
                </div>
            </div>

            <!-- Right Column - Features -->
            <div data-aos="fade-left">
                <div class="space-y-4">
                    <div class="bg-white rounded-lg p-4 shadow hover:shadow-md 
                                border-l-3 border-amber-600 transform hover:-translate-x-1 transition-all duration-300">
                        <div class="flex items-start space-x-3">
                            <div class="bg-amber-50 p-2 rounded flex-shrink-0">
                                <svg class="w-5 h-5 text-amber-700" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"/>
                                </svg>
                            </div>
                            <div>
                                <h3 class="text-base font-bold text-gray-800 mb-1">Prime Mountain Location</h3>
                                <p class="text-sm text-gray-600">
                                    Perched at 2,500 meters with panoramic Himalayan views.
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="bg-white rounded-lg p-4 shadow hover:shadow-md 
                                border-l-3 border-amber-600 transform hover:-translate-x-1 transition-all duration-300">
                        <div class="flex items-start space-x-3">
                            <div class="bg-amber-50 p-2 rounded flex-shrink-0">
                                <svg class="w-5 h-5 text-amber-700" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M11.3 1.046A1 1 0 0112 2v5h4a1 1 0 01.82 1.573l-7 10A1 1 0 018 18v-5H4a1 1 0 01-.82-1.573l7-10a1 1 0 011.12-.38z" clip-rule="evenodd"/>
                                </svg>
                            </div>
                            <div>
                                <h3 class="text-base font-bold text-gray-800 mb-1">Luxury Amenities</h3>
                                <p class="text-sm text-gray-600">
                                    Award-winning spa, heated pool, and guided mountain tours.
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="bg-white rounded-lg p-4 shadow hover:shadow-md 
                                border-l-3 border-amber-600 transform hover:-translate-x-1 transition-all duration-300">
                        <div class="flex items-start space-x-3">
                            <div class="bg-amber-50 p-2 rounded flex-shrink-0">
                                <svg class="w-5 h-5 text-amber-700" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-8-3a1 1 0 00-.867.5 1 1 0 11-1.731-1A3 3 0 0113 8a3.001 3.001 0 01-2 2.83V11a1 1 0 11-2 0v-1a1 1 0 011-1 1 1 0 100-2zm0 8a1 1 0 100-2 1 1 0 000 2z" clip-rule="evenodd"/>
                                </svg>
                            </div>
                            <div>
                                <h3 class="text-base font-bold text-gray-800 mb-1">Gourmet Dining</h3>
                                <p class="text-sm text-gray-600">
                                    Three specialty restaurants featuring farm-to-table cuisine.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Additional Features Grid -->
        <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-4" data-aos="fade-up">
            <div class="bg-white p-4 rounded-lg shadow hover:shadow-md transform hover:-translate-y-0.5 
                        transition-all duration-300 group text-center">
                <div class="bg-amber-50 w-12 h-12 rounded-full flex items-center justify-center mx-auto mb-3">
                    <svg class="w-6 h-6 text-amber-700" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M9 4.804A7.968 7.968 0 005.5 4c-1.255 0-2.443.29-3.5.804v10A7.969 7.969 0 015.5 14c1.669 0 3.218.51 4.5 1.385A7.962 7.962 0 0114.5 14c1.255 0 2.443.29 3.5.804v-10A7.968 7.968 0 0014.5 4c-1.255 0-2.443.29-3.5.804V12a1 1 0 11-2 0V4.804z"/>
                    </svg>
                </div>
                <h4 class="font-bold text-sm text-gray-800 mb-1">Cultural Events</h4>
                <p class="text-xs text-gray-600">Traditional music and dance performances</p>
            </div>

            <div class="bg-white p-4 rounded-lg shadow hover:shadow-md transform hover:-translate-y-0.5 
                        transition-all duration-300 group text-center">
                <div class="bg-amber-50 w-12 h-12 rounded-full flex items-center justify-center mx-auto mb-3">
                    <svg class="w-6 h-6 text-amber-700" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M6 6V5a3 3 0 013-3h2a3 3 0 013 3v1h2a2 2 0 012 2v3.57A22.952 22.952 0 0110 13a22.95 22.95 0 01-8-1.43V8a2 2 0 012-2h2zm2-1a1 1 0 011-1h2a1 1 0 011 1v1H8V5zm1 5a1 1 0 011-1h.01a1 1 0 110 2H10a1 1 0 01-1-1z" clip-rule="evenodd"/>
                        <path d="M2 13.692V16a2 2 0 002 2h12a2 2 0 002-2v-2.308A24.974 24.974 0 0110 15c-2.796 0-5.487-.46-8-1.308z"/>
                    </svg>
                </div>
                <h4 class="font-bold text-sm text-gray-800 mb-1">Adventure Hub</h4>
                <p class="text-xs text-gray-600">Trekking and guided nature walks</p>
            </div>

            <div class="bg-white p-4 rounded-lg shadow hover:shadow-md transform hover:-translate-y-0.5 
                        transition-all duration-300 group text-center">
                <div class="bg-amber-50 w-12 h-12 rounded-full flex items-center justify-center mx-auto mb-3">
                    <svg class="w-6 h-6 text-amber-700" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M3.172 5.172a4 4 0 015.656 0L10 6.343l1.172-1.171a4 4 0 115.656 5.656L10 17.657l-6.828-6.829a4 4 0 010-5.656z" clip-rule="evenodd"/>
                    </svg>
                </div>
                <h4 class="font-bold text-sm text-gray-800 mb-1">Eco-Friendly</h4>
                <p class="text-xs text-gray-600">Sustainable practices and conservation</p>
            </div>

            <div class="bg-white p-4 rounded-lg shadow hover:shadow-md transform hover:-translate-y-0.5 
                        transition-all duration-300 group text-center">
                <div class="bg-amber-50 w-12 h-12 rounded-full flex items-center justify-center mx-auto mb-3">
                    <svg class="w-6 h-6 text-amber-700" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M10.394 2.08a1 1 0 00-.788 0l-7 3a1 1 0 000 1.84L5.25 8.051a.999.999 0 01.356-.257l4-1.714a1 1 0 11.788 1.838L7.667 9.088l1.94.831a1 1 0 00.787 0l7-3a1 1 0 000-1.838l-7-3z"/>
                    </svg>
                </div>
                <h4 class="font-bold text-sm text-gray-800 mb-1">Local Community</h4>
                <p class="text-xs text-gray-600">Supporting local artisans</p>
            </div>
        </div>
    </div>
</section>