<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Symfony\Component\HttpFoundation\Response;

class SetLocale
{
    /**
     * Languages the user can choose, with the name shown in the switcher.
     */
    public const LOCALES = [
        'en' => 'English',
        'it' => 'Italiano',
    ];

    /**
     * Use the language chosen in the switcher, otherwise the browser's preferred one.
     */
    public function handle(Request $request, Closure $next): Response
    {
        $locale = $request->session()->get('locale');

        if (! isset(self::LOCALES[$locale]) && $request->hasHeader('Accept-Language')) {
            $locale = $request->getPreferredLanguage(array_keys(self::LOCALES));
        }

        if (isset(self::LOCALES[$locale])) {
            App::setLocale($locale);
        }

        return $next($request);
    }
}
