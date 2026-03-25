<?php

namespace Database\Seeders;

use App\Models\Bookmaker;
use Illuminate\Database\Seeder;

class BookmakerSeeder extends Seeder
{
    public function run(): void
    {
        $data = json_decode(
            file_get_contents(storage_path('seed-data/bookmakers.json')),
            associative: true,
        );

        Bookmaker::query()->upsert($data, ['id']);
    }
}
