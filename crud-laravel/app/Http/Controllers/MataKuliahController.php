<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MataKuliah;

class MataKuliahController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'nama_matkul' => 'required|string|max:100'
        ]);

        MataKuliah::create([
            'nama_matkul' => $request->nama_matkul,
        ]);

        return redirect()->route('dashboard')->with('success', 'Mata kuliah berhasil ditambahkan!');
    }
    public function destroy($id)
    {
    $matkul = MataKuliah::findOrFail($id);
    $matkul->delete();

    return redirect()->route('dashboard')->with('success', 'Mata kuliah berhasil dihapus.');
}
}
