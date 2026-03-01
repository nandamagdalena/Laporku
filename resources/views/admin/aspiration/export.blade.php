@extends('layouts.pdf')

@section('content')

<h3 style="text-align:center;">LAPORAN PENGADUAN</h3>

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
</table>

@if($aspiration->image)
    <br>
    <strong>Bukti Foto:</strong><br><br>
    <img src="{{ public_path('storage/'.$aspiration->image) }}" width="250">
@endif

@endsection
