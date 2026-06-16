<nav x-data="{ open: false }" class="sticky top-0 z-50 border-b border-[#dbe8f5]/80 bg-white/90 backdrop-blur-xl">
    <div class="lumiere-container">
        <div class="flex h-[76px] items-center justify-between gap-8">

            <div class="flex items-center gap-10">
                <a href="{{ route('home') }}" class="relative font-['Playfair_Display'] text-4xl font-bold tracking-[-0.7px] text-[#233a5e]">
                    Lumiere
                    <span class="absolute -right-5 -top-1 text-sm text-[#f6b93b]">✦</span>
                </a>

                <div class="hidden items-center gap-9 text-[15px] font-semibold lg:flex">
                    <a href="{{ route('home') }}"
                       class="{{ request()->routeIs('home') ? 'text-[#2f80ed]' : 'text-[#1f2a44]' }} hover:text-[#2f80ed]">
                        Home
                    </a>

                    <a href="{{ route('customer.salons.index') }}"
                       class="{{ request()->routeIs('customer.salons.*') ? 'text-[#2f80ed]' : 'text-[#1f2a44]' }} hover:text-[#2f80ed]">
                        Salons
                    </a>

                    @auth
                        @if (auth()->user()->role === 'customer')
                            <a href="{{ route('customer.bookings.index') }}"
                               class="{{ request()->routeIs('customer.bookings.*') ? 'text-[#2f80ed]' : 'text-[#1f2a44]' }} hover:text-[#2f80ed]">
                                My Booking
                            </a>
                        @endif

                        @if (auth()->user()->role === 'owner')
                            <a href="{{ route('owner.dashboard') }}"
                            class="{{ request()->routeIs('owner.dashboard') ? 'text-[#2f80ed]' : 'text-[#1f2a44]' }} hover:text-[#2f80ed]">
                                Partner Dashboard
                            </a>

                            <a href="{{ route('owner.salons.index') }}"
                            class="{{ request()->routeIs('owner.salons.*') ? 'text-[#2f80ed]' : 'text-[#1f2a44]' }} hover:text-[#2f80ed]">
                                My Salons
                            </a>

                            <a href="{{ route('owner.bookings.index') }}"
                            class="{{ request()->routeIs('owner.bookings.*') ? 'text-[#2f80ed]' : 'text-[#1f2a44]' }} hover:text-[#2f80ed]">
                                Bookings
                            </a>
                        @endif

                        @if (auth()->user()->role === 'admin')
                            <a href="{{ route('admin.dashboard') }}"
                               class="{{ request()->routeIs('admin.dashboard') ? 'text-[#2f80ed]' : 'text-[#1f2a44]' }} hover:text-[#2f80ed]">
                                Admin
                            </a>

                            <a href="{{ route('admin.categories.index') }}"
                            class="{{ request()->routeIs('admin.categories.*') ? 'text-[#2f80ed]' : 'text-[#1f2a44]' }} hover:text-[#2f80ed]">
                                Categories
                            </a>

                            <a href="{{ route('admin.users.index') }}"
                            class="{{ request()->routeIs('admin.users.*') ? 'text-[#2f80ed]' : 'text-[#1f2a44]' }} hover:text-[#2f80ed]">
                                Users
                            </a>
                        @endif
                    @endauth
                </div>
            </div>

            <div class="hidden items-center gap-3 lg:flex">
                @auth
                    <a href="{{ route('account.index') }}" class="lumiere-btn-outline">
                        {{ auth()->user()->name }}
                    </a>

                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button class="lumiere-btn-primary">
                            Logout
                        </button>
                    </form>
                @endauth

                @guest
                    <a href="{{ route('login') }}" class="lumiere-btn-outline">
                        Login
                    </a>

                    <a href="{{ route('register') }}" class="lumiere-btn-primary">
                        Register
                    </a>

                    <a href="{{ route('owner.register') }}" class="lumiere-btn-outline">
                    Join as Partner
                    </a>
                @endguest

                <button @click="open = !open" class="grid h-[42px] w-[42px] place-items-center rounded-full bg-[#eaf4ff] text-[#2f80ed] lg:hidden">
                    ☰
                </button>
            </div>

            <button @click="open = !open" class="grid h-[42px] w-[42px] place-items-center rounded-full bg-[#eaf4ff] text-[#2f80ed] lg:hidden">
                ☰
            </button>

        </div>
    </div>

    <div x-show="open" class="border-t border-[#dbe8f5] bg-white lg:hidden">
        <div class="space-y-3 px-5 py-5 font-semibold text-[#1f2a44]">
            <a href="{{ route('home') }}" class="block">Home</a>
            <a href="{{ route('customer.salons.index') }}" class="block">Salons</a>

            @auth
                @if (auth()->user()->role === 'customer')
                    <a href="{{ route('customer.bookings.index') }}" class="block">
                        My Booking
                    </a>
                @endif

                @if (auth()->user()->role === 'owner')
                    <a href="{{ route('owner.salons.index') }}" class="block">
                        Partner Dashboard
                    </a>

                    <a href="{{ route('owner.bookings.index') }}" class="block">
                        Bookings
                    </a>
                @endif

                @if (auth()->user()->role === 'admin')
                    <a href="{{ route('admin.dashboard') }}" class="block">
                        Admin
                    </a>

                    <a href="{{ route('admin.categories.index') }}" class="block">
                        Categories
                    </a>

                    <a href="{{ route('admin.users.index') }}" class="block">
                        Users
                    </a>
                @endif

                <a href="{{ route('account.index') }}" class="block">
                    Account
                </a>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button class="font-semibold text-[#2f80ed]">
                        Logout
                    </button>
                </form>
            @endauth

            @guest
                <a href="{{ route('login') }}" class="block">
                    Login
                </a>

                <a href="{{ route('register') }}" class="block text-[#2f80ed]">
                    Register
                </a>

                <a href="{{ route('owner.register') }}" class="block text-[#2f80ed]">
                Join as Partner
                </a>
            @endguest
        </div>
    </div>
</nav>