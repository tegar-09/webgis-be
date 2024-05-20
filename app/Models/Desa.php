<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Desa extends Model
{
    use HasFactory;

    // Tentukan nama tabel jika tidak sesuai konvensi laravel
    protected $table = 'tb_desa';

    // Tentukan kolom yang bisa diisi (mass assignable)
    protected $fillable = [
        'id_kecamatan',
        'nama_desa',
    ];

    // Relasi: satu desa belongs to satu kecamatan
    public function kecamatan()
    {
        return $this->belongsTo(Kecamatan::class, 'id_kecamatan');
    }
}
