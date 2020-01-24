<?php

use App\Model\Authority;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(EmployeeSeeder::class);
        $this->call(DepartmentSeeder::class);
        $this->call(PcmakerSeeder::class);
        $this->call(PcStorageType::class);
        $this->call(PcTypeSeeder::class);
        $this->call(AntivirusSeeder::class);
        $this->call(AuthSeed::class);
        $this->call(SystemModeSeeder::class);
        $this->call(OSSeeder::class);
        $this->call(CPUSeeder::class);
    }
}
