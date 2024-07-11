<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FotoKejadian extends Model
{
    use HasFactory;

    protected $table = 'tb_foto_kejadian';

    protected $fillable = [
        'id_kejadian',
        'nama_file',
    ];

    public function kejadian()
    {
        return $this->belongsTo(Kejadian::class, 'id_kejadian');
    }
}
