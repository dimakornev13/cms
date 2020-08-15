<?php

namespace Tests\Unit;


use App\Models\Category;
use App\Models\Page;
use App\Models\Uri;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Str;
use Tests\TestCase;

class CategoryTest extends TestCase
{

    use RefreshDatabase;


    public function test_category_saving_event()
    {
        $category = Category::create([
            'meta_title' => 'тест и вторая строка'
        ]);

        $uri = $category->uri;

        $this->assertEquals('test-i-vtoraya-stroka', $category->slug);
        $this->assertTrue($category->uri instanceof Uri);
        $this->assertEquals($uri->uri, $category->slug);
        $this->assertEquals($uri->type, Uri::TYPE_PAGES_CATEGORY);
        $this->assertEquals($uri->entity_id, $category->id);

        $category->update([
            'meta_title' => 'тест и вторая строка'
        ]);

        $this->assertEquals(Uri::where('uri', $category->slug)->count(), 1);
    }


    public function test_category_slug()
    {
        $entity = Category::create([
            'meta_title' => 'тест и вторая строка'
        ]);

        $this->assertEquals('test-i-vtoraya-stroka', $entity->slug);
    }


    public function test_generate_path()
    {
        $entity = Category::create([
            'meta_title' => 'тест и вторая строка'
        ]);

        $this->assertEquals(','.$entity->id.',', $entity->path);
        $this->assertEquals(Str::slug($entity->meta_title), $entity->uri->uri);
    }


    public function test_generate_path_with_parents()
    {
        $parent = Category::create([
            'meta_title' => 'тест и вторая строка'
        ]);

        $entity = Category::create([
            'meta_title' => 'тест и вторая строка',
            'parent_id' => $parent->id
        ]);


        $this->assertEquals(sprintf(',%d,%d,', $parent->id, $entity->id), $entity->path);
        $this->assertEquals(Str::slug($parent->meta_title) . '/' . Str::slug($entity->meta_title), $entity->uri->uri);

    }


    public function test_generate_path_with_parents2()
    {
        $parent1 = Category::create([
            'meta_title' => 'тест и вторая строка'
        ]);

        $parent2 = Category::create([
            'meta_title' => 'тест и вторая строка',
            'parent_id' => $parent1->id,
        ]);

        $entity = Category::create([
            'meta_title' => 'тест и вторая строка',
            'parent_id' => $parent2->id
        ]);

        $expectedUri = Str::slug($parent1->meta_title) . '/' . Str::slug($parent2->meta_title) . '/' . Str::slug($entity->meta_title);

        $expectedPath = sprintf(',%s,%s,%s,', $parent1->id, $parent2->id, $entity->id);

        $this->assertEquals($expectedPath, $entity->path);
        $this->assertEquals($expectedUri, $entity->uri->uri);
    }


    public function test_category_multiple_pages(){
        $category = Category::create([
            'meta_title' => 'category'
        ]);

        $page1 = Page::create([
            'meta_title' => 'page1'
        ]);

        $page2 = Page::create([
            'meta_title' => 'page2'
        ]);

        $page1->categories()->attach($category->id);
        $page2->categories()->attach($category->id);

        $this->assertEquals(2, count($category->pages));
    }
}
