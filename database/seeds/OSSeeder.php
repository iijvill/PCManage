<?php

use Illuminate\Database\Seeder;

class OSSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('os_infos')->insert([
            ['os_name' =>'未設定'],
            ['os_name' =>'Windows 10'],
            ['os_name' =>'Windows 7'],
            ['os_name' =>'macOS'],
            ['os_name' =>'その他'],
        ]);
    }
}
