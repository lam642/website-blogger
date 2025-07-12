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
        <h2>Đổi mật khẩu</h2>
        <form action="{{ route('postDoiMatKhau') }}" method="post">
            @csrf
            <input type="hidden" name="customer_token" value="{{ $customer_token }}">


            <div class="single-input-item">
            <input type="password" id="newPassword" name="newPassword" value="" placeholder="Mật khẩu mới">
                @error('newPassword')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="single-input-item">
            <input type="password" id="comfirmPass" name="comfirmPass"  placeholder="Xác nhận mật khẩu">
                @error('comfirmPass')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="single-input-item">
                <button class="btn btn-sqr col-lg-12" >Thay đổi mật khẩu</button>
            </div>
           
        </form>
    </div>
    </div>
</main>






@include("client.layouts.footer")

<!-- Page specific script -->

<!-- Code injected by live-server -->
@stack("scripts")