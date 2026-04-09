@extends('layouts.pdf')

@section('content')

<h3 style="text-align:center;">
    LAPORAN PENGADUAN SARANA DAN PRASARANA SMK NEGERI 4 BOJONEGORO
</h3>

<table class="data-table">
    <tr>
        <td class="label">ID Pengaduan</td>
        <td>: {{ $aspiration->id }}</td>
    </tr>
    <tr>
        <td class="label">Nama Pelapor</td>
        <td>: {{ $aspiration->user->name }}</td>
    </tr>
    <tr>
        <td class="label">Kategori</td>
        <td>: {{ $aspiration->category->name }}</td>
    </tr>
    <tr>
        <td class="label">Isi Laporan</td>
        <td>: {{ $aspiration->description }}</td>
    </tr>
    <tr>
        <td class="label">Status</td>
        <td>: {{ $aspiration->status }}</td>
    </tr>
    <tr>
        <td class="label">Tanggal</td>
        <td>: {{ $aspiration->created_at->format('d-m-Y') }}</td>
    </tr>
    <tr>
        <td class="label">Tanggapan</td>
        <td>: {{ $aspiration->response ?? '-' }}</td>
    </tr>
</table>

{{-- 🔥 BUKTI (BIAR GA PINDAH HALAMAN) --}}
@if($aspiration->image || $aspiration->admin_image)
    <div style="margin-top:15px; page-break-inside: avoid;">
        <strong>Bukti Dokumentasi:</strong>

        <table width="100%" style="margin-top:10px;">
            <tr>

                {{-- BUKTI USER --}}
                @if($aspiration->image)
                <td align="center">
                    <p style="font-size:12px;">Bukti User</p>
                    <img
                        src="{{ public_path('storage/'.$aspiration->image) }}"
                        style="max-width:250px; max-height:200px; object-fit:contain;"
                    >
                </td>
                @endif

                {{-- BUKTI ADMIN --}}
                @if($aspiration->admin_image)
                <td align="center">
                    <p style="font-size:12px;">Bukti Admin</p>
                    <img
                        src="{{ public_path('storage/'.$aspiration->admin_image) }}"
                        style="max-width:250px; max-height:200px; object-fit:contain;"
                    >
                </td>
                @endif

            </tr>
        </table>
    </div>
@endif

@endsection
