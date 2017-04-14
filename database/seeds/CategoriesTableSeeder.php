<?php

use Illuminate\Database\Seeder;

class CategoriesTableSeeder extends Seeder
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
                    'slug' => 'Work and Business',
                    'color' => 'success',
                    'parent_id' => 0
                ],
                [
                    'slug' => 'Transport',
                    'color' => 'info',
                    'parent_id' => 0
                ],
                [
                    'slug' => 'Property',
                    'color' => 'primary',
                    'parent_id' => 0
                ],
                [
                    'slug' => 'Building',
                    'color' => 'danger',
                    'parent_id' => 0
                ],
                [
                    'slug' => 'Electrical Engineering',
                    'color' => 'warning',
                    'parent_id' => 0
                ],
                [
                    'slug' => 'Clothes',
                    'color' => 'success',
                    'parent_id' => 0
                ],
                [
                    'slug' => 'For home',
                    'color' => 'info',
                    'parent_id' => 0
                ],
                [
                    'slug' => 'Production',
                    'color' => 'primary',
                    'parent_id' => 0
                ],
                [
                    'slug' => 'For kids',
                    'color' => 'danger',
                    'parent_id' => 0
                ],
                [
                    'slug' => 'Animals',
                    'color' => 'warning',
                    'parent_id' => 0
                ],
                [
                    'slug' => 'Agriculture',
                    'color' => 'success',
                    'parent_id' => 0
                ],
                [
                    'slug' => 'Leisure, hobbies',
                    'color' => 'info',
                    'parent_id' => 0
                ],
                [
                    'slug' => 'Vacancies',
                    'color' => '',
                    'parent_id' => 1
                ],
                [
                    'slug' => 'Internet services',
                    'color' => '',
                    'parent_id' => 1
                ],
                [
                    'slug' => 'Search for a job',
                    'color' => '',
                    'parent_id' => 1
                ],
                [
                    'slug' => 'Passenger cars',
                    'color' => '',
                    'parent_id' => 2
                ],
                [
                    'slug' => 'Freight cars',
                    'color' => '',
                    'parent_id' => 2
                ],
                [
                    'slug' => 'Bikes',
                    'color' => '',
                    'parent_id' => 2
                ],
                [
                    'slug' => 'Apartments',
                    'color' => '',
                    'parent_id' => 3
                ],
                [
                    'slug' => 'Houses',
                    'color' => '',
                    'parent_id' => 3
                ],
                [
                    'slug' => 'Offices',
                    'color' => '',
                    'parent_id' => 3
                ],
            ]);
        } catch (\Exception $ex) {
            DB::rollBack();
            throw $ex;
        }

        DB::commit();
    }
}
