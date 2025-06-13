<?php

namespace App\Http\Controllers\API;

use App\Models\Event;
use App\Models\Booking;
use App\Http\Controllers\Controller;
use App\models\User;

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
    $user = auth()->user();

    if (!$user) {
        return response()->json(['error' => 'Not authenticated'], 401);
    }

    if (!method_exists($user, 'bookings')) {
        return response()->json(['error' => 'Bookings method does not exist on User model'], 500);
    }

    $bookings = $user->bookings()->with('event')->get();

    return response()->json($bookings);
}

}
