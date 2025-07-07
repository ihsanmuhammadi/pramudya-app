<form id="editPengeluaranForm">
    @csrf
    @method('PUT')
    <input type="hidden" name="id" value="{{ $pengeluaran->id }}">

    <div class="row g-3 mb-3">
        <div class="col-md-6">
            <label>No PO</label>
            <input type="text" name="no_po" class="form-control"
                value="{{ old('no_po', $pengeluaran->no_po) }}"
                placeholder="Masukkan Nomor PO" required>
        </div>

        <div class="col-md-6">
            <label>Tanggal</label>
            <input type="date" name="tanggal" class="form-control"
                value="{{ old('tanggal', $pengeluaran->tanggal) }}"
                required>
        </div>

        <div class="col-md-6">
            <label>Nama PO</label>
            <input type="text" name="nama_po" class="form-control"
                value="{{ old('nama_po', $pengeluaran->nama_po) }}"
                placeholder="Masukkan Nama PO" required>
        </div>

        <div class="col-md-6">
            <label>Total</label>
            <input type="number" name="total" class="form-control"
                value="{{ old('total', $pengeluaran->total) }}"
                placeholder="Total pengeluaran" required>
        </div>

        <div class="col-md-12">
            <label>Keterangan</label>
            <textarea name="keterangan" class="form-control" rows="3"
                placeholder="Masukkan keterangan tambahan">{{ old('keterangan', $pengeluaran->keterangan) }}</textarea>
        </div>
    </div>

    <div class="text-end">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
        <button type="submit" class="btn btn-primary">Update</button>
    </div>
</form>
