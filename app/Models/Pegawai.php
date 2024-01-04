<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pegawai extends Model
{
    use HasFactory;

    protected $table = 'pegawais';

    protected $fillable = [
        'kd_pegawai',
        'nama_pegawai',
    ];

    public function Penilaian(){
        return $this->hasOne(Penilaian::class);
    }
}
