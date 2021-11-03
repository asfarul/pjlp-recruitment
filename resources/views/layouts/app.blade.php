@extends('layouts.master')

@section('body')
    <div id="page-wrapper">
        <!-- Preloader -->
        <!-- Preloader functionality (initialized in js/app.js) - pageLoading() -->
        <div class="preloader themed-background">
            <h1 class="push-top-bottom text-light text-center"><strong>Pro</strong>UI</h1>
            <div class="inner">
                <h3 class="text-light visible-lt-ie10"><strong>Loading..</strong></h3>
                <div class="preloader-spinner hidden-lt-ie10"></div>
            </div>
        </div>
        <!-- END Preloader -->

        <div id="page-container" class="sidebar-partial sidebar-visible-lg sidebar-no-animations">

        @include('layouts.sidebar')

        <!-- Main Container -->
            <div id="main-container">
            @include('layouts.header')

            <!-- Page content -->
                <div id="page-content">
                    <!-- Dashboard 2 Header -->
                    <div class="content-header">
                        @yield('content-header')
                    </div>
                    <!-- END Dashboard 2 Header -->

                    @yield('content')
                </div>
                <!-- END Page Content -->

                @include('layouts.footer')
            </div>
            <!-- END Main Container -->
        </div>
        <!-- END Page Container -->
    </div>
    <!-- END Page Wrapper -->

    <!-- Scroll to top link, initialized in js/app.js - scrollToTop() -->
    <a href="#" id="to-top"><i class="fa fa-angle-double-up"></i></a>

    <!-- jQuery, Bootstrap.js, jQuery plugins and Custom JS code -->
    <script src="{{ asset('assets/js/vendor/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/js/vendor/bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins.js') }}"></script>
    <script src="{{ asset('assets/js/app.js') }}"></script>
    <script src="{{ asset('assets/js/toastr/toastr.min.js') }}"></script>
    {!! Toastr::message() !!}

    @yield('js')
@endsection