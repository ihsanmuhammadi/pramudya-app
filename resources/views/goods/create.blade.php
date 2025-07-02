@extends('layouts.admin')

@section('title', 'Tambah Barang')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0"><i class="fas fa-plus"></i> Tambah Barang Baru</h5>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('goods.store') }}">
                    @csrf

                    <div class="mb-3">
                        <label for="nama_barang" class="form-label">Nama Barang</label>
                        <input type="text" class="form-control @error('nama_barang') is-invalid @enderror"
                               id="nama_barang" name="nama_barang" value="{{ old('nama_barang') }}" required>
                        @error('nama_barang')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="jumlah_barang" class="form-label">Jumlah Barang</label>
                                <input type="number" class="form-control @error('jumlah_barang') is-invalid @enderror"
                                       id="jumlah_barang" name="jumlah_barang" value="{{ old('jumlah_barang') }}"
                                       min="0" required>
                                @error('jumlah_barang')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="satuan_barang" class="form-label">Satuan Barang</label>
                                <input type="number" class="form-control @error('satuan_barang') is-invalid @enderror"
                                       id="satuan_barang" name="satuan_barang" value="{{ old('satuan_barang') }}"
                                       min="1" required>
                                @error('satuan_barang')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="harga_barang" class="form-label">Harga Barang</label>
                                <div class="input-group">
                                    <span class="input-group-text">Rp</span>
                                    <input type="number" class="form-control @error('harga_barang') is-invalid @enderror"
                                           id="harga_barang" name="harga_barang" value="{{ old('harga_barang') }}"
                                           min="0" step="0.01" required>
                                </div>
                                @error('harga_barang')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="kode_barang" class="form-label">Kode Barang</label>
                                <input type="text" class="form-control @error('kode_barang') is-invalid @enderror"
                                       id="kode_barang" name="kode_barang" value="{{ old('kode_barang') }}" required>
                                @error('kode_barang')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="spesifikasi" class="form-label">Spesifikasi / Catatan</label>
                        <textarea class="form-control @error('spesifikasi') is-invalid @enderror"
                                  id="spesifikasi" name="spesifikasi" rows="3">{{ old('spesifikasi') }}</textarea>
                        @error('spesifikasi')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="d-flex justify-content-between">
                        <a href="{{ route('goods.index') }}" class="btn btn-secondary">
                            <i class="fas fa-arrow-left"></i> Kembali
                        </a>
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save"></i> Simpan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
