<?php

use Illuminate\Database\Seeder;

class AdvertTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::beginTransaction();
        try {
            DB::table('adverts')->insert([
                [
                    'user_id' => 1,
                    'category_id' => 13,
                    'subcategory_id' => 1,
                    'text' => 'Programmer text'
                ],
                [
                    'user_id' => 1,
                    'category_id' => 13,
                    'subcategory_id' => 1,
                    'text' => '0Programmer text'
                ],
                [
                    'user_id' => 1,
                    'category_id' => 13,
                    'subcategory_id' => 1,
                    'text' => '1Programmer text'
                ],
                [
                    'user_id' => 1,
                    'category_id' => 13,
                    'subcategory_id' => 1,
                    'text' => '2Programmer text'
                ],
                [
                    'user_id' => 1,
                    'category_id' => 13,
                    'subcategory_id' => 1,
                    'text' => '3Programmer text'
                ],
                [
                    'user_id' => 1,
                    'category_id' => 13,
                    'subcategory_id' => 1,
                    'text' => '4Programmer text'
                ],
                [
                    'user_id' => 1,
                    'category_id' => 13,
                    'subcategory_id' => 2,
                    'text' => 'designer text'
                ],
                [
                    'user_id' => 1,
                    'category_id' => 13,
                    'subcategory_id' => 2,
                    'text' => '2designer text'
                ],
                [
                    'user_id' => 1,
                    'category_id' => 13,
                    'subcategory_id' => 2,
                    'text' => '3designer text'
                ],
            ]);
        } catch (\Exception $ex) {
            DB::rollBack();
            throw $ex;
        }

        DB::commit();
    }
}
