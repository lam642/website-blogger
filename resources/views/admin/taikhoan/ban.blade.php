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
          <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Khóa tài khoản {{ $user->name }} </h3>
              </div>

              <form action="{{ route('admin.update.ban', $user->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="card-body">
                  <div class="form-group">
                    <label>Lý do khóa</label>
                    <textarea name="comment" class="form-control" rows="3" placeholder="Nhập lý do khóa" value=" {{ old('comment') }}"></textarea>
                    @error('comment')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                  </div>

                  <div class="form-group">
                    <label>Thời gian khóa</label>
                    <input type="date" class="form-control" name="time_ban" placeholder="Nhập thời gian khóa" value=" {{ old('time_ban') }}">
                    @error('time_ban')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                  </div>
                   
                  <div class="form-group">
                <label>Trạng thái</label>
                <select name="status" class="form-control">
                    <option value="banned" {{ old('status') == 'banned' ? 'selected' : '' }}>Khóa</option>
                    <option value="active" {{ old('status') == 'active' ? 'selected' : '' }}>Hoạt động</option>
                </select>
                @error('status')
                <span class="text-danger">{{ $message }}</span>
                @enderror
                </div>

                </div>

                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Khóa tài khoản</button>
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



