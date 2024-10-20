<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('css/statusruang.css') }}">
    <link rel="stylesheet" href="{{ asset('css/statusruang.css') }}">
    <link rel="shortcut icon" href="{{ asset('img/favicon.png') }}">
    <title>{{ $title }}</title>
</head>
<body>
    <div class="navbar-holder">
        @include('partials.navbar')
    </div>
    <div>
        <p>
            Status Tiket Peminjaman Ruangan
        </p>
        <div>
            <div>
                <table>
                    <tr class="header">
                        <th>Acara</th>
                        <th>Ruangan</th>
                        <th>Tanggal</th>
                        <th>Waktu</th>
                        <th>Status</th>
                    </tr>
                    <tr>
                        <th>Kaderisasi</th>
                        <th>A 201</th>
                        <th>30 Mei 2024</th>
                        <th>16:00</th>
                        <th>Pending</th>
                    </tr>
                    <tr>
                        <th>Diskusi tugas SBD</th>
                        <th>A 202</th>
                        <th>15 Mei 2024</th>
                        <th>18:00</th>
                        <th>Diterima</th>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</body>
</html>