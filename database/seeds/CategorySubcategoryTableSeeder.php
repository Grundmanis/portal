<?php

use Illuminate\Database\Seeder;

class CategorySubcategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @throws Exception
     */
    public function run()
    {
        DB::beginTransaction();
        try {
            DB::table('category_subcategory')->insert([
                [
                    'category_id' => 13,
                    'subcategory_id' => 1,
                ],
                [
                    'category_id' => 13,
                    'subcategory_id' => 2,
                ],
                [
                    'category_id' => 14,
                    'subcategory_id' => 3,
                ],
                [
                    'category_id' => 14,
                    'subcategory_id' => 4,
                ],
                [
                    'category_id' => 15,
                    'subcategory_id' => 1,
                ],
                [
                    'category_id' => 15,
                    'subcategory_id' => 2,
                ],
                [
                    'category_id' => 16,
                    'subcategory_id' => 5,
                ],
                [
                    'category_id' => 16,
                    'subcategory_id' => 6,
                ],
                [
                    'category_id' => 17,
                    'subcategory_id' => 7,
                ],
                [
                    'category_id' => 19,
                    'subcategory_id' => 8,
                ],
                [
                    'category_id' => 19,
                    'subcategory_id' => 9,
                ],
                [
                    'category_id' => 20,
                    'subcategory_id' => 8,
                ],
                [
                    'category_id' => 20,
                    'subcategory_id' => 9,
                ],
                [
                    'category_id' => 21,
                    'subcategory_id' => 8,
                ],
                [
                    'category_id' => 21,
                    'subcategory_id' => 9,
                ],
            ]);
        } catch (\Exception $ex) {
            DB::rollBack();
            throw $ex;
        }

        DB::commit();
    }
}
