<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\EventBooking;
use App\Models\User;

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

        // Get the authenticated user
        $user = auth()->user();

        // Create a new event booking
        $eventBooking = EventBooking::create([
            'room' => $request->room,
            'booking_date' => $request->booking_date,
            'start_time' => $request->start_time,
            'end_time' => $request->end_time,
            'event_type' => $request->event_type,
            'event_name' => $request->event_name,
            'description' => $request->description,
            'status' => $request->status,
            'user_id' => $user->id, // Automatically set the user ID
            'name' => $user->name, // Automatically set the user's name
            'role' => $user->role, // Automatically set the user's role
        ]);

        return response()->json(['message' => 'Event booked successfully!'], 201);
    }

    

        // Add this method to fetch events
        public function getEvents()
        {
            $events = EventBooking::with('user')->get();

            $formattedEvents = $events->map(function ($event) {
                return [
                    'id' => $event->id,
                    'title' => $event->event_name,
                    'room' => $event->room,
                    'booking_date' => $event->booking_date,
                    'start' => $event->start_time,
                    'end' => $event->end_time,
                    'status' => $event->status,
                    'cssClass' => 'event-' . strtolower(str_replace(' ', '-', $event->event_type)),
                    'name' => $event->name,
                    'role' => $event->role,
                    'user_id' => $event->user_id, // Include the user ID
                    'description' => $event->description,
                ];
            });

            return response()->json($formattedEvents);
        }


    public function showDashboard()
    {
        // Fetch only events with pending status
        $events = EventBooking::where('status', 'pending')->with('user')->get();

        return view('dashboardkonfirmasi', [
            'title' => 'Dashboard Konfirmasi',
            'events' => $events,
        ]);
    }
    
    public function bulkUpdate(Request $request)
    {
        $statuses = $request->input('statuses', []);

        foreach ($statuses as $eventId => $status) {
            EventBooking::where('id', $eventId)->update(['status' => $status]);
        }

        return redirect()->route('dashboard.konfirmasi')->with('success', 'Statuses updated successfully.');
    }

}

