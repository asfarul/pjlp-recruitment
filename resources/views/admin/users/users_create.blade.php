@permission('create-users')
@extends('layouts.app')

@section('title', 'Tambah User')

@section('content-header')
    <div class="header-section">
        <h1>
            <i class="gi gi-user_add"></i>User<br>
            <small>Tambah user</small>
        </h1>
    </div>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="block full">
                {{ Form::open(array('route' => 'users.store', 'class' => 'form-horizontal form-label-left')) }}

                <div class='form-group {{ $errors->has('name') ? ' has-error' : '' }}'>
                    {{ Form::label('name', 'Nama', array('class' => 'col-sm-2 col-form-label')) }}
                    <div class="col-sm-10">
                        {{ Form::text('name', null, array('class' => 'form-control col-md-7 col-xs-12', 'placeholder' => 'Nama Lengkap')) }}
                        @if ($errors->has('name')) <span
                                class="help-block">{{ $errors->first('name') }}</span> @endif
                    </div>
                </div>

                <div class='form-group {{ $errors->has('email') ? ' has-error' : '' }}'>
                    {{ Form::label('email', 'Email', array('class' => 'col-sm-2 col-form-label')) }}
                    <div class="col-sm-10">
                        {{ Form::text('email', null, array('class' => 'form-control col-md-7 col-xs-12', 'placeholder' => 'Email (Contoh: nama@email.domain)')) }}
                        @if ($errors->has('email')) <span
                                class="help-block">{{ $errors->first('email') }}</span> @endif
                    </div>
                </div>

                <div class='form-group {{ $errors->has('password') ? ' has-error' : '' }}'>
                    {{ Form::label('password', 'Password', array('class' => 'col-sm-2 col-form-label')) }}
                    <div class="col-sm-10">
                        {{ Form::password('password', array('class' => 'form-control col-md-7 col-xs-12', 'placeholder' => 'Password minimal 6 karakter')) }}
                        @if ($errors->has('password')) <span
                                class="help-block">{{ $errors->first('password') }}</span> @endif
                    </div>
                </div>

                <div class='form-group {{ $errors->has('confirm_password') ? ' has-error' : '' }}'>
                    {{ Form::label('confirm_password', 'Konfirmasi Password', array('class' => 'col-sm-2 col-form-label')) }}
                    <div class="col-sm-10">
                        {{ Form::password('confirm_password', array('class' => 'form-control col-md-7 col-xs-12', 'placeholder' => 'Ulangi password anda')) }}
                        @if ($errors->has('confirm_password')) <span
                                class="help-block">{{ $errors->first('confirm_password') }}</span> @endif
                    </div>
                </div>

                <div class='form-group {{ $errors->has('role_id') ? ' has-error' : '' }}'>
                    {{ Form::label('role_id', 'Role', array('class' => 'col-sm-2 col-form-label')) }}
                    <div class="col-sm-10">
                        {{ Form::select('role_id', $roles, null, ['class' => 'form-control select-select2', 'style' => 'width: 100%;', 'placeholder' => '-- Pilih Role --']) }}
                        @if ($errors->has('role_id')) <span
                                class="help-block">{{ $errors->first('role_id') }}</span> @endif
                    </div>
                </div>

                <div class="ln_solid"></div>

                <div class="form-group">
                    <div class="text-center">
                        <button type="submit" class="btn btn-success">Tambah User</button>
                    </div>
                </div>
                {{ Form::close() }}
            </div>
        </div>
    </div>
@endsection
@endpermission
