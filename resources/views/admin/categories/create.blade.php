<x-app-layout>
    <div class="min-h-screen bg-white text-[#172033]">

        <section class="border-b border-[#e6f1ff] bg-gradient-to-b from-[#f6fbff] to-white py-14">
            <div class="lumiere-container max-w-3xl">

                <div class="max-w-2xl">
                    <div class="lumiere-badge">
                        ✦ Admin Area
                    </div>

                    <h1 class="mt-6 font-['Playfair_Display'] text-5xl font-bold leading-tight tracking-[-1px] text-[#0f172a] md:text-6xl">
                        Tambah
                        <span class="text-[#2f80ed]">Kategori</span>
                    </h1>

                    <p class="mt-5 text-lg leading-8 text-[#667085]">
                        Buat kategori baru untuk mengelompokkan layanan salon.
                    </p>
                </div>

            </div>
        </section>

        <section class="py-14">
            <div class="lumiere-container max-w-3xl">

                <form method="POST"
                      action="{{ route('admin.categories.store') }}"
                      class="rounded-[28px] border border-[#dbe8f5] bg-white p-8 shadow-[0_18px_45px_rgba(38,103,184,0.12)]">
                    @csrf

                    <div class="mb-6">
                        <label class="mb-2 block text-sm font-extrabold text-[#2a4468]">
                            Nama Kategori
                        </label>

                        <input
                            type="text"
                            name="nama_category"
                            value="{{ old('nama_category') }}"
                            placeholder="Contoh: Hair Treatment"
                            class="w-full rounded-xl border border-[#dbe8f5] bg-white px-4 py-3 text-[#172033] outline-none focus:border-[#2f80ed] focus:ring-4 focus:ring-[#2f80ed]/10"
                        >

                        @error('nama_category')
                            <p class="mt-2 text-sm text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="flex flex-wrap gap-3">
                        <button
                            class="rounded-xl bg-gradient-to-r from-[#2f80ed] to-[#5aa9ff] px-6 py-4 font-extrabold text-white shadow-[0_12px_30px_rgba(47,128,237,0.28)] transition hover:-translate-y-0.5"
                        >
                            Simpan
                        </button>

                        <a href="{{ route('admin.categories.index') }}"
                           class="rounded-xl border border-[#dbe8f5] bg-[#f6fbff] px-6 py-4 font-bold text-[#2f80ed] transition hover:border-[#2f80ed] hover:bg-[#eaf4ff]">
                            Batal
                        </a>
                    </div>
                </form>

            </div>
        </section>

    </div>
</x-app-layout>