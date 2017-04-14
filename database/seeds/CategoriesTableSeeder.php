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
                    'name' => 'Work and Business',
                    'color' => 'success',
                    'parent_id' => 0
                ],
                [
                    'name' => 'Transport',
                    'color' => 'info',
                    'parent_id' => 0
                ],
                [
                    'name' => 'Property',
                    'color' => 'primary',
                    'parent_id' => 0
                ],
                [
                    'name' => 'Building',
                    'color' => 'danger',
                    'parent_id' => 0
                ],
                [
                    'name' => 'Electrical Engineering',
                    'color' => 'warning',
                    'parent_id' => 0
                ],
                [
                    'name' => 'Clothes',
                    'color' => 'success',
                    'parent_id' => 0
                ],
                [
                    'name' => 'For home',
                    'color' => 'info',
                    'parent_id' => 0
                ],
                [
                    'name' => 'Production',
                    'color' => 'primary',
                    'parent_id' => 0
                ],
                [
                    'name' => 'For kids',
                    'color' => 'danger',
                    'parent_id' => 0
                ],
                [
                    'name' => 'Animals',
                    'color' => 'warning',
                    'parent_id' => 0
                ],
                [
                    'name' => 'Agriculture',
                    'color' => 'success',
                    'parent_id' => 0
                ],
                [
                    'name' => 'Leisure, hobbies',
                    'color' => 'info',
                    'parent_id' => 0
                ],
                [
                    'name' => 'Vacancies',
                    'color' => '',
                    'parent_id' => 1
                ],
                [
                    'name' => 'Internet services',
                    'color' => '',
                    'parent_id' => 1
                ],
                [
                    'name' => 'Search for a job',
                    'color' => '',
                    'parent_id' => 1
                ],
                [
                    'name' => 'Passenger cars',
                    'color' => '',
                    'parent_id' => 2
                ],
                [
                    'name' => 'Freight cars',
                    'color' => '',
                    'parent_id' => 2
                ],
                [
                    'name' => 'Bikes',
                    'color' => '',
                    'parent_id' => 2
                ],
                [
                    'name' => 'Apartments',
                    'color' => '',
                    'parent_id' => 3
                ],
                [
                    'name' => 'Houses',
                    'color' => '',
                    'parent_id' => 3
                ],
                [
                    'name' => 'Offices',
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
