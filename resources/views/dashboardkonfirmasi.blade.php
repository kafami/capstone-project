<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('css/dashboardkonfirmasi.css') }}">
    <link rel="shortcut icon" href="{{ asset('img/favicon.png') }}">
    <title>{{ $title }}</title>
</head>
<body>
    <div class="nav">
        @include('partials.dashboardnavbar')
    </div>
    <div class="dash-main">
        <div class="main">
            <div class="option-holder">
                <p>Konfirmasi Request</p>
                <div>
                    <label for="ruangan" class="form-label"><p>Sort By: </p></label>
                    <select name="ruangan" id="ruangan" class="form-select">
                        <option value="A201">Date</option>
                        <option value="A202">Role</option>
                    </select>
                </div>
                <button class="submit-button"><p>Submit</p></button>
            </div>
            <div class="konfirmasi-ruangan">
                <div>
                    <p class="ruangan">ruangan A202</p>
                    <p class="peminjam">Kaffa Emirudin</p>
                    <div class="date-time">
                        <p class="date">1/10/24</p>
                        <p class="time">16:30 - 18:00</p>
                    </div>
                </div>
                    <label class="container">
                        <input class="confirm-box" type="checkbox">
                        <span class="checkbox-container"></span>
                    </label>
                    <label class="container">
                        <input class="deny-box" type="checkbox">
                        <span class="checkbox-container"></span>
                    </label>
            </div>
    
            <div class="konfirmasi-ruangan">
                <div>
                    <p class="ruangan">ruangan A201</p>
                    <p class="peminjam">Kevin Ryo Pratama</p>
                    <div class="date-time">
                        <p class="date">1/13/24</p>
                        <p class="time">16:30 - 18:00</p>
                    </div>
                </div>
                <label class="container">
                    <input class="confirm-box" type="checkbox">
                    <span class="checkbox-container"></span>
                </label>
                <label class="container">
                    <input class="deny-box" type="checkbox">
                    <span class="checkbox-container"></span>
                </label>
            </div>
    
            <div class="konfirmasi-ruangan">
                <div>
                    <p class="ruangan">ruangan A102</p>
                    <p class="peminjam">Elmar</p>
                    <div class="date-time">
                        <p class="date">1/13/24</p>
                        <p class="time">16:30 - 18:00</p>
                    </div>
                </div>
                <label class="container">
                    <input class="confirm-box" type="checkbox">
                    <span class="checkbox-container"></span>
                </label>
                <label class="container">
                    <input class="deny-box" type="checkbox">
                    <span class="checkbox-container"></span>
                </label>
            </div>
        </div>
    </div>
</body>
</html>
