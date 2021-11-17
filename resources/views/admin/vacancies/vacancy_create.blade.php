@permission('create-vacancies')
    @extends('layouts.app')

    @section('title', 'Tambah Lowongan')

@section('content-header')
    <div class="header-section">
        <h1>
            <i class="gi gi-sort"></i>Lowongan Pekerjaan<br>
            <small>Tambah Lowongan Pekerjaan</small>
        </h1>
    </div>
@endsection

@section('content')
    <div class="row">
        {{ Form::open(['route' => 'lowongan.store']) }}
        <div class="col-md-8">
            <div class="block full col-md-8">
                <div class="block-title">
                    <h2{{ $errors->has('title') ? ' class=text-danger' : '' }}><strong>Judul Lowongan Pekerjaan</strong>
                        </h2>
                </div>

                <div class='form-group'>
                    {{ Form::text('title', null, ['class' => 'form-control', 'placeholder' => 'Judul lengkap lowongan pekerjaan']) }}
                    @if ($errors->has('title')) <span
                            class="text-danger">{{ $errors->first('title') }}</span> @endif
                </div>
            </div>

            <div class="block full col-md-4">
                <div class="block-title">
                    <h2{{ $errors->has('vacancy_code') ? ' class=text-danger' : '' }}><strong>Kode Lowongan
                            Pekerjaan</strong></h2>
                </div>

                <div class='form-group'>
                    {{ Form::text('vacancy_code', null, ['class' => 'form-control', 'placeholder' => 'Contoh: IT-DKI2019']) }}
                    @if ($errors->has('vacancy_code')) <span
                            class="text-danger">{{ $errors->first('vacancy_code') }}</span> @endif
                </div>
            </div>

            <div class="clearfix"></div>

            <div class="block full">
                <div class="block-title">
                    <h2{{ $errors->has('opd_id') ? ' class=text-danger' : '' }}><strong>OPD</strong>
                        <small>Organisas Perangkat Daerah</small>
                        </h2>
                </div>

                <div class='form-group'>
                    {{ Form::select('opd_id', $opds, null, ['class' => 'form-control select-select2', 'placeholder' => '-- Pilih OPD --']) }}
                    @if ($errors->has('opd_id')) <span
                            class="text-danger">{{ $errors->first('opd_id') }}</span> @endif
                </div>
            </div>

            <div class="block full">
                <div class="block-title">
                    <h2{{ $errors->has('description') ? ' class=text-danger' : '' }}>Deskripsi Lowongan <small>(Syarat &
                            Ketentuan)</small></h2>
                </div>

                <div class='form-group'>
                    {{ Form::textarea('description', null, ['class' => 'ckeditor']) }}
                    @if ($errors->has('description')) <span
                            class="text-danger">{{ $errors->first('description') }}</span> @endif
                </div>
            </div>

            <div class="block full">
                <div class="block-title">
                    <h2{{ $errors->has('selection') ? ' class=text-danger' : '' }}>Tahapan Seleksi</h2>
                </div>

                <div class='form-group'>
                    {{ Form::textarea('selection', null, ['class' => 'ckeditor']) }}
                    @if ($errors->has('selection')) <span
                            class="text-danger">{{ $errors->first('selection') }}</span> @endif
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="block full">
                <div class="block-title">
                    <h2>Perkiraan Gaji</h2>
                </div>

                <div class='form-group'>
                    {{ Form::text('salary_estimate', null, ['class' => 'form-control', 'placeholder' => 'Perkiraan jumlah gaji dalam rupiah (Contoh: Rp 2.000.000)']) }}
                </div>
            </div>

            <div class="block full">
                <div class="block-title">
                    <h2>Tipe Calon Pegawai</h2>
                </div>

                <div class='form-group'>
                    {{ Form::select('occupation_id', $occupations, null, ['class' => 'form-control select-select2', 'placeholder' => '-- Pilih Tipe --']) }}
                </div>
            </div>

            <div class="block full">
                <div class="block-title">
                    <h2>Tipe Lowongan</h2>
                </div>

                <div class='form-group'>
                    {{ Form::select('type_id', $types, null, ['class' => 'form-control select-select2', 'placeholder' => '-- Pilih Tipe --']) }}
                </div>
            </div>

            <div class="block full">
                <div class="block-title">
                    <h2{{ $errors->has('number_of_employee') ? ' class=text-danger' : '' }}>Jumlah Pegawai</h2>
                </div>

                <div class='form-group'>
                    {{ Form::number('number_of_employee', 0, ['class' => 'form-control', 'placeholder' => 'Jumlah pegawai yang dibutuhkan', 'min' => '0']) }}
                    @if ($errors->has('number_of_employee')) <span
                            class="text-danger">{{ $errors->first('number_of_employee') }}</span> @endif
                </div>
            </div>

            <div class="block full">
                <div class="block-title">
                    <h2>Tanggal Mulai & Berakhir Lamaran</h2>
                </div>

                <div class='form-group'>
                    <div class="input-group input-daterange" data-date-format="dd/mm/yyyy   ">
                        {{ Form::text('start_date', null, array('class' => 'form-control text-center', 'autocomplete' => 'off', 'placeholder' => 'Dari')) }}
                        <span class="input-group-addon"><i class="fa fa-angle-right"></i></span>
                        {{ Form::text('finish_date', null, array('class' => 'form-control text-center', 'autocomplete' => 'off', 'placeholder' => 'Ke')) }}
                    </div>
                </div>
            </div>

            <div class="block full">
                <div class="block-title">
                    <h2>Pilih Periode</h2>
                </div>

                <div class='form-group'>
                    {{ Form::select('period_id', $periods, null, ['class' => 'form-control select-select2', 'placeholder' => '-- Pilih Periode --']) }}
                </div>
            </div>

            <div class="block full col-md-4">
                <div class="block-title text-center">
                    <h2>Status</h2>
                </div>

                <div class='form-group text-center'>
                    <label class="switch switch-success">{!! Form::checkbox('status', 'inactive', null, ['id' => 'status']) !!}<span></span></label>
                </div>
            </div>

            <div class="block full col-md-8">
                <div class="block-title text-center">
                    <h2>Aksi</h2>
                </div>

                <div class='form-group text-center'>
                    <button type="submit" class="btn btn-success">Simpan</button>
                </div>
            </div>
        </div>
        {{ Form::close() }}
    </div>
@endsection

@section('js')
    <script src="{{ asset('assets/js/helpers/ckeditor/ckeditor.js') }}"></script>
    <script type="text/javascript">
        $('#status').change(function() {
            var val = this.checked ? 'active' : 'inactive';
            $('#status').val(val);
        });
    </script>
    <script>
        $(document).ready(function() {
            const numInputs = document.querySelectorAll('input[type=number]')

            numInputs.forEach(function(input) {
                input.addEventListener('change', function(e) {
                    if (e.target.value == '') {
                        e.target.value = 0
                    }
                })
            })
        });
    </script>
@endsection

@endpermission
