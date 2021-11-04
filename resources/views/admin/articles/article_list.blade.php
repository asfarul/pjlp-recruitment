@permission('read-articles')
@extends('layouts.app')

@section('title', 'Artikel')

@section('content-header')
    <div class="header-section">
        <h1>
            <i class="gi gi-book"></i>Artikel<br>
            <small>Daftar semua artikel</small>
        </h1>
    </div>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="block full">
                @permission('create-articles')
                <a href="{{ route('artikel.create') }}" class="btn btn-success"><i class="fa fa-book"></i>
                    Tambah
                    Artikel</a>
                <hr/>
                @endpermission

                <div class="table-responsive">
                    <table class="table table-bordered table-striped" id="dataArticle-datatable">
                        <thead>
                        <tr>
                            <th class="text-center">No</th>
                            <th class="text-center">Gambar</th>
                            <th>Judul</th>
                            <th>Kategori</th>
                            <th>Status</th>
                            <th>Tgl Publikasi</th>
                            <th>Tgl Dibuat</th>
                            @if(Auth::user()->hasPermission('edit-articles') || Auth::user()->hasPermission('delete-articles'))
                                <th class="text-center">Aksi</th>
                            @endif
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($articles as $keyIndex => $article)
                            <tr>
                                <td class="text-center">{{ $keyIndex + 1 }}</td>
                                <td class="text-center"><img src="@if(!empty($article->image_header)) {{ url('/uploads') . $article->image_header }} @endif" height ="50px"></td>
                                <td>{{ $article->title }}</td>
                                <td>{{ $article->category }}</td>
                                <td>{{ $article->status }}</td>
                                <td>{{ date('d/m/Y', strtotime($article->created_at)) }}</td>
                                <td>{{ date('d/m/Y', strtotime($article->publish_at)) }}</td>
                                @if(Auth::user()->hasPermission('edit-articles') || Auth::user()->hasPermission('delete-articles'))
                                    <td class="text-center">
                                        <div class="btn-group">
                                            @permission('edit-articles')
                                            <a href="{{ route('artikel.edit', $article->id) }}" data-toggle="tooltip"
                                               class="btn btn-xs btn-info" data-original-title="Edit"><i
                                                        class="fa fa-pencil"></i></a>
                                            @endpermission
                                            @permission('delete-articles')
                                            <a href="javascript:;" data-toggle="modal"
                                               onclick="deleteData({{ $article->id }})"
                                               data-target="#confirm-delete" class="btn btn-xs btn-danger"><i
                                                        class="fa fa-trash"></i></a>
                                            @endpermission
                                        </div>
                                    </td>
                                @endif
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    @include('modals.confimation-delete')
@endsection

@section('js')
    <script>
        $(document).ready(function () {
            var TablesDatatables = function () {
                return {
                    init: function () {
                        /* Initialize Bootstrap Datatables Integration */
                        App.datatables();

                        /* Initialize Datatables */
                        $('#dataArticle-datatable').dataTable({
                            ordering: false,
                            autoWidth: false,
                            columnDefs: [
                                { width: "10px", targets: 0 },
                                { width: "15%", targets: 1 }
                            ],
                            pageLength: 20,
                            lengthMenu: [[20, 30, 50, -1], [20, 30, 50, 'All']],
                        });

                        /* Add placeholder attribute to the search input */
                        $('.dataTables_filter input').attr('placeholder', 'Cari . . .');
                    }
                };
            }();

            $(function () {
                TablesDatatables.init();
            });
        });
    </script>
    <script type="text/javascript">
        function deleteData(id) {
            var id = id;
            var url = '{{ route("artikel.destroy", ":id") }}';
            url = url.replace(':id', id);
            $("#deleteForm").attr('action', url);
        }

        function formSubmit() {
            $("#deleteForm").submit();
        }
    </script>
@endsection
@endpermission