<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Laravel SB Admin 2">
    <meta name="author" content="Alejandro RH">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Sistem Pakar Penyakit Kulit | Dashboard</title>

    <!-- Fonts -->
    <link href="{{ asset('vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/sb-admin-2.min.css') }}" rel="stylesheet">
    
    
    <!-- Datatable -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css">

    <!-- DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.25/css/dataTables.bootstrap4.min.css">

    {{-- Sweet Alert --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    
    <script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
</head>
<body id="page-top">

<!-- Page Wrapper -->
<div id="wrapper">
    <!-- Sidebar -->
    <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

        <!-- Sidebar - Brand -->
        <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
            <div class="sidebar-brand-text mx-3">Penyakit Kulit</div>
        </a>

        <!-- Divider -->
        <hr class="sidebar-divider my-0">

        <!-- Nav Item - Home -->
        <li class="nav-item {{ Nav::isRoute('home') }}">
            <a class="nav-link" href="{{ route('home') }}">
                <i class="fas fa-fw fa-home"></i>
                <span>{{ __('Home') }}</span></a>
        </li>

        @if (Auth::check())
            <!-- Nav Item - Prediction -->
            <li class="nav-item {{ Nav::isRoute('prediction*') }}">
                <a class="nav-link" href="{{ route('prediction') }}">
                    <i class="fas fa-fw fa-smile"></i>
                    <span>{{ __('Prediksi') }}</span>
                </a>
            </li>
        @endif

        <!-- Divider -->
        <hr class="sidebar-divider d-none d-md-block">

        @if (auth()->user()->isAdmin())
            <div class="sidebar-heading">Data</div>

            <!-- Nav Item - Diseases -->
            <li class="nav-item {{ Nav::isRoute('master.diseases.*') }}">
                <a class="nav-link" href="{{ route('master.diseases.list') }}">
                    <i class="fas fa-fw fa-virus"></i>
                    <span>{{ __('Penyakit') }}</span></a>
            </li>

            <!-- Nav Item - Symptoms -->
            <li class="nav-item {{ Nav::isRoute('master.symptoms.*') }}">
                <a class="nav-link" href="{{ route('master.symptoms.list') }}">
                    <i class="fas fa-fw fa-flag"></i>
                    <span>{{ __('Gejala') }}</span></a>
            </li>

            <!-- Nav Item - Certainties -->
            <li class="nav-item {{ Nav::isRoute('master.certainties.*') }}">
                <a class="nav-link" href="{{ route('master.certainties.list') }}">
                    <i class="fas fa-fw fa-lightbulb"></i>
                    <span>{{ __('Keyakinan') }}</span></a>
            </li>

            <!-- Nav Item - Certainties -->
            <li class="nav-item {{ Nav::isRoute('master.assignments.*') }}">
                <a class="nav-link" href="{{ route('master.assignments.list') }}">
                    <i class="fas fa-fw fa-check-circle"></i>
                    <span>{{ __('Assign Keyakinan') }}</span></a>
            </li>

            <!-- Nav Item - Knowledges -->
            <li class="nav-item {{ Nav::isRoute('master.knowledges.*') }}">
                <a class="nav-link" href="{{ route('master.knowledges.list') }}">
                    <i class="fas fa-fw fa-database"></i>
                    <span>{{ __('Basis Pengetahuan') }}</span></a>
            </li>

            <!-- Nav Item - Decision Tree -->
            <li class="nav-item {{ Nav::isRoute('decision-tree.*') }}">
                <a class="nav-link" href="{{ route('decision-tree.list') }}">
                    <i class="fas fa-fw fa-network-wired"></i>
                    <span>{{ __('C4.5 Tree') }}</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">
        @endif

        <!-- Sidebar Toggler (Sidebar) -->
        <div class="text-center d-none d-md-inline">
            <button class="rounded-circle border-0" id="sidebarToggle"></button>
        </div>

    </ul>
    <!-- End of Sidebar -->

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

        <!-- Main Content -->
        <div id="content">

            <!-- Topbar -->
            <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                <!-- Sidebar Toggle (Topbar) -->
                <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                    <i class="fa fa-bars"></i>
                </button>

                <!-- Topbar Navbar -->
                <ul class="navbar-nav ml-auto">
                    @if (!Auth::check())
                        <li class="nav-item">
                            <a href="/login" class="nav-link"><i class="fas fa-sign-in-alt mr-2"></i> Login</a>
                        </li>
                        <li class="nav-item">
                            <a href="/register" class="nav-link">
                                <i class="fas fa-user-plus mr-2"></i> Register
                            </a>
                        </li>
                    @endif
                    
                    @if (Auth::check())
                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a
                                class="nav-link dropdown-toggle"
                                href="#"
                                id="userDropdown"
                                role="button"
                                data-toggle="dropdown"
                                aria-haspopup="true"
                                aria-expanded="false"
                            >
                            <div class="d-flex flex-column">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small">{{ Auth::user()->name }}</span>
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small"><strong>{{ auth()->user()->role->name }}</strong></span>
                            </div>    

                                <figure class="img-profile rounded-circle avatar font-weight-bold" data-initial="{{ Auth::user()->name[0] }}"></figure>
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="{{ route('profile') }}">
                                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                    {{ __('Profile') }}
                                </a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    {{ __('Logout') }}
                                </a>
                            </div>
                        </li>
                    @endif

                </ul>

            </nav>
            <!-- End of Topbar -->

            <!-- Begin Page Content -->
            <div class="container-fluid">

                @yield('main-content')

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- End of Main Content -->

        <!-- Footer -->
        <footer class="sticky-footer bg-white">
            <div class="container my-auto">
                <div class="copyright text-center my-auto">
                    <span>Copyright &copy; Sistem Pakar Penyakit Kulit {{ now()->year }}</span>
                </div>
            </div>
        </footer>
        <!-- End of Footer -->

    </div>
    <!-- End of Content Wrapper -->

</div>

<!-- Scroll to Top Button-->
<a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
</a>

<!-- Logout Modal-->
<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">{{ __('Ready to Leave?') }}</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
            <div class="modal-footer">
                <button class="btn btn-link" type="button" data-dismiss="modal">{{ __('Cancel') }}</button>
                <a class="btn btn-danger" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">{{ __('Logout') }}</a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Scripts -->
<script src="{{ asset('vendor/bootstrap/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('vendor/jquery-easing/jquery.easing.min.js') }}"></script>
<script src="{{ asset('js/sb-admin-2.min.js') }}"></script>
<script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.25/js/dataTables.bootstrap4.min.js"></script
</body>
</html>
