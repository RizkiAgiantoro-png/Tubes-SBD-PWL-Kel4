<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Lumiere - Beauty & Wellness Booking</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>

<body class="min-h-screen bg-[#f6fbff] font-sans text-[#172033] antialiased">

    <div class="grid min-h-screen lg:grid-cols-2">

        <div class="relative hidden overflow-hidden bg-[#eaf4ff] lg:block">
            <div class="absolute inset-0 bg-gradient-to-br from-[#eaf4ff] via-white to-[#f6fbff]"></div>

            <div class="relative z-10 flex h-full flex-col justify-between p-14">
                <a href="{{ route('home') }}" class="relative inline-block font-['Playfair_Display'] text-5xl font-bold text-[#233a5e]">
                    Lumiere
                    <span class="absolute -right-6 -top-2 text-lg text-[#f6b93b]">✦</span>
                </a>

                <div>
                    <div class="mb-5 inline-flex rounded-full border border-[#dbe8f5] bg-white/80 px-5 py-3 text-sm font-extrabold text-[#2f80ed] shadow-sm">
                        ✦ Your Beauty. Our Passion.
                    </div>

                    <h1 class="font-['Playfair_Display'] text-6xl font-bold leading-tight tracking-[-1.5px] text-[#0f172a]">
                        Glow Inside
                        <span class="text-[#2f80ed]">&amp;</span>
                        Out
                    </h1>

                    <p class="mt-6 max-w-lg text-lg leading-8 text-[#667085]">
                        Temukan dan pesan salon, spa, serta treatment premium terbaik secara cepat, elegan, dan nyaman.
                    </p>
                </div>

                <div class="grid grid-cols-3 gap-4">
                    <div class="rounded-2xl border border-[#dbe8f5] bg-white/80 p-5 shadow-sm">
                        <p class="text-2xl font-extrabold text-[#2f80ed]">4.8★</p>
                        <p class="mt-1 text-sm text-[#667085]">Rating</p>
                    </div>

                    <div class="rounded-2xl border border-[#dbe8f5] bg-white/80 p-5 shadow-sm">
                        <p class="text-2xl font-extrabold text-[#2f80ed]">Easy</p>
                        <p class="mt-1 text-sm text-[#667085]">Booking</p>
                    </div>

                    <div class="rounded-2xl border border-[#dbe8f5] bg-white/80 p-5 shadow-sm">
                        <p class="text-2xl font-extrabold text-[#2f80ed]">Safe</p>
                        <p class="mt-1 text-sm text-[#667085]">Payment</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="flex min-h-screen items-center justify-center px-6 py-12">
            <div class="w-full max-w-md">

                <div class="mb-10 text-center lg:hidden">
                    <a href="{{ route('home') }}" class="relative inline-block font-['Playfair_Display'] text-5xl font-bold text-[#233a5e]">
                        Lumiere
                        <span class="absolute -right-6 -top-2 text-lg text-[#f6b93b]">✦</span>
                    </a>
                </div>

                <div class="rounded-[28px] border border-[#dbe8f5] bg-white p-8 shadow-[0_18px_45px_rgba(38,103,184,0.12)]">
                    {{ $slot }}
                </div>

                <p class="mt-8 text-center text-sm text-[#667085]">
                    © {{ date('Y') }} Lumiere. Beauty & Wellness Booking.
                </p>
            </div>
        </div>
       
    </div>
    @livewireScripts
 @include('layouts.footer')
</body>
</html>