@extends('Kabid.master.master')

@section('content')
<div class="pagetitle">
    <h1>Edit Sub Kriteria</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="index.html">Home</a></li>
        <li class="breadcrumb-item">Kriteria</li>
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
            <h5 class="card-title">Data Sub Kriteria</h5>
              @foreach ($subkriteria as $data)
              <form class="row g-3" action="/kabid/sub_kriteria/update/{{$data->id}}" method="POST" >
                @csrf
                @method('PATCH')
                <div class="col-12">
                  <label for="inputEmail4" class="form-label">Nama Kriteria</label>
                  <select name="id_kriteria" id="id_kriteria" class="form-control">
                  <option disabled value="">Pilih Kriteria</option>
                       @foreach ($kriteria as $k)
                        <option @if ($data->id_kriteria == $k->id)
                          selected
                        @endif value="{{ $k->id }}">{{ $k->nama_kriteria }}</option>
                        @endforeach
              </select>
                </div>
                <div class="col-12">
                  <label for="inputPassword4" class="form-label">Nama Sub Kritea</label>
                  {{-- <input type="text" class="form-control" value="{{ old('nama_subkriteria') }}" id="nama_subkriteria" name="nama_subkriteria"> --}}
                  <select name="nama_subkriteria" id="nama_subkriteria" class="form-control">
                    <option disabled value="">Pilih Parameter</option>
                    <option @if ($data->nama_subkriteria == 'Sangat Baik')
                      selected
                     @endif value="Sangat Baik">Sangat Baik</option>
                     <option @if ($data->nama_subkriteria == 'Baik')
                      selected
                     @endif value="Baik">Baik</option>
                     <option @if ($data->nama_subkriteria == 'Cukup')
                      selected
                     @endif value="Cukup">Cukup</option>
                     <option @if ($data->nama_subkriteria == 'Kurang')
                      selected
                     @endif value="Kurang">Kurang</option>
                     <option @if ($data->nama_subkriteria == 'Sangat Kurang')
                      selected
                     @endif value="Sangat Kurang">Sangat Kurang</option>






                        {{-- <option value="Sangat Baik">Sangat Baik</option>
                        <option value="Baik">Baik</option>
                        <option value="Cukup">Cukup</option>
                        <option value="Kurang">Kurang</option>
                        <option value="Sangat Kurang">Sangat Kurang</option> --}}
             
                </select>
                </div>
           
  
  
                  {{-- <input type="text" class="form-control" id="inputAddress" name="kd_kriteria"> --}}
                </div>
                <div class="text-center">
                  <button type="submit" class="btn btn-primary  me-1 mb-1">Submit</button>
             <a href="/kabid/sub_kriteria" class="btn btn-danger me-1 mb-1">Batal</a>
                </div>
              </form><!-- Vertical Form -->
  
              @endforeach
            <!-- Vertical Form -->
           
          </div>
        </div>

       

      </div>
    </div>
  </section>

@endsection