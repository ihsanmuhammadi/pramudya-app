@extends('layouts.app')
@section('content')
<div class="py-10">
    <div class="max-w-4xl mx-auto bg-white p-6 rounded shadow">
        <h2 class="text-2xl font-bold mb-6">Surat Jalan</h2>

        @if (session('success'))
        <div class="bg-green-100 border border-green-300 text-green-800 p-4 rounded mb-4">
            {{ session('success') }}
        </div>
        @endif

        <form action="{{ route('surat-jalan.store') }}" method="POST">
            @csrf
            <div class="grid gap-4 mb-4">
                <div>
                    <label class="block font-medium mb-1">No Surat Jalan *</label>
                    <input type="text" name="no_surat" class="w-full border-gray-300 rounded shadow-sm" required>
                </div>
                <div>
                    <label class="block font-medium mb-1">Tanggal *</label>
                    <input type="date" name="tanggal" class="w-full border-gray-300 rounded shadow-sm" required value="{{ date('Y-m-d') }}">
                </div>
                <div>
                    <label class="block font-medium mb-1">Keterangan Penerima</label>
                    <input type="text" name="keterangan_penerima" class="w-full border-gray-300 rounded shadow-sm">
                </div>
                <div>
                    <label class="block font-medium mb-1">No PO *</label>
                    <select name="order_id" id="order_id" class="form-select w-full border-gray-300 rounded shadow-sm" required>
                        <option value="">-- Pilih No PO --</option>
                        @foreach($orders as $order)
                            <option value="{{ $order->id }}">{{ $order->no_po }} - {{ $order->nama_po }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label class="block font-medium mb-1">Kendaraan</label>
                    <input type="text" name="kendaraan" class="w-full border-gray-300 rounded shadow-sm">
                </div>
            </div>

            <div class="text-center mt-4 flex justify-center gap-4">
                <button type="button" class="bg-gray-100 border border-gray-300 text-gray-800 px-6 py-2 rounded hover:bg-gray-200"
                        data-bs-toggle="modal" data-bs-target="#historyModal">
                    <i class="bi bi-clock-history me-1"></i> Lihat History
                </button>
                <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded hover:bg-blue-700">
                    Generate PDF
                </button>
            </div>
        </form>
    </div>
</div>
@endsection

<!-- Modal History -->
<div class="modal fade" id="historyModal" tabindex="-1" aria-labelledby="historyModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Riwayat Surat Jalan</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        @if($histories->isEmpty())
            <p class="text-muted">Belum ada riwayat surat jalan.</p>
        @else
        <table class="table table-bordered">
          <thead>
            <tr>
              <th>No Surat</th>
              <th>No PO</th>
              <th>Penerima</th>
              <th>Tanggal</th>
              <th>Status</th>
              <th>Keterangan</th>
              <th>Kendaraan</th>
              <th>Aksi</th>
            </tr>
          </thead>
          <tbody>
            @foreach($histories as $h)
            <tr>
                <td>{{ $h->no_surat }}</td>
                <td>{{ $h->order->no_po ?? '-' }}</td>
                <td>{{ $h->penerima }}</td>
                <td>{{ $h->tanggal }}</td>
                <td>{{ $h->status }}</td>
                <td>{{ $h->keterangan_penerima }}</td>
                <td>{{ $h->kendaraan }}</td>
                <td>
                    <a href="{{ route('surat-jalan.download', $h->id) }}" class="btn btn-sm btn-outline-primary">
                        Download
                    </a>
                </td>

            </tr>
            @endforeach
          </tbody>
        </table>
        @endif
      </div>
    </div>
  </div>
</div>

{{-- Tambahkan ini di bagian paling bawah halaman --}}
<style>
    .modal-backdrop.show {
        background-color: rgba(0, 0, 0, 0.5) !important; /* ubah sesuai kebutuhan */
    }
</style>

