<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Post extends Model
{
    // use SoftDeletes;
    protected $table = 'posts';

    protected $fillable = ['title', 'slug', 'content', 'thumbnail', 'status', 'user_id', 'category_id', 'view_count'];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function comments() {
        return $this->hasMany(Comment::class);
    }

    public function tags() {
        return $this->belongsToMany(Tag::class);
    }

    public function reactions() {
        return $this->hasMany(Reaction::class);
    }

    public function reports() {
        return $this->hasMany(Report::class);
    }

    public function category() {
        return $this->belongsTo(Category::class);
    }

    public function saveArticles() {
        return $this->hasMany(SaveArticle::class);
    }

}