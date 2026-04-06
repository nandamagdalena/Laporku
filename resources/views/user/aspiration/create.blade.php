@extends('layouts.usertemplate')

@section('title', 'Form Pengaduan')

@section('content')

{{-- HEADER --}}
<div class="mb-6">
    <h1 class="text-xl font-semibold text-gray-800">Form Pengaduan</h1>
    <p class="text-sm text-gray-500 mt-1">
        <span class="text-gray-400">Beranda</span>
        <span class="mx-1">›</span>
        <span class="text-blue-600">Form Pengaduan</span>
    </p>
</div>

{{-- CARD --}}
<div class="bg-white rounded-xl border border-gray-200 shadow-sm p-6">

    {{-- TITLE --}}
    <div class="mb-6">
        <h2 class="text-sm font-semibold text-gray-800">Data Pengaduan</h2>
        <p class="text-xs text-gray-500">
            Lengkapi data pengaduan dengan benar dan jelas.
        </p>
    </div>

    {{-- ERROR GLOBAL --}}
    @if ($errors->any())
        <div class="mb-4 rounded-lg bg-red-100 border border-red-300 p-4 text-sm text-red-700">
            <ul class="list-disc pl-5 space-y-1">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('pengaduan.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="grid grid-cols-3 gap-6">

            {{-- LEFT FORM --}}
            <div class="col-span-2 space-y-4">

                {{-- Nama --}}
                <div>
                    <label class="text-sm font-medium text-gray-700">Nama</label>
                    <p class="text-gray-600 text-sm">
                        Pastikan nama yang diinputkan sesuai dengan nama saat registrasi<span class="text-red-500">*</span>
                    </p>
                    <input
                        type="text"
                        name="name"
                        value="{{ Auth::user()->name }}"
                        readonly
                        class="w-full mt-1 px-3 py-2 text-sm
                            border border-blue-300 rounded-lg
                            bg-gray-100 cursor-not-allowed"
                    />
                    @error('name')
                        <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Tanggal --}}
                <div>
                    <label class="text-sm font-medium text-gray-700">Tanggal</label>
                    <input
                        type="date"
                        name="date"
                        value="{{ old('date') }}"
                        class="w-full mt-1 px-3 py-2 text-sm
                               border border-gray-300 rounded-lg
                               focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                        @error('date') border-red-500 @else @enderror"
                    >
                    @error('date')
                        <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Kategori --}}
                <div>
                    <label class="text-sm font-medium text-gray-700">Kategori</label>
                    <select
                        name="category_id"
                        class="w-full mt-1 px-3 py-2 text-sm
                               border border-gray-300 rounded-lg
                               focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                        @error('category_id') border-red-500 @else @enderror"
                    >
                        <option value="">Pilih Kategori</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}"
                                {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('category_id')
                        <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Lokasi --}}
                <div>
                    <label class="text-sm font-medium text-gray-700">Lokasi</label>
                    <p class="text-gray-500 text-sm">
                        Jelaskan lebih detail terkait lokasi kerusakan sarana/prasarana<span class="text-red-500">*</span>
                    </p>
                    <input
                        type="text"
                        name="location"
                        value="{{ old('location') }}"
                        placeholder="Isi keterangan lokasi"
                        class="w-full mt-1 px-3 py-2 text-sm
                               border border-gray-300 rounded-lg
                               focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500
                        @error('location') @else @enderror"
                    >
                    @error('location')
                        <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Keterangan --}}
                <div>
                    <label class="text-sm font-medium text-gray-700">Keterangan</label>
                    <textarea
                        name="description"
                        rows="4"
                        placeholder="Isi keterangan"
                        class="w-full mt-1 px-3 py-2 text-sm
                               border border-gray-300 rounded-lg
                               focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500
                        @error('description') @else @enderror"
                    >{{ old('description') }}</textarea>
                    @error('description')
                        <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                    @enderror
                </div>

            </div>

            {{-- UPLOAD --}}
            <div>
                <label class="text-sm font-medium text-gray-700">Bukti</label>

                <div class="relative mt-2 h-48 border border-dashed rounded-xl flex items-center justify-center text-gray-400
                @error('image') border-red-500 @else @enderror">

                    <img id="preview" class="hidden w-full h-full object-cover rounded-xl">

                    {{-- Remove --}}
                    <button
                        type="button"
                        onclick="removeImage()"
                        id="removeBtn"
                        class="hidden absolute top-2 right-2 z-20 bg-red-500 text-white w-6 h-6 rounded-full text-xs">
                        ✕
                    </button>

                    {{-- Input --}}
                    <input
                        type="file"
                        name="image"
                        accept="image/*"
                        onchange="previewImage(this)"
                        class="absolute inset-0 opacity-0 cursor-pointer"
                    >

                    {{-- Text --}}
                    <div id="uploadText" class="text-center text-sm">
                        <i class="fa-regular fa-image text-3xl mb-2"></i>
                        <p>Unggah Gambar</p>
                    </div>
                </div>

                @error('image')
                    <p class="text-xs text-red-500 mt-2">{{ $message }}</p>
                @enderror
            </div>

        </div>

        {{-- ACTION --}}
        <div class="flex justify-end gap-3 mt-8">
            <button
                type="submit"
                class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-lg text-sm">
                Kirim
            </button>
        </div>
    </form>

    {{-- modal success --}}
    @if (session('success'))
    <div class="fixed inset-0 z-50 flex items-center justify-center bg-black/40">

        <div class="bg-white w-full max-w-md rounded-2xl p-6 text-center shadow-lg">

            {{-- Icon --}}
            <div class="flex justify-center mb-3">
               <img
                    src="{{ asset('images/emoji.png') }}"
                    class="h-12"
                    alt="Success"
                >
            </div>

            {{-- Title --}}
            <h2 class="text-lg font-semibold text-green-600">
                Terima kasih atas laporan Anda!
            </h2>

            {{-- Desc --}}
            <p class="text-sm text-gray-600 mt-2">
                Pengaduan sarana sekolah telah berhasil dikirim
                dan sedang menunggu peninjauan.
            </p>
            <p class="text-sm text-yellow-600 mt-2">
                Silahkan Cek kembali status pengaduanmu dalam 24 jam
                di menu Riwayat pengaduan!
            </p>


            {{-- Illustration (optional) --}}
            <div class="my-4 flex justify-center">
                <img
                    src="{{ asset('images/laporan.png') }}"
                    class="h-16"
                    alt="Success"
                >
            </div>

            {{-- Button --}}
            <a
                href="{{ route('pengaduan.mine') }}"
                class="inline-block mt-2 px-6 py-2
                    bg-green-500 hover:bg-green-600
                    text-white rounded-lg text-sm"
            >
                OK
            </a>
        </div>
    </div>
    @endif
</div>

{{-- JS --}}
<script>
function previewImage(input) {
    const preview = document.getElementById('preview')
    const uploadText = document.getElementById('uploadText')
    const removeBtn = document.getElementById('removeBtn')

    const file = input.files[0]
    if (!file) return

    preview.src = URL.createObjectURL(file)
    preview.classList.remove('hidden')
    uploadText.classList.add('hidden')
    removeBtn.classList.remove('hidden')
}

function removeImage() {
    const preview = document.getElementById('preview')
    const uploadText = document.getElementById('uploadText')
    const removeBtn = document.getElementById('removeBtn')
    const input = document.querySelector('input[name="image"]')

    input.value = ''
    preview.classList.add('hidden')
    uploadText.classList.remove('hidden')
    removeBtn.classList.add('hidden')
}
</script>

@endsection
