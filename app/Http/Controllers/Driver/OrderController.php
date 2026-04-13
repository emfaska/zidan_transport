<?php

namespace App\Http\Controllers\Driver;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\DriverWallet;
use App\Models\WalletTransaction;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    public function show($id)
    {
        $booking = Booking::where('driver_id', Auth::id())
            ->with(['user', 'rute.layanan', 'armada'])
            ->findOrFail($id);

        return view('driver.order.show', compact('booking'));
    }

    public function updateStatus(Request $request, $id)
    {
        $booking = Booking::where('driver_id', Auth::id())->findOrFail($id);
        $driver = Auth::user();

        $request->validate([
            'status' => 'required|in:on_trip,completed,confirmed'
        ]);

        $booking->update([
            'status' => $request->status
        ]);

        $message = 'Status perjalanan berhasil diperbarui!';

        if ($request->status === 'on_trip') {
            $message = 'Hati-hati di jalan! Perjalanan dimulai.';
            
            // Set status driver jadi ON DUTY via Profile
            if ($driver->driverProfile) {
                $driver->driverProfile->update(['status_driver' => 'on_duty']);
            }
        }

        if ($request->status === 'completed') {
            $message = 'Alhamdulillah, tugas selesai dengan baik!';

            // Kembalikan status driver jadi AVAILABLE via Profile (Hanya jika sebelumnya bukan Offline)
            if ($driver->driverProfile && $driver->driverProfile->status_driver !== 'off') {
                $driver->driverProfile->update(['status_driver' => 'available']);
            }

            // === Hitung & Catat Komisi Driver (Sesuai Setting) ===
            $hargaAcuan = $booking->total_akhir ?? $booking->total_harga;
            $percent = (float) Setting::get('driver_commission_percent', 25);
            $komisi = round($hargaAcuan * ($percent / 100), 2);

            DB::transaction(function () use ($booking, $komisi, $driver) {
                // Upsert: buat atau perbarui dompet driver
                $wallet = DriverWallet::firstOrCreate(
                    ['user_id' => $driver->id],
                    ['balance' => 0, 'total_earned' => 0, 'total_withdrawn' => 0]
                );

                $wallet->balance       += $komisi;
                $wallet->total_earned  += $komisi;
                $wallet->save();

                // Catat di riwayat transaksi
                WalletTransaction::create([
                    'driver_id'   => $driver->id,
                    'booking_id'  => $booking->id,
                    'type'        => 'credit',
                    'amount'      => $komisi,
                    'description' => 'Komisi ' . Setting::get('driver_commission_percent', 25) . '% — ' . $booking->kode_booking . ' (' . ($booking->rute->nama_rute ?? 'Trip') . ')',
                    'status'      => 'settled',
                ]);
            });
        }

        return redirect()->back()->with('success', $message);
    }
}
