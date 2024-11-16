<?php

namespace App\Http\Controllers;

use App\Models\Room;
use Illuminate\Http\Request;

class RoomController extends Controller
{
    /**
     * Display a list of rooms.
     */
    public function index()
    {
        $rooms = Room::all(); // Fetch all rooms
        return view('rooms.index', compact('rooms'));
    }

    /**
     * Store a new room.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:rooms,name',
            'location' => 'nullable|string',
            'capacity' => 'nullable|integer|min:1',
        ]);

        Room::create($request->only(['name', 'location', 'capacity']));

        return redirect()->route('rooms.index')->with('success', 'Room added successfully!');
    }
    
    public function edit(Room $room)
    {
        return view('rooms.edit', compact('room'));
    }

    /**
     * Update the specified room in storage.
     */
    public function update(Request $request, Room $room)
    {
        $request->validate([
            'name' => 'required|unique:rooms,name,' . $room->id,
            'location' => 'nullable|string',
            'capacity' => 'nullable|integer|min:1',
        ]);

        $room->update($request->only(['name', 'location', 'capacity']));

        return redirect()->route('rooms.index')->with('success', 'Room updated successfully!');
    }

    /**
     * Remove the specified room from storage.
     */
    public function destroy(Room $room)
    {
        $room->delete();

        return redirect()->route('rooms.index')->with('success', 'Room deleted successfully!');
    }
}
