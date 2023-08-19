<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inventaris extends Model
{
    use HasFactory;
    protected $table = 'tb_inventaris';
    protected $primaryKey = 'id_inventaris';
    protected $fillable = [
        'barang_id',
        'register',
        'kondisi',
        'ruangan_id',
        'tahun_masuk',
        'jenis_kepemilikan',
        'pegawai_id'
    ];

    public function barang()
    {
        return $this->belongsTo(Barang::class, 'barang_id');
    }

    public function ruangan()
    {
        return $this->belongsTo(Ruangan::class, 'ruangan_id');
    }
}
