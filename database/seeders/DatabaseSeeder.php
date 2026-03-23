<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    public function run(): void
    {
        if (app()->environment() !== 'production') {
            $this->call([
                UserSeeder::class,
                SportSeeder::class,
                ContinentSeeder::class,
                CountrySeeder::class,
                RegionSeeder::class,
            ]);
        }
    }
}
