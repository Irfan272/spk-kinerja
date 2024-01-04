@extends('Kabid.master.master')

@section('content')
<div class="pagetitle">
    <h1>Data Sub Kriteria</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="index.html">Home</a></li>
        <li class="breadcrumb-item">Tables</li>
        <li class="breadcrumb-item active">Data</li>
      </ol>
    </nav>
  </div><!-- End Page Title -->

  <section class="section">
    <div class="row">
      <div class="col-lg-12">
        <a href="/kabid/sub_kriteria/create" class="btn btn-success me-1 mb-3 mt-2"><i class="bi bi-plus" ></i>Tambah Data Kriteria</a>
        
        @foreach ($kriteria as $item)
        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Sub Kriteri {{$item->nama_kriteria}} ({{$item->kd_kriteria}})</h5>
            {{-- <p>Add lightweight datatables to your project with using the <a href="https://github.com/fiduswriter/Simple-DataTables" target="_blank">Simple DataTables</a> library. Just add <code>.datatable</code> class name to any table you wish to conver to a datatable</p> --}}
            {{-- <a href="/sub_kriteria/create" class="btn btn-success me-1 mb-3 mt-2"><i class="bi bi-plus" ></i>Tambah Data C1</a> --}}
            <!-- Table with stripped rows -->
            <table class="table ">
              <thead>
                <tr>
                  <th scope="col">No</th>
                  <th scope="col">Nama Sub Kriteria</th>
                  <th scope="col">Nilai</th>
                  <th scope="col">Action</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($item->SubKriteria as $data)
                <tr>
                  <th scope="row">{{$loop->iteration}}</th>
                  <th>{{$data->nama_subkriteria}}</th>
                  <td>{{$data->nilai}}</td>
                  <td>
                    <a href="/kabid/sub_kriteria/edit/{{ $data->id }}" class="btn m-1 btn-warning"><i class="bi bi-pencil-square"></i></a>
                    <form action="/kabid/sub_kriteria/delete/{{$data->id}}" method="POST" class="d-inline">
                      @csrf
                      @method('DELETE')
                    <button type="submit" class="btn btn-danger btn-xs"><i class="bi bi-trash"></i> </button>
                    </form>
                  </td>
                </tr>
                @endforeach
           
             
            

               
         
              </tbody>
            </table>
            <!-- End Table with stripped rows -->

          </div>
       
        </div>
        @endforeach
      </div>
    </div>
  </section>
@endsection