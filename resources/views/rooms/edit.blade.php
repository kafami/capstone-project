<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Room</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/dashboardnavbar.css') }}">
</head>
<body>
    @include('partials.dashboardnavbar') <!-- Include the navbar -->

    <div class="container mt-5">
        <h1 class="mb-4">Edit Room</h1>

        @if($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('rooms.update', $room) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="name" class="form-label">Room Name</label>
                <input type="text" id="name" name="name" class="form-control" value="{{ old('name', $room->name) }}" required>
            </div>

            <div class="mb-3">
                <label for="location" class="form-label">Location (Optional)</label>
                <input type="text" id="location" name="location" class="form-control" value="{{ old('location', $room->location) }}">
            </div>

            <div class="mb-3">
                <label for="capacity" class="form-label">Capacity (Optional)</label>
                <input type="number" id="capacity" name="capacity" class="form-control" value="{{ old('capacity', $room->capacity) }}">
            </div>

            <button type="submit" class="btn btn-success">Update Room</button>
            <a href="{{ route('rooms.index') }}" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
