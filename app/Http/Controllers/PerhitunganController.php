<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PerhitunganController extends Controller
{
    public function index(){
        return view('Admin.perhitungan.index');
    }

    public function create(){
        return view('Admin.perhitungan.create');
    }

    public function edit(){
        return view('Admin.perhitungan.edit');
    }
}
