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

    <form method="GET" action="{{ route('admin.dashboard') }}" class="row g-3 mb-4">

        <div class="col-md-4">
            <label class="form-label">Tanggal Mulai</label>
            <input type="date"
                name="start_date"
                class="form-control"
                value="{{ request('start_date') }}">
        </div>

        <div class="col-md-4">
            <label class="form-label">Tanggal Akhir</label>
            <input type="date"
                name="end_date"
                class="form-control"
                value="{{ request('end_date') }}">
        </div>

        <div class="col-md-3">
            <label class="form-label">Shift</label>
            <select name="shift" class="form-control">
                <option value="">Semua Shift</option>
                <option value="Shift 1" {{ request('shift')=='Shift 1'?'selected':'' }}>Shift 1</option>
                <option value="Shift 2" {{ request('shift')=='Shift 2'?'selected':'' }}>Shift 2</option>
                <option value="Shift 3" {{ request('shift')=='Shift 3'?'selected':'' }}>Shift 3</option>
            </select>
        </div>

        <div class="col-md-12 d-flex gap-2">
            <button class="btn btn-primary">Terapkan Filter</button>
            <a href="{{ route('admin.dashboard') }}" class="btn btn-outline-secondary">
                Reset
            </a>
        </div>

    </form>



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
                                <th width="120">
                                    @if (auth()->user()->role === 'admin')Aksi
                                    @endif</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($getbarang as $item)
                            <tr>
                                <td>{{ $getbarang->firstItem() + $loop->index }}</td>
                                <td>{{ $item->no_barang }}</td>
                                <td>{{ $item->line_code }}</td>
                                <td>{{ $item->chargis_from }} - {{ $item->chargis_to }}</td>
                                <td>
                                    <span class="badge bg-secondary">{{ $item->shift }}</span>
                                </td>
                                <td class="text-center">
                                    <div class="d-flex justify-content-center align-items-center gap-1">

                                    {{-- DETAIL --}}
                                    <a href="{{ route('admin.dashboard.detail', $item->id) }}"
                                    class="btn btn-sm btn-outline-info px-2"
                                    title="Detail">
                                        <i class="bx bx-show"></i>
                                    </a>
                                    @if (auth()->user()->role === 'admin')

                                        {{-- EDIT --}}
                                        <a href="{{ route('admin.dashboard.edit', $item->id) }}"
                                        class="btn btn-sm btn-outline-warning px-2"
                                        title="Edit">
                                            <i class="bx bx-pencil"></i>
                                        </a>

                                        {{-- HAPUS --}}
                                        <form action="{{ route('admin.dashboard.destroy', $item->id) }}"
                                            method="POST"
                                            onsubmit="return confirm('Hapus data?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                    class="btn btn-sm btn-outline-danger px-2"
                                                    title="Hapus">
                                                <i class="bx bx-trash"></i>
                                            </button>
                                        </form>
                                    @endif
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="card-footer d-flex justify-content-between align-items-center">
                        <small class="text-muted">
                            Menampilkan {{ $getbarang->firstItem() }} –
                            {{ $getbarang->lastItem() }}
                            dari {{ $getbarang->total() }} data
                        </small>

                       {{-- {{ $getbarang->links('pagination::bootstrap-5') }}--}}
                        {{ $getbarang->appends(request()->query())->links('pagination::bootstrap-5') }}

                    </div>
            </div>
        </div>

        {{-- Data Requests --}}
        <div class="col-lg-6">
            <div class="card h-100">
                <div class="card-header fw-semibold">Data Requests</div>
                <div class="card-body">
                    <table class="table table-hover mb-0">
                        <thead class="table-light">
                            <tr>
                                <th>No</th>
                                <th>No Barang</th>
                                <th>Line</th>
                                <th>Chargis</th>
                                <th>Shift</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($getbarang as $item)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $item->no_barang }}</td>
                                <td>{{ $item->line_code }}</td>
                                <td>{{ $item->chargis_from }} - {{ $item->chargis_to }}</td>
                                <td><span class="badge bg-secondary">{{ $item->shift }}</span></td>
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
                label: 'Jumlah Penyusunan',
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

