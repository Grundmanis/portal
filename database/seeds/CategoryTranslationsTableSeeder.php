<?php

use Illuminate\Database\Seeder;

class CategoryTranslationsTableSeeder extends Seeder
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
                    'name' => 'Work and Business',
                    'lng' => 'en',
                    'category_id' => 1
                ],
                [
                    'name' => 'Transport',
                    'lng' => 'en',
                    'category_id' => 2
                ],
                [
                    'name' => 'Property',
                    'lng' => 'en',
                    'category_id' => 3
                ],
                [
                    'name' => 'Building',
                    'lng' => 'en',
                    'category_id' => 4
                ],
                [
                    'name' => 'Electrical Engineering',
                    'lng' => 'en',
                    'category_id' => 5
                ],
                [
                    'name' => 'Clothes',
                    'lng' => 'en',
                    'category_id' => 6
                ],
                [
                    'name' => 'For home',
                    'lng' => 'en',
                    'category_id' => 7
                ],
                [
                    'name' => 'Production',
                    'lng' => 'en',
                    'category_id' => 8
                ],
                [
                    'name' => 'For kids',
                    'lng' => 'en',
                    'category_id' => 9
                ],
                [
                    'name' => 'Animals',
                    'lng' => 'en',
                    'category_id' => 10
                ],
                [
                    'name' => 'Agriculture',
                    'lng' => 'en',
                    'category_id' => 11
                ],
                [
                    'name' => 'Leisure, hobbies',
                    'lng' => 'en',
                    'category_id' => 12
                ],
                [
                    'name' => 'Vacancies',
                    'lng' => 'en',
                    'category_id' => 13
                ],
                [
                    'name' => 'Internet services',
                    'lng' => 'en',
                    'category_id' => 14
                ],
                [
                    'name' => 'Search for a job',
                    'lng' => 'en',
                    'category_id' => 15
                ],
                [
                    'name' => 'Passenger cars',
                    'lng' => 'en',
                    'category_id' => 16
                ],
                [
                    'name' => 'Freight cars',
                    'lng' => 'en',
                    'category_id' => 17
                ],
                [
                    'name' => 'Bikes',
                    'lng' => 'en',
                    'category_id' => 18
                ],
                [
                    'name' => 'Apartments',
                    'lng' => 'en',
                    'category_id' => 19
                ],
                [
                    'name' => 'Houses',
                    'lng' => 'en',
                    'category_id' => 20
                ],
                [
                    'name' => 'Offices',
                    'lng' => 'en',
                    'category_id' => 21
                ],
            ]);
        } catch (\Exception $ex) {
            DB::rollBack();
            throw $ex;
        }

        DB::commit();
    }
}
