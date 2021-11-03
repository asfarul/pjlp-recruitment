<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Cetak Kartu</title>
    <link rel="stylesheet" href="{{ asset('template/css/print.css') }}">
</head>

<body>

<!-- Print Button -->
<div class="print-button-container">
    <a href="javascript:window.print()" class="print-button">Cetak Kartu</a>
</div>

<div id="candidatecard">

    <!-- Header -->
    <div class="row">
        <div class="col-xl-12" style="text-align: center">
            <img src="{{ asset('template/images/logo.png') }}" alt="Pemerintah Kota Pontianak" width="80px">
        </div>
        <div class="col-xl-12" style="text-align: center">
            <h4>PEMERINTAH KOTA PONTIANAK</h4>
        </div>
    </div>

    <div style="margin-top: 50px"></div>

    <div class="row">
        <div class="col-xl-6">
            <div class="avatar-wrapper" data-tippy-placement="bottom"
                 title="{{ $candidate->nama }}">
                <img class="profile-pic" src="{{ url('/uploads') . $candidate->foto }}" alt="$candidate->nama" width="120px"/>
            </div>
        </div>
        <div class="col-xl-6">
            <p id="details">
                <strong>NO PENDAFTARAN:</strong> #CPJLP{{ $candidate->id }} <br>
            </p>
        </div>
    </div>

    <div class="row">
        <div class="col-xl-12">
            <h2>
                {{ $candidate->nama }}
                <br>
                <span style="font-size: 15pt">{{ $candidate->title }}</span>
            </h2>
        </div>

        <div class="col-xl-6" style="margin-top: -20px">
            <p>
                NIK: {{ $candidate->nik }}<br>
                Email: {{ $candidate->email }}<br>
                No Telp: {{ $candidate->notel }}<br>
            </p>
        </div>
    </div>

    <!-- Footer -->
    <div class="row" style="margin-top: -80px">
        <div class="col-xl-12">
            <ul id="footer">
                <li><span>pjlp.pontianakkota.go.id</span></li>
                <li>Pemerintah Kota Pontianak</li>
                <li>Jl. Rahadi Usman no.3 Kota Pontianak</li>
            </ul>
        </div>
    </div>

</div>


</body>
</html>
