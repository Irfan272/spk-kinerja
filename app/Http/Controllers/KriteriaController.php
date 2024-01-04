<?php

namespace App\Http\Controllers;

use App\Models\Kriteria;
use Illuminate\Http\Request;

class KriteriaController extends Controller
{
    public function index(){
        $kriteria = Kriteria::all();

        $bobot = Kriteria::sum('bobot');
        $total = Kriteria::sum('normalisasi');

        return view('Kabid.kriteria.index', compact('kriteria', 'bobot','total'));
    }

    public function create(){

        return view('Kabid.kriteria.create');
    }

    public function store(Request $request){
        $validateData = $request->validate([
            'kd_kriteria' => 'required',
            'nama_kriteria' => 'required',
            'bobot' => 'required',
          
            'jenis_kriteria' => 'required', 
        ]);

        $bobot = $request->input('bobot');

        $normalisasi = $bobot / 100;

        $validateData['normalisasi'] = $normalisasi;

        Kriteria::create($validateData);

        return redirect('/kabid/kriteria');
    }



    public function edit($id){
        $kriteria = Kriteria::where('id', $id)->get();
        return view('Kabid.kriteria.edit', compact('kriteria'));
    }

    public function update(Request $request, $id){
        $validateData = $request->validate([
            'kd_kriteria' => 'required',
            'nama_kriteria' => 'required',
            'bobot' => 'required',
          
            'jenis_kriteria' => 'required', 
        ]);

        $bobot = $request->input('bobot');

        $normalisasi = $bobot / 100;

        $validateData['normalisasi'] = $normalisasi;

        Kriteria::where('id', $id)->update($validateData);

        return redirect('/kabid/kriteria');
    }

    public function delete($id){
        Kriteria::destroy($id);

        return back();
    }

}
