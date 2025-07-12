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
            <h1>Quản lí danh mục </h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">DataTables</li>
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
                <h3 class="card-title">Sửa danh mục </h3>
              </div>

              <form action="{{ route('admin.danhmuc.update', $category->id) }}" method="POST">
                @csrf
                <div class="card-body">
                  <div class="form-group">
                    <label>Tên thẻ</label>
                    <input type="text" class="form-control" name="name" placeholder="Nhập tên thẻ" value=" {{ $category->name }}">
                    @error('name')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                  </div>

                  <div class="form-group">
                    <label>Đường dẫn</label>
                    <input type="text" class="form-control" name="slug" placeholder="Nhập đường dẫn" value=" {{ $category->slug }}">
                    @error('slug')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                  </div>
                   
                  <div class="form-group">
                    <label>Trạng thái</label>
                    <select name="status" class="form-control" value=" {{ $category->status }}">
                      <option value="active" {{ $category->status == 'active' ? "selected" : "" }} >Hoạt động</option>  <!--Active: Hoạt động-->
                      <option value="inactive" {{ $category->status == 'inactive' ? "selected" : "" }}>Không hoạt động</option> <!--Inactive: Không hoạt động-->
                    </select>
                  </div>
                  @error('status')
                  <span class="text-danger">{{ $message }}</span>
                  @enderror
                </div>

                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Sửa danh mục</button>
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


<script>
  $(function () {
    $("#example1").DataTable({
      "responsive": true, "lengthChange": false, "autoWidth": false,
      "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
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
