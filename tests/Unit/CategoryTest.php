<?php

namespace Tests\Unit;

use App\Category;
use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class CategoryTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_categories_can_be_created()
    {
        $category = factory(Category::class)->create();
        $found_category = Category::find($category->id);
        $this->assertEquals($found_category->id, $category->id);
        $category->delete();
    }
}
