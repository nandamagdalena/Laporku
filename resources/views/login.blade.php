<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Masuk - Smart RT</title>
     @vite('resources/css/app.css')
</head>
<body class="bg-gray-50">
    <div class="min-h-screen flex">
        <!-- Left Side - Login Form -->
        <div class="w-full lg:w-1/2 flex items-center justify-center px-6 py-12">
            <div class="max-w-md w-full space-y-8">
                <!-- Logo -->
                <div>
                    <h1 class="text-4xl font-bold text-cyan-500">Lantera</h1>
                </div>

                <!-- Login Form -->
                <div class="mt-8">
                    <h2 class="text-3xl font-bold text-gray-900 mb-2">Masuk</h2>
                    <p class="text-gray-600 text-sm mb-6">Silakan masukkan e-mail dan kata sandi</p>

                    <form class="space-y-6" action="{{ route('login') }}" method="POST">
                        @csrf

                        <!-- Email Field -->
                        <div>
                            <label for="email" class="block text-sm font-medium text-gray-700 mb-2">
                                E-mail<span class="text-red-500">*</span>
                            </label>
                            <input
                                id="email"
                                name="email"
                                type="email"
                                required
                                class="appearance-none block w-full px-3 py-2.5 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-cyan-500 focus:border-cyan-500"
                                placeholder="Masukkan alamat e-mail"
                                value="{{ old('email') }}"
                            >
                            @error('email')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Password Field -->
                        <div>
                            <label for="password" class="block text-sm font-medium text-gray-700 mb-2">
                                Kata Sandi<span class="text-red-500">*</span>
                            </label>
                            <div class="relative">
                                <input
                                    id="password"
                                    name="password"
                                    type="password"
                                    required
                                    class="appearance-none block w-full px-3 py-2.5 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-cyan-500 focus:border-cyan-500"
                                    placeholder="Masukkan kata sandi"
                                >
                                <button type="button" onclick="togglePassword()" class="absolute inset-y-0 right-0 pr-3 flex items-center">
                                    <svg id="eyeIcon" class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                    </svg>
                                </button>
                            </div>
                            @error('password')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Remember Me & Forgot Password -->
                        <div class="flex items-center justify-between">
                            <div class="flex items-center">
                                <input
                                    id="remember"
                                    name="remember"
                                    type="checkbox"
                                    class="h-4 w-4 text-cyan-500 focus:ring-cyan-500 border-gray-300 rounded"
                                >
                                <label for="remember" class="ml-2 block text-sm text-gray-700">
                                    Ingat Login Saya
                                </label>
                            </div>

                            <div class="text-sm">
                                <a href="#" class="font-medium text-cyan-500 hover:text-cyan-600">
                                    Lupa Kata Sandi?
                                </a>
                            </div>
                        </div>

                        <!-- Submit Button -->
                        <div>
                            <button
                                type="submit"
                                class="w-full flex justify-center py-3 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-cyan-500 hover:bg-cyan-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-cyan-500 transition-colors"
                            >
                                Masuk
                            </button>
                        </div>


                        <!-- Register Link -->
                        <div class="text-center">
                            <p class="text-sm text-gray-600">
                                Belum punya akun?
                                <a href="#" class="font-medium text-cyan-500 hover:text-cyan-600">
                                    Daftar Disini!
                                </a>
                            </p>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Right Side - Welcome Section -->
        <div class="hidden lg:flex lg:w-1/2 bg-linear-to-br from-cyan-400 to-cyan-500 items-center justify-center p-12">
            <div class="max-w-lg text-white">
                <h2 class="text-5xl font-bold mb-4">Selamat datang di Lantera</h2>
                <p class="text-xl text-cyan-50 mb-8">
                    Solusi pintar untuk komunikasi dan administrasi Perpustakaan.
                </p>



            </div>
        </div>
    </div>
</body>
</html>
