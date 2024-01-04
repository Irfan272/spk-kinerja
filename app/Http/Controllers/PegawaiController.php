<?php

namespace App\Http\Controllers;

use App\Models\Pegawai;
use Illuminate\Http\Request;

class PegawaiController extends Controller
{
    public function index(){
        $pegawai = Pegawai::all();
        return view('Admin.pegawai.index', compact('pegawai'));
    }

    public function create(){
        $lastPegawai = Pegawai::orderBy('id', 'desc')->first();

        if ($lastPegawai) {
            $lastCode = $lastPegawai->kd_pegawai;
            $lastNumber = (int)substr($lastCode, 1);
            $newNumber = $lastNumber + 1;
            $newCode = 'P' . $newNumber;
        }else{
            $newCode = 'P1';
        }

        return view('Admin.pegawai.create', compact('newCode'));
    }

    public function store(Request $request){
        $validateData = $request->validate([
            'kd_pegawai' => 'required',
            'nama_pegawai' => 'required',
        ]);

        Pegawai::create($validateData);

        return redirect('/admin/pegawai');
    }



    public function edit($id){
        $pegawai = Pegawai::where('id', $id)->get();
        return view('Admin.pegawai.edit', compact('pegawai'));
    }

    public function update(Request $request, $id){
        $validateData = $request->validate([
            'kd_pegawai' => 'required',
            'nama_pegawai' => 'required',
        ]);

        Pegawai::where('id', $id)->update($validateData);

        return redirect('/admin/pegawai');
    }

    public function delete($id){
        Pegawai::destroy($id);

        return back();
    }
}
