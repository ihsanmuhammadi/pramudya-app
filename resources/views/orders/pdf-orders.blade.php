<!DOCTYPE html>
<html>
<head>
    <title>Data Orders</title>
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
        <h1>Data Orders</h1>
        <p>Exported on {{ date('d F Y H:i:s') }}</p>
    </div>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>No PO</th>
                <th>Tanggal</th>
                <th>Company</th>
                <th>PIC</th>
                <th>Total</th>
                <th>Jumlah Items</th>
            </tr>
        </thead>
        <tbody>
            @foreach($orders as $index => $order)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $order->no_po }}</td>
                <td>{{ $order->tanggal }}</td>
                <td>{{ $order->company }}</td>
                <td>{{ $order->pic }}</td>
                <td>Rp{{ number_format($order->total_semua_barang,0,',','.') }}</td>
                <td>{{ $order->items->count() }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div class="footer">
        <p>Total Orders: {{ count($orders) }}</p>
    </div>
</body>
</html>
