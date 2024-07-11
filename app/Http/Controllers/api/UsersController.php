<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Mengambil semua pengguna
        $users = User::all();
        return response()->json(['data' => $users]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        dd($request->all());
        // Validasi data input
        $request->validate([
            'username' => 'required|string|unique:users,username',
            'password' => 'required|string|min:6',
            'nik' => 'required|string|unique:users,nik',
            'nama_asli' => 'required|string',
            'alamat' => 'required|string',
            'lembaga' => 'required|string',
            'no_telp' => 'required|string',
            'role' => 'required|string|exists:roles,name', // Validasi role
        ]);

        // Membuat pengguna baru
        $user = new User([
            'username' => $request->username,
            'password' => Hash::make($request->password),
            'nik' => $request->nik,
            'nama_asli' => $request->nama_asli,
            'alamat' => $request->alamat,
            'lembaga' => $request->lembaga,
            'no_telp' => $request->no_telp,
        ]);

        $user->save();
        $user->assignRole([$request->role]);

        return response()->json(['message' => 'User inserted successfully'], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // Menampilkan detail pengguna berdasarkan ID
        $user = User::findOrFail($id);
        return response()->json($user);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Validasi data input
        $request->validate([
            'username' => 'string|unique:users,username,' . $id,
            'password' => 'string|min:6|nullable',
            'nik' => 'string|unique:users,nik,' . $id,
            'nama_asli' => 'string|nullable',
            'alamat' => 'string|nullable',
            'lembaga' => 'string|nullable',
            'no_telp' => 'string|nullable',
            'role' => 'string|exists:roles,name|nullable', // Validasi role
        ]);

        // Update data pengguna
        $user = User::findOrFail($id);

        $user->username = $request->username ?? $user->username;
        if ($request->password) {
            $user->password = Hash::make($request->password);
        }
        $user->nik = $request->nik ?? $user->nik;
        $user->nama_asli = $request->nama_asli ?? $user->nama_asli;
        $user->alamat = $request->alamat ?? $user->alamat;
        $user->lembaga = $request->lembaga ?? $user->lembaga;
        $user->no_telp = $request->no_telp ?? $user->no_telp;

        if ($request->role) {
            $user->syncRoles([$request->role]); // Sync roles to remove old roles and add new role
        }

        $user->save();

        return response()->json(['message' => 'User updated successfully'], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // Menghapus pengguna berdasarkan ID
        $user = User::findOrFail($id);
        $user->delete();

        return response()->json(['message' => 'User deleted successfully'], 200);
    }
}
