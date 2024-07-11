<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Korban extends Model
{
    use HasFactory;

    // Tentukan nama tabel yang sesuai
    protected $table = 'tb_korban';

    // Tentukan kolom-kolom yang dapat diisi
    protected $fillable = [
        'id_kejadian',
        'hilang',
        'terluka',
        'meninggal',
    ];

    // Relasi dengan model Kejadian
    public function kejadian()
    {
        return $this->belongsTo(Kejadian::class, 'id_kejadian');
    }
}
