@permission('edit-articles')
@extends('layouts.app')

@section('title', 'Ubah Kategori Artikel')

@section('content-header')
    <div class="header-section">
        <h1>
            <i class="gi gi-notes"></i>Kategori Artikel<br>
            <small>Ubah kategori</small>
        </h1>
    </div>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="block full">
                {{ Form::model($category, array('route' => array('kategori.update', $category->id), 'method' => 'PUT', 'class' => 'form-horizontal form-label-left')) }}

                <div class='form-group {{ $errors->has('category') ? ' has-error' : '' }}'>
                    {{ Form::label('category', 'Kategori', array('class' => 'col-sm-2 col-form-label')) }}
                    <div class="col-sm-10">
                        {{ Form::text('category', null, array('class' => 'form-control col-md-7 col-xs-12', 'placeholder' => 'Kategori')) }}
                        @if ($errors->has('category')) <span
                                class="help-block">{{ $errors->first('category') }}</span> @endif
                    </div>
                </div>

                <div class='form-group {{ $errors->has('description') ? ' has-error' : '' }}'>
                    {{ Form::label('description', 'Deskripsi', array('class' => 'col-sm-2 col-form-label')) }}
                    <div class="col-sm-10">
                        {{ Form::text('description', null, array('class' => 'form-control col-md-7 col-xs-12', 'placeholder' => 'Deskripsi)')) }}
                        @if ($errors->has('description')) <span
                                class="help-block">{{ $errors->first('description') }}</span> @endif
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