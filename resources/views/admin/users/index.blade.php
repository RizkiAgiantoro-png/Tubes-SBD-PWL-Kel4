<x-app-layout>
    <div class="min-h-screen bg-white text-[#172033]">

        <section class="border-b border-[#e6f1ff] bg-gradient-to-b from-[#f6fbff] to-white py-14">
            <div class="lumiere-container">
                <div class="max-w-3xl">
                    <div class="lumiere-badge">
                        ✦ Admin Area
                    </div>

                    <h1 class="mt-6 font-['Playfair_Display'] text-5xl font-bold leading-tight tracking-[-1px] text-[#0f172a] md:text-6xl">
                        Manage
                        <span class="text-[#2f80ed]">Users</span>
                    </h1>

                    <p class="mt-5 text-lg leading-8 text-[#667085]">
                        Kelola akun yang register di Lumiere, termasuk customer, owner, dan admin.
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

                @if (session('error'))
                    <div class="mb-6 rounded-xl border border-red-200 bg-red-50 p-4 text-red-700">
                        {{ session('error') }}
                    </div>
                @endif

                <form method="GET" action="{{ route('admin.users.index') }}" class="mb-8 grid gap-4 rounded-[28px] border border-[#dbe8f5] bg-white p-6 shadow-[0_18px_45px_rgba(38,103,184,0.12)] md:grid-cols-[1fr_220px_auto]">
                    <input
                        type="text"
                        name="search"
                        value="{{ request('search') }}"
                        placeholder="Cari nama atau email..."
                        class="rounded-xl border border-[#dbe8f5] bg-white px-4 py-3 text-[#172033] outline-none focus:border-[#2f80ed] focus:ring-4 focus:ring-[#2f80ed]/10"
                    >

                    <select
                        name="role"
                        class="rounded-xl border border-[#dbe8f5] bg-white px-4 py-3 text-[#172033] outline-none focus:border-[#2f80ed] focus:ring-4 focus:ring-[#2f80ed]/10"
                    >
                        <option value="">Semua role</option>
                        <option value="admin" @selected(request('role') === 'admin')>Admin</option>
                        <option value="owner" @selected(request('role') === 'owner')>Owner</option>
                        <option value="customer" @selected(request('role') === 'customer')>Customer</option>
                    </select>

                    <button class="rounded-xl bg-gradient-to-r from-[#2f80ed] to-[#5aa9ff] px-6 py-3 font-extrabold text-white shadow-[0_12px_30px_rgba(47,128,237,0.28)]">
                        Filter
                    </button>
                </form>

                <div class="overflow-hidden rounded-[28px] border border-[#dbe8f5] bg-white shadow-[0_18px_45px_rgba(38,103,184,0.12)]">
                    <div class="grid grid-cols-12 gap-4 border-b border-[#dbe8f5] bg-[#f6fbff] p-5 text-sm font-extrabold text-[#2a4468]">
                        <div class="col-span-3">Nama</div>
                        <div class="col-span-3">Email</div>
                        <div class="col-span-2">Role</div>
                        <div class="col-span-2">Terdaftar</div>
                        <div class="col-span-2 text-right">Aksi</div>
                    </div>

                    @forelse ($users as $user)
                        <div class="grid grid-cols-12 gap-4 border-b border-[#dbe8f5] p-5 text-sm last:border-b-0">
                            <div class="col-span-3">
                                <p class="font-extrabold text-[#172033]">
                                    {{ $user->name }}
                                </p>
                            </div>

                            <div class="col-span-3 text-[#667085]">
                                {{ $user->email }}
                            </div>

                            <div class="col-span-2">
                                <form method="POST" action="{{ route('admin.users.update-role', $user->id) }}">
                                    @csrf
                                    @method('PATCH')

                                    <select
                                        name="role"
                                        onchange="this.form.submit()"
                                        class="w-full rounded-xl border border-[#dbe8f5] bg-white px-3 py-2 text-sm text-[#172033]"
                                    >
                                        <option value="admin" @selected($user->role === 'admin')>Admin</option>
                                        <option value="owner" @selected($user->role === 'owner')>Owner</option>
                                        <option value="customer" @selected($user->role === 'customer')>Customer</option>
                                    </select>
                                </form>
                            </div>

                            <div class="col-span-2 text-[#667085]">
                                {{ $user->created_at?->format('d M Y') }}
                            </div>

                            <div class="col-span-2 text-right">
                                @if ($user->id !== auth()->id())
                                    <form method="POST" action="{{ route('admin.users.destroy', $user->id) }}">
                                        @csrf
                                        @method('DELETE')

                                        <button
                                            onclick="return confirm('Yakin ingin menghapus user ini?')"
                                            class="rounded-xl border border-red-200 bg-red-50 px-4 py-2 font-extrabold text-red-600 transition hover:bg-red-100"
                                        >
                                            Hapus
                                        </button>
                                    </form>
                                @else
                                    <span class="text-xs font-bold text-[#667085]">
                                        Akun aktif
                                    </span>
                                @endif
                            </div>
                        </div>
                    @empty
                        <div class="p-10 text-center text-[#667085]">
                            Tidak ada user ditemukan.
                        </div>
                    @endforelse
                </div>

                <div class="mt-8">
                    {{ $users->links() }}
                </div>

            </div>
        </section>
    </div>
</x-app-layout>