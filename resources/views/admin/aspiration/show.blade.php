@extends('layouts.template')

@section('title', 'Detail Pengaduan')

@section('content')

{{-- HEADER --}}
<div class="mb-6 flex items-center justify-between">

    <div>
        <h1 class="text-xl font-semibold text-gray-800">Detail Pengaduan</h1>
        <p class="text-sm text-gray-500 mt-1">
            <a class="text-[#00afea]">Lihat Pengaduan Lebih Lengkap dan Rinci</a>
        </p>
    </div>

    <a href="{{ route('aspiration.index') }}"
       class="px-4 py-2 bg-gray-500 text-white rounded-lg hover:bg-gray-600 transition">
        <i class="fas fa-arrow-left mr-2"></i> Kembali
    </a>

</div>

{{-- SUCCESS MESSAGE --}}
@if (session('success'))
    <div class="p-3 rounded-md bg-green-100 border border-green-400 text-green-700 text-sm">
        {{ session('success') }}
    </div>
 @endif

{{-- GLOBAL ERROR --}}
@if ($errors->any())
    <div class="p-3 rounded-md bg-red-100 border border-red-400 text-red-700 text-sm">
        <ul class="list-disc list-inside space-y-1">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

{{-- CARD --}}
<div class="bg-white rounded-2xl shadow p-6">

    {{-- CARD HEADER --}}
    <div class="flex items-center justify-between mb-6">
        <div>
            <h2 class="text-lg font-semibold text-gray-800">Laporan Pengaduan</h2>
            <p class="text-sm text-gray-500">
                {{ \Carbon\Carbon::parse($aspiration->date)->format('d M Y') }}
            </p>
        </div>

        <a href="{{ route('aspirations.export', $aspiration->id) }}"
            class="px-4 py-2 bg-[#00afea] text-white rounded-lg hover:bg-gray-300 hover:text-white">
                <i class="fas fa-file-export mr-2"></i> Ekspor
        </a>
    </div>

    {{-- CONTENT --}}
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

        {{-- LEFT --}}
        <div class="md:col-span-2 space-y-4 text-sm">

            {{-- <div>
                <p class="font-semibold text-gray-800 mb-1">Nama</p>
                <p class="font-medium text-gray-500 wrap-break-word">
                    {{ $aspiration->name }}
                </p>
            </div> --}}

            <div>
                <p class="font-semibold text-gray-800 mb-1">Nama Pelapor</p>
                <p class="font-medium text-gray-500 wrap-break-word">
                    {{ $aspiration->user?->name }}
                </p>
            </div>

            <div>
                <p class="font-semibold text-gray-800 mb-1">Kategori</p>
                <p class="font-medium text-gray-500 wrap-break-word">
                    {{ $aspiration->category?->name ?? '-' }}
                </p>
            </div>

            <div>
                <p class="font-semibold text-gray-800 mb-1">Lokasi</p>
                <p class="font-medium text-gray-500 wrap-break-word">
                    {{ $aspiration->location }}
                </p>
            </div>

            <div>
                <p class="font-semibold text-gray-800 mb-1">Keterangan</p>
                <p class="font-medium text-gray-500 wrap-break-word">
                    {{ $aspiration->description }}
                </p>
            </div>

            <form method="POST" action="{{ route('aspiration.update', $aspiration->id) }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                {{-- STATUS --}}
                <div class="mt-4">
                    <label class="font-semibold block text-gray-800 mb-1">Status</label>
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
                    <label class="font-semibold block text-gray-800 mb-1">Tanggapan</label>
                    <textarea
                        name="response"
                        rows="4"
                        class="w-full border rounded-xl p-3 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                    >{{ old('response', $aspiration->response) }}</textarea>
                </div>

                {{-- Bukti admin --}}
                <div>
                    <label class="text-sm font-medium text-gray-700">Bukti Admin</label>

                    <div class="mt-2 relative max-w-md w-full aspect-video border border-dashed border-gray-300 rounded-xl overflow-hidden">

                        {{-- INPUT FILE --}}
                        <input
                            type="file"
                            name="admin_image"
                            id="admin_image_input"
                            class="hidden"
                            onchange="previewAdminImage(event)"
                        >

                        {{-- AREA KLIK --}}
                        <label for="admin_image_input" class="w-full h-full cursor-pointer flex items-center justify-center">

                            <div id="preview-admin" class="w-full h-full">
                                @if ($aspiration->admin_image)
                                    <img
                                        src="{{ asset('storage/' . $aspiration->admin_image) }}"
                                        class="w-full h-full object-cover"
                                    >
                                @else
                                    <div class="w-full h-full flex flex-col items-center justify-center text-gray-400 text-sm">
                                        <i class="fa-regular fa-image text-3xl mb-2"></i>
                                        <p>Klik untuk upload</p>
                                    </div>
                                @endif
                            </div>

                        </label>

                        {{-- TOMBOL HAPUS --}}
                        @if ($aspiration->admin_image)
                        <button
                            type="button"
                            onclick="removeAdminImage()"
                            class="absolute top-2 right-2 bg-red-500 text-white rounded-full w-7 h-7 flex items-center justify-center text-xs hover:bg-red-600"
                        >
                            ✕
                        </button>
                        @endif

                    </div>
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
            <p class="font-semibold text-sm text-gray-800 mb-2">Bukti</p>

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

<script>
    function previewAdminImage(event) {
        const input = event.target;
        const preview = document.getElementById('preview-admin');

        if (input.files && input.files[0]) {
            const reader = new FileReader();

            reader.onload = function(e) {
                preview.innerHTML = `
                    <img src="${e.target.result}" class="w-full h-full object-cover">
                `;
            }

            reader.readAsDataURL(input.files[0]);
        }
    }

    function removeAdminImage() {
        const preview = document.getElementById('preview-admin');
        const input = document.getElementById('admin_image_input');

        // hanya set flag hapus (JANGAN langsung kosongkan kalau user belum yakin)
        let removeInput = document.getElementById('remove_admin_image');

        if (!removeInput) {
            removeInput = document.createElement('input');
            removeInput.type = 'hidden';
            removeInput.name = 'remove_admin_image';
            removeInput.value = '1';
            input.closest('form').appendChild(removeInput);
        }

        // reset preview saja
        preview.innerHTML = `
            <div class="w-full h-full flex flex-col items-center justify-center text-gray-400 text-sm">
                <i class="fa-regular fa-image text-3xl mb-2"></i>
                <p>Klik untuk upload</p>
            </div>
        `;
    }
</script>
@endsection
