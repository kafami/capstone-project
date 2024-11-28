<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Room List</title>
    <link rel="stylesheet" href="{{ asset('css/room_list.css') }}">
</head>
<body>
    <div class="nav">
        @include('partials.dashboardnavbar')
    </div>
    <div class="dash-main">
        <h2 class="title">Room List</h2>
        <div class="room-container">
            @forelse ($rooms as $room)
                <div class="room-card">
                    <h3 class="room-name">{{ $room->name }}</h3>
                    <p><strong>Location:</strong> {{ $room->location }}</p>
                    <p><strong>Capacity:</strong> {{ $room->capacity }}</p>
                    @if ($room->image)
                        <div class="room-image">
                            <img src="{{ asset('storage/' . $room->image) }}" alt="Room Image">
                        </div>
                    @endif
                    <a href="{{ route('rooms.show', $room->id) }}" class="details-link">View Details</a>
                </div>
            @empty
                <p class="no-rooms">No rooms available.</p>
            @endforelse
        </div>
    </div>
</body>
</html>
