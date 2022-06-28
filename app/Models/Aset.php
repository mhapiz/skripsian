<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Aset extends Model
{
    use HasFactory;
    protected $table = 'tb_aset';
    protected $primaryKey = 'id_aset';
    protected $fillable = [
        'nama_aset',
        'kode_aset',
        'keterangan',
        'register',
        'kondisi',
        'harga_beli',
        'tahun_masuk',
    ];
}
