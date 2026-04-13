<?php

namespace App\Http\Controllers\Driver;

use App\Http\Controllers\Controller;
use App\Models\DriverWallet;
use App\Models\WalletTransaction;
use App\Models\WithdrawalRequest;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class WalletController extends Controller
{
    public function index()
    {
        $driver = Auth::user();

        // Ambil atau inisialisasi dompet
        $wallet = DriverWallet::firstOrCreate(
            ['user_id' => $driver->id],
            ['balance' => 0, 'total_earned' => 0, 'total_withdrawn' => 0]
        );

        // Riwayat transaksi (terbaru di atas)
        $transactions = WalletTransaction::where('driver_id', $driver->id)
            ->with('booking')
            ->latest()
            ->paginate(15);

        // Permintaan pencairan terakhir
        $lastWithdrawal = WithdrawalRequest::where('driver_id', $driver->id)
            ->latest()
            ->first();

        // Apakah ada permintaan pencairan yang masih pending?
        $hasPendingWithdrawal = WithdrawalRequest::where('driver_id', $driver->id)
            ->where('status', 'pending')
            ->exists();

        return view('driver.wallet', compact(
            'wallet',
            'transactions',
            'lastWithdrawal',
            'hasPendingWithdrawal'
        ));
    }

    public function requestWithdraw(Request $request)
    {
        $minAmount = (int) Setting::get('min_withdrawal_amount', 10000);
        $request->validate([
            'amount'         => 'required|numeric|min:' . $minAmount,
            'nama_rekening'  => 'required|string|max:100',
            'nama_bank'      => 'required|string|max:50',
            'no_rekening'    => 'required|string|max:30',
        ]);

        $driver = Auth::user();
        $wallet = DriverWallet::where('user_id', $driver->id)->firstOrFail();

        // Pastikan saldo cukup
        if ($request->amount > $wallet->balance) {
            return back()->withErrors(['amount' => 'Nominal melebihi saldo yang tersedia.'])->withInput();
        }

        // Pastikan tidak ada pending sebelumnya
        $hasPending = WithdrawalRequest::where('driver_id', $driver->id)
            ->where('status', 'pending')
            ->exists();

        if ($hasPending) {
            return back()->withErrors(['amount' => 'Masih ada permintaan pencairan yang sedang diproses.'])->withInput();
        }

        DB::transaction(function () use ($request, $driver, $wallet) {
            // Buat permintaan pencairan
            WithdrawalRequest::create([
                'driver_id'     => $driver->id,
                'amount'        => $request->amount,
                'nama_rekening' => $request->nama_rekening,
                'nama_bank'     => $request->nama_bank,
                'no_rekening'   => $request->no_rekening,
                'status'        => 'pending',
            ]);

            // Kurangi saldo (hold) dan catat transaksi debit
            $wallet->balance -= $request->amount;
            $wallet->save();

            WalletTransaction::create([
                'driver_id'   => $driver->id,
                'booking_id'  => null,
                'type'        => 'debit',
                'amount'      => $request->amount,
                'description' => 'Pengajuan pencairan ke ' . $request->nama_bank . ' - ' . $request->no_rekening,
                'status'      => 'settled',
            ]);
        });

        return redirect()->route('driver.wallet.index')
            ->with('success', 'Permintaan pencairan berhasil diajukan! Admin akan memproses segera.');
    }
}
