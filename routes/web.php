<?php

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\LienHeController;
use App\Http\Controllers\Admin\PostController;
use App\Http\Controllers\Admin\ReactionController;
use App\Http\Controllers\Admin\ReportController;
use App\Http\Controllers\Admin\TagController;
use App\Http\Controllers\Admin\CommentController;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\TaiKhoanController;
use App\Http\Controllers\Client\BaiVietCaNhanController;
use App\Http\Controllers\Client\BaoCaoClientController;
use App\Http\Controllers\Client\PostClientController;
use App\Http\Controllers\Client\ReactionClientController;
use App\Http\Controllers\Client\TaiKhoanClientController;





Route::prefix( '/admin')->group(function () {

    Route::get('/login', [AuthController::class, 'login'])->name('admin.login');
    Route::post('check/login', [AuthController::class, 'checkLogin'])->name('admin.checkLogin');
    Route::get('/logout', [AuthController::class, 'logout'])->name('admin.logout');
    
    Route::middleware('checkAdmin')->group(function () {
    // Trang chủ thông kê

    // trang chủ thông kê
    Route::get('/thong-ke', [HomeController::class, 'index'])->name('admin.home');


    // danh mục
    Route::get('/danhmuc', [CategoryController::class, 'index'])->name('admin.danhmuc.index');
    Route::get('/danhmuc/create', [CategoryController::class, 'create'])->name('admin.danhmuc.create');
    Route::post('/danhmuc/store', [CategoryController::class, 'store'])->name('admin.danhmuc.store');
    Route::get('/danhmuc/edit/{id}', [CategoryController::class, 'edit'])->name('admin.danhmuc.edit');
    Route::put('/danhmuc/update/{id}', [CategoryController::class, 'update'])->name('admin.danhmuc.update');
    Route::get('/danhmuc/show/{id}', [CategoryController::class, 'show'])->name('admin.danhmuc.show');
    Route::delete('/danhmuc/destroy/{id}', [CategoryController::class, 'destroy'])->name('admin.danhmuc.destroy');
    Route::get('/danhmuc/trash', [CategoryController::class, 'trash'])->name('admin.danhmuc.trash');
    Route::get('/danhmuc/restore/{id}', [CategoryController::class, 'restore'])->name('admin.danhmuc.restore');
    Route::delete('/danhmuc/force-delete/{id}', [CategoryController::class, 'forceDelete'])->name('admin.danhmuc.force-delete');

    // tag
    Route::get('/tag', [TagController::class, 'index'])->name('admin.tag.index');
    Route::get('/tag/create', [TagController::class, 'create'])->name('admin.tag.create');
    Route::post('/tag/store', [TagController::class, 'store'])->name('admin.tag.store');
    Route::get('/tag/edit/{id}', [TagController::class, 'edit'])->name('admin.tag.edit');
    Route::put('/tag/update/{id}', [TagController::class, 'update'])->name('admin.tag.update');
    Route::delete('/tag/destroy/{id}', [TagController::class, 'destroy'])->name('admin.tag.destroy');

    // Bài viết
    Route::get('/post', [PostController::class, 'index'])->name('admin.post.index');
    Route::get('/post/create', [PostController::class, 'create'])->name('admin.post.create');
    Route::post('/post/store', [PostController::class, 'store'])->name('admin.post.store');
    Route::get('/post/show/{id}', [PostController::class, 'show'])->name('admin.post.show');
    Route::get('/post/edit/{id}', [PostController::class, 'edit'])->name('admin.post.edit');
    Route::put('/post/update/{id}', [PostController::class, 'update'])->name('admin.post.update');
    Route::delete('/post/destroy/{id}', [PostController::class, 'destroy'])->name('admin.post.destroy');

    // Bình luận
    Route::get('/comment', [CommentController::class, 'index'])->name('admin.comment.index');
    Route::get('/comment/edit/{id}', [CommentController::class, 'edit'])->name('admin.comment.edit');
    Route::put('/comment/update/{id}', [CommentController::class, 'update'])->name('admin.comment.update');
    Route::get('/comment/show/{id}', [CommentController::class, 'show'])->name('admin.comment.show');
    Route::delete('/comment/destroy/{id}', [CommentController::class, 'destroy'])->name('admin.comment.destroy');
    Route::put('/comment/toggle-status/{id}', [CommentController::class, 'toggleStatus'])->name('admin.comment.toggleStatus');   


    // reaction
    Route::get('/reaction', [ReactionController::class, 'index'])->name('admin.reaction.index');
    Route::get('/reaction/create', [ReactionController::class, 'create'])->name('admin.reaction.create');
    Route::post('/reaction/store', [ReactionController::class, 'store'])->name('admin.reaction.store');
    Route::get('/reaction/edit/{id}', [ReactionController::class, 'edit'])->name('admin.reaction.edit');
    Route::put('/reaction/update/{id}', [ReactionController::class, 'update'])->name('admin.reaction.update');
    Route::delete('/reaction/destroy/{id}', [ReactionController::class, 'destroy'])->name('admin.reaction.destroy');
    
    // Quản lý tài khoản
    Route::get('/tai-khoan', [TaiKhoanController::class, 'index'])->name('admin.taikhoan.index');
    Route::get('/tai-khoan/ban/{id}', [TaiKhoanController::class, 'ban'])->name('admin.taikhoan.ban');
    Route::put('/tai-khoan/update/{id}', [TaiKhoanController::class, 'update'])->name('admin.update.ban');
    Route::get('/tai-khoan/show/{id}', [TaiKhoanController::class, 'show'])->name('admin.taikhoan.show');
    Route::delete('/tai-khoan/destroy/{id}', [TaiKhoanController::class, 'destroy'])->name('admin.taikhoan.destroy');

    // Report 
    Route::get('/report/bai-viet', [ReportController::class, 'danhSachBaoCaoBaiViet'])->name('admin.report.danhsachbaocaobaiviet');
    Route::get('/report/bai-viet/chi-tiet-bao-cao-bai-viet/{id}', [ReportController::class, 'chiTietBaoCaoBaiViet'])->name('admin.report.chitietbaocao');
    Route::delete('/delete/bao-cao/{id}', [ReportController::class, 'delete'])->name('admin.report.delete');


    Route::get('/report/binh-luan', [ReportController::class, 'danhSachBaoCaoBinhLuan'])->name('admin.report.danhsachbaocaobinhluan');
    Route::get('/report/binh-luan/chi-tiet-binh-luan/{id}', [ReportController::class, 'chiTietBaoCaoBinhLuan'])->name('admin.report.chitietbaocaobinhluan');

    // Quản lý liên hê
    Route::get('/lien-he', [LienHeController::class, 'index'])->name('admin.lienhe.index');
    Route::get('/chi-tie-lien-he/{id}', [LienHeController::class, 'chiTietLienHe'])->name('admin.lienhe.chiTietLienHe');
    Route::delete('/destroy-lien-he/{id}', [LienHeController::class, 'destroy'])->name('admin.lienhe.destroy');

   
    });
});





















///////////////////////////////////////////////////////// Khách hàng /////////////////////////////////////////////////////////

use App\Http\Controllers\Client\HomeClientController;
use App\Http\Controllers\Client\AuthClientController;
use App\Http\Controllers\Client\CommentClentController;
use App\Http\Controllers\Client\LienClientHeController;
use App\Http\Controllers\GoogleController;


// Đăng ký, đăng nhập, đăng xuất
Route::get('/register', [AuthClientController::class, 'register'])->name('register');
Route::post('/check/register', [AuthClientController::class, 'checkRegister'])->name('checkregister');

Route::get('/login', [AuthClientController::class, 'login'])->name('login');
Route::post('/check/login', [AuthClientController::class, 'checkLogin'])->name('checklogin');

Route::post('/logout', [AuthClientController::class, 'logout'])->name('logout');

// Trang chủ, chi tiết bài viết, tìm kiếm, tài khoản
Route::get('/', [HomeClientController::class, 'index'])->name('home');
Route::get('/filter-category', [HomeClientController::class, 'filterByCategory'])->name('filter.category');
Route::get('/chi-tiet-bai-viet/{slug}/{id}', [PostClientController::class,'chiTietBaiViet'])->name('chitietbaiviet');
Route::get('/search', [PostClientController::class, 'search'])->name('search');
Route::get('/search/tag/{slug}', [PostClientController::class, 'fillterTag'])->name('fillterTag');
Route::get('/tai-khoan', [TaiKhoanClientController::class, 'taiKhoan'])->name('taikhoan');
Route::post('/comment-store', [CommentClentController::class, 'commentStore'])->name('comment.store');   
Route::delete('/comment-destroy/{id}', [CommentClentController::class, 'destroy'])->name('comment.destroy');   

// Route::get('/comment-delete/{id}', [CommentClentController::class, 'commentDelete'])->name('comment.delete');

// Reaction
Route::post('/reaction', [ReactionClientController::class, 'reaction'])->name('reaction');

// Báo cáo 
Route::post('/bao-cao/bai-viet', [BaoCaoClientController::class, 'baoCaoBaiViet'])->name('baocao.baiviet');
Route::post('/bao-cao/binh-luan/{id}', [BaoCaoClientController::class, 'baoCaoBinhLuan'])->name('baocao.comment');


 // Thay đổi thông tin tài khoản
 Route::put('/thay-doi-thong-tin/tai-khoan/{id}', [TaiKhoanClientController::class, 'chinhSuaTaiKhoan'])->name('chinhSuaTaiKhoan');

 // Đăng nhập bằng google

Route::get('/auth/google', [GoogleController::class, 'redirectToGoogle'])->name('google.login');
Route::get('/auth/google/callback', [GoogleController::class, 'handleGoogleCallback']);

// Đăng bài 
Route::get('/from-dang-bai', [BaiVietCaNhanController::class, 'formDangBai'])->name('formDangBai');
Route::post('/post-bai-biet', [BaiVietCaNhanController::class, 'postBaiViet'])->name('postBaiViet');

Route::get('/danh-sach-ca-nhan', [BaiVietCaNhanController::class, 'danhSachCaNhan'])->name('danhSachCaNhan');
Route::get('/bai-viet/edit/{id}', [BaiVietCaNhanController::class, 'edit'])->name('baiviet.edit');
Route::put('/bai-viet/update/{id}', [BaiVietCaNhanController::class, 'update'])->name('baiviet.update');
Route::delete('/bai-viet/destroy/{id}', [BaiVietCaNhanController::class, 'destroy'])->name('baiviet.destroy');  

// liên hệ
Route::get('/lien-he', [LienClientHeController::class,'lienHe'])->name('lienHe');
Route::post('/post-lien-he', [LienClientHeController::class,'postLienHe'])->name(name: 'postLienHe');

// Đổi mật khẩu gửi bằng mail
Route::get('/form-mail', [HomeClientController::class,'formMail'])->name('formMail');
Route::post('/check-mail', [HomeClientController::class,'checkMail'])->name('checkMail');
Route::get('/from-doi-mat-khau', [HomeClientController::class,'fromDoiMatKhau'])->name('fromDoiMatKhau');
Route::post('/post-doi-mat-khau', [HomeClientController::class,'postDoiMatKhau'])->name('postDoiMatKhau');

// Lưu bài viết
Route::post('/luu-bai-viet',  [PostClientController::class,'savePost'])->name('savePost');
Route::get('/danh-sach-luu',  [PostClientController::class,'danhSachDaLuu'])->name('danhSachDaLuu');
Route::delete('/xoa-danh-sach-luu/{id}',  [PostClientController::class,'destroySavePost'])->name('destroySavePost');


