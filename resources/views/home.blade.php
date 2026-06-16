<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lumiere - Beauty & Wellness Booking</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-white text-[#172033]">

    @include('layouts.navigation')

    <main>
        <section class="relative overflow-hidden border-b border-[#e6f1ff] bg-[linear-gradient(90deg,rgba(246,251,255,0.97)_0%,rgba(234,244,255,0.82)_48%,rgba(255,255,255,0.45)_100%)]">
            <div class="absolute -left-24 top-20 h-72 w-72 rounded-full bg-[#2f80ed]/10 blur-xl"></div>
            <div class="absolute -bottom-20 right-32 h-60 w-60 rounded-full bg-[#2f80ed]/10 blur-xl"></div>

            <div class="lumiere-container grid min-h-[560px] items-center gap-10 py-16 lg:grid-cols-2">

                <div class="relative z-10">
                    <div class="lumiere-badge">
                        ✦ Your Beauty. Our Passion.
                    </div>

                    <h1 class="mt-6 font-['Playfair_Display'] text-[54px] font-bold leading-[0.98] tracking-[-2px] text-[#0f172a] md:text-[78px]">
                        Glow Inside
                        <span class="text-[#2f80ed]">&amp;</span>
                        Out
                    </h1>

                    <p class="mt-6 max-w-xl text-lg leading-8 text-[#52627a]">
                        Temukan dan pesan salon, spa, serta treatment premium terbaik di sekitar kamu.
                        Cepat, elegan, dan nyaman.
                    </p>

                    <form action="{{ route('customer.salons.index') }}"
                          method="GET"
                          class="mt-8 grid overflow-hidden rounded-[22px] border border-[#dbe8f5] bg-white/95 shadow-[0_18px_45px_rgba(38,103,184,0.12)] lg:grid-cols-[1.2fr_1fr_auto]">

                        <div class="flex items-center gap-4 border-b border-[#dbe8f5] p-5 lg:border-b-0 lg:border-r">
                            <div class="grid h-12 w-12 shrink-0 place-items-center rounded-full bg-[#eaf4ff] text-[#2f80ed]">
                                ✿
                            </div>

                            <div class="w-full">
                                <label class="block text-sm font-extrabold text-[#172033]">
                                    Apa yang kamu cari?
                                </label>

                                <input
                                    type="text"
                                    name="search"
                                    placeholder="Cari salon atau layanan..."
                                    class="w-full border-none bg-transparent text-[#667085] outline-none focus:ring-0"
                                >
                            </div>
                        </div>

                        <div class="flex items-center gap-4 border-b border-[#dbe8f5] p-5 lg:border-b-0 lg:border-r">
                            <div class="grid h-12 w-12 shrink-0 place-items-center rounded-full bg-[#eaf4ff] text-[#2f80ed]">
                                ⌖
                            </div>

                            <div class="w-full">
                                <label class="block text-sm font-extrabold text-[#172033]">
                                    Lokasi
                                </label>

                                <input
                                    type="text"
                                    name="kota"
                                    placeholder="Kota..."
                                    class="w-full border-none bg-transparent text-[#667085] outline-none focus:ring-0"
                                >
                            </div>
                        </div>

                        <div class="p-4">
                            <button class="h-full w-full rounded-xl bg-gradient-to-r from-[#2f80ed] to-[#5aa9ff] px-6 py-4 font-bold text-white shadow-[0_12px_30px_rgba(47,128,237,0.28)] transition hover:-translate-y-0.5">
                                Search & Book →
                            </button>
                        </div>
                    </form>

                    <div class="mt-8 grid gap-4 sm:grid-cols-2 lg:grid-cols-4">
                        <div class="flex items-center gap-3">
                            <div class="grid h-11 w-11 place-items-center rounded-2xl border border-[#dbe8f5] bg-white text-[#2f80ed]">
                                ♕
                            </div>
                            <div>
                                <strong class="block text-sm">Trusted Salons</strong>
                                <small class="text-[#667085]">Terverifikasi</small>
                            </div>
                        </div>

                        <div class="flex items-center gap-3">
                            <div class="grid h-11 w-11 place-items-center rounded-2xl border border-[#dbe8f5] bg-white text-[#2f80ed]">
                                %
                            </div>
                            <div>
                                <strong class="block text-sm">Best Price</strong>
                                <small class="text-[#667085]">Kompetitif</small>
                            </div>
                        </div>

                        <div class="flex items-center gap-3">
                            <div class="grid h-11 w-11 place-items-center rounded-2xl border border-[#dbe8f5] bg-white text-[#2f80ed]">
                                ✓
                            </div>
                            <div>
                                <strong class="block text-sm">Easy Booking</strong>
                                <small class="text-[#667085]">Cepat dan aman</small>
                            </div>
                        </div>

                        <div class="flex items-center gap-3">
                            <div class="grid h-11 w-11 place-items-center rounded-2xl border border-[#dbe8f5] bg-white text-[#2f80ed]">
                                ★
                            </div>
                            <div>
                                <strong class="block text-sm">Satisfaction</strong>
                                <small class="text-[#667085]">Dipercaya pelanggan</small>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="hidden lg:block">
                    <div class="relative">
                        <div class="absolute -left-8 -top-8 h-36 w-36 rounded-full bg-[#eaf4ff]"></div>

                        <img
                            src="https://images.unsplash.com/photo-1570172619644-dfd03ed5d881?auto=format&fit=crop&w=1200&q=80"
                            alt="Beauty treatment"
                            class="relative h-[480px] w-full rounded-[32px] object-cover shadow-[0_18px_45px_rgba(38,103,184,0.16)]"
                        >

                        <div class="absolute -bottom-6 left-8 rounded-3xl border border-[#dbe8f5] bg-white p-5 shadow-[0_18px_45px_rgba(38,103,184,0.12)]">
                            <p class="text-sm font-bold text-[#667085]">Average Rating</p>
                            <p class="mt-1 text-3xl font-extrabold text-[#2f80ed]">4.8★</p>
                        </div>
                    </div>
                </div>

            </div>
        </section>

        <section class="py-16">
            <div class="lumiere-container">
                <div class="mb-8 flex items-end justify-between gap-4">
                    <div>
                        <h2 class="font-['Playfair_Display'] text-4xl font-bold tracking-[-0.5px]">
                            Featured Salons ✦
                        </h2>

                        <p class="mt-2 text-[#667085]">
                            Pilihan salon premium dengan rating terbaik.
                        </p>
                    </div>

                    <a href="{{ route('customer.salons.index') }}" class="font-extrabold text-[#2f80ed]">
                        View all
                    </a>
                </div>

                <div class="grid gap-6 md:grid-cols-2 lg:grid-cols-4">
                    @forelse ($featuredSalons as $salon)
                        @php
                            $thumbnail = $salon->images->where('is_thumbnail', true)->first()
                                ?? $salon->images->first();
                        @endphp

                        <article class="overflow-hidden rounded-[18px] border border-[#dbe8f5] bg-white shadow-[0_12px_32px_rgba(39,93,152,0.08)] transition hover:-translate-y-1 hover:shadow-[0_18px_45px_rgba(38,103,184,0.12)]">
                            <div class="relative h-[170px] overflow-hidden">
                                <span class="absolute left-3 top-3 z-10 rounded-full bg-[#2f80ed] px-3 py-1.5 text-xs font-extrabold text-white">
                                    Top Rated
                                </span>

                                @if ($thumbnail)
                                    <img
                                        src="{{ asset('storage/' . $thumbnail->image_path) }}"
                                        alt="{{ $salon->nama_salon }}"
                                        class="h-full w-full object-cover"
                                    >
                                @else
                                    <div class="grid h-full place-items-center bg-[#eaf4ff] text-[#667085]">
                                        No Image
                                    </div>
                                @endif
                            </div>

                            <div class="p-5">
                                <h3 class="font-bold">
                                    {{ $salon->nama_salon }}
                                </h3>

                                <div class="mt-2 text-sm font-extrabold text-[#f6b93b]">
                                    ★ {{ number_format($salon->rating, 1) }}
                                </div>

                                <p class="mt-2 text-sm leading-6 text-[#667085]">
                                    {{ $salon->kota->nama_kota ?? '-' }}
                                    <br>
                                    <span class="font-extrabold text-[#20304a]">
                                        {{ $salon->services->count() }} layanan
                                    </span>
                                </p>

                                <a href="{{ route('customer.salons.show', $salon->salon_id) }}"
                                   class="mt-4 block rounded-xl border border-[#2f80ed] px-4 py-3 text-center text-sm font-extrabold text-[#2f80ed] transition hover:bg-[#2f80ed] hover:text-white">
                                    View Salon
                                </a>
                            </div>
                        </article>
                    @empty
                        <div class="rounded-[18px] border border-[#dbe8f5] bg-white p-8 text-[#667085]">
                            Belum ada salon aktif.
                        </div>
                    @endforelse
                </div>
            </div>
        </section>

        <section class="bg-[#f6fbff] py-16">
            <div class="lumiere-container grid gap-8 lg:grid-cols-2">

                <div>
                    <div class="mb-8">
                        <h2 class="font-['Playfair_Display'] text-4xl font-bold">
                            Popular Treatments
                        </h2>

                        <p class="mt-2 text-[#667085]">
                            Layanan favorit yang sering dipesan pelanggan.
                        </p>
                    </div>

                    <div class="rounded-[18px] border border-[#dbe8f5] bg-white p-5 shadow-[0_12px_32px_rgba(39,93,152,0.08)]">
                        @forelse ($featuredServices as $service)
                            <div class="flex items-center justify-between gap-5 border-b border-[#dbe8f5] px-2 py-4 last:border-b-0">
                                <div class="flex items-center gap-4">
                                    <div class="grid h-12 w-12 place-items-center rounded-2xl bg-[#eaf4ff] text-[#2f80ed]">
                                        ✧
                                    </div>

                                    <div>
                                        <h3 class="font-bold">
                                            {{ $service->nama_service }}
                                        </h3>

                                        <p class="text-sm text-[#667085]">
                                            {{ $service->category->nama_category ?? '-' }}
                                            · {{ $service->durasi }} menit
                                        </p>
                                    </div>
                                </div>

                                <div class="text-right text-sm text-[#667085]">
                                    From
                                    <strong class="block text-base text-[#172033]">
                                        £ {{ number_format($service->harga, 0, ',', '.') }}
                                    </strong>
                                </div>
                            </div>
                        @empty
                            <p class="p-4 text-[#667085]">
                                Belum ada layanan.
                            </p>
                        @endforelse
                    </div>
                </div>



            </div>
        </section>

        <section class="bg-gradient-to-b from-[#f6fbff] to-white py-16">
            <div class="lumiere-container">
                <div class="mb-8">
                    <h2 class="font-['Playfair_Display'] text-4xl font-bold">
                        Loved by Our Clients ✦
                    </h2>

                    <p class="mt-2 text-[#667085]">
                        Pengalaman pelanggan yang sudah booking di Lumiere.
                    </p>
                </div>

                <div class="grid gap-6 lg:grid-cols-[250px_1fr]">
                    <div class="rounded-[18px] border border-[#dbe8f5] bg-white p-7 shadow-[0_12px_32px_rgba(39,93,152,0.08)]">
                        <div class="font-extrabold text-[#f6b93b]">★★★★★</div>
                        <div class="mt-2 text-5xl font-black">4.8/5</div>
                        <p class="mt-3 text-[#667085]">
                            Berdasarkan review pelanggan Lumiere.
                        </p>
                    </div>

                    <div class="grid gap-5 md:grid-cols-3">
                        @forelse ($latestReviews as $review)
                            <article class="rounded-[18px] border border-[#dbe8f5] bg-white p-6 shadow-[0_12px_32px_rgba(39,93,152,0.08)]">
                                <div class="mb-4">
                                    <strong>{{ $review->customer->name ?? 'Customer' }}</strong>
                                    <div class="text-[#f6b93b]">
                                        {{ str_repeat('★', $review->rating) }}
                                    </div>
                                </div>

                                <p class="text-sm leading-7 text-[#42526c]">
                                    {{ $review->komentar }}
                                </p>

                                <p class="mt-4 text-sm font-bold text-[#2f80ed]">
                                    {{ $review->salon->nama_salon ?? '-' }}
                                </p>
                            </article>
                        @empty
                            <article class="rounded-[18px] border border-[#dbe8f5] bg-white p-6 text-[#667085] shadow-[0_12px_32px_rgba(39,93,152,0.08)]">
                                Belum ada review.
                            </article>
                        @endforelse
                    </div>
                </div>
            </div>
        </section>
    </main>

    <footer class="border-t border-[#dbe8f5] bg-[#f4f9ff] py-12">
        <div class="lumiere-container">
            <div class="grid gap-8 md:grid-cols-2 lg:grid-cols-[1.4fr_1fr_1fr_1fr_1.4fr]">
                <div>
                    <h3 class="font-['Playfair_Display'] text-4xl font-bold text-[#233a5e]">
                        Lumiere
                    </h3>

                    <p class="mt-4 text-sm leading-7 text-[#5f6f86]">
                        Platform booking beauty & wellness premium. Look good, feel even better.
                    </p>
                </div>

                <div>
                    <h4 class="mb-4 font-bold">Explore</h4>
                    <a href="{{ route('customer.salons.index') }}" class="block text-sm leading-8 text-[#5f6f86]">Salons Near Me</a>
                    <a href="#treatments" class="block text-sm leading-8 text-[#5f6f86]">Treatments</a>
                    <a href="#" class="block text-sm leading-8 text-[#5f6f86]">Deals</a>
                </div>

                <div>
                    <h4 class="mb-4 font-bold">For Partners</h4>
                    <a href="{{ route('owner.salons.index') }}" class="block text-sm leading-8 text-[#5f6f86]">Partner Dashboard</a>
                    <a href="#" class="block text-sm leading-8 text-[#5f6f86]">Resources</a>
                    <a href="#" class="block text-sm leading-8 text-[#5f6f86]">Partner Support</a>
                </div>

                <div>
                    <h4 class="mb-4 font-bold">Support</h4>
                    <a href="#" class="block text-sm leading-8 text-[#5f6f86]">Help Center</a>
                    <a href="#" class="block text-sm leading-8 text-[#5f6f86]">How It Works</a>
                    <a href="#" class="block text-sm leading-8 text-[#5f6f86]">Contact Us</a>
                </div>

                <div>
                    <h4 class="mb-4 font-bold">Stay Glowing</h4>
                    <p class="text-sm leading-7 text-[#5f6f86]">
                        Dapatkan promo dan tips beauty terbaru.
                    </p>

                    <form class="mt-4 flex overflow-hidden rounded-xl border border-[#dbe8f5] bg-white">
                        <input type="email" placeholder="Enter your email" class="flex-1 border-0 px-4 py-3 focus:ring-0">
                        <button class="w-12 bg-[#2f80ed] text-white">➜</button>
                    </form>
                </div>
            </div>

            <div class="mt-10 border-t border-[#dbe8f5] pt-5 text-center text-sm text-[#728199]">
                © {{ date('Y') }} Lumiere. All rights reserved.
            </div>
        </div>
    </footer>

</body>
</html>