<?php

namespace M0xy\Cms\Controllers;

use App\Http\Controllers\Controller;
use App\Services\TicketService;
use M0xy\Cms\Models\Category;
use M0xy\Cms\Models\Page;
use M0xy\Cms\Models\Uri;

class PageController extends Controller
{

    public function index()
    {
        $page = Page::where('slug', '/')->firstOrFail();

        return view('page', [
            'entity' => $page
        ]);
    }


    public function handle($url)
    {
        $uri = Uri::where('uri', $url)->firstOrFail();

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

        if(isset($page->parameters->is_ticket))
            return view('ticket', [
                'entity' => $page
            ]);
        elseif(isset($page->parameters->is_exam))
            return $this->exam($page);

        return view('page', [
            'entity' => $page
        ]);
    }

    private function exam(Page $page){
        $page->tickets = TicketService::getQuestions($page);

        return view('exam', [
            'entity' => $page
        ]);
    }


    private function category(Uri $url)
    {
        $entity = Category::where('id', $url->entity_id)->firstOrFail();
        $tickets = Page::with('uri')->where('category_id', $entity->id)->get();

        return view('category', [
            'entity' => $entity,
            'tickets' => $tickets
        ]);
    }


}
