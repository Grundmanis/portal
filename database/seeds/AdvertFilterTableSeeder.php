<?php

use Illuminate\Database\Seeder;

class AdvertFilterTableSeeder extends Seeder
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
            DB::table('advert_filters')->insert([
                [
                    'advert_id' => 1,
                    'filter_id' => 1,
                    'key' => 'work_days',
                    'value' => 'week'
                ],
                [
                    'advert_id' => 1,
                    'filter_id' => 2,
                    'key' => 'company_name',
                    'value' => 'devp'
                ],
                [
                    'advert_id' => 1,
                    'filter_id' => 3,
                    'key' => 'work_time',
                    'value' => '9:00'
                ],
                [
                    'advert_id' => 1,
                    'filter_id' => 4,
                    'key' => 'location',
                    'value' => 'riga'
                ],
                [
                    'advert_id' => 2,
                    'filter_id' => 1,
                    'key' => 'work_days',
                    'value' => 'holidays'
                ],
                [
                    'advert_id' => 2,
                    'filter_id' => 2,
                    'key' => 'company_name',
                    'value' => 'picanova'
                ],
                [
                    'advert_id' => 2,
                    'filter_id' => 3,
                    'key' => 'work_time',
                    'value' => '10:00'
                ],
                [
                    'advert_id' => 2,
                    'filter_id' => 4,
                    'key' => 'location',
                    'value' => 'jurmala'
                ],
            ]);
        } catch (\Exception $ex) {
            DB::rollBack();
            throw $ex;
        }

        DB::commit();
    }
}
