@permission('read-periods')
@extends('layouts.app')

@section('title', 'Periode')

@section('content-header')
    <div class="header-section">
        <h1>
            <i class="gi gi-keys"></i>Master Periode<br>
            <small>Manajemen Periode Pendaftaran PJLP</small>
        </h1>
    </div>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="block full">
                @permission('create-periods')
                <a href="{{ route('periods.create') }}" class="btn btn-success"><i class="fa fa-home"></i> Tambah
                    Periode</a>
                <hr/>
                @endpermission
                @php
                    setlocale(LC_TIME, 'id_ID');
                    \Carbon\Carbon::setLocale('id');
                @endphp 
                <div class="table-responsive">
                    <table class="table table-bordered table-striped" id="dataOpd-datatable">
                        <thead>
                        <tr>
                            <th class="text-center">No</th>
                            <th>Tanggal Mulai</th>
                            <th>Tanggal Selesai</th>
                            <th>Deskripsi</th>
                            @if(Auth::user()->hasPermission('edit-periods') || Auth::user()->hasPermission('delete-periods'))
                                <th class="text-center">Aksi</th>
                            @endif
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($periods as $keyIndex => $period)
                            <tr>
                                <td class="text-center">{{ $loop->iteration }}</td>
                                <td>{{ \Carbon\Carbon::parse($period->start_date)->formatLocalized('%d %B %Y') }}</td>
                                <td>{{ \Carbon\Carbon::parse($period->end_date)->formatLocalized('%d %B %Y') }}</td>
                                <td>{{ $period->description }}</td>
                                @if(Auth::user()->hasPermission('edit-periods') || Auth::user()->hasPermission('delete-periods'))
                                    <td class="text-center">
                                        <div class="btn-group">
                                            @permission('edit-periods')
                                            <a href="{{ route('periods.edit', $period->id) }}" data-toggle="tooltip"
                                               class="btn btn-xs btn-info" data-original-title="Edit"><i
                                                        class="fa fa-pencil"></i></a>
                                            </a>
                                            @endpermission
                                            @permission('delete-periods')
                                            <a href="javascript:;" data-toggle="modal"
                                               onclick="deleteData({{ $period->id }})"
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
            var url = '{{ route("periods.destroy", ":id") }}';
            url = url.replace(':id', id);
            $("#deleteForm").attr('action', url);
        }

        function formSubmit() {
            $("#deleteForm").submit();
        }
    </script>
@endsection
@endpermission