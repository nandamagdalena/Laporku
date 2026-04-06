@extends('layouts.template')

@section('title', 'Profile')

@section('content')

<link rel="stylesheet"
 href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

<div class="max-w-5xl mx-auto">
    <div class="mb-6">
        <h1 class="text-2xl font-bold text-gray-800">Profile</h1>
        <p class="text-sm text-cyan-500">Kelola informasi akun anda</p>
    </div>
    {{-- ALERT --}}
    @if(session('success'))
        <div class="mb-6 bg-green-100 text-green-700 px-4 py-3 rounded-lg">
            {{ session('success') }}
        </div>
    @endif

    <div class="bg-white rounded-2xl shadow p-8">

        <form action="{{ route('admin.profile.update') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <input type="hidden" name="remove_photo" id="removePhotoInput" value="0">

            {{-- HEADER PROFILE --}}
            <div class="flex items-center gap-5 mb-8">

                {{-- FOTO --}}
                <div class="relative">
                    <div class="relative w-24 h-24">

                        {{-- INPUT FILE (WAJIB DI DALAM FORM) --}}
                        <input
                            type="file"
                            name="photo"
                            id="photoInput"
                            class="hidden"
                            accept="image/*"
                            onchange="previewPhoto(event)"
                        >

                        {{-- FOTO --}}
                        <label for="photoInput" class="cursor-pointer group">
                            <img
                                id="previewImage"
                                src="{{ Auth::user()->photo
                                    ? asset('storage/' . Auth::user()->photo)
                                    : 'https://ui-avatars.com/api/?name=' . urlencode(Auth::user()->name) . '&background=2563eb&color=fff' }}"
                                class="w-24 h-24 rounded-full object-cover border group-hover:opacity-70 transition"
                            >

                            {{-- ICON CAMERA --}}
                            <div class="absolute inset-0 flex items-center justify-center opacity-0 group-hover:opacity-100 transition">
                                <i class="fa-solid fa-camera text-white text-lg bg-black/50 p-2 rounded-full"></i>
                            </div>
                        </label>

                        {{-- BUTTON HAPUS (SELALU ADA) --}}
                        <button
                            type="button"
                            onclick="removePhoto()"
                            class="absolute -bottom-2 -right-2 z-10 bg-red-500 text-white w-6 h-6 rounded-full text-xs flex items-center justify-center hover:bg-red-600"
                        >
                            <i class="fa-solid fa-trash"></i>
                        </button>

                    </div>
                </div>

                {{-- NAMA & EMAIL --}}
                <div>
                    <h2 class="text-xl font-semibold text-gray-800">
                        {{ Auth::user()->name }}
                    </h2>
                    <p class="text-gray-500 text-sm">
                        {{ Auth::user()->email }}
                    </p>
                </div>
            </div>

            {{-- FORM DATA --}}
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                {{-- NAMA --}}
                <div>
                    <label class="text-sm font-semibold text-gray-700 flex items-center gap-2 mb-1">
                        Nama Lengkap
                        <i class="fa-solid fa-pen text-blue-500 text-xs"></i>
                    </label>

                    <input type="text" name="name"
                        value="{{ old('name', Auth::user()->name) }}"
                        class="w-full border border-blue-400 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-300">
                </div>

                {{-- PASSWORD (DISPLAY ONLY) --}}
                <div>
                    <label class="text-sm font-semibold text-gray-700 flex items-center gap-2 mb-1">
                        Kata Sandi
                        <i class="fa-solid fa-lock text-blue-500 text-xs"></i>
                    </label>

                    <input type="password" value="********"
                        class="w-full border border-blue-400 rounded-lg px-4 py-2 bg-gray-100 cursor-not-allowed"
                        disabled>
                </div>

                {{-- EMAIL --}}
                <div>
                    <label class="text-sm font-semibold text-gray-700 flex items-center gap-2 mb-1">
                        Email
                        <i class="fa-solid fa-envelope text-blue-500 text-xs"></i>
                    </label>

                    <input type="email" name="email"
                        value="{{ old('email', Auth::user()->email) }}"
                        class="w-full border border-blue-400 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-300">
                </div>

                {{-- ROLE --}}
                <div>
                    <label class="text-sm font-semibold text-gray-700 flex items-center gap-2 mb-1">
                        Jenis Akun
                        <i class="fa-solid fa-user text-blue-500 text-xs"></i>
                    </label>

                    <input type="text"
                        value="{{ old('role', Auth::user()->role) }}"
                        class="w-full border border-blue-400 rounded-lg px-4 py-2 bg-gray-100 text-blue-600 font-semibold"
                        disabled>
                </div>

                {{-- NO HP --}}
                <div>
                    <label class="text-sm font-semibold text-gray-700 flex items-center gap-2 mb-1">
                        No. Telepon
                        <i class="fa-solid fa-phone text-blue-500 text-xs"></i>
                    </label>

                    <input type="text" name="phone_number"
                        value="{{ old('phone_number', Auth::user()->phone_number) }}"
                        class="w-full border border-blue-400 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-300">
                </div>

                {{-- NIS --}}
                <div>
                    <label class="text-sm font-semibold text-gray-700 flex items-center gap-2 mb-1">
                        NIS
                        <i class="fa-solid fa-image text-blue-500 text-xs"></i>
                    </label>

                    <input type="text" name="nis"
                        value="{{ old('nis', Auth::user()->nis) }}"
                        class="w-full border border-blue-400 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-300">
                </div>

            </div>

            {{-- BUTTON --}}
            <div class="flex justify-end mt-8">
                <button
                    type="submit"
                    class="bg-blue-600 text-white px-6 py-2 rounded-xl hover:bg-blue-700 shadow"
                >
                    Simpan
                </button>
            </div>

        </form>

    </div>
</div>

<script>
function previewPhoto(event) {
    const reader = new FileReader();
    reader.onload = function(){
        document.getElementById('previewImage').src = reader.result;
    }
    reader.readAsDataURL(event.target.files[0]);

    // kalau upload baru → jangan hapus
    document.getElementById('removePhotoInput').value = 0;
}

function removePhoto() {
    document.getElementById('previewImage').src =
        "https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name) }}";

    document.getElementById('removePhotoInput').value = 1;

    // reset input file
    document.getElementById('photoInput').value = "";
}
</script>

@endsection
