{{-- Shared fields of the create and edit forms, $post is null when creating --}}
@php($inputClass = 'block w-full mt-1 rounded-lg border-slate-300 shadow-xs placeholder:text-slate-400 focus:border-indigo-400 focus:ring-3 focus:ring-indigo-200/50')

<div class="space-y-5">
    <div>
        <x-input-label for="title" value="Title"/>
        <input type="text" name="title" id="title" required
               value="{{ old('title', $post?->title) }}"
               class="{{ $inputClass }}" placeholder="What do you want to talk about?">
        <x-input-error :messages="$errors->get('title')" class="mt-2"/>
    </div>
    <div>
        <x-input-label for="post_type_id" value="Type"/>
        <select name="post_type_id" id="post_type_id" required class="{{ $inputClass }}">
            @foreach ($types as $type)
                <option value="{{ $type->id }}" @selected(old('post_type_id', $post?->post_type_id) == $type->id)>
                    {{ $type->name }}
                </option>
            @endforeach
        </select>
        <x-input-error :messages="$errors->get('post_type_id')" class="mt-2"/>
    </div>
    <div>
        <x-input-label for="content" value="Content"/>
        <textarea name="content" id="content" rows="8" required
                  class="{{ $inputClass }}" placeholder="Write your post…">{{ old('content', $post?->content) }}</textarea>
        <x-input-error :messages="$errors->get('content')" class="mt-2"/>
    </div>
</div>

<div class="mt-6 flex items-center justify-end gap-4">
    <a href="{{ route('forum.index') }}" class="text-sm font-semibold text-slate-500 transition hover:text-slate-800">Cancel</a>
    <x-primary-button>{{ $submit }}</x-primary-button>
</div>
