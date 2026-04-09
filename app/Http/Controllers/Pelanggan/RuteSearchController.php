<?php

namespace App\Http\Controllers\Pelanggan;

use App\Http\Controllers\Controller;
use App\Models\Rute;
use Illuminate\Http\Request;

class RuteSearchController extends Controller
{
    /**
     * Search for routes based on pickup and destination.
     */
    public function search(Request $request)
    {
        $request->validate([
            'lokasi_awal' => 'required|string|min:2',
            'tujuan' => 'required|string|min:2',
        ]);

        $lokasiAwal = $request->lokasi_awal;
        $tujuan = $request->tujuan;

        // Partial and case-insensitive matching with grouped conditions
        $rutes = Rute::where('is_active', true)
            ->where(function ($query) use ($lokasiAwal, $tujuan) {
                $query->where(function ($q) use ($lokasiAwal, $tujuan) {
                    $q->where('lokasi_awal', 'like', '%' . $lokasiAwal . '%')
                        ->where('tujuan', 'like', '%' . $tujuan . '%');
                })->orWhere(function ($q) use ($lokasiAwal, $tujuan) {
                    // Check reverse direction
                    $q->where('lokasi_awal', 'like', '%' . $tujuan . '%')
                        ->where('tujuan', 'like', '%' . $lokasiAwal . '%');
                });
            })
            ->with(['armada'])
            ->get();

        if ($rutes->isEmpty()) {
            return response()->json([
                'success' => false,
                'message' => 'Rute belum tersedia untuk lokasi tersebut.',
            ]);
        }

        return response()->json([
            'success' => true,
            'data' => $rutes->map(function ($rute) {
                return [
                    'id' => $rute->id,
                    'nama_rute' => $rute->nama_rute,
                    'lokasi_awal' => $rute->lokasi_awal,
                    'tujuan' => $rute->tujuan,
                    'harga' => number_format($rute->harga_paket, 0, ',', '.'),
                    'harga_raw' => $rute->harga_paket,
                    'jarak' => $rute->jarak_km ? $rute->jarak_km . ' km' : '-',
                    'durasi' => $rute->durasi_estimasi ?? '-',
                    'armada' => $rute->armada ? $rute->armada->nama : 'Semua Armada',
                    'booking_url' => route('pelanggan.booking.create', ['rute_id' => $rute->id]),
                ];
            }),
        ]);
    }
}
