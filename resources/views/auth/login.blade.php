@extends('layouts.authentication')

@section('title', 'Login')

@section('content-left')
    <!-- Title -->
    <h1 class="push-top-bottom">
        <strong>Rekrutmen</strong><br>
        <small>Selamat datang di halaman login rekrutmen</small>
    </h1>
    <!-- END Title -->

    <!-- Key Features -->
    {{--<ul class="fa-ul text-muted">--}}
    {{--<li><i class="fa fa-check fa-li text-success"></i> Clean &amp; Modern Design</li>--}}
    {{--<li><i class="fa fa-check fa-li text-success"></i> Fully Responsive &amp; Retina Ready</li>--}}
    {{--<li><i class="fa fa-check fa-li text-success"></i> 10 Color Themes</li>--}}
    {{--<li><i class="fa fa-check fa-li text-success"></i> PSD Files Included</li>--}}
    {{--<li><i class="fa fa-check fa-li text-success"></i> Widgets Collection</li>--}}
    {{--<li><i class="fa fa-check fa-li text-success"></i> Designed Pages Collection</li>--}}
    {{--<li><i class="fa fa-check fa-li text-success"></i> .. and many more awesome features!</li>--}}
    {{--</ul>--}}
    <!-- END Key Features -->

    <!-- Footer -->
    <footer class="text-muted push-top-bottom">
        <small><span id="year-copy"></span> &copy; <a href="#" target="_blank">RaMiT</a></small>
    </footer>
    <!-- END Footer -->
@endsection

@section('content-right')
    <!-- Login Title -->
    <div class="login-title text-center">
        <h1>Silakan <strong>Masuk</strong></h1>
    </div>
    <!-- END Login Title -->

    <!-- Login Block -->
    <div class="block push-bit">
        <!-- Login Form -->
        <form action="{{ route('login') }}" method="post" id="form-login" class="form-horizontal">
            {{ csrf_field() }}
            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                <div class="col-xs-12">
                    @if ($errors->has('email'))
                        <span class="help-block">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                    @endif
                    <div class="input-group">
                        <span class="input-group-addon"><i class="gi gi-envelope"></i></span>
                        <input type="email" id="email" name="email" class="form-control input-lg"
                               value="{{ old('email') }}" placeholder="Email">
                    </div>
                </div>
            </div>
            <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                <div class="col-xs-12">
                    <div class="input-group">
                        <span class="input-group-addon"><i class="gi gi-asterisk"></i></span>
                        <input type="password" id="password" name="password"
                               class="form-control input-lg" placeholder="Password">
                    </div>
                    @if ($errors->has('password'))
                        <span class="help-block">
                                <strong>{{ $errors->first('password') }}</strong>
                            </span>
                    @endif
                </div>
            </div>
            <div class="form-group form-actions">
                <div class="col-xs-8 text-right">
                    <button type="submit" class="btn btn-sm btn-primary"><i class="fa fa-angle-right"></i>
                        Login to Dashboard
                    </button>
                </div>
            </div>
        </form>
        <!-- END Login Form -->
    </div>
    <!-- END Login Block -->
    </div>
    <!-- END Login Container -->
@endsection