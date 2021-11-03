@permission('create-opds')
@extends('layouts.app')

@section('title', 'tambah OPD')

@section('content-header')
    <div class="header-section">
        <h1>
            <i class="gi gi-home"></i>Organisasi Perangkat Daerah<br>
            <small>Tambah OPD</small>
        </h1>
    </div>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="block full">
                {{ Form::open(array('route' => 'opd.store', 'class' => 'form-horizontal form-label-left')) }}

                <div class='form-group {{ $errors->has('opd') ? ' has-error' : '' }}'>
                    {{ Form::label('opd', 'Nama OPD', array('class' => 'col-sm-2 col-form-label')) }}
                    <div class="col-sm-10">
                        {{ Form::text('opd', null, array('class' => 'form-control col-md-7 col-xs-12', 'placeholder' => 'Nama Organisasi Perangkat Daerah')) }}
                        @if ($errors->has('opd')) <span
                                class="help-block">{{ $errors->first('opd') }}</span> @endif
                    </div>
                </div>

                <div class='form-group {{ $errors->has('deskripsi') ? ' has-error' : '' }}'>
                    {{ Form::label('deskripsi', 'Deskripsi OPD', array('class' => 'col-sm-2 col-form-label')) }}
                    <div class="col-sm-10">
                        {{ Form::text('deskripsi', null, array('class' => 'form-control col-md-7 col-xs-12', 'placeholder' => 'Deskripsi Organisasi Perangkat Daerah')) }}
                        @if ($errors->has('deskripsi')) <span
                                class="help-block">{{ $errors->first('deskripsi') }}</span> @endif
                    </div>
                </div>

                <div class='form-group {{ $errors->has('alamat') ? ' has-error' : '' }}'>
                    {{ Form::label('alamat', 'Alamat', array('class' => 'col-sm-2 col-form-label')) }}
                    <div class="col-sm-10">
                        {{ Form::textarea('alamat', null, array('class' => 'form-control col-md-7 col-xs-12', 'rows' => '9', 'placeholder' => 'Alamat lengkap OPD')) }}
                        @if ($errors->has('alamat')) <span
                                class="help-block">{{ $errors->first('alamat') }}</span> @endif
                    </div>
                </div>

                <div class='form-group {{ $errors->has('telepon') ? ' has-error' : '' }}'>
                    {{ Form::label('telepon', 'Telepon', array('class' => 'col-sm-2 col-form-label')) }}
                    <div class="col-sm-10">
                        {{ Form::number('telepon', null, array('class' => 'form-control col-md-7 col-xs-12', 'placeholder' => 'Telepon OPD')) }}
                        @if ($errors->has('telepon')) <span
                                class="help-block">{{ $errors->first('telepon') }}</span> @endif
                    </div>
                </div>

                <div class='form-group'>
                    {{ Form::label('lokasi', 'Lokasi', array('class' => 'col-sm-2 col-form-label')) }}
                    <div class="col-sm-5">
                        {{ Form::text('lat', null, array('id' => 'lat', 'class' => 'form-control col-md-7 col-xs-12', 'placeholder' => 'Latitude')) }}
                    </div>
                    <div class="col-sm-5">
                        {{ Form::text('lng', null, array('id' => 'lng','class' => 'form-control col-md-7 col-xs-12', 'placeholder' => 'Longitude')) }}
                    </div>
                    <div class="col-sm-10 col-sm-offset-2" style="margin-top: 20px">
                        <div style="width: 100%; height: 500px;">
                            {!! Mapper::render() !!}
                        </div>
                    </div>
                </div>

                <div class="ln_solid"></div>

                <div class="form-group">
                    <div class="text-center">
                        <button type="submit" class="btn btn-success">Tambah OPD</button>
                    </div>
                </div>
                {{ Form::close() }}
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script type="text/javascript">
        function setLatLng(lat, lng)
        {
            document.getElementById("lat").value = lat;
            document.getElementById("lng").value = lng;
        }
    </script>
@endsection

@endpermission
