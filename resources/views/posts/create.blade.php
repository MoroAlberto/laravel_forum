<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create</title>
    <link href="{{ asset('css/main.css') }}" rel="stylesheet">
</head>
<body>
<main class="app-container">
    <h1 class="title">Create a post</h1>
    <form action="/submit" class="edit-container" method="POST">
        @csrf
        <div>
            <label for="title">Title: </label>
            <input type="text" name="title" id="title" placeholder="Please input a title" required>
            <label for="content">Content: </label>
            <input type="text" name="content" id="content" placeholder="Please input some content" required>
            <label for="type">Post Type: </label>
            <select name="type" id="type">
                @foreach ( $types as $type )
                    <option value="{{$type->id}}">{{$type->typeName}}</option>
                @endforeach
            </select>
        </div>
        <button type="submit">Submit</button>
    </form>
    <form action="/">
        <button>Back</button>
    </form>
</main>
</body>
</html>
