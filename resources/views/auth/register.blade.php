<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar - Laporku!</title>
    @vite('resources/css/app.css')
</head>
<body class="bg-gray-50">
<div class="min-h-screen flex">

    <!-- Left Side -->
    <div class="w-full lg:w-1/2 flex items-center justify-center px-6 py-12">
        <div class="max-w-md w-full space-y-6">

            <div>
                <h2 class="text-3xl font-bold text-gray-900 mb-2">Daftar</h2>
                <p class="text-gray-600 text-sm">Silakan lengkapi data di bawah ini</p>
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

            <form class="space-y-5" action="{{ route('register') }}" method="POST">
                @csrf

                {{-- NAME --}}
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">
                        Nama Lengkap<span class="text-red-500">*</span>
                    </label>
                    <input
                        type="text"
                        name="name"
                        value="{{ old('name') }}"
                        class="appearance-none block w-full px-3 py-2.5 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-cyan-500 focus:border-cyan-500
                        @error('name') @else @enderror"
                        placeholder="Masukkan nama lengkap"
                    >
                </div>

                {{-- EMAIL --}}
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">
                        E-mail<span class="text-red-500">*</span>
                    </label>
                    <input
                        type="email"
                        name="email"
                        value="{{ old('email') }}"
                        class="appearance-none block w-full px-3 py-2.5 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-cyan-500 focus:border-cyan-500
                        @error('email') @else @enderror"
                        placeholder="Masukkan email"
                    >
                </div>

                {{-- NIS --}}
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">
                        NIS<span class="text-red-500">*</span>
                    </label>
                    <input
                        type="text"
                        name="nis"
                        value="{{ old('nis') }}"
                        class="appearance-none block w-full px-3 py-2.5 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-cyan-500 focus:border-cyan-500
                        @error('nis') @else @enderror"
                        placeholder="Masukkan NIS"
                    >
                </div>

                {{-- PHONE --}}
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">
                        Nomor Telepon<span class="text-red-500">*</span>
                    </label>
                    <input
                        type="text"
                        name="phone_number"
                        value="{{ old('phone_number') }}"
                        class="appearance-none block w-full px-3 py-2.5 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-cyan-500 focus:border-cyan-500
                        @error('phone_number') @else @enderror"
                        placeholder="Masukkan nomor telepon"
                    >
                </div>

                {{-- PASSWORD --}}
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        Kata Sandi<span class="text-red-500">*</span>
                    </label>

                    <div class="relative">
                        <input
                            type="password"
                            name="password"
                            class="w-full px-3 py-2.5 border rounded-md shadow-sm pr-10
                            @error('password') @else border-gray-300 @enderror
                            focus:outline-none focus:ring-cyan-500 focus:border-cyan-500"
                            placeholder="Masukkan kata sandi"
                        >

                        <button type="button"
                            class="toggle-password absolute inset-y-0 right-0 pr-3 flex items-center text-gray-400 hover:text-gray-600">
                            <svg class="h-5 w-5 pointer-events-none" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                            </svg>
                        </button>
                    </div>

                    @error('password')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>


                {{-- PASSWORD CONFIRMATION --}}
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        Konfirmasi Kata Sandi<span class="text-red-500">*</span>
                    </label>

                    <div class="relative">
                        <input
                            type="password"
                            name="password_confirmation"
                            class="w-full px-3 py-2.5 border rounded-md shadow-sm pr-10
                            @error('password_confirmation') @else border-gray-300 @enderror
                            focus:outline-none focus:ring-cyan-500 focus:border-cyan-500"
                            placeholder="Masukkan konfirmasi kata sandi"
                        >

                        <button type="button"
                            class="toggle-password absolute inset-y-0 right-0 pr-3 flex items-center text-gray-400 hover:text-gray-600">
                            <svg class="h-5 w-5 pointer-events-none" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                            </svg>
                        </button>
                    </div>

                    @error('password_confirmation')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                {{-- BUTTON --}}
                <button
                    type="submit"
                    class="w-full py-3 px-4 rounded-md text-sm font-medium text-white bg-[#0059A8] hover:bg-[#0589fd] transition"
                >
                    Daftar
                </button>

                <div class="text-center text-sm text-gray-600">
                    Sudah punya akun?
                    <a href="{{ route('login') }}" class="text-cyan-500 hover:text-cyan-600 font-medium">
                        Masuk disini
                    </a>
                </div>
            </form>
        </div>
    </div>

    <!-- Right Side -->
    <div class="hidden lg:flex lg:w-1/2 bg-linear-to-br from-[#0059A8] to-cyan-500 items-center justify-center p-12">
        <div class="max-w-lg text-white text-center">
            <img class="mx-auto mb-4" src="{{ asset('images/logolapor.png') }}" alt="Laporku Logo">
            <h2 class="text-4xl font-bold mb-4">Selamat datang di Laporku!</h2>
            <p class="text-lg text-cyan-50">
                Solusi untuk mengaspirasikan keluhan terkait sarana dan prasarana di SMK Negeri 4 Bojonegoro.
            </p>
        </div>
    </div>
</div>

<script>
document.addEventListener("DOMContentLoaded", function () {

    document.querySelectorAll(".toggle-password").forEach(button => {

        button.addEventListener("click", function () {

            const input = this.parentElement.querySelector("input");
            const icon = this.querySelector("svg");

            if (input.type === "password") {
                input.type = "text";
                icon.innerHTML = `
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M3 3l18 18" />
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M10.584 10.587A3 3 0 0012 15a3 3 0 002.413-4.416M9.88 4.24A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.542 7a9.97 9.97 0 01-1.563 3.029M6.1 6.1A9.969 9.969 0 002.458 12c1.274 4.057 5.064 7 9.542 7 1.61 0 3.13-.38 4.472-1.055" />
                `;
            } else {
                input.type = "password";
                icon.innerHTML = `
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                `;
            }

        });

    });

});
</script>
</body>
</html>
