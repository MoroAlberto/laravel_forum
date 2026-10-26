@extends('layout')

@section('slot')
    <div class="rounded-xl bg-white p-10 text-center shadow-sm ring-1 ring-slate-200">
        <p class="text-5xl font-extrabold text-indigo-600">404</p>
        <h1 class="mt-3 text-xl font-bold text-slate-900">{{ __('message.fallback') }}</h1>
        <a href="{{ route('forum.index') }}"
           class="mt-6 inline-flex rounded-lg bg-indigo-600 px-4 py-2 text-sm font-semibold text-white shadow-sm transition hover:bg-indigo-500">
            {{ __('Back') }}
        </a>
    </div>
@endsection
