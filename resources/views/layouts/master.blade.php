<!DOCTYPE html>
<!--[if IE 9]>
<html class="no-js lt-ie10" lang="en"> <![endif]-->
<!--[if gt IE 9]><!-->
<html class="no-js" lang="en"> <!--<![endif]-->
<head>
    <meta charset="utf-8">

    <title>Sysadmin | @yield('title')</title>

    <meta name="description" content="Admin Template">
    <meta name="author" content="Futamee">
    <meta name="robots" content="noindex, nofollow">
    <meta name="viewport" content="width=device-width,initial-scale=1.0,user-scalable=0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Icons -->
    <!-- The following icons can be replaced with your own, they are used by desktop and mobile browsers -->
    <link rel="shortcut icon" href="{{ asset('assets/img/favicon.png') }}">
    <link rel="apple-touch-icon" href="{{ asset('assets/img/icon57.png') }}" sizes="57x57">
    <link rel="apple-touch-icon" href="{{ asset('assets/img/icon72.png') }}" sizes="72x72">
    <link rel="apple-touch-icon" href="{{ asset('assets/img/icon76.png') }}" sizes="76x76">
    <link rel="apple-touch-icon" href="{{ asset('assets/img/icon114.png') }}" sizes="114x114">
    <link rel="apple-touch-icon" href="{{ asset('assets/img/icon120.png') }}" sizes="120x120">
    <link rel="apple-touch-icon" href="{{ asset('assets/img/icon144.png') }}" sizes="144x144">
    <link rel="apple-touch-icon" href="{{ asset('assets/img/icon152.png') }}" sizes="152x152">
    <link rel="apple-touch-icon" href="{{ asset('assets/img/icon180.png') }}" sizes="180x180">
    <!-- END Icons -->

    <!-- Stylesheets -->
    <!-- Bootstrap is included in its original form, unaltered -->
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}">

    <!-- Related styles of various icon packs and plugins -->
    <link rel="stylesheet" href="{{ asset('assets/css/plugins.css') }}">

    <!-- The main stylesheet of this template. All Bootstrap overwrites are defined in here -->
    <link rel="stylesheet" href="{{ asset('assets/css/main.css') }}">

    <!-- The themes stylesheet of this template (for using specific theme color in individual elements - must included last) -->
    <link rel="stylesheet" href="{{ asset('assets/css/themes.css') }}">

    <!-- Toastr -->
    <link href="{{ asset('assets/css/toastr/toastr.min.css') }}" rel="stylesheet" type="text/css"/>

@yield('css')
<!-- END Stylesheets -->

    <script src="{{ asset('assets/js/vendor/modernizr.min.js') }}"></script>
</head>
<body>
@yield('body')
</body>
</html>
