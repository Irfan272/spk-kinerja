<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Kriteria;
use App\Models\Penilaian;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class UserPeringkatController extends Controller
{
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

        $utilities['total'] = array_sum($utilities);

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
        $penilaianWithUtilities = [];
    
        foreach ($penilaian as &$pen) {
            $utilities = $this->calculateUtilityForPenilaian($pen);
            $utilities['peringkat'] = 0; // Inisialisasi peringkat
    
            // Simpan utilities ke array
            $penilaianWithUtilities[] = [
                'penilaian' => $pen,
                'utilities' => $utilities
            ];
        }
    
        // Separate incomplete and complete data
        $incompleteData = [];
        $completeData = [];
    
        foreach ($penilaianWithUtilities as $pen) {
            if (in_array(null, array_values($pen['utilities']), true)) {
                $incompleteData[] = $pen;
            } else {
                $completeData[] = $pen;
            }
        }
    
       // Urutkan dan hitung peringkat untuk incomplete data
usort($incompleteData, function ($a, $b) {
    if ($a['penilaian']->tanggal_penilaian === $b['penilaian']->tanggal_penilaian) {
        // Sort by total utility, ascending for incomplete data
        return $a['utilities']['total'] <=> $b['utilities']['total'];
    } else {
        // Sort by date, descending for incomplete data
        $dateA = Carbon::parse($a['penilaian']->tanggal_penilaian);
        $dateB = Carbon::parse($b['penilaian']->tanggal_penilaian);
        return $dateB->diff($dateA)->invert ? -1 : 1;
    }
});

// Urutkan dan hitung peringkat untuk complete data
usort($completeData, function ($a, $b) {
    if ($a['penilaian']->tanggal_penilaian === $b['penilaian']->tanggal_penilaian) {
        // Sort by total utility, descending for complete data
        return $b['utilities']['total'] <=> $a['utilities']['total'];
    } else {
        // Sort by date, descending for complete data
        $dateA = Carbon::parse($a['penilaian']->tanggal_penilaian);
        $dateB = Carbon::parse($b['penilaian']->tanggal_penilaian);
        return $dateB->diff($dateA)->invert ? -1 : 1;
    }
});
    
        $tanggal_sebelumnya = null;
        $peringkat = 1;
    
        // Loop through incomplete data and assign rankings
        foreach ($incompleteData as &$pen) {
            if ($pen['penilaian']->tanggal_penilaian !== $tanggal_sebelumnya) {
                $tanggal_sebelumnya = $pen['penilaian']->tanggal_penilaian;
                $peringkat = 1;
            }
    
            $pen['utilities']['peringkat'] = $peringkat;
            $peringkat++;
        }
    
        // Loop through complete data and assign rankings
        foreach ($completeData as &$pen) {
            if ($pen['penilaian']->tanggal_penilaian !== $tanggal_sebelumnya) {
                $tanggal_sebelumnya = $pen['penilaian']->tanggal_penilaian;
                $peringkat = 1;
            }
    
            $pen['utilities']['peringkat'] = $peringkat;
            $peringkat++;
        }
    
        // Combine incomplete and complete data for display
        $penilaianForDisplay = array_merge($incompleteData, $completeData);
    
        return view('User.penilaian.peringkat', compact('penilaianForDisplay'));
    }

    public function cetakPeringkat(){
        $penilaian = Penilaian::all();
       $penilaianWithUtilities = [];
   
       foreach ($penilaian as &$pen) {
           $utilities = $this->calculateUtilityForPenilaian($pen);
           $utilities['peringkat'] = 0; // Inisialisasi peringkat
   
           // Simpan utilities ke array
           $penilaianWithUtilities[] = [
               'penilaian' => $pen,
               'utilities' => $utilities
           ];
       }
   
       // Separate incomplete and complete data
       $incompleteData = [];
       $completeData = [];
   
       foreach ($penilaianWithUtilities as $pen) {
           if (in_array(null, array_values($pen['utilities']), true)) {
               $incompleteData[] = $pen;
           } else {
               $completeData[] = $pen;
           }
       }
   
      // Urutkan dan hitung peringkat untuk incomplete data
usort($incompleteData, function ($a, $b) {
   if ($a['penilaian']->tanggal_penilaian === $b['penilaian']->tanggal_penilaian) {
       // Sort by total utility, ascending for incomplete data
       return $a['utilities']['total'] <=> $b['utilities']['total'];
   } else {
       // Sort by date, descending for incomplete data
       $dateA = Carbon::parse($a['penilaian']->tanggal_penilaian);
       $dateB = Carbon::parse($b['penilaian']->tanggal_penilaian);
       return $dateB->diff($dateA)->invert ? -1 : 1;
   }
});

// Urutkan dan hitung peringkat untuk complete data
usort($completeData, function ($a, $b) {
   if ($a['penilaian']->tanggal_penilaian === $b['penilaian']->tanggal_penilaian) {
       // Sort by total utility, descending for complete data
       return $b['utilities']['total'] <=> $a['utilities']['total'];
   } else {
       // Sort by date, descending for complete data
       $dateA = Carbon::parse($a['penilaian']->tanggal_penilaian);
       $dateB = Carbon::parse($b['penilaian']->tanggal_penilaian);
       return $dateB->diff($dateA)->invert ? -1 : 1;
   }
});
   
       $tanggal_sebelumnya = null;
       $peringkat = 1;
   
       // Loop through incomplete data and assign rankings
       foreach ($incompleteData as &$pen) {
           if ($pen['penilaian']->tanggal_penilaian !== $tanggal_sebelumnya) {
               $tanggal_sebelumnya = $pen['penilaian']->tanggal_penilaian;
               $peringkat = 1;
           }
   
           $pen['utilities']['peringkat'] = $peringkat;
           $peringkat++;
       }
   
       // Loop through complete data and assign rankings
       foreach ($completeData as &$pen) {
           if ($pen['penilaian']->tanggal_penilaian !== $tanggal_sebelumnya) {
               $tanggal_sebelumnya = $pen['penilaian']->tanggal_penilaian;
               $peringkat = 1;
           }
   
           $pen['utilities']['peringkat'] = $peringkat;
           $peringkat++;
       }
   
       // Combine incomplete and complete data for display
       $penilaianForDisplay = array_merge($incompleteData, $completeData);
   
       return view('User.penilaian.cetak', compact('penilaianForDisplay'));
}
}
