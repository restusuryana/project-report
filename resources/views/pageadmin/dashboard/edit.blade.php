@extends('template-admin.layout')

@section('content')
<div class="container-fluid">

    {{-- HEADER --}}
    <div class="mb-4">
        <h4 class="fw-bold mb-0">Edit Data Barang</h4>
        <small class="text-muted">Perbarui data penyusunan barang</small>
    </div>

    <div class="row justify-content-center">
        <div class="col-xl-8">

            <div class="card">
                <div class="card-body p-4">

                    <form action="{{ route('admin.dashboard.update', $barang->id) }}"
                          method="POST"
                          class="row g-4">
                        @csrf
                        @method('PUT')

                        {{-- NO BARANG --}}
                        <div class="col-md-6">
                            <label class="form-label">No Barang</label>
                            <input type="text"
                                   name="no_barang"
                                   class="form-control @error('no_barang') is-invalid @enderror"
                                   value="{{ old('no_barang', $barang->no_barang) }}">
                            @error('no_barang')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- LINE CODE --}}
                        <div class="col-md-6">
                            <label class="form-label">Line Code</label>
                            <select name="line_code"
                                    class="form-control @error('line_code') is-invalid @enderror">
                                <option value="">-- Pilih Line --</option>
                                <option value="A" {{ old('line_code') == 'A' ? 'selected' : '' }}>A</option>
                                <option value="B" {{ old('line_code') == 'B' ? 'selected' : '' }}>B</option>
                                <option value="C" {{ old('line_code') == 'C' ? 'selected' : '' }}>C</option>
                                <option value="D1" {{ old('line_code') == 'D1' ? 'selected' : '' }}>D1</option>
                                <option value="E" {{ old('line_code') == 'E' ? 'selected' : '' }}>E</option>
                                <option value="F1" {{ old('line_code') == 'F1' ? 'selected' : '' }}>F1</option>
                                <option value="G1" {{ old('line_code') == 'G1' ? 'selected' : '' }}>G1</option>
                                <option value="H1" {{ old('line_code') == 'H1' ? 'selected' : '' }}>H1</option>
                                <option value="I" {{ old('line_code') == 'I' ? 'selected' : '' }}>I</option>
                            </select>

                            @error('line_code')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- CHARGIS FROM --}}
                        <div class="col-md-6">
                            <label class="form-label">Chargis From</label>
                            <input type="number"
                                   name="chargis_from"
                                   class="form-control @error('chargis_from') is-invalid @enderror"
                                   value="{{ old('chargis_from', $barang->chargis_from) }}">
                            @error('chargis_from')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- CHARGIS TO --}}
                        <div class="col-md-6">
                            <label class="form-label">Chargis To</label>
                            <input type="number"
                                   name="chargis_to"
                                   class="form-control @error('chargis_to') is-invalid @enderror"
                                   value="{{ old('chargis_to', $barang->chargis_to) }}">
                            @error('chargis_to')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- SHIFT (READ ONLY) --}}
                        <div class="col-md-6">
                            <label class="form-label">Shift</label>
                            <input type="text"
                                   class="form-control"
                                   value="{{ $barang->shift }}"
                                   readonly>
                        </div>

                        {{-- INFO --}}
                        <div class="col-md-12">
                            <label class="form-label">Keterangan</label>
                            <textarea name="info"
                                      rows="3"
                                      class="form-control @error('info') is-invalid @enderror">{{ old('info', $barang->info) }}</textarea>
                            @error('info')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- ACTION --}}
                        <div class="col-12 d-flex justify-content-end gap-2 mt-3">
                            <a href="{{ route('admin.dashboard') }}"
                               class="btn btn-light px-4">
                                Batal
                            </a>
                            <button type="submit"
                                    class="btn btn-primary px-5">
                                Update Data
                            </button>
                        </div>

                    </form>

                </div>
            </div>

        </div>
    </div>
</div>
@endsection
