<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('css/users.css') }}">
    <link rel="shortcut icon" href="{{ asset('img/favicon.png') }}">
    <title>{{ $title }}</title>
</head>
<body>
    <div class="nav">
        @include('partials.dashboardnavbar')
    </div>
    <div class="dash-main">
        <h1 class="header-title">User Management</h1>

        <!-- User Table -->
        <div class="table-container">
            <table class="custom-table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Role</th>
                        <th>Name</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($users as $index => $user)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ ucfirst($user['role']) }}</td>
                            <td>{{ $user['name'] }}</td>
                            <td>
                                <button class="btn delete-btn" onclick="deleteUser({{ $index }})">Delete</button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="empty-row">No users found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Add User Form -->
        <div class="form-container">
            <h2 class="form-title">Add New User</h2>
            <form id="user-form">
                <div class="form-group">
                    <label for="role">Role:</label>
                    <select id="role" name="role" required>
                        <option value="Admin">Admin</option>
                        <option value="Professor">Professor</option>
                        <option value="Student">Student</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="name">Name:</label>
                    <input type="text" id="name" name="name" required>
                </div>
                <button type="submit" class="btn primary-btn">Add User</button>
            </form>
        </div>
    </div>

    <script>
        const users = @json($users);

        function deleteUser(index) {
            users.splice(index, 1);
            renderUsers();
        }
    </script>
</body>
</html>
