<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login() {
        return view('admin.auth.formLogin');
    }

    public function checkLogin(Request $request) {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6',
        ], [
            'email.required' => 'Email là bắt buộc',
            'email.email' => 'Email không hợp lệ',
            'password.required' => 'Mật khẩu là bắt buộc',
            'password.min' => 'Mật khẩu phải có ít nhất 6 ký tự',
        ]);

        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            if($user->role == 'admin') {
                return redirect()->route('admin.home')->with('success', 'Đăng nhập thành công');
            } else {
                return route('home');
            }
        } else {
            return redirect()->back()->with('error', 'Email hoặc mật khẩu không chính xác');
        }
    }

    public function logout() {
        Auth::logout();
        return redirect()->route('admin.login')->with('success', 'Đăng xuất thành công');
    }
}
