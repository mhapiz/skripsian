<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BarangMasuk extends Model
{
    use HasFactory;
    protected $table = 'tb_barang_masuk';
    protected $primaryKey = 'id_barang_masuk';
    protected $fillable = [
        'tanggal',
        'suplier_id',
        'total_harga',
        'addedToInventaris',
    ];

    public function suplier()
    {
        return $this->belongsTo(Suplier::class, 'suplier_id', 'id_suplier');
    }

    public function detail_barang_masuk()
    {
        return $this->hasMany(DetailBarangMasuk::class, 'barang_masuk_id', 'id_barang_masuk');
    }
}
