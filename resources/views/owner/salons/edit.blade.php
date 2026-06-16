<x-app-layout>
    <div class="min-h-screen bg-white text-[#172033]">

        <section class="border-b border-[#e6f1ff] bg-gradient-to-b from-[#f6fbff] to-white py-14">
            <div class="lumiere-container max-w-3xl">

                <div class="max-w-2xl">
                    <div class="lumiere-badge">
                        ✦ Owner Area
                    </div>

                    <h1 class="mt-6 font-['Playfair_Display'] text-5xl font-bold leading-tight tracking-[-1px] text-[#0f172a] md:text-6xl">
                        Edit
                        <span class="text-[#2f80ed]">
                            {{ $salon->nama_salon }}
                        </span>
                    </h1>

                    <p class="mt-5 text-lg leading-8 text-[#667085]">
                        Perbarui informasi salon, status operasional, dan detail marketplace.
                    </p>
                </div>

            </div>
        </section>

        <section class="py-14">
            <div class="lumiere-container max-w-3xl">

                <form method="POST"
                      action="{{ route('owner.salons.update', $salon->salon_id) }}"
                      class="rounded-[28px] border border-[#dbe8f5] bg-white p-8 shadow-[0_18px_45px_rgba(38,103,184,0.12)]">

                    @csrf
                    @method('PUT')

                    <div class="mb-5">
                        <label class="mb-2 block text-sm font-extrabold text-[#2a4468]">
                            Nama Salon
                        </label>

                        <input
                            type="text"
                            name="nama_salon"
                            value="{{ old('nama_salon', $salon->nama_salon) }}"
                            class="w-full rounded-xl border border-[#dbe8f5] bg-white px-4 py-3 text-[#172033] outline-none focus:border-[#2f80ed] focus:ring-4 focus:ring-[#2f80ed]/10"
                        >

                        @error('nama_salon')
                            <p class="mt-2 text-sm text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-5">
                        <label class="mb-2 block text-sm font-extrabold text-[#2a4468]">
                            Kota
                        </label>

                        <select
                            name="kota_id"
                            class="w-full rounded-xl border border-[#dbe8f5] bg-white px-4 py-3 text-[#172033] outline-none focus:border-[#2f80ed] focus:ring-4 focus:ring-[#2f80ed]/10"
                        >
                            @foreach ($kotas as $kota)
                                <option value="{{ $kota->kota_id }}"
                                    @selected(old('kota_id', $salon->kota_id) == $kota->kota_id)>
                                    {{ $kota->nama_kota }} — {{ $kota->provinsi }}
                                </option>
                            @endforeach
                        </select>

                        @error('kota_id')
                            <p class="mt-2 text-sm text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-5">
                        <label class="mb-2 block text-sm font-extrabold text-[#2a4468]">
                            Alamat
                        </label>

                        <textarea
                            name="alamat"
                            rows="3"
                            class="w-full rounded-xl border border-[#dbe8f5] bg-white px-4 py-3 text-[#172033] outline-none focus:border-[#2f80ed] focus:ring-4 focus:ring-[#2f80ed]/10"
                        >{{ old('alamat', $salon->alamat) }}</textarea>

                        @error('alamat')
                            <p class="mt-2 text-sm text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-5 grid gap-5 md:grid-cols-2">
                        <div>
                            <label class="mb-2 block text-sm font-extrabold text-[#2a4468]">
                                Latitude
                            </label>

                            <input
                                type="text"
                                name="latitude"
                                value="{{ old('latitude', $salon->latitude) }}"
                                placeholder="Contoh: 3.595196"
                                class="w-full rounded-xl border border-[#dbe8f5] bg-white px-4 py-3 text-[#172033] outline-none focus:border-[#2f80ed] focus:ring-4 focus:ring-[#2f80ed]/10"
                            >

                            @error('latitude')
                                <p class="mt-2 text-sm text-red-500">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label class="mb-2 block text-sm font-extrabold text-[#2a4468]">
                                Longitude
                            </label>

                            <input
                                type="text"
                                name="longitude"
                                value="{{ old('longitude', $salon->longitude) }}"
                                placeholder="Contoh: 98.672226"
                                class="w-full rounded-xl border border-[#dbe8f5] bg-white px-4 py-3 text-[#172033] outline-none focus:border-[#2f80ed] focus:ring-4 focus:ring-[#2f80ed]/10"
                            >

                            @error('longitude')
                                <p class="mt-2 text-sm text-red-500">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="mb-5">
                        <label class="mb-2 block text-sm font-extrabold text-[#2a4468]">
                            Deskripsi
                        </label>

                        <textarea
                            name="deskripsi"
                            rows="5"
                            class="w-full rounded-xl border border-[#dbe8f5] bg-white px-4 py-3 text-[#172033] outline-none focus:border-[#2f80ed] focus:ring-4 focus:ring-[#2f80ed]/10"
                        >{{ old('deskripsi', $salon->deskripsi) }}</textarea>
                    </div>

                    <div class="mb-5 grid gap-5 md:grid-cols-2">
                        <div>
                            <label class="mb-2 block text-sm font-extrabold text-[#2a4468]">
                                Jam Buka
                            </label>

                            <input
                                type="time"
                                name="jam_buka"
                                value="{{ old('jam_buka', $salon->jam_buka) }}"
                                class="w-full rounded-xl border border-[#dbe8f5] bg-white px-4 py-3 text-[#172033] outline-none focus:border-[#2f80ed] focus:ring-4 focus:ring-[#2f80ed]/10"
                            >

                            @error('jam_buka')
                                <p class="mt-2 text-sm text-red-500">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label class="mb-2 block text-sm font-extrabold text-[#2a4468]">
                                Jam Tutup
                            </label>

                            <input
                                type="time"
                                name="jam_tutup"
                                value="{{ old('jam_tutup', $salon->jam_tutup) }}"
                                class="w-full rounded-xl border border-[#dbe8f5] bg-white px-4 py-3 text-[#172033] outline-none focus:border-[#2f80ed] focus:ring-4 focus:ring-[#2f80ed]/10"
                            >

                            @error('jam_tutup')
                                <p class="mt-2 text-sm text-red-500">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="mb-6">
                        <label class="mb-2 block text-sm font-extrabold text-[#2a4468]">
                            Status
                        </label>

                        <select
                            name="status"
                            class="w-full rounded-xl border border-[#dbe8f5] bg-white px-4 py-3 text-[#172033] outline-none focus:border-[#2f80ed] focus:ring-4 focus:ring-[#2f80ed]/10"
                        >
                            <option value="active" @selected(old('status', $salon->status) === 'active')>
                                Active
                            </option>

                            <option value="inactive" @selected(old('status', $salon->status) === 'inactive')>
                                Inactive
                            </option>
                        </select>

                        @error('status')
                            <p class="mt-2 text-sm text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="flex flex-wrap gap-3">
                        <button
                            class="rounded-xl bg-gradient-to-r from-[#2f80ed] to-[#5aa9ff] px-6 py-4 font-extrabold text-white shadow-[0_12px_30px_rgba(47,128,237,0.28)] transition hover:-translate-y-0.5"
                        >
                            Update Salon
                        </button>

                        <a href="{{ route('owner.salons.index') }}"
                           class="rounded-xl border border-[#dbe8f5] bg-[#f6fbff] px-6 py-4 font-bold text-[#2f80ed] transition hover:border-[#2f80ed] hover:bg-[#eaf4ff]">
                            Batal
                        </a>
                    </div>

                </form>

            </div>
        </section>

    </div>
</x-app-layout>