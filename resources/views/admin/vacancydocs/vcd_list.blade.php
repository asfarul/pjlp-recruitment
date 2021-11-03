@permission('read-vacancydocs')
@extends('layouts.app')

@section('title', 'Dokumen Lowongan')

@section('content-header')
    <div class="header-section">
        <h1>
            <i class="gi gi-file_export"></i>Dokumen Lowongan<br>
            <small>Daftar semua dokumen</small>
        </h1>
    </div>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="block full">
                @permission('create-articles')
                <a href="{{ route('dokumen.create') }}" class="btn btn-success"><i class="fa fa-newspaper-o"></i> Tambah
                    Dokumen</a>
                <hr/>
                @endpermission

                <div class="table-responsive">
                    <table class="table table-bordered table-striped" id="dataVacdoc-datatable">
                        <thead>
                        <tr>
                            <th class="text-center">No</th>
                            <th>OPD</th>
                            <th>Lowongan</th>
                            <th>Dokumen</th>
                            <th>File</th>
                            @if(Auth::user()->hasPermission('edit-vacancydocs') || Auth::user()->hasPermission('delete-vacancydocs'))
                                <th class="text-center">Aksi</th>
                            @endif
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($vacdocs as $keyIndex => $vacdoc)
                            <tr>
                                <td class="text-center">{{ $keyIndex + 1 }}</td>
                                <td>{{ $vacdoc->opd }}</td>
                                <td>{{ $vacdoc->vacancy_title }}</td>
                                <td>{{ $vacdoc->title }}</td>
                                <td>{{ $vacdoc->title }}</td>
                                @if(Auth::user()->hasPermission('edit-vacancydocs') || Auth::user()->hasPermission('delete-vacancydocs'))
                                    <td class="text-center">
                                        <div class="btn-group">
                                            @permission('edit-vacancydocs')
                                            <a href="{{ route('kategori.edit', $vacdoc->id) }}" data-toggle="tooltip"
                                               class="btn btn-xs btn-info" data-original-title="Edit"><i
                                                        class="fa fa-pencil"></i></a>
                                            @endpermission
                                            @permission('delete-vacancydocs')
                                            <a href="javascript:;" data-toggle="modal"
                                               onclick="deleteData({{ $vacdoc->id }})"
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
                        $('#dataVacdoc-datatable').dataTable({
                            ordering: false,
                            autoWidth: false,
                            columnDefs: [{ width: "10px", targets: 0 }],
                            pageLength: 20,
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
            var url = '{{ route("dokumen.destroy", ":id") }}';
            url = url.replace(':id', id);
            $("#deleteForm").attr('action', url);
        }

        function formSubmit() {
            $("#deleteForm").submit();
        }
    </script>
@endsection
@endpermission