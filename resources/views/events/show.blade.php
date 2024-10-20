<!-- resources/views/events/show.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Event Details</title>
</head>
<body>
    <div class="event-details">
        <h1>{{ $event->event_name }}</h1>
        <p><strong>Room:</strong> {{ $event->room }}</p>
        <p><strong>Date:</strong> {{ $event->booking_date }}</p>
        <p><strong>Start Time:</strong> {{ $event->start_time }}</p>
        <p><strong>End Time:</strong> {{ $event->end_time }}</p>
        <p><strong>Description:</strong> {{ $event->description }}</p>
        <p><strong>Status:</strong> {{ $event->status }}</p>
    </div>
</body>
</html>