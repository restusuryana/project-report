<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Login | Report Penyusunan</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="{{ asset('admin') }}/assets/css/bootstrap.min.css" rel="stylesheet">

    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Inter', sans-serif;
            background: #0f172a;
            min-height: 100vh;
        }

        .login-wrapper {
            min-height: 100vh;
            display: flex;
        }

        /* LEFT */
        .login-left {
            flex: 1;
            background: linear-gradient(180deg, #020617, #0f172a);
            color: #fff;
            padding: 60px;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .login-left h1 {
            font-weight: 700;
            margin-bottom: 12px;
        }

        .login-left p {
            color: #94a3b8;
            max-width: 360px;
        }

        /* RIGHT */
        .login-right {
            flex: 1;
            background: #f8fafc;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .login-card {
            width: 100%;
            max-width: 380px;
            background: #ffffff;
            border-radius: 16px;
            padding: 32px;
            box-shadow: 0 20px 40px rgba(0,0,0,.08);
        }

        .login-card h4 {
            font-weight: 700;
            margin-bottom: 4px;
        }

        .login-card small {
            color: #64748b;
        }

        .form-control {
            border-radius: 10px;
            padding: 10px 14px;
        }

        .btn-primary {
            border-radius: 10px;
            padding: 10px;
            font-weight: 600;
        }

        .form-label {
            font-size: 14px;
            font-weight: 500;
        }

        @media (max-width: 768px) {
            .login-left {
                display: none;
            }
        }
    </style>
</head>

<body>

<div class="login-wrapper">

    {{-- LEFT --}}
    <div class="login-left">
        <h1>Report Penyusunan</h1>
        <p>
            Sistem monitoring dan pencatatan penyusunan barang
            berbasis web untuk mendukung proses penyusunan.
        </p>
    </div>

    {{-- RIGHT --}}
    <div class="login-right">
        <div class="login-card">

            <h4>Login</h4>
            <small>Masuk ke sistem</small>

            <form action="{{ route('login.post') }}" method="POST" class="mt-4">
                @csrf

                {{-- EMAIL --}}
                <div class="mb-3">
                    <label class="form-label">Email</label>
                    <input type="email"
                           name="email"
                           class="form-control @error('email') is-invalid @enderror"
                           placeholder="email@example.com"
                           value="{{ old('email') }}">
                    @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- PASSWORD --}}
                <div class="mb-4">
                    <label class="form-label">Password</label>
                    <input type="password"
                           name="password"
                           class="form-control @error('password') is-invalid @enderror"
                           placeholder="••••••••">
                    @error('password')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <button class="btn btn-primary w-100">
                    Login
                </button>
            </form>

        </div>
    </div>

</div>

</body>
</html>
