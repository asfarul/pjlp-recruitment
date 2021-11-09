@permission('read-vacancies')
@extends('layouts.app')

@section('title', 'Lowongan Pekerjaan')

@section('content-header')
    <div class="header-section">
        <h1>
            <i class="gi gi-sort"></i>Lowongan Pekerjaan<br>
            <small>Daftar semua lowongan pekerjaan</small>
        </h1>
    </div>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="block full">
                @permission('create-vacancies')
                <a href="{{ route('lowongan.create') }}" class="btn btn-success"><i class="fa fa-sticky-note"></i>
                    Tambah
                    Lowongan</a>
                <hr/>
                @endpermission

                <div class="table-responsive">
                    <table class="table table-bordered table-striped" id="dataLowongan-datatable">
                        <thead>
                        <tr>
                            <th class="text-center">No</th>
                            <th class="text-center">Kode Lowongan</th>
                            <th>Judul Lowongan</th>
                            <th>OPD</th>
                            <th class="text-center">Periode</th>
                            <th class="text-center">Jalur</th>
                            <th class="text-center">Status</th>
                            @if(Auth::user()->hasPermission('edit-vacancies') || Auth::user()->hasPermission('delete-vacancies'))
                                <th class="text-center">Aksi</th>
                            @endif
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($vacancies as $keyIndex => $vacancy)
                            <tr>
                                <td class="text-center">{{ $keyIndex + 1 }}</td>
                                <td class="text-center">{{ $vacancy->vacancy_code }}</td>
                                <td>{{ $vacancy->title }}</td>
                                <td>{{ $vacancy->dinas->deskripsi }}</td>
                                <td class="text-center">{{ $vacancy->periode != null ? $vacancy->periode->description : '-' }}</td>
                                <td class="text-center"><small>{{ strtoupper($vacancy->type->type) }}</small></td>
                                <td class="text-center">
                                    @if($vacancy->status == 1)
                                        <span class="label label-success">aktif</span>
                                    @else
                                        <span class="label label-danger">tidak aktif</span>
                                    @endif
                                </td>
                                @if(Auth::user()->hasPermission('edit-vacancies') || Auth::user()->hasPermission('delete-vacancies'))
                                    <td class="text-center">
                                        <div class="btn-group">
                                            @permission('edit-vacancies')
                                            <a href="{{ route('lowongan.edit', $vacancy->id) }}" data-toggle="tooltip"
                                               class="btn btn-xs btn-info" data-original-title="Edit"><i
                                                        class="fa fa-pencil"></i></a>
                                            @endpermission
                                            @permission('delete-vacancies')
                                            <a href="javascript:;" data-toggle="modal"
                                               onclick="deleteData({{ $vacancy->id }})"
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
                        $('#dataLowongan-datatable').dataTable({
                            ordering: false,
                            autoWidth: false,
                            columnDefs: [{ width: "10px", targets: 0 }],
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
            var url = '{{ route("lowongan.destroy", ":id") }}';
            url = url.replace(':id', id);
            $("#deleteForm").attr('action', url);
        }

        function formSubmit() {
            $("#deleteForm").submit();
        }
    </script>
@endsection
@endpermission