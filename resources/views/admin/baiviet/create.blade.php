<!-- header -->
@include('admin.layout.header')
<!-- end header -->

<!-- navbar -->
@include('admin.layout.navbar')
<!-- end navbar -->

<!-- Main Sidebar Container -->
@include('admin.layout.sidebar')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Quản lí bài viết </h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Bài viết</li>
          </ol>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-12">
          <div class="card card-primary">
            <div class="card-header">
              <h3 class="card-title">Thêm bài viết </h3>
            </div>

            <form action="{{ route('admin.post.store') }}" method="POST" enctype="multipart/form-data">
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
                        <img id="thumbnail-preview" src="#" alt="Xem trước ảnh"
                          style="max-width: 100%; display: none;" />
                      </div>
                    </div>

                    <!-- Tên tác giả -->
                    <div class="form-group mt-3">
                      <label>Tên tác giả</label>
                      <input type="text" class="form-control" name="user_id" value="{{ $usersAdmin->name ?? 'admin' }}" readonly>
                    </div>
                      <!-- Tên đường dẫn   -->
                      <div class="form-group mt-3">
                      <label>Tên đường dẫn</label>
                      <input type="text" class="form-control" name="slug" placeholder="Nhập tên đường dẫn" value="{{ old('slug') }}">
                      @error('slug')
              <span class="text-danger">{{ $message }}</span>
            @enderror
                    </div>
                    <!-- Tag -->
                    <div class="form-group mt-3">
                      <label>Tags</label>
                      <select name="tag_id[]" class="form-control" multiple>
                        @foreach ($tags as $tag)
              <option value="{{ $tag->id }}" {{ collect(old('tag_id', $selectedTagIds ?? []))->contains($tag->id) ? 'selected' : '' }}>
                {{ $tag->name }}
              </option>
            @endforeach
                      </select>
                      @error('tag_id')
              <span class="text-danger">{{ $message }}</span>
            @enderror
                    </div>

                    <!-- Danh mục -->
                    <div class="form-group mt-3">
                      <label>Danh mục</label>
                      <select name="category_id" class="form-control">
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
                      <label>Trạng thái</label>
                      <select name="status" class="form-control">
                        <option value="draft" {{ old('status') == 'draft' ? "selected" : "" }}>Bản nháp</option>
                        <option value="published" {{ old('status') == 'published' ? "selected" : "" }}>Đã đăng</option>
                        <option value="Pending approval" {{ old('status') == 'Pending approval' ? "selected" : "" }}>Chờ
                          phê duyệt</option>
                      </select>
                      @error('status')
              <span class="text-danger">{{ $message }}</span>
            @enderror
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
                <button type="submit" class="btn btn-primary">Thêm bài viết</button>
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
  <!-- /.content -->
</div>

@include('admin.layout.footer')

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


<script>
  $(function () {
    $("#example1").DataTable({
      "responsive": true, "lengthChange": false, "autoWidth": false,
      "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
    }).buttons().container().appendTo('#example1_wrapper .col-md-6 :eq(0)');
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
    });
  });
</script>
<!-- Code injected by live-server -->

</body>

</html>