<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Language;
use Inertia\Inertia;
use Illuminate\Support\Facades\Redirect;

class LanguageController extends Controller
{
    public function index()
    {
        return Inertia('Languages/Index', [
            'languages' => Language::get(),
            'site_locale' => \App::getLocale(),
        ]); 
    }

    public function store(Request $request)
    {
        $languages = $request->languages;

        $languages = collect($languages);

        if($languages->whereNull('locale')->first() != null || $languages->whereNull('short')->first() != null || $languages->whereNull('title')->first() != null)
                return redirect()->back()->with('error', 'Please fill all fields');

        Language::where('locale', '<>', \App::getLocale())->delete();


        foreach($languages->where('locale', '<>', \App::getLocale()) as $language)
            Language::create($language);

        return redirect()->back()->with('message', 'Saved');
    }
}
