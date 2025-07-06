@extends('layouts.app')

@section('content')
<div class="py-10">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900">
                <h1 class="fw-bold display-6 mb-4">Manajemen Order</h1>
                <div class="mb-3 d-flex justify-content-between align-items-center">
                    <button class="btn btn-primary" id="btn-create">
                        <i class="bi bi-plus-circle me-1"></i> Tambah Order
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
                {{ $dataTable->table() }}
            </div>
        </div>
    </div>
</div>

<!-- Create Modal -->
<div class="modal fade" id="createModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <form id="createOrderForm" class="w-100">
            @csrf
            <div class="modal-content">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title">Tambah Order</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    @include('orders._order-form', ['prefix' => 'items'])
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
                Apakah yakin ingin menghapus order ini?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <button type="button" class="btn btn-danger" id="confirmDeleteBtn">Hapus</button>
            </div>
        </div>
    </div>
</div>

<!-- Show Modal -->
<div class="modal fade" id="showModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Detail Order</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body" id="showModalBody">
                <div class="text-center my-3"><div class="spinner-border text-primary"></div></div>
            </div>
        </div>
    </div>
</div>

<!-- Edit Modal -->
<div class="modal fade" id="editModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title">Edit Order</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body" id="editModalBody">
                <div class="text-center my-3"><div class="spinner-border text-primary"></div></div>
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

let itemIndex = 1;
const goodsOptions = `@foreach($goods as $g)<option value="{{ $g->id }}">{{ $g->nama_barang }} (Stok: {{ $g->jumlah_barang }})</option>@endforeach`;

// CREATE
$('#btn-create').click(function(){
    $('#createOrderForm')[0].reset();
    $('#itemsRepeater').html(getItemRow(0));
    itemIndex = 1;
    $('#createModal').modal('show');
});

function getItemRow(index) {
    return `
    <div class="row g-3 align-items-end item-row mb-2">
        <div class="col-md-4">
            <select name="items[${index}][goods_id]" class="form-select" required>
                <option value="" selected disabled>Pilih Barang</option>
                ${goodsOptions}
            </select>
        </div>
        <div class="col-md-3">
            <input type="number" name="items[${index}][jumlah_barang]" class="form-control" min="1" required>
        </div>
        <div class="col-md-3">
            <button type="button" class="btn btn-danger remove-item">
                <i class="bi bi-trash"></i>
            </button>
        </div>
    </div>`;
}

// ADD item (create)
$(document).on('click', '#addItem', function(){
    $('#itemsRepeater').append(getItemRow(itemIndex++));
});

// REMOVE item (create+edit)
$(document).on('click', '.remove-item', function(){
    if($('.item-row').length <= 1){
        showToast('Order minimal memiliki satu barang!', 'error');
        return;
    }
    $(this).closest('.item-row').remove();
});

// STORE
$(document).on('submit', '#createOrderForm', function(e){
    e.preventDefault();
    $.ajax({
        url: '/orders',
        method: 'POST',
        data: $(this).serialize(),
        success: function(){
            $('#createModal').modal('hide');
            $('#orders-table').DataTable().ajax.reload(null, false);
            showToast('Order berhasil ditambahkan!', 'success');
        },
        error: function(xhr){
            showToast('Gagal menambah order: ' + xhr.responseText, 'error');
        }
    });
});

// SHOW
$(document).on('click', '.btn-show', function(){
    const id = $(this).data('id');
    $('#showModalBody').html('<div class="text-center my-3"><div class="spinner-border text-primary"></div></div>');
    $.get('/orders/' + id, function(data){
        $('#showModalBody').html(data);
        $('#showModal').modal('show');
    });
});

// EDIT
$(document).on('click', '.btn-edit', function(){
    const id = $(this).data('id');
    $('#editModalBody').html('<div class="text-center my-3"><div class="spinner-border text-primary"></div></div>');
    $('#editModal').modal('show'); // <-- tambahkan ini
    $.get('/orders/' + id + '/edit', function(data){
        $('#editModalBody').html(data);
    });
});

// // ADD item in EDIT modal
// $(document).on('click', '#addEditItem', function(){
//     $('#editItemsRepeater').append(getItemRow(editItemIndex++));
// });

// SUBMIT edit
$(document).on('submit', '#editOrderForm', function(e){
    e.preventDefault();
    const id = $(this).find('input[name=id]').val();
    $.ajax({
        url: '/orders/' + id,
        type: 'POST',
        data: $(this).serialize() + '&_method=PUT',
        success: function(){
            $('#editModal').modal('hide');
            $('#orders-table').DataTable().ajax.reload(null, false);
            showToast('Order berhasil diperbarui!', 'success');
        },
        error: function(xhr){
            showToast('Update gagal: ' + xhr.responseText, 'error');
        }
    });
});

// DELETE
let deleteId = null;
$(document).on('click', '.btn-delete', function(){
    deleteId = $(this).data('id');
    $('#deleteConfirmModal').modal('show');
});
$('#confirmDeleteBtn').click(function(){
    if(!deleteId) return;
    $.ajax({
        url: '/orders/' + deleteId,
        method: 'POST',
        data: {
            _method: 'DELETE',
            _token: $('meta[name="csrf-token"]').attr('content')
        },
        success: function(){
            $('#deleteConfirmModal').modal('hide');
            $('#orders-table').DataTable().ajax.reload(null, false);
            showToast('Order berhasil dihapus!', 'success');
        },
        error: function(){
            $('#deleteConfirmModal').modal('hide');
            showToast('Gagal menghapus order!', 'error');
        }
    });
});

// EXPORT
$(document).on('click', '.export-option', function(e){
    e.preventDefault();
    const type = $(this).data('type');
    window.location.href = '/orders/export/' + type;
});

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
