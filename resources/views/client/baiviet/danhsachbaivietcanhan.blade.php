<!-- header -->
@include("client.layouts.header")
<!-- end header -->
@stack("styles")

<!-- navbar -->
@include("client.layouts.navbar")
<style>
    /* Import font từ Google Fonts nếu bạn chưa có */
    @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap');

    /* Container cho nội dung slider */
    .hero-slider-content {
        text-align: right;
        /* ĐÂY LÀ ĐIỂM CHÍNH: Căn chỉnh chữ sang phải */
        position: relative;
        z-index: 2;
        /* Điều chỉnh các giá trị padding và max-width để chữ nằm đúng vị trí và không bị tràn */
        padding-top: 10%;
        /* Giữ nguyên hoặc điều chỉnh khoảng cách trên */
        padding-right: 5%;
        /* CHỈNH SỬA: Khoảng cách từ lề phải của banner */
        padding-left: 0;
        /* Đảm bảo không có padding thừa bên trái nếu bạn muốn nội dung dạt hẳn sang phải */
        margin-left: auto;
        /* Đẩy khối nội dung này sang phải nếu nó có max-width */
        max-width: 60%;
        /* Giới hạn chiều rộng của khối nội dung để chữ không bị quá dài trên một dòng */
        /* Bạn có thể cần điều chỉnh max-width và padding-right để phù hợp với banner cụ thể của bạn */
    }

    /* Tiêu đề chính */
    .hero-slider-content .slide-title {
        font-family: 'Inter', sans-serif;
        font-size: clamp(2.5rem, 5vw, 4.5rem);
        font-weight: 700;
        color: #2C3E50;
        line-height: 1.2;
        margin-bottom: 15px;
        max-width: 100%;
        /* Đảm bảo tiêu đề sử dụng hết chiều rộng của .hero-slider-content */
    }

    /* Phần span trong tiêu đề */
    .hero-slider-content .slide-title span {
        /* (Giữ nguyên hoặc điều chỉnh nếu cần) */
    }

    /* Mô tả */
    .hero-slider-content .slide-desc {
        font-family: 'Inter', sans-serif;
        font-size: clamp(1rem, 2vw, 1.5rem);
        font-weight: 400;
        color: #34495E;
        margin-bottom: 25px;
        max-width: 100%;
        /* Đảm bảo mô tả sử dụng hết chiều rộng của .hero-slider-content */
    }

    /* Nút bấm */
    .hero-slider-content .btn-hero {
        display: inline-block;
        font-family: 'Inter', sans-serif;
        font-size: 1rem;
        font-weight: 600;
        color: #2C3E50;
        background-color: #ECF0F1;
        padding: 12px 30px;
        border: none;
        border-radius: 5px;
        text-decoration: none;
        transition: background-color 0.3s ease;
    }

    .hero-slider-content .btn-hero:hover {
        background-color: #BDC3C7;
        cursor: pointer;
    }

    /* Update styling for blog meta to handle more elements */
    .blog-meta {
        display: flex;
        /* Để các phần tử nằm trên cùng một hàng */
        align-items: center;
        /* Căn giữa theo chiều dọc */
        flex-wrap: wrap;
        /* Cho phép các mục xuống dòng nếu không đủ chỗ */
        gap: 15px;
        /* Khoảng cách giữa các mục trong blog-meta */
        margin-bottom: 10px;
        /* Khoảng cách dưới blog-meta */
        font-size: 14px;
        color: #777;
    }

    .blog-meta p {
        margin: 0;
        /* Loại bỏ margin mặc định của thẻ p */
    }

    /* Styling for view count */
    .view-count {
        display: flex;
        align-items: center;
        gap: 5px;
        /* Khoảng cách giữa icon và số */
        color: #888;
        /* Màu chữ cho lượt xem */
    }

    .view-count i {
        font-size: 16px;
        /* Kích thước icon mắt */
    }
</style>
<!-- menu -->
<!-- header top end -->

<!-- header middle area start -->
<!-- menu -->
<!-- main menu navbar end -->
</div>
</div>
</div>
<!-- main menu area end -->

<!-- mini cart area start -->

<!-- mini cart area end -->

</div>
</div>
</div>
<!-- header middle area end -->
</div>
<!-- main header start -->

<!-- mobile header start -->
<!-- mobile header start -->
<div class="mobile-header d-lg-none d-md-block sticky">
    <!--mobile header top start -->
    <div class="container-fluid">
        <div class="row align-items-center">
            <div class="col-12">
                <div class="mobile-main-header">
                    <div class="mobile-logo">
                        <a href="index.html">
                            <img src="assets/img/logo/logo.png" alt="Brand Logo" width="110px">
                        </a>
                    </div>
                    <div class="mobile-menu-toggler">
                        <div class="mini-cart-wrap">
                            <!-- <a href="cart.html">
                                        <i class="pe-7s-shopbag"></i>
                                        <div class="notification">0</div>
                                    </a> -->
                        </div>
                        <button class="mobile-menu-btn">
                            <span></span>
                            <span></span>
                            <span></span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- mobile header top start -->
</div>
<!-- mobile header end -->
<!-- mobile header end -->

<!-- offcanvas mobile menu start -->
<!-- off-canvas menu start -->
<aside class="off-canvas-wrapper">
    <div class="off-canvas-overlay"></div>
    <div class="off-canvas-inner-content">
        <div class="btn-close-off-canvas">
            <i class="pe-7s-close"></i>
        </div>

        <div class="off-canvas-inner">
            <!-- search box start -->
            <div class="search-box-offcanvas">
                <form>
                    <input type="text" placeholder="Search Here...">
                    <button class="search-btn"><i class="pe-7s-search"></i></button>
                </form>
            </div>
            <!-- search box end -->

            <!-- mobile menu start -->
            <div class="mobile-navigation">

                <!-- mobile menu navigation start -->

                <!-- mobile menu navigation end -->
            </div>
            <!-- mobile menu end -->



            <!-- offcanvas widget area start -->
            <div class="offcanvas-widget-area">
                <div class="off-canvas-contact-widget">
                    <ul>
                        <li><i class="fa fa-mobile"></i>
                            <a href="#">0123456789</a>
                        </li>
                        <li><i class="fa fa-envelope-o"></i>
                            <a href="#">info@yourdomain.com</a>
                        </li>
                    </ul>
                </div>
                <div class="off-canvas-social-widget">
                    <a href="#"><i class="fa fa-facebook"></i></a>
                    <a href="#"><i class="fa fa-twitter"></i></a>
                    <a href="#"><i class="fa fa-pinterest-p"></i></a>
                    <a href="#"><i class="fa fa-linkedin"></i></a>
                    <a href="#"><i class="fa fa-youtube-play"></i></a>
                </div>
            </div>
            <!-- offcanvas widget area end -->
        </div>
    </div>
</aside>
<!-- off-canvas menu end -->
<!-- offcanvas mobile menu end -->
</header>
<!-- end Header Area -->


<main>
    <!-- hero slider area start -->
    <section class="slider-area">
        <div class="hero-slider-active slick-arrow-style slick-arrow-style_hero slick-dot-style">
            <!-- single slider item start -->

        </div>
    </section>
    <!-- hero slider area end -->


    <!-- blog main wrapper start -->
    <div class="blog-main-wrapper section-padding">
        <div class="container">
            <div class="row">
                @if(session('success'))
                    <p class="alert alert-success">{{ session('success') }}</p>
                @endif

                @if(session('error'))
                    <p class="alert alert-danger">{{ session('error') }}</p>
                @endif
                <div class="col-lg-9 order-1 order-lg-2">
                    <h2 class="mb-4">Bài viết của tôi</h2>
                    <div class="blog-item-wrapper blog-list-inner">
                        <div class="row mbn-30">

                            @foreach($baiViets as $baiViet)
                                <div class="col-12">
                                    <div class="blog-post-item mb-30">
                                        <div class="post-options position-relative"
                                            style="float: right; position: absolute; top: 10px; right: 10px; z-index: 10;">
                                            <button class="btn btn-light btn-sm dropdown-toggle" type="button"
                                                data-bs-toggle="dropdown" aria-expanded="false">
                                                <i class="fa fa-ellipsis-v"></i>
                                            </button>
                                            <ul class="dropdown-menu dropdown-menu-end">
                                                <li><a class="dropdown-item"
                                                        href="{{ route('baiviet.edit', $baiViet->id) }}">Sửa bài viết</a>
                                                </li>
                                                <li>
                                                    <form action="{{ route('baiviet.destroy', $baiViet->id) }}"
                                                        method="POST"
                                                        onsubmit="return confirm('Bạn có chắc chắn muốn xóa bài viết này không?')">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button class="dropdown-item text-danger" type="submit">Xóa bài
                                                            viết</button>
                                                    </form>
                                                </li>
                                            </ul>
                                        </div>
                                        <figure class="blog-thumb">
                                            <a
                                                href="{{ route('chitietbaiviet', ['slug' => $baiViet->slug, 'id' => $baiViet->id]) }}">
                                                <img src="{{ asset('storage/' . $baiViet->thumbnail) }}" alt="blog image">
                                            </a>
                                        </figure>
                                        <div class="blog-content">
                                            <div class="blog-author-info">
                                                <img src="{{ asset('storage/' . ($baiViet->user?->avatar)) }} "
                                                    alt="Avatar Tác Giả" class="author-avatar"
                                                    onerror="this.onerror=null; this.src='https://icon-library.com/images/icon-user/icon-user-15.jpg'"
                                                    width="5%">
                                                <span class="author-name">{{ $baiViet->user->name }}</span>
                                                <span class="">
                                                Trạng thái: 
                                                {{ 
                                                    $baiViet->status == 'published' ? 'Đã đăng' : 
                                                    ($baiViet->status == 'refuse' ? 'Từ chối' : 'Chờ phê duyệt') 
                                                }}
                                            </span>

                                            </div>
                                            <h4 class="blog-title">
                                                <a
                                                    href="{{ route('chitietbaiviet', ['slug' => $baiViet->slug, 'id' => $baiViet->id]) }}">{{ $baiViet->title }}</a>
                                            </h4>
                                            <div class="blog-meta">
                                                <p>{{ $baiViet->created_at?->format("d/m/Y") ?? 'Chưa có ngày' }} | <a
                                                        href="#">Corano</a></p>
                                           
                                                <span class="view-count">
                                                    <i class="fa fa-eye"></i> {{ $baiViet->view_count }} lượt xem
                                                </span>
                                               
                                            </div>
                                            <p>{{ Str::words(strip_tags($baiViet->content), 30, '...') }}</p>
                                            <a class="{{ route('chitietbaiviet', ['slug' => $baiViet->slug, 'id' => $baiViet->id]) }}"
                                                href="blog-details.html">Đọc thêm...</a>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        {{ $baiViets->links('pagination::bootstrap-5') }}
                        @if($baiViets->isEmpty())
                            <p class="alert alert-warning">Bạn chưa có bài viết nào</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- blog main wrapper end -->
</main>

<!-- Scroll to top start -->


<!-- foote -->
@include("client.layouts.footer")

<!-- Page specific script -->

<!-- Code injected by live-server -->
@stack("scripts")