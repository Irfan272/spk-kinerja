@extends('User.master.master')

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
            @php
                $tanggal_sebelumnya = null;
            @endphp

            @foreach ($penilaianForDisplay as $index => $pen)
                @if ($pen['penilaian']->tanggal_penilaian !== $tanggal_sebelumnya)
                    @php
                        $tanggal_sebelumnya = $pen['penilaian']->tanggal_penilaian;
                    @endphp

                    <div class="card" id="tabelContainer-{{ $index }}">
                        <div class="card-body">
                            <h5 class="card-title">List Data Penilaian - {{ $tanggal_sebelumnya }}</h5>
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
                                        <th scope="col">Total</th>
                                        <th scope="col">Peringkat</th>
                                    </tr>
                                </thead>
                                <tbody>
                @endif

                <tr>
                    <th scope="row">{{ $pen['utilities']['peringkat'] }}</th>
                    <td>{{ $pen['penilaian']->pegawai->nama_pegawai }}</td>
                    <td>{{ isset($pen['utilities'][1]) ? $pen['utilities'][1] : '' }}</td>
                    <td>{{ isset($pen['utilities'][2]) ? $pen['utilities'][2] : '' }}</td>
                    <td>{{ isset($pen['utilities'][3]) ? $pen['utilities'][3] : '' }}</td>
                    <td>{{ isset($pen['utilities'][4]) ? $pen['utilities'][4] : '' }}</td>
                    <td>{{ isset($pen['utilities'][5]) ? $pen['utilities'][5] : '' }}</td>
                    <td>{{ isset($pen['utilities'][6]) ? $pen['utilities'][6] : '' }}</td>
                    <td>{{ $pen['utilities']['total'] }}</td>
                    <td>{{ $pen['utilities']['peringkat'] }}</td>
                </tr>

                @if ($loop->last || $pen['penilaian']->tanggal_penilaian !== $penilaianForDisplay[$index + 1]['penilaian']->tanggal_penilaian)
                                </tbody>
                            </table>
                        </div>
                    </div>
                @endif
            @endforeach

            <a href="/user/cetak" class="btn btn-primary">Cetak Tabel</a>
        </div>
    </div>
</section>
@endsection
