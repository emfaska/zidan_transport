<?php

namespace App\Http\Controllers\Pelanggan;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Rute;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf;

class BookingController extends Controller
{
    public function index(Request $request)
    {
        $tab = $request->query('tab', 'active');

        $query = Booking::where('user_id', Auth::id())
            ->with(['rute', 'extensions'])
            ->latest();

        if ($tab === 'history') {
            $query->whereIn('status', ['completed', 'cancelled']);
        } else {
            $query->whereNotIn('status', ['completed', 'cancelled']);
        }

        $bookings = $query->paginate(10)->appends(['tab' => $tab]);
            
        return view('pelanggan.booking.index', compact('bookings', 'tab'));
    }

    public function create(Request $request)
    {
        $layanans = \App\Models\Layanan::where('is_active', true)->get();
        $rutes = Rute::with('armada')
            ->where('is_active', true)
            ->whereHas('armada', function($query) {
                $query->where('status', 'tersedia');
            })
            ->get();
        $selectedArmada = null;
        
        if ($request->has('armada_id')) {
            $selectedArmada = \App\Models\Armada::find($request->armada_id);
        }

        $promo = \App\Models\Promo::where('is_active', true)->latest()->first();
        
        return view('pelanggan.booking.create', compact('layanans', 'rutes', 'selectedArmada', 'promo'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'rute_id' => 'required|exists:rutes,id',
            'armada_id' => 'nullable|exists:armadas,id',
            'tipe_perjalanan' => 'required|in:one_way,round_trip',
            'tanggal_berangkat' => 'required|date|after_or_equal:today',
            'waktu_jemput' => 'required',
            'titik_jemput' => 'required|string|max:255',
            'titik_tujuan' => 'required|string|max:255',
            'jumlah_penumpang' => 'required|integer|min:1',
            'catatan_customer' => 'nullable|string',
            'include_tol' => 'nullable|boolean',
        ]);

        $rute = Rute::findOrFail($request->rute_id);
        
        // Cek ketersediaan armada pada tanggal tersebut
        if ($request->armada_id) {
            $isBooked = Booking::where('armada_id', $request->armada_id)
                ->where('tanggal_berangkat', $request->tanggal_berangkat)
                ->where('status', '!=', 'cancelled')
                ->exists();

            if ($isBooked) {
                return back()->withInput()->with('error', 'Maaf, armada ini sudah dipesan oleh pelanggan lain untuk tanggal tersebut. Silakan pilih armada lain atau tanggal berbeda.');
            }
        }
        
        // Pilih harga paket berdasarkan tipe perjalanan
        $hargaPaket = ($request->tipe_perjalanan === 'round_trip' && $rute->harga_paket_pp) 
                        ? $rute->harga_paket_pp 
                        : $rute->harga_paket;

        $totalHarga = $hargaPaket;
        $hargaTol = $rute->harga_tol ?? 0;

        if ($request->has('include_tol') && $request->include_tol && $hargaTol > 0) {
            // Jika PP, biaya tol dikali 2 (pergi & pulang)
            $biayaTol = ($request->tipe_perjalanan === 'round_trip') ? ($hargaTol * 2) : $hargaTol;
            $totalHarga += $biayaTol;
        } else {
            $biayaTol = 0;
        }

        // Apply Promo if active
        $promo = \App\Models\Promo::where('is_active', true)->latest()->first();
        $potonganPromo = 0;
        if ($promo) {
            $potonganPromo = ($totalHarga * $promo->potongan_persen) / 100;
        }
        $totalAkhir = $totalHarga - $potonganPromo;
        
        $booking = Booking::create([
            'user_id' => Auth::id(),
            'rute_id' => $request->rute_id,
            'promo_id' => $promo ? $promo->id : null,
            'tipe_perjalanan' => $request->tipe_perjalanan,
            'armada_id' => $request->armada_id,
            'tanggal_berangkat' => $request->tanggal_berangkat,
            'waktu_jemput' => $request->waktu_jemput,
            'titik_jemput' => $request->titik_jemput,
            'titik_tujuan' => $request->titik_tujuan,
            'jumlah_penumpang' => $request->jumlah_penumpang,
            'include_tol' => $request->has('include_tol'),
            'harga_paket' => $hargaPaket, 
            'harga_tol' => ($request->has('include_tol') && $request->include_tol) ? $biayaTol : 0,
            'total_harga' => $totalHarga, 
            'potongan_promo' => $potonganPromo,
            'total_akhir' => $totalAkhir,
            'status' => 'pending',
            'catatan_customer' => $request->catatan_customer,
        ]);

        try {
            (new \App\Services\FonnteService())->sendCheckoutInvoice($booking);
        } catch (\Exception $e) {
            \Illuminate\Support\Facades\Log::error('Fonnte Send WA Error (Checkout): ' . $e->getMessage());
        }

        return redirect()->route('pelanggan.booking.index')
            ->with('success', 'Pesanan Anda berhasil dikirim! Silakan tunggu konfirmasi admin.');
    }

    public function payment(Request $request, $id)
    {
        $booking = Booking::where('user_id', Auth::id())
            ->where('id', $id)
            ->whereIn('status', ['confirmed', 'pending'])
            ->firstOrFail();

        // If already fully paid, redirect
        if ($booking->status_pembayaran === 'lunas') {
            return redirect()->route('pelanggan.booking.index')->with('success', 'Pesanan ini sudah lunas.');
        }

        $totalHarga = (float) ($booking->total_akhir ?? $booking->total_harga);
        $sudahBayar = (float) $booking->jumlah_bayar;
        $remainingBalance = $totalHarga - $sudahBayar;

        // If DP already paid, payment type must be 'lunas' for the remaining balance
        if ($booking->status_pembayaran === 'dp_dibayar') {
            $paymentType = 'lunas';
            $amountToPay = (int) $remainingBalance;
        } else {
            $paymentType = $request->query('type', $booking->tipe_pembayaran ?? 'lunas');
            if ($paymentType === 'dp') {
                $amountToPay = (int) ($totalHarga * 0.3); // 30% DP
            } else {
                $amountToPay = (int) $totalHarga;
            }
        }

        // Regenerate token if type changes or token is missing or amount changes
        // Use a more specific check for the snap token to avoid unnecessary regenerations
        $needsNewToken = !$booking->snap_token || 
                         ($booking->status_pembayaran === 'dp_dibayar' && $booking->tipe_pembayaran !== 'lunas') ||
                         ($booking->status_pembayaran !== 'dp_dibayar' && $booking->tipe_pembayaran !== $paymentType);

        if ($needsNewToken || (int)$booking->jumlah_bayar !== $amountToPay) {
            
            \Midtrans\Config::$serverKey = config('midtrans.server_key');
            \Midtrans\Config::$isProduction = config('midtrans.is_production');
            \Midtrans\Config::$isSanitized = config('midtrans.is_sanitized');
            \Midtrans\Config::$is3ds = config('midtrans.is_3ds');

            $params = [
                'transaction_details' => [
                    'order_id' => $booking->kode_booking . '-' . $paymentType . '-' . uniqid(),
                    'gross_amount' => $amountToPay,
                ],
                'customer_details' => [
                    'first_name' => Auth::user()->name,
                    'email' => Auth::user()->email,
                    'phone' => Auth::user()->no_hp ?? '',
                ],
                'item_details' => [
                    [
                        'id' => $booking->rute_id,
                        'price' => $amountToPay,
                        'quantity' => 1,
                        'name' => 'Pembayaran ' . strtoupper($paymentType) . ' - ' . ($booking->rute->nama_rute ?? 'Transport'),
                    ]
                ],
                'metadata' => [
                    'booking_id' => $booking->id,
                    'tipe_pembayaran' => $paymentType,
                ]
            ];

            try {
                $snapToken = \Midtrans\Snap::getSnapToken($params);
                $booking->update([
                    'snap_token' => $snapToken,
                    'tipe_pembayaran' => $paymentType,
                    // We don't update jumlah_bayar yet, it's updated in callback
                ]);
            } catch (\Exception $e) {
                \Log::error('Midtrans Snap Error: ' . $e->getMessage());
                return back()->with('error', 'Gagal menghubungkan ke layanan pembayaran. Silakan coba sesaat lagi.');
            }
        }
            
        return view('pelanggan.booking.payment', compact('booking', 'paymentType', 'amountToPay', 'sudahBayar', 'totalHarga'));
    }

    public function show($id)
    {
        $booking = Booking::where('user_id', Auth::id())
            ->with(['rute', 'armada', 'extensions' => function($q) {
                $q->latest();
            }])
            ->findOrFail($id);
            
        return view('pelanggan.booking.show', compact('booking'));
    }

    public function requestExtension(Request $request, $id)
    {
        $booking = Booking::where('user_id', Auth::id())->findOrFail($id);

        $request->validate([
            'new_return_date' => 'required|date|after:' . $booking->tanggal_berangkat->format('Y-m-d'),
            'reason' => 'required|string|max:500',
        ]);

        if ($booking->hasPendingExtension()) {
            return back()->with('error', 'Anda masih memiliki pengajuan perpanjangan yang belum diproses.');
        }

        $extension = $booking->extensions()->create([
            'new_return_date' => $request->new_return_date,
            'reason' => $request->reason,
            'status' => 'pending'
        ]);

        try {
            (new \App\Services\FonnteService())->sendExtensionRequestToAdmin($extension);
        } catch (\Exception $e) {
            \Illuminate\Support\Facades\Log::error('Fonnte Send WA Error (Extension Req): ' . $e->getMessage());
        }

        return back()->with('success', 'Pengajuan perpanjangan berhasil dikirim! Tunggu konfirmasi admin.');
    }

    public function destroy($id)
    {
        $booking = Booking::where('user_id', Auth::id())
            ->findOrFail($id);
            
        // Only allow deletion for pending bookings
        if ($booking->status !== 'pending') {
            return back()->with('error', 'Hanya pesanan dengan status pending yang dapat dihapus.');
        }

        try {
            (new \App\Services\FonnteService())->sendCancellation($booking);
        } catch (\Exception $e) {
            \Illuminate\Support\Facades\Log::error('Fonnte Send WA Error (Cancel): ' . $e->getMessage());
        }
        
        $booking->delete();
        
        return redirect()->route('pelanggan.booking.index')
            ->with('success', 'Pesanan Anda berhasil dihapus.');
    }

    public function downloadInvoice($id)
    {
        $booking = Booking::where('user_id', Auth::id())
            ->with(['rute.layanan', 'armada', 'extensions' => function($q) {
                $q->where('status', 'approved');
            }])
            ->findOrFail($id);

        // Hanya boleh download jika status sudah dikonfirmasi, on_trip, atau selesai
        if (!in_array($booking->status, ['confirmed', 'on_trip', 'completed'])) {
            return back()->with('error', 'Invoice belum tersedia. Pesanan harus dikonfirmasi terlebih dahulu.');
        }

        try {
            $pdf = Pdf::loadView('pelanggan.booking.invoice', compact('booking'))
                      ->setPaper('a4', 'portrait')
                      ->setOptions([
                          'isHtml5ParserEnabled' => true,
                          'isRemoteEnabled' => true,
                          'defaultFont' => 'sans-serif'
                      ]);

            return $pdf->stream('invoice-' . $booking->kode_booking . '.pdf');
        } catch (\Exception $e) {
            \Log::error('PDF Generation Error: ' . $e->getMessage());
            return back()->with('error', 'Gagal membuat file PDF. Silakan coba sesaat lagi.');
        }
    }
}
