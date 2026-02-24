<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Laporan Pengaduan</title>
    <style>
        body { font-family: sans-serif; }
        h2 { margin-bottom: 5px; }
        .label { font-weight: bold; }
        .row { margin-bottom: 8px; }
        img { max-width: 300px; margin-top: 10px; }
    </style>
</head>
<body>

    <h2>Laporan Pengaduan</h2>
    <p>{{ \Carbon\Carbon::now()->format('d M Y') }}</p>

    <div class="row">
        <span class="label">Nama:</span>
        {{ $aspiration->user->name ?? '-' }}
    </div>

    <div class="row">
        <span class="label">Tanggal:</span>
        {{ $aspiration->created_at->format('d-m-Y') }}
    </div>

    <div class="row">
        <span class="label">Kategori:</span>
        {{ $aspiration->category->name ?? '-' }}
    </div>

    <div class="row">
        <span class="label">Lokasi:</span>
        {{ $aspiration->location }}
    </div>

    <div class="row">
        <span class="label">Keterangan:</span>
        {{ $aspiration->description }}
    </div>

    <div class="row">
        <span class="label">Status:</span>
        {{ ucfirst($aspiration->status) }}
    </div>

    @if($aspiration->image)
        <div class="row">
            <span class="label">Bukti:</span><br>
            <img src="{{ public_path('storage/'.$aspiration->image) }}">
        </div>
    @endif

</body>
</html>
