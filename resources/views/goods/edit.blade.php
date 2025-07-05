<form id="editGoodsForm">
    @csrf
    @method('PUT')

    <input type="hidden" name="id" value="{{ $goods->id }}">

    <div class="row g-3">
        <div class="col-md-6">
            <label>Nama Barang</label>
            <input type="text" name="nama_barang" class="form-control"
                   value="{{ old('nama_barang', $goods->nama_barang) }}"
                   placeholder="Masukkan nama barang" required>
        </div>

        <div class="col-md-3">
            <label>Jumlah</label>
            <input type="number" name="jumlah_barang" class="form-control"
                   value="{{ old('jumlah_barang', $goods->jumlah_barang) }}"
                   placeholder="0" required>
        </div>

        <div class="col-md-3">
            <label>Satuan</label>
            <select name="satuan_barang" class="form-select" required>
                <option value="" disabled {{ old('satuan_barang', $goods->satuan_barang) == '' ? 'selected' : '' }}>Pilih satuan</option>
                @foreach(['pcs', 'buah', 'pack', 'dus', 'unit'] as $option)
                    <option value="{{ $option }}"
                        {{ old('satuan_barang', $goods->satuan_barang) == $option ? 'selected' : '' }}>
                        {{ ucfirst($option) }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="col-md-6">
            <label>Harga</label>
            <input type="number" name="harga_barang" class="form-control"
                   value="{{ old('harga_barang', $goods->harga_barang) }}"
                   placeholder="Masukkan harga satuan" required>
        </div>

        <div class="col-md-6">
            <label>Kode</label>
            <input type="text" name="kode_barang" class="form-control"
                   value="{{ old('kode_barang', $goods->kode_barang) }}"
                   placeholder="Kode unik barang" required>
        </div>

        <div class="col-12">
            <label>Spesifikasi</label>
            <textarea name="spesifikasi" class="form-control" rows="4" style="resize: vertical;" placeholder="Masukkan spesifikasi barang...">{{ old('spesifikasi', $goods->spesifikasi) }}</textarea>
        </div>

    <div class="text-end">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
        <button type="submit" class="btn btn-primary">Update</button>
    </div>
</form>
