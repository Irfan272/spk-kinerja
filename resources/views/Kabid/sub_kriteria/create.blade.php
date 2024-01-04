@extends('Kabid.master.master')

@section('content')
<div class="pagetitle">
    <h1>Tambah Sub Kriteria</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="index.html">Home</a></li>
        <li class="breadcrumb-item">Sub Kriteria</li>
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
            <h5 class="card-title">Data Sub Kriteria</h5>

            <!-- Vertical Form -->
            <form class="row g-3" action="/kabid/sub_kriteria/store" method="POST" enctype="multipart/form-data">
              @csrf
              <div class="col-12">
                <label for="inputEmail4" class="form-label">Nama Kriteria</label>
                <select name="" id="id_kriteria" class="form-control">
                <option disabled value="">Pilih Kriteria</option>
                @foreach ($kriteria as $data)
                    <option value="{{$data->id}}">{{$data->nama_kriteria}}, ( {{$data->kd_kriteria}} )</option>
                 @endforeach
            </select>
              </div>
              <div class="col-12">
                <label for="inputPassword4" class="form-label">Nama Sub Kritea</label>
                {{-- <input type="text" class="form-control" value="{{ old('nama_subkriteria') }}" id="nama_subkriteria" name="nama_subkriteria"> --}}
                <select name="nama_subkriteria" id="nama_subkriteria" class="form-control">
                  <option disabled value="">Pilih Parameter</option>
      
                      <option value="Sangat Baik">Sangat Baik</option>
                      <option value="Baik">Baik</option>
                      <option value="Cukup">Cukup</option>
                      <option value="Kurang">Kurang</option>
                      <option value="Sangat Kurang">Sangat Kurang</option>
           
              </select>
              </div>
             
         
              <div class="text-center">
                <button type="submit" class="btn btn-primary  me-1 mb-1">Submit</button>
           <a href="/kabid/sub_kriteria" class="btn btn-danger me-1 mb-1">Batal</a>
              </div>
            </form><!-- Vertical Form -->

          </div>
        </div>

       

      </div>
    </div>
  </section>

@endsection