<?php

namespace App\Http\Controllers;

use App\Models\Page;
use App\Models\Uri;

class PageController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        return view('index', [
            'entity' => Page::query()->where('url', '=', '/')->firstOrFail()
        ]);
    }

    /**
     * @param Page $entity
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    private function page(Page $entity)
    {
        return view('page', compact('entity'));
    }
}
