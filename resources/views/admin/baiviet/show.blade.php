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
              <h3 class="card-title">Chi tiết bài viết </h3>
            </div>

           
              <div class="card-body">
                <div class="row">
                  <!-- Cột trái -->
                  <div class="col-md-4">
                    <!-- Ảnh bài viết -->
                    <div class="form-group">
                      <label>Ảnh bài viết</label>
                      <p>
                      <img src="{{ asset('storage/' . $post->thumbnail) }}" alt="Ảnh bài viết" style="max-width: 50%;" >
                      <!-- Xem trước -->
                      <div class="mt-2">
                        <img id="thumbnail-preview" src="#" alt="Xem trước ảnh"
                          style="max-width: 100%; display: none;" />
                      </div>
                    </div>

                    <!-- Tên tác giả -->
                    <div class="form-group mt-3">
                      <label>Tên tác giả</label>
                      <input type="text" class="form-control" name="user_id" value="{{ $user->name }}" readonly>
                    </div>
                      <!-- Tên đường dẫn   -->
                      <div class="form-group mt-3">
                      <label>Tên đường dẫn</label>
                      <input type="text" class="form-control" name="slug" placeholder="Nhập tên đường dẫn" value="{{ $post->slug }}" readonly>
                    </div>
                    <!-- Tag -->
                    <div class="form-group mt-3">
                      <label>Tags</label>
                      @foreach ($tags as $tag)
                    <span class="badge badge-primary">{{ $tag->name }}</span>
                    @endforeach
                    </div>

                    <!-- Danh mục -->
                    <div class="form-group mt-3">
                      <label>Danh mục</label>
                      <span class="badge badge-primary">{{ $categories->name }}</span>
                    </div>

                    <!-- Trạng thái -->
                    <div class="form-group mt-3">
                      <label>Trạng thái</label>
                      <span class="badge badge-primary">{{ $post->status == 'draft' ? 'Bản nháp' : ($post->status == 'published' ? 'Đã đăng' : ($post->status == 'Pending approval' ? 'Chờ phê duyệt' : ($post->status == 'refuse' ? 'Từ chối' : 'Chấp nhận')))}}</span>
                    </div>

                      <!-- Số lượt xem -->
                      <div class="form-group mt-3">
                      <label>Số lượt xem</label>
                      <span class="badge badge-primary">{{ $post->view_count }}</span>
                    </div>

                      <!-- Số lượt tương tác -->
                      <div class="form-group mt-3">
                      <label>Số lượt tương tác</label>
                      <span class="badge badge-primary">{{ $countReaction }}</span>
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

                    @foreach ($reactionTypes as $type => [$label, $btnClass])
                        @php
                            // Tìm phần tử có type tương ứng trong collection
                            $match = $countReactionType->firstWhere('type', $type);
                            $total = $match ? $match->total : 0;
                        @endphp
                        <button name="type" value="{{ $type }}" class="btn {{ $btnClass }}">
                            {{ $label }} {{ $total > 0 ? $total : '' }}
                        </button>
                    @endforeach
                      <!-- Số lượt bình luận -->
                      <div class="form-group mt-3">
                      <label>Số lượt bình luận</label>
                      <span class="badge badge-primary">{{ $countComment }}</span>
                    </div>



                       <!-- Ngày tạo -->
                       <div class="form-group mt-3">
                      <label>Ngày tạo</label>
                      <span class="badge badge-primary">{{ $post->created_at->format('d/m/Y') }}</span>
                    </div>

                      <!-- Ngày chỉnh sửa -->
                      <div class="form-group mt-3">
                      <label>Ngày chỉnh sửa</label>
                      <span class="badge badge-primary">{{ $post->updated_at->format('d/m/Y') }}</span>
                    </div>
                  </div>

                  <!-- Cột phải -->
                  <div class="col-md-8">
                    <!-- Tiêu đề -->
                    <div class="form-group">
                      <label>Tiêu đề</label>
                      <input type="text" class="form-control" name="title" placeholder="Nhập tiêu đề"
                        value="{{ $post->title }}" readonly>
                    </div>

                    <!-- Nội dung -->
                    <div class="form-group mt-3">
                      <label>Nội dung</label>
                      <textarea name="content" class="form-control" rows="12"
                            placeholder="Nhập nội dung" value="" readonly>{{ $post->content }}</textarea>
                    </div>
                  </div>
              
                </div>
              </div>

              <!-- end card-body -->
              <div class="card-footer">
                <a href="{{ route('admin.post.index') }}" class="btn btn-primary">Quay lại</a>
              </div>
            
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