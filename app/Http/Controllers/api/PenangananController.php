<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Penanganan;

class PenangananController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Mengambil semua data penanganan
        $penanganans = Penanganan::all();
        return response()->json($penanganans);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'id_kejadian' => 'required|exists:tb_kejadian,id',
            'penanganan' => 'required|string|max:255',
        ]);

        // Membuat penanganan baru
        $penanganan = Penanganan::create($request->all());

        return response()->json($penanganan, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // Mencari penanganan berdasarkan ID
        $penanganan = Penanganan::find($id);

        if (!$penanganan) {
            return response()->json(['message' => 'Penanganan not found'], 404);
        }

        return response()->json($penanganan);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Validasi input
        $request->validate([
            'id_kejadian' => 'sometimes|required|exists:tb_kejadian,id',
            'penanganan' => 'sometimes|required|string|max:255',
        ]);

        // Mencari penanganan berdasarkan ID
        $penanganan = Penanganan::find($id);

        if (!$penanganan) {
            return response()->json(['message' => 'Penanganan not found'], 404);
        }

        // Memperbarui penanganan
        $penanganan->update($request->all());

        return response()->json($penanganan);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // Mencari penanganan berdasarkan ID
        $penanganan = Penanganan::find($id);

        if (!$penanganan) {
            return response()->json(['message' => 'Penanganan not found'], 404);
        }

        // Menghapus penanganan
        $penanganan->delete();

        return response()->json(['message' => 'Penanganan deleted successfully']);
    }
}
