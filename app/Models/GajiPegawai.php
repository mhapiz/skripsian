<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GajiPegawai extends Model
{
    use HasFactory;
    protected $table = 'tb_gaji_pegawai';
    protected $primaryKey = 'id_gaji_pegawai';
    protected $fillable = [
        'pegawai_id',
        'bulan',
        'tahun',
        'total_gaji',
    ];

    public function pegawai()
    {
        return $this->belongsTo(Pegawai::class, 'pegawai_id', 'id_pegawai');
    }
}
