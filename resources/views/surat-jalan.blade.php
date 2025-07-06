<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Surat Jalan</title>
    <style>
        @page { size: 21.5cm 17cm landscape;}
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
            color: red;
        }
        .logo {
            width: 300px;
            margin-bottom: 5px;
        }
        .alamat {
            font-size: 8px;
            color: black;
            margin-bottom: 15px;
            justify-content: center;
            margin-left: 105px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        .header-table td {
            vertical-align: top;
        }
        .data-table th, .data-table td {
            border: 1px solid red;
            padding: 5px;
        }
        .footer td { text-align: center; }
        .note {
            font-size: 10px;
            text-align: center;
            margin-top: 5px;
            color: black;
        }
    </style>
</head>
<body>

<table class="header-table">
    <tr>
        <td style="width: 65%;">
            <img src="{{ public_path('images/pp.jpeg') }}" class="logo" alt="Logo">
            <div class="alamat">
                Kp. Kebon Kalapa RT. 03 RW. 03 No. 49<br>
                Banjaran - Bandung Telp. 0813 2300 0049
            </div>
            <div><strong>SURAT JALAN NO. {{ $no_surat ?? '......' }}</strong></div>
            <div>Bersama ini kendaraan {{ $kendaraan ?? '................' }} No. PO. {{ $no_po ?? '........' }}</div>
            <div style="margin-bottom: 2px">Kami kirimkan barang-barang tersebut di bawah ini. Harap diterima dengan baik.</div>
        </td>
        <td style="width: 35%;">
            <div>Bandung, {{ $tanggal ? \Carbon\Carbon::parse($tanggal)->translatedFormat('d F Y') : '........' }}</div><br>
            <div><strong>Kepada Yth:</strong></div>
            <div>Tuan/Toko {{ $penerima ?? '............................' }}</div>
            <div style="margin-left: 20px; text-align: justify">{{ $alamat_penerima ?? '............................' }}</div>
            <div style="margin-left: 20px">{{ $keterangan_penerima ?? '' }}</div>
            <br><br>
            <div style="color:black;"><strong>PO No. {{ $no_po ?? '........' }}</strong></div>
        </td>
    </tr>
</table>

<table class="data-table">
    <thead>
        <tr>
            <th style="width:20%;">BANYAKNYA</th>
            <th style="width:60%;">NAMA BARANG</th>
            <th style="width:20%;">KETERANGAN</th>
        </tr>
    </thead>
    <tbody>
        @foreach($items as $item)
        <tr>
            <td>{{ $item['qty'] }}</td>
            <td>{{ $item['nama_barang'] }}</td>
            <td>{{ $item['keterangan'] }}</td>
        </tr>
        @endforeach
    </tbody>
</table>

<div class="note">
    <strong># Note: Setelah Barang Diterima Mohon Dicek #</strong>
</div>

<table class="footer">
    <tr>
        <td>
            Tanda Terima<br><br><br><br>
            (..............................)
        </td>
        <td>
            Hormat Kami,<br><br><br><br>
            <div style="color: black">(CV Pramudya Putra)</div>
        </td>
    </tr>
</table>

</body>
</html>
