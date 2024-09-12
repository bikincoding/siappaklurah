<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
    body {
        font-family: arial;
    }

    table,
    tr,
    td,
    th {
        border: 1px solid black;
        border-collapse: collapse;
        padding: 10px;
    }

    table {
        width: 100%;
    }

    th {
        background-color: grey;
        color: white;
    }

    .text-center {
        text-align: center;
    }
    </style>

    <script type="text/javascript">
    window.onload = function() {
        window.print();
    }
    </script>
</head>

<body>
    <h1 class="text-center">Laporan Usulan Data Bantuan <br /> Kelurahan Kerobokan Kaja</h1>
    <table>
        <tr>
            <th>No</th>
            <th>Nama</th>
            <th>KTP</th>
            <th>Jenis Usulan</th>
            <th>Tanggal</th>
            <th>Lingkungan</th>
            <th>Keterangan</th>
            <th>Status</th>
        </tr>
        @foreach ($UsulanDanaBantuans as $UsulanDanaBantuan)
        <tr>
            <td class="text-center">{{ ++$i }}</td>
            <td>{{ $UsulanDanaBantuan->nama }}</td>
            <td><img src="{{ asset('storage/usulan_ktp/'.$UsulanDanaBantuan->usulan_ktp) }}" alt="foto"
                    class="img-fluid" width="100px"></td>
            <td>{{ $UsulanDanaBantuan->bantuan->nama_bantuan }}</td>
            <td>{{ $UsulanDanaBantuan->tgl_musreng }}</td>

            <td>{{ $UsulanDanaBantuan->banjar->nama_banjar  }}</td>
            <td>{!! $UsulanDanaBantuan->keterangan !!}</td>
            <td>{{ $UsulanDanaBantuan->status_label }}</td>
        </tr>
        @endforeach
    </table>
</body>

</html>