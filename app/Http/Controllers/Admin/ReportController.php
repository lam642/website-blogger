<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Comment;
use App\Models\Post;
use App\Models\Report;
use App\Models\User;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function danhSachBaoCaoBaiViet() {
        $danhSachBaoCaoBaiViets = Report::query()->whereNull('comment_id')->orderBy('created_at', 'desc')->get();
        return view('admin.report.danhsachbaocaobaiviet', compact('danhSachBaoCaoBaiViets'));
    }

    public function chiTietBaoCaoBaiViet($id) {
        $baoCaoBaiViet = Report::query()->whereNull('comment_id')->first(); // Lấy những comment_id là null 
        // Kiểm tra id có tồn tại hay không
        if(!$baoCaoBaiViet) {
            return redirect()->back()->with('error', 'Không có báo cáo bài viết nào');
        }
        $user = User::where('id', $baoCaoBaiViet->user_id)->first(); // Lấy id người dùng báo cáo
        $baiViet = Post::where('id', $baoCaoBaiViet->post_id)->first();// Lấy id bài viết báo cáo
        return view('admin.report.chitietbaocaobaiviet', compact('baoCaoBaiViet', 'user', 'baiViet'));
    }

      public function danhSachBaoCaoBinhLuan() {
        $danhSachBaoCaoBinhLuans = Report::query()->whereNotNull('comment_id')->orderBy('created_at', 'desc')->get();
        return view('admin.report.danhsachbaocaobinhluan', compact('danhSachBaoCaoBinhLuans'));
    }

       public function chiTietBaoCaoBinhLuan($id) {
        $baoCaoBinhLuan = Report::query()->whereNotNull('comment_id')->first();
        if(!$baoCaoBinhLuan) {
            return redirect()->back()->with('error', 'Không có báo cáo bài viết nào');
        }
        $user = User::where('id', $baoCaoBinhLuan->user_id)->first();
        $baiViet = Post::where('id',  $baoCaoBinhLuan->post_id)->first();
        $comment = Comment::where('id',  $baoCaoBinhLuan->comment_id)->first();
        return view('admin.report.chitietbaocaobinhluan', compact('baoCaoBinhLuan', 'user', 'baiViet', 'comment'));
    }

    public function delete($id) {
        // Lấy id báo cáo 
        $baoCao = Report::findOrFail($id);
        $baoCao->delete();
        return  redirect()->back()->with('success', 'Xóa thành công');
    }
}