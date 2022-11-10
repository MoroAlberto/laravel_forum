<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Details</title>
    @vite('resources/js/app.js')
</head>
<body>
<main class="app-container">
    <div class="post-container">
        <p class="post-title">{{$post->title}}</p>
        <p class="post-content">{{$post->content}}</p>
        <p class="post-user">Posted by: {{ $post->user->name}} on {{ $post->updated_at->format('d/m/Y')}}</p>
    </div>
    <h1 class="title">Comments</h1>
    @foreach ($comments as $index => $comment )
        <div class="comments-container">
            <h1>{{$comment->user->name}}</h1>
            <p>{{$comment->comment}}</p>
            <p class="comment-likes">Likes: {{$comment->likes}}</p>
        </div>
    @endforeach

    @auth
        <div class="add-comment-container">
            <form action="/add-comment" method="POST">
                @csrf
                <input type="hidden" name="post_id" value="{{$post->id}}">
                <label for="comment">Comment:</label>
                <input type="text" name="comment" id="comment">
                <button>Submit comment</button>
            </form>
        </div>
    @endauth

    @guest
        <p>You must be logged in to post a comment</p>
    @endguest

    <div class="buttons-container">
        <form action="{{route('forum.index')}}" method="GET">
            <button>Back</button>
        </form>
    </div>
</main>

</body>
</html>
