<form id="editGoodsForm">
    @csrf
    @method('PUT')

    <input type="hidden" name="id" value="{{ $goods->id }}">

    <div class="mb-3">
        <label>Nama Barang</label>
        <input type="text" name="nama_barang" class="form-control"
               value="{{ old('nama_barang', $goods->nama_barang) }}">
    </div>

    <div class="mb-3">
        <label>Jumlah</label>
        <input type="number" name="jumlah_barang" class="form-control"
               value="{{ old('jumlah_barang', $goods->jumlah_barang) }}">
    </div>

    <div class="mb-3">
        <label>Satuan</label>
        <input type="text" name="satuan_barang" class="form-control"
               value="{{ old('satuan_barang', $goods->satuan_barang) }}">
    </div>

    <div class="mb-3">
        <label>Harga</label>
        <input type="number" name="harga_barang" class="form-control"
               value="{{ old('harga_barang', $goods->harga_barang) }}">
    </div>

    <div class="mb-3">
        <label>Kode</label>
        <input type="text" name="kode_barang" class="form-control"
               value="{{ old('kode_barang', $goods->kode_barang) }}">
    </div>

    <div class="mb-3">
        <label>Spesifikasi</label>
        <textarea name="spesifikasi" class="form-control">{{ old('spesifikasi', $goods->spesifikasi) }}</textarea>
    </div>

    <div class="text-end">
        <button type="submit" class="btn btn-primary">Update</button>
    </div>
</form>
