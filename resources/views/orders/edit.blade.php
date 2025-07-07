<form id="editOrderForm">
    @csrf
    @method('PUT')
    <input type="hidden" name="id" value="{{ $order->id }}">

    <div class="row g-3 mb-3">
        <div class="col-md-3">
            <label>No PO</label>
            <input type="text" name="no_po" class="form-control" value="{{ $order->no_po }}" required>
        </div>
        <div class="col-md-3">
            <label>Tanggal</label>
            <input type="date" name="tanggal" class="form-control" value="{{ $order->tanggal }}" required>
        </div>
        <div class="col-md-6">
            <label>Nama PO</label>
            <input type="text" name="nama_po" class="form-control" value="{{ $order->nama_po }}" required>
        </div>
        <div class="col-md-6">
            <label>Company</label>
            <input type="text" name="company" class="form-control" value="{{ $order->company }}" required>
        </div>
        <div class="col-md-6">
            <label>PIC</label>
            <input type="text" name="pic" class="form-control" value="{{ $order->pic }}" required>
        </div>
        <div class="col-md-3">
            <label>No Telp</label>
            <input type="text" name="no_telp" class="form-control" value="{{ $order->no_telp }}" required>
        </div>
        <div class="col-md-3">
            <label>Fax</label>
            <input type="text" name="fax" class="form-control" value="{{ $order->fax }}">
        </div>
        <div class="col-md-6">
            <label>Email</label>
            <input type="email" name="email" class="form-control" value="{{ $order->email }}" required>
        </div>
         <div class="col-md-6">
            <label>Alamat</label>
            <textarea name="alamat" class="form-control" rows="2" required>{{ $order->alamat }}</textarea>
        </div>
        <div class="col-md-6">
            <label>Keterangan</label>
            <textarea name="keterangan" class="form-control" rows="2">{{ $order->keterangan }}</textarea>
        </div>
    </div>

    <h5 class="fw-bold mb-3">Detail Barang</h5>

<div class="border rounded p-3 mb-3"
     style="max-height: 150px; overflow-y: auto;"
     id="editItemsRepeater">
    @foreach($order->items as $index => $item)
    <div class="d-flex align-items-center gap-2 item-row mb-2">
    <div class="mr-2" style="flex: 0 0 32%;">
        <select name="items[{{ $index }}][goods_id]" class="form-select" required>
            <option value="" selected disabled>Pilih Barang</option>
            @foreach($goods as $g)
                <option value="{{ $g->id }}" {{ $item->goods_id == $g->id ? 'selected' : '' }}>
                    {{ $g->nama_barang }} (Stok: {{ $g->jumlah_barang }})
                </option>
            @endforeach
        </select>
    </div>
    <div class="mr-2" style="flex: 0 0 23.4%;">
        <input type="number" name="items[{{ $index }}][jumlah_barang]"
               class="form-control" value="{{ $item->jumlah_barang }}" min="1" required>
    </div>
    <div style="flex: 0 0 5%;">
        <button type="button" class="btn btn-danger w-100 remove-item">
            <i class="bi bi-trash"></i>
        </button>
    </div>
</div>

    @endforeach
</div>


<button type="button" class="btn btn-success" id="addEditItem">
    <i class="bi bi-plus-circle"></i> Tambah Barang
</button>


    <div class="text-end mt-3">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
        <button type="submit" class="btn btn-primary">Update</button>
    </div>
</form>

<script>
function initEditModal() {
    let editItemIndex = {{ count($order->items) }};
    const goodsOptions = `{!! collect($goods)->map(function($g) {
        return "<option value='{$g->id}'>{$g->nama_barang} (Stok: {$g->jumlah_barang})</option>";
    })->implode('') !!}`;

    $('#editModal').off('click', '#addEditItem').on('click', '#addEditItem', function(){
        const newItem = `
            <div class="row g-3 align-items-end item-row mb-2">
                <div class="col-md-4">
                    <select name="items[${editItemIndex}][goods_id]" class="form-select" required>
                        <option value="" selected disabled>Pilih Barang</option>
                        ${goodsOptions}
                    </select>
                </div>
                <div class="col-md-3">
                    <input type="number" name="items[${editItemIndex}][jumlah_barang]" class="form-control" min="1" required>
                </div>
                <div class="col-md-3">
                    <button type="button" class="btn btn-danger remove-item">
                        <i class="bi bi-trash"></i>
                    </button>
                </div>
            </div>`;
        $('#editItemsRepeater').append(newItem);
        editItemIndex++;
    });

    $('#editModal').off('click', '.remove-item').on('click', '.remove-item', function(){
        if ($('#editItemsRepeater .item-row').length <= 1) {
            showToast('Order minimal memiliki satu barang!', 'error');
            return;
        }
        $(this).closest('.item-row').remove();
    });
}

// panggil langsung supaya saat $.get selesai, dia initialize
initEditModal();
</script>
