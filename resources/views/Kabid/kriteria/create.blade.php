@extends('Kabid.master.master')

@section('content')
<div class="pagetitle">
    <h1>Tambah Kriteria</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="index.html">Home</a></li>
        <li class="breadcrumb-item">Kriteria</li>
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
            <h5 class="card-title">Data Kriteria</h5>

            <!-- Vertical Form -->
            <form class="row g-3" action="/kabid/kriteria/store" method="POST" enctype="multipart/form-data">
              @csrf
              <div class="col-12">
                <label for="inputNanme4" class="form-label">Kode Kriteria</label>
                <input type="text" class="form-control" value="{{ old('kd_kriteria') }}" id="kd_kriteria" name="kd_kriteria">
              </div>
              <div class="col-12">
                <label for="inputEmail4" class="form-label">Nama Kriteria</label>
                <input type="text" class="form-control" value="{{ old('nama_kriteria') }}"id="nama_kriteria" name="nama_kriteria">
              </div>
              <div class="col-12">
                <label for="inputPassword4" class="form-label">Bobot</label>
                <input type="number" class="form-control" value="{{ old('bobot') }}" id="bobot" name="bobot">
              </div>
              <div class="col-12">
                <label for="inputAddress" class="form-label">Jenis Kriteria</label>
                <select name="jenis_kriteria" id="jenis_kriteria" class="form-control">
                  <option disabled value="">Pilih Jenis Kriteria</option>
      
                      <option value="benefit">Benefit</option>
                      <option value="cost">Cost</option>
           
              </select>



                {{-- <input type="text" class="form-control" id="inputAddress" name="kd_kriteria"> --}}
              </div>
              <div class="text-center">
                <button type="submit" class="btn btn-primary  me-1 mb-1">Submit</button>
           <a href="/kabid/kriteria" class="btn btn-danger me-1 mb-1">Batal</a>
              </div>
            </form><!-- Vertical Form -->

          </div>
        </div>

       

      </div>
    </div>
  </section>

@endsection