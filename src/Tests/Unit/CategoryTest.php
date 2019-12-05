<?php

namespace Tests\Unit;


use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Str;
use M0xy\Cms\Models\Category;
use M0xy\Cms\Models\Uri;
use Tests\TestCase;

class CategoryTest extends TestCase
{

    use RefreshDatabase;


    /**
     * A basic unit test example.
     *
     * @return void
     */

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

        $this->assertEquals(',1,', $entity->path);
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


        $this->assertEquals(',1,2,', $entity->path);
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

        $this->assertEquals(',1,2,3,', $entity->path);
        $this->assertEquals($expectedUri, $entity->uri->uri);
    }

}
