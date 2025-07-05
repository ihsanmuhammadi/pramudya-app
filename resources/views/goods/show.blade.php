<ul class="list-group">
    <li class="list-group-item"><strong>Nama:</strong> {{ $goods->nama_barang }}</li>
    <li class="list-group-item"><strong>Jumlah:</strong> {{ $goods->jumlah_barang }}</li>
    <li class="list-group-item"><strong>Satuan:</strong> {{ $goods->satuan_barang }}</li>
    <li class="list-group-item"><strong>Harga:</strong> Rp{{ number_format($goods->harga_barang) }}</li>
    <li class="list-group-item"><strong>Kode:</strong> {{ $goods->kode_barang }}</li>
    <li class="list-group-item"><strong>Spesifikasi:</strong> {{ $goods->spesifikasi }}</li>
    <li class="list-group-item"><strong>Dibuat:</strong> {{ $goods->created_at->format('Y-m-d H:i:s') }}</li>
    <li class="list-group-item"><strong>Diubah:</strong> {{ $goods->updated_at->format('Y-m-d H:i:s') }}</li>
</ul>
