<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\RefundRequest;
use Illuminate\Http\Request;

class RefundController extends Controller
{
    public function index(Request $request)
    {
        $status = $request->query('status', 'all');

        $query = RefundRequest::with(['booking.user', 'booking.armada']);

        if ($status !== 'all') {
            $query->where('status', $status);
        }

        $refunds = $query->latest()->paginate(10);

        return view('admin.refund.index', compact('refunds', 'status'));
    }

    public function approve(Request $request, $id)
    {
        $request->validate([
            'admin_note' => 'nullable|string|max:500'
        ]);

        $refund = RefundRequest::findOrFail($id);
        
        if ($refund->status !== 'pending') {
            return back()->with('error', 'Hanya permintaan dengan status pending yang bisa diproses.');
        }

        $refund->update([
            'status' => 'processed',
            'admin_note' => $request->admin_note
        ]);

        return back()->with('success', 'Permintaan refund ditandai sebagai "Diproses". Menunggu pelanggan mengunggah bukti penerimaan.');
    }

    public function reject(Request $request, $id)
    {
        $request->validate([
            'admin_note' => 'required|string|max:500'
        ]);

        $refund = RefundRequest::findOrFail($id);
        
        if ($refund->status !== 'pending') {
            return back()->with('error', 'Hanya permintaan dengan status pending yang bisa ditolak.');
        }

        $refund->update([
            'status' => 'rejected',
            'admin_note' => $request->admin_note
        ]);

        return back()->with('success', 'Permintaan refund berhasil ditolak.');
    }
}
