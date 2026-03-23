<?php

namespace Database\Seeders;

use App\Models\Region;
use Illuminate\Database\Seeder;

class RegionSeeder extends Seeder
{
    public function run(): void
    {
        $regions = json_decode(
            file_get_contents(storage_path('seed-data/regions.json')),
            associative: true,
        );

        Region::query()->upsert($regions, ['id']);
    }
}
