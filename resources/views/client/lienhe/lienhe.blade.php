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
 

<div class="contact-area section-padding pt-0">
            @if(session('success')) 
                <div class="alert alert-success">{{ session('success') }}</div>
            
            @endif
            @if(session('error')) 
                <div class="alert alert-success">{{ session('error') }}</div>
            @endif
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="contact-message">
                            <h4 class="contact-title">Nói với chúng tôi</h4>
                            <form action="{{ route('postLienHe') }}" method="post" class="contact-form">
                                @csrf
                                <div class="row">
                                    <div class="col-lg-12 col-md-12 col-sm-12">
                                    <input name="name" placeholder="Họ và tên" type="text" value="{{ $user->name ?? '' }}"> 
                                        @error('name')
                                        <p class="text text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <div class="col-lg-12 col-md-12 col-sm-12">
                                    <input name="email" placeholder="Email" type="text" value="{{ $user->email ?? '' }}"> 
                                        @error('email')
                                        <p class="text text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <div class="col-12">
                                        <div class="contact2-textarea text-center">
                                            <textarea placeholder="Nội dung *" name="message" class="form-control2" ></textarea>
                                            @error('message')
                                            <p class="text text-danger">{{ $message }}</p>
                                        @enderror
                                        </div>
                                        <div class="contact-btn">
                                            <button class="btn btn-sqr" type="submit">Gửi</button>
                                        </div>
                                    </div>
                                    <div class="col-12 d-flex justify-content-center">
                                        <p class="form-messege"></p>
                                    </div>
                                </div>
                            </form>
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

<!-- Báo cáo bình luận đặt ở cuối file, ngoài mọi layout -->


<!-- báo cáo bài viết -->




@include("client.layouts.footer")

<!-- Page specific script -->

<!-- Code injected by live-server -->