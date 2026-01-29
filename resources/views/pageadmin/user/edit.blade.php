@extends('template-admin.layout')

@section('content')
<div class="container-fluid">

    {{-- HEADER --}}
    <div class="mb-4">
        <h4 class="fw-bold mb-0">Edit User</h4>
        <small class="text-muted">Perbarui data pengguna sistem</small>
    </div>

    <div class="row justify-content-left">
        <div class="col-xl-8">

            <div class="card">
                <div class="card-body p-4">

                    <form action="{{ route('users.update', $user->id) }}"
                          method="POST"
                          class="row g-4">
                        @csrf
                        @method('PUT')

                        {{-- NAMA --}}
                        <div class="col-md-6">
                            <label class="form-label">Nama</label>
                            <input type="text"
                                   name="name"
                                   class="form-control @error('name') is-invalid @enderror"
                                   value="{{ old('name', $user->name) }}">
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- EMAIL --}}
                        <div class="col-md-6">
                            <label class="form-label">Email</label>
                            <input type="email"
                                   name="email"
                                   class="form-control @error('email') is-invalid @enderror"
                                   value="{{ old('email', $user->email) }}">
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- PASSWORD --}}
                        <div class="col-md-6">
                            <label class="form-label">
                                Password
                                <span class="text-muted">(kosongkan jika tidak diubah)</span>
                            </label>
                            <div class="input-group">
                                <input type="password"
                                       id="password"
                                       name="password"
                                       class="form-control @error('password') is-invalid @enderror">
                                <button class="btn btn-outline-secondary" type="button" id="togglePassword">
                                    <i class="bx bx-hide"></i>
                                </button>
                            </div>
                            @error('password')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- CONFIRM PASSWORD --}}
                        <div class="col-md-6">
                            <label class="form-label">
                                Konfirmasi Password
                            </label>
                            <div class="input-group">
                                <input type="password"
                                       id="password_confirmation"
                                       name="password_confirmation"
                                       class="form-control">
                                <button class="btn btn-outline-secondary" type="button" id="toggleConfirmPassword">
                                    <i class="bx bx-hide"></i>
                                </button>
                            </div>
                        </div>

                        {{-- ROLE --}}
                        <div class="col-md-6">
                            <label class="form-label">Role</label>
                            <select name="role"
                                    class="form-select @error('role') is-invalid @enderror">
                                <option value="admin" {{ old('role',$user->role)=='admin'?'selected':'' }}>
                                    Admin
                                </option>
                                <option value="operator" {{ old('role',$user->role)=='operator'?'selected':'' }}>
                                    Operator
                                </option>
                                <option value="user" {{ old('role',$user->role)=='user'?'selected':'' }}>
                                    User
                                </option>
                            </select>
                            @error('role')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- ACTION --}}
                        <div class="col-12 d-flex justify-content-end gap-2 mt-3">
                            <a href="{{ route('users.index') }}"
                               class="btn btn-light px-4">
                                Batal
                            </a>
                            <button type="submit"
                                    class="btn btn-primary px-5">
                                Update User
                            </button>
                        </div>

                    </form>

                </div>
            </div>

        </div>
    </div>
</div>

{{-- PASSWORD TOGGLE --}}
<script>
    document.getElementById('togglePassword').addEventListener('click', function () {
        const input = document.getElementById('password');
        const icon = this.querySelector('i');
        if (input.type === 'password') {
            input.type = 'text';
            icon.classList.replace('bx-hide', 'bx-show');
        } else {
            input.type = 'password';
            icon.classList.replace('bx-show', 'bx-hide');
        }
    });

    document.getElementById('toggleConfirmPassword').addEventListener('click', function () {
        const input = document.getElementById('password_confirmation');
        const icon = this.querySelector('i');
        if (input.type === 'password') {
            input.type = 'text';
            icon.classList.replace('bx-hide', 'bx-show');
        } else {
            input.type = 'password';
            icon.classList.replace('bx-show', 'bx-hide');
        }
    });
</script>
@endsection
