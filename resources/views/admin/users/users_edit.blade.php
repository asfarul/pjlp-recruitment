@permission('edit-users')
@extends('layouts.app')

@section('title', 'Ubah User')

@section('content-header')
    <div class="header-section">
        <h1>
            <i class="gi gi-user"></i>User<br>
            <small>Ubah user</small>
        </h1>
    </div>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="block full">
                {{ Form::model($user, array('route' => array('users.update', $user->id), 'method' => 'PUT', 'class' => 'form-horizontal form-label-left')) }}

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
                                class="help-block">{{ $errors->first('password') }}</span> @else
                            <span class="help-block"><i class="text-danger">Jangan diisi jika tidak ingin merubah password</i></span> @endif
                    </div>
                </div>

                <div class="form-group{{ $errors->has('role_id') ? ' has-error' : '' }} row">
                    <label class="col-sm-2 col-form-label" for="category_id">Role
                    </label>
                    <div class="col-sm-10">
                        <select class="form-control select-select2" id="role_id" name="role_id">
                            @if(count($roles))
                                @foreach($roles as $row)
                                    <option value="{{$row->id}}" {{$row->id == $user->roles[0]->id ? 'selected="selected"' : ''}}>{{$row->name}}</option>
                                @endforeach
                            @endif
                        </select>
                        @if ($errors->has('role_id'))
                            <span class="help-block">{{ $errors->first('role_id') }}</span>
                        @endif
                    </div>
                </div>

                <div class="ln_solid"></div>

                <div class="form-group">
                    <div class="text-center">
                        <input type="hidden" name="_token" value="{{ Session::token() }}">
                        <input name="_method" type="hidden" value="PUT">
                        <button type="submit" class="btn btn-info">Ubah</button>
                    </div>
                </div>
                {{ Form::close() }}
            </div>
        </div>
    </div>
@endsection
@endpermission