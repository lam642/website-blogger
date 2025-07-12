<body>
    <!-- Start Header Area -->
    <header class="header-area header-wide">
        <!-- main header start -->
        <div class="main-header d-none d-lg-block">
            <!-- header top start -->
            <div class="header-top bdr-bottom">
                <div class="container">
                    <div class="row align-items-center">
                        <div class="col-lg-6">
                            <div class="welcome-message">
                                <p>Welcome blogger</p>
                            </div>
                        </div>

                    </div>
                </div>
            </div>

            <div class="header-main-area sticky">
                <div class="container">
                    <div class="row align-items-center position-relative">

                        <!-- start logo area -->
                        <div class="col-lg-2">
                            <div class="logo">
                                <a href="{{ route('home') }}">
                                    <img src="{{ asset('client/assets/img/logo/logo.png') }}" alt="Brand Logo" width="110px">
                                </a>
                            </div>
                        </div>
                        <!-- start logo area -->

                        <!-- main menu area start -->
                        <div class="col-lg-6 position-static">
                            <div class="main-menu-area">
                                <div class="main-menu">
                                    <!-- main menu navbar start -->
                                    <nav class="desktop-menu">
                                        <ul>
                                            <li class="active"><a href="{{ route('home') }}">Trang chủ </a></li>
                                            <li><a href="{{ route('lienHe') }}">Liên hệ</a></li>
                                        </ul>
                                    </nav>
                                                                    </div>
                            </div>
                        </div>
                        <!-- main menu area end -->

                        <!-- mini cart area start -->
                        <div class="col-lg-4">
                            <div class="header-right d-flex align-items-center justify-content-xl-between justify-content-lg-end">
                                <div class="header-search-container">
                                    <button class="search-trigger d-xl-none d-lg-block"><i class="pe-7s-search"></i></button>
                                    <form class="header-search-box d-lg-none d-xl-block" method="get" action="{{ route('search') }}">
                                        <input type="text" placeholder="Search entire store hire" class="header-search-field" name="search" value="{{ request()->input('search') }}">
                                        <button class="header-search-btn"><i class="pe-7s-search"></i></button>
                                    </form>
                                </div>
                                <div class="header-configure-area">
                                    <ul class="nav justify-content-end">
                                        <li class="user-hover">
                                           <span>Xin chào {{ auth()->check() ? auth()->user()->name : '' }}</span>
                                            <a href="#">
                                                <i class="pe-7s-user"></i>
                                            </a>
                                            <ul class="dropdown-list">
                                                @if(Auth::check())
                                                    <li><a href="{{ route('taikhoan') }}">Tài khoản</a></li>
                                                    <li><a href="{{ route('danhSachCaNhan') }}"> bài viết</a></li>
                                                    <li><a href="{{ route('danhSachDaLuu') }}"> Đã lưu</a></li>
                                                    <li><a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Đăng xuất</a></li>
                                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                                        @csrf
                                                    </form>
                                                    @else
                                                <li><a href="{{ route('login') }}">Đăng nhập</a></li>
                                                <li><a href="{{ route('register') }}">Đăng ký</a></li>
                                                @endif
                                            </ul>
                                        </li>
                                        <li>
                                            <!-- <a href="wishlist.html">
                                                <i class="pe-7s-like"></i>
                                                <div class="notification">0</div>
                                            </a> -->
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <!-- mini cart area end -->

                    </div>
                </div>
            </div>