<!-- penilaian.show.blade.php -->
@extends('Admin.master.master')

@section('content')
    <div class="pagetitle">
        <h1>Data Penilaian</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                <li class="breadcrumb-item">Penilaian</li>
                <li class="breadcrumb-item active">Show</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section">
        <div class="row">
            <div class="col-lg-12">

                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">List Data Penilaian</h5>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">No</th>
                                    <th scope="col">Nama Pegawai</th>
                                    <th scope="col">Kriteria 1</th>
                                    <th scope="col">Kriteria 2</th>
                                    <th scope="col">Kriteria 3</th>
                                    <th scope="col">Kriteria 4</th>
                                    <th scope="col">Kriteria 5</th>
                                    <th scope="col">Kriteria 6</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($penilaianWithUtilities as $index => $pen)
                                    <tr>
                                        <th scope="row">{{ $index + 1 }}</th>
                                        <td>{{ $pen['penilaian']->pegawai->nama_pegawai }}</td>
                                        <td>{{ $pen['utilities'][1] }}</td>
                                        <td>{{ $pen['utilities'][2] }}</td>
                                        <td>{{ $pen['utilities'][3] }}</td>
                                        <td>{{ $pen['utilities'][4] }}</td>
                                        <td>{{ $pen['utilities'][5] }}</td>
                                        <td>{{ $pen['utilities'][6] }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
        </div>
    </section>
@endsection
