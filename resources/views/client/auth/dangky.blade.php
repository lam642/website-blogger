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
                                <h2>Đăng ký</h2>
                                @if(session('error'))
                                        <div class=" alert alert-error>
                                        {{ session('error') }}
                                    </div>
                                @endif
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        <form action="{{ route('checkregister') }}" method="post">
            @csrf
            <div class="single-input-item">
            <input type="text" id="name" name="name" value="{{ old('name') }}" placeholder="Họ và tên" >
                @error('name')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
            </div>
            <div class="single-input-item">
            <input type="email" id="email" name="email" value="{{ old('email') }}" placeholder="email">
                @error('email')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
            </div>
            <div class="row">
                <div class="col-lg-6">
                    <div class="single-input-item">
                    <input type="password" id="password" name="password" value="{{ old('password') }}" placeholder="Mật khẩu">
                @error('password')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="single-input-item">
                    <input type="password" id="password" name="comfirm_password" placeholder="Xác nhận mật khẩu">
                @error('comfirm_password')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                    </div>
                </div>
            </div>

            <div class="single-input-item">
                <button class="btn btn-sqr col-lg-12">Đăng ký</button>
            </div>
        </form>
    </div>
    </div>
</main>






@include("client.layouts.footer")

<!-- Page specific script -->

<!-- Code injected by live-server -->
@stack("scripts")