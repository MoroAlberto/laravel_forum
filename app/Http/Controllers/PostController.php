<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use App\Models\PostType;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::all();
        $postTypes = PostType::all();
        session()->forget('currentFilter');
        return view('posts.index', [
            'posts' => $posts,
            'types' => $postTypes
        ]);
    }

    public function create()
    {
        $postTypes = PostType::all();
        return view('posts.create', [
            'types' => $postTypes
        ]);
    }

    public function createSubmit(Post $post)
    {
        $post->title = request('title');
        $post->content = request("content");
        $post->typeID = request('type');
        $post->postedBy = Auth::user()->id;
        $post->save();
        return redirect('/');
    }

    public function edit($slug)
    {
        $selectedPost = Post::find($slug);
        $currentUser = Auth::id();
        if ($selectedPost->postedBy == $currentUser) {
            return view('posts.edit', [
                'post' => $selectedPost
            ]);
        } else {
            return back()->with('errorMsg', 'You do not have permission to edit this post');
        }
    }

    public function editSubmit($slug)
    {
        $selectedPost = Post::find($slug);
        $selectedPost->title = request('title');
        $selectedPost->content = request('content');
        $selectedPost->save();
        return redirect('/');
    }

    public function delete($slug)
    {
        $selectedComments = Comment::get()->where('postID', '=', $slug);
        foreach ($selectedComments as $comment) {
            $comment->delete();
        }
        $selectedPost = Post::find($slug);
        $selectedPost->delete();
        return redirect('/');
    }

    public function filter()
    {
        $filterID = request('typeFilter');
        $filteredTypes = Post::get()->where('typeID', '=', $filterID);
        $filterName = PostType::select(['typeName'])->where('id', '=', $filterID)->get();
        $types = PostType::all();
        return view('posts.index', [
            'posts' => $filteredTypes,
            'types' => $types,
            'filterName' => $filterName
        ]);
    }

    public function details($slug)
    {
        $selectedPost = Post::find($slug);

        $selectedComments = Comment::select()->where('postID', '=', $slug)->get();
        $commentUsers = [];
        foreach ($selectedComments as $comment) {
            $commentUsers[] = User::select('name')->where('id', '=', $comment->userID)->get();
        }
        return view('posts.details',
            [
                'post' => $selectedPost,
                'comments' => $selectedComments,
                'users' => $commentUsers
            ]);
    }
}
