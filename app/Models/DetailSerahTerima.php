<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailSerahTerima extends Model
{
    use HasFactory;
    protected $table = 'tb_detail_serah_terima';
    protected $primaryKey = 'id_detail_serah_terima';
    protected $fillable = [
        'serah_terima_id',
        'barang_id',
        'jumlah',
    ];
}
