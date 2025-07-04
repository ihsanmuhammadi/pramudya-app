@extends('layouts.app')
@section('content')
    {{-- <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot> --}}

    <div class="py-10">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h1 class="fw-bold display-6 mb-4">Manajemen Barang</h1>


                    <div class="mb-3 d-flex justify-content-between align-items-center">
                        <div>
                            <button class="btn btn-primary" id="btn-create">
                                <i class="bi bi-plus-circle me-1"></i> Tambah Barang
                            </button>
                        </div>
                        <div class="d-flex gap-2">
                            <!-- Filter Button -->
        {{-- <button class="btn btn-outline-dark" data-bs-toggle="modal" data-bs-target="#filterModal">
            <i class="bi bi-funnel me-1"></i> Filter
        </button> --}}
                            <div class="dropdown">
  <button class="btn btn-outline-primary dropdown-toggle fw-bold" type="button" id="exportDropdown" data-bs-toggle="dropdown" aria-expanded="false">
    <i class="bi bi-download me-1"></i> Export
  </button>
  <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="exportDropdown">
    <li><a class="dropdown-item export-option" data-type="excel" href="#"><i class="bi bi-file-earmark-excel me-1"></i>Excel</a></li>
    <li><a class="dropdown-item export-option" data-type="pdf" href="#"><i class="bi bi-file-earmark-pdf me-1"></i>PDF</a></li>
    <li><a class="dropdown-item export-option" data-type="csv" href="#"><i class="bi bi-file-earmark-text me-1"></i>CSV</a></li>
  </ul>
</div>
                        </div>


                    </div>
                    {{ $dataTable->table() }}
                </div>
            </div>
        </div>
    </div>

<!-- Create Modal -->
<div class="modal fade" id="createModal" tabindex="-1" aria-labelledby="createModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg">
    <form id="createGoodsForm" class="w-100">
      @csrf
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Tambah Barang</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body">
          <div class="row g-3">
              <div class="col-md-6">
                  <label>Nama Barang</label>
                  <input type="text" name="nama_barang" class="form-control">
              </div>
              <div class="col-md-6">
                  <label>Jumlah</label>
                  <input type="number" name="jumlah_barang" class="form-control">
              </div>
              <div class="col-md-6">
                  <label>Satuan</label>
                  <input type="text" name="satuan_barang" class="form-control">
              </div>
              <div class="col-md-6">
                  <label>Harga</label>
                  <input type="number" name="harga_barang" class="form-control">
              </div>
              <div class="col-md-6">
                  <label>Kode</label>
                  <input type="text" name="kode_barang" class="form-control">
              </div>
              <div class="col-md-6">
                  <label>Spesifikasi</label>
                  <textarea name="spesifikasi" class="form-control" rows="1"></textarea>
              </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-primary">Simpan</button>
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
        </div>
      </div>
    </form>
  </div>
</div>

<!-- Show Modal -->
<div class="modal fade" id="showModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5">Goods Detail</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body" id="showModalBody">
        <!-- Loaded content -->
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>

<!-- Edit Modal -->
<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title">Edit Goods</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body" id="editModalBody">
            <!-- content loaded from edit.blade.php via AJAX -->
        </div>
    </div>
  </div>
</div>

@endsection

@push('scripts')
    {{ $dataTable->scripts(attributes: ['type' => 'module']) }}

    <script>
document.addEventListener('DOMContentLoaded', function () {
    // Show the create modal
    $('#btn-create').click(function () {
        $('#createModal').modal('show');
        $('#createGoodsForm')[0].reset(); // optional: clear fields
    });

    // Handle form submit
    $('#createGoodsForm').submit(function (e) {
        e.preventDefault();

        $.ajax({
            url: '/goods', // Laravel resource store route
            method: 'POST',
            data: $(this).serialize(),
            success: function () {
                $('#createModal').modal('hide');
                $('#goods-table').DataTable().ajax.reload(null, false);
            },
            error: function (xhr) {
                alert('Gagal menambah data: ' + xhr.responseText);
            }
        });
    });

    // Delete button
    $(document).on('click', '.btn-delete', function () {
        const id = $(this).data('id');

        if (confirm('Yakin ingin menghapus barang ini?')) {
            $.ajax({
                url: '/goods/' + id,
                type: 'POST',
                data: {
                    _method: 'DELETE',
                    _token: $('meta[name="csrf-token"]').attr('content')
                },
                success: function (res) {
                    alert(res.message);
                    $('#goods-table').DataTable().ajax.reload(null, false);
                },
                error: function (xhr) {
                    alert('Gagal menghapus data.');
                }
            });
        }
    });

    // Show button
    $(document).on('click', '.btn-show', function () {
        const id = $(this).data('id');
        $.get('/goods/' + id, function (data) {
            $('#showModalBody').html(data);
            $('#showModal').modal('show');
        });
    });

    // Edit button
    $(document).on('click', '.btn-edit', function () {
        const id = $(this).data('id');
        $.get('/goods/' + id + '/edit', function (formHtml) {
            $('#editModalBody').html(formHtml);
            $('#editModal').modal('show');
        });
    });

    // Submit edit
    $(document).on('submit', '#editGoodsForm', function (e) {
        e.preventDefault();

        const id = $(this).find('input[name=id]').val();
        const formData = $(this).serialize();

        $.ajax({
            url: '/goods/' + id,
            type: 'POST',
            data: formData,
            success: function () {
                $('#editModal').modal('hide');
                $('#goods-table').DataTable().ajax.reload(null, false);
            },
            error: function (xhr) {
                alert('Update failed');
            }
        });
    });

    // Export buttons
    $(document).on('click', '.export-option', function (e) {
    e.preventDefault();
    const type = $(this).data('type');
    window.location.href = '/goods/export/' + type;
    });

});
</script>
@endpush
