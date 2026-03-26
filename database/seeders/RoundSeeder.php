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

        foreach (array_chunk($data, 1000) as $chunk) {
            Round::query()->upsert($chunk, ['id']);
        }
    }
}
