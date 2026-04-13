<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\VehicleReport;
use App\Models\ReplacementRequest;
use App\Models\Armada;
use App\Models\Booking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class VehicleIssueController extends Controller
{
    public function index()
    {
        $reports = VehicleReport::with(['user', 'armada', 'booking'])->latest()->paginate(10, ['*'], 'reports_page');
        $replacements = ReplacementRequest::with(['user', 'booking', 'oldArmada'])->latest()->paginate(10, ['*'], 'replacements_page');
        $av_armadas = Armada::where('status', 'tersedia')->get();
        
        return view('admin.vehicle.index', compact('reports', 'replacements', 'av_armadas'));
    }

    public function handleReport(Request $request, $id)
    {
        $report = VehicleReport::findOrFail($id);
        
        $request->validate([
            'status' => 'required|in:checked,repaired',
        ]);

        $report->update(['status' => $request->status]);

        if ($request->status === 'checked') {
            $report->armada->update(['status' => 'maintenance']);
        } elseif ($request->status === 'repaired') {
            $report->armada->update(['status' => 'tersedia']);
        }

        return back()->with('success', 'Status laporan kendaraan berhasil diperbarui.');
    }

    public function handleReplacement(Request $request, $id)
    {
        $replacement = ReplacementRequest::findOrFail($id);
        
        $request->validate([
            'action' => 'required|in:approve,reject',
            'admin_notes' => 'nullable|string|max:500',
            'new_armada_id' => 'required_if:action,approve|exists:armadas,id'
        ]);

        if ($request->action === 'reject') {
            $replacement->update([
                'status' => 'rejected',
                'admin_notes' => $request->admin_notes
            ]);
            return back()->with('success', 'Permintaan ganti armada telah ditolak.');
        }

        // Action: Approve
        DB::transaction(function () use ($request, $replacement) {
            $booking = $replacement->booking;
            
            // 1. Update status armada lama jadi maintenance jika alasannya rusak
            $replacement->oldArmada->update(['status' => 'maintenance']);
            
            // 2. Set armada baru di booking
            $booking->update(['armada_id' => $request->new_armada_id]);
            
            // 3. Update status armada baru jadi terpakai
            Armada::find($request->new_armada_id)->update(['status' => 'terpakai']);

            // 4. Update request status
            $replacement->update([
                'status' => 'approved',
                'new_armada_id' => $request->new_armada_id,
                'admin_notes' => $request->admin_notes
            ]);
        });

        return back()->with('success', 'Permintaan ganti armada disetujui. Data pesanan telah diperbarui.');
    }
}
