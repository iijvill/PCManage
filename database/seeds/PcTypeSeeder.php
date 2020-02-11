<?php

use Illuminate\Database\Seeder;

class PcTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('pctype_infos')->insert([
            ['pctype_name' => '不明'],
            ['pctype_name' => 'デスクトップPC'],
            ['pctype_name' => 'オールインワンPC'],
            ['pctype_name' => 'ノートPC'],
        ]);
    }
}
