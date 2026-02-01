<section id="contact" class="py-10 sm:py-12 lg:py-16 bg-white">
    <div class="container mx-auto px-3 sm:px-4 lg:px-6">
        <!-- SECTION HEADER -->
        <div class="text-center max-w-3xl mx-auto mb-8 sm:mb-10">
            <span class="inline-block px-3 py-1 bg-amber-100 text-amber-800 rounded-full 
                         text-xs font-semibold uppercase mb-4 shadow"
                  data-aos="fade-up">
                Get In Touch
            </span>
            
            <h2 class="text-xl sm:text-2xl md:text-3xl lg:text-4xl font-bold mb-4"
                data-aos="fade-up" data-aos-delay="100">
                <span class="block text-gray-800">Plan Your Himalayan</span>
                <span class="text-transparent bg-gradient-to-r from-amber-700 to-amber-800 bg-clip-text">
                    Getaway
                </span>
            </h2>
            
            <p class="text-sm sm:text-base text-gray-600 leading-relaxed max-w-2xl mx-auto px-3"
               data-aos="fade-up" data-aos-delay="200">
                Contact us to book your stay or inquire about special packages.
            </p>
        </div>

        <!-- CONTENT GRID -->
        <div class="grid lg:grid-cols-2 gap-6 lg:gap-8">
            <!-- LEFT: CONTACT INFO -->
            <div class="bg-white rounded-lg shadow hover:shadow-md transition-shadow duration-300 
                        border-l-3 border-amber-600 p-5" data-aos="fade-right">
                <h3 class="text-lg font-bold text-gray-800 mb-5">
                    Contact Information
                </h3>
                
                <!-- LOCATION -->
                <div class="flex items-start gap-3 mb-4 p-3 bg-amber-50/50 rounded hover:bg-amber-50 
                            transition-colors duration-300">
                    <div class="flex-shrink-0 w-10 h-10 flex items-center justify-center 
                                rounded bg-amber-100 text-amber-700">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                        </svg>
                    </div>
                    <div>
                        <h4 class="text-sm font-semibold text-amber-900 mb-1">Our Location</h4>
                        <p class="text-sm text-gray-600">
                            {{ $appSetting->contact_address ?? 'Himalayan Heights, Pokhara, Nepal' }}
                        </p>
                    </div>
                </div>

                <!-- EMAIL -->
                <div class="flex items-start gap-3 mb-4 p-3 bg-amber-50/50 rounded hover:bg-amber-50 
                            transition-colors duration-300">
                    <div class="flex-shrink-0 w-10 h-10 flex items-center justify-center 
                                rounded bg-amber-100 text-amber-700">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                        </svg>
                    </div>
                    <div>
                        <h4 class="text-sm font-semibold text-amber-900 mb-1">Email Address</h4>
                        <a href="mailto:{{ $appSetting->contact_email ?? 'reservations@himalayahotel.com' }}" 
                           class="text-sm text-amber-700 hover:text-amber-900 transition-colors">
                            {{ $appSetting->contact_email ?? 'reservations@himalayahotel.com' }}
                        </a>
                    </div>
                </div>

                <!-- PHONE -->
                <div class="flex items-start gap-3 mb-5 p-3 bg-amber-50/50 rounded hover:bg-amber-50 
                            transition-colors duration-300">
                    <div class="flex-shrink-0 w-10 h-10 flex items-center justify-center 
                                rounded bg-amber-100 text-amber-700">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                        </svg>
                    </div>
                    <div>
                        <h4 class="text-sm font-semibold text-amber-900 mb-1">Phone Number</h4>
                        <a href="tel:{{ $appSetting->contact_phone ?? '+977-61-123456' }}" 
                           class="text-sm text-amber-700 hover:text-amber-900 transition-colors font-medium">
                            {{ $appSetting->contact_phone ?? '+977 (61) 123-456' }}
                        </a>
                    </div>
                </div>

                <!-- MAP -->
                <div class="rounded overflow-hidden border border-amber-200 shadow">
                    <div class="w-full h-40">
                        <iframe class="w-full h-full" 
                                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3510.860765732487!2d83.985669!3d28.394857!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3995937bbf0376ff%3A0xf6cf823b25802164!2sPokhara%2C%20Nepal!5e0!3m2!1sen!2s!4v1616161642474!5m2!1sen!2s"
                                style="border:0;" 
                                allowfullscreen="" 
                                loading="lazy" 
                                referrerpolicy="no-referrer-when-downgrade">
                        </iframe>
                    </div>
                </div>
            </div>

            <!-- RIGHT: CONTACT FORM -->
            <div class="bg-white rounded-lg shadow hover:shadow-md transition-shadow duration-300 
                        border-l-3 border-amber-600 p-5" data-aos="fade-left"
                 x-data="formHandler('contact')" x-ref="form">
                <h3 class="text-lg font-bold text-gray-800 mb-2">
                    Send Us a Message
                </h3>
                <p class="text-sm text-gray-600 mb-5">
                    Fill out the form below and our team will get back to you shortly.
                </p>

                <form class="space-y-4" @submit.prevent="submit">
                    @csrf

                    <!-- NAME & EMAIL -->
                    <div class="grid md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm text-gray-700 mb-2 font-medium">Your Name *</label>
                            <input name="name" placeholder="John Smith" type="text" x-model="form.name"
                                class="w-full border border-amber-200 rounded px-3 py-2 text-sm
                                       focus:outline-none focus:ring-1 focus:ring-amber-500 focus:border-transparent 
                                       transition-all duration-300"
                                :class="errors.name ? 'border-red-500' : ''">
                            <p x-show="errors.name" x-text="errors.name" 
                               class="text-red-500 text-xs mt-1"></p>
                        </div>

                        <div>
                            <label class="block text-sm text-gray-700 mb-2 font-medium">Your Email *</label>
                            <input name="email" placeholder="john@example.com" type="email" x-model="form.email"
                                class="w-full border border-amber-200 rounded px-3 py-2 text-sm
                                       focus:outline-none focus:ring-1 focus:ring-amber-500 focus:border-transparent 
                                       transition-all duration-300"
                                :class="errors.email ? 'border-red-500' : ''">
                            <p x-show="errors.email" x-text="errors.email" 
                               class="text-red-500 text-xs mt-1"></p>
                        </div>
                    </div>

                    <!-- SUBJECT -->
                    <div>
                        <label class="block text-sm text-gray-700 mb-2 font-medium">Subject *</label>
                        <select name="subject" x-model="form.subject"
                            class="w-full border border-amber-200 rounded px-3 py-2 text-sm bg-white
                                   focus:outline-none focus:ring-1 focus:ring-amber-500 focus:border-transparent 
                                   transition-all duration-300"
                            :class="errors.subject ? 'border-red-500' : ''">
                            <option value="" disabled selected>Select inquiry type</option>
                            <option value="Room Reservation">Room Reservation</option>
                            <option value="Package Inquiry">Package Inquiry</option>
                            <option value="General Inquiry">General Inquiry</option>
                        </select>
                    </div>

                    <!-- MESSAGE -->
                    <div>
                        <label class="block text-sm text-gray-700 mb-2 font-medium">Message *</label>
                        <textarea name="message" placeholder="Tell us about your requirements..." 
                                  rows="4" x-model="form.message"
                            class="w-full border border-amber-200 rounded px-3 py-2 text-sm
                                   focus:outline-none focus:ring-1 focus:ring-amber-500 focus:border-transparent 
                                   transition-all duration-300 resize-none"
                            :class="errors.message ? 'border-red-500' : ''"></textarea>
                    </div>

                    <!-- SUBMIT BUTTON -->
                    <button type="submit"
                        class="w-full bg-amber-800 text-white text-sm py-3 rounded font-semibold
                               hover:bg-amber-900 transition-all duration-300 disabled:opacity-50 disabled:cursor-not-allowed"
                        :disabled="loading"
                        x-text="loading ? 'Sending...' : 'Send Message'">
                    </button>
                </form>
            </div>
        </div>
    </div>
</section>
