<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Dashboard')</title>

    @vite('resources/css/app.css')

    <link
        rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
        crossorigin="anonymous"
    />
</head>

<body class="bg-gray-100">

<div class="flex min-h-screen">

    {{-- SIDEBAR --}}
    <aside id="sidebar" class="w-80 bg-white flex flex-col transition-all duration-300">

        {{-- Logo --}}
        <div class="h-28 flex items-center px-16">
            <!-- DARI h-20 JADI h-24 -->
            <img src="{{ asset('images/logonew.png') }}" alt="Laporku" class="h-24">
        </div>

        {{-- Menu --}}
        <nav class="flex-1 px-6 py-8 text-base text-gray-700 space-y-8">

            {{-- Dashboard --}}
            <div>
                <p class="text-sm font-bold uppercase mb-3 text-gray-900">Dashboard</p>

                <a href="{{ route('user.dashboard') }}"
                class="flex items-center gap-4 px-5 py-3 rounded-xl
                {{ request()->routeIs('user.dashboard')
                        ? 'bg-[#a2e8ff4c] text-[#00afea] font-semibold'
                        : 'text-gray-500 hover:bg-gray-100 hover:text-gray-900' }}">
                    <i class="fa-solid fa-house"></i>
                    Dashboard
                </a>
            </div>

            {{-- Pengaduan --}}
            <div>
                <p class="text-sm font-bold uppercase mb-3 text-gray-900">Pengaduan</p>

                <a href="{{ route('pengaduan.create') }}"
                class="flex items-center gap-4 px-5 py-3 rounded-xl
                {{ request()->routeIs('pengaduan.create')
                        ? 'bg-[#a2e8ff4c] text-[#00afea] font-semibold'
                        : 'text-gray-500 hover:bg-gray-100 hover:text-gray-900' }}">
                    <i class="fa-regular fa-file-lines"></i>
                    Form Pengaduan
                </a>

                <a href="{{ route('pengaduan.mine') }}"
                class="flex items-center gap-4 px-5 py-3 rounded-xl
                {{ request()->routeIs('pengaduan.mine')
                        ? 'bg-[#a2e8ff4c] text-[#00afea] font-semibold'
                        : 'text-gray-500 hover:bg-gray-100 hover:text-gray-900' }}">
                    <i class="fa-solid fa-clock-rotate-left"></i>
                    Riwayat Pengaduan
                </a>
            </div>

        </nav>
    </aside>

    {{-- MAIN AREA --}}
    <div class="flex-1 flex flex-col">

        {{-- TOPBAR --}}
        <header class="h-20 bg-white flex items-center justify-between px-10">

            {{-- Left --}}
            <div class="flex items-center gap-4">
                <button id="toggleSidebar" class="p-3 rounded-lg hover:bg-gray-100">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gray-600" fill="none"
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
                    class="flex items-center gap-5 focus:outline-none">

                    <div class="text-right leading-tight">
                        <p class="text-base font-semibold text-gray-800">
                            {{ Auth::user()->name }}
                        </p>
                        <p class="text-sm text-gray-500">
                            {{ Auth::user()->email }}
                        </p>
                    </div>

                    <img
                        src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name) }}&background=2563eb&color=fff"
                        class="w-12 h-12 rounded-full"
                        alt="Avatar"
                    >
                </button>

                {{-- DROPDOWN PROFILE --}}
                <div
                    id="profileDropdown"
                    class="hidden absolute right-0 mt-4 w-80 bg-white rounded-2xl shadow-xl z-50">

                    <div class="p-6">

                        <div class="flex items-center gap-4">
                            <img
                                src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name) }}&background=ef4444&color=fff"
                                class="w-16 h-16 rounded-full"
                                alt="Avatar"
                            >

                            <div>
                                <p class="text-lg font-semibold text-gray-800">
                                    {{ Auth::user()->name }}
                                </p>
                                <p class="text-sm text-gray-500 flex items-center gap-2">
                                    <i class="fa-solid fa-envelope"></i>
                                    {{ Auth::user()->email }}
                                </p>
                            </div>
                        </div>

                        <hr class="my-6 opacity-5">

                        <a
                            href="{{ route('profile.edit') }}"
                            class="block w-full text-center bg-blue-50 text-blue-600 py-3 rounded-xl font-semibold hover:bg-blue-100 transition">
                            Edit Profil
                        </a>

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

        {{-- CONTENT --}}
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

</body>
</html>
