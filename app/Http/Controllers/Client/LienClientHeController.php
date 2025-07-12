<?php

namespace App\Http\Controllers\client;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use Illuminate\Http\Request;

class LienClientHeController extends Controller
{
    public function lienHe() {
        $user = auth()->user();
        return view("client.lienhe.lienhe", compact('user'));
    }
    public function postLienHe(Request $request) {
        $request->validate([
            "name" => "required|string|max:255",
            "email" => "required|email|max:255", // Thêm quy tắc validate cho email
            "message" => "required|string",
        ], [
            "name.required" => "Tên không được bỏ trống",
            "name.string" => "Tên phải là chuỗi",
            "name.max" => "Tên không vượt quá 255 ký tự",
        
            // Thông báo lỗi cho trường email
            "email.required" => "Email không được bỏ trống",
            "email.email" => "Email không đúng định dạng",
            "email.max" => "Email không vượt quá 255 ký tự",
        
            "message.required" => "Nội dung không được bỏ trống", // Đổi lại "Nội dung" cho rõ nghĩa hơn
            "message.string" => "Nội dung phải là chuỗi",
        ]);
        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'message' => $request->message  
        ];
    
        
        if(Contact::create($data)) { 
            return back()->with('success', 'Liên hệ của bạn đã được gửi!');
        }
        return back()->with('error', 'Đã có lỗi xin hãy thử lại!');
    
    }
}
