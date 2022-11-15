@extends('welcome')

@section('slot')
    @auth
        You are logged in as <strong>{{Auth::user()->name}}</strong>
        <form action="logout">
            <button>Logout</button>
        </form>
        @if(Auth::user()->is_admin == 1)
            You are an admin, this means that you can create a user.
            <form action="/user-creation">
                <button>Create user</button>
            </form>
        @endif
    @endauth
{{--    @if(Session::has('alert_message'))--}}
{{--        <x-alert :message="session('alert_message')" type="error"></x-alert>--}}
{{--    @endif--}}
{{--    @if (session('success'))--}}
{{--        <div id="alert-1" class="flex p-4 mb-4 bg-blue-100 rounded-lg dark:bg-blue-200" role="alert">--}}
{{--            <svg aria-hidden="true" class="flex-shrink-0 w-5 h-5 text-blue-700 dark:text-blue-800" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path></svg>--}}
{{--            <span class="sr-only">Info</span>--}}
{{--            <div class="ml-3 text-sm font-medium text-blue-700 dark:text-blue-800">--}}
{{--                {{ session('success') }}--}}
{{--            </div>--}}
{{--            <button type="button" class="ml-auto -mx-1.5 -my-1.5 bg-blue-100 text-blue-500 rounded-lg focus:ring-2 focus:ring-blue-400 p-1.5 hover:bg-blue-200 inline-flex h-8 w-8 dark:bg-blue-200 dark:text-blue-600 dark:hover:bg-blue-300" data-dismiss-target="#alert-1" aria-label="Close">--}}
{{--                <span class="sr-only">Close</span>--}}
{{--                <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>--}}
{{--            </button>--}}
{{--        </div>--}}
{{--    @endif--}}
{{--            <div class="filter-buttons">--}}
{{--                <form action="/post-filter" method="POST">--}}
{{--                    @csrf--}}
{{--                    <select name="typeFilter" id="typeFilter">--}}
{{--                    @foreach($types as $type)--}}
{{--                        <option value="{{$type->id}}">{{$type->name}}</option>--}}
{{--                    @endforeach--}}
{{--                    </select>--}}
{{--                    <button>Filter</button>--}}
{{--                </form>--}}
{{--                <form action="/">--}}
{{--                    <button>Clear filters</button>--}}
{{--                </form>--}}
{{--            </div>--}}
{{--            @if (isset($filterName))--}}
{{--                Current filter: {{$filterName[0]->name}}--}}
{{--            @endif--}}
    <div class='items-center justify-center min-h-screen w-8/12 m-auto '>
        @foreach ($posts as $post )
            <div class="rounded-xl border p-5 shadow-md bg-white mt-2 mb-2">
                <div class="flex w-full items-center justify-between border-b pb-3">
                    <div class="flex items-center space-x-3">
                        <div class="h-8 w-8 rounded-full bg-slate-400 bg-[url('https://i.pravatar.cc/32')]"></div>
                        <div class="text-lg font-bold text-slate-700">{{ $post->user->name }}</div>
                    </div>
                    <div class="flex items-center space-x-8">
                        <button
                            class="rounded-2xl border bg-neutral-100 px-3 py-1 text-xs font-semibold">{{$post->postType->name}}</button>
                        <div class="text-xs text-neutral-500">{{ $post->created_at->diffForHumans() }}</div>
                    </div>
                </div>
                <div class="mt-4 mb-6">
                    <a class="mb-3 text-xl font-bold" href="{{ route('forum.show',$post->id) }}">{{$post->title}}</a>
                    <div class="text-sm text-neutral-600">{{$post->content}}
                    </div>
                </div>
                <div>
                    <div class="flex items-center justify-between text-slate-500">
                        <div class="flex space-x-4 md:space-x-8">
                            <div class="flex cursor-pointer items-center transition hover:text-slate-600">
                                <svg xmlns="http://www.w3.org/2000/svg" class="mr-1.5 h-5 w-5" fill="none"
                                     viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                          d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z"/>
                                </svg>
                                <span>{{count($post->comments)}}</span>
                            </div>
                            <div class="flex cursor-pointer items-center transition hover:text-slate-600">
                                <svg xmlns="http://www.w3.org/2000/svg" class="mr-1.5 h-5 w-5" fill="none"
                                     viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                          d="M14 10h4.764a2 2 0 011.789 2.894l-3.5 7A2 2 0 0115.263 21h-4.017c-.163 0-.326-.02-.485-.06L7 20m7-10V5a2 2 0 00-2-2h-.095c-.5 0-.905.405-.905.905 0 .714-.211 1.412-.608 2.006L7 11v9m7-10h-2M7 20H5a2 2 0 01-2-2v-6a2 2 0 012-2h2.5"/>
                                </svg>
                                <span>{{count($post->likes)}}</span>
                            </div>
                            <form action="{{route('forum.edit',[$post->id])}}">
                                <button>Edit post</button>
                            </form>
                            @auth
                                <form action="{{route('forum.destroy',[$post->id])}}" method="POST">
                                    @method('DELETE')
                                    @csrf
                                    <button type="submit">Delete post</button>
                                </form>
                            @endauth
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
        @guest
            <p class="m-2">You must log in to make a post!</p>
        @endguest
        @auth
            <form action="{{route('forum.create')}}">
                <button class="">Create a post</button>
            </form>
        @endauth
    </div>
@endsection
