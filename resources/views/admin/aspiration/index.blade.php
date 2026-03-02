@extends('layouts.template')

@section('title', 'Daftar Pengaduan')

@section('content')
<div class="space-y-6">
    <!-- HEADER -->
    <div>
        <h1 class="text-2xl font-semibold text-gray-800">Daftar Pengaduan</h1>
        <div class="text-sm text-gray-500 mt-1">
            <span class="text-[#00afea]">Kelola Keseluruhan Pengaduan</span>
        </div>
    </div>

    <!-- CARD -->
    <div class="bg-white rounded-xl shadow p-6">
        <!-- Search -->
        <div class="flex items-center justify-between mb-5">
            <div class="flex items-center gap-3">

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

                <div class="relative inline-block">
                    <!-- FILTER BUTTON -->
                    <button type="button"
                        onclick="toggleFilter()"
                        class="flex items-center justify-center w-10 h-10 rounded-lg
                        border border-gray-300 bg-white hover:bg-gray-100
                        transition duration-200">

                        <i class="fa-solid fa-sliders text-[#00afea]"></i>
                    </button>

                    <div id="filterDropdown" class="hidden absolute right-0 mt-3 w-72 bg-white border border-gray-200 rounded-xl shadow-lg p-4 z-50">

                        <form method="GET" class="space-y-4">
                            <!-- KATEGORI CHECKBOX -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">
                                    Kategori
                                </label>

                                <div class="max-h-40 overflow-y-auto space-y-2">
                                    @foreach($categories as $category)
                                        <label class="flex items-center space-x-2 text-sm">
                                            <input type="checkbox"
                                                name="category[]"
                                                value="{{ $category->id }}"
                                                {{ in_array($category->id, (array)request('category')) ? 'checked' : '' }}
                                                class="rounded border-gray-300 text-[#00afea] focus:ring-[#00afea]">

                                            <span>{{ $category->name }}</span>
                                        </label>
                                    @endforeach
                                </div>
                            </div>

                            <!-- TANGGAL -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">
                                    Tanggal Mulai
                                </label>
                                <input type="date"
                                    name="start_date"
                                    value="{{ request('start_date') }}"
                                    class="w-full border border-gray-300 rounded-lg p-2 text-sm">
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">
                                    Tanggal Selesai
                                </label>
                                <input type="date"
                                    name="end_date"
                                    value="{{ request('end_date') }}"
                                    class="w-full border border-gray-300 rounded-lg p-2 text-sm">
                            </div>

                            <!-- BUTTON -->
                            <div class="flex justify-between pt-2">
                                <a href="{{ route('aspiration.index') }}"
                                class="bg-yellow-100 text-yellow-600 px-4 py-2 rounded-lg text-sm">
                                    Reset
                                </a>

                                <button type="submit"
                                    class="bg-[#00afea] text-white px-4 py-2 rounded-lg text-sm">
                                    Terapkan
                                </button>
                            </div>

                        </form>
                    </div>
                </div>
            </div>

                {{-- Export --}}
                <a href="{{ route('aspirations.export.excel', request()->query()) }}"
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
                    Ekspor
                </a>
            </div>

            <!-- Table -->
            <div class="w-full overflow-hidden rounded-xl border border-gray-200">
            <table class="w-full text-sm">
                <thead class="bg-[#02779E] text-white">
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
                                {{ $item->user?->name }}
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
                                        border border-blue-500 text-[#02779E] hover:bg-blue-50">
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

<script>
    function toggleFilter() {
        document.getElementById('filterDropdown')
            .classList.toggle('hidden');
    }

    document.addEventListener('click', function(event) {
        const dropdown = document.getElementById('filterDropdown');
        const button = event.target.closest('button');

        if (!event.target.closest('#filterDropdown') &&
            !event.target.closest('[onclick="toggleFilter()"]')) {
            dropdown.classList.add('hidden');
        }
    });
</script>
@endsection
