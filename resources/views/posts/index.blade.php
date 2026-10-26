@extends('layout')

@section('slot')
    @if ($errors->any())
        @foreach ($errors->all() as $error)
            <x-alert message="{{ $error }}" type="error"></x-alert>
        @endforeach
    @endif

    <div class="mt-2 flex items-center justify-between gap-4">
        <div>
            <h1 class="text-2xl font-extrabold tracking-tight text-slate-900">
                {{ $filterName ?? __('message.latest_discussions') }}
            </h1>
            <p class="mt-1 text-sm text-slate-500">
                @guest
                    <a href="{{ route('login') }}" class="font-semibold text-indigo-600 hover:text-indigo-500">{{ __('message.log_in') }}</a>
                    {{ __('message.to_start_discussion') }}
                @else
                    {{ __('message.share_something') }}
                @endguest
            </p>
        </div>
        @auth
            <a href="{{ route('forum.create') }}"
               class="inline-flex shrink-0 items-center gap-1.5 rounded-lg bg-indigo-600 px-4 py-2 text-sm font-semibold text-white shadow-sm transition hover:bg-indigo-500 focus:outline-hidden focus:ring-3 focus:ring-indigo-300">
                <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15"/>
                </svg>
                {{ __('message.new_post') }}
            </a>
        @endauth
    </div>

    <nav class="mt-6 flex gap-2 overflow-x-auto pb-1" aria-label="{{ __('message.filter_by_type') }}">
        <a href="{{ route('forum.index') }}"
           @class([
               'shrink-0 rounded-full px-3.5 py-1.5 text-sm font-semibold transition',
               'bg-slate-900 text-white' => ! isset($filterName),
               'bg-white text-slate-600 ring-1 ring-slate-200 hover:bg-slate-50' => isset($filterName),
           ])>{{ __('message.all') }}</a>
        @foreach ($types as $type)
            <a href="{{ route('forum.filter', ['typeFilter' => $type->id]) }}"
               @class([
                   'shrink-0 rounded-full px-3.5 py-1.5 text-sm font-semibold transition',
                   'bg-slate-900 text-white' => ($filterName ?? null) === $type->name,
                   'bg-white text-slate-600 ring-1 ring-slate-200 hover:bg-slate-50' => ($filterName ?? null) !== $type->name,
               ])>{{ $type->name }}</a>
        @endforeach
    </nav>

    <div class="mt-6 space-y-4">
        @forelse ($posts as $post)
            <x-post-card :post="$post"></x-post-card>
        @empty
            <div class="rounded-xl bg-white p-10 text-center shadow-sm ring-1 ring-slate-200">
                <p class="font-semibold text-slate-700">{{ __('message.no_posts') }}</p>
                <p class="mt-1 text-sm text-slate-500">{{ __('message.be_first') }}</p>
            </div>
        @endforelse
    </div>

    <div class="mt-8">
        @if ($posts instanceof \Illuminate\Contracts\Pagination\Paginator)
            {{ $posts->links() }}
        @endif
    </div>
@endsection
