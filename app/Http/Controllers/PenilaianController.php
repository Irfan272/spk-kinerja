<?php

namespace App\Http\Controllers;

use App\Models\Kriteria;
use App\Models\Pegawai;
use App\Models\Penilaian;
use Illuminate\Http\Request;

class PenilaianController extends Controller
{
    public function index(){
        $penilaian = Penilaian::with('pegawai', 'Kriteria1', 'Kriteria2', 'Kriteria3', 'Kriteria4', 'Kriteria5', 'Kriteria6')->get();
        return view('Admin.penilaian.index', compact('penilaian'));
    }

    public function create(){
        $pegawai = Pegawai::all();
        $kriteria = Kriteria::with('SubKriteria')
        ->whereIn('kd_kriteria', ['C4'])
        ->get();

        return view('Admin.penilaian.create', compact('pegawai', 'kriteria'));
    }

    public function store(Request $request){
        $penilaian = new Penilaian();

        $penilaian->id_pegawai = $request->input('id_pegawai');
        $penilaian->tanggal_penilaian = $request->input('tanggal_penilaian');

        $kriteria = Kriteria::all();
        foreach($kriteria as $kriteria){
            $nilai_kriteria = 'nilai_kriteria' . $kriteria->id;
            $penilaian->{'id_kriteria' . $kriteria->id} = $request->input($nilai_kriteria);
        }
        $penilaian->save();

        return redirect('/admin/penilaian');
    }



    public function edit($id){
        $pegawai = Pegawai::all();
        $kriteria = Kriteria::with('SubKriteria')
        ->whereIn('kd_kriteria', ['C4'])
        ->get();
        $penilaian = Penilaian::where('id', $id)->get();
        return view('Admin.penilaian.edit', compact('pegawai', 'kriteria', 'penilaian'));
    }

    public function update(Request $request, $id){


        $penilaian = Penilaian::findOrFail($id);

        if (!$penilaian) {
            return redirect('/admin/penilaian')->with('error', 'Data penilaian tidak ditemukan.');
        }
    
        $penilaian->id_pegawai = $request->input('id_pegawai');
        $penilaian->tanggal_penilaian = $request->input('tanggal_penilaian');
    
        $kriteria = Kriteria::all();
        foreach ($kriteria as $kriteriaItem) {
            if ($kriteriaItem->kd_kriteria === 'C1') {
                continue;
            }

            if ($kriteriaItem->kd_kriteria === 'C2') {
                continue;
            }

            if ($kriteriaItem->kd_kriteria === 'C3') {
                continue;
            }

            if ($kriteriaItem->kd_kriteria === 'C5') {
                continue;
            }

            if ($kriteriaItem->kd_kriteria === 'C6') {
                continue;
            }

            $nilaiKriteria = 'nilai_kriteria' . $kriteriaItem->id;
            $penilaian->{'id_kriteria' . $kriteriaItem->id} = $request->input($nilaiKriteria);
        }
        
        $penilaian->save();
 

        return redirect('/admin/penilaian');
    }

    public function delete($id){
        Penilaian::destroy($id);

        return back();
    }


    public function calculateUtilityForPenilaian($penilaian)
    {
        $utilities = [];
        $kriteria = Kriteria::all();

        foreach ($kriteria as $kriteria) {
            $nilai_kriteria = $penilaian->{'id_kriteria' . $kriteria->id};
            $subkriteria = $kriteria->SubKriteria->firstWhere('nilai', $nilai_kriteria);

            if ($subkriteria) {
                $c_out = $subkriteria->nilai;
                $c_min = $kriteria->SubKriteria->min('nilai');
                $c_max = $kriteria->SubKriteria->max('nilai');
                $jenis_kategori = $kriteria->jenis_kriteria;

                $nilai_utility = $this->calculateUtility($c_out, $c_min, $c_max, $jenis_kategori);

                $utilities[$kriteria->id] = $nilai_utility;
            }
        }

        return $utilities;
    }

    public function calculateUtility($c_out, $c_min, $c_max, $jenis_kategori)
    {
        if ($jenis_kategori == 'cost') {
            $nilai_utility = (($c_max - $c_out) / ($c_max - $c_min)) * 100;
        } elseif ($jenis_kategori == 'benefit') {
            $nilai_utility = (($c_out - $c_min) / ($c_max - $c_min)) * 100;
        } else {
            $nilai_utility = 0; // Nilai default jika jenis kategori tidak sesuai
        }

        return $nilai_utility;
    }

    public function showPenilaian()
    {
        $penilaian = Penilaian::all();
        $penilaianWithUtilities = [];

        foreach ($penilaian as $pen) {
            $utilities = $this->calculateUtilityForPenilaian($pen);
            $penilaianWithUtilities[] = [
                'penilaian' => $pen,
                'utilities' => $utilities
            ];
        }

        return view('Admin.penilaian.util', compact('penilaianWithUtilities'));
    }
}
