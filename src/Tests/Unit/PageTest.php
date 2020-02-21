<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\DB;
use M0xy\Cms\Models\Category;
use M0xy\Cms\Models\Page;
use M0xy\Cms\Models\Uri;
use Tests\TestCase;

class PageTest extends TestCase
{

    use RefreshDatabase;


    public function test_page_saving_event()
    {
        $page = Page::create([
            'meta_title' => 'тест и вторая строка'
        ]);

        $uri = Uri::where('uri', $page->slug)->first();

        $this->assertEquals('test-i-vtoraya-stroka', $page->slug);
        $this->assertTrue($uri instanceof Uri);
        $this->assertEquals($uri->uri, $page->slug);
        $this->assertEquals($uri->type, Uri::TYPE_PAGE);
        $this->assertEquals($uri->entity_id, $page->id);

        $page->update([
            'meta_title' => 'тест и вторая строка'
        ]);

        $this->assertEquals(Uri::where('uri', $page->slug)->count(), 1);
    }


    public function test_pages_categories()
    {
        $category = Category::create([
            'meta_title' => 'тест и вторая строка'
        ]);

        $page = Page::create([
            'meta_title' => 'тест и вторая строка',
            'category_id' => $category->id
        ]);

        $page->categories()->attach($category->id);

        $this->assertEquals($category->id, $page->category_id);
        $this->assertEquals(1, count($page->categories));
    }
}
