<?php

namespace App\Http\Controllers;

use App\Models\Kriteria;
use App\Models\Penilaian;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Carbon\Carbon;

class TotalController extends Controller
{
   public function calculateUtilityForPenilaian($penilaian)
{
    $utilities = [];
    $kriteria = Kriteria::all();

    foreach ($kriteria as $kriteria) {
        $nilai_kriteria = $penilaian->{'id_kriteria' . $kriteria->id};

        // Check if $nilai_kriteria is empty
        if (empty($nilai_kriteria)) {
            // Handle missing value, like skipping or setting a default value
            continue;
        }

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




    public function calculateTotalUtility()
    {
        // Ambil semua penilaian
        $penilaian = Penilaian::all();

        // Ambil bobot kriteria
        $kriteria = Kriteria::all();
        $totalBobot = $kriteria->sum('bobot');
        $bobotKriteria = $kriteria->pluck('bobot');

        // Inisialisasi array untuk menyimpan nilai total alternatif
        $nilaiTotalAlternatif = [];

        // Loop melalui setiap penilaian
        foreach ($penilaian as $pen) {
            $nilaiAlternatif = 0;

            // Loop melalui setiap kriteria
            foreach ($kriteria as $index => $k) {
                $nilaiKriteria = $pen->{'id_kriteria' . ($index + 1)};
                $normalisasiBobot = $bobotKriteria[$index] / $totalBobot;
                $nilaiAlternatif += $nilaiKriteria * $normalisasiBobot;
            }

            // Simpan nilai total alternatif ke array
            $nilaiTotalAlternatif[] = $nilaiAlternatif;
        }

        return $nilaiTotalAlternatif;
    }


    public function showPenilaian()
    {
        $penilaian = Penilaian::all();
        $penilaianWithUtilities = [
            'incomplete' => [],
            'complete' => []
        ];
    
        foreach ($penilaian as $pen) {
            $utilities = $this->calculateUtilityForPenilaian($pen);
    
            // Determine if criteria data is incomplete or complete
            $hasIncompleteCriteria = in_array(null, array_values($utilities), true);
            if ($hasIncompleteCriteria) {
                $penilaianWithUtilities['incomplete'][] = [
                    'penilaian' => $pen,
                    'utilities' => $utilities
                ];
            } else {
                $penilaianWithUtilities['complete'][] = [
                    'penilaian' => $pen,
                    'utilities' => $utilities
                ];
            }
        }
    
        $penilaianGroupedByDate = [];
    
        // Loop and display incomplete data
        foreach ($penilaianWithUtilities['incomplete'] as $data) {
            $date = Carbon::parse($data['penilaian']->tanggal_penilaian)->format('d-m-Y');
            if (!isset($penilaianGroupedByDate[$date])) {
                $penilaianGroupedByDate[$date] = [];
            }
    
            $penilaianGroupedByDate[$date][] = $data;
        }
    
        // Loop and display complete data
        foreach ($penilaianWithUtilities['complete'] as $data) {
            $date = Carbon::parse($data['penilaian']->tanggal_penilaian)->format('d-m-Y');
            if (!isset($penilaianGroupedByDate[$date])) {
                $penilaianGroupedByDate[$date] = [];
            }
    
            $penilaianGroupedByDate[$date][] = $data;
        }
    
        krsort($penilaianGroupedByDate);
    
        return view('Admin.penilaian.total', compact('penilaianGroupedByDate'));
    }
    
}
