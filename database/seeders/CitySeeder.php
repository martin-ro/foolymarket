<?php

namespace Database\Seeders;

use App\Models\City;
use Illuminate\Database\Seeder;

class CitySeeder extends Seeder
{
    public function run(): void
    {
        $data = json_decode(
            file_get_contents(storage_path('seed-data/cities.json')),
            associative: true,
        );

        foreach (array_chunk($data, 1000) as $chunk) {
            City::query()->upsert($chunk, ['id']);
        }
    }
}
