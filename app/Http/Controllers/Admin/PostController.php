<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\PostRequest;
use App\Models\Category;
use App\Models\Comment;
use App\Models\Post;
use App\Models\Reaction;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use PHPUnit\Framework\Constraint\Count;

class PostController extends Controller
{
    public function index() {

        $posts = Post::with(['user', 'category'])->orderBy('id', 'desc')->get();

        return view('admin.baiviet.index', compact('posts'));
    }

    public function create() {
        $categories = Category::where('status', 'active')->get();
        $usersAdmin = Auth::user()->name; // Lấy tên người tạo bài ở đây là admin
        $tags = Tag::where('status', 'active')->get(); // trạng thái tag lấy là hoạt động
        return view('admin.baiviet.create', compact('categories', 'usersAdmin', 'tags'));
    }

    public function store(PostRequest $request) {
        $validated = $request->validated();

        // Lấy dữ liệu từ form
        $dataPost = $request->only('title', 'content', 'category_id', 'status', 'slug', 'user_id');
        $dataPost['user_id'] = 1;
        // Tạo slug nếu chưa có hoặc xử lý lại slug đã nhập
       if(empty($request->input('slug'))){
             $slug = Str::slug($request->input('title'), '-');
             $dataPost['slug'] = $slug;
        } else {
            $dataPost['slug'] = $request->input('slug');
        }
        // Xử lý ảnh nếu có
        if ($request->hasFile('thumbnail')) {
            $thumbnailPath = $request->file('thumbnail')->store('uploads/posts', 'public');
            $dataPost['thumbnail'] = $thumbnailPath;
        }
    
        // Tạo bài viết
        $post = Post::create($dataPost);
    
        // Gắn tag nếu có
        if ($request->has('tag_id')) {
            $post->tags()->sync($request->input('tag_id'));
        }
    
        if($post) {
            return redirect()->route('admin.post.index')->with('success', 'Bài viết đã được tạo thành công');
        } else {
            return redirect()->route('admin.post.index')->with('error', 'Bài viết đã được tạo thất bại');
        }
    }

    public function show($id) {
        // Lấy id của bài viết
        $post = Post::find($id);
        // Kiểm tra id bài viết
        if(!$post) {
            return redirect()->route('admin.post.index')->with('error', 'Bài viết không tồn tại');
        }
        $user = Auth::user(); // Lấy thông tin người dùng
        $tags = Tag::whereHas('posts', function ($query) use ($id) {
            $query->where('post_id', $id);
        })->get(); 
        $countReactionType = DB::table('reactions')
                    ->select('type', DB::raw('COUNT(id) as total'))
                    ->where('post_id', $post->id)
                    ->groupBy('type')
                    ->get();
                        
        $categories = Category::where('id', $post->category_id)->first();
        $comments = Comment::where('post_id', $id)->get();
        $countComment = Comment::where('post_id', $id)->count();
        // Đếm số người tương tác với bài viết
        $countReaction = Reaction::where('post_id', $id)->count();
        return view('admin.baiviet.show', compact('post', 'user', 'tags', 'categories', 'comments', 'countReaction', 'countComment', 'countReactionType'));
    }

    public function edit($id) {
        $post = Post::find($id);
        if(!$post) {
            return redirect()->route('admin.post.index')->with('error', 'Bài viết không tồn tại');
        }
        $categories = Category::where('status', 'active')->get();
        $tags = Tag::where('status', 'active')->get();
        $user = User::where('id', $post->user_id)->first();
        // $tags = Tag::whereHas('posts', function ($query) use ($id) {
        //     $query->where('post_id', $id);
        // })->get();

        $selectedTagIds = $post->tags->pluck('id')->toArray();
        return view('admin.baiviet.edit', compact('post', 'categories', 'user', 'tags', 'selectedTagIds'));
    }

    public function update(Request $request, $id) {
        // Lấy id 
        $post = Post::find($id);
        // Kiểm tra id
        if(!$post) {
            return redirect()->route('admin.post.index')->with('error', 'Bài viết không tồn tại');
        }
        // sử dụng validate để kiểm tra dữ liệu
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'category_id' => 'required|exists:categories,id',
            'slug' => 'required|string|max:255',
            'tag_id' => 'required|exists:tags,id',
            'thumbnail' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ], [
            'title.required' => 'Tiêu đề bài viết là bắt buộc',
            'title.string' => 'Tiêu đề bài viết phải là chuỗi',
            'title.max' => 'Tiêu đề bài viết không được vượt quá 255 ký tự',
            'content.required' => 'Nội dung bài viết là bắt buộc',
            'content.string' => 'Nội dung bài viết phải là chuỗi',
            'category_id.required' => 'Danh mục bài viết là bắt buộc',
            'category_id.exists' => 'Danh mục bài viết không tồn tại',
        ]);
        // lấy dữ liệu từ form
        $dataPost = $request->only('title', 'content', 'category_id', 'slug', 'user_id', 'status');
        // xử lý ảnh nếu có

        // kiểm tra người dùng có tải ảnh lên không
        if ($request->hasFile('thumbnail')) {
            //  kiểm tra ảnh cũ còn tồn tại không
            if($post->thumbnail && Storage::disk('public')->exists($post->thumbnail)) {
                // thực hiện xóa ảnh cũ
                Storage::disk('public')->delete($post->thumbnail);
            }
            // thực hiện tải ảnh mới lên
            $thumbnailPath = $request->file('thumbnail')->store('uploads/posts', 'public');
            $dataPost['thumbnail'] = $thumbnailPath;
        }
        if(empty($request->input('slug'))){
             $slug = Str::slug($request->input('title'), '-');
             $dataPost['slug'] = $slug;
        } else {
            $dataPost['slug'] = $request->input('slug');
        }
        $dataPost['user_id'] = Auth::user()->id;
        // thực hiện cập nhật bài viết
        $post->update($dataPost);
        $post->tags()->sync($request->input('tag_id'));
        return redirect()->route('admin.post.index')->with('success', 'Bài viết đã được cập nhật thành công');
    }

    public function destroy($id) {
        // Lấy id
        $post = Post::find($id);
        // Kiểm tra id có tồn tại không
        if(!$post) {
            return redirect()->route('admin.post.index')->with('error', 'Bài viết không tồn tại');
        }
        if($post->thumbnail && Storage::disk('public')->exists($post->thumbnail)) {
            Storage::disk('public')->delete($post->thumbnail);
        }
        $post->delete();
        return redirect()->route('admin.post.index')->with('success', 'Bài viết đã được xóa thành công');
    }
}
