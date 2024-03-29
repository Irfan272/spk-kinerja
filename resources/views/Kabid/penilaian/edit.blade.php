@extends('Kabid.master.master')

@section('content')
<div class="pagetitle">
    <h1>Edit Penilaian</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="index.html">Home</a></li>
        <li class="breadcrumb-item">Penilaian</li>
        <li class="breadcrumb-item active">Edit</li>
      </ol>
    </nav>
  </div><!-- End Page Title -->
  <section class="section">
    <div class="row">
      @if ($errors->any())
      <div class="alert alert-danger">
          <ul>
              @foreach ($errors->all() as $error)
                  <li>{{ $error }}</li>
              @endforeach
          </ul>
      </div>
  @endif

      <div class="col-lg-12">

        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Data Penilaian</h5>
  @foreach ($penilaian as $data)
     <!-- Vertical Form -->
     <form class="row g-3" action="/kabid/penilaian/update/{{ $data->id }}" method="POST" enctype="multipart/form-data">
      @csrf
      @method('PATCH')
      <div class="col-12">
        <label for="inputNanme4" class="form-label">Nama Pegawai</label>
        <select name="id_pegawai" class="form-control">
            @foreach ($pegawai as $dataPegawai)
                <option @if ($data->id_pegawai == $dataPegawai->id)
                  selected 
                  @endif value="{{$dataPegawai->id}}">{{$dataPegawai->nama_pegawai}}</option>              

                {{-- <option value="{{ $dataPegawai->id }}" @if($dataPegawai->id == $penilaian->id_pegawai) selected @endif>{{ $dataPegawai->nama_pegawai }}</option> --}}
            @endforeach
        </select>
      </div>
      <div class="col-12">
        <label for="inputNanme4" class="form-label">Tanggal Penilaian</label>
        <input type="date" class="form-control" value="{{ $data->tanggal_penilaian}}" id="tanggal_penilaian" name="tanggal_penilaian">
      </div>

      @foreach ($kriteria as $dataKriteria)
      <div class="col-12">
        <label for="nilai_kriteria{{ $dataKriteria->id }}" class="form-label">{{$dataKriteria->nama_kriteria}}</label>
        <select name="nilai_kriteria{{ $dataKriteria->id }}" class="form-control">
            @foreach ($dataKriteria->SubKriteria as $subkriteria)
         

                <option value="{{ $subkriteria->nilai }}" @if($subkriteria->nilai == $data->{'id_kriteria' . $dataKriteria->id}) selected @endif>{{ $subkriteria->nama_subkriteria }}</option>
            @endforeach
        </select>
      </div>
      @endforeach
    
      
      <div class="text-center">
        <button type="submit" class="btn btn-primary me-1 mb-1">Update</button>
        <a href="/kabid/penilaian" class="btn btn-danger me-1 mb-1">Batal</a>
      </div>
    </form><!-- Vertical Form -->

  @endforeach
           
          </div>
        </div>

      </div>
    </div>
  </section>

@endsection
