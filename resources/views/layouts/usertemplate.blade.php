<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Dashboard')</title>

    @vite('resources/css/app.css')

    {{-- Font Awesome --}}
    <link
        rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
        crossorigin="anonymous"
    />
</head>

<body class="bg-gray-100">

<div class="flex min-h-screen">

    {{-- SIDEBAR --}}
    <aside class="w-64 bg-white border-r border-gray-200 flex flex-col">

        {{-- Logo --}}
        <div class="h-16 flex items-center gap-2 px-6 border-b">
            <img src="{{ asset('images/logopanjang.png') }}" class="h-8" alt="Laporku">
        </div>

        {{-- Menu --}}
        <nav class="flex-1 px-4 py-6 text-sm text-gray-700 space-y-6">

            {{-- Dashboard --}}
            <div>
                <p class="text-xs text-black-400 uppercase mb-2">Dashboard</p>

                <a href="{{ route('user.dashboard') }}"
                class="flex items-center px-3 py-2 rounded-lg
                {{ request()->routeIs('user.dashboard')
                        ? 'bg-blue-50 text-blue-600 font-medium'
                        : 'hover:bg-gray-100 text-gray-700' }}">
                    <i class="fa-solid fa-house mr-1.5"></i>
                    Dashboard
                </a>
            </div>

            {{-- Pengaduan --}}
            <div>
                <p class="text-xs uppercase text-black-400 mb-2">Pengaduan</p>

                <a href="{{ route('pengaduan.create') }}"
                class="flex items-center gap-3 px-3 py-2 rounded-lg
                {{ request()->routeIs('pengaduan.create')
                        ? 'bg-blue-50 text-blue-600 font-medium'
                        : 'hover:bg-gray-100 text-gray-700' }}">
                    <i class="fa-regular fa-file-lines"></i>
                    Form Pengaduan
                </a>

                <a href="{{ route('pengaduan.mine') }}"
                class="flex items-center gap-3 px-3 py-2 rounded-lg
                {{ request()->routeIs('pengaduan.mine')
                        ? 'bg-blue-50 text-blue-600 font-medium'
                        : 'hover:bg-gray-100 text-gray-700' }}">
                    <i class="fa-solid fa-clock-rotate-left"></i>
                    Riwayat Pengaduan
                </a>
            </div>

        </nav>
    </aside>

    {{-- MAIN AREA --}}
    <div class="flex-1 flex flex-col">

        {{-- TOPBAR --}}
        <header class="h-16 bg-white border-b flex items-center justify-between px-6">

            {{-- Left --}}
            <div class="flex items-center gap-3">
                <button class="p-2 rounded-lg hover:bg-gray-100">
                    <i class="fa-solid fa-bars text-gray-600"></i>
                </button>
            </div>

            {{-- Right --}}
            <div class="flex items-center gap-4">
                <div class="text-right leading-tight">
                    <p class="text-sm font-semibold text-gray-800">
                        {{ Auth::user()->name ?? 'User' }}
                    </p>
                    <p class="text-xs text-gray-500">
                        {{ Auth::user()->email ?? 'user@email.com' }}
                    </p>
                </div>

                <img
                    src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name ?? 'User') }}&background=2563eb&color=fff"
                    class="w-9 h-9 rounded-full"
                    alt="Avatar"
                >
            </div>
        </header>

        {{-- CONTENT --}}
        <main class="flex-1 p-6">
            @yield('content')
        </main>

    </div>
</div>

</body>
</html>
