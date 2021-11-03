@extends('layouts.master')

@section('body')
    <div class="container">
        <div class="row">
            <div class="col-md-5 col-md-offset-1">
                <div id="login-alt-container">
                    @yield('content-left')
                </div>
            </div>
            <div class="col-md-5">
                <!-- Login Container -->
                <div id="login-container">
                    @yield('content-right')
                </div>
            </div>
        </div>
    </div>
    <!-- END Login Alternative Row -->

    <!-- jQuery, Bootstrap.js, jQuery plugins and Custom JS code -->
    <script src="{{ asset('assets/js/vendor/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/js/vendor/bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins.js') }}"></script>
    <script src="{{ asset('assets/js/app.js') }}"></script>

    <!-- Load and execute javascript code used only in this page -->
    <script src="{{ asset('assets/js/pages/login.js') }}"></script>
    <script>
        $(function () {
            Login.init();
        });
    </script>
@endsection