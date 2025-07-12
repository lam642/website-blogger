<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LienHeController extends Controller
{
    public function index()
    {
        $lienHes = Contact::orderBy("id","desc")->paginate(10);
        return view("admin.lienhe.lienhe", compact("lienHes"));
    }
    public function chiTietLienHe($id) {
        // Lấy id liên hệ không có thực hiện báo lỗi 404
        $lienHe = Contact::findOrFail($id);
        return view("admin.lienhe.chitietlienhe", compact("lienHe"));

    }
    public function destroy($id) {
        // Lấy id liên hệ không có thực hiện báo lỗi 404
        $lienHe = Contact::findOrFail($id);
        $lienHe->delete();
        return redirect()->back()->with("success","Xóa thành công");
    }


}
