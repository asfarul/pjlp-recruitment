@extends('layouts.master')

@section('body')
    <!-- Error Container -->
    <div id="error-container">
        <div class="error-options">
            <h3><i class="fa fa-chevron-circle-left text-muted"></i> <a href="{{ url('sysadmin') }}">Kembali</a></h3>
        </div>
        <div class="row">
            <div class="col-sm-8 col-sm-offset-2 text-center">
                <h1 class="animation-fadeIn"><i class="fa fa-times-circle-o text-muted"></i> 401</h1>
                <h2 class="h3">Oops, Maaf anda tidak diizinkan untuk masuk ke halaman ini</h2>
            </div>
        </div>
    </div>
    <!-- END Error Container -->
@endsection