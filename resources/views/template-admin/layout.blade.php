<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Dashboard | Report Penyusunan</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    {{-- CORE CSS --}}
    <link href="{{ asset('admin') }}/assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{ asset('admin') }}/assets/css/bootstrap-extended.css" rel="stylesheet">
    <link href="{{ asset('admin') }}/assets/css/app.css" rel="stylesheet">
    <link href="{{ asset('admin') }}/assets/css/icons.css" rel="stylesheet">

    {{-- PLUGINS --}}
    <link href="{{ asset('admin') }}/assets/plugins/simplebar/css/simplebar.css" rel="stylesheet">
    <link href="{{ asset('admin') }}/assets/plugins/metismenu/css/metisMenu.min.css" rel="stylesheet">

    {{-- FONT --}}
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

    @yield('style')

    {{-- CUSTOM STYLE --}}
    <style>
        body {
            font-family: 'Inter', sans-serif;
            background-color: #f5f7fb;
        }

        /* ===== SIDEBAR ===== */
        .sidebar-wrapper {
            width: 260px;
            background: #0f172a;
            position: fixed;
            top: 0;
            bottom: 0;
            left: 0;
            z-index: 1000;
        }

        .sidebar-header {
			background: #0f172a;
            padding: 24px 20px;
            border-bottom: 1px solid rgba(240, 3, 3, 0.08);
        }

        .sidebar-header h4 {
            color: #ffffff;
            font-weight: 700;
            margin: 0;
            letter-spacing: .5px;
        }

        .sidebar-header small {
            color: #ffffff;
			font-size: 12px;
			opacity: .7;

        }

        .metismenu a {
            color: #cbd5e1;
            padding: 12px 20px;
            display: flex;
            align-items: center;
            font-weight: 500;
        }

        .metismenu a:hover,
        .metismenu .mm-active > a {
            background: rgba(255,255,255,.08);
            color: #fff;
            border-left: 4px solid #3b82f6;
        }

        /* ===== HEADER ===== */
        .topbar {
            height: 64px;
            background: #ffffff;
            border-bottom: 1px solid #e5e7eb;
            position: fixed;
            left: 260px;
            right: 0;
            top: 0;
            z-index: 900;
            padding: 0 24px;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .user-box {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .user-box img {
            width: 38px;
            height: 38px;
            border-radius: 50%;
        }

        .user-info p {
            margin: 0;
            font-weight: 600;
            font-size: 14px;
        }

        .user-info small {
			font-size: 12px;
            color: #64748b;
        }

        /* ===== CONTENT ===== */
        .page-content {
            margin-left: 260px;
            padding: 96px 32px 32px;
            min-height: 100vh;
        }

        /* ===== FOOTER ===== */
        footer {
            text-align: center;
            color: #64748b;
            font-size: 13px;
            margin-top: 40px;
        }

        /* ===== CARD ===== */
        .card {
            border-radius: 16px;
            border: none;
            box-shadow: 0 10px 30px rgba(0,0,0,.04);
        }

		.chart-wrapper {
			height: 200px; /* WAJIB */
			position: relative;
		}

    </style>
</head>

<body>

{{-- SIDEBAR --}}
<div class="sidebar-wrapper">
    <div class="sidebar-header">
        <h4>REPORT</h4>
        <small>Penyusunan</small>
    </div>

    @include('template-admin.navbar')
</div>

{{-- HEADER --}}
<div class="topbar">
    <div class="topbar-left"></div>

    <div class="dropdown">
        <a href="#"
           class="d-flex align-items-center text-decoration-none dropdown-toggle"
           id="userDropdown"
           data-bs-toggle="dropdown"
           aria-expanded="false">

            <img src="https://cdn-icons-png.flaticon.com/512/9187/9187604.png"
                 class="rounded-circle"
                 width="38"
                 height="38">

            <div class="user-info ms-2 text-start">
                <p class="mb-0">{{ Auth::user()->name }}</p>
                <small>{{ strtoupper(Auth::user()->role) }}</small>
            </div>
        </a>

        <ul class="dropdown-menu dropdown-menu-end shadow">
            <li>
                <a class="dropdown-item" href="{{ route('logout') }}"
                   onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    <i class="bx bx-log-out-circle me-2"></i> Logout
                </a>
            </li>
        </ul>

        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
            @csrf
        </form>
    </div>
</div>

{{-- CONTENT --}}
<div class="page-content">
    @yield('content')

    <footer class="page-footer">
        © 2025 Report Penyusunan. All rights reserved.
    </footer>
</div>

{{-- JS --}}
<script src="{{ asset('admin') }}/assets/js/jquery.min.js"></script>
<script src="{{ asset('admin') }}/assets/js/bootstrap.bundle.min.js"></script>
<script src="{{ asset('admin') }}/assets/plugins/metismenu/js/metisMenu.min.js"></script>
<script src="{{ asset('admin') }}/assets/plugins/simplebar/js/simplebar.min.js"></script>
<script src="{{ asset('admin') }}/assets/js/app.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
@yield('script')


</body>
</html>
