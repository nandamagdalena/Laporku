@extends('layouts.template')

@section('title', 'Dashboard')

@section('content')

<div class="space-y-6">

    {{-- HEADER --}}
    <div>
        <h1 class="text-2xl font-semibold text-gray-800">Dashboard</h1>
        <p class="text-sm text-gray-500 mt-1">
            Halo {{ Auth::user()->name ?? 'User' }}, selamat datang kembali di Dashboard Laporku!
        </p>
    </div>

    {{-- STATISTIK CARD --}}
    <div class="bg-white rounded-2xl shadow-md p-8">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

            {{-- Total Pengguna --}}
            <div class="flex items-center gap-5 border-r last:border-r-0 pr-6">
                <div class="w-16 h-16 rounded-full bg-green-100 flex items-center justify-center">
                    <svg class="w-8 h-8 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M17 20h5v-2a4 4 0 00-5-4M9 20H4v-2a4 4 0 015-4m8-4a4 4 0 11-8 0 4 4 0 018 0z"/>
                    </svg>
                </div>
                <div>
                    <p class="text-sm text-gray-500">Total Pengguna</p>
                    <p class="text-3xl font-bold text-gray-800">{{ $totalUsers ?? 5423 }}</p>
                </div>
            </div>

            {{-- Kategori --}}
            <div class="flex items-center gap-5 border-r last:border-r-0 pr-6">
                <div class="w-16 h-16 rounded-full bg-green-100 flex items-center justify-center">
                    <svg class="w-8 h-8 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M3 7h18M3 12h18M3 17h18"/>
                    </svg>
                </div>
                <div>
                    <p class="text-sm text-gray-500">Kategori</p>
                    <p class="text-3xl font-bold text-gray-800">{{ $totalCategories ?? 10 }}</p>
                </div>
            </div>

            {{-- Pengaduan --}}
            <div class="flex items-center gap-5">
                <div class="w-16 h-16 rounded-full bg-green-100 flex items-center justify-center">
                    <svg class="w-8 h-8 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 12h6m-6 4h6M7 8h10M5 20h14a2 2 0 002-2V6a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                    </svg>
                </div>
                <div>
                    <p class="text-sm text-gray-500">Pengaduan</p>
                    <p class="text-3xl font-bold text-gray-800">{{ $totalAspirations ?? 189 }}</p>
                </div>
            </div>

        </div>
    </div>

    {{-- CHART ATAS --}}
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">

        {{-- Chart Pengguna --}}
        <div class="bg-white rounded-2xl shadow-md p-6">
            <h3 class="font-semibold text-gray-700">Chart Pengguna</h3>
            <p class="text-xs text-gray-400 mb-4">Data Keseluruhan Pengguna</p>
            <canvas id="penggunaLineChart" height="120"></canvas>
        </div>

        {{-- Chart Pengaduan --}}
        <div class="bg-white rounded-2xl shadow-md p-6">
            <h3 class="font-semibold text-gray-700">Chart Pengaduan</h3>
            <p class="text-xs text-gray-400 mb-4">Statistik Jumlah Pengaduan</p>
            <canvas id="pengaduanLineChart" height="120"></canvas>
        </div>

    </div>

    {{-- BAGIAN BAWAH --}}
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">

        {{-- List Pengguna Terbaru --}}
        <div class="bg-white rounded-2xl shadow-md p-6">
            <h3 class="font-semibold text-indigo-700 mb-4">List Pengguna Terbaru</h3>

            <div class="space-y-4">
                @foreach ($latestUsers ?? [] as $user)
                <div class="flex items-center gap-4 bg-gray-50 p-3 rounded-xl">
                    <img src="https://ui-avatars.com/api/?name={{ urlencode($user->name ?? 'User') }}&background=6366f1&color=fff"
                        class="w-10 h-10 rounded-full">
                    <div>
                        <p class="text-sm font-medium text-gray-800">{{ $user->name ?? 'Alberto Vieira Santos' }}</p>
                        <p class="text-xs text-gray-500">
                            Bergabung Pada: {{ $user->created_at->format('d F Y') ?? '27 November 2025' }}
                        </p>
                    </div>
                </div>
                @endforeach
            </div>
        </div>

        {{-- Chart Penambahan Pengguna --}}
        <div class="bg-white rounded-2xl shadow-md p-6">
            <h3 class="font-semibold text-indigo-700 mb-4">Chart Penambahan Pengguna</h3>
            <canvas id="userBarChart" height="120"></canvas>
        </div>

    </div>

</div>

@php
    $bulan = [
        1=>'Jan',2=>'Feb',3=>'Mar',4=>'Apr',5=>'Mei',6=>'Jun',
        7=>'Jul',8=>'Agu',9=>'Sep',10=>'Okt',11=>'Nov',12=>'Des'
    ];
@endphp

{{-- CHART JS --}}
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>

    // Line Chart Pengguna
    new Chart(document.getElementById('penggunaLineChart'), {
        type: 'line',
        data: {
            labels: ['Feb', 'Mar', 'Apr', 'Mei', 'Jun'],
            datasets: [{
                data: [10, 25, 15, 30, 20],
                borderColor: '#ef4444',
                backgroundColor: 'rgba(239,68,68,0.15)',
                tension: 0.4,
                fill: true
            }]
        },
        options: {
            plugins: { legend: { display: false } }
        }
    });


    // Line Chart Pengaduan
    new Chart(document.getElementById('pengaduanLineChart'), {
        type: 'line',
        data: {
            labels: ['Feb', 'Mar', 'Apr', 'Mei', 'Jun'],
            datasets: [{
                data: [12, 28, 18, 35, 22],
                borderColor: '#3b82f6',
                backgroundColor: 'rgba(59,130,246,0.15)',
                tension: 0.4,
                fill: true
            }]
        },
        options: {
            plugins: { legend: { display: false } }
        }
    });


    // Bar Chart Penambahan Pengguna
    new Chart(document.getElementById('userBarChart'), {
        type: 'bar',
        data: {
            labels: {!! json_encode(
                $userChart->pluck('month')->map(fn($m) => $bulan[$m])
            ) !!},
            datasets: [{
                label: 'Pengguna Baru ({{ now()->year }})',
                data: {!! json_encode($userChart->pluck('total')) !!},
                backgroundColor: '#10b981',
                borderRadius: 8
            }]
        },
        options: {
            plugins: {
                legend: { display: true }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: { stepSize: 1 }
                }
            }
        }
    });

</script>

@endsection
