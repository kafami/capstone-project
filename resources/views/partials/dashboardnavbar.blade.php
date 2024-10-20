<link rel="stylesheet" href="{{ asset('css/dashboardnavbar.css') }}">
<div class="dash-container">
    <div class="dash-nav">
        <div class="dashboard-option">
            <img class="dashNavicons" src="{{ asset('img/dashboard.svg') }}" alt="">
            <a href="/dashboard"><p class="navText">Dashboard</p></a>
        </div>

        <div class="dashboard-option">
            <img class="dashNavicons" src="{{ asset('img/home.svg') }}" alt="">
            <a href="/"><p class="navText">
                Home
            </p></a>
        </div>
        <div class="dashboard-option">
            <img class="dashNavicons" src="{{ asset('img/calendar.svg') }}" alt="">
            <a href="/konfirmasi"><p class="navText">
                Konfirmasi Request
            </p></a>
        </div>
        <div class="dashboard-option">
            <img class="dashNavicons" src="{{ asset('img/user.svg') }}" alt="">
            <a href="/users"><p class="navText">
                Users
            </p></a>
        </div>
        <div class="dashboard-option">
            <img class="dashNavicons" src="{{ asset('img/logout.svg') }}" alt="">
            <a href="/"><p class="navText">
                Logout
            </p></a>
        </div>
    </div>
</div>