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
                // ContinentSeeder::class,
                // CountrySeeder::class,
                // RegionSeeder::class,
                // CitySeeder::class,
                // StateSeeder::class,
                // TypeSeeder::class,
                // BookmakerSeeder::class,
                // VenueSeeder::class,
                // TeamSeeder::class,
                // LeaguesSeeder::class,
                // SeasonSeeder::class,
                // StageSeeder::class,
                // RivalSeeder::class,
                // PlayerSeeder::class,
                // RefereeSeeder::class,
                // MarketSeeder::class,
                // RoundSeeder::class,
            ]);
        }
    }
}
