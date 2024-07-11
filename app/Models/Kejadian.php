<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kejadian extends Model
{
    use HasFactory;

    // Tentukan nama tabel jika tidak sesuai konvensi laravel
    protected $table = 'tb_kejadian';

    // Tentukan kolom yang bisa diisi (mass assignable)
    protected $fillable = [
        'jenis_bencana',
        'nama_kejadian',
        'tanggal_kejadian',
        'waktu_kejadian',
        'alamat_kejadian',
        'id_kecamatan',
        'id_desa',
        'penyebab_kejadian',
        'kronologi',
        'ketinggian_air',
        'latitude',
        'longitude',
        'id_users'
    ];

    // Relasi: satu kejadian belongs to satu kecamatan
    public function kecamatan()
    {
        return $this->belongsTo(Kecamatan::class, 'id_kecamatan');
    }

    // Relasi: satu kejadian belongs to satu desa
    public function desa()
    {
        return $this->belongsTo(Desa::class, 'id_desa');
    }

    // Relasi: satu kejadian belongs to satu user (pelapor)
    public function user()
    {
        return $this->belongsTo(User::class, 'id_users');
    }

    // Relasi: satu kejadian has many to banyak foto
    public function fotoKejadian()
    {
        return $this->hasMany(FotoKejadian::class, 'id_kejadian');
    }

    // Relasi: satu kejadian has many to banyak foto
    public function penanganan()
    {
        return $this->hasMany(Penanganan::class, 'id_kejadian');
    }

    // Relasi: satu kejadian has many to banyak foto
    public function korban()
    {
        return $this->hasMany(Korban::class, 'id_kejadian');
    }

    // Relasi: satu kejadian has many to banyak foto
    public function Keterangan()
    {
        return $this->hasMany(Keterangan::class, 'id_kejadian');
    }
}