<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Posts Index</title>
    <link href="{{ asset('css/main.css') }}" rel="stylesheet">

</head>
<body>
    <main class="app-container">
        <h1 class="title">Welcome to my forum</h1>
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

        @foreach ($posts as $post )
        <div class="post-container">
            <p class="post-title"><a href="/{{$post->id}}">{{$post->title}}</a></p>
            <p class="post-content">{{$post->content}}</p>
            <p class="post-user">Posted by: {{App\Models\User::find($post->postedBy)->name}}</p>
            <div class="button-container">
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
        @endforeach

        @guest
            <p class="login-prompt">You must log in to make a post!</p>
        @endguest
        @auth
        <form action="/create">
            <button class="create-button">Create a post</button>
        </form>
        @endauth
    </main>
</body>
</html>
