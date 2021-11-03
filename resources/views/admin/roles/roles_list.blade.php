@permission('read-roles')
@extends('layouts.app')

@section('title', 'Role')

@section('content-header')
    <div class="header-section">
        <h1>
            <i class="gi gi-keys"></i><i class="gi gi-user"></i>Role<br>
            <small>Daftar semua role</small>
        </h1>
    </div>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="block full">
                @permission('create-roles')
                <a href="{{ route('roles.create') }}" class="btn btn-success"><i class="fa fa-user"></i><i
                            class="fa fa-key"></i> Tambah
                    Role</a>
                <hr/>
                @endpermission
                <div class="table-responsive">
                    <table class="table table-bordered table-striped" id="dataRole-datatable">
                        <thead>
                        <tr>
                            <th class="text-center">No</th>
                            <th>Role</th>
                            <th>Role Display</th>
                            <th>Deskripsi Role</th>
                            <th class="text-center">Warna Label</th>
                            @if(Auth::user()->hasPermission('edit-roles') || Auth::user()->hasPermission('delete-roles'))
                                <th class="text-center">Aksi</th>
                            @endif
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($roles as $keyIndex => $role)
                            <tr>
                                <td class="text-center">{{ $keyIndex + 1 }}</td>
                                <td>{{ $role->name }}</td>
                                <td>{{ $role->display_name }}</td>
                                <td>{{ $role->description }}</td>
                                <td class="text-center">
                                    <div class="colorbox" style="background-color: {{ $role->color }};"></div>
                                </td>
                                @if(Auth::user()->hasPermission('edit-roles') || Auth::user()->hasPermission('delete-roles'))
                                    <td class="text-center">
                                        <div class="btn-group">
                                            @permission('edit-roles')
                                            <a href="{{ route('roles.edit', $role->id) }}" data-toggle="tooltip"
                                               class="btn btn-xs btn-info" data-original-title="Edit"><i
                                                        class="fa fa-pencil"></i></a>
                                            @endpermission
                                            @permission('delete-roles')
                                            <a href="javascript:;" data-toggle="modal"
                                               onclick="deleteData({{ $role->id }})"
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
                        $('#dataRole-datatable').dataTable({
                            ordering: false,
                            autoWidth: false,
                            columnDefs: [{ width: "10px", targets: 0 }],
                            pageLength: 10,
                            lengthMenu: [[10, 20, 30, -1], [10, 20, 30, 'All']]
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
            var url = '{{ route("roles.destroy", ":id") }}';
            url = url.replace(':id', id);
            $("#deleteForm").attr('action', url);
        }

        function formSubmit() {
            $("#deleteForm").submit();
        }
    </script>
@endsection
@endpermission