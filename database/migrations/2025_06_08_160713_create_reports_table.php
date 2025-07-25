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
        Schema::create('reports', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // Ai báo cáo
            $table->foreignId('post_id')->nullable()->constrained()->onDelete('cascade'); // Báo cáo bài viết
            $table->foreignId('comment_id')->nullable()->constrained()->onDelete('cascade'); // Báo cáo bình luận
            $table->text('reason'); // Lý do báo cáo
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reports');
    }
};
