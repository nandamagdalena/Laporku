@extends('layouts.template')

@section('title', 'Detail Pengaduan')

@section('content')

{{-- HEADER --}}
<div class="mb-6">
    <h1 class="text-xl font-semibold text-gray-800">Detail Pengaduan</h1>
    <p class="text-sm text-gray-500 mt-1">
        <a href="{{ route('admin.dashboard') }}" class="hover:text-blue-600">Beranda</a> /
        <a href="{{ route('aspiration.index') }}" class="hover:text-blue-600">Daftar Pengaduan</a> /
        <span class="text-red-500">Detail Pengaduan</span>
    </p>
</div>

{{-- CARD --}}
<div class="bg-white rounded-2xl shadow p-6">

    {{-- CARD HEADER --}}
    <div class="flex items-center justify-between mb-6">
        <div>
            <h2 class="text-lg font-semibold text-gray-800">Laporan Pengaduan</h2>
            <p class="text-sm text-gray-500">
                Tanggal laporan pengaduan
            </p>
        </div>

        <button
            class="flex items-center gap-2 px-4 py-2 border rounded-xl text-sm text-gray-600 hover:bg-gray-50">
            <i class="fa-solid fa-file-export"></i>
            Ekspor
        </button>
    </div>

    {{-- CONTENT --}}
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

        {{-- LEFT --}}
        <div class="md:col-span-2 space-y-4 text-sm">

            <div>
                <p class="text-gray-500">Nama</p>
                <p class="font-medium text-gray-800">
                    {{ $aspiration->name }}
                </p>
            </div>

            <div>
                <p class="text-gray-500">Tanggal</p>
                <p class="font-medium text-gray-800">
                    {{ \Carbon\Carbon::parse($aspiration->tanggal)->format('d-m-Y') }}
                </p>
            </div>

            <div>
                <p class="text-gray-500">Kategori</p>
                <p class="font-medium text-gray-800">
                    {{ $aspiration->category?->name ?? '-' }}
                </p>
            </div>

            <div>
                <p class="text-gray-500">Lokasi</p>
                <p class="font-medium text-gray-800">
                    {{ $aspiration->location }}
                </p>
            </div>

            <div>
                <p class="text-gray-500 mb-1">Keterangan</p>
                <p class="text-gray-700 leading-relaxed">
                    {{ $aspiration->description }}
                </p>
            </div>

            <form method="POST" action="{{ route('aspiration.update', $aspiration->id) }}">
                @csrf
                @method('PUT')

                {{-- STATUS --}}
                <div class="mt-4">
                    <label class="block text-gray-500 mb-1">Status</label>
                    <select
                        name="status"
                        class="w-48 border rounded-xl px-3 py-2 text-sm">
                        <option value="menunggu" {{ $aspiration->status === 'menunggu' ? 'selected' : '' }}>Menunggu</option>
                        <option value="diproses" {{ $aspiration->status === 'diproses' ? 'selected' : '' }}>Diproses</option>
                        <option value="selesai" {{ $aspiration->status === 'selesai' ? 'selected' : '' }}>Selesai</option>
                        <option value="ditolak" {{ $aspiration->status === 'ditolak' ? 'selected' : '' }}>Ditolak</option>
                    </select>
                </div>

                {{-- TANGGAPAN --}}
                <div class="mt-4">
                    <label class="block text-gray-500 mb-1">Tanggapan</label>
                    <textarea
                        name="response"
                        rows="4"
                        class="w-full border rounded-xl p-3 text-sm"
                    >{{ old('response', $aspiration->response) }}</textarea>
                </div>

                {{-- BUTTON --}}
                <div class="flex justify-end mt-6">
                    <button
                        type="submit"
                        class="px-5 py-2 rounded-xl bg-blue-600 text-white text-sm hover:bg-blue-700">
                        Kirim
                    </button>
                </div>
            </form>
        </div>
        {{-- RIGHT (BUKTI) --}}
        <div>
            <p class="text-sm text-gray-500 mb-2">Bukti</p>

            <div class="border border-dashed border-gray-300 rounded-xl h-48 flex items-center justify-center">
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

    </div>
</div>

@endsection
