@extends('Kabid.master.master')

@section('content')
<div class="pagetitle">
    <h1>Tambah Penilaian</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="index.html">Home</a></li>
        <li class="breadcrumb-item">Penilaian</li>
        <li class="breadcrumb-item active">Create</li>
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
            <h5 class="card-title">Data Penilian</h5>

            <!-- Vertical Form -->
            <form class="row g-3" action="/kabid/penilaian/store" method="POST" enctype="multipart/form-data">
              @csrf
              <div class="col-12">
                <label for="inputNanme4" class="form-label">Nama Pegawai</label>
                <select name="id_pegawai" class="form-control">
                    @foreach ($pegawai as $pegawai)
                        <option value="{{ $pegawai->id }}">{{ $pegawai->nama_pegawai }}</option>
                    @endforeach
                </select>
              </div>
              @foreach ($kriteria as $data)
              <div class="col-12">
                <label for="nilai_kriteria{{ $data->id }}" class="form-label">{{$data->nama_kriteria}}</label>
                <select name="nilai_kriteria{{ $data->id }}" class="form-control">
                    @foreach ($data->SubKriteria as $subkriteria)
                        <option value="{{ $subkriteria->nilai }}">{{ $subkriteria->nama_subkriteria }}</option>
                    @endforeach
                </select>
              </div>
              @endforeach
            
              
              <div class="text-center">
                <button type="submit" class="btn btn-primary  me-1 mb-1">Submit</button>
           <a href="/kabid/pegawai" class="btn btn-danger me-1 mb-1">Batal</a>
              </div>
            </form><!-- Vertical Form -->

          </div>
        </div>

       

      </div>
    </div>
  </section>

@endsection