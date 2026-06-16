<x-app-layout>
    <div class="min-h-screen bg-white text-[#172033]">

        <section class="border-b border-[#e6f1ff] bg-gradient-to-b from-[#f6fbff] to-white py-14">
            <div class="lumiere-container">
                <div class="max-w-3xl">
                    <div class="lumiere-badge">
                        ✦ Account
                    </div>

                    <h1 class="mt-6 font-['Playfair_Display'] text-5xl font-bold leading-tight tracking-[-1px] text-[#0f172a] md:text-6xl">
                        My
                        <span class="text-[#2f80ed]">Account</span>
                    </h1>

                    <p class="mt-5 text-lg leading-8 text-[#667085]">
                        Kelola informasi akun, role, dan akses cepat ke fitur Lumiere.
                    </p>
                </div>
            </div>
        </section>

        <section class="py-14">
            <div class="lumiere-container grid gap-8 lg:grid-cols-3">

                <div class="rounded-[28px] border border-[#dbe8f5] bg-white p-8 shadow-[0_18px_45px_rgba(38,103,184,0.12)]">
                    <div class="grid h-24 w-24 place-items-center rounded-full bg-[#eaf4ff] text-4xl font-extrabold text-[#2f80ed]">
                        {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                    </div>

                    <h2 class="mt-6 text-3xl font-extrabold text-[#172033]">
                        {{ auth()->user()->name }}
                    </h2>

                    <p class="mt-2 text-sm text-[#667085]">
                        {{ auth()->user()->email }}
                    </p>

                    <span class="mt-5 inline-flex rounded-full bg-[#eaf4ff] px-4 py-2 text-sm font-extrabold uppercase tracking-[0.12em] text-[#2f80ed]">
                        {{ auth()->user()->role }}
                    </span>
                </div>

                <div class="space-y-6 lg:col-span-2">

                    <div class="rounded-[28px] border border-[#dbe8f5] bg-white p-8 shadow-[0_18px_45px_rgba(38,103,184,0.12)]">
                        <h2 class="font-['Playfair_Display'] text-3xl font-bold text-[#172033]">
                            Account Settings
                        </h2>

                        <p class="mt-2 text-sm leading-6 text-[#667085]">
                            Ubah informasi profil, email, password, atau hapus akun.
                        </p>

                        <div class="mt-6 flex flex-wrap gap-3">
                            <a
                                href="{{ route('profile.edit') }}"
                                class="rounded-xl bg-gradient-to-r from-[#2f80ed] to-[#5aa9ff] px-5 py-3 font-extrabold text-white shadow-[0_12px_30px_rgba(47,128,237,0.28)]"
                            >
                                Edit Profile
                            </a>
                        </div>
                    </div>

                    <div class="rounded-[28px] border border-[#dbe8f5] bg-white p-8 shadow-[0_18px_45px_rgba(38,103,184,0.12)]">
                        <h2 class="font-['Playfair_Display'] text-3xl font-bold text-[#172033]">
                            Quick Access
                        </h2>

                        <div class="mt-6 grid gap-4 md:grid-cols-2">
                            @if (auth()->user()->role === 'customer')
                                <a href="{{ route('customer.bookings.index') }}" class="rounded-xl border border-[#dbe8f5] bg-[#f6fbff] p-5 font-extrabold text-[#2f80ed] transition hover:border-[#2f80ed]">
                                    My Bookings
                                </a>

                                <a href="{{ route('customer.salons.index') }}" class="rounded-xl border border-[#dbe8f5] bg-[#f6fbff] p-5 font-extrabold text-[#2f80ed] transition hover:border-[#2f80ed]">
                                    Explore Salons
                                </a>
                            @endif

                            @if (auth()->user()->role === 'owner')
                                <a href="{{ route('owner.dashboard') }}" class="rounded-xl border border-[#dbe8f5] bg-[#f6fbff] p-5 font-extrabold text-[#2f80ed] transition hover:border-[#2f80ed]">
                                    Partner Dashboard
                                </a>

                                <a href="{{ route('owner.salons.index') }}" class="rounded-xl border border-[#dbe8f5] bg-[#f6fbff] p-5 font-extrabold text-[#2f80ed] transition hover:border-[#2f80ed]">
                                    My Salons
                                </a>
                            @endif

                            @if (auth()->user()->role === 'admin')
                                <a href="{{ route('admin.dashboard') }}" class="rounded-xl border border-[#dbe8f5] bg-[#f6fbff] p-5 font-extrabold text-[#2f80ed] transition hover:border-[#2f80ed]">
                                    Admin Dashboard
                                </a>

                                <a href="{{ route('admin.categories.index') }}" class="rounded-xl border border-[#dbe8f5] bg-[#f6fbff] p-5 font-extrabold text-[#2f80ed] transition hover:border-[#2f80ed]">
                                    Manage Categories
                                </a>
                            @endif
                        </div>
                    </div>

                </div>

            </div>
        </section>
    </div>
</x-app-layout>