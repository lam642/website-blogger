<!-- header -->
@include("client.layouts.header")
@include("client.layouts.navbar")
<!-- end header -->
@push('styles')
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
    <div class="dang-ky" style="width: 550px; margin: auto;">


        <div class="login-reg-form-wrap sign-up-form" ">
        <h2>Nhập email để lấy lại mật khẩu</h2>
        @if(session('ban'))
            <script>
                alert("{{ session('ban') }}");
                </script>
        @endif
        @if(session('error'))
            <div class="text-danger">
                {{ session('error') }}
            </div>
        @endif
        @if(session('success'))
            <div class="text-success">
                {{ session('success') }}
            </div>
        @endif
        <!-- 
            Để chuyển chính trang hiện tại khi click vào thẻ <a>, 
            bạn KHÔNG sử dụng thuộc tính target hoặc dùng target="_self" (mặc định).
            Ví dụ:
        -->


        <!-- 
            Nếu bạn dùng target="_blank" thì sẽ mở ra tab mới.
            Nếu KHÔNG có target hoặc target="_self", sẽ chuyển chính trang hiện tại.
        -->

        <!-- Form lấy lại mật khẩu -->
        <form action="{{ route('checkMail') }}" method="post">
            @csrf
            <div class="single-input-item">
                <input type="text" id="email" name="email" value="{{ old('email') }}" placeholder="Email">
                @error('email')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="single-input-item">
                <button class="btn btn-sqr col-lg-12">Gửi</button>
            </div>
        </form>
    </div>
    </div>
</main>






@include("client.layouts.footer")

<!-- Page specific script -->

<!-- Code injected by live-server -->
@stack("scripts")