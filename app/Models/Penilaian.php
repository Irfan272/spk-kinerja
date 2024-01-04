<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penilaian extends Model
{
    use HasFactory;

    protected $table = 'penilaians';
    
    protected $fillable = [
        'id_pegawai',
        'tanggal_penilaian',
        'id_kriteria1',
        'id_kriteria2',
        'id_kriteria3',
        'id_kriteria4',
        'id_kriteria5',
        'id_kriteria6',
    ];

    
    public function Pegawai(){
        return $this->belongsTo(Pegawai::class, 'id_pegawai');
    }
    public function Kriteria1(){
        return $this->belongsTo(Kriteria::class, 'id_kriteria1');
    }
    public function Kriteria2(){
        return $this->belongsTo(Kriteria::class, 'id_kriteria2');
    }

    public function Kriteria3(){
        return $this->belongsTo(Kriteria::class, 'id_kriteria3');
    }
    public function Kriteria4(){
        return $this->belongsTo(Kriteria::class, 'id_kriteria4');
    }

    public function Kriteria5(){
        return $this->belongsTo(Kriteria::class, 'id_kriteria5');
    }
    
    public function Kriteria6(){
        return $this->belongsTo(Kriteria::class, 'id_kriteria6');
    }

}
