@extends('layouts.usertemplate')

@section('title', 'Dashboard User')

@section('content')

<div class="space-y-6">

    {{-- Banner --}}
    <div
        class="rounded-2xl p-6 flex justify-between items-center text-white shadow-lg"
        style="background: linear-gradient(to right, #2563eb, #3b82f6);">
        <div>
            <h2 class="text-2xl font-bold">
                Halo, {{ auth()->user()->name }}! 👋
            </h2>
            <p class="text-sm mt-2 opacity-90 max-w-md">
                Laporku! membantu Anda melaporkan sarana sekolah yang bermasalah agar
                segera ditindaklanjuti demi lingkungan belajar yang aman dan nyaman.
            </p>
        </div>

        <img src="{{ asset('images/people.png') }}"
            class="w-32 hidden md:block">
    </div>

    {{-- Statistik Status --}}
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

        <div class="bg-white rounded-2xl p-6 flex items-center gap-4 shadow">
            <div class="bg-blue-100 text-blue-600 p-6 rounded-xl">
                <i class="fa-solid fa-hourglass-half text-3xl"></i>
            </div>
            <div>
                <p class="text-gray-500 text-sm">Menunggu</p>
                <p class="text-2xl font-bold">{{ $menunggu }}</p>
            </div>
        </div>

        <div class="bg-white rounded-2xl p-6 flex items-center gap-4 shadow">
            <div class="bg-yellow-100 text-yellow-600 p-6 rounded-xl">
                <i class="fa-solid fa-chart-simple text-3xl"></i>
            </div>
            <div>
                <p class="text-gray-500 text-sm">Proses</p>
                <p class="text-2xl font-bold">{{ $proses }}</p>
            </div>
        </div>

        <div class="bg-white rounded-2xl p-6 flex items-center gap-4 shadow">
            <div class="bg-green-100 text-green-600 p-6 rounded-xl">
                <i class="fa-solid fa-circle-check text-3xl"></i>
            </div>
            <div>
                <p class="text-gray-500 text-sm">Selesai</p>
                <p class="text-2xl font-bold">{{ $selesai }}</p>
            </div>
        </div>

    </div>

    {{-- Charts --}}
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">

        {{-- Statistik Harian --}}
        <div class="bg-white rounded-2xl p-6 shadow">
            <h3 class="font-semibold mb-4">Statistik Harian</h3>
            <canvas id="harianChart"></canvas>
        </div>

        {{-- Statistik Bulanan --}}
        <div class="bg-white rounded-2xl p-6 shadow">
            <h3 class="font-semibold mb-4">Statistik Bulanan</h3>
            <canvas id="bulananChart"></canvas>
        </div>

    </div>

</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>

// Chart Harian
new Chart(document.getElementById('harianChart'), {
    type: 'line',
    data: {
        labels: {!! json_encode($harian->pluck('tanggal')) !!},
        datasets: [{
            label: 'Pengaduan Harian',
            data: {!! json_encode($harian->pluck('total')) !!},
            borderColor: '#ef4444',
            backgroundColor: 'rgba(239,68,68,0.2)',
            fill: true,
            tension: 0.4
        }]
    }
});

// Chart Bulanan
new Chart(document.getElementById('bulananChart'), {
    type: 'line',
    data: {
        labels: {!! json_encode($bulanan->pluck('bulan')) !!},
        datasets: [{
            label: 'Pengaduan Bulanan',
            data: {!! json_encode($bulanan->pluck('total')) !!},
            borderColor: '#3b82f6',
            backgroundColor: 'rgba(59,130,246,0.2)',
            fill: true,
            tension: 0.4
        }]
    }
});

</script>

@endsection
