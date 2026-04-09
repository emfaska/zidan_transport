<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\DriverWallet;
use App\Models\WalletTransaction;
use App\Models\WithdrawalRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class WalletController extends Controller
{
    public function index()
    {
        // Daftar permintaan pencairan (pending dulu, lalu yang terbaru)
        $withdrawals = WithdrawalRequest::with('driver')
            ->orderByRaw("FIELD(status, 'pending', 'approved', 'rejected')")
            ->latest()
            ->paginate(20);

        // Statistik ringkas
        $stats = [
            'total_pending'  => WithdrawalRequest::where('status', 'pending')->count(),
            'total_approved' => WithdrawalRequest::where('status', 'approved')->sum('amount'),
            'total_drivers'  => DriverWallet::count(),
            'total_balance'  => DriverWallet::sum('balance'),
        ];

        return view('admin.wallet.index', compact('withdrawals', 'stats'));
    }

    public function approve($id)
    {
        $withdrawal = WithdrawalRequest::where('status', 'pending')->findOrFail($id);

        DB::transaction(function () use ($withdrawal) {
            // Tandai approved
            $withdrawal->update([
                'status'       => 'approved',
                'processed_at' => now(),
            ]);

            // Tambahkan ke total_withdrawn driver
            $wallet = DriverWallet::where('user_id', $withdrawal->driver_id)->first();
            if ($wallet) {
                $wallet->total_withdrawn += $withdrawal->amount;
                $wallet->save();
            }

            // Update status transaksi debit menjadi withdrawn
            WalletTransaction::where('driver_id', $withdrawal->driver_id)
                ->where('type', 'debit')
                ->where('status', 'settled')
                ->where('amount', $withdrawal->amount)
                ->latest()
                ->first()
                ?->update(['status' => 'withdrawn']);
        });

        return back()->with('success', 'Pencairan berhasil disetujui!');
    }

    public function reject(Request $request, $id)
    {
        $request->validate([
            'catatan_admin' => 'nullable|string|max:255',
        ]);

        $withdrawal = WithdrawalRequest::where('status', 'pending')->findOrFail($id);

        DB::transaction(function () use ($request, $withdrawal) {
            // Tandai rejected
            $withdrawal->update([
                'status'        => 'rejected',
                'catatan_admin' => $request->catatan_admin,
                'processed_at'  => now(),
            ]);

            // Kembalikan saldo ke dompet driver
            $wallet = DriverWallet::where('user_id', $withdrawal->driver_id)->first();
            if ($wallet) {
                $wallet->balance += $withdrawal->amount;
                $wallet->save();
            }

            // Hapus transaksi debit terkait (refund)
            WalletTransaction::where('driver_id', $withdrawal->driver_id)
                ->where('type', 'debit')
                ->where('status', 'settled')
                ->where('amount', $withdrawal->amount)
                ->latest()
                ->first()
                ?->delete();

            // Catat transaksi refund
            WalletTransaction::create([
                'driver_id'   => $withdrawal->driver_id,
                'booking_id'  => null,
                'type'        => 'credit',
                'amount'      => $withdrawal->amount,
                'description' => 'Pengembalian dana — pencairan ditolak admin',
                'status'      => 'settled',
            ]);
        });

        return back()->with('success', 'Pencairan ditolak dan saldo dikembalikan ke driver.');
    }
}
