@extends('layouts.template')

@section('title', 'Daftar Pengguna')

@section('content')
<div class="space-y-6">

    <!-- HEADER -->
    <div class="flex items-start justify-between">

        <!-- KIRI -->
        <div>
            <h1 class="text-2xl font-semibold text-gray-800">
                Daftar Pengguna
            </h1>

            <div class="text-sm text-gray-500 mt-1">
                <span class="text-[#00afea]">Kelola dan Pantau Daftar Pengguna</span>
            </div>
        </div>

        <!-- KANAN (Tanggal) -->
        <div class="hidden md:block">
            <span class="bg-blue-50 text-blue-600 px-4 py-2 rounded-xl text-sm font-semibold shadow-sm">
                {{ now()->format('l, d F Y') }}
            </span>
        </div>

    </div>

        <!-- CARD -->
        <div class="bg-white rounded-xl shadow p-6">

            <!-- SEARCH + SORT -->
            <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 mb-8">

                <!-- KIRI (Search + Export) -->
                <div class="flex items-center gap-3 w-full md:w-auto">

                    <!-- SEARCH -->
                    <form method="GET" class="relative w-full md:w-80">
                        <input
                            type="text"
                            name="search"
                            value="{{ request('search') }}"
                            placeholder="Telusuri sesuatu..."
                            class="w-full rounded-xl border border-gray-300 pl-11 pr-4 py-2.5 text-sm
                                focus:outline-none focus:ring-2 focus:ring-blue-500 transition"
                        >

                        <svg class="absolute left-4 top-3 w-4 h-4 text-gray-400"
                            fill="none" stroke="currentColor" stroke-width="2"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M21 21l-4.35-4.35m1.35-5.65a7 7 0 11-14 0 7 7 0 0114 0z"/>
                        </svg>

                        <input type="hidden" name="sort" value="{{ request('sort') }}">
                    </form>

                    <!-- EXPORT BUTTON -->
                    <a href="{{ route('admin.users.export') }}"
                    class="inline-flex items-center gap-2 bg-[#00afea] hover:bg-blue-400
                            text-white text-sm px-4 py-2.5 rounded-xl shadow-sm
                            transition duration-200">

                        <svg xmlns="http://www.w3.org/2000/svg"
                            class="w-4 h-4"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke="currentColor"
                            stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M12 4v12m0 0l-3-3m3 3l3-3M4 20h16"/>
                        </svg>

                        Export
                    </a>

                </div>

            <!-- KANAN (Sort) -->
            <form method="GET" class="flex items-center gap-3">
                <span class="text-sm text-gray-500">Sort by:</span>

                <select
                    name="sort"
                    onchange="this.form.submit()"
                    class="rounded-xl border border-gray-300 px-4 py-2.5 text-sm
                        focus:outline-none focus:ring-2 focus:ring-blue-500 cursor-pointer">
                    <option value="az" {{ request('sort')=='az' ? 'selected' : '' }}>
                        A - Z
                    </option>
                    <option value="za" {{ request('sort')=='za' ? 'selected' : '' }}>
                        Z - A
                    </option>
                </select>

                <input type="hidden" name="search" value="{{ request('search') }}">
            </form>
        </div>

        <!-- TABLE -->
        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead>
                    <tr class="bg-[#02779E] text-white text-sm">
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

            {{-- pagination --}}
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
