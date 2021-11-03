@permission('edit-roles')
@extends('layouts.app')

@section('title', 'Ubah Role')

@section('content-header')
    <div class="header-section">
        <h1>
            <i class="gi gi-keys"></i><i class="gi gi-user"></i>Role<br>
            <small>Ubah role</small>
        </h1>
    </div>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="block full">
                {{ Form::model($role, array('route' => array('roles.update', $role->id), 'method' => 'PUT', 'class' => 'form-horizontal form-label-left')) }}

                <div class='form-group {{ $errors->has('name') ? ' has-error' : '' }}'>
                    {{ Form::label('name', 'Nama', array('class' => 'col-sm-2 col-form-label')) }}
                    <div class="col-sm-10">
                        {{ Form::text('name', null, array('class' => 'form-control col-md-7 col-xs-12', 'placeholder' => 'Nama Lengkap')) }}
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
                        {{ Form::text('description', null, array('class' => 'form-control col-md-7 col-xs-12', 'placeholder' => 'Deskripsi Role')) }}
                        @if ($errors->has('description')) <span
                                class="help-block">{{ $errors->first('description') }}</span> @endif
                    </div>
                </div>

                <div class='form-group {{ $errors->has('color') ? ' has-error' : '' }}'>
                    {{ Form::label('color', 'Warna Label', array('class' => 'col-sm-2 col-form-label')) }}
                    <div class="col-sm-10">
                        <div class="input-group input-colorpicker">
                            {{ Form::text('color', null, array('class' => 'form-control col-md-7 col-xs-12 input-colorpicker', 'placeholder' => 'Warna Label Role')) }}
                            <span class="input-group-addon"><i></i></span>
                        </div>
                        @if ($errors->has('color')) <span
                                class="help-block">{{ $errors->first('color') }}</span> @endif
                    </div>
                </div>

                <div class='form-group {{ $errors->has('permission_id') ? ' has-error' : '' }}'>
                    {{ Form::label('permission_id', 'Permission', array('class' => 'col-sm-2 col-form-label')) }}
                    <div class="col-sm-10">
                        @if(count($permissions))
                            @foreach($permissions as $permission)
                                {{ Form::checkbox('permission_id[]', $permission->id, in_array($permission->id, $role_permissions)) }}
                                {{ Form::label($permission->name, ucwords ($permission->description)) }}<br>
                            @endforeach
                        @endif
                        @if ($errors->has('permission_id')) <span
                                class="help-block">{{ $errors->first('permission_id') }}</span> @endif
                    </div>
                </div>

                <div class="ln_solid"></div>

                <div class="form-group">
                    <div class="text-center">
                        <button type="submit" class="btn btn-info">Ubah</button>
                    </div>
                </div>
                {{ Form::close() }}
            </div>
        </div>
    </div>
@endsection
@endpermission