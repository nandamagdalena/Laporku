@extends('layouts.template')

@section('title', 'Dashboard')

@section('content')

<div class="space-y-8">

    {{-- HEADER --}}
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-3xl font-bold text-gray-800">Dashboard</h1>
            <p class="text-[#1ac8db] mt-2">
                Halo {{ Auth::user()->name ?? 'User' }}, selamat datang kembali 👋
            </p>
        </div>
        <div class="hidden md:block">
            <span class="bg-blue-50 text-blue-600 px-4 py-2 rounded-xl text-sm font-semibold">
                {{ now()->format('l, d F Y') }}
            </span>
        </div>
    </div>


    {{-- STATISTIK CARD --}}
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

        {{-- Total Pengguna --}}
        <div class="bg-[#a2e8ff4c] p-8 rounded-2xl shadow-md hover:shadow-xl transition duration-300">
            <div class="flex justify-between items-center">
                <div>
                    <p class="text-cyan-500 text-sm">Total Pengguna</p>
                    <h2 class="text-4xl font-bold text-cyan-700 mt-2">
                        {{ $totalUsers ?? 5423 }}
                    </h2>
                </div>
                <div class="w-16 h-16 rounded-2xl bg-cyan-300 flex items-center justify-center">
                    <svg class="w-8 h-8 text-cyan-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M17 20h5v-2a4 4 0 00-5-4M9 20H4v-2a4 4 0 015-4m8-4a4 4 0 11-8 0 4 4 0 018 0z"/>
                    </svg>
                </div>
            </div>
        </div>

        {{-- Kategori --}}
        <div class="bg-yellow-50 p-8 rounded-2xl shadow-md hover:shadow-xl transition duration-300">
            <div class="flex justify-between items-center">
                <div>
                    <p class="text-yellow-500 text-sm">Kategori</p>
                    <h2 class="text-4xl font-bold text-yellow-800 mt-2">
                        {{ $totalCategories ?? 10 }}
                    </h2>
                </div>
                <div class="w-16 h-16 rounded-2xl bg-yellow-200 flex items-center justify-center">
                    <svg class="w-8 h-8 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M3 7h18M3 12h18M3 17h18"/>
                    </svg>
                </div>
            </div>
        </div>

        {{-- Pengaduan --}}
        <div class="bg-blue-50 p-8 rounded-2xl shadow-md hover:shadow-xl transition duration-300">
            <div class="flex justify-between items-center">
                <div>
                    <p class="text-blue-500 text-sm">Pengaduan</p>
                    <h2 class="text-4xl font-bold text-blue-800 mt-2">
                        {{ $totalAspirations ?? 189 }}
                    </h2>
                </div>
                <div class="w-16 h-16 rounded-2xl bg-indigo-100 flex items-center justify-center">
                    <svg class="w-8 h-8 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 12h6m-6 4h6M7 8h10M5 20h14a2 2 0 002-2V6a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                    </svg>
                </div>
            </div>
        </div>

    </div>

    {{-- CHART SECTION --}}
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">

        <div class="bg-white p-8 rounded-2xl shadow-md">
            <h3 class="text-lg font-semibold text-gray-700 mb-6">Statistik Pengguna</h3>
            <canvas id="penggunaLineChart" height="140"></canvas>
        </div>

        <div class="bg-white p-8 rounded-2xl shadow-md">
            <h3 class="text-lg font-semibold text-gray-700 mb-6">Statistik Pengaduan</h3>
            <canvas id="pengaduanLineChart" height="140"></canvas>
        </div>

    </div>


    {{-- BAGIAN BAWAH --}}
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">

        {{-- User Terbaru --}}
        <div class="bg-white p-8 rounded-2xl shadow-md">
            <h3 class="text-lg font-semibold text-indigo-700 mb-6">
                Pengguna Terbaru
            </h3>

            <div class="space-y-4">
                @foreach ($latestUsers ?? [] as $user)
                <div class="flex items-center justify-between bg-gray-50 p-4 rounded-xl hover:bg-gray-100 transition">
                    <div class="flex items-center gap-4">
                        <img
                            src="{{ $user->photo
                                ? asset('storage/' . $user->photo)
                                : 'https://ui-avatars.com/api/?name=' . urlencode($user->name) . '&background=2563eb&color=fff' }}"
                            class="w-12 h-12 rounded-full object-cover"
                            alt="Avatar"
                        >
                        <div>
                            <p class="font-semibold text-gray-800">
                                {{ $user->name ?? 'User Name' }}
                            </p>
                            <p class="text-sm text-gray-500">
                                {{ $user->created_at->format('d F Y') ?? '-' }}
                            </p>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>


        {{-- Chart Bar --}}
        <div class="bg-white p-6 rounded-2xl shadow-md">

            <h3 class="font-semibold mb-4">Laporan Terbaru</h3>

            <div class="overflow-hidden rounded-xl border border-gray-200">
                <table class="w-full text-sm">
                    <thead class="bg-cyan-600 text-white">
                        <tr>
                            <th class="px-3 py-3 text-left">Nama</th>
                            <th class="px-3 py-3 text-center">Tanggal</th>
                            <th class="px-3 py-3 text-center">Lokasi</th>
                            <th class="px-3 py-3 text-center">Status</th>
                            <th class="px-3 py-3 text-center">Aksi</th>
                        </tr>
                    </thead>

                    <tbody class="divide-y">
                        @foreach($latestAspirations as $item)
                        <tr class="hover:bg-gray-50">

                            <td class="px-3 py-3">
                                {{ $item->user->name }}
                            </td>

                            <td class="px-3 py-3 text-center">
                                {{ $item->created_at->format('d-m-Y') }}
                            </td>

                            <td class="px-3 py-3 text-center">
                                {{ $item->location }}
                            </td>

                            <td class="px-3 py-3 text-center">
                                @php
                                    $statusClass = match($item->status) {
                                        'menunggu' => 'bg-yellow-100 text-yellow-600',
                                        'diproses' => 'bg-blue-100 text-blue-600',
                                        'selesai' => 'bg-green-100 text-green-600',
                                        'ditolak' => 'bg-red-100 text-red-600',
                                    };
                                @endphp

                                <span class="px-3 py-1 rounded-full text-xs font-semibold {{ $statusClass }}">
                                    {{ ucfirst($item->status) }}
                                </span>
                            </td>

                            <td class="px-3 py-3 text-center">
                                <a href="{{ route('aspiration.show', $item->id) }}"
                                class="inline-flex items-center justify-center w-8 h-8 rounded-full
                                        border border-blue-500 text-blue-600 hover:bg-blue-50">
                                    <i class="fa-solid fa-eye text-xs"></i>
                                </a>
                            </td>

                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

    </div>

</div>
@endsection

@push('scripts')
@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    document.addEventListener("DOMContentLoaded", function () {

        // DATA DARI LARAVEL
        const userChartData = @json($userChart);
        const pengaduanDataRaw = @json($pengaduanPerBulan);

        // FORMAT DATA 12 BULAN
        const userData = Array(12).fill(0);
        const pengaduanData = Array(12).fill(0);

        userChartData.forEach(item => {
            userData[item.month - 1] = item.total;
        });

        pengaduanDataRaw.forEach(item => {
            pengaduanData[item.month - 1] = item.total;
        });

        const labels = ['Jan','Feb','Mar','Apr','Mei','Jun','Jul','Agu','Sep','Okt','Nov','Des'];

        // === CHART PENGGUNA ===
        const penggunaCtx = document.getElementById('penggunaLineChart');
        if (penggunaCtx) {
            new Chart(penggunaCtx, {
                type: 'line',
                data: {
                    labels: labels,
                    datasets: [{
                        label: 'Jumlah Pengguna',
                        data: userData,
                        borderColor: '#6366f1',
                        backgroundColor: 'rgba(99,102,241,0.1)',
                        tension: 0.4,
                        fill: true
                    }]
                },
                options: {
                    responsive: true,
                    plugins: {
                        legend: { display: true }
                    }
                }
            });
        }

        // === CHART PENGADUAN ===
        const pengaduanCtx = document.getElementById('pengaduanLineChart');
        if (pengaduanCtx) {
            new Chart(pengaduanCtx, {
                type: 'line',
                data: {
                    labels: labels,
                    datasets: [{
                        label: 'Jumlah Pengaduan',
                        data: pengaduanData,
                        borderColor: '#10b981',
                        backgroundColor: 'rgba(16,185,129,0.1)',
                        tension: 0.4,
                        fill: true
                    }]
                },
                options: {
                    responsive: true,
                    plugins: {
                        legend: { display: true }
                    }
                }
            });
        }

        // === BAR CHART USER ===
        const barCtx = document.getElementById('userBarChart');
        if (barCtx) {
            new Chart(barCtx, {
                type: 'bar',
                data: {
                    labels: labels,
                    datasets: [{
                        label: 'User Baru',
                        data: userData,
                        backgroundColor: '#6366f1'
                    }]
                },
                options: {
                    responsive: true,
                    plugins: {
                        legend: { display: true }
                    }
                }
            });
        }

    });
</script>
@endpush
