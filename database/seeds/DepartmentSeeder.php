<?php

use Illuminate\Database\Seeder;
class DepartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('department_infos')->insert([
            ['department_name' => '在庫・保管'],
            ['department_name' => 'メディア'],
            ['department_name' => '情報商材'],
            ['department_name' => 'システム'],
            ['department_name' => 'デザイン・コーダー'],
            ['department_name' => '総務・経理・役員'],
        ]);
    }
}
