<!-- Sidebar -->
<div class="flex md:flex-shrink-0 h-screen">
    <div class="flex flex-col w-64 bg-white border-r border-gray-200">

        <!-- Logo -->
        <div class="flex items-center justify-center h-16 px-4 bg-[#6B4C2B]">
            <a href="{{ route('admin.dashboard') }}" class="text-white font-bold text-xl hover:opacity-90">
                {{ $appSetting->app_name ?? 'Hotel Admin' }}
            </a>
        </div>

        <!-- Menu -->
        <div class="flex flex-col flex-grow px-4 py-4 overflow-y-auto">
            <div class="space-y-1">

                <!-- Dashboard -->
                <a href="{{ route('admin.dashboard') }}"
                   class="flex items-center px-2 py-3 text-sm font-medium rounded-md
                   {{ request()->routeIs('admin.dashboard') ? 'bg-[#6B4C2B] text-white' : 'text-gray-700 hover:bg-[#6B4C2B] hover:text-white transition' }}">
                    <i class="fas fa-tachometer-alt mr-3"></i>
                    Dashboard
                </a>

                <!-- User Management Section -->
                <div class="pt-4 mt-4 border-t border-gray-200"
                     x-data="{ open: false }"
                     x-init="open = {{ request()->routeIs('admin.staff.*') || request()->routeIs('admin.roles.*') || request()->routeIs('admin.departments.*') ? 'true' : 'false' }}">
                    
                    <h3 class="px-3 text-xs font-semibold text-gray-500 uppercase tracking-wider">
                        Administration
                    </h3>

                    <button @click="open = !open"
                        class="w-full flex items-center justify-between px-2 py-3 text-sm font-medium rounded-md
                        {{ request()->routeIs('admin.staff.*') || request()->routeIs('admin.roles.*') || request()->routeIs('admin.departments.*') ? 'bg-[#6B4C2B] text-white' : 'text-gray-700 hover:bg-[#6B4C2B] hover:text-white transition' }}">
                        <div class="flex items-center">
                            <i class="fas fa-users mr-3"></i>
                            User Management
                        </div>
                        <i :class="open ? 'fas fa-chevron-up' : 'fas fa-chevron-down'" class="text-xs"></i>
                    </button>

                    <div x-show="open" x-cloak class="ml-6 mt-2 space-y-1">
                        <a href="#"
                           class="flex items-center px-2 py-2 text-sm rounded-md
                           {{ request()->routeIs('admin.staff.*') ? 'bg-[#6B4C2B] text-white font-medium' : 'text-gray-700 hover:bg-[#6B4C2B] hover:text-white transition' }}">
                            <i class="fas fa-user mr-3 text-xs"></i>
                            Staff
                        </a>

                        <a href="#"
                           class="flex items-center px-2 py-2 text-sm rounded-md
                           {{ request()->routeIs('admin.roles.*') ? 'bg-[#6B4C2B] text-white font-medium' : 'text-gray-700 hover:bg-[#6B4C2B] hover:text-white transition' }}">
                            <i class="fas fa-user-tag mr-3 text-xs"></i>
                            Roles
                        </a>

                        <a href="#"
                           class="flex items-center px-2 py-2 text-sm rounded-md
                           {{ request()->routeIs('admin.departments.*') ? 'bg-[#6B4C2B] text-white font-medium' : 'text-gray-700 hover:bg-[#6B4C2B] hover:text-white transition' }}">
                            <i class="fas fa-building mr-3 text-xs"></i>
                            Departments
                        </a>
                    </div>
                </div>

                <!-- Settings -->
                <a href="#"
                   class="flex items-center px-2 py-3 text-sm font-medium rounded-md
                   {{ request()->routeIs('admin.settings.*') ? 'bg-[#6B4C2B] text-white' : 'text-gray-700 hover:bg-[#6B4C2B] hover:text-white transition' }}">
                    <i class="fas fa-cog mr-3"></i>
                    Settings
                </a>

            </div>
        </div>

        <!-- User Footer -->
        @auth
            <div class="p-4 border-t border-gray-200 flex items-center justify-between">
                <div class="flex items-center space-x-3">
                    <a href="#">
                        <img class="w-10 h-10 rounded-full cursor-pointer hover:opacity-80 transition"
                             src="{{ auth()->user()->staff && auth()->user()->staff->profile_image
                                ? asset(auth()->user()->staff->profile_image)
                                : 'https://ui-avatars.com/api/?name=' . urlencode(auth()->user()->name) . '&background=6B4C2B&color=ffffff' }}"
                             alt="{{ auth()->user()->name }}">
                    </a>

                    <div class="flex flex-col">
                        <span class="text-sm font-medium text-gray-700">{{ auth()->user()->name }}</span>
                        <span class="text-xs text-gray-500">
                            {{ auth()->user()->staff->role->name ?? 'N/A' }}
                        </span>
                    </div>
                </div>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="text-gray-500 hover:text-red-600 transition" title="Logout">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                             stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a2 2 0 01-2 2H5a2 2 0 01-2-2V7a2 2 0 012-2h6a2 2 0 012 2v1" />
                        </svg>
                    </button>
                </form>
            </div>
        @endauth

    </div>
</div>
