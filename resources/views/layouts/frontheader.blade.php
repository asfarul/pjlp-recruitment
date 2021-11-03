<!-- Header Container ================================================== -->
<header id="header-container" class="fullwidth{{ (\Request::is('/')) ? " transparent-header" : "" }}">

    <!-- Header -->
    <div id="header">
        <div class="container">

            <!-- Left Side Content -->
            <div class="left-side">

                <!-- Logo -->
                <div id="logo">
                    <a href="{{ url('/') }}"><img src="{{ asset('template/images/logo.png') }}" data-sticky-logo="{{ asset('template/images/logo.png') }}"
                                              data-transparent-logo="{{ asset('template/images/logo.png') }}" alt=""></a>
                </div>

                <!-- Main Navigation -->
                <nav id="navigation">
                    <ul id="responsive">
                        <li class="margin-top-2"><a href="{{ url('/') }}" class="current">Beranda</a></li>
                        {{--<li class="margin-top-2"><a href="#" class="current">Berita</a></li>--}}
                        <li>
                            <a href="{{ url('/') }}" class="current">Karir</a>
                            <ul class="dropdown-nav">
                                <li><a href="{{ route('front.pelamar.checkpage') }}">Cek Status</a></li>
                            </ul>
                        </li>
                    </ul>
                </nav>
                <div class="clearfix"></div>
                <!-- Main Navigation / End -->

            </div>
            <!-- Left Side Content / End -->

            <!-- Right Side Content / End -->
            <div class="right-side">
                <!-- Mobile Navigation Button -->
                <span class="mmenu-trigger">
					<button class="hamburger hamburger--collapse" type="button">
						<span class="hamburger-box">
							<span class="hamburger-inner"></span>
						</span>
					</button>
				</span>

            </div>
            <!-- Right Side Content / End -->

        </div>
    </div>
    <!-- Header / End -->

</header>
<div class="clearfix"></div>
<!-- Header Container / End -->