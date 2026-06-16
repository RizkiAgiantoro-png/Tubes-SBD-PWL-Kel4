<x-app-layout>
    <div class="min-h-screen bg-white text-[#172033]">

        <section class="border-b border-[#e6f1ff] bg-gradient-to-b from-[#f6fbff] to-white py-14">
            <div class="lumiere-container">

                <div class="max-w-3xl">
                    <div class="lumiere-badge">
                        ✦ Owner Area
                    </div>

                    <h1 class="mt-6 font-['Playfair_Display'] text-5xl font-bold leading-tight tracking-[-1px] text-[#0f172a] md:text-6xl">
                        Booking
                        <span class="text-[#2f80ed]">Masuk</span>
                    </h1>

                    <p class="mt-5 text-lg leading-8 text-[#667085]">
                        Pantau reservasi customer, detail layanan, pembayaran, dan status booking.
                    </p>
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

                <div class="space-y-6">
                    @forelse ($bookings as $booking)
                        <article class="rounded-[28px] border border-[#dbe8f5] bg-white p-6 shadow-[0_18px_45px_rgba(38,103,184,0.12)]">

                            <div class="flex flex-col justify-between gap-6 lg:flex-row">
                                <div>
                                    <p class="mb-2 text-sm font-extrabold text-[#2f80ed]">
                                        {{ $booking->booking_date }} · {{ $booking->booking_time }}
                                    </p>

                                    <h2 class="font-['Playfair_Display'] text-3xl font-bold tracking-[-0.5px] text-[#172033]">
                                        {{ $booking->salon->nama_salon }}
                                    </h2>

                                    <p class="mt-3 text-sm text-[#667085]">
                                        Customer:
                                        <span class="font-bold text-[#172033]">
                                            {{ $booking->customer->name }}
                                        </span>
                                    </p>

                                    <p class="mt-1 text-sm text-[#667085]">
                                        Staff:
                                        <span class="font-bold text-[#172033]">
                                            {{ $booking->staff ? $booking->staff->nama_staff : 'Bebas staff' }}
                                        </span>
                                    </p>
                                </div>

                                <div class="text-left lg:text-right">
                                    <span class="inline-flex rounded-full bg-[#eaf4ff] px-4 py-2 text-sm font-extrabold uppercase tracking-[0.12em] text-[#2f80ed]">
                                        {{ $booking->status_booking }}
                                    </span>

                                    <p class="mt-4 text-3xl font-extrabold text-[#20304a]">
                                        £ {{ number_format($booking->total_harga, 2, ',', '.') }}
                                    </p>
                                </div>
                            </div>

                            <div class="mt-6 border-t border-[#dbe8f5] pt-5">
                                <h3 class="mb-4 text-lg font-extrabold text-[#172033]">
                                    Detail Layanan
                                </h3>

                                <div class="space-y-3">
                                    @foreach ($booking->details as $detail)
                                        <div class="flex justify-between gap-4 border-b border-[#dbe8f5] pb-3 last:border-b-0">
                                            <div>
                                                <p class="font-bold text-[#172033]">
                                                    {{ $detail->service->nama_service }}
                                                </p>

                                                <p class="text-sm text-[#667085]">
                                                    {{ $detail->service->durasi }} menit
                                                </p>
                                            </div>

                                            <p class="font-extrabold text-[#20304a]">
                                                £ {{ number_format($detail->subtotal, 2, ',', '.') }}
                                            </p>
                                        </div>
                                    @endforeach
                                </div>
                            </div>

                            <div class="mt-6 rounded-[18px] border border-[#dbe8f5] bg-[#f6fbff] p-5">
                                <h3 class="mb-3 text-lg font-extrabold text-[#172033]">
                                    Payment
                                </h3>

                                <div class="grid gap-3 md:grid-cols-2">
                                    <p class="text-sm text-[#667085]">
                                        Metode:
                                        <span class="font-bold text-[#172033]">
                                            {{ $booking->payment->metode_pembayaran ?? '-' }}
                                        </span>
                                    </p>

                                    <p class="text-sm text-[#667085]">
                                        Status:
                                        <span class="font-bold text-[#172033]">
                                            {{ $booking->payment->payment_status ?? '-' }}
                                        </span>
                                    </p>
                                </div>
                            </div>

                            @if (!in_array($booking->status_booking, ['completed', 'cancelled']))
                                <div class="mt-6 flex flex-wrap gap-3 border-t border-[#dbe8f5] pt-5">
                                    <form method="POST"
                                          action="{{ route('owner.bookings.complete', $booking->booking_id) }}">
                                        @csrf
                                        @method('PATCH')

                                        <button
                                            class="rounded-xl bg-gradient-to-r from-[#2f80ed] to-[#5aa9ff] px-5 py-3 font-extrabold text-white shadow-[0_12px_30px_rgba(47,128,237,0.28)] transition hover:-translate-y-0.5">
                                            Selesaikan
                                        </button>
                                    </form>

                                    <form method="POST"
                                          action="{{ route('owner.bookings.cancel', $booking->booking_id) }}">
                                        @csrf
                                        @method('PATCH')

                                        <button
                                            onclick="return confirm('Yakin ingin membatalkan booking ini?')"
                                            class="rounded-xl border border-red-200 bg-red-50 px-5 py-3 font-extrabold text-red-600 transition hover:bg-red-100">
                                            Batalkan
                                        </button>
                                    </form>
                                </div>
                            @endif

                        </article>
                    @empty
                        <div class="rounded-[28px] border border-[#dbe8f5] bg-white p-10 text-center text-[#667085] shadow-[0_18px_45px_rgba(38,103,184,0.12)]">
                            Belum ada booking masuk.
                        </div>
                    @endforelse
                </div>

            </div>
        </section>

    </div>
</x-app-layout>