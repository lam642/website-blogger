<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    protected $table = "contacts";
    protected $fillable = [
        "name",
        "email",
        "message",
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }
}
