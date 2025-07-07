<!DOCTYPE html>
<html>
<head>
    <title>Data Pendapatan</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; }
        .header { text-align: center; margin-bottom: 30px; }
        .header h1 { color: #333; margin-bottom: 5px; }
        .header p { color: #666; margin: 0; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #ddd; padding: 8px; text-align: left; font-size: 13px; }
        th { background-color: #f2f2f2; font-weight: bold; }
        tr:nth-child(even) { background-color: #f9f9f9; }
        .footer { margin-top: 30px; text-align: right; font-size: 12px; color: #666; }
    </style>
</head>
<body>
    <div class="header">
        <h1>Data Pendapatan</h1>
        <p>Exported on {{ date('d F Y H:i:s') }}</p>
    </div>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>No PO</th>
                <th>Nama PO</th>
                <th>Tanggal Order</th>
                <th>Total Pendapatan</th>
                <th>Dicatat Pada</th>
            </tr>
        </thead>
        <tbody>
            @foreach($pendapatan as $index => $p)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $p->order->no_po ?? '-' }}</td>
                <td>{{ $p->order->nama_po ?? '-' }}</td>
                <td>{{ $p->order->tanggal ?? '-' }}</td>
                <td>Rp{{ number_format($p->order->total_semua_barang ?? 0, 0, ',', '.') }}</td>
                <td>{{ $p->created_at->format('d-m-Y H:i') }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div class="footer">
        <p>Total Pendapatan: {{ count($pendapatan) }}</p>
    </div>
</body>
</html>
