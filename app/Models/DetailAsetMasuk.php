<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailAsetMasuk extends Model
{
    use HasFactory;
    protected $table = 'tb_detail_aset_masuk';
    protected $primaryKey = 'id_detail_aset_masuk';
    protected $fillable = [
        'aset_masuk_id',
        'nama_aset',
        'kode_aset',
        'jumlah_masuk',
        'harga_satuan',
    ];

    public function aset_masuk()
    {
        return $this->belongsTo(AsetMasuk::class, 'aset_masuk_id', 'id_aset_masuk');
    }

    public function barang()
    {
        return $this->belongsTo(Barang::class, 'barang_id', 'id_barang');
    }
}
