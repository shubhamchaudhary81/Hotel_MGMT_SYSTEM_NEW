@extends('layouts.admin.app')
@section('title', ($appSetting->app_name ?? 'HMS') . ' | Settings')

@push('styles')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
@endpush

@section('contents')

    <div class="flex-1 overflow-auto p-4 md:p-6 bg-gray-50">

        {{-- HEADER --}}
        <div class="mb-6">
            <h2 class="text-2xl font-bold text-gray-800">Application Settings</h2>
            <p class="text-gray-600">Manage website settings, contact info & theme colors</p>
        </div>

        {{-- FORM CARD --}}
        <div class="bg-white shadow rounded-lg p-6">

            <form method="POST" enctype="multipart/form-data"
                action="{{ $setting ? route('admin.settings.update', $setting->id) : route('admin.settings.store') }}">
                @csrf
                @if($setting) @method('PUT') @endif


                {{-- ================= GENERAL SETTINGS ================= --}}
                <h3 class="text-lg font-semibold text-gray-700 mb-4">General Settings</h3>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">

                    {{-- APP NAME --}}
                    <div>
                        <label class="block text-sm font-medium text-gray-700">App Name</label>
                        <input type="text" name="app_name" value="{{ old('app_name', $setting->app_name ?? '') }}"
                            class="mt-1 block w-full border rounded-md px-3 py-2">
                    </div>

                    {{-- LOGO --}}
                    <div>
                        <label class="block text-sm font-medium text-gray-700">App Logo</label>
                        <input type="file" name="app_logo" class="mt-1 block w-full border rounded-md px-3 py-2">
                        @if(!empty($setting->app_logo))
                            <img src="{{ asset($setting->app_logo) }}" class="h-10 mt-2">
                        @endif
                    </div>

                    {{-- FAVICON --}}
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Favicon</label>
                        <input type="file" name="favicon" class="mt-1 block w-full border rounded-md px-3 py-2">
                        @if(!empty($setting->favicon))
                            <img src="{{ asset($setting->favicon) }}" class="h-6 mt-2">
                        @endif
                    </div>

                    {{-- META TITLE --}}
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Meta Title</label>
                        <input type="text" name="meta_title" value="{{ old('meta_title', $setting->meta_title ?? '') }}"
                            class="mt-1 block w-full border rounded-md px-3 py-2">
                    </div>

                    {{-- META DESCRIPTION --}}
                    <div class="md:col-span-2">
                        <label class="block text-sm font-medium text-gray-700">Meta Description</label>
                        <textarea name="meta_description" rows="3"
                            class="mt-1 block w-full border rounded-md px-3 py-2">{{ old('meta_description', $setting->meta_description ?? '') }}</textarea>
                    </div>

                </div>


                {{-- ================= CONTACT DETAILS ================= --}}
                <h3 class="text-lg font-semibold text-gray-700 mb-4">Contact Details</h3>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">

                    {{-- EMAIL --}}
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Contact Email</label>
                        <input type="email" name="contact_email"
                            value="{{ old('contact_email', $setting->contact_email ?? '') }}"
                            class="mt-1 block w-full border rounded-md px-3 py-2">
                    </div>

                    {{-- PHONE --}}
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Contact Phone</label>
                        <input type="text" name="contact_phone"
                            value="{{ old('contact_phone', $setting->contact_phone ?? '') }}"
                            class="mt-1 block w-full border rounded-md px-3 py-2">
                    </div>

                    {{-- ADDRESS --}}
                    <div class="md:col-span-2">
                        <label class="block text-sm font-medium text-gray-700">Address</label>
                        <input type="text" name="contact_address"
                            value="{{ old('contact_address', $setting->contact_address ?? '') }}"
                            class="mt-1 block w-full border rounded-md px-3 py-2">
                    </div>

                </div>


                {{-- ================= SOCIAL LINKS ================= --}}
                <h3 class="text-lg font-semibold text-gray-700 mb-2">Social Media</h3>
                <p class="text-sm text-gray-500 mb-4">Add links to your social profiles (optional)</p>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">

                    <input type="url" name="facebook_url" placeholder="Facebook URL"
                        value="{{ old('facebook_url', $setting->facebook_url ?? '') }}" class="border rounded-md px-3 py-2">

                    <input type="url" name="twitter_url" placeholder="Twitter URL"
                        value="{{ old('twitter_url', $setting->twitter_url ?? '') }}" class="border rounded-md px-3 py-2">

                    <input type="url" name="linkedin_url" placeholder="LinkedIn URL"
                        value="{{ old('linkedin_url', $setting->linkedin_url ?? '') }}" class="border rounded-md px-3 py-2">

                    <input type="url" name="instagram_url" placeholder="Instagram URL"
                        value="{{ old('instagram_url', $setting->instagram_url ?? '') }}"
                        class="border rounded-md px-3 py-2">

                </div>


                {{-- ================= THEME COLOR SETTINGS ================= --}}
                <h3 class="text-lg font-semibold text-gray-700 mb-4">Theme Colors</h3>

                <div class="flex flex-col gap-8">

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-10">

                        {{-- PRIMARY --}}
                        <div x-data="{ hex: '{{ old('primary_color', $setting->primary_color ?? '#6B4C2B') }}' }">
                            <label class="text-sm font-medium text-gray-700 mb-1">Primary Color</label>
                            <div class="flex items-center gap-3">
                                <input type="color" x-model="hex" name="primary_color"
                                    class="w-12 h-10 border rounded cursor-pointer">
                                <input type="text" x-model="hex" maxlength="7" class="border rounded px-3 py-2 w-28">
                            </div>
                        </div>

                        {{-- PRIMARY HOVER --}}
                        <div x-data="{ hex: '{{ old('primary_hover', $setting->primary_hover ?? '#5A3F20') }}' }">
                            <label class="text-sm font-medium text-gray-700 mb-1">Primary Hover</label>
                            <div class="flex items-center gap-3">
                                <input type="color" x-model="hex" name="primary_hover"
                                    class="w-12 h-10 border rounded cursor-pointer">
                                <input type="text" x-model="hex" maxlength="7" class="border rounded px-3 py-2 w-28">
                            </div>
                        </div>

                        {{-- ACCENT --}}
                        <div x-data="{ hex: '{{ old('accent_color', $setting->accent_color ?? '#2665CB') }}' }">
                            <label class="text-sm font-medium text-gray-700 mb-1">Accent Color</label>
                            <div class="flex items-center gap-3">
                                <input type="color" x-model="hex" name="accent_color"
                                    class="w-12 h-10 border rounded cursor-pointer">
                                <input type="text" x-model="hex" maxlength="7" class="border rounded px-3 py-2 w-28">
                            </div>
                        </div>

                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-10">

                        {{-- SIDEBAR ACTIVE BG --}}
                        <div x-data="{ hex: '{{ old('sidebar_active_bg', $setting->sidebar_active_bg ?? '#EFE7DF') }}' }">
                            <label class="text-sm font-medium text-gray-700 mb-1">Sidebar Active Background</label>
                            <div class="flex items-center gap-3">
                                <input type="color" x-model="hex" name="sidebar_active_bg"
                                    class="w-12 h-10 border rounded cursor-pointer">
                                <input type="text" x-model="hex" maxlength="7" class="border rounded px-3 py-2 w-28">
                            </div>
                        </div>

                        {{-- SIDEBAR HOVER BG --}}
                        <div x-data="{ hex: '{{ old('sidebar_hover_bg', $setting->sidebar_hover_bg ?? '#F5EFEA') }}' }">
                            <label class="text-sm font-medium text-gray-700 mb-1">Sidebar Hover Background</label>
                            <div class="flex items-center gap-3">
                                <input type="color" x-model="hex" name="sidebar_hover_bg"
                                    class="w-12 h-10 border rounded cursor-pointer">
                                <input type="text" x-model="hex" maxlength="7" class="border rounded px-3 py-2 w-28">
                            </div>
                        </div>

                        {{-- SIDEBAR ACTIVE TEXT --}}
                        <div
                            x-data="{ hex: '{{ old('sidebar_active_text', $setting->sidebar_active_text ?? '#6B4C2B') }}' }">
                            <label class="text-sm font-medium text-gray-700 mb-1">Sidebar Active Text</label>
                            <div class="flex items-center gap-3">
                                <input type="color" x-model="hex" name="sidebar_active_text"
                                    class="w-12 h-10 border rounded cursor-pointer">
                                <input type="text" x-model="hex" maxlength="7" class="border rounded px-3 py-2 w-28">
                            </div>
                        </div>

                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-10">

                        {{-- TABLE HEADER BG --}}
                        <div x-data="{ hex: '{{ old('table_header_bg', $setting->table_header_bg ?? '#f9f6f2') }}' }"
                            class="w-full md:w-1/3">
                            <label class="text-sm font-medium text-gray-700 mb-1">Table Header Background</label>
                            <div class="flex items-center gap-3">
                                <input type="color" x-model="hex" name="table_header_bg"
                                    class="w-12 h-10 border rounded cursor-pointer">
                                <input type="text" x-model="hex" maxlength="7" class="border rounded px-3 py-2 w-28">
                            </div>
                        </div>

                    </div>

                </div>


                {{-- ================= SAVE BUTTON ================= --}}
                <div class="flex justify-end">
                    <button type="submit" class="px-5 py-2 bg-indigo-600 text-white rounded hover:bg-indigo-700">
                        Save Settings
                    </button>
                </div>

            </form>
        </div>

    </div>
@endsection