<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ruangan extends Model
{
    use HasFactory;
    protected $table = 'tb_ruangan';
    protected $primaryKey = 'id_ruangan';
    protected $fillable = ['nama_ruangan', 'pegawai_id'];

    public function pegawai()
    {
        return $this->belongsTo(Pegawai::class, 'pegawai_id', 'id_pegawai');
    }

    public function inventaris()
    {
        return $this->hasMany(Inventaris::class, 'ruangan_id', 'id_ruangan');
    }
}
