<!doctype html>
<html lang="en">

<head>
	<!-- Required meta tags -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!--favicon-->
	<link rel="icon" href="" type="image/png"/>
	<!--plugins-->
	<link href="{{ asset('admin') }}/assets/plugins/vectormap/jquery-jvectormap-2.0.2.css" rel="stylesheet"/>
	<link href="{{ asset('admin') }}/assets/plugins/simplebar/css/simplebar.css" rel="stylesheet" />
	<link href="{{ asset('admin') }}/assets/plugins/perfect-scrollbar/css/perfect-scrollbar.css" rel="stylesheet" />
	<link href="{{ asset('admin') }}/assets/plugins/metismenu/css/metisMenu.min.css" rel="stylesheet"/>
	<!-- loader-->
	<link href="{{ asset('admin') }}/assets/css/pace.min.css" rel="stylesheet"/>
	<script src="{{ asset('admin') }}/assets/js/pace.min.js"></script>
	<!-- Bootstrap CSS -->
	<link href="{{ asset('admin') }}/assets/css/bootstrap.min.css" rel="stylesheet">
	<link href="{{ asset('admin') }}/assets/css/bootstrap-extended.css" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet">
	<link href="{{ asset('admin') }}/assets/css/app.css" rel="stylesheet">
	<link href="{{ asset('admin') }}/assets/css/icons.css" rel="stylesheet">
	<!-- Theme Style CSS -->
	<link rel="stylesheet" href="{{ asset('admin') }}/assets/css/dark-theme.css"/>
	<link rel="stylesheet" href="{{ asset('admin') }}/assets/css/semi-dark.css"/>
	<link rel="stylesheet" href="{{ asset('admin') }}/assets/css/header-colors.css"/>
    @yield('style')
	<title>Dashboard</title>
</head>

<body>
    <!--wrapper-->
    <div class="wrapper">
        <!--sidebar wrapper -->
        <div class="sidebar-wrapper" data-simplebar="true">
            <div class="sidebar-header">
				<div>
					{{-- <img src="{{ asset('env') }}/logotangkas.png" class="logo-icon" alt="logo icon"> --}}
				</div>
				<div>
					<h4 class="logo-text">REPORT PENYUSUNAN</h4>
				</div>
				<div class="toggle-icon ms-auto"><i class='bx bx-arrow-to-left'></i>
				</div>
			</div>
            <!--navigation-->
            @include('template-admin.navbar')

            <!--end navigation-->
        </div>
        <!--end sidebar wrapper -->
        <!--start header -->
        <header>
			<div class="topbar d-flex align-items-center">
				<nav class="navbar navbar-expand">
					<div class="mobile-toggle-menu"><i class='bx bx-menu'></i>
					</div>
					{{-- <div class="search-bar flex-grow-1">
						<div class="position-relative search-bar-box">
							<input type="text" class="form-control search-control" placeholder="Type to search..."> <span class="position-absolute top-50 search-show translate-middle-y"><i class='bx bx-search'></i></span>
							<span class="position-absolute top-50 search-close translate-middle-y"><i class='bx bx-x'></i></span>
						</div>
					</div> --}}
					<div class="top-menu ms-auto">
			
					</div>
					<div class="user-box dropdown">
						<a class="d-flex align-items-center nav-link dropdown-toggle dropdown-toggle-nocaret" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
							<img src="https://cdn-icons-png.flaticon.com/512/9187/9187604.png" class="user-img" alt="user avatar">
						
							<div class="user-info ps-3">
									<p class="user-name mb-0">{{ Auth::user()->name }}</p>
									<p class="designation mb-0">{{ Auth::user()->role }}</p>
							</div>
						</a>
						
						<ul class="dropdown-menu dropdown-menu-end">
						
							
							<li>
								<div class="dropdown-divider mb-0"></div>
							</li>
							<li><a class="dropdown-item" href="/logout"><i class='bx bx-log-out-circle'></i><span>Logout</span></a>
							</li>
						</ul>
					</div>
				</nav>
			</div>
		</header>
        <!--end header -->
        <!--start page wrapper -->
        @yield('content')

        <!--end page wrapper -->
        <!--start overlay-->
        <div class="overlay toggle-icon"></div>
        <!--end overlay-->
        <!--Start Back To Top Button-->
        <a class="back-to-top" href="javaScript:;"><i class='bx bxs-up-arrow-alt'></i></a>
        <!--End Back To Top Button-->
        <footer class="page-footer">
            <?php
            // Dapatkan tahun sekarang menggunakan PHP
            $year = date('Y');
            ?>

            <p class="mb-0">Copyright © <?php echo $year; ?>. All right reserved.</p>
        </footer>
    </div>
    <!--end wrapper-->
    <!--start switcher-->

    <!--end switcher-->
    @include('sweetalert::alert')

    @yield('script')

    <!-- Bootstrap JS -->
    <script src="{{ asset('admin') }}/assets/js/bootstrap.bundle.min.js"></script>
    <!--plugins-->
    <script src="{{ asset('admin') }}/assets/js/jquery.min.js"></script>
    <script src="{{ asset('admin') }}/assets/plugins/simplebar/js/simplebar.min.js"></script>
    <script src="{{ asset('admin') }}/assets/plugins/metismenu/js/metisMenu.min.js"></script>
    <script src="{{ asset('admin') }}/assets/plugins/perfect-scrollbar/js/perfect-scrollbar.js"></script>
    <script src="{{ asset('admin') }}/assets/plugins/vectormap/jquery-jvectormap-2.0.2.min.js"></script>
    <script src="{{ asset('admin') }}/assets/plugins/vectormap/jquery-jvectormap-world-mill-en.js"></script>
    <script src="{{ asset('admin') }}/assets/plugins/chartjs/js/Chart.min.js"></script>
    <script src="{{ asset('admin') }}/assets/plugins/chartjs/js/Chart.extension.js"></script>
    <script src="{{ asset('admin') }}/assets/js/index.js"></script>
    <!--app JS-->
    <script src="{{ asset('admin') }}/assets/js/app.js"></script>

    {{-- UPLOAD --}}
    <script src="{{ asset('admin') }}/assets/plugins/Drag-And-Drop/dist/imageuploadify.min.js"></script>


    <script src="{{ asset('admin') }}/assets/plugins/datatable/js/jquery.dataTables.min.js"></script>
	<script src="{{ asset('admin') }}/assets/plugins/datatable/js/dataTables.bootstrap5.min.js"></script>
	<script>
		$(document).ready(function() {
			// Initialize DataTable for the first table without search functionality
			$('#example').DataTable({
				searching: false // Disable search
			});
		});
	</script>
	
	<script>
		$(document).ready(function() {
			// Initialize DataTable for the second table without search functionality
			var table = $('#example2').DataTable({
				lengthChange: false,
				searching: false, // Disable search
				// buttons: ['copy', 'excel', 'pdf', 'print']
			});
	
			table.buttons().container()
				.appendTo('#example2_wrapper .col-md-6:eq(0)');
		});
	</script>
	
	<!--app JS-->



</body>

</html>
