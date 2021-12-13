@extends('layouts.frontapp')

@section('title', 'Status Pelamar')

@section('content')
    <!-- Titlebar ================================================== -->
    <div class="single-page-header" data-background-image="{{ asset('template/images/single-job.jpg') }}">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="single-page-header-inner centered-button">
                        <div class="header-details">
                            <h3>STATUS ANDA</h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container margin-bottom-50">
        <div class="row">
            <div class="col-xl-12">
                <div class="dashboard-box margin-top-0">
                    <div class="content with-padding padding-bottom-0">
                        <div class="row">
                            <div class="col-auto">
                                <div class="avatar-wrapper" data-tippy-placement="bottom"
                                     title="{{ $candidate->nama }}">
                                    <img class="profile-pic" src="{{ url('/uploads') . $candidate->foto }}" alt="{{ $candidate->nama }}"/>
                                </div>
                            </div>

                            <div class="col">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="submit-field">
                                            <h5>NIK</h5>
                                            {{ $candidate->nik }}
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="submit-field">
                                            <h5>Nama</h5>
                                            {{ $candidate->nama }}
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="submit-field">
                                            <h5>Status</h5>
                                            <span style="color: {{ $candidate->color }}">{{ $candidate->candidate_status }}</span>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="submit-field">
                                            <h5>Terakhir Mendaftar</h5>
                                            <strong>{{date('d/m/Y', strtotime($candidate->created_at))}}</strong>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="submit-field">
                                            <h5>Formasi</h5>
                                            <strong>{{ $candidate->title }}</strong>
                                        </div>
                                    </div>
                                    
                                    @if($candidate->statusid > 2)
                                        <div class="col-xl-6">
                                            <h4><strong>Aksi</strong></h4>
                                            <div class="account-type">
                                                {{ Form::open(array('route' => 'front.pelamar.print')) }}
                                                {{ Form::hidden('nik', $candidate->nik) }}
                                                <button type="submit" class="button ripple-effect"><i
                                                            class="icon-material-outline-print"></i> C E T A K
                                                </button>
                                                {{ Form::close() }}
                                            </div>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <small style="color: red">PERHATIAN!! Bukti pendaftaran dapat dicetak setelah dinyatakan lulus tahap administrasi</small>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection