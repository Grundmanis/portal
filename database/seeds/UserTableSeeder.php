<?php

use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
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
            DB::table('users')->insert([
                [
                    'name' => 'Armand Grundmanis',
                    'email' => 'agrundmanis@inbox.lv',
                    'password' => bcrypt('secret')
                ],
            ]);
        } catch (\Exception $ex) {
            DB::rollBack();
            throw $ex;
        }

        DB::commit();
    }
}
