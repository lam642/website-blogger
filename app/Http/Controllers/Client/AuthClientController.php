<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Vtiful\Kernel\Format;
use Illuminate\Support\Carbon;

class AuthClientController extends Controller
{
    public function login()
    {
        return view('client.auth.dangnhap');
    }

    public function checkLogin(Request $request)
    {
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string|min:8',
        ], [
            'email.required' => 'Email không được để trống',
            'email.email' => 'Email không hợp lệ',
            'password.required' => 'Mật khẩu không được để trống',
            'password.min' => 'Mật khẩu phải có ít nhất 8 ký tự',
        ]);

        $credentials = $request->only('email', 'password');

        if (auth()->attempt($credentials, $request->filled('remember'))) {
            $user = auth()->user();
            // kiểm ta nếu thời gian hiện tại lớn hơn thời gian khóa 
            // cập nhập trang thái tài khoản
            if ($user->is_banned == 'banned' && $user->time_ban && $user->time_ban <= now()) {
                $user->is_banned = 'active';
                $user->time_ban = null;
                $user->comment = null;
                $user->save();
            }
            if ($user->is_banned == 'banned') {
                // Thông báo chi tiết thời gian khóa và lý do
                return redirect()
                    ->back()
                    ->with('error', 'Tài khoản của bạn đã bị khóa'
                        . ($user->time_ban ? (' cho đến ' . Carbon::parse($user->time_ban)->format('d/m/Y')) : '')
                        . '. Lý do: ' . $user->comment . '. Vui lòng liên hệ quản trị viên để biết thêm chi tiết.'); 
            }
            $user->email_verified_at = Carbon::parse($user->email_verified_at)->toDateTimeString();
            $user->save();
            return redirect()->route('home')->with('success', 'Đăng nhập thành công');
        } else {
            return redirect()->back()->with('error', 'Thông tin đăng nhập không chính xác');
        }
    }
    public function register()
    {
        return view('client.auth.dangky');
    }
    public function checkRegister(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|',
            'comfirm_password' => 'required|string|same:password|min:8',
        ], [
            'name.required' => 'Tên không được để trống',
            'email.required' => 'Email không được để trống',
            'email.email' => 'Email không hợp lệ',
            'email.unique' => 'Email đã được sử dụng',
            'password.required' => 'Mật khẩu không được để trống',
            'password.min' => 'Mật khẩu phải có ít nhất 8 ký tự',
            'comfirm_password.required' => 'Xác nhận mật khẩu không được để trống',
            'comfirm_password.same' => 'Xác nhận mật khẩu không khớp',
            'comfirm_password.min' => 'Xác nhận mật khẩu phải có ít nhất 8 ký tự',
            'comfirm_password.string' => 'Xác nhận mật khẩu phải là chuỗi ký tự',
            'password.string' => 'Mật khẩu phải là chuỗi ký tự',
            'name.string' => 'Tên phải là chuỗi ký tự',
            'name.max' => 'Tên không được vượt quá 255 ký tự',
            'email.max' => 'Email không được vượt quá 255 ký tự',
            'email.string' => 'Email phải là chuỗi ký tự',

        ]);
        $dataDangKy = $request->only('name', 'email', 'password');
        $dangKyThanhDong = User::create([
            'name' => $dataDangKy['name'],
            'email' => $dataDangKy['email'],
            'password' => Hash::make($dataDangKy['password']),
            'is_banned' => 'active', // Mặc định là hoạt động
            'role' => 'user', // Mặc định là người dùng
        ]);

        if ($dangKyThanhDong) {
            return redirect()->route('login')->with('success', 'Đăng ký thành công, vui lòng đăng nhập');
        } else {
            return redirect()->back()->with('error', 'Đăng ký không thành công, vui lòng thử lại');
        }
    }

    public function logout()
    {
        auth()->logout();
        return redirect()->route('home')->with('success', 'Đăng xuất thành công');
    }


}
