@permission('read-candidates')
@extends('layouts.app')

@section('title', 'Data Pelamar UMUM')

@section('content-header')
    <div class="header-section">
        <h1>
            <i class="gi gi-file_export"></i>Data Pelamar UMUM<br>
            <small>Daftar semua pelamar di formasi umum</small>
        </h1>
    </div>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="block full">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped" id="dataVacdoc-datatable">
                        <thead>
                        <tr>
                            <th class="text-center">No</th>
                            <th class="text-center">Foto</th>
                            <th>Nama</th>
                            <th>NIK</th>
                            <th>Lowongan</th>
                            <th>Melamar Di OPD</th>
                            <th class="text-center">Status</th>
                            <th class="text-center">Dokumen</th>
                            @if(Auth::user()->hasPermission('show-candidates') || Auth::user()->hasPermission('edit-candidates') || Auth::user()->hasPermission('delete-candidates'))
                                <th class="text-center">Aksi</th>
                            @endif
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($candidates as $keyIndex => $candidate)
                            <tr>
                                <td class="text-center">{{ $keyIndex + 1 }}</td>
                                <td class="text-center"><img src="{{ url('/uploads') . $candidate->foto }}" height="50">
                                </td>
                                <td>{{ $candidate->nama }}</td>
                                <td>{{ $candidate->nik }}</td>
                                <td>{{ $candidate->title }}</td>
                                <td>{{ $candidate->opd }}</td>
                                <td class="text-center"><span class="label label-info">{{ $candidate->candidate_status }}</span></td>
                                <td class="text-center">
                                    <div class="btn-group">
                                        <a href="javascript:void(0)" data-toggle="dropdown"
                                           class="btn btn-alt btn-danger dropdown-toggle"><span
                                                    class="caret"></span></a>
                                        <ul class="dropdown-menu text-right">
                                            <li class="dropdown-header">Dokumen Pendukung</li>
                                            <li><a href="{{ url('/uploads') . $candidate->ktp }}"
                                                   target="_blank">KTP</a></li>
                                            <li><a href="{{ url('/uploads') . $candidate->ijazah }}" target="_blank">Ijazah</a>
                                            </li>
                                            <li><a href="{{ url('/uploads') . $candidate->transkrip }}" target="_blank">Transkrip
                                                    Nilai</a></li>
                                            <li><a href="{{ url('/uploads') . $candidate->surat_penawaran }}"
                                                   target="_blank">Surat Penawaran</a></li>
                                            <li><a href="{{ url('/uploads') . $candidate->pakta_integritas }}"
                                                   target="_blank">Pakta Integritas</a></li>
                                            <li><a href="{{ url('/uploads') . $candidate->formulir_kualifikasi }}"
                                                   target="_blank">Formulir Kualifikasi</a></li>
                                            @if(!empty($candidate->sertifikat))<li><a href="{{ url('/uploads') . $candidate->sertifikat }}"
                                                   target="_blank">Sertifikat</a></li>@endif
                                        </ul>
                                    </div>
                                </td>
                                @if(Auth::user()->hasPermission('show-candidates') || Auth::user()->hasPermission('edit-candidates') || Auth::user()->hasPermission('delete-candidates'))
                                    <td class="text-center">
                                        <div class="btn-group">
                                            @permission('show-candidates')
                                            <a href="javascript:;" class="btn btn-xs btn-warning"
                                               data-toggle="modal"
                                               data-target="#detail"
                                               data-avatar="{{ url('/uploads') . $candidate->foto }}"
                                               data-nik="{{ $candidate->nik }}"
                                               data-nama="{{ $candidate->nama }}"
                                               data-notel="{{ $candidate->notel }}"
                                               data-email="{{ $candidate->email }}"
                                               data-opd="{{ $candidate->opd }}"
                                               data-jabatan="{{ $candidate->title }}">
                                                <i class="fa fa-eye"></i>
                                            </a>
                                            @endpermission
                                            @permission('edit-candidates')
                                            <a href="{{ route('pelamar.edit', $candidate->id) }}" data-toggle="tooltip"
                                               class="btn btn-xs btn-info" data-original-title="Edit"><i
                                                        class="fa fa-pencil"></i></a>
                                            @endpermission
                                            @permission('delete-candidates')
                                            <a href="javascript:;" data-toggle="modal"
                                               onclick="deleteData({{ $candidate->id }})"
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
    @include('modals.candidate-detail')
@endsection

@section('js')
    <script>
        $('#detail').on('show.bs.modal', function (e) {
            var avatar = $(e.relatedTarget).data('avatar');
            var nik = $(e.relatedTarget).data('nik');
            var nama = $(e.relatedTarget).data('nama');
            var notel = $(e.relatedTarget).data('notel');
            var email = $(e.relatedTarget).data('email');
            var opd = $(e.relatedTarget).data('opd');
            var jabatan = $(e.relatedTarget).data('jabatan');

            $('#avatar').attr('src', avatar);
            $('#detail-nik').html(nik);
            $('#detail-nama').html(nama);
            $('#detail-notel').html(notel);
            $('#detail-email').html(email);
            $('#detail-opd').html(opd);
            $('#detail-jabatan').html(jabatan);
        });
    </script>
    <script>
        $(document).ready(function () {
            var TablesDatatables = function () {
                return {
                    init: function () {
                        /* Initialize Bootstrap Datatables Integration */
                        App.datatables();

                        /* Initialize Datatables */
                        $('#dataVacdoc-datatable').dataTable({
                            ordering: true,
                            autoWidth: false,
                            columnDefs: [
                                {width: "10px", targets: 0},
                                {width: "100px", targets: 6},
                            ],
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
            var url = '{{ route("pelamar.destroy", ":id") }}';
            url = url.replace(':id', id);
            $("#deleteForm").attr('action', url);
        }

        function formSubmit() {
            $("#deleteForm").submit();
        }
    </script>
@endsection
@endpermission