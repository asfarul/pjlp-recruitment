@permission('create-periods')
@extends('layouts.app')

@section('title', 'Tambah Periode')

@section('content-header')
    <div class="header-section">
        <h1>
            <i class="gi gi-keys"></i> Periode<br>
            <small>Tambah Periode</small>
        </h1>
    </div>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="block full">
                {{ Form::open(array('route' => 'periods.store', 'class' => 'form-horizontal form-label-left')) }}

                <div class='form-group {{ $errors->has('start_date') ? ' has-error' : '' }}'>
                    {{ Form::label('start_date', 'Tanggal Mulai', array('class' => 'col-sm-2 col-form-label')) }}
                    <div class="col-sm-10">
                        {{ Form::date('start_date', null, array('class' => 'form-control col-md-7 col-xs-12', 'placeholder' => 'Tanggal Mulai')) }}
                        @if ($errors->has('start_date')) <span
                                class="help-block">{{ $errors->first('start_date') }}</span> @endif
                    </div>
                </div>

                <div class='form-group {{ $errors->has('end_date') ? ' has-error' : '' }}'>
                    {{ Form::label('end_date', 'Tanggal Selesai', array('class' => 'col-sm-2 col-form-label')) }}
                    <div class="col-sm-10">
                        {{ Form::date('end_date', null, array('class' => 'form-control col-md-7 col-xs-12', 'placeholder' => 'Tanggal Sampai')) }}
                        @if ($errors->has('end_date')) <span
                                class="help-block">{{ $errors->first('end_date') }}</span> @endif
                    </div>
                </div>

                <div class='form-group {{ $errors->has('description') ? ' has-error' : '' }}'>
                    {{ Form::label('description', 'Deskripsi', array('class' => 'col-sm-2 col-form-label')) }}
                    <div class="col-sm-10">
                        {{ Form::text('description', null, array('class' => 'form-control col-md-7 col-xs-12', 'placeholder' => 'Deskripsi permission')) }}
                        @if ($errors->has('description')) <span
                                class="help-block">{{ $errors->first('description') }}</span> @endif
                    </div>
                </div>

                <div class="ln_solid"></div>

                <div class="form-group">
                    <div class="text-center">
                        <button type="submit" class="btn btn-success">tambah periode</button>
                    </div>
                </div>
                {{ Form::close() }}
            </div>
        </div>
    </div>

@endsection
@endpermission