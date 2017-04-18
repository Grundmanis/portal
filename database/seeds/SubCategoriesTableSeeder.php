<?php

use Illuminate\Database\Seeder;

class SubCategoriesTableSeeder extends Seeder
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
            DB::table('subcategories')->insert([
                [
                    'slug' => 'programmer',
                ],
                [
                    'slug' => 'designer',
                ],
                [
                    'slug' => 'web-development',
                ],
                [
                    'slug' => 'administration',
                ],
                [
                    'slug' => 'bmw',
                ],
                [
                    'slug' => 'audi',
                ],
                [
                    'slug' => 'buses',
                ],
                [
                    'slug' => 'riga',
                ],
                [
                    'slug' => 'jurmala',
                ],
            ]);
        } catch (\Exception $ex) {
            DB::rollBack();
            throw $ex;
        }

        DB::commit();
    }
}
