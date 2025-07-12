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
        Schema::create('reactions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('post_id')->constrained()->onDelete('cascade'); // Cảm xúc thuộc bài nào
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // Ai thả cảm xúc
            $table->enum('type', ['like', 'love', 'angry', 'sad', 'haha', 'wow', 'cry']); // Loại cảm xúc
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reactions');
    }
};
