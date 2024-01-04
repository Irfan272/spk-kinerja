<?php

namespace App\Http\Controllers;

use App\Models\Kriteria;
use App\Models\Pegawai;
use App\Models\SubKriteria;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Hash;
use PhpParser\Node\Expr\FuncCall;

class DashboardController extends Controller
{
    public function index(){

        $total_kriteria = Kriteria::all()->count();
        $total_akun = User::all()->count();
        $total_pegawai = Pegawai::all()->count();
        $total_subkriteria = SubKriteria::all()->count();

        return view('Admin.dashboard', compact('total_akun', 'total_kriteria', 'total_pegawai', 'total_subkriteria'));
    }

    public function akun(){
        $akun = User::all();
        return view('Admin.akun.index', compact('akun'));
    }

    public function create(){
        return view('Admin.akun.create');
    }

    public function store(Request $request){
        $validasiData = $request->validate([


    'name' =>  'required|string|max:255',
    'email' =>  'required|string|max:255|unique:users',
    'password' =>  'required|string|max:20',
    'role' =>  'required|string|max:255',



    ]);
    $validasiData['password'] = Hash::make($validasiData['password']);

    User::create($validasiData);

    return redirect('/admin/akun');
}

public function edit($id){
    $akun = User::where('id',$id)->get();
 
    return view('admin.akun.edit', compact('akun'));
} 

public function update(Request $request, $id){
    // User::where('id', $id)->update([

    //     'username' =>  $request->username,
    //     'nama_lengkap' =>  $request->nama_lengkap,
    //     'email' =>  $request->email,
    //     'password' =>  Hash::make($request->password) ,
    //     'tanggal_lahir' =>  $request->tanggal_lahir,
    //     'jenis_kelamin' =>  $request->jenis_kelamin,
    //     'alamat' =>  $request->alamat,
    //     'no_telpon' =>  $request->no_telpon,
    //     'jabatan' =>  $request->jabatan,
    //     'id_divisi' =>  $request->id_divisi,
    //     'id_role' =>  $request->id_role,
    // ]);

    $validasiData = $request->validate([


        'name' =>  'required|string|max:255',
        'email' =>  'required|string|max:255|',
        'password' =>  'required|string|max:20',
        'role' =>  'required|string|max:255',
    
    
    
        ]);
        $validasiData['password'] = Hash::make($validasiData['password']);
        User::where('id', $id)->update($validasiData);







    return redirect('/admin/akun');
}

public function delete($id){
    User::destroy($id);
    return back();
}
// End AkunController
}
