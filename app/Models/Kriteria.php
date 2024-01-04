<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kriteria extends Model
{
    use HasFactory;

    protected $table = 'kriterias';

    protected $fillable = [
        'kd_kriteria',
        'nama_kriteria',
        'bobot',
        'normalisasi',
        'jenis_kriteria', 
    ];

    public function SubKriteria(){
        return $this->hasMany(SubKriteria::class, 'id_kriteria');
    }

    public function Penilaian(){
        return $this->hasOne(SubKriteria::class);
    }
}
