<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use App\Models\Post;
use App\Models\Tag;
use App\Models\Category;
use App\Models\SaveArticle;
use DB;
use GrahamCampbell\ResultType\Success;
use Illuminate\Http\Request;

class PostClientController extends Controller
{
      public function chiTietBaiViet(Request $request, $slug, $id) {
        // Lấy bài viết id và người dùng viết bài
         $baiViet = Post::with('user', 'tags')->where('id', $id)->firstOrFail();
         $countReactionType = DB::table('reactions')
                            ->select('type', DB::raw('COUNT(id) AS total'))
                            ->where('post_id', $baiViet->id)
                            ->groupBy('type')
                            ->pluck('total', 'type');

        
        if($baiViet->status == 'published') {
         $baiViet->increment('view_count');
         }
         $comments = Comment::where('post_id', $baiViet->id)->orderBy('created_at', 'desc')->paginate(10);
         
         // Kiểm tra xem người dùng đã lưu bài viết này chưa
         $isSaved = false;
         if (auth()->check()) {
             $isSaved = SaveArticle::where('user_id', auth()->id())
                                  ->where('post_id', $baiViet->id)
                                  ->exists();
         }
         
        return view('client.chitietbaiviet', compact('baiViet', 'comments', 'countReactionType', 'isSaved'));
    }

    public function search(Request $request) {
        $query = Post::query();
        if(filled($request->input('search')))
        {
            $query->where('title', 'like', '%' . $request->input('search') . '%');
        }
        // Lấy các bài viết người dùng đã được duyệt đăng
        $baiVietTimKiems = $query->with('user')->where("status",'published')->orderBy("created_at","desc")->paginate(10);
        $tuKhoaTimKiem = $request->input('search');
        return view('client.search_results', compact('baiVietTimKiems', 'tuKhoaTimKiem'));
    }
    public function fillterTag(Request $request, $slug) {
        // Lấy tag theo slug
        $tag = Tag::where('slug', $slug)->firstOrFail();
        // Lấy các bài viết đã được duyệt đăng có gắn tag này
        $baiVietTimKiems = $tag->posts()->where('status', 'published')->with('user')->orderBy('created_at', 'desc')->paginate(10);
        $tagTimKiem = $tag->name;
        return view('client.search_results', compact('baiVietTimKiems', 'tagTimKiem'));
    }

    public function savePost(Request $request) {
        // Kiểm tra đăng nhập
        if (!auth()->check()) {
            return response()->json([
                'success' => false,
                'message' => 'Bạn cần đăng nhập để lưu bài viết!'
            ]);
        }

        // Validate dữ liệu
        $request->validate([
            'post_id' => 'required|exists:posts,id'
        ], [
            'post_id.required' => 'ID bài viết là bắt buộc',
            'post_id.exists' => 'Bài viết không tồn tại'
        ]);

        $userId = auth()->id();
        $postId = $request->post_id;

        // Kiểm tra xem đã lưu bài viết này chưa
        $existingSave = SaveArticle::where('user_id', $userId)
                                  ->where('post_id', $postId)
                                  ->first();

        if ($existingSave) {
            // Nếu đã lưu thì xóa (toggle)
            $existingSave->delete();
            return response()->json([
                'success' => true,
                'message' => 'Đã bỏ lưu bài viết!',
                'saved' => false
            ]);
        } else {
            // Nếu chưa lưu thì thêm mới
            SaveArticle::create([
                'user_id' => $userId,
                'post_id' => $postId,
                'status' => 1
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Đã lưu bài viết thành công!',
                'saved' => true
            ]);
        }
    }

    public function danhSachDaLuu(Request $request) {
        if(!auth()->user()) {
            return response([
                'success' => false,
                'message' => 'Bạn cần đăng nhập'
            ]);
        }

        $user = auth()->user();
        $existingSaves = SaveArticle::where('user_id', $user->id)
        ->with('post')
        ->paginate(5);

        return view('client.baiviet.danhsachdaluu', compact('existingSaves'));
    }
    
    public function destroySavePost(Request $request, $id) {
        // Kiểm tra đăng nhập
        if (!auth()->check()) {
            if ($request->ajax()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Bạn cần đăng nhập để thực hiện thao tác này'
                ], 401);
            }
            return redirect()->route('login')->with('error', 'Bạn cần đăng nhập để thực hiện thao tác này');
        }

        try {
            // Tìm record SaveArticle
            $saveArticle = SaveArticle::findOrFail($id);
            
            // Kiểm tra quyền: chỉ người tạo mới được xóa
            if ($saveArticle->user_id !== auth()->id()) {
                if ($request->ajax()) {
                    return response()->json([
                        'success' => false,
                        'message' => 'Bạn không có quyền xóa bài viết này'
                    ], 403);
                }
                return redirect()->back()->with('error', 'Bạn không có quyền xóa bài viết này');
            }

            // Thực hiện xóa
            $deleted = $saveArticle->delete();
            
            if ($deleted) {
                if ($request->ajax()) {
                    return response()->json([
                        'success' => true,
                        'message' => 'Đã xóa bài viết khỏi danh sách đã lưu thành công!'
                    ]);
                }
                return redirect()->back()->with('success', 'Đã xóa bài viết khỏi danh sách đã lưu thành công!');
            } else {
                if ($request->ajax()) {
                    return response()->json([
                        'success' => false,
                        'message' => 'Có lỗi xảy ra khi xóa bài viết'
                    ], 500);
                }
                return redirect()->back()->with('error', 'Có lỗi xảy ra khi xóa bài viết');
            }
            
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            if ($request->ajax()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Không tìm thấy bài viết đã lưu'
                ], 404);
            }
            return redirect()->back()->with('error', 'Không tìm thấy bài viết đã lưu');
            
        } catch (\Exception $e) {
            if ($request->ajax()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Có lỗi xảy ra: ' . $e->getMessage()
                ], 500);
            }
            return redirect()->back()->with('error', 'Có lỗi xảy ra: ' . $e->getMessage());
        }
    }
}
