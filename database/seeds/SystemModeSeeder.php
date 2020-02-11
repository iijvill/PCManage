<?php

use Illuminate\Database\Seeder;

class SystemModeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('system_modes')->insert([
            ['systemmode_name' => '棚卸し' , 'run' => 0],
        ]);
    }
}
