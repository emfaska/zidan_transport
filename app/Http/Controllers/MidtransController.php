<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class MidtransController extends Controller
{
    public function callback(Request $request)
    {
        $serverKey = config('midtrans.server_key');
        $signature = hash("sha512", $request->order_id . $request->status_code . $request->gross_amount . $serverKey);

        if ($signature !== $request->signature_key) {
            \Log::warning('Midtrans Callback: Invalid signature for Order ID: ' . $request->order_id);
            return response()->json(['message' => 'Invalid signature'], 403);
        }

        $transactionStatus = $request->transaction_status;
        $orderId = $request->order_id;
        
        // Robustly find booking
        $parts = explode('-', $orderId);
        // Format: BOOK-YYYYMMDD-XXX-type-uniqueID
        // We know kode_booking is 3 parts: BOOK, date, counter
        if (count($parts) < 3) {
             return response()->json(['message' => 'Invalid Order ID format'], 400);
        }
        $kodeBooking = $parts[0] . '-' . $parts[1] . '-' . $parts[2];
        $paymentType = $parts[3] ?? 'lunas'; // Use type from order_id if metadata fails
        
        $booking = Booking::where('kode_booking', $kodeBooking)->first();

        if (!$booking) {
            \Log::error('Midtrans Callback: Booking not found for Kode: ' . $kodeBooking);
            return response()->json(['message' => 'Booking not found'], 404);
        }

        if ($transactionStatus == 'capture' || $transactionStatus == 'settlement') {
            $grossAmount = (float) $request->gross_amount;
            
            // If it was lunas/settlement, we expect it to complete the payment
            // If it was DP, we mark it as dp_dibayar
            $newStatusPembayaran = ($paymentType === 'dp') ? 'dp_dibayar' : 'lunas';
            
            // For safety, if they pay 'lunas' even without DP, it becomes 'lunas'
            // If they pay 'lunas' and previously had 'dp_dibayar', it becomes 'lunas'
            
            $updateData = [
                'status_pembayaran' => $newStatusPembayaran,
                'metode_pembayaran' => 'midtrans',
                'status' => 'confirmed', 
                'tipe_pembayaran' => $paymentType,
            ];

            $booking->update($updateData);
            
            // Increment total paid amount
            // Note: In production, you might want to check if this transaction was already processed
            // using the transaction_id to prevent double counting if callbacks are retried.
            $booking->increment('jumlah_bayar', $grossAmount);

            try {
                if ($newStatusPembayaran === 'lunas') {
                    (new \App\Services\FonnteService())->sendPaymentSuccess($booking);
                }
            } catch (\Exception $e) {
                \Illuminate\Support\Facades\Log::error('Fonnte Send WA Error (Payment Success): ' . $e->getMessage());
            }

            \Log::info('Midtrans Callback: Payment success for ' . $kodeBooking . ' Type: ' . $paymentType . ' Amount: ' . $grossAmount);
        } elseif ($transactionStatus == 'pending') {
            // Only update to pending if not already lunas/dp_dibayar
            if (!in_array($booking->status_pembayaran, ['lunas', 'dp_dibayar'])) {
                $booking->update(['status_pembayaran' => 'pending']);
            }
        } elseif ($transactionStatus == 'deny' || $transactionStatus == 'expire' || $transactionStatus == 'cancel') {
            // Only update to failed if not already lunas/dp_dibayar
            if (!in_array($booking->status_pembayaran, ['lunas', 'dp_dibayar'])) {
                $booking->update(['status_pembayaran' => 'failed']);
            }
            \Log::info('Midtrans Callback: Payment failed/cancelled for ' . $kodeBooking . ' Status: ' . $transactionStatus);
        }

        return response()->json(['message' => 'Callback processed']);
    }
}
