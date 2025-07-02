@extends('admin.layout.app')

@section('title', 'Detail Barang')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0"><i class="fas fa-eye"></i> Detail Barang</h5>
            </div>
            <div class="card-body">
                <div class="row mb-3">
                    <div class="col-sm-3"><strong>Kode Barang:</strong></div>
                    <div class="col-sm-9"><code>{{ $barang->kode_barang }}</code></div>
                </div>

                <div class="row mb-3">
                    <div class="col-sm-3"><strong>Nama Barang:</strong></div>
                    <div class="col-sm-9">{{ $barang->nama_barang }}</div>
                </div>

                <div class="row mb-3">
                    <div class="col-sm-3"><strong>Jumlah:</strong></div>
                    <div class="col-sm-9">{{ number_format($barang->jumlah_barang) }}</div>
                </div>

                <div class="row mb-3">
                    <div class="col-sm-3"><strong>Satuan:</strong></div>
                    <div class="col-sm-9">{{ $barang->satuan_barang }}</div>
                </div>

                <div class="row mb-3">
                    <div class="col-sm-3"><strong>Harga:</strong></div>
                    <div class="col-sm-9">Rp {{ number_format($barang->harga_barang, 0, ',', '.') }}</div>
                </div>

                <div class="row mb-3">
                    <div class="col-sm-3"><strong>Spesifikasi:</strong></div>
                    <div class="col-sm-9">{{ $barang->spesifikasi ?: '-' }}</div>
                </div>

                <div class="row mb-3">
                    <div class="col-sm-3"><strong>Dibuat:</strong></div>
                    <div class="col-sm-9">{{ $barang->created_at->format('d/m/Y H:i') }}</div>
                </div>

                <div class="row mb-3">
                    <div class="col-sm-3"><strong>Diperbarui:</strong></div>
                    <div class="col-sm-9">{{ $barang->updated_at->format('d/m/Y H:i') }}</div>
                </div>

                <div class="d-flex justify-content-between">
                    <a href="{{ route('admin.barang.index') }}" class="btn btn-secondary">
                        <i class="fas fa-arrow-left"></i> Kembali
                    </a>
                    <div>
                        <a href="{{ route('admin.barang.edit', $barang) }}" class="btn btn-warning">
                            <i class="fas fa-edit"></i> Edit
                        </a>
                        <form method="POST" action="{{ route('admin.barang.destroy', $barang) }}"
                              class="d-inline ms-2" onsubmit="return confirm('Yakin ingin menghapus data ini?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">
                                <i class="fas fa-trash"></i> Hapus
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
