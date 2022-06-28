<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SerahTerima extends Model
{
    use HasFactory;
    protected $table = 'tb_serah_terima';
    protected $primaryKey = 'id_serah_terima';
    protected $fillable = [
        'no_serah_terima',
        'tanggal_serah_terima',
        'ruangan_id',
    ];

    public function ruangan()
    {
        return $this->belongsTo(Ruangan::class, 'ruangan_id', 'id_ruangan');
    }

    public function detail()
    {
        return $this->hasMany(DetailSerahTerima::class, 'serah_terima_id', 'id_serah_terima');
    }
}
