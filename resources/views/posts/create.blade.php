@extends('layout')

@section('slot')
    <h1 class="text-2xl font-extrabold tracking-tight text-slate-900">New post</h1>
    <form action="{{ route('forum.store') }}" method="POST"
          class="mt-6 rounded-xl bg-white p-6 shadow-sm ring-1 ring-slate-200">
        @csrf
        @include('posts._form', ['post' => null, 'submit' => 'Publish'])
    </form>
@endsection
