<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\Console\Input\Input;

class TaiKhoanClientController extends Controller
{

    public function taiKhoan()
    {
        return view('client.taikhoan');
    }

    public function chinhSuaTaiKhoan(Request $request, $id)
    {
        $user = auth()->user();

        // Nếu là tài khoản Google, không validate email và mật khẩu
        if ($user->google_id != null) {
            $validated = $request->validate([
                'name' => 'required|string|max:255',
                'anh_dai_dien' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            ], [
                'name.required' => 'Họ tên không được để trống.',
                'name.string' => 'Họ tên phải là một chuỗi.',
                'name.max' => 'Họ tên không được vượt quá 255 ký tự.',
                'anh_dai_dien.image' => 'Ảnh đại diện phải là một tệp hình ảnh.',
                'anh_dai_dien.mimes' => 'Ảnh đại diện phải có định dạng jpeg, png, jpg hoặc gif.',
                'anh_dai_dien.max' => 'Ảnh đại diện không được vượt quá 2MB.',
            ]);
        } else {
            $validated = $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|email',
                'anh_dai_dien' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
                'new-pwd' => 'nullable|min:6',
                'confirm-pwd' => 'same:new-pwd'
            ], [
                'name.required' => 'Họ tên không được để trống.',
                'name.string' => 'Họ tên phải là một chuỗi.',
                'name.max' => 'Họ tên không được vượt quá 255 ký tự.',
                'email.required' => 'Email không được để trống.',
                'email.email' => 'Email không đúng định dạng.',
                'anh_dai_dien.image' => 'Ảnh đại diện phải là một tệp hình ảnh.',
                'anh_dai_dien.mimes' => 'Ảnh đại diện phải có định dạng jpeg, png, jpg hoặc gif.',
                'anh_dai_dien.max' => 'Ảnh đại diện không được vượt quá 2MB.',
                'new-pwd.min' => 'Mật khẩu mới phải có ít nhất 6 ký tự.',
                'confirm-pwd.same' => 'Mật khẩu xác nhận không trùng khớp với mật khẩu mới.',
            ]);
        }

        // Cập nhật thông tin
        $user->name = $request->input('name');

        if ($user->google_id == null) { // Nếu người dùng đăng ký không phải bằng google
            $user->email = $request->input('email');
            if ($request->filled('new-pwd')) {
                $user->password = Hash::make($request->input('new-pwd'));
            }
        }

        // Cập nhật ảnh đại diện nếu có
        if ($request->hasFile('anh_dai_dien')) {
            if ($user->avatar && Storage::disk('public')->exists($user->avatar)) {
                Storage::disk('public')->delete($user->avatar);
            }
            $avatarPath = $request->file('anh_dai_dien')->store('uploads/avatar', 'public');
            $user->avatar = $avatarPath;
        }

        if ($user->save()) {
            return redirect()->back()->with('success', 'Cập nhật tài khoản thành công!');
        } else {
            return redirect()->back()->with('error', 'Cập nhật thất bại!');
        }
    }
}
