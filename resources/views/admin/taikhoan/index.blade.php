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
  @if(session('success'))
        <div class="alert alert-success">
          {{ session('success') }}
        </div>
      @endif

      @if(session('error'))
        <div class="alert alert-danger">
          {{ session('error') }}
        </div>
      @endif


    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Quản lí tài khoản </h1>
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
            <div class="card">
              <div class="card-header">
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>STT</th>
                    <th>Tên tài khoản</th>
                    <th>Email</th>
                    <th>ngày tạo</th>
                    <th>ngày khóa</th>
                    <th>Trạng thái</th>
                    <th>Thao tác</th>
                  </tr>
                  </thead>
                  <tbody>
                    @foreach ($users as $key => $user)
                      <tr>
                        <td>{{ $key + 1 }}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->created_at->format('d/m/Y') }}</td>
                        <td>
                            @if ($user->time_ban)
                                {{ \Carbon\Carbon::parse($user->time_ban)->format('d/m/Y') }}
                            @else
                                Không khóa
                            @endif
                        </td>
                          <td>{{ $user->is_banned == 'active' ? 'Hoạt động' : ($user->is_banned == 'banned' ? 'Khóa' : 'Khóa vĩnh viễn') }}</td>
                        <td>
                          <!--- Ban -->
                          <a href="{{ route('admin.taikhoan.ban', $user->id) }}">
                            <button class="btn btn-primary">
                              {{ $user->is_banned == 'active' ? 'Khóa' : ($user->is_banned == 'banned' ? 'Mở khóa' : 'Khóa vĩnh viễn') }}
                            </button>
                          </a>
                          <!--- Xóa -->
                          <form action="{{ route('admin.taikhoan.destroy', $user->id) }}" method="post" style="display: inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger" {{ $user->time_ban != null || $user->is_banned != 'active' ? 'disabled' : '' }} onclick="return confirm('Bạn có chắc chắn muốn xóa danh mục này không?')">
                              Xóa
                            </button>
                          </form>
                          <!--- Xem chi tiết -->
                          <a href="{{ route('admin.taikhoan.show', $user->id) }}">
                            <button class="btn btn-info">
                              Xem chi tiết
                            </button>
                          </a>
                        </td>
                        
                      </tr>
                    @endforeach
                  </tbody>
                  
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <!-- Footer -->
      @include('admin.layout.footer')
  <!-- end footer -->
  
<!-- Page specific script -->
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
