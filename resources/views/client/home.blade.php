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
    text-align: right; /* ĐÂY LÀ ĐIỂM CHÍNH: Căn chỉnh chữ sang phải */
    position: relative;
    z-index: 2;
    /* Điều chỉnh các giá trị padding và max-width để chữ nằm đúng vị trí và không bị tràn */
    padding-top: 10%; /* Giữ nguyên hoặc điều chỉnh khoảng cách trên */
    padding-right: 5%; /* CHỈNH SỬA: Khoảng cách từ lề phải của banner */
    padding-left: 0; /* Đảm bảo không có padding thừa bên trái nếu bạn muốn nội dung dạt hẳn sang phải */
    margin-left: auto; /* Đẩy khối nội dung này sang phải nếu nó có max-width */
    max-width: 60%; /* Giới hạn chiều rộng của khối nội dung để chữ không bị quá dài trên một dòng */
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
    max-width: 100%; /* Đảm bảo tiêu đề sử dụng hết chiều rộng của .hero-slider-content */
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
    max-width: 100%; /* Đảm bảo mô tả sử dụng hết chiều rộng của .hero-slider-content */
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
    display: flex; /* Để các phần tử nằm trên cùng một hàng */
    align-items: center; /* Căn giữa theo chiều dọc */
    flex-wrap: wrap; /* Cho phép các mục xuống dòng nếu không đủ chỗ */
    gap: 15px; /* Khoảng cách giữa các mục trong blog-meta */
    margin-bottom: 10px; /* Khoảng cách dưới blog-meta */
    font-size: 14px;
    color: #777;
}

.blog-meta p {
    margin: 0; /* Loại bỏ margin mặc định của thẻ p */
}

/* Styling for view count */
.view-count {
    display: flex;
    align-items: center;
    gap: 5px; /* Khoảng cách giữa icon và số */
    color: #888; /* Màu chữ cho lượt xem */
}

.view-count i {
    font-size: 16px; /* Kích thước icon mắt */
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
                                    <img src="assets/img/logo/logo.png" alt="Brand Logo" >
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
                <div class="hero-single-slide hero-overlay">
                    <div class="hero-slider-item bg-img" data-bg="{{  asset('client/assets/img/slider/banner-home.png') }}">
                        <div class="container">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="hero-slider-content slide-1">
                                        <h2 class="slide-title">Viết bài  <span></span></h2>
                                        <h4 class="slide-desc">Chia sẻ tri thức - kinh nghiệm và trải nghiệm của bạn</h4>
                                        <a href="{{ route('formDangBai') }}" class="btn btn-hero">Đăng bài viết</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
            </div>
        </section>
        <!-- hero slider area end -->


        <!-- blog main wrapper start -->
        <div class="blog-main-wrapper section-padding">
    <div class="container">
        <div class="row">
            <div class="col-lg-3 order-2 order-lg-1">
                <aside class="blog-sidebar-wrapper">
                    <div class="blog-sidebar">
                        <h5 class="title"></h5>
                        <div class="sidebar-serch-form">

                        </div>
                    </div>
                    <div class="blog-sidebar">
                        <h5 class="title">Danh mục</h5>
                        @if($danhMucs->count() > 0)
                        <ul class="blog-archive blog-category">
                            <li>
                                <a href="#" class="category-filter" data-category="all">Tất cả</a>
                            </li>
                            @foreach ( $danhMucs as $danhMuc )
                            <li >
                            <a href="#" class="category-filter" data-category="{{ $danhMuc->id }}">{{ $danhMuc->name }}  ({{ $danhMuc->posts()->where('status', 'published')->count() }})
                            </a>
                            </li>
                            @endforeach
                            {{ $danhMucs->links() }}
                        </ul>
                        @endif
                    </div>
                     <div class="blog-sidebar">
                        <!-- <h5 class="title">Từ khóa được tìm kiếm nhiều nhất</h5>
                        <ul class="blog-archive">
                            <li><a href="#">January (10)</a></li>
                            <li><a href="#">February (08)</a></li>
                            <li><a href="#">March (07)</a></li>
                            <li><a href="#">April (14)</a></li>
                            <li><a href="#">May (10)</a></li>
                        </ul> -->
                        <div class="blog-sidebar">
                                <h5 class="title">Bài viết được xem nhiều nhất</h5>
                                <div class="recent-post">
                                    @foreach ($baiVietXemNhieus as $baiVietXemNhieu)
                                    <div class="recent-post-item">
                                        <figure class="product-thumb">
                                            <a href="{{ route('chitietbaiviet',['slug' => $baiVietXemNhieu->slug, 'id' => $baiVietXemNhieu->id]) }}">
                                                <img src="{{ asset('storage/' . $baiVietXemNhieu->thumbnail) }}" alt="blog image">
                                            </a>
                                        </figure>
                                        <div class="recent-post-description">
                                            <div class="product-name">
                                                <h6><a href="{{ route('chitietbaiviet',['slug' => $baiVietXemNhieu->slug, 'id' => $baiVietXemNhieu->id]) }}">{{ $baiVietXemNhieu->title }}</a></h6>
                                                <p>{{ $baiVietXemNhieu->created_at->format('d/m/Y') }}</p>
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                            </div> <!-- single sidebar end -->
                        <h5 class="title">Tags</h5>
                        <ul class="blog-tags">
                            @foreach ($tags as $tag )
                            <li><a href="{{ route('fillterTag', $tag->slug) }}">{{ $tag->name }}</a></li>
                            @endforeach
                        </ul>
                    </div> </aside>
            </div>
            <div class="col-lg-9 order-1 order-lg-2">
                <div class="blog-item-wrapper blog-list-inner" id="blog-posts-container">
                    <div class="row mbn-30">
                        
                        @foreach($baiVietNguoidungs as  $baiVietNguoidung)
                        <div class="col-12">
                            <div class="blog-post-item mb-30">
                                <figure class="blog-thumb">
                                    <a href="{{ route('chitietbaiviet',['slug' => $baiVietNguoidung->slug, 'id' => $baiVietNguoidung->id]) }}">
                                        <img src="{{ asset('storage/' . $baiVietNguoidung->thumbnail) }}" alt="blog image">
                                    </a>
                                </figure>
                                <div class="blog-content">
                                    <div class="blog-author-info">
                                    <img src="{{ asset('storage/' . ($baiVietNguoidung->user?->avatar)) }}"
                                         alt="Avatar Tác Giả"
                                         class="author-avatar"
                                         onerror="this.onerror=null; this.src='https://icon-library.com/images/icon-user/icon-user-15.jpg'"
                                         style="width:40px; height:40px; border-radius:50%; object-fit:cover;">
                                        <span class="author-name">{{ $baiVietNguoidung->user->name }}</span>
                                    </div> 
                                    <h4 class="blog-title">
                                        <a href="{{ route('chitietbaiviet',['slug' => $baiVietNguoidung->slug, 'id' => $baiVietNguoidung->id]) }}">{{ $baiVietNguoidung->title }}</a>
                                    </h4>
                                    <div class="blog-meta">
                                    <p>{{ $baiVietNguoidung->created_at?->format("d/m/Y") ?? 'Chưa có ngày' }} | <a href="#">Corano</a></p>
                                        <!-- <span class="favorite-icon" title="Thêm vào yêu thích">
                                            <i class="fa fa-heart-o"></i> Yêu thích
                                        </span> -->
                                        <span class="view-count">
                                            <i class="fa fa-eye"></i> {{ $baiVietNguoidung->view_count }} lượt xem
                                        </span>
                                    </div>
                                    <p>{{ Str::words(strip_tags(html_entity_decode($baiVietNguoidung->content)), 30, '...') }}</p>

                                    <a href="{{ route('chitietbaiviet',['slug' => $baiVietNguoidung->slug, 'id' => $baiVietNguoidung->id]) }}">Đọc thêm...</a>
                                </div>
                            </div>
                            </div>
                            @endforeach
                    </div>
                    {{ $baiVietNguoidungs->links() }}
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
<style>
.category-filter.active {
    color: #007bff !important;
    font-weight: bold;
    text-decoration: underline;
}
</style>
<script>
// AJAX filter cho danh mục
document.addEventListener('DOMContentLoaded', function() {
    const categoryFilters = document.querySelectorAll('.category-filter');
    const blogContainer = document.getElementById('blog-posts-container');
    
    categoryFilters.forEach(filter => {
        filter.addEventListener('click', function(e) {
            e.preventDefault();
            
            // Remove active class from all filters
            categoryFilters.forEach(f => f.classList.remove('active'));
            // Add active class to clicked filter
            this.classList.add('active');
            
            const categoryId = this.getAttribute('data-category');
            
            // Show loading
            blogContainer.innerHTML = '<div class="text-center"><i class="fa fa-spinner fa-spin fa-3x"></i><p>Đang tải...</p></div>';
            
            // Send AJAX request
            fetch(`{{ route('filter.category') }}?category_id=${categoryId}`, {
                method: 'GET',
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'Accept': 'application/json'
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    blogContainer.innerHTML = data.html;
                    
                    // Update pagination if needed
                    if (data.pagination) {
                        // You can add pagination handling here if needed
                    }
                } else {
                    blogContainer.innerHTML = '<div class="alert alert-warning">Không có bài viết nào trong danh mục này.</div>';
                }
            })
            .catch(error => {
                console.error('Error:', error);
                blogContainer.innerHTML = '<div class="alert alert-danger">Có lỗi xảy ra khi tải dữ liệu.</div>';
            });
        });
    });
});
</script>

<!-- Code injected by live-server -->
@stack("scripts")