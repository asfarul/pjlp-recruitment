<!-- Main Sidebar -->
<div id="sidebar">
    <!-- Wrapper for scrolling functionality -->
    <div id="sidebar-scroll">
        <!-- Sidebar Content -->
        <div class="sidebar-content">
            <!-- Brand -->
            <a href="{{ route('dashboard') }}" class="sidebar-brand">
                <img src="{{ asset('img/logo-white.png') }}" height="28">
            </a>
            <!-- END Brand -->

            <!-- User Info -->
            <div class="sidebar-section sidebar-user clearfix sidebar-nav-mini-hide">
                <div class="sidebar-user-avatar">
                    <a href="page_ready_user_profile.html">
                        <img src="{{ asset('assets/img/placeholders/avatars/avatar2.jpg') }}" alt="avatar">
                    </a>
                </div>
                <div class="sidebar-user-name">{{ Auth::user()->name }}</div>
                <div class="sidebar-user-links">
                    <a href="page_ready_user_profile.html" data-toggle="tooltip" data-placement="bottom"
                       title="Profile"><i class="gi gi-user"></i></a>
                    <a href="#" data-toggle="tooltip" data-placement="bottom" title="Logout"
                       onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i
                            class="gi gi-exit"></i></a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        {{ csrf_field() }}
                    </form>
                </div>
            </div>
            <!-- END User Info -->

            <!-- Sidebar Navigation -->
            <ul class="sidebar-nav">
                <li class="sidebar-header">
                    <span class="sidebar-header-title">Main Navigation</span>
                </li>
            </ul>
        {!! $Menu->asUl(['class' => 'sidebar-nav']) !!}
        <!-- END Sidebar Navigation -->
        </div>
        <!-- END Sidebar Content -->
    </div>
    <!-- END Wrapper for scrolling functionality -->
</div>
<!-- END Main Sidebar -->
