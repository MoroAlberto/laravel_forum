@extends('layout')

@section('slot')
    <a href="{{ route('forum.index') }}"
       class="inline-flex items-center gap-1 text-sm font-semibold text-slate-500 transition hover:text-slate-800">
        <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
            <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5L8.25 12l7.5-7.5"/>
        </svg>
        {{ __('Back') }}
    </a>

    <article class="mt-4 rounded-xl bg-white p-6 shadow-sm ring-1 ring-slate-200 sm:p-8">
        <a href="{{ route('forum.filter', ['typeFilter' => $post->postType->id]) }}"
           class="inline-block rounded-full bg-indigo-50 px-2.5 py-1 text-xs font-semibold text-indigo-700 transition hover:bg-indigo-100">
            {{ $post->postType->name }}
        </a>
        <h1 class="mt-3 text-2xl font-extrabold tracking-tight text-slate-900 sm:text-3xl">{{ $post->title }}</h1>
        <div class="mt-3 flex items-center gap-3">
            <img class="h-8 w-8 rounded-full bg-slate-300" alt=""
                 src="https://i.pravatar.cc/64?img={{ $post->user->id }}">
            <div class="text-sm">
                <span class="font-semibold text-slate-900">{{ $post->user->name }}</span>
                <span class="text-slate-500">· {{ $post->created_at->diffForHumans() }}</span>
            </div>
        </div>
        <div class="mt-6 whitespace-pre-line leading-relaxed text-slate-700">{{ $post->content }}</div>
    </article>

    <section class="mt-10">
        <h2 class="text-lg font-bold text-slate-900">
            Comments <span class="font-semibold text-slate-400">{{ $comments->count() }}</span>
        </h2>

        <div class="mt-4 space-y-3">
            @forelse ($comments as $comment)
                <div class="flex gap-3 rounded-xl bg-white p-4 shadow-sm ring-1 ring-slate-200">
                    <img class="h-8 w-8 shrink-0 rounded-full bg-slate-300" alt=""
                         src="https://i.pravatar.cc/64?img={{ $comment->user->id }}">
                    <div class="min-w-0 flex-1">
                        <div class="text-sm">
                            <span class="font-semibold text-slate-900">{{ $comment->user->name }}</span>
                            <span class="text-slate-500">· {{ $comment->created_at->diffForHumans() }}</span>
                        </div>
                        <p class="mt-1 whitespace-pre-line text-slate-700">{{ $comment->comment }}</p>
                    </div>
                </div>
            @empty
                <p class="rounded-xl border-2 border-dashed border-slate-200 p-6 text-center text-sm text-slate-500">
                    There are no comments on this post
                </p>
            @endforelse
        </div>

        @auth
            <form action="{{ route('comments.store') }}" method="POST"
                  class="mt-6 rounded-xl bg-white p-4 shadow-sm ring-1 ring-slate-200">
                @csrf
                <input type="hidden" name="post_id" value="{{ $post->id }}">
                <label class="sr-only" for="comment">Comment</label>
                <textarea name="comment" id="comment" rows="3" required
                          class="block w-full rounded-lg border-slate-300 shadow-xs placeholder:text-slate-400 focus:border-indigo-400 focus:ring-3 focus:ring-indigo-200/50"
                          placeholder="Write a comment…">{{ old('comment') }}</textarea>
                <x-input-error :messages="$errors->get('comment')" class="mt-2"/>
                <div class="mt-3 flex justify-end">
                    <x-primary-button>{{ __('Submit comment') }}</x-primary-button>
                </div>
            </form>
        @else
            <p class="mt-6 text-sm text-slate-500">
                <a href="{{ route('login') }}" class="font-semibold text-indigo-600 hover:text-indigo-500">Log in</a>
                to post a comment.
            </p>
        @endauth
    </section>
@endsection
