
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
            <h1>Quản lí liên hệ </h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Liên hệ</li>
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
             
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>STT</th>
                    <th>Người liên hệ</th>
                    <th>Email</th>
                    <th>Ngày liên hệ</th>
                    <th>Thao tác</th>
                  </tr>
                  </thead>
                  <tbody>
                    @foreach ($lienHes as $key => $lienHe)
                  
                      <tr>
                        <td>{{ $key + 1 }}</td>
                        <td>{{ $lienHe->name}}</td>
                        <td>{{ $lienHe->email}}</td>
                        <td>{{ $lienHe->created_at }}</td>
                        <td>
                      
                          <form action="{{ route('admin.lienhe.destroy', $lienHe->id) }}" method="post" style="display: inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger" onclick="return confirm('Bạn có chắc chắn muốn xóa bài viết này không?')">
                              Xóa
                            </button>
                          </form>

                          <a href="{{ route('admin.lienhe.chiTietLienHe', ['id' => $lienHe->id]) }}"><button class="btn btn-primary">Xem chi tiết</button></a
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
