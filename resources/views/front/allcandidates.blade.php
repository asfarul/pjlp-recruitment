@extends('layouts.frontapp')

@section('title', 'Formasi')

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
                            <h3>FORMASI</h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @if(!$umums->isEmpty())
        <!-- Apply Content
    ================================================== -->
        <div class="container dtable margin-top-50 margin-bottom-50">
            <div class="row">
                <!-- Content -->
                <div class="col-lg-12">
                    <h4>FORMASI UMUM</h4>
                    <table id="dataPelamar" class="table table-striped table-bordered dt-responsive nowrap"
                           cellspacing="0"
                           width="100%">
                        <thead>
                        <tr>
                            <th style="text-align: center">No</th>
                            <th>Instansi</th>
                            <th>Formasi</th>
                            <th style="text-align: center">Kuota</th>
                            <th style="text-align: center">Jumlah Pelamar</th>
                            <th>Detail</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($umums as $keyIndex => $umum)
                            <tr>
                                <td style="text-align: center">{{ $keyIndex + 1 }}</td>
                                <td>{{ $umum->deskripsi }}</td>
                                <td>{{ $umum->title }}</td>
                                <td style="text-align: center">{{ $umum->number_of_employee }}</td>
                                <td style="text-align: center">
                                    @php
                                        $candidates = \App\Models\Candidate::where([
                                            ['vacancy_id', '=', $umum->id],
                                            ['period_id', '=', $umum->period_id],
                                            ])->count();
                                        echo $candidates;
                                    @endphp
                                </td>
                                <td>
                                    <a href="{{ route('front.lowongan.detail', Hashids::encode($umum->id . '97531')) }}"
                                        class="btn btn-primary"><i class="icon-material-outline-info"></i>
                                    Detail</a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                {{-- <div class="col-lg-12">
                    <a href="{{ route('front.formasi.umum') }}" class="button btn-primary full-width">
                        DAFTAR FORMASI UMUM SEKARANG
                    </a>
                </div> --}}
            </div>
        </div>
    @endif

    @if(!$khususes->isEmpty())
        <!-- Apply Content
    ================================================== -->
        <div class="container dtable margin-top-50 margin-bottom-50">
            <div class="row">
                <!-- Content -->
                <div class="col-lg-12">
                    <h4>FORMASI KHUSUS</h4>
                    <table id="dataPelamar" class="table table-striped table-bordered dt-responsive nowrap"
                           cellspacing="0"
                           width="100%">
                        <thead>
                        <tr>
                            <th style="text-align: center">No</th>
                            <th>Instansi</th>
                            <th>Formasi</th>
                            <th style="text-align: center">Kuota</th>
                            <th style="text-align: center">Jumlah Pelamar</th>
                            <th>Detail</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($khususes as $keyIndex => $khusus)
                            <tr>
                                <td style="text-align: center">{{ $keyIndex + 1 }}</td>
                                <td>{{ $khusus->deskripsi }}</td>
                                <td>{{ $khusus->title }}</td>
                                <td style="text-align: center">{{ $khusus->number_of_employee }}</td>
                                <td style="text-align: center">
                                    @php
                                        $candidates = \App\Models\CandidateKhusus::where([
                                            ['vacancy_id', '=', $khusus->id],
                                            ['period_id', '=', $khusus->period_id],
                                        ])->count();
                                        echo $candidates;
                                    @endphp
                                </td>
                                <td>
                                    <a href="{{ route('front.lowongan.detail', Hashids::encode($khusus->id . '97531')) }}"
                                        class="btn btn-primary"><i class="icon-material-outline-info"></i>
                                    Detail</a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                {{--<div class="col-lg-12">
                    <a href="{{ route('front.formasi.khusus') }}" class="button btn-primary full-width">
                        DAFTAR FORMASI KHUSUS SEKARANG
                    </a>
                </div>--}}
            </div>
        </div>
    @endif
    {{-- <div class="text-center mb-5">
        <h3 class="text-danger">PENDAFTARAN TELAH DITUTUP</h3>
        <p>Terima kasih atas partisipasinya, silakan tunggu pengumuman berikutnya atau cek status pendaftaran Anda <a href="{{ route('front.pelamar.checkpage') }}">di sini.</a></p>
    </div> --}}
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