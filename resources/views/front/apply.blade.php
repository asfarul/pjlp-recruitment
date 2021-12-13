@extends('layouts.frontapp')

@section('title', 'Melamar Lowongan')

@section('content')
    <!-- Titlebar ================================================== -->
    <div class="single-page-header" data-background-image="{{ asset('template/images/single-job.jpg') }}">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="single-page-header-inner">
                        <div class="left-side">
                            <div class="header-details">
                                <h3>[{{ strtoupper($vacancy->type) }}] {{ $vacancy->title }}</h3>
                                <h5>{{ $vacancy->occupation }}</h5>
                                <ul>
                                    <li><i class="icon-material-outline-business"></i> {{ $vacancy->deskripsi }}</li>
                                    @if($vacancy->status == 1)
                                        <li>
                                            <div class="verified-badge-with-title">Aktif</div>
                                        </li>@endif
                                </ul>
                            </div>
                        </div>
                        <div class="right-side">
                            <div class="salary-box">
                                <div class="salary-type">Kode Lamaran</div>
                                <div class="salary-amount">{{ $vacancy->vacancy_code }}</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Apply Content
    ================================================== -->
    <div class="container margin-top-50 margin-bottom-50">
        <div class="row">
            <!-- Content -->
            <div class="col-lg-8">
                <div>
                    <h2>Formulir Pendaftaran</h2>
                    <p>Isilah formulir anda dengan data yang benar, agar dapat dengan mudah dihubungi. Jika tidak dapat
                        dihubungi maka anda dianggap gugur.</p>
                </div>
                @if($vacancy->type_id == 1)
                {{-- khusus --}}
                    <div class="dashboard-box margin-top-0">
                        {{ Form::open(array('route' => 'front.lowongan.apply.khusus', 'enctype' => 'multipart/form-data')) }}
                        {{ Form::hidden('vacancy_id', Hashids::encode($vacancy->id . '97531')) }}
                        <div class="content with-padding padding-bottom-10">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="submit-field">
                                        <h5>NIK
                                            <small>(Nomor Induk Kependudukan)</small>
                                        </h5>
                                        {{ Form::text('nik', null, array('class' => 'with-border', 'maxlength' => '16', 'placeholder' => '61710xxxxxxxxxxx')) }}
                                        @if ($errors->has('nik'))
                                            <small style="color: red">{{ $errors->first('nik') }}</small>
                                        @endif
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="submit-field">
                                        <h5>Nama Lengkap</h5>
                                        {{ Form::text('nama', null, array('class' => 'with-border', 'placeholder' => 'Nama lengkap pelamar')) }}
                                        @if ($errors->has('nama'))
                                            <small style="color: red">{{ $errors->first('nama') }}</small>
                                        @endif
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="submit-field">
                                        <h5>Email</h5>
                                        {{ Form::email('email', null, array('class' => 'with-border', 'placeholder' => 'Email pelamar')) }}
                                        @if ($errors->has('email'))
                                            <small style="color: red">{{ $errors->first('email') }}</small>
                                        @endif
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="submit-field">
                                        <h5>No Telepon/Handphone</h5>
                                        {{ Form::text('notel', null, array('class' => 'with-border', 'maxlength' => '14', 'placeholder' => 'Nomor telepon/handphone pelamar')) }}
                                        @if ($errors->has('notel'))
                                            <small style="color: red">{{ $errors->first('notel') }}</small>
                                        @endif
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="submit-field">
                                        <div class="uploadButton">
                                            {{ Form::file('surat_penawaran', array('id' => 'surat_penawaran', 'class' => 'uploadButton-input', 'accept' => 'application/pdf')) }}
                                            <label class="uploadButton-button ripple-effect" for="surat_penawaran">Upload
                                                File</label>
                                            <span class="uploadButton-file-name penawaran">Upload Surat Penawaran, PDF, maksimal 1MB</span>
                                        </div>
                                        @if ($errors->has('surat_penawaran'))
                                            <small style="color: red">{{ $errors->first('surat_penawaran') }}</small>
                                        @endif
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="submit-field">
                                        <div class="uploadButton">
                                            {{ Form::file('pakta_integritas', array('id' => 'pakta_integritas', 'class' => 'uploadButton-input', 'accept' => 'application/pdf')) }}
                                            <label class="uploadButton-button ripple-effect" for="pakta_integritas">Upload
                                                File</label>
                                            <span class="uploadButton-file-name pakta">Upload Pakta Integritas, PDF, maksimal 1MB</span>
                                        </div>
                                        @if ($errors->has('pakta_integritas'))
                                            <small style="color: red">{{ $errors->first('pakta_integritas') }}</small>
                                        @endif
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="submit-field">
                                        <div class="uploadButton">
                                            {{ Form::file('formulir_kualifikasi', array('id' => 'formulir_kualifikasi', 'class' => 'uploadButton-input', 'accept' => 'application/pdf')) }}
                                            <label class="uploadButton-button ripple-effect" for="formulir_kualifikasi">Upload
                                                File</label>
                                            <span class="uploadButton-file-name kualifikasi">Upload Formulir Kualifikasi, PDF, maksimal 2MB</span>
                                        </div>
                                        @if ($errors->has('formulir_kualifikasi'))
                                            <small style="color: red">{{ $errors->first('formulir_kualifikasi') }}</small>
                                        @endif
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="submit-field">
                                        <div class="uploadButton">
                                            {{ Form::file('foto', array('id' => 'foto', 'class' => 'uploadButton-input', 'accept' => 'image/*')) }}
                                            <label class="uploadButton-button ripple-effect" for="foto">Upload
                                                File</label>
                                            <span class="uploadButton-file-name foto">Upload Foto, JPG/PNG, maksimal 1MB</span>
                                        </div>
                                        @if ($errors->has('foto'))
                                            <small style="color: red">{{ $errors->first('foto') }}</small>
                                        @endif
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="submit-field">
                                        <div class="uploadButton">
                                            {{ Form::file('ktp', array('id' => 'ktp', 'class' => 'uploadButton-input', 'accept' => 'image/*, application/pdf')) }}
                                            <label class="uploadButton-button ripple-effect" for="ktp">Upload
                                                FIle</label>
                                            <span class="uploadButton-file-name ktp">Upload Scan KTP, JPG/PNG/PDF, maksimal 1MB</span>
                                        </div>
                                        @if ($errors->has('ktp'))
                                            <small style="color: red">{{ $errors->first('ktp') }}</small>
                                        @endif
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="submit-field">
                                        <div class="uploadButton">
                                            {{ Form::file('ijazah', array('id' => 'ijazah', 'class' => 'uploadButton-input', 'accept' => 'image/*, application/pdf')) }}
                                            <label class="uploadButton-button ripple-effect" for="ijazah">Upload
                                                File</label>
                                            <span class="uploadButton-file-name ijazah">Upload Scan Ijazah, JPG/PNG/PDF, maksimal 1MB</span>
                                        </div>
                                        @if ($errors->has('ijazah'))
                                            <small style="color: red">{{ $errors->first('ijazah') }}</small>
                                        @endif
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="submit-field">
                                        <div class="uploadButton">
                                            {{ Form::file('transkrip', array('id' => 'transkrip', 'class' => 'uploadButton-input', 'accept' => 'image/*, application/pdf')) }}
                                            <label class="uploadButton-button ripple-effect" for="transkrip">Upload
                                                File</label>
                                            <span class="uploadButton-file-name transkrip">Upload Scan Transkrip Nilai, JPG/PNG/PDF, maksimal 1MB</span>
                                        </div>
                                        @if ($errors->has('transkrip'))
                                            <small style="color: red">{{ $errors->first('transkrip') }}</small>
                                        @endif
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="submit-field">
                                        <div class="uploadButton">
                                            {{ Form::file('kontrak_spk', array('id' => 'kontrak_spk', 'class' => 'uploadButton-input', 'accept' => '.pdf')) }}
                                            <label class="uploadButton-button ripple-effect" for="kontrak_spk">Upload
                                                File</label>
                                            <span class="uploadButton-file-name kontrak_spk">Upload Kontrak SPK, PDF, maksimal 500KB</span>
                                        </div>
                                        @if ($errors->has('kontrak_spk'))
                                            <small style="color: red">{{ $errors->first('kontrak_spk') }}</small>
                                        @endif
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="submit-field">
                                        <div class="uploadButton">
                                            {{ Form::file('evaluasi_prestasi', array('id' => 'evaluasi_prestasi', 'class' => 'uploadButton-input', 'accept' => '.pdf')) }}
                                            <label class="uploadButton-button ripple-effect" for="evaluasi_prestasi">Upload
                                                File</label>
                                            <span class="uploadButton-file-name evaluasi_prestasi">Upload Scan Evaluasi Prestasi, PDF, maksimal 2MB</span>
                                        </div>
                                        @if ($errors->has('evaluasi_prestasi'))
                                            <small style="color: red">{{ $errors->first('evaluasi_prestasi') }}</small>
                                        @endif
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="submit-field">
                                        <div class="uploadButton">
                                            {{ Form::file('sertifikat', array('id' => 'sertifikat', 'class' => 'uploadButton-input', 'accept' => 'image/*, application/pdf')) }}
                                            <label class="uploadButton-button ripple-effect" for="sertifikat">Upload
                                                File</label>
                                            <span class="uploadButton-file-name sertifikat">Upload Scan Sertifikat (JIKA ADA), digabung menjadi 1 PDF jika lebih dari satu, JPG/PNG/PDF, maksimal 3MB</span>
                                        </div>
                                        @if ($errors->has('sertifikat'))
                                            <small style="color: red">{{ $errors->first('sertifikat') }}</small>
                                        @endif
                                    </div>
                                </div>

                                <div class="col-xl-12 centered-button">
                                    
                                    <button type="submit" class="button ripple-effect big margin-top-30"><i
                                                class="icon-feather-plus"></i> Lamar
                                    </button>
                                    <p style="color:red">Perhatian! Pastikan formasi yang anda pilih sudah benar dan data diri beserta berkas yang anda inputkan sudah benar dan lengkap.</p>
                                </div>
                            </div>
                        </div>
                        {{ Form::close() }}
                    </div>
                @elseif($vacancy->type_id == 2)
                    {{-- umum --}}
                    <div class="dashboard-box margin-top-0">
                        {{ Form::open(array('route' => 'front.lowongan.apply', 'enctype' => 'multipart/form-data')) }}
                        {{ Form::hidden('vacancy_id', Hashids::encode($vacancy->id . '97531')) }}
                        <div class="content with-padding padding-bottom-10">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="submit-field">
                                        <h5>NIK
                                            <small>(Nomor Induk Kependudukan)</small>
                                        </h5>
                                        {{ Form::text('nik', null, array('class' => 'with-border', 'maxlength' => '16', 'placeholder' => '61710xxxxxxxxxxx')) }}
                                        @if ($errors->has('nik'))
                                            <small style="color: red">{{ $errors->first('nik') }}</small>
                                        @endif
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="submit-field">
                                        <h5>Nama Lengkap</h5>
                                        {{ Form::text('nama', null, array('class' => 'with-border', 'placeholder' => 'Nama lengkap pelamar')) }}
                                        @if ($errors->has('nama'))
                                            <small style="color: red">{{ $errors->first('nama') }}</small>
                                        @endif
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="submit-field">
                                        <h5>Email</h5>
                                        {{ Form::email('email', null, array('class' => 'with-border', 'placeholder' => 'Email pelamar')) }}
                                        @if ($errors->has('email'))
                                            <small style="color: red">{{ $errors->first('email') }}</small>
                                        @endif
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="submit-field">
                                        <h5>No Telepon/Handphone</h5>
                                        {{ Form::text('notel', null, array('class' => 'with-border', 'maxlength' => '14', 'placeholder' => 'Nomor telepon/handphone pelamar')) }}
                                        @if ($errors->has('notel'))
                                            <small style="color: red">{{ $errors->first('notel') }}</small>
                                        @endif
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="submit-field">
                                        <div class="uploadButton">
                                            {{ Form::file('surat_penawaran', array('id' => 'surat_penawaran', 'class' => 'uploadButton-input', 'accept' => 'application/pdf')) }}
                                            <label class="uploadButton-button ripple-effect" for="surat_penawaran">Upload
                                                File</label>
                                            <span class="uploadButton-file-name penawaran">Upload Surat Penawaran, PDF, maksimal 200KB</span>
                                        </div>
                                        @if ($errors->has('surat_penawaran'))
                                            <small style="color: red">{{ $errors->first('surat_penawaran') }}</small>
                                        @endif
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="submit-field">
                                        <div class="uploadButton">
                                            {{ Form::file('pakta_integritas', array('id' => 'pakta_integritas', 'class' => 'uploadButton-input', 'accept' => 'application/pdf')) }}
                                            <label class="uploadButton-button ripple-effect" for="pakta_integritas">Upload
                                                File</label>
                                            <span class="uploadButton-file-name pakta">Upload Pakta Integritas, PDF, maksimal 200KB</span>
                                        </div>
                                        @if ($errors->has('pakta_integritas'))
                                            <small style="color: red">{{ $errors->first('pakta_integritas') }}</small>
                                        @endif
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="submit-field">
                                        <div class="uploadButton">
                                            {{ Form::file('formulir_kualifikasi', array('id' => 'formulir_kualifikasi', 'class' => 'uploadButton-input', 'accept' => 'application/pdf')) }}
                                            <label class="uploadButton-button ripple-effect" for="formulir_kualifikasi">Upload
                                                File</label>
                                            <span class="uploadButton-file-name kualifikasi">Upload Formulir Kualifikasi, PDF, maksimal 200KB</span>
                                        </div>
                                        @if ($errors->has('formulir_kualifikasi'))
                                            <small style="color: red">{{ $errors->first('formulir_kualifikasi') }}</small>
                                        @endif
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="submit-field">
                                        <div class="uploadButton">
                                            {{ Form::file('foto', array('id' => 'foto', 'class' => 'uploadButton-input', 'accept' => 'image/*')) }}
                                            <label class="uploadButton-button ripple-effect" for="foto">Upload
                                                File</label>
                                            <span class="uploadButton-file-name foto">Upload Foto, JPG/PNG, maksimal 200KB</span>
                                        </div>
                                        @if ($errors->has('foto'))
                                            <small style="color: red">{{ $errors->first('foto') }}</small>
                                        @endif
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="submit-field">
                                        <div class="uploadButton">
                                            {{ Form::file('ktp', array('id' => 'ktp', 'class' => 'uploadButton-input', 'accept' => 'image/*, application/pdf')) }}
                                            <label class="uploadButton-button ripple-effect" for="ktp">Upload
                                                File</label>
                                            <span class="uploadButton-file-name ktp">Upload Scan KTP, JPG/PNG/PDF, maksimal 200KB</span>
                                        </div>
                                        @if ($errors->has('ktp'))
                                            <small style="color: red">{{ $errors->first('ktp') }}</small>
                                        @endif
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="submit-field">
                                        <div class="uploadButton">
                                            {{ Form::file('ijazah', array('id' => 'ijazah', 'class' => 'uploadButton-input', 'accept' => 'image/*, application/pdf')) }}
                                            <label class="uploadButton-button ripple-effect" for="ijazah">Upload
                                                File</label>
                                            <span class="uploadButton-file-name ijazah">Upload Scan Ijazah, JPG/PNG/PDF, maksimal 500KB</span>
                                        </div>
                                        @if ($errors->has('ijazah'))
                                            <small style="color: red">{{ $errors->first('ijazah') }}</small>
                                        @endif
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="submit-field">
                                        <div class="uploadButton">
                                            {{ Form::file('transkrip', array('id' => 'transkrip', 'class' => 'uploadButton-input', 'accept' => 'image/*, application/pdf')) }}
                                            <label class="uploadButton-button ripple-effect" for="transkrip">Upload
                                                File</label>
                                            <span class="uploadButton-file-name transkrip">Upload Scan Transkrip Nilai, JPG/PNG/PDF, maksimal 500KB</span>
                                        </div>
                                        @if ($errors->has('transkrip'))
                                            <small style="color: red">{{ $errors->first('transkrip') }}</small>
                                        @endif
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="submit-field">
                                        <div class="uploadButton">
                                            {{ Form::file('sertifikat', array('id' => 'sertifikat', 'class' => 'uploadButton-input', 'accept' => 'image/*, application/pdf')) }}
                                            <label class="uploadButton-button ripple-effect" for="sertifikat">Upload
                                                File</label>
                                            <span class="uploadButton-file-name sertifikat">Upload Scan Sertifikat (JIKA ADA), digabung menjadi 1 PDF jika lebih dari satu, JPG/PNG/PDF, maksimal 3MB</span>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-xl-12 centered-button">
                                    <button type="submit" class="button ripple-effect big margin-top-30"><i
                                                class="icon-feather-plus"></i> Lamar
                                    </button>
                                    <p style="color:red">Perhatian! Pastikan formasi yang anda pilih sudah benar dan data diri beserta berkas yang anda inputkan sudah benar dan lengkap.</p>
                                </div>
                            </div>
                        </div>
                        {{ Form::close() }}
                    </div>
                @endif
                
            </div>
            <div class="col-lg-4">
                <div class="sidebar-container">
                    @if(!$vacdocs->isEmpty())
                    <!-- Sidebar Widget -->
                    <div class="sidebar-widget">
                        <div class="job-overview">
                            <div class="job-overview-inner">
                                <ul>
                                    <li>
                                        <i class="icon-material-outline-attach-file"></i>
                                        <span><strong>Download Dokumen Pendukung</strong></span>
                                        <hr>
                                        @foreach($vacdocs as $vacdoc)
                                            <h5><a href="{{ url('/uploads') . $vacdoc->document }}">{{ $vacdoc->title }}</a></h5>
                                            <hr>
                                        @endforeach
                                        <small style="color: red">silakan baca dan diisi dengan teliti</small>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </div>
        
    </div>

    

@endsection