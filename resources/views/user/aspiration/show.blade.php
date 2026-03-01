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
        <form method="POST" action="{{ route('pengaduan.destroy', $aspiration->id) }}">
            @csrf
            @method('DELETE')
            <button
                onclick="return confirm('Yakin ingin menghapus pengaduan ini?')"
                class="flex items-center gap-2 bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded-xl text-sm">
                <i class="fa-solid fa-trash"></i>
                Hapus Pengaduan
            </button>
        </form>
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

        {{-- RIGHT (BUKTI) --}}
        <div>
            <label class="text-sm font-medium text-gray-700">Bukti</label>

            <div class="mt-2 h-48 border border-dashed border-gray-300 rounded-xl
                        flex items-center justify-center">

                @if ($aspiration->image)
                    <img
                        src="{{ asset('storage/' . $aspiration->image) }}"
                        alt="Bukti Pengaduan"
                        class="w-full h-full object-cover rounded-xl"
                    >
                @else
                    <div class="text-center text-gray-400 text-sm">
                        <i class="fa-regular fa-image text-3xl mb-2"></i>
                        <p>Tidak Ada Bukti</p>
                    </div>
                @endif

            </div>
        </div>

        {{-- TANGGAPAN --}}
        <div class=" md:col-span-3">
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

{{-- Footer --}}
<div class="flex justify-end mt-6">
    <a
        href="{{ route('pengaduan.mine') }}"
        class="bg-gray-400 hover:bg-gray-500 text-white px-6 py-2 rounded-xl text-sm">
        Kembali
    </a>
</div>

@endsection
