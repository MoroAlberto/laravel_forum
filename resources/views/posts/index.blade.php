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

    <nav class="mt-6 flex gap-2 overflow-x-auto pb-1 lg:hidden" aria-label="{{ __('message.filter_by_type') }}">
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

@section('sidebar')
    <section class="rounded-xl bg-white p-5 shadow-sm ring-1 ring-slate-200">
        <h2 class="text-sm font-bold uppercase tracking-wide text-slate-500">{{ __('message.topics') }}</h2>
        <ul class="mt-3 space-y-1">
            <li>
                <a href="{{ route('forum.index') }}"
                   @class([
                       'flex items-center justify-between rounded-lg px-3 py-2 text-sm font-semibold transition',
                       'bg-slate-100 text-slate-900' => ! isset($filterName),
                       'text-slate-600 hover:bg-slate-50' => isset($filterName),
                   ])>
                    {{ __('message.all') }}
                    <span class="text-xs font-medium text-slate-400">{{ $types->sum('posts_count') }}</span>
                </a>
            </li>
            @foreach ($types as $type)
                <li>
                    <a href="{{ route('forum.filter', ['typeFilter' => $type->id]) }}"
                       @class([
                           'flex items-center justify-between rounded-lg px-3 py-2 text-sm font-semibold transition',
                           'bg-slate-100 text-slate-900' => ($filterName ?? null) === $type->name,
                           'text-slate-600 hover:bg-slate-50' => ($filterName ?? null) !== $type->name,
                       ])>
                        <span class="flex items-center gap-2">
                            <span class="h-2.5 w-2.5 rounded-full {{ $type->dotClasses() }}"></span>
                            {{ $type->name }}
                        </span>
                        <span class="text-xs font-medium text-slate-400">{{ $type->posts_count }}</span>
                    </a>
                </li>
            @endforeach
        </ul>
    </section>

    <section class="rounded-xl bg-gradient-to-br from-indigo-600 to-violet-600 p-5 text-white shadow-sm">
        <h2 class="font-bold">{{ __('message.about_title', ['name' => config('app.name')]) }}</h2>
        <p class="mt-2 text-sm leading-relaxed text-indigo-100">{{ __('message.about_text') }}</p>
    </section>
@endsection
