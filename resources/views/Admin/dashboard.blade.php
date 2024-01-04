@extends('Admin.master.master')

@section('content')
<div class="pagetitle">
    <h1>Dashboard</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="index.html">Home</a></li>
        <li class="breadcrumb-item active">Dashboard</li>
      </ol>
    </nav>
  </div><!-- End Page Title -->

  <section class="section dashboard">
    <div class="row">

      <!-- Left side columns -->
      <div class="col-lg-12">
        <div class="row">

          <!-- Kriteria Card -->
          <div class="col-xxl-6 col-md-6">
            <div class="card info-card sales-card">

          
              <div class="card-body">
                <h5 class="card-title">Data  <span>| Akun</span></h5>

                <div class="d-flex align-items-center">
                  <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                    <i class="bi bi-person-circle"></i>
                  </div>
                  <div class="ps-3">
                    <h6>{{$total_akun}}</h6>
                    <span class="text-success small pt-1 fw-bold">Jumlah Akun</span> 

                  </div>
                </div>
              </div>

            </div>
          </div><!-- Kriteria Card -->

          <!-- Sub Kriteria Card -->
          <div class="col-xxl-6 col-md-6">
            <div class="card info-card revenue-card">

            <div class="card-body">
                <h5 class="card-title">Data <span>| Pegawai</span></h5>

                <div class="d-flex align-items-center">
                  <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                    <i class="bi bi-people-fill"></i>
                  </div>
                  <div class="ps-3">
                    <h6>{{$total_pegawai}}</h6>
                    <span class="text-success small pt-1 fw-bold">Jumlah Pegawai</span> 
                  </div>
                </div>
              </div>

            </div>
          </div><!-- Pegawai Card -->

                     <!-- Sub Kriteria Card -->
                     <div class="col-xxl-6 col-md-6">
                      <div class="card info-card revenue-card">
        
                      <div class="card-body">
                          <h5 class="card-title">Data <span>| Kriteria</span></h5>
        
                          <div class="d-flex align-items-center">
                            <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                              <i class="bi bi-book-fill"></i>
                            </div>
                            <div class="ps-3">
                              <h6>{{$total_kriteria}}</h6>
                              <span class="text-success small pt-1 fw-bold">Jumlah Kriteria</span> 
                            </div>
                          </div>
                        </div>
        
                      </div>
                    </div><!-- Pegawai Card -->

          <!-- Penilaian Card -->
          <div class="col-xxl-6 col-md-6">
            <div class="card info-card revenue-card">

            <div class="card-body">
                <h5 class="card-title">Data <span>| Sub Kriteria</span></h5>

                <div class="d-flex align-items-center">
                  <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                    <i class="bi bi-book-half"></i>
                  </div>
                  <div class="ps-3">
                    <h6>{{$total_subkriteria}}</h6>
                    <span class="text-success small pt-1 fw-bold">Jumlah Sub Kriteria</span> 
                  </div>
                </div>
              </div>

            </div>
          </div><!-- Penlian Card -->

       
  </section>

@endsection