<nav x-data="{ open: false }" style="background: #181818 !important; color: #fff !important; border-color: #222 !important;">
    <style>
        nav[style] *,
        nav[style] {
            background: #181818 !important;
            color: #fff !important;
            border-color: #222 !important;
        }
        nav[style] .border-t,
        nav[style] .border-b,
        nav[style] .border-gray-100,
        nav[style] .border-gray-200,
        nav[style] .border-gray-600,
        nav[style] .border-gray-700 {
            border-color: #222 !important;
        }
        /* Quita el subrayado solo al enlace de Piston Rojo y dropdown */
        nav[style] .nav-no-underline,
        nav[style] .nav-no-underline:active,
        nav[style] .nav-no-underline:focus,
        nav[style] .nav-no-underline:hover {
            text-decoration: none !important;
            border-bottom: none !important;
            box-shadow: none !important;
        }
        /* Animaciones para botones y enlaces */
        nav[style] .nav-no-underline,
        nav[style] .dropdown-link,
        nav[style] button,
        nav[style] .inline-flex {
            transition: background 0.2s, color 0.2s, box-shadow 0.2s;
        }
        nav[style] .nav-no-underline:hover,
        nav[style] .dropdown-link:hover,
        nav[style] button:hover,
        nav[style] .inline-flex:hover {
            background: #242424 !important;
            color: #ff5252 !important;
            box-shadow: 0 2px 8px rgba(0,0,0,0.12);
        }
    </style>
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('dashboard') }}">
                        <x-application-logo class="block h-9 w-auto fill-current" style="color: #fff !important;" />
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden sm:flex" style="align-items: center;">
                    <div style="max-width: 160px; margin-left: 1rem; margin-right: 1rem; padding: 2px 10px; background: rgba(24,24,24,0.95); border-radius: 8px; display: flex; align-items: center; justify-content: center;">
                        <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')" class="nav-no-underline" style="font-size: 1.1rem; font-weight: bold; padding: 0;">
                            {{ __('Piston Rojo') }}
                        </x-nav-link>
                    </div>
                </div>
            </div>

            <!-- Settings Dropdown -->
            <div class="hidden sm:flex sm:items-center sm:ms-6">
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md" style="color: #fff !important; background: #181818 !important;">
                            <div>{{ Auth::user()->name }}</div>
                            <div class="ms-1">
                                <svg class="fill-current h-4 w-4" style="color: #fff !important;" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </div>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <x-dropdown-link :href="route('profile.edit')" class="nav-no-underline dropdown-link">
                            {{ __('Perfil') }}
                        </x-dropdown-link>
                        <!-- Authentication -->
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <x-dropdown-link :href="route('logout')" class="nav-no-underline dropdown-link"
                                    onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                {{ __('Cerrar sesion') }}
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>

            <!-- Hamburger -->
            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md" style="color: #fff !important; background: #181818 !important;">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                {{ __('Dashboard') }}
            </x-responsive-nav-link>
        </div>

        <!-- Responsive Settings Options -->
        <div class="pt-4 pb-1 border-t">
            <div class="px-4">
                <div class="font-medium text-base">{{ Auth::user()->name }}</div>
                <div class="font-medium text-sm">{{ Auth::user()->email }}</div>
            </div>

            <div class="mt-3 space-y-1">
                <x-responsive-nav-link :href="route('profile.edit')">
                    {{ __('Profile') }}
                </x-responsive-nav-link>
                <!-- Authentication -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <x-responsive-nav-link :href="route('logout')"
                            onclick="event.preventDefault();
                                        this.closest('form').submit();">
                        {{ __('Log Out') }}
                    </x-responsive-nav-link>
                </form>
            </div>
        </div>
    </div>
</nav>