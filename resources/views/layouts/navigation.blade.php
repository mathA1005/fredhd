<nav x-data="{ open: false }" class="bg-white border-b ">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-28"> <!-- Augmenté la hauteur à 28 pour plus de largeur -->
            <div class="flex">
                <!-- Logo -->
                <a class="flex-none rounded-xl text-xl inline-block font-semibold focus:outline-none focus:opacity-80"
                   href="{{ url('/') }}" aria-label="logo fred">
                    <img src="{{ asset('storage/picture/fred.png') }}" alt="Admin" class="inline-block h-28 w-28 mr-2"> <!-- Taille du logo ajustée -->
                </a>
                <!-- End Logo -->

                <!-- Navigation Links -->
                <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                    <x-nav-link :href="route('home.index')" :active="request()->routeIs('home.index')">
                        {{ __('Accueil') }}
                    </x-nav-link>
                    <x-nav-link :href="route('rooms.index')" :active="request()->routeIs('rooms.index')">
                        {{ __('Chambres') }}
                    </x-nav-link>
                    <x-nav-link :href="route('about.index')" :active="request()->routeIs('about.index')">
                        {{ __('A propos') }}
                    </x-nav-link>
                    <x-nav-link :href="route('contact.index')" :active="request()->routeIs('contact.index')">
                        {{ __('Contact') }}
                    </x-nav-link>
                    <x-nav-link :href="route('faqs.index')" :active="request()->routeIs('faqs.index')">
                        {{ __('Faqs') }}
                    </x-nav-link>
                    @if(auth()->check())
                        <x-nav-link :href="route('reviews.index')" :active="request()->routeIs('reviews.index')">
                            {{ __('Avis') }}
                        </x-nav-link>
                    @endif
                </div>
            </div>

            <!-- Button Group -->
            @if(!auth()->check())
                <div class="hidden sm:flex sm:items-center sm:ms-6">
                    <a href="{{ route('login') }}" class="py-2 px-3 inline-flex items-center gap-x-2 text-sm font-medium rounded-xl border border-gray-200 text-black hover:bg-gray-100 dark:border-neutral-700 dark:hover:bg-white/10 dark:text-neutral-800 dark:hover:text-neutral-600">
                        {{ __('Sign in') }}
                    </a>
                    <a href="{{ route('register') }}" class="py-2 px-3 inline-flex items-center gap-x-2 text-sm font-medium rounded-xl border border-transparent bg-customGreen text-white hover:bg-customGreen transition focus:outline-none focus:bg-customGreen">
                        {{ __('Register') }}
                    </a>
                </div>
            @else
                <div class="hidden sm:flex sm:items-center sm:ms-6">
                    <x-dropdown align="right" width="48">
                        <x-slot name="trigger">
                            <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 dark:text-gray-400 bg-white dark:bg-gray-800 hover:text-gray-700 dark:hover:text-gray-300 focus:outline-none transition ease-in-out duration-150">
                                {{ Auth::user()->name }}
                                <div class="ms-1">
                                    <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 1 111.414 1.414l-4 4a 1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                            </button>
                        </x-slot>

                        <x-slot name="content">
                            <x-dropdown-link :href="route('profile.edit')">
                                {{ __('Profile') }}
                            </x-dropdown-link>

                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <x-dropdown-link :href="route('logout')"
                                                 onclick="event.preventDefault();
                                                    this.closest('form').submit();">
                                    {{ __('Log Out') }}
                                </x-dropdown-link>
                            </form>
                        </x-slot>
                    </x-dropdown>
                </div>
                @if(auth()->check() && auth()->user()->role->name === \App\Models\Role::ADMIN)
                    <div class="flex items-center gap-x-2 ms-auto py-1 md:ps-6 md:order-3 md:col-span-3">
                        <a href="{{ route('admin.index') }}" type="button"
                           class="py-2 px-3 inline-flex items-center gap-x-2 text-sm font-medium rounded-xl border border-gray-200 text-black hover:bg-gray-100 disabled:opacity-50 disabled:pointer-events-none dark:border-neutral-700 dark:hover:bg-white/10 dark:text-neutral-800 dark:hover:text-neutral-600">
                            Dashboard Admin
                        </a>
                    </div>
            @endif
        @endif

        <!-- Hamburger -->
            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 dark:text-gray-500 hover:text-gray-500 dark:hover:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-900 focus:outline-none focus:bg-gray-100 dark:focus:bg-gray-900 focus:text-gray-500 dark:focus:text-gray-400 transition duration-150 ease-in-out">
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
            <x-responsive-nav-link :href="route('home.index')" :active="request()->routeIs('home.index')">
                {{ __('Accueil') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('rooms.index')" :active="request()->routeIs('rooms.index')">
                {{ __('Chambres') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('about.index')" :active="request()->routeIs('about.index')">
                {{ __('A propos') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('contact.index')" :active="request()->routeIs('contact.index')">
                {{ __('Contact') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('faqs.index')" :active="request()->routeIs('faqs.index')">
                {{ __('Faqs') }}
            </x-responsive-nav-link>
            @if(auth()->check())
                <x-responsive-nav-link :href="route('reviews.index')" :active="request()->routeIs('reviews.index')">
                    {{ __('Avis') }}
                </x-responsive-nav-link>
            @endif
        </div>

    @if(auth()->check())
        <!-- Responsive Settings Options -->
            <div class="pt-4 pb-1 border-t border-gray-200 dark:border-gray-600">
                <div class="px-4">
                    <div class="font-medium text-base text-gray-800 dark:text-gray-200">{{ Auth::user()->name }}</div>
                    <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
                </div>

                <div class="mt-3 space-y-1">
                    <x-responsive-nav-link :href="route('profile.edit')">
                        {{ __('Profile') }}
                    </x-responsive-nav-link>

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
        @endif
    </div>
</nav>
