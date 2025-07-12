<!-- header -->
@include("client.layouts.header")
@include("client.layouts.navbar")
<!-- end header -->
@push('styles')
    <style>
        /* Báo cáo bài viết */

        .dropdown-menu-custom {
            background: white;
            border: 1px solid #ddd;
            padding: 8px;
            position: absolute;
            right: 0;
            top: 100%;
            z-index: 100;
            width: 120px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        }

        .dropdown-menu-custom a {
            display: block;
            color: #333;
            text-decoration: none;
            padding: 5px 10px;
            font-size: 14px;
        }

        .dropdown-menu-custom a:hover {
            background-color: #f5f5f5;
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
    <div class="my-account-wrapper section-padding">
        <div class="container">
            <div class="section-bg-color">
                <div class="row">
                    <div class="col-lg-12">
                        <!-- My Account Page Start -->
                        <div class="myaccount-page-wrapper">
                            <!-- My Account Tab Menu Start -->
                            <div class="row">
                                <div class="col-lg-3 col-md-4">
                                    <div class="myaccount-tab-menu nav" role="tablist">
                                        <a href="#account-info" data-bs-toggle="tab"><i class="fa fa-user"></i>Thông tin
                                            tài khoản</a>
                                    </div>
                                </div>
                                <!-- My Account Tab Menu End -->

                                <!-- My Account Tab Content Start -->
                                <div class="col-lg-9 col-md-8">
                                    <div class="tab-content" id="myaccountContent">




                                        <!-- Single Tab Content Start -->
                                        <div class="tab-pane fade show active" id="account-info" role="tabpanel">

                                            <div class="myaccount-content">
                                                <h5>Tài khoản của tôi</h5>
                                                @if(session('success'))
                                                    ` <p class="alert alert-success">{{ session('success') }}</p>
                                                @endif

                                                @if(session('error'))
                                                    <p class="alert alert-error">{{ session('error') }}</p>
                                                @endif
                                                <div class="col-md-3">


                                                </div>
                                                <div class="account-details-form">
                                                    <form action="{{ route('chinhSuaTaiKhoan', auth()->user()->id) }}"
                                                        Method="POST" enctype="multipart/form-data">
                                                        @csrf
                                                        @Method('put')
                                                        <div class="row">
                                                            <div class="text-center col-lg-6">
                                                                <img src="{{ asset('storage/' . auth()->user()->avatar) }}"
                                                                    class="img-thumbnail" style="width: 100px" alt=""
                                                                    onerror="this.onerror=null; this.src='https://icon-library.com/images/icon-user/icon-user-15.jpg'">
                                                                <h6>Ảnh đại diện</h6>
                                                                <input type="file" name="anh_dai_dien"
                                                                    class="form-control" accept="image/">
                                                                @error('anh_dai_dien')
                                                                    <p class="text-danger">{{ $message }}</p>
                                                                @enderror
                                                            </div>
                                                            <div class="col-lg-12">
                                                                <div class="single-input-item">
                                                                    <label for="first-name" class="required">Họ và
                                                                        tên</label>
                                                                    <input type="text" name="name" id="first-name"
                                                                        placeholder="Họ và tên"
                                                                        value="{{ auth()->user()->name ?? old('name') }}" />
                                                                    @error('name')
                                                                        <p class="text-danger">{{ $message }}</p>
                                                                    @enderror
                                                                </div>
                                                            </div>
                                                            <div class="single-input-item">
                                                                <label for="email" class="required">Email</label>
                                                                <input type="email" id="email" name="email"
                                                                    placeholder="email"
                                                                    value="{{ auth()->user()->email ?? old('email') }}"
                                                                    {{ auth()->user()->google_id != null ? "readonly" : "" }} />
                                                                @error('email')
                                                                    <p class="text-danger">{{ $message }}</p>
                                                                @enderror
                                                            </div>
                                                            @if(auth()->user()->google_id == null)
                                                                <fieldset>
                                                                    <legend>Thay đổi mật khẩu</legend>

                                                                    <div class="row">
                                                                        <div class="col-lg-6">
                                                                            <div class="single-input-item">
                                                                                <label for="new-pwd" class="required">Mật
                                                                                    khẩu mới</label>
                                                                                <input type="password" id="new-pwd"
                                                                                    name="new-pwd"
                                                                                    placeholder="New Password" value="" />
                                                                                @error('new-pwd')
                                                                                    <p class="text-danger">{{ $message }}</p>
                                                                                @enderror
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-lg-6">
                                                                            <div class="single-input-item">
                                                                                <label for="confirm-pwd"
                                                                                    class="required">Xác nhận mật
                                                                                    khẩu</label>
                                                                                <input type="password" id="confirm-pwd"
                                                                                    name="confirm-pwd"
                                                                                    placeholder="Confirm Password" />
                                                                                @error('confirm-pwd')
                                                                                    <p class="text-danger">{{ $message }}</p>
                                                                                @enderror
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </fieldset>
                                                            @endif
                                                            <div class="single-input-item">
                                                                <button class="btn btn-sqr">Lưa thay đổi</button>
                                                            </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div> <!-- Single Tab Content End -->
                                    </div>
                                </div> <!-- My Account Tab Content End -->
                            </div>
                        </div> <!-- My Account Page End -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

<!-- Scroll to top start -->
<div class="scroll-top not-visible">
    <i class="fa fa-angle-up"></i>
</div>
<!-- Scroll to Top End -->
<!-- Báo cáo bình luận -->
<script>
    function toggleMenu(id) {
        // Ẩn tất cả menu trước
        document.querySelectorAll('.dropdown-menu-custom').forEach(el => el.style.display = 'none');
        // Hiện menu của comment đang chọn
        const menu = document.getElementById('dropdown-' + id);
        if (menu.style.display === 'block') {
            menu.style.display = 'none';
        } else {
            menu.style.display = 'block';
        }
    }

    function toggleReportForm(id) {
        const form = document.getElementById('report-form-' + id);
        form.style.display = (form.style.display === 'none' || form.style.display === '') ? 'block' : 'none';

        // Ẩn menu sau khi chọn
        const menu = document.getElementById('dropdown-' + id);
        menu.style.display = 'none';
    }

    // Tắt menu nếu click ngoài
    document.addEventListener('click', function (e) {
        if (!e.target.closest('.comment-menu')) {
            document.querySelectorAll('.dropdown-menu-custom').forEach(el => el.style.display = 'none');
        }
    });
</script>


<!-- báo cáo bài viết -->
<script>
    function toggleReportForm() {
        const form = document.querySelector('.report-form');
        form.style.display = (form.style.display === 'none' || form.style.display === '') ? 'block' : 'none';
    }
</script>





@include("client.layouts.footer")

<!-- Page specific script -->

<!-- Code injected by live-server -->
@stack("scripts")