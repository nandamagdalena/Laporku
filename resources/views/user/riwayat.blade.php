@extends('layouts.usertemplate')

@section('title', 'Riwayat Pengaduan')

@section('content')

{{-- HEADER --}}
<div class="mb-6">
    <h1 class="text-xl font-semibold text-gray-800">Daftar Pengaduan</h1>
    <p class="text-sm text-gray-500 mt-1">
        <span class="text-gray-400">Beranda</span>
        <span class="mx-1">›</span>
        <span class="text-blue-600 font-medium">Daftar Pengaduan</span>
    </p>
</div>

{{-- CARD --}}
<div class="bg-white rounded-xl shadow border border-gray-100 p-6">

    {{-- SEARCH --}}
    <form method="GET" class="mb-5 flex items-center gap-2">
        <div class="relative w-72">
            <input
                type="text"
                name="search"
                value="{{ request('search') }}"
                placeholder="Telusuri sesuatu..."
                class="w-full pl-9 pr-3 py-2 border border-gray-300 rounded-lg text-sm focus:ring-1 focus:ring-blue-500 focus:border-blue-500"
            >
            <span class="absolute left-3 top-1/2 -translate-y-1/2 text-gray-400">
                🔍
            </span>
        </div>
        <button
            type="submit"
            class="p-2 border border-gray-300 rounded-lg text-gray-600 hover:bg-gray-100"
            title="Filter"
        >
            ⚙️
        </button>
    </form>

    {{-- TABLE --}}
    <div class="overflow-x-auto rounded-lg border border-gray-200">
        <table class="w-full text-sm border-collapse">
            <thead class="bg-blue-600 text-white">
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
                        {{ $loop->iteration + ($aspirations->currentPage()-1)*$aspirations->perPage() }}
                    </td>
                    <td class="px-4 py-3 text-gray-800 font-medium">
                        {{ $item->nama }}
                    </td>
                    <td class="px-4 py-3 text-gray-700">
                        {{ $item->tanggal->format('d-m-Y') }}
                    </td>
                    <td class="px-4 py-3 text-gray-700">
                        {{ $item->category->name }}
                    </td>
                    <td class="px-4 py-3 text-gray-700">
                        {{ $item->lokasi }}
                    </td>

                    {{-- STATUS --}}
                    <td class="px-4 py-3 text-center">
                        @if ($item->status === 'menunggu')
                            <span class="inline-block px-3 py-1 text-xs font-semibold rounded-full bg-red-100 text-red-600">
                                Menunggu
                            </span>
                        @elseif ($item->status === 'proses')
                            <span class="inline-block px-3 py-1 text-xs font-semibold rounded-full bg-orange-100 text-orange-600">
                                Proses
                            </span>
                        @else
                            <span class="inline-block px-3 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-600">
                                Selesai
                            </span>
                        @endif
                    </td>

                    {{-- AKSI --}}
                    <td class="px-4 py-3 text-center">
                        <a
                            {{-- href="{{ route('pengaduan.show', $item->id) }}" --}}
                            class="inline-flex items-center justify-center w-8 h-8 rounded-full border border-blue-500 text-blue-600 hover:bg-blue-50 transition"
                            title="Lihat Detail"
                        >
                            👁
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
        <div class="pagination-blue">
            {{ $aspirations->links() }}
        </div>
    </div>

</div>

{{-- CUSTOM PAGINATION COLOR --}}
<style>
.pagination-blue .page-link,
.pagination-blue a {
    border-radius: 9999px !important;
    padding: 0.4rem 0.7rem !important;
}

.pagination-blue .active span {
    background-color: #2563eb !important;
    border-color: #2563eb !important;
    color: white !important;
}
</style>

@endsection
