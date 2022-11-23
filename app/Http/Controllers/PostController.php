<?php

namespace App\Http\Controllers;

use App\Http\Requests\ValidatePostRequest;
use App\Models\Comment;
use App\Models\Like;
use App\Models\Post;
use App\Models\PostType;
use App\Models\User;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Database\QueryException;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    /**
     * Create the controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        if (Auth::check()) {
            $this->authorizeResource(Post::class, 'post');
        }
    }

    /**
     * @return Factory|View|Application
     */
    public function index(): Factory|View|Application
    {
        $posts = Post::orderBy('updated_at', 'desc')->paginate(4);
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
     * @param ValidatePostRequest $request
     * @return RedirectResponse
     */
    public function store(ValidatePostRequest $request): RedirectResponse
    {
        $request->validated();
        Post::create([
            'title' => $request->input('title'),
            'content' => $request->input('content'),
            'post_type_id' => $request->input('post_type_id'),
            'user_id' => Auth::id()
        ]);
        return redirect()->route('forum.index')->with('success', __('message.success'));
    }


    /**
     * Display the specified resource.
     *
     * @param Post $post
     * @return Application|Factory|View|RedirectResponse
     */
    public function show(Post $post): View|Factory|RedirectResponse|Application
    {
        $selectedComments = Comment::select()->where('post_id', '=', $post->id)->get();
        $commentUsers = [];
        foreach ($selectedComments as $comment) {
            $commentUsers[] = User::select('name')->where('id', '=', $comment->user_id)->get();
        }
        return view('posts.show',
            [
                'post' => $post,
                'comments' => $selectedComments,
                'users' => $commentUsers
            ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Post $post
     * @return Factory|View|Application|RedirectResponse
     */
    public function edit(Post $post): Factory|View|Application|RedirectResponse
    {
        $postTypes = PostType::all();
        $currentUser = Auth::id();
        if ($post->user_id == $currentUser) {
            return view('posts.edit', [
                'post' => $post,
                'types' => $postTypes
            ]);
        } else {
            //don't use back() because with filters give problems
            return redirect()->route('forum.index')->with('error', __('message.no_permission'));
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param ValidatePostRequest $request
     * @param Post $post
     * @return RedirectResponse
     */
    public function update(ValidatePostRequest $request, Post $post): RedirectResponse
    {
        $request->validated();
        Post::where('id', $post->id)->update($request->except(['_token', '_method']));
        return redirect()->route('forum.index')->with('success', __('message.success_update'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Post $post
     * @return RedirectResponse
     */
    public function destroy(Post $post): RedirectResponse
    {
        Post::destroy($post->id);
        return redirect()->route('forum.index')->with('success', __('message.delete'));
    }

    /**
     * @param Request $request
     * @return View|Factory|Application
     */
    public function filter(Request $request): View|Factory|Application
    {
        $filterID = $request->input('typeFilter');
        $filteredPosts = Post::get()->where('post_type_id', '=', $filterID);
        $filterName = PostType::select(['name'])->where('id', '=', $filterID)->get();
        $postTypes = PostType::all();
        return view('posts.index', [
            'posts' => $filteredPosts,
            'types' => $postTypes,
            'filterName' => $filterName
        ]);
    }

    /**
     * @return RedirectResponse|string[] $request
     */
    public function like(Request $request): array|RedirectResponse
    {
        $request->validate([
            'post_id' => 'required|integer|min:1',
        ]);
        try {
            Like::create([
                'post_id' => $request->input('post_id'),
                'user_id' => Auth::id()
            ]);
        } catch (QueryException $ex) {
            return [
                'message' => $ex->getMessage(),
                'success' => false
            ];
        }
        //Debugbar::info();
        $message = "added";
        $res = "true";
        if ($request->expectsJson()) {
            return [
                'message' => $message,
                'success' => $res
            ];
        }
        return redirect()->route('forum.index');
    }
}
