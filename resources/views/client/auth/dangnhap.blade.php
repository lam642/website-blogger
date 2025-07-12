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
        <h2>Đăng nhập tài khoản</h2>
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
        <form action="{{ route('checklogin') }}" method="post">
            @csrf
            <div class="single-input-item">
            <input type="text" id="email" name="email" value="{{ old('email') }}" placeholder="Email">
                @error('email')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="single-input-item">
            <input type="password" id="password" name="password" value="{{ old('password') }}" placeholder="Mật khẩu">
                @error('password')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <br>
            <div class="input-group">
                <span for="password">Ghi nhớ tài khoản</span>
                <input type="checkbox" id="remember" name="remember">
            </div>
            <div class="single-input-item">
                <button class="btn btn-sqr col-lg-12" >Đăng nhập</button>
            </div>
            <div style="text-align: center;">
            <p class="text-align-center">Hoặc</p>
            <a href="{{ route('google.login') }}" class="btn-google ">
            <img src="https://developers.google.com/identity/images/g-logo.png" alt="Google Logo" width="26">
            <span>Đăng nhập bằng Google</span>
            </a>
            <div class="options">
                <a href="{{ route('formMail') }}">Quên mật khẩu?</a>
                <span>Chưa có tài khoản? <a href="{{ route('register') }}">Đăng ký ngay</a></span>
            </div>
            </div>
        </form>
    </div>
    </div>
</main>






@include("client.layouts.footer")

<!-- Page specific script -->

<!-- Code injected by live-server -->
@stack("scripts")