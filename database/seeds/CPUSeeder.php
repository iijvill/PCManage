<?php

use Illuminate\Database\Seeder;

class CPUSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        DB::table('cpu_infos')->insert([
            ['cpu_name' => '未設定'],
            ['cpu_name' => 'Core i7'],
            ['cpu_name' => 'Core i5'],
            ['cpu_name' => 'Core i3'],
            ['cpu_name' => 'Pentium'],
            ['cpu_name' => 'Celeron'],
            ['cpu_name' => 'Atom'],
        ]);
    }
}
