<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index() {
    
        $categories = Category::orderBy('id', 'desc')->get();
        return view('admin.danhmuc.index', compact('categories'));
    }

    public function create() {
        return view('admin.danhmuc.create');
    }

    public function store(Request $request) {
        $request->validate([
            'name' => 'required|max:100',
            'slug' => 'required|max:255',
            'status' => 'required',
        ], [
            'name.required' => 'Tên danh mục không được để trống',
            'slug.required' => 'Đường dẫn không được để trống',
            'status.required' => 'Trạng thái không được để trống',
            'name.max' => 'Tên danh mục không được vượt quá 100 ký tự',
            'slug.max' => 'Đường dẫn không được vượt quá 255 ký tự',
        ]);

       $data = [
        'name' => $request->name,
        'slug' => $request->slug,
        'status' => $request->status,
       ];

       $addCategory = Category::create($data);
       if ($addCategory) {
        return redirect()->route('admin.danhmuc.index')->with('success', 'Thêm danh mục thành công');
       } else {
        return redirect()->route('admin.danhmuc.index')->with('error', 'Thêm danh mục thất bại');
       }
    }
    
    public function edit($id) {
        // Lấy danh mục có id tương ứng
        $category = Category::find($id);
        // Kiểm tra id có tồn tại không
        if(!$category) {
            return redirect()->route('admin.danhmuc.index')->with('error', 'Danh mục không tồn tại');
        }
        return view('admin.danhmuc.edit', compact('category'));
    }

    public function update(Request $request, $id) {
        $request->validate([
            'name' => 'required|max:100',
            'slug' => 'required|max:255',
            'status' => 'required',
        ], [
            'name.required' => 'Tên danh mục không được để trống',
            'slug.required' => 'Đường dẫn không được để trống',
            'status.required' => 'Trạng thái không được để trống',
            'name.max' => 'Tên danh mục không được vượt quá 100 ký tự',
            'slug.max' => 'Đường dẫn không được vượt quá 255 ký tự',
        ]);
        // Lấy danh mục theo id 
        $category = Category::find($id);
        // Kiểm tra id danh mục có tồn tại không
        if(!$category) {
            return redirect()->route('admin.danhmuc.index')->with('error', 'Danh mục không tồn tại');
        } 
        $data = [
            'name' => $request->name,
            'slug' => $request->slug,
            'status' => $request->status,
        ];
        
        $updateCategory = $category->update($data);
        if ($updateCategory) {
            return redirect()->route('admin.danhmuc.index')->with('success', 'Sửa danh mục thành công');
        } else {
            return redirect()->route('admin.danhmuc.index')->with('error', 'Sửa danh mục thất bại');
        }
    }

    public function show($id) {
        // Lấy danh mục theo id
        $category = Category::find($id);
        $posts = Post::where('category_id', $id)->orderBy('id', 'desc')->get();
        // Kiểm tra id danh mục có tồn tại hay không
        if(!$category) {
            return redirect()->route('admin.danhmuc.index')->with('error', 'Danh mục không tồn tại');
        }
        return view('admin.danhmuc.show', compact('category', 'posts'));
    }

    public function destroy($id) {
        // Lấy id dan mục tương ứng
        $category = Category::find($id);
        $category->status = 'inactive'; // thực hiện cập nhập trạng thái danh mục
        $category->save();
        $category->delete();
        return redirect()->route('admin.danhmuc.index')->with('success', 'Xóa danh mục thành công');
    }

    public function trash() {
        $categories = Category::onlyTrashed()->orderBy('id', 'desc')->get(); // Lấy danh danh mục đã bị xóa
        return view('admin.danhmuc.trash', compact('categories'));
    }

    public function restore($id) {
        // Lấy danh mục theo id đã bị xóa mền
        $category = Category::onlyTrashed()->findOrFail($id);  
        // Kiểm tra id danh mục có tồn tại hay không
        if(!$category) {
            return redirect()->route('admin.danhmuc.trash')->with('error', 'Danh mục không tồn tại');
        }
        $category->restore();
        return redirect()->route('admin.danhmuc.trash')->with('success', 'Khôi phục danh mục thành công');
    }

    public function forceDelete($id) {
        // Lấy danh mục theo id đã bị xóa mền
        $category = Category::onlyTrashed()->findOrFail($id);
        // Kiểm tra id danh mục có tồn tại hay không
        if(!$category) {
            return redirect()->route('admin.danhmuc.trash')->with('error', 'Danh mục không tồn tại');
        }
        $category->forceDelete();
        return redirect()->route('admin.danhmuc.trash')->with('success', 'Xóa vĩnh viễn danh mục thành công');
    }
}
