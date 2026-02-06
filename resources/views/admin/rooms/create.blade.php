@extends('layouts.admin.app')
@section('title', ($appSetting->app_name ?? "HMS") . " | Add Room")

@section('contents')

<div
    x-data="{
        currentStep: 1,
        totalSteps: 3,
        previewImage: null,
        showAmenityModal: false,
        search: '',
        selectedAmenities: {},
        selectedAmenityNames: {},
        
        nextStep() {
            if (this.validateStep(this.currentStep)) {
                if (this.currentStep < this.totalSteps) {
                    this.currentStep++;
                    this.scrollToTop();
                }
            }
        },
        
        prevStep() {
            if (this.currentStep > 1) {
                this.currentStep--;
                this.scrollToTop();
            }
        },
        
        scrollToTop() {
            window.scrollTo({ top: 0, behavior: 'smooth' });
        },
        
        validateStep(step) {
            const form = document.getElementById('room-form');
            let isValid = true;
            
            if (step === 1) {
                const requiredFields = ['room_number', 'room_type_id', 'capacity', 'base_price'];
                for (const field of requiredFields) {
                    const input = form.querySelector(`[name='${field}']`);
                    if (input && !input.value.trim()) {
                        input.classList.add('border-red-500');
                        isValid = false;
                    } else if (input) {
                        input.classList.remove('border-red-500');
                    }
                }
            }
            
            return isValid;
        },

        toggleAmenity(id, name){
            if(this.selectedAmenities[id]) {
                delete this.selectedAmenities[id];
                delete this.selectedAmenityNames[id];
            } else {
                this.selectedAmenities[id] = 1;
                this.selectedAmenityNames[id] = name;
            }
        },
        
        removeAmenity(id) {
            delete this.selectedAmenities[id];
            delete this.selectedAmenityNames[id];
        },

        saveForm() {
            if (this.validateStep(this.currentStep)) {
                document.getElementById('room-form').submit();
            }
        }
    }"
    class="space-y-6"
>
    @php
        $selectedAmenities = old('amenities', []);
    @endphp

    {{-- BACKEND VALIDATION --}}
    @if($errors->any())
        <div class="bg-red-50 border-l-4 border-red-500 p-4 mb-6 rounded-lg shadow-sm">
            <div class="flex">
                <div class="flex-shrink-0">
                    <svg class="h-5 w-5 text-red-400" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
                    </svg>
                </div>
                <div class="ml-3">
                    <h3 class="text-sm font-medium text-red-800">Please fix the following errors:</h3>
                    <div class="mt-2 text-sm text-red-700">
                        <ul class="list-disc pl-5 space-y-1">
                            @foreach($errors->all() as $e)
                                <li>{{ $e }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    @endif

    {{-- MAIN CARD --}}
    <div class="bg-white max-w-7xl mx-auto rounded-2xl shadow-lg border border-gray-200 overflow-hidden">

        {{-- HEADER --}}
        <div class="flex justify-between items-center px-6 py-4 border-b">
            <h2 class="text-xl font-semibold text-gray-800">Add New Room</h2>

            <a href="{{ route('admin.rooms.index') }}" 
               class="px-4 py-2 rounded-lg shadow btn-primary text-sm flex items-center gap-2 transition-all duration-200 hover:shadow-md">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                </svg>
                Back to Rooms
            </a>
        </div>

        {{-- PROGRESS BAR --}}
        <div class="px-8 pt-6">
            <div class="mb-6">
                <div class="flex items-center justify-between mb-2">
                    <div class="text-sm font-medium text-gray-700">
                        Step <span x-text="currentStep"></span> of <span x-text="totalSteps"></span>
                    </div>
                    <div class="text-sm font-medium text-gray-700">
                        <span x-show="currentStep === 1">Basic Information</span>
                        <span x-show="currentStep === 2">Pricing Options</span>
                        <span x-show="currentStep === 3">Amenities & Media</span>
                    </div>
                </div>
                <div class="w-full bg-gray-200 rounded-full h-2.5">
                    <div class="h-2.5 rounded-full transition-all duration-500 ease-out" 
                         :style="'width: ' + (currentStep / totalSteps * 100) + '%'"
                         :class="currentStep === 1 ? 'bg-[#f5efea]' : currentStep === 2 ? 'bg-[#d4e6f1]' : 'bg-[#e8f5e9]'"></div>
                </div>
                <div class="flex justify-between mt-2 px-2">
                    <div class="text-center flex-1">
                        <div class="w-10 h-10 mx-auto rounded-full flex items-center justify-center mb-1 transition-all duration-300"
                             :class="currentStep >= 1 
                                ? 'bg-[#f5efea] border-2 border-[#f5efea] text-gray-800' 
                                : 'bg-white border-2 border-gray-300 text-gray-500'">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                            </svg>
                        </div>
                        <span class="text-xs font-medium" :class="currentStep === 1 ? 'text-gray-800' : 'text-gray-500'">Basic</span>
                    </div>
                    <div class="text-center flex-1">
                        <div class="w-10 h-10 mx-auto rounded-full flex items-center justify-center mb-1 transition-all duration-300"
                             :class="currentStep >= 2 
                                ? 'bg-[#d4e6f1] border-2 border-[#d4e6f1] text-gray-800' 
                                : 'bg-white border-2 border-gray-300 text-gray-500'">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                        </div>
                        <span class="text-xs font-medium" :class="currentStep === 2 ? 'text-gray-800' : 'text-gray-500'">Pricing</span>
                    </div>
                    <div class="text-center flex-1">
                        <div class="w-10 h-10 mx-auto rounded-full flex items-center justify-center mb-1 transition-all duration-300"
                             :class="currentStep >= 3 
                                ? 'bg-[#e8f5e9] border-2 border-[#e8f5e9] text-gray-800' 
                                : 'bg-white border-2 border-gray-300 text-gray-500'">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                            </svg>
                        </div>
                        <span class="text-xs font-medium" :class="currentStep === 3 ? 'text-gray-800' : 'text-gray-500'">Details</span>
                    </div>
                </div>
            </div>
        </div>

        {{-- FORM BODY --}}
        <div class="p-6">
            <form id="room-form" method="POST" action="{{ route('admin.rooms.store') }}" enctype="multipart/form-data">
                @csrf

                {{-- STEP 1: BASIC INFORMATION --}}
                <div x-show="currentStep === 1" x-transition class="space-y-6">
                    {{-- SECTION HEADER --}}
                    <div class="flex items-center gap-3 mb-4">
                        <div class="w-10 h-10 bg-[#f5efea] rounded-full flex items-center justify-center">
                            <svg class="w-5 h-5 text-gray-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-lg font-semibold text-gray-800">Basic Information</h3>
                            <p class="text-sm text-gray-600">Enter essential room details</p>
                        </div>
                    </div>

                    {{-- BASIC INFO GRID --}}
                    <div class="grid md:grid-cols-2 gap-4">
                        {{-- Room Number --}}
                        <div class="space-y-2">
                            <label class="block text-sm font-medium text-gray-700">
                                Room Number <span class="text-red-500">*</span>
                            </label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                                    </svg>
                                </div>
                                <input type="text" 
                                       name="room_number" 
                                       value="{{ old('room_number') }}" 
                                       class="pl-10 w-full border border-gray-300 rounded-lg px-4 py-3 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 focus:outline-none transition-all duration-200 bg-white"
                                       placeholder="Ex: 101"
                                       required>
                            </div>
                        </div>

                        {{-- Room Type --}}
                        <div class="space-y-2">
                            <label class="block text-sm font-medium text-gray-700">
                                Room Type <span class="text-red-500">*</span>
                            </label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                                    </svg>
                                </div>
                                <select name="room_type_id" 
                                        class="pl-10 w-full border border-gray-300 rounded-lg px-4 py-3 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 focus:outline-none transition-all duration-200 bg-white appearance-none"
                                        required>
                                    <option value="" disabled selected>Select room type</option>
                                    @foreach($roomTypes as $t)
                                        <option value="{{ $t->id }}" {{ old('room_type_id') == $t->id ? 'selected' : '' }}>
                                            {{ $t->name }}
                                        </option>
                                    @endforeach
                                </select>
                                <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                                    <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                                    </svg>
                                </div>
                            </div>
                        </div>

                        {{-- Capacity --}}
                        <div class="space-y-2">
                            <label class="block text-sm font-medium text-gray-700">
                                Capacity <span class="text-red-500">*</span>
                            </label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9.201a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0z"/>
                                    </svg>
                                </div>
                                <input type="number" 
                                       name="capacity" 
                                       class="pl-10 w-full border border-gray-300 rounded-lg px-4 py-3 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 focus:outline-none transition-all duration-200 bg-white"
                                       value="{{ old('capacity', 1) }}" 
                                       min="1"
                                       required>
                            </div>
                        </div>

                        {{-- Floor Number --}}
                        <div class="space-y-2">
                            <label class="block text-sm font-medium text-gray-700">Floor Number</label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                                    </svg>
                                </div>
                                <input type="number" 
                                       name="floor_number" 
                                       class="pl-10 w-full border border-gray-300 rounded-lg px-4 py-3 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 focus:outline-none transition-all duration-200 bg-white"
                                       value="{{ old('floor_number') }}"
                                       placeholder="Optional">
                            </div>
                        </div>

                        {{-- Base Price --}}
                        <div class="space-y-2">
                            <label class="block text-sm font-medium text-gray-700">
                                Base Price (Rs.) <span class="text-red-500">*</span>
                            </label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <span class="text-gray-500 font-medium">Rs.</span>
                                </div>
                                <input type="number" 
                                       step="0.01" 
                                       name="base_price" 
                                       class="pl-12 w-full border border-gray-300 rounded-lg px-4 py-3 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 focus:outline-none transition-all duration-200 bg-white"
                                       value="{{ old('base_price') }}"
                                       required>
                            </div>
                        </div>

                        {{-- Status --}}
                        <div class="space-y-2">
                            <label class="block text-sm font-medium text-gray-700">Status</label>
                            <select name="status" 
                                    class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 focus:outline-none transition-all duration-200 bg-white appearance-none">
                                <option value="available" {{ old('status', 'available') == 'available' ? 'selected' : '' }}>Available</option>
                                <option value="occupied" {{ old('status') == 'occupied' ? 'selected' : '' }}>Occupied</option>
                                <option value="out_of_order" {{ old('status') == 'out_of_order' ? 'selected' : '' }}>Out of Order</option>
                            </select>
                        </div>
                    </div>
                </div>

                {{-- STEP 2: PRICING OPTIONS --}}
                <div x-show="currentStep === 2" x-transition class="space-y-6">
                    {{-- SECTION HEADER --}}
                    <div class="flex items-center gap-3 mb-4">
                        <div class="w-10 h-10 bg-[#d4e6f1] rounded-full flex items-center justify-center">
                            <svg class="w-5 h-5 text-gray-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-lg font-semibold text-gray-800">Pricing Options</h3>
                            <p class="text-sm text-gray-600">Configure additional pricing settings</p>
                        </div>
                    </div>

                    {{-- PRICING GRID --}}
                    <div class="grid md:grid-cols-2 gap-6">
                        {{-- Weekend Price --}}
                        <div class="space-y-4">
                            <div class="space-y-2">
                                <label class="block text-sm font-medium text-gray-700">Weekend Price (Rs.)</label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <span class="text-gray-500 font-medium">Rs.</span>
                                    </div>
                                    <input type="number" 
                                           step="0.01" 
                                           name="weekend_price" 
                                           value="{{ old('weekend_price') }}" 
                                           class="pl-12 w-full border border-gray-300 rounded-lg px-4 py-3 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 focus:outline-none transition-all duration-200 bg-white">
                                </div>
                            </div>
                            
                            <label class="flex items-center gap-3 cursor-pointer group">
                                <div class="relative">
                                    <input type="checkbox" 
                                           name="use_weekend_price" 
                                           value="1" 
                                           {{ old('use_weekend_price') ? 'checked' : '' }}
                                           class="sr-only peer">
                                    <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-blue-600"></div>
                                </div>
                                <span class="text-sm font-medium text-gray-700">Use Weekend Price</span>
                            </label>
                        </div>

                        {{-- Seasonal Price --}}
                        <div class="space-y-4">
                            <div class="space-y-2">
                                <label class="block text-sm font-medium text-gray-700">Seasonal Price (Rs.)</label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <span class="text-gray-500 font-medium">Rs.</span>
                                    </div>
                                    <input type="number" 
                                           step="0.01" 
                                           name="seasonal_price" 
                                           value="{{ old('seasonal_price') }}" 
                                           class="pl-12 w-full border border-gray-300 rounded-lg px-4 py-3 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 focus:outline-none transition-all duration-200 bg-white">
                                </div>
                            </div>
                            
                            <label class="flex items-center gap-3 cursor-pointer group">
                                <div class="relative">
                                    <input type="checkbox" 
                                           name="use_seasonal_price" 
                                           value="1" 
                                           {{ old('use_seasonal_price') ? 'checked' : '' }}
                                           class="sr-only peer">
                                    <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-blue-600"></div>
                                </div>
                                <span class="text-sm font-medium text-gray-700">Use Seasonal Price</span>
                            </label>
                        </div>
                    </div>
                </div>

                {{-- STEP 3: AMENITIES & MEDIA --}}
                <div x-show="currentStep === 3" x-transition class="space-y-6">
                    {{-- SECTION HEADER --}}
                    <div class="flex items-center gap-3 mb-4">
                        <div class="w-10 h-10 bg-[#e8f5e9] rounded-full flex items-center justify-center">
                            <svg class="w-5 h-5 text-gray-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-lg font-semibold text-gray-800">Amenities & Media</h3>
                            <p class="text-sm text-gray-600">Add room features and images</p>
                        </div>
                    </div>

                    {{-- AMENITIES SECTION --}}
                    <div class="space-y-4">
                        <div class="flex justify-between items-center">
                            <div>
                                <h4 class="text-sm font-medium text-gray-700 mb-1">Room Amenities</h4>
                                <p class="text-xs text-gray-500">Selected: <span x-text="Object.keys(selectedAmenities).length" class="font-semibold"></span></p>
                            </div>

                            <button type="button" 
                                    @click="showAmenityModal = true" 
                                    class="px-4 py-2 bg-[#e8f5e9] text-gray-700 rounded-lg text-sm flex items-center gap-2 transition-all duration-200 hover:bg-[#d8e8d9] border border-[#c8e6c9]">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                                </svg>
                                Select Amenities
                            </button>
                        </div>

                        {{-- SELECTED AMENITIES --}}
                        <div class="min-h-[80px] border border-gray-300 rounded-lg p-3 bg-white">
                            <div class="flex flex-wrap gap-2" x-show="Object.keys(selectedAmenities).length > 0">
                                <template x-for="(qty,id) in selectedAmenities" :key="id">
                                    <span class="inline-flex items-center gap-1 bg-[#e8f5e9] text-gray-700 border border-[#c8e6c9] px-3 py-1.5 rounded-lg text-sm font-medium">
                                        <span x-text="selectedAmenityNames[id]"></span>
                                        <button type="button" 
                                                @click="removeAmenity(id)"
                                                class="text-gray-500 hover:text-gray-700 ml-1">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                            </svg>
                                        </button>
                                    </span>
                                </template>
                            </div>
                            <div x-show="Object.keys(selectedAmenities).length === 0" class="text-center py-4">
                                <svg class="w-10 h-10 text-gray-300 mx-auto mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/>
                                </svg>
                                <p class="text-sm text-gray-400">No amenities selected</p>
                            </div>
                        </div>
                    </div>

                    {{-- DESCRIPTION --}}
                    <div class="space-y-4">
                        <label class="block text-sm font-medium text-gray-700">Room Description</label>
                        <textarea name="description" 
                                  rows="3" 
                                  class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 focus:outline-none transition-all duration-200 bg-white resize-none"
                                  placeholder="Brief description of the room...">{{ old('description') }}</textarea>
                    </div>

                    {{-- IMAGE UPLOAD --}}
                    <div class="space-y-4">
                        <label class="block text-sm font-medium text-gray-700">Room Image</label>
                        <div class="space-y-3">
                            <div class="relative">
                                <input type="file" 
                                       accept="image/*" 
                                       name="image"
                                       @change="const file = $event.target.files[0]; if(file){ previewImage = URL.createObjectURL(file); }"
                                       class="hidden"
                                       id="image-upload">
                                <label for="image-upload" 
                                       class="cursor-pointer block border border-dashed border-gray-300 rounded-lg p-6 text-center hover:border-gray-400 hover:bg-gray-50 transition-all duration-200 bg-white">
                                    <svg class="w-10 h-10 text-gray-400 mx-auto mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                    </svg>
                                    <p class="text-sm font-medium text-gray-700 mb-1">Upload Room Image</p>
                                    <p class="text-xs text-gray-500">Click to browse files</p>
                                </label>
                            </div>

                            {{-- Preview --}}
                            <div x-show="previewImage" class="border border-gray-300 rounded-lg p-4 bg-white">
                                <p class="text-sm font-medium text-gray-700 mb-2">Preview:</p>
                                <img :src="previewImage" 
                                     class="w-40 h-40 object-cover rounded-lg mx-auto">
                            </div>
                        </div>
                    </div>

                    {{-- HIDDEN INPUTS FOR AMENITIES --}}
                    <template x-for="(qty,id) in selectedAmenities" :key="id">
                        <input type="hidden" :name="'amenities['+id+']'" :value="qty">
                    </template>
                </div>

                {{-- STEP NAVIGATION BUTTONS --}}
                <div class="flex justify-between pt-6 mt-6 border-t">
                    <div>
                        <button type="button" 
                                x-show="currentStep > 1"
                                @click="prevStep()"
                                class="px-5 py-2.5 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition-all duration-200 flex items-center gap-2 text-sm font-medium bg-white">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                            </svg>
                            Previous
                        </button>
                    </div>

                    <div class="flex gap-3">
                        <a href="{{ route('admin.rooms.index') }}" 
                           class="px-5 py-2.5 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition-all duration-200 flex items-center gap-2 text-sm font-medium bg-white">
                            Cancel
                        </a>

                        <button type="button" 
                                x-show="currentStep < totalSteps"
                                @click="nextStep()"
                                class="px-6 py-2.5 bg-gray-800 text-white rounded-lg hover:bg-gray-900 transition-all duration-200 flex items-center gap-2 text-sm font-medium">
                            Continue
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                            </svg>
                        </button>

                        <button type="button" 
                                x-show="currentStep === totalSteps"
                                id="saveBtn"
                                class="px-6 py-2.5  text-white rounded-lg hover:bg-[#45a049] transition-all duration-200 flex items-center gap-2 text-sm font-medium" style="background: var(--primary-color);">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                            </svg>
                            Save Room
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    {{-- AMENITY MODAL --}}
    <div x-show="showAmenityModal" 
         x-transition.opacity
         class="fixed inset-0 bg-black/50 flex items-center justify-center z-50 p-4">
        <div class="bg-white w-full max-w-md rounded-xl shadow-2xl overflow-hidden" @click.away="showAmenityModal = false">
            {{-- Modal Header --}}
            <div class="flex justify-between items-center px-5 py-4 border-b bg-gray-50">
                <div>
                    <h3 class="text-lg font-semibold text-gray-800">Select Amenities</h3>
                    <p class="text-sm text-gray-600 mt-1">Choose room features</p>
                </div>
                <button @click="showAmenityModal=false" 
                        class="p-2 rounded-lg hover:bg-gray-200 transition-colors">
                    <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>

            {{-- Modal Body --}}
            <div class="p-5 space-y-4">
                {{-- Search --}}
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                        </svg>
                    </div>
                    <input type="text" 
                           x-model="search" 
                           placeholder="Search amenities..." 
                           class="pl-10 w-full border border-gray-300 rounded-lg px-4 py-2.5 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 focus:outline-none transition-all duration-200 bg-white"
                           @keyup.escape="showAmenityModal=false">
                </div>

                {{-- Amenities List --}}
                <div class="max-h-80 overflow-y-auto">
                    <div class="space-y-2">
                        @foreach($amenities as $amenity)
                            <label
                                x-show="'{{ strtolower($amenity->name) }}'.includes(search.toLowerCase())"
                                class="flex items-center gap-3 p-3 border border-gray-300 rounded-lg cursor-pointer hover:bg-gray-50 transition-all duration-200 bg-white"
                                :class="{ 'bg-[#e8f5e9] border-[#f5efea]': selectedAmenities[{{ $amenity->id }}] !== undefined }"
                            >
                                <input
                                    type="checkbox"
                                    :checked="selectedAmenities[{{ $amenity->id }}] !== undefined"
                                    @change="toggleAmenity({{ $amenity->id }}, '{{ $amenity->name }}')"
                                    class="rounded border-gray-300 text-[#f5efea] focus:ring-[#f5efea] h-5 w-5"
                                >
                                <span class="flex-1 text-sm font-medium text-gray-700">{{ $amenity->name }}</span>
                            </label>
                        @endforeach
                    </div>
                </div>

                {{-- Selected Count --}}
                <div class="flex justify-between items-center pt-4 border-t">
                    <span class="text-sm text-gray-600">
                        <span x-text="Object.keys(selectedAmenities).length" class="font-semibold"></span> selected
                    </span>
                    <div class="flex gap-2">
                        <button @click="showAmenityModal=false" 
                                class="px-4 py-2 bg-[#f5efea] text-white rounded-lg hover:bg-[#45a049] transition-colors text-sm font-medium">
                            Done
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('alpine:init', () => {
    // Initialize selected amenities from old input
    @if(old('amenities'))
        @foreach(old('amenities') as $id => $qty)
            if (document.querySelector('[x-data]').__x.$data) {
                document.querySelector('[x-data]').__x.$data.selectedAmenities[{{ $id }}] = {{ $qty }};
                document.querySelector('[x-data]').__x.$data.selectedAmenityNames[{{ $id }}] = '{{ $amenities->firstWhere("id", $id)->name ?? "" }}';
            }
        @endforeach
    @endif
});

document.getElementById('saveBtn').addEventListener('click', function(){
    Swal.fire({
        title: "Save Room?",
        text: "Are you sure you want to create this new room?",
        icon: "question",
        showCancelButton: true,
        confirmButtonText: "Yes, Save Room",
        cancelButtonText: "Cancel",
        reverseButtons: true,
        customClass: {
            confirmButton: "swal-confirm-btn",
            cancelButton: "swal-cancel-btn"
        },
        buttonsStyling: false
    }).then(result => {
        if(result.isConfirmed){
            document.getElementById('room-form').submit();
        }
    });
});
</script>

@endsection