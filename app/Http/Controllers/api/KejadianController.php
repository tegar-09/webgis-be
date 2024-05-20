<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Kejadian;

class KejadianController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Mengambil semua data kejadian
        $kejadians = Kejadian::all();
        return response()->json($kejadians);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'jenis_bencana' => 'required|string|max:255',
            'nama_kejadian' => 'required|string|max:255',
            'tanggal_kejadian' => 'required|date',
            'waktu_kejadian' => 'required|date_format:H:i:s',
            'alamat_kejadian' => 'required|string|max:255',
            'id_kecamatan' => 'required|exists:tb_kecamatan,id',
            'id_desa' => 'required|exists:tb_desa,id',
            'penyebab_kejadian' => 'required|string|max:255',
            'kronologi' => 'required|string',
            'ketinggian_air' => 'required|integer',
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
            'id_users' => 'required|exists:tb_users,id',
        ]);

        // Membuat kejadian baru
        $kejadian = Kejadian::create($request->all());

        return response()->json($kejadian, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // Mencari kejadian berdasarkan ID
        $kejadian = Kejadian::find($id);

        if (!$kejadian) {
            return response()->json(['message' => 'Kejadian not found'], 404);
        }

        return response()->json($kejadian);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Validasi input
        $request->validate([
            'jenis_bencana' => 'sometimes|required|string|max:255',
            'nama_kejadian' => 'sometimes|required|string|max:255',
            'tanggal_kejadian' => 'sometimes|required|date',
            'waktu_kejadian' => 'sometimes|required|date_format:H:i:s',
            'alamat_kejadian' => 'sometimes|required|string|max:255',
            'id_kecamatan' => 'sometimes|required|exists:tb_kecamatan,id',
            'id_desa' => 'sometimes|required|exists:tb_desa,id',
            'penyebab_kejadian' => 'sometimes|required|string|max:255',
            'kronologi' => 'sometimes|required|string',
            'ketinggian_air' => 'sometimes|required|integer',
            'latitude' => 'sometimes|required|numeric',
            'longitude' => 'sometimes|required|numeric',
            'id_users' => 'sometimes|required|exists:tb_users,id',
        ]);

        // Mencari kejadian berdasarkan ID
        $kejadian = Kejadian::find($id);

        if (!$kejadian) {
            return response()->json(['message' => 'Kejadian not found'], 404);
        }

        // Memperbarui kejadian
        $kejadian->update($request->all());

        return response()->json($kejadian);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // Mencari kejadian berdasarkan ID
        $kejadian = Kejadian::find($id);

        if (!$kejadian) {
            return response()->json(['message' => 'Kejadian not found'], 404);
        }

        // Menghapus kejadian
        $kejadian->delete();

        return response()->json(['message' => 'Kejadian deleted successfully']);
    }
}
