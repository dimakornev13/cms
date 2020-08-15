<?php

namespace App\Http\Controllers;

use App\Models\Uri;
use App\Repositories\CategoryRepository;
use App\Repositories\PageRepository;
use App\Repositories\UriRepository;

class PageController extends Controller
{
    private $pages;
    private $categories;
    private $uri;

    public function __construct(PageRepository $pages, CategoryRepository $categories, UriRepository $uri)
    {
        $this->pages = $pages;
        $this->categories = $categories;
        $this->uri = $uri;
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $page = $this->pages->getIndexPage();

        return view('index', compact('page'));
    }


    public function handle(Uri $url)
    {
        switch ($url->type) {
            case Uri::TYPE_PAGE:
                return $this->page($url);

            case Uri::TYPE_PAGES_CATEGORY:
                return $this->category($url);
        }
    }


    private function page(Uri $url)
    {
        $entity = $this->pages->findOrFail((int) $url->entity_id);

        return view('page', compact('entity'));
    }


    private function category(Uri $url)
    {
        $entity = $this->categories->findOrFail((int) $url->entity_id);

        return view('category', compact('entity'));
    }


}
