<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    use HasFactory;

    protected $attributes = [
        'is_dislike' => 0,
    ];

    protected $fillable = [
        'is_dislike',
        'post_id',
        'user_id',
    ];
}
