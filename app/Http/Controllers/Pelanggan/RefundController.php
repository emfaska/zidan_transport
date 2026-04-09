<?php

namespace App\Http\Controllers\Pelanggan;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\RefundRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RefundController extends Controller
{
    public function create($id)
    {
        $booking = Booking::where('user_id', Auth::id())
            ->whereIn('status', ['pending', 'confirmed'])
            ->where('jumlah_bayar', '>', 0)
            ->findOrFail($id);

        // Jika sudah ada refund request, kembalikan
        if ($booking->refundRequest) {
            return redirect()->route('pelanggan.booking.show', $id)
                             ->with('error', 'Permintaan refund untuk pesanan ini sudah diajukan.');
        }

        return view('pelanggan.booking.refund', compact('booking'));
    }

    public function store(Request $request, $id)
    {
        $request->validate([
            'bank_name' => 'required|string|max:50',
            'account_number' => 'required|string|max:50',
            'account_name' => 'required|string|max:100',
            'reason' => 'required|string|max:500',
        ]);

        $booking = Booking::where('user_id', Auth::id())
            ->whereIn('status', ['pending', 'confirmed'])
            ->where('jumlah_bayar', '>', 0)
            ->findOrFail($id);

        if ($booking->refundRequest) {
            return redirect()->route('pelanggan.booking.show', $id)
                             ->with('error', 'Permintaan refund sudah ada.');
        }

        // Tentukan jumlah refund. Jika full DP, bisa kembalikan penuh atau dipotong biaya admin.
        // Di sini kita kembalikan sesuai jumlah yang sudah dibayar.
        $refundAmount = $booking->jumlah_bayar;

        $refund = RefundRequest::create([
            'booking_id' => $booking->id,
            'user_id' => Auth::id(),
            'bank_name' => $request->bank_name,
            'account_number' => $request->account_number,
            'account_name' => $request->account_name,
            'amount' => $refundAmount,
            'reason' => $request->reason,
            'status' => 'pending'
        ]);

        // Ubah status booking menjadi dibatalkan
        $booking->update(['status' => 'cancelled']);

        try {
            (new \App\Services\FonnteService())->sendCancellation($booking);
        } catch (\Exception $e) {
            \Illuminate\Support\Facades\Log::error('Fonnte Send WA Error (Refund): ' . $e->getMessage());
        }

        return redirect()->route('pelanggan.booking.index')
                         ->with('success', 'Permintaan pembatalan & refund berhasil diajukan. Silakan tunggu proses dari admin.');
    }

    public function confirm(Request $request, $id)
    {
        $request->validate([
            'bukti_penerimaan' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $booking = Booking::where('user_id', Auth::id())
            ->whereHas('refundRequest', function($q) {
                $q->where('status', 'processed');
            })
            ->findOrFail($id);

        $refund = $booking->refundRequest;

        $path = $request->file('bukti_penerimaan')->store('refund_proofs', 'public');

        $refund->update([
            'bukti_penerimaan' => $path,
            'status' => 'completed'
        ]);

        return redirect()->route('pelanggan.booking.index')
                         ->with('success', 'Konfirmasi penerimaan dana berhasil dikirim. Proses refund selesai.');
    }
}
