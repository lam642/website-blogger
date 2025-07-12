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
            <h1>Quản lí danh mục </h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Reaction</li>
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
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>STT</th>
                    <th>Kiểu</th>
                    <th>Tiêu đề bài viết</th>
                    <th>Tên người dùng</th>
                    <th>Thao tác</th>
                  </tr>
                  </thead>
                  <tbody>
                    @foreach ($reactions as $key => $reaction)
                      <tr>
                        <td>{{ $key + 1 }}</td>
                        <td>
                            {{ 
                                $reaction->type == 'like' ? 'like 👍' :
                                ($reaction->type == 'love' ? 'love ❤️' :
                                ($reaction->type == 'haha' ? 'haha 😂' :
                                ($reaction->type == 'wow' ? 'wow 😮' :
                                ($reaction->type == 'sad' ? 'sad 😢' :
                                ($reaction->type == 'angry' ? 'angry 😡' : '❓')))))
                            }}
                        </td>

                        <td>{{ $reaction->post->title }}</td>
                        <td>{{ $reaction->user->name }}</td>
                        <td>

                     
                          <!--- Sửa -->
                          <!-- <a href="{{ route('admin.reaction.edit', $reaction->id) }}">
                            <button class="btn btn-primary">
                              Sửa
                            </button>
                          </a> -->
                          <!--- Xóa -->
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
