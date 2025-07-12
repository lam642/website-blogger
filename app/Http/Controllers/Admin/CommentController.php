<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{

    public function index() {

        $comments = Comment::with('post', 'user')->orderBy('id', 'desc')->get();
      
        return view('admin.binhluan.index', compact('comments'));
    }

    public function edit($id) {
        
        $comment = Comment::with('post', 'user')->find($id);
        return view('admin.binhluan.edit', compact('comment'));
    }

    public function update(Request $request, $id) {
        // Lấy id comment
        $comment = Comment::find($id);
        // Kiểm tra id comment tồn tại
        if(!$comment) {
            return redirect()->back()->with('error', 'Bình luận không tồn tại');
        }
        $request->validate([
            'is_approved' => 'required',
        ], [
            'is_approved.required' => 'Vui lòng chọn trạng thái',
        ]);
        $comment->is_approved = $request->is_approved;
        $comment->save();
        return redirect()->route('admin.comment.index')->with('success', 'Cập nhật trạng thái bình luận thành công');
    }
    public function show($id) {
        // Lấy id comment
        $comment = Comment::with('post', 'user')->find($id);
        // Kiểm tra id comment tồn tại

        if(!$comment) {
            return redirect()->back()->with('error', 'Bình luận không tồn tại');
        }
        return view('admin.binhluan.show', compact('comment'));
    }



    public function destroy($id) {
        // Lấy id comment
        $comment = Comment::find($id);
        // Kiểm tra id comment có tồn tại không
        if(!$comment) {
            return redirect()->back()->with('error', 'Bình luận không tồn tại');
        }
        $comment->delete();
        return redirect()->back()->with('success', 'Xóa bình luận thành công');
    }

    public function toggleStatus($id) {
        // sử dụng findOrFail thực hiện tra lỗi 404 khi không có id comment nào
       $comment = Comment::findOrFail($id);
    
        // Cập nhập trạng thái comment là approved thành pending và ngược lại
       $comment->is_approved = $comment->is_approved === 'approved' ? 'pending' : 'approved';
       // Thực hiện lưu
       $comment->save();

        return redirect()->back()->with('success', 'Đã cập nhật trạng thái bình luận.');
    }
}
