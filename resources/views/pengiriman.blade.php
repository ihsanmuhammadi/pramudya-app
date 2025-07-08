@extends('layouts.app')

@section('content')
<div class="py-10">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900">
                <h1 class="fw-bold display-6 mb-4">Pengiriman</h1>
                <div class="mb-3 d-flex justify-content-end">
                    <div class="dropdown">
                        <button class="btn btn-outline-primary dropdown-toggle fw-bold" type="button" id="exportDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="bi bi-download me-1"></i> Export
                        </button>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="exportDropdown">
                            <li><a class="dropdown-item export-option" data-type="excel" href="#">Excel</a></li>
                            <li><a class="dropdown-item export-option" data-type="pdf" href="#">PDF</a></li>
                            <li><a class="dropdown-item export-option" data-type="csv" href="#">CSV</a></li>
                        </ul>
                    </div>
                </div>
                {{ $dataTable->table() }}
            </div>
        </div>
    </div>
</div>

<!-- Edit Modal -->
<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-md">
        <form id="editPengirimanForm" class="w-100">
        @csrf
        @method('PUT')
            <div class="modal-content">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title">Edit Status Pengiriman</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="id" id="edit-id">

                    <div class="mb-3">
                        <label for="edit-no-surat">No Surat Jalan</label>
                        <input type="text" id="edit-no-surat" class="form-control" readonly>
                    </div>
                    <div class="mb-3">
                        <label for="edit-no-po">No PO</label>
                        <input type="text" id="edit-no-po" class="form-control" readonly>
                    </div>
                    <div class="mb-3">
                        <label for="edit-status">Status</label>
                        <select name="status" id="edit-status" class="form-select" required>
                            <option value="Menunggu">Menunggu</option>
                            <option value="Perjalanan">Perjalanan</option>
                            <option value="Diterima">Diterima</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                </div>
            </div>
        </form>
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
                Apakah kamu yakin ingin menghapus data pengiriman ini?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <button type="button" class="btn btn-danger" id="confirmDeleteBtn">Hapus</button>
            </div>
        </div>
    </div>
</div>

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
.toast { position: relative; }
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

</style>
@endpush

@push('scripts')
{{ $dataTable->scripts(attributes: ['type' => 'module']) }}


<script>
let deleteId = null;

$(document).on('click', '.btn-delete', function () {
    deleteId = $(this).data('id');
    $('#deleteConfirmModal').modal('show');
});

$('#confirmDeleteBtn').click(function () {
    if (!deleteId) return;
    $.ajax({
        url: '/pengiriman/' + deleteId,
        method: 'POST',
        data: {
            _method: 'DELETE',
            _token: $('meta[name="csrf-token"]').attr('content')
        },
        success: function () {
            $('#deleteConfirmModal').modal('hide');
            $('#pengiriman-table').DataTable().ajax.reload(null, false);
            showToast('Data pengiriman berhasil dihapus!', 'success');
        },
        error: function () {
            $('#deleteConfirmModal').modal('hide');
            showToast('Gagal menghapus data!', 'error');
        }
    });
});

let editId = null;

$(document).on('click', '.btn-edit', function () {
    const id = $(this).data('id');
    $('#editModal').modal('show');
    $('#editPengirimanForm')[0].reset();

    $.get('/pengiriman/' + id + '/edit', function (data) {
        $('#edit-id').val(data.id);
        $('#edit-no-surat').val(data.no_surat);
        $('#edit-no-po').val(data.order?.no_po ?? '-');
        $('#edit-status').val(data.status);
    });
});

// OPEN MODAL EDIT
$(document).on('click', '.btn-edit', function () {
    const id = $(this).data('id');
    $('#editModal').modal('show');
    $('#editPengirimanForm')[0].reset();

    // Kosongkan dulu field biar nggak isi lama nongol sebentar
    $('#edit-id').val('');
    $('#edit-no-surat').val('');
    $('#edit-no-po').val('');
    $('#edit-status').val('Menunggu');

    $.get('/pengiriman/' + id + '/edit', function (res) {
        $('#edit-id').val(res.id);
        $('#edit-no-surat').val(res.no_surat);
        $('#edit-no-po').val(res.order?.no_po || '-');
        $('#edit-status').val(res.status);
    }).fail(function () {
        showToast('Gagal memuat data pengiriman', 'error');
    });
});


$('#editPengirimanForm').submit(function (e) {
    e.preventDefault();
    const formData = $(this).serialize();

    const id = $(this).find('input[name=id]').val(); // pastikan input ini ada
    $.ajax({
        url: '/pengiriman/' + id, // << ini penting!
        type: 'POST',
        data: $(this).serialize() + '&_method=PUT', // atau langsung pakai 'PUT' jika tidak pakai spoof
        success: function() {
            $('#editModal').modal('hide');
            $('#pengiriman-table').DataTable().ajax.reload(null, false);
            showToast('Pengiriman berhasil diperbarui!', 'success');
        },
        error: function() {
            showToast('Gagal update!', 'error');
        }
    });

});

// EXPORT
$(document).on('click', '.export-option', function(e){
    e.preventDefault();
    const type = $(this).data('type');
    window.location.href = '/pengiriman/export/' + type;
});

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
    const toastEl = document.getElementById(toastId);
    const bar = toastEl.querySelector('.toast-progress');
    if (bar) {
        bar.style.animation = 'none';
        bar.offsetHeight;
        bar.style.animation = 'progressBar 5s linear forwards';
    }
    setTimeout(() => {
        $('#' + toastId).closest('.position-fixed').remove();
    }, 5000);
}


@if (session('success'))
document.addEventListener('DOMContentLoaded', function () {
    const toastEl = document.getElementById('toastSuccess');
    if (toastEl) {
        const toast = new bootstrap.Toast(toastEl, { delay: 5000 });
        toast.show();
        const bar = toastEl.querySelector('.toast-progress');
        if (bar) {
            bar.style.animation = 'none';
            bar.offsetHeight;
            bar.style.animation = 'progressBar 5s linear forwards';
        }
    }
});
@endif

</script>
@endpush
