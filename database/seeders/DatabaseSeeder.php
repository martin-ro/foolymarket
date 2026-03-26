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
                StateSeeder::class,
                TypeSeeder::class,
                ContinentSeeder::class,
                CountrySeeder::class,
                RegionSeeder::class,
                CitySeeder::class,
                VenueSeeder::class,
                BookmakerSeeder::class,
                MarketSeeder::class,
                LeagueSeeder::class,
                SeasonSeeder::class,
                StageSeeder::class,
                TeamSeeder::class,
                RivalSeeder::class,
                PlayerSeeder::class,
                RefereeSeeder::class,
                RoundSeeder::class,
                StageSeeder::class,
                FixtureSeeder::class,
            ]);
        }
    }
}
