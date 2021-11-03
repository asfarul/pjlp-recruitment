@extends('layouts.master')

@section('body')
    <div id="error-container">
        <div class="error-options">
            <h3><i class="fa fa-chevron-circle-left text-muted"></i> <a href="{{ url('sysadmin') }}">Kembali</a></h3>
        </div>
        <div class="row">
            <div class="col-sm-8 col-sm-offset-2 text-center">
                <h1 class="animation-pulse"><i class="fa fa-exclamation-circle text-warning"></i> 404</h1>
                <h2 class="h3">Oops, maaf halaman yang anda cari tidak ditemukan<br>Silakan kembali ke halaman utama</h2>
            </div>
        </div>
    </div>
@endsection