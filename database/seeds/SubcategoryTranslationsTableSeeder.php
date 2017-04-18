<?php

use Illuminate\Database\Seeder;

class SubcategoryTranslationsTableSeeder extends Seeder
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
            DB::table('category_translations')->insert([
                [
                    'name' => 'Programmer',
                    'lng' => 'en',
                    'subcategory_id' => 1
                ],
                [
                    'name' => 'Designer',
                    'lng' => 'en',
                    'subcategory_id' => 2
                ],
                [
                    'name' => 'Web-development',
                    'lng' => 'en',
                    'subcategory_id' => 3
                ],
                [
                    'name' => 'Administration',
                    'lng' => 'en',
                    'subcategory_id' => 4
                ],
                [
                    'name' => 'BMW',
                    'lng' => 'en',
                    'subcategory_id' => 5
                ],
                [
                    'name' => 'AUDI',
                    'lng' => 'en',
                    'subcategory_id' => 6
                ],
                [
                    'name' => 'Buses',
                    'lng' => 'en',
                    'subcategory_id' => 7
                ],
                [
                    'name' => 'Riga',
                    'lng' => 'en',
                    'subcategory_id' => 8
                ],
                [
                    'name' => 'Jurmala',
                    'lng' => 'en',
                    'subcategory_id' => 9
                ]
            ]);
        } catch (\Exception $ex) {
            DB::rollBack();
            throw $ex;
        }

        DB::commit();
    }
}
