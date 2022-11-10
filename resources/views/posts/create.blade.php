<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create</title>
    @vite('resources/js/app.js')
</head>
<body>
<main class="w-6/12 m-auto">
    <div class="m-auto w-4/8 py-24">
        <div class="text-center">
            <p class="m-auto justify-center font-bold text-gray-600 mt-2 mb-2">Create a post</p>
            <h1 class="text-5xl uppercase bold">Create a post</h1>
            <p class="text-5xl uppercase bold">Create a post</p>
        </div>
    </div>

    <form action="{{route('forum.store')}}" method="POST">
        @csrf
        <div>
            <label for="title">Title: </label>
            <input type="text" name="title" id="title" placeholder="Please input a title" required>
            <label for="content">Content: </label>
            <input type="text" name="content" id="content" placeholder="Please input some content" required>
            <label for="type">Post Type: </label>
            <select name="type" id="type">
                @foreach ( $types as $type )
                    <option value="{{$type->id}}">{{$type->name}}</option>
                @endforeach
            </select>
        </div>
        <button type="submit">Submit</button>
    </form>
    <form action="{{route('forum.index')}}" method="GET">
        <button>Back</button>
    </form>
</main>
</body>
</html>
