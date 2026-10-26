@extends('layout')

@section('slot')
    <h1 class="text-2xl font-extrabold tracking-tight text-slate-900">{{ __('message.edit_post') }}</h1>
    <form action="{{ route('forum.update', [$post->id]) }}" method="POST"
          class="mt-6 rounded-xl bg-white p-6 shadow-sm ring-1 ring-slate-200">
        @method('PATCH')
        @csrf
        @include('posts._form', ['submit' => __('message.save_changes')])
    </form>
@endsection
