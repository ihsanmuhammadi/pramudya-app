@extends('layouts.app')

@section('content')

{{-- Main content --}}
<div class="py-10">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        {{-- @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif --}}

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
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title">Tambah Barang</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label>Nama Barang</label>
                            <input type="text" name="nama_barang" class="form-control" placeholder="Masukkan nama barang" required>
                        </div>
                        <div class="col-md-3">
                            <label>Jumlah</label>
                            <input type="number" name="jumlah_barang" class="form-control" placeholder="0" required>
                        </div>
                        <div class="col-md-3">
                            <label for="satuan_barang">Satuan</label>
                            <select name="satuan_barang" class="form-select" required>
                                <option value="" disabled selected>Pilih satuan</option>
                                <option value="pcs">pcs</option>
                                <option value="buah">buah</option>
                                <option value="pack">pack</option>
                                <option value="dus">dus</option>
                                <option value="unit">unit</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label>Harga</label>
                            <input type="number" name="harga_barang" class="form-control" placeholder="Masukkan harga satuan" required>
                        </div>
                        <div class="col-md-6">
                            <label>Kode</label>
                            <input type="text" name="kode_barang" class="form-control" placeholder="Kode unik barang" required>
                        </div>
                        <div class="col-12">
                            <label for="spesifikasi">Spesifikasi</label>
                            <textarea name="spesifikasi" class="form-control" rows="4" style="resize: vertical;" placeholder="Masukkan spesifikasi barang..."></textarea>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
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
                <h1 class="modal-title">Goods Detail</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" id="showModalBody">
                <div class="text-center my-3"><div class="spinner-border text-primary" role="status"></div></div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<!-- Edit Modal -->
<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title">Edit Goods</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body" id="editModalBody">
                <div class="text-center my-3"><div class="spinner-border text-primary" role="status"></div></div>
            </div>
        </div>
    </div>
</div>

<!-- Delete Confirmation Modal -->
<div class="modal fade" id="deleteConfirmModal" tabindex="-1" aria-labelledby="deleteConfirmModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-danger text-white">
                <h5 class="modal-title">Konfirmasi Hapus</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                Apakah kamu yakin ingin menghapus barang ini?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <button type="button" class="btn btn-danger" id="confirmDeleteBtn">Hapus</button>
            </div>
        </div>
    </div>
</div>

<!-- Toast with Loading Bar -->
@if (session('success'))
<div class="position-fixed top-0 end-0 p-4" style="z-index: 1080">
    <div id="toastSuccess" class="toast align-items-center text-white show fade"
         role="alert" aria-live="assertive" aria-atomic="true"
         style="background-color: #0d6efd; min-width: 300px; font-size: 1.1rem; border-radius: 0.75rem; box-shadow: 0 0.5rem 1rem rgba(0,0,0,0.25); overflow: hidden;">
        <div class="d-flex justify-content-between align-items-center px-3 py-2">
            <div class="toast-body fw-semibold">
                {{ session('success') }}
            </div>
            <button type="button" class="btn-close btn-close-white ms-3" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
        <div class="toast-progress"></div>
    </div>
</div>
@endif

@endsection

@push('styles')
<style>
.toast {
    position: relative;
}

.toast-progress {
    position: absolute;
    bottom: 0;
    left: 0;
    height: 4px;
    width: 100%;
    background-color: white;
    animation: progressBar 5s linear forwards;
    border-bottom-left-radius: 0.75rem;
    border-bottom-right-radius: 0.75rem;
}

@keyframes progressBar {
    from { width: 100%; }
    to { width: 0%; }
}

@keyframes slideInRight {
    from { transform: translateX(100%); opacity: 0; }
    to   { transform: translateX(0); opacity: 1; }
}
</style>
@endpush

@push('scripts')
{{ $dataTable->scripts(attributes: ['type' => 'module']) }}

<script>
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

// Toast function with loading bar
function showToast(message, type = 'success') {
    const toastId = 'toast-' + Date.now();
    const bgColor = type === 'success' ? '#0d6efd' : (type === 'error' ? '#dc3545' : '#0d6efd');

    const toastHTML = `
        <div class="position-fixed top-0 end-0 p-4" style="z-index: 1080">
            <div id="${toastId}" class="toast align-items-center text-white show fade"
                role="alert" aria-live="assertive" aria-atomic="true"
                style="background-color: ${bgColor}; min-width: 300px; font-size: 1.1rem; border-radius: 0.75rem; box-shadow: 0 0.5rem 1rem rgba(0,0,0,0.25); overflow: hidden;">
                <div class="d-flex justify-content-between align-items-center px-3 py-2">
                    <div class="toast-body fw-semibold">
                        ${message}
                    </div>
                    <button type="button" class="btn-close btn-close-white ms-3" data-bs-dismiss="toast" aria-label="Close"></button>
                </div>
                <div class="toast-progress"></div>
            </div>
        </div>
    `;
    $('body').append(toastHTML);

    // Trigger animation for progress bar
    const toastEl = document.getElementById(toastId);
    const bar = toastEl.querySelector('.toast-progress');
    if (bar) {
        bar.style.animation = 'none';
        bar.offsetHeight; // force reflow
        bar.style.animation = 'progressBar 5s linear forwards';
    }
    // Auto-hide after 5 seconds
    setTimeout(() => {
        $('#' + toastId).closest('.position-fixed').remove();
    }, 5000);
}

// Toast load
document.addEventListener('DOMContentLoaded', function () {
    // Create button handler
    $('#btn-create').click(function () {
        $('#createModal').modal('show');
        $('#createGoodsForm')[0].reset();
    });

    // Create form submission
    $('#createGoodsForm').submit(function (e) {
        e.preventDefault();
        $.ajax({
            url: '/goods',
            method: 'POST',
            data: $(this).serialize(),
            success: function (response) {
                $('#createModal').modal('hide');
                $('#goods-table').DataTable().ajax.reload(null, false);
                showToast('Barang berhasil ditambahkan!', 'success');
            },
            error: function (xhr) {
                showToast('Gagal menambah data: ' + xhr.responseText, 'error');
            }
        });
    });

    // Delete modal and submit
    let deleteId = null;

    $(document).on('click', '.btn-delete', function () {
        deleteId = $(this).data('id');
        $('#deleteConfirmModal').modal('show');
    });

    $('#confirmDeleteBtn').click(function () {
        if (!deleteId) return;
        $.ajax({
            url: '/goods/' + deleteId,
            method: 'POST',
            data: {
                _method: 'DELETE',
                _token: $('meta[name="csrf-token"]').attr('content')
            },
            success: function (res) {
                $('#deleteConfirmModal').modal('hide');
                $('#goods-table').DataTable().ajax.reload(null, false);
                showToast('Barang berhasil dihapus!', 'success');
            },
            error: function () {
                $('#deleteConfirmModal').modal('hide');
                showToast('Gagal menghapus data!', 'error');
            }
        });
    });

    // Show modal
    $(document).on('click', '.btn-show', function () {
        const id = $(this).data('id');
        $('#showModalBody').html('<div class="text-center my-3"><div class="spinner-border text-primary" role="status"></div></div>');
        $.get('/goods/' + id, function (data) {
            $('#showModalBody').html(data);
            $('#showModal').modal('show');
        });
    });

    // Edit modal and submit
    $(document).on('click', '.btn-edit', function () {
        const id = $(this).data('id');
        $('#editModalBody').html('<div class="text-center my-3"><div class="spinner-border text-primary" role="status"></div></div>');
        $.get('/goods/' + id + '/edit', function (formHtml) {
            $('#editModalBody').html(formHtml);
            $('#editModal').modal('show');
        });
    });

    $(document).on('submit', '#editGoodsForm', function (e) {
        e.preventDefault();
        const id = $(this).find('input[name=id]').val();
        const formData = $(this).serialize();
        $.ajax({
            url: '/goods/' + id,
            type: 'POST',
            data: formData + '&_method=PUT',
            success: function (response) {
                $('#editModal').modal('hide');
                $('#goods-table').DataTable().ajax.reload(null, false);
                showToast('Barang berhasil diupdate!', 'success');
            },
            error: function (xhr) {
                console.log('Error:', xhr.responseText);
                showToast('Update gagal: ' + xhr.responseText, 'error');
            }
        });
    });

    // Export functionality
    $(document).on('click', '.export-option', function (e) {
        e.preventDefault();
        const type = $(this).data('type');
        window.location.href = '/goods/export/' + type;
    });

    // Debounced search
    $('#goods-table_filter input').unbind().bind('keyup', function(e) {
        if (e.keyCode == 13 || this.value.length > 3) {
            $('#goods-table').DataTable().search(this.value).draw();
        }
    });

    // Initialize progress bar animation if exists
    const bar = document.querySelector('.toast-progress');
    if (bar) {
        bar.style.animation = 'none';
        bar.offsetHeight; // force reflow
        bar.style.animation = 'progressBar 5s linear forwards';
    }
});

// Handle Laravel session success toast
@if (session('success'))
document.addEventListener('DOMContentLoaded', function () {
    const toastEl = document.getElementById('toastSuccess');
    if (toastEl) {
        const toast = new bootstrap.Toast(toastEl, { delay: 5000 });
        toast.show();

        // Trigger animation restart for progress bar
        const bar = toastEl.querySelector('.toast-progress');
        if (bar) {
            bar.style.animation = 'none';
            bar.offsetHeight; // force reflow
            bar.style.animation = 'progressBar 5s linear forwards';
        }
    }
});
@endif

</script>
@endpush
