@permission('read-users')
@extends('layouts.app')

@section('title', 'User')

@section('content-header')
    <div class="header-section">
        <h1>
            <i class="gi gi-user"></i>User<br>
            <small>Daftar semua user</small>
        </h1>
    </div>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="block full">
                @permission('create-users')
                <a href="{{ route('users.create') }}" class="btn btn-success"><i class="fa fa-user-plus"></i> Tambah
                    User</a>
                <hr/>
                @endpermission

                <div class="table-responsive">
                    <table class="table table-bordered table-striped" id="dataUser-datatable">
                        <thead>
                        <tr>
                            <th class="text-center">No</th>
                            <th>Username</th>
                            <th>Email</th>
                            <th class="text-center">Role</th>
                            @if(Auth::user()->hasPermission('edit-users') || Auth::user()->hasPermission('delete-users'))
                                <th class="text-center">Aksi</th>
                            @endif
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($users as $keyIndex => $user)
                            <tr>
                                <td class="text-center">{{ $keyIndex + 1 }}</td>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td class="text-center"><span
                                            style="background: {{ $user->roles[0]->color }}; color: white; padding: 5px;"
                                            class="label">{{  $user->roles()->pluck('name')->implode(' ') }}</span>
                                </td>{{-- Retrieve array of roles associated to a user and convert to string --}}
                                @if(Auth::user()->hasPermission('edit-users') || Auth::user()->hasPermission('delete-users'))
                                    <td class="text-center">
                                        <div class="btn-group">
                                            @permission('edit-users')
                                            <a href="{{ route('users.edit', $user->id) }}" data-toggle="tooltip"
                                               class="btn btn-xs btn-info" data-original-title="Edit"><i
                                                        class="fa fa-pencil"></i></a>
                                            @endpermission
                                            @permission('delete-users')
                                            <a href="javascript:;" data-toggle="modal"
                                               onclick="deleteData({{ $user->id }})"
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
                        $('#dataUser-datatable').dataTable({
                            ordering: false,
                            autoWidth: false,
                            columnDefs: [{ width: "10px", targets: 0 }],
                            pageLength: 20,
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
            var url = '{{ route("users.destroy", ":id") }}';
            url = url.replace(':id', id);
            $("#deleteForm").attr('action', url);
        }

        function formSubmit() {
            $("#deleteForm").submit();
        }
    </script>
@endsection
@endpermission