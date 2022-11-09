<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Posts Index</title>
    {{--    <link href="{{ asset('css/app.css') }}" rel="stylesheet">--}}
    @vite(['resources/css/app.css'])
</head>
<body class="h-screen overflow-hidden flex items-center justify-center" style="background: #edf2f7;">
<main class="w-6/12 m-auto">
    <h1 class="m-auto justify-center font-bold text-gray-600 mt-2 mb-2">Welcome to my forum</h1>
    @auth
        You are logged in as <strong>{{Auth::user()->name}}</strong>
        <form action="logout">
            <button>Logout</button>
        </form>
        {{--            @if(Auth::user()->is_admin == 1)--}}
        {{--                You are an admin, this means that you can create a user.--}}
        {{--                <form action="/user-creation"><button>Create user</button></form>--}}
        {{--            @endif--}}
    @endauth

    @if(Session::has('userCreated'))
        {{Session::get('userCreated')}}
    @endif

    @guest
        Please login down below:

        <form action="login" method="POST">
            @csrf
            <label for="email">Email: </label>
            <input type="text" placeholder="Email" name="email" id="email">
            <label for="password">Password: </label>
            <input type="password" name="password" id="password" placeholder="Password">
            <button>Submit</button>
        </form>
    @endguest

    @if(Session::has('errorMsg'))
        <div class="error-message">{{Session::get('errorMsg')}}</div>
    @endif

    {{--        <div class="filter-buttons">--}}
    {{--            <form action="/post-filter" method="POST">--}}
    {{--                @csrf--}}
    {{--                <select name="typeFilter" id="typeFilter">--}}
    {{--                @foreach($types as $type)--}}
    {{--                    <option value="{{$type->id}}">{{$type->typeName}}</option>--}}
    {{--                @endforeach--}}
    {{--                </select>--}}
    {{--                <button>Filter</button>--}}
    {{--            </form>--}}
    {{--            <form action="/">--}}
    {{--                <button>Clear filters</button>--}}
    {{--            </form>--}}
    {{--        </div>--}}
    {{--        @if (isset($filterName))--}}
    {{--            Current filter: {{$filterName[0]->typeName}}--}}
    {{--        @endif--}}
    <!-- This is an example component -->
    <div class='items-center justify-center min-h-screen'>
        @foreach ($posts as $post )
            <div class="rounded-xl border p-5 shadow-md w-9/12 bg-white">
                <div class="flex w-full items-center justify-between border-b pb-3">
                    <div class="flex items-center space-x-3">
                        <div class="h-8 w-8 rounded-full bg-slate-400 bg-[url('https://i.pravatar.cc/32')]"></div>
                        <div class="text-lg font-bold text-slate-700">{{ $post->user->name }}</div>
                    </div>
                    <div class="flex items-center space-x-8">
                        <button
                            class="rounded-2xl border bg-neutral-100 px-3 py-1 text-xs font-semibold">{{$post->postType->typeName}}</button>
                        {{--                    <div class="text-xs text-neutral-500">2 hours ago</div>--}}
                    </div>
                </div>
                <div class="mt-4 mb-6">
                    <a class="mb-3 text-xl font-bold" href="/{{$post->id}}">{{$post->title}}</a>
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
                            <form action="/{{$post->id}}/edit">
                                <button>Edit post</button>
                            </form>
                            @auth
                                <form action="/{{$post->id}}/delete">
                                    <button>Delete post</button>
                                </form>
                            @endauth
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    @guest
        <p class="m-2">You must log in to make a post!</p>
    @endguest
    @auth
        <form action="/create">
            <button class="">Create a post</button>
        </form>
    @endauth
</main>
</body>
</html>
