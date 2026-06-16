<x-app-layout>
    <div class="min-h-screen bg-white text-[#172033]">

        <section class="border-b border-[#e6f1ff] bg-gradient-to-b from-[#f6fbff] to-white py-14">
            <div class="lumiere-container">

                <div class="max-w-3xl">
                    <div class="lumiere-badge">
                        ✦ Dashboard
                    </div>

                    <h1 class="mt-6 font-['Playfair_Display'] text-5xl font-bold leading-tight tracking-[-1px] text-[#0f172a] md:text-6xl">
                        Welcome,
                        <span class="text-[#2f80ed]">
                            {{ auth()->user()->name }}
                        </span>
                    </h1>

                    <p class="mt-5 text-lg leading-8 text-[#667085]">
                        Akses cepat ke fitur utama sesuai role akun kamu di Lumiere.
                    </p>
                </div>

            </div>
        </section>

        <section class="py-14">
            <div class="lumiere-container">

                @if (auth()->user()->role === 'customer')
                    <div class="grid gap-6 md:grid-cols-2 lg:grid-cols-3">

                        <div class="rounded-[28px] border border-[#dbe8f5] bg-white p-8 shadow-[0_18px_45px_rgba(38,103,184,0.12)]">
                            <div class="mb-4 grid h-14 w-14 place-items-center rounded-2xl bg-[#eaf4ff] text-2xl text-[#2f80ed]">
                                ✿
                            </div>

                            <h2 class="font-['Playfair_Display'] text-3xl font-bold">
                                Explore Salon
                            </h2>

                            <p class="mt-3 text-sm leading-7 text-[#667085]">
                                Cari salon, filter berdasarkan kota dan kategori, lalu booking treatment favoritmu.
                            </p>

                            <a href="{{ route('customer.salons.index') }}"
                               class="mt-6 inline-block rounded-xl bg-gradient-to-r from-[#2f80ed] to-[#5aa9ff] px-5 py-3 font-extrabold text-white shadow-[0_12px_30px_rgba(47,128,237,0.28)]">
                                Cari Salon
                            </a>
                        </div>

                        <div class="rounded-[28px] border border-[#dbe8f5] bg-white p-8 shadow-[0_18px_45px_rgba(38,103,184,0.12)]">
                            <div class="mb-4 grid h-14 w-14 place-items-center rounded-2xl bg-[#eaf4ff] text-2xl text-[#2f80ed]">
                                ✓
                            </div>

                            <h2 class="font-['Playfair_Display'] text-3xl font-bold">
                                My Bookings
                            </h2>

                            <p class="mt-3 text-sm leading-7 text-[#667085]">
                                Lihat riwayat booking, status pembayaran, dan berikan review setelah treatment selesai.
                            </p>

                            <a href="{{ route('customer.bookings.index') }}"
                               class="mt-6 inline-block rounded-xl border border-[#2f80ed] px-5 py-3 font-extrabold text-[#2f80ed] transition hover:bg-[#2f80ed] hover:text-white">
                                Lihat Booking
                            </a>
                        </div>

                        <div class="rounded-[28px] border border-[#dbe8f5] bg-[#f6fbff] p-8">
                            <div class="mb-4 grid h-14 w-14 place-items-center rounded-2xl bg-white text-2xl text-[#2f80ed]">
                                ★
                            </div>

                            <h2 class="font-['Playfair_Display'] text-3xl font-bold">
                                Review
                            </h2>

                            <p class="mt-3 text-sm leading-7 text-[#667085]">
                                Review kamu membantu customer lain memilih salon terbaik di Lumiere.
                            </p>
                        </div>

                    </div>
                @elseif (auth()->user()->role === 'owner')
                    <div class="grid gap-6 md:grid-cols-2 lg:grid-cols-3">

                        <div class="rounded-[28px] border border-[#dbe8f5] bg-white p-8 shadow-[0_18px_45px_rgba(38,103,184,0.12)]">
                            <div class="mb-4 grid h-14 w-14 place-items-center rounded-2xl bg-[#eaf4ff] text-2xl text-[#2f80ed]">
                                ♕
                            </div>

                            <h2 class="font-['Playfair_Display'] text-3xl font-bold">
                                My Salons
                            </h2>

                            <p class="mt-3 text-sm leading-7 text-[#667085]">
                                Kelola data salon, gallery, layanan, dan staff milikmu.
                            </p>

                            <a href="{{ route('owner.salons.index') }}"
                               class="mt-6 inline-block rounded-xl bg-gradient-to-r from-[#2f80ed] to-[#5aa9ff] px-5 py-3 font-extrabold text-white shadow-[0_12px_30px_rgba(47,128,237,0.28)]">
                                Kelola Salon
                            </a>
                        </div>

                        <div class="rounded-[28px] border border-[#dbe8f5] bg-white p-8 shadow-[0_18px_45px_rgba(38,103,184,0.12)]">
                            <div class="mb-4 grid h-14 w-14 place-items-center rounded-2xl bg-[#eaf4ff] text-2xl text-[#2f80ed]">
                                □
                            </div>

                            <h2 class="font-['Playfair_Display'] text-3xl font-bold">
                                Booking Masuk
                            </h2>

                            <p class="mt-3 text-sm leading-7 text-[#667085]">
                                Pantau booking customer, ubah status selesai, atau batalkan reservasi.
                            </p>

                            <a href="{{ route('owner.bookings.index') }}"
                               class="mt-6 inline-block rounded-xl border border-[#2f80ed] px-5 py-3 font-extrabold text-[#2f80ed] transition hover:bg-[#2f80ed] hover:text-white">
                                Lihat Booking
                            </a>
                        </div>

                        <div class="rounded-[28px] border border-[#dbe8f5] bg-[#f6fbff] p-8">
                            <div class="mb-4 grid h-14 w-14 place-items-center rounded-2xl bg-white text-2xl text-[#2f80ed]">
                                %
                            </div>

                            <h2 class="font-['Playfair_Display'] text-3xl font-bold">
                                Partner Tools
                            </h2>

                            <p class="mt-3 text-sm leading-7 text-[#667085]">
                                Lengkapi gallery, layanan, dan staff agar salon tampil lebih profesional.
                            </p>
                        </div>

                    </div>
                @elseif (auth()->user()->role === 'admin')
                    <div class="grid gap-6 md:grid-cols-2 lg:grid-cols-3">

                        <div class="rounded-[28px] border border-[#dbe8f5] bg-white p-8 shadow-[0_18px_45px_rgba(38,103,184,0.12)]">
                            <div class="mb-4 grid h-14 w-14 place-items-center rounded-2xl bg-[#eaf4ff] text-2xl text-[#2f80ed]">
                                ☰
                            </div>

                            <h2 class="font-['Playfair_Display'] text-3xl font-bold">
                                Admin Dashboard
                            </h2>

                            <p class="mt-3 text-sm leading-7 text-[#667085]">
                                Pantau statistik user, salon, booking, revenue, dan rating platform.
                            </p>

                            <a href="{{ route('admin.dashboard') }}"
                               class="mt-6 inline-block rounded-xl bg-gradient-to-r from-[#2f80ed] to-[#5aa9ff] px-5 py-3 font-extrabold text-white shadow-[0_12px_30px_rgba(47,128,237,0.28)]">
                                Buka Dashboard
                            </a>
                        </div>

                        <div class="rounded-[28px] border border-[#dbe8f5] bg-white p-8 shadow-[0_18px_45px_rgba(38,103,184,0.12)]">
                            <div class="mb-4 grid h-14 w-14 place-items-center rounded-2xl bg-[#eaf4ff] text-2xl text-[#2f80ed]">
                                ✧
                            </div>

                            <h2 class="font-['Playfair_Display'] text-3xl font-bold">
                                Categories
                            </h2>

                            <p class="mt-3 text-sm leading-7 text-[#667085]">
                                Kelola kategori layanan yang digunakan oleh owner saat membuat service.
                            </p>

                            <a href="{{ route('admin.categories.index') }}"
                               class="mt-6 inline-block rounded-xl border border-[#2f80ed] px-5 py-3 font-extrabold text-[#2f80ed] transition hover:bg-[#2f80ed] hover:text-white">
                                Kelola Kategori
                            </a>
                        </div>

                        <div class="rounded-[28px] border border-[#dbe8f5] bg-[#f6fbff] p-8">
                            <div class="mb-4 grid h-14 w-14 place-items-center rounded-2xl bg-white text-2xl text-[#2f80ed]">
                                ★
                            </div>

                            <h2 class="font-['Playfair_Display'] text-3xl font-bold">
                                Platform Control
                            </h2>

                            <p class="mt-3 text-sm leading-7 text-[#667085]">
                                Admin bertanggung jawab menjaga data kategori dan memantau aktivitas sistem.
                            </p>
                        </div>

                    </div>
                @else
                    <div class="rounded-[28px] border border-[#dbe8f5] bg-white p-8 shadow-[0_18px_45px_rgba(38,103,184,0.12)]">
                        <h2 class="font-['Playfair_Display'] text-3xl font-bold">
                            Role belum dikenali
                        </h2>

                        <p class="mt-3 text-[#667085]">
                            Hubungi admin untuk memperbaiki role akun.
                        </p>
                    </div>
                @endif

            </div>
        </section>

    </div>
</x-app-layout>