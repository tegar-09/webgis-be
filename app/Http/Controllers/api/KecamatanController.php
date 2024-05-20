<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Kecamatan;

class KecamatanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Mengambil semua data kecamatan
        $kecamatan = Kecamatan::all();
        return response()->json($kecamatan);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'nama_kecamatan' => 'required|string|max:255',
        ]);

        // Membuat kecamatan baru
        $kecamatan = Kecamatan::create($request->all());

        return response()->json($kecamatan, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // Mencari kecamatan berdasarkan ID
        $kecamatan = Kecamatan::find($id);

        if (!$kecamatan) {
            return response()->json(['message' => 'Kecamatan not found'], 404);
        }

        return response()->json($kecamatan);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Validasi input
        $request->validate([
            'nama_kecamatan' => 'sometimes|required|string|max:255',
        ]);

        // Mencari kecamatan berdasarkan ID
        $kecamatan = Kecamatan::find($id);

        if (!$kecamatan) {
            return response()->json(['message' => 'Kecamatan not found'], 404);
        }

        // Memperbarui kecamatan
        $kecamatan->update($request->all());

        return response()->json($kecamatan);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // Mencari kecamatan berdasarkan ID
        $kecamatan = Kecamatan::find($id);

        if (!$kecamatan) {
            return response()->json(['message' => 'Kecamatan not found'], 404);
        }

        // Menghapus kecamatan
        $kecamatan->delete();

        return response()->json(['message' => 'Kecamatan deleted successfully']);
    }
}
