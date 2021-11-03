@extends('layouts.app')

@section('Judul')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="block" style="padding-bottom: 30px;">
                <h2><strong>DASHBOARD</strong> Penyedia Jasa Lainnya Perorangan</h2>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <!-- Widget -->
            <div class="widget">
                <div class="widget-extra text-center themed-background-dark-night">
                    <h3 class="widget-content-light"><i class="fa fa-bar-chart animation-floating"></i> <strong>Data</strong> Keseluruhan</h3>
                </div>
                <div class="widget-simple">
                    <div class="row text-center">
                        <div class="col-xs-4">
                            <a href="javascript:void(0)" class="widget-icon themed-background-autumn">
                                <i class="gi gi-sort"></i>
                            </a>
                            <h3 class="remove-margin-bottom"><strong>{{ $vacancies }}</strong><br><small>Lowongan</small></h3>
                        </div>
                        <div class="col-xs-4">
                            <a href="javascript:void(0)" class="widget-icon themed-background-spring">
                                <i class="gi gi-file_export"></i>
                            </a>
                            <h3 class="remove-margin-bottom"><strong>{{ $vacdocs }}</strong><br><small>Dokumen</small></h3>
                        </div>
                        <div class="col-xs-4">
                            <a href="javascript:void(0)" class="widget-icon themed-background-fire">
                                <i class="fa fa-group"></i>
                            </a>
                            <h3 class="remove-margin-bottom"><strong>{{ $candidates }}</strong><br><small>Pelamar</small></h3>
                        </div>
                    </div>
                </div>
            </div>
            <!-- END Widget -->
        </div>
    </div>
@endsection