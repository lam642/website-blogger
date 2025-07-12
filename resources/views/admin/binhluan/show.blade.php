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
          <h1>Quản lí bình luận </h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Bình luận</li>
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
              <h3 class="card-title">Chi tiết bình luận </h3>
            </div>

           
              <div class="card-body">
                <div class="row">
                  <!-- Cột trái -->
                  <div class="col-md-4">
                  
                    <!-- Người bình luận -->
                    <div class="form-group mt-3">
                      <label>Người bình luận</label>
                      <input type="text" class="form-control" name="user_id" value="{{ $comment->user->name }}" readonly>
                    </div>
                    
                        <!-- Tài khoản-->
                        <div class="form-group mt-3">
                      <label>Email</label>
                      <input type="text" class="form-control" name="email" value="{{ $comment->user->email }}" readonly>
                    </div>

                    <!-- Danh mục -->
                    <div class="form-group mt-3">
                      <label>Trạng thái</label>
                      <span class="badge badge-primary">{{ $comment->is_approved == 'pending' ? 'Chưa duyệt' : ($comment->is_approved == 'approved' ? 'Đã duyệt' : ($comment->is_approved == 'refuse' ? 'Từ chối' : 'Spam')) }}</span>
                    </div>


                      
                      <!-- Ngày chỉnh sửa -->
                      <div class="form-group mt-3">
                      <label>Ngày bình luận</label>
                      <span class="badge badge-primary">{{ $comment->created_at->format('d/m/Y') }}</span>
                    </div>

                  
                  </div>

                  <!-- Cột phải -->
                  <div class="col-md-8">
                      <!-- Bài viết   -->
                      <div class="form-group mt-3">
                      <label>Bài viết</label>
                      <input type="text" class="form-control" name="post_id" value="{{ $comment->post->title }}" readonly>
                    </div>
                    <!-- Tiêu đề -->
                    <div class="form-group">
                      <label>Nội dung bài viết</label>
                      <textarea name="content" class="form-control" rows="12"
                            placeholder="Nhập nội dung" value="" readonly>{{ $comment->post->content }}</textarea>
                    </div>

                    <!-- Nội dung -->
                 
                  </div>
        
              <!-- end card-body -->
              <div class="card-footer">
                <a href="{{ route('admin.comment.index') }}" class="btn btn-primary">Quay lại</a>
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