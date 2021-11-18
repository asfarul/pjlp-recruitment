@extends('layouts.frontapp')

@section('title', 'GAGAL MENDAFTAR!')

@section('content')
    <div class="container margin-bottom-50">
        <div class="row">
            <!-- Content -->
            <div class="col-lg-4 offset-4 margin-top-100">
                <div class="pricing-plan recommended">
                    <div class="recommended-badge">GAGAL MENDAFTAR!</div>
                    <p class="margin-top-10">Anda sudah pernah melakukan pendaftaran di periode ini atau pendaftaran sudah ditutup, anda bisa memeriksa status anda <a href="https://pjlp-recruitment.pontianakkota.go.id/pelamar/status">di sini</a></p>
                    {{--<a href="#" class="button full-width margin-top-20">CEK STATUS LAMARAN</a>--}}
                </div>
            </div>
        </div>
    </div>
@endsection