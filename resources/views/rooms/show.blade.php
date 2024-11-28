<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Room Details</title>
    <link rel="stylesheet" href="{{ asset('css/room_details.css') }}">
</head>
<body>
    <div class="nav">
        @include('partials.dashboardnavbar')
    </div>
    <div class="room-details-container">
        <h2 class="room-title">{{ $room->name }}</h2>
        
        <div class="room-info">
            <p><strong>Location:</strong> {{ $room->location }}</p>
            <p><strong>Capacity:</strong> {{ $room->capacity }}</p>
            <p><strong>Description:</strong> {{ $room->description ?? 'No description available' }}</p>
        </div>

        @if ($room->image)
            <div class="room-image">
                <h3>Room Image</h3>
                <img src="{{ asset('storage/' . $room->image) }}" alt="Room Image">
            </div>
        @endif

        @if ($room->blueprint)
            <div class="room-blueprint">
                <h3>Room Blueprint</h3>
                @if (pathinfo($room->blueprint, PATHINFO_EXTENSION) === 'pdf')
                    <a href="{{ asset('storage/' . $room->blueprint) }}" target="_blank">View Blueprint (PDF)</a>
                @else
                    <img src="{{ asset('storage/' . $room->blueprint) }}" alt="Room Blueprint">
                @endif
            </div>
        @endif

        <a href="{{ route('rooms.list') }}" class="back-link">Back to Room List</a>
    </div>
</body>
</html>
