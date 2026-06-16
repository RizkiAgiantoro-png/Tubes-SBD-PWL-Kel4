<?php

namespace App\Http\Controllers\Owner;
use App\Models\Salon;
use App\Models\Kota;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SalonController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
{
    $salons = Salon::where(
        'owner_id',
        auth()->id()
    )->latest()->get();

    return view(
        'owner.salons.index',
        compact('salons')
    );
}

    /**
     * Show the form for creating a new resource.
     */
    public function create()
{
    $kotas = Kota::all();

    return view(
        'owner.salons.create',
        compact('kotas')
    );
}
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
{
    $request->validate([
        'kota_id' => 'required',
        'nama_salon' => 'required|max:255',
        'alamat' => 'required',
        'deskripsi' => 'nullable',
        'jam_buka' => 'required',
        'jam_tutup' => 'required',
        'latitude' => ['nullable', 'numeric', 'between:-90,90'],
        'longitude' => ['nullable', 'numeric', 'between:-180,180'],
    ]);

    Salon::create([
        'owner_id' => auth()->id(),
        'kota_id' => $request->kota_id,
        'nama_salon' => $request->nama_salon,
        'alamat' => $request->alamat,
        'deskripsi' => $request->deskripsi,
        'jam_buka' => $request->jam_buka,
        'jam_tutup' => $request->jam_tutup,
        'latitude' => $request->latitude,
        'longitude' => $request->longitude,
        'status' => 'active'
    ]);

    return redirect()
        ->route('owner.salons.index')
        ->with('success', 'Salon berhasil dibuat');
}

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Salon $salon)
    {
        abort_if($salon->owner_id !== auth()->id(), 403);

        $kotas = Kota::all();

        return view('owner.salons.edit', compact('salon', 'kotas'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Salon $salon)
    {
        abort_if($salon->owner_id !== auth()->id(), 403);

        $validated = $request->validate([
            'kota_id' => ['required', 'exists:kotas,kota_id'],
            'nama_salon' => ['required', 'max:255'],
            'alamat' => ['required'],
            'deskripsi' => ['nullable'],
            'jam_buka' => ['required'],
            'jam_tutup' => ['required'],
            'status' => ['required', 'in:active,inactive'],
            'latitude' => ['nullable', 'numeric', 'between:-90,90'],
            'longitude' => ['nullable', 'numeric', 'between:-180,180'],
        ]);

        $salon->update($validated);

        return redirect()
            ->route('owner.salons.index')
            ->with('success', 'Salon berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Salon $salon)
    {
        abort_if($salon->owner_id !== auth()->id(), 403);

        $salon->delete();

        return redirect()
            ->route('owner.salons.index')
            ->with('success', 'Salon berhasil dihapus.');
    }

    public function gallery(Salon $salon)
    {
        abort_if($salon->owner_id !== auth()->id(), 403);

        return view('owner.salons.gallery', compact('salon'));
    }
    public function services(Salon $salon)
    {
        abort_if($salon->owner_id !== auth()->id(), 403);

        return view('owner.salons.services', compact('salon'));
    }

    public function staff(Salon $salon)
    {
        abort_if($salon->owner_id !== auth()->id(), 403);

        return view('owner.salons.staff', compact('salon'));
    }
}
