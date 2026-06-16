<x-app-layout>
    <div class="min-h-screen bg-white text-[#172033]">

        <section class="border-b border-[#e6f1ff] bg-gradient-to-b from-[#f6fbff] to-white py-14">
            <div class="lumiere-container">

                <div class="mb-10 max-w-3xl">
                    <div class="lumiere-badge">
                        ✦ Explore Lumiere
                    </div>

                    <h1 class="mt-6 font-['Playfair_Display'] text-5xl font-bold leading-tight tracking-[-1px] text-[#0f172a] md:text-6xl">
                        Find Salon
                        <span class="text-[#2f80ed]">Premium</span>
                    </h1>

                    <p class="mt-5 text-lg leading-8 text-[#667085]">
                        Find the best salon for your favourite treatment.
                    </p>
                </div>

                <form
                    method="GET"
                    class="grid gap-4 rounded-[22px] border border-[#dbe8f5] bg-white p-5 shadow-[0_18px_45px_rgba(38,103,184,0.12)] lg:grid-cols-[1.2fr_1fr_1fr_1fr_auto]"
                >

                    <div>
                        <label class="mb-2 block text-sm font-extrabold text-[#172033]">
                            Salon
                        </label>

                        <input
                            type="text"
                            name="search"
                            value="{{ request('search') }}"
                            placeholder="Salon name..."
                            class="w-full rounded-xl border border-[#dbe8f5] bg-white px-4 py-3 text-[#172033] outline-none focus:border-[#2f80ed] focus:ring-4 focus:ring-[#2f80ed]/10"
                        >
                    </div>

                    <div>
                        <label class="mb-2 block text-sm font-extrabold text-[#172033]">
                            City
                        </label>

                        <select
                            name="kota"
                            class="w-full rounded-xl border border-[#dbe8f5] bg-white px-4 py-3 text-[#172033] outline-none focus:border-[#2f80ed] focus:ring-4 focus:ring-[#2f80ed]/10"
                        >
                            <option value="">All City</option>

                            @foreach ($kotas as $kota)
                                <option value="{{ $kota->nama_kota }}"
                                    @selected(request('kota') == $kota->nama_kota)>
                                    {{ $kota->nama_kota }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label class="mb-2 block text-sm font-extrabold text-[#172033]">
                            Category
                        </label>

                        <select
                            name="category"
                            class="w-full rounded-xl border border-[#dbe8f5] bg-white px-4 py-3 text-[#172033] outline-none focus:border-[#2f80ed] focus:ring-4 focus:ring-[#2f80ed]/10"
                        >
                            <option value="">All</option>

                            @foreach ($categories as $category)
                                <option value="{{ $category->nama_category }}"
                                    @selected(request('category') == $category->nama_category)>
                                    {{ $category->nama_category }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label class="mb-2 block text-sm font-extrabold text-[#172033]">
                            Sort
                        </label>

                        <select
                            name="sort"
                            class="w-full rounded-xl border border-[#dbe8f5] bg-white px-4 py-3 text-[#172033] outline-none focus:border-[#2f80ed] focus:ring-4 focus:ring-[#2f80ed]/10"
                        >
                            <option value="">Default</option>
                            <option value="rating" @selected(request('sort') === 'rating')>
                                Highest Rate
                            </option>
                            <option value="latest" @selected(request('sort') === 'latest')>
                                Newest
                            </option>
                        </select>
                    </div>

                    <div class="flex items-end">
                        <button
                            class="w-full rounded-xl bg-gradient-to-r from-[#2f80ed] to-[#5aa9ff] px-6 py-3 font-bold text-white shadow-[0_12px_30px_rgba(47,128,237,0.28)] transition hover:-translate-y-0.5"
                        >
                            Cari
                        </button>
                    </div>

                </form>
                <div class="mb-10 overflow-hidden rounded-[28px] border border-[#dbe8f5] bg-white shadow-[0_18px_45px_rgba(38,103,184,0.12)]">
                    <div class="border-b border-[#dbe8f5] bg-[#f6fbff] p-6">
                        <h2 class="font-['Playfair_Display'] text-3xl font-bold tracking-[-0.5px] text-[#172033]">
                            Salon Location
                        </h2>


                    </div>

                    <div id="salonsMap" class="h-[520px] w-full"></div>
                </div>

            </div>
        </section>

        <section class="py-14">
            <div class="lumiere-container">

                <div class="mb-8 flex flex-col justify-between gap-4 md:flex-row md:items-end">
                    <div>
                        <h2 class="font-['Playfair_Display'] text-4xl font-bold tracking-[-0.5px]">
                            Available Salon ✦
                        </h2>

                        <p class="mt-2 text-[#667085]">
                            Show {{ $salons->count() }} Available salon.
                        </p>
                    </div>

                    @if (request()->hasAny(['search', 'kota', 'category', 'sort']))
                        <a href="{{ route('customer.salons.index') }}"
                           class="font-extrabold text-[#2f80ed] hover:text-[#1769d8]">
                            Reset Filter
                        </a>
                    @endif
                </div>

                <div class="grid gap-6 md:grid-cols-2 xl:grid-cols-3">
                    @forelse ($salons as $salon)
                        @php
                            $thumbnail = $salon->images->where('is_thumbnail', true)->first()
                                ?? $salon->images->first();

                            $lowestPrice = $salon->services->min('harga');
                        @endphp

                        <article class="overflow-hidden rounded-[18px] border border-[#dbe8f5] bg-white shadow-[0_12px_32px_rgba(39,93,152,0.08)] transition hover:-translate-y-1 hover:shadow-[0_18px_45px_rgba(38,103,184,0.12)]">

                            <div class="relative h-[220px] overflow-hidden">
                                <span class="absolute left-3 top-3 z-10 rounded-full bg-[#2f80ed] px-3 py-1.5 text-xs font-extrabold text-white">
                                    {{ $salon->rating >= 4.5 ? 'Top Rated' : 'Available' }}
                                </span>

                                @if ($thumbnail)
                                    <img
                                        src="{{ asset('storage/' . $thumbnail->image_path) }}"
                                        class="h-full w-full object-cover transition duration-300 hover:scale-105"
                                        alt="{{ $salon->nama_salon }}"
                                    >
                                @else
                                    <div class="grid h-full place-items-center bg-[#eaf4ff] text-[#667085]">
                                        No Image
                                    </div>
                                @endif
                            </div>

                            <div class="p-5">
                                <div class="mb-3 flex items-center justify-between gap-3">
                                    <h3 class="text-xl font-extrabold text-[#172033]">
                                        {{ $salon->nama_salon }}
                                    </h3>

                                    <div class="shrink-0 text-sm font-extrabold text-[#f6b93b]">
                                        ★ {{ number_format($salon->rating, 1) }}
                                    </div>
                                </div>

                                <p class="text-sm leading-6 text-[#667085]">
                                    {{ $salon->kota->nama_kota }},
                                    {{ $salon->kota->provinsi }}
                                </p>

                                <p class="mt-3 line-clamp-2 text-sm leading-6 text-[#667085]">
                                    {{ $salon->deskripsi ?? 'Premium Salon With the Best Service from Lumiere.' }}
                                </p>

                                <div class="mt-5 flex items-center justify-between border-t border-[#dbe8f5] pt-4">
                                    <div>
                                        <p class="text-sm text-[#667085]">
                                            {{ $salon->services->count() }} services
                                        </p>

                                        <p class="mt-1 font-extrabold text-[#20304a]">
                                            @if ($lowestPrice)
                                                From £ {{ number_format($lowestPrice, 2, ',', '.') }}
                                            @else
                                                Prize not available
                                            @endif
                                        </p>
                                    </div>

                                    <a
                                        href="{{ route('customer.salons.show', $salon->salon_id) }}"
                                        class="rounded-xl border border-[#2f80ed] px-4 py-3 text-sm font-extrabold text-[#2f80ed] transition hover:bg-[#2f80ed] hover:text-white"
                                    >
                                        View Salon
                                    </a>
                                </div>
                            </div>
                        </article>
                    @empty
                        <div class="rounded-[18px] border border-[#dbe8f5] bg-white p-10 text-[#667085] shadow-[0_12px_32px_rgba(39,93,152,0.08)]">
                            Cant find any salon
                        </div>
                    @endforelse
                </div>
                <div class="mt-10">
                    {{ $salons->links() }}
                </div>
            </div>
        </section>

    </div>
<link
    rel="stylesheet"
    href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
/>

<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const salons = @json($mapSalons);

        const mapElement = document.getElementById('salonsMap');

        if (!mapElement) {
            return;
        }

        const defaultCenter = [-2.548926, 118.0148634];

        const map = L.map('salonsMap').setView(defaultCenter, 5);

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 19,
            attribution: '&copy; OpenStreetMap contributors'
        }).addTo(map);

        const markers = [];

        salons.forEach(function (salon) {
            if (!salon.latitude || !salon.longitude) {
                return;
            }

            const marker = L.marker([salon.latitude, salon.longitude])
                .addTo(map)
                .bindPopup(`
                    <div style="min-width: 220px">
                        <strong>${salon.name}</strong>
                        <br>
                        <span>${salon.address ?? ''}</span>
                        <br>
                        <span>${salon.city ?? ''}</span>
                        <br>
                        <span>★ ${Number(salon.rating).toFixed(1)}</span>
                        <br><br>
                        <a href="${salon.url}" style="color:#2f80ed;font-weight:700;">
                            Lihat Detail
                        </a>
                    </div>
                `);

            markers.push(marker);
        });

        if (markers.length > 0) {
            const group = L.featureGroup(markers);
            map.fitBounds(group.getBounds(), {
                padding: [40, 40]
            });
        }
    });
</script>
</x-app-layout>