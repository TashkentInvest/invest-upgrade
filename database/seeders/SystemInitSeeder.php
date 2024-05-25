<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Database\Seeders\Init\RoleSeeder;
use Database\Seeders\Init\UserSeeder;
use Database\Seeders\Init\RegionsSeeder;
use Database\Seeders\Init\DistrictsSeeder;

class SystemInitSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(
            [
                RoleSeeder::class,
                UserSeeder::class,
                RegionsSeeder::class,
                DistrictsSeeder::class,
            ]
        );
    }
}
