@extends('layouts.admin')

@section('title', 'Data Barang')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0"><i class="fas fa-box"></i> Data Barang</h5>
                <a href="{{ route('goods.create') }}" class="btn btn-primary">
                    <i class="fas fa-plus"></i> Tambah Barang
                </a>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped table-hover">
                        <thead class="table-dark">
                            <tr>
                                <th>No</th>
                                <th>Kode Barang</th>
                                <th>Nama Barang</th>
                                <th>Jumlah</th>
                                <th>Satuan</th>
                                <th>Harga</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($goods as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td><code>{{ $item->kode_barang }}</code></td>
                                    <td>{{ $item->nama_barang }}</td>
                                    <td>{{ number_format($item->jumlah_barang) }}</td>
                                    <td>{{ $item->satuan_barang }}</td>
                                    <td>Rp {{ number_format($item->harga_barang, 0, ',', '.') }}</td>
                                    <td>
                                        <div class="btn-group" role="group">
                                            <a href="{{ route('goods.show', $item) }}"
                                               class="btn btn-info btn-sm">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            <a href="{{ route('goods.edit', $item) }}"
                                               class="btn btn-warning btn-sm">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <form method="POST"
                                                  action="{{ route('goods.destroy', $item) }}"
                                                  class="d-inline"
                                                  onsubmit="return confirm('Yakin ingin menghapus data ini?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="text-center">Tidak ada data barang</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
