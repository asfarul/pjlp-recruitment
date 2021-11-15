@extends('layouts.frontapp')

@section('title', $vacancy->title)

@section('content')
<!-- Titlebar ================================================== -->
<div class="single-page-header" data-background-image="{{ asset('template/images/single-job.jpg') }}">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="single-page-header-inner">
                    <div class="left-side">
                        <div class="header-details">
                            <h3>[{{ strtoupper($vacancy->type) }}] {{ $vacancy->title }}</h3>
                            <h5>{{ $vacancy->occupation }}</h5>
                            <ul>
                                <li><i class="icon-material-outline-business"></i> {{ $vacancy->deskripsi }}</li>
                                @if($vacancy->status == 1)
                                <li>
                                    <div class="verified-badge-with-title">Aktif</div>
                                </li>@endif
                            </ul>
                        </div>
                    </div>
                    <div class="right-side">
                        <div class="salary-box">
                            <div class="salary-type">Kode Lamaran</div>
                            <div class="salary-amount">{{ $vacancy->vacancy_code }}</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<!-- Page Content
    ================================================== -->
<div class="container">
    <div class="row">

        <!-- Content -->
        <div class="col-xl-8 col-lg-8 content-right-offset">
            <div class="single-page-section">
                {{-- <h3 class="margin-bottom-25"><strong>DESKRIPSI</strong></h3> --}}
                {{-- <embed src="{{ asset('file/PENGUMUMAN.pdf')}}" type="application/pdf" width="100%" height="1000px">
                --}}
                {!! $vacancy->description !!}
            </div>

            <div class="single-page-section">
                {{-- <h3 class="margin-bottom-30"><strong>TAHAPAN SELEKSI</strong></h3> --}}
                {!! $vacancy->selection !!}
            </div>
        </div>


        <!-- Sidebar -->
        <div class="col-xl-4 col-lg-4">
            <div class="sidebar-container">
                {{-- @if($vacancy->status == 1)
                        <a href="{{ route('front.lowongan.lamar', Hashids::encode($vacancy->id . '97531')) }}"
                class="apply-now-button">Lamar
                Sekarang <i class="icon-material-outline-arrow-right-alt"></i></a>
                @endif --}}
                @if(!$vacdocs->isEmpty())
                <!-- Sidebar Widget -->
                <div class="sidebar-widget">
                    <div class="job-overview">
                        <div class="job-overview-inner">
                            <ul>
                                <li>
                                    <i class="icon-material-outline-attach-file"></i>
                                    <span><strong>Download Dokumen Pendukung</strong></span>
                                    <hr>
                                    @foreach($vacdocs as $vacdoc)
                                    <h5><a href="{{ url('/uploads') . $vacdoc->document }}">{{ $vacdoc->title }}</a>
                                    </h5>
                                    <hr>
                                    @endforeach
                                    <small style="color: red; font-size: 15pt">Silakan baca dengan teliti!</small>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                @endif
                {{-- <a href="{{URL::to('/')}}/file/01-KAK.pdf" target="_blank">
                <button class="btn"><i class="fa fa-download"></i> <img src="{{ asset('img/WARNING.png') }}"
                        width="500px" alt="contact"></button>

                </a> --}}
                {{-- <small style="color: red">PERHATIAN!! Untuk dibaca dan pelajari KAK terlebih dahulu</small> --}}


                <!-- Sidebar Widget -->
                <div class="sidebar-widget">
                    <div class="job-overview">
                        <div class="job-overview-inner">
                            <ul>
                                <li>
                                    <i class="icon-material-outline-business"></i>
                                    <span>Penyelenggara</span>
                                    <h5>{{ $vacancy->deskripsi }}</h5>
                                </li>
                                <li>
                                    <i class="icon-material-outline-business-center"></i>
                                    <span>Kategori Pegawai</span>
                                    <h5>{{ $vacancy->occupation }}</h5>
                                </li>
                                <li>
                                    <i class="icon-material-outline-local-atm"></i>
                                    <span>Perkiraan Gaji</span>
                                    <h5>{{ $vacancy->salary_estimate }}</h5>
                                </li>
                                <li>
                                    <i class="icon-material-outline-access-time"></i>
                                    <span>Tanggal Mulai</span>
                                    <h5>{{ $vacancy->start_date->formatLocalized('%A, %e %B %Y') }}</h5>
                                </li>
                                <li>
                                    <i class="icon-material-outline-access-time"></i>
                                    <span>Tanggal Berakhir</span>
                                    <h5>{{ $vacancy->end_date->formatLocalized('%A, %e %B %Y') }}</h5>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>

                @if($vacancy->status == 1)
                <a href="{{ route('front.lowongan.lamar', Hashids::encode($vacancy->id . '97531')) }}"
                    class="apply-now-button">Lamar
                    Sekarang <i class="icon-material-outline-arrow-right-alt"></i></a>
                @endif

            </div>
        </div>

    </div>
</div>


@endsection