@permission('read-opds')
@extends('layouts.app')

@section('title', 'OPD')

@section('content-header')
    <div class="header-section">
        <h1>
            <i class="gi gi-keys"></i>Organisasi Perangkat Daerah<br>
            <small>Daftar semua OPD</small>
        </h1>
    </div>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="block full">
                @permission('create-opds')
                <a href="{{ route('opd.create') }}" class="btn btn-success"><i class="fa fa-home"></i> Tambah
                    OPD</a>
                <hr/>
                @endpermission

                <div class="table-responsive">
                    <table class="table table-bordered table-striped" id="dataOpd-datatable">
                        <thead>
                        <tr>
                            <th class="text-center">No</th>
                            <th>OPD</th>
                            <th>Deskripsi</th>
                            <th class="text-center">Kode OPD</th>
                            @if(Auth::user()->hasPermission('edit-opds') || Auth::user()->hasPermission('delete-opds'))
                                <th class="text-center">Aksi</th>
                            @endif
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($opds as $keyIndex => $opd)
                            <tr>
                                <td class="text-center">{{ $keyIndex + 1 }}</td>
                                <td>{{ $opd->opd }}</td>
                                <td>{{ $opd->deskripsi }}</td>
                                <td class="text-center">{{ $opd->kode_opd }}</td>
                                @if(Auth::user()->hasPermission('edit-opds') || Auth::user()->hasPermission('delete-opds'))
                                    <td class="text-center">
                                        <div class="btn-group">
                                            @permission('edit-opds')
                                            <a href="{{ route('permission.edit', $opd->id) }}" data-toggle="tooltip"
                                               class="btn btn-xs btn-info" data-original-title="Edit"><i
                                                        class="fa fa-pencil"></i></a>
                                            </a>
                                            @endpermission
                                            @permission('delete-opds')
                                            <a href="javascript:;" data-toggle="modal"
                                               onclick="deleteData({{ $opd->id }})"
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
                        $('#dataOpd-datatable').dataTable({
                            ordering: false,
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
            var url = '{{ route("opd.destroy", ":id") }}';
            url = url.replace(':id', id);
            $("#deleteForm").attr('action', url);
        }

        function formSubmit() {
            $("#deleteForm").submit();
        }
    </script>
@endsection
@endpermission