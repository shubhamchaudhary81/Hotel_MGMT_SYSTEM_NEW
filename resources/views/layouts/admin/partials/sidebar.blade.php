<!-- Sidebar -->
<div class="hidden md:flex md:flex-shrink-0">
    <div class="flex flex-col w-64 bg-white border-r border-gray-200">

        <!-- Logo -->
        <div class="flex items-center justify-center h-16 px-4 bg-[#6B4C2B]">
            <a href="{{ route('admin.dashboard') }}"
               class="text-white font-bold text-xl hover:opacity-90">
                {{ $appSetting->app_name ?? 'Hotel Admin' }}
            </a>
        </div>

        <!-- Menu -->
        <div class="flex flex-col flex-grow px-4 py-4 overflow-y-auto">
            <div class="space-y-1">

                <!-- Dashboard -->
                <a href="{{ route('admin.dashboard') }}"
                   class="flex items-center px-2 py-3 text-sm font-medium rounded-md
                   {{ request()->routeIs('admin.dashboard')
                        ? 'bg-[#EFE7DF] text-[#6B4C2B]'
                        : 'text-gray-600 hover:bg-[#F5EFEA]' }}">
                    <i class="fas fa-tachometer-alt mr-3"></i>
                    Dashboard
                </a>

                <!-- Setups Dropdown -->
                <div x-data="{ open: false }"
                     x-init="open = {{ request()->routeIs(
                        'admin.room-types.*',
                        'admin.amenities.*',
                        'admin.extra-services.*',
                        'admin.room-services.*',
                        'admin.menu-items.*'
                     ) ? 'true' : 'false' }}">

                    <button @click="open = !open"
                        class="w-full flex items-center justify-between px-2 py-3 text-sm font-medium rounded-md
                        {{ request()->routeIs(
                            'admin.room-types.*',
                            'admin.amenities.*',
                            'admin.extra-services.*',
                            'admin.room-services.*',
                            'admin.menu-items.*'
                        )
                            ? 'bg-[#EFE7DF] text-[#6B4C2B]'
                            : 'text-gray-600 hover:bg-[#F5EFEA]' }}">

                        <div class="flex items-center">
                            <i class="fas fa-tools mr-3"></i>
                            Setups
                        </div>

                        <i :class="open ? 'fas fa-chevron-up' : 'fas fa-chevron-down'" class="text-xs"></i>
                    </button>

                    <div x-show="open" x-collapse.min.0 x-cloak class="ml-6 mt-2 space-y-1">

                        <a href="{{ route('admin.room-types.index') }}"
                           class="flex items-center px-2 py-2 text-sm rounded-md
                           {{ request()->routeIs('admin.room-types.*')
                                ? 'bg-[#EFE7DF] text-[#6B4C2B] font-medium'
                                : 'text-gray-600 hover:bg-[#F5EFEA]' }}">
                            <i class="fas fa-door-open mr-3 text-xs"></i>
                            Room Types
                        </a>

                        <a href="{{ route('admin.amenities.index') }}"
                           class="flex items-center px-2 py-2 text-sm rounded-md
                           {{ request()->routeIs('admin.amenities.*')
                                ? 'bg-[#EFE7DF] text-[#6B4C2B] font-medium'
                                : 'text-gray-600 hover:bg-[#F5EFEA]' }}">
                            <i class="fas fa-wifi mr-3 text-xs"></i>
                            Amenities
                        </a>

                        <a href="{{ route('admin.extra-services.index') }}"
                           class="flex items-center px-2 py-2 text-sm rounded-md
                           {{ request()->routeIs('admin.extra-services.*')
                                ? 'bg-[#EFE7DF] text-[#6B4C2B] font-medium'
                                : 'text-gray-600 hover:bg-[#F5EFEA]' }}">
                            <i class="fas fa-concierge-bell mr-3 text-xs"></i>
                            Extra Services
                        </a>

                        <a href="{{ route('admin.room-services.index') }}"
                           class="flex items-center px-2 py-2 text-sm rounded-md
                           {{ request()->routeIs('admin.room-services.*')
                                ? 'bg-[#EFE7DF] text-[#6B4C2B] font-medium'
                                : 'text-gray-600 hover:bg-[#F5EFEA]' }}">
                            <i class="fas fa-broom mr-3 text-xs"></i>
                            Room Services
                        </a>

                        <a href="{{ route('admin.menu-items.index') }}"
                           class="flex items-center px-2 py-2 text-sm rounded-md
                           {{ request()->routeIs('admin.menu-items.*')
                                ? 'bg-[#EFE7DF] text-[#6B4C2B] font-medium'
                                : 'text-gray-600 hover:bg-[#F5EFEA]' }}">
                            <i class="fas fa-utensils mr-3 text-xs"></i>
                            Menu Items
                        </a>
                    </div>
                </div>

                <!-- Administration -->
                <div class="pt-4 mt-4 border-t border-gray-200"
                     x-data="{ open: false }"
                     x-init="open = {{ request()->routeIs(
                        'admin.staff.*',
                        'admin.roles.*',
                        'admin.departments.*'
                     ) ? 'true' : 'false' }}">

                    <h3 class="px-3 text-xs font-semibold text-gray-500 uppercase tracking-wider">
                        Administration
                    </h3>

                    <button @click="open = !open"
                        class="w-full flex items-center justify-between px-2 py-3 text-sm font-medium rounded-md
                        {{ request()->routeIs(
                            'admin.staff.*',
                            'admin.roles.*',
                            'admin.departments.*'
                        )
                            ? 'bg-[#EFE7DF] text-[#6B4C2B]'
                            : 'text-gray-600 hover:bg-[#F5EFEA]' }}">
                        <span class="flex items-center">
                            <i class="fas fa-users mr-3"></i>
                            User Management
                        </span>
                        <i :class="open ? 'fas fa-chevron-up' : 'fas fa-chevron-down'" class="text-xs"></i>
                    </button>
                </div>

                <!-- Settings -->
                <a href="{{ route('admin.settings.index') }}"
                   class="flex items-center px-2 py-3 text-sm font-medium rounded-md
                   {{ request()->routeIs('admin.settings.*')
                        ? 'bg-[#EFE7DF] text-[#6B4C2B]'
                        : 'text-gray-600 hover:bg-[#F5EFEA]' }}">
                    <i class="fas fa-cog mr-3"></i>
                    Settings
                </a>

            </div>
        </div>

        <!-- User Footer -->
        @auth
        <div class="p-4 border-t border-gray-200 flex items-center justify-between">
            <div class="flex items-center space-x-3">
                <img class="w-10 h-10 rounded-full"
                     src="{{ auth()->user()->staff && auth()->user()->staff->profile_image
                        ? asset(auth()->user()->staff->profile_image)
                        : 'https://ui-avatars.com/api/?name=' . urlencode(auth()->user()->name) . '&background=6B4C2B&color=ffffff' }}">
                <div>
                    <p class="text-sm font-medium text-gray-700">
                        {{ auth()->user()->name }}
                    </p>
                    <p class="text-xs text-gray-500">
                        {{ auth()->user()->staff->role->name ?? 'N/A' }}
                    </p>
                </div>
            </div>

            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button class="text-gray-500 hover:text-red-600 transition">
                    <i class="fas fa-sign-out-alt"></i>
                </button>
            </form>
        </div>
        @endauth

    </div>
</div>
