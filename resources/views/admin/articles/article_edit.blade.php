@permission('edit-articles')
    @extends('layouts.app')

    @section('title', 'Ubah Artikel')

@section('content-header')
    <div class="header-section">
        <h1>
            <i class="gi gi-book"></i>Artikel<br>
            <small>Ubah artikel</small>
        </h1>
    </div>
@endsection

@section('content')
    <div class="row">
        {{ Form::model($article, ['route' => ['artikel.update', $article->id], 'method' => 'PUT', 'class' => 'form-horizontal form-label-left', 'enctype' => 'multipart/form-data']) }}
        <div class="col-md-12">
            <div class="block full">
                <div class="block-title">
                    <h2{{ $errors->has('title') ? ' class=text-danger' : '' }}><strong>Judul Artikel</strong></h2>
                </div>

                <div class='form-group'>
                    {{ Form::text('title', null, ['class' => 'form-control', 'placeholder' => 'Judul lengkap artikel']) }}
                    @if ($errors->has('title')) <span
                            class="text-danger">{{ $errors->first('title') }}</span> @endif
                </div>
            </div>

            <div class="block full">
                <div class="block-title">
                    <h2{{ $errors->has('category_id') ? ' class=text-danger' : '' }}><strong>Kategori</strong></h2>
                </div>

                <div class='form-group'>
                    {{ Form::select('category_id', $categories, null, ['class' => 'form-control select-select2', 'placeholder' => '-- Pilih Kategori--']) }}
                    @if ($errors->has('category_id')) <span
                            class="text-danger">{{ $errors->first('category_id') }}</span> @endif
                </div>
            </div>

            <div class="block full">
                <div class="block-title">
                    <h2{{ $errors->has('image_header') ? ' class=text-danger' : '' }}><strong>Gambar Header</strong>
                        </h2>
                </div>

                <div class='form-group'>
                    {{ Form::file('image_header', ['id' => 'image_header', 'accept' => 'image/*']) }}
                    <br>
                    <img src="@if (!empty($article->image_header)) {{ url('/uploads') . $article->image_header }} @endif" id="image-header-preview" width="50%" />
                    @if ($errors->has('image_header')) <span class="text-danger">{{ $errors->first('image_header') }}</span> @endif
                </div>
            </div>

            <div class="block full">
                <div class="block-title">
                    <h2{{ $errors->has('content') ? ' class=text-danger' : '' }}>Konten Artikel</h2>
                </div>

                <div class='form-group'>
                    {{ Form::textarea('content', null, ['class' => 'ckeditor']) }}
                    @if ($errors->has('content')) <span
                            class="text-danger">{{ $errors->first('content') }}</span> @endif
                </div>
            </div>

            <div class="block full  col-md-7">
                <div class="block-title">
                    <h2{{ $errors->has('status') ? ' class=text-danger' : '' }}><strong>Status</strong></h2>
                </div>

                <div class='form-group'>
                    <select name="status" class="form-control select-select2">
                        <option value="PUBLISHED" {{ $article->status == 'PUBLISHED' ? 'selected' : '' }}>Published
                        </option>
                        <option value="DRAFT" {{ $article->status == 'DRAFT' ? 'selected' : '' }}>Draft</option>
                    </select>
                    {{-- {{ Form::select('status', $statusList, null, ['class' => 'form-control select-select2', 'placeholder' => '-- Pilih Status--']) }} --}}
                    @if ($errors->has('status')) <span
                            class="text-danger">{{ $errors->first('status') }}</span> @endif
                </div>
            </div>

            <div class="block full col-md-5">
                <div class="block-title">
                    <h2>Waktu Publikasi</h2>
                </div>

                <div class='form-group'>
                    <div class="input-group date" data-provide="datepicker" data-date-format="dd/mm/yyyy">
                        {{ $article->from != null ? 
                        Form::text('from', date('d/m/Y', strtotime($article->from)), ['class' => 'form-control text-center', 'autocomplete' => 'off', 'placeholder' => 'Mulai']) 
                        : Form::text('from', null, ['class' => 'form-control text-center', 'autocomplete' => 'off', 'placeholder' => 'Mulai']) 
                        }}
                        <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                    </div>
                </div>
            </div>
            <div class="clearfix"></div>

            <div class="block full">
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
        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function(e) {
                    $('#image-header-preview').attr('src', e.target.result);
                }
                reader.readAsDataURL(input.files[0]);
            }
        }
        $("#image_header").change(function() {
            readURL(this);
        });
    </script>
@endsection
@endpermission
