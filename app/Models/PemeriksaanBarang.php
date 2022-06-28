<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PemeriksaanBarang extends Model
{
    use HasFactory;
    protected $table = 'tb_pemeriksaan_barang';
    protected $primaryKey = 'id_pemeriksaan_barang';
    protected $fillable = [
        'no_pemeriksaan',
        'tanggal_pemeriksaan',
        'barang_masuk_id',
        'pemeriksa_1',
        'pemeriksa_2',
        'pemeriksa_3',
    ];

    public function barangMasuk()
    {
        return $this->belongsTo(BarangMasuk::class, 'barang_masuk_id', 'id_barang_masuk');
    }
}
