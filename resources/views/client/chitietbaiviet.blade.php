<!-- header -->
@include("client.layouts.header")
@include("client.layouts.navbar")
<!-- end header -->

@section('head')
    <meta property="og:title" content="{{ $baiViet->title }}">
    <meta property="og:description" content="{{ Str::limit(strip_tags($baiViet->content), 100) }}">
    <meta property="og:image" content="{{ asset('storage/' . $baiViet->thumbnail) }}">
    <meta property="og:url" content="{{ route('chitietbaiviet', ['slug' => $baiViet->slug, 'id' => $baiViet->id]) }}">
    <meta property="og:type" content="article">
@endsection

@push('styles')
<style>
    /* Styles cho form báo cáo bình luận */
    .comment-report-form {
        animation: slideDown 0.3s ease-out;
        border-left: 4px solid #dc3545 !important;
    }

    .comment-report-form form {
        background: linear-gradient(135deg, #fff5f5 0%, #ffe6e6 100%);
        border: 1px solid #ffcccc;
        box-shadow: 0 2px 8px rgba(220, 53, 69, 0.1);
    }

    .comment-report-form .form-label {
        color: #dc3545;
        font-size: 0.9rem;
    }

    .comment-report-form textarea {
        border: 1px solid #ffcccc;
        transition: border-color 0.3s ease;
    }

    .comment-report-form textarea:focus {
        border-color: #dc3545;
        box-shadow: 0 0 0 0.2rem rgba(220, 53, 69, 0.25);
    }

    .comment-report-form .btn-danger {
        background: linear-gradient(45deg, #dc3545, #c82333);
        border: none;
        transition: all 0.3s ease;
    }

    .comment-report-form .btn-danger:hover {
        background: linear-gradient(45deg, #c82333, #bd2130);
        transform: translateY(-1px);
        box-shadow: 0 4px 8px rgba(220, 53, 69, 0.3);
    }

    .comment-report-form .btn-secondary {
        background: linear-gradient(45deg, #6c757d, #5a6268);
        border: none;
        transition: all 0.3s ease;
    }

    .comment-report-form .btn-secondary:hover {
        background: linear-gradient(45deg, #5a6268, #495057);
        transform: translateY(-1px);
    }

    /* Animation cho form */
    @keyframes slideDown {
        from {
            opacity: 0;
            transform: translateY(-10px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    /* Responsive design */
    @media (max-width: 768px) {
        .comment-report-form {
            margin: 10px 0;
        }
        
        .comment-report-form .d-flex {
            flex-direction: column;
        }
        
        .comment-report-form .d-flex .btn {
            margin-bottom: 5px;
        }
    }

    /* Notification styles */
    .alert {
        border-radius: 8px;
        border: none;
        font-weight: 500;
    }

    .alert-success {
        background: linear-gradient(135deg, #d4edda 0%, #c3e6cb 100%);
        color: #155724;
        border-left: 4px solid #28a745;
    }

    .alert-danger {
        background: linear-gradient(135deg, #f8d7da 0%, #f5c6cb 100%);
        color: #721c24;
        border-left: 4px solid #dc3545;
    }

    /* Loading spinner */
    .fa-spinner {
        animation: spin 1s linear infinite;
    }

    @keyframes spin {
        0% { transform: rotate(0deg); }
        100% { transform: rotate(360deg); }
    }

    /* Button disabled state */
    .btn:disabled {
        opacity: 0.6;
        cursor: not-allowed;
    }

    /* Styles cho button lưu bài viết */
    .save-post-btn {
        transition: all 0.3s ease;
        border: none;
        background: none;
        width: 100%;
        text-align: left;
        padding: 8px 16px;
    }

    .save-post-btn:hover {
        background-color: rgba(0, 123, 255, 0.1);
        transform: translateX(2px);
    }

    .save-post-btn.text-warning:hover {
        background-color: rgba(255, 193, 7, 0.1);
    }

    .save-post-btn:disabled {
        opacity: 0.6;
        cursor: not-allowed;
        transform: none;
    }

    .save-post-btn i {
        margin-right: 8px;
        transition: transform 0.3s ease;
    }

    .save-post-btn:hover i {
        transform: scale(1.1);
    }

    /* Animation pulse cho button lưu bài viết */
    @keyframes pulse {
        0% { transform: scale(1); }
        50% { transform: scale(1.05); }
        100% { transform: scale(1); }
    }

    /* Styles cho form báo cáo bài viết */
    .post-report-form {
        animation: slideDown 0.3s ease-out;
        border-left: 4px solid #dc3545 !important;
        max-width: 500px;
        margin-left: auto;
    }

    .post-report-form form {
        background: linear-gradient(135deg, #fff5f5 0%, #ffe6e6 100%);
        border: 1px solid #ffcccc;
        box-shadow: 0 4px 12px rgba(220, 53, 69, 0.15);
    }

    .post-report-form .form-label {
        color: #dc3545;
        font-size: 0.95rem;
        margin-bottom: 10px;
    }

    .post-report-form textarea {
        border: 1px solid #ffcccc;
        transition: border-color 0.3s ease;
        resize: vertical;
        min-height: 100px;
    }

    .post-report-form textarea:focus {
        border-color: #dc3545;
        box-shadow: 0 0 0 0.2rem rgba(220, 53, 69, 0.25);
    }

    .post-report-section .btn-outline-danger {
        border-color: #dc3545;
        color: #dc3545;
        transition: all 0.3s ease;
    }

    .post-report-section .btn-outline-danger:hover {
        background-color: #dc3545;
        border-color: #dc3545;
        color: white;
        transform: translateY(-1px);
        box-shadow: 0 4px 8px rgba(220, 53, 69, 0.3);
    }

    /* Responsive cho form báo cáo bài viết */
    @media (max-width: 768px) {
        .post-report-form {
            max-width: 100%;
            margin: 10px 0;
        }
        
        .post-report-section {
            float: none !important;
            text-align: center;
            margin-bottom: 15px;
        }
        
        .post-report-form .d-flex {
            flex-direction: column;
        }
        
        .post-report-form .d-flex .btn {
            margin-bottom: 5px;
        }
    }
</style>
@endpush


</div>
</div>
</div>


</div>
</div>
</div>

</div>



</header>
<!-- end Header Area -->

<main>
    <!-- breadcrumb area start -->
   
    <!-- breadcrumb area end -->

    <!-- blog main wrapper start -->
    <div class="blog-main-wrapper section-padding">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 order-2">

                </div>
                <div class="col-lg-9 order-1">
                    <div class="blog-item-wrapper">
                        <!-- blog post item start -->
                        <div class="blog-post-item blog-details-post">

                            <div class="blog-content">
                                <h3 class="blog-title">
                                    {{ $baiViet->title }}
                                </h3>
                                @if($baiViet->user_id !== auth()->id())
                                    <div class="post-report-section" style="float: right;">
                                        
                                    <div class="post-options position-relative"
                                            style="float: right; position: absolute; top: 10px; right: 10px; z-index: 10;">
                                            <button class="btn btn-light btn-sm dropdown-toggle" type="button"
                                                data-bs-toggle="dropdown" aria-expanded="false">
                                                <i class="fa fa-ellipsis-v"></i>
                                            </button>
                                            <ul class="dropdown-menu dropdown-menu-end">
                                                <li>
                                                        <button class="dropdown-item text-danger" type="button" onclick="togglePostReportForm()">Báo cáo</button>
                                                </li>

                                                <li>
                                               <form action="{{ route('savePost') }}" id="savePost">
                                                @csrf
                                                <input type="hidden" name="post_id" id="" value="{{ $baiViet->id }}">
                                                <button class="dropdown-item save-post-btn {{ $isSaved ? 'text-warning' : 'text-success' }}" type="submit">
                                                    <i class="fa fa-{{ $isSaved ? 'bookmark' : 'bookmark-o' }}"></i> 
                                                    {{ $isSaved ? 'Đã lưu' : 'Lưu bài viết' }}
                                                </button>
                                               </form>
                                                </li>
                                            </ul>
                                        </div>
                                        
                                        <!-- Form báo cáo bài viết -->
                                        <div id="post-report-form" class="post-report-form mt-3" style="display: none;">
                                            <form action="{{ route('baocao.baiviet') }}" method="POST" class="border p-4 rounded">
                                                @csrf
                                                <input type="hidden" name="post_id" value="{{ $baiViet->id }}">
                                                <input type="hidden" name="user_id" value="{{ auth()->id() }}">
                                                
                                                <div class="form-group">
                                                    <label for="bao-cao-bai-viet" class="form-label fw-bold text-danger">
                                                        <i class="fa fa-flag"></i> Báo cáo bài viết: "{{ $baiViet->title }}"
                                                    </label>
                                                    <textarea 
                                                        name="bao_cao_bai_viết" 
                                                        id="bao-cao-bai-viet"
                                                        class="form-control" 
                                                        rows="4" 
                                                        placeholder="Vui lòng mô tả lý do báo cáo bài viết này..."
                                                        required
                                                    ></textarea>
                                                    @error('bao_cao_bai_viết')
                                                        <div class="text-danger mt-1">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                                
                                                <div class="mt-3 d-flex gap-2">
                                                    <button type="submit" class="btn btn-danger btn-sm">
                                                        <i class="fa fa-paper-plane"></i> Gửi báo cáo
                                                    </button>
                                                    <button type="button" class="btn btn-secondary btn-sm" onclick="togglePostReportForm()">
                                                        <i class="fa fa-times"></i> Hủy
                                                    </button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                @else
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
                                                <form action="{{ route('baiviet.destroy', $baiViet->id) }}" method="POST"
                                                    onsubmit="return confirm('Bạn có chắc chắn muốn xóa bài viết này không?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button class="dropdown-item text-danger" type="submit">Xóa bài
                                                        viết</button>
                                                </form>
                                            </li>
                                        </ul>
                                    </div>
                                @endif

                            <div class="container-article"></div>
                                <div class="article-header">
                                    <div class="article-meta">
                                        <span class="author" style="display: flex; align-items: center; gap: 8px;">
                                            <img 
                                                src="{{ asset('storage/' . ($baiViet->user?->avatar)) }}" 
                                                alt="Avatar" 
                                                style="width:32px; height:32px; border-radius:50%; object-fit:cover;"
                                                onerror="this.onerror=null; this.src='https://icon-library.com/images/icon-user/icon-user-15.jpg';"
                                            >
                                            {{ $baiViet->user->name ?? 'Ẩn danh' }}
                                        </span>
                                        <span class="date"><i class="fa fa-calendar"></i> {{ $baiViet->created_at->format('d/m/Y') }}</span>
                                        <span class="views"><i class="fa fa-eye"></i> {{ $baiViet->view_count ?? 0 }} lượt xem</span>
                           
                                <figure class="blog-thumb" width="50%">
                                    <img src="{{ asset('storage/' . $baiViet->thumbnail) }}" alt="blog image"
                                        width="50%">
                                </figure>
                                <div class="entry-summary">

                                    <p>
                                        {!! $baiViet->content !!}
                                    </p>
                                    <div class="a2a_kit a2a_kit_size_32 a2a_default_style" data-a2a-url="{{ url()->current() }}" data-a2a-title="{{ $baiViet->title }}">
                                        <a class="a2a_button_facebook"></a>
                                        <a class="a2a_button_twitter"></a>
                                        </div>
                                    <script async src="https://static.addtoany.com/menu/page.js"></script>


                                    <div class="tag-line">
                                        <h6>Tag :</h6>

                                        @foreach($baiViet->tags as $tag)
                                            <a href="{{ route('fillterTag', $tag->slug) }}">{{ $tag->name }}</a>{{ !$loop->last ? ',' : '' }}
                                        @endforeach

                                    </div>
                                    @php
                                        $reactionTypes = [
                                            'like' => ['👍 Thích', 'btn-outline-primary'],
                                            'love' => ['❤️ Yêu', 'btn-outline-danger'],
                                            'haha' => ['😂 Haha', 'btn-outline-warning'],
                                            'wow' => ['😮 Wow', 'btn-outline-info'],
                                            'sad' => ['😢 Buồn', 'btn-outline-secondary'],
                                            'angry' => ['😡 Giận', 'btn-outline-dark'],
                                        ];
                                    @endphp

                                    <div class="like-section mt-4">
                                        <form id="reaction-form">
                                            @csrf
                                            <input type="hidden" name="post_id" value="{{ $baiViet->id }}">

                                            @foreach($reactionTypes as $type => [$label, $btnClass])
                                                @php
                                                    $total = $countReactionType[$type] ?? 0;
                                                @endphp
                                                <button type="button" data-type="{{ $type }}" class="btn {{ $btnClass }} reaction-btn">
                                                    <span class="reaction-label">{{ $label }}</span>
                                                    <span class="reaction-count" id="count-{{ $type }}">{{ $total > 0 ? $total : '' }}</span>
                                                </button>
                                            @endforeach
                                        </form>
                                    </div>


                                </div>
                            </div>
                        </div>
                        <!-- blog post item end -->

                        <!-- comment area start -->
                         <div id="comment-list">
                        @foreach($comments as $comment)
                        <div class="comment-body position-relative" id="">
                                @if ($comment->is_approved == 'approved')
                                    <!-- menu dropdown -->
                                    @if($comment->user_id !== auth()->id())
                                    <div class="post-options position-relative"
                                            style="float: right; position: absolute; top: 10px; right: 10px; z-index: 10;">
                                            <button class="btn btn-light btn-sm dropdown-toggle" type="button"
                                                data-bs-toggle="dropdown" aria-expanded="false">
                                                <i class="fa fa-ellipsis-v"></i>
                                            </button>
                                            <ul class="dropdown-menu dropdown-menu-end">
                                                <li>
                                                        <button class="dropdown-item text-danger" type="button" onclick="toggleCommentReportForm({{ $comment->id }})">Báo cáo</button>
                                                </li>
                                            </ul>
                                        </div>
                                    @else
                                        <div class="post-options position-relative"
                                            style="float: right; position: absolute; top: 10px; right: 10px; z-index: 10;">
                                            <button class="btn btn-light btn-sm dropdown-toggle" type="button"
                                                data-bs-toggle="dropdown" aria-expanded="false">
                                                <i class="fa fa-ellipsis-v"></i>
                                            </button>
                                            <ul class="dropdown-menu dropdown-menu-end">
                                                <li>
                                                    <form action="{{ route('comment.destroy', $comment->id) }}" method="POST"
                                                        onsubmit="return confirm('Bạn có chắc chắn muốn xóa bài viết này không?')">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button class="dropdown-item text-danger" type="submit">Xóa Bình luận</button>
                                                    </form>
                                                </li>
                                            </ul>
                                        </div>
                                    @endif

                                    <!-- nội dung bình luận -->
                                    <div class="comment-item" style="display: flex; align-items: flex-start; gap: 12px; margin-bottom: 18px;">
                                        <img 
                                            src="{{ asset('storage/' . ($comment->user?->avatar)) }}" 
                                            alt="Avatar" 
                                            style="width:36px; height:36px; border-radius:50%; object-fit:cover;"
                                            onerror="this.onerror=null; this.src='https://icon-library.com/images/icon-user/icon-user-15.jpg';"
                                        >
                                        <div>
                                            <span class="author" style="font-weight: 600;">{{ $comment->user->name ?? 'Ẩn danh' }}</span>
                                            <div class="comment-post-date">{{ $comment->created_at->format('d/m/Y') }}</div>
                                            <p>{{ $comment->content }}</p>
                                        </div>
                                    </div>

                                    <!-- form báo cáo bình luận -->
                                    <div id="comment-report-form-{{ $comment->id }}" class="comment-report-form mt-3" style="display: none;">
                                        <form action="{{ route('baocao.comment', $comment->id) }}" method="POST" class="border p-3 rounded bg-light" id="formReportComment">
                                            @csrf
                                            <input type="hidden" name="post_id" value="{{ $baiViet->id }}">
                                            <input type="hidden" name="user_id" value="{{ auth()->id() }}">
                                            
                                            <div class="form-group">
                                                <label for="baocao-{{ $comment->id }}" class="form-label fw-bold text-danger">
                                                    <i class="fa fa-flag"></i> Báo cáo bình luận của {{ $comment->user->name }}
                                                </label>
                                                <textarea 
                                                    name="baocao" 
                                                    id="baocao-{{ $comment->id }}"
                                                    class="form-control" 
                                                    rows="4" 
                                                    placeholder="Vui lòng mô tả lý do báo cáo bình luận này..."
                                                    required
                                                ></textarea>
                                                @error('baocao')
                                                    <div class="text-danger mt-1">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            
                                            <div class="mt-3 d-flex gap-2">
                                                <button type="submit" class="btn btn-danger btn-sm">
                                                    <i class="fa fa-paper-plane"></i> Gửi báo cáo
                                                </button>
                                                <button type="button" class="btn btn-secondary btn-sm" onclick="toggleCommentReportForm({{ $comment->id }})">
                                                    <i class="fa fa-times"></i> Hủy
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                                   
                                @elseif($comment->is_approved == 'refuse')
                                    <div class="alert alert-warning">
                                        Chúng tôi nhận thấy bình luận của bạn có từ ngữ thiếu chuẩn
                                        mực hoặc span. Vui lòng chỉnh sửa những bình luận của mình trước khi gửi
                                    </div>
                                @else
                                    <div class="alert alert-warning" id="list-comment">
                                        Bình luận này đang chờ duyệt.
                                    </div>
                                @endif
                            </div>
                        @endforeach
                        {{ $comments->links('pagination::bootstrap-5') }}


                        </div>
                    </div>
  
                                      
                    <!-- comment area end -->

                    <!-- start blog comment box -->
                    <div class="blog-comment-wrapper">
                        <h5>Bình luận</h5>
                        <form action="{{ route('comment.store') }}" method="POST" id="comment-form">
                            @csrf
                            <input type="hidden" name="post_id" value="{{ $baiViet->id }}">
                            <input type="hidden" name="user_id" value="{{ auth()->id() }}">
                            <!-- Đảm bảo có post_id -->
                            <div class="comment-post-box">
                                <div class="row">
                                    <div class="col-12">
                                        <textarea name="content" id="content" placeholder="Bạn đang nghĩ gì?"></textarea>
                                        @error('content')
                                            <div class="alert alert-danger mt-2">
                                                {{ $message }}
                                            </div>
                                        @enderror

                                    </div>
                                    <div class="col-12">
                                        <div class="coment-btn">
                                            <input class="btn btn-sqr" type="submit" value="Bình luận">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <!-- start blog comment box -->
                </div>
            </div>
        </div>
    </div>
    </div>
    <!-- blog main wrapper end -->
  

</main>

<!-- Scroll to top start -->
<div class="scroll-top not-visible">
    <i class="fa fa-angle-up"></i>
</div>
<!-- Scroll to Top End -->

<!-- Báo cáo bình luận đặt ở cuối file, ngoài mọi layout -->


<!-- báo cáo bài viết -->
<script>
    function togglePostReportForm() {
        const form = document.querySelector('.post-report-form');
        form.style.display = (form.style.display === 'none' || form.style.display === '') ? 'block' : 'none';
    }

    document.addEventListener('DOMContentLoaded', function() {
        // Ajax cho form báo cáo bài viết
        const postReportForm = document.querySelector('#post-report-form form');
        if (postReportForm) {
            postReportForm.addEventListener('submit', function(e) {
                e.preventDefault();
                const formData = new FormData(this);
                const submitBtn = this.querySelector('button[type="submit"]');
                const originalText = submitBtn.innerHTML;
                submitBtn.disabled = true;
                submitBtn.innerHTML = '<i class="fa fa-spinner fa-spin"></i> Đang gửi...';
                fetch(this.action, {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest'
                    },
                    credentials: 'same-origin'
                })
                .then(async response => {
                    if (!response.ok) {
                        const text = await response.text();
                        console.error('Server error response:', text);
                        throw new Error('Server error');
                    }
                    return response.json();
                })
                .then(data => {
                    if (data.success) {
                        showNotification('Báo cáo đã được gửi thành công!', 'success');
                        this.reset();
                        this.closest('.post-report-form').style.display = 'none';
                    } else {
                        showNotification(data.message || 'Có lỗi xảy ra, vui lòng thử lại!', 'error');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    showNotification('Có lỗi xảy ra, vui lòng thử lại!', 'error');
                })
                .finally(() => {
                    submitBtn.disabled = false;
                    submitBtn.innerHTML = originalText;
                });
            });
        }



        // Ajax cho tất cả form báo cáo bình luận
        const reportForms = document.querySelectorAll('.comment-report-form form');
        reportForms.forEach(form => {
            form.addEventListener('submit', function(e) {
                e.preventDefault();
                const formData = new FormData(this);
                const submitBtn = this.querySelector('button[type="submit"]');
                const originalText = submitBtn.innerHTML;
                submitBtn.disabled = true;
                submitBtn.innerHTML = '<i class="fa fa-spinner fa-spin"></i> Đang gửi...';
                fetch(this.action, {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest'
                    },
                    credentials: 'same-origin'
                })
                .then(async response => {
                    if (!response.ok) {
                        const text = await response.text();
                        console.error('Server error response:', text);
                        throw new Error('Server error');
                    }
                    return response.json();
                })
                .then(data => {
                    if (data.success) {
                        showNotification('Báo cáo đã được gửi thành công!', 'success');
                        this.reset();
                        this.closest('.comment-report-form').style.display = 'none';
                    } else {
                        showNotification(data.message || 'Có lỗi xảy ra, vui lòng thử lại!', 'error');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    showNotification('Có lỗi xảy ra, vui lòng thử lại!', 'error');
                })
                .finally(() => {
                    submitBtn.disabled = false;
                    submitBtn.innerHTML = originalText;
                });
            });
        });
    });



    // Function để toggle form báo cáo bình luận
    function toggleCommentReportForm(commentId) {
        const form = document.getElementById('comment-report-form-' + commentId);
        if (form) {
            form.style.display = (form.style.display === 'none' || form.style.display === '') ? 'block' : 'none';
        }
        


        // Đóng dropdown menu sau khi click
        const dropdownMenus = document.querySelectorAll('.dropdown-menu');
        dropdownMenus.forEach(menu => {
            if (menu.classList.contains('show')) {
                menu.classList.remove('show');
            }
        });
    }



    // Đóng tất cả form báo cáo khi click ra ngoài
    document.addEventListener('click', function(e) {
        if (!e.target.closest('.comment-report-form') && !e.target.closest('.dropdown-menu') && !e.target.closest('.dropdown-toggle')) {
            const reportForms = document.querySelectorAll('.comment-report-form');
            reportForms.forEach(form => {
                form.style.display = 'none';
            });
        }
    });


        // Ajax cho form bình luận
        const commentForm = document.getElementById('comment-form');
        commentForm.addEventListener('submit', function(e) {
            e.preventDefault();

            const content = document.getElementById('content').value;
            const postId = document.querySelector('input[name="post_id"]').value;
            // Lấy CSRF token từ input hidden
            const csrfToken = document.querySelector('input[name="_token"]').value;

            fetch("{{ route('comment.store') }}", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "Accept": "application/json",
                    "X-CSRF-TOKEN": csrfToken
                },
                body: JSON.stringify({
                    content: content,
                    post_id: postId
                })
            })
            .then(res => res.json())
            .then(data => {
                if (data.success) {
                    document.getElementById('content').value = "";

                    // Thêm bình luận mới vào danh sách (bạn có thể tuỳ chỉnh lại HTML cho phù hợp)
                    const commentHTML = `<div class="alert alert-warning" id="list-comment">
                                        Bình luận này đang chờ duyệt.
                                    </div>
                                    `;
                    // Thêm vào trước form bình luận
                    document.getElementById('comment-list').insertAdjacentHTML("beforeend", commentHTML);
                } else {
                    alert(data.message || "Đã xảy ra lỗi.");
                }
            })
            .catch(() => alert("Gửi bình luận thất bại!"));
        });



        // Ajax cho lưu bài viết
        const savePost = document.getElementById('savePost');
        savePost.addEventListener('submit', function(e){
            e.preventDefault();
            
            const formData = new FormData(this);
            const submitBtn = this.querySelector('button[type="submit"]');
            const originalText = submitBtn.innerHTML;
            const isCurrentlySaved = submitBtn.classList.contains('text-warning');
            
            // Disable button và hiển thị loading
            submitBtn.disabled = true;
            submitBtn.innerHTML = '<i class="fa fa-spinner fa-spin"></i> Đang lưu...';
            
            fetch(this.action, {
                method: 'POST',
                body: formData,
                headers: {
                    'X-Requested-With': 'XMLHttpRequest'
                },
                credentials: 'same-origin'
            })
            .then(async response => {
                if (!response.ok) {
                    const text = await response.text();
                    console.error('Server error response:', text);
                    throw new Error('Server error');
                }
                return response.json();
            })
            .then(data => {
                if (data.success) {
                    showNotification(data.message, 'success');
                    
                    // Cập nhật trạng thái button với animation
                    if (data.saved) {
                        submitBtn.innerHTML = '<i class="fa fa-bookmark"></i> Đã lưu';
                        submitBtn.classList.remove('text-success');
                        submitBtn.classList.add('text-warning');
                        // Thêm hiệu ứng pulse
                        submitBtn.style.animation = 'pulse 0.5s ease-in-out';
                        setTimeout(() => {
                            submitBtn.style.animation = '';
                        }, 500);
                    } else {
                        submitBtn.innerHTML = '<i class="fa fa-bookmark-o"></i> Lưu bài viết';
                        submitBtn.classList.remove('text-warning');
                        submitBtn.classList.add('text-success');
                    }
                } else {
                    showNotification(data.message || 'Có lỗi xảy ra, vui lòng thử lại!', 'error');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                showNotification('Có lỗi xảy ra, vui lòng thử lại!', 'error');
            })
            .finally(() => {
                submitBtn.disabled = false;
            });
        });


        
    // Ajax cho form reaction
    const reactionTypes = ['like', 'love', 'haha', 'wow', 'sad', 'angry'];

    document.querySelectorAll('.reaction-btn').forEach(function(btn) {
    btn.addEventListener('click', function(e) {
        e.preventDefault();
        let type = this.getAttribute('data-type');
        let form = document.getElementById('reaction-form');
        let post_id = form.querySelector('input[name="post_id"]').value;
        let token = form.querySelector('input[name="_token"]').value;

        fetch("{{ route('reaction') }}", {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                "X-CSRF-TOKEN": token,
                "Accept": "application/json"
            },
            body: JSON.stringify({
                post_id: post_id,
                type: type
            })
        })
        .then(response => {
        if (!response.ok) {
            // Nếu là lỗi chưa đăng nhập (401)
            if (response.status === 401) {
                alert("Bạn cần đăng nhập để thả cảm xúc!");
            }
            throw new Error("Lỗi phản hồi: " + response.status);
        }
        return response.json();
    })
        .then(data => {
            console.log('Response from backend:', data); // Debug
            console.log('Data type:', typeof data);
            console.log('Data keys:', Object.keys(data));
            if(data.success) {
                // Cập nhật lại số lượng cho tất cả các loại
                for (let type of reactionTypes) {
                    let count = data.counts[type] ?? 0;
                    let el = document.getElementById('count-' + type);
                    console.log('Updating count for', type, ':', count, 'Element:', el);
                    if (el) {
                        el.textContent = count > 0 ? count : '';
                    } else {
                        console.error('Element not found for type:', type);
                    }
                }
                // Reset active class cho tất cả
                document.querySelectorAll('.reaction-btn').forEach(btn => btn.classList.remove('active'));
                // Nếu người dùng vẫn còn reaction thì tô sáng icon
                if (data.current_user_reaction) {
                    let activeBtn = document.querySelector('.reaction-btn[data-type="' + data.current_user_reaction + '"]');
                    if (activeBtn) {
                        activeBtn.classList.add('active');
                    }
                }
            } else {
                console.error('Server returned error:', data.message);
                alert(data.message || 'Có lỗi xảy ra!');
            }
        })
        .catch(error => {
            console.error('Fetch error:', error);
            alert('Có lỗi xảy ra khi thả cảm xúc!');
        });
    });
});
    // Function hiển thị thông báo
    function showNotification(message, type) {
        // Tạo element thông báo
        const notification = document.createElement('div');
        notification.className = `alert alert-${type === 'success' ? 'success' : 'danger'} alert-dismissible fade show position-fixed`;
        notification.style.cssText = `
            bottom: 0px;
            right: 20px;
            z-index: 9999;
            min-width: 300px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.15);
        `;
        
        notification.innerHTML = `
            <i class="fa fa-${type === 'success' ? 'check-circle' : 'exclamation-circle'}"></i>
            ${message}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        `;
        
        // Thêm vào body
        document.body.appendChild(notification);
        
        // Tự động ẩn sau 5 giây
        setTimeout(() => {
            if (notification.parentNode) {
                notification.remove();
            }
        }, 5000);
    }
</script>





@include("client.layouts.footer")

<!-- Page specific script -->

<!-- Code injected by live-server -->
@stack("scripts")