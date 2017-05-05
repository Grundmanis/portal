<?php

use Illuminate\Database\Seeder;

class CategoryTableSeeder extends Seeder
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
            DB::table('categories')->insert([
                [
                    'slug' => 'work',
                ],
                [
                    'slug' => 'transport',
                ],
                [
                    'slug' => 'vacancies',
                ],
                [
                    'slug' => 'auto',
                ],
            ]);
        } catch (\Exception $ex) {
            DB::rollBack();
            throw $ex;
        }
        DB::commit();
    }
}
