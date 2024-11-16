<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Room Management</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/dashboardnavbar.css') }}">
</head>
<body>
    @include('partials.dashboardnavbar') <!-- Include the navbar -->

    <div class="container mt-5">
        <h1 class="mb-4">Room Management</h1>

        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <!-- Add Room Form -->
        <form action="{{ route('rooms.store') }}" method="POST" class="mb-4">
            @csrf
            <div class="row">
                <div class="col-md-4">
                    <input type="text" name="name" class="form-control" placeholder="Room Name" required>
                </div>
                <div class="col-md-4">
                    <input type="text" name="location" class="form-control" placeholder="Location (Optional)">
                </div>
                <div class="col-md-2">
                    <input type="number" name="capacity" class="form-control" placeholder="Capacity (Optional)">
                </div>
                <div class="col-md-2">
                    <button type="submit" class="btn btn-primary w-100">Add Room</button>
                </div>
            </div>
        </form>

        <!-- Room List -->
        <table class="table table-striped">
            <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Location</th>
                <th>Capacity</th>
                <th>Created At</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
            @forelse($rooms as $room)
                <tr>
                    <td>{{ $room->id }}</td>
                    <td>{{ $room->name }}</td>
                    <td>{{ $room->location ?? 'N/A' }}</td>
                    <td>{{ $room->capacity ?? 'N/A' }}</td>
                    <td>{{ $room->created_at->format('Y-m-d H:i') }}</td>
                    <td>
                        <a href="{{ route('rooms.edit', $room) }}" class="btn btn-sm btn-warning">Edit</a>
                        <form action="{{ route('rooms.destroy', $room) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this room?');">Delete</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="text-center">No rooms found.</td>
                </tr>
            @endforelse
            </tbody>
        </table>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
