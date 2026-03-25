<?php

namespace Database\Seeders;

use App\Models\Continent;
use Illuminate\Database\Seeder;

class ContinentSeeder extends Seeder
{
    public function run(): void
    {
        $data = json_decode(
            file_get_contents(storage_path('seed-data/continents.json')),
            associative: true,
        );

        Continent::query()->upsert($data, ['id']);
    }
}
