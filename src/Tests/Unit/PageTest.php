<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use M0xy\Cms\Models\Page;
use M0xy\Cms\Models\Uri;
use Tests\TestCase;

class PageTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic unit test example.
     *
     * @return void
     */
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

    //public function test_pages_categories()
    //{
    //    $categories = factory(Category::class, 3)->create();
    //    $page = factory(Page::class)->create();
    //
    //    collect($categories)->map(function ($category) use ($page){
    //        PagesCategory::create([
    //            'category_id' => $category->id,
    //            'page_id' => $page->id
    //        ]);
    //    });
    //
    //    $this->assertEquals(3, PagesCategory::all()->count());
    //}

}
