<?php

namespace Tests\Unit;

use App\Models\Page;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Str;
use Tests\TestCase;

class PageTest extends TestCase
{

    use RefreshDatabase;

    /**
     * @return void
     */
    public function test_page_during_saving_generate_all_necessary_fields()
    {
        $metaTitle = "какой-то мета заголовок";
        $h1 = "какой-то текст";

        /** @var Page $page */
        $page = Page::create([
            'meta_title' => $metaTitle,
            'h1' => $h1,
        ]);

        $this->assertNotEmpty($page->getSlug());
        $this->assertNotEmpty($page->getUrl());
        $this->assertEquals($page->getSlug(), Str::slug($metaTitle));
    }

    /**
     * @return void
     */
    function test_page_success_hierarchy_generation()
    {
        $metaParentTitle = 'родитель';
        $metaChildTitle = 'потомок';

        /** @var Page $parent */
        $parent = Page::create([
            'meta_title' => $metaParentTitle,
        ]);

        /** @var Page $child */
        $child = Page::create([
            'meta_title' => $metaChildTitle,
            'parent_id' => $parent->getId()
        ]);

        $this->assertEquals($child->getUrl(), "{$parent->getUrl()}/{$child->getSlug()}");
    }
}
