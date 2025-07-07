<ul class="list-group">
    <li class="list-group-item"><strong>No PO:</strong> {{ $pengeluaran->no_po }}</li>
    <li class="list-group-item"><strong>Tanggal:</strong> {{ \Carbon\Carbon::parse($pengeluaran->tanggal)->format('Y-m-d') }}</li>
    <li class="list-group-item"><strong>Nama PO:</strong> {{ $pengeluaran->nama_po }}</li>
    <li class="list-group-item"><strong>Total:</strong> Rp{{ number_format($pengeluaran->total) }}</li>
    <li class="list-group-item"><strong>Keterangan:</strong> {{ $pengeluaran->keterangan }}</li>
    <li class="list-group-item"><strong>Dibuat:</strong> {{ $pengeluaran->created_at->format('Y-m-d H:i:s') }}</li>
    <li class="list-group-item"><strong>Diubah:</strong> {{ $pengeluaran->updated_at->format('Y-m-d H:i:s') }}</li>
</ul>
