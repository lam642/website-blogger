<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Reaction;
use App\Models\Report;
use Illuminate\Http\Request;

class BaoCaoClientController extends Controller
{
    public function baoCaoBaiViet(Request $request)
    {
        if(!auth()->check()) {
            if ($request->ajax()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Bạn cần đăng nhập để báo cáo'
                ], 401);
            }
            
            echo "
            <script>
                alert('Bạn cần đăng nhập để báo cáo');
                window.location.href = '/login';
            </script>
            ";
            return;
        }

        try {
            $validate = $request->validate([
                'bao_cao_bai_viết' => 'required|min:10|max:500',
            ], [
                'bao_cao_bai_viết.required' => 'Nội dung báo cáo không được để trống',
                'bao_cao_bai_viết.min' => 'Nội dung báo cáo phải có ít nhất 10 ký tự',
                'bao_cao_bai_viết.max' => 'Nội dung báo cáo không được vượt quá 500 ký tự',
            ]);

            $report = [
                'user_id' => auth()->id(),
                'post_id' => $request->input('post_id'),
                'reason' => $request->input('bao_cao_bai_viết'),
            ];

            if(Report::create($report)) {
                if ($request->ajax()) {
                    return response()->json([
                        'success' => true,
                        'message' => 'Báo cáo bài viết đã được gửi thành công!'
                    ]);
                }
                
                echo "<script>alert('Báo cáo đã được gửi!')
                             history.back();
                     </script>";
            } else {
                if ($request->ajax()) {
                    return response()->json([
                        'success' => false,
                        'message' => 'Báo cáo bị lỗi, hãy thử lại sau'
                    ]);
                }
                
                echo "
                <script>
                    alert('Báo cáo bị lỗi, hãy thử lại sau');
                    history.back();
                </script>
                ";
            }
        } catch (\Illuminate\Validation\ValidationException $e) {
            if ($request->ajax()) {
                return response()->json([
                    'success' => false,
                    'message' => $e->errors()['bao_cao_bai_viết'][0] ?? 'Có lỗi validation xảy ra'
                ], 422);
            }
            
            throw $e;
        } catch (\Exception $e) {
            if ($request->ajax()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Có lỗi xảy ra, vui lòng thử lại sau'
                ], 500);
            }
            
            return redirect()->back()->with('error', 'Báo cáo bài viết không thành công. Vui lòng thử lại sau.');
        }
    }

    public function baoCaoBinhLuan(Request $request, $id) {
        if(!auth()->check()) {
            if ($request->ajax()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Bạn cần đăng nhập để báo cáo'
                ], 401);
            }
            
            echo "
            <script>
                alert('Bạn cần đăng nhập để báo cáo');
                window.location.href = '/login';
            </script>
            ";
            return;
        }

        try {
            // Thêm validation cho báo cáo bình luận
            $validate = $request->validate([
                'baocao' => 'required|min:10|max:500',
            ], [
                'baocao.required' => 'Nội dung báo cáo không được để trống',
                'baocao.min' => 'Nội dung báo cáo phải có ít nhất 10 ký tự',
                'baocao.max' => 'Nội dung báo cáo không được vượt quá 500 ký tự',
            ]);

            $report = [
                'user_id' => auth()->id(),
                'post_id' => $request->input('post_id'),
                'comment_id' => $id,
                'reason' => $request->input('baocao'),
            ];

            if(Report::create($report)) {
                if ($request->ajax()) {
                    return response()->json([
                        'success' => true,
                        'message' => 'Báo cáo đã được gửi thành công!'
                    ]);
                }
                
                echo "
                <script>
                    alert('Báo cáo đã được gửi thành công!');
                    history.back();
                </script>
                ";
            } else {
                if ($request->ajax()) {
                    return response()->json([
                        'success' => false,
                        'message' => 'Báo cáo bị lỗi, hãy thử lại sau'
                    ]);
                }
                
                echo "
                <script>
                    alert('Báo cáo bị lỗi, hãy thử lại sau');
                    history.back();
                </script>
                ";
            }
        } catch (\Illuminate\Validation\ValidationException $e) {
            if ($request->ajax()) {
                return response()->json([
                    'success' => false,
                    'message' => $e->errors()['baocao'][0] ?? 'Có lỗi validation xảy ra'
                ], 422);
            }
            
            throw $e;
        } catch (\Exception $e) {
            if ($request->ajax()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Có lỗi xảy ra, vui lòng thử lại sau'
                ], 500);
            }
            
            echo "
            <script>
                alert('Có lỗi xảy ra, vui lòng thử lại sau');
                history.back();
            </script>
            ";
        }
    }
}
