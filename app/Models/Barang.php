<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    use HasFactory;
    protected $table = 'tb_barang';
    protected $primaryKey = 'id_barang';
    protected $fillable = [
        'nama_barang',
        'kode_barang',
        'merk',
        'foto_path',
    ];
}
