<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Landing</title>
    @vite('resources/css/app.css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        @keyframes float1 {
        0%,100% { transform: translateY(0); }
        50% { transform: translateY(-20px); }
        }

        @keyframes float2 {
        0%,100% { transform: translate(0,0); }
        50% { transform: translate(10px,-15px); }
        }

        @keyframes float3 {
        0%,100% { transform: translate(0,0); }
        50% { transform: translate(-10px,10px); }
        }
    </style>
</head>

<body class="font-sans bg-gray-50">

<!-- NAVBAR -->
<nav class="bg-white shadow-sm">
    <div class="max-w-7xl mx-auto px-6 py-4 flex justify-between items-center">
        <img src="{{ asset('images/logo2.png') }}" class="w-36">

        <div class="hidden md:flex gap-8 text-gray-600">
            <a href="#" class="text-[#1ac8db] font-semibold">Beranda</a>
            <a href="#">FAQ</a>
            <a href="#">Tentang</a>
        </div>

        <div class="flex gap-3">
            <a href="{{ route('login') }}" class="px-4 py-2 bg-yellow-400 text-white font-semibold rounded-full text-sm">Login</a>
            <a href="{{ route('register') }}" class="px-4 py-2 bg-transparent font-semibold border border-gray-400 text-gray-700 rounded-full text-sm">Daftar</a>
        </div>
    </div>
</nav>

<!-- HERO -->
<section class="relative bg-linear-to-r from-green-100 to-blue-100 py-5 overflow-hidden">
    <div class="max-w-6xl mx-auto px-6 grid md:grid-cols-2 items-center gap-10">
        <!-- TEXT -->
        <div>
            <p class="text-sm text-gray-500 mb-2">Menemukan Kerusakan Sarana dan Prasarana Sekolah?</p>

            <h1 class="text-4xl md:text-5xl font-bold text-gray-800 leading-tight">
                Laporkan Keluhan Kerusakan Sarana dan Prasarana SMK Negeri 4 Bojonegoro
            </h1>

            <!-- SEARCH -->
            <div class="mt-6 flex gap-4">
                <a href="{{ route('login') }}"
                class="bg-yellow-400 text-black px-6 py-3 rounded-full font-semibold shadow hover:scale-105 transition">
                    Kirim Pengaduan
                </a>

                <a href="#"
                class="border border-gray-400 text-gray-700 px-6 py-3 rounded-full font-semibold hover:bg-gray-100 transition">
                    Pelajari
                </a>
            </div>

            <!-- STATS -->
            <div class="flex items-center gap-6 mt-6 text-gray-600">
                <div>
                    <p class="text-xl font-bold">{{$aspiration}}⭐</p>
                    <p class="text-sm">Pengaduan</p>
                </div>
                <div>
                    <p class="text-xl font-bold">{{$user}}👤</p>
                    <p class="text-sm">Pengguna</p>
                </div>
            </div>
        </div>

        <!-- IMAGE -->
        <div class="relative">
            <img src="{{ asset('images/logosmk.png') }}"
            class="relative z-10 md:-translate-y-5 -translate-y-10">

            <!-- dekorasi -->
            <div class="absolute -top-1 -left-5 w-20 h-20 bg-yellow-300 rounded-xl"></div>
            <div class="absolute bottom-25 right-0 w-16 h-16 bg-yellow-400 rounded-full"></div>
        </div>

    </div>
</section>

{{-- PANDUAN --}}
<section id="cara" class="bg-white py-16 md:py-24">
    <div class="max-w-6xl mx-auto px-6">
        <div class="text-center mb-12">
            <p class="text-sm text-cyan-600 font-semibold mb-2">PANDUAN SINGKAT</p>
            <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">Cara Melaporkan Kerusakan</h2>
            <p class="text-gray-600 max-w-2xl mx-auto">Ikuti langkah-langkah mudah di bawah ini untuk mengirim laporan Anda</p>
        </div>

        <div class="grid md:grid-cols-4 gap-6">
            <!-- Step 1 -->
            <div class="text-center">
                <div class="w-16 h-16 bg-[#1ac8db] text-white rounded-full flex items-center justify-center text-2xl font-bold mb-4 mx-auto">1</div>
                <h3 class="font-semibold text-gray-900 mb-2">Buat Akun</h3>
                <p class="text-sm text-gray-600">Daftar dengan nomor identitas dan email aktif Anda</p>
            </div>

            <!-- Step 2 -->
            <div class="text-center">
                <div class="w-16 h-16 bg-[#1ac8db] text-white rounded-full flex items-center justify-center text-2xl font-bold mb-4 mx-auto">2</div>
                <h3 class="font-semibold text-gray-900 mb-2">Isi Form</h3>
                <p class="text-sm text-gray-600">Jelaskan detail kerusakan dan lokasi dengan lengkap</p>
            </div>

            <!-- Step 3 -->
            <div class="text-center">
                <div class="w-16 h-16 bg-[#1ac8db] text-white rounded-full flex items-center justify-center text-2xl font-bold mb-4 mx-auto">3</div>
                <h3 class="font-semibold text-gray-900 mb-2">Upload Foto</h3>
                <p class="text-sm text-gray-600">Sertakan foto kerusakan sebagai bukti nyata</p>
            </div>

            <!-- Step 4 -->
            <div class="text-center">
                <div class="w-16 h-16 bg-[#1ac8db] text-white rounded-full flex items-center justify-center text-2xl font-bold mb-4 mx-auto">4</div>
                <h3 class="font-semibold text-gray-900 mb-2">Kirim & Pantau</h3>
                <p class="text-sm text-gray-600">Pantau perkembangan pengaduan Anda secara langsung</p>
            </div>
        </div>

        <div class="mt-12 text-center">
            <a href="{{ route('login') }}" class="bg-cyan-600 text-white px-8 py-4 rounded-lg font-semibold hover:bg-cyan-700 transition inline-flex items-center gap-2 shadow-lg">
                <i class="fas fa-arrow-right"></i> Mulai Buat Pengaduan
            </a>
        </div>
    </div>
</section>

{{-- FAQ --}}
<section id="faq" class="relative bg-linear-to-r from-green-100 to-blue-100 py-10 md:py-14 overflow-hidden">
    <!-- Bintang 1 -->
    <img src="/images/bintang.png"
    class="absolute top-[10%] left-[5%] w-28 opacity-40 pointer-events-none animate-[float1_6s_ease-in-out_infinite]">

    <!-- Bintang 2 -->
    <img src="/images/bintang.png"
    class="absolute top-[20%] right-[10%] w-24 opacity-40 pointer-events-none animate-[float2_8s_ease-in-out_infinite]">

    <!-- Bintang 3 -->
    <img src="/images/bintang.png"
    class="absolute bottom-[15%] left-[8%] w-28 opacity-30 pointer-events-none animate-[float3_7s_ease-in-out_infinite]">

    <!-- Bintang 4 -->
    <img src="/images/bintang.png"
    class="absolute bottom-[10%] right-[5%] w-20 opacity-40 pointer-events-none animate-[float1_9s_ease-in-out_infinite]">

    <!-- Bintang 5 -->
    <img src="/images/bintang.png"
    class="absolute top-[50%] right-[15%] w-14 opacity-30 pointer-events-none animate-[float2_6s_ease-in-out_infinite]">

    <div class="max-w-4xl mx-auto px-6">
        <div class="text-center mb-12">
            <p class="text-sm text-cyan-600 font-semibold mb-2">❓ PERTANYAAN UMUM</p>
            <h2 class="text-3xl md:text-4xl font-bold text-gray-900">FAQ</h2>
        </div>

        <div class="space-y-4">
            <!-- FAQ 1 -->
            <details class="bg-white p-6 rounded-lg shadow-sm group cursor-pointer">
                <summary class="flex items-center justify-between font-semibold text-gray-900 select-none">
                    Bagaimana cara mendaftar di sistem ini?
                    <i class="fas fa-chevron-down group-open:rotate-180 transition"></i>
                </summary>
                <p class="text-gray-600 mt-4">Anda dapat mendaftar dengan klik tombol "Daftar" di halaman utama, kemudian isi formulir dengan data diri yang valid. Pastikan email Anda aktif untuk verifikasi akun.</p>
            </details>

            <!-- FAQ 2 -->
            <details class="bg-white p-6 rounded-lg shadow-sm group cursor-pointer">
                <summary class="flex items-center justify-between font-semibold text-gray-900 select-none">
                    Apakah data saya aman di aplikasi ini?
                    <i class="fas fa-chevron-down group-open:rotate-180 transition"></i>
                </summary>
                <p class="text-gray-600 mt-4">Ya, semua data pengguna dilindungi dengan enkripsi tingkat tinggi dan sesuai dengan standar keamanan data internasional. Kami tidak akan membagikan data Anda kepada pihak ketiga.</p>
            </details>

            <!-- FAQ 3 -->
            <details class="bg-white p-6 rounded-lg shadow-sm group cursor-pointer">
                <summary class="flex items-center justify-between font-semibold text-gray-900 select-none">
                    Berapa lama waktu yang diperlukan untuk memproses pengaduan?
                    <i class="fas fa-chevron-down group-open:rotate-180 transition"></i>
                </summary>
                <p class="text-gray-600 mt-4">Pengaduan akan diverifikasi dalam 1-2 hari kerja. Setelah itu, tim teknis akan melakukan perbaikan sesuai prioritas dan kondisi kerusakan. Anda akan mendapatkan notifikasi untuk setiap update status.</p>
            </details>

            <!-- FAQ 4 -->
            <details class="bg-white p-6 rounded-lg shadow-sm group cursor-pointer">
                <summary class="flex items-center justify-between font-semibold text-gray-900 select-none">
                    Bisakah saya melacak status pengaduan saya?
                    <i class="fas fa-chevron-down group-open:rotate-180 transition"></i>
                </summary>
                <p class="text-gray-600 mt-4">Tentu! Setelah login, Anda dapat melihat semua pengaduan Anda beserta status terkini. Setiap perubahan status akan diberitahukan melalui notifikasi otomatis.</p>
            </details>

            <!-- FAQ 5 -->
            <details class="bg-white p-6 rounded-lg shadow-sm group cursor-pointer">
                <summary class="flex items-center justify-between font-semibold text-gray-900 select-none">
                    Apa saja jenis kerusakan yang bisa dilaporkan?
                    <i class="fas fa-chevron-down group-open:rotate-180 transition"></i>
                </summary>
                <p class="text-gray-600 mt-4">Semua jenis kerusakan sarana dan prasarana sekolah dapat dilaporkan, mulai dari kerusakan bangunan, peralatan pembelajaran, meubelé, hingga fasilitas umum lainnya.</p>
            </details>
        </div>
    </div>
</section>

<!-- TENTANG -->
<section id="tentang" class="bg-white py-12 md:py-16">
    <div class="max-w-6xl mx-auto px-6 grid md:grid-cols-2 gap-12 items-center">
        <div>
            <p class="text-sm text-cyan-600 font-semibold mb-2">ℹ️ TENTANG KAMI</p>
            <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-6">Visi & Misi</h2>

            <div class="space-y-6">
                <div>
                    <h3 class="font-semibold text-gray-900 mb-2 flex items-center gap-2">
                        <i class="fas fa-bullseye text-cyan-600"></i> Visi
                    </h3>
                    <p class="text-gray-600">Menjadi sistem pengaduan terpercaya yang meningkatkan kualitas sarana dan prasarana di SMK Negeri 4 Bojonegoro melalui partisipasi aktif seluruh warga sekolah.</p>
                </div>

                <div>
                    <h3 class="font-semibold text-gray-900 mb-2 flex items-center gap-2">
                        <i class="fas fa-target text-cyan-600"></i> Misi
                    </h3>
                    <p class="text-gray-600">Memberikan platform yang mudah digunakan untuk melaporkan kerusakan, meningkatkan transparansi dalam penanganan masalah, dan mempercepat proses perbaikan sarana dan prasarana sekolah.</p>
                </div>
            </div>
        </div>

        <div class="bg-linear-to-br from-cyan-50 to-blue-50 p-8 rounded-xl">
            <h3 class="font-semibold text-gray-900 mb-6 text-lg">Informasi Kontak</h3>

            <div class="space-y-4">
                <div class="flex gap-4">
                    <div class="w-10 h-10 bg-cyan-600 rounded-lg flex items-center justify-center text-white shrink-0">
                        <i class="fas fa-map-marker-alt"></i>
                    </div>
                    <div>
                        <p class="font-semibold text-gray-900">Lokasi</p>
                        <p class="text-gray-600 text-sm">SMK Negeri 4 Bojonegoro, Jawa Timur</p>
                    </div>
                </div>

                <div class="flex gap-4">
                    <div class="w-10 h-10 bg-cyan-600 rounded-lg flex items-center justify-center text-white shrink-0">
                        <i class="fas fa-phone"></i>
                    </div>
                    <div>
                        <p class="font-semibold text-gray-900">Telepon</p>
                        <p class="text-gray-600 text-sm">(0353) XXXX - XXXX</p>
                    </div>
                </div>

                <div class="flex gap-4">
                    <div class="w-10 h-10 bg-cyan-600 rounded-lg flex items-center justify-center text-white shrink-0">
                        <i class="fas fa-envelope"></i>
                    </div>
                    <div>
                        <p class="font-semibold text-gray-900">Email</p>
                        <p class="text-gray-600 text-sm">pengaduan@smkn4bjn.sch.id</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- CTA SECTION -->
<section class="w-full flex justify-center pt-4 pb-12 bg-white">
    <div class="bg-linear-to-r from-[#1ac8db] to-blue-500 text-white rounded-2xl shadow-xl max-w-4xl w-full px-6 py-12 text-center">

        <h2 class="text-3xl md:text-4xl font-bold mb-4">
            Siap Melaporkan?
        </h2>

        <p class="text-cyan-100 mb-8 text-lg">
            Bantu kami menjaga sarana dan prasarana sekolah dengan melaporkan kerusakan segera.
        </p>

        <div class="flex gap-4 justify-center flex-wrap">
            <a href="{{ route('login') }}"
               class="bg-white text-cyan-600 px-8 py-3 rounded-lg font-semibold hover:bg-gray-100 transition flex items-center gap-2 shadow-md">
                <i class="fas fa-arrow-right"></i> Mulai Sekarang
            </a>

            <a href="#faq"
               class="border-2 border-white px-8 py-3 rounded-lg font-semibold hover:bg-white hover:text-cyan-600 transition">
                Pelajari Lebih Lanjut
            </a>
        </div>

    </div>
</section>

<!-- FOOTER -->
<footer class="bg-cyan-950 text-white py-12">
    <div class="max-w-6xl mx-auto px-6">
        <div class="grid md:grid-cols-4 gap-8 mb-8">
            <div>
                <h4 class="font-semibold text-white mb-4">Tentang</h4>
                <ul class="space-y-2 text-sm">
                    <li><a href="#tentang" class="hover:text-white transition">Visi & Misi</a></li>
                    <li><a href="#fitur" class="hover:text-white transition">Fitur</a></li>
                    <li><a href="#cara" class="hover:text-white transition">Panduan</a></li>
                </ul>
            </div>
            <div>
                <h4 class="font-semibold text-grey-800 mb-4">Bantuan</h4>
                <ul class="space-y-2 text-sm">
                    <li><a href="#faq" class="hover:text-white transition">FAQ</a></li>
                    <li><a href="#" class="hover:text-white transition">Hubungi Kami</a></li>
                    <li><a href="#" class="hover:text-white transition">Laporan Bug</a></li>
                </ul>
            </div>
            <div>
                <h4 class="font-semibold text-grey-800 mb-4">Kebijakan</h4>
                <ul class="space-y-2 text-sm">
                    <li><a href="#" class="hover:text-white transition">Privacy Policy</a></li>
                    <li><a href="#" class="hover:text-white transition">Terms & Conditions</a></li>
                </ul>
            </div>
            <div>
                <h4 class="font-semibold text-white mb-4">Ikuti Kami</h4>
                <div class="flex gap-4">
                    <a href="#" class="w-10 h-10 bg-gray-700 rounded-lg flex items-center justify-center hover:bg-cyan-600 transition">
                        <i class="fab fa-facebook"></i>
                    </a>
                    <a href="#" class="w-10 h-10 bg-gray-700 rounded-lg flex items-center justify-center hover:bg-cyan-600 transition">
                        <i class="fab fa-twitter"></i>
                    </a>
                    <a href="#" class="w-10 h-10 bg-gray-700 rounded-lg flex items-center justify-center hover:bg-cyan-600 transition">
                        <i class="fab fa-instagram"></i>
                    </a>
                </div>
            </div>
        </div>

        <div class="border-t border-gray-500 pt-8 text-center text-sm">
            <p>&copy; <span id="year"></span> Sistem Pengaduan Sarana Prasarana SMK Negeri 4 Bojonegoro. All Rights Reserved.</p>
        </div>
    </div>
</footer>

<script>
    document.getElementById('year').textContent = new Date().getFullYear();
</script>
</body>
</html>
