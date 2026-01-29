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
            left: -260px;
            z-index: 1000;
            transition: left .3s ease;
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

        .sidebar-wrapper.show {
            left: 0;
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
            left: 0;
            padding-left: 16px;
            padding-right: 16px;
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
			height: 280px; /* WAJIB */
			position: relative;
            width: 100%;
		}

        /* Desktop */
        @media (min-width: 992px) {
            .sidebar-wrapper {
                left: 0;
            }
        }

        /* ============================= */
    /* RESPONSIVE (MOBILE & TABLET) */
    /* ============================= */
    @media (max-width: 991px) {


        /* TOPBAR */
        .topbar {
            left: 0;
            padding-left: 16px;
            padding-right: 16px;
        }

        /* CONTENT */
        .page-content {
            margin-left: 0;
            padding: 88px 16px 24px;
        }
    }

    /* HP KECIL */
    @media (max-width: 576px) {
        .page-content {
            padding: 80px 12px 20px;
        }

        .user-info {
            display: none; /* sembunyikan nama biar muat */
        }
    }

    /*shift.list*/
            .shift-list {
            display: flex;
            flex-direction: column;
            gap: 6px;
        }

        .shift-item {
            display: grid;
            grid-template-columns: 30px 80px auto;
            gap: 6px;
            font-size: 13px;
            padding: 4px 6px;
            border-bottom: 1px dashed #e5e7eb;
        }

        .shift-item:last-child {
            border-bottom: none;
        }

        .shift-item .line {
            font-weight: 600;
            text-align: center;
        }

        .shift-item .barang {
            font-family: monospace;
        }

        .shift-item .chargis {
            text-align: right;
            color: #64748b;
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
    <div class="topbar-left d-flex align-items-center">
        <button class="btn btn-light d-lg-none me-2"
                onclick="toggleSidebar()">
            <i class="bx bx-menu"></i>
        </button>
    </div>

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
<script>
const sidebar = document.querySelector('.sidebar-wrapper');
const burger  = document.querySelector('.bx-menu').parentElement;

function toggleSidebar() {
    sidebar.classList.toggle('show');
}

// KLIK DI LUAR SIDEBAR → TUTUP
document.addEventListener('click', function (e) {

    // kalau sidebar ga kebuka, skip
    if (!sidebar.classList.contains('show')) return;

    // kalau klik di sidebar ATAU di burger, jangan tutup
    if (sidebar.contains(e.target) || burger.contains(e.target)) return;

    // selain itu → tutup sidebar
    sidebar.classList.remove('show');
});
</script>

@yield('script')


</body>
</html>
