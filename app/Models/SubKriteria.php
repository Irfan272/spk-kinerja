<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubKriteria extends Model
{
    use HasFactory;

    protected $table = 'sub_kriterias';

    protected $fillable = [
        'id_kriteria',
        'nama_subkriteria',
        'nilai',
    ];

    public function Kriteria(){
        return $this->belongsTo(Kriteria::class, 'id_kriteria');
    }
}
