@extends('layouts.frontapp')

@section('title', 'Check Status')

@section('content')
    <!-- Titlebar ================================================== -->
    <div class="single-page-header" data-background-image="{{ asset('template/images/single-job.jpg') }}">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="single-page-header-inner centered-button">
                        <div class="header-details">
                            <h3>CEK STATUS</h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container margin-bottom-50">
        <div class="row">
            <!-- Content -->
            <div class="col-lg-4 offset-4 margin-top-100">
                <div class="pricing-plan recommended">
                    <div class="recommended-badge">SILAKAN CEK STATUS ANDA DI SINI</div>
                    {{ Form::open(array('route' => 'front.pelamar.check')) }}
                    <div class="submit-field">
                        <h5>NIK
                            <small>(Nomor Induk Kependudukan)</small>
                        </h5>
                        {{ Form::text('nik', null, array('class' => 'with-border', 'maxlength' => '16', 'placeholder' => '61710xxxxxxxxxxx')) }}
                        @if ($errors->has('nik'))
                            <small style="color: red">{{ $errors->first('nik') }}</small>
                        @endif
                    </div>

                    <div class="centered-button">
                        <button type="submit" class="button ripple-effect"><i
                                    class="icon-material-outline-search"></i> CEK
                        </button>
                    </div>
                    {{ Form::close() }}
                </div>
            </div>
        </div>
    </div>
@endsection