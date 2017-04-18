<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         $this->call(CategoriesTableSeeder::class);
         $this->call(SubCategoriesTableSeeder::class);
         $this->call(CategoryTranslationsTableSeeder::class);
         $this->call(CategorySubcategoryTableSeeder::class);
         $this->call(SubcategoryTranslationsTableSeeder::class);
         $this->call(CategoryFiltersTableSeeder::class);
         $this->call(UserTableSeeder::class);
         $this->call(AdvertTableSeeder::class);
         $this->call(AdvertFilterTableSeeder::class);
    }
}
