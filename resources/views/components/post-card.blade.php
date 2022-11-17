<div class="rounded-xl border p-5 shadow-md bg-white mt-2 mb-2">
    <div class="flex w-full items-center justify-between border-b pb-3">
        <div class="flex items-center space-x-3">
            <img class="h-8 w-8 rounded-full bg-slate-400" alt="Profile pic"
                 src="https://i.pravatar.cc/32?img={{ $post->user->id }}">
            <div class="text-lg font-bold text-slate-700">{{ $post->user->name }}</div>
        </div>
        <div class="flex items-center space-x-8">
            <form action="/filter" method="POST">
                @csrf
                <input type="hidden" name="typeFilter" id="typeFilter" value="{{$post->postType->id}}">
                <button
                    class="rounded-2xl border bg-neutral-100 px-3 py-1 text-xs font-semibold">{{$post->postType->name}}</button>
            </form>
            <div class="text-xs text-neutral-500">{{ $post->created_at->diffForHumans() }}</div>
        </div>
    </div>
    <div class="mt-4 mb-6" onclick="location.href='{{ route('forum.show',$post->id) }}';">
        <a class="mb-3 text-xl font-bold" href="{{ route('forum.show',$post->id) }}">{{$post->title}}</a>
        <div class="text-sm text-neutral-600">{{$post->content}}
        </div>
    </div>
    <div>
        <div class="flex items-center justify-between text-slate-500">
            <div class="flex space-x-4 md:space-x-8">
                <div class="flex cursor-pointer items-center transition hover:text-slate-600"
                     onclick="location.href='{{ route('forum.show',$post->id) }}';">
                    <svg xmlns="http://www.w3.org/2000/svg" class="mr-1.5 h-5 w-5" fill="none"
                         viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round"
                              d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z"/>
                    </svg>
                    <span>{{count($post->comments)}}</span>
                </div>
                <div x-data={} x-on:click="addLike( {{$post->id}} )"
                     class="flex items-center transition hover:text-slate-600">
                    <svg xmlns="http://www.w3.org/2000/svg" class="mr-1.5 h-5 w-5" fill="none"
                         viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round"
                              d="M14 10h4.764a2 2 0 011.789 2.894l-3.5 7A2 2 0 0115.263 21h-4.017c-.163 0-.326-.02-.485-.06L7 20m7-10V5a2 2 0 00-2-2h-.095c-.5 0-.905.405-.905.905 0 .714-.211 1.412-.608 2.006L7 11v9m7-10h-2M7 20H5a2 2 0 01-2-2v-6a2 2 0 012-2h2.5"/>
                    </svg>
                    <span id="like_{{$post->id}}">{{count($post->likes)}}</span>
                </div>
                @auth
                    <form action="{{route('forum.edit',[$post->id])}}" method="GET">
                        <button>Edit post</button>
                    </form>

                    <form action="{{ route('forum.destroy',$post->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit">Delete post</button>
                    </form>
                @endauth
            </div>
        </div>
    </div>
</div>

<script>
    function addLike(post_id) {
        window.Laravel = @json(['csrf_token' =>csrf_token()]);
        fetch('/like', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'Accept': 'application/json',
                'url': '/like',
                'X-CSRF-Token': Laravel.csrf_token
            },
            body: JSON.stringify({post_id: post_id}),
        })
            .then(Result => Result.json())
            .then(string => {
                if (string.message === "Unauthenticated.") {
                    alert("Only register users can like a post");
                } else if (string.success === "true") {
                    const element = document.getElementById('like_' + post_id);
                    const oldLike = parseInt(element.innerText, 10)
                    element.innerHTML = oldLike + 1;
                    element.classList.add("bg-blue-100");
                } else if (string.message.startsWith("SQLSTATE[23000]:")) {
                    alert("You already liked this post");
                }
            })
            .catch(errorMsg => {
                console.log(errorMsg);
            });
    }
</script>
