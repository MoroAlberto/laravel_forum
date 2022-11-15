@extends('welcome')

@section('slot')

    <div class="rounded-xl border p-5 shadow-md bg-white mt-2 mb-2">
        <form action="{{route('forum.update',[$post->id])}}" method="POST">
            <div class="mt-4 mb-6">
                <p class="mb-3 text-3xl font-bold">Edit your post</p>
                @method('PATCH')
                @csrf
                <div class="ml-1 mr-1 text-2xl">
                    <label for="title">Title: </label>
                    <input type="text" name="title" id="title" placeholder="Please input a title"
                           value='{{$post->title}}'
                           required>
                    <br>
                    <br>
                    <label for="content">Content: </label>
                    <input type="text" name="content" id="content" placeholder="Please input some content"
                           value='{{$post->content}}'
                           required>
                </div>
            </div>
            <div class="flex justify-between mt-4 ">
                <x-primary-button type="submit">Submit</x-primary-button>
            </div>
        </form>
    </div>
    <div class="flex justify-between mt-4 ">
        <div></div>
        <form action="{{route('forum.index')}}" method="GET">
            <x-primary-button>
                {{ __('Back') }}
            </x-primary-button>
        </form>
    </div>
@endsection
