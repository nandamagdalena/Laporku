@extends('layouts.usertemplate')

@section('title', 'Dashboard')

@section('content')

{{-- HEADER --}}
<div class="mb-6">
    <h1 class="text-2xl font-semibold text-gray-800">Dashboard</h1>
    <p class="text-sm text-gray-500 mt-1">
        Halo, {{ Auth::user()->name ?? 'User' }}, selamat datang kembali di Dashboard Laporku!
    </p>
</div>

{{-- SUMMARY CARD --}}
<div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">

    {{-- Menunggu --}}
    <div class="bg-white rounded-xl p-5 flex items-center gap-4 shadow-sm">
        <div class="w-12 h-12 rounded-lg bg-blue-50 flex items-center justify-center">
            <i class="fa-regular fa-clock text-blue-600 text-lg"></i>
        </div>
        <div>
            <p class="text-sm text-gray-500">Menunggu</p>
            <p class="text-2xl font-semibold text-gray-800">100</p>
        </div>
    </div>

    {{-- Proses --}}
    <div class="bg-white rounded-xl p-5 flex items-center gap-4 shadow-sm">
        <div class="w-12 h-12 rounded-lg bg-yellow-50 flex items-center justify-center">
            <i class="fa-solid fa-rotate text-yellow-500 text-lg"></i>
        </div>
        <div>
            <p class="text-sm text-gray-500">Proses</p>
            <p class="text-2xl font-semibold text-gray-800">25</p>
        </div>
    </div>

    {{-- Selesai --}}
    <div class="bg-white rounded-xl p-5 flex items-center gap-4 shadow-sm">
        <div class="w-12 h-12 rounded-lg bg-green-50 flex items-center justify-center">
            <i class="fa-solid fa-check text-green-600 text-lg"></i>
        </div>
        <div>
            <p class="text-sm text-gray-500">Selesai</p>
            <p class="text-2xl font-semibold text-gray-800">189</p>
        </div>
    </div>

</div>

{{-- STATISTIK --}}
<div class="grid grid-cols-1 lg:grid-cols-2 gap-6">

    {{-- Statistik Harian --}}
    <div class="bg-white rounded-xl p-6 shadow-sm">
        <div class="mb-4">
            <h3 class="text-sm font-semibold text-gray-700">Statistik Harian</h3>
            <p class="text-xs text-gray-500">Jumlah Pengaduan Harian</p>
        </div>

        {{-- Dummy Chart --}}
        <div class="h-40 bg-linear-to-t from-red-50 to-white rounded-lg flex items-end px-4 pb-4">
            <div class="w-full h-20 bg-red-200 rounded-md opacity-60"></div>
        </div>

        <p class="text-xs text-gray-500 mt-3">
            Pengaduan hari ini: <span class="font-semibold text-gray-700">30 laporan</span>
        </p>
    </div>

    {{-- Statistik Bulanan --}}
    <div class="bg-white rounded-xl p-6 shadow-sm">
        <div class="mb-4">
            <h3 class="text-sm font-semibold text-gray-700">Statistik Bulanan</h3>
            <p class="text-xs text-gray-500">Jumlah Pengaduan Bulanan</p>
        </div>

        {{-- Dummy Chart --}}
        <div class="h-40 bg-linear-to-t from-blue-50 to-white rounded-lg flex items-end px-4 pb-4">
            <div class="w-full h-24 bg-blue-200 rounded-md opacity-60"></div>
        </div>

        <p class="text-xs text-gray-500 mt-3">
            Pengaduan bulan ini:
            <span class="font-semibold text-gray-700">600 laporan</span>
        </p>
    </div>

</div>

@endsection
