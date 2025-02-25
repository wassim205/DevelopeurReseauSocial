<nav x-data="{ open: false, profileDropdown: false }" class="fixed top-0 w-full bg-gray-900 text-white z-50 border-b border-gray-700">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex items-center space-x-4">
                <!-- Logo -->
                <div class="text-2xl font-bold text-blue-400">
                    <a href="{{ route('dashboard') }}">&lt;DevConnect/&gt;</a>
                </div>

                <!-- Search bar - hidden on mobile -->
                <div class="relative hidden md:block">
                    <input type="text"
                           placeholder="Search developers, posts, or #tags"
                           class="bg-gray-800 pl-10 pr-4 py-2 rounded-lg w-64 lg:w-96 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:bg-gray-700 transition-all duration-200"
                    >
                    <svg class="w-5 h-5 text-gray-400 absolute left-3 top-2.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                    </svg>
                </div>

                <!-- Navigation Links - hidden on mobile -->
                <div class="hidden md:flex space-x-4">
                    <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')" class="text-gray-300 hover:text-blue-400">
                        {{ __('Dashboard') }}
                    </x-nav-link>
                    <x-nav-link :href="route('profileView')" :active="request()->routeIs('profileView')" class="text-gray-300 hover:text-blue-400">
                        {{ __('Profile') }}
                    </x-nav-link>
                </div>
            </div>

            <!-- Icons and Settings Dropdown -->
            <div class="flex items-center space-x-4">
                <!-- Navigation Icons - hidden on mobile -->
                <div class="hidden md:flex items-center space-x-6">
                    <a href="#" class="flex items-center space-x-1 hover:text-blue-400">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                        </svg>
                    </a>
                    <a href="#" class="flex items-center space-x-1 hover:text-blue-400">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z"/>
                        </svg>
                        <span class="bg-blue-500 rounded-full w-2 h-2"></span>
                    </a>
                    <a href="#" class="flex items-center space-x-1 hover:text-blue-400">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/>
                        </svg>
                        <span class="bg-red-500 rounded-full w-2 h-2"></span>
                    </a>
                </div>

                <!-- Profile Dropdown -->
                <div class="relative" x-data="{ open: false }">
                    <button @click="open = !open" class="flex items-center focus:outline-none">
                        <div class="h-8 w-8 rounded-full overflow-hidden">
                            <img src="https://avatar.iran.liara.run/public/boy" alt="{{ Auth::user()->name }}" class="w-full h-full object-cover"/>
                        </div>
                        <div class="ms-1 hidden md:block">
                            <svg class="fill-current h-4 w-4 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                            </svg>
                        </div>
                    </button>

                    <div x-show="open" 
                         @click.away="open = false"
                         class="absolute right-0 mt-2 w-48 py-2 bg-gray-800 rounded-md shadow-lg z-50"
                         x-transition:enter="transition ease-out duration-100"
                         x-transition:enter-start="transform opacity-0 scale-95"
                         x-transition:enter-end="transform opacity-100 scale-100"
                         x-transition:leave="transition ease-in duration-75"
                         x-transition:leave-start="transform opacity-100 scale-100"
                         x-transition:leave-end="transform opacity-0 scale-95">
                        
                        <div class="px-4 py-2 border-b border-gray-700">
                            <div class="font-medium text-base text-gray-200">{{ Auth::user()->name }}</div>
                            <div class="font-medium text-sm text-gray-400">{{ Auth::user()->email }}</div>
                        </div>

                        <x-dropdown-link :href="route('profile.edit')" class="block px-4 py-2 text-gray-200 hover:bg-gray-700">
                            {{ __('Edit Profile') }}
                        </x-dropdown-link>

                        <!-- Authentication -->
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <x-dropdown-link :href="route('logout')"
                                    onclick="event.preventDefault(); this.closest('form').submit();"
                                    class="block px-4 py-2 text-gray-200 hover:bg-gray-700">
                                {{ __('Log Out') }}
                            </x-dropdown-link>
                        </form>
                    </div>
                </div>

                <!-- Hamburger -->
                <div class="md:hidden flex items-center">
                    <button @click="open = !open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-blue-400 hover:bg-gray-700 focus:outline-none focus:bg-gray-700 focus:text-blue-400 transition duration-150 ease-in-out">
                        <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                            <path :class="{'hidden': open, 'inline-flex': !open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                            <path :class="{'hidden': !open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': !open}" class="hidden md:hidden">
        <!-- Search bar for mobile -->
        <div class="px-4 pt-2 pb-3">
            <div class="relative">
                <input type="text"
                       placeholder="Search developers, posts, or #tags"
                       class="bg-gray-800 pl-10 pr-4 py-2 rounded-lg w-full text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:bg-gray-700 transition-all duration-200"
                >
                <svg class="w-5 h-5 text-gray-400 absolute left-3 top-2.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                </svg>
            </div>
        </div>
        
        <!-- Mobile navigation links -->
        <div class="pt-2 pb-3 space-y-1">
            
            
            <!-- Mobile Navigation Icons -->
            <div class="flex justify-around py-4 border-t border-b border-gray-700">
                <a href="dashboard" class="flex flex-col items-center space-y-1 hover:text-blue-400">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                    </svg>
                    <span class="text-xs">Home</span>
                </a>
                <a href="#" class="flex flex-col items-center space-y-1 hover:text-blue-400 relative">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z"/>
                    </svg>
                    <span class="text-xs">Messages</span>
                    <span class="absolute top-0 right-0 bg-blue-500 rounded-full w-2 h-2"></span>
                </a>
                <a href="#" class="flex flex-col items-center space-y-1 hover:text-blue-400 relative">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/>
                    </svg>
                    <span class="text-xs">Notifications</span>
                    <span class="absolute top-0 right-0 bg-red-500 rounded-full w-2 h-2"></span>
                </a>
            </div>
        </div>

        <!-- Mobile Settings Options -->
        <div class="pt-4 pb-1 border-t border-gray-700">
            <div class="px-4">
                <div class="font-medium text-base text-gray-200">{{ Auth::user()->name }}</div>
                <div class="font-medium text-sm text-gray-400">{{ Auth::user()->email }}</div>
            </div>

            <div class="mt-3 space-y-1">
                <x-responsive-nav-link :href="route('profileView')" :active="request()->routeIs('profileView')" class="block pl-3 pr-4 py-2 text-base font-medium text-gray-200 hover:bg-gray-700">
                    {{ __('View Your Profile') }}
                </x-responsive-nav-link>
                <x-responsive-nav-link :href="route('profile.edit')" class="block pl-3 pr-4 py-2 text-base font-medium text-gray-200 hover:bg-gray-700">
                    {{ __('Edit Profile') }}
                </x-responsive-nav-link>

                <!-- Authentication -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <x-responsive-nav-link :href="route('logout')"
                            onclick="event.preventDefault(); this.closest('form').submit();"
                            class="block pl-3 pr-4 py-2 text-base font-medium text-gray-200 hover:bg-gray-700">
                        {{ __('Log Out') }}
                    </x-responsive-nav-link>
                </form>
            </div>
        </div>
    </div>
</nav>