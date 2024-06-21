<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Human Resource Potential Table</title>
    <style>
    .human-resource-table {
        width: 100%;
        border-collapse: collapse;
        margin-bottom: 20px;
    }

    .human-resource-table th,
    .human-resource-table td {
        border: 1px solid black;
        padding: 8px;
        text-align: left;
    }

    .human-resource-table th {
        background-color: #f2f2f2;
    }

    .human-resource-table caption {
        caption-side: top;
        font-size: 1.5em;
        font-weight: bold;
        margin: 10px 0;
    }
    </style>

    <script type="text/javascript">
    window.onload = function() {
        window.print();
    }
    </script>
</head>

<body>

    <table class="human-resource-table">
        <caption>II. POTENSI SUMBER DAYA MANUSIA</caption>
        <caption>KELURAHAN KEROBOKAN KAJA BULAN {{strtoupper($laporanBulanTahun->bulan)}} TAHUN
            {{$laporanBulanTahun->tahun}} </caption>
        <thead>
            <tr>
                <th colspan="2">A. JUMLAH</th>

            </tr>
        </thead>
        <tbody>
            <tr>
                <td>Jumlah laki-laki</td>
                <td>{{ $sumberDayaManusia->jumlah_laki_laki }} orang</td>
            </tr>
            <tr>
                <td>Jumlah perempuan</td>
                <td>{{ $sumberDayaManusia->jumlah_perempuan }} orang</td>
            </tr>
            <tr>
                <td>Jumlah total</td>
                <td>{{ $sumberDayaManusia->jumlah_total }} orang</td>
            </tr>
            <tr>
                <td>Jumlah kepala keluarga</td>
                <td>{{ $sumberDayaManusia->jumlah_kepala_keluarga }} KK</td>
            </tr>
            <tr>
                <td>Kepadatan Penduduk</td>
                <td>{{ $sumberDayaManusia->kepadatan_penduduk }} per KM</td>
            </tr>
        </tbody>
    </table>

    <table class="human-resource-table">

        <thead>
            <tr>
                <th colspan="3">B. USIA</th>
            </tr>
            <tr>
                <th>Usia</th>
                <th>Laki-laki</th>
                <th>Perempuan</th>

            </tr>
        </thead>
        <tbody>
            @foreach($usias as $usia)
            <tr>
                <td>{{ $usia->usia }}</td>
                <td>{{ $usia->total_laki_laki }} orang</td>
                <td>{{ $usia->total_perempuan }} orang</td>
            </tr>
            @endforeach

        </tbody>
    </table>


    <!-- Continue from the previous tables -->

    <!-- Section C: Pendidikan (Education) -->
    <table class="human-resource-table">

        <thead>
            <tr>
                <th colspan="3">C. PENDIDIKAN</th>
            </tr>
            <tr>
                <th>Tingkatan Pendidikan</th>
                <th>Laki-laki</th>
                <th>Perempuan</th>
            </tr>
        </thead>
        <tbody>

            @foreach($pendidikans as $pendidikan)
            <tr>
                <td>{{ $pendidikan->tingkatan_pendidikan }}</td>
                <td>{{ $pendidikan->total_laki_laki }} orang</td>
                <td>{{ $pendidikan->total_perempuan }} orang</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Section D: Mata Pencaharian Pokok (Main Occupation) -->
    <table class="human-resource-table">
        <thead>
            <tr>
                <th colspan="3">D. MATA PENCAHARIAN POKOK</th>
            </tr>
            <tr>
                <th>Jenis Pekerjaan</th>
                <th>Laki-laki</th>
                <th>Perempuan</th>
            </tr>
        </thead>
        <tbody>
            @foreach($matapencaharianpokoks as $mp)
            <tr>
                <td>{{ $mp->jenis_pekerjaan }}</td>
                <td>{{ $mp->total_laki_laki }} orang</td>
                <td>{{ $mp->total_perempuan }} orang</td>
            </tr>
            @endforeach

            <tr>
                <td>Jumlah Total Penduduk</td>
                <td>{{ $total_laki_laki_mp }} orang </td>
                <td>{{ $total_perempuan_mp }} orang </td> <!-- Assumed blank based on the pattern -->
            </tr>
        </tbody>
    </table>

    <!-- Continuation from the previous tables -->

    <!-- Section E: Agama/Aliran Kepercayaan (Religion/Belief Systems) -->
    <table class="human-resource-table">
        <thead>
            <tr>
                <th colspan="3">E. AGAMA/ALIRAN KEPERCAYAAN</th>
            </tr>
            <tr>
                <th>Agama</th>
                <th>Laki-laki</th>
                <th>Perempuan</th>
            </tr>
        </thead>
        <tbody>
            @foreach($agamas as $agama)
            <tr>
                <td>{{ $agama->agama }}</td>
                <td>{{ $agama->total_laki_laki }} orang</td>
                <td>{{ $agama->total_perempuan }} orang</td>
            </tr>
            @endforeach
            <!-- Add additional rows as necessary -->
            <tr>
                <td>Jumlah</td>
                <td>{{ $total_laki_laki_ag }} orang</td>
                <td>{{ $total_perempuan_ag }} orang</td>
            </tr>
        </tbody>
    </table>

    <!-- Section F: Kewarganegaraan (Citizenship) -->
    <table class="human-resource-table">
        <thead>
            <tr>
                <th colspan="3">F. KEWARGANEGARAAN</th>
            </tr>
            <tr>
                <th>Kewarganegaraan</th>
                <th>Laki-laki</th>
                <th>Perempuan</th>
            </tr>
        </thead>
        <tbody>
            @foreach($kewarganegaraans as $kewarganegaraan)
            <tr>
                <td>{{ $kewarganegaraan->kewarganegaraan }}</td>
                <td>{{ $kewarganegaraan->total_laki_laki }} orang</td>
                <td>{{ $kewarganegaraan->total_perempuan }} orang</td>
            </tr>
            @endforeach
            <tr>
                <td>Jumlah</td>
                <td>{{$total_laki_laki_kwg}} orang</td>
                <td>{{$total_perempuan_kwg}} orang</td>
            </tr>
        </tbody>
    </table>

    <!-- Section G: Etnis (Ethnicity) -->
    <table class="human-resource-table">
        <thead>
            <tr>
                <th colspan="3">G. ETNIS</th>
            </tr>
            <tr>
                <th>Etnis</th>
                <th>Laki-laki</th>
                <th>Perempuan</th>
            </tr>
        </thead>
        <tbody>
            @foreach($etniss as $etnis)
            <tr>
                <td>{{ $etnis->etnis }}</td>
                <td>{{ $etnis->total_laki_laki }} orang</td>
                <td>{{ $etnis->total_perempuan }} orang</td>
            </tr>
            @endforeach
            <!-- Add additional rows as necessary -->

        </tbody>
    </table>

    <!-- Continuation from the previous tables -->

    <!-- Section H: Cacat Mental dan Fisik (Mental and Physical Disabilities) -->
    <table class="human-resource-table">
        <thead>
            <tr>
                <th colspan="3">H. CACAT MENTAL DAN FISIK</th>
            </tr>
            <tr>
                <th>Jenis Cacat</th>
                <th>Laki-laki</th>
                <th>Perempuan</th>
            </tr>
        </thead>
        <tbody>
            @foreach($cacats as $cacat)
            <tr>
                <td>{{ $cacat->jenis_cacat }}</td>
                <td>{{ $cacat->total_laki_laki }} orang</td>
                <td>{{ $cacat->total_perempuan }} orang</td>
            </tr>
            @endforeach

            <tr>
                <td>Jumlah</td>
                <td>{{$total_laki_laki_cct}} orang</td>
                <td>{{$total_perempuan_cct}} orang</td>
            </tr>
        </tbody>
    </table>

    <!-- Section I: Tenaga Kerja (Workforce) -->
    <table class="human-resource-table">
        <thead>
            <tr>
                <th colspan="3">I. TENAGA KERJA</th>
            </tr>
            <tr>
                <th>Tenaga Kerja</th>
                <th>Laki-laki</th>
                <th>Perempuan</th>
            </tr>
        </thead>
        <tbody>
            @foreach($tenagakerjas as $tenagakerja)
            <tr>
                <td>{{ $tenagakerja->tenaga_kerja }}</td>
                <td>{{ $tenagakerja->total_laki_laki }} orang</td>
                <td>{{ $tenagakerja->total_perempuan }} orang</td>
            </tr>
            @endforeach
            <!-- Add additional rows as necessary -->
            <tr>
                <td>Jumlah</td>
                <td>{{$total_laki_laki_tk}} orang</td>
                <td>{{$total_perempuan_tk}} orang</td> <!-- Assuming no corresponding value for Perempuan -->
            </tr>
        </tbody>
    </table>

    <!-- Section J: Kualitas Angkatan Kerja (Quality of the Workforce) -->
    <table class="human-resource-table">
        <thead>
            <tr>
                <th colspan="3">J. KUALITAS ANGKATAN KERJA</th>
            </tr>
            <tr>
                <th>Angkatan Kerja</th>
                <th>Laki-laki</th>
                <th>Perempuan</th>
            </tr>
        </thead>
        <tbody>
            @foreach($kualitasangkatankerjas as $kualitasangkatankerja)
            <tr>
                <td>{{ $kualitasangkatankerja->angkatan_kerja }}</td>
                <td>{{ $kualitasangkatankerja->total_laki_laki }} orang</td>
                <td>{{ $kualitasangkatankerja->total_perempuan }} orang</td>
            </tr>
            @endforeach
            <!-- Add additional rows as necessary -->
            <tr>
                <td>Jumlah</td>
                <td>{{$total_laki_laki_kak}} orang</td>
                <td>{{$total_perempuan_kak}} orang</td>
            </tr>
        </tbody>
    </table>

    <!-- The rest of your HTML code continues -->


</body>

</html>