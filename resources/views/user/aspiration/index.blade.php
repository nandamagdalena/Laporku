@extends('layouts.usertemplate')

@section('title', 'Riwayat Pengaduan')

@section('content')

{{-- HEADER --}}
<div class="mb-6 flex items-start justify-between">

    {{-- KIRI --}}
    <div>
        <h1 class="text-xl font-semibold text-gray-800">
            Daftar Pengaduan
        </h1>

        <p class="text-sm text-gray-500 mt-1">
            <span class="text-[#00afea]">
                Lihat Daftar Pengaduan Anda
            </span>
        </p>
    </div>

    {{-- KANAN (Tanggal) --}}
    <div class="hidden md:block">
        <span class="bg-blue-50 text-blue-600 px-4 py-2 rounded-xl text-sm font-semibold shadow-sm">
            {{ now()->format('l, d F Y') }}
        </span>
    </div>

</div>

{{-- CARD --}}
<div class="bg-white rounded-xl shadow border border-gray-100 p-6">

    {{-- SEARCH + FILTER --}}
    <form method="GET" class="mb-5 flex items-center gap-2">

        {{-- SEARCH --}}
        <div class="relative w-72">
            <input
                type="text"
                name="search"
                value="{{ request('search') }}"
                placeholder="Telusuri sesuatu..."
                class="w-full pl-9 pr-3 py-2 border border-gray-300 rounded-lg text-sm focus:ring-1 focus:ring-blue-500 focus:border-blue-500"
            >
            <span class="absolute left-3 top-1/2 -translate-y-1/2 text-gray-400">
                <i class="fa-solid fa-magnifying-glass"></i>
            </span>
        </div>


        {{-- FILTER --}}
        <details class="relative">
            <summary
                class="w-10 h-10 flex items-center justify-center border border-gray-300 rounded-lg text-gray-600 hover:bg-gray-100 cursor-pointer"
                title="Filter">
                <i class="fa-solid fa-sliders"></i>
            </summary>

            <div class="absolute right-0 mt-2 w-72 bg-white border border-gray-200 rounded-xl p-4 shadow-lg z-10">

                <p class="font-semibold text-base mb-3">Kategori</p>

                <div class="space-y-2 mb-4">
                @foreach ($categories as $cat)
                    <label class="flex items-center gap-2">
                        <input
                            type="checkbox"
                            name="category[]"
                            value="{{ $cat->id }}"
                            {{ in_array($cat->id, request('category', [])) ? 'checked' : '' }}
                            class="rounded border-gray-300 text-blue-600"
                        >
                        <span class="text-sm text-gray-700">
                            {{ $cat->name }}
                        </span>
                    </label>
                @endforeach
                </div>

                <div class="flex gap-2">
                    <a href="{{ route('pengaduan.mine') }}"
                    class="w-full text-center text-sm py-2 border border-gray-300 rounded-lg">
                        Reset
                    </a>

                    <button
                        type="submit"
                        class="w-full text-sm py-2 bg-blue-700 text-white rounded-lg">
                        Terapkan
                    </button>
                </div>
            </div>
        </details>

    </form>

    {{-- TABLE --}}
    <div class="overflow-x-auto rounded-lg border border-gray-200">
        <table class="w-full text-sm border-collapse">
            <thead class="bg-[#02779E] text-white">
                <tr>
                    <th class="px-4 py-3 text-left font-medium">No</th>
                    <th class="px-4 py-3 text-left font-medium">Nama</th>
                    <th class="px-4 py-3 text-left font-medium">Tanggal</th>
                    <th class="px-4 py-3 text-left font-medium">Kategori</th>
                    <th class="px-4 py-3 text-left font-medium">Lokasi</th>
                    <th class="px-4 py-3 text-center font-medium">Status</th>
                    <th class="px-4 py-3 text-center font-medium">Aksi</th>
                </tr>
            </thead>

            <tbody class="divide-y divide-gray-100">

                @forelse ($aspirations as $item)
                <tr class="hover:bg-gray-50 transition">
                    <td class="px-4 py-3 text-gray-700">
                        {{ $loop->iteration + ($aspirations->currentPage() - 1) * $aspirations->perPage() }}
                    </td>

                    <td class="px-4 py-3 text-gray-800 font-medium">
                        {{ $item->user?->name }}
                    </td>

                    <td class="px-4 py-3 text-gray-700">
                        {{ \Carbon\Carbon::parse($item->tanggal)->format('d-m-Y') }}
                    </td>

                    <td class="px-4 py-3 text-gray-700">
                        {{ $item->category?->name ?? '-' }}
                    </td>

                    <td class="px-4 py-3 text-gray-700">
                        {{ $item->location }}
                    </td>

                    {{-- STATUS --}}
                    <td class="px-4 py-3 text-center">
                        @if ($item->status === 'menunggu')
                            <span class="inline-block px-3 py-1 text-xs font-semibold rounded-full bg-yellow-100 text-yellow-700">
                                Menunggu
                            </span>
                        @elseif ($item->status === 'diproses')
                            <span class="inline-block px-3 py-1 text-xs font-semibold rounded-full bg-blue-100 text-blue-700">
                                Diproses
                            </span>
                        @elseif ($item->status === 'selesai')
                            <span class="inline-block px-3 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-700">
                                Selesai
                            </span>
                        @else
                            <span class="inline-block px-3 py-1 text-xs font-semibold rounded-full bg-red-100 text-red-700">
                                Ditolak
                            </span>
                        @endif
                    </td>

                    {{-- AKSI --}}
                    <td class="px-4 py-3 text-center">
                        <a
                            href="{{ route('pengaduan.show', $item->id) }}"
                            class="inline-flex items-center justify-center w-8 h-8 rounded-full
                                border border-blue-500 text-blue-600 hover:bg-blue-50 transition"
                            title="Lihat Detail"
                        >
                            <i class="fa-solid fa-eye"></i>
                        </a>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" class="text-center py-8 text-gray-500">
                        Data pengaduan belum tersedia
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- FOOTER --}}
    <div class="flex flex-col sm:flex-row justify-between items-center mt-4 text-sm text-gray-500 gap-2">
        <div>
            Menampilkan {{ $aspirations->firstItem() }}
            – {{ $aspirations->lastItem() }}
            dari {{ $aspirations->total() }} data
        </div>
        {{-- pagination --}}
        <div>
            {{ $aspirations->links() }}
        </div>
    </div>

    <script>
    </script>
</div>
@endsection
