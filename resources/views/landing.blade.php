<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Landing</title>
    @vite('resources/css/app.css')
</head>
<body class="bg-gray-100 font-sans">

<!-- NAVBAR -->
<nav class="bg-white shadow">
    <div class="max-w-7xl mx-auto px-6 py-4 flex justify-between items-center">
        <img src= "{{ asset ('images/logo2.png') }}" style= "width: 150px">

        <div class="space-x-8 hidden md:flex">
            <a href="{{ route('landing') }}" class="text-[#1ac8db] font-semibold">Beranda</a>
            <a href="#" class="hover:text-blue-600">FAQ</a>
            <a href="#" class="hover:text-blue-600">Tentang</a>
        </div>

        <a href="{{ route('login') }}"
           class="bg-yellow-400 px-5 py-2 rounded-lg font-semibold">
            Masuk
        </a>
    </div>
</nav>

<!-- HERO -->
<section
    class="relative bg-cover bg-center bg-no-repeat text-white py-32"
    style="background-image: url('{{ asset('images/smkn4.jpg') }}')"
>

    <!-- Overlay (biar tulisan kebaca) -->
    <div class="absolute inset-0 bg-black/50"></div>

    <!-- Content -->
    <div class="relative max-w-7xl mx-auto px-6 grid md:grid-cols-2 gap-10 items-center">
        <div>
            <h1 class="text-4xl font-bold leading-tight">
                Sampaikan Pengaduan Anda Dengan Mudah
            </h1>
            <p class="mt-4 text-gray-200">
                Platform digital untuk menyampaikan aspirasi masyarakat secara cepat dan transparan.
            </p>

            <div class="mt-6 flex gap-4">
                <a href="#" class="bg-yellow-400 text-black px-6 py-2 rounded-lg font-semibold">
                    Kirim Pengaduan
                </a>
                <a href="#" class="border border-white px-6 py-2 rounded-lg">
                    Pelajari
                </a>
            </div>
        </div>
    </div>

</section>

<!-- GURU / TIM -->
<section class="py-16 bg-gray-100 text-center">
    <h2 class="text-2xl font-bold mb-10">Tim Pengelola</h2>

    <div class="max-w-6xl mx-auto grid md:grid-cols-4 gap-6 px-6">
        @for ($i = 0; $i < 4; $i++)
        <div class="bg-white p-4 rounded-xl shadow">
            <img src="https://source.unsplash.com/100x100/?face" class="rounded-full mx-auto">
            <h3 class="mt-3 font-semibold">Nama Petugas</h3>
            <p class="text-sm text-gray-500">Admin</p>
        </div>
        @endfor
    </div>
</section>

<!-- ABOUT -->
<section class="bg-[#1ac8db] text-white py-16 text-center">
    <div class="max-w-3xl mx-auto px-6">
        <h2 class="text-2xl font-bold mb-4">Apa Itu Sistem Ini?</h2>
        <p class="text-gray-200">
            Sistem pengaduan masyarakat yang membantu warga menyampaikan laporan secara online
            dan memantau statusnya secara real-time.
        </p>
    </div>
</section>

<!-- VISI MISI -->
<section class="py-16 bg-white text-center">
    <h2 class="text-2xl font-bold mb-6">Visi & Misi</h2>

    <div class="max-w-4xl mx-auto px-6">
        <p class="mb-4">
            <strong>Visi:</strong> Menjadi platform pengaduan terbaik yang transparan dan terpercaya.
        </p>
        <p>
            <strong>Misi:</strong> Memberikan kemudahan akses bagi masyarakat dalam menyampaikan aspirasi.
        </p>
    </div>
</section>

<!-- FITUR -->
<section class="py-16 bg-[#1ac8db] text-white text-center">
    <h2 class="text-2xl font-bold mb-10">Fitur Utama</h2>

    <div class="max-w-6xl mx-auto grid md:grid-cols-3 gap-6 px-6">
        <div class="bg-white text-black p-6 rounded-xl">
            <h3 class="font-semibold mb-2">Kirim Pengaduan</h3>
            <p class="text-sm">Laporkan masalah dengan mudah</p>
        </div>

        <div class="bg-white text-black p-6 rounded-xl">
            <h3 class="font-semibold mb-2">Tracking Status</h3>
            <p class="text-sm">Pantau proses laporan</p>
        </div>

        <div class="bg-white text-black p-6 rounded-xl">
            <h3 class="font-semibold mb-2">Riwayat</h3>
            <p class="text-sm">Lihat semua laporan</p>
        </div>
    </div>
</section>

<!-- BERITA -->
<section class="py-16 bg-gray-100">
    <div class="max-w-6xl mx-auto px-6">
        <h2 class="text-2xl font-bold mb-8 text-center">Berita Terbaru</h2>

        <div class="grid md:grid-cols-3 gap-6">
            @for ($i = 0; $i < 3; $i++)
            <div class="bg-white rounded-xl shadow">
                <img src="https://source.unsplash.com/400x200/?news" class="rounded-t-xl">
                <div class="p-4">
                    <h3 class="font-semibold">Judul Berita</h3>
                    <p class="text-sm text-gray-500">Deskripsi singkat berita</p>
                </div>
            </div>
            @endfor
        </div>
    </div>
</section>

<!-- FOOTER -->
<footer class="bg-[#1ac8db] text-white text-center py-6">
    <p>&copy; {{ date('Y') }} Sistem Pengaduan</p>
</footer>

</body>
</html>
