<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Http\Requests\PostRequest;
use App\Models\Post;
use App\Models\SaveArticle;
use Illuminate\Http\Request;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Models\Category;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Symfony\Component\Console\Input\Input;


class BaiVietCaNhanController extends Controller
{
    public function formDangBai()
    {
            if (!auth()->check()) {
                return redirect()->route('login')->with('error', 'Bạn cần đăng nhập để đăng bài.');
            }
        $categories = Category::all();
        $usersAdmin = Auth::user();
        $tags = Tag::all();
        return view('client.baiviet.create', compact('categories', 'usersAdmin', 'tags'));
    }

    public function postBaiViet(Request $request)
    {
        $validate = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'thumbnail' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'category_id' => 'required|exists:categories,id',
        ], [
            'title.required' => 'Tiêu đề là bắt buộc',
            'title.string' => 'Tiêu đề phải là một chuỗi',
            'title.max' => 'Tiêu đề không được vượt quá 255 ký tự',
            'content.required' => 'Nội dung là bắt buộc',
            'content.string' => 'Nội dung phải là một chuỗi',
            'thumbnail.required' => 'Ảnh là bắt buộc',
            'thumbnail.image' => 'Ảnh phải là một ảnh',
            'thumbnail.mimes' => 'Ảnh phải là một ảnh',
            'thumbnail.max' => 'Ảnh không được vượt quá 2MB',
            'category_id.required' => 'Danh mục là bắt buộc',
            'category_id.exists' => 'Danh mục không tồn tại',
        ]);
        // Lấy dữ liệu từ form
        $dataPost = $request->only('title', 'content', 'category_id', 'slug', 'user_id');
        // Tạo slug nếu chưa có hoặc xử lý lại slug đã nhập
        // $dataPost['slug'] = Str::slug($request->input('slug') ?? $request->input('title'));
        $slug = Str::slug($request->input('title'), '-');
        $dataPost['slug'] = $slug;
        $dataPost['user_id'] = auth()->user()->id;

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

        if ($post) {
            return redirect()->back()->with('success', 'Bài viết đã được tạo thành công');
        } else {
            return redirect()->back()->with('error', 'Bài viết đã được tạo thất bại');
        }

    }

    public function danhSachCaNhan()
    {
        // lấy id user
        $user = auth()->user();
        $baiViets = Post::where('user_id', $user->id)->paginate(5);
        return view('client.baiviet.danhsachbaivietcanhan', compact('user', 'baiViets'));
    }
    public function edit($id)
    {
        $baiViet = Post::findOrFail($id);

        $categories = Category::all();
        return view('client.baiviet.edit', compact('baiViet', 'categories'));
    }
    public function update(Request $request, $id)
    {
        $baiViet = Post::findOrFail($id);
        $validate = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'thumbnail' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'category_id' => 'required|exists:categories,id',
        ], [
            'title.required' => 'Tiêu đề là bắt buộc',
            'title.string' => 'Tiêu đề phải là một chuỗi',
            'title.max' => 'Tiêu đề không được vượt quá 255 ký tự',
            'content.required' => 'Nội dung là bắt buộc',
            'content.string' => 'Nội dung phải là một chuỗi',
            'thumbnail.image' => 'Ảnh phải là một ảnh',
            'thumbnail.mimes' => 'Ảnh phải là một ảnh',
            'thumbnail.max' => 'Ảnh không được vượt quá 2MB',
            'category_id.required' => 'Danh mục là bắt buộc',
            'category_id.exists' => 'Danh mục không tồn tại',
        ]);
        // Lấy dữ liệu từ form
        $dataPost = $request->only('title', 'content', 'category_id', 'slug');
        // Tạo slug nếu chưa có hoặc xử lý lại slug đã nhập
        // $dataPost['slug'] = Str::slug($request->input('slug') ?? $request->input('title'));
        $slug = Str::slug($request->input('title'), '-');
        $dataPost['slug'] = $slug;
        $dataPost['user_id'] = auth()->user()->id;

        // Xử lý ảnh nếu có
        if ($request->hasFile('thumbnail')) {
            //  kiểm tra ảnh cũ còn tồn tại không
            if ($baiViet->thumbnail && Storage::disk('public')->exists($baiViet->thumbnail)) {
                // thực hiện xóa ảnh cũ
                Storage::disk('public')->delete($baiViet->thumbnail);
            }
            // thực hiện tải ảnh mới lên
            $thumbnailPath = $request->file('thumbnail')->store('uploads/posts', 'public');
            $dataPost['thumbnail'] = $thumbnailPath;
        }

        // Cập nhật bài viết bài viết
        $post = $baiViet->update($dataPost);

        // Gắn tag nếu có

        if ($post) {
            return redirect()->back()->with('success', 'Bài viết đã được tạo thành công');
        } else {
            return redirect()->back()->with('error', 'Bài viết đã được tạo thất bại');
        }
    }

    public function destroy($id)
    {
        $baiViet = Post::findOrFail($id);
        $baiViet->delete();
        return redirect()->back()->with('success', 'Bài viết đã được xóa');
    }

   
}

