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
    <aside id="sidebar" class="w-80 bg-white border-r border-gray-200 flex flex-col duration-300">

        <div class="flex items-center pt-4 pl-6">
            <img
                src="{{ asset('images/logo2.png') }}"
                alt="Laporku"
                class="h-16 w-auto"
            >
        </div>

        {{-- Menu --}}
        <nav class="flex-1 px-6 py-8 space-y-4 text-base text-gray-700">

            {{-- dashboard --}}
            <div>
                <p class="text-sm font-bold uppercase mb-3 text-gray-900">Dashboard</p>

                <a href="{{ route('admin.dashboard') }}"
                class="relative flex items-center gap-4 px-5 py-3 rounded-xl transition-all duration-200
                {{ request()->routeIs('admin.dashboard')
                        ? 'bg-[#a2e8ff4c] text-[#00afea] font-semibold'
                        : 'text-gray-500 hover:bg-gray-100 hover:text-gray-900' }}">

                    {{-- GARIS AKTIF DI SISI SIDEBAR --}}
                    @if(request()->routeIs('admin.dashboard'))
                        <span class="absolute -left-5 top-0 h-full w-1 bg-yellow-400 rounded-r-full"></span>
                    @endif

                    <i class="fa-solid fa-house text-lg"></i>
                    Dashboard
                </a>
            </div>

            {{-- daftar pengguna --}}
            <div>
                <p class="text-sm font-bold uppercase mb-3 text-gray-900">Kelola Pengguna</p>

                <a href="{{ route('admin.users') }}"
                class="relative flex items-center gap-4 px-5 py-3 rounded-xl transition-all duration-200
                {{ request()->routeIs('admin.users')
                        ? 'bg-[#a2e8ff4c] text-[#00afea] font-semibold'
                        : 'text-gray-500 hover:bg-gray-100 hover:text-gray-900' }}">

                    {{-- GARIS AKTIF DI SISI SIDEBAR --}}
                    @if(request()->routeIs('admin.users'))
                        <span class="absolute -left-5 top-0 h-full w-1 bg-yellow-400 rounded-r-full"></span>
                    @endif

                    <i class="fa-solid fa-users text-lg"></i>
                    Daftar Pengguna
                </a>
            </div>

            {{-- KELOLA PENGADUAN DROPDOWN --}}
            <div
                x-data="{
                    open: {{ request()->routeIs('aspiration.*') || request()->routeIs('aspirations.*') ? 'true' : 'false' }}
                }"
                class="space-y-2">

                <p class="text-sm font-bold uppercase mb-3 text-gray-900">Kelola Pengaduan</p>

                {{-- BUTTON --}}
                <button
                    @click="open = !open"
                    class="w-full flex items-center justify-between px-5 py-3 rounded-xl
                    text-gray-500 hover:bg-gray-100 hover:text-gray-900 transition"
                >
                    <div class="flex items-center gap-4">
                        <i class="fa-solid fa-file-circle-exclamation text-lg"></i>
                        Daftar Pengaduan
                    </div>

                    <i
                        class="fa-solid"
                        :class="open ? 'fa-chevron-up' : 'fa-chevron-down'"
                    ></i>
                </button>

                {{-- DROPDOWN --}}
                <div
                    x-show="open"
                    x-transition
                    class="ml-6 space-y-2"
                >

                    <a href="{{ route('aspiration.index') }}"
                    class="block px-4 py-2 rounded-lg text-sm
                    {{ request()->routeIs('aspiration.index') ? 'bg-[#a2e8ff4c] text-[#00afea] font-semibold' : 'text-gray-500 hover:bg-gray-100' }}">
                        Semua Pengaduan
                    </a>

                    <a href="{{ route('aspirations.menunggu') }}"
                    class="block px-4 py-2 rounded-lg text-sm
                    {{ request()->routeIs('aspirations.menunggu') ? 'bg-yellow-100 text-yellow-600 font-semibold' : 'text-gray-500 hover:bg-gray-100' }}">
                        Menunggu
                    </a>

                    <a href="{{ route('aspirations.diproses') }}"
                    class="block px-4 py-2 rounded-lg text-sm
                    {{ request()->routeIs('aspirations.diproses') ? 'bg-blue-100 text-blue-600 font-semibold' : 'text-gray-500 hover:bg-gray-100' }}">
                        Diproses
                    </a>

                    <a href="{{ route('aspirations.selesai') }}"
                    class="block px-4 py-2 rounded-lg text-sm
                    {{ request()->routeIs('aspirations.selesai') ? 'bg-green-100 text-green-600 font-semibold' : 'text-gray-500 hover:bg-gray-100' }}">
                        Selesai
                    </a>

                    <a href="{{ route('aspirations.ditolak') }}"
                    class="block px-4 py-2 rounded-lg text-sm
                    {{ request()->routeIs('aspirations.ditolak') ? 'bg-red-100 text-red-600 font-semibold' : 'text-gray-500 hover:bg-gray-100' }}">
                        Ditolak
                    </a>

                </div>
            </div>

            {{-- kategori --}}
            <div>
                <p class="text-sm font-bold uppercase mb-3 text-gray-900">Kelola Kategori</p>

                <a href="{{ route('category.index') }}"
                class="relative flex items-center gap-4 px-5 py-3 rounded-xl transition-all duration-200
                {{ request()->routeIs('category.index')
                        ? 'bg-[#a2e8ff4c] text-[#00afea] font-semibold'
                        : 'text-gray-500 hover:bg-gray-100 hover:text-gray-900' }}">

                    {{-- GARIS AKTIF DI SISI SIDEBAR --}}
                    @if(request()->routeIs('category.index'))
                        <span class="absolute -left-5 top-0 h-full w-1 bg-yellow-400 rounded-r-full"></span>
                    @endif

                    <i class="fa-solid fa-folder text-lg"></i>
                    Daftar Kategori
                </a>
            </div>

        </nav>
    </aside>

    {{-- MAIN AREA --}}
    <div class="flex-1 flex flex-col">

        {{-- TOPBAR --}}
        <header class="h-20 bg-white flex items-center justify-between px-8">

            <div class="flex items-center gap-4">
                <!-- tombol dibesarin -->
                <button id="toggleSidebar" class="p-3 rounded-lg hover:bg-gray-100">
                    <svg xmlns="http://www.w3.org/2000/svg"
                         class="h-6 w-6 text-gray-600"
                         fill="none"
                         viewBox="0 0 24 24"
                         stroke="currentColor">
                        <path stroke-linecap="round"
                              stroke-linejoin="round"
                              stroke-width="2"
                              d="M4 6h16M4 12h16M4 18h16"/>
                    </svg>
                </button>
            </div>

            <div class="relative">
                <button onclick="toggleProfile()"
                        class="flex items-center gap-5 focus:outline-none">

                    <div class="text-right leading-tight">
                        <!-- font dibesarin -->
                        <p class="text-base font-semibold text-gray-800">
                            {{ Auth::user()->name }}
                        </p>
                        <p class="text-sm text-gray-500">
                            {{ Auth::user()->email }}
                        </p>
                    </div>

                    <!-- avatar dibesarin -->
                    <img
                        src="{{ Auth::user()->photo
                            ? asset('storage/' . Auth::user()->photo)
                            : 'https://ui-avatars.com/api/?name=' . urlencode(Auth::user()->name) . '&background=2563eb&color=fff' }}"
                        class="w-12 h-12 rounded-full object-cover"
                        alt="Avatar"
                    >
                </button>

                <div id="profileDropdown"
                     class="hidden absolute right-0 mt-4 w-96 bg-white rounded-2xl shadow-lg border z-50">

                    <div class="p-8">

                        <div class="flex items-center gap-5">
                            <img
                                src="{{ Auth::user()->photo
                                    ? asset('storage/' . Auth::user()->photo)
                                    : 'https://ui-avatars.com/api/?name=' . urlencode(Auth::user()->name) . '&background=2563eb&color=fff' }}"
                                class="w-12 h-12 rounded-full object-cover"
                                alt="Avatar"
                            >

                            <div>
                                <p class="text-lg font-semibold text-gray-800">
                                    {{ Auth::user()->name }}
                                </p>
                                <p class="text-base text-gray-500 flex items-center gap-2">
                                    <i class="fa-solid fa-envelope"></i>
                                    {{ Auth::user()->email }}
                                </p>
                            </div>
                        </div>

                        <hr class="my-6">

                        <a href="{{ route('admin.profile') }}"
                           class="block w-full text-center bg-blue-50 text-blue-600 py-4 rounded-xl font-semibold hover:bg-blue-100 transition">
                            Edit Profil
                        </a>

                        <form method="POST" action="{{ route('logout') }}" class="mt-5">
                            @csrf
                            <button type="submit"
                                    class="w-full flex items-center justify-center gap-2 bg-red-50 text-red-600 py-4 rounded-xl font-semibold hover:bg-red-100 transition">
                                Logout
                                <i class="fa-solid fa-right-from-bracket"></i>
                            </button>
                        </form>

                    </div>
                </div>
            </div>
        </header>

        <main class="p-8">
            @yield('content')
        </main>

    </div>
</div>

<script>
    function toggleProfile() {
        document.getElementById('profileDropdown')
            .classList.toggle('hidden');
    }

    document.addEventListener('click', function (e) {
        const dropdown = document.getElementById('profileDropdown');
        if (!e.target.closest('.relative')) {
            dropdown.classList.add('hidden');
        }
    });

    const toggleBtn = document.getElementById('toggleSidebar');
    const sidebar = document.getElementById('sidebar');

    toggleBtn.addEventListener('click', () => {
        sidebar.classList.toggle('-ml-80');
    });
</script>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
@stack('scripts')
</body>
</html>
