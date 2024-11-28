<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Profile</title>
    <link rel="stylesheet" href="{{ asset('css/edit_profile.css') }}">
</head>
<body>
    <div class="container">
        <h1>Edit Profile</h1>
        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <form action="{{ route('update-profile') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" name="name" id="name" value="{{ old('name', $user->name) }}" required>
                @error('name') <small class="error">{{ $message }}</small> @enderror
            </div>

            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" name="email" id="email" value="{{ old('email', $user->email) }}" required>
                @error('email') <small class="error">{{ $message }}</small> @enderror
            </div>

            <div class="form-group">
                <label for="profile_image">Profile Image</label>
                @if ($user->profile_image)
                    <img src="{{ asset('storage/' . $user->profile_image) }}" alt="Profile Image" width="100">
                @endif
                <input type="file" name="profile_image" id="profile_image">
                @error('profile_image') <small class="error">{{ $message }}</small> @enderror
            </div>

            <button type="submit">Update Profile</button>
        </form>
    </div>
</body>
</html>
