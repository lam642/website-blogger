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
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // Người viết bài
            $table->foreignId('category_id')->nullable()->constrained()->onDelete('set null'); // Danh mục
            $table->string('title'); // Tiêu đề
            $table->string('slug')->unique(); // Slug
            $table->longText('content'); // Nội dung
            $table->string('thumbnail')->nullable(); // Ảnh đại diện bài viết
            $table->enum('status', ['draft','published','Pending approval','refuse','accept'])->default('draft')->comment('draft: Bảng nháp, published: Đã đăng, Pending approval: Chờ phê duyệt, refuse: Từ chối, accept: chấp nhận'); // Trạng thái
            $table->unsignedBigInteger('view_count')->default(0); // Lượt xem
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('posts');
    }
};
