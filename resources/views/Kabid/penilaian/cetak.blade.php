@php
$tanggal_sebelumnya = null;
@endphp

<!DOCTYPE html>
<html lang="en">

<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Laporan</title>
<style>
    @page {
        size: A4;
        margin: 0;
    }

    body {
        margin: 2cm;
    }

    h1 {
        text-align: center;
        margin-bottom: 20px;
    }

    .logo {
        height: 80px;
        width: auto;
        display: block;
        text-align: left;
    }

    table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 20px;
    }

    th,
    td {
        border: 1px solid #000;
        padding: 8px;
        text-align: center;
    }

    .wrap-text {
        word-wrap: break-word;
        white-space: normal;
    }

    .page-break {
        page-break-after: always;
    }
</style>
</head>

<body>
@foreach ($penilaianForDisplay as $index => $pen)
    @if ($pen['penilaian']->tanggal_penilaian !== $tanggal_sebelumnya)
        @php
            $tanggal_sebelumnya = $pen['penilaian']->tanggal_penilaian;
        @endphp

        <header>
            <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/9/9e/Logo_of_People%27s_Consultative_Assembly_Indonesia.png/625px-Logo_of_People%27s_Consultative_Assembly_Indonesia.png"
                alt="Logo Perusahaan" class="logo">
            <h1 class="wrap-text">HASIL PENENTUAN PERPANJANGAN KONTRAK KERJA PEGAWAI TIDAK TETAP</h1>
        </header>

        <main>
            <p>Berikut ini merupakan hasil penilaian untuk penentuan perpanjangan kontrak kerja Pegawai Tidak Tetap (PTT) :</p>
            <p>Tanggal Penilaian: {{ $tanggal_sebelumnya }}</p>

            <table>
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Pegawai</th>
                        <th>Kedisiplinan (C1)</th>
                        <th>Kerjasama (C2)</th>
                        <th>Sikap (C3)</th>
                        <th>Kehadiran (C4)</th>
                        <th>Keahlian (C5)</th>
                        <th>Loyalitas (C6)</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody>
    @endif

    <tr>
        <td>{{ $pen['utilities']['peringkat'] }}</td>
        <td>{{ $pen['penilaian']->pegawai->nama_pegawai }}</td>
        <td>{{ isset($pen['utilities'][1]) ? $pen['utilities'][1] : '' }}</td>
        <td>{{ isset($pen['utilities'][2]) ? $pen['utilities'][2] : '' }}</td>
        <td>{{ isset($pen['utilities'][3]) ? $pen['utilities'][3] : '' }}</td>
        <td>{{ isset($pen['utilities'][4]) ? $pen['utilities'][4] : '' }}</td>
        <td>{{ isset($pen['utilities'][5]) ? $pen['utilities'][5] : '' }}</td>
        <td>{{ isset($pen['utilities'][6]) ? $pen['utilities'][6] : '' }}</td>
     
        <td>{{ $pen['utilities']['total'] }}</td>
    </tr>

    @if ($loop->last || $pen['penilaian']->tanggal_penilaian !== $penilaianForDisplay[$index + 1]['penilaian']->tanggal_penilaian)
                </tbody>
            </table>

            @php
                $sortedData = collect($pen['penilaian']['utilities'])
                    ->sortByDesc('peringkat')
                    ->values()
                    ->all();
            @endphp

        </main>

        <script>
            window.onload = function () {
                window.print();
            };
        </script>

        @if (!$loop->last)
            <div class="page-break"></div>
        @endif
    @endif
@endforeach
</body>

</html>




