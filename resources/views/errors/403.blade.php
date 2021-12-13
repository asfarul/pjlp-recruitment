@extends('layouts.master')

@section('body')
    <!-- Error Container -->
    <div id="error-container">
        <div class="error-options">
            <h3><i class="fa fa-chevron-circle-left text-muted"></i> <a href="{{ url('/') }}">Kembali</a></h3>
        </div>
        <div class="row">
            <div class="col-sm-8 col-sm-offset-2 text-center">
                <h1 class="animation-hatch"><i class="fa fa-times text-danger"></i> 403</h1>
                <h2 class="h3">Oops, maaf anda tidak mempunyai akses untuk masuk ke halaman ini</h2>
            </div>
        </div>
    </div>
    <!-- END Error Container -->
@endsection