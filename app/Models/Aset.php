<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Aset extends Model
{
    use HasFactory;
    public const ASET = 'aset';
    public const KENDARAAN_DINAS = 'kendaraanDinas';
    protected $table = 'tb_aset';
    protected $primaryKey = 'id';
    protected $guarded = [
        'created_at',
        'updated_at'
    ];

    public static function getUniqueAssets()
    {
        return self::select('nama', 'kode', 'merk', DB::raw('MAX(id) as id'))
        ->groupBy('nama', 'kode', 'merk')
        ->get();
    }

    public function ruangan()
    {
        return $this->belongsTo(Ruangan::class, 'ruangan_id');
    }

    public function pegawai()
    {
        return $this->belongsTo(Pegawai::class, 'pegawai_id');
    }
}
