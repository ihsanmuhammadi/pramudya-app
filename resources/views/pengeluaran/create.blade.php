<div class="row g-3 mb-3">
    <div class="col-md-6">
        <label>No PO</label>
        <input type="text" name="no_po" class="form-control"
            value="{{ isset($pengeluaran) ? $pengeluaran->no_po : '' }}" required>
    </div>
    <div class="col-md-6">
        <label>Tanggal</label>
        <input type="date" name="tanggal" class="form-control"
            value="{{ isset($pengeluaran) ? $pengeluaran->tanggal : '' }}" required>
    </div>
    <div class="col-md-6">
        <label>Nama PO</label>
        <input type="text" name="nama_po" class="form-control"
            value="{{ isset($pengeluaran) ? $pengeluaran->nama_po : '' }}" required>
    </div>
    <div class="col-md-6">
        <label>Total</label>
        <input type="text" name="total" class="form-control"
            value="{{ isset($pengeluaran) ? $pengeluaran->total : '' }}" required>
    </div>
    <div class="col-md-12">
        <label>Keterangan</label>
        <textarea name="keterangan" class="form-control" rows="2">{{ isset($pengeluaran) ? $pengeluaran->keterangan : '' }}</textarea>
    </div>
</div>

