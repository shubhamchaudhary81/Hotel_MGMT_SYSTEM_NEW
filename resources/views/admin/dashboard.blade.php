@extends('layouts.admin.app')

@section('title', ($appSetting->app_name ?? 'HMS') . ' | Dashboard')

@section('contents')

{{-- Page Heading --}}
<div class="mb-6">
    <h1 class="text-2xl font-semibold text-gray-800">Hotel Dashboard</h1>
    <p class="text-sm text-gray-500">Overview of hotel operations</p>
</div>

{{-- STAT CARDS --}}
<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">

    {{-- Total Rooms --}}
    <div class="bg-white rounded-xl shadow-sm p-5 border border-gray-100">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-sm text-gray-500">Total Rooms</p>
                <h2 class="text-2xl font-bold text-gray-800">45</h2>
            </div>
            <div class="w-12 h-12 flex items-center justify-center rounded-full bg-amber-100 text-amber-700">
                <i class="fas fa-bed"></i>
            </div>
        </div>
    </div>

    {{-- Booked Rooms --}}
    <div class="bg-white rounded-xl shadow-sm p-5 border border-gray-100">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-sm text-gray-500">Booked Rooms</p>
                <h2 class="text-2xl font-bold text-gray-800">18</h2>
            </div>
            <div class="w-12 h-12 flex items-center justify-center rounded-full bg-green-100 text-green-700">
                <i class="fas fa-calendar-check"></i>
            </div>
        </div>
    </div>

    {{-- Available Rooms --}}
    <div class="bg-white rounded-xl shadow-sm p-5 border border-gray-100">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-sm text-gray-500">Available Rooms</p>
                <h2 class="text-2xl font-bold text-gray-800">27</h2>
            </div>
            <div class="w-12 h-12 flex items-center justify-center rounded-full bg-blue-100 text-blue-700">
                <i class="fas fa-door-open"></i>
            </div>
        </div>
    </div>

    {{-- Total Guests --}}
    <div class="bg-white rounded-xl shadow-sm p-5 border border-gray-100">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-sm text-gray-500">Total Guests</p>
                <h2 class="text-2xl font-bold text-gray-800">62</h2>
            </div>
            <div class="w-12 h-12 flex items-center justify-center rounded-full bg-purple-100 text-purple-700">
                <i class="fas fa-users"></i>
            </div>
        </div>
    </div>

</div>

{{-- SECOND ROW --}}
<div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mt-8">

    {{-- Recent Bookings --}}
    <div class="bg-white rounded-xl shadow-sm border border-gray-100">
        <div class="p-5 border-b">
            <h3 class="text-lg font-semibold text-gray-700">Recent Bookings</h3>
        </div>

        <div class="divide-y">
            <div class="p-4 flex justify-between text-sm">
                <span class="text-gray-600">Room 101 - John Doe</span>
                <span class="text-green-600 font-medium">Checked In</span>
            </div>
            <div class="p-4 flex justify-between text-sm">
                <span class="text-gray-600">Room 203 - Alice Smith</span>
                <span class="text-yellow-600 font-medium">Reserved</span>
            </div>
            <div class="p-4 flex justify-between text-sm">
                <span class="text-gray-600">Room 305 - Mark Lee</span>
                <span class="text-red-600 font-medium">Checked Out</span>
            </div>
        </div>
    </div>

    {{-- Quick Actions --}}
    <div class="bg-white rounded-xl shadow-sm border border-gray-100">
        <div class="p-5 border-b">
            <h3 class="text-lg font-semibold text-gray-700">Quick Actions</h3>
        </div>

        <div class="p-5 grid grid-cols-2 gap-4">
            <a href="#" class="flex items-center gap-3 p-3 rounded-lg bg-gray-50 hover:bg-gray-100 transition">
                <i class="fas fa-plus-circle text-amber-700"></i>
                <span class="text-sm text-gray-700">Add Room</span>
            </a>

            <a href="#" class="flex items-center gap-3 p-3 rounded-lg bg-gray-50 hover:bg-gray-100 transition">
                <i class="fas fa-calendar-plus text-green-700"></i>
                <span class="text-sm text-gray-700">New Booking</span>
            </a>

            <a href="#" class="flex items-center gap-3 p-3 rounded-lg bg-gray-50 hover:bg-gray-100 transition">
                <i class="fas fa-users text-blue-700"></i>
                <span class="text-sm text-gray-700">Guests</span>
            </a>

            <a href="#" class="flex items-center gap-3 p-3 rounded-lg bg-gray-50 hover:bg-gray-100 transition">
                <i class="fas fa-file-invoice text-purple-700"></i>
                <span class="text-sm text-gray-700">Invoices</span>
            </a>
        </div>
    </div>

</div>

@endsection
