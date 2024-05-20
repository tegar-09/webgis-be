<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Desa;

class DesaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Mengambil semua data desa
        $desas = Desa::all();
        return response()->json($desas);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'id_kecamatan' => 'required|exists:tb_kecamatan,id',
            'nama_desa' => 'required|string|max:255',
        ]);

        // Membuat desa baru
        $desa = Desa::create($request->all());

        return response()->json($desa, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // Mencari desa berdasarkan ID
        $desa = Desa::find($id);

        if (!$desa) {
            return response()->json(['message' => 'Desa not found'], 404);
        }

        return response()->json($desa);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Validasi input
        $request->validate([
            'id_kecamatan' => 'sometimes|required|exists:tb_kecamatan,id',
            'nama_desa' => 'sometimes|required|string|max:255',
        ]);

        // Mencari desa berdasarkan ID
        $desa = Desa::find($id);

        if (!$desa) {
            return response()->json(['message' => 'Desa not found'], 404);
        }

        // Memperbarui desa
        $desa->update($request->all());

        return response()->json($desa);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // Mencari desa berdasarkan ID
        $desa = Desa::find($id);

        if (!$desa) {
            return response()->json(['message' => 'Desa not found'], 404);
        }

        // Menghapus desa
        $desa->delete();

        return response()->json(['message' => 'Desa deleted successfully']);
    }
}