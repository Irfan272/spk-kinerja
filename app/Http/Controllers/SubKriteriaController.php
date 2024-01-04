<?php

namespace App\Http\Controllers;

use App\Models\Kriteria;
use App\Models\SubKriteria;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SubKriteriaController extends Controller
{
    public function index(){
        // $idKriteria = 1;
        $kriteria = Kriteria::with('SubKriteria')
                    ->whereIn('kd_kriteria', ['C1', 'C2', 'C3', 'C5', 'C6' ])
                    ->get();
        // $kriteria = Kriteria::with('sub_kriteria')->get()


        return view('Kabid.sub_kriteria.index', compact('kriteria'));
    }

    public function indexKehadiran(){
        // $idKriteria = 1;
        $kriteria = Kriteria::with('SubKriteria')
                    ->whereIn('kd_kriteria', ['C4' ])
                    ->get();
        // $kriteria = Kriteria::with('sub_kriteria')->get()


        return view('Kabid.sub_kriteria.index', compact('kriteria'));
    }

    public function createDataWithLoop()
    {
        $id_kriteria = 4; // Ganti dengan id_kriteria sesuai kebutuhan Anda
        $initialValue = 100; // Ganti dengan nilai awal untuk kolom 'nilai'
    
        for ($i = 1; $i <= 100; $i++) {
            $data = [
                'id_kriteria' => $id_kriteria,
                'nama_subkriteria' => $i,
                'nilai' => $initialValue + $i,
            ];
    
            // Menghitung nilai berdasarkan $nama_subkriteria
            if ($i >= 80  && $i <= 100) {
                $data['nilai'] = 5;
            } elseif ($i >= 60) {
                $data['nilai'] = 4;
            } elseif ($i >= 40) {
                $data['nilai'] = 3;
            } elseif ($i >= 20) {
                $data['nilai'] = 2;
            } elseif ($i >= 1) {
                $data['nilai'] = 1;
            }
    
            SubKriteria::create($data);
        }
    
        return "100 baris data berhasil dibuat!";
    }

    public function create(){
        $kriteria = Kriteria::all();
        return view('Kabid.sub_kriteria.create', compact('kriteria'));
    }

    public function store(Request $request){
        $validateData = $request->validate([
            'id_kriteria' => 'required',
            'nama_subkriteria' => 'required', 
            // 'nilai' => 'required', 
        ]);

        $nama_subKriteria = $request->input('nama_subkriteria');

        switch($nama_subKriteria){
            case "Sangat Baik" :
                $nilai = 5;
                break;
            case "Baik" :
                $nilai = 4;
                break;
            case "Cukup" :
                $nilai = 3;
                break;
            case "Kurang" :
                $nilai = 2;
                break;
            case "Sangat Kurang" :
                $nilai = 1;
                break;
        }

        $validateData['nilai'] = $nilai;

        // <option value="Sangat Baik">Sangat Baik</option>
        // <option value="Baik">Baik</option>
        // <option value="Cukup">Cukup</option>
        // <option value="Kurang">Kurang</option>
        // <option value="Sangat Kurang">Sangat Kurang</option>
      

        SubKriteria::create($validateData);

        return redirect('/kabid/sub_kriteria');
    }



    public function edit($id){
        $kriteria = Kriteria::all();
        $subkriteria = SubKriteria::where('id', $id)->get();
        return view('Kabid.sub_kriteria.edit', compact('kriteria' ,'subkriteria'));
    }

    public function update(Request $request, $id){
        $validateData = $request->validate([
            'id_kriteria' => 'required',
            'nama_subkriteria' => 'required', 
            // 'nilai' => 'required', 
        ]);

        $nama_subKriteria = $request->input('nama_subkriteria');

        switch($nama_subKriteria){
            case "Sangat Baik" :
                $nilai = 5;
                break;
            case "Baik" :
                $nilai = 4;
                break;
            case "Cukup" :
                $nilai = 3;
                break;
            case "Kurang" :
                $nilai = 2;
                break;
            case "Sangat Kurang" :
                $nilai = 1;
                break;
        }

        $validateData['nilai'] = $nilai;


        SubKriteria::where('id', $id)->update($validateData);

        return redirect('/kabid/sub_kriteria');
    }

    public function delete($id){
        SubKriteria::destroy($id);

        return back();
    }
}
