@extends('template-admin.layout')

@section('content')
    <div class="page-wrapper">
        <div class="page-content">
            <!--breadcrumb-->
            <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
                <div class="breadcrumb-title pe-3">Forms</div>
                <div class="ps-3">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0 p-0">
                            <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a></li>
                            <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
                            <li class="breadcrumb-item active" aria-current="page">Tambah Barang</li>
                        </ol>
                    </nav>
                </div>
            </div>
            <!--breadcrumb-->

            <div class="row">
                <div class="col-xl-7 mx-auto">
                    <hr />
                    <div class="card border-top border-0 border-4 border-primary">
                        <div class="card-body p-5">
                            <div class="card-title d-flex align-items-center">
                                <div><i class="bx bx-plus-circle me-1 font-22 text-primary"></i></div>
                                <h5 class="mb-0 text-primary">Tambah Barang</h5>
                            </div>
                            <hr>
                            <form action="{{ route('admin.dashboard.store') }}" method="POST" class="row g-3" enctype="multipart/form-data">
                                @csrf

                                <div class="col-md-12">
                                    <label for="no_barang" class="form-label">No Barang</label>
                                    <input type="text" class="form-control" id="no_barang" name="no_barang" required>
                                    <small class="text-danger">
                                        @foreach ($errors->get('no_barang') as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </small>
                                </div>

                                <div class="col-md-12">
                                    <label for="line_code" class="form-label">Line Code</label>
                                    <input type="text" class="form-control" id="line_code" name="line_code" required>
                                    <small class="text-danger">
                                        @foreach ($errors->get('line_code') as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </small>
                                </div>

                                <div class="col-md-12">
                                    <label for="chargis_from" class="form-label">Chargis From</label>
                                    <input type="text" class="form-control" id="chargis_from" name="chargis_from" required>
                                    <small class="text-danger">
                                        @foreach ($errors->get('chargis_from') as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </small>
                                </div>

                                <div class="col-md-12">
                                    <label for="chargis_to" class="form-label">Chargis To</label>
                                    <input type="text" class="form-control" id="chargis_to" name="chargis_to" required>
                                    <small class="text-danger">
                                        @foreach ($errors->get('chargis_to') as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </small>
                                </div>

                                <div class="col-md-12">
                                    <label for="shift" class="form-label">Shift</label>
                                    <select class="form-control" id="shift" name="shift" required>
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                    </select>
                                    <small class="text-danger">
                                        @foreach ($errors->get('shift') as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </small>
                                </div>

                                <div class="col-md-12">
                                    <label for="info" class="form-label">Info</label>
                                    <textarea class="form-control" id="info" name="info"></textarea>
                                    <small class="text-danger">
                                        @foreach ($errors->get('info') as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </small>
                                </div>

                                <div class="col-12 mt-3 d-flex justify-content-end">
                                    <button type="submit" class="btn btn-primary px-5">Simpan</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
