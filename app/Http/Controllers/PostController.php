<?php

namespace App\Http\Controllers;

use App\Http\Requests\ValidatePostRequest;
use App\Models\Like;
use App\Models\Post;
use App\Models\PostType;
use App\Models\User;
use Illuminate\Container\Attributes\CurrentUser;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class PostController extends Controller
{
    public function index(): View
    {
        $posts = Post::with(['user', 'postType'])
            ->withCount(['comments', 'likes'])
            ->orderBy('updated_at', 'desc')
            ->paginate(4);

        return view('posts.index', [
            'posts' => $posts,
            'types' => PostType::all(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('posts.create', [
            'types' => PostType::all(),
        ]);
    }

    public function store(ValidatePostRequest $request, #[CurrentUser] User $user): RedirectResponse
    {
        $user->posts()->create($request->validated());

        return redirect()->route('forum.index')->with('success', __('message.success'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post): View
    {
        return view('posts.show', [
            'post' => $post,
            'comments' => $post->comments()->with('user')->get(),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post): View|RedirectResponse
    {
        if (Gate::denies('update', $post)) {
            // don't use back() because with filters give problems
            return redirect()->route('forum.index')->with('error', __('message.no_permission'));
        }

        return view('posts.edit', [
            'post' => $post,
            'types' => PostType::all(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ValidatePostRequest $request, Post $post): RedirectResponse
    {
        $post->update($request->validated());

        return redirect()->route('forum.index')->with('success', __('message.success_update'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post): RedirectResponse
    {
        Gate::authorize('delete', $post);

        $post->delete();

        return redirect()->route('forum.index')->with('success', __('message.delete'));
    }

    public function filter(Request $request): View
    {
        $request->validate([
            'typeFilter' => 'required|integer',
        ]);

        $filterType = PostType::findOrFail($request->integer('typeFilter'));

        return view('posts.index', [
            'posts' => $filterType->posts()
                ->with(['user', 'postType'])
                ->withCount(['comments', 'likes'])
                ->orderBy('updated_at', 'desc')
                ->paginate(4)
                ->appends(['typeFilter' => $filterType->id]),
            'types' => PostType::all(),
            'filterName' => $filterType->name,
        ]);
    }

    /**
     * @return array{message: string, success: bool}|RedirectResponse
     */
    public function like(Request $request): array|RedirectResponse
    {
        $request->validate([
            'post_id' => 'required|integer|exists:posts,id',
        ]);

        $like = Like::createOrFirst([
            'post_id' => $request->input('post_id'),
            'user_id' => Auth::id(),
        ]);

        if ($request->expectsJson()) {
            return [
                'message' => $like->wasRecentlyCreated ? 'added' : 'already_liked',
                'text' => __($like->wasRecentlyCreated ? 'message.like_added' : 'message.already_liked'),
                'success' => $like->wasRecentlyCreated,
            ];
        }

        return redirect()->route('forum.index');
    }
}
