<?php

use Illuminate\Database\Seeder;

class AntivirusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('antivirus_infos')->insert([
            ['antivirus_name' =>'不明・なし', 'limit' => null],
            ['antivirus_name' =>'マカフィー', 'limit' => '2020-05-20'],
            ['antivirus_name' =>'カスペルスキー', 'limit' => '2020-01-05'],
        ]);
    }
}
