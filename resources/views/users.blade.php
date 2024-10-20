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
        <div class="main">
            <div class="header">
                <p class="body-title">User Information</p>
            </div>
            <div id="user-container"></div>
            <div class="form-container">
                <h2>Add New User</h2>
                <form id="user-form">
                    <label for="role">Role:</label>
                    <select id="role" name="role" required>
                        <option value="Admin">Admin</option>
                        <option value="Professor">Professor</option>
                        <option value="Student">Student</option>
                    </select>
                    <label for="name">Name:</label>
                    <input type="text" id="name" name="name" required>
                    <button type="submit">Add User</button>
                </form>
            </div>
        </div>
    </div>
    <script>
        const users = [
            { role: 'Admin', name: 'Pak Sidik', img: '{{ asset("img/admin.svg") }}' },
            { role: 'Professor', name: 'Pak Arseto', img: '{{ asset("img/professor.svg") }}' },
            { role: 'Student', name: 'Kaffa', img: '{{ asset("img/student.svg") }}' },
        ];

        const roleImages = {
            'Admin': '{{ asset("img/admin.svg") }}',
            'Professor': '{{ asset("img/professor.svg") }}',
            'Student': '{{ asset("img/student.svg") }}'
        };

        const userContainer = document.getElementById('user-container');

        function renderUsers() {
            userContainer.innerHTML = '';
            users.forEach((user, index) => {
                const userHolder = document.createElement('div');
                userHolder.className = 'user-holder';

                const infoDiv = document.createElement('div');
                infoDiv.className = 'info';

                const img = document.createElement('img');
                img.src = user.img;
                img.alt = user.role;

                const roleP = document.createElement('p');
                roleP.textContent = user.role;

                infoDiv.appendChild(img);
                infoDiv.appendChild(roleP);

                const nameP = document.createElement('p');
                nameP.className = 'name';
                nameP.textContent = user.name;

                const deleteButton = document.createElement('button');
                deleteButton.textContent = 'Delete';
                deleteButton.onclick = () => {
                    users.splice(index, 1);
                    renderUsers();
                };

                userHolder.appendChild(infoDiv);
                userHolder.appendChild(nameP);
                userHolder.appendChild(deleteButton);

                userContainer.appendChild(userHolder);
            });
        }

        document.getElementById('user-form').addEventListener('submit', function(event) {
            event.preventDefault();
            const role = document.getElementById('role').value;
            const name = document.getElementById('name').value;
            const img = roleImages[role];
            users.push({ role, name, img });
            renderUsers();
            this.reset();
        });

        // Initial render
        renderUsers();
    </script>
</body>
</html>
