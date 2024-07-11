<?php

namespace App\Http\Controllers\api;

use App\Models\Korban;
use App\Models\Keterangan;
use App\Models\Penanganan;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PenangananController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    // public function index()
    // {
    //   // Mengambil semua data kejadian
    //   $penanganan = Penanganan::all();
    //   return response()->json($penanganan);
    // }

    public function index()
    {
        // Mengambil semua data penanganan beserta data korban dan keterangan
        $penanganan = Penanganan::with('korban', 'keterangan')->get();

        // Pastikan untuk mengecek apakah data ditemukan atau tidak
        if ($penanganan->isEmpty()) {
            return response()->json(['message' => 'Data not found'], 404);
        }

        // Mengembalikan response JSON dengan data yang telah digabung
        return response()->json($penanganan);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validasi data input
        $request->validate([
            'id_kejadian' => 'required|exists:tb_kejadian,id',
            'penanganan' => 'required|array',
            'penanganan.*' => 'required|string',
            'hilang' => 'integer|nullable',
            'terluka' => 'integer|nullable',
            'meninggal' => 'integer|nullable',
            'dampak' => 'required|string',
            'unsur_terlibat' => 'required|string',
        ]);

        // Simpan data penanganan
        foreach ($request->penanganan as $penangananDetail) {
            $penanganan = new Penanganan();
            $penanganan->id_kejadian = $request->id_kejadian;
            $penanganan->penanganan = $penangananDetail;
            $penanganan->save();
        }

        // Simpan data korban
        $korban = new Korban();
        $korban->id_kejadian = $request->id_kejadian;
        $korban->hilang = $request->hilang;
        $korban->terluka = $request->terluka;
        $korban->meninggal = $request->meninggal;
        $korban->save();

        // Simpan data keterangan
        $keterangan = new Keterangan();
        $keterangan->id_kejadian = $request->id_kejadian;
        $keterangan->dampak = $request->dampak;
        $keterangan->unsur_terlibat = $request->unsur_terlibat;
        $keterangan->save();

        return response()->json(['message' => 'Tanggap Bencana inserted successfully'], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        // Cari data berdasarkan ID dari masing-masing tabel
        $penanganan = Penanganan::find($id);
        $korban = Korban::find($id);
        $keterangan = Keterangan::find($id);

        // Buat array untuk menyimpan hasil
        $result = [];

        // Tambahkan data ke array hasil jika ditemukan
        if ($penanganan) {
            $result['penanganan'] = $penanganan;
        }
        if ($korban) {
            $result['korban'] = $korban;
        }
        if ($keterangan) {
            $result['keterangan'] = $keterangan;
        }

        // Periksa apakah ada data yang ditemukan
        if (!empty($result)) {
            return response()->json($result, 200);
        } else {
            return response()->json(['message' => 'Data not found'], 404);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        // Validasi data input
        $request->validate([
            'penanganan' => 'string|nullable',
            'hilang' => 'integer|nullable',
            'terluka' => 'integer|nullable',
            'meninggal' => 'integer|nullable',
            'dampak' => 'string|nullable',
            'unsur_terlibat' => 'string|nullable',
        ]);

        // Update data penanganan
        $penanganan = Penanganan::where('id_kejadian', $id)->firstOrFail();
        $penangananData = array_filter($request->only(['penanganan']));
        $penanganan->update($penangananData);

        // Update data korban
        $korban = Korban::where('id_kejadian', $id)->firstOrFail();
        $korbanData = array_filter($request->only(['hilang', 'terluka', 'meninggal']));
        $korban->update($korbanData);

        // Update data keterangan
        $keterangan = Keterangan::where('id_kejadian', $id)->firstOrFail();
        $keteranganData = array_filter($request->only(['dampak', 'unsur_terlibat']));
        $keterangan->update($keteranganData);

        return response()->json(['message' => 'Tanggap Bencana updated successfully'], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        // Cari data berdasarkan ID dari masing-masing tabel
        $penanganan = Penanganan::find($id);
        $korban = Korban::find($id);
        $keterangan = Keterangan::find($id);
    
        // Cek apakah data ditemukan di salah satu tabel
        if ($penanganan || $korban || $keterangan) {
            // Hapus data jika ditemukan
            if ($penanganan) {
                $penanganan->delete();
            }
            if ($korban) {
                $korban->delete();
            }
            if ($keterangan) {
                $keterangan->delete();
            }
    
            return response()->json(['message' => 'Tanggap Bencana deleted successfully'], 200);
        } else {
            return response()->json(['message' => 'Data not found'], 404);
        }
    }    
}
