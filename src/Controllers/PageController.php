<?php

namespace M0xy\Cms\Controllers;

use App\Http\Controllers\Controller;
use M0xy\Cms\Models\Category;
use M0xy\Cms\Models\Page;
use M0xy\Cms\Models\Uri;

class PageController extends Controller
{

    public function index()
    {
        //$page = Page::where('slug', '/')->firstOrFail();

        return view('index', [
            //'entity' => $page
        ]);
    }


    public function handle(Uri $url)
    {
        switch ($uri->type) {
            case Uri::TYPE_PAGE:
                return $this->page($uri);

            case Uri::TYPE_PAGES_CATEGORY:
                return $this->category($uri);
        }
    }


    private function page(Uri $url)
    {
        $page = Page::findOrFail($url->entity_id);

        return view('page', [
            'entity' => $page
        ]);
    }


    private function category(Uri $url)
    {
        $entity = Category::where('id', $url->entity_id)->firstOrFail();

        return view('category', [
            'entity' => $entity,
            'tickets' => $tickets
        ]);
    }


}
