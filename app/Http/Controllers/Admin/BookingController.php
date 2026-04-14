<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\User;
use App\Services\FonnteService;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    protected $fonnte;

    public function __construct(FonnteService $fonnte)
    {
        $this->fonnte = $fonnte;
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Booking::with(['user', 'rute', 'driver', 'armada', 'extensions'])->latest();

        if ($request->filled('tanggal')) {
            $query->whereDate('tanggal_berangkat', $request->tanggal);
        }
        if ($request->filled('armada_id')) {
            $query->where('armada_id', $request->armada_id);
        }
        if ($request->filled('driver_id')) {
            $query->where('driver_id', $request->driver_id);
        }

        $bookings = $query->get();
        $armadas = \App\Models\Armada::all();
        $drivers = User::where('role', 'pengemudi')->get();

        return view('admin.booking.index', compact('bookings', 'armadas', 'drivers'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Booking $booking)
    {
        return view('admin.booking.show', compact('booking'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $customers = User::where('role', 'pelanggan')->get();
        $drivers = User::where('role', 'pengemudi')->get();
        $layanans = \App\Models\Layanan::where('is_active', true)->get();
        $rutes = \App\Models\Rute::with('armada')->where('is_active', true)->get();
        
        return view('admin.booking.create', compact('customers', 'drivers', 'layanans', 'rutes'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Clean currency inputs before validation
        $input = $request->all();
        if (isset($input['total_harga'])) {
            $input['total_harga'] = str_replace(['.', ','], '', $input['total_harga']);
        }
        $request->merge($input);

        $request->validate([
            'user_id' => 'required|exists:users,id',
            'rute_id' => 'required|exists:rutes,id',
            'tanggal_berangkat' => 'required|date',
            'waktu_jemput' => 'required',
            'jumlah_penumpang' => 'required|integer|min:1',
            'alamat_jemput' => 'required|string',
            'driver_id' => 'nullable|exists:users,id',
        ]);

        $rute = \App\Models\Rute::find($request->rute_id);
        
        // Cek ketersediaan armada
        $armadaId = $request->armada_id ?? $rute->armada_id;
        if ($armadaId) {
            $isBooked = Booking::where('armada_id', $armadaId)
                ->where('tanggal_berangkat', $request->tanggal_berangkat)
                ->where('status', '!=', 'cancelled')
                ->exists();

            if ($isBooked) {
                return back()->withInput()->with('error', 'Maaf, armada ini sudah memiliki jadwal booking lain pada tanggal tersebut.');
            }
        }
        
        $totalHarga = $request->total_harga ?? $rute->harga_paket;
        if($request->has('include_tol') && !$request->has('total_harga')) {
            $totalHarga += $rute->harga_tol ?? 0;
        }

        $booking = Booking::create([
            'user_id' => $request->user_id,
            'rute_id' => $request->rute_id,
            'armada_id' => $request->armada_id ?? $rute->armada_id,
            'tanggal_berangkat' => $request->tanggal_berangkat,
            'waktu_jemput' => $request->waktu_jemput,
            'jumlah_penumpang' => $request->jumlah_penumpang,
            'alamat_jemput' => $request->alamat_jemput,
            'catatan_customer' => $request->catatan ?? null,
            'include_tol' => $request->has('include_tol'),
            'harga_paket' => $rute->harga_paket,
            'harga_tol' => $rute->harga_tol,
            'total_harga' => $totalHarga,
            'status' => 'confirmed', 
            'driver_id' => $request->driver_id,
        ]);

        // Kirim Notifikasi WA ke Driver jika ada
        if ($request->driver_id) {
            $driver = User::find($request->driver_id);
            if ($driver && $driver->no_hp) {
                try {
                    $this->fonnte->sendDriverAssignment($booking);
                    session()->flash('wa_success', "Tugas berhasil dikirim ke WhatsApp {$driver->name}!");
                } catch (\Exception $e) {
                    \Illuminate\Support\Facades\Log::error('Fonnte Send WA Error (Admin Store): ' . $e->getMessage());
                }
            }
        }

        return redirect()->route('admin.booking.index')->with('success', 'Booking berhasil dibuat untuk pelanggan!');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Booking $booking)
    {
        $drivers = User::where('role', 'pengemudi')->get();
        $armadas = \App\Models\Armada::all();
        return view('admin.booking.edit', compact('booking', 'drivers', 'armadas'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Booking $booking)
    {
        // Clean currency inputs before validation
        $input = $request->all();
        if (isset($input['total_harga'])) {
            $input['total_harga'] = str_replace(['.', ','], '', $input['total_harga']);
        }
        $request->merge($input);

        $request->validate([
            'status' => 'required|in:pending,confirmed,on_trip,completed,cancelled',
            'driver_id' => 'nullable|exists:users,id',
            'armada_id' => 'nullable|exists:armadas,id',
            'total_harga' => 'required|numeric|min:0',
            'status_pembayaran' => 'required|in:belum_bayar,dp_dibayar,lunas',
            'catatan_admin' => 'nullable|string',
        ]);

        // Cek ketersediaan armada jika status bukan cancelled
        if ($request->status !== 'cancelled' && $booking->armada_id) {
            $isBooked = Booking::where('armada_id', $booking->armada_id)
                ->where('tanggal_berangkat', $booking->tanggal_berangkat)
                ->where('status', '!=', 'cancelled')
                ->where('id', '!=', $booking->id) // Kecualikan pesanan ini sendiri
                ->exists();

            if ($isBooked) {
                return back()->withInput()->with('error', 'Gagal update: Armada ini sudah memiliki jadwal booking AKTIF lain pada tanggal tersebut.');
            }
        }

        $booking->update([
            'status' => $request->status,
            'driver_id' => $request->driver_id,
            'armada_id' => $request->armada_id,
            'total_harga' => $request->total_harga,
            'total_akhir' => $request->total_harga, // Admin sets the FINAL price
            'status_pembayaran' => $request->status_pembayaran,
            'catatan_admin' => $request->catatan_admin,
            'potongan_promo' => 0, // Reset promo if manual price is set by admin to avoid double discount
        ]);

        // Kirim Notifikasi WA ke Driver jika baru saja di-assign atau diubah
        if ($request->driver_id && ($booking->wasChanged('driver_id') || $request->has('force_notify'))) {
            $driver = User::find($request->driver_id);
            if ($driver && $driver->no_hp) {
                try {
                    $this->fonnte->sendDriverAssignment($booking);
                    session()->flash('wa_success', "Tugas berhasil dikirim ke WhatsApp {$driver->name}!");
                } catch (\Exception $e) {
                    \Illuminate\Support\Facades\Log::error('Fonnte Send WA Error (Admin Update): ' . $e->getMessage());
                }
            }
        }

        return redirect()->route('admin.booking.index')->with('success', 'Booking berhasil diperbarui!');
    }

    /**
     * Notify driver via WhatsApp API (Fonnte)
     */
    public function notifyDriver(Booking $booking)
    {
        if (!$booking->driver || !$booking->driver->no_hp) {
            return back()->with('error', 'Gagal: Driver tidak memiliki nomor HP.');
        }

        try {
            $this->fonnte->sendDriverAssignment($booking);
            return back()->with('wa_success', "Tugas berhasil dikirim ke WhatsApp {$booking->driver->name}!");
        } catch (\Exception $e) {
            \Illuminate\Support\Facades\Log::error('Fonnte Send WA Error (Admin Notify): ' . $e->getMessage());
            return back()->with('error', 'Gagal mengirim pesan WhatsApp. Pastikan Token Fonnte benar.');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Booking $booking)
    {
        $booking->delete();
        return redirect()->route('admin.booking.index')->with('success', 'Booking berhasil dihapus!');
    }

    /**
     * Prepare message for driver assignment
     */
    private function prepareMessage($booking, $driver)
    {
        $tanggal = \Carbon\Carbon::parse($booking->tanggal_berangkat)->format('d M Y');
        $jam = substr($booking->waktu_jemput, 0, 5);
        $appUrl = config('app.url');
        
        $message = "Halo *{$driver->name}*!\n\n";
        $message .= "Ada penugasan baru untuk Anda:\n";
        $message .= "• Kode: *#{$booking->kode_booking}*\n";
        $message .= "• Rute: *{$booking->rute->nama_rute}*\n";
        $message .= "• Jadwal: *{$tanggal}* @ *{$jam} WIB*\n\n";
        $message .= "Silakan cek detail tugas di Dashboard Driver:\n";
        $message .= "{$appUrl}/driver/dashboard\n\n";
        $message .= "Semoga perjalanan lancar dan berkah! 🚗✨";

        return $message;
    }

    public function handleExtension(Request $request, \App\Models\BookingExtension $extension)
    {
        // Clean currency inputs
        $input = $request->all();
        if (isset($input['additional_price'])) {
            $input['additional_price'] = str_replace(['.', ','], '', $input['additional_price']);
        }
        $request->merge($input);

        $request->validate([
            'action' => 'required|in:approve,reject',
            'additional_price' => 'required_if:action,approve|numeric|min:0',
            'admin_notes' => 'nullable|string',
        ]);

        if ($request->action === 'approve') {
            $extension->update([
                'status' => 'approved',
                'additional_price' => $request->additional_price,
                'admin_notes' => $request->admin_notes
            ]);
            $msg = 'Pengajuan perpanjangan telah DISETUJUI.';
        } else {
            $extension->update([
                'status' => 'rejected',
                'admin_notes' => $request->admin_notes
            ]);
            $msg = 'Pengajuan perpanjangan telah DITOLAK.';
        }

        try {
            (new \App\Services\FonnteService())->sendExtensionStatusToCustomer($extension);
        } catch (\Exception $e) {
            \Illuminate\Support\Facades\Log::error('Fonnte Send WA Error (Handle Extension): ' . $e->getMessage());
        }

        return back()->with('success', $msg);
    }

    public function downloadInvoice($id)
    {
        $booking = Booking::with(['user', 'rute.layanan', 'armada', 'extensions' => function($q) {
            $q->where('status', 'approved');
        }])->findOrFail($id);

        try {
            $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadView('pelanggan.booking.invoice', compact('booking'))
                      ->setPaper('a4', 'portrait')
                      ->setOptions([
                          'isHtml5ParserEnabled' => true,
                          'isRemoteEnabled' => true,
                          'defaultFont' => 'sans-serif'
                      ]);

            return $pdf->stream('invoice-' . $booking->kode_booking . '.pdf');
        } catch (\Exception $e) {
            \Log::error('Admin PDF Generation Error: ' . $e->getMessage());
            return back()->with('error', 'Gagal membuat file PDF: ' . $e->getMessage());
        }
    }
}
