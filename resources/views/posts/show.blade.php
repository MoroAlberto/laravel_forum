@extends('layout')

@section('slot')
    <div class="rounded-xl border p-5 shadow-md bg-white mt-2 mb-2">
        <div class="mt-4 mb-6">
            <p class="mb-3 text-3xl font-bold">{{$post->title}}</p>
            <div class="ml-1 mr-1 text-2xl">{{$post->content}}
            </div>
        </div>
        <div class="flex w-full items-center justify-between border-t pt-3">
            <div class="flex items-center space-x-3">
                <button
                    class="rounded-2xl border bg-neutral-100 px-3 py-1 text-xs font-semibold">{{$post->postType->name}}</button>
            </div>
            <div class="flex items-center space-x-8">
                <div class="text-xs text-neutral-500">Posted by: {{ $post->user->name}}
                    on {{ $post->created_at->diffForHumans() }}</div>
            </div>
        </div>
    </div>
    <h1 class="mb-3 text-3xl font-bold">Comments:</h1>
    @if($comments->isEmpty())
        <div class="rounded-xl border p-5 shadow-md bg-white mt-2 mb-2">
            <div class="mt-2">
                <p class="ml-1 mr-1 text">There are no comments on this post</p>
            </div>
        </div>
    @endif
    @foreach ($comments as $index => $comment )
        <div class="rounded-xl border p-5 shadow-md bg-white mt-2 mb-2 bg-slate-300">
            <div class="mt-2">
                <div class="ml-1 mr-1 mb-3 text-xl">{{$comment->comment}}</div>
                <p class="ml-1 mr-1 text">Posted by: {{ $comment->user->name}}</p>
                <div class="flex items-center transition hover:text-slate-600">
                    <svg xmlns="http://www.w3.org/2000/svg" class="mr-1.5 h-5 w-5" fill="none"
                         viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round"
                              d="M14 10h4.764a2 2 0 011.789 2.894l-3.5 7A2 2 0 0115.263 21h-4.017c-.163 0-.326-.02-.485-.06L7 20m7-10V5a2 2 0 00-2-2h-.095c-.5 0-.905.405-.905.905 0 .714-.211 1.412-.608 2.006L7 11v9m7-10h-2M7 20H5a2 2 0 01-2-2v-6a2 2 0 012-2h2.5"/>
                    </svg>
                    <span>{{$comment->likes}}</span>
                </div>
            </div>
        </div>
    @endforeach
    @auth
        <div class="rounded-xl border p-5 shadow-md bg-white mt-2 mb-2">
            <div class="mb-4">
                <h1 class="text-3xl font-bold">
                    Create a comment
                </h1>
            </div>
            <form action="/add-comment" method="POST">
                @csrf
                <input type="hidden" name="post_id" value="{{$post->id}}">
                <div>
                    <label class="block text-sm font-bold text-gray-700" for="comment">Comment:</label>
                    <input type="text" name="comment"
                           class="block w-full mt-1 border-gray-300 rounded-md shadow-sm placeholder:text-gray-400 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                           id="comment" placeholder="Please input a comment" required>
                </div>
                <div class="flex justify-between mt-4 ">
                    <x-primary-button type="submit"> {{ __('Submit comment') }}</x-primary-button>
                </div>
            </form>
        </div>
    @endauth
    <div class="flex justify-between mt-4 ">
        @guest
            <p class="m-2">You must be logged in to post a comment</p>
        @endguest
        <div></div>
        <form action="{{route('forum.index')}}" method="GET">
            <x-primary-button>
                {{ __('Back') }}
            </x-primary-button>
        </form>
    </div>
@endsection
