<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Tag;
use Illuminate\Http\Request;

class TagController extends Controller
{
    public function index() {
        $tags = Tag::all();
        return view('admin.tag.index', compact('tags'));
    }

    public function create() {
        return view('admin.tag.create');
    }

    public function store(Request $request) {
        $request->validate([
            'name' => 'required|unique:tags,name|max:100',
            'slug' => 'required|unique:tags,slug|max:255',
            'status' => 'required',
        ], [
            'name.required' => 'Tên thẻ không được để trống',
            'name.max' => 'Tên thẻ không được vượt quá 100 ký tự',
            'name.unique' => 'Tên thẻ đã tồn tại',
            'slug.required' => 'Đường dẫn không được để trống',
            'slug.max' => 'Đường dẫn không được vượt quá 255 ký tự',
            'status.required' => 'Trạng thái không được để trống',
            'slug.unique' => 'Đường dẫn đã tồn tại',
        ]);
            $data = [
            'name' => $request->name,
            'slug' => $request->slug,
            'status' => $request->status,
        ];
        $addTag = Tag::create($data);
        if($addTag) {
            return redirect()->route('admin.tag.index')->with('success', 'Thẻ đã được tạo thành công');
        } else {
            return redirect()->route('admin.tag.index')->with('error', 'Thẻ đã được tạo thất bại');
        }
    }

    public function edit($id) {
        // Tìm kiếm tag theo id
        $tag = Tag::where('id', $id)->first();
        if(!$tag) {
            return redirect()->route('admin.tag.index')->with('error', 'Thẻ không tồn tại');
        }
        return view('admin.tag.edit', compact('tag'));
    }

    public function update(Request $request, $id) {
        $request->validate([
            'name' => 'required|unique:tags,name|max:100',
            'slug' => 'required|unique:tags,slug|max:255',
            'status' => 'required',
        ], [
            'name.required' => 'Tên thẻ không được để trống',
            'name.max' => 'Tên thẻ không được vượt quá 100 ký tự',
            'name.unique' => 'Tên thẻ đã tồn tại',
            'slug.required' => 'Đường dẫn không được để trống',
            'slug.max' => 'Đường dẫn không được vượt quá 255 ký tự',
            'status.required' => 'Trạng thái không được để trống',
            'slug.unique' => 'Đường dẫn đã tồn tại',
        ]);
        $tag = Tag::find($id);
        if(!$tag) {
            return redirect()->route('admin.tag.index')->with('error', 'Thẻ không tồn tại');
        }
       $data = [
        $tag['name'] = $request->name,
        $tag['slug'] = $request->slug,
        $tag['status'] = $request->status,
       ];
       $updateTag = $tag->update($data);
       if($updateTag) {
        return redirect()->route('admin.tag.index')->with('success', 'Thẻ đã được sửa thành công');
       } else {
        return redirect()->route('admin.tag.index')->with('error', 'Thẻ đã được sửa thất bại');
       }
    }

    public function destroy($id) {
        $tag = Tag::find($id);
        if(!$tag) {
            return redirect()->route('admin.tag.index')->with('error', 'Thẻ không tồn tại');
        }
        $tag->delete();
        return redirect()->route('admin.tag.index')->with('success', 'Thẻ đã được xóa thành công');
    }
}
