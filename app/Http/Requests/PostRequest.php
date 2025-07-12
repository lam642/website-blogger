<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'thumbnail' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'slug' => 'required|string|max:255',
            'tag_id' => 'required|array',
            'category_id' => 'required|exists:categories,id',
            'status' => 'required|string|max:255',
        ];
    }

    public function messages()
    {
        return [
            'title.required' => 'Tiêu đề là bắt buộc',
            'title.string' => 'Tiêu đề phải là một chuỗi',
            'title.max' => 'Tiêu đề không được vượt quá 255 ký tự',
            'content.required' => 'Nội dung là bắt buộc',
            'content.string' => 'Nội dung phải là một chuỗi',
            'thumbnail.required' => 'Ảnh là bắt buộc',
            'thumbnail.image' => 'Ảnh phải là một ảnh',
            'thumbnail.mimes' => 'Ảnh phải là một ảnh',
            'thumbnail.max' => 'Ảnh không được vượt quá 2MB',
            'slug.required' => 'Tên đường dẫn là bắt buộc',
            'slug.string' => 'Tên đường dẫn phải là một chuỗi',
            'slug.max' => 'Tên đường dẫn không được vượt quá 255 ký tự',
            'tag_id.required' => 'Tag là bắt buộc',
            'tag_id.array' => 'Tag phải là một mảng',
            'category_id.required' => 'Danh mục là bắt buộc',
            'category_id.exists' => 'Danh mục không tồn tại',
            'status.required' => 'Trạng thái là bắt buộc',
        ];
    }
}
