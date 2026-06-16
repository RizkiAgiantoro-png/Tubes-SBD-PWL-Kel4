<x-app-layout>
    <div class="min-h-screen bg-white text-[#172033]">

        <section class="border-b border-[#e6f1ff] bg-gradient-to-b from-[#f6fbff] to-white py-14">
            <div class="lumiere-container">

                <div class="mb-10 flex flex-col justify-between gap-6 lg:flex-row lg:items-end">
                    <div>
                        <div class="lumiere-badge">
                            ✦ Salon Detail
                        </div>

                        <h1 class="mt-6 font-['Playfair_Display'] text-5xl font-bold leading-tight tracking-[-1px] text-[#0f172a] md:text-6xl">
                            {{ $salon->nama_salon }}
                        </h1>

                        <p class="mt-4 max-w-2xl text-lg leading-8 text-[#667085]">
                            {{ $salon->alamat }},
                            {{ $salon->kota->nama_kota }}
                        </p>
                    </div>

                    <div class="rounded-[18px] border border-[#dbe8f5] bg-white px-6 py-4 text-center shadow-[0_12px_32px_rgba(39,93,152,0.08)]">
                        <p class="text-sm font-bold text-[#667085]">Rating</p>
                        <p class="mt-1 text-3xl font-extrabold text-[#f6b93b]">
                            ★ {{ number_format($salon->rating, 1) }}
                        </p>
                    </div>
                </div>

                <div class="grid gap-4 md:grid-cols-3">
                    @forelse ($salon->images as $image)
                        <img
                            src="{{ asset('storage/' . $image->image_path) }}"
                            class="h-64 w-full rounded-[18px] object-cover shadow-[0_12px_32px_rgba(39,93,152,0.08)]"
                            alt="{{ $salon->nama_salon }}"
                        >
                    @empty
                        <div class="rounded-[18px] border border-[#dbe8f5] bg-white p-10 text-[#667085] shadow-[0_12px_32px_rgba(39,93,152,0.08)]">
                            No image available
                        </div>
                    @endforelse
                </div>

            </div>
        </section>

        <section class="py-14">
            <div class="lumiere-container grid gap-8 lg:grid-cols-3">

                <div class="lg:col-span-2">
                    <div class="mb-8">
                        <h2 class="font-['Playfair_Display'] text-4xl font-bold tracking-[-0.5px]">
                            Available Services ✦
                        </h2>

                        <p class="mt-2 text-[#667085]">
                            Choose the available services that you wish.
                        </p>
                    </div>

                    <div class="space-y-5">
                        @forelse ($salon->services as $service)
                            <article class="rounded-[18px] border border-[#dbe8f5] bg-white p-6 shadow-[0_12px_32px_rgba(39,93,152,0.08)] transition hover:-translate-y-1 hover:shadow-[0_18px_45px_rgba(38,103,184,0.12)]">
                                <div class="flex flex-col justify-between gap-6 md:flex-row">
                                    <div>
                                        <span class="inline-flex rounded-full bg-[#eaf4ff] px-3 py-1.5 text-xs font-extrabold text-[#2f80ed]">
                                            {{ $service->category->nama_category }}
                                        </span>

                                        <h3 class="mt-4 text-2xl font-extrabold text-[#172033]">
                                            {{ $service->nama_service }}
                                        </h3>

                                        <p class="mt-2 text-sm font-semibold text-[#667085]">
                                            {{ $service->durasi }} Minutes
                                        </p>

                                        <p class="mt-4 max-w-xl text-sm leading-7 text-[#667085]">
                                            {{ $service->deskripsi ?? '' }}
                                        </p>
                                    </div>

                                    <div class="shrink-0 md:text-right">
                                        <p class="text-2xl font-extrabold text-[#20304a]">
                                            £{{ number_format($service->harga, 2, '.', ',') }}
                                        </p>

                                        <a
                                            href="{{ route('customer.salons.booking', $salon->salon_id) }}"
                                            class="mt-4 inline-block rounded-xl border border-[#2f80ed] px-5 py-3 text-sm font-extrabold text-[#2f80ed] transition hover:bg-[#2f80ed] hover:text-white"
                                        >
                                            Booking
                                        </a>
                                    </div>
                                </div>
                            </article>
                        @empty
                            <div class="rounded-[18px] border border-[#dbe8f5] bg-white p-8 text-[#667085] shadow-[0_12px_32px_rgba(39,93,152,0.08)]">
                                No services available
                            </div>
                        @endforelse
                    </div>
                </div>

                <aside class="space-y-6">

                    <div class="rounded-[18px] border border-[#dbe8f5] bg-white p-6 shadow-[0_12px_32px_rgba(39,93,152,0.08)]">
                        <h2 class="font-['Playfair_Display'] text-2xl font-bold">
                            Saloon Information
                        </h2>

                        <p class="mt-4 text-sm leading-7 text-[#667085]">
                            {{ $salon->deskripsi ?? 'Salon premium mitra Lumiere.' }}
                        </p>

                        <div class="mt-5 space-y-3 border-t border-[#dbe8f5] pt-5 text-sm text-[#667085]">
                            <p>
                                <span class="font-extrabold text-[#172033]">Open:</span>
                                {{ $salon->jam_buka }}
                            </p>

                            <p>
                                <span class="font-extrabold text-[#172033]">Closed:</span>
                                {{ $salon->jam_tutup }}
                            </p>
                        </div>
                    </div>

                    <div class="rounded-[18px] border border-[#dbe8f5] bg-white p-6 shadow-[0_12px_32px_rgba(39,93,152,0.08)]">
                        <h2 class="font-['Playfair_Display'] text-2xl font-bold">
                            Saloon Location
                        </h2>

                        @if ($salon->latitude && $salon->longitude)
                            <div
                                id="salonMap"
                                class="mt-5 h-72 overflow-hidden rounded-[18px] border border-[#dbe8f5]"
                            ></div>

                            <p class="mt-4 text-sm leading-6 text-[#667085]">
                                {{ $salon->alamat }},
                                {{ $salon->kota->nama_kota }}
                            </p>
                        @else
                            <p class="mt-4 text-sm leading-6 text-[#667085]">
                                Location not available
                            </p>
                        @endif
                    </div>

                    <div class="rounded-[18px] border border-[#dbe8f5] bg-white p-6 shadow-[0_12px_32px_rgba(39,93,152,0.08)]">
                        <h2 class="font-['Playfair_Display'] text-2xl font-bold">
                            Staff
                        </h2>

                        <div class="mt-5 space-y-4">
                            @forelse ($salon->staff as $staff)
                                <div class="border-b border-[#dbe8f5] pb-4 last:border-b-0">
                                    <p class="font-extrabold text-[#172033]">
                                        {{ $staff->nama_staff }}
                                    </p>

                                    <p class="mt-1 text-sm text-[#667085]">
                                        {{ $staff->spesialisasi ?? 'Therapist' }}
                                    </p>
                                </div>
                            @empty
                                <p class="text-sm text-[#667085]">
                                    No Staff Available
                                </p>
                            @endforelse
                        </div>
                    </div>

                    <div class="rounded-[18px] border border-[#dbe8f5] bg-white p-6 shadow-[0_12px_32px_rgba(39,93,152,0.08)]">
                        <h2 class="font-['Playfair_Display'] text-2xl font-bold">
                            Review
                        </h2>

                        <div class="mt-5 space-y-5">
                            @forelse ($salon->reviews as $review)
                                <div class="border-b border-[#dbe8f5] pb-5 last:border-b-0">
                                    <p class="font-extrabold text-[#f6b93b]">
                                        {{ str_repeat('★', $review->rating) }}
                                    </p>

                                    <p class="mt-2 text-sm leading-7 text-[#667085]">
                                        {{ $review->komentar }}
                                    </p>
                                </div>
                            @empty
                                <p class="text-sm text-[#667085]">
                                    No review available
                                </p>
                            @endforelse
                        </div>
                    </div>

                </aside>

            </div>
        </section>

    </div>
    <link
    rel="stylesheet"
    href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
/>

<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
@if ($salon->latitude && $salon->longitude)
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const latitude = {{ $salon->latitude }};
            const longitude = {{ $salon->longitude }};

            const map = L.map('salonMap').setView([latitude, longitude], 15);

            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                maxZoom: 19,
                attribution: '&copy; OpenStreetMap contributors'
            }).addTo(map);

            L.marker([latitude, longitude])
                .addTo(map)
                .bindPopup(`{{ $salon->nama_salon }}`)
                .openPopup();
        });
    </script>
@endif
</x-app-layout>