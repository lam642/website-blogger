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
          <h1>Quản lí báo cáo </h1>
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
              <h3 class="card-title">Chi báo cáo bài viết </h3>
            </div>

           
              <div class="card-body">
                <div class="row">
                  <!-- Cột trái -->
                  <div class="col-md-4">
                    <!-- Ảnh bài viết -->
                    

                    <!-- Tên tác giả -->
                    <div class="form-group mt-3">
                      <label>Người báo cáo</label>
                      <input type="text" class="form-control" value="{{ $user->name }}" readonly>
                    </div>
                     
                         <!-- Nội dung báo cáo -->
                    <div class="form-group mt-3">
                      <label>Nội dung báo cáo</label>
                      <textarea type="tel" class="form-control" value="{{ $baoCaoBaiViet->reason }}" readonly>{{  $baoCaoBaiViet->reason }}  </textarea>
                    </div>
                     

                      <!-- Ngày Báo cáo -->
                      <div class="form-group mt-3">
                      <label>Ngày báo báo</label>
                      <span class="badge badge-primary">{{ $baoCaoBaiViet->updated_at->format('d/m/Y') }}</span>
                    </div>

                  
                  </div>

                  <!-- Cột phải -->
                  <div class="col-md-8">
                    <!-- Tiêu đề -->
                    <div class="form-group">
                      <label>Tiêu đề</label>
                      <input type="text" class="form-control" name="title" placeholder="Nhập tiêu đề"
                        value="{{ $baiViet->title }}" readonly>
                    </div>

                    <!-- Nội dung -->
                    <div class="form-group mt-3">
                      <label>Nội dung</label>
                      <textarea name="content" class="form-control" rows="12"
                            placeholder="Nhập nội dung" value="" readonly>{{ $baiViet->content }}</textarea>
                    </div>
                  </div>
              
                </div>
              </div>

              <!-- end card-body -->
              <div class="card-footer">
                <a href="{{ route('admin.report.danhsachbaocaobaiviet') }}" class="btn btn-primary">Quay lại</a>
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