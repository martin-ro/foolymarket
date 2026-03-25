<?php

namespace Database\Seeders;

use App\Models\Round;
use Illuminate\Database\Seeder;

class RoundSeeder extends Seeder
{
    public function run(): void
    {
        $data = json_decode(
            file_get_contents(storage_path('seed-data/rounds.json')),
            associative: true,
        );

        Round::query()->upsert($data, ['id']);
    }
}
