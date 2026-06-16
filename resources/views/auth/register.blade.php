<x-guest-layout>
    <div x-data="{ showPassword: false, showConfirm: false }">

        <div class="mb-8">
            <p class="mb-3 text-sm font-extrabold text-[#2f80ed]">
                Create Account
            </p>

            <h1 class="font-['Playfair_Display'] text-4xl font-bold tracking-[-0.7px] text-[#172033]">
                Join Lumiere
            </h1>

            <p class="mt-3 text-sm leading-6 text-[#667085]">
                Buat akun untuk booking treatment, memberi review, atau mengelola salon sebagai partner.
            </p>
        </div>

        <form method="POST" action="{{ route('register') }}" class="space-y-5">
            @csrf

            <div>
                <label for="name" class="mb-2 block text-sm font-bold text-[#2a4468]">
                    Name
                </label>

                <input
                    id="name"
                    type="text"
                    name="name"
                    value="{{ old('name') }}"
                    required
                    autofocus
                    autocomplete="name"
                    class="w-full rounded-xl border border-[#dbe8f5] bg-white px-4 py-3 text-[#172033] outline-none focus:border-[#2f80ed] focus:ring-4 focus:ring-[#2f80ed]/10"
                    placeholder="Nama lengkap"
                >

                <x-input-error :messages="$errors->get('name')" class="mt-2" />
            </div>

            <div>
                <label for="email" class="mb-2 block text-sm font-bold text-[#2a4468]">
                    Email
                </label>

                <input
                    id="email"
                    type="email"
                    name="email"
                    value="{{ old('email') }}"
                    required
                    autocomplete="username"
                    class="w-full rounded-xl border border-[#dbe8f5] bg-white px-4 py-3 text-[#172033] outline-none focus:border-[#2f80ed] focus:ring-4 focus:ring-[#2f80ed]/10"
                    placeholder="nama@email.com"
                >

                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <div>
                <label for="password" class="mb-2 block text-sm font-bold text-[#2a4468]">
                    Password
                </label>

                <div class="relative">
                    <input
                        id="password"
                        x-bind:type="showPassword ? 'text' : 'password'"
                        name="password"
                        required
                        autocomplete="new-password"
                        class="w-full rounded-xl border border-[#dbe8f5] bg-white px-4 py-3 pr-24 text-[#172033] outline-none focus:border-[#2f80ed] focus:ring-4 focus:ring-[#2f80ed]/10"
                        placeholder="Minimal 8 karakter"
                    >

                    <button
                        type="button"
                        x-on:click="showPassword = !showPassword"
                        class="absolute right-3 top-1/2 -translate-y-1/2 text-sm font-bold text-[#2f80ed]"
                    >
                        <span x-show="!showPassword">Show</span>
                        <span x-show="showPassword">Hide</span>
                    </button>
                </div>

                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

            <div>
                <label for="password_confirmation" class="mb-2 block text-sm font-bold text-[#2a4468]">
                    Confirm Password
                </label>

                <div class="relative">
                    <input
                        id="password_confirmation"
                        x-bind:type="showConfirm ? 'text' : 'password'"
                        name="password_confirmation"
                        required
                        autocomplete="new-password"
                        class="w-full rounded-xl border border-[#dbe8f5] bg-white px-4 py-3 pr-24 text-[#172033] outline-none focus:border-[#2f80ed] focus:ring-4 focus:ring-[#2f80ed]/10"
                        placeholder="Ulangi password"
                    >

                    <button
                        type="button"
                        x-on:click="showConfirm = !showConfirm"
                        class="absolute right-3 top-1/2 -translate-y-1/2 text-sm font-bold text-[#2f80ed]"
                    >
                        <span x-show="!showConfirm">Show</span>
                        <span x-show="showConfirm">Hide</span>
                    </button>
                </div>

                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
            </div>

            <button
                type="submit"
                class="w-full rounded-xl bg-gradient-to-r from-[#2f80ed] to-[#5aa9ff] px-5 py-3 font-bold text-white shadow-[0_12px_30px_rgba(47,128,237,0.28)] transition hover:-translate-y-0.5"
            >
                Register
            </button>
        </form>

        <p class="mt-6 text-center text-sm text-[#667085]">
            Sudah punya akun?
            <a href="{{ route('login') }}" class="font-bold text-[#2f80ed] hover:text-[#1769d8]">
                Sign in
            </a>
        </p>

    </div>
</x-guest-layout>