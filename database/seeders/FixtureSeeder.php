<?php

namespace Database\Seeders;

use App\Models\Fixture;
use Illuminate\Database\Seeder;

class FixtureSeeder extends Seeder
{
    public function run(): void
    {
        $data = json_decode(
            file_get_contents(storage_path('seed-data/fixtures.json')),
            associative: true,
        );

        foreach (array_chunk($data, 1000) as $chunk) {
            Fixture::query()->upsert($chunk, ['id']);
        }
    }
}
