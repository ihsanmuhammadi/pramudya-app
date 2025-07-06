<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Surat Jalan</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
            color: red;
        }
        .logo {
            width: 180px;
            margin-bottom: 5px;
        }
        .alamat {
            font-size: 10px;
            color: black;
            margin-bottom: 15px;
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
        .footer {
            margin-top: 30px;
            width: 100%;
        }
        .footer td {
            text-align: center;
        }
        .note {
            font-size: 10px;
            text-align: center;
            margin-top: 20px;
            color: black
        }
    </style>
</head>
<body>

<table class="header-table">
    <tr>
        <td style="width: 70%;">
            <img src="{{ public_path('images/pp.jpeg') }}" class="logo" alt="Logo">
            <div class="alamat">
                Kp. Kebon Kalapa RT. 03 RW. 03 No. 49 Banjaran - Bandung<br>
                Telp. 0813 2300 0049
            </div>
            <div><strong>SURAT JALAN NO. {{ $no_surat ?? '......' }}</strong></div>
            <div>Bersama ini kendaraan ................................................. No. PO. ..............</div>
            <div> Kami kirimkan barang-barang tersebut di bawah ini. Harap diterima dengan baik. </div>
        </td>
        <td style="width: 30%;">
            <div>Bandung, {{ $tanggal ?? '........' }}</div><br>
            <div><strong>Kepada Yth:</strong></div>
            <div>Tuan/Toko ...........................................</div>
            <div>.....................................................</div>
            <div>.....................................................</div>
            <div>.....................................................</div>
            <br>
            <div style="color:black;"><strong>PO No.</strong></div>
        </td>
    </tr>
</table>

<br>

<table class="data-table">
    <thead>
        <tr>
            <th style="width:20%;">BANYAKNYA</th>
            <th style="width:40%;">NAMA BARANG</th>
            <th style="width:40%;">KETERANGAN</th>
        </tr>
    </thead>
    <tbody>
        {{-- @foreach($items as $item) --}}
        <tr>
            {{-- <td>{{ $item['qty'] }}</td>
            <td>{{ $item['nama_barang'] }}</td>
            <td>{{ $item['keterangan'] }}</td> --}}
        </tr>
        {{-- @endforeach --}}
    </tbody>
</table>
<div class="note">
    <strong># Note: Setelah Barang Diterima Mohon Dicek #</strong>
</div>

<br><br>

<table class="footer">
    <tr>
        <td>
            Tanda Terima<br><br><br>
            (..............................)
        </td>
        <td>
            Hormat Kami<br><br><br>
            (CV Pramudya Putra)
        </td>
    </tr>
</table>

</body>
</html>
