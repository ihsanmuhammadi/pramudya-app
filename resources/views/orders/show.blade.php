<div class="row mb-3">
    <div class="col-md-6 mb-2">
        <div class="border p-2 rounded"><strong>No PO:</strong> {{ $order->no_po }}</div>
    </div>
    <div class="col-md-6 mb-2">
        <div class="border p-2 rounded"><strong>Tanggal:</strong> {{ $order->tanggal }}</div>
    </div>
    <div class="col-md-6 mb-2">
        <div class="border p-2 rounded"><strong>Company:</strong> {{ $order->company }}</div>
    </div>
    <div class="col-md-6 mb-2">
        <div class="border p-2 rounded"><strong>PIC:</strong> {{ $order->pic }}</div>
    </div>
    <div class="col-md-6 mb-2">
        <div class="border p-2 rounded"><strong>No Telp:</strong> {{ $order->no_telp }}</div>
    </div>
    <div class="col-md-6 mb-2">
        <div class="border p-2 rounded"><strong>Email:</strong> {{ $order->email }}</div>
    </div>
    <div class="col-md-6 mb-2">
        <div class="border p-2 rounded"><strong>Fax:</strong> {{ $order->fax }}</div>
    </div>
    <div class="col-md-6 mb-2">
        <div class="border p-2 rounded"><strong>Total:</strong> Rp{{ number_format($order->total_semua_barang,0,',','.') }}</div>
    </div>
    <div class="col-md-6 mb-2">
        <div class="border p-2 rounded"><strong>Created:</strong> {{ $order->created_at }}</div>
    </div>
    <div class="col-md-6 mb-2">
        <div class="border p-2 rounded"><strong>Updated:</strong> {{ $order->updated_at }}</div>
    </div>

    <div class="col-md-6 d-flex flex-column">
        <h6 class="fw-bold mb-2 ml-1">Alamat</h6>
        <div class="border rounded p-2 flex-grow-1" style="max-height: 120px; overflow-y: auto;">
            {{ $order->alamat }}
        </div>
    </div>
    <div class="col-md-6 d-flex flex-column">
        <h6 class="fw-bold mb-2 ml-1">Catatan</h6>
        <div class="border rounded p-2 flex-grow-1" style="max-height: 120px; overflow-y: auto;">
            {{ $order->catatan }}
        </div>
    </div>
</div>

<h5 class="fw-bold mb-3">Detail Barang</h5>
<div class="border rounded p-2 mb-3">
    <div style="max-height: 200px; overflow-y: auto;">
        <table class="table table-bordered table-sm mb-0">
            <thead class="table-light sticky-top">
                <tr>
                    <th>Nama Barang</th>
                    <th class="text-end">Jumlah</th>
                    <th class="text-end">Harga</th>
                    <th class="text-end">Total</th>
                </tr>
            </thead>
            <tbody>
                @foreach($order->items as $item)
                <tr>
                    <td>{{ $item->goods->nama_barang }}</td>
                    <td class="text-end">{{ $item->jumlah_barang }}</td>
                    <td class="text-end">Rp{{ number_format($item->harga_barang,0,',','.') }}</td>
                    <td class="text-end">Rp{{ number_format($item->total_harga_barang,0,',','.') }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

