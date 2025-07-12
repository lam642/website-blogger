<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('comments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('post_id')->constrained()->onDelete('cascade'); // Bình luận thuộc bài viết nào
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // Ai bình luận
            $table->text('content'); // Nội dung bình luận
            $table->foreignId('parent_id')->nullable()->constrained('comments')->onDelete('cascade'); // Nếu là trả lời
            $table->enum('is_approved', ['pending', 'approved','refuse', 'Spam'])->default('pending')->comment('pending: Chưa duyệt, approved: Đã duyệt, refuse: Từ chối, accept: chấp nhận');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('comments');
    }
};
