<?php

namespace App\Http\Controllers\API;

use App\Models\Event;
use App\Models\Booking;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BookingController extends Controller
{
    public function book(Event $event)
{
    $user = auth()->user();

    if ($event->bookings()->where('user_id', $user->id)->exists()) {
        return response()->json(['message' => 'Already booked'], 400);
    }

    if ($event->bookings()->count() >= $event->seats) {
        return response()->json(['message' => 'No seats available'], 400);
    }

    Booking::create(['user_id' => $user->id, 'event_id' => $event->id]);
    return response()->json(['message' => 'Booking successful']);
}

public function myBookings()
{
    return auth()->user()->bookings()->with('event')->get();
}

}
