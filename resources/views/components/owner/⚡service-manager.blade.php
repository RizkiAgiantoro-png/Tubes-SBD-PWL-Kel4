<?php

use App\Models\Salon;
use App\Models\Service;
use App\Models\Category;
use Livewire\Component;

new class extends Component {
    public Salon $salon;

    public $service_id = null;
    public $category_id = '';
    public $nama_service = '';
    public $durasi = '';
    public $harga = '';
    public $deskripsi = '';

    public bool $isEditing = false;

    public function mount(Salon $salon): void
    {
        abort_if($salon->owner_id !== auth()->id(), 403);

        $this->salon = $salon;
    }

    public function save(): void
    {
        $this->validate([
            'category_id' => ['required', 'exists:categories,category_id'],
            'nama_service' => ['required', 'max:150'],
            'durasi' => ['required', 'integer', 'min:15'],
            'harga' => ['required', 'numeric', 'min:0'],
            'deskripsi' => ['nullable'],
        ]);

        Service::updateOrCreate(
            ['service_id' => $this->service_id],
            [
                'salon_id' => $this->salon->salon_id,
                'category_id' => $this->category_id,
                'nama_service' => $this->nama_service,
                'durasi' => $this->durasi,
                'harga' => $this->harga,
                'deskripsi' => $this->deskripsi,
            ]
        );

        $this->resetForm();

        session()->flash('success', 'Layanan berhasil disimpan.');
    }

    public function edit(int $id): void
    {
        $service = Service::where('service_id', $id)
            ->where('salon_id', $this->salon->salon_id)
            ->firstOrFail();

        $this->service_id = $service->service_id;
        $this->category_id = $service->category_id;
        $this->nama_service = $service->nama_service;
        $this->durasi = $service->durasi;
        $this->harga = $service->harga;
        $this->deskripsi = $service->deskripsi;

        $this->isEditing = true;
    }

    public function delete(int $id): void
    {
        $service = Service::where('service_id', $id)
            ->where('salon_id', $this->salon->salon_id)
            ->firstOrFail();

        if ($service->bookingDetails()->exists()) {
            session()->flash('error', 'Layanan tidak bisa dihapus karena sudah pernah dibooking.');
            return;
        }

        $service->delete();

        session()->flash('success', 'Layanan berhasil dihapus.');
    }

    public function resetForm(): void
    {
        $this->service_id = null;
        $this->category_id = '';
        $this->nama_service = '';
        $this->durasi = '';
        $this->harga = '';
        $this->deskripsi = '';
        $this->isEditing = false;
    }

    public function getServicesProperty()
    {
        return $this->salon
            ->services()
            ->with('category')
            ->latest()
            ->get();
    }

    public function getCategoriesProperty()
    {
        return Category::orderBy('nama_category')->get();
    }
};

?>

<div class="space-y-10">

    @if (session()->has('success'))
        <div class="rounded-xl border border-green-200 bg-green-50 p-4 text-green-700">
            {{ session('success') }}
        </div>
    @endif

    <form
        wire:submit.prevent="save"
        class="rounded-[28px] border border-[#dbe8f5] bg-white p-8 shadow-[0_18px_45px_rgba(38,103,184,0.12)]"
    >

        <h2 class="mb-6 font-['Playfair_Display'] text-3xl font-bold tracking-[-0.5px] text-[#172033]">
            {{ $isEditing ? 'Edit Layanan' : 'Tambah Layanan' }}
        </h2>

        <div class="mb-5">
            <label class="mb-2 block text-sm font-extrabold text-[#2a4468]">
                Kategori
            </label>

            <select
                wire:model="category_id"
                class="w-full rounded-xl border border-[#dbe8f5] bg-white px-4 py-3 text-[#172033] outline-none focus:border-[#2f80ed] focus:ring-4 focus:ring-[#2f80ed]/10"
            >
                <option value="">Pilih kategori</option>

                @foreach ($this->categories as $category)
                    <option value="{{ $category->category_id }}">
                        {{ $category->nama_category }}
                    </option>
                @endforeach
            </select>

            @error('category_id')
                <p class="mt-2 text-sm text-red-500">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-5">
            <label class="mb-2 block text-sm font-extrabold text-[#2a4468]">
                Nama Layanan
            </label>

            <input
                type="text"
                wire:model="nama_service"
                class="w-full rounded-xl border border-[#dbe8f5] bg-white px-4 py-3 text-[#172033] outline-none focus:border-[#2f80ed] focus:ring-4 focus:ring-[#2f80ed]/10"
            >

            @error('nama_service')
                <p class="mt-2 text-sm text-red-500">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-5 grid gap-5 md:grid-cols-2">
            <div>
                <label class="mb-2 block text-sm font-extrabold text-[#2a4468]">
                    Durasi Menit
                </label>

                <input
                    type="number"
                    wire:model="durasi"
                    class="w-full rounded-xl border border-[#dbe8f5] bg-white px-4 py-3 text-[#172033] outline-none focus:border-[#2f80ed] focus:ring-4 focus:ring-[#2f80ed]/10"
                    placeholder="90"
                >

                @error('durasi')
                    <p class="mt-2 text-sm text-red-500">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label class="mb-2 block text-sm font-extrabold text-[#2a4468]">
                    Harga
                </label>

                <input
                    type="number"
                    wire:model="harga"
                    class="w-full rounded-xl border border-[#dbe8f5] bg-white px-4 py-3 text-[#172033] outline-none focus:border-[#2f80ed] focus:ring-4 focus:ring-[#2f80ed]/10"
                    placeholder="350000"
                >

                @error('harga')
                    <p class="mt-2 text-sm text-red-500">{{ $message }}</p>
                @enderror
            </div>
        </div>

        <div class="mb-6">
            <label class="mb-2 block text-sm font-extrabold text-[#2a4468]">
                Deskripsi
            </label>

            <textarea
                wire:model="deskripsi"
                rows="4"
                class="w-full rounded-xl border border-[#dbe8f5] bg-white px-4 py-3 text-[#172033] outline-none focus:border-[#2f80ed] focus:ring-4 focus:ring-[#2f80ed]/10"
            ></textarea>
        </div>

        <div class="flex flex-wrap gap-3">
            <button
                type="submit"
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

    <div>
        <div class="mb-8">
            <h2 class="font-['Playfair_Display'] text-4xl font-bold tracking-[-0.5px] text-[#172033]">
                Daftar Layanan ✦
            </h2>

            <p class="mt-2 text-[#667085]">
                Layanan ini akan tampil di halaman detail salon dan bisa dipilih customer saat booking.
            </p>
        </div>

        <div class="space-y-5">
            @forelse ($this->services as $service)
                <article class="flex flex-col justify-between gap-5 rounded-[18px] border border-[#dbe8f5] bg-white p-6 shadow-[0_12px_32px_rgba(39,93,152,0.08)] md:flex-row md:items-center">
                    <div>
                        <span class="inline-flex rounded-full bg-[#eaf4ff] px-3 py-1.5 text-xs font-extrabold text-[#2f80ed]">
                            {{ $service->category->nama_category }}
                        </span>

                        <h3 class="mt-4 text-2xl font-extrabold text-[#172033]">
                            {{ $service->nama_service }}
                        </h3>

                        <p class="mt-2 text-sm text-[#667085]">
                            {{ $service->durasi }} menit ·
                            £ {{ number_format($service->harga, 2, ',', '.') }}
                        </p>

                        @if ($service->deskripsi)
                            <p class="mt-3 max-w-xl text-sm leading-7 text-[#667085]">
                                {{ $service->deskripsi }}
                            </p>
                        @endif
                    </div>

                    <div class="flex gap-2">
                        <button
                            wire:click="edit({{ $service->service_id }})"
                            class="rounded-xl border border-[#dbe8f5] bg-[#f6fbff] px-4 py-3 text-sm font-extrabold text-[#2f80ed] transition hover:border-[#2f80ed] hover:bg-[#eaf4ff]"
                        >
                            Edit
                        </button>

                        <button
                            wire:click="delete({{ $service->service_id }})"
                            wire:confirm="Yakin hapus layanan ini?"
                            class="rounded-xl border border-red-200 bg-red-50 px-4 py-3 text-sm font-extrabold text-red-600 transition hover:bg-red-100"
                        >
                            Hapus
                        </button>
                    </div>
                </article>
            @empty
                <div class="rounded-[28px] border border-[#dbe8f5] bg-white p-10 text-[#667085] shadow-[0_18px_45px_rgba(38,103,184,0.12)]">
                    Belum ada layanan.
                </div>
            @endforelse
        </div>
    </div>

</div>