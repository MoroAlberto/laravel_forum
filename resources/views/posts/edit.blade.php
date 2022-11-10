<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit</title>
    @vite('resources/js/app.js')
</head>
<body>
<main class="app-container">
    <h1 class="title">Edit your post</h1>
    <form action="{{route('forum.update',[$post->id])}}" class="edit-container" method="POST">
        @method('PATCH')
        @csrf
        <div>
            <label for="title">Title: </label>
            <input type="text" name="title" id="title" placeholder="Please input a title" value='{{$post->title}}'
                   required>
            <label for="content">Content: </label>
            <input type="text" name="content" id="content" placeholder="Please input some content"
                   value='{{$post->content}}'
                   required>
        </div>
        <button type="submit">Submit</button>
    </form>
</main>
</body>
</html>
