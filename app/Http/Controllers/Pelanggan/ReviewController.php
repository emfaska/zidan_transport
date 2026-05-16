<?php

namespace App\Http\Controllers\Pelanggan;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    public function store(Request $request, $bookingId)
    {
        $request->validate([
            'rating_layanan' => 'required|integer|min:1|max:5',
            'rating_driver'  => 'required|integer|min:1|max:5',
            'comment'        => 'nullable|string|max:500',
        ]);

        $booking = Booking::where('id', $bookingId)
            ->where('user_id', Auth::id())
            ->where('status', 'completed')
            ->firstOrFail();

        // Cek apakah sudah pernah direview
        if ($booking->review) {
            return back()->with('error', 'Anda sudah memberikan review untuk pesanan ini.');
        }

        Review::create([
            'booking_id'     => $booking->id,
            'user_id'        => Auth::id(),
            'driver_id'      => $booking->driver_id,
            'rating_layanan' => $request->rating_layanan,
            'rating_driver'  => $request->rating_driver,
            'rating'         => round(($request->rating_layanan + $request->rating_driver) / 2), // Legacy support
            'comment'        => $request->comment,
        ]);

        return back()->with('success', 'Terima kasih atas feedback Anda! Ulasan Anda sangat membantu kami meningkatkan layanan.');
    }
}
