<?php

use App\Models\Booking;
use App\Models\BookingDetail;
use App\Models\Payment;
use App\Models\Salon;
use App\Models\Service;
use App\Models\Staff;
use App\Models\Schedule;
use App\Notifications\CustomerBookingCreatedNotification;
use App\Notifications\OwnerNewBookingNotification;
use App\Traits\SendsNotificationSafely;
use Livewire\Component;


new class extends Component {
    use SendsNotificationSafely;
    public Salon $salon;

    public $selected_services = [];
    public string $staff_id = '';
    public string $booking_date = '';
    public string $booking_time = '';
    public string $metode_pembayaran = 'cash';

    public function mount(Salon $salon): void
    {
        $this->salon = $salon;
    }

    public function book()
    {
        $validated = $this->validate([
            'selected_services' => ['required', 'array', 'min:1'],
            'selected_services.*' => ['exists:services,service_id'],
            'staff_id' => ['nullable', 'exists:staff,staff_id'],
            'booking_date' => ['required', 'date', 'after_or_equal:today'],
            'booking_time' => ['required', 'date_format:H:i'],
            // 'metode_pembayaran' => ['required', 'in:cash,transfer,ewallet,credit_card'],
        ]);

        $services = Service::whereIn('service_id', $validated['selected_services'])
            ->where('salon_id', $this->salon->salon_id)
            ->get();

        if ($services->count() !== count($validated['selected_services'])) {
            $this->addError('selected_services', 'Ada layanan yang tidak valid.');
            return;
        }

        $totalHarga = $services->sum('harga');
        $totalDurasi = $services->sum('durasi');
        $requestedStart = \Carbon\Carbon::parse(
            $validated['booking_date'] . ' ' . $validated['booking_time']
        );

        $requestedEnd = $requestedStart->copy()->addMinutes($totalDurasi);

        $salonOpen = \Carbon\Carbon::parse(
            $validated['booking_date'] . ' ' . $this->salon->jam_buka
        );

        $salonClose = \Carbon\Carbon::parse(
            $validated['booking_date'] . ' ' . $this->salon->jam_tutup
        );

        if ($requestedStart < $salonOpen || $requestedEnd > $salonClose) {
            $this->addError(
                'booking_time',
                'Jam booking harus berada dalam jam operasional salon.'
            );

            return;
        }

        if ($validated['staff_id']) {
            $dayName = $requestedStart->format('l');

            $staffSchedule = Schedule::where('staff_id', $validated['staff_id'])
                ->where('hari', $dayName)
                ->where('status', 'available')
                ->first();

            if (!$staffSchedule) {
                $this->addError(
                    'booking_date',
                    'Staff tidak memiliki jadwal tersedia pada hari tersebut.'
                );

                return;
            }

            $staffStart = \Carbon\Carbon::parse(
                $validated['booking_date'] . ' ' . $staffSchedule->jam_mulai
            );

            $staffEnd = \Carbon\Carbon::parse(
                $validated['booking_date'] . ' ' . $staffSchedule->jam_selesai
            );

            if ($requestedStart < $staffStart || $requestedEnd > $staffEnd) {
                $this->addError(
                    'booking_time',
                    'Jam booking berada di luar jadwal kerja staff.'
                );

                return;
            }

            $existingBookings = Booking::with('details.service')
                ->where('staff_id', $validated['staff_id'])
                ->where('booking_date', $validated['booking_date'])
                ->whereIn('status_booking', ['pending', 'paid'])
                ->get();

            foreach ($existingBookings as $existingBooking) {
                $existingStart = \Carbon\Carbon::parse(
                    $existingBooking->booking_date . ' ' . $existingBooking->booking_time
                );

                $existingDuration = $existingBooking->details->sum(function ($detail) {
                    return $detail->service->durasi * $detail->qty;
                });

                $existingEnd = $existingStart->copy()->addMinutes($existingDuration);

                $isOverlap = $requestedStart < $existingEnd
                    && $requestedEnd > $existingStart;

                if ($isOverlap) {
                    $this->addError(
                        'booking_time',
                        'Staff sudah memiliki booking pada rentang waktu tersebut.'
                    );

                    return;
                }
            }
        }

        $booking = Booking::create([
            'customer_id' => auth()->id(),
            'salon_id' => $this->salon->salon_id,
            'staff_id' => $validated['staff_id'] ?: null,
            'booking_date' => $validated['booking_date'],
            'booking_time' => $validated['booking_time'],
            'total_harga' => $totalHarga,
            'status_booking' => 'pending'
        ]);

    foreach ($services as $service) {
        BookingDetail::create([
            'booking_id' => $booking->booking_id,
            'service_id' => $service->service_id,
            'qty' => 1,
            'subtotal' => $service->harga,
        ]);
    }

            Payment::create([
                'booking_id' => $booking->booking_id,
                'metode_pembayaran' => 'midtrans',
                'payment_date' => null,
                'total_bayar' => $totalHarga,
                'payment_status' => 'pending',
            ]);
            $booking->load(['salon.owner', 'staff', 'details.service', 'payment']);

            // Kirim ke user yang sedang login (bukan dari relasi DB)
            $this->notifySafely(
                auth()->user(),
                new CustomerBookingCreatedNotification($booking)
            );

            $this->notifySafely(
                $booking->salon->owner,
                new OwnerNewBookingNotification($booking)
            );
        session()->flash('success', 'Booking berhasil dibuat.');

        return redirect()->route('customer.bookings.index');
    }

    public function getServicesProperty()
    {
        return $this->salon->services()->with('category')->get();
    }

    public function getStaffListProperty()
    {
        return $this->salon->staff()->where('status', 'active')->get();
    }


    public function getSelectedServicesDataProperty()
    {
        if (empty($this->selected_services)) {
            return collect();
        }

        return Service::whereIn('service_id', $this->selected_services)
            ->where('salon_id', $this->salon->salon_id)
            ->get();
    }

    public function getTotalHargaProperty()
    {
        return $this->selectedServicesData->sum('harga');
    }

    public function getTotalDurasiProperty()
    {
        return $this->selectedServicesData->sum('durasi');
    }
};

?>

<div class="rounded-[28px] border border-[#dbe8f5] bg-white p-6 shadow-[0_18px_45px_rgba(38,103,184,0.12)]">

    <h2 class="mb-6 font-['Playfair_Display'] text-3xl font-bold tracking-[-0.5px] text-[#172033]">
        Detail Booking
    </h2>

    @if (session()->has('success'))
        <div class="mb-5 rounded-xl border border-green-200 bg-green-50 p-4 text-green-700">
            {{ session('success') }}
        </div>
    @endif

    <form wire:submit.prevent="book" class="space-y-6">

        <div>
            <label class="mb-3 block text-sm font-extrabold text-[#2a4468]">
                Pilih Layanan
            </label>

            <div class="space-y-3">
                @forelse ($this->services as $service)
                    <label class="flex cursor-pointer items-start gap-4 rounded-2xl border border-[#dbe8f5] bg-[#f6fbff] p-4 transition hover:border-[#2f80ed] hover:bg-[#eaf4ff]">
                        <input
                            type="checkbox"
                            wire:model.live="selected_services"
                            value="{{ (string) $service->service_id }}"
                            class="mt-1 rounded border-[#dbe8f5] text-[#2f80ed] focus:ring-[#2f80ed]"
                        >

                        <div class="flex-1">
                            <p class="font-extrabold text-[#172033]">
                                {{ $service->nama_service }}
                            </p>

                            <p class="mt-1 text-sm text-[#667085]">
                                {{ $service->category->nama_category }}
                                · {{ $service->durasi }} menit
                            </p>
                        </div>

                        <p class="shrink-0 font-extrabold text-[#20304a]">
                            £ {{ number_format($service->harga, 2, ',', '.') }}
                        </p>
                    </label>
                @empty
                    <div class="rounded-2xl border border-[#dbe8f5] bg-[#f6fbff] p-5 text-[#667085]">
                        Belum ada layanan tersedia.
                    </div>
                @endforelse
            </div>

            @error('selected_services')
                <p class="mt-2 text-sm text-red-500">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label class="mb-2 block text-sm font-extrabold text-[#2a4468]">
                Pilih Staff
            </label>

            <select
                wire:model="staff_id"
                class="w-full rounded-xl border border-[#dbe8f5] bg-white px-4 py-3 text-[#172033] outline-none focus:border-[#2f80ed] focus:ring-4 focus:ring-[#2f80ed]/10"
            >
                <option value="">Bebas staff</option>

                @foreach ($this->staffList as $staff)
                    <option value="{{ $staff->staff_id }}">
                        {{ $staff->nama_staff }}
                        @if ($staff->spesialisasi)
                            — {{ $staff->spesialisasi }}
                        @endif
                    </option>
                @endforeach
            </select>

            @error('staff_id')
                <p class="mt-2 text-sm text-red-500">{{ $message }}</p>
            @enderror

            <p class="mt-2 text-xs font-semibold text-[#667085]">
                Jika memilih staff tertentu, jadwal booking harus sesuai dengan jadwal kerja staff tersebut.
            </p>
        </div>

        <div class="grid gap-5 md:grid-cols-2">
            <div>
                <label class="mb-2 block text-sm font-extrabold text-[#2a4468]">
                    Tanggal Booking
                </label>

                <input
                    type="date"
                    wire:model="booking_date"
                    class="w-full rounded-xl border border-[#dbe8f5] bg-white px-4 py-3 text-[#172033] outline-none focus:border-[#2f80ed] focus:ring-4 focus:ring-[#2f80ed]/10"
                >

                @error('booking_date')
                    <p class="mt-2 text-sm text-red-500">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label class="mb-2 block text-sm font-extrabold text-[#2a4468]">
                    Jam Booking
                </label>

                <input
                    type="time"
                    wire:model="booking_time"
                    class="w-full rounded-xl border border-[#dbe8f5] bg-white px-4 py-3 text-[#172033] outline-none focus:border-[#2f80ed] focus:ring-4 focus:ring-[#2f80ed]/10"
                >
                <p class="mt-2 text-xs font-semibold text-[#667085]">
                    Jam operasional salon:
                    {{ \Carbon\Carbon::parse($salon->jam_buka)->format('H:i') }}
                    -
                    {{ \Carbon\Carbon::parse($salon->jam_tutup)->format('H:i') }}
                </p>
                @error('booking_time')
                    <p class="mt-2 text-sm text-red-500">{{ $message }}</p>
                @enderror
            </div>
        </div>

        {{-- <div>
            <label class="mb-2 block text-sm font-extrabold text-[#2a4468]">
                Metode Pembayaran
            </label>

            <select
                wire:model="metode_pembayaran"
                class="w-full rounded-xl border border-[#dbe8f5] bg-white px-4 py-3 text-[#172033] outline-none focus:border-[#2f80ed] focus:ring-4 focus:ring-[#2f80ed]/10"
            >
                <option value="cash">Cash di Salon</option>
                <option value="transfer">Transfer</option>
                <option value="ewallet">E-Wallet</option>
                <option value="credit_card">Credit Card</option>
            </select>

            @error('metode_pembayaran')
                <p class="mt-2 text-sm text-red-500">{{ $message }}</p>
            @enderror
        </div> --}}

        <div class="rounded-[22px] border border-[#dbe8f5] bg-[#f6fbff] p-5">
            <h3 class="mb-4 text-lg font-extrabold text-[#172033]">
                Ringkasan Booking
            </h3>

            @if ($this->selectedServicesData->count())
                <div class="space-y-3">
                    @foreach ($this->selectedServicesData as $service)
                        <div class="flex justify-between gap-4 border-b border-[#dbe8f5] pb-3 text-sm last:border-b-0">
                            <span class="font-semibold text-[#667085]">
                                {{ $service->nama_service }}
                            </span>

                            <span class="font-extrabold text-[#20304a]">
                                £ {{ number_format($service->harga, 2, ',', '.') }}
                            </span>
                        </div>
                    @endforeach
                </div>

                <div class="mt-5 border-t border-[#dbe8f5] pt-5">
                    <p class="text-sm font-semibold text-[#667085]">
                        Total Durasi: {{ $this->totalDurasi }} menit
                    </p>

                    <p class="mt-2 text-3xl font-extrabold text-[#2f80ed]">
                        £ {{ number_format($this->totalHarga, 2, ',', '.') }}
                    </p>
                </div>
            @else
                <p class="text-sm text-[#667085]">
                    Belum ada layanan dipilih.
                </p>
            @endif
        </div>

        <button
            class="w-full rounded-xl bg-gradient-to-r from-[#2f80ed] to-[#5aa9ff] px-5 py-4 font-extrabold text-white shadow-[0_12px_30px_rgba(47,128,237,0.28)] transition hover:-translate-y-0.5"
        >
            Buat Booking
        </button>

    </form>
</div>