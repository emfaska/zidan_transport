<?php

namespace App\Http\Controllers\Driver;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\LaporanArmada;
use App\Models\Booking;
use Illuminate\Support\Facades\Auth;

class LaporanController extends Controller
{
    public function store(Request $request)
    {
         $request->validate([
             'booking_id' => 'required|exists:bookings,id',
             'tipe_laporan' => 'required|in:kerusakan,kecelakaan,kebersihan,lainnya',
             'deskripsi' => 'required|string|max:1000',
             'foto_bukti' => 'nullable|image|max:5120',
         ]);

         $booking = Booking::where('id', $request->booking_id)->whereNotNull('armada_id')->firstOrFail();

         $path = null;
         if ($request->hasFile('foto_bukti')) {
             $path = $request->file('foto_bukti')->store('laporan_armada', 'public');
         }

         LaporanArmada::create([
             'driver_id' => Auth::id(),
             'armada_id' => $booking->armada_id,
             'booking_id' => $booking->id,
             'tipe_laporan' => $request->tipe_laporan,
             'deskripsi' => $request->deskripsi,
             'foto_bukti' => $path,
             'request_penggantian' => $request->has('request_penggantian'),
             'status' => 'pending'
         ]);

         return back()->with('success', 'Laporan Kedaruratan telah dikirim ke Admin. Silakan tunggu instruksi selanjutnya melalui WhatsApp atau Telepon.');
    }
}
