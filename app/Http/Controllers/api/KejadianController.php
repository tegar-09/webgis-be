<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Kejadian;
use App\Models\FotoKejadian;

class KejadianController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    // public function index()
    // {
    //     // Mengambil semua data kejadian
    //     $kejadian = Kejadian::all();
    //     return response()->json($kejadian);
    // }

    public function index()
    {
        $kejadian = Kejadian::all();
        return response()->json(['data' => $kejadian]);
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request);
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
            'id_users' => 'required|exists:users,id',
            'nama_file' => 'required|string',
        ]);

        // Simpan data kejadian
        $kejadian = new Kejadian();
        $kejadian->jenis_bencana = $request->jenis_bencana;
        $kejadian->nama_kejadian = $request->nama_kejadian;
        $kejadian->tanggal_kejadian = $request->tanggal_kejadian;
        $kejadian->waktu_kejadian = $request->waktu_kejadian;
        $kejadian->alamat_kejadian = $request->alamat_kejadian;
        $kejadian->id_kecamatan = $request->id_kecamatan;
        $kejadian->id_desa = $request->id_desa;
        $kejadian->penyebab_kejadian = $request->penyebab_kejadian;
        $kejadian->kronologi = $request->kronologi;
        $kejadian->ketinggian_air = $request->ketinggian_air;
        $kejadian->latitude = $request->latitude;
        $kejadian->longitude = $request->longitude;
        $kejadian->id_users = $request->id_users;
        $kejadian->save();

        // Simpan data foto kejadian
        $fotoKejadian = new FotoKejadian();
        $fotoKejadian->id_kejadian = $kejadian->id;
        $fotoKejadian->nama_file = $request->nama_file;
        $fotoKejadian->save();

        return response()->json(['message' => 'Kejadian inserted successfully'], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        // Cari kejadian berdasarkan ID
        $kejadian = Kejadian::find($id);

        if (!$kejadian) {
            return response()->json(['message' => 'Kejadian not found'], 404);
        }

        // Ambil data foto kejadian
        $fotoKejadian = FotoKejadian::where('id_kejadian', $kejadian->id)->first();

        return response()->json(['kejadian' => $kejadian, 'fotoKejadian' => $fotoKejadian], 200);
    }

    /**
     * Update the specified resource in storage.
     */
   public function update(Request $request, string $id)
    {
        // Validasi data input
        $request->validate([
            'jenis_bencana' => 'string|max:255|nullable',
            'nama_kejadian' => 'string|max:255|nullable',
            'tanggal_kejadian' => 'date|nullable',
            'waktu_kejadian' => 'date_format:H:i:s|nullable',
            'alamat_kejadian' => 'string|max:255|nullable',
            'id_kecamatan' => 'string|exists:tb_kecamatan,id|nullable',
            'id_desa' => 'string|exists:tb_desa,id|nullable',
            'penyebab_kejadian' => 'string|max:255|nullable',
            'kronologi' => 'string|nullable',
            'ketinggian_air' => 'integer|nullable',
            'latitude' => 'numeric|nullable',
            'longitude' => 'numeric|nullable',
            'id_users' => 'string|exists:users,id|nullable',
            'nama_file' => 'string|nullable',
        ]);

        // Update data kejadian
        $kejadian = Kejadian::findOrFail($id);

        $kejadian->jenis_bencana = $request->jenis_bencana ?? $kejadian->jenis_bencana;
        $kejadian->nama_kejadian = $request->nama_kejadian ?? $kejadian->nama_kejadian;
        $kejadian->tanggal_kejadian = $request->tanggal_kejadian ?? $kejadian->tanggal_kejadian;
        $kejadian->waktu_kejadian = $request->waktu_kejadian ?? $kejadian->waktu_kejadian;
        $kejadian->alamat_kejadian = $request->alamat_kejadian ?? $kejadian->alamat_kejadian;
        $kejadian->id_kecamatan = $request->id_kecamatan ?? $kejadian->id_kecamatan;
        $kejadian->id_desa = $request->id_desa ?? $kejadian->id_desa;
        $kejadian->penyebab_kejadian = $request->penyebab_kejadian ?? $kejadian->penyebab_kejadian;
        $kejadian->kronologi = $request->kronologi ?? $kejadian->kronologi;
        $kejadian->ketinggian_air = $request->ketinggian_air ?? $kejadian->ketinggian_air;
        $kejadian->latitude = $request->latitude ?? $kejadian->latitude;
        $kejadian->longitude = $request->longitude ?? $kejadian->longitude;
        $kejadian->id_users = $request->id_users ?? $kejadian->id_users;
        
        $kejadian->save();

        // Update data foto kejadian jika ada dan tidak null
        if ($request->filled('nama_file')) {
            $fotoKejadian = FotoKejadian::where('id_kejadian', $kejadian->id)->first();
            if ($fotoKejadian) {
                $fotoKejadian->nama_file = $request->nama_file;
                $fotoKejadian->save();
            } else {
                $fotoKejadian = new FotoKejadian();
                $fotoKejadian->id_kejadian = $kejadian->id;
                $fotoKejadian->nama_file = $request->nama_file;
                $fotoKejadian->save();
            }
        }

        return response()->json(['message' => 'Kejadian updated successfully'], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        // Cari kejadian berdasarkan ID
        $kejadian = Kejadian::find($id);

        if (!$kejadian) {
            return response()->json(['message' => 'Kejadian not found'], 404);
        }

        // Hapus foto kejadian
        FotoKejadian::where('id_kejadian', $kejadian->id)->delete();

        // Hapus kejadian
        $kejadian->delete();

        return response()->json(['message' => 'Kejadian deleted successfully'], 200);
    }

}
