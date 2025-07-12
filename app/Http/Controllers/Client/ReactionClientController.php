<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Reaction;
use Illuminate\Support\Facades\DB;

class ReactionClientController extends Controller
{
    public function reaction(Request $request)
    {
        $userId = auth()->id();
        if (!$userId) {
            return response()->json(['success' => false, 'message' => 'Bạn cần đăng nhập!'], 401);
        }
        $postId = $request->input('post_id');
        $type = $request->input('type');
        
        // Debug log
        \Log::info('Reaction request', [
            'user_id' => $userId,
            'post_id' => $postId,
            'type' => $type
        ]);
        
        // Kiểm tra nếu reaction đã tồn tại và giống loại cũ thì xóa (toggle)
        $existing = Reaction::where('post_id', $postId)
            ->where('user_id', $userId)
            ->first();

        if ($existing && $existing->type == $type) {
            $existing->delete();
            \Log::info('Deleted existing reaction');
        } else {
            Reaction::updateOrCreate(
                ['post_id' => $postId, 'user_id' => $userId],
                ['type' => $type]
            );
            \Log::info('Created/Updated reaction');
        }

        
        // Đếm lại số lượng từng loại reaction cho bài viết này
        $counts = Reaction::where('post_id', $postId)
            ->select('type', DB::raw('count(*) as total'))
            ->groupBy('type')
            ->pluck('total', 'type');

        // Sau khi xử lý xong
        $currentUserReaction = Reaction::where('post_id', $postId)
            ->where('user_id', $userId)
            ->value('type');

        $response = [
            'success' => true,
            'counts' => $counts,
            'current_user_reaction' => $currentUserReaction // null nếu đã gỡ
        ];
        
        \Log::info('Response', $response);
        
        return response()->json($response);
    }
}
