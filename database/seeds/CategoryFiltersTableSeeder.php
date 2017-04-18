<?php

use Illuminate\Database\Seeder;

class CategoryFiltersTableSeeder extends Seeder
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
            DB::table('category_filters')->insert([
                [
                    'category_id' => 13,
                    'name' => 'work_days',
                    'type' => 'select',
                    'value' => '["week","holidays"]',
                    'main' => 0
                ],
                [
                    'category_id' => 13,
                    'name' => 'company_name',
                    'type' => 'input',
                    'value' => '',
                    'main' => 1
                ],
                [
                    'category_id' => 13,
                    'name' => 'work_time',
                    'type' => 'input',
                    'value' => '',
                    'main' => 1
                ],
                [
                    'category_id' => 13,
                    'name' => 'location',
                    'type' => 'select',
                    'value' => '["riga","jurmala"]',
                    'main' => 1
                ],
            ]);
        } catch (\Exception $ex) {
            DB::rollBack();
            throw $ex;
        }

        DB::commit();
    }
}
