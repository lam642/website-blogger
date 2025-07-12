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
              <h3 class="card-title">Sửa bình luận </h3>
            </div>

            <form action="{{ route('admin.comment.update', $comment->id) }}" method="POST" enctype="multipart/form-data">
              @csrf
              @method('PUT')
              <div class="card-body">
                <div class="row">
                  <!-- Cột trái -->
                  <div class="col-md-4">
                    <!-- Người bình luận -->
                    <div class="form-group mt-3">
                      <label>Người bình luận</label>
                      <input type="text" class="form-control" name="user_id" value="{{ $comment->user->name }}" readonly>
                    </div>
                    
                   <!-- người bình luận -->
                   <div class="form-group mt-3">
                      <label>Nội dung bình luận</label>
                      <input type="text" class="form-control" name="title2" value="{{ $comment->content }}" readonly>
                    </div>


                    <!-- is_approved -->
                    <div class="form-group mt-3">
                      <label>Trạng thái</label>
                      <select name="is_approved" class="form-control">
                        <option value="pending" {{ $comment->is_approved == 'pending' ? "selected" : "" }}>Chưa duyệt</option>
                        <option value="approved" {{ $comment->is_approved == 'approved' ? "selected" : "" }}>Duyệt</option>
                        <option value="refuse" {{ $comment->is_approved == 'refuse' ? "selected" : "" }}>Từ chối</option>
                      </select>
                      @error('is_approved')
              <span class="text-danger">{{ $message }}</span>
            @enderror
                    </div>
                  </div>

                  <!-- Cột phải -->
                  <div class="col-md-8">
                    <!-- Nội dung bài viết -->
                    <div class="form-group">
                      <label>Nội dung bài viết</label>
                      <textarea name="content" class="form-control" rows="12"
                        placeholder="Nhập nội dung" readonly>{{ $comment->post->content }}</textarea>
                    </div>

                    
                  </div>

                </div>
              </div>

              <!-- end card-body -->
              <div class="card-footer">
                <button type="submit" class="btn btn-primary">Sửa bình luận</button>
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