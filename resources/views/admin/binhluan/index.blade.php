
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
            <div class="card">
              <div class="card-header">
                
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>STT</th>
                    <th>Người bình luận</th>
                    <th>Ngày bình luận</th>
                    <th>Trạng thái</th>
                    <th>Thao tác</th>
                  </tr>
                  </thead>
                  <tbody>
                    @foreach ($comments as $key => $comment)
                  
                      <tr>
                        <td>{{ $key + 1 }}</td>
                        <td>{{ $comment->user->name ?? 'Không có người bình luận' }}</td>
                        <td>{{ $comment->created_at->format('d/m/Y') ?? '' }}</td>
                        <td>{{ $comment->is_approved == 'pending' ? 'Chưa duyệt' : ($comment->is_approved == 'approved' ? 'Duyệt' : ($comment->is_approved == 'refuse' ? 'Từ chối' : 'Spam')) }}</td>
                        <td>
                          <!--- Sửa -->
                          <a href="{{ route('admin.comment.edit', $comment->id) }}">
                            <button class="btn btn-primary">
                              Sửa
                            </button>
                          </a>
                          <!--- Xóa -->
                          <form action="{{ route('admin.comment.destroy', $comment->id) }}" method="post" style="display: inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger" {{ $comment->is_approved == '1' ? 'approved' : '' }} onclick="return confirm('Bạn có chắc chắn muốn xóa bình luận này không?')"
                            {{ $comment->is_approved == 'approved' ? 'disabled' : '' }}  >
                              Xóa
                            </button>
                          </form>
                          <!--- Xem -->
                          <a href="{{ route('admin.comment.show', $comment->id) }}">
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
