<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\LaporanArmada;
use App\Models\Armada;

class LaporanArmadaController extends Controller
{
    public function index()
    {
        $laporans = LaporanArmada::with(['driver', 'armada', 'booking'])
            ->latest()
            ->paginate(15);
            
        return view('admin.laporan.index', compact('laporans'));
    }

    public function updateStatus(Request $request, $id)
    {
         $laporan = LaporanArmada::findOrFail($id);
         
         $request->validate([
             'status' => 'required|in:diproses,selesai,ditolak',
         ]);

         $laporan->update(['status' => $request->status]);

         // Otomatis ubah status armada menjadi maintenance jika diperlukan
         if ($request->status === 'diproses' && in_array($laporan->tipe_laporan, ['kerusakan', 'kecelakaan'])) {
             if ($laporan->armada) {
                 $laporan->armada->update(['status' => 'maintenance']);
             }
         } elseif ($request->status === 'selesai' && $laporan->armada && $laporan->armada->status === 'maintenance') {
             $laporan->armada->update(['status' => 'tersedia']);
         }

         return back()->with('success', 'Status laporan berhasil diperbarui!');
    }
}
