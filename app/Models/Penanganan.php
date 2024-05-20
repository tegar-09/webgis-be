<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penanganan extends Model
{
    use HasFactory;

    // Tentukan nama tabel jika tidak sesuai konvensi Laravel
    protected $table = 'tb_penanganan';

    // Tentukan kolom yang bisa diisi (mass assignable)
    protected $fillable = [
        'id_kejadian',
        'penanganan',
    ];

    // Relasi: satu penanganan belongs to satu kejadian
    public function kejadian()
    {
        return $this->belongsTo(Kejadian::class, 'id_kejadian');
    }
}
