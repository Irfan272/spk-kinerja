<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\HasilController;
use App\Http\Controllers\KabidController;
use App\Http\Controllers\TotalController;
use App\Http\Controllers\PegawaiController;
use App\Http\Controllers\KriteriaController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PenilaianController;
use App\Http\Controllers\PeringkatController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\PerhitunganController;
use App\Http\Controllers\SubKriteriaController;
use App\Http\Controllers\UserPeringkatController;
use App\Http\Controllers\KabidPeringkatController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('auth.login');
});

Auth::routes();
// Route::get('/', [LoginController::class, 'showLoginForm']);

// Route::get('/admin/dashboard', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::middleware(['auth','CheckRole:admin'])->group(function (){
    Route::get('/admin/dashboard', [DashboardController::class, 'index']);

    Route::get('/admin/akun', [DashboardController::class, 'akun']);
    Route::get('/admin/akun/create', [DashboardController::class, 'create']);
    Route::post('/admin/akun/store', [App\Http\Controllers\DashboardController::class, 'store']);
    Route::get('/admin/akun/edit/{id}', [App\Http\Controllers\DashboardController::class, 'edit']);
    Route::patch('/admin/akun/update/{id}', [App\Http\Controllers\DashboardController::class, 'update']);
    Route::delete('/admin/akun/delete/{id}', [App\Http\Controllers\DashboardController::class, 'delete']);
    
    

    // Pegawai
    Route::get('/admin/pegawai', [PegawaiController::class, 'index']);
    Route::get('/admin/pegawai/create', [PegawaiController::class, 'create']);
    Route::post('/admin/pegawai/store', [App\Http\Controllers\PegawaiController::class, 'store']);
    Route::get('/admin/pegawai/edit/{id}', [App\Http\Controllers\PegawaiController::class, 'edit']);
    Route::patch('/admin/pegawai/update/{id}', [App\Http\Controllers\PegawaiController::class, 'update']);
    Route::delete('/admin/pegawai/delete/{id}', [App\Http\Controllers\PegawaiController::class, 'delete']);
    
    
    // Penilaian
    Route::get('/admin/penilaian', [PenilaianController::class, 'index']);
    Route::get('/admin/penilaian/create', [PenilaianController::class, 'create']);
    Route::post('/admin/penilaian/store', [App\Http\Controllers\PenilaianController::class, 'store']);
    Route::get('/admin/penilaian/edit/{id}', [App\Http\Controllers\PenilaianController::class, 'edit']);
    Route::patch('/admin/penilaian/update/{id}', [App\Http\Controllers\PenilaianController::class, 'update']);
    Route::delete('/admin/penilaian/delete/{id}', [App\Http\Controllers\PenilaianController::class, 'delete']);
    Route::get('/admin/penilaian/util', [PenilaianController::class, 'showPenilaian']);
    
    
    //perhitungan
    Route::get('/admin/perhitungan', [TotalController::class, 'showPenilaian']);
    
    
    // total
    Route::get('/admin/peringkat', [PeringkatController::class, 'showPenilaian']);
    // Cetak
    Route::get('/admin/cetak', [PeringkatController::class, 'cetakPeringkat']);
    
});


// // Perhitungan
// Route::get('/perhitungan', [PerhitunganController::class, 'index']);
// Route::get('/perhitungan/create', [PerhitunganController::class, 'create']);
// Route::get('/perhitungan/edit', [PerhitunganController::class, 'edit']);

// // Hasil Akhir
// Route::get('/hasil', [HasilController::class, 'index']);


Route::middleware(['auth','CheckRole:kepala bidang'])->group(function (){
Route::get('/kabid/dashboard', [KabidController::class, 'index']);

// Route::get('/kabid/akun', [KabidController::class, 'akun']);
    // Kriteria
    Route::get('/kabid/kriteria', [KriteriaController::class, 'index']);
    Route::get('/kabid/kriteria/create', [KriteriaController::class, 'create']);
    Route::post('/kabid/kriteria/store', [App\Http\Controllers\KriteriaController::class, 'store']);
    Route::get('/kabid/kriteria/edit/{id}', [App\Http\Controllers\KriteriaController::class, 'edit']);
    Route::patch('/kabid/kriteria/update/{id}', [App\Http\Controllers\KriteriaController::class, 'update']);
    Route::delete('/kabid/kriteria/delete/{id}', [App\Http\Controllers\KriteriaController::class, 'delete']);
    // Route::get('/kabid/kriteria/show/{id}', [App\Http\Controllers\KriteriaController::class, 'showkabidistrasi']);
    Route::get('/create-data', [SubKriteriaController::class, 'createDataWithLoop']);
   
    
    // Sub Kriteria
    Route::get('/kabid/sub_kriteria', [SubKriteriaController::class, 'index']);
    Route::get('/kabid/sub_kriteria/create', [SubKriteriaController::class, 'create']);
    Route::post('/kabid/sub_kriteria/store', [App\Http\Controllers\SubKriteriaController::class, 'store']);
    Route::get('/kabid/sub_kriteria/edit/{id}', [App\Http\Controllers\SubKriteriaController::class, 'edit']);
    Route::patch('/kabid/sub_kriteria/update/{id}', [App\Http\Controllers\SubKriteriaController::class, 'update']);
    Route::delete('/kabid/sub_kriteria/delete/{id}', [App\Http\Controllers\SubKriteriaController::class, 'delete']);
    
    Route::get('/kabid/sub_kriteria_kehadiran', [SubKriteriaController::class, 'indexKehadiran']);
// Penilaian
Route::get('/kabid/penilaian', [KabidController::class, 'indexpenilaian']);
Route::get('/kabid/penilaian/create', [KabidController::class, 'createpenilaian']);
Route::post('/kabid/penilaian/store', [App\Http\Controllers\KabidController::class, 'storepenilaian']);
Route::get('/kabid/penilaian/edit/{id}', [App\Http\Controllers\KabidController::class, 'editpenilaian']);
Route::patch('/kabid/penilaian/update/{id}', [App\Http\Controllers\KabidController::class, 'updatepenilaian']);
Route::delete('/kabid/penilaian/delete/{id}', [App\Http\Controllers\KabidController::class, 'deletepenilaian']);
Route::get('/kabid/penilaian/util', [KabidController::class, 'showPenilaian']);


//perhitungan
Route::get('/kabid/perhitungan', [KabidController::class, 'showPenilaianTotal']);


// total
Route::get('/kabid/peringkat', [KabidPeringkatController::class, 'showPenilaian']);
    // Cetak
Route::get('/kabid/cetak', [KabidPeringkatController::class, 'cetakPeringkat']);

});


Route::middleware(['auth','CheckRole:user'])->group(function (){
    Route::get('/user/dashboard', [UserController::class, 'index']);
    
    // Route::get('/user/akun', [UserController::class, 'akun']);
    // Route::get('/user/kriteria', [UserController::class, 'indexkriteria']);
    // Route::get('/user/sub_kriteria', [UserController::class, 'indexsubkriteria']);
    // Route::get('/user/pegawai', [UserController::class, 'indexpegawai']);
    
    // Penilaian
    Route::get('/user/penilaian', [UserController::class, 'indexpenilaian']);
    Route::get('/user/penilaian/create', [UserController::class, 'createpenilaian']);
    Route::post('/user/penilaian/store', [App\Http\Controllers\UserController::class, 'storepenilaian']);
    Route::get('/user/penilaian/edit/{id}', [App\Http\Controllers\UserController::class, 'editpenilaian']);
    Route::patch('/user/penilaian/update/{id}', [App\Http\Controllers\UserController::class, 'updatepenilaian']);
    Route::delete('/user/penilaian/delete/{id}', [App\Http\Controllers\UserController::class, 'deletepenilaian']);
    Route::get('/user/penilaian/util', [UserController::class, 'showPenilaian']);
    



    
    //perhitungan
    Route::get('/user/perhitungan', [UserController::class, 'showPenilaianTotal']);
    
    
    // total
    Route::get('/user/peringkat', [UserPeringkatController::class, 'showPenilaian']);
        // Cetak
    Route::get('/user/cetak', [UserPeringkatController::class, 'cetakPeringkat']);
    
    });
