<x-guest-layout>
    <div x-data="{ showPassword: false }">

        <div class="mb-8">
            <p class="mb-3 text-sm font-extrabold text-[#2f80ed]">
                Welcome Back
            </p>

            <h1 class="font-['Playfair_Display'] text-4xl font-bold tracking-[-0.7px] text-[#172033]">
                Sign in to Lumiere
            </h1>

            <p class="mt-3 text-sm leading-6 text-[#667085]">
                Masuk untuk mengelola booking, salon, layanan, dan pengalaman beauty kamu.
            </p>
        </div>

        <x-auth-session-status class="mb-5" :status="session('status')" />

        <form method="POST" action="{{ route('login') }}" class="space-y-5">
            @csrf

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
                    autofocus
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
                        autocomplete="current-password"
                        class="w-full rounded-xl border border-[#dbe8f5] bg-white px-4 py-3 pr-24 text-[#172033] outline-none focus:border-[#2f80ed] focus:ring-4 focus:ring-[#2f80ed]/10"
                        placeholder="Masukkan password"
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

            <div class="flex items-center justify-between">
                <label for="remember_me" class="inline-flex items-center gap-2 text-sm text-[#667085]">
                    <input
                        id="remember_me"
                        type="checkbox"
                        name="remember"
                        class="rounded border-[#dbe8f5] text-[#2f80ed] focus:ring-[#2f80ed]"
                    >
                    Remember me
                </label>

                @if (Route::has('password.request'))
                    <a href="{{ route('password.request') }}" class="text-sm font-bold text-[#2f80ed] hover:text-[#1769d8]">
                        Forgot password?
                    </a>
                @endif
            </div>

            <button
                type="submit"
                class="w-full rounded-xl bg-gradient-to-r from-[#2f80ed] to-[#5aa9ff] px-5 py-3 font-bold text-white shadow-[0_12px_30px_rgba(47,128,237,0.28)] transition hover:-translate-y-0.5"
            >
                Log in
            </button>
        </form>

        <p class="mt-6 text-center text-sm text-[#667085]">
            Belum punya akun?
            <a href="{{ route('register') }}" class="font-bold text-[#2f80ed] hover:text-[#1769d8]">
                Register
            </a>
        </p>

    </div>
</x-guest-layout>