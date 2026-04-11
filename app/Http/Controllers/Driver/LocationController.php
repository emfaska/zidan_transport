<?php

namespace App\Http\Controllers\Driver;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Booking;
use Illuminate\Support\Facades\Auth;

class LocationController extends Controller
{
    /**
     * Update driver's current location.
     */
    public function update(Request $request)
    {
        $request->validate([
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
        ]);

        $user = Auth::user();
        if ($user->role !== 'pengemudi') {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        $profile = $user->driverProfile;
        if ($profile) {
            $profile->update([
                'latitude' => $request->latitude,
                'longitude' => $request->longitude,
            ]);
        }

        return response()->json(['message' => 'Location updated']);
    }

    /**
     * Fetch the driver's current location for a specific booking.
     */
    public function fetch($booking_id)
    {
        $booking = Booking::with('driver.driverProfile')
            ->where('id', $booking_id)
            ->where('user_id', Auth::id()) // Ensure customer owns the booking
            ->firstOrFail();

        if ($booking->status !== 'on_trip') {
            return response()->json(['message' => 'Tracking only available during trip'], 400);
        }

        $driver = $booking->driver;
        if (!$driver || !$driver->driverProfile) {
            return response()->json(['message' => 'No driver assigned'], 404);
        }

        return response()->json([
            'latitude' => $driver->driverProfile->latitude,
            'longitude' => $driver->driverProfile->longitude,
            'driver_name' => $driver->name,
        ]);
    }
}
