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
                            Partner
                            <span class="text-[#2f80ed]">Dashboard</span>
                        </h1>

                        <p class="mt-5 max-w-3xl text-lg leading-8 text-[#667085]">
                            Pantau performa salon, layanan, staff, booking, dan revenue dari seluruh salon milikmu.
                        </p>
                    </div>

                    <a href="{{ route('owner.salons.index') }}"
                       class="rounded-xl bg-gradient-to-r from-[#2f80ed] to-[#5aa9ff] px-6 py-4 font-extrabold text-white shadow-[0_12px_30px_rgba(47,128,237,0.28)] transition hover:-translate-y-0.5">
                        Kelola Salon
                    </a>
                </div>

            </div>
        </section>

        <section class="py-14">
            <div class="lumiere-container">

                <div class="grid gap-6 md:grid-cols-2 lg:grid-cols-4">
                    <div class="rounded-[22px] border border-[#dbe8f5] bg-white p-6 shadow-[0_12px_32px_rgba(39,93,152,0.08)]">
                        <p class="text-sm font-bold text-[#667085]">Total Salon</p>
                        <h2 class="mt-3 text-4xl font-extrabold text-[#172033]">
                            {{ $totalSalons }}
                        </h2>
                    </div>

                    <div class="rounded-[22px] border border-[#dbe8f5] bg-white p-6 shadow-[0_12px_32px_rgba(39,93,152,0.08)]">
                        <p class="text-sm font-bold text-[#667085]">Total Layanan</p>
                        <h2 class="mt-3 text-4xl font-extrabold text-[#172033]">
                            {{ $totalServices }}
                        </h2>
                    </div>

                    <div class="rounded-[22px] border border-[#dbe8f5] bg-white p-6 shadow-[0_12px_32px_rgba(39,93,152,0.08)]">
                        <p class="text-sm font-bold text-[#667085]">Total Staff</p>
                        <h2 class="mt-3 text-4xl font-extrabold text-[#172033]">
                            {{ $totalStaff }}
                        </h2>
                    </div>

                    <div class="rounded-[22px] border border-[#dbe8f5] bg-white p-6 shadow-[0_12px_32px_rgba(39,93,152,0.08)]">
                        <p class="text-sm font-bold text-[#667085]">Total Booking</p>
                        <h2 class="mt-3 text-4xl font-extrabold text-[#172033]">
                            {{ $totalBookings }}
                        </h2>
                    </div>
                </div>

                <div class="mt-6 grid gap-6 md:grid-cols-2 lg:grid-cols-4">
                    <div class="rounded-[22px] border border-yellow-200 bg-yellow-50 p-6">
                        <p class="text-sm font-bold text-yellow-700">Pending</p>
                        <h2 class="mt-3 text-4xl font-extrabold text-yellow-700">
                            {{ $pendingBookings }}
                        </h2>
                    </div>

                    <div class="rounded-[22px] border border-blue-200 bg-blue-50 p-6">
                        <p class="text-sm font-bold text-blue-700">Paid</p>
                        <h2 class="mt-3 text-4xl font-extrabold text-blue-700">
                            {{ $paidBookings }}
                        </h2>
                    </div>

                    <div class="rounded-[22px] border border-green-200 bg-green-50 p-6">
                        <p class="text-sm font-bold text-green-700">Completed</p>
                        <h2 class="mt-3 text-4xl font-extrabold text-green-700">
                            {{ $completedBookings }}
                        </h2>
                    </div>

                    <div class="rounded-[22px] border border-red-200 bg-red-50 p-6">
                        <p class="text-sm font-bold text-red-700">Cancelled</p>
                        <h2 class="mt-3 text-4xl font-extrabold text-red-700">
                            {{ $cancelledBookings }}
                        </h2>
                    </div>
                </div>

                <div class="mt-6 rounded-[28px] border border-[#dbe8f5] bg-gradient-to-r from-[#2f80ed] to-[#5aa9ff] p-8 text-white shadow-[0_18px_45px_rgba(38,103,184,0.18)]">
                    <p class="text-sm font-bold text-white/80">Total Revenue Owner</p>
                    <h2 class="mt-3 text-4xl font-extrabold">
                        Rp {{ number_format($totalRevenue, 0, ',', '.') }}
                    </h2>
                </div>

                <div class="mt-8 grid gap-6 lg:grid-cols-2">
                    <div class="rounded-[28px] border border-[#dbe8f5] bg-white p-6 shadow-[0_18px_45px_rgba(38,103,184,0.12)]">
                        <h2 class="mb-4 font-['Playfair_Display'] text-3xl font-bold tracking-[-0.5px] text-[#172033]">
                            Grafik Status Booking
                        </h2>

                        <div class="h-80">
                            <canvas id="ownerBookingStatusChart"></canvas>
                        </div>
                    </div>

                    <div class="rounded-[28px] border border-[#dbe8f5] bg-white p-6 shadow-[0_18px_45px_rgba(38,103,184,0.12)]">
                        <h2 class="mb-4 font-['Playfair_Display'] text-3xl font-bold tracking-[-0.5px] text-[#172033]">
                            Booking per Salon
                        </h2>

                        <div class="h-80">
                            <canvas id="ownerBookingPerSalonChart"></canvas>
                        </div>
                    </div>
                </div>

                <div class="mt-8 rounded-[28px] border border-[#dbe8f5] bg-white p-6 shadow-[0_18px_45px_rgba(38,103,184,0.12)]">
                    <h2 class="mb-5 font-['Playfair_Display'] text-3xl font-bold tracking-[-0.5px] text-[#172033]">
                        Booking Terbaru
                    </h2>

                    <div class="space-y-4">
                        @forelse ($latestBookings as $booking)
                            <div class="flex flex-col justify-between gap-4 rounded-[18px] border border-[#dbe8f5] bg-[#f6fbff] p-5 md:flex-row md:items-center">
                                <div>
                                    <p class="font-extrabold text-[#172033]">
                                        {{ $booking->salon->nama_salon }}
                                    </p>

                                    <p class="mt-1 text-sm text-[#667085]">
                                        Customer:
                                        <span class="font-bold text-[#172033]">
                                            {{ $booking->customer->name }}
                                        </span>
                                    </p>

                                    <p class="mt-1 text-sm text-[#667085]">
                                        {{ $booking->booking_date }} · {{ $booking->booking_time }}
                                    </p>

                                    <p class="mt-1 text-sm text-[#667085]">
                                        Staff:
                                        <span class="font-bold text-[#172033]">
                                            {{ $booking->staff?->nama_staff ?? 'Bebas staff' }}
                                        </span>
                                    </p>
                                </div>

                                <div class="text-left md:text-right">
                                    <span class="inline-flex rounded-full bg-white px-3 py-1.5 text-xs font-extrabold uppercase tracking-[0.12em] text-[#2f80ed]">
                                        {{ $booking->status_booking }}
                                    </span>

                                    <p class="mt-2 text-sm font-extrabold text-[#20304a]">
                                        Rp {{ number_format($booking->total_harga, 0, ',', '.') }}
                                    </p>
                                </div>
                            </div>
                        @empty
                            <p class="rounded-[18px] border border-[#dbe8f5] bg-[#f6fbff] p-6 text-[#667085]">
                                Belum ada booking.
                            </p>
                        @endforelse
                    </div>
                </div>

            </div>
        </section>

        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

        <script>
            window.addEventListener('load', function () {
                if (typeof Chart === 'undefined') {
                    console.error('Chart.js belum tersedia.');
                    return;
                }

                const statusCanvas = document.getElementById('ownerBookingStatusChart');

                if (statusCanvas) {
                    new Chart(statusCanvas, {
                        type: 'doughnut',
                        data: {
                            labels: @json(array_keys($bookingStatusChart)),
                            datasets: [{
                                data: @json(array_values($bookingStatusChart)),
                            }]
                        },
                        options: {
                            responsive: true,
                            maintainAspectRatio: false,
                            plugins: {
                                legend: {
                                    position: 'bottom',
                                }
                            }
                        }
                    });
                }

                const perSalonCanvas = document.getElementById('ownerBookingPerSalonChart');

                if (perSalonCanvas) {
                    new Chart(perSalonCanvas, {
                        type: 'bar',
                        data: {
                            labels: @json($bookingPerSalon->pluck('nama_salon')),
                            datasets: [{
                                label: 'Jumlah Booking',
                                data: @json($bookingPerSalon->pluck('total_booking')),
                            }]
                        },
                        options: {
                            responsive: true,
                            maintainAspectRatio: false,
                            scales: {
                                y: {
                                    beginAtZero: true,
                                    ticks: {
                                        precision: 0
                                    }
                                }
                            },
                            plugins: {
                                legend: {
                                    position: 'bottom',
                                }
                            }
                        }
                    });
                }
            });
        </script>

    </div>
</x-app-layout>