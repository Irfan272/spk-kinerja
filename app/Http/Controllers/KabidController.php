<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Pegawai;
use App\Models\Kriteria;
use App\Models\Penilaian;
use App\Models\SubKriteria;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Foundation\Auth\User;

class KabidController extends Controller
{
    public function index(){

        $total_kriteria = Kriteria::all()->count();
        $total_akun = User::all()->count();
        $total_pegawai = Pegawai::all()->count();
        $total_subkriteria = SubKriteria::all()->count();

        return view('Kabid.dashboard', compact('total_akun', 'total_kriteria', 'total_pegawai', 'total_subkriteria'));
    }

    public function akun(){
        $akun = User::all();
        return view('Kabid.akun.index', compact('akun'));
    }

    public function indexkriteria(){
        $kriteria = Kriteria::all();

        $bobot = Kriteria::sum('bobot');
        $total = Kriteria::sum('normalisasi');

        return view('Kabid.kriteria.index', compact('kriteria', 'bobot','total'));
    }

    public function indexpegawai(){
        $pegawai = Pegawai::all();
        return view('Kabid.pegawai.index', compact('pegawai'));
    }

    public function indexsubkriteria(){
        // $idKriteria = 1;
        $kriteria = Kriteria::with('SubKriteria')->get();
        // $kriteria = Kriteria::with('sub_kriteria')->get()


        return view('Kabid.sub_kriteria.index', compact('kriteria'));
    }

    public function indexpenilaian(){
        $penilaian = Penilaian::with('pegawai', 'Kriteria1', 'Kriteria2', 'Kriteria3', 'Kriteria4', 'Kriteria5', 'Kriteria6')->get();
        return view('Kabid.penilaian.index', compact('penilaian'));
    }

    public function createpenilaian(){
        $pegawai = Pegawai::all();
        $kriteria = Kriteria::with('SubKriteria')->get();

        return view('Kabid.penilaian.create', compact('pegawai', 'kriteria'));
    }

    public function storepenilaian(Request $request){
        $penilaian = new Penilaian();

        $penilaian->id_pegawai = $request->input('id_pegawai');
        $penilaian->tanggal_penilaian = $request->input('tanggal_penilaian');

        $kriteria = Kriteria::all();
        foreach($kriteria as $kriteria){
            $nilai_kriteria = 'nilai_kriteria' . $kriteria->id;
            $penilaian->{'id_kriteria' . $kriteria->id} = $request->input($nilai_kriteria);
        }
        $penilaian->save();

        return redirect('/kabid/penilaian');
    }



    public function editpenilaian($id){
        $pegawai = Pegawai::all();
        $kriteria = Kriteria::with('SubKriteria')
        ->whereIn('kd_kriteria', ['C1', 'C2', 'C6'])
        ->get();
        $penilaian = Penilaian::where('id', $id)->get();
        return view('Kabid.penilaian.edit', compact('pegawai', 'kriteria', 'penilaian'));
    }

    public function updatepenilaian(Request $request, $id){


        $penilaian = Penilaian::findOrFail($id);

        if (!$penilaian) {
            return redirect('/kabid/penilaian')->with('error', 'Data penilaian tidak ditemukan.');
        }
    
        $penilaian->id_pegawai = $request->input('id_pegawai');
        $penilaian->tanggal_penilaian = $request->input('tanggal_penilaian');
    
        $kriteria = Kriteria::all();
        foreach ($kriteria as $kriteriaItem) {

            // Cek 4
            if ($kriteriaItem->kd_kriteria === 'C3') {
                continue;
            }

            if ($kriteriaItem->kd_kriteria === 'C4') {
                continue;
            }

            if ($kriteriaItem->kd_kriteria === 'C5') {
                continue;
            }

            $nilaiKriteria = 'nilai_kriteria' . $kriteriaItem->id;
            $penilaian->{'id_kriteria' . $kriteriaItem->id} = $request->input($nilaiKriteria);
        }
        
        $penilaian->save();
 


        return redirect('/kabid/penilaian');
    }

    public function deletepenilaian($id){
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

        return view('Kabid.penilaian.util', compact('penilaianWithUtilities'));
    }

    // public function calculateUtilityForPenilaian($penilaian)
    // {
    //     $utilities = [];
    //     $kriteria = Kriteria::all();

    //     foreach ($kriteria as $kriteria) {
    //         $nilai_kriteria = $penilaian->{'id_kriteria' . $kriteria->id};
    //         $subkriteria = $kriteria->SubKriteria->firstWhere('nilai', $nilai_kriteria);

    //         if ($subkriteria) {
    //             $c_out = $subkriteria->nilai;
    //             $c_min = $kriteria->SubKriteria->min('nilai');
    //             $c_max = $kriteria->SubKriteria->max('nilai');
    //             $jenis_kategori = $kriteria->jenis_kriteria;

    //             $nilai_utility = $this->calculateUtility($c_out, $c_min, $c_max, $jenis_kategori);

    //             $utilities[$kriteria->id] = $nilai_utility;
    //         }
    //     }

    //     return $utilities;
    // }

    // public function calculateUtility($c_out, $c_min, $c_max, $jenis_kategori)
    // {
    //     if ($jenis_kategori == 'cost') {
    //         $nilai_utility = (($c_max - $c_out) / ($c_max - $c_min)) * 100;
    //     } elseif ($jenis_kategori == 'benefit') {
    //         $nilai_utility = (($c_out - $c_min) / ($c_max - $c_min)) * 100;
    //     } else {
    //         $nilai_utility = 0; // Nilai default jika jenis kategori tidak sesuai
    //     }

    //     return $nilai_utility;
    // }




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

    public function showPenilaianTotal()
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
    
        return view('Kabid.penilaian.total', compact('penilaianGroupedByDate'));
    }

public function showPenilaianPeringkat(){
    $penilaian = Penilaian::all();
    $penilaianWithUtilities = [];

    foreach ($penilaian as &$pen) { // Tambahkan tanda & di sini
        $utilities = $this->calculateUtilityForPenilaian($pen);
        $utilities['peringkat'] = 0; // Inisialisasi peringkat

        // Simpan utilities ke array
        $penilaianWithUtilities[] = [
            'penilaian' => $pen,
            'utilities' => $utilities
        ];
    }

    // Urutkan berdasarkan tanggal_penilaian dan nilai total alternatif, kemudian hitung peringkat
    usort($penilaianWithUtilities, function ($a, $b) {
        if ($a['penilaian']->tanggal_penilaian === $b['penilaian']->tanggal_penilaian) {
            return $b['utilities']['total'] <=> $a['utilities']['total']; // Urutan terbalik, dari besar ke kecil
        } else {
            $dateA = Carbon::parse($a['penilaian']->tanggal_penilaian);
            $dateB = Carbon::parse($b['penilaian']->tanggal_penilaian);
            return $dateB->diff($dateA)->invert ? -1 : 1; // Urutan tanggal terbalik, dari terbaru ke terlama
        }
    });

    $tanggal_sebelumnya = null;
    $peringkat = 1;

    foreach ($penilaianWithUtilities as &$pen) {
        if ($pen['penilaian']->tanggal_penilaian !== $tanggal_sebelumnya) {
            $tanggal_sebelumnya = $pen['penilaian']->tanggal_penilaian;
            $peringkat = 1;
        }

        $pen['utilities']['peringkat'] = $peringkat;
        $peringkat++;
    }
   

    // return view('Admin.penilaian.peringkat', compact('penilaianWithUtilities', 'nilaiTotalAlternatif', 'peringkat'));
    return view('Kabid.penilaian.peringkat', compact('penilaianWithUtilities'));
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

   return view('Kabid.penilaian.cetak', compact('penilaianForDisplay'));
}

}
