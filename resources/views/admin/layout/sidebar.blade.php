<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="../../index3.html" class="brand-link">
      <img src="{{ asset('admin/assets/dist/img/AdminLTELogo.png') }}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8" >
      <span class="brand-text font-weight-light">ADMIN</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="{{ asset('admin/assets/dist/img/user2-160x160.jpg') }}" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
        </div>
      </div>

      <!-- SidebarSearch Form -->


      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
               <!-- Trang chủ -->
               <li class="nav-item">
              <a href="{{ route('admin.home') }}" class="nav-link">
              <i class="nav-icon fas fa-tachometer-alt"></i>
                <p>
                Trang chủ
                </p>
              </a>
            </li>

               <!-- Danh mục -->
               <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-file-alt"></i>
              <p> Quản lý danh mục </p>
              <i class="fas fa-angle-left right"></i>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ route('admin.danhmuc.index') }}" class="nav-link">
                  <i class="nav-icon fas fa-solid fa-minus"></i>
                  <p>Danh mục blog</p>
                </a>
              </li>
              
              <li class="nav-item">
                <a href="{{ route('admin.danhmuc.trash') }}" class="nav-link">
                <i class="nav-icon fas fa-solid fa-minus"></i>
                  <p>Danh mục bị xóa</p>
                </a>
              </li>
            </ul>
          </li>

        <!-- Quản lý tag -->
          <li class="nav-item">
          <a href="{{ route('admin.tag.index') }}" class="nav-link">
            <i class="nav-icon fas fa-tag"></i>
            <p>
              Quản lý tag
            </p>
          </a>
        </li>

         <!-- Quản lý bài viết -->
         <li class="nav-item">
          <a href="{{ route('admin.post.index') }}" class="nav-link">
            <i class="nav-icon fas fa-file-alt"></i>
            <p>Quản lý bài viết</p>
          </a>
        </li>


          <li class="nav-item">
            <a href="{{ route('admin.comment.index') }}" class="nav-link">
            <i class=" nav-icon fas fa-solid fa-comment"></i>
              <p>
                Quản lý bình luận
              </p>
            </a>
          </li>
          

        <!-- Quản lý reaction -->
              <!-- <li class="nav-item">
          <a href="{{ route('admin.reaction.index') }}" class="nav-link">
              <i class="nav-icon fas fa-solid fa-heart"></i>
              <p>
                  Quản lý Reaction
              </p>
          </a>
      </li>  -->
        
           <!-- Quản lý report -->
          <li class="nav-item">
              <a href="#" class="nav-link">
                  <i class="nav-icon fas fa-flag"></i> <!-- ICON phù hợp cho quản lý report -->
                  <p>Quản lý report</p>
                  <i class="fas fa-angle-left right"></i>
              </a>
              <ul class="nav nav-treeview">
                  <li class="nav-item">
                      <a href="{{ route('admin.report.danhsachbaocaobaiviet') }}" class="nav-link">
                          <i class="fas fa-file-alt nav-icon"></i> <!-- ICON cho bài viết -->
                          <p>Báo cáo bài viết</p>
                      </a>
                  </li>

                  <li class="nav-item">
                      <a href="{{ route('admin.report.danhsachbaocaobinhluan') }}" class="nav-link">
                          <i class="fas fa-comments nav-icon"></i> <!-- ICON cho bình luận -->
                          <p>Báo cáo bình luận</p>
                      </a>
                  </li>
              </ul>
          </li>

        

          <li class="nav-item">
            <a href="{{ route('admin.lienhe.index') }}" class="nav-link">
            <i class="nav-icon fas fa-solid fa-phone"></i>
              <p>
                Liên hệ
              </p>
            </a>
          </li>

              <li class="nav-item">
                <a href="{{ route('admin.taikhoan.index') }}" class="nav-link">
                <i class="nav-icon far fa-user"></i>
                <p>Quản lý tài khoản</p>
                </a>
              </li>

             
          </li>

        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

  <style>
    /* General sidebar styling */
.main-sidebar {
    background-color: #1d1d2c; /* Darker color for a sleek look */
}

.brand-link {
    background-color: #33334c;
    padding: 15px;
    display: flex;
    align-items: center;
    text-align: center;
}

.brand-link .brand-image {
    opacity: 1;
    margin-right: 10px;
}

.brand-text {
    color: #f0f0f0;
    font-weight: 600;
    font-size: 1.2em;
}

/* User Panel */
.user-panel {
    border-bottom: 1px solid rgba(255, 255, 255, 0.1);
}

.user-panel .image img {
    border-radius: 50%;
    border: 2px solid #ddd;
}

.user-panel .info a {
    color: #b8b8d0;
    font-weight: 600;
    font-size: 1em;
    margin-left: 10px;
}

/* Sidebar Menu Links */
.nav-sidebar > .nav-item > .nav-link {
    color: #c7c7e1;
    font-size: 1em;
    margin: 2px 0;
    padding: 10px 15px;
    transition: background 0.3s, color 0.3s;
}

.nav-sidebar > .nav-item > .nav-link:hover {
    background-color: #33334c;
    color: #ffffff;
}

.nav-sidebar .nav-icon {
      color: #b0b0d0;
  }

/* Treeview Menu */
.nav-treeview .nav-item .nav-link {
    padding-left: 35px;
    font-size: 0.95em;
}

.nav-treeview .nav-item .nav-link:hover {
    background-color: #2c2c3f;
    color: #e0e0f0;
}

.nav-treeview .nav-icon {
    color: #9494b8;
}

/* Active link styling */
.nav-sidebar > .nav-item > .nav-link.active {
    background-color: #44445c;
    color: #ffffff;
    border-left: 4px solid #ff8c00; /* Highlight active link */
}

.nav-sidebar > .nav-item > .nav-link.active .nav-icon {
    color: #ff8c00;
}

  </style>
