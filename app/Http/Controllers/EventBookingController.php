<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\EventBooking;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

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

        $isConflict = EventBooking::where('room', $request->room)
        ->where('booking_date', $request->booking_date)
        ->where('status', 'accepted')
        ->where(function ($query) use ($request) {
            $query->whereBetween('start_time', [$request->start_time, $request->end_time])
                ->orWhereBetween('end_time', [$request->start_time, $request->end_time])
                ->orWhere(function ($query) use ($request) {
                    $query->where('start_time', '<=', $request->start_time)
                        ->where('end_time', '>=', $request->end_time);
                });
        })
        ->exists();

    if ($isConflict) {
        return response()->json(['message' => 'The room is already booked for the selected date and time.'], 422);
    }

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
            'user_id' => $user->id, 
            'name' => $user->name, 
            'role' => $user->role, 
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
                    'user_id' => $event->user_id, 
                    'description' => $event->description,
                ];
            });

            return response()->json($formattedEvents);
        }


        public function showDashboard()
        {
            $events = EventBooking::where('status', 'pending')->with('user')->get();

            foreach ($events as $event) {
                $conflicts = EventBooking::where('room', $event->room) // Same room
                    ->where('booking_date', $event->booking_date) // Same date
                    ->where('id', '!=', $event->id) // Exclude the current event
                    ->where(function ($query) use ($event) {
                        $query->whereBetween('start_time', [$event->start_time, $event->end_time])
                            ->orWhereBetween('end_time', [$event->start_time, $event->end_time])
                            ->orWhere(function ($query) use ($event) {
                                $query->where('start_time', '<=', $event->start_time)
                                    ->where('end_time', '>=', $event->end_time);
                            });
                    })
                    ->exists();

                $event->is_conflict = $conflicts; // Add a flag for conflicting events
            }

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

    public function showBookingHistory()
    {
        $bookings = EventBooking::all(); // Fetch all bookings
        return view('booking_history', compact('bookings'));
    }

    public function showAcceptedEventsForToday()
    {
        $today = \Carbon\Carbon::now()->toDateString();
        $acceptedBookings = EventBooking::where('status', 'accepted')->whereDate('booking_date', '>=', $today)->get(); // Fetch only accepted bookings for today
        return view('accepted_events', compact('acceptedBookings'));
    }

    public function deleteBooking($id)
    {
        $booking = EventBooking::find($id);
        if ($booking) {
            $booking->delete();
        }
        return redirect()->route('accepted.events')->with('success', 'Booking deleted successfully.');
    }

    public function showUserBookings()
    {
        // Get the authenticated user's bookings, sorted by booking_date
        $user = Auth::user();
        $bookings = EventBooking::where('user_id', $user->id)
            ->orderBy('booking_date', 'desc') 
            ->get();

        return view('user_bookings', [
            'title' => 'My Bookings',
            'bookings' => $bookings,
        ]);
    }

    public function updateStatus(Request $request, $id)
    {
        $event = EventBooking::findOrFail($id); // Find the event by ID
    
        // Update the status to the provided one (e.g., 'canceled')
        $event->status = $request->input('status');
        $event->save();
    
        return redirect()->back()->with('success', 'Event status updated successfully.');
    }
}

