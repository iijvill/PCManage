<?php

use Illuminate\Database\Seeder;

use Faker\Generator as FakerGenerator;    // 追記
use Faker\Factory as FakerFactory;        // 追記

class EmployeeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Fakerを使ってダミーデータを生成する
        $faker = FakerFactory::create('ja_JP');

        $employee_count = 100;

        for($emp_id = 0; $emp_id <= $employee_count; $emp_id++){
            $rnd_name = $faker->name;
            $rnd_email = $faker->email;
        
            DB::table('employee_infos')->insert([
                'employee_name' => $rnd_name,
                'email'         => $rnd_email,
            ]);
        };  
    }
}
