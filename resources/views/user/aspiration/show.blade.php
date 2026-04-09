@extends('layouts.usertemplate')

@section('title', 'Detail Pengaduan')

@section('content')

{{-- Breadcrumb --}}
<div class="mb-6">
    <h1 class="text-xl font-semibold text-gray-800">Detail Pengaduan</h1>
    <p class="text-sm text-gray-500 mt-1">
            <span class="text-[#00afea]">
                Lihat Detail Pengaduan Anda
            </span>
        </p>
</div>

{{-- Card --}}
<div class="bg-white rounded-2xl shadow p-6">

    {{-- Header --}}
    <div class="flex items-center justify-between mb-6">
        <div>
            <h2 class="text-lg font-semibold text-gray-800">Laporan Pengaduan</h2>
            <p class="text-sm text-gray-500">
                {{ \Carbon\Carbon::parse($aspiration->date)->format('d M Y') }}
            </p>
        </div>

        {{-- Hapus --}}
        <button type="button"
            onclick="openDeleteModal({{ $aspiration->id }})"
            class="flex items-center gap-2 bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded-xl text-sm">

            <i class="fa-solid fa-trash"></i>
            Hapus Pengaduan
        </button>
    </div>

    {{-- Content --}}
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        {{-- LEFT --}}
        <div class="md:col-span-2 space-y-4 text-sm">

            <div>
                <p class="font-semibold text-gray-800">Nama Pelapor</p>
                <p class="font-medium text-gray-500">
                    {{ $aspiration->name }}
                </p>
            </div>

            <div>
                <p class="font-semibold text-gray-800">Kategori</p>
                <p class="font-medium text-gray-500">
                    {{ $aspiration->category?->name ?? '-' }}
                </p>
            </div>

            <div>
                <p class="font-semibold text-gray-800">Lokasi</p>
                <p class="font-medium text-gray-500">
                    {{ $aspiration->location }}
                </p>
            </div>

            <div>
                <p class="font-semibold text-gray-800 mb-1">Keterangan</p>
                <p class="font-medium text-gray-500 wrap-break-word">
                    {{ $aspiration->description }}
                </p>
            </div>

            <div>
                <p class="font-semibold text-gray-800 mb-1">Status</p>
                @php
                    $statusColor = match($aspiration->status) {
                        'menunggu' => 'bg-yellow-100 text-yellow-700',
                        'diproses' => 'bg-blue-100 text-blue-700',
                        'selesai'  => 'bg-green-100 text-green-700',
                        'ditolak'  => 'bg-red-100 text-red-700',
                    };
                @endphp
                <span class="inline-block text-xs font-semibold px-3 py-1 rounded-full {{ $statusColor }}">
                    {{ ucfirst($aspiration->status) }}
                </span>
            </div>

        </div>

        {{-- RIGHT (BUKTI USER & ADMIN) --}}
        <div class="space-y-4">

            {{-- BUKTI USER --}}
            <div>
                <label class="text-sm font-medium text-gray-700">Bukti Anda</label>

                <div class="mt-2 h-40 border border-dashed border-gray-300 rounded-xl flex items-center justify-center">
                    @if ($aspiration->image)
                        <img
                            src="{{ asset('storage/' . $aspiration->image) }}"
                            class="w-full h-full object-cover rounded-xl"
                        >
                    @else
                        <div class="text-center text-gray-400 text-sm">
                            <i class="fa-regular fa-image text-2xl mb-1"></i>
                            <p>Tidak Ada Bukti</p>
                        </div>
                    @endif
                </div>
            </div>

            {{-- BUKTI ADMIN --}}
            <div>
                <label class="text-sm font-medium text-gray-700">Bukti Admin</label>

                <div class="mt-2 h-40 border border-dashed border-gray-300 rounded-xl flex items-center justify-center">
                    @if ($aspiration->admin_image)
                        <img
                            src="{{ asset('storage/' . $aspiration->admin_image) }}"
                            class="w-full h-full object-cover rounded-xl"
                        >
                    @else
                        <div class="text-center text-gray-400 text-sm">
                            <i class="fa-regular fa-image text-2xl mb-1"></i>
                            <p>Belum ada bukti dari admin</p>
                        </div>
                    @endif
                </div>
            </div>

        </div>

        {{-- TANGGAPAN --}}
        <div class="md:col-span-1 self-start -mt-32">
            <p class="font-semibold text-gray-800 mb-1">Tanggapan</p>

            @if ($aspiration->response)
                <div class="border border-gray-200 rounded-xl p-4 text-gray-700 text-sm leading-relaxed bg-gray-50">
                    {{ $aspiration->response }}
                </div>
            @else
                <div class="border border-dashed border-gray-300 rounded-xl p-4 text-gray-400 text-sm">
                    Belum ada tanggapan
                </div>
            @endif
        </div>
    </div>

<div id="deleteModal" class="fixed inset-0 bg-black/20 hidden items-center justify-center z-50">

    <div id="modalBox" class="bg-white w-[90%] max-w-md rounded-2xl shadow-lg p-6 scale-95 opacity-0 transition-all duration-300">

        <!-- ICON -->
        <div class="flex justify-center mb-4">
            <div class="bg-red-100 text-red-500 p-3 rounded-full">
                <i class="fa-solid fa-trash text-xl"></i>
            </div>
        </div>

        <!-- TEXT -->
        <h2 class="text-lg font-semibold text-gray-800 text-center">
            Hapus Pengaduan?
        </h2>

        <p class="text-sm text-gray-500 text-center mt-2">
            Data yang sudah dihapus tidak dapat dikembalikan.
        </p>

        <!-- BUTTON -->
        <div class="flex gap-3 mt-6">

            <!-- BATAL -->
            <button onclick="closeDeleteModal()"
                class="w-full py-2 rounded-lg bg-gray-100 hover:bg-gray-200 text-gray-700 transition">
                Batal
            </button>

            <!-- HAPUS -->
            <form id="deleteForm" method="POST" class="w-full">
                @csrf
                @method('DELETE')

                <button type="submit"
                    class="w-full py-2 rounded-lg bg-red-500 hover:bg-red-600 text-white transition">
                    Ya, Hapus
                </button>
            </form>

        </div>

    </div>
</div>

{{-- Footer --}}
<div class="flex justify-end mt-6">
    <a
        href="{{ route('pengaduan.mine') }}"
        class="bg-gray-400 hover:bg-gray-500 text-white px-6 py-2 rounded-xl text-sm">
        Kembali
    </a>
</div>

<script>
function openDeleteModal(id = null) {
    const modal = document.getElementById('deleteModal');
    const box = document.getElementById('modalBox');

    modal.classList.remove('hidden');
    modal.classList.add('flex');

    setTimeout(() => {
        box.classList.remove('scale-95', 'opacity-0');
        box.classList.add('scale-100', 'opacity-100');
    }, 10);

    // set action kalau pakai dynamic ID
    if (id) {
        document.getElementById('deleteForm').action = `/user/pengaduan/${id}`;
    }
}

function closeDeleteModal() {
    const modal = document.getElementById('deleteModal');
    const box = document.getElementById('modalBox');

    box.classList.add('scale-95', 'opacity-0');

    setTimeout(() => {
        modal.classList.add('hidden');
        modal.classList.remove('flex');
    }, 200);
}

document.getElementById('deleteModal').addEventListener('click', function(e) {
    if (e.target === this) {
        closeDeleteModal();
    }
});
</script>
@endsection
