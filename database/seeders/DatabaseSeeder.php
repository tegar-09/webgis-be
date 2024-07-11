<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(RolePermissionSeeder::class);
        
        // Buat pengguna admin
        $admin = User::create([
            'username' => 'admin',
            'password' => Hash::make('password123'), // Ganti dengan password yang kuat
            'nik' => '1234567890123456',
            'nama_asli' => 'Admin User',
            'alamat' => 'Alamat Admin',
            'lembaga' => 'Lembaga Admin',
            'no_telp' => '081234567890',
        ]);

        // Assign role admin ke pengguna tersebut
        $admin->assignRole('admin');
    }
}
