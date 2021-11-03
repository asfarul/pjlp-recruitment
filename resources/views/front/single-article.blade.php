@extends('layouts.frontapp')

@section('title', $article->title)

@section('content')
<!-- Post Content -->
<div class="container margin-top-50">
    <div class="row">
        <!-- Inner Content -->
        <div class="col-xl-12 col-lg-12">
            <!-- Blog Post -->
            <div class="blog-post single-post">

                <!-- Blog Post Thumbnail -->
                <div class="blog-post-thumbnail">
                    <div class="blog-post-thumbnail-inner">
                        <span class="blog-item-tag">{{ $article->category }}</span>
                        <img src="{{ url('/uploads') . $article->image_header }}" height="100%" alt="">
                    </div>
                </div>

                <!-- Blog Post Content -->
                <div class="blog-post-content">
                    <h3 class="margin-bottom-10">{{ $article->title }}</h3>

                    <div class="blog-post-info-list margin-bottom-20">
                        <a href="#"
                            class="blog-post-info">{{ $article->created_at->formatLocalized('%A, %e %B %Y') }}</a>
                    </div>
                    {!! $article->content !!}
                </div>

                @if ($article->category == 'Rekrutmen')
              {{-- <div class="text-center mb-5" id="link-tautan-rekrutmen">
                    <h3 class="text-danger">PENDAFTARAN TELAH DITUTUP</h3>
                    <p>Terima kasih atas partisipasinya, silakan tunggu pengumuman berikutnya atau cek status pendaftaran Anda <a href="{{ route('front.pelamar.checkpage') }}">di sini.</a></p>
                </div>--}}
                <!-- Category Boxes Container -->
                <div class="categories-container" id="link-tautan-rekrutmen">

                    <!-- Plan -->
                    {{-- <div class="pricing-plan">
                        <h3>UMUM</h3>
                        <p class="margin-top-10">Diperuntukan untuk umum bagi yang ingin mendaftar sebagai penyedia
                            jasa orang lainnya. Pelajari dan <span style="color: red">baca dengan teliti Kerangka Acuan
                                Kerja</span>
                            <p>
                                <a href="{{ route('front.formasi.umum') }}" class="button full-width margin-top-20">
                                    DAFTAR SEKARANG</a>
                    </div> --}}

                    <!-- Plan -->
                    <div class="pricing-plan">
                        <h3>KHUSUS</h3>
                        <p class="margin-top-10">Diperuntukan untuk penyedia jasa orang lainnya yang memiliki
                            pengalaman kerja/berkontrak dengan pemerintah/Lembaga Daerah.</p>
                        <a href="{{ route('front.formasi.khusus') }}" class="button full-width margin-top-20">DAFTAR
                            SEKARANG</a>
                    </div>

                </div>
                @endif

            </div>
            <!-- Blog Post Content / End -->

            <!-- Blog Nav -->
            <ul id="posts-nav" class="margin-top-0 margin-bottom-40">
                @if($nextarticle)
                <li class="next-post">
                    <a href="{{ route('front.artikel.detail', Hashids::encode($nextarticle->id . '13579')) }}">
                        <span>Berita Selanjutnya</span>
                        <strong>{{ $nextarticle->title }}</strong>
                    </a>
                </li>
                @endif
                @if($prevarticle)
                <li class="prev-post">
                    <a href="{{ route('front.artikel.detail', Hashids::encode($prevarticle->id . '13579')) }}">
                        <span>Berita Sebelumnya</span>
                        <strong>{{ $prevarticle->title }}</strong>
                    </a>
                </li>

                @endif
            </ul>
        </div>
        <!-- Inner Content / End -->
    </div>
</div>

<!-- Spacer -->
<div class="padding-top-40"></div>
<!-- Spacer -->
@endsection