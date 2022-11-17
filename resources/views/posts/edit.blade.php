@extends('layout')

@section('slot')
    @if ($errors->any())
        @foreach ($errors->all() as $error)
            <x-alert message="{{ $error }}" type="error"></x-alert>
        @endforeach
    @endif
    <div class="rounded-xl border p-5 shadow-md bg-white mt-2 mb-2">
        <div class="mb-4">
            <h1 class="text-3xl font-bold">
                Edit Post
            </h1>
        </div>
        <form action="{{route('forum.update',[$post->id])}}" method="POST">
            <div class="mt-4 mb-6">
                @method('PATCH')
                @csrf
                <div>
                    <label class="block text-sm font-bold text-gray-700" for="title">Title:</label>
                    <input type="text" name="title" value='{{$post->title}}'
                           class="block w-full mt-1 border-gray-300 rounded-md shadow-sm placeholder:text-gray-400 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                           id="title" placeholder="Please input a title" required>
                </div>
                <div class="mt-4">
                    <label class="block text-sm font-bold text-gray-700" for="content">Content:</label>
                    <textarea
                        class="block w-full mt-1 border-gray-300 rounded-md shadow-sm placeholder:text-gray-400 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                        name="content" id="content" placeholder="Please input some content" required>{{$post->content}}</textarea>
                </div>
                <div class="mt-4">
                    <label class="block text-sm font-bold text-gray-700" for="type">Post type: :</label>
                    <select
                        class="block w-full mt-1 border-gray-300 rounded-md shadow-sm placeholder:text-gray-400 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                        name="type" id="type" required>
                        @foreach ( $types as $type )
                            <option value="{{$type->id}}" @if($post->post_type_id == $type->id) selected @endif>{{$type->name}}</option>
                        @endforeach
                    </select>
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
