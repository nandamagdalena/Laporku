@extends('layouts.usertemplate')

@section('title', 'Dashboard User')

@section('content')

<div class="space-y-6">

    {{-- BANNER --}}
    <div class="relative overflow-hidden rounded-2xl shadow-md px-6 py-4 text-white">

        {{-- Gradient Background --}}
        <div class="absolute inset-0 bg-linear-to-r from-[#1ac8db] to-blue-500"></div>

        {{-- Soft Glow --}}
        <div class="absolute -top-10 -left-10 w-40 h-40 bg-cyan-300 opacity-20 blur-2xl rounded-full"></div>

        <div class="relative flex items-center justify-between">

            {{-- TEXT --}}
            <div class="max-w-md">
                <h2 class="text-xl md:text-2xl font-semibold">
                    Selamat Datang,
                    <span class="text-cyan-200 font-bold">
                        {{ auth()->user()->name }}
                    </span> 👋
                </h2>

                <p class="mt-1 text-xs md:text-sm text-white/90">
                    Laporkan fasilitas bermasalah dengan cepat dan mudah.
                </p>

                <div class="mt-3 flex gap-2">
                    <a href="{{ route('pengaduan.create') }}"
                    class="bg-white text-blue-700 text-xs font-semibold px-4 py-2 rounded-lg
                            hover:scale-105 transition shadow">
                        🚀 Buat
                    </a>

                    <a href="#"
                    class="border border-white/40 text-xs px-4 py-2 rounded-lg
                            hover:bg-white/10 transition">
                        Riwayat
                    </a>
                </div>
            </div>

            {{-- IMAGE --}}
            <img src="{{ asset('images/people.png') }}"
                class="w-28 md:w-32 drop-shadow-lg hidden md:block">

        </div>
    </div>

    {{-- ================= STATISTIK (1 CARD BESAR) ================= --}}
    <div class="bg-white rounded-3xl shadow p-8 flex justify-around items-center">

        {{-- MENUNGGU --}}
        <div class="flex items-center gap-4">
            <div class="bg-blue-100 p-6 rounded-2xl text-blue-600">
                <i class="fa-solid fa-clock text-3xl"></i>
            </div>
            <div>
                <p class="text-gray-400 text-sm">Menunggu</p>
                <p class="text-3xl font-bold">{{ $menunggu }}</p>
            </div>
        </div>

        <div class="h-14 w-px bg-gray-200"></div>

        {{-- PROSES --}}
        <div class="flex items-center gap-4">
            <div class="bg-gray-100 p-6 rounded-2xl text-blue-500">
                <i class="fa-solid fa-rotate text-3xl"></i>
            </div>
            <div>
                <p class="text-gray-400 text-sm">Proses</p>
                <p class="text-3xl font-bold">{{ $proses }}</p>
            </div>
        </div>

        <div class="h-14 w-px bg-gray-200"></div>

        {{-- SELESAI --}}
        <div class="flex items-center gap-4">
            <div class="bg-gray-100 p-6 rounded-2xl text-blue-500">
                <i class="fa-solid fa-check text-3xl"></i>
            </div>
            <div>
                <p class="text-gray-400 text-sm">Selesai</p>
                <p class="text-3xl font-bold">{{ $selesai }}</p>
            </div>
        </div>

    </div>


    {{-- ================= TABEL + TIPS ================= --}}
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

        {{-- TABEL --}}
        <div class="lg:col-span-2 bg-white rounded-2xl shadow p-6">

            <h3 class="font-semibold mb-4">Laporan Terbaru Saya</h3>

            <div class="overflow-hidden rounded-xl border border-gray-200">
                <table class="w-full text-sm">
                    <thead class="bg-gray-100 text-gray-600">
                        <tr>
                            <th class="px-3 py-3 text-left">Nama</th>
                            <th class="px-3 py-3 text-center">Tanggal</th>
                            <th class="px-3 py-3 text-center">Lokasi</th>
                            <th class="px-3 py-3 text-center">Status</th>
                            <th class="px-3 py-3 text-center">Aksi</th>
                        </tr>
                    </thead>

                    <tbody class="divide-y">
                        @foreach($latest as $item)
                        <tr class="hover:bg-gray-50">

                            <td class="px-3 py-3">
                                {{ $item->user->name }}
                            </td>

                            <td class="px-3 py-3 text-center">
                                {{ \Carbon\Carbon::parse($item->date)->format('d-m-Y') }}
                            </td>

                            <td class="px-3 py-3 text-center">
                                {{ $item->location }}
                            </td>

                            <td class="px-3 py-3 text-center">
                                @php
                                    $statusClass = match($item->status) {
                                        'menunggu' => 'bg-red-100 text-red-600',
                                        'diproses' => 'bg-orange-100 text-orange-600',
                                        'selesai' => 'bg-green-100 text-green-600',
                                    };
                                @endphp

                                <span class="px-3 py-1 rounded-full text-xs font-semibold {{ $statusClass }}">
                                    {{ ucfirst($item->status) }}
                                </span>
                            </td>

                            <td class="px-3 py-3 text-center">
                                <a href="{{ route('pengaduan.show', $item->id) }}"
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

        {{-- TIPS CARD --}}
        <div class="bg-white rounded-2xl shadow p-4 flex flex-col justify-between">

            <div>
                <h4 class="font-semibold mb-3">Tips Menjaga Sarana Sekolah 💡</h4>

                <ul class="text-sm space-y-3 text-gray-600">
                    <li>✔️ Jaga kebersihan fasilitas sekolah</li>
                    <li>✔️ Gunakan dengan bijak</li>
                    <li>✔️ Laporkan kerusakan segera</li>
                </ul>

                <img src="{{ asset('images/tips.png') }}"
                     class="mt-4 rounded-xl">
            </div>

            <a href="{{ route('pengaduan.create') }}"
               class="mt-4 bg-blue-600 text-white text-sm text-center py-3 rounded-xl hover:bg-blue-700 transition">
                + Buat Pengaduan Baru
            </a>

        </div>

    </div>

</div>

@endsection
