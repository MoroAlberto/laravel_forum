@props(['post'])

{{-- guests get a link to the login page, logged users like the post through addLike() in app.js --}}
@php($liked = (bool) ($post->liked ?? false))
@guest
    <a href="{{ route('login') }}" title="{{ __('message.like') }}"
       {{ $attributes->merge(['class' => 'flex items-center gap-1.5 transition hover:text-indigo-600']) }}>
@else
    <button type="button" x-data x-on:click="addLike({{ $post->id }})" data-like title="{{ __('message.like') }}"
            @if ($liked) aria-pressed="true" @endif
            {{ $attributes->class(['flex items-center gap-1.5 transition hover:text-indigo-600', 'text-indigo-600' => $liked]) }}>
@endguest
        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="{{ $liked ? 'currentColor' : 'none' }}"
             viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
            <path stroke-linecap="round" stroke-linejoin="round"
                  d="M14 10h4.764a2 2 0 011.789 2.894l-3.5 7A2 2 0 0115.263 21h-4.017c-.163 0-.326-.02-.485-.06L7 20m7-10V5a2 2 0 00-2-2h-.095c-.5 0-.905.405-.905.905 0 .714-.211 1.412-.608 2.006L7 11v9m7-10h-2M7 20H5a2 2 0 01-2-2v-6a2 2 0 012-2h2.5"/>
        </svg>
        <span @auth id="like_{{ $post->id }}" @endauth>{{ $post->likes_count }}</span>
@guest
    </a>
@else
    </button>
@endguest
