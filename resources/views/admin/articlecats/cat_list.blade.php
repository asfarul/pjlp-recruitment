@permission('read-articles')
@extends('layouts.app')

@section('title', 'Kategori Artikel')

@section('content-header')
    <div class="header-section">
        <h1>
            <i class="gi gi-notes"></i>Kategori Artikel<br>
            <small>Daftar semua kategori</small>
        </h1>
    </div>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="block full">
                @permission('create-articles')
                <a href="{{ route('kategori.create') }}" class="btn btn-success"><i class="fa fa-newspaper-o"></i> Tambah
                    Kategori</a>
                <hr/>
                @endpermission

                <div class="table-responsive">
                    <table class="table table-bordered table-striped" id="dataKategori-datatable">
                        <thead>
                        <tr>
                            <th class="text-center">No</th>
                            <th>Kategori</th>
                            <th>Deskripsi</th>
                            @if(Auth::user()->hasPermission('edit-articles') || Auth::user()->hasPermission('delete-articles'))
                                <th class="text-center">Aksi</th>
                            @endif
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($categories as $keyIndex => $category)
                            <tr>
                                <td class="text-center">{{ $keyIndex + 1 }}</td>
                                <td>{{ $category->category }}</td>
                                <td>{{ $category->description }}</td>
                                @if(Auth::user()->hasPermission('edit-articles') || Auth::user()->hasPermission('delete-articles'))
                                    <td class="text-center">
                                        <div class="btn-group">
                                            @permission('edit-articles')
                                            <a href="{{ route('kategori.edit', $category->id) }}" data-toggle="tooltip"
                                               class="btn btn-xs btn-info" data-original-title="Edit"><i
                                                        class="fa fa-pencil"></i></a>
                                            @endpermission
                                            @permission('delete-articles')
                                            <a href="javascript:;" data-toggle="modal"
                                               onclick="deleteData({{ $category->id }})"
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
                        $('#dataKategori-datatable').dataTable({
                            ordering: false,
                            autoWidth: false,
                            columnDefs: [{ width: "10px", targets: 0 }],
                            pageLength: 10,
                            lengthMenu: [[10, 20, 30, -1], [10, 20, 30, 'All']],
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
            var url = '{{ route("kategori.destroy", ":id") }}';
            url = url.replace(':id', id);
            $("#deleteForm").attr('action', url);
        }

        function formSubmit() {
            $("#deleteForm").submit();
        }
    </script>
@endsection
@endpermission