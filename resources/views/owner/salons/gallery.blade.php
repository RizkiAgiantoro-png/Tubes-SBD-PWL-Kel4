<x-app-layout>
    <div class="min-h-screen bg-white text-[#172033]">

        <section class="border-b border-[#e6f1ff] bg-gradient-to-b from-[#f6fbff] to-white py-14">
            <div class="lumiere-container">

                <div class="max-w-3xl">
                    <div class="lumiere-badge">
                        ✦ Owner Gallery
                    </div>

                    <h1 class="mt-6 font-['Playfair_Display'] text-5xl font-bold leading-tight tracking-[-1px] text-[#0f172a] md:text-6xl">
                        Gallery
                        <span class="text-[#2f80ed]">
                            {{ $salon->nama_salon }}
                        </span>
                    </h1>

                    <p class="mt-5 text-lg leading-8 text-[#667085]">
                        Upload gambar, atur thumbnail utama, dan kelola visual salon agar tampil menarik di halaman customer.
                    </p>
                </div>

            </div>
        </section>

        <section class="py-14">
            <div class="lumiere-container">
                <livewire:owner.salon-image-upload :salon="$salon" />
            </div>
        </section>

    </div>
</x-app-layout>