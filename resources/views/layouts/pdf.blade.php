<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Laporan</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 30px;
        }

        .kop-container {
            width: 100%;
            border-bottom: 4px double black;
            padding-bottom: 10px;
            margin-bottom: 20px;
        }

        .kop-table {
            width: 100%;
        }

        .kop-logo {
            width: 120px;
        }

        .kop-text {
            text-align: center;
        }

        .kop-text h1,
        .kop-text h2,
        .kop-text h3,
        .kop-text p {
            margin: 2px 0;
        }

        .kop-text h1 {
            font-size: 16px;
        }

        .kop-text h2 {
            font-size: 15px;
        }

        .kop-text h3 {
            font-size: 18px;
            font-weight: bold;
        }

        .kop-text p {
            font-size: 13px;
        }

        .content {
            margin-top: 20px;
        }

        table.data-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }

        table.data-table th,
        table.data-table td {
            border: 1px solid black;
            padding: 6px;
            font-size: 12px;
        }

        table.data-table th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>

    <!-- KOP -->
    <div class="kop-container">
        <table class="kop-table">
            <tr>
                <td width="15%">
                    <img src="{{ public_path('images/logosmk.png') }}" class="kop-logo">
                </td>
                <td class="kop-text">
                    <h1>PEMERINTAH PROVINSI JAWA TIMUR</h1>
                    <h2>DINAS PENDIDIKAN</h2>
                    <h3>SEKOLAH MENENGAH KEJURUAN NEGERI 4 BOJONEGORO</h3>
                    <p>
                        Jalan Raya Surabaya, Ds. Sukowati, Kec. Kapas<br>
                        Telp./Fax. (0353) 892418<br>
                        web: www.smkn4bojonegoro.sch.id email: smkn4bojonegoro@yahoo.co.id
                    </p>
                </td>
            </tr>
        </table>
    </div>

    <!-- ISI -->
    <div class="content">
        @yield('content')
    </div>

</body>
</html>
