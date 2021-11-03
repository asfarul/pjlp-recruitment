@permission('read-permissions')
@extends('layouts.app')

@section('title', 'Permission')

@section('content-header')
    <div class="header-section">
        <h1>
            <i class="gi gi-keys"></i>Permissions<br>
            <small>Daftar semua permission</small>
        </h1>
    </div>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="block full">
                @permission('create-permissions')
                <a href="{{ route('permission.create') }}" class="btn btn-success"><i class="fa fa-key"></i> Tambah
                    Permission</a>
                <hr/>
                @endpermission
                <div class="table-responsive">
                    <table class="table table-bordered table-striped" id="dataPermission-datatable">
                        <thead>
                        <tr>
                            <th class="text-center">No</th>
                            <th>Permission</th>
                            <th>Permission Display</th>
                            <th>Deskripsi Permission</th>
                            @if(Auth::user()->hasPermission('edit-permissions') || Auth::user()->hasPermission('delete-permissions'))
                                <th class="text-center">Aksi</th>
                            @endif
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($permissions as $keyIndex => $permission)
                            <tr>
                                <td class="text-center">{{ $keyIndex + 1 }}</td>
                                <td>{{ $permission->name }}</td>
                                <td>{{ $permission->display_name }}</td>
                                <td>{{ $permission->description }}</td>
                                @if(Auth::user()->hasPermission('edit-permissions') || Auth::user()->hasPermission('delete-permissions'))
                                <td class="text-center">
                                    <div class="btn-group">
                                        @permission('edit-permissions')
                                        <a href="{{ route('permission.edit', $permission->id) }}" data-toggle="tooltip"
                                           class="btn btn-xs btn-info" data-original-title="Edit"><i
                                                    class="fa fa-pencil"></i></a>
                                        @endpermission
                                        @permission('delete-permissions')
                                        <a href="javascript:;" data-toggle="modal"
                                           onclick="deleteData({{ $permission->id }})"
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
                        $('#dataPermission-datatable').dataTable({
                            ordering: false,
                            autoWidth: false,
                            columnDefs: [{ width: "10px", targets: 0 }],
                            pageLength: 20,
                            lengthMenu: [[20, 30, 50, -1], [20, 30, 50, 'All']]
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
            var url = '{{ route("permission.destroy", ":id") }}';
            url = url.replace(':id', id);
            $("#deleteForm").attr('action', url);
        }

        function formSubmit() {
            $("#deleteForm").submit();
        }
    </script>
@endsection
@endpermission