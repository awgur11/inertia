<?php

namespace App\Http\Middleware;

use Illuminate\Http\Request;
use Inertia\Middleware;
use Tightenco\Ziggy\Ziggy;

class HandleInertiaRequests extends Middleware
{
    /**
     * The root template that is loaded on the first page visit.
     *
     * @var string
     */
    protected $rootView = 'app';

    /**
     * Determine the current asset version.
     */
    public function version(Request $request): string|null
    {
        return parent::version($request);
    }

    /**
     * Define the props that are shared by default.
     *
     * @return array<string, mixed>
     */
    public function share(Request $request): array
    {
        return [
            ...parent::share($request),
            'auth' => [
                'user' => $request->user(),
            ],
            'ziggy' => fn () => [
                ...(new Ziggy)->toArray(),
                'location' => $request->url(),
            ],
            'flash' => [
                'message' => fn () => $request->session()->get('message'),
                'error' => fn () => $request->session()->get('error')
            ],
            'languages' => $this->getLanguages($request)

        ];
    }

    private function getLanguages(Request $request)
    {
        try{
            $languages = \App\Models\Language::orderBy('position')->get();
        } catch(\Exemption $e) {
            $languages = collect([
                [
                    'title' => 'Русский',
                    'short' => 'рус',
                    'locale' => 'ru',
                    'position' => 0,
                    'public' => 1,
                ],
                [
                    'title' => 'Украинский',
                    'short' => 'укр',
                    'locale' => 'ua',
                    'position' => 0,
                    'public' => 1,
                ],
            ]);
       }

        return $languages->map(function($item) use($request){
                if(\App::getLocale() == $item->locale)
                    $item->current = true;
                else
                    $item->current = false;

                $uri = preg_replace('/^[a-z]{2}\//', '', $request->path());

                if($item->locale != config('app.fallback_locale'))
                    $uri = $item->locale.'/'.$uri;

                $item->link = url($uri);
                
                return $item;
        });
    }
}
