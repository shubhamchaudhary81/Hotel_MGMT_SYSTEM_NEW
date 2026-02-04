<!-- Sidebar -->
<div class="hidden md:flex md:flex-shrink-0">
    <div class="flex flex-col w-64 bg-white border-r border-gray-200">

        <!-- Logo -->
        <div class="flex items-center justify-center h-16 px-4"
             style="background: var(--primary-color);">
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
                        ? 'text-[var(--sidebar-active-text)]'
                        : 'text-gray-600' }}"
                   style="{{ request()->routeIs('admin.dashboard') ? 'background: var(--sidebar-active-bg)' : '' }}"
                   onmouseover="this.style.background='{{ request()->routeIs('admin.dashboard') ? 'var(--sidebar-active-bg)' : 'var(--sidebar-hover-bg)' }}'"
                   onmouseout="this.style.background='{{ request()->routeIs('admin.dashboard') ? 'var(--sidebar-active-bg)' : 'transparent' }}'">
                    <i class="fas fa-tachometer-alt mr-3"></i>
                    Dashboard
                </a>

                <!-- SETUPS DROPDOWN -->
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
                        ) ? 'text-[var(--sidebar-active-text)]' : 'text-gray-600' }}"
                        style="{{ request()->routeIs(
                            'admin.room-types.*',
                            'admin.amenities.*',
                            'admin.extra-services.*',
                            'admin.room-services.*',
                            'admin.menu-items.*'
                        ) ? 'background: var(--sidebar-active-bg)' : '' }}"
                        onmouseover="this.style.background='{{ request()->routeIs(
                            'admin.room-types.*',
                            'admin.amenities.*',
                            'admin.extra-services.*',
                            'admin.room-services.*',
                            'admin.menu-items.*'
                        ) ? 'var(--sidebar-active-bg)' : 'var(--sidebar-hover-bg)' }}'"
                        onmouseout="this.style.background='{{ request()->routeIs(
                            'admin.room-types.*',
                            'admin.amenities.*',
                            'admin.extra-services.*',
                            'admin.room-services.*',
                            'admin.menu-items.*'
                        ) ? 'var(--sidebar-active-bg)' : 'transparent' }}'">

                        <div class="flex items-center">
                            <i class="fas fa-tools mr-3"></i>
                            Setups
                        </div>

                        <i :class="open ? 'fas fa-chevron-up' : 'fas fa-chevron-down'" class="text-xs"></i>
                    </button>

                    <div x-show="open" x-collapse.min.0 x-cloak class="ml-6 mt-2 space-y-1">

                        <!-- ROOM TYPES -->
                        <a href="{{ route('admin.room-types.index') }}"
                           class="flex items-center px-2 py-2 text-sm rounded-md
                           {{ request()->routeIs('admin.room-types.*')
                                ? 'text-[var(--sidebar-active-text)] font-medium'
                                : 'text-gray-600' }}"
                           style="{{ request()->routeIs('admin.room-types.*') ? 'background: var(--sidebar-active-bg)' : '' }}"
                           onmouseover="this.style.background='{{ request()->routeIs('admin.room-types.*') ? 'var(--sidebar-active-bg)' : 'var(--sidebar-hover-bg)' }}'"
                           onmouseout="this.style.background='{{ request()->routeIs('admin.room-types.*') ? 'var(--sidebar-active-bg)' : 'transparent' }}'">
                            <i class="fas fa-door-open mr-3 text-xs"></i>
                            Room Types
                        </a>

                        <!-- Amenities -->
                        <a href="{{ route('admin.amenities.index') }}"
                           class="flex items-center px-2 py-2 text-sm rounded-md
                           {{ request()->routeIs('admin.amenities.*')
                                ? 'text-[var(--sidebar-active-text)] font-medium'
                                : 'text-gray-600' }}"
                           style="{{ request()->routeIs('admin.amenities.*') ? 'background: var(--sidebar-active-bg)' : '' }}"
                           onmouseover="this.style.background='{{ request()->routeIs('admin.amenities.*') ? 'var(--sidebar-active-bg)' : 'var(--sidebar-hover-bg)' }}'"
                           onmouseout="this.style.background='{{ request()->routeIs('admin.amenities.*') ? 'var(--sidebar-active-bg)' : 'transparent' }}'">
                            <i class="fas fa-wifi mr-3 text-xs"></i>
                            Amenities
                        </a>

                        <!-- Extra Services -->
                        <a href="{{ route('admin.extra-services.index') }}"
                           class="flex items-center px-2 py-2 text-sm rounded-md
                           {{ request()->routeIs('admin.extra-services.*')
                                ? 'text-[var(--sidebar-active-text)] font-medium'
                                : 'text-gray-600' }}"
                           style="{{ request()->routeIs('admin.extra-services.*') ? 'background: var(--sidebar-active-bg)' : '' }}"
                           onmouseover="this.style.background='{{ request()->routeIs('admin.extra-services.*') ? 'var(--sidebar-active-bg)' : 'var(--sidebar-hover-bg)' }}'"
                           onmouseout="this.style.background='{{ request()->routeIs('admin.extra-services.*') ? 'var(--sidebar-active-bg)' : 'transparent' }}'">
                            <i class="fas fa-concierge-bell mr-3 text-xs"></i>
                            Extra Services
                        </a>

                        <!-- Room Services -->
                        <a href="{{ route('admin.room-services.index') }}"
                           class="flex items-center px-2 py-2 text-sm rounded-md
                           {{ request()->routeIs('admin.room-services.*')
                                ? 'text-[var(--sidebar-active-text)] font-medium'
                                : 'text-gray-600' }}"
                           style="{{ request()->routeIs('admin.room-services.*') ? 'background: var(--sidebar-active-bg)' : '' }}"
                           onmouseover="this.style.background='{{ request()->routeIs('admin.room-services.*') ? 'var(--sidebar-active-bg)' : 'var(--sidebar-hover-bg)' }}'"
                           onmouseout="this.style.background='{{ request()->routeIs('admin.room-services.*') ? 'var(--sidebar-active-bg)' : 'transparent' }}'">
                            <i class="fas fa-broom mr-3 text-xs"></i>
                            Room Services
                        </a>

                        <!-- Menu -->
                        <a href="{{ route('admin.menu-items.index') }}"
                           class="flex items-center px-2 py-2 text-sm rounded-md
                           {{ request()->routeIs('admin.menu-items.*')
                                ? 'text-[var(--sidebar-active-text)] font-medium'
                                : 'text-gray-600' }}"
                           style="{{ request()->routeIs('admin.menu-items.*') ? 'background: var(--sidebar-active-bg)' : '' }}"
                           onmouseover="this.style.background='{{ request()->routeIs('admin.menu-items.*') ? 'var(--sidebar-active-bg)' : 'var(--sidebar-hover-bg)' }}'"
                           onmouseout="this.style.background='{{ request()->routeIs('admin.menu-items.*') ? 'var(--sidebar-active-bg)' : 'transparent' }}'">
                            <i class="fas fa-utensils mr-3 text-xs"></i>
                            Menu Items
                        </a>
                    </div>
                </div>

                <!-- ADMINISTRATION SECTION (GREY LINE + TITLE) -->
                <div class="pt-4 mt-4 border-t"
                     style="border-color: #e5e7eb;"> {{-- SAME GREY LINE --}}

                    <h3 class="px-3 text-xs font-semibold uppercase tracking-wider"
                        style="color: #6B7280;"> {{-- SAME GRAY COLOR --}}
                        Administration
                    </h3>

                    <!-- User Management -->
                    <div x-data="{ open: false }"
                         x-init="open = {{ request()->routeIs(
                            'admin.staff.*',
                            'admin.roles.*',
                            'admin.departments.*'
                         ) ? 'true' : 'false' }}">

                        <button @click="open = !open"
                            class="w-full flex items-center justify-between px-2 py-3 text-sm font-medium rounded-md
                            {{ request()->routeIs(
                                'admin.staff.*',
                                'admin.roles.*',
                                'admin.departments.*'
                            ) ? 'text-[var(--sidebar-active-text)]' : 'text-gray-600' }}"
                            style="{{ request()->routeIs(
                                'admin.staff.*',
                                'admin.roles.*',
                                'admin.departments.*'
                            ) ? 'background: var(--sidebar-active-bg)' : '' }}"
                            onmouseover="this.style.background='{{ request()->routeIs(
                                'admin.staff.*',
                                'admin.roles.*',
                                'admin.departments.*'
                            ) ? 'var(--sidebar-active-bg)' : 'var(--sidebar-hover-bg)' }}'"
                            onmouseout="this.style.background='{{ request()->routeIs(
                                'admin.staff.*',
                                'admin.roles.*',
                                'admin.departments.*'
                            ) ? 'var(--sidebar-active-bg)' : 'transparent' }}'">

                            <span class="flex items-center">
                                <i class="fas fa-users mr-3"></i>
                                User Management
                            </span>
                            <i :class="open ? 'fas fa-chevron-up' : 'fas fa-chevron-down'" class="text-xs"></i>
                        </button>
                    </div>
                </div>

                <!-- SETTINGS -->
                <a href="{{ route('admin.settings.index') }}"
                   class="flex items-center px-2 py-3 text-sm font-medium rounded-md
                   {{ request()->routeIs('admin.settings.*')
                        ? 'text-[var(--sidebar-active-text)]'
                        : 'text-gray-600' }}"
                   style="{{ request()->routeIs('admin.settings.*') ? 'background: var(--sidebar-active-bg)' : '' }}"
                   onmouseover="this.style.background='{{ request()->routeIs('admin.settings.*') ? 'var(--sidebar-active-bg)' : 'var(--sidebar-hover-bg)' }}'"
                   onmouseout="this.style.background='{{ request()->routeIs('admin.settings.*') ? 'var(--sidebar-active-bg)' : 'transparent' }}'">
                    <i class="fas fa-cog mr-3"></i>
                    Settings
                </a>

            </div>
        </div>

        <!-- FOOTER -->
        @auth
        <div class="p-4 border-t border-gray-200 flex items-center justify-between">

            <div class="flex items-center space-x-3">
                <img class="w-10 h-10 rounded-full"
                     src="{{ auth()->user()->staff && auth()->user()->staff->profile_image
                        ? asset(auth()->user()->staff->profile_image)
                        : 'https://ui-avatars.com/api/?name='.urlencode(auth()->user()->name).'&background=6B4C2B&color=ffffff' }}">

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
