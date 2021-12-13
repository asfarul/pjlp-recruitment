@extends('layouts.master')

@section('body')
    <!-- Error Container -->
    <div id="error-container">
        <div class="error-options">
            <h3><i class="fa fa-chevron-circle-left text-muted"></i> <a href="{{ url('/') }}">Kembali</a></h3>
        </div>
        <div class="row">
            <div class="col-sm-8 col-sm-offset-2 text-center">
                <h1><i class="fa fa-cog fa-spin text-danger"></i> 500</h1>
                <h2 class="h3">Oops, maaf terjadi kesalahan pada server<br>Sedang kami perbaiki...mohon dicoba kembali beberapa saat lagi</h2>
            </div>
        </div>
    </div>
    <!-- END Error Container -->
@endsection