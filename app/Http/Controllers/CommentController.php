<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function add(Comment $comment)
    {
        $commentBody = request('comment');
        $comment->comment = $commentBody;
        $comment->likes = 0;
        $comment->postID = request('post-id');
        $comment->userID = Auth::id();
        $comment->save();
        return back();
    }
}
