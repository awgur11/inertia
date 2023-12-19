<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Resources\PageResource;
use App\Models\Page;
use Inertia\Inertia;
use Illuminate\Validation\Rule;

class PageController extends Controller
{
    public function index()
    {
        $pages = Page::with('language')->whereType('pages')->paginate(30);

        return Inertia('Pages/Index', [
            'pages' => PageResource::collection($pages)
        ]);
    }

    public function create(Page $page)
    {
        return Inertia::render('Pages/Create');
    }

    public function store(Request $request)
    {
        $request->request->add([
            'alt_title' => str()->slug($request->languages[0]['title'])
        ]);

        $request->validate([
            'alt_title' => 'unique:pages|max:256',
            'languages.*.title' => 'required|max:256|min:3',
            'languages.*.content' => 'max:65000',
            'languages.*.tag_title' => 'max:256',
            'languages.*.description' => 'max:1200',
        ]);

        $page = Page::create($request->only('alt_title', 'public', 'type', 'preview'));

        $page->languages()->createMany($request->languages);

        return redirect()->route('pages.index')->with('message', 'Saved');
    }

    public function edit(Page $page)
    {
        return Inertia::render(
            'Pages/Edit',
            [
                'page' => Page::with('languages')->find($page->id)
            ]
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Page $page)
    {
        $request->request->add([
            'alt_title' => str()->slug($request->languages[0]['title'])
        ]);

        $request->validate([
            'alt_title' => [Rule::unique('pages')->ignore($page->id)],
            'languages.*.title' => 'required|max:256|min:3',
            'languages.*.content' => 'max:65000',
          //  'languages.*.tag_title' => 'max:256|min:3',
            'languages.*.description' => 'max:1200',

        ]);

        if($request->has('public') && $request->public == true)
            $page->public = 1;
        else
            $page->public = 0;



        $page->alt_title = str()->slug($request->languages[0]['title']);
      //  $page->public = $request->public;
        $page->save();

        foreach($request->languages as $lang)
        {
            if($page->languages()->where('language', $lang['language'])->first() != null)
                $page->languages()->where('language', $lang['language'])->update($lang);
            else
                $page->languages()->create($lang);

        }

        return redirect()->route('pages.edit', ['page' => $page->id])->with('message', 'Blog Created Successfully');
    }

    public function destroy(Page $page)
    {

        $page->delete();
        sleep(1);

        return redirect()->route('pages.index')->with('message', 'page Delete Successfully');
    }
}
