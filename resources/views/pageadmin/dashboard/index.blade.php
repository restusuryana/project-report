@extends('template-admin.layout')

@section('content')
<div class="container-fluid">

    {{-- HEADER --}}
    <div class="mb-4">
        <h4 class="fw-bold mb-0">Dashboard Penyusunan</h4>
        <small class="text-muted">Monitoring data penyusunan per shift</small>
    </div>

    {{-- STAT --}}
    <div class="row g-4 mb-4">
        <div class="col-md-3">
            <div class="card p-3">
                <small class="text-muted">Shift 1</small>
                <h3 class="fw-bold text-primary">{{ $totalshift1 }}</h3>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card p-3">
                <small class="text-muted">Shift 2</small>
                <h3 class="fw-bold text-success">{{ $totalshift2 }}</h3>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card p-3">
                <small class="text-muted">Shift 3</small>
                <h3 class="fw-bold text-warning">{{ $totalshift3 }}</h3>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card p-3 bg-dark text-white">
                <small>Total Susun (Chargis)</small>
                <h3 class="fw-bold text-white">{{ $totalAll }}</h3>
            </div>
        </div>
    </div>

    {{-- CHART + TABLE --}}
    <div class="row g-4">

        {{-- CHART --}}
        <div class="col-lg-6">
            <div class="card h-100">
                <div class="card-header fw-semibold">Grafik Penyusunan Per Shift</div>
                <div class="card-body">
                    <canvas id="shiftChart"></canvas>
                </div>
            </div>
        </div>

        {{-- DATA TERBARU --}}
        <div class="col-lg-6">
            <div class="card h-100">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <span class="fw-semibold">Data Terbaru</span>
                    <a href="{{ route('admin.dashboard.create') }}" class="btn btn-sm btn-primary">
                        + Tambah Data
                    </a>
                </div>
                <div class="card-body p-0">
                    <table class="table table-hover mb-0">
                        <thead class="table-light">
                            <tr>
                                <th>No</th>
                                <th>No Barang</th>
                                <th>Line</th>
                                <th>Chargis</th>
                                <th>Shift</th>
                                <th width="120">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($getbarang->take(5) as $item)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $item->no_barang }}</td>
                                <td>{{ $item->line_code }}</td>
                                <td>{{ $item->chargis_from }} - {{ $item->chargis_to }}</td>
                                <td><span class="badge bg-secondary">{{ $item->shift }}</span></td>
                                <td>
                                    <a href="{{ route('admin.dashboard.edit',$item->id) }}" class="btn btn-sm btn-warning">Edit</a>
                                    <form action="{{ route('admin.dashboard.destroy',$item->id) }}" method="POST" class="d-inline">
                                        @csrf @method('DELETE')
                                        <button class="btn btn-sm btn-danger" onclick="return confirm('Hapus data?')">Hapus</button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
</div>
@section('script')

<script>
    const ctx = document.getElementById('shiftChart').getContext('2d');
    const shiftChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: ['Shift 1', 'Shift 2', 'Shift 3'],
            datasets: [{
                label: 'Jumlah Produksi',
                data: [{{ $totalshift1 }}, {{ $totalshift2 }}, {{ $totalshift3 }}],
                backgroundColor: [
                    'rgba(54, 162, 235, 0.7)',
                    'rgba(75, 192, 192, 0.7)',
                    'rgba(255, 206, 86, 0.7)'
                ],
                borderColor: [
                    'rgba(54, 162, 235, 1)',
                    'rgba(75, 192, 192, 1)',
                    'rgba(255, 206, 86, 1)'
                ],
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        stepSize: 0
                    }
                }
            }
        }
    });
</script>
@endsection

@endsection

