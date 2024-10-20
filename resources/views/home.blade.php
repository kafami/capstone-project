<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('css/home.css') }}">
    <link rel="shortcut icon" href="{{ asset('img/favicon.png') }}">
    <title>{{ $title }}</title>
</head>
<body>
    {{-- pembagian kelas grid--}}
    <div class="website-body">
        {{-- bagian header --}}
        <div class="header">
            @include('partials.navbar')
        </div>
        {{-- grid tabel --}}
        <div class="main">
            {{-- manggil table --}}
            @include('partials.tables')
        </div>
        {{-- grid search bar & calendar --}}
        <div class="secondary">
            <div class="search-bar-holder">
                <input class="search-bar" type="text">
            </div>
            {{-- manggil calendar --}}
            @include('partials.calendar')
            <div class="categories">
                <p class="cat-title">Categories</p>
                <div class="cat-holder">
                    <p class="cat-text">External</p>
                    <div class="cat-exter"></div>
                </div>
                <div class="cat-holder">
                    <p class="cat-text">Internal</p>
                    <div class="cat-inter"></div>
                </div>
                <div class="cat-holder">
                    <p class="cat-text">Maintanance</p>
                    <div class="cat-maint"></div>
                </div>
                <div class="cat-holder">
                    <p class="cat-text">Zoom</p>
                    <div class="cat-zoom"></div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>