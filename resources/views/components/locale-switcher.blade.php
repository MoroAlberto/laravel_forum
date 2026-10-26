@php($current = app()->getLocale())

<form method="POST" action="{{ route('locale.update') }}" {{ $attributes->merge(['class' => 'inline-flex rounded-lg bg-slate-100 p-0.5']) }}>
    @csrf
    @foreach (\App\Http\Middleware\SetLocale::LOCALES as $locale => $name)
        <button type="submit" name="locale" value="{{ $locale }}" title="{{ $name }}" lang="{{ $locale }}"
                @if ($locale === $current) aria-current="true" @endif
                @class([
                    'rounded-md px-2 py-1 text-xs font-bold uppercase transition',
                    'bg-white text-slate-900 shadow-sm' => $locale === $current,
                    'text-slate-500 hover:text-slate-800' => $locale !== $current,
                ])>{{ $locale }}</button>
    @endforeach
</form>
