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
          <h1>Chi tiết tài khoản: <strong>{{ $user->name }} </strong></h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">tài khoản</li>
          </ol>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-6">
          <img src="{{ asset('storage/'.$user->avatar) }}" style="width: 70%" alt=""
            onerror="this.onerror=null; this.src='https://icon-library.com/images/icon-user/icon-user-15.jpg'" width="100%">
        </div>
        <div class="col-6">
          <div class="container">
            <table class="table table-borderless">
              <tbody style="font-size: large;">
                <tr>
                  <th>Họ tên: </th>
                  <td>{{ $user->name }}</td>
                </tr>

                <tr>
                  <th>Email: </th>
                  <td>{{ $user->email }}</td>
                </tr>
                
                <tr>
                  <th>Trạng thái: </th>
                  <td>{{ $user->is_banned == 'active' ? 'Hoạt động' : ($user->is_banned == 'banned' ? 'Khóa' : 'Khóa vĩnh viễn') }}</td>
                </tr>
                @if( $user->is_banned == 'banned')
                <tr>
                  <th>Lý do cấm: </th>
                  <td>{{ $user->comment}}</td>
                </tr>

                 <tr>
                  <th>Thời gian khóa: </th>
                  <td>{{ $user->time_ban }}</td>
                </tr>
                @endif
              </tbody>
            </table>
          </div>
        </div>
        <div class="col-12">
          <hr>
          <br>
          <h2>Lịch sử bài viết</h2>
          <div>
            <table id="example1" class="table table-bordered table-striped">
              <thead>
                <tr>
                  <th>STT</th>
                  <th>Tên bài viết</th>
                  <th>Ngày đăng</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($user->posts as $key => $post)
                  <tr>
                    <td>{{ $key + 1 }}</td>
                    <td>{{ $post->title }}</td>
                    <td>{{ $post->created_at }}</td>
                  </tr>
                @endforeach
              </tbody>
             
            </table>
          </div>
        </div>

        <div class="col-12">
          <hr>
          <br>
          <h2>Lịch sử bình luận</h2>
          <div>
          <table id="example2" class="table table-bordered table-striped">
          <thead>
        <tr>
          <th>ID</th>
          <th>Người bình luận</th>
          <th>Nội dung</th>
          <th>Ngày bình luận</th>
          <th>Thao tác</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($user->comments as $comment)
        <tr>
          <td>{{ $comment->id }}</td>
          <td>{{ $comment->user->name }}</td>
          <td>{{ $comment->content }}</td>
          <td>{{ $comment->created_at->format('d/m/Y') ?? "" }}</td>
          <td>
            <form action="{{ route('admin.comment.toggleStatus', $comment->id) }}" method="post">
              @csrf 
              @method('PUT')
              @if($comment->is_approved	 == 'approved')
              <button class="btn btn-primary">👁️</button>
              @else
              <button class="btn btn-primary">🚫</button>
              @endif
            </form>
          </td>

        </tr>
        @endforeach
      </tbody>
             
            </table>
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



