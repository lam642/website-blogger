<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Comment;
use App\Models\Post;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Mail;

class HomeClientController extends Controller
{
    public function index(Request $request)
    {
        $query = Post::query(); 
        // Lọc theo danh mục
        if ($request->has('category_id') && $request->category_id != '') {
            $query->where('category_id', $request->category_id);
        }
        // Lấy doanh mục
        $danhMucs  = Category::query()->whereHas('posts')->orderBy("created_at","desc")->paginate(5);

        $danhMucs = Category::whereHas('posts', function ($query) {
            $query->where('status', 'published'); // nếu chỉ lấy bài đã duyệt
        })->paginate(10); // hoặc ->get() nếu không cần phân trang

 // Lấy tag
        $tags = Tag::query()->where('status', 'active')->orderBy("created_at","desc")->get();
        // Lấy các bài viết người dùng đã được duyệt đăng
        $baiVietNguoidungs = $query->with('user')->where("status",'published')->orderBy("created_at","desc")->paginate(10);
        $baiVietXemNhieus = $query->with('user')->where("status",'published')->orderBy("view_count","desc")->paginate(3);

        return view('client.home',compact('baiVietNguoidungs', 'danhMucs', 'tags', 'baiVietXemNhieus'));
    }

    public function filterByCategory(Request $request)
    {
        $categoryId = $request->input('category_id');
        
        $query = Post::query();
        
        if ($categoryId && $categoryId != 'all') {
            $query->where('category_id', $categoryId);
        }
        
        $posts = $query->with('user', 'category')
            ->where('status', 'published')
            ->orderBy('created_at', 'desc')
            ->paginate(10);
            
        $html = '';
        
        foreach ($posts as $post) {
            $html .= '<div class="col-lg-6 col-md-6">
                <div class="single-blog">
                    <div class="blog-img">
                        <a href="' . route('chitietbaiviet', ['slug' => $post->slug, 'id' => $post->id]) . '">
                            <img src="' . asset('storage/' . $post->thumbnail) . '" alt="' . $post->title . '">
                        </a>
                    </div>
                    <div class="blog-content">
                        <div class="blog-meta">
                            <ul>
                                <li><a href="#">' . $post->user->name . '</a></li>
                                <li class="p-0">' . $post->created_at->format('d/m/Y') . '</li>
                            </ul>
                        </div>
                        <h3><a href="' . route('chitietbaiviet', ['slug' => $post->slug, 'id' => $post->id]) . '">' . $post->title . '</a></h3>
                        <p>' . Str::limit(strip_tags($post->content), 100) . '</p>
                    </div>
                </div>
            </div>';
        }
        
        return response()->json([
            'success' => true,
            'html' => $html,
            'pagination' => $posts->links()->toHtml()
        ]);
    }
    

    public function formMail(Request $request) {
        return view('client.email.fromMail');
    }

    public function checkMail(Request $request) {
        // kiểm tra email người nhập
        $request->validate([
            'email' => 'required|email'
        ], [
            'email.required' => 'Không được bỏ trống',
            'email.email' => 'Phải đúng định dạng'
        ]);
        // Lấy thông tin email 
        $email =   $request->input('email');
        // Kiểm tra email người nhập có trùng với email trong DB hay không
        $user = User::where('email', $email)->first();
        // Phủ định nếu không có email
        if (!$user) {
            return response()->back()->with('error','Email chưa đăng ký');
        }

        // Nếu đúng thực hiện tạo mã custemer token
        $random = Str::random(10);
        // dd($random);
        // thực hiện thêm mã vào rồi gửi cho db
        $user->update([
            'customer_token' => $random,
        ]);
        
       $email = $user->email;
        Mail::send('client.email.resetpass', compact( 'email', 'user', 'random'), function($message) use( $email ) {
            $message->to($email)
                    ->subject('Quên mật khâu');
        });
        
        return redirect()->back()->with('success','Kiểm tra email của bạn');
    }
    public function fromDoiMatKhau(Request $request) {
        $customer_token = $request->get('customer_token');
    
        // Có thể check thêm token hợp lệ ở đây
    
        return view('client.email.fromdoimatkhau', compact('customer_token'));
    }
    
    public function postDoiMatKhau(Request $request) {
        $request->validate([
            'newPassword' => 'required|string|min:6',
            'comfirmPass' => 'required|same:newPassword',
        ], [
            'newPassword.required' => 'Mật khẩu mới là bắt buộc',
            'newPassword.min' => 'Mật khẩu mới phải có ít nhất 6 ký tự',
            'comfirmPass.required' => 'Vui lòng xác nhận mật khẩu',
            'comfirmPass.same' => 'Xác nhận mật khẩu không khớp',
        ]);
    
        $user = User::where('customer_token', $request->get('customer_token'))->first();
    
        if (!$user) {
            return back()->with('error', 'Token không hợp lệ hoặc đã hết hạn');
        }
    
        // Cập nhật mật khẩu mới và xóa token
        $user->password = bcrypt($request->newPassword);
        $user->customer_token = null;
        $user->save();
    
        return redirect()->route('login')->with('success', 'Đổi mật khẩu thành công!');
    }
    

}