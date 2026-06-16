<x-app-layout>
    <div class="min-h-screen bg-white text-[#172033]">

        <section class="border-b border-[#e6f1ff] bg-gradient-to-b from-[#f6fbff] to-white py-14">
            <div class="lumiere-container">

                <div class="flex flex-col justify-between gap-6 md:flex-row md:items-end">
                    <div>
                        <div class="lumiere-badge">
                            ✦ Admin Area
                        </div>

                        <h1 class="mt-6 font-['Playfair_Display'] text-5xl font-bold leading-tight tracking-[-1px] text-[#0f172a] md:text-6xl">
                            Kategori
                            <span class="text-[#2f80ed]">Layanan</span>
                        </h1>

                        <p class="mt-5 text-lg leading-8 text-[#667085]">
                            Kelola kategori layanan yang akan digunakan oleh owner saat membuat service salon.
                        </p>
                    </div>

                    <a href="{{ route('admin.categories.create') }}"
                       class="rounded-xl bg-gradient-to-r from-[#2f80ed] to-[#5aa9ff] px-6 py-4 font-extrabold text-white shadow-[0_12px_30px_rgba(47,128,237,0.28)] transition hover:-translate-y-0.5">
                        Tambah Kategori
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

                @if (session('error'))
                    <div class="mb-6 rounded-xl border border-red-200 bg-red-50 p-4 text-red-700">
                        {{ session('error') }}
                    </div>
                @endif

                <div class="overflow-hidden rounded-[28px] border border-[#dbe8f5] bg-white shadow-[0_18px_45px_rgba(38,103,184,0.12)]">
                    @forelse ($categories as $category)
                        <div class="flex flex-col justify-between gap-4 border-b border-[#dbe8f5] p-6 last:border-b-0 md:flex-row md:items-center">
                            <div>
                                <h2 class="text-2xl font-extrabold text-[#172033]">
                                    {{ $category->nama_category }}
                                </h2>

                                <p class="mt-2 text-sm text-[#667085]">
                                    {{ $category->services()->count() }} layanan
                                </p>
                            </div>

                            <div class="flex gap-2">
                                <a href="{{ route('admin.categories.edit', $category->category_id) }}"
                                   class="rounded-xl border border-[#dbe8f5] bg-[#f6fbff] px-4 py-3 text-sm font-extrabold text-[#2f80ed] transition hover:border-[#2f80ed] hover:bg-[#eaf4ff]">
                                    Edit
                                </a>

                                <form method="POST"
                                      action="{{ route('admin.categories.destroy', $category->category_id) }}">
                                    @csrf
                                    @method('DELETE')

                                    <button
                                        onclick="return confirm('Yakin ingin menghapus kategori ini?')"
                                        class="rounded-xl border border-red-200 bg-red-50 px-4 py-3 text-sm font-extrabold text-red-600 transition hover:bg-red-100">
                                        Hapus
                                    </button>
                                </form>
                            </div>
                        </div>
                    @empty
                        <div class="p-10 text-[#667085]">
                            Belum ada kategori.
                        </div>
                    @endforelse
                </div>

            </div>
        </section>

    </div>
</x-app-layout>