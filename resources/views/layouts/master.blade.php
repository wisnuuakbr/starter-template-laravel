<!DOCTYPE html>
<html lang="en">
@include('layouts.head')

<body class="fixed-left">

    <!-- Loader -->
    {{-- <div id="preloader">
        <div id="status">
            <div class="spinner"></div>
        </div>
    </div> --}}

    <!-- Begin page -->
    <div id="wrapper">

        <!-- Top Bar Start -->
        <div class="topbar">

            <!-- LOGO -->
            <div class="topbar-left">
                <a href="index.html" class="logo">
                    <img src="{{ asset('style') }}/assets/images/logo.png" alt="" height="20"
                        class="logo-large">
                    <img src="{{ asset('style') }}/assets/images/logo-sm.png" alt="" height="22"
                        class="logo-sm">
                </a>
            </div>

            <nav class="navbar-custom">
                <!-- Search input -->
                @include('layouts.navbar')

            </nav>

        </div>
        <!-- Top Bar End -->

        <!-- ========== Left Sidebar Start ========== -->
        <div class="left side-menu">
            <div class="slimscroll-menu" id="remove-scroll">

                <!--- Sidemenu -->
                <div id="sidebar-menu">
                    <!-- Left Menu Start -->
                    @include('layouts.sidebar')

                </div>
                <!-- Sidebar -->
                <div class="clearfix"></div>

            </div>
            <!-- Sidebar -left -->

        </div>
        <!-- Left Sidebar End -->

        <!-- ============================================================== -->
        <!-- Start right Content here -->
        <!-- ============================================================== -->
        <div class="content-page">
            <!-- Start content -->
            <div class="content">
                <div class="container-fluid">
                    @include('layouts.breadcrumb')

                    @yield('content')

                    <!-- end row -->

                </div> <!-- container-fluid -->

            </div> <!-- content -->

            @include('layouts.footer')
        </div>


        <!-- ============================================================== -->
        <!-- End Right content here -->
        <!-- ============================================================== -->

    </div>
    <!-- END wrapper -->


    <!-- jQuery  -->
    @include('layouts.script')

</body>

</html>
