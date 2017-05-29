<?php

namespace Tests\Unit;

use App\Category;
use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class CategoryTest extends TestCase
{
    use DatabaseMigrations;
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testCategoryCanBeaCreated()
    {
        $category = factory(Category::class)->create();
        $found_category = Category::find($category->id);
        $this->assertEquals($found_category->id, $category->id);
        $category->delete();
    }
}
