@extends('layouts.app')
@section('content')
<div class="py-10">
    <div class="max-w-4xl mx-auto bg-white p-6 rounded shadow">
        <h2 class="text-2xl font-bold mb-6">Generate Surat Jalan</h2>

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
                    <input type="text" name="no_surat_jalan"
                           class="w-full border-gray-300 rounded shadow-sm" required>
                </div>
                <div>
                    <label class="block font-medium mb-1">Tanggal *</label>
                    <input type="date" name="tanggal"
                           class="w-full border-gray-300 rounded shadow-sm" required value="{{ date('Y-m-d') }}">
                </div>
                <div>
                    <label class="block font-medium mb-1">Nama Customer *</label>
                    <input type="text" name="customer_name"
                           class="w-full border-gray-300 rounded shadow-sm" required>
                </div>
                <div>
                    <label class="block font-medium mb-1">Alamat Kirim *</label>
                    <textarea name="alamat_kirim"
                              class="w-full border-gray-300 rounded shadow-sm" rows="2" required></textarea>
                </div>
                <div>
                    <label class="block font-medium mb-1">Detail Barang *</label>
                    <textarea name="detail_barang"
                              class="w-full border-gray-300 rounded shadow-sm" rows="4" required
                              placeholder="Misal:
- Barang A (10 pcs)
- Barang B (5 pcs)"></textarea>
                </div>
                <div>
                    <label class="block font-medium mb-1">Catatan</label>
                    <textarea name="catatan"
                              class="w-full border-gray-300 rounded shadow-sm" rows="2"></textarea>
                </div>
            </div>

            <div class="text-center mt-4">
                <button type="submit"
                        class="bg-blue-600 text-white px-6 py-2 rounded hover:bg-blue-700">
                    Generate PDF
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
