<?php

use App\Models\Salon;
use App\Models\Staff;
use App\Models\Schedule;
use Livewire\Component;

new class extends Component {
    public Salon $salon;

    public ?int $staff_id = null;

    public string $nama_staff = '';
    public string $spesialisasi = '';
    public string $no_hp = '';
    public string $status = 'active';

    public bool $isEditing = false;

    public ?int $selected_staff_id = null;

    public string $hari = 'Monday';
    public string $jam_mulai = '';
    public string $jam_selesai = '';
    public string $schedule_status = 'available';

    public function mount(Salon $salon): void
    {
        abort_if($salon->owner_id !== auth()->id(), 403);
        $this->salon = $salon;
    }

    public function save(): void
    {
        $validated = $this->validate([
            'nama_staff' => ['required', 'max:100'],
            'spesialisasi' => ['nullable', 'max:100'],
            'no_hp' => ['nullable', 'max:20'],
            'status' => ['required', 'in:active,inactive'],
        ]);

        Staff::updateOrCreate(
            ['staff_id' => $this->staff_id],
            [
                'salon_id' => $this->salon->salon_id,
                'nama_staff' => $validated['nama_staff'],
                'spesialisasi' => $validated['spesialisasi'],
                'no_hp' => $validated['no_hp'],
                'status' => $validated['status'],
            ]
        );

        $this->resetForm();

        session()->flash('success', 'Data staff berhasil disimpan.');
    }

    public function edit(int $id): void
    {
        $staff = Staff::where('staff_id', $id)
            ->where('salon_id', $this->salon->salon_id)
            ->firstOrFail();

        $this->staff_id = $staff->staff_id;
        $this->nama_staff = $staff->nama_staff;
        $this->spesialisasi = $staff->spesialisasi ?? '';
        $this->no_hp = $staff->no_hp ?? '';
        $this->status = $staff->status;

        $this->isEditing = true;
    }

        public function selectStaff(int $id): void
        {
            $staff = Staff::where('staff_id', $id)
                ->where('salon_id', $this->salon->salon_id)
                ->firstOrFail();

            $this->selected_staff_id = $staff->staff_id;
        }

        public function saveSchedule(): void
        {
            $validated = $this->validate([
                'selected_staff_id' => ['required', 'exists:staff,staff_id'],
                'hari' => ['required', 'in:Monday,Tuesday,Wednesday,Thursday,Friday,Saturday,Sunday'],
                'jam_mulai' => ['required', 'date_format:H:i'],
                'jam_selesai' => ['required', 'date_format:H:i', 'after:jam_mulai'],
                'schedule_status' => ['required', 'in:available,off'],
            ]);

            $staff = Staff::where('staff_id', $validated['selected_staff_id'])
                ->where('salon_id', $this->salon->salon_id)
                ->firstOrFail();

            Schedule::updateOrCreate(
                [
                    'staff_id' => $staff->staff_id,
                    'hari' => $validated['hari'],
                ],
                [
                    'jam_mulai' => $validated['jam_mulai'],
                    'jam_selesai' => $validated['jam_selesai'],
                    'status' => $validated['schedule_status'],
                ]
            );

            $this->jam_mulai = '';
            $this->jam_selesai = '';
            $this->schedule_status = 'available';

            session()->flash('success', 'Jadwal staff berhasil disimpan.');
        }

        public function deleteSchedule(int $id): void
        {
            $schedule = Schedule::where('schedule_id', $id)
                ->whereHas('staff', function ($query) {
                    $query->where('salon_id', $this->salon->salon_id);
                })
                ->firstOrFail();

            $schedule->delete();

            session()->flash('success', 'Jadwal staff berhasil dihapus.');
        }

        public function getSelectedStaffProperty()
        {
            if (!$this->selected_staff_id) {
                return null;
            }

            return Staff::where('staff_id', $this->selected_staff_id)
                ->where('salon_id', $this->salon->salon_id)
                ->with('schedules')
                ->first();
        }

    public function delete(int $id): void
    {
        $staff = Staff::where('staff_id', $id)
            ->where('salon_id', $this->salon->salon_id)
            ->firstOrFail();

        if ($staff->bookings()->exists()) {
            $staff->update(['status' => 'inactive']);
            session()->flash('success', 'Staff sudah memiliki booking, jadi statusnya diubah menjadi inactive.');
            return;
        }

        $staff->delete();

        session()->flash('success', 'Staff berhasil dihapus.');
    }

    public function resetForm(): void
    {
        $this->staff_id = null;
        $this->nama_staff = '';
        $this->spesialisasi = '';
        $this->no_hp = '';
        $this->status = 'active';
        $this->isEditing = false;
    }

    public function getStaffListProperty()
    {
        return $this->salon->staff()->latest()->get();
    }
};

?>

<div class="grid gap-8 lg:grid-cols-3">

    <div class="rounded-[28px] border border-[#dbe8f5] bg-white p-8 shadow-[0_18px_45px_rgba(38,103,184,0.12)]">
        <h2 class="mb-6 font-['Playfair_Display'] text-3xl font-bold tracking-[-0.5px] text-[#172033]">
            {{ $isEditing ? 'Edit Staff' : 'Tambah Staff' }}
        </h2>

        @if (session('success'))
            <div class="mb-5 rounded-xl border border-green-200 bg-green-50 p-4 text-green-700">
                {{ session('success') }}
            </div>
        @endif

        <form wire:submit.prevent="save" class="space-y-5">

            <div>
                <label class="mb-2 block text-sm font-extrabold text-[#2a4468]">
                    Nama Staff
                </label>

                <input
                    type="text"
                    wire:model="nama_staff"
                    class="w-full rounded-xl border border-[#dbe8f5] bg-white px-4 py-3 text-[#172033] outline-none focus:border-[#2f80ed] focus:ring-4 focus:ring-[#2f80ed]/10"
                >

                @error('nama_staff')
                    <p class="mt-2 text-sm text-red-500">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label class="mb-2 block text-sm font-extrabold text-[#2a4468]">
                    Spesialisasi
                </label>

                <input
                    type="text"
                    wire:model="spesialisasi"
                    class="w-full rounded-xl border border-[#dbe8f5] bg-white px-4 py-3 text-[#172033] outline-none focus:border-[#2f80ed] focus:ring-4 focus:ring-[#2f80ed]/10"
                    placeholder="Contoh: Hair Stylist, Therapist, Nail Artist"
                >
            </div>

            <div>
                <label class="mb-2 block text-sm font-extrabold text-[#2a4468]">
                    No HP
                </label>

                <input
                    type="text"
                    wire:model="no_hp"
                    class="w-full rounded-xl border border-[#dbe8f5] bg-white px-4 py-3 text-[#172033] outline-none focus:border-[#2f80ed] focus:ring-4 focus:ring-[#2f80ed]/10"
                    placeholder="08xxxxxxxxxx"
                >
            </div>

            <div>
                <label class="mb-2 block text-sm font-extrabold text-[#2a4468]">
                    Status
                </label>

                <select
                    wire:model="status"
                    class="w-full rounded-xl border border-[#dbe8f5] bg-white px-4 py-3 text-[#172033] outline-none focus:border-[#2f80ed] focus:ring-4 focus:ring-[#2f80ed]/10"
                >
                    <option value="active">Active</option>
                    <option value="inactive">Inactive</option>
                </select>
            </div>

            <div class="flex flex-wrap gap-3">
                <button
                    class="rounded-xl bg-gradient-to-r from-[#2f80ed] to-[#5aa9ff] px-6 py-4 font-extrabold text-white shadow-[0_12px_30px_rgba(47,128,237,0.28)] transition hover:-translate-y-0.5"
                >
                    {{ $isEditing ? 'Update' : 'Simpan' }}
                </button>

                @if ($isEditing)
                    <button
                        type="button"
                        wire:click="resetForm"
                        class="rounded-xl border border-[#dbe8f5] bg-[#f6fbff] px-6 py-4 font-bold text-[#2f80ed] transition hover:border-[#2f80ed] hover:bg-[#eaf4ff]"
                    >
                        Batal
                    </button>
                @endif
            </div>

        </form>
    </div>

    <div class="rounded-[28px] border border-[#dbe8f5] bg-white p-8 shadow-[0_18px_45px_rgba(38,103,184,0.12)] lg:col-span-2">
        <div class="mb-8">
            <h2 class="font-['Playfair_Display'] text-4xl font-bold tracking-[-0.5px] text-[#172033]">
                Staff List ✦
            </h2>

            <p class="mt-2 text-[#667085]">
                Staff aktif akan muncul di form booking customer.
            </p>
        </div>

        <div class="space-y-5">
            @forelse ($this->staffList as $staff)
                <article class="flex flex-col justify-between gap-5 rounded-[18px] border border-[#dbe8f5] bg-[#f6fbff] p-5 md:flex-row md:items-center">
                    <div>
                        <span class="inline-flex rounded-full bg-white px-3 py-1.5 text-xs font-extrabold uppercase tracking-[0.12em] text-[#2f80ed]">
                            {{ $staff->status }}
                        </span>

                        <h3 class="mt-4 text-2xl font-extrabold text-[#172033]">
                            {{ $staff->nama_staff }}
                        </h3>

                        <p class="mt-2 text-sm text-[#667085]">
                            {{ $staff->spesialisasi ?? 'Tidak ada spesialisasi' }}
                        </p>

                        <p class="mt-1 text-sm text-[#667085]">
                            {{ $staff->no_hp ?? '-' }}
                        </p>
                    </div>

                    <div class="flex gap-2">
                        <button
                            wire:click="edit({{ $staff->staff_id }})"
                            class="rounded-xl border border-[#dbe8f5] bg-white px-4 py-3 text-sm font-extrabold text-[#2f80ed] transition hover:border-[#2f80ed] hover:bg-[#eaf4ff]"
                        >
                            Edit
                        </button>

                        <button
                            wire:click="delete({{ $staff->staff_id }})"
                            wire:confirm="Yakin hapus staff ini?"
                            class="rounded-xl border border-red-200 bg-red-50 px-4 py-3 text-sm font-extrabold text-red-600 transition hover:bg-red-100"
                        >
                            Hapus
                        </button>
                    </div>
                </article>
            @empty
                <div class="rounded-[18px] border border-[#dbe8f5] bg-[#f6fbff] p-8 text-[#667085]">
                    Belum ada staff.
                </div>
            @endforelse
        </div>
    </div>
        <div class="rounded-[28px] border border-[#dbe8f5] bg-white p-8 shadow-[0_18px_45px_rgba(38,103,184,0.12)] lg:col-span-3">
            <div class="mb-8">
                <h2 class="font-['Playfair_Display'] text-4xl font-bold tracking-[-0.5px] text-[#172033]">
                    Jadwal Staff ✦
                </h2>

                <p class="mt-2 text-[#667085]">
                    Atur hari kerja dan jam kerja staff
                </p>
            </div>

            <div class="grid gap-8 lg:grid-cols-3">

                <div class="rounded-[22px] border border-[#dbe8f5] bg-[#f6fbff] p-5">
                    <h3 class="mb-4 text-xl font-extrabold text-[#172033]">
                        Pilih Staff
                    </h3>

                    <div class="space-y-3">
                        @forelse ($this->staffList as $staff)
                            <button
                                type="button"
                                wire:click="selectStaff({{ $staff->staff_id }})"
                                class="block w-full rounded-xl border px-4 py-3 text-left transition
                                    {{ $selected_staff_id === $staff->staff_id
                                        ? 'border-[#2f80ed] bg-[#eaf4ff] text-[#2f80ed]'
                                        : 'border-[#dbe8f5] bg-white text-[#172033] hover:border-[#2f80ed]' }}"
                            >
                                <span class="block font-extrabold">
                                    {{ $staff->nama_staff }}
                                </span>

                                <span class="mt-1 block text-sm text-[#667085]">
                                    {{ $staff->spesialisasi ?? 'Tidak ada spesialisasi' }}
                                </span>
                            </button>
                        @empty
                            <p class="text-sm text-[#667085]">
                                Belum ada staff.
                            </p>
                        @endforelse
                    </div>
                </div>

                <div class="rounded-[22px] border border-[#dbe8f5] bg-white p-5 lg:col-span-2">
                    @if ($this->selectedStaff)
                        <h3 class="mb-5 text-xl font-extrabold text-[#172033]">
                            Kelola Jadwal: {{ $this->selectedStaff->nama_staff }}
                        </h3>

                        <form wire:submit.prevent="saveSchedule" class="grid gap-5 md:grid-cols-2">
                            <div>
                                <label class="mb-2 block text-sm font-extrabold text-[#2a4468]">
                                    Hari
                                </label>

                                <select
                                    wire:model="hari"
                                    class="w-full rounded-xl border border-[#dbe8f5] bg-white px-4 py-3 text-[#172033] outline-none focus:border-[#2f80ed] focus:ring-4 focus:ring-[#2f80ed]/10"
                                >
                                    <option value="Monday">Monday</option>
                                    <option value="Tuesday">Tuesday</option>
                                    <option value="Wednesday">Wednesday</option>
                                    <option value="Thursday">Thursday</option>
                                    <option value="Friday">Friday</option>
                                    <option value="Saturday">Saturday</option>
                                    <option value="Sunday">Sunday</option>
                                </select>

                                @error('hari')
                                    <p class="mt-2 text-sm text-red-500">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label class="mb-2 block text-sm font-extrabold text-[#2a4468]">
                                    Status Jadwal
                                </label>

                                <select
                                    wire:model="schedule_status"
                                    class="w-full rounded-xl border border-[#dbe8f5] bg-white px-4 py-3 text-[#172033] outline-none focus:border-[#2f80ed] focus:ring-4 focus:ring-[#2f80ed]/10"
                                >
                                    <option value="available">Available</option>
                                    <option value="off">Off</option>
                                </select>

                                @error('schedule_status')
                                    <p class="mt-2 text-sm text-red-500">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label class="mb-2 block text-sm font-extrabold text-[#2a4468]">
                                    Jam Mulai
                                </label>

                                <input
                                    type="time"
                                    wire:model="jam_mulai"
                                    class="w-full rounded-xl border border-[#dbe8f5] bg-white px-4 py-3 text-[#172033] outline-none focus:border-[#2f80ed] focus:ring-4 focus:ring-[#2f80ed]/10"
                                >

                                @error('jam_mulai')
                                    <p class="mt-2 text-sm text-red-500">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label class="mb-2 block text-sm font-extrabold text-[#2a4468]">
                                    Jam Selesai
                                </label>

                                <input
                                    type="time"
                                    wire:model="jam_selesai"
                                    class="w-full rounded-xl border border-[#dbe8f5] bg-white px-4 py-3 text-[#172033] outline-none focus:border-[#2f80ed] focus:ring-4 focus:ring-[#2f80ed]/10"
                                >

                                @error('jam_selesai')
                                    <p class="mt-2 text-sm text-red-500">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="md:col-span-2">
                                <button
                                    class="rounded-xl bg-gradient-to-r from-[#2f80ed] to-[#5aa9ff] px-6 py-4 font-extrabold text-white shadow-[0_12px_30px_rgba(47,128,237,0.28)] transition hover:-translate-y-0.5"
                                >
                                    Simpan Jadwal
                                </button>
                            </div>
                        </form>

                        <div class="mt-8">
                            <h4 class="mb-4 text-lg font-extrabold text-[#172033]">
                                Daftar Jadwal
                            </h4>

                            <div class="space-y-3">
                                @forelse ($this->selectedStaff->schedules as $schedule)
                                    <div class="flex flex-col justify-between gap-4 rounded-xl border border-[#dbe8f5] bg-[#f6fbff] p-4 md:flex-row md:items-center">
                                        <div>
                                            <p class="font-extrabold text-[#172033]">
                                                {{ $schedule->hari }}
                                            </p>

                                            <p class="mt-1 text-sm text-[#667085]">
                                                {{ \Carbon\Carbon::parse($schedule->jam_mulai)->format('H:i') }}
                                                -
                                                {{ \Carbon\Carbon::parse($schedule->jam_selesai)->format('H:i') }}
                                                · {{ $schedule->status }}
                                            </p>
                                        </div>

                                        <button
                                            type="button"
                                            wire:click="deleteSchedule({{ $schedule->schedule_id }})"
                                            wire:confirm="Yakin ingin menghapus jadwal ini?"
                                            class="rounded-xl border border-red-200 bg-red-50 px-4 py-3 text-sm font-extrabold text-red-600 transition hover:bg-red-100"
                                        >
                                            Hapus
                                        </button>
                                    </div>
                                @empty
                                    <p class="rounded-xl border border-[#dbe8f5] bg-[#f6fbff] p-5 text-sm text-[#667085]">
                                        Staff ini belum memiliki jadwal.
                                    </p>
                                @endforelse
                            </div>
                        </div>
                    @else
                        <div class="rounded-xl border border-[#dbe8f5] bg-[#f6fbff] p-8 text-[#667085]">
                            Pilih staff terlebih dahulu untuk mengelola jadwal.
                        </div>
                    @endif
                </div>

            </div>
        </div>

</div>