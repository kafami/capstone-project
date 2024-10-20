<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\EventBooking;

class EventBookingController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'room' => 'required|string',
            'booking_date' => 'required|date',
            'start_time' => 'required|date_format:H:i',
            'end_time' => 'required|date_format:H:i|after:start_time',
            'event_type' => 'required|string',
            'event_name' => 'required|string',
            'description' => 'nullable|string',
            'status' => 'required|string',
        ]);

        EventBooking::create([
            'room' => $request->room,
            'booking_date' => $request->booking_date,
            'start_time' => $request->start_time,
            'end_time' => $request->end_time,
            'event_type' => $request->event_type,
            'event_name' => $request->event_name,
            'description' => $request->description,
            'status' => $request->status,
        ]);

        return response()->json(['message' => 'Event booking created successfully!']);
    }

    // Add this method to fetch events
    public function getEvents()
{
    $events = EventBooking::all();

    // Format the events data
    $formattedEvents = $events->map(function ($event) {
        return [
            'id' => $event->id, // Add the event ID
            'title' => $event->event_name,
            'room' => $event->room, // Ensure room is an integer
            'day' => \Carbon\Carbon::parse($event->booking_date)->dayOfWeek, // Day of the week
            'date' => $event->booking_date, // Include the booking_date
            'start' => $event->start_time,
            'end' => $event->end_time,
            'status' => $event->status,
            'cssClass' => 'event-' . strtolower(str_replace(' ', '-', $event->event_type)),
        ];
    });

    return response()->json($formattedEvents);
}
}
