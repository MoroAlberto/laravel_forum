@extends('layout')

@section('slot')
    @if(session('error'))
        <x-alert message="{{session('error')}}" type="error"></x-alert>
    @endif
    @if (session('success'))
        <x-alert message="{{session('success')}}" type="success"></x-alert>
    @endif
    @if ($errors->any())
        @foreach ($errors->all() as $error)
            <x-alert message="{{ $error }}" type="error"></x-alert>
        @endforeach
    @endif
    <div class="rounded-xl border p-2 shadow-md bg-slate-200 mt-2 mb-2">
        <div class="flex items-stretch">
            <p class="ml-1 mr-1 text">Filter by: </p>
            @foreach($types as $type)
                <form action="/filter" method="POST" class="mr-2">
                    @csrf
                    <input type="hidden" name="typeFilter" id="typeFilter" value="{{$type->id}}">
                    @if (isset($filterName) && $type->name == $filterName[0]->name)
                        <button
                            class="rounded-2xl border bg-yellow-200 px-3 py-1 text-xs font-bold ">{{$type->name}}</button>
                    @else
                        <button
                            class="rounded-2xl border bg-neutral-100 px-3 py-1 text-xs font-semibold ">{{$type->name}}</button>
                    @endif
                </form>
            @endforeach
        </div>
    </div>
    @if($posts->isEmpty())
        <div class="rounded-xl border p-5 shadow-md bg-white mt-2 mb-2">
            <div class="mt-2">
                <p class="ml-1 mr-1 text">There are no posts</p>
            </div>
        </div>
    @endif
    @foreach ($posts as $post )
        <x-post-card :post="$post"></x-post-card>
    @endforeach
    <div class="flex justify-between mt-4 ">
        @guest
            <p class="m-2">You must log in to make a post!</p>
        @endguest
        @auth
            <form action="{{route('forum.create')}}">
                <x-primary-button>Create a post</x-primary-button>
            </form>
        @endauth
        @if (isset($filterName))
            <form action="{{route('forum.index')}}">
                <x-primary-button>Clear filters</x-primary-button>
            </form>
        @endif
    </div>
    <div class="mx-auto pb-10">
{{--        {{$posts->links()}}--}}
    </div>
@endsection
