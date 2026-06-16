<x-app-layout>
    <div class="min-h-screen bg-white text-[#172033]">

        <section class="border-b border-[#e6f1ff] bg-gradient-to-b from-[#f6fbff] to-white py-14">
            <div class="lumiere-container">

                <div class="flex flex-col justify-between gap-6 md:flex-row md:items-end">
                    <div>
                        <div class="lumiere-badge">
                            ✦ Owner Area
                        </div>

                        <h1 class="mt-6 font-['Playfair_Display'] text-5xl font-bold leading-tight tracking-[-1px] text-[#0f172a] md:text-6xl">
                            My
                            <span class="text-[#2f80ed]">Salons</span>
                        </h1>

                        <p class="mt-5 text-lg leading-8 text-[#667085]">
                            Kelola salon, gallery, layanan, staff, dan booking customer dari satu dashboard partner.
                        </p>
                    </div>

                    <a href="{{ route('owner.salons.create') }}"
                       class="rounded-xl bg-gradient-to-r from-[#2f80ed] to-[#5aa9ff] px-6 py-4 font-extrabold text-white shadow-[0_12px_30px_rgba(47,128,237,0.28)] transition hover:-translate-y-0.5">
                        Add Salon
                    </a>
                </div>

            </div>
        </section>

        <section class="py-14">
            <div class="lumiere-container">

                @if (session('success'))
                    <div class="mb-6 rounded-xl border border-green-200 bg-green-50 p-4 text-green-700">
                        {{ session('success') }}
                    </div>
                @endif

                <div class="grid gap-6 md:grid-cols-2 xl:grid-cols-3">
                    @forelse($salons as $salon)
                        <article class="rounded-[28px] border border-[#dbe8f5] bg-white p-6 shadow-[0_18px_45px_rgba(38,103,184,0.12)] transition hover:-translate-y-1">

                            <div class="mb-5 flex items-start justify-between gap-4">
                                <div>
                                    <span class="inline-flex rounded-full bg-[#eaf4ff] px-3 py-1.5 text-xs font-extrabold uppercase tracking-[0.12em] text-[#2f80ed]">
                                        {{ $salon->status }}
                                    </span>

                                    <h2 class="mt-4 font-['Playfair_Display'] text-3xl font-bold tracking-[-0.5px] text-[#172033]">
                                        {{ $salon->nama_salon }}
                                    </h2>
                                </div>

                                <span class="shrink-0 font-extrabold text-[#f6b93b]">
                                    ★ {{ number_format($salon->rating, 1) }}
                                </span>
                            </div>

                            <p class="line-clamp-2 text-sm leading-7 text-[#667085]">
                                {{ $salon->alamat }}
                            </p>

                            <div class="mt-6 grid grid-cols-2 gap-3">
                                <a href="{{ route('owner.salons.edit', $salon->salon_id) }}"
                                   class="rounded-xl border border-[#dbe8f5] bg-[#f6fbff] px-3 py-3 text-center text-sm font-bold text-[#2f80ed] transition hover:border-[#2f80ed] hover:bg-[#eaf4ff]">
                                    Edit
                                </a>

                                <a href="{{ route('owner.salons.gallery', $salon->salon_id) }}"
                                   class="rounded-xl border border-[#dbe8f5] bg-[#f6fbff] px-3 py-3 text-center text-sm font-bold text-[#2f80ed] transition hover:border-[#2f80ed] hover:bg-[#eaf4ff]">
                                    Gallery
                                </a>

                                <a href="{{ route('owner.salons.services', $salon->salon_id) }}"
                                   class="rounded-xl border border-[#dbe8f5] bg-[#f6fbff] px-3 py-3 text-center text-sm font-bold text-[#2f80ed] transition hover:border-[#2f80ed] hover:bg-[#eaf4ff]">
                                    Services
                                </a>

                                <a href="{{ route('owner.salons.staff', $salon->salon_id) }}"
                                   class="rounded-xl border border-[#dbe8f5] bg-[#f6fbff] px-3 py-3 text-center text-sm font-bold text-[#2f80ed] transition hover:border-[#2f80ed] hover:bg-[#eaf4ff]">
                                    Staff
                                </a>
                            </div>

                            <form method="POST"
                                  action="{{ route('owner.salons.destroy', $salon->salon_id) }}"
                                  class="mt-3">
                                @csrf
                                @method('DELETE')

                                <button
                                    onclick="return confirm('Yakin ingin menghapus salon ini?')"
                                    class="w-full rounded-xl border border-red-200 bg-red-50 px-3 py-3 text-sm font-bold text-red-600 transition hover:bg-red-100">
                                    Delete
                                </button>
                            </form>

                        </article>
                    @empty
                        <div class="rounded-[28px] border border-[#dbe8f5] bg-white p-10 text-[#667085] shadow-[0_18px_45px_rgba(38,103,184,0.12)]">
                            Belum ada salon.
                        </div>
                    @endforelse
                </div>

            </div>
        </section>

    </div>
</x-app-layout>