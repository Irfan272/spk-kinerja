@extends('Admin.master.master')

@section('content')
<div class="pagetitle">
    <h1>Data Penilaian</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="index.html">Home</a></li>
            <li class="breadcrumb-item">Penilaian</li>
            <li class="breadcrumb-item active">Total</li>
        </ol>
    </nav>
</div><!-- End Page Title -->

<section class="section">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    @foreach ($penilaianGroupedByDate as $date => $penilaianData)
                        <h5 class="card-title">List Data Penilaian Date: {{ $date }}</h5>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">No</th>
                                    <th scope="col">Nama Pegawai</th>
                                    <th scope="col">Kedisiplinan (C1)</th>
                                    <th scope="col">Kerjasama (C2)</th>
                                    <th scope="col">Sikap (C3)</th>
                                    <th scope="col">Kehadiran (C4)</th>
                                    <th scope="col">Keahlian (C5)</th>
                                    <th scope="col">Loyalitas (C6)</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($penilaianData as $index => $data)
                                    @php
                                        $pen = $data['penilaian'];
                                        $utilities = $data['utilities'];
                                    @endphp
                                    <tr>
                                        <th scope="row">{{ $index + 1 }}</th>
                                        <td>{{ $pen->pegawai->nama_pegawai }}</td>
                                        <td>{{ $utilities[1] ?? '' }}</td>
                                        <td>{{ $utilities[2] ?? '' }}</td>
                                        <td>{{ $utilities[3] ?? '' }}</td>
                                        <td>{{ $utilities[4] ?? '' }}</td>
                                        <td>{{ $utilities[5] ?? '' }}</td>
                                        <td>{{ $utilities[6] ?? '' }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
