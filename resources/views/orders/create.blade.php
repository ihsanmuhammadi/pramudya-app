<div class="row g-3 mb-3">
    <div class="col-md-3">
        <label>No PO</label>
        <input type="text" name="no_po" class="form-control"
            value="{{ isset($order) ? $order->no_po : '' }}" required>
    </div>
    <div class="col-md-3">
        <label>Tanggal</label>
        <input type="date" name="tanggal" class="form-control"
            value="{{ isset($order) ? $order->tanggal : '' }}" required>
    </div>
    <div class="col-md-6">
        <label>Nama PO</label>
        <input type="text" name="nama_po" class="form-control"
            value="{{ isset($order) ? $order->nama_po : '' }}" required>
    </div>
    <div class="col-md-6">
        <label>Company</label>
        <input type="text" name="company" class="form-control"
            value="{{ isset($order) ? $order->company : '' }}" required>
    </div>
    <div class="col-md-6">
        <label>PIC</label>
        <input type="text" name="pic" class="form-control"
            value="{{ isset($order) ? $order->pic : '' }}" required>
    </div>
    <div class="col-md-3">
        <label>No Telp</label>
        <input type="text" name="no_telp" class="form-control"
            value="{{ isset($order) ? $order->no_telp : '' }}" required>
    </div>
    <div class="col-md-3">
        <label>Fax</label>
        <input type="text" name="fax" class="form-control"
            value="{{ isset($order) ? $order->fax : '' }}">
    </div>
    <div class="col-md-6">
        <label>Email</label>
        <input type="email" name="email" class="form-control"
            value="{{ isset($order) ? $order->email : '' }}" required>
    </div>
    <div class="col-md-6">
        <label>Alamat</label>
        <textarea name="alamat" class="form-control" rows="2" required>{{ isset($order) ? $order->alamat : '' }}</textarea>
    </div>
    <div class="col-md-6">
        <label>Keterangan</label>
        <textarea name="keterangan" class="form-control" rows="2">{{ isset($order) ? $order->keterangan : '' }}</textarea>
    </div>
</div>

<h5 class="fw-bold mb-3">Detail Barang</h5>

<div class="border rounded p-3 mb-3"
     style="max-height: 150px; overflow-y: auto;"
     id="{{ isset($edit) && $edit ? 'editItemsRepeater' : 'itemsRepeater' }}">
    @if(isset($order) && isset($edit))
        @foreach($order->items as $index => $item)
        <div class="row g-2 align-items-end item-row mb-2">
            <div class="col-md-6">
                <select name="items[{{ $index }}][goods_id]" class="form-select" required>
                    <option value="" selected disabled>Pilih Barang</option>
                    @foreach($goods as $g)
                        <option value="{{ $g->id }}" {{ $item->goods_id == $g->id ? 'selected' : '' }}>
                            {{ $g->nama_barang }} (Stok: {{ $g->jumlah_barang }})
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-3">
                <input type="number" name="items[{{ $index }}][jumlah_barang]"
                       class="form-control" value="{{ $item->jumlah_barang }}" min="1" required>
            </div>
            <div class="col-md-3">
                <button type="button" class="btn btn-danger remove-item w-100">
                    <i class="bi bi-trash"></i>
                </button>
            </div>
        </div>
        @endforeach
    @else
        <div class="row g-2 align-items-end item-row mb-2">
            <div class="col-md-6">
                <select name="items[0][goods_id]" class="form-select" required>
                    <option value="" selected disabled>Pilih Barang</option>
                    @foreach($goods as $g)
                        <option value="{{ $g->id }}">{{ $g->nama_barang }} (Stok: {{ $g->jumlah_barang }})</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-3">
                <input type="number" name="items[0][jumlah_barang]" class="form-control" min="1" required>
            </div>
            <div class="col-md-3">
                <button type="button" class="btn btn-danger remove-item w-100">
                    <i class="bi bi-trash"></i>
                </button>
            </div>
        </div>
    @endif
</div>

<button type="button" class="btn btn-success"
    id="{{ isset($edit) && $edit ? 'addEditItem' : 'addItem' }}">
    <i class="bi bi-plus-circle"></i> Tambah Barang
</button>

<script>
$(document).on('click', '.remove-item', function(){
    if ($('.item-row').length <= 1) {
        showToast('Order minimal memiliki satu barang!', 'error');
        return;
    }
    $(this).closest('.item-row').remove();
});
</script>

