@extends('layouts.app')
@section('content')
<div class="py-6 min-h-screen overflow-hidden bg-gray-50">
    <div class="max-w-7xl mx-auto sm:px-4 lg:px-6">
        <!-- Judul Halaman -->
        <div class="mb-6">
            <h1 class="text-2xl font-bold text-gray-800">Dashboard</h1>
        </div>

        <!-- Ringkasan -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
            <!-- Total Barang -->
            <div class="bg-white p-4 rounded shadow text-center">
                <h3 class="text-sm font-semibold text-gray-600 mb-1">Total Barang</h3>
                <p class="text-2xl font-bold text-blue-600">{{ $totalBarang }}</p>
            </div>

            <!-- Total Order -->
            <div class="bg-white p-4 rounded shadow text-center">
                <h3 class="text-sm font-semibold text-gray-600 mb-1">Total Order</h3>
                <p class="text-2xl font-bold text-green-600">{{ $totalOrder }}</p>
            </div>

            <!-- Total Pengeluaran -->
            <div class="bg-white p-4 rounded shadow text-center">
                <h3 class="text-sm font-semibold text-gray-600 mb-1">Total Pengeluaran</h3>
                <p class="text-2xl font-bold text-red-500">
                    Rp{{ number_format($totalPengeluaran, 0, ',', '.') }}
                </p>
            </div>
        </div>

        <!-- Statistik + Pendapatan -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-4 mb-6">
            <!-- Grafik Statistik Pengiriman -->
            <div class="bg-white p-4 rounded shadow col-span-2">
                <h3 class="text-base font-semibold text-gray-800 mb-3">Statistik Pengiriman</h3>
                <div class="relative h-[250px]">
                    <canvas id="pengirimanChart"></canvas>
                </div>
            </div>

            <div class="bg-white p-6 rounded shadow h-full flex flex-col justify-center items-center text-center">
                <h3 class="text-base font-semibold text-gray-700 mb-3">Total Pendapatan</h3>
                <div class="text-4xl font-extrabold text-indigo-700 mb-2">
                    Rp{{ number_format($totalPendapatan, 0, ',', '.') }}
                </div>
                <p class="text-sm text-gray-500">Akumulasi dari semua order</p>
            </div>
        </div>

        <!-- Pengeluaran Terbaru -->
        <div class="bg-white p-4 rounded shadow">
            <h3 class="text-base font-semibold text-gray-800 mb-3">5 Pengeluaran Terbaru</h3>
            @if($pengeluaranTerbaru->isEmpty())
                <p class="text-sm text-gray-500">Belum ada data pengeluaran.</p>
            @else
                <ul class="divide-y divide-gray-200 text-sm">
                    @foreach($pengeluaranTerbaru as $item)
                    <li class="py-2 flex justify-between">
                        <span class="text-gray-700">{{ $item->nama_po }}</span>
                        <span class="text-red-600 font-semibold">Rp{{ number_format($item->total, 0, ',', '.') }}</span>
                    </li>
                    @endforeach
                </ul>
            @endif
        </div>
    </div>
</div>

<!-- Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const ctx = document.getElementById('pengirimanChart').getContext('2d');
    const pengirimanChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: {!! json_encode(array_keys($pengirimanStats) ?: ['Tidak Ada Data']) !!},
            datasets: [{
                label: 'Jumlah Pengiriman',
                data: {!! json_encode(array_values($pengirimanStats) ?: [0]) !!},
                backgroundColor: 'rgba(59, 130, 246, 0.5)',
                borderColor: 'rgba(59, 130, 246, 1)',
                borderWidth: 1
            }]
        },
        options: {
            maintainAspectRatio: false,
            responsive: true,
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        precision: 0
                    }
                }
            },
            plugins: {
                legend: { display: false }
            }
        }
    });
</script>
@endsection
