<!DOCTYPE html>
<html>
<head>
    <title>Data Pengeluaran</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; }
        .header { text-align: center; margin-bottom: 30px; }
        .header h1 { color: #333; margin-bottom: 5px; }
        .header p { color: #666; margin: 0; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }
        th { background-color: #f2f2f2; font-weight: bold; }
        tr:nth-child(even) { background-color: #f9f9f9; }
        .footer { margin-top: 30px; text-align: right; font-size: 12px; color: #666; }
    </style>
</head>
<body>
    <div class="header">
        <h1>Data Pengeluaran</h1>
        <p>Diekspor pada {{ date('d F Y H:i:s') }}</p>
    </div>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>No PO</th>
                <th>Tanggal</th>
                <th>Nama PO</th>
                <th>Total</th>
                <th>Keterangan</th>
                <th>Dibuat Oleh</th>
            </tr>
        </thead>
        <tbody>
            @foreach($pengeluaran as $index => $item)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $item->no_po }}</td>
                <td>{{ $item->tanggal }}</td>
                <td>{{ $item->nama_po }}</td>
                <td>Rp{{ number_format($item->total, 0, ',', '.') }}</td>
                <td>{{ $item->keterangan }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div class="footer">
        <
