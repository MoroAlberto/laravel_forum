<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    protected $attributes = [
        'is_dislike' => 0,
    ];

    protected $fillable = [
        'is_dislike',
        'post_id',
        'user_id',
    ];
}
