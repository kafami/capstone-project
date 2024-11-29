<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('css/home.css') }}">
    <link rel="shortcut icon" href="{{ asset('img/favicon.png') }}">
    <title>{{ $title }}</title>
</head>
<body>
    {{-- pembagian kelas grid--}}
    <div class="website-body">
        {{-- bagian header --}}
        <div class="header">
            @include('partials.navbar')
        </div>
        {{-- grid tabel --}}
        <div class="main">
            {{-- manggil table --}}
            @include('partials.tables')
        </div>
        {{-- grid search bar & calendar --}}
        <div class="secondary">
            <div class="search-bar-holder">
                <input class="search-bar" type="text">
            </div>
            {{-- manggil calendar --}}
            @include('partials.calendar')
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
                    <p class="cat-text">Maintanance</p>
                    <div class="cat-maint"></div>
                </div>
                <div class="cat-holder">
                    <p class="cat-text">Zoom</p>
                    <div class="cat-zoom"></div>
                </div>
            </div>
        </div>
    </div>

    <!-- Popup -->
    <div id="popup" class="popup hidden">
        <div class="popup-content">
            <span id="close-popup" class="close-popup">&times;</span>
            <div class="form-container">
                <div class="holder">
                    <div class="data-input">
                        <form id="event-form">
                            <!-- Existing form structure -->
                            <div class="form-group">
                                <label for="ruangan" class="form-label">Pilih ruangan:</label>
                                <select name="ruangan" id="ruangan" class="form-select">
                                    <option value="A201">A201</option>
                                    <option value="A202">A202</option>
                                    <option value="A102">A102</option>
                                    <option value="A101">A101</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="bookingdate" class="form-label">Pilih tanggal:</label>
                                <input type="date" id="bookingdate" name="bookingdate" class="form-input">
                            </div>
                            <div class="form-group">
                                <label for="starttime" class="form-label">Start time:</label>
                                <input type="time" id="starttime" name="starttime" class="form-input time-input">
                            </div>
                            <div class="form-group">
                                <label for="endtime" class="form-label">End time:</label>
                                <input type="time" id="endtime" name="endtime" class="form-input time-input">
                            </div>
                            <div class="form-group">
                                <label for="event-type" class="form-label">Pilih jenis acara:</label>
                                <select name="event-type" id="event-type" class="form-select">
                                    <option value="External">External</option>
                                    <option value="Internal">Internal</option>
                                    <option value="Maintenance">Maintenance</option>
                                    <option value="Zoom">Zoom</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="event_name" class="form-label">Acara:</label>
                                <input type="text" id="event_name" name="event_name" class="form-input nama-acara">
                            </div>
                            <div class="form-group">
                                <label for="description" class="form-label">Deskripsi:</label>
                                <textarea id="description" name="description" class="form-input deskripsi-acara" rows="5"></textarea>
                            </div>
                            <div class="button-container">
                                <input type="submit" id="submit-btn" value="Submit">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
    document.addEventListener('DOMContentLoaded', function () {
        const popup = document.getElementById('popup');
        const openPopupLink = document.querySelector('.calendarOpt a');
        const closePopup = document.getElementById('close-popup');

        openPopupLink.addEventListener('click', function (e) {
            e.preventDefault();
            popup.classList.remove('hidden');
        });

        closePopup.addEventListener('click', function () {
            popup.classList.add('hidden');
        });

        window.addEventListener('click', function (event) {
            if (event.target === popup) {
                popup.classList.add('hidden');
            }
        });
    });

    $(document).ready(function () {
        $('#submit-btn').click(function (e) {
            e.preventDefault();

            const formData = {
                room: $('#ruangan').val(),
                booking_date: $('#bookingdate').val(),
                start_time: $('#starttime').val(),
                end_time: $('#endtime').val(),
                event_type: $('#event-type').val(),
                event_name: $('.nama-acara').val(),
                description: $('.deskripsi-acara').val(),
                status: 'pending',
                _token: '{{ csrf_token() }}'
            };

            $.ajax({
                url: '/event-booking',
                type: 'POST',
                data: formData,
                success: function (response) {
                    alert(response.message);
                    $('#popup').addClass('hidden');
                    $('#event-form')[0].reset();
                },
                error: function (xhr) {
                    if (xhr.status === 422) {
                        const errors = JSON.parse(xhr.responseText);
                        alert(errors.message); 
                    } else {
                        alert('An error occurred: ' + xhr.responseText);
                    }
                }
            });
        });
    });
    document.getElementById('ruangan').addEventListener('change', function () {
    const roomName = this.value;
    fetch(`/room-details/${roomName}`)
        .then(response => response.json())
        .then(data => {
            if (data.location) {
                alert('Room location: ' + data.location); // Replace this with your desired behavior
            } else {
                console.error('Room not found');
            }
        })
        .catch(error => console.error('Error fetching room details:', error));
});
</script>

</body>
</html>