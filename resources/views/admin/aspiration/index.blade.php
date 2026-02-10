@extends('layouts.template')

@section('title', 'Daftar Pengaduan')

@section('content')
<div class="space-y-6">
    <!-- HEADER -->
    <div>
        <h1 class="text-2xl font-semibold text-gray-800">Daftar Pengaduan</h1>
        <div class="text-sm text-gray-500 mt-1">
            <span class="text-gray-400">Beranda</span>
            <span class="mx-1">›</span>
            <span class="text-red-500">Daftar Penggaduan</span>
        </div>
    </div>

        <!-- CARD -->
        <div class="bg-white rounded-xl shadow p-6">
            <!-- Search -->
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
        </div>

            <!-- Table -->
            <div class="overflow-hidden rounded-xl border border-gray-200">
            <table class="w-full text-sm">
                <thead class="bg-blue-600 text-white">
                    <tr>
                        <th class="px-3 py-3">No</th>
                        <th class="px-3 py-3">Nama</th>
                        <th class="px-3 py-3">Tanggal</th>
                        <th class="px-3 py-3">Kategori</th>
                        <th class="px-3 py-3">Lokasi</th>
                        <th class="px-3 py-3">Status</th>
                        <th class="px-3 py-3">Aksi</th>
                    </tr>
                    </thead>
                    <tbody class="divide-y">
                        @forelse ($aspirations as $item)
                        <tr class="hover:bg-gray-50">
                            <td class="px-3 py-2 text-center">
                                {{ $loop->iteration + $aspirations->firstItem() - 1 }}
                            </td>
                            <td class="px-3 py-2">
                                {{ $item->name ?? $item->nama }}
                            </td>
                            <td class="px-3 py-2 text-center">
                                {{ \Carbon\Carbon::parse($item->date)->format('d-m-Y') }}
                            </td>
                            <td class="px-3 py-2 text-center">
                                {{ $item->category->name }}
                            </td>
                            <td class="px-3 py-2">
                                {{ $item->location }}
                            </td>
                            <td class="px-3 py-2 text-center">
                                @php
                                    $statusClass = match($item->status) {
                                        'menunggu' => 'bg-yellow-100 text-yellow-600',
                                        'diproses' => 'bg-blue-100 text-blue-700',
                                        'selesai'  => 'bg-green-100 text-green-600',
                                        'ditolak'  => 'bg-red-200 text-red-600',
                                    };
                                @endphp
                                <span class="px-3 py-1 rounded-full text-xs font-semibold {{ $statusClass }}">
                                    {{ ucfirst($item->status) }}
                                </span>
                            </td>
                            <td class="px-3 py-2 text-center">
                               <a href="{{ route('aspiration.show', $item->id) }}"
                                class="inline-flex items-center justify-center w-8 h-8 rounded-full
                                        border border-blue-500 text-blue-600 hover:bg-blue-50">
                                    <i class="fa-solid fa-eye"></i>
                                </a>

                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7" class="text-center py-6 text-gray-500">
                                Tidak ada data
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <div class="flex items-center justify-between mt-4">
                <p class="text-sm text-gray-600">
                    Menampilkan {{ $aspirations->firstItem() }}–{{ $aspirations->lastItem() }} dari {{ $aspirations->total() }} data
                </p>
                {{ $aspirations->links() }}
            </div>
        </div>
    </div>
</div>
@endsection
