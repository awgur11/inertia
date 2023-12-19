<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Page;

class SiteController extends Controller
{
    public function index()
    {
        $pages = Page::with('language')->where('type', 'pages')->wherePublic(1)->get();

        return Inertia::render('Site/Index', [
            'pages' => $pages
        ]);
    }

    public function page($alt_title)
    {
        return Inertia::render('Site/Page', [
            'page' => Page::with('language')->where('alt_title', $alt_title)->first(),
            'pages' => Page::with('language')->where('type', 'pages')->wherePublic(1)->get()
        ]);
    }
}
