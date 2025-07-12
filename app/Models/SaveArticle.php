<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SaveArticle extends Model
{
    protected $table = 'save_articles';
    protected $fillable = ['user_id', 'post_id', 'status'];

    public function user () {
        return $this->belongsTo(User::class);
    }

    public function post () {
        return $this->belongsTo(Post::class);
    }

}
