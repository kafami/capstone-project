<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Bookings</title>
    <link rel="stylesheet" href="{{ asset('css/user_booking.css') }}">
    <link rel="shortcut icon" href="{{ asset('img/favicon.png') }}">
</head>
<body>
    <div class="website-body">
        <!-- Header -->
        <div class="header">
            @include('partials.navbar')
        </div>

        <!-- Main Content -->
        <div class="main">
            <div class="form-container">
                <div class="holder">
                    <h2 class="form-title">My Bookings</h2>
                    <div class="data-input">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Event Name</th>
                                    <th>Room</th>
                                    <th>Booking Date</th>
                                    <th>Start Time</th>
                                    <th>End Time</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($bookings as $booking)
                                    <tr>
                                        <td>{{ $booking->event_name }}</td>
                                        <td>{{ $booking->room }}</td>
                                        <td>{{ \Carbon\Carbon::parse($booking->booking_date)->format('d M Y') }}</td>
                                        <td>{{ $booking->start_time }}</td>
                                        <td>{{ $booking->end_time }}</td>
                                        <td>{{ ucfirst($booking->status) }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="text-center">You have no bookings.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- Sidebar -->
        <div class="secondary">
            <div class="search-bar-holder">
                <input class="search-bar" type="text" placeholder="Search bookings...">
            </div>
            <!-- Calendar -->
            @include('partials.calendar')
            <!-- Categories -->
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
                    <p class="cat-text">Maintenance</p>
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
