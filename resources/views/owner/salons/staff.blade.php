<x-app-layout>
    <div class="min-h-screen bg-white text-[#172033]">

        <section class="border-b border-[#e6f1ff] bg-gradient-to-b from-[#f6fbff] to-white py-14">
            <div class="lumiere-container">

                <div class="max-w-3xl">
                    <div class="lumiere-badge">
                        ✦ Owner Staff
                    </div>

                    <h1 class="mt-6 font-['Playfair_Display'] text-5xl font-bold leading-tight tracking-[-1px] text-[#0f172a] md:text-6xl">
                        Staff
                        <span class="text-[#2f80ed]">
                            {{ $salon->nama_salon }}
                        </span>
                    </h1>

                    <p class="mt-5 text-lg leading-8 text-[#667085]">
                        Kelola staff aktif, spesialisasi, dan kontak agar customer bisa memilih staff saat booking.
                    </p>
                </div>

            </div>
        </section>

        <section class="py-14">
            <div class="lumiere-container">
                <livewire:owner.staff-manager :salon="$salon" />
            </div>
        </section>

    </div>
</x-app-layout>