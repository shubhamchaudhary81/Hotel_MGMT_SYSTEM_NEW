<div x-data="{
    openQuick: false,
    openNotif: false,
    time: '',
    greeting: '',
    day: '',
    date: '',

    init() {
        this.updateTime();
        setInterval(() => this.updateTime(), 1000);
    },

    updateTime() {
        const now = new Date();

        const hours = now.getHours();
        if(hours < 12) this.greeting = 'Good Morning';
        else if(hours < 17) this.greeting = 'Good Afternoon';
        else this.greeting = 'Good Evening';

        this.time = now.toLocaleTimeString([], {
            hour: 'numeric',
            minute: '2-digit',
            hour12: true
        });

        this.day = now.toLocaleDateString([], { weekday: 'long' });
        this.date = now.toLocaleDateString([], { month: 'long', day: '2-digit', year: 'numeric' });
    }
}" class="flex items-center justify-between h-16 px-6 bg-white border-b border-gray-200 shadow-sm">

    {{-- LEFT SIDE --}}
    <div class="flex items-center gap-4">
        <button class="text-gray-600 focus:outline-none md:hidden">
            <i class="fas fa-bars text-lg"></i>
        </button>

        <div class="flex flex-col">
            <!-- <h1 class="text-lg font-semibold text-gray-700">@yield('title')</h1> -->
            <span class="text-xs text-gray-400" x-text="greeting + ', {{ auth()->user()->name }}'"></span>
        </div>
    </div>

    {{-- RIGHT SIDE --}}
    <div class="flex items-center space-x-4 relative">

    {{-- DATE & TIME --}}
    <div class="hidden md:flex flex-col items-end text-end mr-4">
        <span class="text-xs text-gray-500" x-text="day"></span>
        <span class="text-sm font-medium text-gray-700" x-text="date + ' | ' + time"></span>
    </div>

        {{-- NOTIFICATIONS --}}
        <div class="relative">
            <button @click="openNotif = !openNotif" @click.outside="openNotif = false"
                class="relative p-2 text-gray-500 hover:bg-gray-100 rounded-full transition">
                <i class="fas fa-bell"></i>
                <span class="absolute top-0 right-0 inline-flex items-center justify-center px-1.5 py-0.5 text-xs font-bold leading-none text-white bg-red-600 rounded-full">3</span>
            </button>

            <div x-show="openNotif" x-transition x-cloak
                class="absolute right-0 mt-2 w-64 bg-white border border-gray-200 rounded-md shadow-lg overflow-hidden z-50">
                <div class="p-2 font-semibold text-gray-600 border-b">Notifications</div>
                <a href="#" class="block px-4 py-2 text-sm text-gray-600 hover:bg-gray-100">New staff added</a>
                <a href="#" class="block px-4 py-2 text-sm text-gray-600 hover:bg-gray-100">Project deadline approaching</a>
                <a href="#" class="block px-4 py-2 text-sm text-gray-600 hover:bg-gray-100">Server rebooted</a>
            </div>
        </div>

        {{-- QUICK ACTIONS --}}
        <div class="relative">
            <button @click="openQuick = !openQuick" @click.outside="openQuick = false"
                class="flex items-center text-sm text-gray-500 focus:outline-none">
                <span class="hidden md:inline-block">Quick Actions</span>
                <i class="ml-1 fas fa-chevron-down transition-transform duration-200" :class="{'rotate-180': openQuick}"></i>
            </button>

            <div x-show="openQuick" x-transition x-cloak
                class="absolute right-0 mt-2 w-44 bg-white border border-gray-200 rounded-md shadow-lg overflow-hidden z-50">
                <a href="#" class="block px-4 py-2 text-sm text-gray-600 hover:bg-gray-100">
                    <i class="fas fa-user mr-2"></i> Profile
                </a>

                <a href="#" class="block px-4 py-2 text-sm text-gray-600 hover:bg-gray-100">
                    <i class="fas fa-cog mr-2"></i> Settings
                </a>

                <div class="border-t"></div>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="w-full text-left px-4 py-2 text-sm text-red-600 hover:bg-red-50">
                        <i class="fas fa-sign-out-alt mr-2"></i> Logout
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
