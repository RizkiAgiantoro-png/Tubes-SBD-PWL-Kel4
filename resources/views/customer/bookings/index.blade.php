<x-app-layout>
    <div class="min-h-screen bg-white text-[#172033]">

        <section class="border-b border-[#e6f1ff] bg-gradient-to-b from-[#f6fbff] to-white py-14">
            <div class="lumiere-container">

                <div class="max-w-3xl">
                    <div class="lumiere-badge">
                        ✦ Customer Area
                    </div>

                    <h1 class="mt-6 font-['Playfair_Display'] text-5xl font-bold leading-tight tracking-[-1px] text-[#0f172a] md:text-6xl">
                        Riwayat
                        <span class="text-[#2f80ed]">Booking</span>
                    </h1>

                    <p class="mt-5 text-lg leading-8 text-[#667085]">
                        Lihat status booking, pembayaran, treatment yang dipilih, dan review yang sudah kamu kirim.
                    </p>
                </div>

            </div>
        </section>

        <section class="py-14">
            <div class="lumiere-container max-w-5xl">

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

                                    @if ($booking->staff)
                                        <p class="mt-3 text-sm text-[#667085]">
                                            Staff:
                                            <span class="font-bold text-[#172033]">
                                                {{ $booking->staff->nama_staff }}
                                            </span>
                                        </p>
                                    @endif
                                </div>

                                <div class="text-left lg:text-right">
                                    <span class="inline-flex rounded-full bg-[#eaf4ff] px-4 py-2 text-sm font-extrabold uppercase tracking-[0.12em] text-[#2f80ed]">
                                        {{ $booking->status_booking }}
                                    </span>

                                    <p class="mt-4 text-3xl font-extrabold text-[#20304a]">
                                        £{{ number_format($booking->total_harga, 2, '.', ',') }}
                                    </p>
                                </div>

                            </div>

                            <div class="mt-6 border-t border-[#dbe8f5] pt-5">

                                <h3 class="mb-4 text-lg font-extrabold text-[#172033]">
                                    Detail Treatment
                                </h3>

                                <div class="space-y-3">
                                    @foreach ($booking->details as $detail)
                                        <div class="flex items-center justify-between gap-4 border-b border-[#dbe8f5] pb-3 last:border-b-0">
                                            <div>
                                                <p class="font-bold text-[#172033]">
                                                    {{ $detail->service->nama_service }}
                                                </p>

                                                <p class="text-sm text-[#667085]">
                                                    {{ $detail->service->durasi }} menit
                                                </p>
                                            </div>

                                            <p class="font-extrabold text-[#20304a]">
                                                £{{ number_format($detail->subtotal, 2, ',', '.') }}
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

                            @if ($booking->payment && $booking->payment->payment_status === 'pending')
                                <div class="mt-5">
                                    <a
                                        href="{{ route('customer.bookings.pay', $booking->booking_id) }}"
                                        class="inline-block rounded-xl bg-gradient-to-r from-[#2f80ed] to-[#5aa9ff] px-5 py-3 font-extrabold text-white shadow-[0_12px_30px_rgba(47,128,237,0.28)] transition hover:-translate-y-0.5"
                                    >
                                        Bayar Sekarang
                                    </a>
                                </div>
                            @endif

                            @if (session('success') && session('success_booking_id') == $booking->booking_id)
                                <div class="mt-5 rounded-xl border border-green-200 bg-green-50 p-4 text-green-700">
                                    {{ session('success') }}
                                </div>
                            @endif

                            @if (session('error'))
                                <div class="mt-5 rounded-xl border border-red-200 bg-red-50 p-4 text-red-700">
                                    {{ session('error') }}
                                </div>
                            @endif

                            @if ($booking->status_booking === 'completed' && !$booking->review)

                                <form
                                    method="POST"
                                    action="{{ route('customer.reviews.store', $booking->booking_id) }}"
                                    class="mt-6 border-t border-[#dbe8f5] pt-6"
                                >
                                    @csrf

                                    <h3 class="mb-4 font-['Playfair_Display'] text-2xl font-bold text-[#172033]">
                                        Beri Review
                                    </h3>

                                    <div class="mb-4">
                                        <label class="mb-2 block text-sm font-extrabold text-[#2a4468]">
                                            Rating
                                        </label>

                                        <select
                                            name="rating"
                                            class="w-full rounded-xl border border-[#dbe8f5] bg-white px-4 py-3 text-[#172033] outline-none focus:border-[#2f80ed] focus:ring-4 focus:ring-[#2f80ed]/10"
                                        >
                                            <option value="">Pilih Rating</option>
                                            <option value="5">5 - Sangat Puas</option>
                                            <option value="4">4 - Puas</option>
                                            <option value="3">3 - Cukup</option>
                                            <option value="2">2 - Kurang</option>
                                            <option value="1">1 - Buruk</option>
                                        </select>
                                    </div>

                                    <div class="mb-4">
                                        <label class="mb-2 block text-sm font-extrabold text-[#2a4468]">
                                            Komentar
                                        </label>

                                        <textarea
                                            name="komentar"
                                            rows="4"
                                            placeholder="Bagikan pengalaman treatment kamu..."
                                            class="w-full rounded-xl border border-[#dbe8f5] bg-white px-4 py-3 text-[#172033] outline-none focus:border-[#2f80ed] focus:ring-4 focus:ring-[#2f80ed]/10"
                                        ></textarea>
                                    </div>

                                    <button
                                        class="rounded-xl bg-gradient-to-r from-[#2f80ed] to-[#5aa9ff] px-5 py-3 font-extrabold text-white shadow-[0_12px_30px_rgba(47,128,237,0.28)] transition hover:-translate-y-0.5"
                                    >
                                        Kirim Review
                                    </button>

                                </form>

                            @elseif ($booking->review)

                                <div class="mt-6 border-t border-[#dbe8f5] pt-6">

                                    <h3 class="mb-4 font-['Playfair_Display'] text-2xl font-bold text-[#172033]">
                                        Review Kamu
                                    </h3>

                                    <p class="font-extrabold text-[#f6b93b]">
                                        {{ str_repeat('★', $booking->review->rating) }}
                                    </p>

                                    <p class="mt-3 max-w-2xl text-sm leading-7 text-[#667085]">
                                        {{ $booking->review->komentar }}
                                    </p>

                                </div>

                            @endif

                        </article>

                    @empty

                        <div class="rounded-[28px] border border-[#dbe8f5] bg-white p-10 text-center text-[#667085] shadow-[0_18px_45px_rgba(38,103,184,0.12)]">
                            Belum ada booking.
                        </div>

                    @endforelse
                </div>

            </div>
        </section>

    </div>
</x-app-layout>