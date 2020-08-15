<?php

namespace App\Services\Cms\Page;


use App\Models\Page;
use App\Models\Uri;
use App\Repositories\UriRepository;

class UriService
{
    private $urls;

    public function __construct(UriRepository $urls)
    {
        $this->urls = $urls;
    }

    /**
     * Generate Uri for page and save it
     * @param Page $page
     */
    public function makeUri(Page $page)
    {

        $this->delete($page);

        try {
            $this->urls->create([
                'uri' => $this->getUri($page),
                'entity_id' => $page->id,
                'type' => Uri::TYPE_PAGE
            ]);
        } catch (\Throwable $exception) {
            $page->slug = $page->slug . '-2';
            $page->save();
        }
    }


    /**
     * Return Uri for page
     *
     * @param Page $page
     *
     * @return string
     */
    private function getUri(Page $page): string
    {
        return $page->category_id > 0
            ? $page->category->uri->uri . '/' . $page->slug
            : $page->slug;
    }


    public function exists(Page $page)
    {
        return $this->urls->exists($this->getUri($page));
    }


    public function delete(Page $page)
    {
        $this->urls->deletePage((int)$page->id);
    }
}
