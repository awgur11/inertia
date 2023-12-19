<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\Language;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Cache;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // $site_languages = Cache::remember('site_languages', 3600, function(){
        //     return Language::wherePublic(1)->orderBy('position')->get();
        // });

        // if($site_languages->where('locale', $this->app->request->segment(1))->first() != null)
        // {
        //     \App::setLocale($this->app->request->segment(1));

        //     config(['csl' => $this->app->request->segment(1)]);
        // }
        // else
        //     $csl = \App::getLocale();


    }
}
