@extends('Kabid.master.master')

@section('content')
<div class="pagetitle">
    <h1>Data Kriteria</h1>
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

        <div class="card">
          <div class="card-body">
            <h5 class="card-title">List Data Kriteria</h5>
            {{-- <p>Add lightweight datatables to your project with using the <a href="https://github.com/fiduswriter/Simple-DataTables" target="_blank">Simple DataTables</a> library. Just add <code>.datatable</code> class name to any table you wish to conver to a datatable</p> --}}
            <a href="/kabid/kriteria/create" class="btn btn-success me-1 mb-3 mt-2"><i class="bi bi-plus" ></i>Tambah Data Kriteria</a>
            <!-- Table with stripped rows -->
            <table class="table ">
              <thead>
                <tr>
                  <th scope="col">No</th>
                  <th scope="col">Kode Kriteria</th>
                  <th scope="col">Nama Kriteria</th>
                  <th scope="col">Bobot Kriteria</th>
                  <th scope="col">Normalisasi</th>
                  <th scope="col">Jenis Kriteria</th>
                  <th scope="col">Action</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($kriteria as $data)
                <tr>
                  <td >{{$loop->iteration }}</td>
                  <td>{{$data->kd_kriteria}}</td>
                  <td>{{$data->nama_kriteria}}</td>
                  <td>{{$data->bobot}}</td>
                  <td>{{$data->normalisasi}}</td>
                  <td>{{$data->jenis_kriteria}}</td>
           
                  <td>
                    <a href="/kabid/kriteria/edit/{{ $data->id }}" class="btn m-1 btn-warning"><i class="bi bi-pencil-square"></i></a>
                    <form action="/kabid/kriteria/delete/{{$data->id}}" method="POST" class="d-inline">
                      @csrf
                      @method('DELETE')
                    <button type="submit" class="btn btn-danger btn-xs"><i class="bi bi-trash"></i> </button>
                    </form>


                    {{-- <a href="/kabid/kriteria/edit" class="btn m-1 btn-warning"><i class="bi bi-pencil-square"></i></a>
                    <a href="/kriteria/destroy" class="btn m-1 btn-danger"><i class="bi bi-trash"></i></a> --}}

                  </td>
                </tr>
                @endforeach
                <tr>
                  <td colspan="3"></td>
                  <td>Total : {{$bobot}}</td>
                  <td>Total : {{$total}}</td>
                  <td colspan="2"></td>
                </tr>
               
              </tbody>
            </table>
            <!-- End Table with stripped rows -->

          </div>
        </div>

      </div>
    </div>
  </section>
@endsection