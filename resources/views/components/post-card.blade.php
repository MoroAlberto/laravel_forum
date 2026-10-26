<article class="rounded-xl bg-white p-5 shadow-sm ring-1 ring-slate-200 transition hover:shadow-md hover:ring-slate-300">
    <div class="flex items-center justify-between gap-3">
        <div class="flex min-w-0 items-center gap-3">
            <img class="h-9 w-9 shrink-0 rounded-full bg-slate-300" alt=""
                 src="https://i.pravatar.cc/72?img={{ $post->user->id }}">
            <div class="min-w-0">
                <div class="truncate text-sm font-semibold text-slate-900">{{ $post->user->name }}</div>
                <div class="text-xs text-slate-500">{{ $post->created_at->diffForHumans() }}</div>
            </div>
        </div>
        <a href="{{ route('forum.filter', ['typeFilter' => $post->postType->id]) }}"
           class="shrink-0 rounded-full bg-indigo-50 px-2.5 py-1 text-xs font-semibold text-indigo-700 transition hover:bg-indigo-100">
            {{ $post->postType->name }}
        </a>
    </div>

    <a href="{{ route('forum.show', $post->id) }}" class="group mt-4 block">
        <h2 class="text-lg font-bold text-slate-900 group-hover:text-indigo-600">{{ $post->title }}</h2>
        <p class="mt-1 line-clamp-3 text-sm leading-relaxed text-slate-600">{{ $post->content }}</p>
    </a>

    <div class="mt-4 flex items-center justify-between border-t border-slate-100 pt-3 text-sm text-slate-500">
        <div class="flex items-center gap-5">
            <a href="{{ route('forum.show', $post->id) }}"
               class="flex items-center gap-1.5 transition hover:text-indigo-600" title="Comments">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                     viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round"
                          d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z"/>
                </svg>
                <span>{{ $post->comments_count }}</span>
            </a>
            <button type="button" x-data x-on:click="addLike({{ $post->id }})" data-like
                    class="flex items-center gap-1.5 transition hover:text-indigo-600" title="Like">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                     viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round"
                          d="M14 10h4.764a2 2 0 011.789 2.894l-3.5 7A2 2 0 0115.263 21h-4.017c-.163 0-.326-.02-.485-.06L7 20m7-10V5a2 2 0 00-2-2h-.095c-.5 0-.905.405-.905.905 0 .714-.211 1.412-.608 2.006L7 11v9m7-10h-2M7 20H5a2 2 0 01-2-2v-6a2 2 0 012-2h2.5"/>
                </svg>
                <span id="like_{{ $post->id }}">{{ $post->likes_count }}</span>
            </button>
        </div>
        <div class="flex items-center gap-3 text-xs font-semibold">
            @can('update', $post)
                <a href="{{ route('forum.edit', [$post->id]) }}" class="transition hover:text-indigo-600">Edit</a>
            @endcan
            @can('delete', $post)
                <form action="{{ route('forum.destroy', $post->id) }}" method="POST"
                      onsubmit="return confirm('Delete this post?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="transition hover:text-red-600">Delete</button>
                </form>
            @endcan
        </div>
    </div>
</article>
