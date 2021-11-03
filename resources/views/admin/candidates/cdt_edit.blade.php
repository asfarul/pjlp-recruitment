@permission('edit-candidates')
@extends('layouts.app')

@section('title', 'Ubah Data Pelamar Umum')

@section('content-header')
    <div class="header-section">
        <h1>
            <i class="gi gi-users"></i>Ubah Data<br>
            <small>Ubah Data Pelamar Umum</small>
        </h1>
    </div>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-2">
            <img src="{{ url('uploads'. $pelamar->foto) }}" width="100%">
        </div>
        <div class="col-md-10">
            <div class="block full">
                {{ Form::open(array('url' => route('pelamar.update', $pelamar->id), 'class' => 'form-horizontal form-label-left', 'enctype' => 'multipart/form-data')) }}
                <input name="_method" type="hidden" value="PATCH">
                <div class='form-group {{ $errors->has('nik') ? ' has-error' : '' }}'>
                    {{ Form::label('nik', 'NIK', array('class' => 'col-md-2 col-form-label')) }}
                    <div class="col-md-10">
                        {{ Form::text('nik', $pelamar->nik, ['class' => 'form-control']) }}
                        @if ($errors->has('nik')) <span
                                class="help-block">{{ $errors->first('nik') }}</span> @endif
                    </div>
                </div>

                <div class='form-group {{ $errors->has('nama') ? ' has-error' : '' }}'>
                    {{ Form::label('nama', 'NAMA', array('class' => 'col-md-2 col-form-label')) }}
                    <div class="col-md-10">
                        {{ Form::text('nama', $pelamar->nama, ['class' => 'form-control']) }}
                        @if ($errors->has('nama')) <span
                                class="help-block">{{ $errors->first('nama') }}</span> @endif
                    </div>
                </div>

                <div class='form-group {{ $errors->has('email') ? ' has-error' : '' }}'>
                    {{ Form::label('email', 'EMAIL', array('class' => 'col-md-2 col-form-label')) }}
                    <div class="col-md-10">
                        {{ Form::text('email', $pelamar->email, ['class' => 'form-control']) }}
                        @if ($errors->has('email')) <span
                                class="help-block">{{ $errors->first('email') }}</span> @endif
                    </div>
                </div>

                <div class='form-group {{ $errors->has('notel') ? ' has-error' : '' }}'>
                    {{ Form::label('notel', 'NOMOR TELEPON', array('class' => 'col-md-2 col-form-label')) }}
                    <div class="col-md-10">
                        {{ Form::text('notel', $pelamar->notel, ['class' => 'form-control']) }}
                        @if ($errors->has('notel')) <span
                                class="help-block">{{ $errors->first('notel') }}</span> @endif
                    </div>
                </div>

                <div class='form-group {{ $errors->has('status_id') ? ' has-error' : '' }}'>
                    {{ Form::label('status_id', 'STATUS', array('class' => 'col-sm-2 col-form-label')) }}
                    <div class="col-sm-10">
                        {{ Form::select('status_id', $status, $pelamar->status_id, array('class' => 'form-control', 'placeholder' => '-- Pilih Status --')) }}
                        @if ($errors->has('status_id')) <span
                                class="help-block">{{ $errors->first('status_id') }}</span> @endif
                    </div>
                </div>

                <div class="ln_solid"></div>

                <div class="form-group">
                    <div class="text-center">
                        <button type="submit" class="btn btn-warning">Ubah Data</button>
                    </div>
                </div>
                {{ Form::close() }}
            </div>
        </div>
    </div>
@endsection
@endpermission
