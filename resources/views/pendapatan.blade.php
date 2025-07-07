@extends('layouts.app')

@section('content')
<div class="py-10">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900">
                <h1 class="fw-bold display-6 mb-4">Pendapatan</h1>
                <div class="mb-3 d-flex justify-content-between align-items-center">
                    <button class="btn btn-primary" id="btn-create">
                        <i class="bi bi-plus-circle me-1"></i> Tambah Pendapatan
                    </button>
                    <div class="dropdown">
                        <button class="btn btn-outline-primary dropdown-toggle fw-bold" type="button" data-bs-toggle="dropdown">
                            <i class="bi bi-download me-1"></i> Export
                        </button>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li><a class="dropdown-item export-option" data-type="excel" href="#"><i class="bi bi-file-earmark-excel me-1"></i>Excel</a></li>
                            <li><a class="dropdown-item export-option" data-type="pdf" href="#"><i class="bi bi-file-earmark-pdf me-1"></i>PDF</a></li>
                            <li><a class="dropdown-item export-option" data-type="csv" href="#"><i class="bi bi-file-earmark-text me-1"></i>CSV</a></li>
                        </ul>
                    </div>
                </div>
                {{ $dataTable->table(['id' => 'pendapatan-table']) }}
            </div>
        </div>
    </div>
</div>

<!-- Create Modal -->
<div class="modal fade" id="createModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-md">
        <form id="createPendapatanForm" class="w-100">
            @csrf
            <div class="modal-content">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title">Tambah Pendapatan</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="order_id" class="form-label">No PO</label>
                        <select name="order_id" id="order_id" class="form-select" required>
                            <option value="" disabled selected>Pilih No PO</option>
                            @foreach($orders as $order)
                                <option value="{{ $order->id }}">{{ $order->no_po }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div id="orderInfo" style="display: none;">
                        <div class="mb-2">
                            <label class="form-label">Nama PO</label>
                            <input type="text" class="form-control" id="nama_po" readonly>
                        </div>
                        <div class="mb-2">
                            <label class="form-label">Tanggal</label>
                            <input type="text" class="form-control" id="tanggal" readonly>
                        </div>
                        <div class="mb-2">
                            <label class="form-label">Total Pendapatan</label>
                            <input type="text" class="form-control" id="total" readonly>
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

<!-- Delete Modal -->
<div class="modal fade" id="deleteConfirmModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-danger text-white">
                <h5 class="modal-title">Konfirmasi Hapus</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                Apakah yakin ingin menghapus pendapatan ini?
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
table.dataTable td.text-center {
    vertical-align: middle !important;
}

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
        </div>`;
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

// OPEN CREATE MODAL
$('#btn-create').click(function() {
    $('#createPendapatanForm')[0].reset();
    $('#orderInfo').hide();
    $('#createModal').modal('show');
});

// FETCH ORDER DETAIL WHEN SELECTED
$('#order_id').on('change', function() {
    const id = $(this).val();
    if (!id) return;
    $.get(`/pendapatan/order/${id}`, function(data) {
        $('#nama_po').val(data.nama_po);
        $('#tanggal').val(data.tanggal);
        $('#total').val('Rp' + parseInt(data.total_semua_barang).toLocaleString('id-ID'));
        $('#orderInfo').slideDown();
    })
});

// SUBMIT CREATE
$(document).on('submit', '#createPendapatanForm', function(e) {
    e.preventDefault();
    $.ajax({
        url: '/pendapatan',
        method: 'POST',
        data: $(this).serialize(),
        success: function() {
            $('#createModal').modal('hide');
            $('#pendapatan-table').DataTable().ajax.reload(null, false);
            showToast('Pendapatan berhasil ditambahkan!');
        },
        error: function(xhr) {
            const msg = xhr.responseJSON?.message || 'Gagal menyimpan pendapatan.';
            showToast(msg, 'error');
        }
    });
});

// DELETE HANDLER
let deleteId = null;
$(document).on('click', '.btn-delete', function() {
    deleteId = $(this).data('id');
    $('#deleteConfirmModal').modal('show');
});
$('#confirmDeleteBtn').click(function() {
    if (!deleteId) return;
    $.ajax({
        url: `/pendapatan/${deleteId}`,
        method: 'POST',
        data: {
            _method: 'DELETE',
            _token: $('meta[name="csrf-token"]').attr('content')
        },
        success: function() {
            $('#deleteConfirmModal').modal('hide');
            $('#pendapatan-table').DataTable().ajax.reload(null, false);
            showToast('Pendapatan berhasil dihapus!');
        },
        error: function() {
            $('#deleteConfirmModal').modal('hide');
            showToast('Gagal menghapus pendapatan!', 'error');
        }
    });
});

// EXPORT HANDLER
$(document).on('click', '.export-option', function(e){
    e.preventDefault();
    const type = $(this).data('type');
    if (!type) return;
    window.location.href = `/pendapatan/export/${type}`;
});

</script>
@endpush
