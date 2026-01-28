@extends('layouts.template')

@section('title', 'Dashboard')

@section('content')

{{-- Header --}}
<div class="mb-6">
    <h1 class="text-2xl font-semibold text-gray-800">Dashboard</h1>
    <p class="text-sm text-gray-500 mt-1">
        Halo, Admin Sarpras, selamat datang kembali di Dashboard Laporku!
    </p>
</div>

{{-- Statistik --}}
<div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
    {{-- Total Pengguna --}}
    <div class="bg-white rounded-xl p-6 flex items-center gap-4 shadow-sm">
        <div class="w-12 h-12 rounded-full bg-green-100 flex items-center justify-center">
            <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M17 20h5v-2a4 4 0 00-5-4M9 20H4v-2a4 4 0 015-4m8-4a4 4 0 11-8 0 4 4 0 018 0z"/>
            </svg>
        </div>
        <div>
            <p class="text-sm text-gray-500">Total Pengguna</p>
            <p class="text-2xl font-semibold text-gray-800">5,423</p>
        </div>
    </div>

    {{-- Kategori --}}
    <div class="bg-white rounded-xl p-6 flex items-center gap-4 shadow-sm">
        <div class="w-12 h-12 rounded-full bg-green-100 flex items-center justify-center">
            <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M3 7h18M3 12h18M3 17h18"/>
            </svg>
        </div>
        <div>
            <p class="text-sm text-gray-500">Kategori</p>
            <p class="text-2xl font-semibold text-gray-800">10</p>
        </div>
    </div>

    {{-- Pengaduan --}}
    <div class="bg-white rounded-xl p-6 flex items-center gap-4 shadow-sm">
        <div class="w-12 h-12 rounded-full bg-green-100 flex items-center justify-center">
            <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M9 12h6m-6 4h6M7 8h10M5 20h14a2 2 0 002-2V6a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
            </svg>
        </div>
        <div>
            <p class="text-sm text-gray-500">Pengaduan</p>
            <p class="text-2xl font-semibold text-gray-800">189</p>
        </div>
    </div>
</div>

{{-- Chart Section --}}
<div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-6">
    {{-- Chart Pengguna --}}
    <div class="bg-white rounded-xl p-6 shadow-sm">
        <h3 class="text-sm font-semibold text-gray-700 mb-1">Chart Pengguna</h3>
        <p class="text-xs text-gray-400 mb-4">Data keseluruhan pengguna</p>

        <div class="h-48 flex items-center justify-center text-gray-400 text-sm">
            (Chart Pengguna – placeholder)
        </div>
    </div>

    {{-- Chart Pengaduan --}}
    <div class="bg-white rounded-xl p-6 shadow-sm">
        <h3 class="text-sm font-semibold text-gray-700 mb-1">Chart Pengaduan</h3>
        <p class="text-xs text-gray-400 mb-4">Statistik jumlah pengaduan</p>

        <div class="h-48 flex items-center justify-center text-gray-400 text-sm">
            (Chart Pengaduan – placeholder)
        </div>
    </div>
</div>

{{-- Bottom Section --}}
<div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
    {{-- List Pengguna Terbaru --}}
    <div class="bg-white rounded-xl p-6 shadow-sm">
        <h3 class="text-sm font-semibold text-gray-700 mb-4">List Pengguna Terbaru</h3>

        <ul class="space-y-4">
            @for ($i = 0; $i < 4; $i++)
                <li class="flex items-center gap-3">
                    <img src="https://ui-avatars.com/api/?name=User&background=2563eb&color=fff"
                         class="w-10 h-10 rounded-full">
                    <div>
                        <p class="text-sm font-medium text-gray-800">Alberto Vieira Santos</p>
                        <p class="text-xs text-gray-500">Bergabung pada: 27 November 2025</p>
                    </div>
                </li>
            @endfor
        </ul>
    </div>

    {{-- Chart Penambahan Pengguna --}}
    <div class="bg-white rounded-xl p-6 shadow-sm">
        <h3 class="text-sm font-semibold text-gray-700 mb-4">Chart Penambahan Pengguna</h3>

        <div class="h-56 flex items-center justify-center text-gray-400 text-sm">
            (Bar Chart – placeholder)
        </div>
    </div>
</div>

@endsection
