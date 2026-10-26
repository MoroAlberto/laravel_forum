<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'comment' => 'required|string',
            'post_id' => 'required|integer|exists:posts,id',
        ]);

        Comment::create([
            ...$validated,
            'user_id' => Auth::id(),
        ]);

        return back();
    }
}
