@permission('create-vacancydocs')
@extends('layouts.app')

@section('title', 'Tambah Dokumen Lowongan')

@section('content-header')
    <div class="header-section">
        <h1>
            <i class="gi gi-file_export"></i>Tambah Dokumen Lowongan<br>
            <small>Daftar semua dokumen</small>
        </h1>
    </div>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="block full">
                {{ Form::open(array('route' => 'dokumen.store', 'class' => 'form-horizontal form-label-left', 'enctype' => 'multipart/form-data')) }}

                <div class='form-group {{ $errors->has('opd_id') ? ' has-error' : '' }}'>
                    {{ Form::label('opd_id', 'OPD', array('class' => 'col-sm-2 col-form-label')) }}
                    <div class="col-sm-10">
                        {{ Form::select('opd_id', $opds, null, ['class' => 'form-control select-select2', 'placeholder' => '-- Pilih OPD --']) }}
                        @if ($errors->has('opd_id')) <span
                                class="help-block">{{ $errors->first('opd_id') }}</span> @endif
                    </div>
                </div>

                <div class='form-group {{ $errors->has('vacancy_id') ? ' has-error' : '' }}'>
                    {{ Form::label('vacancy_id', 'Lowongan', array('class' => 'col-sm-2 col-form-label')) }}
                    <div class="col-sm-10">
                        {{ Form::select('vacancy_id', $vacancies, null, array('class' => 'form-control select-select2', 'placeholder' => '-- Pilih Lowongan --')) }}
                        @if ($errors->has('vacancy_id')) <span
                                class="help-block">{{ $errors->first('vacancy_id') }}</span> @endif
                    </div>
                </div>

                <div class='form-group {{ $errors->has('title') ? ' has-error' : '' }}'>
                    {{ Form::label('title', 'Nama Dokumen', array('class' => 'col-sm-2 col-form-label')) }}
                    <div class="col-sm-10">
                        {{ Form::text('title', null, array('class' => 'form-control col-md-7 col-xs-12', 'placeholder' => 'Nama Dokumen')) }}
                        @if ($errors->has('title')) <span
                                class="help-block">{{ $errors->first('name') }}</span> @endif
                    </div>
                </div>

                <div class='form-group {{ $errors->has('document') ? ' has-error' : '' }}'>
                    {{ Form::label('document', 'File', array('class' => 'col-sm-2 col-form-label')) }}
                    <div class="col-sm-10">
                        {{ Form::file('document', array('id' => 'image_header', 'accept' => 'application/pdf,application/msword, application/vnd.openxmlformats-officedocument.wordprocessingml.document')) }}
                        @if ($errors->has('document')) <span
                                class="help-block">{{ $errors->first('document') }}</span> @endif
                    </div>
                </div>

                <div class="ln_solid"></div>

                <div class="form-group">
                    <div class="text-center">
                        <button type="submit" class="btn btn-success">Tambah Dokumen</button>
                    </div>
                </div>
                {{ Form::close() }}
            </div>
        </div>
    </div>
@endsection
@endpermission
