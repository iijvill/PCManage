<?php

use Illuminate\Database\Seeder;

class PcmakerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('pcmaker_infos')->insert([
            ['pcmaker_name' => '未設定'],
            ['pcmaker_name' => 'Dell'],
            ['pcmaker_name' => 'Apple'],
            ['pcmaker_name' => 'Lenovo'],
            ['pcmaker_name' => 'ASUS'],
        ]);
    }
}
