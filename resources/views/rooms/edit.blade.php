<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Room</title>
    <link rel="stylesheet" href="{{ asset('css/room_management.css') }}">
</head>
<body>
    <div class="nav">
        @include('partials.dashboardnavbar')
    </div>
    <div class="dash-main">
        <h1 class="title">Edit Room</h1>

        @if($errors->any())
            <div class="alert error-alert">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('rooms.update', $room) }}" method="POST" class="edit-room-form">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="name">Room Name</label>
                <input type="text" id="name" name="name" value="{{ old('name', $room->name) }}" required>
            </div>

            <div class="form-group">
                <label for="location">Location (Optional)</label>
                <input type="text" id="location" name="location" value="{{ old('location', $room->location) }}">
            </div>

            <div class="form-group">
                <label for="capacity">Capacity (Optional)</label>
                <input type="number" id="capacity" name="capacity" value="{{ old('capacity', $room->capacity) }}">
            </div>

            <div class="button-group">
                <button type="submit" class="btn primary-btn">Update Room</button>
                <a href="{{ route('rooms.index') }}" class="btn secondary-btn">Cancel</a>
            </div>
        </form>
    </div>
</body>
</html>
