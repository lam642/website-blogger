<!-- header -->
@include("client.layouts.header")
<!-- end header -->
@stack("styles")

<!-- navbar -->
@include("client.layouts.navbar")
<style>
.highlight {
    background-color: yellow;
    font-weight: bold;
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
                    @if(!empty($tuKhoaTimKiem))
                        <h5 class="title">Từ khóa tìm kiếm: "{{ $tuKhoaTimKiem }}"</h5>
                    @elseif(!empty($tagTimKiem))
                        <h5 class="title">Kết quả theo thẻ: "{{ $tagTimKiem }}"</h5>
                    @endif

                        </ul>
                    </div> </aside>
            </div>
            <div class="col-lg-9 order-1 order-lg-2">
                <div class="blog-item-wrapper blog-list-inner">
                    <div class="row mbn-30">
                        @if($baiVietTimKiems->count() > 0)
                        @foreach($baiVietTimKiems as  $baiVietTimKiem)
                        <div class="col-12">
                            <div class="blog-post-item mb-30">
                                <figure class="blog-thumb">
                                    <a href="{{ route('chitietbaiviet',['slug' => $baiVietTimKiem->slug, 'id' => $baiVietTimKiem->id]) }}">
                                        <img src="{{ asset('storage/' . $baiVietTimKiem->thumbnail) }}" alt="blog image">
                                    </a>
                                </figure>
                                <div class="blog-content">
                                    <div class="blog-author-info">
                                    <img src="{{ asset('storage/' . ($baiVietTimKiem->user?->avatar)) }} " alt="Avatar Tác Giả" class="author-avatar"   onerror="this.onerror=null; this.src='https://icon-library.com/images/icon-user/icon-user-15.jpg'" width="5%" >
                                        <span class="author-name">{{ $baiVietTimKiem->user->name }}</span>
                                    </div> 
                                 <h4 class="blog-title">
                                    <a href="{{ route('chitietbaiviet', ['slug' => $baiVietTimKiem->slug, 'id' => $baiVietTimKiem->id]) }}">
                                        {!! !empty($tuKhoaTimKiem) && stripos($baiVietTimKiem->title, $tuKhoaTimKiem) !== false
                                            ? preg_replace('/' . preg_quote($tuKhoaTimKiem, '/') . '/i', '<span class="highlight">$0</span>', e($baiVietTimKiem->title))
                                            : e($baiVietTimKiem->title) !!}
                                    </a>
                                </h4>

                                    <div class="blog-meta">
                                    <p>{{ $baiVietTimKiem->created_at?->format("d/m/Y") ?? 'Chưa có ngày' }} | <a href="#">Corano</a></p>
                                  
                                        <span class="view-count">
                                            <i class="fa fa-eye"></i> {{ $baiVietTimKiem->view_count }} lượt xem
                                        </span>
                                    </div>
                                    <p>{{ Str::words(strip_tags($baiVietTimKiem->content), 30, '...') }}</p>
                                    <a class="blog-read-more" href="blog-details.html">Đọc thêm...</a>
                                </div>
                            </div>
                            </div>
                        @endforeach
                    </div>
                    {{ $baiVietTimKiems->links() }}
                    </div>
                    @else
                     <p>
                        @if(!empty($tuKhoaTimKiem))
                            Không tìm thấy bài viết nào phù hợp với từ khóa "{{ $tuKhoaTimKiem }}".
                        @elseif(!empty($tagTimKiem))
                            Không tìm thấy bài viết nào phù hợp với thẻ "{{ $tagTimKiem }}".
                        @else
                            Không tìm thấy bài viết nào.
                        @endif
                    </p>
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