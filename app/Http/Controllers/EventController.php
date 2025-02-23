<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class EventController extends Controller
{
    public function index()
    {
        $events = Event::all();
        return response()->json([
            'success' => true,
            'data' => $events
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'startDate' => 'required|date',
            'endDate' => 'required|date|after_or_equal:startDate',
            'location' => 'required|string|max:255',
            'attendees' => 'required|integer|min:1',
            'status' => 'required|in:open,closed',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Store image
        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('events', 'public'); // Store in public disk
            $validated['image'] = asset(Storage::url($path));
        }

        $event = Event::create($validated);

        return response()->json([
            'success' => true,
            'data' => $event,
            'message' => 'Event berhasil dibuat, silahkan cek Halaman Utama'
        ], 201);
    }

    public function show(Event $event)
    {
        return response()->json([
            'success' => true,
            'data' => $event
        ]);
    }

    public function update(Request $request, Event $event)
    {
        $validated = $request->validate([
            'title' => 'sometimes|string|max:255',
            'startDate' => 'sometimes|date',
            'endDate' => 'sometimes|date|after_or_equal:startDate',
            'location' => 'sometimes|string|max:255',
            'attendees' => 'sometimes|integer|min:1',
            'status' => 'sometimes|in:open,closed',
            'image' => 'sometimes|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->hasFile('image')) {
            // Delete old image
            if ($event->image) {
                $oldImage = str_replace(asset(''), '', $event->image);
                Storage::disk('public')->delete($oldImage);
            }
            
            // Store new image
            $path = $request->file('image')->store('events', 'public');
            $validated['image'] = asset(Storage::url($path));
        }

        $event->update($validated);

        return response()->json([
            'success' => true,
            'data' => $event,
            'message' => 'Event berhasil diperbarui'
        ]);
    }

    public function destroy(Event $event)
    {
        // Delete associated image
        if ($event->image) {
            $imagePath = str_replace(asset(''), '', $event->image);
            Storage::disk('public')->delete($imagePath);
        }

        $event->delete();

        return response()->json([
            'success' => true,
            'message' => 'Event berhasil dihapus'
        ]);
    }

    public function stats()
    {
        $total = Event::count();
        $open = Event::where('status', 'open')->count();
        $closed = Event::where('status', 'closed')->count();
        $avgAttendees = Event::avg('attendees');

        return response()->json([
            'total_events' => $total,
            'open_events' => $open,
            'closed_events' => $closed,
            'avg_attendees' => round($avgAttendees, 1)
        ]);
    }
}