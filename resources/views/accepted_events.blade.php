<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Accepted Upcoming Events</title>
    <link rel="stylesheet" href="{{ asset('css/accepted_events.css') }}">
</head>
<body>
    <div class="nav">
        @include('partials.dashboardnavbar')
    </div>
    <div class="dash-main">
        <h2 class="title">Accepted Upcoming Events</h2>
        <div class="table-container">
            <table class="custom-table">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Role</th>
                        <th>Event Name</th>
                        <th>Room</th>
                        <th>Booking Date</th>
                        <th>Start - End Time</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($acceptedBookings as $booking)
                        <tr>
                            <td>{{ $booking->name }}</td>
                            <td>{{ $booking->role }}</td>
                            <td>{{ $booking->event_name }}</td>
                            <td>{{ $booking->room }}</td>
                            <td>{{ \Carbon\Carbon::parse($booking->booking_date)->format('d M Y') }}</td>
                            <td>{{ $booking->start_time }} - {{ $booking->end_time }}</td>
                            <td>
                                <form action="{{ route('update.status', $booking->id) }}" method="POST" class="action-form">
                                    @csrf
                                    @method('PATCH')
                                    <input type="hidden" name="status" value="canceled">
                                    <button type="submit" class="action-button cancel">Cancel</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="no-events">No accepted bookings for today.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>
