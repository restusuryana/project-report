@extends('template-admin.layout')

@section('content')

<div class="page-wrapper">
    <div class="container-fluid">

        <h4 class="mb-3">Profil Saya</h4>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <div class="card">
            <div class="card-body">

                <form method="POST" action="{{ route('profile.update') }}">
                    @csrf

                    <div class="mb-3">
                        <label>Nama</label>
                        <input type="text" name="name"
                               value="{{ auth()->user()->name }}"
                               class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label>Email</label>
                        <input type="email" name="email"
                               value="{{ auth()->user()->email }}"
                               class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label>Role</label>
                        <input type="text"
                               value="{{ auth()->user()->role }}"
                               class="form-control" readonly>
                    </div>

                    <hr>

                    <div class="mb-3">
                        <label>Password Baru (opsional)</label>
                        <input type="password" name="password" class="form-control">
                        <small class="text-muted">
                            Kosongkan jika tidak ingin mengganti password
                        </small>
                    </div>

                    <div class="mb-3">
                        <label>Konfirmasi Password</label>
                        <input type="password" name="password_confirmation" class="form-control">
                    </div>

                    <button class="btn btn-primary">
                        Simpan Perubahan
                    </button>
                </form>

            </div>
        </div>

    </div>
</div>
@endsection
