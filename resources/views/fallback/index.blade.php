@extends('layout')

@section('slot')
    <div class="rounded-xl border p-5 shadow-md bg-white mt-2 mb-2">
        <h1 class="text-3xl font-bold">
            {{ __('message.fallback') }}
        </h1>
    </div>
    <div class="flex justify-between mt-4">
        <div></div>
        <form action="{{ route('forum.index') }}" method="GET">
            <x-primary-button>
                {{ __('Back') }}
            </x-primary-button>
        </form>
    </div>
@endsection
