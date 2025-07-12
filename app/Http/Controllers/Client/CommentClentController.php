<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class CommentClentController extends Controller
{
    public function commentStore(Request $request)
    {
        if (!auth()->check()) {
            return response()->json(['success' => false, 'message' => 'Bạn cần đăng nhập.']);
        }
    
        $validated = $request->validate([
            'content' => 'required|string|max:1000',
            'post_id' => 'required|exists:posts,id'
        ]);
    
        $comment = Comment::create([
            'user_id' => auth()->id(),
            'post_id' => $request->post_id,
            'content' => $request->content,
            'is_approved' => 'pending' // nếu có kiểm duyệt
        ]);
    
        return response()->json([
            'success' => true,
            'comment' => [
                'user_name' => auth()->user()->name,
                'content' => $comment->content,
                'created_at' => now()->format('d/m/Y')
            ]
        ]);
    }
}
