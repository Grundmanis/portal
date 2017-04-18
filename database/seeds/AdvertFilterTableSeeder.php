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
                    'value' => 'mon'
                ],
                [
                    'advert_id' => 1,
                    'filter_id' => 2,
                    'value' => 'DEVP'
                ],
                [
                    'advert_id' => 1,
                    'filter_id' => 3,
                    'value' => '9:00'
                ],
                [
                    'advert_id' => 1,
                    'filter_id' => 4,
                    'value' => 'Riga'
                ],
                [
                    'advert_id' => 2,
                    'filter_id' => 1,
                    'value' => 'holidays'
                ],
                [
                    'advert_id' => 2,
                    'filter_id' => 2,
                    'value' => 'Picanova'
                ],
                [
                    'advert_id' => 2,
                    'filter_id' => 3,
                    'value' => '10:00'
                ],
                [
                    'advert_id' => 2,
                    'filter_id' => 4,
                    'value' => 'Jurmala'
                ],
            ]);
        } catch (\Exception $ex) {
            DB::rollBack();
            throw $ex;
        }

        DB::commit();
    }
}
