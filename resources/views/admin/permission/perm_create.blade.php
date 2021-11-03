@permission('create-permissions')
@extends('layouts.app')

@section('title', 'Tambah Permission')

@section('content-header')
    <div class="header-section">
        <h1>
            <i class="gi gi-keys"></i> Permission<br>
            <small>Tambah permission</small>
        </h1>
    </div>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="block full">
                {{ Form::open(array('route' => 'permission.store', 'class' => 'form-horizontal form-label-left')) }}

                <div class='form-group {{ $errors->has('name') ? ' has-error' : '' }}'>
                    {{ Form::label('name', 'Permission', array('class' => 'col-sm-2 col-form-label')) }}
                    <div class="col-sm-10">
                        {{ Form::text('name', null, array('class' => 'form-control col-md-7 col-xs-12', 'placeholder' => 'Permission')) }}
                        @if ($errors->has('name')) <span
                                class="help-block">{{ $errors->first('name') }}</span> @endif
                    </div>
                </div>

                <div class='form-group {{ $errors->has('display_name') ? ' has-error' : '' }}'>
                    {{ Form::label('display_name', 'Nama Display', array('class' => 'col-sm-2 col-form-label')) }}
                    <div class="col-sm-10">
                        {{ Form::text('display_name', null, array('class' => 'form-control col-md-7 col-xs-12', 'placeholder' => 'Nama Display')) }}
                        @if ($errors->has('display_name')) <span
                                class="help-block">{{ $errors->first('name') }}</span> @endif
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
                        <button type="submit" class="btn btn-success">tambah Permission</button>
                    </div>
                </div>
                {{ Form::close() }}
            </div>
        </div>
    </div>

@endsection
@endpermission