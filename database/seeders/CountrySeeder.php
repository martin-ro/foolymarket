<?php

namespace Database\Seeders;

use App\Models\Country;
use Illuminate\Database\Seeder;

class CountrySeeder extends Seeder
{
    public function run(): void
    {
        Country::factory()->create([
            'id' => 11,
            'continent_id' => 1,
            'name' => 'Germany',
            'official_name' => 'Federal Republic of Germany',
            'fifa_name' => 'GER',
            'iso2' => 'DE',
            'iso3' => 'DEU',
            'latitude' => '51.2024651',
            'longitude' => '10.3822031',
            'borders' => ['AUT', 'BEL', 'CZE', 'DNK', 'FRA', 'LUX', 'NLD', 'POL', 'CHE'],
            'image_path' => 'https://cdn.sportmonks.com/images/countries/png/short/de.png',
        ]);

        Country::factory()->create([
            'id' => 462,
            'continent_id' => 1,
            'name' => 'England',
            'official_name' => 'England',
            'fifa_name' => 'ENG',
            'iso2' => 'EN',
            'iso3' => 'ENG',
            'latitude' => '54.5608864',
            'longitude' => '-2.2125118',
            'borders' => ['IRL'],
            'image_path' => 'https://cdn.sportmonks.com/images/countries/png/short/en.png',
        ]);

        Country::factory()->create([
            'id' => 17,
            'continent_id' => 1,
            'name' => 'France',
            'official_name' => 'French Republic',
            'fifa_name' => 'FRA',
            'iso2' => 'FR',
            'iso3' => 'FRA',
            'latitude' => '46.6372795',
            'longitude' => '2.3382623',
            'borders' => ['AND', 'BEL', 'DEU', 'ITA', 'LUX', 'MCO', 'ESP', 'CHE'],
            'image_path' => 'https://cdn.sportmonks.com/images/countries/png/short/fr.png',
        ]);

        Country::factory()->create([
            'id' => 251,
            'continent_id' => 1,
            'name' => 'Italy',
            'official_name' => 'Italian Republic',
            'fifa_name' => 'ITA',
            'iso2' => 'IT',
            'iso3' => 'ITA',
            'latitude' => '42.7669792',
            'longitude' => '12.4938231',
            'borders' => ['AUT', 'FRA', 'SMR', 'SVN', 'CHE', 'VAT'],
            'image_path' => 'https://cdn.sportmonks.com/images/countries/png/short/it.png',
        ]);

        Country::factory()->create([
            'id' => 32,
            'continent_id' => 1,
            'name' => 'Spain',
            'official_name' => 'Kingdom of Spain',
            'fifa_name' => 'ESP',
            'iso2' => 'ES',
            'iso3' => 'ESP',
            'latitude' => '40.3960266',
            'longitude' => '-3.5506926',
            'borders' => ['AND', 'FRA', 'GIB', 'PRT', 'MAR'],
            'image_path' => 'https://cdn.sportmonks.com/images/countries/png/short/es.png',
        ]);
    }
}
