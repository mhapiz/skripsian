<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Suplier extends Model
{
    use HasFactory;
    protected $table = 'tb_suplier';
    protected $primaryKey = 'id_suplier';
    protected $fillable = [
        'nama_suplier',
        'kota',
        'alamat',
        'no_telp',
    ];
}
