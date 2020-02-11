<?php

use Illuminate\Database\Seeder;

class AuthSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('authorities')->insert([
            ['auth_name' => '一般'],
            ['auth_name' => 'オペレータ'],
            ['auth_name' => 'PC管理者'],
            ['auth_name' => 'システム管理者'],
        ]);
    }
}
