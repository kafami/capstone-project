<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('css/dashboardkonfirmasi.css') }}">
    <link rel="shortcut icon" href="{{ asset('img/favicon.png') }}">
    <title>{{ $title }}</title>
</head>
<body>
    <div class="nav">
        @include('partials.dashboardnavbar')
    </div>
    <form action="{{ route('events.bulkUpdate') }}" method="POST">
        @csrf
        <div class="dash-main">
            <div class="main">
                <div class="option-holder">
                    <p>Konfirmasi Request</p>
                    <div>
                        <label for="ruangan" class="form-label"><p>Sort By: </p></label>
                        <select name="ruangan" id="ruangan" class="form-select">
                            <option value="date">Date</option>
                            <option value="role">Role</option>
                        </select>
                    </div>
                    <button type="submit" class="submit-button"><p>Submit</p></button>
                </div>

                @foreach ($events as $event)
                    <div class="konfirmasi-ruangan {{ $event->is_conflict ? 'conflict' : '' }}">
                        <div>
                            <p class="ruangan">Ruangan {{ $event->room }}</p>
                            <p class="ruangan">{{ $event->event_name }}</p>
                            <p class="ruangan">{{ $event->description }}</p>
                            <p class="peminjam">{{ $event->name }}</p>
                            <p class="peminjam">{{ $event->role }}</p>
                            <div class="date-time">
                                <p class="date">{{ \Carbon\Carbon::parse($event->booking_date)->format('m/d/y') }}</p>
                                <p class="time">{{ $event->start_time }} - {{ $event->end_time }}</p>
                            </div>
                        </div>
                        <label class="container">
                            <input type="checkbox" name="statuses[{{ $event->id }}]" value="accepted" class="confirm-box" onclick="toggleCheckbox(this)" {{ $event->is_conflict ? 'disabled' : '' }}>
                            <span class="checkbox-container"></span>
                        </label>
                        <label class="container">
                            <input type="checkbox" name="statuses[{{ $event->id }}]" value="denied" class="deny-box" onclick="toggleCheckbox(this)">
                            <span class="checkbox-container"></span>
                        </label>
                    </div>
                @endforeach


            </div>
        </div>
    </form>

<script>
    function toggleCheckbox(selectedCheckbox) {
        const checkboxes = selectedCheckbox.closest('.konfirmasi-ruangan').querySelectorAll('input[type="checkbox"]');
        checkboxes.forEach(checkbox => {
            if (checkbox !== selectedCheckbox) checkbox.checked = false;
        });
    }
    document.querySelector('form').addEventListener('submit', function (e) {
        const conflictingCheckBoxes = document.querySelectorAll('.konfirmasi-ruangan.conflict .confirm-box:checked');

        console.log("Conflicting checkboxes:", conflictingCheckBoxes);

        if (conflictingCheckBoxes.length > 0) {
            alert('You cannot confirm events that have conflicts. Please resolve the conflicts first.');
            e.preventDefault(); 
        }
    });

</script>

</body>
</html>
