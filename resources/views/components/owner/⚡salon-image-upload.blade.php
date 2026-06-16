<?php

use App\Models\Salon;
use App\Models\SalonImage;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;

new class extends Component {
    use WithFileUploads;

    public Salon $salon;

    public $images = [];

    public string $image_type = 'gallery';

    public function mount(Salon $salon): void
    {
        abort_if($salon->owner_id !== auth()->id(), 403);

        $this->salon = $salon;
    }

    public function saveImages(): void
    {
        
        $this->validate([
            'images.*' => ['required', 'image', 'max:2560'],
            'image_type' => ['required', 'in:gallery,banner,logo,interior,treatment'],
        ]);

        foreach ($this->images as $image) {
            $path = $image->store(
                'salons/' . $this->salon->salon_id,
                'public'
            );

            SalonImage::create([
                'salon_id' => $this->salon->salon_id,
                'image_path' => $path,
                'image_type' => $this->image_type,
                'is_thumbnail' => false,
            ]);
        }

        $this->images = [];
        $this->image_type = 'gallery';

        session()->flash('success', 'Gambar salon berhasil diupload.');
    }

    public function setThumbnail(int $imageId): void
    {
        $image = SalonImage::where('image_id', $imageId)
            ->where('salon_id', $this->salon->salon_id)
            ->firstOrFail();

        SalonImage::where('salon_id', $this->salon->salon_id)
            ->update(['is_thumbnail' => false]);

        $image->update(['is_thumbnail' => true]);
    }

    public function deleteImage(int $imageId): void
    {
        $image = SalonImage::where('image_id', $imageId)
            ->where('salon_id', $this->salon->salon_id)
            ->firstOrFail();

        Storage::disk('public')->delete($image->image_path);

        $image->delete();
    }

    public function getSalonImagesProperty()
    {
        return $this->salon
            ->images()
            ->latest()
            ->get();
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
        wire:submit.prevent="saveImages"
        class="rounded-[28px] border border-[#dbe8f5] bg-white p-8 shadow-[0_18px_45px_rgba(38,103,184,0.12)]"
    >

        <h2 class="mb-6 font-['Playfair_Display'] text-3xl font-bold tracking-[-0.5px] text-[#172033]">
            Upload Gambar Salon
        </h2>

        <div class="mb-5">
            <label class="mb-2 block text-sm font-extrabold text-[#2a4468]">
                Tipe Gambar
            </label>

            <select
                wire:model="image_type"
                class="w-full rounded-xl border border-[#dbe8f5] bg-white px-4 py-3 text-[#172033] outline-none focus:border-[#2f80ed] focus:ring-4 focus:ring-[#2f80ed]/10"
            >
                <option value="gallery">Gallery</option>
                <option value="banner">Banner</option>
                <option value="logo">Logo</option>
                <option value="interior">Interior</option>
                <option value="treatment">Treatment</option>
            </select>
        </div>

        <div
            x-data="{ files: [] }"
            class="rounded-[22px] border-2 border-dashed border-[#dbe8f5] bg-[#f6fbff] p-6"
        >
            <label class="mb-2 block text-sm font-extrabold text-[#2a4468]">
                Pilih File Gambar
            </label>

            <input
                type="file"
                multiple
                wire:model="images"
                accept="image/*"
                class="w-full text-sm text-[#667085] file:mr-4 file:rounded-xl file:border-0 file:bg-[#2f80ed] file:px-4 file:py-2 file:text-sm file:font-extrabold file:text-white hover:file:bg-[#1769d8]"
                x-on:change="files = [...$event.target.files].map(file => file.name)"
            >

            <p class="mt-3 text-xs text-[#667085]">
                Maksimal 2.5 MB per gambar. Format disarankan: JPG, PNG, atau WEBP.
            </p>

            @error('images')
                <p class="mt-2 text-sm text-red-500">{{ $message }}</p>
            @enderror

            @error('images.*')
                <p class="mt-2 text-sm text-red-500">{{ $message }}</p>
            @enderror

            <div class="mt-4 rounded-xl border border-[#dbe8f5] bg-white p-4 text-sm text-[#667085]" x-show="files.length">
                <p class="mb-2 font-extrabold text-[#172033]">
                    File dipilih:
                </p>

                <template x-for="file in files" :key="file">
                    <p x-text="file"></p>
                </template>
            </div>
        </div>

        <button
            type="submit"
            wire:loading.attr="disabled"
            class="mt-6 rounded-xl bg-gradient-to-r from-[#2f80ed] to-[#5aa9ff] px-6 py-4 font-extrabold text-white shadow-[0_12px_30px_rgba(47,128,237,0.28)] transition hover:-translate-y-0.5 disabled:opacity-50"
        >
            <span wire:loading.remove>Upload</span>
            <span wire:loading>Mengupload...</span>
        </button>

    </form>

    <div>
        <div class="mb-8">
            <h2 class="font-['Playfair_Display'] text-4xl font-bold tracking-[-0.5px] text-[#172033]">
                Gambar Salon ✦
            </h2>

            <p class="mt-2 text-[#667085]">
                Pilih satu gambar sebagai thumbnail utama untuk tampil di halaman Explore Salon.
            </p>
        </div>

        <div class="grid gap-6 md:grid-cols-2 xl:grid-cols-3">
            @forelse ($this->salonImages as $image)
                <article class="overflow-hidden rounded-[18px] border border-[#dbe8f5] bg-white shadow-[0_12px_32px_rgba(39,93,152,0.08)] transition hover:-translate-y-1 hover:shadow-[0_18px_45px_rgba(38,103,184,0.12)]">
                    <img
                        src="{{ asset('storage/' . $image->image_path) }}"
                        class="h-56 w-full object-cover"
                        alt="Salon image"
                    >

                    <div class="space-y-4 p-5">
                        <p class="text-sm text-[#667085]">
                            Tipe:
                            <span class="font-extrabold text-[#172033]">
                                {{ $image->image_type }}
                            </span>
                        </p>

                        @if ($image->is_thumbnail)
                            <span class="inline-flex rounded-full bg-green-50 px-3 py-1.5 text-sm font-extrabold text-green-700">
                                Thumbnail Utama
                            </span>
                        @else
                            <button
                                type="button"
                                wire:click="setThumbnail({{ $image->image_id }})"
                                class="block w-full rounded-xl border border-[#dbe8f5] bg-[#f6fbff] px-4 py-3 text-sm font-extrabold text-[#2f80ed] transition hover:border-[#2f80ed] hover:bg-[#eaf4ff]"
                            >
                                Jadikan Thumbnail
                            </button>
                        @endif

                        <button
                            type="button"
                            wire:click="deleteImage({{ $image->image_id }})"
                            wire:confirm="Yakin ingin menghapus gambar ini?"
                            class="block w-full rounded-xl border border-red-200 bg-red-50 px-4 py-3 text-sm font-extrabold text-red-600 transition hover:bg-red-100"
                        >
                            Hapus Gambar
                        </button>
                    </div>
                </article>
            @empty
                <div class="rounded-[28px] border border-[#dbe8f5] bg-white p-10 text-[#667085] shadow-[0_18px_45px_rgba(38,103,184,0.12)]">
                    Belum ada gambar salon.
                </div>
            @endforelse
        </div>
    </div>

</div>