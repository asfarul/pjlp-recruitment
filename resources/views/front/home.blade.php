@extends('layouts.frontapp')

@section('title', 'Beranda')

@section('banner')
    <!-- Intro Banner
        ================================================== -->
    <div class="intro-banner dark-overlay" data-background-image="{{ asset('template/images/header-background.png') }}">

        <!-- Transparent Header Spacer -->
        <div class="transparent-header-spacer"></div>

        <div class="container">

            <!-- Intro Headline -->
            <div class="row">
                <div class="col-md-12">
                    <div class="banner-headline">
                        <h3>
                            <strong style="font-size: 30pt">Pemerintah Kota Pontianak</strong>
                            <br>
                            <span style="font-size: 15pt">Halaman resmi perekrutan Penyedia Jasa Lainnya Orang Perorangan.</span>
                        </h3>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('content')

    <!-- Content ================================================== -->
        <!-- Article -->
        <div class="section padding-top-65 padding-bottom-50">
            <div class="container">
                <div class="row">
                    <div class="col-xl-12">

                        <!-- Section Headline -->
                        <div class="section-headline margin-top-0 margin-bottom-45">
                            <h3>Berita Terbaru</h3>
                            {{-- <a href="pages-blog.html" class="headline-link">Selengkapnya</a> --}}
                        </div>

                        <div class="row justify-content-center">
                        @foreach($articles as $article)
                            <!-- Article Post Item -->
                                <div class="col-xl-4">
                                    <a href="{{ route('front.artikel.detail', Hashids::encode($article->id . '13579')) }}"
                                       class="blog-compact-item-container">
                                        <div class="blog-compact-item">
                                            <img src="{{ url('/uploads') . $article->image_header }}" alt="">
                                            <span class="blog-item-tag">{{ $article->category }}</span>
                                            <div class="blog-compact-item-content">
                                                <ul class="blog-post-tags">
                                                    <li>{{ $article->created_at->formatLocalized('%A,   %e %B %Y') }}</li>
                                                </ul>
                                                <h3>{{ str_limit($article->title, $limit = 60, $end = '...') }}</h3>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                                <!-- Article post Item / End -->
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Article / End -->

    <!-- Section -->
    <div class="photo-section" data-background-image="{{ asset('template/images/section-background.png') }}">

        <!-- Infobox -->
        <div class="text-content white-font">
            <div class="container">

                <div class="row">
                    <div class="col-lg-6 col-md-8 col-sm-12">
                        <h2>Kesempatan Berkarir</h2>
                        <p>
                            Pemerintah Kota Pontianak Memberikan kesempatan kepada putra – putri terbaik
                            Kota Pontianak untuk bekerja di lingkungan pemerintah kota. Melalui pengalaman dan bukti
                            nyata melayani masyarakat Pontianak, inilah kesempatanmu untuk ikut memajukan Kota
                            Pontianak.
                        </p>
                    </div>
                    <div class="col-lg-6 col-md-4 col-sm-12">
                        <div class="counters-container">

                            <!-- Counter -->
                            <div class="single-counter">
                                <div class="counter-inner">
                                    <h3><span class="counter">{{ $countCan }}</span></h3>
                                    <span class="counter-title text-white">Pelamar</span>
                                </div>
                            </div>
                            <!-- Counter -->
                            <div class="single-counter">
                                <a href="{{ route('front.formasi.detail') }}"
                                   class="button button-sliding-icon ripple-effect big margin-top-20">Lihat lebih detail <i
                                            class="icon-material-outline-arrow-right-alt"></i></a>
                            </div>
    
                        </div>
                    </div>
                </div>

            </div>
        </div>
        <!-- Infobox / End -->

    </div>
    <!-- Section / End -->

    {{-- <div class="section padding-top-70 padding-bottom-70">
        <div class="container">
            <div class="row">
                <div class="col-xl-12">
                    <div class="counters-container">

                        <!-- Counter -->
                        <div class="single-counter">
                            <i class="icon-line-awesome-user"></i>
                            <div class="counter-inner">
                                <h3><span class="counter">{{ $countCan }}</span></h3>
                                <span class="counter-title">Pelamar</span>
                            </div>
                        </div>

                        <!-- Counter -->
                        <div class="single-counter">
                            <a href="{{ route('front.formasi.detail') }}"
                               class="button button-sliding-icon ripple-effect big margin-top-20">Lihat lebih detail <i
                                        class="icon-material-outline-arrow-right-alt"></i></a>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div> --}}
@endsection