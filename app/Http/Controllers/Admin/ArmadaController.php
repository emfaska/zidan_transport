<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Armada;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ArmadaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->input('search');
        
        $armadas = Armada::when($search, function ($query, $search) {
            return $query->where('nama', 'like', "%{$search}%")
                         ->orWhere('plat_nomor', 'like', "%{$search}%")
                         ->orWhere('jenis', 'like', "%{$search}%");
        })->latest()->get();
        
        return view('admin.armada.index', compact('armadas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.armada.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'jenis' => 'required|string|max:255',
            'bbm' => 'required|string|max:50',
            'kapasitas' => 'required|integer|min:1',
            'tahun' => 'nullable|integer|min:1900|max:'.(date('Y')+1),
            'plat_nomor' => 'required|string|max:20|unique:armadas,plat_nomor',
            'status' => 'required|in:tersedia,maintenance,terpakai',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'spesifikasi' => 'nullable|string',
        ]);

        $data = $request->except(['foto']);

        if ($request->hasFile('foto')) {
            $data['foto'] = $request->file('foto')->store('armada', 'public');
        }

        Armada::create($data);

        return redirect()->route('admin.armada.index')->with('success', 'Armada berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Armada $armada)
    {
        return view('admin.armada.show', compact('armada'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Armada $armada)
    {
        return view('admin.armada.edit', compact('armada'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Armada $armada)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'jenis' => 'required|string|max:255',
            'bbm' => 'required|string|max:50',
            'kapasitas' => 'required|integer|min:1',
            'tahun' => 'nullable|integer|min:1900|max:'.(date('Y')+1),
            'plat_nomor' => 'required|string|max:20|unique:armadas,plat_nomor,'.$armada->id,
            'status' => 'required|in:tersedia,maintenance,terpakai',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'spesifikasi' => 'nullable|string',
        ]);

        $data = $request->except(['foto']);

        if ($request->hasFile('foto')) {
            // Delete old photo if exists
            if ($armada->foto) {
                Storage::disk('public')->delete($armada->foto);
            }
            $data['foto'] = $request->file('foto')->store('armada', 'public');
        }

        $armada->update($data);

        return redirect()->route('admin.armada.index')->with('success', 'Armada berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Armada $armada)
    {
        if ($armada->foto) {
            Storage::disk('public')->delete($armada->foto);
        }
        
        $armada->delete();

        return redirect()->route('admin.armada.index')->with('success', 'Armada berhasil dihapus!');
    }
}
