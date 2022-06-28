<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AsetMasuk extends Model
{
    use HasFactory;
    protected $table = 'tb_aset_masuk';
    protected $primaryKey = 'id_aset_masuk';
    protected $fillable = [
        'nomor',
        'tanggal',
        'suplier_id',
        'total_harga',
    ];

    public function suplier()
    {
        return $this->belongsTo(Suplier::class, 'suplier_id', 'id_suplier');
    }

    public function detail_aset_masuk()
    {
        return $this->hasMany(DetailAsetMasuk::class, 'aset_masuk_id', 'id_aset_masuk');
    }
}
