<?php

use Illuminate\Database\Seeder;

class PcStorageType extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('storage_types')->insert([
            ['storage_name' => '不明'],
            ['storage_name' => 'HDD'],
            ['storage_name' => 'SSD']
        ]);
    }
}
