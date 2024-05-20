<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kecamatan extends Model
{
    use HasFactory;

    // Tentukan nama tabel jika tidak sesuai konvensi laravel
    protected $table = 'tb_kecamatan';

    // Tentukan kolom yang bisa diisi (mass assignable)
    protected $fillable = [
        'nama_kecamatan',
    ];

    // Jika ada relasi dengan model lain, tambahkan disini
    // Contoh: satu kecamatan memiliki banyak desa
    public function desa()
    {
        return $this->hasMany(Desa::class, 'id_kecamatan');
    }
}

