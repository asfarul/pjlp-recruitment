@extends('layouts.frontapp')

@section('title', 'Formasi Umum')

@section('css')
    <link rel='stylesheet' href='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css'>
    <link rel='stylesheet' href='https://cdn.datatables.net/1.10.16/css/dataTables.bootstrap.min.css'>
    <link rel='stylesheet' href='https://cdn.datatables.net/responsive/2.2.1/css/responsive.bootstrap.min.css'>

    <link rel="stylesheet" href="{{ asset('css/table.css') }}">
@endsection

@section('content')
    <!-- Titlebar ================================================== -->
    <div class="single-page-header" data-background-image="{{ asset('template/images/single-job.jpg') }}">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="single-page-header-inner centered-button">
                        <div class="header-details">
                            <h3>FORMASI UMUM</h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container dtable margin-top-50 margin-bottom-50">
        <div class="row">
            <!-- Content -->
            <div class="col-lg-12">
                <!-- Formasi Umum
                ================================================== -->
                <!-- Recruitment Listing -->
                @foreach($vaccols as $vaccol)
                    <div class="dashboard-box margin-top-20">

                        <!-- Headline -->
                        <div class="headline">
                            <h2><strong>{{ $vaccol['OPD'] }}</strong></h2>
                        </div>

                        <div class="content">
                            <ul class="dashboard-box-list">
                                @foreach($vaccol['vacancies'] as $vacancy)
                                    <li>
                                        <!-- Job Listing -->
                                        <div class="job-listing">

                                            <!-- Job Listing Details -->
                                            <div class="job-listing-details">

                                                <!-- Details -->
                                                <div class="job-listing-description margin-left-10">
                                                    <h4 class="job-listing-title">{{ $vacancy->title }}</h4>

                                                    <!-- Job Listing Footer -->
                                                    <div class="job-listing-footer">
                                                        <ul>
                                                            <li>
                                                                <i class="icon-material-outline-business"></i> {{ $vacancy->opd }}
                                                            </li>
                                                            @if($vacancy->occupation)
                                                                <li>
                                                                    <i class="icon-material-outline-business-center"></i> {{ $vacancy->occupation }}
                                                                </li>
                                                            @endif
                                                            <li>
                                                                <i class="icon-material-outline-access-time"></i> {{ $vacancy->start_date->formatLocalized('%A, %e %B %Y') }}
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Buttons -->
                                        <div class="buttons-to-right">
                                            <a href="{{ route('front.lowongan.detail', Hashids::encode($vacancy->id . '97531')) }}"
                                               class="button ripple-effect"><i class="icon-material-outline-info"></i>
                                                Detail</a>
                                        </div>

                                        {{-- <a href="{{URL::to('/')}}/file/KAK.pdf" target="_blank">
                                            <button class="btn"><i class="fa fa-download"></i> Download File KAK</button>
                                            <small style="color: red">PERHATIAN!! Untuk dibaca dan pelajari KAK terlebih dahulu</small>
                                        </a> --}}
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script src='https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js'></script>
    <script src='https://cdn.datatables.net/1.10.16/js/dataTables.bootstrap.min.js'></script>
    <script src='https://cdn.datatables.net/responsive/2.2.1/js/dataTables.responsive.min.js'></script>
    <script src='https://cdn.datatables.net/responsive/2.2.1/js/responsive.bootstrap.min.js'></script>
    <script>
        $(document).ready(function () {
            $('#dataPelamar').DataTable();
        });
    </script>
@endsection