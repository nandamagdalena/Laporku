<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'dashboard')</title>
    @vite('resources/css/app.css')

    <link
        rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
        integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA=="
        crossorigin="anonymous"
        referrerpolicy="no-referrer"
    />

    {{-- Tailwind CSS --}}
    <script src="https://cdn.tailwindcss.com"></script>

    {{-- Tailwind Config (optional, for color tweak) --}}
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#2563eb',
                    }
                }
            }
        }
    </script>
</head>
<body class="bg-gray-100">

<div class="flex min-h-screen">

    {{-- SIDEBAR --}}
    <aside class="w-64 bg-white border-r border-gray-200 flex flex-col">
        {{-- Logo --}}
        <div class="h-16 flex items-center px-6">
            <img src="{{ asset('images/logopanjang.png') }}" alt="Laporku" class="h-14">
        </div>

        {{-- Menu --}}
        <nav class="flex-1 px-4 py-6 space-y-2 text-sm text-gray-700">

            {{-- dashboard --}}
            <div>
                <p class="text-xs text-gray-400 uppercase mb-2">Dashboard</p>

                <a href="{{ route('admin.dashboard') }}"
                    class="flex items-center px-3 py-2 rounded-lg
                    {{ request()->routeIs('admin.dashboard')
                            ? 'bg-blue-50 text-blue-600 font-medium'
                            : 'hover:bg-gray-100 text-gray-700' }}">
                        <i class="fa-solid fa-house mr-1.5"></i>
                        Dashboard
                </a>
            </div>

            {{-- daftar pengguna --}}
            <div>
                <p class="text-xs text-gray-400 uppercase mb-2">Daftar Pengguna</p>
                <a href="{{ route('admin.users') }}"
                        class="flex items-center px-3 py-2 rounded-lg
                        {{ request()->routeIs('admin.users')
                                ? 'bg-blue-50 text-blue-600 font-medium'
                                : 'hover:bg-gray-100 text-gray-700' }}">
                            <i class="fa-solid fa-users mr-1.5"></i>
                            Daftar Pengguna
                </a>
            </div>

            {{-- daftar pengaduan --}}
            <div>
                <p class="text-xs text-gray-400 uppercase mb-2">Daftar Pengaduan</p>
                <a href="{{ route('aspiration.index') }}"
                        class="flex items-center px-3 py-2 rounded-lg
                        {{ request()->routeIs('admin.users')
                                ? 'bg-blue-50 text-blue-600 font-medium'
                                : 'hover:bg-gray-100 text-gray-700' }}">
                            <i class="fa-solid fa-users mr-1.5"></i>
                            Daftar Pengaduan
                </a>
            </div>

            {{-- kategori --}}
            <div>
                <p class="text-xs font-bold uppercase mb-2 text-gray-900">Kelola Kategori</p>
                <a href="{{ route('category.index') }}"
                class="flex items-center gap-3 px-4 py-2 rounded-xl
                {{ request()->routeIs('category.index')
                        ? 'bg-blue-50 text-blue-700 font-semibold'
                        : 'text-gray-500 hover:bg-gray-100 hover:text-gray-700' }}">

                    <i class="fa-solid fa-folder text-base"></i>
                    <span>Kategori</span>
                </a>
            </div>
        </nav>
    </aside>

    {{-- MAIN AREA --}}
    <div class="flex-1 flex flex-col">

        {{-- TOPBAR --}}
        <header class="h-16 bg-white flex items-center justify-between px-6">
            {{-- Left --}}
            <div class="flex items-center gap-3">
                <button class="p-2 rounded-lg hover:bg-gray-100">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-600" fill="none"
                         viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M4 6h16M4 12h16M4 18h16"/>
                    </svg>
                </button>
            </div>

            {{-- Right --}}
            <div class="relative">
                <button
                    onclick="toggleProfile()"
                    class="flex items-center gap-4 focus:outline-none">

                    <div class="text-right leading-tight">
                        <p class="text-sm font-semibold text-gray-800">
                            {{ Auth::user()->name }}
                        </p>
                        <p class="text-xs text-gray-500">
                            {{ Auth::user()->email }}
                        </p>
                    </div>

                    <img
                        src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name) }}&background=2563eb&color=fff"
                        class="w-9 h-9 rounded-full"
                        alt="Avatar"
                    >
                </button>

                {{-- DROPDOWN PROFILE --}}
                <div
                    id="profileDropdown"
                    class="hidden absolute right-0 mt-4 w-80 bg-white rounded-2xl shadow-lg border z-50">

                    {{-- CARD CONTENT --}}
                    <div class="p-6">

                        {{-- AVATAR --}}
                        <div class="flex items-center gap-4">
                            <img
                                src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name) }}&background=ef4444&color=fff"
                                class="w-14 h-14 rounded-full"
                                alt="Avatar"
                            >

                            <div>
                                <p class="text-base font-semibold text-gray-800">
                                    {{ Auth::user()->name }}
                                </p>
                                <p class="text-sm text-gray-500 flex items-center gap-2">
                                    <i class="fa-solid fa-envelope"></i>
                                    {{ Auth::user()->email }}
                                </p>
                            </div>
                        </div>

                        <hr class="my-5">

                        {{-- EDIT PROFIL --}}
                        <a
                            href="{{ route('profile.edit') }}"
                            class="block w-full text-center bg-blue-50 text-blue-600 py-3 rounded-xl font-semibold hover:bg-blue-100 transition">
                            Edit Profil
                        </a>

                        {{-- LOGOUT --}}
                        <form method="POST" action="{{ route('logout') }}" class="mt-4">
                            @csrf
                            <button
                                type="submit"
                                class="w-full flex items-center justify-center gap-2 bg-red-50 text-red-600 py-3 rounded-xl font-semibold hover:bg-red-100 transition">
                                Logout
                                <i class="fa-solid fa-right-from-bracket"></i>
                            </button>
                        </form>

                    </div>
                </div>
            </div>
        </header>

        {{-- CONTENT (kosong, siap diisi) --}}
        <main class="p-6">
            @yield('content')
        </main>

    </div>
</div>

<script>
    function toggleProfile() {
        document.getElementById('profileDropdown')
            .classList.toggle('hidden');
    }

    // klik di luar = nutup
    document.addEventListener('click', function (e) {
        const dropdown = document.getElementById('profileDropdown');
        if (!e.target.closest('.relative')) {
            dropdown.classList.add('hidden');
        }
    });
</script>

</body>
</html>
