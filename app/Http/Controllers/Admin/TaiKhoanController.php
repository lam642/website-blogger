<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;

class TaiKhoanController extends Controller
{
    public function index()
    {
        $users = User::query()->where('role', 'user')->orderBy('id', 'desc')->get();
    
        foreach ($users as $user) {
            if ($user->is_banned == 'banned' && $user->time_ban && $user->time_ban < now()) {
                $user->is_banned = 'active';
                $user->time_ban = null;
                $user->comment = null;
                $user->save();
            }
        }
    
        return view('admin.taikhoan.index', compact('users'));
    }

    public function show($id)
    {
        $user = User::with('posts', 'comments')->find($id);
        return view('admin.taikhoan.show', compact('user'));
    }

    public function ban($id)
    {
        $user = User::find($id);
        if($user->is_banned == 'banned'){ 
            $user->is_banned = 'active';
            $user->time_ban = null;   
            $user->comment = null;     
            $user->save();
            return redirect()->route('admin.taikhoan.index');
        }
        return view('admin.taikhoan.ban', compact('user'));
    }
 

    public function update(Request $request, $id)
    {
        $user = User::find($id);
        if($user->is_banned == 'active'){
        $now = Carbon::now();
        $request->validate([
            'time_ban' => 'nullable|after:'.$now, // Cho phép time_ban. Khi chọn bắp buộc phải hơn thời gian hiện tại
        ], [
            'time_ban.after' => 'Thời gian khóa phải lớn hơn ngày hiện tại',
        ]);
        $user->is_banned = $request->status;
        $user->comment = $request->comment;
        $user->time_ban = $request->time_ban ?? null;
        $user->save();
        return redirect()->route('admin.taikhoan.index');
        }
    }


    public function destroy($id)
    {   
        // Lấy id của người dùng
        $user = User::find($id);
        if($user->time_ban == null){
            $user->delete();
            return redirect()->back()->with('success', 'Xóa thành công');
        }
        else{
            // Không cho phép xóa khi thời gian khóa vẫn còn
            return redirect()->route('admin.taikhoan.index')->with('error', 'Tài khoản đã bị khóa còn thời gian khóa là: '.$user->time_ban);
        }
    }
}
