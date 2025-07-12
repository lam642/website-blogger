<!-- header -->
@include("client.layouts.header")
@include("client.layouts.navbar")
<!-- end header -->

<style>
  select[multiple] {
    height: auto;
    min-height: 100px;
    padding: 8px;
    border: 1px solid #ccc;
    border-radius: 6px;
    background-color: #fff;
    font-size: 16px;
  }

  select[multiple] option {
    padding: 6px 10px;
    margin: 4px 0;
    cursor: pointer;
  }

  select[multiple] option:checked {
    background-color: #007bff;
    color: #fff;
  }

  label {
    font-weight: bold;
    margin-bottom: 6px;
    display: block;
  }
</style>

<section class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-12">
        <div class="card card-primary">
          <div class="card-header">
            <h3 class="card-title">Đăng bài </h3>
          </div>
          @if(session('success'))
        <p class="alert alert-success">{{ session('success') }}</p>
      @endif

          @if(session('error'))
        <p class="alert alert-danger">{{ session('error') }}</p>
      @endif


          <form action="{{ route('postBaiViet') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="card-body">
              <div class="row">
                <!-- Cột trái -->
                <div class="col-md-4">
                  <!-- Ảnh bài viết -->
                  <div class="form-group">
                    <label>Ảnh bài viết</label>
                    <input type="file" class="form-control" name="thumbnail" onchange="previewImage(event)">
                    @error('thumbnail')
            <span class="text-danger">{{ $message }}</span>
          @enderror
                    <!-- Xem trước -->
                    <div class="mt-2">
                      <img id="thumbnail-preview" src="#" alt="Xem trước ảnh" style="max-width: 100%; display: none;" />
                    </div>
                  </div>

                  <!-- Tên tác giả -->
                  <div class="form-group mt-3">
                    <input type="hidden" class="form-control" name="user_id" value="{{ $usersAdmin->id  }}" readonly>
                  </div>
                 
                  <!-- Tag -->


                  <!-- Danh mục -->
                  <div class="form-group mt-3">
                    <label>Danh mục</label>
                    <select name="category_id" class="form-control">
                      <option value="" selected>--Chọn danh mục--</option>
                      @foreach ($categories as $category)
              <option value="{{ $category->id }}">{{ $category->name }}</option>
            @endforeach
                    </select>
                    @error('category_id')
            <span class="text-danger">{{ $message }}</span>
          @enderror
                  </div>

                  <!-- Trạng thái -->
                  <div class="form-group mt-3">
                  </div>
                </div>

                <!-- Cột phải -->
                <div class="col-md-8">
                  <!-- Tiêu đề -->
                  <div class="form-group">
                    <label>Tiêu đề</label>
                    <input type="text" class="form-control" name="title" placeholder="Nhập tiêu đề"
                      value="{{ old('title') }}">
                    @error('title')
            <span class="text-danger">{{ $message }}</span>
          @enderror
                  </div>

                  <!-- Nội dung -->
                  <div class="form-group mt-3">
                    <label>Nội dung</label>
                    <textarea name="content" class="form-control" rows="12"
                      placeholder="Nhập nội dung">{{ old('content') }}</textarea>
                    @error('content')
            <span class="text-danger">{{ $message }}</span>
          @enderror
                  </div>
                </div>
              </div>
            </div>

            <!-- end card-body -->
            <div class="card-footer">
              <button type="submit" class="btn btn-primary">Đăng bài</button>
            </div>
          </form>
        </div>
      </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->
  </div>
  <!-- /.container-fluid -->
</section>

</div>
</div>
</div>


</div>
</div>
</div>

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


      <!-- mobile menu end -->


      <!-- offcanvas widget area start -->

      <!-- offcanvas widget area end -->
    </div>
  </div>
</aside>

</header>
<!-- end Header Area -->



<!-- Scroll to top start -->
<div class="scroll-top not-visible">
  <i class="fa fa-angle-up"></i>
</div>
<!-- Scroll to Top End -->
<!-- Báo cáo bình luận -->

<script src="https://cdn.ckeditor.com/4.22.1/full/ckeditor.js"></script>
<script>
  // Cấu hình CKEditor
  CKEDITOR.replace('content', {
    height: 400,
    removeButtons: 'PasteFromWord'
  });
</script>

<script>
  function previewImage(event) {
    const reader = new FileReader();
    reader.onload = function () {
      const img = document.getElementById('thumbnail-preview');
      img.src = reader.result;
      img.style.display = 'block';
    };
    reader.readAsDataURL(event.target.files[0]);
  }
</script>




@include("client.layouts.footer")

<!-- Page specific script -->

<!-- Code injected by live-server -->
@stack("scripts")