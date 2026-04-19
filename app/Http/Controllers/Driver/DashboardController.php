<?php

namespace App\Http\Controllers\Driver;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $activeBookings = Booking::where('driver_id', Auth::id())
            ->whereIn('status', ['confirmed', 'on_trip'])
            ->with(['user', 'rute'])
            ->orderBy('tanggal_berangkat', 'asc')
            ->orderBy('waktu_jemput', 'asc')
            ->get();

        $activeBooking = $activeBookings->first();
        $upcomingTaskCount = $activeBookings->count();

        // Statistik ringkas
        $stats = [
            'total_completed' => Booking::where('driver_id', Auth::id())->where('status', 'completed')->count(),
            'total_trips' => Booking::where('driver_id', Auth::id())->count(),
            'today_jobs' => Booking::where('driver_id', Auth::id())
                ->whereDate('tanggal_berangkat', today())
                ->count(),
        ];

        return view('driver.dashboard', compact('activeBooking', 'stats', 'upcomingTaskCount'));
    }

    public function updateStatus(Request $request)
    {
        $request->validate([
            'status' => 'required|in:available,off'
        ]);

        $driver = Auth::user();
        
        // Jangan biarkan offline jika ada trip aktif
        $hasActiveTrip = Booking::where('driver_id', $driver->id)
            ->whereIn('status', ['confirmed', 'on_trip'])
            ->exists();
            
        if ($hasActiveTrip && $request->status === 'off') {
            return response()->json([
                'success' => false,
                'message' => 'Anda tidak bisa Offline saat masih ada tugas aktif.'
            ], 422);
        }

        $profile = $driver->driverProfile;
        if($profile) {
            $profile->status_driver = $request->status;
            $profile->save();
        }

        return response()->json([
            'success' => true,
            'message' => 'Status berhasil diperbarui.',
            'status' => $request->status
        ]);
    }

    public function history(Request $request)
    {
        $query = Booking::where('driver_id', Auth::id())
            ->where('status', 'completed')
            ->with(['user', 'rute']);

        // Filter Bulan (Format: YYYY-MM)
        if ($request->filled('month')) {
            [$year, $month] = explode('-', $request->month);
            $query->whereYear('tanggal_berangkat', $year)
                  ->whereMonth('tanggal_berangkat', $month);
        }

        $bookings = $query->latest()
            ->paginate(15)
            ->withQueryString();

        return view('driver.order.index', compact('bookings'));
    }

    public function activeTasks(Request $request)
    {
        $bookings = Booking::where('driver_id', Auth::id())
            ->whereIn('status', ['confirmed', 'on_trip'])
            ->with(['user', 'rute'])
            ->orderBy('tanggal_berangkat', 'asc')
            ->orderBy('waktu_jemput', 'asc')
            ->paginate(15);
            
        return view('driver.order.active', compact('bookings'));
    }
}
