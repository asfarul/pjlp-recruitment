@extends('layouts.frontmaster')

@section('body')
    <!-- Wrapper -->
    <div id="wrapper"{{ (\Request::is('/')) ? " class=wrapper-with-transparent-header" : "" }}>

        @include('layouts.frontheader')

        @yield('banner')

        @yield('content')

        @include('layouts.frontfooter')

    </div>
    <!-- Wrapper / End -->
@endsection

@section('js')
    <!-- Scripts
    ================================================== -->
    <script src="{{ asset('template/js/jquery-3.3.1.min.js') }}"></script>
    <script src="{{ asset('template/js/jquery-migrate-3.0.0.min.js') }}"></script>
    <script src="{{ asset('template/js/mmenu.min.js') }}"></script>
    <script src="{{ asset('template/js/tippy.all.min.js') }}"></script>
    <script src="{{ asset('template/js/simplebar.min.js') }}"></script>
    <script src="{{ asset('template/js/bootstrap-slider.min.js') }}"></script>
    <script src="{{ asset('template/js/bootstrap-select.min.js') }}"></script>
    <script src="{{ asset('template/js/snackbar.js') }}"></script>
    <script src="{{ asset('template/js/clipboard.min.js') }}"></script>
    <script src="{{ asset('template/js/counterup.min.js') }}"></script>
    <script src="{{ asset('template/js/magnific-popup.min.js') }}"></script>
    <script src="{{ asset('template/js/slick.min.js') }}"></script>
    <script src="{{ asset('template/js/custom.js') }}"></script>

    <!-- Snackbar // documentation: https://www.polonel.com/snackbar/ -->
    <script>
        // Snackbar for user status switcher
        $('#snackbar-user-status label').click(function() {
            Snackbar.show({
                text: 'Your status has been changed!',
                pos: 'bottom-center',
                showAction: false,
                actionText: "Dismiss",
                duration: 3000,
                textColor: '#fff',
                backgroundColor: '#383838'
            });
        });
    </script>
@endsection