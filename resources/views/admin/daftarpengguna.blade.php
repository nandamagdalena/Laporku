@extends('layouts.template')

@section('title', 'Daftar Pengguna')

@section('content')
<div class="space-y-6">

    <!-- HEADER -->
    <div>
        <h1 class="text-2xl font-semibold text-gray-800">Daftar Pengguna</h1>
        <div class="text-sm text-gray-500 mt-1">
            <span class="text-gray-400">Beranda</span>
            <span class="mx-1">›</span>
            <span class="text-red-500">Daftar Pengguna</span>
        </div>
    </div>

        <!-- CARD -->
        <div class="bg-white rounded-xl shadow p-6">

        <!-- SEARCH + SORT -->
        <div class="flex items-center justify-between mb-5">

        <!-- SEARCH -->
        <form method="GET" class="relative w-80">
            <input
                type="text"
                name="search"
                value="{{ request('search') }}"
                placeholder="Telusuri sesuatu..."
                class="w-full rounded-lg border border-gray-300 pl-10 pr-4 py-2 text-sm
                    focus:outline-none focus:ring-2 focus:ring-blue-500"
            >

            <!-- icon search -->
            <svg class="absolute left-3 top-2.5 w-4 h-4 text-gray-400"
                fill="none" stroke="currentColor" stroke-width="2"
                viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M21 21l-4.35-4.35m1.35-5.65a7 7 0 11-14 0 7 7 0 0114 0z"/>
            </svg>

            <!-- jaga sorting saat search -->
            <input type="hidden" name="sort" value="{{ request('sort') }}">
        </form>

        <!-- SORT -->
        <form method="GET" class="flex items-center gap-2">
            <span class="text-sm text-gray-500">Sort by:</span>

            <select
                name="sort"
                onchange="this.form.submit()"
                class="rounded-lg border border-gray-300 px-3 py-2 text-sm
                    focus:outline-none focus:ring-2 focus:ring-blue-500 cursor-pointer"
            >
                <option value="az" {{ request('sort')=='az' ? 'selected' : '' }}>
                    A - Z
                </option>
                <option value="za" {{ request('sort')=='za' ? 'selected' : '' }}>
                    Z - A
                </option>
            </select>

            <!-- jaga search saat sorting -->
            <input type="hidden" name="search" value="{{ request('search') }}">
        </form>

</div>
        <!-- TABLE -->
        <div class="overflow-x-auto">
            <table class="w-full border-collapse">
                <thead>
                    <tr class="bg-blue-700 text-white text-sm">
                        <th class="px-4 py-3 text-left rounded-l-lg">No</th>
                        <th class="px-4 py-3 text-left">Nama Pengguna</th>
                        <th class="px-4 py-3 text-left">NIS</th>
                        <th class="px-4 py-3 text-left">Email</th>
                        <th class="px-4 py-3 text-left">No. Telpon</th>
                        <th class="px-4 py-3 text-center rounded-r-lg">Aksi</th>
                    </tr>
                </thead>
                <tbody class="text-sm text-gray-700">
                    @foreach ($users as $user)
                    <tr class="border-b hover:bg-gray-50">
                        <td class="px-4 py-3">
                            {{ $loop->iteration + ($users->currentPage()-1) * $users->perPage() }}
                        </td>
                        <td class="px-4 py-3">{{ $user->name }}</td>
                        <td class="px-4 py-3">{{ $user->nis }}</td>
                        <td class="px-4 py-3">{{ $user->email }}</td>
                        <td class="px-4 py-3">{{ $user->phone_number }}</td>
                        <td class="px-4 py-3 text-center">
                            <button
                                type="button"
                                onclick="openDeleteModal({{ $user->id }})"
                                class="text-red-500 hover:bg-red-100 p-2 rounded-lg">
                                <i class="fa-solid fa-trash-can"></i>
                            </button>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- FOOTER -->
        <div class="flex items-center justify-between mt-6 text-sm text-gray-500">
            <div>
                Menampilkan
                {{ $users->firstItem() }}–{{ $users->lastItem() }}
                dari {{ $users->total() }} data
            </div>

            <div>
                {{ $users->links() }}
            </div>
        </div>

        <!-- DELETE MODAL -->
        <div
            id="deleteModal"
            class="fixed inset-0 z-50 hidden bg-black/50 backdrop-blur-sm">

            <!-- WRAPPER (penting!) -->
            <div class="flex min-h-screen items-center justify-center">

                <!-- MODAL BOX -->
                <div class="bg-white w-95 rounded-2xl p-6 text-center shadow-xl pointer-events-auto">

                    <!-- ICON -->
                    <div class="flex justify-center mb-4">
                        <img src="{{ asset('images/delmodal.png') }}" alt="">
                    </div>

                    <h2 class="text-lg font-semibold text-gray-800">
                        Hapus Pengguna?
                    </h2>

                    <p class="text-sm text-gray-500 mt-2">
                        Data yang Anda pilih akan dihapus
                        <span class="text-red-500 font-medium">secara permanen</span>
                        dan tidak dapat dikembalikan.
                    </p>

                    <!-- BUTTON -->
                    <div class="flex justify-center gap-4 mt-6">
                        <button
                            type="button"
                            onclick="closeDeleteModal()"
                            class="px-6 py-2 rounded-lg border border-red-500 text-red-500 hover:bg-red-50">
                            Batalkan
                        </button>

                        <form id="deleteForm" method="POST">
                            @csrf
                            @method('DELETE')

                            <button
                                type="submit"
                                class="px-6 py-2 rounded-lg bg-red-600 text-white hover:bg-red-700">
                                Hapus
                            </button>
                        </form>

                    </div>

                </div>
            </div>
        </div>

        <script>
            function openDeleteModal(userId) {
                const modal = document.getElementById('deleteModal');
                const form  = document.getElementById('deleteForm');

                form.action = `/admin/daftarpengguna/${userId}`;
                modal.classList.remove('hidden');
            }

            function closeDeleteModal() {
                const modal = document.getElementById('deleteModal');
                modal.classList.add('hidden');
            }
        </script>
    </div>
</div>
@endsection
