<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use App\Models\PostType;
use App\Models\User;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class PostController extends Controller
{

    /**
     * @return Factory|View|Application
     */
    public function index(): Factory|View|Application
    {
        $posts = Post::all();
        $postTypes = PostType::all();
        session()->forget('currentFilter');
        return view('posts.index', [
            'posts' => $posts,
            'types' => $postTypes
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Factory|View|Application
     */
    public function create(): Factory|View|Application
    {
        $postTypes = PostType::all();
        return view('posts.create', [
            'types' => $postTypes
        ]);
    }

    /**
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'title' => 'required|unique:posts',
            'content' => 'required|string',
            'type' => 'required|integer|min:1|exists:post_types,id',
        ]);
        Post::create([
            'title' => $request->input('title'),
            'content' => $request->input('content'),
            'post_type_id' => $request->input('type'),
            'user_id' => Auth::user()->id
        ]);
        return redirect()->route('forum.index')->with('success', 'Post created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return Factory|View|Application
     */
    public function show(int $id): Factory|View|Application
    {
        $selectedPost = Post::find($id);
        $selectedComments = Comment::select()->where('post_id', '=', $id)->get();
        $commentUsers = [];
        foreach ($selectedComments as $comment) {
            $commentUsers[] = User::select('name')->where('id', '=', $comment->user_id)->get();
        }
        return view('posts.show',
            [
                'post' => $selectedPost,
                'comments' => $selectedComments,
                'users' => $commentUsers
            ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return Factory|View|Application|RedirectResponse
     */
    public function edit(int $id): Factory|View|Application|RedirectResponse
    {
        $selectedPost = Post::find($id);
        $currentUser = Auth::id();
        if ($selectedPost->user_id == $currentUser) {
            return view('posts.edit', [
                'post' => $selectedPost
            ]);
        } else {
            return back()->with('error', 'You do not have permission to edit this post');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param int $id
     * @return RedirectResponse
     */
    public function update(Request $request, int $id): RedirectResponse
    {
        $request->validate([
            'title' => 'required|unique:posts',
            'content' => 'required|string',
            'type' => 'required|integer|min:1|exists:post_types,id',
        ]);
        $selectedPost = Post::find($id);
        $selectedPost->title = $request->input('title');
        $selectedPost->content = $request->input('content');
        $selectedPost->save();
        return redirect()->route('forum.index')->with('success', 'Post updated successfully');
    }

    /**
     * @param Post $id
     * @return RedirectResponse
     */
    public function destroy(Post $id): RedirectResponse
    {
        $id->delete();
        return redirect()->route('forum.index')->with('success', 'Post deleted successfully');
    }

    /**
     * @return View|Factory|Application
     */
    public function filter(): View|Factory|Application
    {
        $filterID = request('typeFilter');
        $filteredTypes = Post::get()->where('post_type_id', '=', $filterID);
        $filterName = PostType::select(['name'])->where('id', '=', $filterID)->get();
        $types = PostType::all();
        return view('posts.index', [
            'posts' => $filteredTypes,
            'types' => $types,
            'filterName' => $filterName
        ]);
    }


}
