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
                            Admin
                            <span class="text-[#2f80ed]">Dashboard</span>
                        </h1>

                        <p class="mt-5 text-lg leading-8 text-[#667085]">
                            Pantau performa platform Lumiere: user, salon, layanan, booking, revenue, dan rating.
                        </p>
                    </div>

                    <a href="{{ route('admin.categories.index') }}"
                       class="rounded-xl bg-gradient-to-r from-[#2f80ed] to-[#5aa9ff] px-6 py-4 font-extrabold text-white shadow-[0_12px_30px_rgba(47,128,237,0.28)] transition hover:-translate-y-0.5">
                        Kelola Kategori
                    </a>
                </div>

            </div>
        </section>

        <section class="py-14">
            <div class="lumiere-container">

                <div class="grid gap-6 md:grid-cols-2 lg:grid-cols-4">

                    <div class="rounded-[22px] border border-[#dbe8f5] bg-white p-6 shadow-[0_12px_32px_rgba(39,93,152,0.08)]">
                        <p class="text-sm font-bold text-[#667085]">Total User</p>
                        <h2 class="mt-3 text-4xl font-extrabold text-[#172033]">{{ $totalUsers }}</h2>
                    </div>

                    <div class="rounded-[22px] border border-[#dbe8f5] bg-white p-6 shadow-[0_12px_32px_rgba(39,93,152,0.08)]">
                        <p class="text-sm font-bold text-[#667085]">Total Salon</p>
                        <h2 class="mt-3 text-4xl font-extrabold text-[#172033]">{{ $totalSalons }}</h2>
                    </div>

                    <div class="rounded-[22px] border border-[#dbe8f5] bg-white p-6 shadow-[0_12px_32px_rgba(39,93,152,0.08)]">
                        <p class="text-sm font-bold text-[#667085]">Total Layanan</p>
                        <h2 class="mt-3 text-4xl font-extrabold text-[#172033]">{{ $totalServices }}</h2>
                    </div>

                    <div class="rounded-[22px] border border-[#dbe8f5] bg-white p-6 shadow-[0_12px_32px_rgba(39,93,152,0.08)]">
                        <p class="text-sm font-bold text-[#667085]">Total Booking</p>
                        <h2 class="mt-3 text-4xl font-extrabold text-[#172033]">{{ $totalBookings }}</h2>
                    </div>

                </div>

                <div class="mt-6 grid gap-6 md:grid-cols-2 lg:grid-cols-4">

                    <div class="rounded-[22px] border border-green-200 bg-green-50 p-6">
                        <p class="text-sm font-bold text-green-700">Booking Completed</p>
                        <h2 class="mt-3 text-4xl font-extrabold text-green-700">
                            {{ $completedBookings }}
                        </h2>
                    </div>

                    <div class="rounded-[22px] border border-yellow-200 bg-yellow-50 p-6">
                        <p class="text-sm font-bold text-yellow-700">Booking Pending</p>
                        <h2 class="mt-3 text-4xl font-extrabold text-yellow-700">
                            {{ $pendingBookings }}
                        </h2>
                    </div>

                    <div class="rounded-[22px] border border-red-200 bg-red-50 p-6">
                        <p class="text-sm font-bold text-red-700">Booking Cancelled</p>
                        <h2 class="mt-3 text-4xl font-extrabold text-red-700">
                            {{ $cancelledBookings }}
                        </h2>
                    </div>

                    <div class="rounded-[22px] border border-[#dbe8f5] bg-white p-6 shadow-[0_12px_32px_rgba(39,93,152,0.08)]">
                        <p class="text-sm font-bold text-[#667085]">Rata-rata Rating</p>
                        <h2 class="mt-3 text-4xl font-extrabold text-[#f6b93b]">
                            {{ number_format($averageRating ?? 0, 1) }} ★
                        </h2>
                    </div>

                </div>

                <div class="mt-6 rounded-[28px] border border-[#dbe8f5] bg-gradient-to-r from-[#2f80ed] to-[#5aa9ff] p-8 text-white shadow-[0_18px_45px_rgba(38,103,184,0.18)]">
                    <p class="text-sm font-bold text-white/80">Total Revenue</p>
                    <h2 class="mt-3 text-4xl font-extrabold">
                        £ {{ number_format($totalRevenue, 2, ',', '.') }}
                    </h2>
                </div>

                <div class="mt-8 grid gap-6 lg:grid-cols-[1fr_1.2fr]">

                    <div class="rounded-[28px] border border-[#dbe8f5] bg-white p-6 shadow-[0_18px_45px_rgba(38,103,184,0.12)]">
                        <h2 class="mb-4 font-['Playfair_Display'] text-3xl font-bold tracking-[-0.5px] text-[#172033]">
                            Grafik Status Booking
                        </h2>

                        <div class="h-80">
                            <canvas id="bookingStatusChart"></canvas>
                        </div>
                    </div>

                    <div class="rounded-[28px] border border-[#dbe8f5] bg-white p-6 shadow-[0_18px_45px_rgba(38,103,184,0.12)]">
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
                                    </div>

                                    <div class="text-left md:text-right">
                                        <span class="inline-flex rounded-full bg-white px-3 py-1.5 text-xs font-extrabold uppercase tracking-[0.12em] text-[#2f80ed]">
                                            {{ $booking->status_booking }}
                                        </span>

                                        <p class="mt-2 text-sm font-extrabold text-[#20304a]">
                                            £ {{ number_format($booking->total_harga, 2, ',', '.') }}
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

                {{-- ── Storage Link Tool ─────────────────────────────────────────────── --}}
                <div class="mt-8 rounded-[28px] border border-[#dbe8f5] bg-white p-6 shadow-[0_18px_45px_rgba(38,103,184,0.12)]">
                    <div class="flex flex-col justify-between gap-4 md:flex-row md:items-center">
                        <div>
                            <h2 class="font-['Playfair_Display'] text-2xl font-bold tracking-[-0.5px] text-[#172033]">
                                Storage Link
                            </h2>
                            <p class="mt-1 text-sm text-[#667085]">
                                Buat symlink <code class="rounded bg-[#eaf4ff] px-1.5 py-0.5 text-xs font-bold text-[#2f80ed]">public/storage</code>
                                → <code class="rounded bg-[#eaf4ff] px-1.5 py-0.5 text-xs font-bold text-[#2f80ed]">storage/app/public</code>
                                tanpa perlu akses SSH.
                            </p>

                            {{-- Status symlink saat ini --}}
                            @php
                                $linkPath   = public_path('storage');
                                $targetPath = storage_path('app/public');
                                $isLinked   = is_link($linkPath) && readlink($linkPath) === $targetPath;
                            @endphp

                            <div class="mt-3 inline-flex items-center gap-2 rounded-full px-3 py-1.5 text-xs font-bold
                                {{ $isLinked ? 'bg-green-50 text-green-700 border border-green-200' : 'bg-red-50 text-red-700 border border-red-200' }}">
                                <span class="size-2 rounded-full {{ $isLinked ? 'bg-green-500' : 'bg-red-500' }}"></span>
                                {{ $isLinked ? 'Symlink aktif' : 'Symlink belum dibuat' }}
                            </div>
                        </div>

                        <form method="POST" action="{{ route('admin.storage.link') }}">
                            @csrf
                            <button type="submit"
                                    class="rounded-xl bg-gradient-to-r from-[#2f80ed] to-[#5aa9ff] px-6 py-3 font-extrabold text-white shadow-[0_12px_30px_rgba(47,128,237,0.28)] transition hover:-translate-y-0.5 whitespace-nowrap"
                                    onclick="return confirm('Jalankan storage:link sekarang?')">
                                🔗 Buat Storage Link
                            </button>
                        </form>
                    </div>

                    {{-- Flash messages --}}
                    @if(session('success'))
                        <div class="mt-4 rounded-xl border border-green-200 bg-green-50 px-4 py-3 text-sm font-semibold text-green-700">
                            ✓ {{ session('success') }}
                        </div>
                    @endif
                    @if(session('info'))
                        <div class="mt-4 rounded-xl border border-blue-200 bg-blue-50 px-4 py-3 text-sm font-semibold text-blue-700">
                            ℹ {{ session('info') }}
                        </div>
                    @endif
                    @if(session('error'))
                        <div class="mt-4 rounded-xl border border-red-200 bg-red-50 px-4 py-3 text-sm font-semibold text-red-700">
                            ✗ {{ session('error') }}
                        </div>
                    @endif
                </div>

                <div class="mt-8 rounded-[28px] border border-[#dbe8f5] bg-white p-6 shadow-[0_18px_45px_rgba(38,103,184,0.12)]">
                    <h2 class="mb-4 font-['Playfair_Display'] text-3xl font-bold tracking-[-0.5px] text-[#172033]">
                        Grafik Booking Berdasarkan Kategori
                    </h2>

                    <p class="mb-6 text-sm leading-6 text-[#667085]">
                        Menampilkan jumlah booking berdasarkan kategori layanan yang dipilih customer.
                    </p>

                    <div class="h-96">
                        <canvas id="bookingCategoryChart"></canvas>
                    </div>
                </div>

            </div>
        </section>




<script>
    window.addEventListener('load', function () {
        if (typeof Chart === 'undefined') {
            console.error('Chart.js belum tersedia.');
            return;
        }

        const bookingStatusCanvas = document.getElementById('bookingStatusChart');

        if (bookingStatusCanvas) {
            new Chart(bookingStatusCanvas, {
                type: 'doughnut',
                data: {
                    labels: @json(array_keys($bookingChart)),
                    datasets: [{
                        data: @json(array_values($bookingChart)),
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

        const bookingCategoryCanvas = document.getElementById('bookingCategoryChart');

        if (bookingCategoryCanvas) {
            new Chart(bookingCategoryCanvas, {
                type: 'bar',
                data: {
                    labels: @json($bookingByCategory->pluck('nama_category')),
                    datasets: [{
                        label: 'Jumlah Booking',
                        data: @json($bookingByCategory->pluck('total_booking')),
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
                            display: true,
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