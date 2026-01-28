@extends('template-admin.layout')
@section('content')
<div class="container-fluid">

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <span class="fw-semibold">Detail Data</span>
                    <a href="{{ route('admin.dashboard') }}" class="btn btn-sm btn-primary">
                        Kembali
                    </a>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-6">
                            <h5 class="fw-semibold">Tanggal Penyusunan:</h5>
                            <p>{{ \Carbon\Carbon::parse($barang->tanggal_penyusunan)->format('d M Y') }}</p>
                        </div>
                        <div class="col-6">
                            <h5 class="fw-semibold">No Barang:</h5>
                            <p>{{ $barang->no_barang }}</p>
                        </div>
                        <div class="col-6">
                            <h5 class="fw-semibold">Line:</h5>
                            <p>{{ $barang->line_code }}</p>
                        </div>
                        <div class="col-6">
                            <h5 class="fw-semibold">Chargis:</h5>
                            <p>{{ $barang->chargis_from }} - {{ $barang->chargis_to }}</p>
                        </div>
                        <div class="col-6">
                            <h5 class="fw-semibold">Shift:</h5>
                            <p>{{ $barang->shift }}</p>
                        </div>
                        <div class="col-6">
                            <h5 class="fw-semibold">Reported By :</h5>
                            <p>{{$barang->user->name ?? '-'}}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection