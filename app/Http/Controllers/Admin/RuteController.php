<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Rute;
use App\Models\Layanan;
use App\Models\Armada;
use Illuminate\Http\Request;

class RuteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $rutes = Rute::with(['layanan', 'armada'])->latest()->get();
        return view('admin.rute.index', compact('rutes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $rute = null; // For blank form
        $layanans = Layanan::where('is_active', true)->get();
        $armadas = Armada::where('status', 'tersedia')->get();
        return view('admin.rute.create', compact('rute', 'layanans', 'armadas'));
    }

    public function duplicate(Rute $rute)
    {
        $layanans = Layanan::where('is_active', true)->get();
        $armadas = Armada::where('status', 'tersedia')->get();
        return view('admin.rute.create', compact('rute', 'layanans', 'armadas'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'layanan_id' => 'required|exists:layanans,id',
            'nama_rute' => 'required|string|max:255',
            'lokasi_awal' => 'required|string|max:255',
            'tujuan' => 'required|string|max:255',
            'armada_id' => 'required|exists:armadas,id',
            'harga_paket' => 'required|numeric|min:0',
            'harga_tol' => 'nullable|numeric|min:0',
            'durasi_estimasi' => 'nullable|string|max:100',
            'jarak_km' => 'nullable|integer|min:0',
            'catatan' => 'nullable|string',
        ]);

        Rute::create($request->all());

        return redirect()->route('admin.rute.index')->with('success', 'Rute baru berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Rute $rute)
    {
        return view('admin.rute.show', compact('rute'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Rute $rute)
    {
        $layanans = Layanan::where('is_active', true)->get();
        $armadas = Armada::all();
        return view('admin.rute.edit', compact('rute', 'layanans', 'armadas'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Rute $rute)
    {
        $request->validate([
            'layanan_id' => 'required|exists:layanans,id',
            'nama_rute' => 'required|string|max:255',
            'lokasi_awal' => 'required|string|max:255',
            'tujuan' => 'required|string|max:255',
            'armada_id' => 'required|exists:armadas,id',
            'harga_paket' => 'required|numeric|min:0',
            'harga_tol' => 'nullable|numeric|min:0',
            'durasi_estimasi' => 'nullable|string|max:100',
            'jarak_km' => 'nullable|integer|min:0',
            'catatan' => 'nullable|string',
        ]);

        $rute->update($request->all());

        return redirect()->route('admin.rute.index')->with('success', 'Data rute berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Rute $rute)
    {
        $rute->delete();
        return redirect()->route('admin.rute.index')->with('success', 'Rute berhasil dihapus!');
    }

    public function toggleStatus(Rute $rute)
    {
        $rute->update(['is_active' => !$rute->is_active]);
        return back()->with('success', 'Status rute berhasil diubah!');
    }
}
