<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailBarangMasuk extends Model
{
    use HasFactory;
    protected $table = 'tb_detail_barang_masuk';
    protected $primaryKey = 'id_detail_barang_masuk';
    protected $fillable = [
        'barang_masuk_id',
        'barang_id',
        'jumlah_masuk',
        'harga_satuan',
    ];

    public function barang_masuk()
    {
        return $this->belongsTo(BarangMasuk::class, 'barang_masuk_id', 'id_barang_masuk');
    }

    public function barang()
    {
        return $this->belongsTo(Barang::class, 'barang_id', 'id_barang');
    }
}
