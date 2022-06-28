<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pangkat extends Model
{
    use HasFactory;
    protected $table = 'tb_pangkat';
    protected $primaryKey = 'id_pangkat';
    protected $fillable = [
        'nama_pangkat',
        'golongan',
        'gaji_pokok',
        'potongan',
    ];
}
