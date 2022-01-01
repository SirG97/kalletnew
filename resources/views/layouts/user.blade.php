<!DOCTYPE html>
<html dir="ltr" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="keywords"
          content="buy, sell, exchange">
    <meta name="description"
          content="Kallet E-wallet">
    <meta name="robots" content="noindex,nofollow">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Kallet</title>
    <link rel="canonical" href="https://carlosexchange.com" />
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('plugins/images/favicon.png') }}">
    <!-- Custom CSS -->
    <link href="{{ asset('plugins/bower_components/chartist/dist/chartist.min.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('plugins/bower_components/chartist-plugin-tooltips/dist/chartist-plugin-tooltip.css')}}">
    <!-- Custom CSS -->
    <link href="{{ asset('css/amplestyle.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/extra.css')}}" rel="stylesheet">
</head>

<body>
<!-- ============================================================== -->
<!-- Preloader - style you can find in spinners.css -->
<!-- ============================================================== -->
<div class="preloader">
    <div class="lds-ripple">
        <div class="lds-pos"></div>
        <div class="lds-pos"></div>
    </div>
</div>
<!-- ============================================================== -->
<!-- Main wrapper - style you can find in pages.scss -->
<!-- ============================================================== -->
<div id="main-wrapper" data-layout="vertical" data-navbarbg="skin5" data-sidebartype="full"
     data-sidebar-position="absolute" data-header-position="absolute" data-boxed-layout="full">
    <!-- ============================================================== -->
    <!-- Topbar header - style you can find in pages.scss -->
    <!-- ============================================================== -->
    <header class="topbar" data-navbarbg="skin5">
        <nav class="navbar top-navbar navbar-expand-md navbar-dark">
            <div class="navbar-header" data-logobg="skin6">
                <!-- ============================================================== -->
                <!-- Logo -->
                <!-- ============================================================== -->
                <a class="navbar-brand" href="/">
                    <!-- Logo icon -->
                    <b class="logo-icon">
                        <!-- Dark Logo icon -->
{{--                        @if(!is_null($config) and !is_null($config->logo))--}}
{{--                        <img src="{{ asset('/storage') }}/{{ $config->logo }}" style="width: 50px; height: 50px; border-radius: 50%" alt="homepage" />--}}
{{--                        @else--}}
                        <img src="{{ asset('img/logo2.png') }}" style="width: 50px; height: 50px; border-radius: 50%" alt="homepage" />
{{--                        @endif--}}
                    </b>
                    <!--End Logo icon -->
                    <!-- Logo text -->
                    <span class="logo-text">
                            <!-- dark Logo text -->
                        <span class="font-weight-bold">Kallet</span>
{{--                            <img src="plugins/images/logo-text.png" alt="homepage" />--}}
                        </span>
                </a>
                <!-- ============================================================== -->
                <!-- End Logo -->
                <!-- ============================================================== -->
                <!-- ============================================================== -->
                <!-- toggle and nav items -->
                <!-- ============================================================== -->
                <a class="nav-toggler waves-effect waves-light text-dark d-block d-md-none"
                   href="javascript:void(0)"><i class="ti-menu ti-close"></i></a>
            </div>
            <!-- ============================================================== -->
            <!-- End Logo -->
            <!-- ============================================================== -->
            <div class="navbar-collapse collapse" id="navbarSupportedContent" data-navbarbg="skin5">

                <!-- ============================================================== -->
                <!-- Right side toggle and nav items -->
                <!-- ============================================================== -->
                <ul class="navbar-nav ms-auto d-flex align-items-center">

                    <!-- ============================================================== -->

                    <!-- User profile and search -->
                    <!-- ============================================================== -->
                    <li>
                        <a class="profile-pic" href="#">
                            <img src="plugins/images/users/varun.jpg" alt="user-img" width="36"
                                 class="img-circle"><span class="text-white font-medium">Steave</span></a>
                    </li>
                    <!-- ============================================================== -->
                    <!-- User profile and search -->
                    <!-- ============================================================== -->
                </ul>
            </div>
        </nav>
    </header>
    <!-- ============================================================== -->
    <!-- End Topbar header -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- Left Sidebar - style you can find in sidebar.scss  -->
    <!-- ============================================================== -->
    <aside class="left-sidebar" data-sidebarbg="skin6">
        <!-- Sidebar scroll-->
        <div class="scroll-sidebar">
            <!-- Sidebar navigation-->
            <nav class="sidebar-nav">
                <ul id="sidebarnav">
                    <!-- User Profile-->
                    <li class="sidebar-item pt-2">
                        <a class="sidebar-link waves-effect waves-dark sidebar-link" href="{{ route('home') }}"
                           aria-expanded="false">
                            <i class="far fa-clock" aria-hidden="true"></i>
                            <span class="hide-menu">Dashboard</span>
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a class="sidebar-link waves-effect waves-dark sidebar-link" href="{{ route('fund') }}"
                           aria-expanded="false">
                            <i class="far fa-money-bill-alt" aria-hidden="true"></i>
                            <span class="hide-menu">Fund Account</span>
                        </a>
                    </li>

                    <li class="sidebar-item">
                        <a class="sidebar-link waves-effect waves-dark sidebar-link" href="{{route('QRPayment')}}"
                           aria-expanded="false">
                            <i class="far fa-lightbulb" aria-hidden="true"></i>
                            <span class="hide-menu">QR Payment</span>
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a class="sidebar-link waves-effect waves-dark sidebar-link" href="{{route('transfer')}}"
                           aria-expanded="false">
                            <i class="far fa-handshake" aria-hidden="true"></i>
                            <span class="hide-menu">Transfer</span>
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a class="sidebar-link waves-effect waves-dark sidebar-link" href="{{route('transactions')}}"
                           aria-expanded="false">
                            <i class="fa fa-history" aria-hidden="true"></i>
                            <span class="hide-menu">Transactions</span>
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a class="sidebar-link waves-effect waves-dark sidebar-link" href="{{route('tickets')}}"
                           aria-expanded="false">
                            <i class="far fa-gem" aria-hidden="true"></i>
                            <span class="hide-menu">Disputes</span>
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a class="sidebar-link waves-effect waves-dark sidebar-link" href="{{route('referrals')}}"
                           aria-expanded="false">
                            <i class="fa fa-headphones" aria-hidden="true"></i>
                            <span class="hide-menu">Referrals</span>
                        </a>
                    </li>
                    <li class="sidebar-item selected">
                        <a class="sidebar-link has-arrow waves-effect waves-dark active" href="javascript:void(0)" aria-expanded="false">
                            <i class="far fa-sun"></i>
                            <span class="hide-menu">Settings</span>
                        </a>
                        <ul aria-expanded="false" class="collapse first-level in">
                            <li class="sidebar-item">
                                <a href="{{ route('profile') }}" class="sidebar-link">
                                    <i class="far fa-user"></i>
                                    <span class="hide-menu">Profile</span>
                                </a>
                            </li>
                            <li class="sidebar-item">
                                <a href="{{ route('KYC') }}" class="sidebar-link">
                                    <i class="far fa-address-card"></i>
                                    <span class="hide-menu">KYC</span>
                                </a>
                            </li>

                        </ul>
                    </li>

                    <li class="sidebar-item">
                        <a class="sidebar-link waves-effect waves-dark sidebar-link" href="{{ route('logout') }}"
                           aria-expanded="false"
                           onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                            <i class="far fa-arrow-alt-circle-right" aria-hidden="true"></i>
                            <span class="hide-menu">Logout</span>
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </li>

                </ul>

            </nav>
            <!-- End Sidebar navigation -->
        </div>
        <!-- End Sidebar scroll-->
    </aside>
    <!-- ============================================================== -->
    <!-- End Left Sidebar - style you can find in sidebar.scss  -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- Page wrapper  -->
    <!-- ============================================================== -->
    <div class="page-wrapper">
        <!-- ============================================================== -->
        <!-- Bread crumb and right sidebar toggle -->
        <!-- ============================================================== -->
        <div class="page-breadcrumb bg-white">
            <div class="row align-items-center">
                <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                    <h4 class="page-title">@yield('page')</h4>
                </div>

            </div>
            <!-- /.col-lg-12 -->
        </div>
        <!-- ============================================================== -->
        <!-- End Bread crumb and right sidebar toggle -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Container fluid  -->
        <!-- ============================================================== -->
        @yield('content')
        <!-- ============================================================== -->
        <!-- End Container fluid  -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- footer -->
        <!-- ============================================================== -->
        <footer class="footer text-center"> 2021 © Kallet

        </footer>
        <!-- ============================================================== -->
        <!-- End footer -->
        <!-- ============================================================== -->
    </div>
    <!-- ============================================================== -->
    <!-- End Page wrapper  -->
    <!-- ============================================================== -->
</div>
<!-- ============================================================== -->
<!-- End Wrapper -->
<!-- ============================================================== -->
<!-- ============================================================== -->
<!-- All Jquery -->
<!-- ============================================================== -->
<script src="{{ asset('plugins/bower_components/jquery/dist/jquery.min.js') }}"></script>
<!-- Bootstrap tether Core JavaScript -->
<script src="{{ asset('bootstrap/dist/js/bootstrap.bundle.min.js')}}"></script>
<script src="{{ asset('js/app-style-switcher.js')}}"></script>
<script src="{{ asset('plugins/bower_components/jquery-sparkline/jquery.sparkline.min.js')}}"></script>
<!--Wave Effects -->
<script src="{{ asset('js/waves.js')}}"></script>
<!--Menu sidebar -->
<script src="{{ asset('js/sidebarmenu.js')}}"></script>
<!--Custom JavaScript -->
<script src="{{ asset('js/custom.js')}}"></script>
<!--This page JavaScript -->
<!--chartis chart-->
<script src="{{ asset('plugins/bower_components/chartist/dist/chartist.min.js') }}"></script>
<script src="{{ asset('plugins/bower_components/chartist-plugin-tooltips/dist/chartist-plugin-tooltip.min.js')}}"></script>
<script src="{{ asset('js/pages/dashboards/dashboard1.js')}}"></script>
<script src="{{ asset('js/script.js') }}"></script>
</body>

</html>
