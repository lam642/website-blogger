<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use App\Models\Post;
use App\Models\User;
use App\Models\Reaction;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    
        public function index()
        {
            // 1. Lấy tất cả các bản ghi theo điều kiện để sau đó count() và pluck()
            $users = DB::table('users')->where('role', 'user')->where('is_banned', 'active')->get(); // Hoặc '0' hoặc 'inactive' tùy cách bạn lưu trữ
            $postsPublished = DB::table('posts')->where('status', 'published')->get();
            $postsPending = DB::table('posts')->where('status', 'pending')->get();
            $commentsApproved = DB::table('comments')->where('is_approved', 'approved')->get(); // Hoặc '1' hoặc 'approved'
            $reactions = DB::table('reactions')->get(); // Lấy tất cả reactions
            $tagsActive = DB::table('tags')->where('status', 'active')->get();
            $categoriesActive = DB::table('categories')->where('status', 'active')->get();
    
            // 2. Thống kê tổng số lượng (để hiển thị số)
            $tongSoTaiKhoan = $users->count();
            $tongSoBaiVietDaDuyet = $postsPublished->count();
            $tongSoBaiVietChoDuyet = $postsPending->count();
            $tongSoBinhLuanDaDuyet = $commentsApproved->count();
            $tongSoReaction = $reactions->count();
            $tongSoTag = $tagsActive->count();
            $tongSoDanhMuc = $categoriesActive->count();
    
    
            // 3. Chuyển đổi thành mảng để dùng cho biểu đồ hoặc danh sách chi tiết (nếu cần)
            // Lưu ý: pluck() lấy ra các giá trị từ cột được chỉ định
            $danhSachTenTaiKhoan = $users->pluck('email')->toArray(); // Lấy tên các tài khoản
    
            $danhSachTieuDeBaiVietDaDuyet = $postsPublished->pluck('title')->toArray();
            $danhSachTieuDeBaiVietChoDuyet = $postsPending->pluck('title')->toArray();
    
            $danhSachNoiDungBinhLuan = $commentsApproved->pluck('content')->toArray(); // Giả sử cột là 'content'
    
            // Thống kê Reaction theo loại (ví dụ: 'like', 'love', 'haha')
            // Cần giả định cột 'type' trong bảng 'reactions'
            $thongKeReactionTheoLoai = $reactions->groupBy('type')
                                                ->map(fn ($item) => $item->count())
                                                ->toArray();
    
            $danhSachTenTag = $tagsActive->pluck('name')->toArray();
            $danhSachTenDanhMuc = $categoriesActive->pluck('name')->toArray();
            
            // Lấy tất cả kiểu biểu cảm
            $countReactionType = Reaction::query()
            ->select('type', DB::raw('COUNT(id) as total'))
            ->groupBy('type')
            ->get();
    
    
            return view('admin.home', compact(
                'tongSoTaiKhoan',
                'tongSoBaiVietDaDuyet',
                'tongSoBaiVietChoDuyet',
                'tongSoBinhLuanDaDuyet',
                'tongSoReaction',
                'tongSoTag',
                'tongSoDanhMuc',
                'danhSachTenTaiKhoan', // Nếu bạn muốn dùng danh sách này cho biểu đồ/list
                'danhSachTieuDeBaiVietDaDuyet', // Nếu bạn muốn dùng danh sách này cho biểu đồ/list
                'danhSachTieuDeBaiVietChoDuyet', // Nếu bạn muốn dùng danh sách này cho biểu đồ/list
                'danhSachNoiDungBinhLuan', // Nếu bạn muốn dùng danh sách này cho biểu đồ/list
                'thongKeReactionTheoLoai', // Rất quan trọng cho biểu đồ tròn Reaction
                'danhSachTenTag', // Nếu bạn muốn dùng danh sách này cho biểu đồ/list
                'danhSachTenDanhMuc', // Nếu bạn muốn dùng danh sách này cho biểu đồ/list
                'countReactionType' // Nếu bạn muốn dùng danh sách này cho biểu đồ/list
            ));
        }
    
}
