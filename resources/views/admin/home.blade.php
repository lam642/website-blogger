@include('admin.layout.header')
@include('admin.layout.navbar')
@include('admin.layout.sidebar')

<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Dashboard Admin</h1>
                </div><div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Dashboard</li>
                    </ol>
                </div></div></div></div>
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-3 col-6">
                    <div class="small-box bg-info">
                        <div class="inner">
                            <h3>{{ $tongSoTaiKhoan }}</h3>
                            <p>Tổng số Tài khoản</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-person-add"></i>
                        </div>
                        <a href="{{ route('admin.taikhoan.index') }}" class="small-box-footer">Truy cập vào danh sách tài khoản <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <div class="col-lg-3 col-6">
                    <div class="small-box bg-success">
                        <div class="inner">
                            <h3>{{ $tongSoBaiVietDaDuyet }}</h3>
                            <p>Bài viết đã duyệt</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-document"></i>
                        </div>
                        <a href="{{ route('admin.post.index') }}" class="small-box-footer">Truy cập vào danh sách bài viết <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <div class="col-lg-3 col-6">
                    <div class="small-box bg-warning">
                        <div class="inner">
                            <h3>{{ $tongSoBaiVietChoDuyet }}</h3>
                            <p>Bài viết chờ duyệt</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-clock"></i>
                        </div>
                        <a href="{{ route('admin.post.index') }}" class="small-box-footer">Truy cập vào danh sách bài viết <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <div class="col-lg-3 col-6">
                    <div class="small-box bg-danger">
                        <div class="inner">
                            <h3>{{ $tongSoBinhLuanDaDuyet }}</h3>
                            <p>Tổng số Bình luận</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-chatboxes"></i>
                        </div>
                        <a href="{{ route('admin.comment.index') }}" class="small-box-footer">Truy cập vào danh sách bình luận <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <div class="col-lg-3 col-6">
                    <div class="small-box bg-primary">
                        <div class="inner">
                            <h3>{{ $tongSoTag }}</h3>
                            <p>Tổng số Thẻ (Tags)</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-pricetags"></i>
                        </div>
                        <a href="{{ route('admin.tag.index') }}" class="small-box-footer">Truy cập vào danh sách thẻ <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <div class="col-lg-3 col-6">
                    <div class="small-box bg-secondary">
                        <div class="inner">
                            <h3>{{ $tongSoDanhMuc }}</h3>
                            <p>Tổng số Danh mục</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-folder"></i>
                        </div>
                        <a href="{{ route('admin.danhmuc.index') }}" class="small-box-footer">Truy cập vào danh sách danh mục <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <div class="col-lg-3 col-6">
                    <div class="small-box bg-info">
                        <div class="inner">
                            <h3>{{ $tongSoReaction }}</h3>
                            <p>Tổng số Reaction</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-happy"></i>
                        </div>
                        <a href="{{ route('admin.reaction.index') }}" class="small-box-footer">Truy cập vào danh sách reaction <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="card card-primary card-outline">
                        <div class="card-header">
                            <h3 class="card-title">Thống kê tổng quan</h3>
                        </div>
                        <div class="card-body">
                            <canvas id="userStatsChart" style="height:250px; min-height:250px"></canvas>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card card-info card-outline">
                        <div class="card-header">
                            <h3 class="card-title">Thống kê cảm xúc (Reaction)</h3>
                        </div>
                        <div class="card-body">
                            <canvas id="postStatsChart" style="height:250px; min-height:250px"></canvas>
                        </div>
                    </div>
                        <p>Dánh sách cảm xúc</p>
                    @php
                    $reactionTypes = [
                            'like' => ['👍 Thích', 'btn-outline-primary'],
                            'love' => ['❤️ Yêu', 'btn-outline-danger'],
                            'haha' => ['😂 Haha', 'btn-outline-warning'],
                            'wow' => ['😮 Wow', 'btn-outline-info'],
                            'sad' => ['😢 Buồn', 'btn-outline-secondary'],
                            'angry' => ['😡 Giận', 'btn-outline-dark'],
                        ];
                @endphp
                @foreach ($reactionTypes as $type => [$label, $btnClass])
                        @php
                            $match = $countReactionType->firstWhere('type', $type);
                            $total = $match ? $match->total : 0;
                        @endphp
                            <button name="type" value="{{ $type }}" class="btn {{ $btnClass }}">
                                {{ $label }} {{ $total > 0 ? $total : '' }}
                            </button>
                @endforeach
            </div>
                </div>
              
            <div class="row">
                <div class="col-md-6">
                    <div class="card card-success card-outline">
                        <div class="card-header">
                            <h3 class="card-title">Danh sách tên tài khoản (ví dụ)</h3>
                        </div>
                        <div class="card-body">
                            <ul>
                                @foreach($danhSachTenTaiKhoan as $ten)
                                    <li>{{ $ten }}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card card-warning card-outline">
                        <div class="card-header">
                            <h3 class="card-title">Danh sách tiêu đề bài viết (đã duyệt)</h3>
                        </div>
                        <div class="card-body">
                            <ul>
                                @foreach($danhSachTieuDeBaiVietDaDuyet as $tieuDe)
                                    <li>{{ $tieuDe }}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            </div></section>
    </div>
@include('admin.layout.footer')

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    // Dữ liệu từ Laravel PHP cho biểu đồ tổng quan
    const tongSoTaiKhoan = {{ $tongSoTaiKhoan }};
    const tongSoBaiVietDaDuyet = {{ $tongSoBaiVietDaDuyet }};
    const tongSoBaiVietChoDuyet = {{ $tongSoBaiVietChoDuyet }};
    const tongSoBinhLuanDaDuyet = {{ $tongSoBinhLuanDaDuyet }};
    const tongSoReaction = {{ $tongSoReaction }};
    const tongSoTag = {{ $tongSoTag }};
    const tongSoDanhMuc = {{ $tongSoDanhMuc }};


    // Lấy context của canvas cho biểu đồ tổng quan
    const ctx1 = document.getElementById('userStatsChart').getContext('2d');

    // Tạo biểu đồ cột
    new Chart(ctx1, {
        type: 'bar',
        data: {
            labels: [
                'Tài khoản',
                'Bài viết (Duyệt)',
                'Bài viết (Chờ)',
                'Bình luận',
                'Reaction',
                'Thẻ (Tags)',
                'Danh mục'
            ],
            datasets: [{
                label: 'Tổng số lượng',
                data: [
                    tongSoTaiKhoan,
                    tongSoBaiVietDaDuyet,
                    tongSoBaiVietChoDuyet,
                    tongSoBinhLuanDaDuyet,
                    tongSoReaction,
                    tongSoTag,
                    tongSoDanhMuc
                ],
                backgroundColor: [
                    'rgba(75, 192, 192, 0.6)', // Xanh ngọc
                    'rgba(54, 162, 235, 0.6)', // Xanh dương
                    'rgba(255, 206, 86, 0.6)', // Vàng
                    'rgba(153, 102, 255, 0.6)', // Tím
                    'rgba(255, 99, 132, 0.6)', // Đỏ
                    'rgba(0, 123, 255, 0.6)',  // Xanh dương đậm hơn
                    'rgba(108, 117, 125, 0.6)' // Xám
                ],
                borderColor: [
                    'rgba(75, 192, 192, 1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 206, 86, 1)',
                    'rgba(153, 102, 255, 1)',
                    'rgba(255, 99, 132, 1)',
                    'rgba(0, 123, 255, 1)',
                    'rgba(108, 117, 125, 1)'
                ],
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            scales: {
                y: {
                    beginAtZero: true
                }
            },
            plugins: {
                title: {
                    display: true,
                    text: 'Thống kê tổng quan'
                }
            }
        }
    });

    // Biểu đồ Pie/Doughnut cho thống kê Reaction theo loại
    const thongKeReactionTheoLoai = @json($thongKeReactionTheoLoai);

    const reactionLabels = Object.keys(thongKeReactionTheoLoai);
    const reactionData = Object.values(thongKeReactionTheoLoai);

    const ctx2 = document.getElementById('postStatsChart').getContext('2d');

    new Chart(ctx2, {
        type: 'pie',
        data: {
            labels: reactionLabels,
            datasets: [{
                label: 'Số lượng Reaction',
                data: reactionData,
                backgroundColor: [
                    'rgba(255, 99, 132, 0.6)', // Đỏ
                    'rgba(54, 162, 235, 0.6)', // Xanh dương
                    'rgba(255, 206, 86, 0.6)', // Vàng
                    'rgba(75, 192, 192, 0.6)', // Xanh ngọc
                    'rgba(153, 102, 255, 0.6)', // Tím
                    'rgba(255, 159, 64, 0.6)' // Cam
                ],
                borderColor: [
                    'rgba(255, 99, 132, 1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 206, 86, 1)',
                    'rgba(75, 192, 192, 1)',
                    'rgba(153, 102, 255, 1)',
                    'rgba(255, 159, 64, 1)'
                ],
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                title: {
                    display: true,
                    text: 'Thống kê cảm xúc (Reaction)'
                }
            }
        }
    });
</script>

<script>
    // Đảm bảo jQuery và DataTable JS đã được tải TRƯỚC đoạn script này.
    // Nếu bạn đang dùng AdminLTE, thì jQuery và DataTable thường được tải qua footer.blade.php.
    $(function () {
        // Chỉ khởi tạo nếu phần tử tồn tại
        if ($("#example1").length) {
            $("#example1").DataTable({
                "responsive": true, "lengthChange": false, "autoWidth": false,
                "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
            }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
        }
        if ($('#example2').length) {
            $('#example2').DataTable({
                "paging": true,
                "lengthChange": false,
                "searching": false,
                "ordering": true,
                "info": true,
                "autoWidth": false,
                "responsive": true,
            });
        }
    });
</script>