<x-guest-layout>
    <div class="mb-8 text-center">
        <h1 class="font-['Playfair_Display'] text-4xl font-bold text-[#172033]">
            Join as Lumiere Partner
        </h1>

        <p class="mt-3 text-sm leading-6 text-[#667085]">
            Daftarkan akun owner untuk mulai mengelola salon, layanan, staff, dan booking customer.
        </p>
    </div>

    <form method="POST" action="{{ route('owner.register.store') }}">
        @csrf

        <div>
            <x-input-label for="name" value="Nama Owner / Partner" />
            <x-text-input
                id="name"
                class="mt-1 block w-full"
                type="text"
                name="name"
                :value="old('name')"
                required
                autofocus
                autocomplete="name"
            />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <div class="mt-4">
            <x-input-label for="email" value="Email" />
            <x-text-input
                id="email"
                class="mt-1 block w-full"
                type="email"
                name="email"
                :value="old('email')"
                required
                autocomplete="username"
            />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div class="mt-4">
            <x-input-label for="password" value="Password" />
            <x-text-input
                id="password"
                class="mt-1 block w-full"
                type="password"
                name="password"
                required
                autocomplete="new-password"
            />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <div class="mt-4">
            <x-input-label for="password_confirmation" value="Konfirmasi Password" />
            <x-text-input
                id="password_confirmation"
                class="mt-1 block w-full"
                type="password"
                name="password_confirmation"
                required
                autocomplete="new-password"
            />
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="mt-6 flex items-center justify-between">
            <a
                class="text-sm font-semibold text-[#2f80ed] hover:underline"
                href="{{ route('login') }}"
            >
                Sudah punya akun?
            </a>

            <button class="rounded-xl bg-gradient-to-r from-[#2f80ed] to-[#5aa9ff] px-5 py-3 font-extrabold text-white shadow-[0_12px_30px_rgba(47,128,237,0.28)]">
                Register Owner
            </button>
        </div>
    </form>
</x-guest-layout>